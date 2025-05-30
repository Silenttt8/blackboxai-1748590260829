<?php
include 'header.php';
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "Produk tidak ditemukan.";
    exit;
}

$produk_id = intval($_GET['id']);
$query = "SELECT * FROM produk WHERE produk_id = $produk_id";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    echo "Produk tidak ditemukan.";
    exit;
}

$produk = mysqli_fetch_assoc($result);
?>
<div class="container">
    <h3><?php echo htmlspecialchars($produk['nama']); ?></h3>
    <div class="row">
        <div class="col-md-6">
            <?php if ($produk['gambar']) { ?>
                <img src="gambar/<?php echo htmlspecialchars($produk['gambar']); ?>" alt="<?php echo htmlspecialchars($produk['nama']); ?>" class="img-responsive" style="max-height:400px;">
            <?php } else { ?>
                <img src="gambar/no-image.png" alt="No Image" class="img-responsive" style="max-height:400px;">
            <?php } ?>
        </div>
        <div class="col-md-6">
            <h4>Harga: Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></h4>
            <p><?php echo nl2br(htmlspecialchars($produk['deskripsi'])); ?></p>
            <p>Stok: <?php echo intval($produk['stok']); ?></p>
            <a href="cart_add.php?id=<?php echo $produk['produk_id']; ?>" class="btn btn-success">Tambah ke Keranjang</a>
            <a href="produk.php" class="btn btn-default">Kembali ke Produk</a>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
