<?php
// header.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($title) ? $title : "KFJoli"; ?></title>
  <link rel="stylesheet" href="./assets/css/style.css">
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
        <?php if (isset($page) && $page === 'menu'): ?>
            <form class="search">
                <input type="text" id="searchInput" class="search-box" placeholder="Nhập món ăn cần tìm ...">
                <button onclick="searchFood()">Tìm kiếm</button>
            </form>
            <div class="shopping-cart">
                <a href="cart.php"><i class="icon-cart ti-shopping-cart"></i></a>
            </div>
        <?php endif; ?>
    
        <div class="account">
            <i class="icon-user ti-user"></i>
            <button id="btnLogin"><b>Đăng nhập</b></button>
        </div>
    </div>
  </div>
  <div class="clear"></div>
  <div id="extra-nav">
    <div class="container-extra">
      <button><a href="#type-food"><b>Đặt hàng ngay</b></a></button>
      <div class="shopping-cart">
        <a href="cart.php"><i class="icon-cart ti-shopping-cart"></i></a>
      </div>
    </div>
  </div>
</div>
