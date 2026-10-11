<?php
require_once 'model/product.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = getProductById($id);

// Hiển thị thông báo nếu sản phẩm không tồn tại[cite: 2]
if (!$product) {
    require_once 'view/header.php';
    echo "<p class='error'>Sản phẩm không tồn tại hoặc đã bị xóa trước đó!</p>";
    echo "<p><a href='product_list.php' class='btn'>Quay lại danh sách</a></p>";
    require_once 'view/footer.php';
    exit();
}

// Xác nhận xóa thành công[cite: 2]
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    deleteProduct($id);
    header("Location: product_list.php");
    exit();
}

require_once 'view/header.php';
?>

<h3>Xác nhận xóa sản phẩm</h3>
<p>Bạn có chắc chắn muốn xóa sản phẩm <strong><?= htmlspecialchars($product['name']) ?></strong> (ID: <?= $product['id'] ?>) không?</p>

<form method="POST" action="">
    <button type="submit" class="btn btn-danger">Đồng ý Xóa</button>
    <a href="product_list.php" class="btn">Hủy bỏ</a>
</form>

<?php require_once 'view/footer.php'; ?>