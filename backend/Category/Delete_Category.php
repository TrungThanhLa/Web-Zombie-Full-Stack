<?php
session_start();
require_once '../connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = 'ID danh mục không hợp lệ';
    header('Location: Create_Category.php');
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
$sql_delete = "DELETE FROM category WHERE id_cat = $id";
$is_delete = mysqli_query($connection, $sql_delete);

if ($is_delete) {
    $_SESSION['success'] = 'Xóa danh mục thành công';
    header('Location: Create_Category.php?id=' . $user['id']);
    exit();
}
else {
    $_SESSION['error'] = 'Xóa danh mục không thành công';
    header('Location: Create_Category.php?id=' . $user['id']);
    exit();
}

?>
