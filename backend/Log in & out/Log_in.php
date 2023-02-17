<?php
session_start();
require_once '../connection.php';

if (isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['success'] = 'Chào mừng bạn đến với trang quản trị';
    header('Location: ../Homepage/Home.php');
    exit();
}

if (isset($_SESSION['username'])) {
    $_SESSION['success'] = 'Chào mừng bạn đã quay trở lại trang quản trị';
    header('Location: ../Homepage/Home.php');
    exit();
}

$sql_select_all = "SELECT * FROM user_admin";
$result_all = mysqli_query($connection, $sql_select_all);
$users = mysqli_fetch_all($result_all, MYSQLI_ASSOC);
//echo '<pre>';
//print_r($users);
//echo '</pre>';
foreach ($users AS $key => $value) {

//$sql_select_one = "SELECT * FROM user_admin WHERE username = username";
//$result_one = mysqli_query($connection, $sql_select_one);
//$user = mysqli_fetch_assoc($result_one);
//echo '<pre>';
//print_r($user);
//echo '</pre>';

//echo '<pre>';
//print_r($_POST);
//echo '</pre>';

$error = '';

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            $error = 'Phải điền đầy đủ thông tin';
        }

        if (empty($error)) {
            if ($password == $value['password']) {
                if (isset($_POST['checkbox'])) {
                    setcookie('username', $username, time() + 72000);
                }

                $_SESSION['username'] = $username;
                $_SESSION['success'] = 'Đăng nhập thành công';
                header('Location: ../Homepage/Home.php');
                exit();
            } else {
                $error = 'Sai tài khoản hoặc mật khẩu';
            }
        }
    }
}

?>

<title>Đăng nhập trang quản trị</title>

<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="../assets/css/all.min.css">
<link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
<link rel="stylesheet" href="../assets/css/style.css">

<div class="form login" style="width: 30%; margin: 0px auto; margin-top: 100px; ">
<h2>Đăng nhập</h2>
<p style="color: red"><?php
    echo $error;
    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    ?>
</p>
<p style="color: green"><?php
    if (isset($_SESSION['success'])) {
        echo $_SESSION['success'];
        unset($_SESSION['success']);
    }
    ?>
</p>
<form action="" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <div class="form-group">
        <input type="checkbox" name="checkbox" id="checkbox">
        <label for="checkbox">Ghi nhớ đăng nhập</label>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Sign in" class="btn btn-success">
    </div>
</form>
    <div class="register">
        <p style="color: dimgray;">Bạn chưa có tài khoản ? Hãy <a href="Sign_up.php">Đăng kí</a> ngay tại đây nhé !</p>
    </div>
</div>

<!-- Bootstrap 3.3.7 -->
<script src="../assets/js/bootstrap.min.js"></script>
