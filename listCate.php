<?php
include "connection/connect.php";

$category_search = isset($_GET['category_search']) ? $_GET['category_search'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

$limit = 6;
$pages = !empty($_GET['pages']) ? $_GET['pages'] : 1;
$start = ($pages - 1) * $limit;

$sql = "SELECT * FROM category WHERE name LIKE '%$category_search%' AND status LIKE '%$status%'";

$queryRow =  mysqli_query($conn, $sql);
$count = mysqli_num_rows($queryRow);

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
                  <h1>Data Table Category</h1>
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
          <section class="content">


            <div class="box-header">
              <a href="addCate.php" class="btn btn-success">+ Add New Category</a>
              <form class="form-group" method="GET">
                <div class="row align-items-center">
                  <div class="col-lg-6 p-0">
                    <input type="text" name="category_search" class="form-control pull-right" placeholder="Search">
                  </div>
                  <div class="col-lg-6 p-0">
                    <select name="status" id="" class="form-control">
                      <option value="">All</option>
                      <option value="1">Show</option>
                      <option value="0">Hide</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-outline-dark btn-block"><i class="fa fa-search"></i></button>
                </div>
              </form>

            </div>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-hover table-bordered">
            <tbody>
              <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Options</th>
              </tr>
              <?php if ($result->num_rows > 0) { ?>
                <?php foreach ($result as $key => $value) { ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['name'] ?></td>
                    <td>
                      <?php if ($value['status'] == 1) { ?>
                        <span class="badge badge-success">Show</span>
                      <?php } else { ?>
                        <span class="badge badge-danger">Hide</span>

                      <?php } ?>
                    </td>
                    <td>
                      <a href="updateCate.php?id=<?= $value['id'] ?>" class="btn btn-success">Update</a>
                      <a href="deleteCate.php?id=<?= $value['id'] ?>" class="btn btn-danger" onclick='return confirm("Are You Sure About That ? All Products which have this category  will be delete ! ")'>Delete</a>
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
            <li class="page-item"><a class="page-link" href="?page=category/index.php&pages=<?= ($pages > 1) ? $pages - 1 : $pages ?>">&laquo;</a></li>
            <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
              <li class="page-item <?= $i == $pages ? 'active' : ''; ?>">
                <a class="page-link" href="?page=category/index.php&pages=<?= $i; ?>"><?= $i; ?></a>
              </li>
            <?php endfor; ?>
            <li class="page-item"><a class="page-link" href="?page=category/index.php&pages=<?= ($pages < $totalPage) ? $pages + 1 : $pages ?>">&raquo;</a></li>
          </ul>

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