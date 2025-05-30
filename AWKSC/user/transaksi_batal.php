<?php
	include 'header.php';
	include '../koneksi.php';
    $id = $_GET['id'];

$sql=mysqli_query($koneksi,"UPDATE transaksi set transaksi_status='1' where transaksi_id = '$id'");
echo $sql;
echo "<script>alert('Booking dibatalkan')</script>";
header("location:transaksi.php");

?>