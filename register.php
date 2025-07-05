<?php
$map = [
  'invalid' => 'Thông tin không hợp lệ.',
  'exists'  => 'Email đã tồn tại.',
  'empty'   => 'Vui lòng nhập Email và Mật khẩu.',
  'fail'    => 'Email hoặc mật khẩu chưa đúng.',
  'blocked' => 'Tài khoản này đã bị khóa!',
  'welcome' => 'Đăng ký thành công!',
  'loginok' => 'Đăng nhập thành công!'
];
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

  if (!empty($_GET['msg']) && $_GET['msg'] === 'welcome') {
      echo '<script>window.parent.postMessage("register-success", "*");</script>';
  }
  ?>

  <div class="form-container">
    <h2>Đăng ký</h2>
    <form id="registerForm" method="POST" action="php/auth/register.php">
      <input type="text" id="fullname" name="fullname" placeholder="Họ và tên" required />
      <input type="email" id="email" name="email" placeholder="Email" required />
      <input type="password" id="password" name="password" placeholder="Mật khẩu" required />
      <input type="password" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu" required />
      <p style="color: #888; font-size: 13px; margin-bottom: 12px;">
        Lưu ý: Chúng tôi cam kết bảo mật thông tin của bạn.
      </p>
      <button type="submit">Tạo tài khoản</button>
      <div class="form-link">
        Đã có tài khoản? <a href="#" onclick="window.parent.postMessage('gotoLogin', '*')">Đăng nhập</a>
      </div>
    </form>
  </div>

</body>
</html>