/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.5.9-MariaDB-log : Database - db_gis_astar
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_gis_astar` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `tb_jenistps` */

DROP TABLE IF EXISTS `tb_jenistps`;

CREATE TABLE `tb_jenistps` (
  `id_jenistps` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenistps` varchar(128) NOT NULL,
  `marker` varchar(128) NOT NULL,
  PRIMARY KEY (`id_jenistps`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jenistps` */

insert  into `tb_jenistps`(`id_jenistps`,`nama_jenistps`,`marker`) values 
(3,'Tps Kecil','default_marker.png');

/*Table structure for table `tb_kontak` */

DROP TABLE IF EXISTS `tb_kontak`;

CREATE TABLE `tb_kontak` (
  `id_kontak` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `pesan` text NOT NULL,
  PRIMARY KEY (`id_kontak`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kontak` */

insert  into `tb_kontak`(`id_kontak`,`nama`,`email`,`pesan`) values 
(3,'vanrezky sadewa','vanrezksadewa1@gmail.com','inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach. inappropriate behavior is often laughed.');

/*Table structure for table `tb_log` */

DROP TABLE IF EXISTS `tb_log`;

CREATE TABLE `tb_log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `log_time` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `log_user` varchar(255) DEFAULT NULL,
  `log_tipe` int(11) DEFAULT NULL,
  `log_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=latin1;

/*Data for the table `tb_log` */

insert  into `tb_log`(`id_log`,`log_time`,`log_user`,`log_tipe`,`log_desc`) values 
(1,'2020-05-18 21:16:33','1',3,'Edit Data User Administrator Aplikasi '),
(2,'2020-05-18 21:20:03','1',0,'Admin Berhasil Masuk Aplikasi '),
(3,'2020-05-18 22:00:59','1',3,'Edit Data User Administrator Aplikasi '),
(4,'2020-05-18 23:16:25',NULL,1,'Keluar Dari Aplikasi '),
(5,'2020-05-18 23:16:29','1',0,'Admin Berhasil Masuk Aplikasi '),
(6,'2020-05-18 23:19:11','1',1,'Keluar Dari Aplikasi '),
(7,'2020-05-18 23:19:16','1',0,'Admin Berhasil Masuk Aplikasi '),
(8,'2020-05-19 10:49:01','1',0,'Admin Berhasil Masuk Aplikasi '),
(9,'2020-05-19 11:14:02','1',3,'Edit Data User Administrator Aplikasi '),
(10,'2020-05-19 11:15:09','1',3,'Edit Data User Administrator Aplikasi '),
(11,'2020-05-19 11:30:19','1',3,'Edit Nama Administrator Aplikasi '),
(12,'2020-05-19 11:30:36','1',3,'Edit Nama Administrator Aplikasi '),
(13,'2020-05-19 11:30:36','1',1,'Keluar Dari Aplikasi '),
(14,'2020-05-19 11:33:41','1',0,'Admin Berhasil Masuk Aplikasi '),
(15,'2020-05-19 11:33:51','1',3,'Edit Nama Administrator Aplikasi '),
(16,'2020-05-19 11:33:54','1',1,'Keluar Dari Aplikasi '),
(17,'2020-05-19 11:36:54','1',0,'Admin Berhasil Masuk Aplikasi '),
(18,'2020-05-19 11:55:06','1',1,'Keluar Dari Aplikasi '),
(19,'2020-05-19 11:55:13','1',0,'Admin Berhasil Masuk Aplikasi '),
(20,'2020-05-19 11:57:01','1',1,'Keluar Dari Aplikasi '),
(21,'2020-05-19 11:57:06','1',0,'Admin Berhasil Masuk Aplikasi '),
(22,'2020-05-19 11:57:25','1',1,'Keluar Dari Aplikasi '),
(23,'2020-05-19 11:57:30','1',0,'Admin Berhasil Masuk Aplikasi '),
(24,'2020-05-19 12:22:04',NULL,1,'Keluar Dari Aplikasi '),
(25,'2020-05-19 12:22:43','1',0,'Admin Berhasil Masuk Aplikasi '),
(26,'2020-05-19 12:23:35','1',3,'Edit Nama Administrator Aplikasi '),
(27,'2020-05-19 12:23:37','1',1,'Keluar Dari Aplikasi '),
(28,'2020-05-19 12:23:47','1',0,'Admin Berhasil Masuk Aplikasi '),
(29,'2020-05-19 12:33:50','1',3,'Edit Nama Administrator Aplikasi '),
(30,'2020-05-19 12:33:53','1',1,'Keluar Dari Aplikasi '),
(31,'2020-05-19 12:38:09','1',0,'Admin Berhasil Masuk Aplikasi '),
(32,'2020-05-19 12:40:18','1',1,'Keluar Dari Aplikasi '),
(33,'2020-05-19 12:40:30','1',0,'Admin Berhasil Masuk Aplikasi '),
(34,'2020-05-19 13:25:18','1',2,'Menambahkan Data Petugas '),
(35,'2020-05-19 13:25:50','1',2,'Menambahkan Data Petugas '),
(36,'2020-05-19 13:27:36','1',3,'Edit Data User Administrator Aplikasi '),
(37,'2020-05-19 13:27:45','1',3,'Edit Data User Administrator Aplikasi '),
(38,'2020-05-19 13:27:55','1',3,'Edit Data User Administrator Aplikasi '),
(39,'2020-05-19 13:37:38','1',3,'Edit Data User Administrator Aplikasi '),
(40,'2020-05-19 13:37:51','1',3,'Edit Data User Administrator Aplikasi '),
(41,'2020-05-19 13:38:12','1',3,'Edit Data User Administrator Aplikasi '),
(42,'2020-05-19 13:44:15','1',2,'Menambahkan Data Petugas '),
(43,'2020-05-19 13:44:30','1',4,'Delete Data Administrator Aplikasi'),
(44,'2020-05-19 13:55:18','1',1,'Keluar Dari Aplikasi '),
(45,'2020-05-19 13:56:25','1',0,'Admin Berhasil Masuk Aplikasi '),
(46,'2020-05-19 14:05:53','1',4,'Delete Data Petugas'),
(47,'2020-05-19 14:06:43','1',3,'Ubah Nama Petugas '),
(48,'2020-05-19 15:14:20',NULL,1,'Keluar Dari Aplikasi '),
(49,'2020-05-19 15:14:30','1',0,'Admin Berhasil Masuk Aplikasi '),
(50,'2020-05-19 16:16:26',NULL,1,'Keluar Dari Aplikasi '),
(51,'2020-05-19 16:16:33','1',0,'Admin Berhasil Masuk Aplikasi '),
(52,'2020-05-19 16:56:19',NULL,1,'Keluar Dari Aplikasi '),
(53,'2020-05-19 17:29:10','1',0,'Admin Berhasil Masuk Aplikasi '),
(54,'2020-05-19 17:44:35','1',2,'Menambahkan Data User Administrator Aplikasi '),
(55,'2020-05-19 17:45:59','1',3,'Edit Data User Administrator Aplikasi '),
(56,'2020-05-19 19:28:13','1',0,'Admin Berhasil Masuk Aplikasi '),
(57,'2020-05-19 21:19:17',NULL,1,'Keluar Dari Aplikasi '),
(58,'2020-05-19 21:19:33','1',0,'Admin Berhasil Masuk Aplikasi '),
(59,'2020-05-19 21:26:17','1',1,'Keluar Dari Aplikasi '),
(60,'2020-05-19 21:48:38','1',0,'Admin Berhasil Masuk Aplikasi '),
(61,'2020-05-19 21:49:03','1',2,'Menambahkan Data Petugas '),
(62,'2020-05-19 21:49:16','1',1,'Keluar Dari Aplikasi '),
(63,'2020-05-19 21:49:23','11',0,'Petugas Berhasil Masuk Aplikasi '),
(64,'2020-05-19 21:52:11','11',1,'Keluar Dari Aplikasi '),
(65,'2020-05-19 21:52:36','11',0,'Petugas Berhasil Masuk Aplikasi '),
(66,'2020-05-19 22:02:21','11',1,'Keluar Dari Aplikasi '),
(67,'2020-05-19 22:02:35','11',0,'Petugas Berhasil Masuk Aplikasi '),
(68,'2020-05-19 22:02:45','11',1,'Keluar Dari Aplikasi'),
(69,'2020-05-19 22:03:14','11',0,'Petugas Berhasil Masuk Aplikasi '),
(70,'2020-05-19 22:03:56','11',1,'Keluar Dari Aplikasi '),
(71,'2020-05-19 22:04:11','11',0,'Petugas Berhasil Masuk Aplikasi '),
(72,'2020-05-19 22:16:00','11',1,'Keluar Dari Aplikasi '),
(73,'2020-05-19 22:16:58','11',0,'Petugas Berhasil Masuk Aplikasi '),
(74,'2020-05-19 22:17:29','11',1,'Keluar Dari Aplikasi '),
(75,'2020-05-19 22:18:03','11',0,'Petugas Berhasil Masuk Aplikasi '),
(76,'2020-05-19 22:29:57','11',3,'Ubah Nama Petugas '),
(77,'2020-05-19 22:30:14','11',1,'Keluar Dari Aplikasi '),
(78,'2020-05-19 22:31:00','11',0,'Petugas Berhasil Masuk Aplikasi '),
(79,'2020-05-19 22:31:35','11',1,'Keluar Dari Aplikasi '),
(80,'2020-05-19 22:31:41','11',0,'Petugas Berhasil Masuk Aplikasi '),
(81,'2020-05-19 22:31:50','11',1,'Keluar Dari Aplikasi '),
(82,'2020-05-19 22:32:53','11',0,'Petugas Berhasil Masuk Aplikasi '),
(83,'2020-05-19 22:50:49','11',1,'Keluar Dari Aplikasi '),
(84,'2020-05-19 22:50:52','1',0,'Admin Berhasil Masuk Aplikasi '),
(85,'2020-05-19 22:51:33','1',1,'Keluar Dari Aplikasi '),
(86,'2020-05-19 22:51:37','1',0,'Admin Berhasil Masuk Aplikasi '),
(87,'2020-05-19 22:56:21','1',1,'Keluar Dari Aplikasi '),
(88,'2020-05-19 22:56:35','11',0,'Petugas Berhasil Masuk Aplikasi '),
(89,'2020-05-19 23:22:20','11',1,'Keluar Dari Aplikasi '),
(90,'2020-05-19 23:22:47','1',0,'Admin Berhasil Masuk Aplikasi '),
(91,'2020-05-19 23:23:42','1',1,'Keluar Dari Aplikasi '),
(92,'2020-05-19 23:54:23','1',0,'Admin Berhasil Masuk Aplikasi '),
(93,'2020-05-20 10:43:08','1',0,'Admin Berhasil Masuk Aplikasi '),
(94,'2020-05-20 10:43:20','1',1,'Keluar Dari Aplikasi '),
(95,'2020-05-20 10:43:47','1',0,'Admin Berhasil Masuk Aplikasi '),
(96,'2020-05-20 10:45:21','1',1,'Keluar Dari Aplikasi '),
(97,'2020-05-20 10:45:26','11',0,'Petugas Berhasil Masuk Aplikasi '),
(98,'2020-05-20 11:03:21','11',1,'Keluar Dari Aplikasi '),
(99,'2020-05-20 11:03:27','1',0,'Admin Berhasil Masuk Aplikasi '),
(100,'2020-05-20 15:08:53',NULL,1,'Keluar Dari Aplikasi '),
(101,'2020-05-20 15:08:57','1',0,'Admin Berhasil Masuk Aplikasi '),
(102,'2020-05-20 15:12:59','1',0,'Admin Berhasil Masuk Aplikasi '),
(103,'2020-05-20 15:28:18','1',1,'Keluar Dari Aplikasi '),
(104,'2020-05-20 15:48:14','1',0,'Admin Berhasil Masuk Aplikasi '),
(105,'2020-05-20 17:20:01',NULL,1,'Keluar Dari Aplikasi '),
(106,'2020-05-20 17:20:05','1',0,'Admin Berhasil Masuk Aplikasi '),
(107,'2020-05-20 17:41:05',NULL,1,'Keluar Dari Aplikasi '),
(108,'2020-05-20 17:41:09','1',0,'Admin Berhasil Masuk Aplikasi '),
(109,'2020-05-20 18:24:29',NULL,1,'Keluar Dari Aplikasi '),
(110,'2020-05-20 18:24:33','1',0,'Admin Berhasil Masuk Aplikasi '),
(111,'2020-05-20 19:29:16','1',2,'Menambahkan Data Costumer '),
(112,'2020-05-20 19:32:59','1',2,'Menambahkan Data Costumer '),
(113,'2020-05-20 19:34:13','1',2,'Menambahkan Data Costumer '),
(114,'2020-05-20 19:35:07','1',2,'Menambahkan Data Costumer '),
(115,'2020-05-20 19:36:16','1',2,'Menambahkan Data Costumer '),
(116,'2020-05-20 19:38:17','1',2,'Menambahkan Data Costumer '),
(117,'2020-05-20 19:40:49','1',2,'Menambahkan Data Costumer '),
(118,'2020-05-20 19:41:39','1',2,'Menambahkan Data Costumer '),
(119,'2020-05-20 19:44:32','1',2,'Menambahkan Data Costumer '),
(120,'2020-05-20 20:28:01','1',3,' Update Data Costumer'),
(121,'2020-05-20 21:24:52',NULL,1,'Keluar Dari Aplikasi '),
(122,'2020-05-20 21:24:56','1',0,'Admin Berhasil Masuk Aplikasi '),
(123,'2020-05-20 22:19:22','1',1,'Keluar Dari Aplikasi '),
(124,'2020-05-20 22:19:35','11',0,'Petugas Berhasil Masuk Aplikasi '),
(125,'2020-05-20 22:28:55','11',1,'Keluar Dari Aplikasi '),
(126,'2020-05-20 22:31:59','11',0,'Petugas Berhasil Masuk Aplikasi '),
(127,'2020-05-20 22:35:59','11',1,'Keluar Dari Aplikasi'),
(128,'2020-05-20 22:36:53','11',0,'Petugas Berhasil Masuk Aplikasi '),
(129,'2020-05-20 22:38:24','11',1,'Keluar Dari Aplikasi '),
(130,'2020-05-20 22:38:29','1',0,'Admin Berhasil Masuk Aplikasi '),
(131,'2020-05-20 23:02:07','1',2,'Menambahkan Data Costumer '),
(132,'2020-05-20 23:02:51','1',1,'Keluar Dari Aplikasi '),
(133,'2020-05-20 23:03:01','11',0,'Petugas Berhasil Masuk Aplikasi '),
(134,'2020-05-20 23:35:40','11',1,'Keluar Dari Aplikasi '),
(135,'2020-05-20 23:35:44','1',0,'Admin Berhasil Masuk Aplikasi '),
(136,'2020-05-20 23:37:17','1',1,'Keluar Dari Aplikasi '),
(137,'2020-05-20 23:37:56','1',0,'Admin Berhasil Masuk Aplikasi '),
(138,'2020-05-20 23:38:33','1',1,'Keluar Dari Aplikasi '),
(139,'2020-05-20 23:38:40','11',0,'Petugas Berhasil Masuk Aplikasi '),
(140,'2020-06-20 19:47:17','1',0,'Admin Berhasil Masuk Aplikasi '),
(141,'2020-06-21 19:08:56','1',0,'Admin Berhasil Masuk Aplikasi '),
(142,'2020-06-21 23:25:54','1',0,'Admin Berhasil Masuk Aplikasi '),
(143,'2020-06-22 10:35:46','1',0,'Admin Berhasil Masuk Aplikasi '),
(144,'2020-07-01 10:58:32','1',0,'Admin Berhasil Masuk Aplikasi '),
(145,'2020-07-07 11:44:36','1',0,'Admin Berhasil Masuk Aplikasi '),
(146,'2020-07-07 11:47:37','1',1,'Keluar Dari Aplikasi '),
(147,'2020-11-09 22:53:54','1',0,'Admin Berhasil Masuk Aplikasi '),
(148,'2020-11-09 23:09:20','1',1,'Keluar Dari Aplikasi '),
(149,'2020-11-20 20:06:30','1',0,'Admin Berhasil Masuk Aplikasi '),
(150,'2020-11-20 20:12:50','1',3,'Edit Data User Administrator Aplikasi '),
(151,'2020-11-20 20:12:56','1',1,'Keluar Dari Aplikasi '),
(152,'2020-11-20 20:13:02','6',0,'Petugas Berhasil Masuk Aplikasi '),
(153,'2020-11-20 20:31:58','1',0,'Admin Berhasil Masuk Aplikasi '),
(154,'2020-11-25 21:49:41','1',0,'Admin Berhasil Masuk Aplikasi '),
(155,'2020-12-06 23:35:33','1',0,'Admin Berhasil Masuk Aplikasi '),
(156,'2021-04-08 16:42:22','1',0,'Admin Berhasil Masuk Aplikasi '),
(157,'2021-04-21 21:09:09','1',0,'Admin Berhasil Masuk Aplikasi '),
(158,'2021-04-22 08:49:09',NULL,1,'Keluar Dari Aplikasi '),
(159,'2021-04-22 09:02:10',NULL,1,'Keluar Dari Aplikasi '),
(160,'2021-04-22 09:02:13',NULL,1,'Keluar Dari Aplikasi '),
(161,'2021-04-24 09:31:52','1',0,'Admin Berhasil Masuk Aplikasi '),
(162,'2021-04-24 12:01:51',NULL,1,'Keluar Dari Aplikasi '),
(163,'2021-04-24 15:29:09',NULL,1,'Keluar Dari Aplikasi '),
(164,'2021-04-29 22:05:03',NULL,1,'Keluar Dari Aplikasi'),
(165,'2021-04-29 22:07:13',NULL,1,'Keluar Dari Aplikasi '),
(166,'2021-05-02 16:50:16',NULL,1,'Keluar Dari Aplikasi');

/*Table structure for table `tb_menu` */

DROP TABLE IF EXISTS `tb_menu`;

CREATE TABLE `tb_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(100) NOT NULL,
  `icon_menu` varchar(50) NOT NULL,
  `url_menu` varchar(128) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tb_menu` */

insert  into `tb_menu`(`id_menu`,`nama_menu`,`icon_menu`,`url_menu`) values 
(1,'Dashboard','fas fa-fw fa-tachometer-alt','dashboard'),
(2,'Master Data','fas fa-fw fa-database','#'),
(3,'Data TPS','fas fa-fw fa-book','tps'),
(4,'Jenis TPS','fas fa-fw fa-book','tps/jenis'),
(5,'Pengguna','fas fa-fw fa-users','pengguna'),
(6,'Pengaturan','fas fa-fw fa-cog','pengaturan'),
(7,'Kontak / Kritik','fas fa-fw fa-address-book','kontak');

/*Table structure for table `tb_menugroup` */

DROP TABLE IF EXISTS `tb_menugroup`;

CREATE TABLE `tb_menugroup` (
  `id_menugroup` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `role` enum('admin','operator','frontend') NOT NULL DEFAULT 'admin',
  `parent_menu` int(11) NOT NULL DEFAULT 0,
  `urutan_menu` int(11) NOT NULL,
  PRIMARY KEY (`id_menugroup`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tb_menugroup` */

insert  into `tb_menugroup`(`id_menugroup`,`id_menu`,`role`,`parent_menu`,`urutan_menu`) values 
(1,2,'admin',0,1),
(2,3,'admin',2,1),
(3,4,'admin',2,2),
(4,5,'admin',0,2),
(5,6,'admin',0,4),
(6,7,'admin',0,3);

/*Table structure for table `tb_pengaturan` */

DROP TABLE IF EXISTS `tb_pengaturan`;

CREATE TABLE `tb_pengaturan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_website` varchar(255) NOT NULL,
  `nama_singkat` varchar(128) DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `zoom` tinyint(4) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `center_map_lat` varchar(25) DEFAULT NULL,
  `center_map_lng` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pengaturan` */

insert  into `tb_pengaturan`(`id`,`nama_website`,`nama_singkat`,`deskripsi`,`zoom`,`logo`,`center_map_lat`,`center_map_lng`) values 
(1,'TPS Pekanbaru',NULL,'Sistem informasi Geografis (GIS) Tempat Pembuangan sampah yang mencakup kota pekanbaru yang terdiri dari 15 kecamatan',12,'49a1534efc60f781550e8c4362421e95.png','0.5415129365016328','101.43967120474854');

/*Table structure for table `tb_tps` */

DROP TABLE IF EXISTS `tb_tps`;

CREATE TABLE `tb_tps` (
  `id_tps` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenistps` int(11) NOT NULL,
  `nama_tps` varchar(254) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `gambar` varchar(100) DEFAULT 'default.jpg',
  `lat` varchar(25) NOT NULL,
  `lng` varchar(25) NOT NULL,
  `dilihat` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_tps`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tb_tps` */

insert  into `tb_tps`(`id_tps`,`id_jenistps`,`nama_tps`,`keterangan`,`alamat`,`telp`,`gambar`,`lat`,`lng`,`dilihat`,`created_at`,`updated_at`) values 
(5,3,'TPS Jalan Satria.','TPS di Jalan Indrapuri Kecamatan Tampan','TPS di Jalan Indrapuri Kecamatan Tampan','13321','a7271d9a8c0e114bbde262cd55a3b5e0.jpg','0.566316846105612','101.43134562796631',6,'2021-05-03 20:55:42','2021-05-24 22:30:42'),
(8,3,'TPS di samping perindustrian, Jalan Hangtuah','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','TPS di samping perindustrian, Jalan Hangtuah Tampan','08215123','37d3743000aa9e54214d79021753e12b.jpg','0.5271798349054337','101.43855540579834',32,'2021-05-03 22:16:47','2021-05-24 22:30:31'),
(9,3,'TPS di Jalan Harapan Jaya','Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak.','TPS di Jalan Harapan Jaya TPS Ilegal','0125213','45e726e252e4ab7f533ad29bfab1f79c.jpeg','0.49944245113495384','101.41576051712036',95,'2021-05-03 22:17:54','2021-05-24 22:29:16');

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(125) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `role` enum('admin','operator') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id_user`,`username`,`password`,`nama`,`role`,`created_at`,`updated_at`,`last_login`) values 
(1,'admin','$2y$10$.TyLHkN6iDi0J.f2jSxnAuhnPUigSKyOaQ/4.iR8Tar6OTL7juKGi','Lala','admin','2021-04-24 02:31:52','2021-04-24 02:31:52','2021-05-26 23:40:04'),
(12,'vanrezky','$2y$10$u.TxCoIdlvV7pyujWIS/mekkfeqkjA9jZ2W7cMoMpXVftDJ14xFMK','Vanrezky','admin','2021-05-05 23:29:30','2021-05-05 23:36:56','2021-05-05 23:52:02'),
(13,'rezki','$2y$10$jVFvQfJfnL0zgYKw3O1sgufAPgZI04wWeRnSd5FZJYQaG5stHT53.','Iki','admin','2021-05-05 23:40:37','2021-05-05 23:41:36',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
