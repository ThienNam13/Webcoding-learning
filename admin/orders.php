<?php require_once 'auth_check.php'; ?>

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
  <link rel="stylesheet" href="../assets/css/orders.css">
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
