-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2017 at 08:48 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `ans` longtext NOT NULL,
  `questionid` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `ans`, `questionid`, `status`) VALUES
(30, 'F9', 23, 'false'),
(31, 'Fine', 23, 'true'),
(32, 'Find', 23, 'false'),
(33, 'yes', 26, 'true'),
(34, 'Yeah', 26, 'false'),
(35, 'karachi', 24, 'true'),
(36, 'Khi', 24, 'false'),
(38, 'nothing', 27, 'true'),
(39, 'nathing', 27, 'false'),
(41, 'naathing', 27, 'false'),
(42, 'free', 27, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('ajrc7mekvv4ui4977lfg9g44of2jfqku', '::1', 1508135967, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530383133353936373b6e616d657c733a31383a2253796564204e617a6972204875737361696e223b646174657c733a31393a22323031372d31302d31362030383a32373a3139223b747970657c733a31393a2253757065722041646d696e6973747261746f72223b757365726e616d657c733a353a2241646d696e223b),
('glio1u6vg6mb1f0nsnt79amvopo2gd8s', '::1', 1508134234, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530383133343233343b),
('j0jt03hrljhcjijha0tkr49bnq0o49cr', '::1', 1508137321, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530383133373331353b6e616d657c733a31383a2253796564204e617a6972204875737361696e223b646174657c733a31393a22323031372d31302d31362030393a30313a3535223b747970657c733a31393a2253757065722041646d696e6973747261746f72223b757365726e616d657c733a353a2241646d696e223b),
('k4ekpue6bah4ui8k6ok9de879vu1sv0r', '::1', 1508136186, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530383133363138363b),
('laakgq854p9qmdbklpf9agvjkjrp7mr4', '::1', 1508135219, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530383133353231333b6e616d657c733a31383a2253796564204e617a6972204875737361696e223b646174657c733a31393a22323031372d31302d31362030383a32363a3539223b747970657c733a31393a2253757065722041646d696e6973747261746f72223b757365726e616d657c733a353a2241646d696e223b),
('n77q01lseel8gtatvgpouheq87ihp270', '::1', 1508136814, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530383133363737303b),
('pu3p7gqva2a08vl2tm8b6gs8m57s7njo', '::1', 1508135239, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530383133353233393b6e616d657c733a31383a2253796564204e617a6972204875737361696e223b646174657c733a31393a22323031372d31302d31362030383a32373a3139223b747970657c733a31393a2253757065722041646d696e6973747261746f72223b757365726e616d657c733a353a2241646d696e223b),
('rnt4abkm9s7ubh6kbsfmur6qf2scaglf', '::1', 1508136519, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530383133363232343b6e616d657c733a31383a2253796564204e617a6972204875737361696e223b646174657c733a31393a22323031372d31302d31362030383a34383a3335223b747970657c733a31393a2253757065722041646d696e6973747261746f72223b757365726e616d657c733a353a2241646d696e223b),
('ssl978vcp01d83c5q66fqp9uecijq9mg', '::1', 1508137398, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530383133373338343b6e616d657c733a31383a2253796564204e617a6972204875737361696e223b646174657c733a31393a22323031372d31302d31362030393a30333a3131223b747970657c733a31393a2253757065722041646d696e6973747261746f72223b757365726e616d657c733a353a2241646d696e223b),
('udvkk7ghe130o3eh5g25unikak307bb6', '::1', 1508134959, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530383133343734383b6e616d657c733a31383a2253796564204e617a6972204875737361696e223b646174657c733a31393a22323031372d31302d31362030383a32323a3339223b747970657c733a31393a2253757065722041646d696e6973747261746f72223b757365726e616d657c733a353a2241646d696e223b);

-- --------------------------------------------------------

--
-- Table structure for table `hobbies`
--

CREATE TABLE `hobbies` (
  `circket` tinyint(1) NOT NULL,
  `tennis` tinyint(1) NOT NULL,
  `football` tinyint(1) NOT NULL,
  `hockey` tinyint(1) NOT NULL,
  `personid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hobbies`
--

INSERT INTO `hobbies` (`circket`, `tennis`, `football`, `hockey`, `personid`) VALUES
(1, 0, 1, 0, 11),
(1, 0, 0, 0, 14);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `l_id` int(11) NOT NULL,
  `username` varchar(45) CHARACTER SET utf8 NOT NULL,
  `password` varchar(45) CHARACTER SET utf8 NOT NULL,
  `lastlogin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sessionid` varchar(10) NOT NULL,
  `IpAddress` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`l_id`, `username`, `password`, `lastlogin`, `sessionid`, `IpAddress`) VALUES
(1, 'syednazir13@gmail.com', '4e075844d2e00e4c800c8c62716bed8c', '2017-10-20 10:45:19', 'otukmnqsmx', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` longtext NOT NULL,
  `subjectid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `subjectid`) VALUES
(23, 'How are you?', 21),
(24, 'Where you live?', 21),
(26, 'You want any help', 22),
(27, 'What are you doing?', 21);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subject_name`) VALUES
(21, 'Asking Question'),
(22, 'Demo');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `name`) VALUES
(11, 'Nazir Hussain'),
(14, 'Anas Anwar');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`) VALUES
(3, 'syed', 'write2syednazir@yahoo.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questionid` (`questionid`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`,`ip_address`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `hobbies`
--
ALTER TABLE `hobbies`
  ADD KEY `personid` (`personid`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`l_id`),
  ADD UNIQUE KEY `sessionid_UNIQUE` (`sessionid`),
  ADD UNIQUE KEY `IpAddress_UNIQUE` (`IpAddress`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjectid` (`subjectid`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`questionid`) REFERENCES `questions` (`id`);

--
-- Constraints for table `hobbies`
--
ALTER TABLE `hobbies`
  ADD CONSTRAINT `hobbies_ibfk_1` FOREIGN KEY (`personid`) REFERENCES `test` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`subjectid`) REFERENCES `subject` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
