/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.5.9-MariaDB-log : Database - pengaduan_puskesmas
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pengaduan_puskesmas` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `berita` */

DROP TABLE IF EXISTS `berita`;

CREATE TABLE `berita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `isi` longtext NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `berita` */

insert  into `berita`(`id`,`slug`,`judul`,`isi`,`id_kategori`,`gambar`,`created_at`,`updated_at`) values 
(2,'4-penyebab-maag-dari-penyakit-hingga-kebiasaan-sehari-hari','4 Penyebab Maag, dari Penyakit Hingga Kebiasaan Sehari-hari','<p><p style=\"margin: 15px 0px; padding: 0px;\">Maag sering dikaitkan dengan kebiasaan telat makan. Perut yang dibiarkan kosong diyakini dapat memicu produksi asam lambung berlebih sehingga menimbulkan gejala sakit maag. Padahal, penyebab maag bukan hanya akibat pola makan yang berantakan.</p><h3>Apa saja kondisi yang dapat menimbulkan sakit maag?</h3><h4>Kondisi medis penyebab maag</h4>Maag sebenarnya bukanlah suatu penyakit khusus, melainkan kumpulan gejala yang menandakan masalah atau penyakit pada sistem pencernaan. Gejalanya mencakup sakit perut, perut kembung, mual, muntah, dan sebagainya.<br>Secara umum, berikut berbagai kondisi medis yang dapat menyebabkan maag.</p><p><br><h4>1. Masalah pada saluran pencernaan</h4>Menurut National Institute of Diabetes and Digestive and Kidney Diseases, berbagai masalah pencernaan yang kerap menjadi penyebab maag adalah sebagai berikut.</p><ul><li>Gastritis (radang lambung). Gastritis merupakan peradangan pada lapisan dalam lambung akibat infeksi bakteri, asam lambung, atau penyebab lainnya.</li><li>Gastroesophageal reflux disease (GERD). GERD merupakan kondisi ketika asam lambung naik menuju kerongkongan sehingga menyebabkan nyeri pada ulu hati (heartburn) dan iritasi kerongkongan.</li><li>Irritable bowel syndrome (IBS). IBS merupakan penyakit yang membuat kontraksi otot usus besar kurang optimal sehingga berujung pada diare atau sembelit.</li><li>Tukak lambung. Tukak lambung menandakan adanya luka atau lubang kecil pada dinding perut, yang biasanya disebabkan oleh gastritis parah.</li><li>Pankreatitis. Pankreatitis merupakan kondisi ketika pankreas mengalami radang sehingga menimbulkan infeksi, kerusakan jaringan, atau bahkan perdarahan.</li><li>Kanker lambung. Kanker berawal dari pertumbuhan tumor atau sel kanker ganas pada bagian dinding lambung.</li></ul><h4>2. Infeksi bakteri penyebab maag</h4><p>Infeksi bakteri Helicobacter pylori merupakan salah satu penyebab gangguan pencernaan yang paling umum. Bakteri ini dapat menyebabkan gastritis, infeksi lambung, hingga tukak lambung akibat gastritis yang bertambah parah.</p><p><h4>3. Penyakit autoimun</h4>Meskipun terbilang langka, penyakit autoimun juga bisa menjadi penyebab maag. Penyakit autoimun terjadi ketika sistem kekebalan tubuh malah menyerang sel-sel sehat dalam tubuh Anda sendiri, bukannya melawan zat asing penyebab penyakit.<br>Dalam hal ini, sel-sel kekebalan tubuh justru menyerang lapisan dinding lambung yang sehat dan tidak bermasalah. Alhasil, sel-sel penyusun lapisan dinding lambung pun mengalami peradangan atau bahkan kerusakan.</p><p><br><h4>4. Stres dan kecemasan</h4>Stres dan kecemasan memang tidak secara langsung menyebabkan maag. Akan tetapi, kondisi ini dapat mempengaruhi kesehatan tubuh. Stres dan kecemasan yang tidak dikelola dengan baik bisa memperburuk gejala gangguan pencernaan.</p><p><p></p></p>',13,'5b1aec4e41410c2249abeaea3bf1a8aa.jpg','2021-06-05 15:57:51','2021-06-06 01:51:16'),
(3,'5-cara-mudah-mengatasi-perut-kembung-yang-cepat-dan-ampuh','5 Cara Mudah Mengatasi Perut Kembung yang Cepat dan Ampuh','<p><span style=\"font-size: 1rem;\">Tidak perlu khawatir jika perut kembung karena kebanyakan penyebabnya tidak berbahaya dan dapat membaik dengan sendirinya. Namun, Anda tetap bisa mempercepat kesembuhannya dengan cara melakukan kiat-kiat mengatasi perut kembung.</span></p><p>Apa saja cara yang bisa Anda lakukan?</p><h3>Ragam cara mengatasi perut kembung</h3><p>Perut menjadi kembung apabila ada sejumlah gas yang menumpuk di dalam sistem pencernaan seperti usus dan lambung. Kondisi ini dapat disebabkan oleh masuknya udara dari luar atau meningkatnya produksi gas di dalam usus.</p><p>Di samping menggunakan obat medis untuk mengatasi perut kembung, ada berbagai cara dan perawatan rumahan yang bisa membantu meredakan keluhannya. Berikut upaya yang dapat Anda lakukan.</p><h4>1. Sengaja kentut atau sendawa</h4><p>Jika Anda sering menahan kentut atau sendawa, sebaiknya ubah kebiasaan ini agar perut tidak lagi kembung. Kentut dan sendawa merupakan cara alami tubuh untuk meredakan perut kembung dengan cara menghilangkan kelebihan gas di dalam perut.</p><p>Jadi, bila perut Anda sudah terasa tidak nyaman, cepat-cepat cari kesempatan untuk menjauhkan diri dari orang sekitar untuk buang gas. Untuk membuat perut terasa lebih lega, Anda juga bisa mengeluarkan gas yang terperangkap dengan buang air besar.</p><h4>2. Kompres air hangat</h4><p>Jika Anda sedang punya banyak waktu luang di rumah, tidak ada salahnya mencoba cara yang satu ini untuk mengatasi perut kembung. Cukup siapkan waslap atau kain bersih, baskom, dan air hangat.</p><p>Rendam waslap atau kain bersih dalam satu baskom air hangat, lalu peras kelebihan airnya. Tempelkan kompres hangat tersebut selama 10 – 15 menit di atas perut untuk meredakan rasa nyeri dan kram.</p><p>Suhu hangat membantu melebarkan pembuluh darah sehingga darah yang membawa oksigen bisa mengalir dengan lancar. Otot-otot perut juga menjadi lebih kendur dan rileks, sehingga bisa mengurangi sakit perut, kembung, serta mengeluarkan kelebihan gas.</p><h4>3. Lebih banyak bergerak</h4><p>Saat perut terasa begah karena kembung, jangan hanya duduk diam dan membiarkan kondisi ini menjadi berlarut-larut. Lekas bangkit dari duduk, kemudian cobalah berjalan kaki sebentar kira-kira 10 – 15 menit saja.</p><p>Olahraga ringan membantu mengendurkan otot usus dan memperlancar pengeluaran gas. Kiat mengatasi perut kembung yang satu ini juga bisa melancarkan pembuangan feses. Dengan begitu, gas yang menyebabkan kembung akan ikut keluar saat buang air besar.</p><h4>4. Beri pijatan pada perut</h4><p>Bila perut Anda mulai terasa kembung dan begah, cobalah mengatasi kondisi ini dengan cara memijatnya perut. Pijatan pada perut membantu melancarkan pergerakan sistem pencernaan sekaligus menghilangkan gas di dalam perut.</p><p>Pijatan pada perut memang diyakini bisa meredakan ketidaknyamanan karena perut kembung. Akan tetapi, jika kondisi Anda tidak kunjung membaik atau pijatan malah memperparah kembung, sebaiknya hentikan pijatan dan pilih perawatan lainnya.</p><h4>5. Makan secara perlahan</h4><p>Anda dianjurkan untuk makan secara perlahan jika tidak ingin keluhan perut kembung semakin bertambah parah. Pasalnya, kebiasaan makan terlalu cepat dapat memicu masuknya banyak udara ke dalam saluran pencernaan.</p><p>Kondisi inilah yang kemudian menyebabkan perut terasa kembung, penuh, dan begah. Guna mengatasi perut yang kembung dan begah, usahakan untuk selalu mengunyah makanan dengan cara perlahan hingga makanan menjadi halus.</p>',10,'000913d220b000c1a912ef199fbf8167.jpg','2021-06-06 01:46:52','2021-06-06 01:46:52'),
(4,'nasi-vs-roti-manakah-yang-lebih-baik-untuk-menu-sarapan-anak','Nasi vs Roti: Manakah yang Lebih Baik untuk Menu Sarapan Anak?','<p>Biasanya nasi atau roti menjadi pilihan menu sarapan favorit orangtua untuk disajikan di meja makan setiap pagi. Selain penyajiannya cepat, nasi dan roti tergolong mudah untuk dikreasikan menjadi bermacam-macam masakan. Lantas kalau mau membandingkan gizi keduanya, mana yang lebih baik dijadikan menu sarapan untuk anak — nasi atau roti?</p><h3 style=\"padding: 0px; border: 0px; margin-right: 0px; margin-bottom: 1em; margin-left: 0px; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; text-size-adjust: none; vertical-align: baseline; max-width: 100%;\"><span style=\"padding: 0px; border: 0px; margin: 0px; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; text-size-adjust: none; vertical-align: baseline; max-width: 100%;\">Asupan gizi yang ideal dalam satu porsi menu sarapan anak</span></h3><p style=\"padding: 0px; border: 0px; margin-right: 0px; margin-bottom: 1em; margin-left: 0px; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; text-size-adjust: none; vertical-align: baseline; max-width: 100%;\">Sarapan memberikan pasokan energi yang dibutuhkan anak untuk melalui hari yang melelahkan. Pasalnya, sarapan pagi menyumbang hingga 20-25 % dari kebutuhan energi total per hari (standar kebutuhan kalori anak sekolah usia 7-12 tahun adalah 1.600-2.000 kalori). Sarapan pagi juga dapat membantu tubuhnya agar lebih efisien dalam mengolah makanan sebagai energi, sehingga anak lebih jarang merasa lapar.</p><p style=\"padding: 0px; border: 0px; margin-right: 0px; margin-bottom: 1em; margin-left: 0px; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; text-size-adjust: none; vertical-align: baseline; max-width: 100%;\">Untuk dapat meraih manfaat ini, menu sarapan sehat untuk anak haruslah terdiri dari 300 gram karbohidrat, 65 gram protein, 50 gram lemak, 25 gram serat, serta asupan berbagai vitamin dan mineral. Jangan kaget dulu melihat besarnya jumlah karbohidrat yang dibutuhkan anak. Kebutuhan glukosa anak memang dua kali lipat lebih besar dibanding orang dewasa. Karbohidrat penting untuk meningkatkan tumbuh kembang otak anak. Glukosa yang dipecah dari karbohidrat merupakan energi utama bagi otak. Selain itu, glukosa juga digunakan oleh otak untuk mengatur dan menjalankan sistem sarafnya.</p><p style=\"padding: 0px; border: 0px; margin-right: 0px; margin-bottom: 1em; margin-left: 0px; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; text-size-adjust: none; vertical-align: baseline; max-width: 100%;\"><span style=\"padding: 0px; border: 0px; margin: 0px; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; text-size-adjust: none; vertical-align: baseline; max-width: 100%;\"></span></p><p style=\"padding: 0px; border: 0px; margin-right: 0px; margin-bottom: 1em; margin-left: 0px; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; text-size-adjust: none; vertical-align: baseline; max-width: 100%;\">Itu sebabnya banyak penelitian yang menunjukkan bahwa menu sarapan tinggi kalori dapat membantu anak-anak belajar lebih baik di sekolah. Artinya anak dapat lebih berkonsentrasi dalam mengingat dan menyelesaikan masalah di setiap mata pelajaran. Namun tentunya sumber karbohidrat yang dipilih tak boleh sembarangan. Nasi dan roti merupakan sumber makanan tinggi karbohidrat. Lalu, mana yang lebih baik untuk anak?</p><h3 style=\"padding: 0px; border: 0px; margin-right: 0px; margin-bottom: 1em; margin-left: 0px; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; text-size-adjust: none; vertical-align: baseline; max-width: 100%;\">Menu sarapan sehat untuk anak, lebih baik pakai nasi atau roti?</h3><p style=\"padding: 0px; border: 0px; margin-right: 0px; margin-bottom: 1em; margin-left: 0px; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; text-size-adjust: none; vertical-align: baseline; max-width: 100%;\">Sebelum menentukan mana yang lebih baik untuk menu sarapan anak, ada baiknya Anda memahami dulu tentang konsep indeks glikemik dalam makanan. Indeks Glikemik (IG) mengukur seberapa cepat karbohidrat yang terdapat dalam makanan untuk diubah menjadi gula oleh tubuh. Semakin tinggi nilai glikemik suatu makanan, semakin tinggi peningkatan kadar gula darah tubuh.</p><p style=\"padding: 0px; border: 0px; margin-right: 0px; margin-bottom: 1em; margin-left: 0px; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; text-size-adjust: none; vertical-align: baseline; max-width: 100%;\">Tingkat indeks glikemik ini dapat memengaruhi kerja otak anak. Seperti yang telah diuraikan di atas, glukosa adalah sumber energi utama otak. Oleh karena itu, semakin tinggi skor IG suatu makanan, semakin tinggi kadar gula darah yang diproduksi, maka semakin baik pula kerja otak anak. Dilansir dari Harvard School bahwa indeks glikemik pada nasi putih (72) lebih rendah daripada skor IG roti tawar putih (75). Lantas, apa ini artinya otomatis roti putih lebih baik ketimbang nasi untuk menu sarapan anak? Belum tentu.</p>',14,'1463b738d0d96a0084b2613900eea520.jpg','2021-06-06 01:54:30','2021-06-06 01:54:30'),
(5,'obat-bab-berdarah-berdasarkan-bagian-saluran-pencernaan','Obat BAB berdarah berdasarkan bagian saluran pencernaan','<p>Salah satu kelompok masalah pencernaan yang sering memicu BAB berdarah yaitu perdarahan pada saluran pencernan. Perdarahan pada saluran pencernaan ini dapat terjadi di berbagai organ pada sistem pencernaan, termasuk kerongkongan dan anus.</p><p>Itu sebabnya, pilihan obat BAB berdarah akan bergantung pada apa penyebab dari kondisi ini. Berikut ini cara mengatasi penyebab BAB berdarah yang dibagi menjadi dua bagian, yaitu saluran pencernaan atas dan bawah.</p><h3>Perdarahan saluran pencernaan atas</h3><p>Berikut ini penyebab perdarahan saluran pencernaan atas yang dapat memicu BAB berdarah serta cara mengobatinya.</p><h3>Infeksi bakteri Helicobacter pylori</h3><p>Infeksi Helicobacter pylori (H. pylori) merupakan kondisi ketika bakteri H. pylori menyerang perut. Bakteri ini dapat merusak jaringan perut hingga bagian pertama dari usus kecil.</p><p>Bila dibiarkan, infeksi bakteri ini dapat menyebabkan masalah pencernaan, seperti tukak lambung, gastritis, dan kanker perut. Bahkan, bakteri H. pylori juga dapat menghasilkan darah pada feses Anda.</p><p>Ada pun beberapa pilihan obat untuk mengatasi infeksi H. pylori sebagai penyebab BAB berdarah, yakni:</p>',13,'d09ce9f4f5fea3e1d054366c7d48c664.jpg','2021-06-06 01:56:07','2021-06-06 01:56:07'),
(6,'4-cara-agar-sarapan-sayur-setiap-pagi-lebih-mudah','4 Cara Agar Sarapan Sayur Setiap Pagi Lebih Mudah','<p>Apa menu sarapan Anda setiap harinya? Mungkin bagi Anda yang punya aktvitas padat, Anda lebih memilih untuk makan sepiring nasi, agar tubuh tidak cepat lemas dan lelah. Apa pun menu sarapan Anda, pastikan di dalamnya ada sejumlah serat dari sayuran. Menu sarapan ini bisa bantu Anda kenyang lebih lama. Lantas, bagaimana caranya untuk makan sayur lebih banyak di waktu sarapan?</p><h3>Sarapan sayur, cara sarapan sehat yang mengenyangkan</h3><p>Siapa bilang sarapan sayur bikin cepat lapar? Faktanya, sayur yang Anda makan saat sarapan bisa bikin perut Anda tidak keroncongan hingga siang hari. Serat yang ada di dalam sayur terbukti dapat bikin perut Anda terasa penuh hingga waktu makan siang Anda. Selain itu, menu ini baik untuk Anda yang ingin mengecilkan lingkar perut dan pinggang.</p><p>Dalam satu hari, Anda harus memenuhi kebutuhan sayur sebanyak 3-4 porsi dalam satu hari. Kira-kira dalam satu kali makan besar, Anda harus mengonsumsi sebanyak satu mangkuk penuh sayuran yang matang tanpa kuah.</p><h3>Bagaimana caranya agar bisa sarapan sayur lebih banyak?</h3><p>Sebenarnya, mudah kok kalau Anda mau memodifikasi sedikit menu sarapan Anda dengan ditambahkan sayuran di dalamnya. Bagi Anda yang kurang suka sayur, juga bisa melakukan tips ini agar sarapan Anda lebih sehat dan berkualitas.</p><h4>1. Buat salad sebagai menu sarapan</h4><p>Jika Anda tak punya banyak waktu untuk membuat sarapan, maka Anda bisa mengandalkan sayur dan dressing salad sebagai menu sarapan di pagi hari. Tak sulit kok, Anda cukup mempersiapkan berbagai jenis sayur untuk salad, seperti daun selada, tomat, wortel, bayam, atau timun. Tambahkan dressing salad di atasnya dan telur rebus jika Anda suka. Jangan lupa untuk mencuci sayur dengan bersih sebelumnya.</p><h4>2. Ganti teh atau kopi dengan smoothie sayur</h4><p>Anda punya kebiasaan harus minum teh atau kopi setiap pagi? Coba deh, sekali-kali ganti menu minuman Anda menjadi minuman yang lebih sehat. Ganti secangkir kopi atau teh Anda dengan smoothie sayur yang segar dan tentunya enak. Mudah, kok, untuk membuatnya, Anda cukup menyediakan sayur-sayuran yang ingin Anda buat jus, kemudian hanya tinggal tambahkan susu, yogurt, atau perasan jeruk segar dan jadilah menu sarapan yang nikmat sekaligus sehat.</p><h4>3. Padukan sayur dengan telur</h4><p>Tidak ada yang tidak cocok untuk dipadukan dengan telur. Ya, bagi Anda pecinta telur, Anda bisa mengakali tambahan sayur di dalam menu omelet Anda. Jangan hanya tambahan daging atau sosis saja yang Anda masukkan ke dalam omelet, tapi sempurnakan gizinya dengan menambahkan potongan berbagai sayuran, seperti bayam, jamur, wortel, hingga brokoli.</p><h4>4. Pakai sayur untuk menu kesukaan Anda</h4><p>Sebenarnya, menu sarapan pada umumnya bisa ditambah sayur-mayur agar lebih bernutrisi dan mengenyangkan. Misalnya nasi goreng atau nasi kuning. Anda bisa menambahkan kubis, timun, wortel, labu, atau sawi. Bahkan, bubur ayam Anda juga akan terasa lebih nikmat kalau ditambah daun bawang dan potongan wortel.</p>',14,'672c7459573c9d9a7b14d3d5288ef730.jpg','2021-06-06 01:58:27','2021-06-06 01:58:27');

