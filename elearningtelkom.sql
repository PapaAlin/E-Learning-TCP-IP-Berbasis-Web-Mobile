-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2021 at 01:51 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `elearningtelkom`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE IF NOT EXISTS `tbl_admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` char(150) NOT NULL,
  `admin_email` char(150) NOT NULL,
  `username` char(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `admin_about` varchar(300) NOT NULL,
  `admin_img` char(250) NOT NULL,
  `admin_status` tinyint(1) NOT NULL,
  `hak_akses` varchar(250) NOT NULL,
  `cookie` varchar(500) NOT NULL,
  `admin_login` datetime NOT NULL,
  `admin_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`admin_id`, `admin_name`, `admin_email`, `username`, `password`, `admin_about`, `admin_img`, `admin_status`, `hak_akses`, `cookie`, `admin_login`, `admin_date`) VALUES
(5, 'admin', 'admin@gmail.com', 'admin', 'fdb28763c569927d644fc081c598ac09', 'admin', '', 1, '', 'LXlRafVwJi361x85zN9G7yo20QOgTEIK', '2021-08-26 20:00:28', '2017-12-26 19:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courses`
--

CREATE TABLE IF NOT EXISTS `tbl_courses` (
  `course_id` int(11) NOT NULL,
  `course_title` varchar(250) NOT NULL,
  `course_img` varchar(250) NOT NULL,
  `course_pdf` varchar(150) NOT NULL,
  `course_desc` text NOT NULL,
  `course_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_courses`
--

INSERT INTO `tbl_courses` (`course_id`, `course_title`, `course_img`, `course_pdf`, `course_desc`, `course_created`) VALUES
(2, 'Web Technology Security', 'COURSE-20210720-211625-780.png', '', 'Web Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology Security\r\n\r\nWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology SecurityWeb Technology Security', '2021-07-20 21:14:11'),
(3, 'Academic English', 'COURSE-20210725-202909-917.png', '', 'Academic English Academic EnglishAcademic EnglishAcademic EnglishAcademic EnglishAcademic English Academic English Academic English Academic English Academic English Academic English Academic English Academic English Academic English Academic English Academic English Academic English Academic English Academic English Academic English vv\r\n \r\n Academic English Academic English Academic English Academic English Academic English Academic English Academic English\r\nAcademic English Academic English Academic English Academic English Academic English Academic English Academic English', '2021-07-25 20:29:09'),
(4, 'Tutorial dan belajar web codeigniter', 'COURSE-20210802-200411-223.png', 'COURSE-PDF-20210802-203539-153.pdf', 'Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter \r\n\r\nTutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter \r\n\r\nTutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter', '2021-08-02 20:01:32'),
(5, 'Tutorial upload PDF di web codeigniter', 'COURSE-20210802-201255-905.jpg', 'COURSE-PDF-20210802-201255-587.pdf', 'Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniterTutorial upload PDF di web codeigniterTutorial upload PDF di web codeigniterTutorial upload PDF di web codeigniterTutorial upload PDF di web codeigniterTutorial upload PDF di web codeigniterTutorial upload PDF di web codeigniterTutorial upload PDF di web codeigniterTutorial upload PDF di web codeigniterTutorial upload PDF di web codeigniterTutorial upload PDF di web codeigniterTutorial upload PDF di web codeigniterTutorial upload PDF di web codeigniterTutorial upload PDF di web codeigniterTutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter\r\n\r\n\r\nTutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter Tutorial upload PDF di web codeigniter ', '2021-08-02 20:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jawaban`
--

CREATE TABLE IF NOT EXISTS `tbl_jawaban` (
  `jawaban_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `jawaban_sesi` int(11) NOT NULL,
  `jawaban_type` char(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  `soal_id` int(11) NOT NULL,
  `jawaban_nilai` char(50) NOT NULL,
  `jawaban_status` tinyint(2) NOT NULL,
  `jawaban_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jawaban`
--

INSERT INTO `tbl_jawaban` (`jawaban_id`, `course_id`, `jawaban_sesi`, `jawaban_type`, `user_id`, `soal_id`, `jawaban_nilai`, `jawaban_status`, `jawaban_created`) VALUES
(1, 5, 1, 'pretest', 1, 1, 'salah', 1, '2021-08-27 19:14:38'),
(2, 5, 1, 'pretest', 1, 2, 'benar', 1, '2021-08-27 19:17:39'),
(3, 5, 1, 'pretest', 1, 3, 'benar', 1, '2021-08-27 19:31:42'),
(4, 5, 1, 'pretest', 1, 4, 'benar', 1, '2021-08-27 19:33:54'),
(11, 5, 1, 'pretest', 1, 5, 'salah', 1, '2021-08-27 20:23:30'),
(12, 5, 2, 'pretest', 1, 1, 'salah', 1, '2021-08-27 20:38:41'),
(13, 5, 2, 'pretest', 1, 2, 'salah', 1, '2021-08-27 20:38:43'),
(14, 5, 2, 'pretest', 1, 3, 'salah', 1, '2021-08-27 20:38:46'),
(15, 5, 2, 'pretest', 1, 4, 'salah', 1, '2021-08-27 20:38:48'),
(16, 5, 2, 'pretest', 1, 5, 'benar', 1, '2021-08-27 20:38:51'),
(17, 5, 1, 'posttest', 1, 1, 'benar', 1, '2021-08-28 20:46:59'),
(18, 5, 1, 'posttest', 1, 2, 'salah', 1, '2021-08-28 21:32:33'),
(19, 5, 1, 'posttest', 1, 3, 'benar', 1, '2021-08-28 21:33:10'),
(20, 5, 1, 'posttest', 1, 4, 'benar', 1, '2021-08-28 21:33:20'),
(21, 5, 1, 'posttest', 1, 5, 'benar', 1, '2021-08-28 21:33:27'),
(22, 5, 1, 'posttest', 1, 6, 'benar', 1, '2021-08-28 21:33:31'),
(23, 5, 1, 'posttest', 1, 7, 'benar', 1, '2021-08-28 21:33:47'),
(24, 5, 1, 'posttest', 1, 8, 'benar', 1, '2021-08-28 21:33:50'),
(25, 5, 1, 'posttest', 1, 9, 'benar', 1, '2021-08-28 21:33:53'),
(26, 5, 1, 'posttest', 1, 10, 'benar', 1, '2021-08-28 21:33:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_options`
--

CREATE TABLE IF NOT EXISTS `tbl_options` (
  `option_id` int(11) NOT NULL,
  `option_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_options`
--

INSERT INTO `tbl_options` (`option_id`, `option_name`, `option_value`, `autoload`, `datetime`) VALUES
(1, 'web_title', 'E-Learning Telkom Sidoarjo', 'yes', '2017-03-23 22:56:54'),
(2, 'web_keywords', 'E-Learning Telkom Sidoarjo', 'yes', '2017-03-23 22:56:54'),
(3, 'web_favicon', 'favicon.png', 'yes', '2017-06-19 21:55:55'),
(4, 'web_email_administrator', 'ahmiarifuadi@gmail.com', 'yes', '2017-06-22 22:56:57'),
(5, 'web_admin_validation', 'telkomdmin', 'yes', '2017-06-22 22:57:56'),
(6, 'web_contact_email', 'admin@gmail.com', 'yes', '2017-07-06 22:55:57'),
(7, 'web_contact_address', 'Sidoarjo, Jawa Timur', 'yes', '2017-07-06 22:54:57'),
(8, 'web_contact_telp', '082191337793', 'yes', '2017-07-06 22:55:55'),
(9, 'web_about', 'Sistem Informasi Uji Kepribadian Seseorang adalah sistem yang berbasiskan web dengan metode Florence littauer yang dibuat dalam sebuah aplikasi perangkat lunak yang sedemikian rupa sehinggamenarik, mudah dan nyaman untuk digunakan sehingga dapat menjadi alternatif dalam pngujian tes kepribadian seseorang. pelaksanaan bentuk tes sekaligus menyelesaikan masalah - masalah yang terjadi pada metode pengukuran kepribadian terdahulu. ', 'yes', '2017-07-06 22:57:57'),
(10, 'web_user_validation', 'telkomuser', 'yes', '2017-07-11 22:56:56'),
(11, 'web_logo', 'LOGO-20210717-200644-5166.png', 'yes', '2017-07-15 22:55:55'),
(12, 'web_created', '2017-03-23 22:56:54', 'yes', '2017-03-23 22:56:54'),
(13, 'web_update', '2021-07-17 20:47:40', 'yes', '2017-03-23 22:56:54'),
(14, 'web_embed_map', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.463635072468!2d112.64289741425748!3d-7.187818772541945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd80021c04105fb%3A0x33be35c7dab4e191!2sKayu+Multiguna+Indonesia!5e0!3m2!1sid!2sid!4v1503036501279" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>', 'yes', '2017-08-18 22:57:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penilaian`
--

CREATE TABLE IF NOT EXISTS `tbl_penilaian` (
  `penilaian_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `penilaian_type` char(50) NOT NULL,
  `penilaian_sesi` int(11) NOT NULL,
  `penilaian_benar` int(11) NOT NULL,
  `penilaian_salah` int(11) NOT NULL,
  `penilaian_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penilaian`
--

INSERT INTO `tbl_penilaian` (`penilaian_id`, `user_id`, `course_id`, `penilaian_type`, `penilaian_sesi`, `penilaian_benar`, `penilaian_salah`, `penilaian_created`) VALUES
(1, 1, 5, 'pretest', 1, 3, 2, '2021-08-27 20:23:30'),
(2, 1, 5, 'pretest', 2, 1, 4, '2021-08-27 20:38:51'),
(3, 1, 5, 'posttest', 1, 9, 1, '2021-08-28 21:33:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_soal`
--

CREATE TABLE IF NOT EXISTS `tbl_soal` (
  `soal_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `soal_text` varchar(500) NOT NULL,
  `soal_no` int(11) NOT NULL,
  `soal_jawaban_a` varchar(250) NOT NULL,
  `soal_jawaban_b` varchar(250) NOT NULL,
  `soal_jawaban_c` varchar(250) NOT NULL,
  `soal_jawaban_d` varchar(250) NOT NULL,
  `soal_jawaban_e` varchar(250) NOT NULL,
  `soal_jawaban_benar` char(5) NOT NULL,
  `soal_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_soal`
--

INSERT INTO `tbl_soal` (`soal_id`, `course_id`, `soal_text`, `soal_no`, `soal_jawaban_a`, `soal_jawaban_b`, `soal_jawaban_c`, `soal_jawaban_d`, `soal_jawaban_e`, `soal_jawaban_benar`, `soal_created`) VALUES
(1, 5, 'Soal 1 tentang Tutorial upload PDF di web codeigniter', 1, 'jawaban 1  upload PDF di web', 'jawaban b  upload PDF di web', 'jawaban c  upload PDF di web', 'jawaban d  upload PDF di web', 'jawaban e  upload PDF di web', 'd', '2021-08-22 20:20:08'),
(2, 5, 'Soal 2 di web codeigniter ', 2, 'Jawab a ', 'Jawab b Tutorial upload PDF di web codeigniter ', 'Jawab c soal', 'Jawab d Tutorial upload PDF di web codeigniter ', 'Jawab d soal ini', 'b', '2021-08-22 21:18:02'),
(3, 5, 'Soal 3', 3, 'jawab 3 a', 'jawab b', 'jawab c', 'jawab d', 'jawab e', 'a', '2021-08-26 20:11:05'),
(4, 5, 'Soal 4', 4, 'jawab a', 'jawab b', 'jawab c', 'jawab d', 'jawab e e', 'd', '2021-08-26 20:13:33'),
(5, 5, 'Soal 5 pdf codeigniter', 5, 'jawab ', 'jawab ', 'jawab ', 'jawab ', 'jawab ', 'b', '2021-08-26 20:25:16'),
(6, 5, 'Soal 6 dari 10', 6, 'jawab aa', 'jawab bb', 'jawab cc', 'jawab dd', 'jawab ee', 'e', '2021-08-26 20:25:59'),
(7, 5, 'Soal 7 tujuh', 7, 'jawab 7', 'jawab 7', 'jawab 7', 'jawab 7', 'jawab 7', 'a', '2021-08-26 20:26:37'),
(8, 5, 'Soal Delapan 8', 8, 'jawab ', 'jawab ', 'jawab ', 'jawab ', 'jawab ', 'a', '2021-08-26 20:27:19'),
(9, 5, 'Soal 9', 9, 'jawab ', 'jawab ', 'jawab ', 'jawab ', 'jawab ', 'c', '2021-08-26 20:27:55'),
(10, 5, 'Soal Sepuluh Sepuluh', 10, 'jawab ', 'jawab ', 'jawab ', 'jawaban d', 'jawaban e', 'c', '2021-08-26 20:29:01'),
(11, 3, 'Soal 1 Academic English', 1, 'jawab 3 a', 'jawab b benar', 'c', 'jawaban d', 'jawab e e', 'b', '2021-08-28 21:09:48'),
(12, 3, 'Soal nomor 2 Academic English', 0, 'jawaban 1 Academic', 'jawaban b', 'C benar', 'd Academic', 'jawaban e E', 'c', '2021-08-28 21:12:41'),
(13, 3, 'Soal 3', 3, 'a jawab', 'b dijawab', 'c dan c', 'd d d d', 'e yang benar', 'e', '2021-08-28 21:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_telp` varchar(50) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(300) NOT NULL,
  `user_about` varchar(500) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_img` varchar(150) NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `user_jk` tinyint(1) NOT NULL,
  `user_alamat` text NOT NULL,
  `cookie` text NOT NULL,
  `user_login` datetime NOT NULL,
  `user_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_telp`, `username`, `password`, `user_about`, `user_name`, `user_email`, `user_img`, `user_status`, `tgl_lahir`, `user_jk`, `user_alamat`, `cookie`, `user_login`, `user_date`) VALUES
(1, '082299661235', 'nizar', 'f4327461daffaaaf9d1700847b87da97', 'Aku Adalah seorang programer', 'Nizaraluk', 'nizaraluk@gmail.com', '', 1, '1993-09-23', 1, 'Ngoro - Mojokerto', 'PkguXnirxIqyN94VSwv37LCf0H5QlMYt', '2021-09-02 18:33:55', '2020-07-10 21:10:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `tbl_jawaban`
--
ALTER TABLE `tbl_jawaban`
  ADD PRIMARY KEY (`jawaban_id`);

--
-- Indexes for table `tbl_options`
--
ALTER TABLE `tbl_options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `tbl_penilaian`
--
ALTER TABLE `tbl_penilaian`
  ADD PRIMARY KEY (`penilaian_id`);

--
-- Indexes for table `tbl_soal`
--
ALTER TABLE `tbl_soal`
  ADD PRIMARY KEY (`soal_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_jawaban`
--
ALTER TABLE `tbl_jawaban`
  MODIFY `jawaban_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `tbl_options`
--
ALTER TABLE `tbl_options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_penilaian`
--
ALTER TABLE `tbl_penilaian`
  MODIFY `penilaian_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_soal`
--
ALTER TABLE `tbl_soal`
  MODIFY `soal_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
