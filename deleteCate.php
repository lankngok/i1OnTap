<?php
include "connection/connect.php";
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

$prod = mysqli_query($conn ,"SELECT * FROM product WHERE category_id = $id");
$data = mysqli_fetch_assoc($prod);
unlink("uploads/".$data['image']);

$sqls = "DELETE FROM product WHERE category_id = $id";
$result = mysqli_query($conn ,$sqls);

$sql = "DELETE FROM category WHERE id = $id";
$result = mysqli_query($conn ,$sql);

if ($result) {
  header('location: listCate.php');
  exit;
}
