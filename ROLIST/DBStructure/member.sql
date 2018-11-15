-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 18-11-15 15:25
-- 서버 버전: 10.3.7-MariaDB
-- PHP 버전: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `login`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `login`
--

CREATE TABLE `login` (
  `h_id` varchar(20) DEFAULT NULL,
  `h_password` varchar(20) DEFAULT NULL,
  `access` varchar(10) NOT NULL,
  `msg` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `login`
--

INSERT INTO `login` (`h_id`, `h_password`, `access`, `msg`) VALUES
('admin', 'admin', '1', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `loginpend`
--

CREATE TABLE `loginpend` (
  `h_id` varchar(100) DEFAULT NULL,
  `h_password` varchar(100) DEFAULT NULL,
  `access` int(16) DEFAULT NULL,
  `msg` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
