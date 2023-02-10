<?php
session_start();
require_once '../connection.php';

echo '<pre>';
print_r($_POST);
print_r($_FILES);
echo '</pre>';

$error = '';

if (isset($_POST['submit'])) {
    $img_main = $_FILES['img_main'];
    $title = $_POST['title'];
}
    if ($img_main['error'] == 4) {
        $error = 'Phải có ảnh đầu trang';
    }
    elseif (empty($title)) {
        $error = 'Phải có tiêu đề sản phẩm mục cuối trang';
    }
    foreach ($_FILES['sale_img']['error'] AS $key => $value) {
        if ($value == 4) {
            $error = 'Phải có đủ 3 ảnh Sale đầu trang';
        }
    }
    if ($value == 0) {
        foreach ($_FILES['sale_img']['full_path'] AS $key1 => $value1) {
            $extensions = pathinfo($value1, PATHINFO_EXTENSION);
            $extensions = strtolower($extensions);
            $allows = ['jpg' , 'jpeg', 'gif', 'png'];
            if (!in_array($extensions, $allows)) {
                $error = 'File tải lên 1 phải là ảnh';
            }
        }
    }
    foreach ($_FILES['sale_img']['size'] AS $key2 => $value2) {
        $size_b = $value2;
        $size_mb = $value2/1024/1024;
        if ($size_mb > 2) {
            $error = 'Ảnh tải lên không được lớn hơn 2MB';
        }
    }

    foreach ($_FILES['sale_product']['error'] AS $key3 => $value3) {
        if ($value3 == 4) {
            $error = 'Phải có đủ 3 ảnh sale sản phẩm cuối trang';
        }
    }

    if ($value3 == 0) {
        foreach ($_FILES['sale_img']['full_path'] AS $key4 => $value4) {
            $extensions = pathinfo($value4, PATHINFO_EXTENSION);
            $extensions = strtolower($extensions);
            $allows = ['jpg' , 'jpeg', 'gif', 'png'];
            if (!in_array($extensions, $allows)) {
                $error = 'File tải lên 2 phải là ảnh';
            }
        }
    }
    foreach ($_FILES['sale_img']['size'] AS $key5 => $value5) {
        $size_b = $value5;
        $size_mb = $value5/1024/1024;
        if ($size_mb > 2) {
            $error = 'Ảnh tải lên không được lớn hơn 2MB';
        }
    }

    if ($img_main['error'] == 0) {
        $extensions = pathinfo($img_main['full_path'], PATHINFO_EXTENSION);
        $extensions = strtolower($extensions);
        $allows = ['png', 'jpg', 'jpeg', 'png'];
        if (!in_array($extensions, $allows)) {
            $error = 'File tải lên 2 phải là ảnh';
        }
    }
    $size_b = $img_main['size'];
    $size_mb = $size_b/1024/1024;
    if ($size_mb > 2) {
        $error = 'Ảnh tải lên phải nhỏ hơn 2MB';
    }
    if (empty($error)) {
        $file_name = '';
        if ($img_main['error'] == 0) {
            $dir_upload = 'main';
            if (!file_exists($dir_upload)) {
                mkdir($dir_upload);
            }
            $file_name = $img_main['name'] . '-' . time() . '.' . $extensions;
            move_uploaded_file($img_main['tmp_name'], "$dir_upload/$file_name");
        }
        $sql_insert = "INSERT INTO homepage(main_img, title) VALUES ('$file_name', '$title')";
        $is_insert = mysqli_query($connection, $sql_insert);
        var_dump($is_insert);

        $file_name_poster = '';
        if ($value == 0) {
            $dir_upload_1 = 'sale_poster';
            if (!file_exists($dir_upload_1)) {
                mkdir($dir_upload_1);
            }
            foreach ($_FILES['sale_img']['name'] AS $key6 => $value6 ) {
                $file_name_poster = $value6 . '.' . time() . '.' . $extensions;
                move_uploaded_file($_FILES['sale_img']['tmp_name'][$key6], "$dir_upload_1/$file_name_poster");
                $sql_insert_poster = "INSERT INTO img_homepage(sale_poster) VALUES ('$file_name_poster')";
                $is_insert_poster = mysqli_query($connection, $sql_insert_poster);
                var_dump($is_insert_poster);
            }
        }
        if ($value3 == 0) {
            $dir_upload_2 = 'sale_products';
            if (!file_exists($dir_upload_2)) {
                mkdir($dir_upload_2);
            }
            foreach ($_FILES['sale_product']['name'] AS $key7 => $value7 ) {
                $file_name_products = $value7 . '.' . time() . '.' . $extensions;
                move_uploaded_file($_FILES['sale_product']['tmp_name'][$key7], "$dir_upload_2/$file_name_products");
                $sql_insert_products = "INSERT INTO img_homepage(sale_products) VALUES ('$file_name_products')";
                $is_insert_products = mysqli_query($connection, $sql_insert_products);
                var_dump($is_insert_products);
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
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
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
                            <img src="../assets/images/Admin Avatar.png" class="user-image" alt="User Image" height="160px" width="160px">
                            <span class="hidden-xs">Lã Nguyễn Trung Thành</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="../assets/images/Admin Avatar.png" class="img-circle" alt="User Image" height="160px" width="160px">

                                <p>
                                    Lã Thành - Web Developer
                                    <small>Quản trị viên</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
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
                    <img src="../assets/images/Admin Avatar.png" class="img-circle" alt="User Image" height="160px" width="160px">
                </div>
                <div class="pull-left info">
                    <p>Lã Nguyễn Trung Thành</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">THANH QUẢN TRỊ</li>
                <li>
                    <a href="../Homepage/Home.php">
                        <i class="fas fa-h-square"></i> <span>Quản lý trang chủ</span>
                        <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                    </a>
                </li>
                <li>
                    <a href="../News/News.php">
                        <i class="fa fa-th"></i> <span>Tin tức</span>
                        <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                    </a>
                </li>
                <li>
                    <a href="../Products/Products.php">
                        <i class="fas fa-boxes"></i> <span> Sản phẩm</span>
                        <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                    </a>
                </li>
                <li>
                    <a href="../Order/Order.php">
                        <i class="fas fa-dolly-flatbed"></i> <span>Đơn hàng</span>
                        <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                    </a>
                </li>
                <li>
                    <a href="../Users/Users.php">
                        <i class="fa fa-code"></i> <span>Quản lý user</span>
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

    <!-- Messaeg Wrapper. Contains messaege error and success -->
    <div class="message-wrap content-wrap content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="alert alert-danger">Lỗi validate</div>
            <p class="alert alert-success">Thành công</p>
        </section>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            Nội dung hiển thị ở đây
            <br>
            <br>
            <a href="Home.php"><i class="fas fa-tasks"></i> Quản lý trang chủ</a>
            <br>
            <br>
            <p style="color: red"><?php echo $error; ?></p>
            <form action="" method="post" enctype="multipart/form-data">
                <h4>Ảnh Chính :</h4>
                <input type="file" name="img_main">
                <br>
                <h4>Ảnh Sale Đầu trang (3 ảnh) :</h4>
                <input type="file" name="sale_img[]" multiple="multiple">
                <br>
                <h4>Tiêu đề mục sản phẩm cuối trang</h4>
                <input type="text" name="title">
                <br>
                <br>
                <h4>Ảnh Sale Sản phẩm cuối trang (3 ảnh) :</h4>
                <input type="file" name="sale_product[]"multiple="multiple">
                <br>
                <br>
                <input type="submit" name="submit" value="Đăng">

            </form>

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

