
<?php
  if (isset($_GET['error'])) echo "<script>alert('Sai tài khoản hoặc mật khẩu');</script>";
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <title>Đăng nhập</title>
  <link rel="stylesheet" href="assets/css/form.css" />
</head>
<body>
  
  <?php
$map = [
  'invalid' => 'Thông tin không hợp lệ.',
  'exists'  => 'Email đã tồn tại.',
  'empty'   => 'Vui lòng nhập Email và Mật khẩu.',
  'fail'    => 'Email hoặc mật khẩu chưa đúng.',
  'welcome' => 'Đăng ký thành công!',
  'loginok' => 'Đăng nhập thành công!'
];
//dùng
if (!empty($_GET['msg']) && isset($map[$_GET['msg']])) {
    echo '<p style="color:red;text-align:center;">'.$map[$_GET['msg']].'</p>';
}

if (isset($_GET['msg']) && $_GET['msg'] === 'loginok' && isset($_GET['popup'])) {
    echo '<script>
        window.parent.postMessage("login-success", window.location.origin);
    </script>';
}
?>

  <div class="form-container">
    <h2>Đăng nhập</h2>
    <form id="loginForm" method="POST" action="php/auth/login.php">
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Mật khẩu" required />
      <button type="submit">Đăng nhập</button>
      <div class="form-link">
        Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>
      </div>
    </form>
  </div>
</body>
</html>
