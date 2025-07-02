<?php
  $pageTitle = "Thanh toán đơn hàng";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= $pageTitle ?></title>
  <link rel="stylesheet" href="assets/css/checkout.css" />
</head>
<body>

<div class="checkout-container">
  <h2>Thanh toán đơn hàng</h2>

  <form id="checkout-form" method="POST" action="php/order/create.php">
    <!-- Thông tin người nhận -->
    <div class="section">
      <div class="section-title">Thông tin người nhận</div>
      <div class="input-group">
        <label for="fullname">Họ và tên</label>
        <input type="text" id="fullname" name="fullname" required>
      </div>
      <div class="input-group">
        <label for="phone">Số điện thoại</label>
        <input type="tel" id="phone" name="phone" required>
      </div>
      <div class="input-group">
        <label for="address">Địa chỉ giao hàng</label>
        <input type="text" id="address" name="address" required>
      </div>
      <div class="input-group">
        <label for="ward">Phường / Xã</label>
        <input type="text" id="ward" name="ward" list="ward-list" required placeholder="Chọn phường gần Bình Thạnh (trong 10km)">
        <datalist id="ward-list">
          <option value="Phường Bình Thạnh">
          <option value="Phường Tân Sơn Nhất">
          <option value="Phường Cầu Kiệu">
          <option value="Phường An Nhơn">
          <option value="Phường Hạnh Thông">
          <option value="Phường Sài Gòn">
          <option value="Phường Minh Phụng">
          <option value="Phường Tân Sơn Hòa">
          <option value="Phường Phú Nhuận">
          <option value="Phường An Hội Đông">
        </datalist>
      </div>
      <div class="input-group">
        <label for="region">Khu vực giao</label>
        <select id="region" name="region" required>
          <option value="">-- Chọn khu vực --</option>
          <option value="TP Hồ Chí Minh">TP Hồ Chí Minh</option>
        </select>
      </div>
    </div>

    <!-- Ghi chú -->
    <div class="section">
      <div class="section-title">Ghi chú cho tài xế</div>
      <textarea name="note" rows="3" placeholder="VD: Giao trước 12h, gọi trước khi đến..."></textarea>
    </div>

    <!-- Chi tiết đơn hàng -->
    <div class="section">
      <div class="section-title">Chi tiết đơn hàng</div>
      <div class="order-items-container">
        <div class="order-item"><span>Phí giao hàng</span><span>15.000₫</span></div>
      </div>
      <div class="checkout-total"><span>Tổng cộng</span><span id="total-amount">...</span></div>
    </div>

    <!-- Phương thức thanh toán -->
    <div class="section">
      <div class="section-title">Phương thức thanh toán</div>
      <select name="payment_method" required>
        <option value="cod">Tiền mặt</option>
        <option value="bank">Chuyển khoản</option>
      </select>
    </div>

    <input type="hidden" name="cart_data" id="cart-data">
    <button type="submit" class="btn-submit">Đặt hàng</button>
  </form>
</div>

<!-- Popup cảnh báo -->
<div class="popup-overlay" id="popup-alert">
  <div class="popup-box">
    <h3>❌ Không hỗ trợ giao hàng</h3>
    <p>Chúng tôi chỉ giao hàng trong bán kính 10km quanh Phường Bình Thạnh.<br>Vui lòng chọn lại phường phù hợp.</p>
    <button onclick="closePopup()">Đóng</button>
  </div>
</div>

<script src="assets/js/checkout.js"></script>
</body>
</html>
