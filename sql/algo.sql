DROP TABLE IF EXISTS `algo_dataset`;
CREATE TABLE `algo_dataset` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender` varchar(50) NOT NULL,
  `status_mhs` varchar(50) NOT NULL,
  `status_nikah` varchar(50) NOT NULL,
  `status_lulus` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `algo_dataset` (`id`, `gender`, `status_mhs`, `status_nikah`, `status_lulus`) VALUES
(1,	'LAKI-LAKI',	'MAHASISWA',	'BELUM',	'TEPAT'),
(2,	'LAKI-LAKI',	'BEKERJA',	'BELUM',	'TEPAT'),
(3,	'PEREMPUAN',	'MAHASISWA',	'BELUM',	'TEPAT'),
(4,	'PEREMPUAN',	'MAHASISWA',	'MENIKAH',	'TEPAT'),
(5,	'LAKI-LAKI',	'BEKERJA',	'MENIKAH',	'TEPAT'),
(6,	'LAKI-LAKI',	'BEKERJA',	'MENIKAH',	'TERLAMBAT'),
(7,	'PEREMPUAN',	'BEKERJA',	'MENIKAH',	'TERLAMBAT'),
(8,	'PEREMPUAN',	'BEKERJA',	'BELUM',	'TERLAMBAT'),
(9,	'LAKI-LAKI',	'BEKERJA',	'BELUM',	'TERLAMBAT'),
(10,	'PEREMPUAN',	'MAHASISWA',	'MENIKAH',	'TERLAMBAT'),
(11,	'PEREMPUAN',	'MAHASISWA',	'BELUM',	'TERLAMBAT'),
(12,	'PEREMPUAN',	'MAHASISWA',	'BELUM',	'TEPAT'),
(13,	'LAKI-LAKI',	'BEKERJA',	'MENIKAH',	'TEPAT'),
(14,	'LAKI-LAKI',	'MAHASISWA',	'MENIKAH',	'TEPAT'),
(15,	'LAKI-LAKI',	'MAHASISWA',	'BELUM',	'TEPAT');

DROP TABLE IF EXISTS `algo_result`;
CREATE TABLE `algo_result` (
  `id` int NOT NULL AUTO_INCREMENT,
  `param` varchar(255) NOT NULL,
  `param_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `data_count` double NOT NULL,
  `data_total` double NOT NULL,
  `result` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
