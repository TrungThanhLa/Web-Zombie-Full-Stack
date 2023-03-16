<?php
session_start();
require_once '../../backend/connection.php';

$sql_select_all = "SELECT * FROM user_customer";
$result_all = mysqli_query($connection, $sql_select_all);
$user = mysqli_fetch_all($result_all, MYSQLI_ASSOC);
echo '<pre>';
print_r($user);
echo '</pre>';

foreach ($user AS $key => $value) {

if (isset($_SESSION['username'])) {
        $_SESSION['success'] = 'Bạn đã đăng nhập thành công';
        header('Location: ../Homepage.php?user_id=' . $value['id']);
        exit();
}

//echo '<pre>';
//print_r($_POST);
//echo '</pre>';

$error = '';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = 'Hãy nhập đầy đủ thông tin';
    }
    elseif ($username != $value['username']) {
        $error = 'Tài khoản không tồn tại';
    }
    if (empty($error)) {
        $password_harsh = $value['password'];
        $is_login = password_verify($password, $password_harsh);
        if ($is_login == true && $username = $value['username']) {
            if (isset($_POST['checkbox'])) {
                setcookie('username', $username, time() + 72000);
            }
            $_SESSION['username'] = $username;
            $_SESSION['success'] = 'Chúc mừng bạn đã đăng nhập thành công';
            header('Location: ../Homepage.php?user_id=' . $value['id']);
            exit();
     }
        else {
            $error = ' Sai tên tài khoản hoặc mật khẩu';
        }
    }
  }
}

?>

<title>Trang đăng nhập</title>

<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="../../backend/assets/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="../../backend/assets/css/all.min.css">
<link rel="stylesheet" href="../../backend/assets/css/AdminLTE.min.css">
<link rel="stylesheet" href="../../backend/assets/css/style.css">

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
            <label for="username">Username<span style="color: red" title="Thông tin bắt buộc"> *</span></label>
            <input type="text" name="username" id="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password<span style="color: red" title="Thông tin bắt buộc"> *</span></label>
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
<script src="../../backend/assets/js/bootstrap.min.js"></script>
