<?php
require_once 'model/product.php';
require_once 'view/header.php';

$products = getAllProducts();
?>

<h3>Danh sách sản phẩm</h3>
<p><a href="product_add.php" class="btn">+ Thêm sản phẩm mới</a></p>

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
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['id']) ?></td>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><?= number_format($p['price'], 0, ',', '.') ?> VNĐ</td>
                    <td><?= htmlspecialchars($p['quantity']) ?></td>
                    <td>
                        <a href="product_edit.php?id=<?= $p['id'] ?>" class="btn btn-warning">Sửa</a>
                        <a href="product_delete.php?id=<?= $p['id'] ?>" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Chưa có sản phẩm nào.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once 'view/footer.php'; ?>