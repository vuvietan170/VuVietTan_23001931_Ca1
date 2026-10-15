<?php
require_once 'auth_check.php';
require_once 'app/model/product.php';

$products = getAllProducts();

include 'app/view/header.php';
?>

<h3>Danh sách sản phẩm</h3>
<p><a href="product_add.php">+ Thêm sản phẩm mới</a></p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($products)): ?>
            <tr>
                <td colspan="5">Chưa có sản phẩm nào trong CSDL.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($products as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['id']) ?></td>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><?= number_format($p['price'], 2) ?> VNĐ</td>
                    <td><?= htmlspecialchars($p['quantity']) ?></td>
                    <td>
                        <a href="product_edit.php?id=<?= $p['id'] ?>">Sửa</a> | 
                        <a href="product_delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php include 'app/view/footer.php'; ?>