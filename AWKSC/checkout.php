<?php
session_start();
include 'header.php';
include 'koneksi.php';

// Check if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<div class='container'><h3>Keranjang belanja kosong.</h3><a href='produk.php' class='btn btn-primary'>Lanjutkan Belanja</a></div>";
    include 'footer.php';
    exit;
}

// Fetch product details for items in cart
$cart_items = array();
$total_price = 0;
$ids = implode(',', array_keys($_SESSION['cart']));
$query = "SELECT * FROM produk WHERE produk_id IN ($ids)";
$result = mysqli_query($koneksi, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $row['quantity'] = $_SESSION['cart'][$row['produk_id']];
    $row['subtotal'] = $row['harga'] * $row['quantity'];
    $total_price += $row['subtotal'];
    $cart_items[] = $row;
}

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);
    $telepon = trim($_POST['telepon']);

    if (empty($nama)) {
        $errors[] = "Nama harus diisi.";
    }
    if (empty($alamat)) {
        $errors[] = "Alamat harus diisi.";
    }
    if (empty($telepon)) {
        $errors[] = "Telepon harus diisi.";
    }

    if (empty($errors)) {
        // Simulate order processing
        // In real app, save order to database

        // Clear cart
        $_SESSION['cart'] = array();
        $success = true;
    }
}
?>

<div class="container">
    <h3>Checkout</h3>

    <?php if ($success) { ?>
        <div class="alert alert-success">Terima kasih! Pesanan Anda telah diterima.</div>
        <a href="produk.php" class="btn btn-primary">Lanjutkan Belanja</a>
    <?php } else { ?>
        <?php if (!empty($errors)) { ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>

        <h4>Ringkasan Pesanan</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $item) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nama']); ?></td>
                        <td>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>Rp <?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="3" class="text-right"><strong>Total</strong></td>
                    <td><strong>Rp <?php echo number_format($total_price, 0, ',', '.'); ?></strong></td>
                </tr>
            </tbody>
        </table>

        <h4>Data Pengiriman</h4>
        <form method="post" action="checkout.php">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?php echo isset($nama) ? htmlspecialchars($nama) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" required><?php echo isset($alamat) ? htmlspecialchars($alamat) : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" name="telepon" id="telepon" class="form-control" value="<?php echo isset($telepon) ? htmlspecialchars($telepon) : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Selesaikan Pembelian</button>
        </form>
    <?php } ?>
</div>

<?php include 'footer.php'; ?>
