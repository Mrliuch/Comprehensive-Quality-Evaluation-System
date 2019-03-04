-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2019-03-04 11:17:55
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aaaaa`
--

-- --------------------------------------------------------

--
-- 表的结构 `apply`
--

CREATE TABLE `apply` (
  `apply_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `act_name` varchar(60) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `act_script` varchar(280) DEFAULT NULL,
  `phone` mediumtext,
  `jpg` varchar(60) DEFAULT NULL,
  `com_id` varchar(70) DEFAULT NULL,
  `temp` int(1) DEFAULT NULL,
  `aaa` int(30) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `result` text,
  `stat` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `community`
--

CREATE TABLE `community` (
  `student_id` int(100) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `com_key` varchar(40) DEFAULT NULL,
  `department` varchar(60) DEFAULT NULL,
  `temp` int(1) DEFAULT '0',
  `temp1` int(11) NOT NULL DEFAULT '0',
  `login_count` int(4) DEFAULT NULL,
  `last_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `community`
--

INSERT INTO `community` (`student_id`, `name`, `com_key`, `department`, `temp`, `temp1`, `login_count`, `last_time`, `update_time`, `create_time`) VALUES
(12165108, '刘晨', '3b712de48137572f3849aabd5666a4e3', NULL, 1, 1, 352, 1551674357, 1551674357, 1542619679);

-- --------------------------------------------------------

--
-- 表的结构 `fan`
--

CREATE TABLE `fan` (
  `id` int(30) NOT NULL,
  `status` int(3) DEFAULT '0' COMMENT '0关闭反馈 1开启 ',
  `one` int(2) DEFAULT NULL,
  `two` int(2) DEFAULT NULL,
  `three` int(2) DEFAULT NULL,
  `create_time` int(12) DEFAULT NULL,
  `uodate_time` int(12) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `fan`
--

INSERT INTO `fan` (`id`, `status`, `one`, `two`, `three`, `create_time`, `uodate_time`) VALUES
(1, 1, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `grade`
--

CREATE TABLE `grade` (
  `id` int(4) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `sum_g1` float DEFAULT NULL COMMENT '考评',
  `sum_g2` float DEFAULT NULL COMMENT '期末成绩',
  `sum_g12` float DEFAULT NULL COMMENT '综合成绩',
  `time1` varchar(50) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `xq` int(2) DEFAULT NULL,
  `status` int(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `note`
--

CREATE TABLE `note` (
  `id` int(4) NOT NULL,
  `up` text COMMENT '弹窗前',
  `note` text CHARACTER SET utf8 COMMENT '通知消息',
  `down` text COMMENT '弹窗后',
  `time` int(11) DEFAULT NULL COMMENT '发布时间',
  `per` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT '发布者',
  `a` int(1) DEFAULT '0' COMMENT '教师',
  `b` int(1) DEFAULT '0' COMMENT '学生干部',
  `c` int(1) DEFAULT '0' COMMENT '办公室',
  `d` int(1) DEFAULT '0' COMMENT '全体学生',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `note`
--

INSERT INTO `note` (`id`, `up`, `note`, `down`, `time`, `per`, `a`, `b`, `c`, `d`, `create_time`, `update_time`) VALUES
(26, 'alert("', '通知：考评分系统的反馈功能已开启，各位同学及时登录查看自己的考评，有问题的及时反馈，3月10日关闭反馈功能。', '");', 1551661697, '管理员', 0, 0, 0, 1, 1551661697, 1551661697);

-- --------------------------------------------------------

--
-- 表的结构 `one`
--

CREATE TABLE `one` (
  `one_id` int(11) NOT NULL,
  `one_name` varchar(30) DEFAULT NULL,
  `one_grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `one`
--

INSERT INTO `one` (`one_id`, `one_name`, `one_grade`) VALUES
(1, '基本素质成绩', 88),
(2, '拓展素质', 12);

-- --------------------------------------------------------

--
-- 表的结构 `perform`
--

CREATE TABLE `perform` (
  `perform_id` int(11) NOT NULL,
  `number` int(30) DEFAULT NULL,
  `activity` varchar(500) DEFAULT NULL,
  `grade` float DEFAULT NULL,
  `three_id` int(11) DEFAULT NULL,
  `date` int(2) DEFAULT NULL COMMENT '月份',
  `year` int(4) DEFAULT NULL COMMENT '学年',
  `xq` int(2) DEFAULT NULL COMMENT '学期',
  `temp` varchar(500) DEFAULT '无' COMMENT '备注',
  `upload_id` int(11) NOT NULL DEFAULT '0' COMMENT '上传者ID',
  `examine_id` int(11) DEFAULT NULL COMMENT '审核者ID',
  `examine` varchar(30) DEFAULT NULL COMMENT '审核署名',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更改时间',
  `abc` int(40) DEFAULT NULL COMMENT '创建时间戳',
  `beizhu` varchar(500) DEFAULT '无',
  `status` int(8) DEFAULT '0',
  `per` int(13) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(30) DEFAULT NULL,
  `gender` varchar(4) DEFAULT NULL,
  `phone` mediumtext,
  `nationality` varchar(30) DEFAULT NULL,
  `political_status` varchar(30) DEFAULT NULL,
  `temp` varchar(100) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `three`
--

CREATE TABLE `three` (
  `three_id` int(11) NOT NULL,
  `one_id` int(11) DEFAULT NULL,
  `two_id` int(11) DEFAULT NULL,
  `three_name` varchar(30) DEFAULT NULL,
  `three_grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `three`
--

INSERT INTO `three` (`three_id`, `one_id`, `two_id`, `three_name`, `three_grade`) VALUES
(1, 1, 1, '集体观念', 10),
(2, 1, 1, '学习态度', 10),
(3, 1, 1, '卫生习惯', 10),
(4, 1, 1, '生活态度', 10),
(5, 1, 2, '学期内各课程平均成绩', 100),
(6, 1, 2, '体质健康状况', 30),
(7, 1, 3, '阳光体育运动', 70),
(8, 2, 4, '校园文化活动', NULL),
(9, 2, 4, '文化、 艺术竞赛视频', NULL),
(10, 2, 4, '发表文艺、 新闻作品', NULL),
(11, 2, 5, '社会实践', NULL),
(12, 2, 5, '志愿服务', NULL),
(13, 2, 5, '创新创业', NULL),
(14, 2, 5, '学科竞赛', NULL),
(15, 2, 5, '学术著作', NULL),
(16, 2, 5, '实践技能', NULL),
(17, 2, 6, '任职情况', NULL),
(18, 1, 1, '政治素养', 10),
(19, 1, 1, '道德素养', 10),
(20, 1, 1, '法纪观念', 10),
(21, 1, 1, '诚信意识', 10),
(22, 1, 1, '安全意识', 10),
(23, 1, 1, '文明修养', 10);

-- --------------------------------------------------------

--
-- 表的结构 `two`
--

CREATE TABLE `two` (
  `two_id` int(11) NOT NULL,
  `one_id` int(11) DEFAULT NULL,
  `two_name` varchar(30) DEFAULT NULL,
  `two_grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `two`
--

INSERT INTO `two` (`two_id`, `one_id`, `two_name`, `two_grade`) VALUES
(1, 1, '思想道德及行为修养', 100),
(2, 1, '科学文化', 100),
(3, 1, '体质健康', 100),
(4, 2, '文化活动', 100),
(5, 2, '实践创新', 100),
(6, 2, '学生干部', 100);

-- --------------------------------------------------------

--
-- 表的结构 `view`
--

CREATE TABLE `view` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `year` int(4) DEFAULT NULL COMMENT '学年',
  `yue` int(4) DEFAULT NULL COMMENT '月份',
  `status` int(4) DEFAULT NULL COMMENT '1为选择'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `view`
--

INSERT INTO `view` (`id`, `name`, `year`, `yue`, `status`) VALUES
(3, '显示', 2018, 1, 0),
(4, '显示', 2018, 3, 0),
(5, '显示', 2018, 4, 0),
(6, '显示', 2018, 5, 0),
(7, '显示', 2018, 6, 0),
(8, '显示', 2018, 7, 0),
(9, '显示', 2018, 9, 1),
(10, '显示', 2018, 10, 1),
(11, '显示', 2018, 11, 1),
(12, '显示', 2018, 12, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`apply_id`);

--
-- Indexes for table `community`
--
ALTER TABLE `community`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `fan`
--
ALTER TABLE `fan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `one`
--
ALTER TABLE `one`
  ADD PRIMARY KEY (`one_id`);

--
-- Indexes for table `perform`
--
ALTER TABLE `perform`
  ADD PRIMARY KEY (`perform_id`),
  ADD KEY `number` (`number`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `three`
--
ALTER TABLE `three`
  ADD PRIMARY KEY (`three_id`);

--
-- Indexes for table `two`
--
ALTER TABLE `two`
  ADD PRIMARY KEY (`two_id`);

--
-- Indexes for table `view`
--
ALTER TABLE `view`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `apply`
--
ALTER TABLE `apply`
  MODIFY `apply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=862;
--
-- 使用表AUTO_INCREMENT `fan`
--
ALTER TABLE `fan`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1216;
--
-- 使用表AUTO_INCREMENT `note`
--
ALTER TABLE `note`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- 使用表AUTO_INCREMENT `one`
--
ALTER TABLE `one`
  MODIFY `one_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `perform`
--
ALTER TABLE `perform`
  MODIFY `perform_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90898;
--
-- 使用表AUTO_INCREMENT `three`
--
ALTER TABLE `three`
  MODIFY `three_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- 使用表AUTO_INCREMENT `two`
--
ALTER TABLE `two`
  MODIFY `two_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `view`
--
ALTER TABLE `view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
