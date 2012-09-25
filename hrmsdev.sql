-- phpMyAdmin SQL Dump
-- version 3.5.0-beta1
-- http://www.phpmyadmin.net
--
-- Host: mysql-shared-02.phpfog.com
-- Generation Time: Sep 25, 2012 at 12:58 PM
-- Server version: 5.5.12-log
-- PHP Version: 5.3.2-1ubuntu4.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hrms_phpfogapp_com`
--
CREATE DATABASE `hrms_phpfogapp_com` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `hrms_phpfogapp_com`;

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE IF NOT EXISTS `agama` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agama` varchar(10) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id`, `agama`, `keterangan`) VALUES
(1, 'Islam', ''),
(2, 'Kristen', 'asdasd'),
(3, 'Hindu', ''),
(4, 'Budha', ''),
(5, 'Konghucu', '');

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE IF NOT EXISTS `cabang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_cabang` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id`, `nama_cabang`) VALUES
(1, 'Mariza Pusat, Puriniaga'),
(2, 'Mariza Plant I KM 8'),
(3, 'Mariza Plant II KM 7');

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE IF NOT EXISTS `departemen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_departemen` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `nama_departemen`) VALUES
(1, 'HRD'),
(2, 'QC'),
(3, 'R&D'),
(4, 'Purchasing'),
(5, 'PPIC'),
(6, 'Produksi'),
(7, 'Gudang'),
(8, 'Kendaraan'),
(9, 'Bengkel'),
(10, 'Export&Import'),
(11, 'Security');

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE IF NOT EXISTS `gaji` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jabatan_id` int(10) unsigned NOT NULL,
  `masa_kerja` int(11) DEFAULT NULL,
  `jumlah` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(45) DEFAULT NULL,
  `tunjangan` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `tunjangan`) VALUES
(1, 'General Manager', NULL),
(2, 'Manager', NULL),
(3, 'Supervisor', NULL),
(4, 'Kepala Bagian', NULL),
(5, 'Staf', NULL),
(6, 'Operator', NULL),
(7, 'Supir', NULL),
(8, 'Montir', NULL),
(9, 'Anggota', NULL),
(10, 'Danton', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_cuti`
--

CREATE TABLE IF NOT EXISTS `jenis_cuti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_cuti` varchar(35) DEFAULT NULL,
  `jumlah_hari` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jenis_cuti`
--

INSERT INTO `jenis_cuti` (`id`, `nama_cuti`, `jumlah_hari`) VALUES
(1, 'Menikah', 3);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(45) NOT NULL,
  `nama_depan` varchar(30) NOT NULL,
  `nama_belakang` varchar(30) DEFAULT NULL,
  `npwp` varchar(45) DEFAULT NULL,
  `tempat_lahir` varchar(30) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `departemen_id` int(10) unsigned NOT NULL,
  `jabatan_id` int(10) unsigned NOT NULL,
  `agama_id` int(10) unsigned NOT NULL,
  `cabang_id` int(10) unsigned NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `pendidikan_id` int(10) unsigned NOT NULL,
  `gol_darah` enum('A','B','O','AB') DEFAULT NULL,
  `sex` enum('l','p') DEFAULT NULL,
  `no_rekening` varchar(45) DEFAULT NULL,
  `status_nikah` enum('nikah','lajang') DEFAULT NULL,
  `aktif` tinyint(1) DEFAULT '1',
  `gapok` decimal(10,0) DEFAULT NULL,
  `join_date` datetime DEFAULT NULL,
  `terminate_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nik`, `nama_depan`, `nama_belakang`, `npwp`, `tempat_lahir`, `tanggal_lahir`, `no_telp`, `email`, `alamat`, `foto`, `departemen_id`, `jabatan_id`, `agama_id`, `cabang_id`, `status_id`, `pendidikan_id`, `gol_darah`, `sex`, `no_rekening`, `status_nikah`, `aktif`, `gapok`, `join_date`, `terminate_date`) VALUES
(6, '12345', 'Bagusnov', 'Eka', '', '', '1989-01-10', '', '', '', NULL, 2, 3, 2, 1, 1, 2, 'O', '', '', '', 1, '3000000', NULL, NULL),
(7, '2345345', 'Maria', 'Ozawa', '', '', '0000-00-00', '', '', '', NULL, 1, 2, 4, 2, 1, 3, 'AB', 'p', '', 'lajang', 1, '2500000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan_potongan`
--

