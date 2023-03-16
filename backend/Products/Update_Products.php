<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = 'Hãy đăng nhập để truy cập';
    header('Location: ../Log in & out/Log_in.php');
    exit();
}

$id_user = $_GET['id_user'];

$sql_select_one= "SELECT * FROM user_admin WHERE id = $id_user";
$result_one = mysqli_query($connection, $sql_select_one);
$user = mysqli_fetch_assoc($result_one);
echo '<pre>';
print_r($user);
echo '</pre>';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = 'ID sản phẩm không hợp lệ';
    header('Location: Products.php');
    exit();
}

$id = $_GET['id'];
$sql_select_one = "SELECT * FROM products WHERE id = $id";
$result_one = mysqli_query($connection, $sql_select_one);
$product = mysqli_fetch_assoc($result_one);

$sql_select_img_product = "SELECT * FROM imgs_products WHERE id_products = $id";
$result_img_product = mysqli_query($connection, $sql_select_img_product);
$img_product = mysqli_fetch_all($result_img_product, MYSQLI_ASSOC);

$sql_select_all = "SELECT products.*, category.name AS 'name_cate' FROM products JOIN category ON products.id_cat = category.id_cat WHERE id = $id ";
$result_all = mysqli_query($connection, $sql_select_all);
$products = mysqli_fetch_assoc($result_all);

$name_cate = $products['name_cate'];

$sql_select_cate = "SELECT * FROM category WHERE status = 1";
$result_cate = mysqli_query($connection, $sql_select_cate);
$categories = mysqli_fetch_all($result_cate, MYSQLI_ASSOC);


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
    $status = $_POST['status'];
    $category = $_POST['category'];
//    $img_product_1 = $_FILES['img_product_1'];
//    $img_product_2 = $_FILES['img_product_2'];
//    $img_product_3 = $_FILES['img_product_3'];

    if (empty($name) || empty($price)) {
        $error = 'Thông tin sản phẩm phải nhập đầy đủ';
    } elseif (empty($product_des)) {
        $error = 'Phải có thông tin chi tiết sản phẩm';
    }
    elseif ($sale_price >= $price) {
        $error = 'Giá sale phải nhỏ hơn giá cũ của sản phẩm';
    }
    elseif ($category == 0 ) {
        $error = 'Phải chọn danh mục cho sản phẩm';
    }
//    elseif ($img_product_1['error'] == 4 && $img_product_2['error'] == 4 && $img_product_3['error'] == 4)
//        $error = 'Phải có ít nhất 1 ảnh mô tả sản phẩm';
    foreach ($_FILES['img_product']['error'] as $key1)
//    {
//        $img_error = $key1;
//        if ($img_error == 4) {
//            $error = 'Phải có ảnh mô tả sản phẩm';
//        }
//    }
    if ($img['error'] == 0) {
        $extensions = pathinfo($img['full_path'], PATHINFO_EXTENSION);
        $extensions = strtolower($extensions);
        $allows = ['jpg', 'jpeg', 'gif', 'png'];
        if (!in_array($extensions, $allows)) {
            $error = 'File tải lên phải là ảnh';
        }
    }

    $size_b = $img['size'];
    $size_mb = $size_b / 1024 / 1024;
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

