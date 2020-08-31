-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-08-28 16:14:14
-- 伺服器版本： 10.4.14-MariaDB
-- PHP 版本： 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `ecb`
--

-- --------------------------------------------------------

--
-- 資料表結構 `check_contactbook`
--

CREATE TABLE `check_contactbook` (
  `id` int(11) NOT NULL,
  `s_NS` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `c_id` int(11) NOT NULL,
  `class` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `finish` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:未完成,1:完成',
  `created_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `check_contactbook`
--

INSERT INTO `check_contactbook` (`id`, `s_NS`, `c_id`, `class`, `finish`, `created_time`) VALUES
(1, '104021006', 4, '1-A', 0, '2020-08-28'),
(2, '104021039', 4, '1-A', 0, '2020-08-28'),
(3, '104021042', 4, '1-A', 0, '2020-08-28'),
(4, '104021043', 4, '1-A', 1, '2020-08-28'),
(5, '104021006', 5, '1-A', 0, '2020-08-28'),
(6, '104021039', 5, '1-A', 0, '2020-08-28'),
(7, '104021042', 5, '1-A', 0, '2020-08-28'),
(8, '104021043', 5, '1-A', 0, '2020-08-28');

-- --------------------------------------------------------

--
-- 資料表結構 `check_contactbook_parent`
--

CREATE TABLE `check_contactbook_parent` (
  `id` int(11) NOT NULL,
  `s_NS` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `parent_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` date NOT NULL,
  `finish` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0:未完成,1:完成'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `check_contactbook_parent`
--

INSERT INTO `check_contactbook_parent` (`id`, `s_NS`, `parent_name`, `class`, `created_date`, `finish`) VALUES
(1, '104021043', 'FungP', '1-A', '2020-08-28', 1),
(3, '104021006', 'WylieP', '1-A', '2020-08-28', 0),
(4, '104021039', 'WangP', '1-A', '2020-08-28', 0),
(5, '104021042', 'XiangP', '1-A', '2020-08-28', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `contactbook`
--

CREATE TABLE `contactbook` (
  `contactbook_id` int(11) NOT NULL,
  `class` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `context` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_date` date NOT NULL,
  `deadline` date NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `check` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `contactbook`
--

INSERT INTO `contactbook` (`contactbook_id`, `class`, `context`, `created_date`, `deadline`, `updated_time`, `check`) VALUES
(4, '1-A', '歷史章節1小考', '2020-08-28', '2020-08-29', '2020-08-28 14:04:49', 'false'),
(5, '1-A', '離散數學1', '2020-08-28', '2020-08-29', '2020-08-28 14:06:46', 'true');

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role` tinyint(2) NOT NULL COMMENT '1:老師 2:學生 3:家長'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`id`, `password`, `role`) VALUES
('0905007006', '0000', 3),
('0911211638', '0000', 3),
('0912123456', '0000', 3),
('0912345678', '0000', 3),
('104021006', '1109', 2),
('104021039', '0522', 2),
('104021042', '0218', 2),
('104021043', '0212', 2),
('teacher', 'admin', 1),
('teacher2', '0000', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `parent`
--

CREATE TABLE `parent` (
  `id` int(11) NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '預設:0000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `parent`
--

INSERT INTO `parent` (`id`, `phone`, `name`, `password`) VALUES
(7, '0912123456', 'FungP', '0000'),
(8, '0905007006', 'WylieP', '0000'),
(9, '0911211638', 'XiangP', '0000'),
(10, '0912345678', 'WangP', '0000');

-- --------------------------------------------------------

--
-- 資料表結構 `student`
--

CREATE TABLE `student` (
  `NS` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `student`
--

INSERT INTO `student` (`NS`, `name`, `password`, `phone`, `parent_phone`, `class`) VALUES
('104021006', 'Wylie', '1109', '0906007006', '0905007006', '1-A'),
('104021039', 'Wang', '0522', '0922331144', '0912345678', '1-A'),
('104021042', 'Xiang', '0218', '0923456412', '0911211638', '1-A'),
('104021043', 'Fung', '0212', '0911123456', '0912123456', '1-A');

-- --------------------------------------------------------

--
-- 資料表結構 `teacher`
--

CREATE TABLE `teacher` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `password`, `phone`, `class`) VALUES
('teacher', '王老明', 'admin', '0910123456', '1-A'),
('teacher2', '隔壁老王', '0000', '0910111222', '1-B');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `check_contactbook`
--
ALTER TABLE `check_contactbook`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `check_contactbook_parent`
--
ALTER TABLE `check_contactbook_parent`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `contactbook`
--
ALTER TABLE `contactbook`
  ADD PRIMARY KEY (`contactbook_id`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`NS`);

--
-- 資料表索引 `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `check_contactbook`
--
ALTER TABLE `check_contactbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `check_contactbook_parent`
--
ALTER TABLE `check_contactbook_parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `contactbook`
--
ALTER TABLE `contactbook`
  MODIFY `contactbook_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `parent`
--
ALTER TABLE `parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
