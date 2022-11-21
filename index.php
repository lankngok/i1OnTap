<?php
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
                  <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
          <div class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header border-0">
                      <div class="d-flex justify-content-between">
                        <h3 class="card-title">Online Store Visitors</h3>
                        <a href="javascript:void(0);">View Report</a>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex">
                        <p class="d-flex flex-column">
                          <span class="text-bold text-lg">820</span>
                          <span>Visitors Over Time</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                          <span class="text-success">
                            <i class="fas fa-arrow-up"></i> 12.5%
                          </span>
                          <span class="text-muted">Since last week</span>
                        </p>
                      </div>
                      <!-- /.d-flex -->

                      <div class="position-relative mb-4">
                        <canvas id="visitors-chart" height="200"></canvas>
                      </div>

                      <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                          <i class="fas fa-square text-primary"></i> This Week
                        </span>

                        <span>
                          <i class="fas fa-square text-gray"></i> Last Week
                        </span>
                      </div>
                    </div>
                  </div>
                  <!-- /.card -->

                  <div class="card">
                    <div class="card-header border-0">
                      <h3 class="card-title">Products</h3>
                      <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm">
                          <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                          <i class="fas fa-bars"></i>
                        </a>
                      </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                      <table class="table table-striped table-valign-middle">
                        <thead>
                          <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Sales</th>
                            <th>More</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <img src="assets/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                              Some Product
                            </td>
                            <td>$13 USD</td>
                            <td>
                              <small class="text-success mr-1">
                                <i class="fas fa-arrow-up"></i>
                                12%
                              </small>
                              12,000 Sold
                            </td>
                            <td>
                              <a href="#" class="text-muted">
                                <i class="fas fa-search"></i>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                              Another Product
                            </td>
                            <td>$29 USD</td>
                            <td>
                              <small class="text-warning mr-1">
                                <i class="fas fa-arrow-down"></i>
                                0.5%
                              </small>
                              123,234 Sold
                            </td>
                            <td>
                              <a href="#" class="text-muted">
                                <i class="fas fa-search"></i>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                              Amazing Product
                            </td>
                            <td>$1,230 USD</td>
                            <td>
                              <small class="text-danger mr-1">
                                <i class="fas fa-arrow-down"></i>
                                3%
                              </small>
                              198 Sold
                            </td>
                            <td>
                              <a href="#" class="text-muted">
                                <i class="fas fa-search"></i>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="assets/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                              Perfect Item
                              <span class="badge bg-danger">NEW</span>
                            </td>
                            <td>$199 USD</td>
                            <td>
                              <small class="text-success mr-1">
                                <i class="fas fa-arrow-up"></i>
                                63%
                              </small>
                              87 Sold
                            </td>
                            <td>
                              <a href="#" class="text-muted">
                                <i class="fas fa-search"></i>
                              </a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header border-0">
                      <div class="d-flex justify-content-between">
                        <h3 class="card-title">Sales</h3>
                        <a href="javascript:void(0);">View Report</a>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex">
                        <p class="d-flex flex-column">
                          <span class="text-bold text-lg">$18,230.00</span>
                          <span>Sales Over Time</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                          <span class="text-success">
                            <i class="fas fa-arrow-up"></i> 33.1%
                          </span>
                          <span class="text-muted">Since last month</span>
                        </p>
                      </div>
                      <!-- /.d-flex -->

                      <div class="position-relative mb-4">
                        <canvas id="sales-chart" height="200"></canvas>
                      </div>

                      <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                          <i class="fas fa-square text-primary"></i> This year
                        </span>

                        <span>
                          <i class="fas fa-square text-gray"></i> Last year
                        </span>
                      </div>
                    </div>
                  </div>
                  <!-- /.card -->

                  <div class="card">
                    <div class="card-header border-0">
                      <h3 class="card-title">Online Store Overview</h3>
                      <div class="card-tools">
                        <a href="#" class="btn btn-sm btn-tool">
                          <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-tool">
                          <i class="fas fa-bars"></i>
                        </a>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="text-success text-xl">
                          <i class="ion ion-ios-refresh-empty"></i>
                        </p>
                        <p class="d-flex flex-column text-right">
                          <span class="font-weight-bold">
                            <i class="ion ion-android-arrow-up text-success"></i> 12%
                          </span>
                          <span class="text-muted">CONVERSION RATE</span>
                        </p>
                      </div>
                      <!-- /.d-flex -->
                      <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="text-warning text-xl">
                          <i class="ion ion-ios-cart-outline"></i>
                        </p>
                        <p class="d-flex flex-column text-right">
                          <span class="font-weight-bold">
                            <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                          </span>
                          <span class="text-muted">SALES RATE</span>
                        </p>
                      </div>
                      <!-- /.d-flex -->
                      <div class="d-flex justify-content-between align-items-center mb-0">
                        <p class="text-danger text-xl">
                          <i class="ion ion-ios-people-outline"></i>
                        </p>
                        <p class="d-flex flex-column text-right">
                          <span class="font-weight-bold">
                            <i class="ion ion-android-arrow-down text-danger"></i> 1%
                          </span>
                          <span class="text-muted">REGISTRATION RATE</span>
                        </p>
                      </div>
                      <!-- /.d-flex -->
                    </div>
                  </div>
                </div>
                <!-- /.col-md-6 -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
          </div>
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