<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = 'Hãy đăng nhập để truy cập';
    header('Location: ../Log in & out/Log_in.php');
    exit();
}

$id = $_GET['user_id'];

$sql_select_one= "SELECT * FROM user_admin WHERE id = $id";
$result_one = mysqli_query($connection, $sql_select_one);
$user = mysqli_fetch_assoc($result_one);

$id_orders = $_GET['id'];

$sql_select_orders = "SELECT * FROM orders WHERE id = $id_orders";
$result_orders = mysqli_query($connection, $sql_select_orders);
$customer = mysqli_fetch_assoc($result_orders);
echo '<pre>';
print_r($customer);
echo '</pre>';

$sql_select_orders_detail = "SELECT order_detail.*, products.name as 'product_name', products.img FROM order_detail JOIN products ON order_detail.id_products = products.id WHERE id_orders = $id_orders ";
$result_orders_detail = mysqli_query($connection, $sql_select_orders_detail);
$orders_detail = mysqli_fetch_all($result_orders_detail, MYSQLI_ASSOC);
echo '<pre>';
print_r($orders_detail);
echo '</pre>';

echo '<pre>';
print_r($user);
echo '</pre>';

echo '<pre>';
print_r($_POST);
echo '</pre>';

$error = '';

if (isset($_POST['submit'])) {
    $submit = $_POST['submit'];
    $status = $_POST['status'];
    if ($status == 0) {
        $status = 'Đang khởi tạo';
    }
    elseif ($status == 1) {
        $status = 'Đang xử lý';
    }
    elseif ($status == 2) {
        $status = 'Đã giao cho bên vận chuyển';
    }
    elseif ($status == 3) {
        $status = 'Đang giao hàng';
    }
    elseif ($status == 4) {
        $status = 'Giao hàng thành công';
    }
    $sql_update = "UPDATE orders SET status = '$status' WHERE id = $id_orders";
    $is_update = mysqli_query($connection, $sql_update);
    var_dump($is_update);
    if ($is_update) {
        $_SESSION['success'] = 'Cập nhật đơn hàng thành công';
        header('Location: Order.php?id=' . $user['id']);
        exit();
    }
    else {
        $_SESSION['error'] = 'Cập nhật đơn hàng thất bại';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý đơn hàng</title>
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
        </section>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            Nội dung hiển thị ở đây
            <br>
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
                    echo '<div class="alert alert-success">';
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    echo '</div>';
                }
                ?>
            </p>
            <br>
            <h3 style="margin: 30px 0px; font-weight: 600">Thông tin khách hàng</h3>
            <a href="Order.php?id=<?php echo $user['id']; ?>"><i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>Trang đơn hàng</a>
            <form action="" method="post" style="margin-top: 30px">
                <div class="form-group">
                    <label for="name" style="font-size: 16px">Tên người đặt: <span style="font-weight: 600"><?php echo $customer['name']; ?></span></label>
                </div>
                <div class="form-group">
                    <label for="email" style="font-size: 16px">E-mail: <span style="font-weight: 500"><?php echo $customer['email']; ?></span></label>
                </div>
                <div class="form-group">
                    <label for="phone" style="font-size: 16px">Số điện thoại: <span style="font-weight: 500"><?php echo $customer['phone']; ?></span></label>
                </div>
                <div class="form-group">
                    <label for="phone" style="font-size: 16px">Địa chỉ: <span style="font-weight: 500"><?php echo $customer['address']; ?></span></label>
                </div>
                <div class="form-group">
                    <label for="phone" style="font-size: 16px">Tỉnh/Thành: <span style="font-weight: 500"><?php echo $customer['city']; ?></span>,</label>
                    <label for="phone" style="font-size: 16px">Quận/Huyện: <span style="font-weight: 500"><?php echo $customer['district']; ?></span>,</label>
                    <label for="phone" style="font-size: 16px">Phường/Xã: <span style="font-weight: 500"><?php echo $customer['ward']; ?></span></label>
                </div>
                <div class="form-group">
                    <label for="phone" style="font-size: 16px">Ghi chú: <span style="font-weight: 500"><?php echo $customer['note']; ?></span></label>
                </div>
                <div class="form-group">
                    <label for="phone" style="font-size: 16px">Phương thức thanh toán: <span style="font-weight: 500"><?php echo $customer['pay_method']; ?></span></label>
                </div>
                <div class="form-group">
                    <label style="font-size: 16px">Ngày tạo đơn: <span style="font-weight: 500"><?php echo date('d/m/Y H:i:s', strtotime($customer['created_at'])); ?></span></label>
                </div>
                <br>
                <table border="1" cellspacing="0" cellpadding="8">
                    <tr>
                        <th style="text-align: center; padding: 30px">STT</th>
                        <th style="text-align: center; padding: 30px">Tên sản phẩm</th>
                        <th style="text-align: center; padding: 30px">Số lượng</th>
                        <th style="text-align: center; padding: 30px">Giá</th>
                        <th style="text-align: center; padding: 30px">Ảnh sản phẩm</th>
                    </tr>
                    <?php $number = 1;
                    foreach ($orders_detail AS $key => $value):
                    ?>
                    <tr>
                        <td style="padding: 30px; text-align: center;"><?php echo $number++; ?></td>
                        <td style="padding: 30px; text-align: center;"><?php echo $value['product_name']; ?></td>
                        <td style="padding: 30px; text-align: center;"><?php echo $value['quantity']; ?></td>
                        <td style="padding: 30px; text-align: center;"><?php echo number_format($value['price']) . 'đ'; ?></td>
                        <td style="padding: 30px; text-align: center;"><img src="../Products/uploads/<?php echo $value['img']; ?>" style="width: 100px; height: 100px;"></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <br>
                <div class="form-group"><label for="name" style="font-size: 16px">Trạng thái đơn hàng</label>
                    <br>
                    <br>
                    <input type="radio" name="status" <?php if ($customer['status'] == 'Đang khởi tạo') { echo 'checked= "checked" '; } else { echo ''; } ?> value="0"> <span style="margin-right: 10px;">Đang khởi tạo</span>
                    <input type="radio" name="status" <?php if ($customer['status'] == 'Đang xử lý') { echo 'checked= "checked" '; } else { echo ''; } ?> value="1"> <span style="margin-right: 10px;">Đang xử lý</span>
                    <input type="radio" name="status" <?php if ($customer['status'] == 'Đã giao cho bên vận chuyển') { echo 'checked= "checked" '; } else { echo ''; } ?> value="2"> <span style="margin-right: 10px;">Đã giao cho bên vận chuyển</span>
                    <input type="radio" name="status" <?php if ($customer['status'] == 'Đang giao hàng') { echo 'checked= "checked" '; } else { echo ''; } ?> value="3"> <span style="margin-right: 10px;">Đang giao hàng</span>
                    <input type="radio" name="status" <?php if ($customer['status'] == 'Giao hàng thành công') { echo 'checked= "checked" '; } else { echo ''; } ?> value="4"> <span style="margin-right: 10px;">Giao hàng thành công</span>
                </div>
                <br>
<!--                <input type="hidden" id="id" name="id" value="--><?php //echo $user['id'];?><!--">-->
                <input type="submit" name="submit" value="Lưu">
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
