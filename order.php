<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đặt hàng thành công</title>
  <link rel="stylesheet" href="assets/css/order.css" />
  <link rel="stylesheet" href="./assets/themify-icons-font/themify-icons/themify-icons.css">
</head>
<body>
  <div id="app">

    <?php include("header.php"); ?>

    <!-- ORDER CONTENT -->
    <div class="order-container">
      <h2>Cảm ơn bạn đã đặt hàng</h2>

      <div class="order-info">
        <p><strong>Mã đơn hàng:</strong> #<span id="order-id">ORDER1234</span></p>
        <p><strong>Thời gian giao hàng dự kiến:</strong> 30 - 45 phút</p>
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
          <tbody id="order-table-body">
          </tbody>
        </table>
        <div class="total">
          Tổng cộng: <span id="total">0đ</span>
        </div>
      </div>

      <div class="buttons">
        <button class="btn" onclick="window.location.href='index.php'">
          Tiếp tục mua hàng
        </button>
        <button class="btn" onclick="window.location.href='history.php'">
          Xem lịch sử đơn hàng
        </button>
      </div>
    </div>

  </div>

  <?php include("footer.php"); ?>

  <script src="assets/js/order.js"></script>
  <!-- Popup cảnh báo lỗi -->
<div class="popup-overlay" id="popup-alert" style="display: none;">
  <div class="popup-box">
    <h3>Không thể tạo đơn hàng</h3>
    <p id="popup-message">Thông tin bạn nhập chưa đúng. Vui lòng kiểm tra lại!</p>
    <button class="popup-btn" onclick="closePopup()">Tôi hiểu rồi</button>
  </div>
</div>

<style>
.popup-overlay {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 999;
}

.popup-box {
  background: #fff;
  padding: 20px 30px;
  border-radius: 10px;
  text-align: center;
  max-width: 400px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  animation: fadeIn 0.3s ease-in-out;
}

.popup-box h3 {
  margin-bottom: 10px;
  color: #c0392b;
}

.popup-box p {
  margin-bottom: 20px;
  color: #333;
}

.popup-btn {
  background-color: #e74c3c;
  color: #fff;
  padding: 8px 18px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: bold;
}

.popup-btn:hover {
  background-color: #c0392b;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>

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
</script>
</body>
</html>
