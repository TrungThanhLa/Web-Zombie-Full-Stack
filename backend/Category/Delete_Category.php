<?php
session_start();
require_once '../connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = 'ID danh mục không hợp lệ';
    header('Location: Create_Category.php');
    exit();
}

$id = $_GET['id'];
$sql_delete = "DELETE FROM category WHERE id_cat = $id";
$is_delete = mysqli_query($connection, $sql_delete);

if ($is_delete) {
    $_SESSION['success'] = 'Xóa danh mục thành công';
    header('Location: Create_Category.php');
    exit();
}
else {
    $_SESSION['error'] = 'Xóa danh mục không thành công';
    header('Location: Create_Category.php');
    exit();
}

?>
