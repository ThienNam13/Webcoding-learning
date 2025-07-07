<?php
require_once '../php/db.php';
require_once 'auth_check.php';

// ✅ Lấy ID đơn hàng từ URL
$order_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($order_id <= 0) {
    echo "ID đơn hàng không hợp lệ.";
    exit;
}

// ✅ Truy vấn thông tin đơn hàng
$stmtOrder = $link->prepare("SELECT * FROM orders WHERE id = ?");
$stmtOrder->bind_param("i", $order_id);
$stmtOrder->execute();
$orderResult = $stmtOrder->get_result();
$order = $orderResult->fetch_assoc();
$stmtOrder->close();

if (!$order) {
    echo "Không tìm thấy đơn hàng.";
    exit;
}

// ✅ Truy vấn chi tiết các món trong đơn
$stmtItems = $link->prepare("
    SELECT f.ten_mon, oi.so_luong, oi.don_gia, (oi.so_luong * oi.don_gia) AS thanh_tien
    FROM order_items oi
    JOIN foods f ON f.id = oi.food_id
    WHERE oi.order_id = ?
");
$stmtItems->bind_param("i", $order_id);
$stmtItems->execute();
$itemsResult = $stmtItems->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Chi tiết đơn hàng #<?= htmlspecialchars($order['ma_don']) ?></title>
  <link rel="stylesheet" href="assets/css/order_detail.css">
</head>
<body>

<h2>Chi tiết đơn hàng #<?= htmlspecialchars($order['ma_don']) ?></h2>

<table>
  <thead>
    <tr>
      <th>Tên món</th>
      <th>Số lượng</th>
      <th>Đơn giá (₫)</th>
      <th>Thành tiền (₫)</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $tong = 0;
    while ($row = $itemsResult->fetch_assoc()):
      $tong += $row['thanh_tien'];
    ?>
    <tr>
      <td><?= htmlspecialchars($row['ten_mon']) ?></td>
      <td><?= $row['so_luong'] ?></td>
      <td><?= number_format($row['don_gia'], 0, ',', '.') ?>₫</td>
      <td><?= number_format($row['thanh_tien'], 0, ',', '.') ?>₫</td>
    </tr>
    <?php endwhile; ?>
    <tr class="total">
      <td colspan="3"><strong>Tổng cộng</strong></td>
      <td><strong><?= number_format($tong, 0, ',', '.') ?>₫</strong></td>
    </tr>
  </tbody>
</table>

<div class="note">
  <p><strong>Họ tên:</strong> <?= htmlspecialchars($order['ho_ten']) ?></p>
  <p><strong>SĐT:</strong> <?= htmlspecialchars($order['sdt']) ?></p>
  <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['dia_chi']) ?>, <?= htmlspecialchars($order['khu_vuc']) ?></p>
  <p><strong>Thời gian đặt:</strong> <?= date("d/m/Y H:i", strtotime($order['thoi_gian_dat'])) ?></p>
  <p><strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($order['hinh_thuc_thanh_toan'] ?? 'Chưa chọn') ?></p>
  <p><strong>Ghi chú:</strong> <?= htmlspecialchars($order['ghi_chu'] ?? 'Không có') ?></p>
</div>

<br>
<a href="orders.php"><button>← Quay lại danh sách</button></a>

</body>
</html>
