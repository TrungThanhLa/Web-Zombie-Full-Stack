<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = 'Hãy đăng nhập để truy cập';
    header('Location: ../Log in & out/Log_in.php');
    exit();
}

$sql_select_all = "SELECT * FROM category ORDER BY created_at DESC";
$result_select = mysqli_query($connection, $sql_select_all);
$categories = mysqli_fetch_all($result_select, MYSQLI_ASSOC);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = 'ID danh mục không hợp lệ';
    header('Location: Create_Category.php');
    exit();
}

$id = $_GET['id'];
if (isset($id)) {
    $sql_select = "SELECT * FROM category WHERE id_cat = $id";
    $result = mysqli_query($connection, $sql_select);
    $data = mysqli_fetch_assoc($result);
    if ($id != $data['id_cat']) {
        $_SESSION['error'] = 'Không tồn tại ID danh mục';
        header('Location: Create_Category.php');
        exit();
    }
}

echo '<pre>';
print_r($_POST);
echo '</pre>';

$error = '';

if (isset($_POST['submit'])) {
    $category = $_POST['category'];
    $status = $_POST['status'];

    if (empty($category)) {
        $error = 'Cần phải có tên danh mục';
    }

    if (empty($error)) {
        $sql_update = "UPDATE category SET name = '$category', status = '$status' WHERE id_cat = $id";
        $is_update = mysqli_query($connection, $sql_update);
        var_dump($is_update);

        if ($is_update) {
            $_SESSION['success'] = 'Cập nhật danh mục sản phẩm thành công';
            header('Location: Create_Category.php');
            exit();
        }
        else {
            $_SESSION['error'] = 'Cập nhật danh mục sản phẩm thất bại';
        }
    }
}

?>
<!-- Create_Product.php -->
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
            <a href="../Products/Products.php"><i class="fas fa-tasks"></i> Quản lý sản phẩm</a>
            <br>
            <br>
            <a href="../Category/Create_Category.php"><i class="fas fa-plus-square"></i> Tạo danh mục sản phẩm</a>
            <p style="color: red"><?php echo $error; ?></p>
            <div class="add_category">
                <!--                <div class="row">-->
                <div class="add">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h3>Sửa danh mục sản phẩm</h3>
                        <hr>
                        <p style="font-weight: bold">Tên danh mục :</p>
                        <input type="text" name="category" value="<?php echo $data['name'];?>">
                        <br>
                        <br>
                        <p style="font-weight: bold">Trạng thái :</p>
                        <input type="radio" name="status" value="1" <?php
                        if ($data['status'] == 1) {
                            echo 'checked';
                        }
                        else {
                            echo '';
                        }
                        ?>
                        > Hiện
                        <input type="radio" name="status" value="0"<?php
                        if ($data['status'] == 0) {
                            echo 'checked';
                        }
                        else {
                            echo '';
                        }
                        ?>
                        > Ẩn
                        <br>
                        <br>
                        <input type="submit" name="submit" value="Cập nhật">
                </div>
                <div class="show">
                    <h3>Danh sách danh mục</h3>
                    <br>
                    <table border="1" cellpadding="8" cellspacing="0" style="width: 50%;">
                        <tr>
                            <th>STT</th>
                            <th>Tên danh mục</th>
                            <th>Trạng thái</th>
                        </tr>
                        <?php foreach ($categories AS $key => $value):?>
                            <tr>
                                <td><?php echo $key + 1;?></td>
                                <td><?php echo $value['name'];?></td>
                                <td><?php
                                    if ($value['status'] == 1) {
                                        echo 'Hiện';
                                    }
                                    else {
                                        echo 'Ẩn';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="Update_Category.php?id=<?php echo $value['id_cat']; ?>"><i class="fas fa-edit"></i> Sửa</a>
                                    <a href="Delete_Category.php?id=<?php echo $value['id_cat']; ?>" onclick="return confirm('Xóa danh mục này ?')"><i class="fas fa-trash-alt" style="color: red"></i> Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </table>
                </div>
                <!--                </div>-->

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
