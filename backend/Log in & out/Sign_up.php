<?php
session_start();
require_once '../connection.php';

$sql_select_all = "SELECT * FROM user_admin";
$result_all = mysqli_query($connection, $sql_select_all);
$users = mysqli_fetch_all($result_all, MYSQLI_ASSOC);
//echo '<pre>';
//print_r($users);
//echo '</pre>';
foreach ($users AS $key => $value) {}

echo '<pre>';
print_r($_POST);
echo '</pre>';

$error = '';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $confirm_password = $_POST['confirm_password'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $full_name = $_POST['full_name'];

    if (empty($username) || empty($password) || empty($email)) {
        $error = 'Vui lòng điền đầy đủ thông tin';
    }
    elseif ($value['username'] == $username) {
        $error = 'Username đã tồn tại';
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Vui lòng điền đúng định dạng email';
    }
    elseif (empty($confirm_password)) {
        $error = 'Vui lòng xác nhận mật khẩu';
    }
    elseif ($confirm_password != $password) {
        $error = 'Mật khẩu không trùng khớp';
    }
    elseif ($value['email'] == $email) {
        $error = 'Email đã tồn tại';
    }
    elseif (is_numeric($name)) {
        $error = 'Tên không được chứa số, vui lòng điền đầy đủ họ tên';
    }
    elseif (empty($full_name)) {
        $error = 'Vui lòng nhập đầy đủ họ và tên';
    }

    if (empty($error)) {
        $password_harsh = password_hash($password, PASSWORD_BCRYPT);
        if ($gender == 0) {
            $gender = 'Male';
        }
        else {
            $gender = 'Female';
        }
        $sql_insert = "INSERT INTO user_admin (username, password, email, name, gender, full_name ) VALUES ('$username', '$password_harsh', '$email', '$name', '$gender', '$full_name')";
        $is_insert = mysqli_query($connection, $sql_insert);
        var_dump($is_insert);
        if ($is_insert) {
            $_SESSION['success'] = 'Đăng ký thành công, hãy đăng nhập tại đây';
            header('Location: Log_in.php');
            exit();
        }
    }
}

?>

<title>Đăng kí trang quản trị</title>

<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="../assets/css/all.min.css">
<link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
<link rel="stylesheet" href="../assets/css/style.css">

<div class="form login" style="width: 30%; margin: 0px auto; margin-top: 100px; ">
    <h2>Đăng ký</h2>
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
            <label for="full_name">Tên đầy đủ<span style="color: red" title="Thông tin bắt buộc"> *</span></label>
            <input type="text" name="full_name" id="full_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="username">Tên admin<span style="color: red" title="Thông tin bắt buộc"> *</span></label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="username">Username<span style="color: red" title="Thông tin bắt buộc"> *</span></label>
            <input type="text" name="username" id="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email<span style="color: red" title="Thông tin bắt buộc"> *</span></label>
            <input type="text" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password<span style="color: red" title="Thông tin bắt buộc"> *</span></label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control">
        </div>
        <div class="form-group">
            <label for="gender">Gender </label>
            <input type="radio" name="gender" id="gender" value="0" checked="checked"> Male
            <input type="radio" name="gender" id="gender" value="1"> Female
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Sign up" class="btn btn-success">
        </div>
    </form>
    <div class="register">
        <p style="color: dimgray;">Quay trở lại trang đăng nhập <a href="Log_in.php">tại đây</a> !</p>
    </div>
</div>

<!-- Bootstrap 3.3.7 -->
<script src="../assets/js/bootstrap.min.js"></script>

