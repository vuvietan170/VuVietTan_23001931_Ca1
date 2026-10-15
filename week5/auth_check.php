<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Kiểm tra, nếu chưa đăng nhập thì chuyển đến trang login, exit() để chương trình không chạy tiếp phần nội dung cần đăng nhập
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>