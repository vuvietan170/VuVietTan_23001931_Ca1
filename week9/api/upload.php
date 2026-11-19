<?php
require __DIR__ . '/common.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, ['message' => 'Chỉ hỗ trợ POST'], 405);
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    respond(false, ['message' => 'ID không hợp lệ hoặc yêu cầu upload quá lớn'], 400);
}
$file = $_FILES['image'] ?? null;
if (!$file || !isset($file['error']) || is_array($file['error'])) {
    respond(false, ['message' => 'Vui lòng chọn ảnh'], 400);
}
if ($file['error'] !== UPLOAD_ERR_OK) {
    respond(false, ['message' => 'Upload thất bại. Chỉ nhận JPG, JPEG, PNG tối đa 2 MB.'], 400);
}
if (!is_uploaded_file($file['tmp_name']) || filesize($file['tmp_name']) > 2 * 1024 * 1024) {
    respond(false, ['message' => 'Ảnh phải có dung lượng tối đa 2 MB'], 400);
}

$mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
$extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png'];
$image = @getimagesize($file['tmp_name']);
if (!isset($extensions[$mime]) || !$image || $image['mime'] !== $mime) {
    respond(false, ['message' => 'File phải là ảnh JPG, JPEG hoặc PNG thực tế'], 400);
}

$destination = null;
try {
    $db = database();
    $db->beginTransaction();
    $stmt = $db->prepare('SELECT id FROM products WHERE id = ? FOR UPDATE');
    $stmt->execute([$id]);
    if (!$stmt->fetch()) {
        $db->rollBack();
        respond(false, ['message' => 'Không tìm thấy sản phẩm'], 404);
    }
    $directory = __DIR__ . '/../uploads';
    if (!is_dir($directory) && !mkdir($directory, 0775, true)) {
        throw new RuntimeException('Không tạo được thư mục uploads');
    }
    $path = 'uploads/' . bin2hex(random_bytes(16)) . '.' . $extensions[$mime];
    $destination = __DIR__ . '/../' . $path;
    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new RuntimeException('Không lưu được ảnh');
    }
    $stmt = $db->prepare('UPDATE products SET image = ? WHERE id = ?');
    $stmt->execute([$path, $id]);
    $db->commit();
    respond(true, ['message' => 'Upload ảnh thành công', 'image' => $path]);
} catch (Throwable $e) {
    if (isset($db) && $db->inTransaction()) $db->rollBack();
    if ($destination && is_file($destination)) unlink($destination);
    respond(false, ['message' => 'Không lưu được ảnh. Kiểm tra database và quyền ghi thư mục uploads, rồi thử lại.'], 500);
}
