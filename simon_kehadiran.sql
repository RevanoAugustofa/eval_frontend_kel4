-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2025 at 03:50 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simon_kehadiran`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nidn` int NOT NULL,
  `nama_dosen` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nidn`, `nama_dosen`, `id_user`) VALUES
(2206232, 'Windy Anggita', 4),
(2206233, 'Putri Aulia', 6),
(2206234, 'Surya Wijaya', 7);

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id_kehadiran` int NOT NULL,
  `tanggal` date NOT NULL,
  `pertemuan` int NOT NULL,
  `status` enum('Hadir','Alpha','Izin','Sakit') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `npm` int NOT NULL,
  `nidn` int NOT NULL,
  `kode_matkul` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kode_kelas` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kehadiran`
--

INSERT INTO `kehadiran` (`id_kehadiran`, `tanggal`, `pertemuan`, `status`, `npm`, `nidn`, `kode_matkul`, `kode_kelas`) VALUES
(1, '2025-02-11', 1, 'Hadir', 330102065, 2206232, 'SBD04', 'KLS03');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kode_kelas` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_kelas` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `nama_kelas`) VALUES
('KLS01', 'A'),
('KLS02', 'B'),
('KLS03', 'C'),
('KLS04', 'D'),
('KLS05', 'E');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `npm` int NOT NULL,
  `nama_mahasiswa` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_user` int NOT NULL,
  `kode_kelas` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `nama_mahasiswa`, `email`, `id_user`, `kode_kelas`) VALUES
(330102065, 'Ji Rizky Cahyusna', 'jicantik12@gmail.com', 2, 'KLS03'),
(330102066, 'Ibnu Zaki', 'ibnuzaki@gmail.com', 5, 'KLS05');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `kode_matkul` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_matkul` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sks` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`kode_matkul`, `nama_matkul`, `sks`) VALUES
('FIS02', 'Fisika', 2),
('JRM05', 'Jaringan Komputer', 3),
('MTK01', 'Matematika Dasar', 3),
('PGR03', 'Pemrograman Web', 4),
('SBD04', 'Sistem Basis Data', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `level` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
(2, 'Ji Rizky Cahyusna', 'nana12', 'mahasiswa'),
(3, 'Hana Kurnia', 'hana14', 'admin'),
(4, 'Windy Anggita', 'windy23', 'dosen'),
(5, 'Ibnu Zaki', 'ibnu22', 'mahasiswa'),
(6, 'Putri Aulia', 'putri29', 'dosen'),
(7, 'Surya Wijaya', 'surya30', 'dosen'),
(27, 'revano', '$2y$10$At2d0qjANJBnn2zqhBN4Te/', 'mahasiswa');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_dosen`
-- (See below for the actual view)
--
CREATE TABLE `v_dosen` (
`nama_dosen` varchar(30)
,`nidn` int
,`No` bigint unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_kehadiran_mahasiswa`
-- (See below for the actual view)
--
CREATE TABLE `v_kehadiran_mahasiswa` (
`id_kehadiran` int
,`nama_dosen` varchar(30)
,`nama_mahasiswa` varchar(30)
,`nama_matkul` varchar(30)
,`npm` int
,`pertemuan` int
,`status` enum('Hadir','Alpha','Izin','Sakit')
,`tanggal` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_kelas`
-- (See below for the actual view)
--
CREATE TABLE `v_kelas` (
`kode_kelas` varchar(5)
,`nama_kelas` varchar(30)
,`No` bigint unsigned
);

-- --------------------------------------------------------

--
-- Structure for view `v_dosen`
--
DROP TABLE IF EXISTS `v_dosen`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dosen`  AS SELECT row_number() OVER (ORDER BY `d`.`nidn` ) AS `No`, `d`.`nidn` AS `nidn`, `d`.`nama_dosen` AS `nama_dosen` FROM `dosen` AS `d``d`  ;

-- --------------------------------------------------------

--
-- Structure for view `v_kehadiran_mahasiswa`
--
DROP TABLE IF EXISTS `v_kehadiran_mahasiswa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_kehadiran_mahasiswa`  AS SELECT `kh`.`id_kehadiran` AS `id_kehadiran`, `m`.`npm` AS `npm`, `m`.`nama_mahasiswa` AS `nama_mahasiswa`, `kh`.`tanggal` AS `tanggal`, `kh`.`pertemuan` AS `pertemuan`, `kh`.`status` AS `status`, `mk`.`nama_matkul` AS `nama_matkul`, `d`.`nama_dosen` AS `nama_dosen` FROM (((`kehadiran` `kh` join `mahasiswa` `m` on((`kh`.`npm` = `m`.`npm`))) join `matkul` `mk` on((`kh`.`kode_matkul` = `mk`.`kode_matkul`))) join `dosen` `d` on((`kh`.`nidn` = `d`.`nidn`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `v_kelas`
--
DROP TABLE IF EXISTS `v_kelas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_kelas`  AS SELECT row_number() OVER (ORDER BY `kelas`.`kode_kelas` ) AS `No`, `kelas`.`kode_kelas` AS `kode_kelas`, `kelas`.`nama_kelas` AS `nama_kelas` FROM `kelas``kelas`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nidn`) USING BTREE,
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`) USING BTREE,
  ADD UNIQUE KEY `unique_kehadiran` (`npm`,`tanggal`,`pertemuan`) USING BTREE,
  ADD KEY `nidn` (`nidn`) USING BTREE,
  ADD KEY `kode_matkul` (`kode_matkul`) USING BTREE,
  ADD KEY `kode_kelas` (`kode_kelas`) USING BTREE;

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kode_kelas`) USING BTREE;

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`npm`) USING BTREE,
  ADD KEY `id_user` (`id_user`) USING BTREE,
  ADD KEY `kode_kelas` (`kode_kelas`) USING BTREE;

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`kode_matkul`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `id_kehadiran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `kehadiran_ibfk_1` FOREIGN KEY (`npm`) REFERENCES `mahasiswa` (`npm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kehadiran_ibfk_2` FOREIGN KEY (`nidn`) REFERENCES `dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kehadiran_ibfk_3` FOREIGN KEY (`kode_matkul`) REFERENCES `matkul` (`kode_matkul`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kehadiran_ibfk_4` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
