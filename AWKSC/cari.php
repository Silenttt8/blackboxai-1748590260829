<?php include 'header.php'; ?>

<?php 
include 'koneksi.php'; 
?>

<div class="container">
	<div class="alert alert-info text-center">
		<h4 style="margin-bottom: 0px"><b>Selamat datang!</b> THE CHAMPIONS</h4>			
	</div>
	<div class="panel">
		<div class="panel-heading">
			<h4>Cari Jadwal</h4>
		</div>
		<div class="panel-body">		

			<form action="Cari.php" method="get">
				<table class="table table-bordered table-striped">
					<tr>				
						<th>Masukkan Tanggal</th>							
						<th width="1%"></th>
					</tr>
					<tr>
						<td>
							<br/>
							<input type="date" name="tgl_dari" class="form-control">
						</td>
						<td>
							<br/>
							<input type="submit" class="btn btn-primary" value="CARI">
						</td>
					</tr>

				</table>
			</form>
			
		</div>
	</div>

	<br/>

	<?php 
	if(isset($_GET['tgl_dari'])){

		$dari = $_GET['tgl_dari'];

		?>
		<div class="panel">
			<div class="panel-heading">
				<h4>Jadwal Hari ini <b>
			</div>
			<div class="panel-body">			

				<br/>
				<br/>
				<table class="table table-bordered table-striped">
					<tr>
						<th width="1%">No</th>
						<th>Pelanggan</th>
						<th>Tanggal</th>
						<th>Jam Mulai</th>
						<th>Durasi</th>
						<th>Jam Selesai</th>
						
						<th>Status Lapangan</th>										
					</tr>

					<?php 
					// koneksi database
					include 'koneksi.php';

					

					// mengambil data pelanggan dari database
					$data = mysqli_query($koneksi,"SELECT * FROM transaksi, pelanggan WHERE transaksi.transaksi_pelanggan=pelanggan.pelanggan_nama and date(transaksi_tgl) = '$dari' order by transaksi_id desc");
					$no = 1;
					// mengubah data ke array dan menampilkannya dengan perulangan while
					while($d=mysqli_fetch_array($data)){
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $d['transaksi_pelanggan']; ?></td>
							<td><?php echo $d['transaksi_tgl']; ?></td>
							<td><?php echo $d['transaksi_durasi']; ?></td>
							<td><?php echo $d['jam_mulai']; ?></td>
							<td><?php echo $d['transaksi_jam_selesai']; ?></td>
							<td>
							<?php 
								if($d['transaksi_lap']=="0"){
									echo "<div>Booking</div>";
								}else if($d['transaksi_lap']=="1"){
									echo "<div>Selesai</div>";
								}
								?>							
							</td>							
						</tr>
						<?php 
					}
					?>
				</table>
			</div>
		</div>
		<?php } ?>

	</div>

<?php include 'footer.php'; ?>