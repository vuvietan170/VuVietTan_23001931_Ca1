<?php
// kiểm tra Php đã được khởi tạo chưa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header-bar { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 20px; }
        .error { color: red; margin-bottom: 10px; }
        .success { color: green; margin-bottom: 10px; }
        .form-group { margin-bottom: 10px; }
        label { display: inline-block; width: 120px; }
    </style>
</head>
<body>
<div class="header-bar">
    <h2>Hệ Thống Quản Lý Sản Phẩm</h2>
    <div>
        <!-- kiểm tra ngươi dùng đăng nhập chưa -->
        <?php if (isset($_SESSION['username'])): ?>
            <!-- htmlspecialchars giúp hiển thị tên an toàn tránh chèn mã HTML JS độc hại -->
            Xin chào, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong> | 
            <a href="logout.php">Đăng xuất</a>
        <?php else: ?>
            <a href="login.php">Đăng nhập</a> | 
            <a href="register.php">Đăng ký</a>
        <?php endif; ?>
    </div>
</div>