<?php
require_once '../php/db.php';
$sql = "SELECT * FROM orders";
$result = $link->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý Đơn Hàng | Admin</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f7f7f7;
      padding: 30px;
    }
    h1 {
      text-align: center;
      color: #e76f00;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
      margin-top: 30px;
    }
    th, td {
      padding: 12px 16px;
      border-bottom: 1px solid #ddd;
      text-align: center;
    }
    th {
      background: #e76f00;
      color: white;
    }
    form {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
    }
    select {
      padding: 5px;
    }
    button {
      background: #28a745;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background: #218838;
    }
  </style>
</head>
<body>

<h1>Quản lý Đơn Hàng</h1>

<table>
  <tr>
    <th>Mã Đơn</th>
    <th>Khách Hàng</th>
    <th>Thời Gian Đặt</th>
    <th>Tổng Tiền</th>
    <th>Trạng Thái</th>
    <th>Cập Nhật</th>
  </tr>
  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['ma_don']) ?></td>
      <td><?= htmlspecialchars($row['ho_ten']) ?></td>
      <td><?= $row['thoi_gian_dat'] ?></td>
      <td><?= number_format($row['tong_tien'], 0, ',', '.') ?>₫</td>
      <td>
        <form method="post">
          <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
          <select name="new_status">
            <?php
              $statuses = ['Đang xử lý', 'Đang giao', 'Hoàn thành', 'Đã hủy'];
              foreach ($statuses as $status) {
                $selected = ($row['trang_thai'] == $status) ? 'selected' : '';
                echo "<option value=\"$status\" $selected>$status</option>";
              }
            ?>
          </select>
          <button type="submit">Cập nhật</button>
        </form>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

</body>
</html>
