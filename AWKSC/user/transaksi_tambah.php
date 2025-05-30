<?php
	include 'header.php';
	include '../koneksi.php'; 
?>

<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>Transaksi Penyewaan Lapangan</h4>
		</div>
		<div class="panel-body">

			

			<div class="col-md-8 col-md-offset-2">
				<a href="transaksi.php" class="btn btn-sm btn-info pull-right">Kembali</a>
				<br/>
				<br/>
				<form method="post" action="transaksi_aksi.php">
					<div class="form-group">
						<label>Pelanggan</label>
						<input type="text" class="form-control" id="pelanggan_pelanggan" name="pelanggan_pelanggan" required="required" value="<?php echo $_SESSION['username']; ?>" readonly>		
					</div>	
					
					<div class="form-group">
						<label>tanggal</label>
						<input type="date" class="form-control" id="tanggal" name="tanggal" required="required">
					</div>	

					<div class="form-group">
						<label>Jam Mulai</label>
						<input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required="required">
					</div>	

					<div class="form-group">
						<label>Durasi Waktu</label>
						<input type="number" class="form-control" id="durasi" name="durasi" placeholder="Durasi Waktu .." required="required">
					</div>	
					<div class="form-group">
						<label>Status</label>
						<select class="form-control" id="lap" name="lap">	
							<option value="0">Booking</option>
						</select>				
					</div>	
					<br/>
                    <input type="submit" class="btn btn-primary" value="Booking">
			</div>

		</div>
	</div>
</div>

<?php include 'footer.php'; ?>