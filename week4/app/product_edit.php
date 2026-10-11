<?php
require_once 'model/product.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = getProductById($id);

if (!$product) {
    require_once 'view/header.php';
    echo "<p class='error'>Sản phẩm không tồn tại!</p>";
    echo "<p><a href='product_list.php' class='btn'>Quay lại danh sách</a></p>";
    require_once 'view/footer.php';
    exit();
}

$errors = [];
$name = $product['name'];
$price = $product['price'];
$quantity = $product['quantity'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = $_POST['price'] ?? '';
    $quantity = $_POST['quantity'] ?? '';

    // Kiểm tra dữ liệu đầu vào[cite: 2, 3]
    if ($name === '') {
        $errors[] = "Tên sản phẩm không được để rỗng.";
    }

    if ($price === '' || !is_numeric($price) || floatval($price) <= 0) {
        $errors[] = "Giá sản phẩm phải lớn hơn 0.";
    }

    if ($quantity === '' || !is_numeric($quantity) || intval($quantity) < 0) {
        $errors[] = "Số lượng phải là số nguyên lớn hơn hoặc bằng 0.";
    }

    if (empty($errors)) {
        updateProduct($id, $name, floatval($price), intval($quantity));
        header("Location: product_list.php");
        exit();
    }
}

require_once 'view/header.php';
?>

<h3>Chỉnh sửa sản phẩm</h3>

<?php if (!empty($errors)): ?>
    <div class="error">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="">
    <div>
        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>">
    </div>
    <div>
        <label for="price">Giá sản phẩm:</label>
        <input type="number" step="0.01" id="price" name="price" value="<?= htmlspecialchars($price) ?>">
    </div>
    <div>
        <label for="quantity">Số lượng:</label>
        <input type="number" id="quantity" name="quantity" value="<?= htmlspecialchars($quantity) ?>">
    </div>
    <div>
        <button type="submit" class="btn">Cập nhật</button>
        <a href="product_list.php" class="btn btn-warning">Hủy</a>
    </div>
</form>

<?php require_once 'view/footer.php'; ?>