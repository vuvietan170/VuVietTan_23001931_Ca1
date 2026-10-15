<?php
session_start();
require_once 'app/common/dbConnect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = 'Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu!';
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: product_list.php");
            exit();
        } else {
            $error = 'Tên đăng nhập hoặc mật khẩu không chính xác!';
        }
    }
}

include 'app/view/header.php';
?>

<h3>Đăng nhập</h3>

<?php if ($error): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="login.php">
    <div class="form-group">
        <label>Tên đăng nhập:</label>
        <input type="text" name="username" required>
    </div>
    <div class="form-group">
        <label>Mật khẩu:</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Đăng nhập</button>
</form>

<p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>

<?php include 'app/view/footer.php'; ?>