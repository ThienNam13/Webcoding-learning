<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <title>Đăng ký tài khoản</title>
  <link rel="stylesheet" href="assets/css/form.css" />
</head>
<body>
  <div id="mainWrapper">
  
<?php
$map = [
  'invalid' => 'Thông tin không hợp lệ.',
  'exists'  => 'Email đã tồn tại.',
  'empty'   => 'Vui lòng nhập Email và Mật khẩu.',
  'fail'    => 'Email hoặc mật khẩu chưa đúng.',
  'welcome' => 'Đăng ký thành công!',
  'loginok' => 'Đăng nhập thành công!'
];
if (!empty($_GET['msg']) && isset($map[$_GET['msg']])) {
    echo '<p style="color:red;text-align:center;">'.$map[$_GET['msg']].'</p>';
}

if (!empty($_GET['msg']) && $_GET['msg'] === 'welcome') {
    echo '<script>window.addEventListener("DOMContentLoaded", function() {
        document.getElementById("popupText").innerText = "Đăng ký thành công!";
        document.getElementById("popupMessage").style.display = "block";
        setTimeout(function() {
            window.location.href = "login.php";
        }, 3000);
    });</script>';
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
          Đã có tài khoản? <a href="login.php">Đăng nhập</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Popup message -->
  <div id="popupMessage">
    <p id="popupText"></p>
    <button onclick="closePopup()">OK</button>
  </div>

  <script>
    function showPopup(message) {
      document.getElementById("popupText").innerText = message;
      document.getElementById("popupMessage").style.display = "block";
    }

    function closePopup() {
      document.getElementById("popupMessage").style.display = "none";
    }

    document.getElementById("registerForm").addEventListener("submit", function (e) {
      const fullname = document.getElementById("fullname").value.trim();
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirm_password").value;

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&^_-])[A-Za-z\d@$!%*#?&^_-]{6,}$/;

      if (fullname.length < 5) {
        e.preventDefault();
        showPopup("Vui lòng nhập đầy đủ họ và tên.");
        return;
      }

      if (!emailRegex.test(email)) {
        e.preventDefault();
        showPopup("Email không hợp lệ.");
        return;
      }

      if (!passwordRegex.test(password)) {
        e.preventDefault();
        showPopup("Mật khẩu phải từ 6 ký tự, chứa chữ, số và ký tự đặc biệt.");
        return;
      }

      if (password !== confirmPassword) {
        e.preventDefault();
        showPopup("Mật khẩu xác nhận không khớp.");
        return;
      }
    });
    window.addEventListener("message", function(event) {
      if (event.data === "register-success") {
        document.getElementById("popupText").innerText = "Đăng ký thành công!";
        document.getElementById("popupMessage").style.display = "block";

        const iframe = document.getElementById("authFrame");
        if (iframe) {
          iframe.src = "login.php";
        }
      }
    });

  </script>
</body>
</html>
