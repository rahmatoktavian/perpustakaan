-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `anggota` (
  `nim` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `anggota` (`nim`, `nama`, `jurusan`) VALUES
('100',	'Dewi',	'Sistem Informasi'),
('200',	'M Asad',	'Sistem Informasi'),
('300',	'Ali',	'Teknik Informatika'),
('400',	'Bagus',	'Sistem Informasi'),
('900',	'M Aulia',	'Sistem Informasi');

CREATE TABLE `kategori_buku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kategori_buku` (`id`, `nama`) VALUES
(1, 'Web Programming'),
(2, 'Other Programming');

CREATE TABLE `buku` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kategori_id` int(10) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `stok` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `buku` (`id`, `kategori_id`, `judul`, `stok`) VALUES
(1,	1,	'PHP Fundamental',	9),
(2,	2,	'JAVA for Beginner',	12),
(3,	2,	'Phyton is Easy',	29),
(4,	2,	'Android Development',	6),
(5,	1,	'HTML Tutorial',	28),
(6,	2,	'iOS Swift',	8),
(7,	2,	'React Native',	20);

CREATE TABLE `denda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) NOT NULL,
  `biaya` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `denda` (`id`, `jenis`, `biaya`) VALUES
(1,	'Terlambat',	10000),
(2,	'Buku Rusak',	30000),
(3,	'Buku Hilang',	100000);

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `petugas` (`id`, `nama`) VALUES
(1, 'Rahmat'),
(2, 'Inna'),
(3, 'Jihan');

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `petugas_id` int(11) DEFAULT NULL,
  `nim` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `expired` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `type`, `petugas_id`, `nim`, `username`, `password`, `nama`, `token`, `expired`) VALUES
(1, 'admin',  NULL, NULL, 'admin',  '21232f297a57a5a743894a0e4a801fc3', 'Admin',  '786655fgfyt456rhfgfdr65666', '2020-06-27 10:35:58'),
(2, 'petugas',  1,  NULL, 'rahmat', 'af2a4c9d4c4956ec9d6ba62213eed568', 'Rahmat Oktavian',  '', '2020-06-27 10:35:39'),
(3, 'petugas',  2,  NULL, 'inna', '18aa53c0ac2859deaca6674ee136809c', 'Inna', '', '2020-06-27 10:35:39'),
(4, 'anggota',  NULL, 200,  'masad',  '934ed925d66c2b586d436b93cb496e4b', 'M Asad', '', '2020-06-27 10:35:39'),
(5, 'anggota',  0,  400,  'bagus',  '17b38fc02fd7e92f3edeb6318e3066d8', 'Bagus',  '', '2020-06-27 10:35:39'),
(6, 'petugas',  3,  0,  'jihan',  '1e936f291742d21affc292460409e215', 'Jihan',  '', '2020-06-27 10:35:39');


CREATE TABLE `peminjaman` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nim` varchar(15) NOT NULL,
  `petugas_id` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `batas_tanggal_kembali` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKpeminjaman212020` (`nim`),
  KEY `FKpeminjaman186144` (`petugas_id`),
  CONSTRAINT `FKpeminjaman186144` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`),
  CONSTRAINT `FKpeminjaman212020` FOREIGN KEY (`nim`) REFERENCES `anggota` (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `peminjaman` (`id`, `nim`, `petugas_id`, `tanggal_pinjam`, `batas_tanggal_kembali`) VALUES
(1,	'100',	2,	'2020-03-01',	'2020-03-07'),
(2,	'200',	1,	'2020-03-02',	'2020-03-09'),
(3,	'100',	2,	'2020-03-10',	'2020-03-17'),
(4,	'300',	2,	'2020-03-05',	'2020-03-12'),
(5,	'400',	1,	'2020-03-06',	'2020-03-14'),
(6,	'100',	2,	'2020-03-20',	'2020-03-27'),
(7,	'900',	1,	'2020-06-26',	'2020-07-03'),
(8,	'300',	1,	'2020-06-27',	'2020-07-03'),
(9,	'100',	1,	'2020-06-26',	'2020-07-03'),
(10,	'200',	3,	'2020-06-26',	'2020-07-03'),
(11,	'900',	2,	'2020-06-27',	'2020-07-04');

CREATE TABLE `peminjaman_buku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `peminjaman_id` int(10) NOT NULL,
  `buku_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `peminjaman_id_buku_id` (`peminjaman_id`,`buku_id`),
  KEY `FKpeminjaman210373` (`peminjaman_id`),
  KEY `FKpeminjaman870930` (`buku_id`),
  CONSTRAINT `FKpeminjaman210373` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`),
  CONSTRAINT `FKpeminjaman870930` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `peminjaman_buku` (`id`, `peminjaman_id`, `buku_id`) VALUES
(1,	1,	1),
(2,	1,	3),
(3,	1,	4),
(4,	2,	2),
(5,	2,	3),
(6,	3,	2),
(7,	3,	4),
(8,	3,	5),
(10,	4,	5),
(11,	5,	2),
(12,	5,	4),
(13,	5,	5),
(14,	6,	1),
(15,	6,	4),
(26,	8,	1),
(27,	8,	2),
(29,	8,	5),
(17,	9,	2),
(18,	9,	3),
(24,	9,	5),
(16,	9,	6);

CREATE TABLE `pengembalian` (
  `peminjaman_id` int(10) NOT NULL,
  `petugas_id` int(11) NOT NULL,
  `tanggal_kembali` date NOT NULL,
  PRIMARY KEY (`peminjaman_id`),
  KEY `petugas_id` (`petugas_id`),
  CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pengembalian` (`peminjaman_id`, `petugas_id`, `tanggal_kembali`) VALUES
(1,	1,	'2020-03-06'),
(2,	2,	'2020-03-10'),
(4,	2,	'2020-03-12'),
(5,	2,	'2020-03-20'),
(10,	1,	'0000-00-00'),
(11,	2,	'0000-00-00');

CREATE TABLE `pengembalian_buku` (
  `peminjaman_id` int(10) NOT NULL,
  `buku_id` int(10) NOT NULL,
  `buku_rusak` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`peminjaman_id`,`buku_id`),
  KEY `peminjaman_id` (`peminjaman_id`),
  KEY `buku_id` (`buku_id`),
  CONSTRAINT `pengembalian_buku_ibfk_1` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`),
  CONSTRAINT `pengembalian_buku_ibfk_2` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pengembalian_buku` (`peminjaman_id`, `buku_id`, `buku_rusak`) VALUES
(1,	1,	0),
(1,	3,	0),
(1,	4,	0),
(2,	2,	1),
(2,	3,	0),
(4,	1,	0),
(5,	2,	1),
(5,	5,	1);

CREATE TABLE `pengembalian_denda` (
  `peminjaman_id` int(10) NOT NULL,
  `denda_id` int(11) NOT NULL,
  `qty` double NOT NULL,
  `nominal` double NOT NULL,
  PRIMARY KEY (`peminjaman_id`,`denda_id`),
  KEY `denda_id` (`denda_id`),
  CONSTRAINT `pengembalian_denda_ibfk_1` FOREIGN KEY (`denda_id`) REFERENCES `denda` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pengembalian_denda` (`peminjaman_id`, `denda_id`, `qty`, `nominal`) VALUES
(2,	1,	2,	20000),
(4,	3,	1,	100000),
(5,	1,	8,	80000),
(5,	2,	2,	60000),
(5,	3,	1,	100000);
-- 2020-06-30 02:57:12