//    foreach ($_FILES['img_product']['size'] as $key3) {
//        $img_size = $key3;
//        $size_b = $key3;
//        $size_mb = $size_b / 1024 / 1024;
//        if ($size_mb > 2) {
//            $error = 'Ảnh mô tả tải lên phải nhỏ hơn 2MB';
//        }
//    }

    if (empty($error)) {
        $file_name_img = $product['img'];
        if ($img['error'] == 0) {
            $dir_upload = 'uploads';
            if (!file_exists($dir_upload)) {
                mkdir($dir_upload);
            }
            unlink("$dir_upload/$file_name_img");
            $file_name_img = $img['name'] . '-' . time() . '.' . $extensions;
            move_uploaded_file($img['tmp_name'], "$dir_upload/$file_name_img");
        }
        $sql_update_img = "UPDATE products SET name = '$name', id_cat = '$category', price = '$price', sale_price = '$sale_price'
                            , description = '$product_des', img = '$file_name_img', status = '$status' WHERE id = $id";
        $is_update_img = mysqli_query($connection, $sql_update_img);
        var_dump($is_update_img);

        $file_imgs = $_FILES['img_product'];
        $imgs = $file_imgs['name'];

        if (!empty($imgs[0])) {
            $sql_delete = "DELETE FROM imgs_products WHERE id_products = $id";
            $is_delete = mysqli_query($connection, $sql_delete);
            foreach ($_FILES['img_product']['name'] as $key4 => $value) {
                $dir_upload_product = 'img_product';
                if (!file_exists($dir_upload_product)) {
                    mkdir($dir_upload_product);
                }
                $file_name_img_product = $value . '-' . time() . '.' . $extensions;
                move_uploaded_file($_FILES['img_product']['tmp_name'][$key4], "$dir_upload_product/$file_name_img_product");
                $sql_insert_img_product = "INSERT INTO imgs_products (id_products ,imgs_des) VALUES ('$id','$file_name_img_product')";
                $is_insert_img_product = mysqli_query($connection, $sql_insert_img_product);
                var_dump($is_insert_img_product);
            }
        }


//        $file_name_img_product = '';
//        if ($key1 == 0) {
//            if (isset($_FILES['img'])) {
//                $id_product = mysqli_insert_id($connection);
//                foreach ($_FILES['img_product']['name'] as $key4 => $value) {
//                    $dir_upload_product = 'img_product';
//                    if (!file_exists($dir_upload_product)) {
//                        mkdir($dir_upload_product);
//                    }
//                    $file_name_img_product = $value . '-' . time() . '.' . $extensions;
//                    move_uploaded_file($_FILES['img_product']['tmp_name'][$key4], "$dir_upload_product/$file_name_img_product");
//                    $sql_insert_img_product = "INSERT INTO imgs_products (id_products ,imgs_des) VALUES ('$id_product','$file_name_img_product')";
//                    $is_insert_img_product = mysqli_query($connection, $sql_insert_img_product);
//                    var_dump($is_insert_img_product);
//                }
//            }

            if ($is_update_img) {
                $_SESSION['success'] = 'Cập nhật sản phẩm thành công';
                header('Location: Products.php');
                exit();
            } else {
                $error = 'Cập nhật sản phẩm thất bại';
            }
//        }


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
            <a href="Products.php?id=<?php echo $user['id']; ?>"><i class="fas fa-tasks"></i> Quản lý sản phẩm</a>
            <br>
            <br>
            <p style="color: red"><?php echo $error; ?></p>
            <form action="" method="post" enctype="multipart/form-data">
                <p>ID sản phẩm: <?php echo $id; ?></p>
                <br>
                <h4>Danh mục sản phẩm</h4>
                <select name="category">
                    <option value="<?php echo $products['id_cat']; ?>"><?php echo $products['name_cate']; ?></option>
                    <?php
                    foreach ($categories AS $key2 => $value2):
                        if ($value2['id_cat'] == $products['id_cat']) {
                            continue;
                        }
                    ?>
                    <option value="<?php echo $value2['id_cat']; ?>"><?php echo $value2['name']; ?></option>
                    <?php endforeach; ?>
                    <option value="0">__Tên danh mục__</option>
                </select>
                <br>
                <br>
                <h4>Tên sản phẩm:</h4>
                <input type="text" name="name" placeholder="Tên sản phẩm..." value="<?php echo $product['name'];?>">
                <hr>
                <h4>Giá sản phẩm</h4>
                <input type="number" name="price" value="<?php echo $product['price'];?>">
                <hr>
                <h4>Giá sale</h4>
                <input type="number" name="sale_price" value="<?php echo $product['sale_price'];?>">
                <hr>
                <h4>Mô tả sản phẩm:</h4>
                <textarea name="product_des" id="product_des"><?php echo $product['description'];?></textarea>
                <script>
                    CKEDITOR.replace ('product_des', {
                        filebrowserBrowseUrl: '../assets/ckfinder/ckfinder.html',
                        fileuploadBrowseUrl: '../assets/ckfinder/core/connector/php/vendor/connector.php'
                    });
                </script>
                <hr>
                <h4>Ảnh sản phẩm</h4>
                <input type="file" name="img">
                <br>
                <img src="uploads/<?php echo $product['img'];?>" height="100px">
                <br>
                <hr>
                <h4>Ảnh mô tả</h4>
                <p style="color: dodgerblue">Thêm ảnh mô tả</p>
                <input type="file" name="img_product[]" multiple="multiple">
                <br>

                <table border="2" cellspacing="0" cellpadding="8" style="width: 100%">
                    <tr>
                        <?php foreach ($img_product AS $item => $values):?>
                        <td>
                            <a href="#" style="color: red"><i class="fas fa-minus-circle"></i>
                                <img src="img_product/<?php echo $values['imgs_des'];?>" height="200px" width="200px" style="padding: 0px 0px;">
                            </a>
                        </td>
                        <?php endforeach;?>
                    </tr>
                </table>
                <p style="font-weight: bold">Trạng thái: </p>
                <input type="radio" name="status" value="1" <?php
                    if ($product['status'] == 1) {
                        echo 'checked';
                    }
                    else {
                        echo '';
                    }
                ?>> Hiện
                <input type="radio" name="status" value="0" <?php
                if ($product['status'] == 0) {
                    echo 'checked';
                }
                else {
                    echo '';
                }
                ?>> Ẩn
                <br>
                <br>
                <input type="submit" name="submit" value="Cập nhật">

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