/*Table structure for table `kategori_berita` */

DROP TABLE IF EXISTS `kategori_berita`;

CREATE TABLE `kategori_berita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `kategori_berita` */

insert  into `kategori_berita`(`id`,`nama_kategori`) values 
(10,'Tips & Trik'),
(13,'Penyakit'),
(14,'Gizi');

/*Table structure for table `kategori_pengaduan` */

DROP TABLE IF EXISTS `kategori_pengaduan`;

CREATE TABLE `kategori_pengaduan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `kategori_pengaduan` */

insert  into `kategori_pengaduan`(`id`,`nama_kategori`) values 
(3,'Pelayanan Umum'),
(4,'Pelayanan Gawat Darurat'),
(5,'Pelayanan Gigi dan Mulut'),
(6,'Pelayanan KIA'),
(7,'Pelayanan Farmasi/Obat');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(100) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert  into `menu`(`id`,`nama_menu`,`icon`,`url`) values 
(1,'Dashboard','fas fa-fw fa-tachometer-alt','dashboard'),
(2,'Data Pasien','fas fa-fw fa-stethoscope','pasien'),
(3,'Data Berita','fas fa-fw fa-newspaper','berita'),
(4,'Kategori Berita','fas fa-fw fa-list','berita/kategori'),
(5,'Pengguna','fas fa-fw fa-users','pengguna'),
(6,'Pengaturan','fas fa-fw fa-cog','pengaturan'),
(7,'Pengaduan','fas fa-fw fa-bell','pengaduan'),
(8,'Kategori Pengaduan','fas fa-fw fa-list','pengaduan/kategori'),
(9,'Home',NULL,NULL),
(10,'Berita',NULL,'berita'),
(11,'Pengaduan',NULL,'pengaduan'),
(12,'Cek Pengaduan',NULL,'pengaduan/cek'),
(13,'Laporan','fas fa-fw fa-file-pdf','laporan');

