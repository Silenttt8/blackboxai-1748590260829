<?php 
// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$id = $_POST['id'];
$transaksi_pelanggan = $_POST['pelanggan_pelanggan'];
$transaksi_tgl = $_POST['tanggal'];
$transaksi_durasi = $_POST['durasi'];
$jam_mulai = $_POST['jam_mulai'];
$transaksi_status =  $_POST['status'];

$transaksi_jam_selesai = date('H:i:s',strtotime("$jam_mulai, +$transaksi_durasi hour"));

$tgl_hari_ini = date('Y-m-d');
$h = mysqli_query($koneksi,"select harga_per_jam from harga");
$harga_per_jam = mysqli_fetch_assoc($h);


$transaksi_harga = $transaksi_durasi * $harga_per_jam['harga_per_jam'];


// update data transaksi
mysqli_query($koneksi,"update transaksi set transaksi_pelanggan='$transaksi_pelanggan', transaksi_tgl='$transaksi_tgl', transaksi_durasi='$transaksi_durasi', jam_mulai='$jam_mulai',transaksi_harga ='$transaksi_harga', transaksi_status='$transaksi_status', transaksi_jam_selesai='$transaksi_jam_selesai', transaksi_lap='$transaksi_lap' where transaksi_id='$id'");


header("location:transaksi.php");

?>