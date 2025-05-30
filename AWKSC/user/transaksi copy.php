<?php include 'header.php'; ?>

<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>History Transaksi  <b> <?php echo $_SESSION['username']; ?> </b> </h4>
		</div>
		<div class="panel-body">

			<a href="transaksi_tambah.php" class="btn btn-sm btn-info pull-left">Transaksi Baru</a>
			
			<br/>
			<br/>

			<table class="table table-bordered table-striped">
				<tr>
					<th width="1%">No</th>
					<th>Invoice</th>
					<th>Tanggal Hari ini</th>
					<th>Tanggal</th>
					<th>Pelanggan</th>
					<th>Jam Mulai</th>
					<th>Durasi </th>
					<th>Jam Selesai </th>
					<th>Harga</th>
					<th>Status</th>				
					<th>OPSI</th>
				</tr>

				<?php 
				// koneksi database
				include '../koneksi.php';
				// mengambil data pelanggan dari database
				$nama=$_SESSION['username'];
				$data = mysqli_query($koneksi,"SELECT * from transaksi where transaksi_pelanggan='$nama' order by transaksi_id desc");
				$no = 1;
				// mengubah data ke array dan menampilkannya dengan perulangan while
				while($d=mysqli_fetch_array($data)){
					?>
	
					<tr>
						<td><?php echo $no++; ?></td>
						<td>INVOICE-<?php echo $d['transaksi_id']; ?></td>
						<td><?php echo $d['transaksi_jam_pemesanan']; ?></td>
						<td><?php echo $d['transaksi_tgl']; ?></td>
						<td><?php echo $d['transaksi_pelanggan']; ?></td>
						<td><?php echo $d['jam_mulai']; ?></td>
						<td><?php echo $d['transaksi_durasi']; ?></td>
						<td><?php echo $d['transaksi_jam_selesai']; ?></td>
						<td><?php echo "Rp. ".number_format($d['transaksi_harga']) ." ,-"; ?></td>
						<td>
							<?php 
							if($d['transaksi_lap']=="0"){
								echo "<div>booking</div>";
							}else if($d['transaksi_lap']=="1"){
								echo "<div >selesai</div>";
							}
							?>		
						<td>
							<a href="transaksi_invoice.php?id=<?php echo $d['transaksi_id']; ?>" target="_blank" class="btn btn-sm btn-warning">Cetak Invoice</a>
							<a href="transaksi_hapus.php?id=<?php echo $d['transaksi_id']; ?>" class="btn btn-sm btn-danger">Batalkan</a>
						</td>
					</tr>
					<?php 
				}
				?>
			</table>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>