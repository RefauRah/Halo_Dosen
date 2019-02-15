-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2018 at 04:42 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `halodosen`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `NIP` varchar(100) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `PRODI` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`NIP`, `ID_USER`, `PRODI`) VALUES
('198009132006041002', 2, 'IF'),
('198310232009121005', 5, 'IF'),
('198907282015031002', 1, 'IF'),
('2007210054', 3, 'IF'),
('7634', 4, 'IF');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `ID_JADWAL` int(11) NOT NULL,
  `KD_RUANG` varchar(100) NOT NULL,
  `KODE_MK` varchar(50) NOT NULL,
  `NIP` varchar(100) NOT NULL,
  `WAKTU` varchar(50) NOT NULL,
  `KELAS` varchar(10) NOT NULL,
  `HARI` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`ID_JADWAL`, `KD_RUANG`, `KODE_MK`, `NIP`, `WAKTU`, `KELAS`, `HARI`) VALUES
(1, 'R.4.11', 'IF15401', '198907282015031002', '07:00-08:40', 'A', 4),
(2, 'R.4.11', 'IF15401', '198907282015031002', '08:40-10:20', 'B', 4),
(3, 'R.4.11', 'IF15401', '198907282015031002', '08:40-10:20', 'C', 4),
(4, 'R.4.11', 'IF15401', '198907282015031002', '10:20-12:00', 'D', 4),
(5, 'R.4.12', 'IF15406', '2007210054', '06:50-09:20', 'D', 0),
(6, 'R.4.09', 'IF15201', '198310232009121005', '08:40-10:20', 'A', 0),
(7, 'R.4.09', 'IF15201', '198310232009121005', '10:20-12:00', 'B', 0),
(8, 'R.4.09', 'IF15201', '198310232009121005', '08:40-10:20', 'C', 0),
(9, 'R.4.09', 'IF15201', '198310232009121005', '10:20-12:00', 'D', 0),
(10, 'R.4.12', 'IF15601', '198009132006041002', '07:00-09:30', 'A', 0),
(11, 'R.4.12', 'IF15601', '198009132006041002', '09:30-12:00', 'B', 0),
(12, 'R.4.10', 'IF15403', '198009132006041002', '12:40-14:20', 'C', 0),
(13, 'R.4.10', 'UN15206', '7634', '12:40-14:20', 'C', 0),
(14, 'R.4.10', 'UN15206', '7634', '14:20-16:00', 'D', 0),
(15, 'R.4.01', 'IF15401L', '198907282015031002', '06:50-08:30', 'D', 6);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NIM` varchar(100) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `JURUSAN` varchar(100) DEFAULT NULL,
  `SEMESTER` varchar(10) DEFAULT NULL,
  `NOTIF_SMS` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`NIM`, `ID_USER`, `JURUSAN`, `SEMESTER`, `NOTIF_SMS`) VALUES
('455878', 9, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `KODE_MK` varchar(50) NOT NULL,
  `NAMA_MK` varchar(100) NOT NULL,
  `SKS` int(11) NOT NULL,
  `SEMESTER_MK` varchar(10) NOT NULL,
  `JURUSAN_MK` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`KODE_MK`, `NAMA_MK`, `SKS`, `SEMESTER_MK`, `JURUSAN_MK`) VALUES
('FIS15101', 'Fisika Dasar', 2, '1', 'IF'),
('FIS15101L', 'Praktikum Fisika Dasar', 1, '1', 'IF'),
('IB15101', 'Praktek Ibadah', 0, '1', 'IF'),
('IF15101', 'Pengantar Informatika', 2, '1', 'IF'),
('IF15102', 'Dasar Pemrograman', 2, '1', 'IF'),
('IF15102L', 'Praktikum Dasar Pemrograman', 1, '1', 'IF'),
('IF15201', 'Algoritma dan Pemrograman', 2, '2', 'IF'),
('IF15201L', 'Praktikum Algoritma dan Pemrograman', 1, '2', 'IF'),
('IF15301', 'Struktur Data', 2, '3', 'IF'),
('IF15301L', 'Praktikum Struktur Data', 1, '3', 'IF'),
('IF15302', 'Organisasi dan Arsitektur Komputer', 3, '3', 'IF'),
('IF15401', 'Basis Data', 2, '4', 'IF'),
('IF15401L', 'Praktikum Basis Data', 1, '4', 'IF'),
('IF15402', 'Rekayasa Perangkat Lunak', 2, '4', 'IF'),
('IF15402L', 'Praktikum Rekayasa Perangkat Lunak', 1, '4', 'IF'),
('IF15403', 'Pemrograman Berorientasi Objek', 2, '4', 'IF'),
('IF15403L', 'Praktikum Pemrograman Berorientasi Objek', 1, '4', 'IF'),
('IF15404', 'Teori Bahasa dan Otomata', 3, '4', 'IF'),
('IF15405', 'Strategi Algoritma', 3, '4', 'IF'),
('IF15406', 'Sistem Operasi', 3, '4', 'IF'),
('IF15501', 'Sistem Basis Data', 2, '5', 'IF'),
('IF15501L', 'Praktikum Sistem Basis Data', 1, '5', 'IF'),
('IF15502', 'Jaringan Komputer', 2, '5', 'IF'),
('IF15502L', 'Praktikum Jaringan komputer', 1, '5', 'IF'),
('IF15503', 'Aplikasi Platform Khusus', 2, '5', 'IF'),
('IF15503L', 'Praktikum Aplikasi Platform Khusus', 1, '5', 'IF'),
('IF15504', 'Pengembangan Aplikasi Web', 2, '5', 'IF'),
('IF15504L', 'Praktikum Pengembangan Aplikasi Web', 1, '5', 'IF'),
('IF15505', 'Interaksi Manusia dan Komputer', 3, '5', 'IF'),
('IF15506', 'Intelegensia Buatan', 3, '5', 'IF'),
('IF15507', 'Manajemen Proyek Perangkat Lunak', 3, '5', 'IF'),
('IF15601', 'Sistem Informasi', 3, '6', 'IF'),
('IF15602', 'Proyek Perangkat Lunak', 3, '6', 'IF'),
('IF15603', 'Sistem Terdistribusi', 3, '6', 'IF'),
('IF15604', 'Grafika Komputer dan Visualisasi', 3, '6', 'IF'),
('IF15605', 'Komunikasi Antar personel', 2, '6', 'IF'),
('IF15606', 'Jaringan Komputer Lanjut', 2, '6', 'IF'),
('IF15606L', 'Praktikum Jaringan Komputer Lanjut', 1, '6', 'IF'),
('IF15701', 'RPl Spesifik Domain', 2, '7', 'IF'),
('IF15701L', 'Praktikum RPL Spesifik Domain', 1, '7', 'IF'),
('IF15701P', 'E-Commerce', 3, '7', 'IF'),
('IF15702', 'Sistem Multimedia', 2, '7', 'IF'),
('IF15702L', 'Praktikum Sistem Multimedia', 1, '7', 'IF'),
('IF15702P', 'Sistem Informasi Geogrfis', 3, '7', 'IF'),
('IF15703', 'Kewirausahaan dan Etika Bisnis', 2, '7', 'IF'),
('IF15703P', 'Wireless/ Mobile Computing', 2, '7', 'IF'),
('IF15703PL', 'Praktikum Wireless/ Mobile Computing', 1, '7', 'IF'),
('IF15704', 'ICT dan Islam', 2, '7', 'IF'),
('IF15704P', 'Mobile Programming', 2, '7', 'IF'),
('IF15704PL', 'Praktikum Mobile Programming', 1, '7', 'IF'),
('IF15705P', 'Sistem Basis Data Terdistribusi', 3, '7', 'IF'),
('IF15706P', 'Sistem Informasi Enterprise', 3, '7', 'IF'),
('IF15707P', 'Perawatan Perangkat Lunak', 3, '7', 'IF'),
('IF15708P', 'Data Mining', 3, '7', 'IF'),
('IF15709P', 'Information Retrieval', 3, '7', 'IF'),
('IF15710P', 'Sistem Cerdas', 3, '7', 'IF'),
('IF15711P', 'Parallel Computing', 3, '7', 'IF'),
('IF15712P', 'Pengolahan Citra Digital', 3, '7', 'IF'),
('IF15713P', 'Kriptografi', 2, '7', 'IF'),
('IF15713PL', 'Praktikum Kripitografi', 1, '7', 'IF'),
('IF8201L', 'Praktikum Dasar Pemrograman', 1, '2', 'IF'),
('IF8301', 'Algoritma dan Struktur Data', 2, '3', 'IF'),
('IF8301L', 'Praktikum Algoritma dan Struktur Data', 1, '3', 'IF'),
('KKM15801', 'Kuliah Kerja Mahasiswa', 2, '8', 'IF'),
('KM15801', 'Komprehensif', 0, '8', 'IF'),
('KP15601', 'Kerja Praktek', 2, '6', 'IF'),
('MAN15601', 'Manajemen', 2, '6', 'IF'),
('MAT15101', 'Kalkulus I', 3, '1', 'IF'),
('MAT15201', 'Kalkulus II', 3, '2', 'IF'),
('MAT15202', 'Logika Informatika', 3, '2', 'IF'),
('MAT15301', 'Aljabar Linier/Aljabar Geometri', 3, '3', 'IF'),
('MAT15302', 'Matematika Diskrit', 3, '3', 'IF'),
('MAT15303', 'Probabilitas dan Statistika', 3, '3', 'IF'),
('OR15101', 'Olahraga', 2, '1', 'IF'),
('TA15801', 'Tugas Akhir dan Seminar', 4, '8', 'IF'),
('TW15201', 'Praktek Tilawah', 0, '2', 'IF'),
('UN15101', 'Bahasa Arab', 2, '1', 'IF'),
('UN15102', 'Bahasa Inggris I', 2, '1', 'IF'),
('UN15201', 'Alquran dan Ilmu Tafsir', 2, '2', 'IF'),
('UN15202', 'Bahasa Inggris II ', 2, '2', 'IF'),
('UN15203', 'Pancasila/Kewarganegaraan', 2, '2', 'IF'),
('UN15204', 'Pengetahuan Lingkungan', 2, '2', 'IF'),
('UN15205', 'Bahasa Indonesia', 2, '2', 'IF'),
('UN15206', 'Ilmu Fiqih', 2, '2', 'IF'),
('UN15301', 'Sejarah Peradaban Islam', 2, '3', 'IF'),
('UN15302', 'Hadits dan Ilmu Hadits', 2, '3', 'IF'),
('UN15303', 'Ilmu Tauhud/ Aqidah', 2, '3', 'IF'),
('UN15407', 'Akhlak Tasawuf', 2, '4', 'IF');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `ID_NEWS` int(11) NOT NULL,
  `NIP` varchar(100) NOT NULL,
  `ID_JADWAL` int(11) NOT NULL,
  `JENIS_NEWS` varchar(50) NOT NULL,
  `PERINTAH` text,
  `TUGAS` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `KD_RUANG` varchar(100) NOT NULL,
  `NAMA_RUANG` varchar(100) NOT NULL,
  `JURUSAN_PEMAKAI` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`KD_RUANG`, `NAMA_RUANG`, `JURUSAN_PEMAKAI`) VALUES
('LAB-4.1', 'Lab. Dasar', 'IF'),
('LAB-4.2', 'Lab.Programming', 'IF'),
('LAB-4.3', 'Lab.Jaringan', 'IF'),
('R.4.01', 'R.4.01', 'IF'),
('R.4.02', 'Lab. Research and Development', 'IF'),
('R.4.03', 'Lab.Geographic Information System', 'IF'),
('R.4.04', 'Lab.Computer Networking', 'IF'),
('R.4.05', 'Lab.Multimedia', 'IF'),
('R.4.06', 'Lab.Programming', 'IF'),
('R.4.07', 'Lab.Database', 'IF'),
('R.4.08', 'R.4.08', 'IF'),
('R.4.09', 'R.4.09', 'IF'),
('R.4.10', 'R.4.10', 'IF'),
('R.4.11', 'R.4.11', 'IF'),
('R.4.12', 'R.4.12', 'IF');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `NIM` varchar(100) NOT NULL,
  `NIP` varchar(100) NOT NULL,
  `ID_JADWAL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`NIM`, `NIP`, `ID_JADWAL`) VALUES
