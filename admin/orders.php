<?php
require_once '../php/db.php';

// Xử lý cập nhật trạng thái nếu có submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['new_status'])) {
    $order_id = intval($_POST['order_id']);
    $new_status = trim($_POST['new_status']);

    $stmt = $link->prepare("UPDATE orders SET trang_thai = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $order_id);
    $stmt->execute();
    $stmt->close();
}

// Truy vấn đơn hàng mới nhất
$sql = "SELECT * FROM orders ORDER BY thoi_gian_dat DESC";
$result = $link->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý Đơn Hàng | Admin</title>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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
      <td><?= date("d/m/Y H:i", strtotime($row['thoi_gian_dat'])) ?></td>
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