-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2023 at 04:26 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_desi`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` varchar(64) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `level` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `nama`, `email`, `level`) VALUES
('23432', 'Dr. Happy Hogan ', 'ewd@fdfd.s', 'admin'),
('352016', 'DESIRE', 'pele@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `nama` varchar(256) NOT NULL,
  `singkatan` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`nama`, `singkatan`) VALUES
('Ilmu Pengetahuan Alam', 'IPA'),
('Ilmu Pengetahuan Sosial', 'IPS');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pelanggaran`
--

CREATE TABLE `kategori_pelanggaran` (
  `nama_pelanggaran` varchar(256) NOT NULL,
  `poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_pelanggaran`
--

INSERT INTO `kategori_pelanggaran` (`nama_pelanggaran`, `poin`) VALUES
('memukul', 5),
('mencuri', 20),
('menyolong', 10);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `nama` varchar(256) NOT NULL,
  `jurusan` varchar(64) NOT NULL,
  `wali_kelas` varchar(64) NOT NULL,
  `total_siswa` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`nama`, `jurusan`, `wali_kelas`, `total_siswa`) VALUES
('X IPA 1', 'IPA', '352016', 2),
('X IPA 2', 'IPA', '23432', 1),
('X IPS 1', 'IPS', '352016', 0);

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` int(11) NOT NULL,
  `sender_id` varchar(64) NOT NULL,
  `receiver_id` varchar(64) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`) VALUES
(1, '352011', '352016', 'hallo bu guru, saya mau konsultasi.\nteman saya saat berangkat sekolah cuma di beri uang saku 5ribu sama orang tua nya. Saya kasihan karena sedikit sedangkan uang saku saya 40ribu setiap berangkat sekolah, apa uang teman saya, saya minta sekalian saja ya ibu, biar dia tidak usah punya uang sekalian daripada sedikit mwehehe...', '2023-04-03 14:40:29'),
(2, '352011', '352016', 'baeq ibu, tx..', '2023-04-05 13:27:44'),
(5, '352011', '352016', 'eh tapi ibu', '2023-04-05 13:46:15'),
(6, '352011', '352016', 'yasudahlah', '2023-04-05 13:46:30'),
(8, '352011', '352016', 'entahlah, apa', '2023-04-05 14:23:11'),
(9, '352011', '23432', 'tes', '2023-04-05 14:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `list_pelanggaran`
--

CREATE TABLE `list_pelanggaran` (
  `id` int(11) NOT NULL,
  `nisn_siswa` varchar(64) NOT NULL,
  `dilaporkan_oleh` varchar(64) NOT NULL,
  `wali_kelas` varchar(64) NOT NULL,
  `kategori_pelanggaran` varchar(256) NOT NULL,
  `keterangan_tindakan` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `list_pelanggaran`
--

INSERT INTO `list_pelanggaran` (`id`, `nisn_siswa`, `dilaporkan_oleh`, `wali_kelas`, `kategori_pelanggaran`, `keterangan_tindakan`) VALUES
(1, '34125689', '352016', '23432', 'memukul', 'bertindak selayaknya ia playboy'),
(4, '0208990001', '23432', '352016', 'mencuri', 'pitnah iki hooh tenan');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `nama_website` varchar(256) NOT NULL,
  `total_poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `nama_website`, `total_poin`) VALUES
(1, 'SMKN 2 Bangkalan', 15);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` varchar(64) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `kelas_siswa` varchar(64) NOT NULL,
  `jurusan` varchar(64) NOT NULL,
  `orang_tua` varchar(256) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `kontak` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nama`, `email`, `kelas_siswa`, `jurusan`, `orang_tua`, `alamat`, `kontak`) VALUES
('0208990001', 'imam fadhkur rokhim', 'imamfadhkur.com@gmail.com', 'X IPA 1', 'IPA', 'mr. n', 'Magetan', '082139897151'),
('34125689', 'aka tony', 'aka@gmail.com', 'X IPA 2', 'IPA', 'howard', 'stark', '3562313232323'),
('352011', 'Alif Fadhillah At Thariq', 'alif@gmail.com', 'X IPA 1', 'IPA', 'Hasan', 'Junok', '083888333777');

--
-- Triggers `siswa`
--
DELIMITER $$
CREATE TRIGGER `after_delete_update_jumlah_siswa` AFTER DELETE ON `siswa` FOR EACH ROW BEGIN
  UPDATE kelas
  SET total_siswa = (SELECT COUNT(*) FROM siswa WHERE kelas_siswa = kelas.nama)
  WHERE kelas.nama = OLD.kelas_siswa;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_update_jumlah_siswa` AFTER INSERT ON `siswa` FOR EACH ROW BEGIN
  UPDATE kelas
  SET total_siswa = (SELECT COUNT(*) FROM siswa WHERE kelas_siswa = kelas.nama)
  WHERE kelas.nama = NEW.kelas_siswa;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_update_jumlah_siswa` AFTER UPDATE ON `siswa` FOR EACH ROW BEGIN
  UPDATE kelas
  SET total_siswa = (SELECT COUNT(*) FROM siswa WHERE kelas_siswa = kelas.nama)
  WHERE kelas.nama = NEW.kelas_siswa OR kelas.nama = OLD.kelas_siswa;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(11) NOT NULL,
  `id_konsultasi` int(11) NOT NULL,
  `pemberi_tanggapan` varchar(64) NOT NULL,
  `isi_tanggapan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_konsultasi`, `pemberi_tanggapan`, `isi_tanggapan`, `created_at`) VALUES
