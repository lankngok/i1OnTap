<?php
include "connection/connect.php";

$product_search = isset($_GET['product_search']) ? $_GET['product_search'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

$limit = 3;
$pages = !empty($_GET['pages']) ? $_GET['pages'] : 1;
$start = ($pages - 1) * $limit;
$sql = "SELECT p.id, p.name, p.price, p.sale, p.image, c.name AS 'Name', p.status FROM product p INNER JOIN category c ON p.category_id = c.id WHERE p.name LIKE '%$product_search%' AND p.status LIKE '%$status%'";

$queryRow =  mysqli_query($conn, $sql);
$count = mysqli_num_rows($queryRow);

if (!empty($_GET['order'])) {
  $orderArr = explode('-', $_GET['order']);
  $field = isset($orderArr[0]) ? $orderArr[0] : '';
  $orderType = isset($orderArr[1]) ? $orderArr[1] : '';
  $sql .= " Order By p.$field $orderType";
}

$totalPage = ceil($count / $limit);
$sql .= " LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">
    <!-- Navbar -->
    <?php include "Layouts/header.php" ?>
    <!-- Main Sidebar Container -->
    <?php include "Layouts/sidebar.php" ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Main Start Here -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Data Table Product</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">DataTables</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>

          <!-- Main content -->
          <section class="content container-fluid">
            <div class="form-group">
              <a href="addProd.php" class="btn btn-success">+ Add New Product</a>
            </div>

            <form class="form-group" method="GET">
              <div class="form-group">
                <input type="text" name="product_search" class="form-control" placeholder="Search">
              </div>

              <div class="row">
                <div class="form-group col-lg-6">
                  <select name="status" id="" class="form-control">
                    <option value="">All</option>
                    <option value="1">In Stock</option>
                    <option value="0">Out Of Stock</option>
                  </select>
                </div>
                <div class="form-group col-lg-6">

                  <select name="order" class="form-control">
                    <option value="">Sắp xếp</option>
                    <option value="id-ASC">Id a - z</option>
                    <option value="id-DESC">Id z - a</option>
                    <option value="name-ASC">Name a - z</option>
                    <option value="name-DESC">Name z - a</option>
                    <option value="price-ASC">Price (Low - High)</option>
                    <option value="price-DESC">Price (High - Low)</option>
                  </select>
                </div>
              </div>
              <button type="submit" class="btn btn-default btn-block"><i class="fa fa-search"></i></button>

            </form>


            <!-- /.box-header -->
            <div class="">
              <table class="table table-hover table-bordered">
                <tbody>
                  <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price ($)</th>
                    <th>Sale (%)</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Options</th>
                  </tr>
                  <?php if ($result->num_rows > 0) { ?>
                    <?php foreach ($result as $key => $value) { ?>
                      <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $value['id'] ?></td>
                        <td><?= $value['name'] ?></td>
                        <td style="width: 20%;">
                          <img src="uploads/<?= $value['image'] ?>" alt="" style="width: 100%;">
                        </td>
                        <td><?= $value['price'] ?></td>

                        <td>
                          <?php if ($value['sale'] > 0) { ?>
                            <span class="badge badge-success">
                              <?= $value['sale'] ?>
                            </span>
                          <?php } else { ?>
                            <span class="badge badge-danger">
                              <?= $value['sale'] ?>
                            </span>

                          <?php } ?>
                        </td>

                        <td><?= $value['Name'] ?></td>

                        <td>
                          <?php if ($value['status'] == 1) { ?>
                            <span class="badge badge-success">In Stock</span>
                          <?php } else { ?>
                            <span class="badge badge-danger">Out Of Stock</span>

                          <?php } ?>
                        </td>
                        <td>
                          <a href="updateProd.php?id=<?= $value['id'] ?>" class="btn btn-success">Update</a>
                          <a href="deleteProd.php?id=<?= $value['id'] ?>" class="btn btn-danger" onclick="return confirm('Are You Sure About That ??')">Delete</a>
                        </td>
                      </tr>

                    <?php } ?>
                  <?php } else { ?>
                    <h3 class="text-danger" style="margin-left: 10px;">0 Data Returned</h3>
                  <?php } ?>

                </tbody>
              </table>
            </div>
            <div class="pagi text-center">

              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="?page=product/index.php&pages=<?= ($pages > 1) ? $pages - 1 : $pages ?>">&laquo;</a></li>
                <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                  <li class="page-item <?= $i == $pages ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=product/index.php&pages=<?= $i; ?>"><?= $i; ?></a>
                  </li>
                <?php endfor; ?>
                <li class="page-item"><a class="page-link" href="?page=product/index.php&pages=<?= ($pages < $totalPage) ? $pages + 1 : $pages ?>">&raquo;</a></li>
              </ul>

            </div>
        </div>
        <!-- /.box-body -->
      </section>
      <!-- Main End Here -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php include "Layouts/footer.php" ?>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="assets/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="assets/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="assets/plugins/moment/moment.min.js"></script>
  <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="assets/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="assets/dist/js/pages/dashboard.js"></script>
  <script src="assets/dist/js/pages/dashboard3.js"></script>

</body>

</html>