('455878', '198907282015031002', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `NAMA` varchar(150) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `EMAIL` varchar(150) DEFAULT NULL,
  `NO_TELP` decimal(13,0) DEFAULT NULL,
  `LEVEL` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `NAMA`, `USERNAME`, `PASSWORD`, `EMAIL`, `NO_TELP`, `LEVEL`) VALUES
(1, 'Wildan Budiawan Zulfikar', 'wildan', 'budiawan', 'wildanbudiawan@gmail.com', '808080', 'dosen'),
(2, 'Ichsan Taufik', 'ICT', 'ichan', 'ichan_taufik@gmail.com', '85624261775', 'dosen'),
(3, 'Khaerul Manaf', 'khaer', 'khaerulm', 'khaerul_manaf@gmail.com', '81802225888', 'dosen'),
(4, 'Ali Khosim', 'al', 'ali', 'ali@gmail.com', '342356', 'dosen'),
(5, 'Mohamad Irfan', 'Moh', 'kajur', 'moh_irfan@gmail.com', '2342359', 'dosen'),
(9, 'Alwan Yassin', 'alwan', 'alwan', 'alwanyassin@gmail.com', '56498', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`NIP`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`ID_JADWAL`),
  ADD KEY `FK_RELATIONSHIP_4` (`KD_RUANG`),
  ADD KEY `FK_RELATIONSHIP_5` (`KODE_MK`),
  ADD KEY `FK_RELATIONSHIP_6` (`NIP`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NIM`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`KODE_MK`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID_NEWS`),
  ADD KEY `ID_JADWAL` (`ID_JADWAL`),
  ADD KEY `FK_RELATIONSHIP_7` (`NIP`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`KD_RUANG`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD KEY `ID_JADWAL` (`ID_JADWAL`),
  ADD KEY `NIM` (`NIM`),
  ADD KEY `NIP` (`NIP`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `ID_JADWAL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `ID_NEWS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`);

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`KD_RUANG`) REFERENCES `ruang` (`KD_RUANG`),
  ADD CONSTRAINT `FK_RELATIONSHIP_5` FOREIGN KEY (`KODE_MK`) REFERENCES `matakuliah` (`KODE_MK`),
  ADD CONSTRAINT `FK_RELATIONSHIP_6` FOREIGN KEY (`NIP`) REFERENCES `dosen` (`NIP`) ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `FK_RELATIONSHIP_7` FOREIGN KEY (`NIP`) REFERENCES `dosen` (`NIP`) ON UPDATE CASCADE,
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`ID_JADWAL`) REFERENCES `jadwal` (`ID_JADWAL`);

--
-- Constraints for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD CONSTRAINT `subscribe_ibfk_1` FOREIGN KEY (`ID_JADWAL`) REFERENCES `jadwal` (`ID_JADWAL`),
  ADD CONSTRAINT `subscribe_ibfk_2` FOREIGN KEY (`NIM`) REFERENCES `mahasiswa` (`NIM`),
  ADD CONSTRAINT `subscribe_ibfk_3` FOREIGN KEY (`NIP`) REFERENCES `dosen` (`NIP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
