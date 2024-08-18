<?php
require 'connect.php';

if(isset($_GET['userId'])) {
  $id = $_GET['userId'];

  // Menghapus data mahasiswa berdasarkan ID
  $query = "DELETE FROM `mahasiswa` WHERE id = '$id'";
  $result = mysqli_query($conn, $query);

  if($result){
    header('location:index.php');
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }
}
?>
