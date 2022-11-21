<?php
include "connection/connect.php";
$id = isset($_GET['id']) ? $_GET['id'] : null;

$errors = [];
$sql = "SELECT * FROM product WHERE id = '$id'";
$results = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($results);

$sql2 = "SELECT * FROM category";
$result = mysqli_query($conn, $sql2);

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $sale = $_POST['sale'];
  $status = $_POST['status'];
  $category_id = $_POST['category_id'];

  if (empty($name)) {
    $errors['name_required'] = "Name is required";
  }

  if (empty($price)) {
    $errors['price_required'] = "Price is required";
  } else {
    if (!filter_var($price,  FILTER_VALIDATE_FLOAT)) {
      $errors['price_invalid'] = "Price must be a number";
    } elseif ($price <= 0) {
      $errors['greather_price'] = "Price must be greater than zero";
    }
  }

  if (empty($sale)) {
    $errors['saleprice_required'] = "Sale Price is required";
  } else {
    // regex theo so thap phan (float)
    $priceRgx = "/^[+-]?([0-9]+([.][0-9]*)?|[.][0-9]+)$/";
    if (!preg_match($priceRgx, $sale)) {
      $errors['price_invalid'] = "Sale must be a number";
    } elseif ($sale < 0) {
      $errors['greather_price'] = "Sale must be greater than zero";
    } elseif ($sale > 100) {
      $errors['price_equals'] = "Sale must be less than or equal to 100%";
    }
  }

  if (!empty($_FILES['image']['name'])) {
    $types = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/webp', 'image/svg'];
    $file = $_FILES['image'];
    if (!in_array($file['type'], $types)) {
      $errors['image_invalid'] = "Invalid image type";
    } else {
      unlink("uploads/" . $row['image']);
      $image = time() . $file['name'];
      move_uploaded_file($file['tmp_name'], "uploads/" . $image);
    }
  } else {
    $image = $row['image'];
  }


  if (!$errors) {
    $sql = "UPDATE product SET name = '$name', price = $price, sale = $sale, image = '$image', status = '$status', category_id = $category_id WHERE id = '$id'";

    $query = mysqli_query($conn, $sql);

    if ($query) {
      header('location: listProd.php');
      exit;
    }
  }
}
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
                  <h1>Update Product: <?= $row['name'] ?></h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=product/index.php">List</a></li>
                    <li class="breadcrumb-item active">Update</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>

          <form method="POST" action="" enctype="multipart/form-data">
            <div class="box-body">
              <?php if ($errors) { ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php foreach ($errors as $key => $value) { ?>
                    <strong>
                      <?= $value . '<hr>' ?>
                    </strong>
                  <?php } ?>
                </div>
              <?php } ?>

              <div class="form-group">
                <label for="exampleInputEmail1">Product's Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name" value="<?= $row['name'] ?>">
              </div>

              <div class="form-group">
                <label for="image">Product's Image</label>
                <input type="file" name="image" class="form-control" id="image">
                <div class="image" style="width: 30%;">
                  <img src="uploads/<?= $row['image'] ?>" alt="" style="width: 100%;">
                </div>
              </div>

              <div class="form-group">
                <label for="price">Product's Price</label>
                <input type="text" name="price" class="form-control" id="price" placeholder="Price" value="<?= $row['price'] ?>">
              </div>

              <div class="form-group">
                <label for="sale">Product's Sale</label>
                <input type="text" name="sale" class="form-control" id="sale" placeholder="Sale Price" value="<?= $row['sale'] ?>">
              </div>

              <div class=" form-group">
                <label for="input">Choose Product's Status</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="status" id="input" value="1" <?= ($row['status'] == 1) ? 'checked' : '' ?>>
                    In Stock
                  </label>
                  <label>
                    <input type="radio" name="status" id="input" value="0" <?= ($row['status'] == 0) ? 'checked' : '' ?>>
                    Out Of Stock
                  </label>
                </div>
              </div>

              <div class="form-group">
                <label for="category_id">Product's Category</label>
                <select name="category_id" id="category_id" class="form-control">
                  <?php foreach ($result as $key => $value) { ?>
                    <?php if ($row['category_id'] == $value['id']) { ?>
                      <option value="<?= $value['id'] ?>" selected>
                        <?= $value['id'] ?> - <?= $value['name'] ?>
                      </option>
                    <?php } else { ?>
                      <option value="<?= $value['id'] ?>">
                        <?= $value['id'] ?> - <?= $value['name'] ?>
                      </option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
          </form>
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