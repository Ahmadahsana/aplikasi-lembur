-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2022 at 05:08 AM
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
(1, 'EDP'),
(2, 'Produksi'),
(3, 'PPC'),
(4, 'Project'),
(5, 'Marketing'),
(6, 'Cost control'),
(7, 'HR'),
(8, 'EFISIENSI');

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
  `bagian` varchar(256) DEFAULT NULL,
  `status` varchar(128) NOT NULL,
  `keterangan` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_form`
--

INSERT INTO `detail_form` (`id`, `id_form`, `nama_user`, `nik`, `jam_mulai`, `jam_selesai`, `bagian`, `status`, `keterangan`) VALUES
(139, 72, 'AGUS BUDIARTO', 'OS-014200', '17:08:00', '20:08:00', 'mesin', '3', 'yuk ahhh'),
(140, 72, 'AHMAD AHSANA TAQWIN', 'OS-036523', '13:08:00', '14:08:00', 'mesin', '6', NULL),
(141, 72, 'AGUS FARRIS SYAFI\'I', '94492', '13:08:00', '14:08:00', 'mesin', '2', 'pengen tolak aja'),
(142, 72, 'HAFID PRASETYO NUGROHO', 'OS-038486', '13:08:00', '14:08:00', 'mesin', '6', NULL),
(143, 73, 'SINGGIH WIRAWAN', '12250', '12:50:00', '15:50:00', 'mesin', '3', NULL),
(144, 73, 'SUPANGAT', '04737', '12:50:00', '15:50:00', 'mesin', '3', NULL),
(145, 74, 'ISWAHYUDI', '05625', '15:46:00', '17:46:00', 'mesin', '0', 'p'),
(146, 74, 'PARGIYANTO', '11545', '15:46:00', '17:46:00', 'mesin', '2', 'i'),
(147, 74, 'RIZAD WINDIASMARA DANU', '95515', '15:46:00', '17:46:00', 'mesin', '6', NULL),
(148, 74, 'LENI MEGAWATI', '12284', '15:46:00', '17:46:00', 'mesin', '1', 'o'),
(149, 74, 'RAMIJAN', '05620', '15:46:00', '17:46:00', 'mesin', '4', 'y'),
(150, 74, 'IMA WIDIASTUTI', '11409', '15:46:00', '17:46:00', 'mesin', '3', 'u'),
(151, 75, 'HERMIN SUSILOWATI', '11770', '12:25:00', '14:25:00', 'boring', '6', NULL),
(152, 75, 'DWI SUSANTO', '12285', '12:25:00', '14:25:00', 'boring', '6', NULL),
(153, 76, 'SINGGIH WIRAWAN', '12250', '13:37:00', '14:37:00', 'mesin', '0', NULL),
(154, 76, 'HERMIN SUSILOWATI', '11770', '13:37:00', '14:37:00', 'mesin', '0', NULL),
(155, 77, 'DWI SUSANTO', '12285', '15:50:00', '17:50:00', 'mesin', '6', NULL),
(156, 77, 'HARRY BUDI SUSETYA', '10539', '15:50:00', '17:50:00', 'mesin', '6', NULL),
(157, 78, 'RIZAD WINDIASMARA DANU', '95515', '18:04:00', '20:04:00', 'mesin', '6', NULL),
(158, 78, 'EDWIN NOOR INDRA', 'OS-027873', '18:04:00', '20:04:00', 'mesin', '6', NULL),
(159, 79, 'RIZAD WINDIASMARA DANU', '95515', '09:11:00', '11:11:00', 'mesin', '6', NULL),
(160, 79, 'EDWIN NOOR INDRA', 'OS-027873', '09:11:00', '11:11:00', 'mesin', '6', NULL),
(161, 79, 'WINARNO', '12386', '09:11:00', '11:11:00', 'mesin', '6', NULL),
(162, 80, 'KISWANTO', 'OS-028213', '16:27:00', '20:27:00', 'Nesting', '0', NULL),
(163, 80, 'MOH ARIFIN', '10553', '16:27:00', '20:27:00', 'worksheet', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `form_pengajuan`
--

CREATE TABLE `form_pengajuan` (
  `id` int(11) NOT NULL,
  `pembuat` varchar(128) NOT NULL,
  `nik` int(128) NOT NULL,
  `alasan` varchar(256) NOT NULL,
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

INSERT INTO `form_pengajuan` (`id`, `pembuat`, `nik`, `alasan`, `no_order`, `tgl_lembur`, `status`, `dept`, `ppc`, `efisiensi`, `cc`, `manager`) VALUES
(72, 'burhan', 986786, 'pengen aja', '323/POI/67', '2022-06-23', '6', NULL, NULL, NULL, NULL, NULL),
(73, 'zumna', 83376, 'coba lur', '1234/YUIOP', '2022-06-23', '3', NULL, NULL, NULL, NULL, NULL),
(74, 'burhan', 986786, 'gak tau', '865968546/hjgfhf', '2022-06-23', '6', NULL, NULL, NULL, NULL, NULL),
(75, 'burhan', 986786, 'oke kawan', 'yuhu7878787', '2022-06-27', '6', NULL, NULL, NULL, NULL, NULL),
(76, 'burhan', 986786, 'oke cuy', '8977i', '2022-06-27', '0', NULL, NULL, NULL, NULL, NULL),
(77, 'burhan', 986786, 'ya ya ya', '324234/GFG', '2022-06-29', '6', NULL, NULL, NULL, NULL, NULL),
(79, 'burhan', 986786, 'okeh', '324234/GFG', '2022-06-30', '6', 'danang', 'kanafi', 'tri', 'leoni', 'yudha'),
(80, 'burhan', 986786, 'nesting', '-', '2022-08-05', '0', NULL, NULL, NULL, NULL, NULL);

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
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `nik` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `nik`) VALUES
(1, 'susanto', '34324232'),
(2, 'winardi', '8677454'),
(3, 'hendro', '32424234'),
(4, 'ucil', '12312445'),
(5, 'cilacap', '453545325'),
(6, 'samiseh', '3453456'),
(7, 'samudro', '878765');

-- --------------------------------------------------------

--
-- Table structure for table `status_f`
--

CREATE TABLE `status_f` (
  `id` int(128) NOT NULL,
  `nama_status` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_f`
--

INSERT INTO `status_f` (`id`, `nama_status`) VALUES
(0, 'pending'),
(1, 'acc departemen'),
(2, 'acc PPC'),
(3, 'acc cost control'),
(4, 'acc efisiensi'),
(5, 'acc pimpinan'),
(6, 'input hr');

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
(14, '06576', 2, 3);

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
(28, 5, '00806');

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
(41, 9, '20');

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
(20, 'Approval_PPC');

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
(41, 20, 'Riwayat approve', 'approval_ppc/riwayat_approve', 'ti-infinite', 1);

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
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_form`
--
ALTER TABLE `detail_form`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `form_pengajuan`
--
ALTER TABLE `form_pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `status_f`
--
ALTER TABLE `status_f`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_grup_jabatan`
--
ALTER TABLE `tb_grup_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_grup_role`
--
ALTER TABLE `tb_grup_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `_tb_user`
--
ALTER TABLE `_tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
