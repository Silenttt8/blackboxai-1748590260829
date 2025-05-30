<?php 
// menghubungkan dengan koneksi
include '../koneksi.php'; 
$transaksi_pelanggan = $_POST['pelanggan_pelanggan'];
$transaksi_tgl = $_POST['tanggal'];
$transaksi_durasi = $_POST['durasi'];
$jam_mulai = $_POST['jam_mulai'];
//$transaksi_status =  $_POST['status'];
$transaksi_lap = $_POST['lap'];

date_default_timezone_set('Asia/Jakarta');
$transaksi_jam_pemesanan = date('Y-m-d H:i:s');
$transaksi_jam_selesai = date('H:i:s',strtotime("$jam_mulai, +$transaksi_durasi hour"));

$tgl_hari_ini = date('Y-m-d');
$h = mysqli_query($koneksi,"SELECT harga_per_jam from harga");
$harga_per_jam = mysqli_fetch_assoc($h);

$transaksi_harga = $transaksi_durasi * $harga_per_jam['harga_per_jam'];

//Jam boking tidak dapat sama
$tambah=mysqli_query($koneksi,"INSERT into transaksi (transaksi_id, transaksi_jam_pemesanan, transaksi_tgl, transaksi_pelanggan, jam_mulai, transaksi_harga, transaksi_durasi, transaksi_jam_selesai, transaksi_status, transaksi_lap) 
values('','$transaksi_jam_pemesanan','$transaksi_tgl','$transaksi_pelanggan','$jam_mulai','$transaksi_harga','$transaksi_durasi','$transaksi_jam_selesai','0','$transaksi_lap')");
$sql=mysqli_query($koneksi,"SELECT max(transaksi_id) as id from transaksi");
while($data=mysqli_fetch_array($sql)){
	$id_terakhir=$data['id'];
}
echo $id_terakhir;
header("location:transaksi.php?id=".$id_terakhir."");
?>