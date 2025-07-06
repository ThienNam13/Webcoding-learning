<?php
session_start();

$map = [
  'invalid' => 'Thông tin không hợp lệ.',
  'exists'  => 'Email đã tồn tại.',
  'empty'   => 'Vui lòng nhập Email và Mật khẩu.',
  'fail'    => 'Email hoặc mật khẩu chưa đúng.',
  'blocked' => 'Tài khoản này đã bị khóa!',
  'welcome' => 'Đăng ký thành công!',
  'loginok' => 'Đăng nhập thành công!'
];

// Nếu đã login và popup=true → gửi message login-success
$SendLoginSuccess = isset($_SESSION['user_id']) && isset($_GET['popup']);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="assets/css/form.css" />
</head>
<body>

<?php
if (!empty($_GET['msg']) && isset($map[$_GET['msg']])) {
    echo '<p style="color:red;text-align:center;">'.$map[$_GET['msg']].'</p>';
}
?>

<?php if ($SendLoginSuccess): ?>
  <script>
    window.parent.postMessage("login-success", "*");
  </script>
<?php endif; ?>

<div class="form-container">
  <h2>Đăng nhập</h2>
  <form id="loginForm" method="POST" action="php/auth/login.php">
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Mật khẩu" required />
    <button type="submit">Đăng nhập</button>
    <div class="form-link">
      Chưa có tài khoản? 
      <a href="register.php" onclick="window.parent.postMessage('gotoRegister', '*')">Đăng ký ngay</a>
    </div>
  </form>
</div>

</body>
</html>