/*Table structure for table `menu_group` */

DROP TABLE IF EXISTS `menu_group`;

CREATE TABLE `menu_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `role` enum('pimpinan','petugas','frontend') DEFAULT 'pimpinan',
  `parent_menu` int(11) NOT NULL DEFAULT 0,
  `urutan_menu` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `menu_group` */

insert  into `menu_group`(`id`,`id_menu`,`role`,`parent_menu`,`urutan_menu`) values 
(2,3,'pimpinan',0,5),
(3,4,'pimpinan',0,4),
(4,5,'pimpinan',0,6),
(5,6,'pimpinan',0,7),
(6,7,'pimpinan',0,3),
(7,2,'pimpinan',0,1),
(8,8,'pimpinan',0,2),
(9,9,'frontend',0,1),
(10,10,'frontend',0,2),
(11,11,'frontend',0,3),
(12,12,'frontend',0,4),
(13,3,'petugas',0,5),
(14,4,'petugas',0,4),
(15,5,'petugas',0,6),
(17,7,'petugas',0,3),
(18,2,'petugas',0,1),
(19,8,'petugas',0,2),
(20,13,'pimpinan',0,7),
(21,14,'petugas',0,7);

/*Table structure for table `pasien` */

DROP TABLE IF EXISTS `pasien`;

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pasien` varchar(15) NOT NULL,
  `nama_pasien` varchar(128) NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `pasien` */

