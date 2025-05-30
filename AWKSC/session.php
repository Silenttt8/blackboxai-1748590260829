<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:form_login.php?pesan=akses_ditolak");
	}
?>