<?php
session_start();
require_once __DIR__ . '/../db.php';

$email = trim($_POST['email']?? '');
$password = $_POST['password']?? '';

if ($email === '' || $password === '') {
    header('Location: ../../login.php?msg=empty');
    exit;
}

$sql  = "SELECT id, fullname, password, blocked FROM users WHERE email = ? LIMIT 1";
$stmt = $link->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$user) {
    header('Location: ../../login.php?msg=fail');  // tài khoản không tồn tại
    exit;
}
if ($user['blocked']) {                            // bị chặn → thoát
    header('Location: ../../login.php?msg=blocked');
    exit;
}
if (!password_verify($password, $user['password'])) {
    header('Location: ../../login.php?msg=fail');  // sai mật khẩu
    exit;
}

// Thành công gọi
$_SESSION['user_id']  = $user['id'];
$_SESSION['email'] = $email;
$_SESSION['fullname'] = $user['fullname'];

// CHUYỂN VỀ login.php và bật cờ flag "loginok"
header('Location: ../../login.php?msg=loginok&popup=1');
exit;
