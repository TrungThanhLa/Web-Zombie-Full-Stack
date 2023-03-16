<?php
session_start();
require_once '../../backend/connection.php';

if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
    $id = $_GET['id'];
    $sql_select_user = "SELECT * FROM user_customer WHERE id = $id";
    $result_user = mysqli_query($connection, $sql_select_user);
    $user = mysqli_fetch_assoc($result_user);
    echo '<pre>';
    print_r($user);
    echo '</pre>';
}

$sql_select_all = "SELECT * FROM user_customer";
$result_all = mysqli_query($connection, $sql_select_all);
$user = mysqli_fetch_all($result_all, MYSQLI_ASSOC);
echo '<pre>';
print_r($user);
echo '</pre>';

foreach ($user AS $key => $value) {}

echo '<pre>';
print_r($_POST);
echo '</pre>';

$error = '';

    if (isset($_POST['submit'])) {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $gender = $_POST['gender'];

        if (empty($full_name) || empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
            $error = 'Hãy nhập đầy đủ thông tin';
        } elseif ($username == $value['username']) {
            $error = 'Username đã tồn tại';
        } elseif ($password != $confirm_password) {
            $error = 'Mật khẩu không trùng khớp';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Phải đúng định dạng email';
        }
        elseif ($email == $value['email']) {
            $error = 'E-mail đã được sử dụng';
        }
        elseif (!is_numeric($phone)) {
            $error = 'Số điện thoại không được có chữ hay ký tự';
        }
        elseif ($phone == $value['phone']) {
            $error = 'Số điện thoại đã tồn tại';
        }
        elseif (is_numeric($full_name)) {
            $error = 'Tên không được chứa số';
        }

        if (empty($error)) {
            $password_harsh = password_hash($password, PASSWORD_BCRYPT);
            if ($gender == 0) {
                $gender = 'Male';
            }
            else {
                $gender = 'Female';
            }
            $sql_insert = "INSERT INTO user_customer(full_name, username, password, email, phone, gender)
                            VALUES ('$full_name', '$username', '$password_harsh', '$email', '$phone', '$gender')";
            $is_insert = mysqli_query($connection, $sql_insert);
            var_dump($is_insert);
            if ($is_insert) {
                $_SESSION['success'] = 'Đăng ký thành công';
                header('Location: Login.php');
                exit();
            }
            else {
                $error = 'Đăng ký tài khoản thất bại, hãy kiểm tra lại thông tin bạn vừa nhập nhé !';
            }
        }
    }

?>

<title>Trang đăng kí</title>

<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="../../backend/assets/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="../../backend/assets/css/all.min.css">
<link rel="stylesheet" href="../../backend/assets/css/AdminLTE.min.css">
<link rel="stylesheet" href="../../backend/assets/css/style.css">

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
            <label for="username">Username<span style="color: red" title="Thông tin bắt buộc"> *</span></label>
            <input type="text" name="username" id="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email<span style="color: red" title="Thông tin bắt buộc"> *</span></label>
            <input type="text" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại<span style="color: red" title="Thông tin bắt buộc"> *</span></label>
            <input type="text" name="phone" id="phone" class="form-control">
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
        <p style="color: dimgray;">Quay trở lại trang đăng nhập <a href="Login.php">tại đây</a> !</p>
    </div>
</div>

<!-- Bootstrap 3.3.7 -->
<script src="../../backend/assets/js/bootstrap.min.js"></script>

