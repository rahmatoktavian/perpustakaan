DROP TABLE IF EXISTS `user_type`;
CREATE TABLE `user_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `user_type` (`id`, `nama`) VALUES
(1,	'petugas'),
(2,	'anggota');

ALTER TABLE `user`
ADD `user_type_id` int NOT NULL AFTER `id`;

DROP TABLE IF EXISTS `akses`;
CREATE TABLE `akses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int NOT NULL DEFAULT '0',
  `nama` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `urutan` smallint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `akses` (`id`, `pid`, `nama`, `icon`, `link`, `urutan`) VALUES
(1,	0,	'Peminjaman Saya',	'fa-book',	'peminjaman_saya/read',	1),
(2,	0,	'Dashboard',	'fa-tachometer-alt',	'dashboard/index',	1),
(3,	0,	'Input Peminjaman',	'fa-clipboard',	'peminjaman/read',	2),
(4,	0,	'Laporan',	'',	'',	3),
(5,	4,	'Grafik Peminjaman',	'fa-tachometer-alt',	'grafik/rekap_peminjaman',	1),
(6,	4,	'Laporan Peminjaman',	'fa-clipboard',	'laporan/rekap_peminjaman',	2),
(7,	4,	'Detail Peminjaman',	'fa-list',	'laporan/detail_peminjaman',	3),
(8,	0,	'Setting',	'',	'',	4),
(9,	4,	'Buku',	'fa-book',	'buku/read',	1),
(10,	4,	'Anggota',	'fa-user',	'anggota/read',	2),
(11,	4,	'Petugas',	'fa-user-circle',	'petugas/read',	3);

DROP TABLE IF EXISTS `user_type_akses`;
CREATE TABLE `user_type_akses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_type_id` int NOT NULL,
  `akses_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_type_id` (`user_type_id`),
  KEY `akses_id` (`akses_id`),
  CONSTRAINT `user_type_akses_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`),
  CONSTRAINT `user_type_akses_ibfk_2` FOREIGN KEY (`akses_id`) REFERENCES `akses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `user_type_akses` (`id`, `user_type_id`, `akses_id`) VALUES
(1,	1,	2),
(2,	1,	3),
(3,	1,	4),
(4,	1,	5),
(5,	1,	6),
(6,	1,	7),
(7,	1,	8),
(8,	1,	9),
(9,	1,	10),
(10,	1,	11),
(11,	2,	1);