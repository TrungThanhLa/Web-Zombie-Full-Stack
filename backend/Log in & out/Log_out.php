<?php
session_start();
unset($_SESSION['username']);
setcookie('username', '', time() - 1);
$_SESSION['success'] = 'Đăng xuất thành công';
header('Location: Log_in.php');
exit();


?>