(1, 1, '352016', 'boleh silahkan, setelah itu uangnya+uangmu kasih ke ibu ya, biar ibu kasih kan ke itu anak :)', '2023-04-04 15:05:27'),
(2, 1, '352016', 'enggak enggak, bercanda kok. boleh kamu minta, tapi nanti setelah kamu minta kasih ke ibu ya uangnya, buat jajan ibu.', '2023-04-05 12:51:10'),
(3, 1, '352016', 'balasan tanggapan dari admin/BK', '2023-04-05 14:04:50');

-- --------------------------------------------------------

--
-- Table structure for table `tata_tertib`
--

CREATE TABLE `tata_tertib` (
  `jenis_tatib` varchar(256) NOT NULL,
  `keterangan` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tata_tertib`
--

INSERT INTO `tata_tertib` (`jenis_tatib`, `keterangan`) VALUES
('dilarang pacaran', 'dilarang memiliki hubungan spesial dari lawan jenis, semua dianggap sama (equal) yaitu fiendship!'),
('mbolos', 'dilarang tidak hadir dengan tidak disertai alasan yang jelas!');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `level` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `level`) VALUES
('0208990001', '3e43121db6b7db3346b03856fbc42b8dbe2ee5f7daa19dc1e0b7288d7f487739', 'siswa'),
('21433', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'siswa'),
('23432', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin'),
('34125689', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', 'siswa'),
('352011', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'siswa'),
('352016', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_total_poin_siswa`
-- (See below for the actual view)
--
CREATE TABLE `view_total_poin_siswa` (
`total_poin` decimal(32,0)
,`nisn_siswa` varchar(64)
);

-- --------------------------------------------------------

--
-- Structure for view `view_total_poin_siswa`
--
DROP TABLE IF EXISTS `view_total_poin_siswa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_total_poin_siswa`  AS SELECT sum(`kategori_pelanggaran`.`poin`) AS `total_poin`, `list_pelanggaran`.`nisn_siswa` AS `nisn_siswa` FROM (`kategori_pelanggaran` join `list_pelanggaran` on(`kategori_pelanggaran`.`nama_pelanggaran` = `list_pelanggaran`.`kategori_pelanggaran`)) GROUP BY `list_pelanggaran`.`nisn_siswa``nisn_siswa`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`singkatan`);

--
-- Indexes for table `kategori_pelanggaran`
--
ALTER TABLE `kategori_pelanggaran`
  ADD PRIMARY KEY (`nama_pelanggaran`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`nama`),
  ADD KEY `jurusan` (`jurusan`),
  ADD KEY `wali_kelas` (`wali_kelas`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konsultasi_ibfk_1` (`receiver_id`),
  ADD KEY `konsultasi_ibfk_2` (`sender_id`);

--
-- Indexes for table `list_pelanggaran`
--
ALTER TABLE `list_pelanggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dilaporkan_oleh` (`dilaporkan_oleh`),
  ADD KEY `kategori_pelanggaran` (`kategori_pelanggaran`),
  ADD KEY `nisn_siswa` (`nisn_siswa`),
  ADD KEY `wali_kelas` (`wali_kelas`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `kelas_siswa` (`kelas_siswa`),
  ADD KEY `jurusan` (`jurusan`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`),
  ADD KEY `id_konsultasi` (`id_konsultasi`),
  ADD KEY `pemberi_tanggapan` (`pemberi_tanggapan`);

--
-- Indexes for table `tata_tertib`
--
ALTER TABLE `tata_tertib`
  ADD PRIMARY KEY (`jenis_tatib`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `list_pelanggaran`
--
ALTER TABLE `list_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `jurusan` FOREIGN KEY (`jurusan`) REFERENCES `jurusan` (`singkatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wali_kelas` FOREIGN KEY (`wali_kelas`) REFERENCES `guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`receiver_id`) REFERENCES `guru` (`nip`),
  ADD CONSTRAINT `konsultasi_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `siswa` (`nisn`);

--
-- Constraints for table `list_pelanggaran`
--
ALTER TABLE `list_pelanggaran`
  ADD CONSTRAINT `list_pelanggaran_ibfk_1` FOREIGN KEY (`dilaporkan_oleh`) REFERENCES `guru` (`nip`),
  ADD CONSTRAINT `list_pelanggaran_ibfk_2` FOREIGN KEY (`kategori_pelanggaran`) REFERENCES `kategori_pelanggaran` (`nama_pelanggaran`),
  ADD CONSTRAINT `list_pelanggaran_ibfk_3` FOREIGN KEY (`nisn_siswa`) REFERENCES `siswa` (`nisn`),
  ADD CONSTRAINT `list_pelanggaran_ibfk_4` FOREIGN KEY (`wali_kelas`) REFERENCES `guru` (`nip`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`kelas_siswa`) REFERENCES `kelas` (`nama`),
  ADD CONSTRAINT `siswa_ibfk_3` FOREIGN KEY (`jurusan`) REFERENCES `jurusan` (`singkatan`);

--
-- Constraints for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `tanggapan_ibfk_1` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id`),
  ADD CONSTRAINT `tanggapan_ibfk_2` FOREIGN KEY (`pemberi_tanggapan`) REFERENCES `guru` (`nip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
