<?php
// koneksi database
include '../koneksi.php';

// mengambil data dari form
$transaksi_id = $_POST['transaksi_id'];
$metode = $_POST['metode'];
$jumlah = $_POST['jumlah'];

// set timezone
date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d H:i:s');

// Upload bukti pembayaran
$rand = rand();
$allowed = array('gif', 'png', 'jpg', 'jpeg', 'pdf');
$filename = $_FILES['bukti']['name'];

if($filename != ""){
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    
    if(in_array($ext, $allowed)){
        $tmp_name = $_FILES['bukti']['tmp_name'];
        $newfilename = 'bukti_'.$rand.'.'.$ext;
        $folder = "../gambar/bukti/";
        
        // buat folder jika belum ada
        if(!is_dir($folder)){
            mkdir($folder, 0755, true);
        }
        
        // pindahkan file
        move_uploaded_file($tmp_name, $folder.$newfilename);
        
        // insert data ke database
        mysqli_query($koneksi, "INSERT INTO pembayaran VALUES (
            '',
            '$transaksi_id',
            '$tanggal',
            '$metode',
            '$jumlah',
            '$newfilename',
            'pending'
        )");
        
        // redirect ke halaman pembayaran
        header("location:pembayaran.php?id=".$transaksi_id."&alert=success");
    }else{
        // redirect dengan pesan error jika format file tidak sesuai
        header("location:pembayaran.php?id=".$transaksi_id."&alert=error_format");
    }
}else{
    // redirect dengan pesan error jika tidak ada file
    header("location:pembayaran.php?id=".$transaksi_id."&alert=error_upload");
}
?> 