<?php
include "connection/connect.php";
$id = isset($_GET['id']) ? $_GET['id'] : null;

$results = mysqli_query($conn, "SELECT * FROM product WHERE id = '$id'");

$data = mysqli_fetch_assoc($results);
unlink("uploads/" . $data['image']);

$query = mysqli_query($conn, "DELETE FROM product WHERE id = '$id'");

if ($query) {
  header("location: listProd.php");
  exit();
} else {
  header("location: listProd.php");
  echo
  "<script>
    alert('Invalid Query, Cannot delete product');
  </script>";
}