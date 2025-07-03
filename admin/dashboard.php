<?php
session_start();

// // Kiểm tra quyền admin
// if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
//   header("Location: login.php");
//   exit;
// }

$adminName = $_SESSION['fullname'] ?? 'Admin'; //tên và role
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Dashboard quản trị | KFJoli</title>
  <link rel="stylesheet" href="assets/css/dashboard.css">
  <link rel="stylesheet" href="../assets/themify-icons-font/themify-icons/themify-icons.css">
</head>
<body>

  <div class="dashboard-header">
    <h1>📊 Chào mừng, <?= htmlspecialchars($adminName) ?>!</h1>
    <a href="logout.php" class="logout-btn">Đăng xuất</a>
  </div>

  <div class="dashboard-content">
    <div class="dashboard-card">
      <h3>🍔 Quản lý món ăn</h3>
      <p>Thêm, sửa, xoá món ăn.</p>
      <a href="foods.php">Truy cập</a>
    </div>

    <div class="dashboard-card">
      <h3>📦 Quản lý đơn hàng</h3>
      <p>Xem và xử lý đơn đã đặt.</p>
      <a href="orders.php">Truy cập</a>
    </div>

    <div class="dashboard-card">
      <h3>👥 Quản lý người dùng</h3>
      <p>Xem danh sách người dùng và phân quyền.</p>
      <a href="users.php">Truy cập</a>
    </div>

    <div class="dashboard-card">
      <h3>📈 Thống kê doanh thu</h3>
      <p>Xem tổng đơn, tổng doanh thu,...</p>
      <a href="stats.php">Truy cập</a>
    </div>
  </div>

</body>
</html>
