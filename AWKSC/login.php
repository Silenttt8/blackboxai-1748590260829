<?php 
session_start();
include 'koneksi.php';
$username = $_POST['username'];
$password = md5($_POST['password']);
$data = mysqli_query($koneksi,"select * from admin where username='$username' and password='$password'");
$admin = mysqli_num_rows($data);
if($admin > 0){
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:admin/pelanggan.php");
}else{
	header("location:index.php?pesan=gagal");
}
?>