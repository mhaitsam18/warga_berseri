-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2021 at 08:11 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warga_berseri`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `pdelete_pendataan_warga` (IN `v_id` VARCHAR(10))  NO SQL
BEGIN
DELETE FROM pendataan_warga WHERE id_warga = v_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pinsert_registrasi_user` (IN `v_username` VARCHAR(10), IN `v_password` VARCHAR(100), IN `v_no_rumah` VARCHAR(10), IN `v_nama` VARCHAR(50), IN `v_foto` VARCHAR(100), IN `v_status` VARCHAR(20), IN `v_id` VARCHAR(10))  NO SQL
BEGIN
INSERT INTO pendataan_warga (id_warga, no_rumah, nama, username, password, foto_ktp, status) VALUES (v_id, v_no_rumah, v_nama, v_username, v_password, v_foto, v_status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `priwayat_pembayaran_iuran` ()  BEGIN
SELECT id_warga,nama,friwayat_pendataan_warga(id) AS Status FROM riwayat_pendataan_warga;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `priwayat_pendataan_warga` ()  BEGIN
SELECT id_warga,nama,friwayat_pendataan_warga(id_warga) AS Status FROM riwayat_pendataan_warga;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pview_pendataan_warga` ()  NO SQL
BEGIN
SELECT * FROM pendataan_warga;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `friwayat_pembayaran_iuran` (`tagihan` INT) RETURNS VARCHAR(255) CHARSET utf8mb4 BEGIN
DECLARE status VARCHAR(255);
DECLARE hasil VARCHAR(255);
SELECT IF(tanggal_diterima IS NOT NULL, 'Benar', 'Salah') INTO status FROM riwayat_pembayaran_iuran WHERE no_tagihan=tagihan;
IF status = 'Benar' THEN
SET hasil = 'Sudah Bayar Iuran';
ELSE
SET hasil = 'Belum Bayar Iuran';
END IF;
RETURN(hasil);
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `friwayat_pendataan_warga` (`id` VARCHAR(20)) RETURNS VARCHAR(255) CHARSET latin1 BEGIN
DECLARE status VARCHAR(255);
DECLARE hasil VARCHAR(255);
SELECT IF(tanggal_ubah IS NOT NULL, 'Benar', 'Salah') INTO status FROM riwayat_pendataan_warga WHERE id_warga = id;
IF status = 'Benar' THEN
SET hasil = 'Terverifikasi';
ELSE
SET hasil = 'Belum Terverifikasi';
END IF;
RETURN(hasil);
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fview_total_warga` () RETURNS VARCHAR(100) CHARSET latin1 NO SQL
    DETERMINISTIC
BEGIN
DECLARE total VARCHAR(100);
SELECT COUNT(id_warga) INTO total FROM pendataan_warga;
RETURN total;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `id` int(11) NOT NULL,
  `agama` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id`, `agama`) VALUES
(1, 'Islam'),
(2, 'Kristen Protestan'),
(3, 'Kristen Katolik'),
(4, 'Budha'),
(5, 'Hindu'),
(6, 'Konghucu');

-- --------------------------------------------------------

--
-- Table structure for table `aspirasi`
--

CREATE TABLE `aspirasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_wa` varchar(128) NOT NULL,
  `jenis_aspirasi` varchar(255) NOT NULL,
  `aspirasi` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `waktu_kirim` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `waktu_post` datetime NOT NULL,
  `terakhir_diubah` datetime NOT NULL,
  `thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `penulis`, `waktu_post`, `terakhir_diubah`, `thumbnail`) VALUES
