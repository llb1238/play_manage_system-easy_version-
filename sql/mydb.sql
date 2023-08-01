-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2023-08-01 15:28:45
-- 服务器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `mydb`
--

-- --------------------------------------------------------

--
-- 表的结构 `employee`
--

CREATE TABLE `employee` (
  `e_id` int(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `job_type` enum('dancer','actor') NOT NULL,
  `telephone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `employee`
--

INSERT INTO `employee` (`e_id`, `name`, `address`, `job_type`, `telephone`) VALUES
(1, 'llb', 'dddd', 'actor', 134232323),
(2, 'sss', 'sss', 'dancer', 123123214),
(3, '2222', '222', 'actor', 123132),
(4, '123142', '123124', 'dancer', 123124),
(5, '232323', '242424', 'actor', 24242),
(6, '343434', '343434', 'actor', 21233),
(7, '232114', '32323', 'actor', 121323);

-- --------------------------------------------------------

--
-- 表的结构 `production_company`
--

CREATE TABLE `production_company` (
  `c_id` int(6) NOT NULL,
  `c_name` varchar(50) NOT NULL,
  `c_telephone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `production_company`
--

INSERT INTO `production_company` (`c_id`, `c_name`, `c_telephone`) VALUES
(1, '', 111),
(2, '', 1),
(3, '', 222),
(4, '', 222),
(5, '', 0),
(6, '', 111),
(7, 'ddd', 111),
(8, '12', 333),
(9, '123123', 123132),
(10, 'npw', 23213),
(11, 'npw', 23213),
(12, 'sdsd', 12324),
(13, 'sdsd', 12324),
(14, '2222', 232312);

-- --------------------------------------------------------

--
-- 表的结构 `user_pass`
--

CREATE TABLE `user_pass` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `work_detail`
--

CREATE TABLE `work_detail` (
  `e_id` int(6) NOT NULL,
  `w_id` int(6) NOT NULL,
  `s_time` datetime NOT NULL,
  `e_time` datetime NOT NULL,
  `c_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转储表的索引
--

--
-- 表的索引 `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`e_id`);

--
-- 表的索引 `production_company`
--
ALTER TABLE `production_company`
  ADD PRIMARY KEY (`c_id`);

--
-- 表的索引 `work_detail`
--
ALTER TABLE `work_detail`
  ADD PRIMARY KEY (`w_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `employee`
--
ALTER TABLE `employee`
  MODIFY `e_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `production_company`
--
ALTER TABLE `production_company`
  MODIFY `c_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用表AUTO_INCREMENT `work_detail`
--
ALTER TABLE `work_detail`
  MODIFY `w_id` int(6) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
