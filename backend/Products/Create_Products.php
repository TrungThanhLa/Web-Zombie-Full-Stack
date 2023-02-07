<?php
session_start();
require_once '../connection.php';

$select_cate = "SELECT * FROM category";
$result_cate = mysqli_query($connection, $select_cate);
$categories = mysqli_fetch_all($result_cate, MYSQLI_ASSOC);

echo '<pre>';
print_r($categories);
echo '</pre>';

echo '<pre>';
print_r($_POST);
print_r($_FILES);
echo '</pre>';

$error = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'];
    $product_des = $_POST['product_des'];
    $img = $_FILES['img'];
    $category = $_POST['category'];
    $status = $_POST['status'];
//    $img_product_1 = $_FILES['img_product_1'];
//    $img_product_2 = $_FILES['img_product_2'];
//    $img_product_3 = $_FILES['img_product_3'];

    if (empty($name) || empty($price)) {
        $error = 'Thông tin sản phẩm phải nhập đầy đủ';
    }
    elseif (empty($product_des)) {
        $error = 'Phải có thông tin chi tiết sản phẩm';
    }
    elseif ($img['error'] == 4) {
        $error = 'Phải có ảnh sản phẩm';
    }
    elseif ($sale_price >= $price) {
        $error = 'Giá sale phải nhỏ hơn giá cũ của sản phẩm';
    }
    elseif ($category == 0) {
        $error = 'Phải chọn danh mục sản phẩm';
    }
//    elseif ($img_product_1['error'] == 4 && $img_product_2['error'] == 4 && $img_product_3['error'] == 4)
//        $error = 'Phải có ít nhất 1 ảnh mô tả sản phẩm';
    foreach ($_FILES['img_product']['error'] AS $key1) {
        $img_error = $key1;
        if ($img_error == 4) {
            $error = 'Phải có ảnh mô tả sản phẩm';
        }
    }
    if ($img['error'] == 0) {
        $extensions = pathinfo($img['full_path'], PATHINFO_EXTENSION);
        $extensions = strtolower($extensions);
        $allows = ['jpg', 'jpeg', 'gif', 'png'];
        if (!in_array($extensions, $allows)) {
            $error = 'File tải lên phải là ảnh';
        }
    }

    $size_b = $img['size'];
    $size_mb = $size_b/1024/1024;
    if ($size_mb > 2) {
        $error = 'Ảnh tải lên phải nhỏ hơn 2MB';
    }

    if ($key1 == 0) {
        foreach ($_FILES['img_product']['full_path'] as $key2) {
            $full_path_img = $key2;
            $extensions = pathinfo($full_path_img, PATHINFO_EXTENSION);
            $extensions = strtolower($extensions);
            $allows = ['jpg', 'jpeg', 'gif', 'png'];
            if (!in_array($extensions, $allows)) {
                $error = 'File tải lên phải là ảnh';
            }
        }
    }

    foreach ($_FILES['img_product']['size'] AS $key3) {
        $img_size = $key3;
        $size_b = $key3;
        $size_mb = $size_b/1024/1024;
        if ($size_mb > 2) {
            $error = 'Ảnh mô tả tải lên phải nhỏ hơn 2MB';
        }
    }

    if (empty($error)) {
        $file_name_img = '';
        if ($img['error'] == 0) {
            $dir_upload = 'uploads';
            if (!file_exists($dir_upload)) {
                mkdir($dir_upload);
            }
            $file_name_img = $img['name'] . '-' . time() . '.' . $extensions;
            move_uploaded_file($img['tmp_name'], "$dir_upload/$file_name_img");
        }
        $sql_insert_img = "INSERT INTO products(name, price, sale_price, description, img, id_cat, status) VALUES ('$name', '$price', '$sale_price', '$product_des', '$file_name_img', '$category', '$status')";
        $is_insert_img = mysqli_query($connection, $sql_insert_img);
        var_dump($is_insert_img);

        $file_name_img_product = '';
        if ($key1 == 0) {
            $id_product = mysqli_insert_id($connection);
            foreach ($_FILES['img_product']['name'] AS $key4 => $value) {
                $dir_upload_product = 'img_product';
                if (!file_exists($dir_upload_product)) {
                    mkdir($dir_upload_product);
                }
                $file_name_img_product = $value . '-' . time() . '.' . $extensions;
                move_uploaded_file($_FILES['img_product']['tmp_name'][$key4], "$dir_upload_product/$file_name_img_product");
                $sql_insert_img_product = "INSERT INTO imgs_products (id_products ,imgs_des) VALUES ('$id_product','$file_name_img_product')";
                $is_insert_img_product = mysqli_query($connection, $sql_insert_img_product);
                var_dump($is_insert_img_product);
            }
        }
        if ($is_insert_img && $is_insert_img_product) {
            $_SESSION['success'] = 'Thêm mới sản phẩm thành công';
            header('Location: Products.php');
            exit();
        }
        else {
            $error = 'Thêm mới sản phẩm thất bại';
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
            <a href="Products.php"><i class="fas fa-tasks"></i> Quản lý sản phẩm</a>
            <br>
            <br>
            <p style="color: red"><?php echo $error; ?></p>
            <form action="" method="post" enctype="multipart/form-data">
                <h4>Danh mục sản phẩm</h4>
                <select name="category">
                    <option value="0">__Tên danh mục__</option>
                    <?php foreach ($categories AS $cate=> $value): ?>
                    <option value="<?php echo $value['id_cat']; ?>"><?php echo $value['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <br>
                <h4>Tên sản phẩm:</h4>
                <input type="text" name="name" placeholder="Tên sản phẩm...">
                <hr>
                <h4>Giá sản phẩm</h4>
                <input type="number" name="price">
                <hr>
                <h4>Giá sale</h4>
                <input type="number" name="sale_price">
                <hr>
                <h4>Mô tả sản phẩm:</h4>
                <textarea name="product_des" id="product_des"></textarea>
                <script>
                    CKEDITOR.replace ('product_des', {
                        filebrowserBrowseUrl: '../assets/ckfinder/ckfinder.html',
                        fileuploadBrowseUrl: '../assets/ckfinder/core/connector/php/vendor/connector.php'
                    });
                </script>
                <hr>
                <h4>Ảnh sản phẩm</h4>
                <input type="file" name="img">
                <hr>
                <h4>Ảnh mô tả</h4>
                <input type="file" name="img_product[]" multiple="multiple">
<!--                <h4>Ảnh mô tả 1</h4>-->
<!--                <input type="file" name="img_product_1">-->
<!--                <h4>Ảnh mô tả 2</h4>-->
<!--                <input type="file" name="img_product_2">-->
<!--                <h4>Ảnh mô tả 3</h4>-->
<!--                <input type="file" name="img_product_3">-->
                <hr>
                <p style="font-weight: bold">Trạng thái: </p>
                <input type="radio" name="status" value="1" checked="checked"> Hiện
                <input type="radio" name="status" value="0"> Ẩn
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