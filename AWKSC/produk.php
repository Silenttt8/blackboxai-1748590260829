<?php
	include 'header.php';
	include 'koneksi.php';

	// Query semua produk
	$query = "SELECT * FROM produk ORDER BY produk_id DESC";
	$result = mysqli_query($koneksi, $query);
?>
<div class="container">
	<div class="alert alert-info text-center">
		<h4><b>Daftar Produk</b></h4>
	</div>

	<div class="row">
		<?php while($produk = mysqli_fetch_assoc($result)) { ?>
			<div class="col-md-3">
				<div class="thumbnail">
					<?php if($produk['gambar']) { ?>
						<img src="gambar/<?php echo htmlspecialchars($produk['gambar']); ?>" alt="<?php echo htmlspecialchars($produk['nama']); ?>" style="height:200px; width:100%; object-fit:cover;">
					<?php } else { ?>
						<img src="gambar/no-image.png" alt="No Image" style="height:200px; width:100%; object-fit:cover;">
					<?php } ?>
					<div class="caption">
						<h4><?php echo htmlspecialchars($produk['nama']); ?></h4>
						<p>Harga: Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
						<p>
							<a href="produk_detail.php?id=<?php echo $produk['produk_id']; ?>" class="btn btn-primary" role="button">Detail</a>
							<a href="cart_add.php?id=<?php echo $produk['produk_id']; ?>" class="btn btn-success" role="button">Tambah ke Keranjang</a>
						</p>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<?php include 'footer.php'; ?>
