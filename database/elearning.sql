-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 20, 2021 at 01:28 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id` int(11) NOT NULL,
  `idMapel` int(11) NOT NULL,
  `idSiswa` int(11) NOT NULL,
  `statusAbsensi` varchar(32) NOT NULL,
  `tgl_absen` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_aplikasi`
--

CREATE TABLE `tb_aplikasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `telp` varchar(16) NOT NULL,
  `alamat` text NOT NULL,
  `logo` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_aplikasi`
--

INSERT INTO `tb_aplikasi` (`id`, `nama`, `email`, `telp`, `alamat`, `logo`) VALUES
(1, 'E-learning | Oscar Store', 'nurmuhaidi@gmail.com', '089618367556', 'Ngasem Candi Rt. 03 Rw. 01 Kec. Batealit Kab. Jepara', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_daftarmapel`
--

CREATE TABLE `tb_daftarmapel` (
  `id` int(11) NOT NULL,
  `kode` varchar(64) NOT NULL,
  `mapel` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `id` int(11) NOT NULL,
  `kode` varchar(64) NOT NULL,
  `mapel` varchar(256) NOT NULL,
  `idGuru` int(11) NOT NULL,
  `idKelas` int(11) NOT NULL,
  `link` text NOT NULL,
  `status` varchar(8) NOT NULL,
  `hari` varchar(32) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_materi`
--

CREATE TABLE `tb_materi` (
  `id` int(11) NOT NULL,
  `idMapel` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `keterangan` text NOT NULL,
  `file` varchar(256) NOT NULL,
  `youtube` varchar(256) NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengumuman`
--

CREATE TABLE `tb_pengumuman` (
  `id` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tugas`
--

CREATE TABLE `tb_tugas` (
  `id` int(11) NOT NULL,
  `idMapel` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `keterangan` text NOT NULL,
  `file` varchar(256) NOT NULL,
  `youtube` varchar(256) NOT NULL,
  `waktu` datetime NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_upload_tugas`
--

CREATE TABLE `tb_upload_tugas` (
  `id` int(11) NOT NULL,
  `idMapel` int(11) NOT NULL,
  `idTugas` int(11) NOT NULL,
  `idSiswa` int(11) NOT NULL,
  `file` varchar(256) NOT NULL,
  `nilai` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `jenisKelamin` varchar(16) NOT NULL,
  `tptLahir` varchar(128) NOT NULL,
  `tglLahir` date NOT NULL,
  `telp` varchar(16) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `idKelas` int(11) NOT NULL,
  `foto` varchar(256) NOT NULL,
  `skin` varchar(8) NOT NULL,
  `level` enum('Administrator','Guru','Siswa') NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `jenisKelamin`, `tptLahir`, `tglLahir`, `telp`, `alamat`, `username`, `password`, `idKelas`, `foto`, `skin`, `level`, `terdaftar`) VALUES
(1, 'Muhammad Ikhsanuddin', 'Laki-Laki', 'Jepara', '2021-12-20', '089618367556', 'Jepara', 'admin', '$2y$10$PrXzsu8.0Bt28hCeY7b3Z.KbG.kienGNmyR41enHfByaXeFDA7C0e', 0, 'no-image.png', 'blue', 'Administrator', '2021-12-20 19:27:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_aplikasi`
--
ALTER TABLE `tb_aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_daftarmapel`
--
ALTER TABLE `tb_daftarmapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_materi`
--
ALTER TABLE `tb_materi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tugas`
--
ALTER TABLE `tb_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_upload_tugas`
--
ALTER TABLE `tb_upload_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_aplikasi`
--
ALTER TABLE `tb_aplikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_daftarmapel`
--
ALTER TABLE `tb_daftarmapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_materi`
--
ALTER TABLE `tb_materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_tugas`
--
ALTER TABLE `tb_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_upload_tugas`
--
ALTER TABLE `tb_upload_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
