<?php
session_start();
require_once("php/db.php");

$ma_don = $_GET['order_id'] ?? '';

if (!$ma_don) {
  header("Location: history.php");
  exit;
}

// Truy vấn đơn hàng
$stmt = $link->prepare("SELECT * FROM orders WHERE ma_don = ?");
$stmt->bind_param("s", $ma_don);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$order) {
  echo "Không tìm thấy đơn hàng.";
  exit;
}

// Truy vấn các món ăn trong đơn hàng
$stmt = $link->prepare("
  SELECT f.ten_mon, i.so_luong, i.don_gia 
  FROM order_items i
  JOIN foods f ON i.food_id = f.id
  WHERE i.order_id = ?
");
$stmt->bind_param("i", $order['id']);
$stmt->execute();
$items = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đặt hàng thành công</title>
  <link rel="stylesheet" href="assets/css/order.css" />
  <link rel="stylesheet" href="./assets/themify-icons-font/themify-icons/themify-icons.css">
  <?php include("header.php"); ?>
  <script src="assets/js/order.js"></script>
</head>
<body>
  <div id="app">
    <!-- ORDER CONTENT -->
    <div class="order-container">
      <h2>Cảm ơn bạn đã đặt hàng</h2>

      <div class="order-info">
        <p><strong>Mã đơn hàng:</strong> #<?= htmlspecialchars($order['ma_don']) ?></p>
        <p><strong>Thời gian giao hàng dự kiến:</strong> 30 - 45 phút</p>
        <p><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($order['thoi_gian_dat'])) ?></p>
      </div>

      <div class="order-details">
        <table>
          <thead>
            <tr>
              <th>Món ăn</th>
              <th>Số lượng</th>
              <th>Đơn giá</th>
              <th>Thành tiền</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $tong = 0;
            while ($item = $items->fetch_assoc()): 
              $thanh_tien = $item['so_luong'] * $item['don_gia'];
              $tong += $thanh_tien;
            ?>
            <tr>
              <td><?= htmlspecialchars($item['ten_mon']) ?></td>
              <td><?= $item['so_luong'] ?></td>
              <td><?= number_format($item['don_gia'], 0, ',', '.') ?>₫</td>
              <td><?= number_format($thanh_tien, 0, ',', '.') ?>₫</td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <div class="total">
          Tổng cộng: <span><?= number_format($tong, 0, ',', '.') ?>₫</span>
        </div>
      </div>

      <div class="buttons">
        <button class="btn" onclick="window.location.href='index.php'">Tiếp tục mua hàng</button>
        <button class="btn" onclick="window.location.href='history.php'">Xem lịch sử đơn hàng</button>
      </div>
    </div>
  </div>

  <?php include("footer.php"); ?>

  <!-- Popup cảnh báo lỗi -->
<div class="popup-overlay" id="popup-alert" style="display: none;">
  <div class="popup-box">
    <h3>Không thể tạo đơn hàng</h3>
    <p id="popup-message">Thông tin bạn nhập chưa đúng. Vui lòng kiểm tra lại!</p>
    <button class="popup-btn" onclick="closePopup()">Tôi hiểu rồi</button>
  </div>
</div>

<script>
function getParam(name) {
  const url = new URL(window.location.href);
  return url.searchParams.get(name);
}

function closePopup() {
  document.getElementById("popup-alert").style.display = "none";
}

// Hiển thị popup nếu có lỗi
const error = getParam("error");
if (error) {
  let message = "Thông tin bạn nhập chưa đúng. Vui lòng kiểm tra lại.";

  if (error === "thieu_thong_tin") {
    message = "Vui lòng nhập đầy đủ họ tên, số điện thoại, địa chỉ và khu vực giao hàng.";
  } else if (error === "cart_trong") {
    message = "Giỏ hàng đang trống hoặc không hợp lệ.";
  } else if (error === "dia_chi_sai") {
    message = "Địa chỉ chưa rõ ràng. Vui lòng nhập số nhà và tên đường.";
  }

  document.getElementById("popup-message").innerText = message;
  document.getElementById("popup-alert").style.display = "flex";
}
</body>
</html>
