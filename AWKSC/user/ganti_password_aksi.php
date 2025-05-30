<?php
	include 'header.php';
	include '../koneksi.php';
	$nama=$_SESSION['username'];
    $password = $_POST['password'];

$sql=mysqli_query($koneksi,"UPDATE pelanggan set password='$password' where username = '$nama'");
//echo $sql;
header("location:ganti_password.php?pesan=oke");

?>