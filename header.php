<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($title) ? $title : "KFJoli"; ?></title>
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/menu.css">  <!-- style riêng của menu -->
  <link rel="stylesheet" href="./assets/themify-icons-font/themify-icons/themify-icons.css">
</head>
<body>
<div id="app">

<!-- HEADER -->
<div id="header">
  <div id="nav">
    <ul class="container-nav">
      <div class="logo-mini"><a href=""><img src="./assets/img/logo.png" alt=""></a></div>
      <li><a href="index.php">Trang chủ</a></li>
      <li><a href="menu.php">Thực đơn</a></li>
      <li><a href="history.php">Lịch sử đơn hàng</a></li>
    </ul>
    <div class="nav-right">
      <?php
              $loggedIn = !empty($_SESSION['fullname']);
            ?> 

      <div class="account">
        <i class="icon-user ti-user"></i>

        <?php if ($loggedIn): ?>
          <span class="welcome-text">
            Xin chào, <?= htmlspecialchars($_SESSION['fullname']) ?>
          </span>
          <button id="btnLogout" class="btn-account"><b>Đăng xuất</b></button>
        <?php else: ?>
          <button id="btnLogin" class="btn-account"><b>Đăng nhập</b></button>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div id="extra-nav">
    <div class="container-extra">
      <button><a href="#type-food"><b>Đặt hàng ngay</b></a></button>
      <div class="shopping-cart">
        <a href="cart.php"><i class="icon-cart ti-shopping-cart"></i></a>
      </div>
    </div>
  </div>
</div>

<!-- Popup đăng nhập / đăng ký (ẩn mặc định) -->
<div id="popupFrame" style="display:none">
  <div class="popup-box">
    <iframe id="authFrame" src="" style="width:420px;height:540px;border:none;border-radius:24px"></iframe>
    <button class="popup-close" onclick="
      document.getElementById('popupFrame').style.display='none';
      document.getElementById('authFrame').src='';
    ">&times;</button>
  </div>
</div>

<script src="assets/js/auth.js"></script>
<script src="./assets/js/search.js"></script>
<script>
/* Đăng xuất */
document.getElementById('btnLogout')?.addEventListener('click', () => {
  fetch('php/auth/logout.php')          // xoá session bên server
    .then(() => location.reload());     // reload để cập nhật header
});
</script>