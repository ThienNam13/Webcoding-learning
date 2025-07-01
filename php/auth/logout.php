<?php
session_start();
session_unset();   // xoá toàn bộ biến session
session_destroy(); // huỷ session

header('Location: ../../index.php');   // về trang chủ
exit;
