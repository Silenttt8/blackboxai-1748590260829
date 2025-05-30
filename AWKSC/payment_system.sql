-- Check if table exists
DROP TABLE IF EXISTS `pembayaran`;

-- Table structure for table `pembayaran`
CREATE TABLE IF NOT EXISTS `pembayaran` (
`pembayaran_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) NOT NULL,
  `pembayaran_tanggal` datetime NOT NULL,
  `pembayaran_metode` varchar(50) NOT NULL,
  `pembayaran_jumlah` int(11) NOT NULL,
  `pembayaran_bukti` varchar(255) NULL,
  `pembayaran_status` enum('pending','confirmed','rejected') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`pembayaran_id`),
  KEY `transaksi_id` (`transaksi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Add constraint to link payments with transactions
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`transaksi_id`) ON DELETE CASCADE ON UPDATE CASCADE; 