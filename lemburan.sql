-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2022 at 05:04 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lemburan`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` int(11) NOT NULL,
  `departemen` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `departemen`) VALUES
(1, 'SI'),
(2, 'Produksi'),
(3, 'PPC'),
(4, 'Project'),
(5, 'Marketing'),
(6, 'FIN'),
(7, 'HR & GA'),
(8, 'Efisiensi'),
(9, 'ERC'),
(10, 'Gudang'),
(11, 'PROC'),
(12, 'QA and QC'),
(13, 'R & D'),
(14, 'Sales Service SP');

-- --------------------------------------------------------

--
-- Table structure for table `detail_form`
--

CREATE TABLE `detail_form` (
  `id` int(128) NOT NULL,
  `id_form` int(128) NOT NULL,
  `nama_user` varchar(256) NOT NULL,
  `nik` varchar(128) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `departemen` varchar(20) DEFAULT NULL,
  `status_kar` varchar(20) DEFAULT NULL,
  `bagian` varchar(256) DEFAULT NULL,
  `no_order` varchar(15) DEFAULT NULL,
  `alasan` varchar(128) DEFAULT NULL,
  `status` varchar(128) NOT NULL,
  `keterangan` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_form`
--

INSERT INTO `detail_form` (`id`, `id_form`, `nama_user`, `nik`, `jam_mulai`, `jam_selesai`, `departemen`, `status_kar`, `bagian`, `no_order`, `alasan`, `status`, `keterangan`) VALUES
(1, 1, 'ZAKARIA AHMAD', '93043', '16:38:00', '20:38:00', 'ERC', 'ENG', 'Nesting', 'P3KH0k', 'pengen aja hehehe', '4', NULL),
(2, 1, 'AHMAD FAUZAN', 'OS-022073', '16:38:00', '20:38:00', 'Produksi', 'OSS_KPRS', 'Nesting', 'P3KH0k', 'pengen aja hehehe', '4', NULL),
(3, 1, 'AHMAD QOMARUDDIN', '12030', '18:38:00', '21:38:00', 'Produksi', 'ENG', 'pengecekan', 'P3KH0k', 'pengen aja hehehe', '4', NULL),
(4, 1, 'INDRA RAHMAD HIDAYAT', 'OS-038779', '17:38:00', '21:38:00', 'Produksi', 'OSS_KPRS', 'Nesting', 'dfdsfs', 'pengen aja hehehe', '4', NULL),
(7, 2, 'ZAKARIA AHMAD', '93043', '10:09:00', '10:09:00', 'ERC', 'ENG', 'pengecekan', 'P3KH0k', 'pengen aja hehehe', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `form_pengajuan`
--

CREATE TABLE `form_pengajuan` (
  `id` int(11) NOT NULL,
  `pembuat` varchar(128) NOT NULL,
  `nik_h` varchar(128) NOT NULL,
  `alasan` varchar(256) DEFAULT NULL,
  `no_order` varchar(128) DEFAULT NULL,
  `tgl_lembur` date NOT NULL,
  `status` varchar(128) NOT NULL,
  `dept` varchar(11) DEFAULT NULL,
  `ppc` varchar(11) DEFAULT NULL,
  `efisiensi` varchar(11) DEFAULT NULL,
  `cc` varchar(11) DEFAULT NULL,
  `manager` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `form_pengajuan`
--

INSERT INTO `form_pengajuan` (`id`, `pembuat`, `nik_h`, `alasan`, `no_order`, `tgl_lembur`, `status`, `dept`, `ppc`, `efisiensi`, `cc`, `manager`) VALUES
(1, 'KISWANTO', '3243242', NULL, NULL, '2022-10-28', '4', 'kanafi', NULL, 'tri', 'enny', NULL),
(2, 'KISWANTO', '3243242', NULL, NULL, '2022-10-29', '0', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `name`) VALUES
(1, 'kabid'),
(2, 'kabag'),
(3, 'admin'),
(4, 'pegawai'),
(5, 'hr');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_log`
--

CREATE TABLE `jenis_log` (
  `id` int(11) NOT NULL,
  `nama_log` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_log`
--

INSERT INTO `jenis_log` (`id`, `nama_log`) VALUES
(1, 'Perubahan jam'),
(2, 'Ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `log_perubahan`
--

CREATE TABLE `log_perubahan` (
  `id` int(128) NOT NULL,
  `id_detail` int(11) NOT NULL,
  `id_form` int(128) NOT NULL,
  `nama_user` varchar(256) NOT NULL,
  `nik` varchar(128) NOT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `departemen` varchar(20) DEFAULT NULL,
  `status_kar` varchar(20) DEFAULT NULL,
  `bagian` varchar(256) DEFAULT NULL,
  `no_order` varchar(15) DEFAULT NULL,
  `alasan` varchar(128) DEFAULT NULL,
  `status` varchar(128) NOT NULL,
  `jenis_log` int(11) NOT NULL,
  `keterangan` varchar(256) DEFAULT NULL,
  `user_pic` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_perubahan`
--

INSERT INTO `log_perubahan` (`id`, `id_detail`, `id_form`, `nama_user`, `nik`, `jam_mulai`, `jam_selesai`, `departemen`, `status_kar`, `bagian`, `no_order`, `alasan`, `status`, `jenis_log`, `keterangan`, `user_pic`) VALUES
(1, 6, 1, 'AHMAD HARIS FAISAL BAHTIAR', '96218', '20:38:00', '21:39:00', 'Marketing', 'ENG', 'Nesting', 'P3KH0k', 'pengen aja hehehe', '0', 2, 'ghhfc', '06576'),
(2, 5, 1, 'AHMAD ROFIQ', 'OS-021907', '16:38:00', '19:38:00', 'Produksi', 'OSS_KPRS', 'pengecekan', 'P3KH0k', 'pengen aja hehehe', '2', 1, NULL, '06576'),
(3, 5, 1, 'AHMAD ROFIQ', 'OS-021907', '18:38:00', '23:38:00', 'Produksi', 'OSS_KPRS', 'pengecekan', 'P3KH0k', 'pengen aja hehehe', '2', 2, 'kurang keras', '3435'),
(4, 3, 1, 'AHMAD QOMARUDDIN', '12030', '16:38:00', '21:38:00', 'Produksi', 'ENG', 'pengecekan', 'P3KH0k', 'pengen aja hehehe', '4', 1, NULL, '00806'),
(5, 4, 1, 'INDRA RAHMAD HIDAYAT', 'OS-038779', '16:38:00', '21:38:00', 'Produksi', 'OSS_KPRS', 'Nesting', 'dfdsfs', 'pengen aja hehehe', '4', 1, NULL, '00806');

-- --------------------------------------------------------

--
-- Table structure for table `log_perubahan_`
--

CREATE TABLE `log_perubahan_` (
  `id` int(11) NOT NULL,
  `id_form` int(11) NOT NULL,
  `id_detail` int(11) NOT NULL,
  `nik` varchar(128) NOT NULL,
  `jam_mulai` varchar(11) DEFAULT NULL,
  `jam_selesai` varchar(11) DEFAULT NULL,
  `jenis_log` int(11) NOT NULL,
  `keterangan` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_perubahan_`
--

INSERT INTO `log_perubahan_` (`id`, `id_form`, `id_detail`, `nik`, `jam_mulai`, `jam_selesai`, `jenis_log`, `keterangan`) VALUES
(2, 12, 29, '06576', '19:48:00', '22:48:00', 1, NULL),
(5, 13, 33, '06576', NULL, NULL, 2, 'bukan ppc'),
(6, 13, 32, '06576', NULL, NULL, 2, 'fdd'),
(7, 13, 32, '06576', '15:50:00', '19:50:00', 1, NULL),
(8, 13, 33, '06576', '14:50:00', '19:50:00', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status_f`
--

CREATE TABLE `status_f` (
  `id` int(128) NOT NULL,
  `nama_status` varchar(256) NOT NULL,
  `warna` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_f`
--

INSERT INTO `status_f` (`id`, `nama_status`, `warna`) VALUES
(0, 'pending', 'danger'),
(1, 'acc departemen', 'warning'),
(2, 'acc Departemen', 'info'),
(3, 'acc efisiensi', 'dark'),
(4, 'acc cost control', 'success'),
(5, 'acc pimpinan', 'success'),
(6, 'input hr', 'primary');

-- --------------------------------------------------------

--
-- Table structure for table `tb_grup_jabatan`
--

CREATE TABLE `tb_grup_jabatan` (
  `id` int(11) NOT NULL,
  `nik` varchar(128) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_grup_jabatan`
--

INSERT INTO `tb_grup_jabatan` (`id`, `nik`, `id_jabatan`, `id_departemen`) VALUES
(1, '123', 3, 1),
(2, '986786', 4, 2),
(3, '87786', 2, 2),
(4, '2344', 4, 6),
(5, '3435', 4, 8),
(6, '34353', 4, 7),
(7, '3435', 2, 1),
(10, '676575', 5, 5),
(11, '83376', 4, 8),
(12, '95243', 5, 7),
(13, '00806', 2, 6),
(14, '06576', 2, 3),
(15, '3243242', 4, 3),
(16, '10553', 0, 3),
(17, '676575', 0, 7),
(18, '11672', 0, 9),
(19, '11673', 0, 9),
(20, '95890', 0, 11),
(22, '3435', 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_grup_role`
--

CREATE TABLE `tb_grup_role` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `nik` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_grup_role`
--

INSERT INTO `tb_grup_role` (`id`, `id_role`, `nik`) VALUES
(1, 1, '123'),
(5, 2, '986786'),
(6, 3, '87786'),
(9, 6, '34353'),
(11, 3, '3435'),
(13, 2, '83376'),
(14, 6, '95243'),
(16, 3, '00806'),
(17, 3, '06576'),
(23, 9, '06576'),
(24, 7, '676575'),
(26, 4, '3435'),
(27, 5, '2344'),
(28, 5, '00806'),
(29, 2, 'OS-031644'),
(30, 2, 'OS-028213'),
(31, 2, '3243242'),
(32, 2, '10553'),
(33, 3, '11672'),
(34, 3, '95890');

-- --------------------------------------------------------

--
-- Table structure for table `ttd`
--

CREATE TABLE `ttd` (
  `id` int(11) NOT NULL,
  `nik` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `ttd` varchar(128) DEFAULT NULL,
  `nama_terang` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ttd`
--

INSERT INTO `ttd` (`id`, `nik`, `username`, `ttd`, `nama_terang`) VALUES
(1, '00806', 'enny', 'enny1.jpg', 'Enny S'),
(2, '3435', 'tri', 'tri1.jpg', 'Triyono'),
(3, '34353', 'dandy', 'dandy1.jpg', 'Dandy Z'),
(4, '06576', 'kanafi', 'kanafi1.jpg', 'Kanafi'),
(5, '95890', 'pinky', 'pinky.jpeg', 'Pingky M'),
(6, '11672', 'hafiq', 'hafiq.png', 'Hafiq M'),
(7, '87786', 'danang', 'danang.jpg', 'Danang'),
(8, '2344', 'leoni', 'leoni.jpg', 'Leoni A');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(2, 1, '2'),
(3, 2, '2'),
(7, 2, '7'),
(11, 3, '6'),
(12, 3, '2'),
(13, 3, '10'),
(19, 4, '11'),
(20, 4, '2'),
(25, 3, '13'),
(26, 3, '14'),
(27, 4, '14'),
(28, 4, '15'),
(29, 5, '2'),
(30, 5, '14'),
(31, 5, '16'),
(32, 6, '14'),
(33, 6, '17'),
(35, 7, '18'),
(36, 6, '2'),
(37, 7, '2'),
(39, 1, '1'),
(40, 1, '3'),
(41, 9, '20'),
(42, 4, '21'),
(43, 5, '21');

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(7, 'Lembur'),
(13, 'Approval Departemen'),
(14, 'Form'),
(15, 'Approval_2'),
(16, 'Approval_3'),
(17, 'Approval_4'),
(18, 'HR'),
(20, 'Approval_PPC'),
(21, 'Report');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL,
  `alias` varchar(128) NOT NULL,
  `status_form` int(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`, `alias`, `status_form`) VALUES
(1, 'admin', 'admin', 0),
(2, 'pegawai', 'user', 0),
(3, 'pimpinan 1', 'pimpinan departemen', 1),
(4, 'pimpinan 2', 'Efisiensi', 2),
(5, 'pimpinan 3', 'Cost control', 3),
(6, 'pimpinan 4', 'manager', 4),
(7, 'HR', 'hr', 5),
(9, 'PPC', 'PPC', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'ti-pie-chart', 1),
(2, 2, 'My profile', 'user/profile', 'ti-user', 1),
(3, 2, 'Edit profile', 'user/editprofile', 'ti-eraser', 1),
(4, 3, 'Menu management', 'menu', 'ti-menu', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'ti-menu-alt', 1),
(9, 1, 'Role', 'admin/role', 'fas fa-network-wired', 0),
(10, 7, 'Pengajuan lembur', 'user', 'ti-target', 1),
(18, 1, 'Daftar user', 'admin/daftar_user', 'ti-user', 1),
(22, 2, 'Ganti password', 'user/ganti_password', 'ti-key', 1),
(28, 7, 'Riwayat pengajuan', 'user/riwayat_pengajuan', 'ti-notepad', 1),
(29, 13, 'Permintaan lembur dept', 'approval_1/index', 'ti-target', 1),
(30, 13, 'Riwayat approve dept', 'approval_1/riwayat_approve', 'ti-panel', 1),
(32, 15, 'Permintaan lembur', 'approval_2/index', 'ti-hand-open', 1),
(33, 15, 'Riwayat approve', 'approval_2/riwayat_approve', 'ti-panel', 1),
(34, 16, 'Permintaan lembur', 'approval_3/index', 'ti-hand-open', 1),
(35, 16, 'Riwayat approve', 'approval_3/riwayat_approve', 'ti-panel', 1),
(36, 17, 'Permintaan lembur', 'approval_4/index', 'ti-hand-open', 1),
(37, 17, 'Riwayat approve', 'approval_4/riwayat_approve', 'ti-panel', 1),
(38, 18, 'Daftar lemburan', 'hr/index', 'ti-layout-list-thumb', 1),
(39, 18, 'Sudah diinput', 'hr/riwayat_input', 'ti-panel', 1),
(40, 20, 'Permintaan lembur', 'approval_ppc/index', 'ti-hand-open', 1),
(41, 20, 'Riwayat approve', 'approval_ppc/riwayat_approve', 'ti-infinite', 1),
(42, 1, 'Daftar lembur', 'admin/daftar_lembur', 'ti-menu-alt', 1),
(43, 21, 'Report lembur', 'user/report', 'ti-bar-chart', 1),
(44, 1, 'Tanda tangan', 'admin/ttd', 'ti-stamp', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_departemen_form`
-- (See below for the actual view)
--
CREATE TABLE `view_departemen_form` (
`id_form` int(11)
,`nik_h` varchar(128)
,`pembuat` varchar(128)
,`departemen` varchar(128)
,`id_dept` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_role`
-- (See below for the actual view)
--
CREATE TABLE `view_role` (
`id` int(11)
,`id_role` int(11)
,`nik` varchar(128)
,`name` varchar(128)
,`departemen` varchar(128)
,`username` varchar(128)
,`role` varchar(128)
,`alias` varchar(128)
);

-- --------------------------------------------------------

--
-- Table structure for table `_tb_user`
--

CREATE TABLE `_tb_user` (
  `id` int(11) NOT NULL,
  `nik` varchar(256) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_tb_user`
--

INSERT INTO `_tb_user` (`id`, `nik`, `nama`, `username`, `password`, `is_active`) VALUES
(1, '1999', 'ahmad', 'ahmad', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 1),
(2, '222', 'banu', 'banu', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 1),
(3, '333', 'burhan', 'burhan', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 1),
(4, '444', 'danang', 'danang', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 1),
(5, '555', 'leoni', 'leoni', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 1),
(6, '666', 'tri', 'tri', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 1),
(7, '777', 'yuda', 'yuda', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 1),
(8, '888', 'ima', 'ima', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 1),
(9, '999', 'zumna', 'zumna', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 1);

-- --------------------------------------------------------

--
-- Structure for view `view_departemen_form`
--
DROP TABLE IF EXISTS `view_departemen_form`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_departemen_form`  AS SELECT `form_pengajuan`.`id` AS `id_form`, `form_pengajuan`.`nik_h` AS `nik_h`, `form_pengajuan`.`pembuat` AS `pembuat`, `pura_keluhan`.`user`.`departemen` AS `departemen`, `departemen`.`id` AS `id_dept` FROM ((`form_pengajuan` join `pura_keluhan`.`user` on(`form_pengajuan`.`nik_h` = `pura_keluhan`.`user`.`nik`)) join `departemen` on(`departemen`.`departemen` = `pura_keluhan`.`user`.`departemen`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_role`
--
DROP TABLE IF EXISTS `view_role`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_role`  AS SELECT `tb_grup_role`.`id` AS `id`, `tb_grup_role`.`id_role` AS `id_role`, `tb_grup_role`.`nik` AS `nik`, `pura_keluhan`.`user`.`name` AS `name`, `pura_keluhan`.`user`.`departemen` AS `departemen`, `pura_keluhan`.`user`.`username` AS `username`, `user_role`.`role` AS `role`, `user_role`.`alias` AS `alias` FROM ((`tb_grup_role` join `pura_keluhan`.`user` on(`pura_keluhan`.`user`.`nik` = `tb_grup_role`.`nik`)) join `user_role` on(`user_role`.`id` = `tb_grup_role`.`id_role`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_form`
--
ALTER TABLE `detail_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_pengajuan`
--
ALTER TABLE `form_pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_log`
--
ALTER TABLE `jenis_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_perubahan`
--
ALTER TABLE `log_perubahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_perubahan_`
--
ALTER TABLE `log_perubahan_`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_f`
--
ALTER TABLE `status_f`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_grup_jabatan`
--
ALTER TABLE `tb_grup_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_grup_role`
--
ALTER TABLE `tb_grup_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ttd`
--
ALTER TABLE `ttd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_tb_user`
--
ALTER TABLE `_tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `detail_form`
--
ALTER TABLE `detail_form`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `form_pengajuan`
--
ALTER TABLE `form_pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_log`
--
ALTER TABLE `jenis_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_perubahan`
--
ALTER TABLE `log_perubahan`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `log_perubahan_`
--
ALTER TABLE `log_perubahan_`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `status_f`
--
ALTER TABLE `status_f`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_grup_jabatan`
--
ALTER TABLE `tb_grup_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_grup_role`
--
ALTER TABLE `tb_grup_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ttd`
--
ALTER TABLE `ttd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `_tb_user`
--
ALTER TABLE `_tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
