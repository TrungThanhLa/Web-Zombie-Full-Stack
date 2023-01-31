<?php
session_start();
require_once '../connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $error = 'ID bài viết không hợp lệ';
    header('Location: News.php');
    exit();
}
$id = $_GET['id'];
$sql_delete = "DELETE FROM news WHERE id = $id";
$is_delete = mysqli_query($connection, $sql_delete);
var_dump($is_delete);
if ($is_delete) {
    $_SESSION['success'] = 'Xóa bài viết thành công';
    header('Location: News.php');
    exit();
}
else {
    $_SESSION['error'] = 'Xóa bài viết không thành công';
    header('Location: News.php');
    exit();
}
