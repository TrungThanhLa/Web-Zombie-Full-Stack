<?php
session_start();
require_once '../backend/connection.php';

if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
    $id = $_GET['user_id'];
    $sql_select_user = "SELECT * FROM user_customer WHERE id = $id";
    $result_user = mysqli_query($connection, $sql_select_user);
    $user = mysqli_fetch_assoc($result_user);
    echo '<pre>';
    print_r($user);
    echo '</pre>';
}

//session_destroy();
//die();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = 'Thêm vào giỏ hàng thất bại';
    header('Location: Products_Frontend.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_select_one = "SELECT * FROM products WHERE id = $id";
    $result_one = mysqli_query($connection, $sql_select_one);
}
else {
    header('Location: Products_Frontend.php');
    exit();
}
if ($result_one) {
    $product = mysqli_fetch_assoc($result_one);
}

$action = (isset($_GET['action'])) ? $_GET['action'] : 'add';

$quantity = (isset($_GET['quantity'])) ? $_GET['quantity'] : 1;

if ($quantity <= 0) {
    $quantity = 1;
}
//var_dump($action);
//echo '<pre>';
//print_r($product);
//echo '</pre>';
//echo '<br>';
//var_dump($_GET);
//die();

$item = [
    'id' => $product['id'],
    'name' => $product['name'],
    'img' => $product['img'],
    'price' => $product ['price'],
    'sale_price' => $product['sale_price'],
    'quantity' => $quantity
];
// Dùng mảng kết hợp để lấy thông tin mong muốn và add vào giỏ hàng
// Xử lý nếu bấm vào nút thêm vào giỏ hàng ở ngoài trang sản phẩm
if ($action == 'add') {
    // Xử lý nếu đã có sản phẩm trong giỏ hàng thì + 1 quantity
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] = $_SESSION['cart'][$id]['quantity'] + $quantity;
    }
    // Nếu chưa có thì thêm như bình thường
    else {
        $_SESSION['cart'][$id] = $item;
    }
}

if ($action == 'update') {
    $_SESSION['cart'][$id]['quantity'] = $quantity;
}

if ($action == 'delete') {
    unset($_SESSION['cart'][$id]);
}

if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
    header('Location: Cart.php?user_id=' . $user['id']);
    exit();
}
else {
    header('Location: Cart.php');
    exit();
}

?>