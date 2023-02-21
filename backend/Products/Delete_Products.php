<?php
session_start();
require_once '../connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = 'ID sản phẩm không hợp lệ';
    header('Location: Products.php');
    exit();
}

$id_user = $_GET['id_user'];

$sql_select_one= "SELECT * FROM user_admin WHERE id = $id_user";
$result_one = mysqli_query($connection, $sql_select_one);
$user = mysqli_fetch_assoc($result_one);
echo '<pre>';
print_r($user);
echo '</pre>';

$id = $_GET['id'];
$sql_delete = "DELETE FROM products WHERE id = $id";
$is_delete = mysqli_query($connection, $sql_delete);

$sql_delete_img_pro = "DELETE FROM imgs_products WHERE id_products = $id";
$result_delete = mysqli_query($connection, $sql_delete_img_pro);

if ($is_delete) {
    $_SESSION['success'] = 'Xóa sản phẩm thành công';
    header('Location: Products.php?id=' . $user['id']);
    exit();
}
else {
    $_SESSION['error'] = 'Xóa sản phẩm thất bại';
    header('Location: Products.php?id=' . $user['id']);
    exit();
}


?>
