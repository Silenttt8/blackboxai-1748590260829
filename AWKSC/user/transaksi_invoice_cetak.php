<!DOCTYPE html>
<html>
<head>
	<title>Invoice Transaksi AWK SC</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
</head>
<body>
	<?php 
		session_start();
		if($_SESSION['status']!="login"){
			header("location:../index.php?pesan=belum_login");
		}
		// koneksi database
		include '../koneksi.php';
	?>
	<div class="container">
		<div class="col-md-10 col-md-offset-1">
		<br/>
		<br/>
		 <form action = "transaksi_invoice.php" method="GET">								
			<?php 
			// menangkap id yang dikirim melalui url
			$id = $_GET['id'];

			// megambil data pelanggan dan data transaksi yang ber id di atas dari tabel pelanggan
			$transaksi = mysqli_query($koneksi,"SELECT * FROM transaksi, pelanggan WHERE transaksi.transaksi_id='$id' and pelanggan.pelanggan_nama=transaksi.transaksi_pelanggan");
			while($t=mysqli_fetch_array($transaksi)){
				?>
				<center><h2> AWK SPORT CENTER </h2></center>
				<h3></h3>
				<br/>
				<br/>
			
				<table class="table">
					<tr>
						<th width="20%">No. Invoice</th>
						<th>:</th>
						<td>INVOICE-<?php echo $t['transaksi_id']; ?></td>
					</tr>
					<tr>
						<th width="20%">Tanggal</th>
						<th>:</th>
						<td><?php echo $t['transaksi_jam_pemesanan']; ?></td>
					</tr>
					<tr>
						<th>Nama Pelanggan</th>
						<th>:</th>
						<td><?php echo $t['transaksi_pelanggan']; ?></td>
					</tr>
					<tr>
						<th>HP</th>
						<th>:</th>
						<td><?php echo $t['pelanggan_hp']; ?></td>
					</tr>
					<tr>
						<th>Alamat</th>
						<th>:</th>
						<td><?php echo $t['pelanggan_alamat']; ?></td>
					</tr>
					<tr>
						<th>Durasi Main</th>
						<th>:</th>
						<td><?php echo $t['transaksi_durasi']; ?> jam</td>
					</tr>
					<tr>
						<th>Harga</th>
						<th>:</th>
						<td><?php echo "Rp. ".number_format($t['transaksi_harga'])." ,-"; ?></td>
					</tr>
					<?php
					// Check payment information
					$id_transaksi = $t['transaksi_id'];
					$cek_pembayaran = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE transaksi_id='$id_transaksi'");
					$ada_pembayaran = mysqli_num_rows($cek_pembayaran);
					
					if($ada_pembayaran > 0) {
						$p = mysqli_fetch_assoc($cek_pembayaran);
					?>
					<tr>
						<th>Status Pembayaran</th>
						<th>:</th>
						<td><strong><?php echo ucfirst($p['pembayaran_status']); ?></strong></td>
					</tr>
					<tr>
						<th>Metode Pembayaran</th>
						<th>:</th>
						<td>
							<?php echo $p['pembayaran_metode']; ?>
							<?php if($p['pembayaran_metode'] == 'Transfer Bank' || $p['pembayaran_metode'] == 'OVO/GoPay/DANA'): ?>
							<br><small>No. Akun: 087871158404</small>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<th>Tanggal Pembayaran</th>
						<th>:</th>
						<td><?php echo date('d/m/Y H:i', strtotime($p['pembayaran_tanggal'])); ?></td>
					</tr>
					<?php } else { ?>
					<tr>
						<th>Status Pembayaran</th>
						<th>:</th>
						<td><strong>Belum Dibayar</strong></td>
					</tr>
					<?php } ?>
				</table>

				<br/>

				<h4 class="text-center">Rincian Transaksi</h4>
				<table class="table table-bordered table-striped">
					<tr>
						<th width="25%">Tanggal Main</th>
						<th width="25%">Jam Mulai</th>
						<th width="25%">Jam Selesai</th>
						<th width="25%">Status</th>
					</tr>		

					<?php 
					// menyimpan id transaksi ke variabel id_transaksi
					$id = $t['transaksi_id'];

					// menampilkan lapangan dari transaksi yang ber id di atas
					$lapangan = mysqli_query($koneksi,"select * from transaksi where transaksi_id='$id'");

					while($p=mysqli_fetch_array($lapangan)){
						?>					
						<tr>
							<td width="5%"><?php echo $t['transaksi_tgl']; ?></td>
							<td width="5%"><?php echo $t['jam_mulai']; ?></td>
							<td width="5%"><?php echo $t['transaksi_jam_selesai']; ?></td>
							<?php
							if($t['transaksi_lap']=='0'){
								$lap="Booking";
							}
							?>
							<td width="5%"><?php echo $lap; ?></td>
						</tr>
						<?php } ?>							
					</table>

					<br/>
					<p><center><i>" Terima kasih telah bermain dilapangan kami ".</i></center></p>

					<?php 
				}
				?>
			</div>
		</div>
		<script type="text/javascript">
			window.print();
		</script>
	</body>
	</html>