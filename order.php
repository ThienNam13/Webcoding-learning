<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đặt hàng thành công</title>
  <link rel="stylesheet" href="assets/css/order.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
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
</body>
</html>
