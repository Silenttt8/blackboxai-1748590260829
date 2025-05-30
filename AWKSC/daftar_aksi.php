<?php 
    include 'koneksi.php';

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];

    if($nama=="" || $username=="" || $password=="" || $hp=="" || $alamat==""){
        header("location:form_daftar.php?pesan=data_belum_lengkap");
    }else{
        $cekuser = mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE username='$username'");
        $cek = mysqli_num_rows($cekuser);
        if($cek > 0){
            header("location:form_daftar.php?pesan=username_sudah_terdaftar");
        }else{
            $daftar = mysqli_query($koneksi,"INSERT INTO pelanggan VALUES('','$username','$password','$nama','$hp','$alamat')");
            header("location:form_login.php?pesan=berhasil_daftar");
        }
    }
?>