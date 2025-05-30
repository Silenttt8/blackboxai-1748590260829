<?php include 'header.php'; ?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Pembayaran Digital</h4>
        </div>
        <div class="panel-body">
            <?php 
            include '../koneksi.php';
            $id = $_GET['id'];
            $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE transaksi_id='$id'");
            $t = mysqli_fetch_assoc($transaksi);

            // Check if payment already exists
            $cek_pembayaran = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE transaksi_id='$id'");
            $sudah_bayar = mysqli_num_rows($cek_pembayaran);
            
            if($sudah_bayar > 0) {
                $p = mysqli_fetch_assoc($cek_pembayaran);
                ?>
                <div class="alert alert-info">
                    <h4>Status Pembayaran: <?php echo ucfirst($p['pembayaran_status']); ?></h4>
                    <p>Tanggal: <?php echo date('d/m/Y H:i', strtotime($p['pembayaran_tanggal'])); ?></p>
                    <p>Metode: <?php echo $p['pembayaran_metode']; ?></p>
                    <p>Jumlah: Rp.<?php echo number_format($p['pembayaran_jumlah']); ?></p>
                    <?php if($p['pembayaran_status'] == 'pending'): ?>
                    <p class="text-warning">Pembayaran Anda sedang diproses oleh admin.</p>
                    <?php elseif($p['pembayaran_status'] == 'confirmed'): ?>
                    <p class="text-success">Pembayaran Anda telah dikonfirmasi.</p>
                    <?php else: ?>
                    <p class="text-danger">Pembayaran Anda ditolak. Silakan hubungi admin atau lakukan pembayaran ulang.</p>
                    <a href="pembayaran.php?id=<?php echo $id; ?>&reset=1" class="btn btn-warning">Bayar Ulang</a>
                    <?php endif; ?>
                </div>
                <?php
                if(isset($_GET['reset']) && $_GET['reset'] == 1) {
                    // Delete existing payment to allow repayment
                    mysqli_query($koneksi, "DELETE FROM pembayaran WHERE transaksi_id='$id'");
                    echo "<script>window.location='pembayaran.php?id=".$id."';</script>";
                }
            } else {
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-info">
                        <h4>Detail Transaksi</h4>
                        <table class="table">
                            <tr>
                                <th>Invoice</th>
                                <td>: INVOICE-<?php echo $t['transaksi_id']; ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>: <?php echo date('d/m/Y', strtotime($t['transaksi_tgl'])); ?></td>
                            </tr>
                            <tr>
                                <th>Jam</th>
                                <td>: <?php echo date('H:i', strtotime($t['jam_mulai'])); ?> - <?php echo date('H:i', strtotime($t['transaksi_jam_selesai'])); ?></td>
                            </tr>
                            <tr>
                                <th>Durasi</th>
                                <td>: <?php echo $t['transaksi_durasi']; ?> Jam</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>: Rp.<?php echo number_format($t['transaksi_harga']); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-md-6">
                    <form action="pembayaran_aksi.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="transaksi_id" value="<?php echo $id; ?>">
                        <input type="hidden" name="jumlah" value="<?php echo $t['transaksi_harga']; ?>">
                        
                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <select class="form-control" name="metode" required>
                                <option value="">- Pilih Metode Pembayaran -</option>
                                <option value="OVO/GoPay/DANA">OVO/GoPay/DANA</option>
                            </select>
                        </div>
                        
                        <div class="alert alert-info">
                            <strong>Informasi E-Wallet:</strong><br>
                            OVO/GoPay/DANA: 087871158404<br>
                            <small>Silahkan transfer sesuai dengan jumlah pembayaran dan upload bukti transfer.</small>
                        </div>

                        <div class="form-group">
                            <label>Bukti Pembayaran</label>
                            <input type="file" name="bukti" class="form-control" required>
                            <small class="text-muted">Upload bukti pembayaran (JPG, PNG, PDF)</small>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Kirim Pembayaran" class="btn btn-primary">
                            <a href="transaksi.php" class="btn btn-default">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?> 