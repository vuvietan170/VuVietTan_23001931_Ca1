<?php
    $host = 'localhost';
    $dbname = 'shopping_cart';
    $username = 'root';
    $password = '';

    try {
        // ket noi toi mysql
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);
        // trả về ngoại lệ nếu lỗi 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // quy định cách lấy kiêu dữ liệu trong database
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        die("Kết nối với database thất bại: " . $e->getMessage());
    }
?>