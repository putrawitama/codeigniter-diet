-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03 Okt 2017 pada 12.51
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diet`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bb_ideal`
--

CREATE TABLE `bb_ideal` (
  `id_ideal` int(50) NOT NULL,
  `tinggi` int(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `berat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bb_ideal`
--

INSERT INTO `bb_ideal` (`id_ideal`, `tinggi`, `gender`, `berat`) VALUES
(1, 146, 'P', '41-44'),
(2, 150, 'P', '43-45'),
(3, 152, 'P', '45-47'),
(4, 154, 'P', '47-49'),
(5, 154, 'L', '51-53'),
(6, 157, 'P', '48-52'),
(7, 157, 'L', '53-57'),
(8, 159, 'P', '49-55'),
(9, 159, 'L', '55-60'),
(10, 162, 'P', '51-57'),
(11, 162, 'L', '57-64'),
(12, 164, 'P', '52-60'),
(13, 164, 'P', '60-68'),
(14, 166, 'P', '53-63'),
(15, 166, 'L', '62-71'),
(16, 169, 'P', '55-65'),
(17, 169, 'L', '64-75'),
(18, 171, 'P', '56-68'),
(19, 171, 'L', '66-78'),
(20, 174, 'P', '57-70'),
(21, 174, 'L', '68-82'),
(22, 176, 'P', '59-72'),
(23, 176, 'L', '70-85'),
(24, 180, 'P', '60-74'),
(25, 180, 'L', '73-89'),
(26, 182, 'P', '61-76'),
(27, 182, 'L', '75-92'),
(28, 184, 'L', '77-96'),
(29, 187, 'L', '80-100'),
(30, 189, 'L', '82-103');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id_customer` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gelar` varchar(100) DEFAULT NULL,
  `telepon` varchar(12) DEFAULT NULL,
  `hp` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` char(1) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `gelar`, `telepon`, `hp`, `email`, `gender`, `tgl_lahir`, `tgl_daftar`) VALUES
('C1709261', 'Fathurrachman', 'S.Kom., M.Kom.,S.T', '', '083857234747', 'putrawitama@gmail.com', 'L', '1995-11-15', '2017-09-26'),
('C1709271', 'Sepdika Geia', 'S.Kom., M.Kom.', '08989898989', '0987766544', 'sepdikageia@gmail.com', 'L', '1971-06-16', '2017-09-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kadar_air`
--

CREATE TABLE `kadar_air` (
  `id_ka` int(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `air` int(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kadar_air`
--

INSERT INTO `kadar_air` (`id_ka`, `gender`, `air`, `keterangan`) VALUES
(1, 'P', 45, 'min'),
(2, 'P', 60, 'max'),
(3, 'L', 50, 'min'),
(4, ':L', 65, 'max');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kadar_lemak_perut`
--

CREATE TABLE `kadar_lemak_perut` (
  `id_klp` int(50) NOT NULL,
  `lemak` int(50) NOT NULL,
  `indikasi` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kadar_lemak_perut`
--

INSERT INTO `kadar_lemak_perut` (`id_klp`, `lemak`, `indikasi`, `keterangan`) VALUES
(1, 1, 'sehat ideal', 'pertahankan'),
(2, 2, 'sehat ideal', 'pertahankan'),
(3, 3, 'sehat ideal', 'pertahankan'),
(4, 4, 'sehat ideal', 'pertahankan'),
(5, 5, 'sehat ideal', 'pertahankan'),
(6, 6, 'cukup tinggi', 'masih merasa sehat mulai perhatikan pola makan !'),
(7, 7, 'cukup tinggi', 'masih merasa sehat mulai perhatikan pola makan !'),
(8, 8, 'cukup tinggi', 'masih merasa sehat mulai perhatikan pola makan !'),
(9, 9, 'cukup tinggi', 'masih merasa sehat mulai perhatikan pola makan !'),
(10, 10, 'kelebihan / tinggi (hati-hati !!)', 'ubah gaya hidup anda terutama pola makan !!'),
(11, 11, 'kelebihan / tinggi (hati-hati !!)', 'ubah gaya hidup anda terutama pola makan'),
(12, 12, 'kelebihan / tinggi (hati-hati !!)', 'ubah gaya hidup anda terutama pola makan'),
(13, 13, 'kelebihan / tinggi (hati-hati !!)', 'ubah gaya hidup anda terutama pola makan'),
(14, 14, 'kelebihan / tinggi (hati-hati !!)', 'ubah gaya hidup anda terutama pola makan'),
(15, 15, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(16, 16, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(17, 17, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(18, 18, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(19, 19, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(20, 25, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(21, 21, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(22, 22, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(23, 23, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(24, 24, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(25, 25, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(26, 26, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(27, 27, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(28, 28, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(29, 29, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(30, 30, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(31, 31, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(32, 32, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(33, 33, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(34, 34, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(35, 35, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(36, 36, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(37, 37, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(38, 38, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(39, 39, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(40, 40, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(41, 41, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(42, 42, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(43, 43, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(44, 44, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(45, 45, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(46, 46, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(47, 47, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(48, 48, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(49, 49, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(50, 50, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(51, 51, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(52, 52, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(53, 53, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(54, 54, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(55, 55, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(56, 56, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(57, 57, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(58, 58, 'diabetes (berbahaya !!)', 'turunkan berat badan !!'),
(59, 59, 'diabetes (berbahaya !!)', 'turunkan berat badan !!');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kadar_lemak_tubuh`
--

CREATE TABLE `kadar_lemak_tubuh` (
  `id_klt` int(50) NOT NULL,
  `usia` int(50) NOT NULL,
  `klt_wanita` int(50) NOT NULL,
  `klt_pria` int(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `massa_tulang`
--

CREATE TABLE `massa_tulang` (
  `id_mt` int(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `b_badan` int(50) NOT NULL,
  `b_tulang` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `massa_tulang`
--

INSERT INTO `massa_tulang` (`id_mt`, `gender`, `b_badan`, `b_tulang`) VALUES
(1, 'P', 49, 1.95),
(2, 'L', 49, 2.66),
(3, 'P', 50, 2.4),
(4, 'L', 50, 2.66),
(5, 'P', 51, 2.4),
(6, 'L', 51, 2.66),
(7, 'P', 52, 2.4),
(8, 'L', 52, 2.66),
(9, 'P', 53, 2.4),
(10, 'L', 53, 2.66),
(11, 'P', 54, 2.4),
(12, 'L', 54, 2.66),
(13, 'P', 55, 2.4),
(14, 'L', 56, 2.66),
(15, 'P', 57, 2.4),
(16, 'L', 57, 2.66),
(17, 'P', 58, 2.4),
(18, 'L', 58, 2.66),
(19, 'P', 59, 2.4),
(20, 'L', 59, 2.66),
(21, 'P', 60, 2.4),
(22, 'L', 60, 2.66),
(23, 'P', 61, 2.4),
(24, 'L', 61, 2.66),
(25, 'P', 62, 2.4),
(26, 'L', 62, 2.66),
(27, 'P', 63, 2.4),
(28, 'L', 63, 2.66),
(29, 'P', 64, 2.4),
(30, 'L', 64, 2.66),
(31, 'P', 65, 2.4),
(32, 'L', 65, 3.29),
(33, 'P', 66, 2.4),
(34, 'L', 66, 3.29),
(35, 'P', 67, 2.4),
(36, 'L', 67, 3.29),
(37, 'P', 68, 2.4),
(38, 'L', 69, 3.29),
(39, 'P', 70, 2.4),
(40, 'L', 70, 3.29),
(41, 'P', 71, 2.95),
(42, 'L', 71, 3.29),
(43, 'P', 72, 2.95),
(44, 'L', 72, 3.29),
(45, 'P', 73, 2.95),
(46, 'L', 73, 3.29),
(47, 'P', 74, 2.95),
(48, 'L', 75, 3.29),
(49, 'P', 76, 2.95),
(50, 'L', 76, 3.29),
(51, 'P', 77, 2.95),
(52, 'L', 77, 3.29),
(53, 'P', 78, 2.95),
(54, 'L', 78, 3.29),
(55, 'P', 78, 2.95),
(56, 'L', 78, 3.29),
(57, 'P', 79, 2.95),
(58, 'L', 79, 3.29),
(59, 'P', 80, 2.95),
(60, 'L', 80, 3.29),
(61, 'P', 81, 2.95),
(62, 'L', 81, 3.29),
(63, 'P', 82, 2.95),
(64, 'L', 82, 3.29),
(65, 'P', 83, 2.95),
(66, 'L', 83, 3.29),
(67, 'P', 84, 2.95),
(68, 'L', 84, 3.29),
(69, 'P', 85, 2.95),
(70, 'L', 85, 3.29),
(71, 'P', 86, 2.95),
(72, 'L', 86, 3.29),
(73, 'P', 87, 2.95),
(74, 'L', 87, 3.29),
(75, 'P', 88, 2.95),
(76, 'L', 88, 3.29),
(77, 'P', 89, 2.95),
(78, 'L', 89, 3.29),
(79, 'P', 90, 2.95),
(80, 'L', 90, 3.29),
(81, 'P', 91, 2.95),
(82, 'L', 91, 3.29),
(83, 'P', 92, 2.95),
(84, 'L', 92, 3.29),
(85, 'P', 93, 2.95),
(86, 'L', 93, 3.29),
(87, 'P', 94, 2.95),
(88, 'L', 94, 3.29),
(89, 'P', 95, 2.95),
(90, 'L', 95, 3.29),
(91, 'P', 96, 2.95),
(92, 'L', 96, 3.69);

-- --------------------------------------------------------

--
-- Struktur dari tabel `progress`
--

CREATE TABLE `progress` (
  `id_progress` int(11) NOT NULL,
  `id_customer` varchar(20) NOT NULL,
  `program` varchar(20) NOT NULL,
  `masalah` text NOT NULL,
  `tinggi` int(11) NOT NULL,
  `usia` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `progress`
--

INSERT INTO `progress` (`id_progress`, `id_customer`, `program`, `masalah`, `tinggi`, `usia`, `target`, `status`) VALUES
(5, 'C1709261', 'turun', 'Jemblung', 180, 22, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rumus`
--

CREATE TABLE `rumus` (
  `id_rumus` int(11) NOT NULL,
  `rumus` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `timbang`
--

CREATE TABLE `timbang` (
  `id_timbang` int(11) NOT NULL,
  `id_progress` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `minggu` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `body_fat` int(11) NOT NULL,
  `bon_mass` int(11) NOT NULL,
  `body_water` int(11) NOT NULL,
  `muscle_mass` int(11) NOT NULL,
  `rating_fisik` int(11) NOT NULL,
  `bmr` int(11) NOT NULL,
  `usia_sel` int(11) NOT NULL,
  `visceral_fat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `timbang`
--

INSERT INTO `timbang` (`id_timbang`, `id_progress`, `tanggal`, `minggu`, `berat`, `body_fat`, `bon_mass`, `body_water`, `muscle_mass`, `rating_fisik`, `bmr`, `usia_sel`, `visceral_fat`) VALUES
(3, 5, '2017-10-02', 0, 85, 20, 2, 50, 10, 8, 0, 21, 9),
(4, 6, '2017-10-03', 0, 90, 20, 2, 50, 10, 8, 0, 21, 9),
(5, 5, '2017-10-03', 0, 87, 20, 2, 50, 10, 8, 0, 21, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bb_ideal`
--
ALTER TABLE `bb_ideal`
  ADD PRIMARY KEY (`id_ideal`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `kadar_air`
--
ALTER TABLE `kadar_air`
  ADD PRIMARY KEY (`id_ka`);

--
-- Indexes for table `kadar_lemak_perut`
--
ALTER TABLE `kadar_lemak_perut`
  ADD PRIMARY KEY (`id_klp`);

--
-- Indexes for table `kadar_lemak_tubuh`
--
ALTER TABLE `kadar_lemak_tubuh`
  ADD PRIMARY KEY (`id_klt`);

--
-- Indexes for table `massa_tulang`
--
ALTER TABLE `massa_tulang`
  ADD PRIMARY KEY (`id_mt`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id_progress`);

--
-- Indexes for table `rumus`
--
ALTER TABLE `rumus`
  ADD PRIMARY KEY (`id_rumus`);

--
-- Indexes for table `timbang`
--
ALTER TABLE `timbang`
  ADD PRIMARY KEY (`id_timbang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bb_ideal`
--
ALTER TABLE `bb_ideal`
  MODIFY `id_ideal` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `kadar_air`
--
ALTER TABLE `kadar_air`
  MODIFY `id_ka` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kadar_lemak_perut`
--
ALTER TABLE `kadar_lemak_perut`
  MODIFY `id_klp` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `massa_tulang`
--
ALTER TABLE `massa_tulang`
  MODIFY `id_mt` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id_progress` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `rumus`
--
ALTER TABLE `rumus`
  MODIFY `id_rumus` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timbang`
--
ALTER TABLE `timbang`
  MODIFY `id_timbang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
