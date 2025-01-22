-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 22 Jan 2025 pada 23.19
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kmp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id_masyarakat` int(11) NOT NULL,
  `get_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `dusun` enum('BATUPIAK','LIBA','BAU','TO COLLO','BUNTULIMBONG','LE TOBARA','SARANG','BUNGAMENDOE') NOT NULL,
  `NIK` varchar(16) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `status_keluarga` enum('KepalaKeluarga','Suami','Istri','Anak','Menantu','Cucu','Orangtua','Mertua') NOT NULL,
  `status_sekolah` enum('TidakSekolah','BelumSekolah','TK/PAUD','SD/SEDERAJAT','SMP/SEDERAJAT','SMA/SEDERAJAT','DI/DII/DIII','DIV/S1','S2') NOT NULL,
  `status_pekerjaan` enum('BELUM/TIDAKBEKERJA','PELAJAR/MAHASISWA','MENGURUSRUMAHTANGGA','PETANI/PEKEBUN','WIRASWASTA','KARYAWANSWASTA/HONORER','P3K','PNS','PENSIUNAN') NOT NULL,
  `agama` enum('Islam','KristenProtestan','KristenKatolik','Hindu','Buddha','Konghucu') NOT NULL,
  `warga_negara` enum('Indonesia') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `action_type` enum('created','updated','deleted') DEFAULT 'created',
  `penerima_raskin` enum('Ya','Tidak') NOT NULL DEFAULT 'Tidak',
  `penerima_BPJS` enum('Ya','Tidak') NOT NULL DEFAULT 'Tidak'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `masyarakat`
--

INSERT INTO `masyarakat` (`id_masyarakat`, `get_user`, `nama`, `dusun`, `NIK`, `jk`, `status_keluarga`, `status_sekolah`, `status_pekerjaan`, `agama`, `warga_negara`, `tgl_lahir`, `updated_at`, `action_type`, `penerima_raskin`, `penerima_BPJS`) VALUES
(24, 1, 'Ansar', 'BATUPIAK', '1234567890098769', 'L', 'KepalaKeluarga', 'BelumSekolah', 'PELAJAR/MAHASISWA', 'Islam', 'Indonesia', '1998-05-01', '2025-01-15 09:00:11', 'updated', 'Ya', 'Ya'),
(25, 1, 'Ija', 'BUNTULIMBONG', '1234567890098765', 'P', 'Istri', 'SMA/SEDERAJAT', 'WIRASWASTA', 'Islam', 'Indonesia', '2025-01-05', '2025-01-06 05:36:16', 'created', 'Ya', 'Ya'),
(26, 1, 'Risky Aulia', 'BUNTULIMBONG', '1234567890098760', 'P', 'Anak', 'SMA/SEDERAJAT', 'PELAJAR/MAHASISWA', 'Islam', 'Indonesia', '2025-01-01', '2025-01-06 05:51:28', 'created', 'Tidak', 'Ya'),
(27, 1, 'Risky Aulia B', 'LE TOBARA', '1234567890098766', 'P', 'Cucu', 'DIV/S1', 'WIRASWASTA', 'Islam', 'Indonesia', '2025-01-02', '2025-01-06 05:52:03', 'created', 'Tidak', 'Tidak'),
(28, 1, 'Risky Aulia N', 'SARANG', '1234567890098762', 'P', 'Orangtua', 'DIV/S1', 'PETANI/PEKEBUN', 'Islam', 'Indonesia', '2025-01-03', '2025-01-06 05:52:39', 'created', 'Ya', 'Tidak'),
(29, 1, 'Ansar B', 'TO COLLO', '1234567890098764', 'L', 'Anak', 'SMP/SEDERAJAT', 'WIRASWASTA', 'Hindu', 'Indonesia', '2025-01-01', '2025-01-11 07:25:30', 'updated', 'Tidak', 'Tidak'),
(30, 1, 'Rasna Wati', 'BUNGAMENDOE', '1234567890098761', 'P', 'Mertua', 'S2', 'PNS', 'Islam', 'Indonesia', '2025-01-02', '2025-01-06 13:07:21', 'created', 'Tidak', 'Ya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1735098924),
('m130524_201442_init', 1735098927),
('m190124_110200_add_verification_token_column_to_user_table', 1735098927);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'Ansar', 'uodBIBeCU9DVDLxqoqcucmyo7VEdamuZ', '$2y$13$xoG2njp12TqgBjfAmzPv0uyZr4HO7UH5VRwqfwrYHNg5KJ.BfQIum', NULL, 'ansarkenshin@gmail.com', 10, 1735098959, 1735098959, 'CQGeIakswbjtpgl7iMJ7TdDyisuIPheO_1735098959'),
(3, 'Risky Aulia', 'wTcvxdZxoW8cWYrch37HkpezHJS2SW0w', '$2y$13$59d2nhMwgf230t76579a4e2ZWAC0tVL7lnfn1Yvp/2qADJJJA/gEe', NULL, 'ansarg1998@gmail.com', 10, 1736945849, 1736945900, 'I-NQW7fO33WIjfaHOQNQhZnonl8FGpnj_1736945849');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id_masyarakat`),
  ADD KEY `get_user` (`get_user`);

--
-- Indeks untuk tabel `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id_masyarakat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD CONSTRAINT `masyarakat_ibfk_1` FOREIGN KEY (`get_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
