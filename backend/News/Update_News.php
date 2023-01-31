<?php
session_start();
require_once '../connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $error = 'ID bài viết không hợp lệ';
    header('Location: News.php');
    exit();
}
$id = $_GET['id'];

$select_one = "SELECT * FROM news WHERE id = $id";
$result_select_one = mysqli_query($connection, $select_one);
$new = mysqli_fetch_assoc($result_select_one);

//B1:
//echo '<pre>';
//print_r($_POST);
//print_r($_FILES);
//echo '</pre>';

//B2:
$error = '';

//B3: Check Submit form:
if (isset($_POST['submit'])) {
    //B4
    $title = $_POST['Title'];
    $meta_title = $_POST['metaTitle'];
    $description = $_POST['description'];
    $meta_des = $_POST['metaDes'];
    $post = $_POST['post'];
    $thumbnail = $_FILES['thumbnail'];
    //B5:
    if (empty($title) || empty($meta_title)) {
        $error = 'Tiêu đề không được để trống';
    }
    elseif (empty($description) || empty($meta_des)) {
        $error = 'Mô tả không được để trống';
    }
    elseif (empty($post)) {
        $error = 'Bài viết không được để trống';
    }
//    elseif ($thumbnail['error'] == 4) {
//        $error = 'Ảnh không được để trống';
//    }
    if ($thumbnail['error'] == 0) {
        $extensions = pathinfo($thumbnail['full_path'], PATHINFO_EXTENSION);
        $extensions = strtolower($extensions);
        $allow = ['jpg', 'jpeg', 'gif', 'png'];
        if (!in_array($extensions, $allow)) {
            $error = 'File tải lên phải là ảnh';
        }
    }
    $size_b = $thumbnail['size'];
    $size_mb = $size_b/1024/1024;
    if ($size_mb > 2) {
        $error = 'Dung lượng ảnh không được vượt quá 2MB';
    }
    //B6:
    if (empty($error)) {
        $file_name = $new['thumbnail'];
        if ($thumbnail['error'] == 0) {
            $dir_uploads = 'uploads';
            if (!file_exists($dir_uploads)) {
                mkdir($dir_uploads);
            }
            unlink("$dir_uploads/$file_name");
            $file_name = $thumbnail['name'] . time();
            move_uploaded_file($thumbnail['tmp_name'], "$dir_uploads/$file_name");
        }
        $sql_update = "UPDATE news SET title = '$title', metatitle = '$meta_title', description = '$description',
                metades = '$meta_des', posts = '$post', thumbnail = '$file_name' WHERE id = $id";
        $is_update = mysqli_query($connection, $sql_update);
        var_dump($is_update);
        if ($is_update) {
            $_SESSION['success'] = 'Cập nhật bài viết thành công';
            header('Location: News.php');
            exit();
        }
        else {
            $error = 'Đăng bài viết không thành công';
        }
    }

}

?>
<!-- News.html -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý tin tức</title>
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
    <script src="../assets/js/script.js"></script>
    <script src="https://cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index.html" class="logo">
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
            <div class="News">
                <a href="News.php"><i class="fas fa-tasks"></i> Quản lý tin tức</a>
                <br>
                <br>
                <p style="color: red"><?php echo $error; ?></p>
                <form action="" method="post" enctype="multipart/form-data">
                    <h4>Tiêu đề :</h4>
                    <input type="text" name="Title" value="<?php echo $new['title'];?>">
                    <hr>
                    <h4>Meta Title :</h4>
                    <input type="text" name="metaTitle" value="<?php echo $new['metatitle'];?>">
                    <hr>
                    <h4>Mô tả :</h4>
                    <textarea name="description"><?php echo $new['description'];?></textarea>
                    <hr>
                    <h4>Mô tả ngắn :</h4>
                    <textarea name="metaDes"><?php echo $new['metades'];?></textarea>
                    <hr>
                    <h4>Bài viết :</h4>
                    <textarea name="post" id="post"><?php echo $new['posts'];?></textarea>
                    <script>CKEDITOR.replace ('post',{
                            //đường dẫn đến file ckfinder.html của ckfinder
                            filebrowserBrowseUrl: '../assets/ckfinder/ckfinder.html',
                            //đường dẫn đến file connector.php của ckfinder
                            filebrowserUploadUrl: '../assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                        });</script>
                    <h4>Thumbnail :</h4>
                    <input type="file" name="thumbnail">
                    <br>
                    <img src="uploads/<?php echo $new['thumbnail']; ?>" height="100px" width="100px">
                    <br>
                    <br>
                    <input type="submit" name="submit" value="Đăng bài">
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