insert  into `pasien`(`id`,`kode_pasien`,`nama_pasien`,`jenis_kelamin`,`alamat`,`telp`,`email`) values 
(1,'P-0001','Vanrezky Sadewa Nababan','pria','Jl. Air Hitam, Kecamatan Payung Sekaki Kota Pekanbaru','082268262017',NULL),
(2,'P-0002','Ciska','wanita','Jln Arbes, Gang Wajib Senyum, Kecamatan Pangkalan Kerinci','08131058123',NULL),
(3,'P-0003','Ridho','pria','Jln Tangor, Gang Merpati Kulim Kota Pekanbaru','01080183081230',NULL),
(5,'p01293','asjdak','pria','asdasda dasdaldjassldmasdas das','121232','vanrezkysadewa77@gmail.com');

/*Table structure for table `pengaduan` */

DROP TABLE IF EXISTS `pengaduan`;

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pasien` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `pengaduan` text NOT NULL,
  `status` int(1) NOT NULL,
  `tgl_pengaduan` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `pengaduan` */

insert  into `pengaduan`(`id`,`id_pasien`,`id_kategori`,`pengaduan`,`status`,`tgl_pengaduan`) values 
(1,1,3,'Toilet Tidak bersih dan banyak sampah berserakan',1,'2021-06-05 17:45:24'),
(2,1,3,'Pelayanan kurang ramah',1,'2021-06-06 22:25:37'),
(3,1,3,'Pelayanan tidak baik.. sehingga terjadi banyak kesalahan',0,'2021-06-07 22:41:16'),
(4,5,4,'Pelayanan gawat daruratnya sangat tidak baik.. banyak terjadi kematian..',1,'2021-06-07 22:47:41');

/*Table structure for table `pengaturan` */

DROP TABLE IF EXISTS `pengaturan`;

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_website` varchar(128) NOT NULL,
  `nama_singkat` varchar(128) DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `semboyan` varchar(128) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pengaturan` */

insert  into `pengaturan`(`id`,`nama_website`,`nama_singkat`,`deskripsi`,`semboyan`,`logo`,`favicon`) values 
(1,'Pengaduan Puskesmas Payung Sekaki','Pengaduan Puskesmas','Sistem Informasi Pengaduan Keluhan Pelayanan Kesehatan Berbasis Web di Puskesmas Payung Sekaki','Melayani Sepenuh Hati','47b8f76180e7014c54170fc2f3f18013.png','default.jpg');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(125) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `role` enum('pimpinan','petugas') NOT NULL DEFAULT 'pimpinan',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`nama`,`role`,`created_at`,`updated_at`,`last_login`) values 
(14,'van','$2y$10$tumhBggvjV.FQqo6z.Gn3.1wPTT3VLtd68R9OLWXIJnKcZuEk08Om','vanrezky sadewa','pimpinan','2021-06-05 16:20:35','2021-06-05 16:20:35','2021-06-07 20:05:37'),
(15,'petugas','$2y$10$VDvTWcyMol2hz2L66ssSvOqOnLRK3zsq2dgyN/RKxTI.7QQwvambK','Andi','petugas','2021-06-06 22:36:49','2021-06-06 22:36:49','2021-06-07 21:58:21');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
