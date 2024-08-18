<?php
/**
 * Trying to connect
 * HOST='localhost'
 * USER='ROOT'
 * PASSWORD=''
 * DATABASE='latihan_jwd'
 **/

// Create connection
$conn = new mysqli('localhost', 'root', '', 'latihan_jwd');

// Check connection
if (!$conn) {
  die(mysqli_error($conn));
} 
?>