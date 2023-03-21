<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = 'Hãy đăng nhập để truy cập';
    header('Location: ../Log in & out/Log_in.php');
    exit();
}

$id = $_GET['id'];

$sql_select_one= "SELECT * FROM user_admin WHERE id = $id";
$result_one = mysqli_query($connection, $sql_select_one);
$user = mysqli_fetch_assoc($result_one);
echo '<pre>';
print_r($user);
echo '</pre>';

$sql_select_all = "SELECT * FROM user_admin WHERE id != $id";
$result_all = mysqli_query($connection, $sql_select_all);
$users = mysqli_fetch_all($result_all);
echo '<pre>';
print_r($users);
echo '</pre>';

echo '<pre>';
print_r($_POST);
print_r($_FILES);
echo '</pre>';

$error = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $avatar = $_FILES['avatar'];
    foreach ($users AS $key => $value) {

        if (empty($username) || empty($email)) {
            $error = 'Vui lòng điền đầy đủ thông tin';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Vui lòng điền đúng định dạng email';
        } elseif (is_numeric($name)) {
            $error = 'Tên không được chứa số, vui lòng điền đầy đủ họ tên';
        } elseif (empty($full_name)) {
            $error = 'Vui lòng nhập đầy đủ họ và tên';
        }
        if ($email == $value[5]) {
            $error = 'Email đã tồn tại';
        }
        if ($avatar['error'] == 0) {
            $extensions = pathinfo($avatar['full_path'], PATHINFO_EXTENSION);
            $extensions = strtolower($extensions);
            $allows = ['jpg', 'jpeg', 'png'];
            if (!in_array($extensions, $allows)) {
                $error = 'File tải lên phải là ảnh';
            }
        }
        $size_b = $avatar['size'];
        $size_mb = $size_b / 1024 / 1024;
        if ($size_mb > 2) {
            $error = 'Ảnh tải lên không được vượt 2MB';
        }
    }

    if (empty($error)) {
        if ($avatar['error'] == 0) {
            $file_name = $user['avatar'];
            $dir_uploads = 'admin_avatar';
            if (!file_exists($dir_uploads)) {
                mkdir($dir_uploads);
            }
            unlink("$dir_uploads/$file_name");
            $file_name = $avatar['name'] . '-' . time() . '.' . $extensions;
            move_uploaded_file($avatar['tmp_name'], "$dir_uploads/$file_name");
            $sql_update_avatar = "UPDATE user_admin SET avatar = '$file_name' WHERE id = $id";
            $is_update_avatar = mysqli_query($connection, $sql_update_avatar);
        }
        if ($email != $user['email']) {
            $sql_update_email = "UPDATE user_admin SET email = '$email' WHERE id = $id";
            $is_update_email = mysqli_query($connection, $sql_update_email);
        }
        $sql_update = "UPDATE user_admin SET name = '$name', full_name = '$full_name' WHERE id = $id";
        $is_update = mysqli_query($connection, $sql_update);
        var_dump($is_update);
        if ($is_update) {
            $_SESSION['success'] = 'Cập nhật thông tin thành công';
            header('Location: Profile.php?id=' .  $user['id']) ;
            exit();
        }
        else {
            $error = 'Cập nhật thất bại';
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý sản phẩm</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../assets/css/_all-skins.min.css">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="https://cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>Y2C</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Youg 2T Clothing</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <i class="fa fa-bars"></i>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php if ($user['avatar'] == '') {
                                echo '<img src="../assets/images/admin-user-icon-4.jpg" class="user-image" alt="User Image" height="160px" width="160px">';
                            }
                            else {
                                ?>
                                <img src="../Users/admin_avatar/<?php echo $user['avatar']; ?>" class="user-image" alt="User Image" height="160px" width="160px">
                            <?php } ?>
                            <span class="hidden-xs"><?php echo $user['full_name']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <?php if ($user['avatar'] == '') {
                                    echo '<img src="../assets/images/admin-user-icon-4.jpg" class="img-circle" alt="User Image" height="160px" width="160px">';
                                }
                                else {
                                    ?>
                                    <img src="../Users/admin_avatar/<?php echo $user['avatar']; ?>" class="img-circle" alt="User Image" height="160px" width="160px">
                                <?php } ?>

                                <p>
                                    <?php echo $user['name'];?>
                                    <small>Quản trị viên</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="../Users/Profile.php?id=<?php echo $user['id']; ?>" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="../Log in & out/Log_out.php" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <?php if ($user['avatar'] == '') {
                        echo '<img src="../assets/images/admin-user-icon-4.jpg" class="img-circle" alt="User Image" height="160px" width="160px">';
                    }
                    else {
                        ?>
                        <img src="../Users/admin_avatar/<?php echo $user['avatar']; ?>" class="img-circle" alt="User Image" height="160px" width="160px">
                    <?php } ?>
                </div>
                <div class="pull-left info">
                    <p><?php echo $user['full_name']; ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">THANH QUẢN TRỊ</li>
                <li>
                    <a href="../Homepage/Home.php?id=<?php echo $user['id']; ?>">
                        <i class="fas fa-h-square"></i> <span>Quản lý trang chủ</span>
                        <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                    </a>
                </li>
                <li>
                    <a href="../News/News.php?id=<?php echo $user['id']; ?>">
                        <i class="fa fa-th"></i> <span>Tin tức</span>
                        <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                    </a>
                </li>
                <li>
                    <a href="../Products/Products.php?id=<?php echo $user['id']; ?>">
                        <i class="fas fa-boxes"></i> <span> Sản phẩm</span>
                        <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                    </a>
                </li>
                <li>
                    <a href="../Order/Order.php?id=<?php echo $user['id']; ?>">
                        <i class="fas fa-dolly-flatbed"></i> <span>Đơn hàng</span>
                        <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                    </a>
                </li>
                <li>
                    <a href="../Users/Users.php?id=<?php echo $user['id']; ?>">
                        <i class="fa fa-code"></i> <span>Quản lý admin</span>
                        <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                    </a>
                </li>
                <li>
                    <a href="../Customer/Customer.php?id=<?php echo $user['id']; ?>">
                        <i class="fas fa-users"></i> <span>Quản lý users</span>
                        <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Breadcrumd Wrapper. Contains breadcrumb -->
    <div class="breadcrumb-wrap content-wrap content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            Nội dung hiển thị ở đây
            <br>
            <div class="form login" style="width: 30%;">
                <h2 style="font-weight: 600">Sửa thông tin người dùng</h2>
                <p style="color: red"><?php
                    if (isset($_SESSION['error'])) {
                        echo '<div class="alert alert-danger">';
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        echo '</div>';
                    }
                    ?>
                </p>
                <p style="color: green"><?php
                    if (isset($_SESSION['success'])) {
                        echo '<p class="alert alert-success">';
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        echo '</p>';
                    }
                    ?>
                </p>
                <br>
                <a href="Profile.php?id=<?php echo $user['id']; ?>"><i class="far fa-edit"></i>Quay lại Profile</a>
                <br>
                <br>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group" >
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo $user['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="full_name">Full name</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" value="<?php echo $user['full_name']; ?>">
                    </div>
                    <div class="form-group" >
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?php echo $user['username']; ?>" readonly>
                    </div>
                    <div class="form-group" >
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $user['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <?php if ($user['avatar'] == '') {
                            echo '<br>Chưa có Avatar';
                        } ?>
                        <?php if ($user['avatar'] != '') { ?>
                        <img src="admin_avatar/<?php echo $user['avatar']; ?>" width="100px" height="100px" style="margin-left: 20px; border-radius: 100px">
                        <?php } ?>
                        <br>
                        <br>
                        <input type="file" name="avatar" class="btn btn-success">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Cập nhật" class="btn btn-success">
                    </div>
                </form>
            </div>
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.13-pre
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
        reserved.
    </footer>
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../assets/js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../assets/js/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../assets/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.min.js"></script>
</body>
</html>
