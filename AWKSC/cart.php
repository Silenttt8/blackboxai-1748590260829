<?php
session_start();
include 'header.php';
include 'koneksi.php';

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Handle update quantity or remove actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        foreach ($_POST['quantities'] as $produk_id => $qty) {
            if ($qty <= 0) {
                unset($_SESSION['cart'][$produk_id]);
            } else {
                $_SESSION['cart'][$produk_id] = $qty;
            }
        }
    }
    if (isset($_POST['clear'])) {
        $_SESSION['cart'] = array();
    }
    header('Location: cart.php');
    exit;
}

// Fetch product details for items in cart
$cart_items = array();
$total_price = 0;
if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $query = "SELECT * FROM produk WHERE produk_id IN ($ids)";
    $result = mysqli_query($koneksi, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $row['quantity'] = $_SESSION['cart'][$row['produk_id']];
        $row['subtotal'] = $row['harga'] * $row['quantity'];
        $total_price += $row['subtotal'];
        $cart_items[] = $row;
    }
}
?>
<div class="container">
    <h3>Keranjang Belanja</h3>
    <?php if (empty($cart_items)) { ?>
        <p>Keranjang belanja Anda kosong.</p>
        <a href="produk.php" class="btn btn-primary">Lanjutkan Belanja</a>
    <?php } else { ?>
        <form method="post" action="cart.php">
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
                            <td>
                                <input type="number" name="quantities[<?php echo $item['produk_id']; ?>]" value="<?php echo $item['quantity']; ?>" min="0" class="form-control" style="width: 80px;">
                            </td>
                            <td>Rp <?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3" class="text-right"><strong>Total</strong></td>
                        <td><strong>Rp <?php echo number_format($total_price, 0, ',', '.'); ?></strong></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" name="update" class="btn btn-success">Update Keranjang</button>
            <button type="submit" name="clear" class="btn btn-danger" onclick="return confirm('Yakin ingin mengosongkan keranjang?')">Kosongkan Keranjang</button>
            <a href="checkout.php" class="btn btn-primary">Checkout</a>
        </form>
    <?php } ?>
</div>
<?php include 'footer.php'; ?>
