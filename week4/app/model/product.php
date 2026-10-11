<?php
require_once __DIR__ . '/../common/dbConnect.php';

// Lấy tất cả sản phẩm
function getAllProducts() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC");
    $stmt->execute();
    return $stmt->fetchAll();
}

// Lấy thông tin 1 sản phẩm theo ID
function getProductById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

// Thêm sản phẩm mới
function addProduct($name, $price, $quantity) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO products (name, price, quantity) VALUES (:name, :price, :quantity)");
    return $stmt->execute([
        ':name' => $name,
        ':price' => $price,
        ':quantity' => $quantity
    ]);
}

// Cập nhật sản phẩm
function updateProduct($id, $name, $price, $quantity) {
    global $conn;
    $stmt = $conn->prepare("UPDATE products SET name = :name, price = :price, quantity = :quantity WHERE id = :id");
    return $stmt->execute([
        ':id' => $id,
        ':name' => $name,
        ':price' => $price,
        ':quantity' => $quantity
    ]);
}

// Xóa sản phẩm
function deleteProduct($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}
?>