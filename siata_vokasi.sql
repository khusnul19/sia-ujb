-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Feb 2021 pada 08.15
-- Versi server: 10.1.30-MariaDB
-- Versi PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siata_vokasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `listprodi`
--

CREATE TABLE `listprodi` (
  `id_prodi` int(11) NOT NULL,
  `nama_prodi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `listprodi`
--

INSERT INTO `listprodi` (`id_prodi`, `nama_prodi`) VALUES
(1, 'D4-Rekayasa Perancangan Mekanik'),
(2, 'D4-Teknologi Rekayasa Kimia Industri'),
(3, 'D4-Teknologi Rekayasa Otomasi'),
(4, 'D4-Teknologi Rekayasa Konstruksi Perkapalan'),
(5, 'D4-Teknik Infrastruktur Sipil Dan Perancangan'),
(6, 'D4-Perencanaan Tata Ruang Dan Pertanahan'),
(7, 'D4-Teknik Listrik Industri'),
(8, 'D4-Manajemen Dan Administrasi'),
(9, 'D4-Informasi Dan Hubungan Masyarakat'),
(10, 'D4-Akuntansi Perpajakan'),
(11, 'D4-Bahasa Asing Terapan'),
(12, 'D3-Teknologi Perencanaan Wilayah dan Kota'),
(13, 'D3-Hubungan Masyarakat'),
(14, 'D3-Akuntansi'),
(15, 'D3-Manajemen Perusahaan'),
(16, 'D3-Administrasi Pajak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendataan_ta`
--

CREATE TABLE `pendataan_ta` (
  `id` int(25) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `nim` varchar(128) NOT NULL,
  `departemen` varchar(128) NOT NULL,
  `program_studi` varchar(128) NOT NULL,
  `judul_ta` varchar(128) NOT NULL,
  `nama_dosbing1` varchar(128) NOT NULL,
  `nama_dosbing2` varchar(128) NOT NULL,
  `ket_ta` varchar(255) NOT NULL,
  `jenis_luaran_ta` varchar(128) NOT NULL,
  `luaran_ta` varchar(255) NOT NULL,
  `file_ta` varchar(255) NOT NULL,
  `status_prodi` int(2) NOT NULL DEFAULT '0',
  `ket_tolak_prodi` varchar(255) NOT NULL,
  `id_prodi` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendataan_ta`
--

INSERT INTO `pendataan_ta` (`id`, `nama`, `nim`, `departemen`, `program_studi`, `judul_ta`, `nama_dosbing1`, `nama_dosbing2`, `ket_ta`, `jenis_luaran_ta`, `luaran_ta`, `file_ta`, `status_prodi`, `ket_tolak_prodi`, `id_prodi`) VALUES
(1, 'Muhammad Edi Ilfa', '21120118120025', '-', 'D3-Akuntansi', 'kkk', 'Anwar S.T.', 'Sapardi S.T.', 'kkk', 'Prototipe', 'PENGEMBANGAN_SISTEM_INFORMASI_SKRIPSI_BERBASIS_WEB_DENGAN_FRAMEWORK_CODEIGNITER.pdf', 'Sistem_Informasi_Manajemen_Tugas_Akhir_Berbasis_Web.pdf', 3, '\r\n', 14),
(2, 'Lina Aulia', '21120118120019', '-', 'D3-Hubungan Masyarakat', 'Pekarangan Rumah Berbasis IoT', 'Anwar S.T.', 'Sapardi S.T.', 'Pekarangan Rumah Berbasis IoT', 'Prototipe', 'tutorial_MySQL_Part_3.pdf', '10229-Article_Text-1641-1-10-20191002.pdf', 1, 'Revisi Di halaman awal', 13),
(3, 'Lina Aulia', '21120118120019', '-', 'D3-Hubungan Masyarakat', 'Pekarangan Rumah Berbasis IoT', 'Anwar S.T.', 'Sapardi S.T.', 'Pekarangan Rumah Berbasis IoT', 'Prototipe', 'tutorial_MySQL_Part_31.pdf', '10229-Article_Text-1641-1-10-201910021.pdf', 0, '', 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `nim` varchar(25) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `id_prodi` int(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `nim`, `username`, `image`, `password`, `role_id`, `is_active`, `date_created`, `id_prodi`) VALUES
(7, 'Admin', NULL, 'admin', 'profil20.jpg', '$2y$10$QEXdub0P6nQ9XsZWg44N5.Rxz69poStE3c6kxTc4Eah.MThIi.Mee', 1, 1, 1596001190, NULL),
(27, 'Wakil Dekan 1', '', 'wadek', 'profil2.jpg', '$2y$10$2Z0HCAdKnBSjQpK7y9kHFeo7vySrqteYB84Ux/lfo11LEHYTvRpTS', 4, 1, 1609865680, NULL),
(28, 'Kepala Tata Usaha', '', 'tatausaha', 'profil3.jpg', '$2y$10$iBB7rm2ufvbh82qZNY7uuOR3iEViVUWRQji9oaU26W7lNWk4XGvIS', 5, 1, 1609865665, NULL),
(29, 'D4-Rekayasa Perancangan Mekanik', '', 'kaprodi1', 'profil4.jpg', '$2y$10$Fb4zD9z0CJjptZzhBv2X/e5aOEzY0dW9m130WiiuKf5n/LEXrJxc.', 3, 1, 1609848665, 1),
(30, 'D4-Teknologi Rekayasa Kimia Industri', '', 'kaprodi2', 'profil5.jpg', '$2y$10$bS6pxjoH/1KD1RSDaINrAe4WYEXDZ6.rfStfctLumDwD5IVodY/1q', 3, 1, 1609848781, 2),
(31, 'D4-Teknologi Rekayasa Otomasi', '', 'kaprodi3', 'profil6.jpg', '$2y$10$xMnA92QEnTMQNE0xTk.9tOU/rq5HXrgdW.iwkhsDf38Hx3ZNBmAzm', 3, 1, 1609848795, 3),
(32, 'D4-Teknologi Rekayasa Konstruksi Perkapalan', '', 'kaprodi4', 'profil7.jpg', '$2y$10$0uZyOBUjebnxBCOnjCkgZeGpG17UGcbgw7j2NaG5pm1eEd/6Hwj4u', 3, 1, 1609848810, 4),
(33, 'D4-Teknik Infrastruktur Sipil Dan Perancangan', '', 'kaprodi5', 'profil8.jpg', '$2y$10$vPRT9vzSMLtjMxD/j7hgI.QGxqauDHS2Wqvs/NeI4hjqp3jXa5uQa', 3, 1, 1609848824, 5),
(34, 'D4-Perencanaan Tata Ruang Dan Pertanahan', '', 'kaprodi6', 'profil9.jpg', '$2y$10$gDqZB0hmUGXbDVZs9zfOweCSoO9MJZ4hk3K9OEcMAHNOHuUw3wlO2', 3, 1, 1609848837, 6),
(35, 'D4-Teknik Listrik Industri', '', 'kaprodi7', 'profil10.jpg', '$2y$10$uzNZCQNLeE75e.Hefdh9Ce6H0mDfHbnJyehxSplCPPiGwQGvyBu8O', 3, 1, 1609848853, 7),
(36, 'D4-Manajemen Dan Administrasi', '', 'kaprodi8', 'profil11.jpg', '$2y$10$tTNy6Kad4297gvbhZ3o6POEiwo21G28m8NA/UTffij6JQ41i34suG', 3, 1, 1609848872, 8),
(37, 'D4-Informasi Dan Hubungan Masyarakat', '', 'kaprodi9', 'profil12.jpg', '$2y$10$G1K9oTrF3gCc3zGkDTRVUeQyrijDyZC8dnUmpfF1M40SYa9E/j.B.', 3, 1, 1609848885, 9),
(38, 'D4-Akuntansi Perpajakan', '', 'kaprodi10', 'profil13.jpg', '$2y$10$Sbz1OXdQLu7VO2PkLrb1LucocuZwugQ848h/GtFUVdO3FA34zb75e', 3, 1, 1609848899, 10),
(39, 'D4-Bahasa Asing Terapan', '', 'kaprodi11', 'profil14.jpg', '$2y$10$kXIKLW.iU.8MqoGYyCOrXOfTV9hKQzExobZ6OfiQEU8Zq8D.H3F8C', 3, 1, 1609848911, 11),
(40, 'D3-Teknologi Perencanaan Wilayah Dan Kota', '', 'kaprodi12', 'profil15.jpg', '$2y$10$azwPGOqt6fzA3.pL6Q0OYu8JjvBuaVLX4R4PBcJOc2hLXeD2StzSC', 3, 1, 1609848924, 12),
(41, 'D3-Hubungan Masyarakat', '', 'kaprodi13', 'profil16.jpg', '$2y$10$LHhH3OFzNdkfRI9qMKMLzuxdG2lPYRjvmK8C4KynzLOR.0T6rt7BO', 3, 1, 1609848937, 13),
(42, 'D3-Akuntansi', '', 'kaprodi14', 'profil17.jpg', '$2y$10$CzLm8zcQpB.4oHRmP6qTaeekLEiWaPDScP4RTNTsgfilxRQbsiHb6', 3, 1, 1609848953, 14),
(43, 'D3-Manajemen Perusahaan', '', 'kaprodi15', 'profil18.jpg', '$2y$10$lSfGqvNft0WGiBLLGl/Oi.gcPIcMvj.BuzfNkPalg3iuwPQbemoPK', 3, 1, 1609848968, 15),
(44, 'D3-Administrasi Pajak', '', 'kaprodi16', 'profil19.jpg', '$2y$10$EfqIsJUAIaslv/KLGUBvG.Rwk/uxEpvbde8IinNcR0n2ODflNJ/1K', 3, 1, 1609848983, 16),
(47, 'Muhammad Edi Ilfa', '21120118120025', 'edi', 'Untitled.png', '$2y$10$4GTTwjC9i2tRbXWXh8.h/uqFngesx76F5bcHoDamqzyuEyyNBEtgq', 2, 1, 1609800871, NULL),
(51, 'Lina Aulia', '21120118120019', 'lina', 'profil22.jpg', '$2y$10$9hD6npSKRSSxVCgrN5jT8OYVlw4WDhqWinNWAAnwJlWej/P6CbHl.', 2, 1, 1608719329, NULL),
(52, 'Dekan', '', 'dekan', 'profil.jpg', '$2y$10$9IveT1DNvMI0imdGPE7kdOj97nfZ5xVdhufL9dy0CUJRHuZkJub52', 6, 1, 1609867774, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(26, 1, 7),
(27, 2, 2),
(28, 3, 3),
(30, 5, 5),
(31, 4, 4),
(34, 6, 6),
(35, 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Kaprodi'),
(4, 'Wadek'),
(5, 'Tatausaha'),
(6, 'Dekan'),
(7, 'Menu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member'),
(3, 'Kepala Prodi'),
(4, 'Wakil Dekan I'),
(5, 'Tatausaha'),
(6, 'Dekan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard Admin', 'admin', 'fas fa-fw fa-home', 1),
(42, 1, 'Role Access', 'admin/role', 'fas fa-fw fa-user-plus', 1),
(43, 7, 'Menu Management', 'menu', 'fas fa-fw fa-folder-plus', 1),
(44, 7, 'SubMenu Management ', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(45, 2, 'Dashboard User', 'user', 'fas fa-fw fa-user', 1),
(46, 2, 'Pendataan TA', 'user/pendataan_ta', 'fas fa-fw fa-user-graduate', 1),
(48, 3, 'Dashboard Kaprodi', 'kaprodi', 'fas fa-fw fa-home', 1),
(49, 3, 'History ', 'kaprodi/history_pendataan_ta', 'fas fa-fw fa-user-graduate', 1),
(50, 5, 'Dashboard Tatausaha', 'tatausaha', 'fas fa-fw fa-home', 1),
(51, 5, 'Data  TA', 'tatausaha/pendataan_ta', 'fas fa-fw fa-user-graduate', 1),
(52, 4, 'Dashboard WD1', 'wadek', 'fas fa-fw fa-home', 1),
(53, 4, 'Data TA', 'wadek/pendataan_ta', 'fas fa-fw fa-user-graduate', 1),
(54, 6, 'Dashboard Dekan', 'dekan', 'fas fa-fw fa-home', 1),
(55, 6, 'Data TA', 'dekan/pendataan_ta', 'fas fa-fw fa-user-graduate', 1),
(56, 3, 'TA Di Setujui', 'kaprodi/data_disetujui', 'fas fa-fw fa-user-graduate', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `listprodi`
--
ALTER TABLE `listprodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indeks untuk tabel `pendataan_ta`
--
ALTER TABLE `pendataan_ta`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `listprodi`
--
ALTER TABLE `listprodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pendataan_ta`
--
ALTER TABLE `pendataan_ta`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
