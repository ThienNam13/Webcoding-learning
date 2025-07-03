<?php
session_start();
require_once("../db.php");

if (
  empty($_POST['fullname']) ||
  empty($_POST['phone']) ||
  empty($_POST['address']) ||
  empty($_POST['region']) ||
  empty($_POST['cart_data'])
) {
  die("Thiếu thông tin đơn hàng!");
}

$user_id = $_SESSION['user_id'] ?? null;
$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$region = $_POST['region'];
$note = $_POST['note'] ?? '';
$payment = $_POST['payment_method'] ?? 'cod';
$cart_json = $_POST['cart_data'];
$cart = json_decode($cart_json, true);

if (!is_array($cart) || count($cart) === 0) {
  die("Giỏ hàng không hợp lệ!");
}

// Tính tổng tiền
$shipping_fee = 15000;
$total = 0;

foreach ($cart as $item) {
  if (!isset($item['id'], $item['so_luong'], $item['gia'])) {
    continue;
  }
  $total += $item['gia'] * $item['so_luong'];
}
$total += $shipping_fee;

// Tạo đơn hàng trước (chưa có mã đơn)
$stmt = $link->prepare("INSERT INTO orders (user_id, ho_ten, sdt, dia_chi, khu_vuc, tong_tien, ghi_chu, hinh_thuc_thanh_toan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssdss",  $user_id, $fullname, $phone, $address, $region, $total, $note, $payment);
$stmt->execute();
$order_id = $stmt->insert_id;
$stmt->close();

// Tạo mã đơn và cập nhật lại
$ma_don = "ODF" . str_pad($order_id, 4, "0", STR_PAD_LEFT);
$update_stmt = $link->prepare("UPDATE orders SET ma_don = ? WHERE id = ?");
$update_stmt->bind_param("si", $ma_don, $order_id);
$update_stmt->execute();
$update_stmt->close();

// Thêm các món vào order_items
$stmt_item = $link->prepare("INSERT INTO order_items (order_id, food_id, so_luong, don_gia) VALUES (?, ?, ?, ?)");

foreach ($cart as $item) {
  if (!isset($item['id'], $item['so_luong'], $item['gia'])) {
    continue;
  }
  $food_id = $item['id'];
  $so_luong = $item['so_luong'];
  $don_gia = $item['gia'];
  $stmt_item->bind_param("iiid", $order_id, $food_id, $so_luong, $don_gia);
  $stmt_item->execute();
}
echo "<pre>";
print_r($cart);
echo "Order ID: $order_id\n";
echo "Insert thành công? " . ($stmt_item ? "YES" : "NO") . "\n";
echo "</pre>";
$stmt_item->close();
$link->close();

// Chuyển trang
header("Location: ../../order.php?order_id=$ma_don");
exit;
?>
