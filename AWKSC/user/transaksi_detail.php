<?php
	include 'header.php';
	include '../koneksi.php';
	$nama=$_SESSION['username'];
	$id=$_GET['id'];
	$tgl=$_GET['tgl'];
	$data = mysqli_query($koneksi,"SELECT * from transaksi where transaksi_id='$id' and transaksi_jam_pemesanan='$tgl'");
	$no = 1;
	while($d=mysqli_fetch_array($data)){
?>

<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4><b>Detail Transaksi</b></h4>
		</div>
		<div class="panel-body">
			<label>No.Invoice : INVOICE-<?php echo $d['transaksi_id']; ?></label><br/>
			<label>Tanggal Digunakan : <?php echo $d['transaksi_tgl']; ?></label><br/>
			<label>Durasi : <?php echo $d['transaksi_durasi'];?> Jam</label><br/>
			<label>Jam Mulai : <?php echo $d['jam_mulai']; ?></label><br/>
			<label>Jam Selesai : <?php echo $d['transaksi_jam_selesai']; ?></label><br/>			
			<label>Tanggal Main : <?php echo $d['transaksi_tgl']; ?></label><br/>
			<?php 
				if($d['transaksi_lap']=="0"){
					$lapangan='Booking';
				}
			?>		
			<label>Status : <?php echo $lapangan; ?></label><br/>
			<label>Total : Rp.<?php echo number_format($d['transaksi_harga']); ?></label><br/>
			
			<?php
			// Check payment status
			$cek_pembayaran = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE transaksi_id='$id'");
			$ada_pembayaran = mysqli_num_rows($cek_pembayaran);
			
			if($ada_pembayaran > 0) {
				$p = mysqli_fetch_assoc($cek_pembayaran);
				echo "<div class='alert alert-info'>";
				echo "<strong>Status Pembayaran:</strong> ".ucfirst($p['pembayaran_status']);
				echo "<br><a href='pembayaran.php?id=".$id."' class='btn btn-sm btn-info'>Lihat Detail Pembayaran</a>";
				echo "</div>";
			} else {
				echo "<div class='alert alert-warning'>";
				echo "<strong>Status Pembayaran:</strong> Belum dibayar";
				echo "<br><a href='pembayaran.php?id=".$id."' class='btn btn-sm btn-success'>Bayar Sekarang</a>";
				echo "</div>";
			}
			?>
			
			<br/>
			<a href="transaksi_invoice.php?id=<?php echo $d['transaksi_id']; ?>" class="btn btn-sm btn-warning">Cetak Invoice</a>
			<a href="transaksi_batal.php?id=<?php echo $d['transaksi_id']; ?>" class="btn btn-sm btn-danger">Batalkan</a>
			<a href="transaksi.php" class="btn btn-sm btn-primary">Kembali</a>
		</div>
	</div>
</div>
<?php 
	}
?>
<?php include 'footer.php'; ?>