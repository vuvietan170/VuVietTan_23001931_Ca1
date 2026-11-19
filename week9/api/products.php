<?php
require __DIR__ . '/common.php';

try {
    $db = database();

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'GET') {
        $page = filter_var($_GET['page'] ?? 1, FILTER_VALIDATE_INT);
        $limit = filter_var($_GET['limit'] ?? 5, FILTER_VALIDATE_INT);
        if ($page === false || $page < 1 || $limit !== 5) {
            respond(false, ['message' => 'page phải là số nguyên dương và limit phải bằng 5'], 400);
        }
        $total = (int)$db->query('SELECT COUNT(*) FROM products')->fetchColumn();
        $totalPages = max(1, (int)ceil($total / $limit));
        $page = min($page, $totalPages);
        $stmt = $db->prepare('SELECT * FROM products ORDER BY id DESC LIMIT ? OFFSET ?');
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, ($page - 1) * $limit, PDO::PARAM_INT);
        $stmt->execute();
        respond(true, [
            'data' => $stmt->fetchAll(),
            'pagination' => ['page' => $page, 'limit' => $limit, 'total' => $total, 'total_pages' => $totalPages]
        ]);
    }

    if (!in_array($method, ['POST', 'PUT', 'DELETE'], true)) {
        respond(false, ['message' => 'Phương thức không được hỗ trợ'], 405);
    }

    if ($method !== 'POST') {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id || $id < 1) {
            respond(false, ['message' => 'ID không hợp lệ'], 400);
        }
    }

    if ($method === 'DELETE') {
        $stmt = $db->prepare('DELETE FROM products WHERE id = ?');
        $stmt->execute([$id]);
        if ($stmt->rowCount() === 0) {
            respond(false, ['message' => 'Không tìm thấy sản phẩm'], 404);
        }
        respond(true);
    }

    $data = json_decode(file_get_contents('php://input'), true);
    if (!is_array($data)) {
        respond(false, ['message' => 'JSON không hợp lệ'], 400);
    }

    $name = $data['name'] ?? null;
    $price = $data['price'] ?? null;
    $stock = $data['stock'] ?? null;

    if (!is_string($name)) {
        respond(false, ['message' => 'Tên sản phẩm không hợp lệ'], 400);
    }
    $name = trim($name);
    if (!preg_match('/^.{1,100}$/us', $name)) {
        respond(false, ['message' => 'Tên phải có từ 1 đến 100 ký tự'], 400);
    }
    if (!is_int($price) || $price <= 0 || $price > 2147483647) {
        respond(false, ['message' => 'Đơn giá phải là số nguyên lớn hơn 0'], 400);
    }
    if (!is_int($stock) || $stock < 0 || $stock > 2147483647) {
        respond(false, ['message' => 'Tồn kho phải là số nguyên không âm'], 400);
    }

    if ($method === 'POST') {
        $stmt = $db->prepare('INSERT INTO products (name, price, stock) VALUES (?, ?, ?)');
        $stmt->execute([$name, $price, $stock]);
        respond(true, ['id' => (int)$db->lastInsertId()], 201);
    }

    // Kiểm tra tồn tại trước khi sửa (kể cả khi giá trị mới giống giá trị cũ).
    $stmt = $db->prepare('SELECT id FROM products WHERE id = ?');
    $stmt->execute([$id]);
    if (!$stmt->fetch()) {
        respond(false, ['message' => 'Không tìm thấy sản phẩm'], 404);
    }

    $stmt = $db->prepare('UPDATE products SET name = ?, price = ?, stock = ? WHERE id = ?');
    $stmt->execute([$name, $price, $stock, $id]);
    respond(true);
} catch (PDOException $e) {
    respond(false, ['message' => 'Lỗi cơ sở dữ liệu'], 500);
}
