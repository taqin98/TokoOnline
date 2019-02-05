# Host: localhost  (Version 5.5.5-10.1.36-MariaDB)
# Date: 2019-01-26 11:02:52
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "admin"
#

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `nama_lengkap` varchar(255) NOT NULL DEFAULT '',
  `id_prov_toko` varchar(255) DEFAULT NULL,
  `id_kota_toko` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "admin"
#

INSERT INTO `admin` VALUES (1,'admin','admin','Nurul Muttaqin','10','163'),(2,'paijo98','paijo98','',NULL,NULL);

#
# Structure for table "kategori"
#

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(200) NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

#
# Data for table "kategori"
#

INSERT INTO `kategori` VALUES (1,'Kaos'),(2,'Tas'),(5,'Sepatu'),(6,'Tenda'),(7,'alat');

#
# Structure for table "ongkir"
#

DROP TABLE IF EXISTS `ongkir`;
CREATE TABLE `ongkir` (
  `kode_ongkir` varchar(5) NOT NULL DEFAULT '',
  `nama_jasa` varchar(100) NOT NULL DEFAULT '',
  `servis` varchar(255) DEFAULT NULL,
  `est` varchar(255) DEFAULT NULL,
  `tarif` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_ongkir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "ongkir"
#

INSERT INTO `ongkir` VALUES ('jne','jne',NULL,NULL,'13000'),('pos','pos',NULL,NULL,'12000'),('tiki','tiki',NULL,NULL,'17000');

#
# Structure for table "pelanggan"
#

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL,
  `id_prov` varchar(255) DEFAULT NULL,
  `id_kota` varchar(255) DEFAULT NULL,
  `alamat_pelanggan` text NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

#
# Data for table "pelanggan"
#

INSERT INTO `pelanggan` VALUES (10,'taqinjunior56@gmail.com','taqin98','Nurul Muttaqin','44444','10','163','kuwasen'),(11,'karnadikarnadia@gmail.com','edo123','Edo Karnadi','3434366666','10','92','ererererxxxxxxxxxx'),(12,'dimasjdk@gmail.com','dimas123','Dimas Adtya','87878','10','92','jhjhjh'),(13,'angga@gmail.com','angga123','Syahrul Angga','878787','10','399','dfdfdf');

#
# Structure for table "pembelian"
#

DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NOT NULL,
  `kode_ongkir` varchar(5) NOT NULL DEFAULT '0',
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_jasa` varchar(100) NOT NULL DEFAULT '',
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `kode_promo` varchar(255) DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pembelian`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=latin1;

#
# Data for table "pembelian"
#

INSERT INTO `pembelian` VALUES (139,11,'jne','2019-01-23',537000,'jne',13000,'ererererxxxxxxxxxx','promo20',0),(140,10,'pos','2019-01-23',217000,'pos',7000,'kuwasen','',0),(141,12,'pos','2019-01-23',119000,'pos',14000,'fgfgfgg','',0);

#
# Structure for table "pembelian_produk"
#

DROP TABLE IF EXISTS `pembelian_produk`;
CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `sub_id` varchar(50) NOT NULL DEFAULT '',
  `brand` varchar(50) NOT NULL,
  `subharga` int(11) NOT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `resi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pembelian_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=latin1;

#
# Data for table "pembelian_produk"
#

INSERT INTO `pembelian_produk` VALUES (161,139,21,1,'Angelica 55',655000,'2','Consina',655000,'belum bayar',NULL,NULL),(162,140,18,1,'SOCHI MAROON',210000,'2','Rown',210000,'selesai','7.png','5454654654'),(163,141,27,1,'Baju Baru KUyhghg',105000,'1','Bloods',105000,'belum bayar',NULL,NULL);

#
# Structure for table "produk"
#

DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `alamat_distro` text NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `berat` varchar(255) DEFAULT NULL,
  `sub_id` varchar(100) NOT NULL DEFAULT '',
  `brand` varchar(50) NOT NULL,
  `foto_produk` varchar(50) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

#
# Data for table "produk"
#

INSERT INTO `produk` VALUES (15,'','VORSA',265000,5,'500','0','Throox','VORSA.jpg','Available Size S M L XL\r\nall info \r\n- Line : @throoxorg\r\n- Wa : 081393444144\r\n- BBM : 5A1A5844\r\n- Fb : throoxoriginal\r\n'),(16,'','GORJI BLUE NAVY',325000,5,'500','0','Throoxx','GORJI BLUE NAVY.jpg','<p>Available Size S M L XL all info - Line : @throoxorg - Wa : 081393444144 - BBM : 5A1A5844 - Fb : throoxoriginaL</p>\r\n'),(17,'','GORJI OLIVE BLACK',325000,5,'500','0','Throox','GORJI OLIVE BLACK.jpg','Available Size S M L XL\r\nall info \r\n- Line : @throoxorg\r\n- Wa : 081393444144\r\n- BBM : 5A1A5844\r\n- Fb : throoxoriginal\r\n'),(18,'','SOCHI MAROON',210000,53,'500','2','Rown','consinaxxx.jpg','<p>Bacgpack with zipper pocket and padded laptop place inside. Size length x width x height = 28 x 13 x 45 cm</p>\r\n'),(19,'','Consina Alphine 55',505000,97,'500','2','Rown','consina Alphine 55.jpg','<p>Consina Alphine 55</p>\r\n\r\n<p>Bacgpack with zipper pocket and padded laptop place inside. Size length x width x height = 28 x 13 x 45 cm</p>\r\n'),(20,'','PIRHO',240000,5,'500','0','Argh','PIRHO.jpg','Colour : Gold\r\nAvailable size : S,M,L,XL\r\n'),(21,'','Angelica 55',655000,-1,'500','2','Consina','angelica-60-gr-800x800.jpg','<p>Nama Produk : Angelica 55</p>\r\n\r\n<p>Model : Carier</p>\r\n\r\n<p>Kapasotas : 60L</p>\r\n\r\n<p>Color : Navy Include Rain Cover</p>\r\n'),(22,'','SPOTTING',280000,5,'500','0','Argh','SPOTTING.jpg','Color : black\r\nAvailable size : M,L,XL'),(23,'','INFINITY',240000,0,'500','2','Argh','INFINITY.jpg','Color : Red Black\r\nInclude Notebook Slot up to 16 inch.'),(24,'','BL PACKO 02',125000,5,'500','0','Bloods','BL PACKO 02.jpg','warna : coklat\r\npanjang : 130 cm'),(25,'','HT CERIBE',105000,5,'500','0','Bloods','HT CERIBE.jpg','-'),(26,'','Roses Field Pouch',95000,5,'500','0','Prigel','Roses Field Pouch.jpg','-'),(27,'','Kaos Kelinci',105000,100,'500','1','Bloods','lala.jpg','<p>baju baguus</p>\r\n'),(29,'','Arei R139 309 Carrier Toba 60L',499000,100,'1500','5','Arei','Arei R139309-Toba-60L.jpg','<ul>\r\n\t<li>Deskripsi 1</li>\r\n\t<li>Deskripsi 2</li>\r\n\t<li>Deskripsi 3</li>\r\n\t<li>Deskripsi 4</li>\r\n</ul>\r\n');

#
# Structure for table "promo"
#

DROP TABLE IF EXISTS `promo`;
CREATE TABLE `promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto` text,
  `kode_promo` varchar(255) DEFAULT NULL,
  `judul_promo` varchar(255) DEFAULT NULL,
  `desc_promo` text,
  `diskon` varchar(255) DEFAULT NULL,
  `tgl` varchar(255) DEFAULT NULL,
  `used` varchar(11) DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

#
# Data for table "promo"
#

INSERT INTO `promo` VALUES (4,'Daun-Pletekan.jpg','ELEK212','bbbbb','jjhjhjh','80','11/07/2018 - 11/15/2018',NULL,'checked'),(7,'promo1.png','promo20','Promo Sale 20','promo 20','20','01/07/2019 - 01/10/2019',NULL,NULL);

#
# Structure for table "slider"
#

DROP TABLE IF EXISTS `slider`;
CREATE TABLE `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_upload` date DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "slider"
#

INSERT INTO `slider` VALUES (1,'2019-01-11','mainbannerdes.jpg','265279','image/jpeg','Distroku'),(3,'2019-01-11','slider1.jpg','231042','image/jpeg','Slider 3ddddddddddfffffxxxxxx');

#
# Structure for table "sub_kategori"
#

DROP TABLE IF EXISTS `sub_kategori`;
CREATE TABLE `sub_kategori` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_id` varchar(255) DEFAULT NULL,
  `sub_nama` varchar(100) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

#
# Data for table "sub_kategori"
#

INSERT INTO `sub_kategori` VALUES (1,'1','Kaos Distro'),(2,'2','Carier Consina'),(5,'2','Carier Rei'),(6,'6','Tenda Avtech'),(7,'2','Carier Eiger'),(8,'5','Sepatu Eiger'),(9,'5','Sepatu Arei'),(10,'1','Kaos Eiger');
