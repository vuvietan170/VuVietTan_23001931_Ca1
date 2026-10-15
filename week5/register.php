<?php
session_start(); // bắt đầu phiên làm việc mới
require_once 'app/common/dbConnect.php';

$error = '';
$success = '';
// nếu server nhận request method là post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //lấy giá trị mà các biêu mẫu gửi lên. Nếu trường đó không được gửi hoặc không tồn lại nó sẽ thay bằng chuỗi rỗng
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = 'Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu!';
    } else {
        // tìm id theo theo username
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        // chạy câu truy vấn trên
        $stmt->execute([$username]);
        // lấy 1 dòng kết quả từ câu truy vấn, kiểm tra tên đăng nhập có tồn tại hay không
        if ($stmt->fetch()) {
            $error = 'Tên đăng nhập đã tồn tại trong database!';
        } else {
            // lưu mật khẩu dưới dang băm để lưu dữ liệu an toàn 
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // thêm user và mật khẩu vào bảng user 
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            // thực hiện câu lệnh insert trước đó 
            if ($stmt->execute([$username, $hashedPassword])) {
                $success = 'Đăng ký thành công! Đang chuyển hướng đến trang đăng nhập...';
                header("refresh:2;url=login.php");
            } else {
                $error = 'Có lỗi xảy ra, vui lòng thử lại!';
            }
        }
    }
}

include 'app/view/header.php';
?>

<h3>Đăng ký tài khoản</h3>

<?php if ($error): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<?php if ($success): ?>
    <div class="success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<form method="POST" action="register.php">
    <div class="form-group">
        <label>Tên đăng nhập:</label>
        <input type="text" name="username" required>
    </div>
    <div class="form-group">
        <label>Mật khẩu:</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Đăng ký</button>
</form>

<p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>

<?php include 'app/view/footer.php'; ?>