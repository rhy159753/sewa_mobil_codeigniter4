-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jan 2021 pada 13.50
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sewamobil`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_bayar`
--

CREATE TABLE `jenis_bayar` (
  `id` int(11) NOT NULL,
  `jenis_bayar` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_bayar`
--

INSERT INTO `jenis_bayar` (`id`, `jenis_bayar`) VALUES
(3, 'Cash'),
(4, 'Credit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `merk`
--

CREATE TABLE `merk` (
  `id` int(11) NOT NULL,
  `merk` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `merk`
--

INSERT INTO `merk` (`id`, `merk`) VALUES
(8, 'Toyota'),
(9, 'Suzuki'),
(10, 'Lexus'),
(12, 'Pagani'),
(13, 'Peugeot');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil`
--

CREATE TABLE `mobil` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `warna` varchar(20) DEFAULT NULL,
  `no_polisi` varchar(10) DEFAULT NULL,
  `jumlah_kursi` int(1) DEFAULT NULL,
  `tahun_beli` int(4) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL COMMENT 'Per Hari',
  `status` varchar(40) NOT NULL,
  `id_merk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`id`, `nama`, `warna`, `no_polisi`, `jumlah_kursi`, `tahun_beli`, `harga`, `status`, `id_merk`) VALUES
(13, 'Toyota Kijang Innova', 'Putih', 'DK 3328 KK', 6, 2019, 150000, 'Booked', 8),
(14, 'New Avanza Veloz', 'Abu Abu', 'DK 1109 KN', 7, 2018, 150000, 'Sedang Digunakan', 8),
(15, 'Suzuki All New Ertiga', 'Putih', 'DK 1899 KI', 4, 2018, 120000, 'Sedang Digunakan', 9),
(17, 'IS300', 'Merah Muda', 'DK 3552 AW', NULL, 2018, 435000, 'Ready', 10),
(18, 'Peugeot 207', 'Merah', 'DK 1233 KK', NULL, 2019, 300000, 'Ready', 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `total` int(11) NOT NULL,
  `id_pemesan` int(11) DEFAULT NULL,
  `id_mobil` int(11) DEFAULT NULL,
  `id_jenis_bayar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `tgl_pinjam`, `tgl_kembali`, `total`, `id_pemesan`, `id_mobil`, `id_jenis_bayar`) VALUES
(1, '2020-01-01', '2020-01-04', 600000, 2, 13, 3),
(6, '2020-01-17', '2020-01-20', 600000, 2, 14, 3),
(8, '2020-01-18', '2020-01-20', 360000, 4, 15, 3),
(16, '2021-01-18', '2021-01-20', 450000, 1, 13, 4),
(17, '2021-01-18', '2021-01-18', 150000, 4, 14, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_password` varchar(200) DEFAULT NULL,
  `user_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_created_at`, `level`) VALUES
(1, 'Administrator', 'admin@example.com', '$2y$10$lLmMwjvO/JSj8UaRnlno3.nqpPuLRQBLSGmBnWPJ/mldsHMqqmk0O', '2021-01-16 07:35:27', 'admin'),
(2, 'Abe', 'abe@example.com', '$2y$10$bdmEp0V8hmj0MYakjoP6V.MWxMHv2.Vth6jcDz5/PoQEEWae6Y7U2', '2021-01-16 07:38:10', 'user'),
(4, 'Lala', 'lala@example.com', '$2y$10$xHp7cuCp0o8tkG4AmAMYEO6LWns8Hzul1H21cmskzqBCuY5DhZ7gK', '2021-01-16 08:52:51', 'user'),
(6, 'Lily', 'lily@example.com', '$2y$10$cV4QqB99Rx6A5CDRqEl.0uBVpa/kt.BiQyo/kurl2GuY1juuRnsmu', '2021-01-17 08:12:42', 'user'),
(7, 'Ina', 'ina@example.com', '$2y$10$9PqDwETCL28fRzI4NAL6AegHqKfGpefbjW7JofhJ8WTpVxT8178lq', '2021-01-17 08:58:12', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jenis_bayar`
--
ALTER TABLE `jenis_bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_mobil_ibfk_2` (`id_merk`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemesan` (`id_pemesan`),
  ADD KEY `id_mobil` (`id_mobil`),
  ADD KEY `id_jenis_bayar` (`id_jenis_bayar`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis_bayar`
--
ALTER TABLE `jenis_bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `merk`
--
ALTER TABLE `merk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