(1, 'Ever too late to lose weight?', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, minima.', 'john stain', '2021-03-22 00:00:00', '2021-03-31 00:00:00', 'post6.jpg'),
(2, 'Make your fitness Boost with us', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, minima.', 'john stain', '2021-03-30 00:00:00', '2021-03-31 00:00:00', 'post1.jpg'),
(3, 'Ethernity beauty health diet plan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, minima.', 'john stain', '2021-03-25 00:00:00', '2021-03-25 00:00:00', 'post2.jpg'),
(4, 'Ever too late to lose weight?', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, minima.', 'john stain', '2021-03-08 00:00:00', '2021-03-31 00:00:00', 'post3.jpg'),
(5, 'Make your fitness Boost with us', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, minima.', 'john stain', '2021-03-27 00:00:00', '2021-03-18 00:00:00', 'post4.jpg'),
(6, 'Ethernity beauty health diet plan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, minima.', 'john stain', '2021-03-19 00:00:00', '2021-03-31 00:00:00', 'post5.jpg'),
(7, 'Berita <br>Hari Ini <span class=\"text-color\">COVID19</span>', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis Theme natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam lorem ante, dapibus in.</p>', 'Muhammad Haitsam', '2021-03-20 21:43:37', '2021-03-20 21:47:25', 'covid.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `footer` varchar(255) NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `header`, `content`, `footer`, `last_updated`) VALUES
(1, 'Illustration', '<p>Add some quality, svg illustrations to your project courtesy of <a\r\n                                            target=\"_blank\" rel=\"nofollow\" href=\"https://undraw.co/\">unDraw</a>, a\r\n                                        constantly updated collection of beautiful svg images that you can use\r\n                                        completely free and without attribution!</p>\r\n                                    <a target=\"_blank\" rel=\"nofollow\" href=\"https://undraw.co/\">Browse Illustrations on\r\n                                        unDraw &rarr;</a>', '', '2021-03-05 03:51:54'),
(2, 'Development Approach', '<p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce\r\n                                        CSS bloat and poor page performance. Custom CSS classes are used to create\r\n                                        custom components and custom utility classes.</p>\r\n                                    <p class=\"mb-0\">Before working with this theme, you should become familiar with the\r\n                                        Bootstrap framework, especially the utility classes.</p>', '', '2021-03-05 03:49:49'),
(3, 'Illustration', '<p>Add some quality, svg illustrations to your project courtesy of <a\r\n                                            target=\"_blank\" rel=\"nofollow\" href=\"https://undraw.co/\">unDraw</a>, a\r\n                                        constantly updated collection of beautiful svg images that you can use\r\n                                        completely free and without attribution!</p>\r\n                                    <a target=\"_blank\" rel=\"nofollow\" href=\"https://undraw.co/\">Browse Illustrations on\r\n                                        unDraw &rarr;</a>', '', '2021-03-05 03:51:44'),
(4, 'Development Approach', '<p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce\r\n                                        CSS bloat and poor page performance. Custom CSS classes are used to create\r\n                                        custom components and custom utility classes.</p>\r\n                                    <p class=\"mb-0\">Before working with this theme, you should become familiar with the\r\n                                        Bootstrap framework, especially the utility classes.</p>', '', '2021-03-05 03:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE `dashboard` (
  `id` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `footer` varchar(256) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `side_logo` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dashboard`
--

INSERT INTO `dashboard` (`id`, `header`, `title`, `content`, `footer`, `icon`, `side_logo`, `logo`) VALUES
(1, 'About Application', 'Warga Berseri', 'SELAMAT DATANG DI APLIKASI PERUMAHAN PERMATA BUAH BATU', 'Editor: Januarizqi Dwi Mileniantoro', '', 'PBB', 'pbb.png'),
(2, '<h2 class=\"text-white text-capitalize\"></i>Warga<span class=\"text-color\"> Berseri</span></h2>', 'Warga Berseri', '<span class=\"h6 d-inline-block mb-4 subhead text-uppercase\">Warga Berseri</span>\r\n					<h1 class=\"text-uppercase text-white mb-5\">Perumahan <span class=\"text-color\">Permata</span><br>Buah Batu</h1>', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `data_admin`
--

CREATE TABLE `data_admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(50) NOT NULL,
  `password_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_admin`
--

INSERT INTO `data_admin` (`id_admin`, `username_admin`, `password_admin`) VALUES
(1, 'dacre', 'dacre123'),
(2, 'reecebibby', 'reece123'),
(3, 'rafif', 'aswqdrfe123'),
(4, 'thomas', 'thomas123'),
(5, 'hannah', '$2y$10$nD4JGCK25.ZRfFK.omVL2OzagZzqBzazo8kQ.S2lcgO');

-- --------------------------------------------------------

--
-- Table structure for table `data_fasilitas`
--

CREATE TABLE `data_fasilitas` (
  `no` int(11) NOT NULL,
  `nama_lokasi` varchar(255) NOT NULL,
  `fasilitas_lokasi` mediumtext NOT NULL,
  `alamat_lokasi` mediumtext NOT NULL,
  `foto_lokasi` varchar(2555) NOT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_fasilitas`
--

INSERT INTO `data_fasilitas` (`no`, `nama_lokasi`, `fasilitas_lokasi`, `alamat_lokasi`, `foto_lokasi`, `lat`, `long`) VALUES
(13, 'Taman Bermain', 'Seluncuran, Bianglala, Jungkat jungkit', 'Jl. Comp. Permata Buah Batu 30 Lengkong, Kec. Bojongsoang, Bandung, Jawa Barat 40287', '/warga_berseri/admin/foto_lokasi/tong3.jpg', '-6.9730451', '107.6399924'),
(14, 'Area Jogging', 'Jalan untuk jogging', 'Blk. C-G 11 Lengkong, Kec. Bojongsoang, Bandung, Jawa Barat 40287', '/warga_berseri/admin/foto_lokasi/75_-Manfaat-jogging-untuk-kesehatan-anda.jpg', '-6.9717489', '107.6384383'),
(18, 'Temapt Bulu Tangkis', 'Raket, Lapangan Bulu Tangkis, Kok', 'Jl. Komp. Permata Buah Batu, Lengkong, Kec. Bojongsoang, Bandung, Jawa Barat 40287', '/warga_berseri/admin/foto_lokasi/605fd42a776443.jpg', '-6.9732321', '107.6383576'),
(19, 'Almalia ', 'Sekolah', 'Jl. Komp. Permata Buah Batu No.A-25, Lengkong, Kec. Bojongsoang, Bandung, Jawa Barat 40287', '/warga_berseri/admin/foto_lokasi/tong4.jpg', '-6.9735963', '107.6390737');

-- --------------------------------------------------------

--
-- Table structure for table `data_iuran_warga`
--

CREATE TABLE `data_iuran_warga` (
  `no_tagihan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `status_penghuni` varchar(20) NOT NULL,
  `blok_rumah` varchar(20) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_iuran` varchar(20) NOT NULL,
  `id_warga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_iuran_warga`
--

INSERT INTO `data_iuran_warga` (`no_tagihan`, `nama`, `status_penghuni`, `blok_rumah`, `tanggal_pembayaran`, `bukti_pembayaran`, `status_iuran`, `id_warga`) VALUES
(0, 'Anugrah Tralala', 'Penghuni Tetap', 'N-08', '2020-02-01', '', 'Lunas', 0);

--
-- Triggers `data_iuran_warga`
--
DELIMITER $$
CREATE TRIGGER `after_pembayaran_update` AFTER UPDATE ON `data_iuran_warga` FOR EACH ROW BEGIN
INSERT INTO riwayat_pembayaran_iuran
SET id_warga = OLD.id_warga,
no_tagihan = OLD.no_tagihan,
nama= OLD.nama,
tanggal_pembayaran = OLD.tanggal_pembayaran,
tanggal_diterima = NOW(),
status_iuran = NEW.status_iuran;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `data_keuangan_iuran`
--

CREATE TABLE `data_keuangan_iuran` (
  `id_data_keuangan` int(10) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL,
  `jumlah_warga` int(10) NOT NULL,
  `jumlah_sudah_bayar` int(10) NOT NULL,
  `jumlah_belum_bayar` int(10) NOT NULL,
  `saldo` int(100) NOT NULL,
  `total_saldo` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_keuangan_iuran`
--

INSERT INTO `data_keuangan_iuran` (`id_data_keuangan`, `bulan`, `tahun`, `jumlah_warga`, `jumlah_sudah_bayar`, `jumlah_belum_bayar`, `saldo`, `total_saldo`) VALUES
(1, 'Apr', 2020, 4, 3, 1, 300000, 0),
(2, '', 0000, 0, 0, 0, 0, 500000),
(3, 'Mei', 2020, 4, 1, 3, 100000, 0),
(4, 'Mei', 2020, 4, 1, 3, 100000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_penggunaan_iuran`
--

CREATE TABLE `data_penggunaan_iuran` (
  `id_penggunaan` int(255) NOT NULL,
  `nama_kebutuhan` text NOT NULL,
  `jumlah_pengeluaran` int(255) NOT NULL,
  `tanggal_penggunaan` date NOT NULL,
  `bukti_pengeluaran` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keluhan`
--

CREATE TABLE `keluhan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_wa` varchar(128) NOT NULL,
  `jenis_keluhan` varchar(255) NOT NULL,
  `keluhan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `bukti` varchar(128) NOT NULL,
  `waktu_kirim` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keluhan`
--

INSERT INTO `keluhan` (`id`, `nama`, `email`, `no_wa`, `jenis_keluhan`, `keluhan`, `status`, `bukti`, `waktu_kirim`) VALUES
(1, 'Ersa Maulana', 'ersa@gmail.com', '', 'kebersihan', 'Jalan di Blok D kotor sekali', 'Belum diproses', '', '2021-04-07 10:23:25'),
(2, 'Rini Sarlita', '', '0821170503125', 'keamanan', 'Rumah saya Kemalingan', 'Sedang diproses', 'pbb.png', '2021-04-08 16:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `musrembang`
--

CREATE TABLE `musrembang` (
  `id` int(11) NOT NULL,
  `program` varchar(255) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `sasaran` varchar(255) NOT NULL,
  `volume_lokasi` varchar(255) NOT NULL,
  `pengusul` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `musrembang`
--

INSERT INTO `musrembang` (`id`, `program`, `kegiatan`, `sasaran`, `volume_lokasi`, `pengusul`, `keterangan`, `status`) VALUES
(1, 'Peningkatan Infrastruktur', 'Pengecoran Jalan', 'Kelancaran Lalu Lintas', 'Volume: 125 m\r\nLokasi: Rw.01\r\nKelurahan Gemolong\r\n-Sragen', 'Musyawarah RT di RW.01\r\nTanggal: 2020-11-01', 'Saat ini kondisi Jalan sudah tidak dapat dilalui oleh kendaraan karena terdapat lobang-lobang yang sangat besar dan dalam', 'Sudah diusulkan');

-- --------------------------------------------------------

--
-- Table structure for table `notulensi`
--

CREATE TABLE `notulensi` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `waktu_post` datetime NOT NULL,
  `terakhir_diubah` datetime NOT NULL,
  `thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notulensi`
--

INSERT INTO `notulensi` (`id`, `judul`, `isi`, `penulis`, `waktu_post`, `terakhir_diubah`, `thumbnail`) VALUES
(1, 'Rapat Paripurna', 'Tidak boleh makan di Toilet.', 'Januarizqi Dwi Mileniantoro', '2021-04-08 22:44:47', '2021-04-08 22:44:58', 'pbb.png');

-- --------------------------------------------------------

--
-- Table structure for table `pendataan_kendaraan`
--

CREATE TABLE `pendataan_kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `id_warga` varchar(20) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `plat_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendataan_kendaraan`
--

INSERT INTO `pendataan_kendaraan` (`id_kendaraan`, `id_warga`, `kategori`, `merk`, `plat_no`) VALUES
(1, '1', 'Motor', ' daihatsu avanza', 'F 123 UY');

-- --------------------------------------------------------

--
-- Table structure for table `pendataan_warga`
--

CREATE TABLE `pendataan_warga` (
  `id_warga` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_rumah` int(11) NOT NULL,
  `rt` varchar(255) NOT NULL,
  `rw` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `foto_user` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `no_akta` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `umur` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `status` enum('Belum Terverifikasi','Terverifikasi') NOT NULL,
  `status_tinggal` enum('Menetap','Kost','Kontrakan','Pemilik Kostan/Kontrakan') NOT NULL,
  `foto_ktp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendataan_warga`
--

INSERT INTO `pendataan_warga` (`id_warga`, `username`, `password`, `no_rumah`, `rt`, `rw`, `alamat`, `foto_user`, `nama`, `nik`, `no_akta`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `pendidikan`, `umur`, `pekerjaan`, `status`, `status_tinggal`, `foto_ktp`) VALUES
('1', 'ersa', 'ersa123', 123, '22', '5', 'Bogor', 'A9D6D8F4-9FC8-4E61-BE55-7F6C90BB04F1.jpg', 'Ersa Nur Maulana', '8391902', 'i230942304', 'Perempuan', 'sukabumi', '2020-03-27', 'islam', 'hehe', '20', 'ngoding', 'Terverifikasi', '', ''),
('2', 'clayjensen', 'clay123', 278, '22', '5', 'perumahan villa mutiara lido blok e1/07', '', 'Clay Jensen', '89201928', '83928493', 'Perempuan', 'Sukabumi', '16-04-2000', 'Hindu', 'SMA', '25', 'Nelayan', 'Terverifikasi', '', ''),
('3', 'naurah', 'naurah123', 789, '22', '5', 'bogor perumahan bojongsoang', '', 'Naurah gardenifa salsabila', '8238237237', '8921378122', 'Perempuan', 'Bandung', '20-03-2000', 'Islam', 'Diploma', '20', 'Nelayan', 'Terverifikasi', '', ''),
('9', 'muhidin', '$2y$10$wRLDuRF3YcjM2GzPL7BULuVn4PRDuVhUp1/nRN1ClS2sYiC3C01Zu', 879, '22', '089', 'Bogor, perumahan villa mutiara lido', '', 'Haji Muhidin', '9872651425617289', '9872651425617289', 'Perempuan', 'sukabumi', '2020-04-17', 'islam', 'hehe', '20', 'ngoding', 'Terverifikasi', 'Menetap', 'A41BE32F-BB4A-49D0-A078-2EA6ECC7613D.jpg'),
('W-PBB-001', 'hajiclay', '$2y$10$cPgdFOdeks8d96CPP4ch/.i.02cmuOVIHRH4J4Pcwy240jtFFBN3i', 623, '', '', '', '', 'Haji Clay', '', '', '', '', '', '', '', '', '', 'Terverifikasi', 'Menetap', '1511355931200.jpg'),
('W-PBB-002', 'fulan', '123456', 123, '', '', '', '', 'fulan', '', '', '', '', '', '', '', '', '', 'Belum Terverifikasi', 'Menetap', '6-min.JPG');

--
-- Triggers `pendataan_warga`
--
DELIMITER $$
CREATE TRIGGER `after_pendataan_update` AFTER UPDATE ON `pendataan_warga` FOR EACH ROW BEGIN
INSERT INTO riwayat_pendataan_warga
SET id_warga = OLD.id_warga,
nama= OLD.nama,
tanggal_ubah = NOW(),
status = NEW.status;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `waktu_post` datetime NOT NULL,
  `terakhir_diubah` datetime NOT NULL,
  `thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `penulis`, `waktu_post`, `terakhir_diubah`, `thumbnail`) VALUES
(1, 'Anggota Eksekutif Baru', 'namanya Sam', 'Januarizqi Dwi Mileniantoro', '2021-03-18 09:17:28', '2021-03-20 20:49:58', 'bg-5.jpg'),
(2, 'dicoba', 'coba', 'Ersa Nur Maulana', '2021-03-19 05:48:04', '2021-03-19 05:48:04', 'bg-7 revisi.jpg'),
(3, 'Ever too late to lose weight?', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, minima.', 'john stain', '2021-03-30 00:00:00', '2021-03-30 00:00:00', 'post6.jpg'),
(4, 'Make your fitness Boost with us', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, minima.', 'john stain', '2021-03-30 00:00:00', '2021-03-30 00:00:00', 'post1.jpg'),
(5, 'Ethernity beauty health diet plan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, minima.', 'john stain', '2021-03-30 00:00:00', '2021-03-30 00:00:00', 'post2.jpg'),
(6, 'Ever too late to lose weight?', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, minima.', 'john stain', '2021-03-30 00:00:00', '2021-03-30 00:00:00', 'post3.jpg'),
(7, 'Make your fitness Boost with us', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, minima.', 'john stain', '2021-03-30 00:00:00', '2021-03-30 00:00:00', 'post4.jpg'),
(8, 'Ethernity beauty health diet plan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, minima.', 'john stain', '2021-03-30 00:00:00', '2021-03-30 00:00:00', 'post5.jpg'),
(9, 'Pengumuman <br>Pengajian <span class=\"text-color\">Bulanan</span>', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis Theme natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam lorem ante, dapibus in.', 'Muhammad Haitsam', '2021-03-20 21:54:41', '2021-03-20 21:54:41', 'bg-7.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pembayaran_iuran`
--

CREATE TABLE `riwayat_pembayaran_iuran` (
  `id_warga` int(11) NOT NULL,
  `no_tagihan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `tanggal_diterima` date NOT NULL,
  `status_iuran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_pembayaran_iuran`
--

INSERT INTO `riwayat_pembayaran_iuran` (`id_warga`, `no_tagihan`, `nama`, `tanggal_pembayaran`, `tanggal_diterima`, `status_iuran`) VALUES
(3, 1, 'naurah', '2020-04-03', '2020-04-12', 'Lunas'),
(0, 0, 'Anugrah Tralala', '2020-02-01', '2020-04-12', 'Lunas'),
(1, 4, 'ersa', '2020-04-03', '2020-04-12', 'Lunas'),
(2, 2004105321, 'Rafif Yusuf', '0000-00-00', '2020-04-20', 'Lunas'),
(12, 123, 'ula', '2020-04-01', '2020-04-20', 'Lunas'),
(3, 1, 'naurah', '2020-04-03', '2020-04-12', 'Lunas'),
(0, 0, 'Anugrah Tralala', '2020-02-01', '2020-04-12', 'Lunas'),
(1, 4, 'ersa', '2020-04-03', '2020-04-12', 'Lunas'),
(2, 2004105321, 'Rafif Yusuf', '0000-00-00', '2020-04-20', 'Lunas'),
(12, 123, 'ula', '2020-04-01', '2020-04-20', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pendataan_warga`
--

CREATE TABLE `riwayat_pendataan_warga` (
  `id_warga` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tanggal_ubah` date NOT NULL,
  `status` enum('Terverifikasi','Belum Terverifikasi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `struktur`
--

CREATE TABLE `struktur` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `parent_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `struktur`
--

INSERT INTO `struktur` (`id`, `nama`, `jabatan`, `foto`, `parent_id`) VALUES
(1, 'Ersa Nur Maulana', 'Ketua RT', 'Ersa_Nur_Maulana-min.JPG', NULL),
(2, 'Januarizqi Dwi Mileniantoro', 'Sie. Keamanan', 'Januarizqi_Dwi_M_-min1.JPG', '1'),
(3, 'Alya Putri Maharani', 'Sie. Kebersihan', '4-min.JPG', '1'),
(6, 'Nurul Fadhilah', 'Sie. PKK', '6-min.JPG', '1'),
(12, 'Olga Paurenta Simanihuruk', 'Bendahara', '2019-06-05_11_59_30_1-min_(1).jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id_template` int(11) NOT NULL,
  `nama_template` varchar(50) NOT NULL,
  `tgl_buat` date NOT NULL,
  `file_template` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id_template`, `nama_template`, `tgl_buat`, `file_template`) VALUES
(1, 'surat', '2020-04-15', 'prosesbisnis_ErsaNurMaulana_6701184083.docx');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `gender` varchar(128) NOT NULL,
  `place_of_birth` varchar(128) NOT NULL,
  `birthday` date DEFAULT NULL,
  `phone_number` varchar(128) NOT NULL,
  `address` varchar(255) NOT NULL,
  `religion_id` int(11) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `gender`, `place_of_birth`, `birthday`, `phone_number`, `address`, `religion_id`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(2, 'Januarizqi Dwi Mileniantoro', 'jaanz17', 'januarrizqi5@gmail.com', 'Laki-laki', 'Kediri', '2000-01-17', '085717295156', 'Kediri', 1, 'Januarizqi_Dwi_M_-min1.JPG', '$2y$10$54Ajl0R.ArBF45hyXCsJZOnTdLzoegtv9nJbBRs3ICk1QBv1kS5yW', 1, 1, 1614472317),
(32, 'Muhammad Haitsam', 'mhaitsam18', 'haitsam03@gmail.com', 'Laki-laki', 'Madinah', '1999-02-18', '082117503125', 'Karawang', 1, 'default.svg', '$2y$10$eMEn1ljyda0pNo74Zr4louAjXYJOPslUoAfTL8IX77ku3HDrpOK82', 1, 0, 1617881885);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 1, 3),
(5, 1, 4),
(6, 1, 5),
(7, 1, 6),
(8, 1, 7),
(9, 1, 8),
(10, 2, 2),
(11, 2, 9),
(12, 1, 9),
(13, 1, 10),
(14, 1, 11),
(15, 3, 1),
(16, 3, 2),
(17, 3, 9),
(18, 4, 1),
(19, 4, 2),
(20, 4, 9),
(21, 5, 1),
(22, 5, 2),
(23, 5, 9),
(24, 2, 4),
(25, 3, 5),
(26, 4, 6),
(27, 5, 7),
(28, 1, 12),
(29, 2, 12),
(30, 3, 12),
(31, 4, 12),
(32, 5, 12),
(33, 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `icon`, `active`) VALUES
(1, 'Admin', 'fe-users', 1),
(2, 'User', 'fe-user', 1),
(3, 'Set Up', 'fe-menu', 1),
(4, 'Admin Kebersihan', 'fe-trash-2', 1),
(5, 'Admin Keamanan', 'fe-shield', 1),
(6, 'Admin Fasilitas', 'fe-home', 1),
(7, 'Admin Olahraga', 'fe-globe', 1),
(8, 'DataMaster', 'fe-database', 1),
(9, 'Lainnya', 'fe-more-vertical-', 1),
(10, 'Data', 'fe-book-open', 0),
(11, 'Dashboard', 'fe-book', 0),
(12, 'KeluhanAspirasi', 'fe-people', 0),
(13, 'menu', 'fe-menu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'administrator'),
(2, 'admin kebersihan'),
(3, 'admin keamanan'),
(4, 'admin fasilitas'),
(5, 'admin olahraga');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin/', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user/', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu/', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/subMenu', 'fas fa-fw fa-folder-open', 1),
(6, 3, 'Role Management', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(7, 2, 'Change Password', 'user/changePassword', 'fas fa-fw fa-key', 1),
(8, 1, 'Data User', 'admin/dataUser/', 'fas fa-fw fa-user-tie', 1),
(9, 4, 'Data Keluhan dan Aspirasi', 'KeluhanAspirasi/kebersihan', 'fas fa-fw fa-broom', 1),
(10, 8, 'Data Master', 'DataMaster/', 'fas fa-fw fa-database', 1),
(11, 5, 'Data Keluhan dan Aspirasi', 'KeluhanAspirasi/keamanan', 'fas fa-fw fa-handshake', 1),
(12, 1, 'Struktur Organisasi', 'Admin/strukturOrganisasi', 'fas fa-fw fa-sitemap', 1),
(13, 1, 'Pengumuman', 'Admin/pengumuman', 'fas fa-fw fa-bullhorn', 1),
(14, 6, 'Data Keluhan dan Aspirasi', 'KeluhanAspirasi/fasilitas', 'fas fa-fw fa-building', 1),
(15, 7, 'Data Keluhan dan Aspirasi', 'KeluhanAspirasi/olahraga', 'fas fa-fw fa-basketball-ball', 1),
(16, 1, 'Riwayat Verifikasi', 'Dashboard/riwayat_verifikasi', 'fas fa-fw fa-history', 1),
(17, 8, 'Data Warga', 'Dashboard/data_warga', 'fas fa-fw fa-users', 1),
(18, 8, 'Data Kendaraan', 'Dashboard/data_kendaraan', 'fas fa-fw fa-car', 1),
(19, 8, 'Data Fasilitas', 'Dashboard/fasilitas', 'fas fa-fw fa-couch', 1),
(20, 1, 'Keluhan dan Aspirasi', 'KeluhanAspirasi/', 'fas fa-fw fa-people-carry', 1),
(21, 3, 'Data Agama', 'DataMaster/agama/', 'fas fa-fw fa-pray', 1),
(22, 3, 'Edit Dashboard Admin', 'DataMaster/dashboard/', 'fas fa-fw fa-edit', 1),
(23, 8, 'Data Konten', 'DataMaster/konten', 'far fa-fw fa-newspaper', 1),
(24, 9, 'Tentang Aplikasi', 'Lainnya/tentang', 'fas fa-fw fa-address-card', 1),
(25, 9, 'Pengaturan', 'Lainnya/pengaturan', 'fas fa-fw fa-wrench', 1),
(26, 9, 'Hubungi Kami', 'Lainnya/hubungi', 'fas fa-fw fa-address-book', 1),
(27, 9, 'Bantuan', 'Lainnya/bantuan', 'far fa-fw fa-question-circle', 1),
(28, 9, 'FAQ', 'Lainnya/faq', 'fas fa-fw fa-question', 1),
(32, 1, 'Berita', 'admin/berita', 'fas fa-fw fa-newspaper', 1),
(33, 1, 'Notulensi', 'admin/notulensi', 'far fa-fw fa-clipboard', 1),
(34, 3, 'Edit Dashboard User', 'DataMaster/dashboardUser/', 'far fa-fw fa-edit', 1),
(35, 1, 'Musrembang', 'Admin/musrembang', 'fas fa-fw fa-book-open', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(4, 'haitsam03@gmail.com', 'iscmRCWne+lTCfqz/25n5R8VUX5MUkaN02Bhum3gVsU=', 1609930420),
(5, 'haitsam03@gmail.com', 'n5QKD1D9vUL9QiROw9MO4pgD/fbbdFGYrGd8znIJWe4=', 1609932048),
(6, 'haitsam03@gmail.com', 'wPG+3htmGqTKAArzVlpS/b0eoqor9TKqG16H5cDvMqA=', 1609932054),
(7, 'aa@aa.a', 'oIK0LUztcU02aYAE6HG86eh7Fq5/TcK17wF7B/To+/k=', 1609941391),
(8, 'wahyuhidayat@gmail.com', 'h5OYZb29deEXYS/1Bc69GOaWseVwGEhhSXVKert9Oog=', 1610019862),
(9, 'pramuko@gmail.com', 'ijlFNaUwBrUcqEbANwlEml1FluVkgWAOvEPf3VtE9H4=', 1610019892),
(10, 'elyrosely@gmail.com', 'zLt8OC5aT9LrQaCipRl09/n95aUTUUjwCiVtKM150uA=', 1610019940),
(11, 'inne@gmail.com', '6kl2FFh6027PAQ51K03uIlFz8f3+e59snpxLo3jAOBE=', 1610019985),
(12, 'wawa@gmail.com', '/g7m4I60ysY6Ljs6xsHhye5zWPyA0eR/4qwv7r7czlo=', 1610020015),
(13, 'fasaldo1999@gmail.com', 'fOSWX9UdFnoi7ejSOIkhye7te1tVdT+cXmd1hh0YZCQ=', 1610023446),
(15, 'muhammadbarja@gmail.com', 'VpatS/tgTK/bfTZLlDDoVX9aaD6Kb3YoeS2/ozJOhXI=', 1610280453),
(16, 'januarizqi5@gmail.com', '8QKHOpK1ROQrW679QbREt1fb2wdgcsffl5PLahNGPws=', 1610507816),
(17, 'suryatiningsih@gmail.com', 'IvVR3KjJpnh+lnQgeWOmpht3w235j9Vax2GkkDCzUBE=', 1610509684),
(18, 'ersanum@gmail.com', 'Tst2ygGt8n2wUa+RsqvtHguZMn1KPTaiNE63D4wwehQ=', 1610529882),
(19, 'haitsamhaitsam18@yahoo.com', '06vONmPAIi0hj/xgLH72Ck6FSDDyqs96P9pxA5bOU54=', 1610556667),
(20, 'shibghotul7@gmail.com', 'zLT3U4RCMM6pc1pVBCI3SodKzlAVJmG13PbfY8ijFnU=', 1610556792),
(21, 'haitsam03@gmail.com', 'oVyGSYjGv4lTvFvUKawPJ96cj42FYlkQW8QcyPDghSQ=', 1611588824),
(22, 'akibdahlan20@gmail.com', 'Q5sF4roomYzNnHkIS0zKCHKteza6KwrK5GYaHqlJr8w=', 1614472096),
(23, 'akibdahlan21@gmail.com', 'M23yBdkPPwctLera1YG1Eccpx5PFhn1vNyKEeEqVpT0=', 1614472317),
(24, 'wakwaw@gmail.com', 'iOURcncfWdC6WJhj6FEhYRCWPFMmfu25d+RbC4txFL8=', 1617169234),
(25, 'haitsam03@gmail.com', 'dWAGvQUW4IiDFCBmjdSpT57Nie9q+d6xhdtC0D+83tU=', 1617881885);

-- --------------------------------------------------------

--
-- Table structure for table `warga`
--

CREATE TABLE `warga` (
  `id_warga` int(11) NOT NULL,
  `nama_warga` varchar(255) NOT NULL,
  `nip` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warga`
--

INSERT INTO `warga` (`id_warga`, `nama_warga`, `nip`, `status`) VALUES
(1, 'Ersa Nur Maulana', 111, 'lajang'),
(2, 'Rafif Yusuf', 121, 'Lajang'),
(6, 'naurah', 131, 'menikah'),
(7, 'tama', 141, 'menikah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_admin`
--
ALTER TABLE `data_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `data_fasilitas`
--
ALTER TABLE `data_fasilitas`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `data_iuran_warga`
--
ALTER TABLE `data_iuran_warga`
  ADD PRIMARY KEY (`no_tagihan`);

--
-- Indexes for table `data_keuangan_iuran`
--
ALTER TABLE `data_keuangan_iuran`
  ADD PRIMARY KEY (`id_data_keuangan`);

--
-- Indexes for table `data_penggunaan_iuran`
--
ALTER TABLE `data_penggunaan_iuran`
  ADD PRIMARY KEY (`id_penggunaan`);

--
-- Indexes for table `keluhan`
--
ALTER TABLE `keluhan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `musrembang`
--
ALTER TABLE `musrembang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notulensi`
--
ALTER TABLE `notulensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendataan_kendaraan`
--
ALTER TABLE `pendataan_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD KEY `id_warga` (`id_warga`);

--
-- Indexes for table `pendataan_warga`
--
ALTER TABLE `pendataan_warga`
  ADD PRIMARY KEY (`id_warga`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_pendataan_warga`
--
ALTER TABLE `riwayat_pendataan_warga`
  ADD PRIMARY KEY (`id_warga`);

--
-- Indexes for table `struktur`
--
ALTER TABLE `struktur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id_template`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`id_warga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `aspirasi`
--
ALTER TABLE `aspirasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dashboard`
--
ALTER TABLE `dashboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_admin`
--
ALTER TABLE `data_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_fasilitas`
--
ALTER TABLE `data_fasilitas`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `data_keuangan_iuran`
--
ALTER TABLE `data_keuangan_iuran`
  MODIFY `id_data_keuangan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_penggunaan_iuran`
--
ALTER TABLE `data_penggunaan_iuran`
  MODIFY `id_penggunaan` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keluhan`
--
ALTER TABLE `keluhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `musrembang`
--
ALTER TABLE `musrembang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notulensi`
--
ALTER TABLE `notulensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pendataan_kendaraan`
--
ALTER TABLE `pendataan_kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `struktur`
--
ALTER TABLE `struktur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id_template` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `warga`
--
ALTER TABLE `warga`
  MODIFY `id_warga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