CREATE TABLE IF NOT EXISTS `karyawan_potongan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `karyawan_id` int(10) unsigned NOT NULL,
  `potongan_id` int(10) unsigned NOT NULL,
  `keterangan` text,
  `tgl_update` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan_tunjangan`
--

CREATE TABLE IF NOT EXISTS `karyawan_tunjangan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `karyawan_id` int(10) unsigned NOT NULL,
  `tunjangan_id` int(10) unsigned NOT NULL,
  `keterangan` text,
  `tgl_update` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE IF NOT EXISTS `pendidikan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pendidikan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`id`, `nama_pendidikan`) VALUES
(1, 'SD'),
(2, 'SMP'),
(3, 'SMA'),
(4, 'D3'),
(5, 'S1'),
(6, 'S2');

-- --------------------------------------------------------

--
-- Table structure for table `penggajian`
--

CREATE TABLE IF NOT EXISTS `penggajian` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(10) NOT NULL,
  `gaji` decimal(10,2) DEFAULT NULL,
  `potongan` decimal(10,2) DEFAULT NULL,
  `tunjangan` decimal(10,2) DEFAULT NULL,
  `tgl_pengambilan` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `penggajian`
--

INSERT INTO `penggajian` (`id`, `nik`, `gaji`, `potongan`, `tunjangan`, `tgl_pengambilan`) VALUES
(2, '12345', '3000000.00', '205000.00', '110000.00', '2012-09-23 00:00:00'),
(3, '2345345', '2500000.00', '205000.00', '110000.00', '2012-09-23 00:00:00'),
(4, '12345', '3000000.00', '205000.00', '310000.00', '2012-09-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `penggajian_detail`
--

CREATE TABLE IF NOT EXISTS `penggajian_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `penggajian_id` int(10) unsigned NOT NULL,
  `total_gaji` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `penggajian_detail`
--

INSERT INTO `penggajian_detail` (`id`, `penggajian_id`, `total_gaji`) VALUES
(1, 2, '2905000'),
(2, 3, '2405000'),
(3, 4, '3105000');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_cuti`
--

CREATE TABLE IF NOT EXISTS `permohonan_cuti` (
  `kd_pcuti` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(45) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `jenis_cuti_id` int(11) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `lama_cuti` int(11) DEFAULT NULL,
  `alasan` varchar(255) DEFAULT NULL,
  `status_pengajuan` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`kd_pcuti`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `permohonan_cuti`
--

INSERT INTO `permohonan_cuti` (`kd_pcuti`, `nik`, `tahun`, `jenis_cuti_id`, `tgl_mulai`, `tgl_akhir`, `lama_cuti`, `alasan`, `status_pengajuan`) VALUES
(4, '2345345', NULL, 1, '2012-09-06', '2012-09-14', 8, 'sdfsdfsdf', 1),
(5, '12345', NULL, 1, '2012-09-07', '2012-09-28', 21, 'sdfsdf', 1),
(6, '2345345', NULL, 1, '2012-09-06', '2012-09-12', 6, 'sdgsdg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `potongan`
--

CREATE TABLE IF NOT EXISTS `potongan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_potongan` varchar(45) DEFAULT NULL,
  `jumlah` decimal(10,2) DEFAULT NULL,
  `status_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `potongan`
--

INSERT INTO `potongan` (`id`, `nama_potongan`, `jumlah`, `status_id`) VALUES
(2, 'Asuransi', '200000.00', 1),
(3, 'Koperasi', '5000.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_roles` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `nama_status`) VALUES
(1, 'Tetap'),
(2, 'Kontrak 2th'),
(3, 'Harian'),
(4, 'Harian Kontrak');

-- --------------------------------------------------------

--
-- Table structure for table `tunjangan`
--

CREATE TABLE IF NOT EXISTS `tunjangan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_tunjangan` varchar(45) DEFAULT NULL,
  `jumlah` decimal(10,2) DEFAULT NULL,
  `status_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tunjangan`
--

INSERT INTO `tunjangan` (`id`, `nama_tunjangan`, `jumlah`, `status_id`) VALUES
(2, 'Tunjangan Istri', '100000.00', 1),
(3, 'Tunjangan Anak', '10000.00', 1),
(11, 'Tunjangan Tetap', '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `roles_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
