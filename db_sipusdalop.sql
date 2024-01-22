-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: https://github.com/azzadi/sipusdalops.github.io
-- Waktu pembuatan: 08 Jan 2024 pada 10.21
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sipusdalop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_kejadian`
--

CREATE TABLE `laporan_kejadian` (
  `id_laporan` int(11) NOT NULL,
  `tanggal_kejadian` date NOT NULL,
  `tanggal_entry_kejadian` date NOT NULL,
  `lokasi_jalan` varchar(255) DEFAULT NULL,
  `jenis_kejadian_bencana` varchar(255) NOT NULL,
  `kronologi_kejadian` varchar(255) NOT NULL,
  `kerugian_usulan_rp` varchar(50) NOT NULL,
  `kerugian_pengajuan_dana_td` varchar(50) NOT NULL,
  `kerugian_realisasi` varchar(50) NOT NULL,
  `data_korban_kerusakan` varchar(255) NOT NULL,
  `keterangan_bantuan` varchar(255) NOT NULL,
  `petugas_entry` varchar(255) NOT NULL,
  `rt` varchar(255) NOT NULL,
  `rw` varchar(255) NOT NULL,
  `dusun` varchar(255) NOT NULL,
  `Kecamatan` varchar(255) NOT NULL,
  `desa_kelurahan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laporan_kejadian`
--

INSERT INTO `laporan_kejadian` (`id_laporan`, `tanggal_kejadian`, `tanggal_entry_kejadian`, `lokasi_jalan`, `jenis_kejadian_bencana`, `kronologi_kejadian`, `kerugian_usulan_rp`, `kerugian_pengajuan_dana_td`, `kerugian_realisasi`, `data_korban_kerusakan`, `keterangan_bantuan`, `petugas_entry`, `rt`, `rw`, `dusun`, `Kecamatan`, `desa_kelurahan`) VALUES
(1, '2024-01-02', '2024-01-09', 'jln nusa indah', 'Angin Kencang', 'stsststtttttt', '3000000', '2000000', '1000000', 'rusak ringan', 'sembako', 'aku', '2', '3', 'panjen', 'kepanjen', 'Kepanjen'),
(2, '2024-01-08', '2024-01-08', ' jl.trunojoyo kepanjen', 'banjir', 'hujan deras mengakibatkan banjir genangan di jl.trunojoyo kepanjen', '1000000', '1000000', '950000', '0', '0', 'misalnya johan', '1', '1', 'kedung pedaringan', 'kepanjen', 'kepanjen'),
(3, '2024-01-05', '2024-01-05', 'malang', 'banjir', 'hujan lebat selama 2 jam', '100000000', '50000000', '90000000', '0', 'logistik', 'yudha', '01', '05', 'kampung baru', 'baru', 'sukun'),
(4, '2024-01-08', '2024-01-08', 'Lat:-8.196229, Long:112.825296', 'Tanah Longsor', 'Hujan deras selama kurleb 2 jam menyebabkan tebing di tepi Jalan antara Dusun Sanggrahan menuju Dusun Arjosari Desa Ampelgading Kec. Tirtoyudo setinggi 15 meter sepanjang 50 meter dengan ketebalan antara 0,5 sampai 1 meter longsor dan menimbun badan jalan', '-', '-', '-', 'Saluran drainage jalan sepanjang 50 meter', '-', 'Indra', '-', '-', 'Sanggrahan', 'Tirtoyudo', 'Ampelgading');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(35) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(255) DEFAULT NULL,
  `password_expire_date` datetime DEFAULT '2024-04-08 00:00:00',
  `password_reset_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `photo`, `login_session_key`, `email_status`, `password_expire_date`, `password_reset_key`) VALUES
(1, 'admin', '$2y$10$CSErYS2WK0MbPB8x1RlfGedZkyoxFobmZWIrVzuSE9G42wTozNTGu', 'azzadi241@gmail.com', 'http://localhost/sipusdalops/uploads/files/u5fbjow1hnv2l69.png', NULL, NULL, '2024-04-08 00:00:00', NULL),
(2, 'user', '$2y$10$LejxTtue80D5TLUg.iR0PekJbkjAlf6rIlZ.53hZtka8s0FFBFVFa', 'trip1@gmail.com', 'http://192.168.0.120/sipusdalops/uploads/files/a1tenrbuxz5g_hv.jpg', NULL, NULL, '2024-04-08 00:00:00', NULL),
(3, 'johan', '$2y$10$8P5qfWMi7ekC9ojHIAz5fO0gMVfju9aESEglWg9HOQfk4yS9yuhWy', 'bro695847@gmail.com', 'http://192.168.0.120/sipusdalops/uploads/files/m1vuep9tzkcrwfg.jpeg', NULL, NULL, '2024-04-08 00:00:00', NULL),
(4, 'Yuli', '$2y$10$S9qjoT7FDYo.VmI1H7LPcO1HqXoGfjco0V2Yw5wRocuyZUJ8Z31cG', 'yoelidharma@gmail.com', 'http://192.168.0.120/sipusdalops/uploads/files/q_0u2sd5ak6iomf.jpg', NULL, NULL, '2024-04-08 00:00:00', NULL),
(5, 'INDRA', '$2y$10$/gM.EER8xjiwr3908/PCiOZ3Bt/hX6nNGs1a77y4ULVUr.MWqU8MK', 'indra73ermawan@gmail.com', 'http://192.168.0.120/sipusdalops/uploads/files/n6uijbas9h5ml3_.jpeg', '0c82bd88d7fd9a534717ed0b854d057e', NULL, '2024-04-08 00:00:00', NULL),
(6, 'User12', '$2y$10$7a/geANi9l9bG9cgDkM2n.qw59swjnX2bHvCwrkZeEQzWHJBMHBuq', 'evakhoir@gmail.com', 'http://192.168.0.120/sipusdalops/uploads/files/103mvpxad6c_n4o.jpg', NULL, NULL, '2024-04-08 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `laporan_kejadian`
--
ALTER TABLE `laporan_kejadian`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `laporan_kejadian`
--
ALTER TABLE `laporan_kejadian`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
