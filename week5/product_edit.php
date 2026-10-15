<?php
require_once 'auth_check.php';
require_once 'app/model/product.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: product_list.php");
    exit();
}

$product = getProductById($id);
if (!$product) {
    include 'app/view/header.php';
    echo "<div class='error'>Sản phẩm không tồn tại!</div>";
    echo "<p><a href='product_list.php'>Quay lại danh sách sản phẩm</a></p>";
    include 'app/view/footer.php';
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = filter_var($_POST['price'] ?? 0, FILTER_VALIDATE_FLOAT);
    $quantity = filter_var($_POST['quantity'] ?? -1, FILTER_VALIDATE_INT);

    if (empty($name)) {
        $error = 'Tên sản phẩm không được để rỗng!';
    } elseif ($price === false || $price <= 0) {
        $error = 'Giá sản phẩm phải lớn hơn 0!';
    } elseif ($quantity === false || $quantity < 0) {
        $error = 'Số lượng sản phẩm phải lớn hơn hoặc bằng 0!';
    } else {
        if (updateProduct($id, $name, $price, $quantity)) {
            header("Location: product_list.php");
            exit();
        } else {
            $error = 'Có lỗi xảy ra khi cập nhật sản phẩm!';
        }
    }
}

include 'app/view/header.php';
?>

<h3>Sửa thông tin sản phẩm</h3>

<?php if ($error): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="product_edit.php?id=<?= $id ?>">
    <div class="form-group">
        <label>Tên sản phẩm:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? $product['name']) ?>" required>
    </div>
    <div class="form-group">
        <label>Giá sản phẩm:</label>
        <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($_POST['price'] ?? $product['price']) ?>" required>
    </div>
    <div class="form-group">
        <label>Số lượng:</label>
        <input type="number" name="quantity" value="<?= htmlspecialchars($_POST['quantity'] ?? $product['quantity']) ?>" required>
    </div>
    <button type="submit">Cập nhật</button>
    <a href="product_list.php">Hủy</a>
</form>

<?php include 'app/view/footer.php'; ?>