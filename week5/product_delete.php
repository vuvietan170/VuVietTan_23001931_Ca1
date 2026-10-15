<?php
require_once 'auth_check.php';
require_once 'app/model/product.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $product = getProductById($id);
    if ($product) {
        deleteProduct($id);
        header("Location: product_list.php");
        exit();
    } else {
        include 'app/view/header.php';
        echo "<div class='error'>Sản phẩm không tồn tại hoặc đã bị xóa!</div>";
        echo "<p><a href='product_list.php'>Quay lại danh sách sản phẩm</a></p>";
        include 'app/view/footer.php';
        exit();
    }
} else {
    header("Location: product_list.php");
    exit();
}
?>