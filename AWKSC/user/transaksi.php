<?php include 'header.php'; ?>

<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>History Transaksi  <b> <?php echo $_SESSION['username']; ?> </b> </h4>
		</div>
		<div class="panel-body">

			<a href="transaksi_tambah.php" class="btn btn-sm btn-info pull-right">Transaksi Baru</a>
			
			<br/>
			<br/>
			</div>
	</div>
</div>
				<?php 
				// koneksi database
				include '../koneksi.php';
				// mengambil data pelanggan dari database
				$nama=$_SESSION['username'];
				$data = mysqli_query($koneksi,"SELECT * from transaksi where transaksi_pelanggan='$nama' order by transaksi_id desc limit 10");
				$no = 1;
				// mengubah data ke array dan menampilkannya dengan perulangan while
				while($d=mysqli_fetch_array($data)){
					?>
				<div class="container">
					<div class="panel">
						<div class="panel-heading">
						<label>No.Invoice : INVOICE-<?php echo $d['transaksi_id']; ?></label><br/>
						<label>Tanggal Pemesanan : <?php echo $d['transaksi_jam_pemesanan']; ?></label><br/>
						<?php if($d['transaksi_status']=='1'){
							echo "<label>Booking Dibatalkan</label><br/>";
						}else if($d['transaksi_status']=='0'){
						?>
						<a href="transaksi_detail.php?id=<?php echo $d['transaksi_id'];?>&tgl=<?php echo $d['transaksi_jam_pemesanan'];?>" class="btn btn-sm btn-primary">Lihat Detail</a>
						<?php }
						?>
						</div>
					</div>
				</div>
					<?php 
				}
				?>
<?php include 'footer.php'; ?>