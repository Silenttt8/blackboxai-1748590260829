<?php 
	session_start();
	include 'koneksi.php';
	
	$username = $_POST['username'];
    $password = $_POST['password'];

	if($username=="" || $password==""){
        header("location:form_login.php?pesan=gagal_login");
    }else{
		$cekakun = mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE username='$username' AND password='$password'");
		$cek = mysqli_num_rows($cekakun);
		if($cek > 0){
			$_SESSION['username'] = $username;
			$_SESSION['status'] = "login";
			header("location:user/transaksi.php");
		}else{
			header("location:form_login.php?pesan=gagal_login");
		}
	}
?>