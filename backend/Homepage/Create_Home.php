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

$sql_select_homepage = "SELECT * FROM homepage ORDER BY created_at DESC";
$result_homepage = mysqli_query($connection, $sql_select_homepage);
$homepage = mysqli_fetch_assoc($result_homepage);
echo '<pre>';
print_r($homepage);
echo '</pre>';

$sql_select_sale_poster = "SELECT sale_poster FROM img_sale_poster ORDER BY created_at DESC LIMIT 3";
$result_poster = mysqli_query($connection, $sql_select_sale_poster);
$sale_poster = mysqli_fetch_all($result_poster, MYSQLI_ASSOC);
echo '<pre>';
print_r($sale_poster);
echo '</pre>';

$sql_select_sale_products = "SELECT sale_products FROM img_sale_products ORDER BY created_at DESC LIMIT 3";
$result_products = mysqli_query($connection, $sql_select_sale_products);
$sale_products = mysqli_fetch_all($result_products, MYSQLI_ASSOC);
echo '<pre>';
print_r($sale_products);
echo '</pre>';

//echo '<pre>';
//print_r($_POST);
//print_r($_FILES);
//echo '</pre>';

$error = '';

if (isset($_POST['submit'])) {

    $img_main = $_FILES['img_main'];
    $title = $_POST['title'];

    if ($img_main['error'] == 4) {
        $error = 'Phải có ảnh đầu trang';
    } elseif (empty($title)) {
        $error = 'Phải có tiêu đề sản phẩm mục cuối trang';
    }
    foreach ($_FILES['sale_img']['error'] as $key => $value) {
        if ($value == 4) {
            $error = 'Phải có đủ 3 ảnh Sale đầu trang';
        }
    }
    if ($value == 0) {
        foreach ($_FILES['sale_img']['full_path'] as $key1 => $value1) {
            $extensions = pathinfo($value1, PATHINFO_EXTENSION);
            $extensions = strtolower($extensions);
            $allows = ['jpg', 'jpeg', 'gif', 'png'];
            if (!in_array($extensions, $allows)) {
                $error = 'File tải lên 1 phải là ảnh';
            }
        }
    }
    foreach ($_FILES['sale_img']['size'] as $key2 => $value2) {
        $size_b = $value2;
        $size_mb = $value2 / 1024 / 1024;
        if ($size_mb > 2) {
            $error = 'Ảnh tải lên không được lớn hơn 2MB';
        }
    }

    foreach ($_FILES['sale_product']['error'] as $key3 => $value3) {
        if ($value3 == 4) {
            $error = 'Phải có đủ 3 ảnh sale sản phẩm cuối trang';
        }
    }

    if ($value3 == 0) {
        foreach ($_FILES['sale_img']['full_path'] as $key4 => $value4) {
            $extensions = pathinfo($value4, PATHINFO_EXTENSION);
            $extensions = strtolower($extensions);
            $allows = ['jpg', 'jpeg', 'gif', 'png'];
            if (!in_array($extensions, $allows)) {
                $error = 'File tải lên 2 phải là ảnh';
            }
        }
    }
    foreach ($_FILES['sale_img']['size'] as $key5 => $value5) {
        $size_b = $value5;
        $size_mb = $value5 / 1024 / 1024;
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
    $size_mb = $size_b / 1024 / 1024;
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
            foreach ($_FILES['sale_img']['name'] as $key6 => $value6) {
                $file_name_poster = $value6 . '.' . time() . '.' . $extensions;
                move_uploaded_file($_FILES['sale_img']['tmp_name'][$key6], "$dir_upload_1/$file_name_poster");
                $sql_insert_poster = "INSERT INTO img_sale_poster(sale_poster) VALUES ('$file_name_poster')";
                $is_insert_poster = mysqli_query($connection, $sql_insert_poster);
                var_dump($is_insert_poster);
            }
        }
        if ($value3 == 0) {
            $dir_upload_2 = 'sale_products';
            if (!file_exists($dir_upload_2)) {
                mkdir($dir_upload_2);
            }
            foreach ($_FILES['sale_product']['name'] as $key7 => $value7) {
                $file_name_products = $value7 . '.' . time() . '.' . $extensions;
                move_uploaded_file($_FILES['sale_product']['tmp_name'][$key7], "$dir_upload_2/$file_name_products");
                $sql_insert_products = "INSERT INTO img_sale_products(sale_products) VALUES ('$file_name_products')";
                $is_insert_products = mysqli_query($connection, $sql_insert_products);
                var_dump($is_insert_products);
            }
        }
        header('Location: Home.php?id=' . $user['id']);
        exit();
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
            <a href="Home.php?id=<?php echo $user['id']; ?>"><i class="fas fa-tasks"></i> Quản lý trang chủ</a>
            <br>
            <br>
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
            <form action="" method="post" enctype="multipart/form-data">
                <h4>Ảnh Chính :</h4>
                <input type="file" name="img_main">
                <br>
                <img src="main/<?php echo $homepage['main_img']; ?>" width="150px" height="150px">
                <br>
                <br>
                <h4>Ảnh Sale Đầu trang (3 ảnh) :</h4>
                <input type="file" name="sale_img[]" multiple="multiple">
                <br>
                <table border="2" cellpadding="8" cellspacing="0">
                    <tr>
                        <?php foreach ($sale_poster AS $key8 => $value8):?>
                        <td><img src="sale_poster/<?php echo $value8['sale_poster']; ?>" width="150px" height="150px"></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
                <br>
                <h4>Tiêu đề mục sản phẩm cuối trang</h4>
                <input type="text" name="title" value="<?php echo $homepage['title']; ?>">
                <br>
                <br>
                <h4>Ảnh Sale Sản phẩm cuối trang (3 ảnh) :</h4>
                <input type="file" name="sale_product[]"multiple="multiple">
                <br>
                <table border="2" cellpadding="8" cellspacing="0">
                    <tr>
                        <?php foreach ($sale_products AS $key9 => $value9):?>
                            <td><img src="sale_products/<?php echo $value9['sale_products']; ?>" width="150px" height="150px"></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
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

