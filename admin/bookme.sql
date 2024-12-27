-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2016 at 05:02 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bookme`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminid` int(11) NOT NULL,
  `firstname` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL DEFAULT '',
  `password` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `image` varchar(250) NOT NULL,
  `Created_date` date NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '0=>Inactive, 1=>Active, 2=>Deleted',
  `modified_date` datetime NOT NULL,
  `ip_address` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `firstname`, `lastname`, `username`, `password`, `email`, `image`, `Created_date`, `status`, `modified_date`, `ip_address`) VALUES
(1, 'SUPER', 'ADMIN', 'bookme', 'd80da5c9c22c1e7fc1ce2f54866facaf', 'urvashi.patel@vrinsofts.com', '1441285547images.jpg', '2015-01-13', 1, '2015-09-10 21:29:08', '122.169.67.107');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE IF NOT EXISTS `tbl_booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `booking_status` int(11) NOT NULL COMMENT '0=>pending,1=>accept,2=>cancle',
  `cr_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`id`, `user_id`, `business_id`, `booking_date`, `start_time`, `end_time`, `message`, `booking_status`, `cr_date`, `update_date`, `status`, `ip_address`) VALUES
(1, 3, 1, '2015-05-18', '14:00', '15:00', 'we will meet regarding location', 2, '2015-09-07 00:23:45', '2015-09-08 05:04:56', 1, ''),
(2, 3, 1, '2015-09-07', '12:00', '16:00', 'testing', 0, '2015-09-07 00:24:24', '2015-09-07 00:24:24', 1, ''),
(3, 1, 1, '2015-05-18', '14:00', '15:00', 'we will meet regarding location', 0, '2015-09-07 03:02:50', '2015-09-07 03:02:50', 1, ''),
(4, 1, 1, '2015-05-18', '14:00', '15:00', 'we will meet regarding location', 0, '2015-09-07 03:04:03', '2015-09-07 03:04:03', 1, ''),
(5, 1, 1, '2015-05-18', '14:00', '15:00', 'we will meet regarding location', 0, '2015-09-07 07:41:24', '2015-09-07 07:41:24', 1, ''),
(6, 1, 1, '2015-05-18', '14:00', '15:00', 'we will meet regarding location', 0, '2015-09-07 07:42:38', '2015-09-07 07:42:38', 1, ''),
(7, 1, 1, '2015-05-18', '14:00', '15:00', 'we will meet regarding location', 0, '2015-09-07 07:47:32', '2015-09-07 07:47:32', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_business_images`
--

CREATE TABLE IF NOT EXISTS `tbl_business_images` (
  `id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `business_image` text NOT NULL,
  `cr_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_business_images`
--

INSERT INTO `tbl_business_images` (`id`, `business_id`, `business_image`, `cr_date`, `update_date`, `status`) VALUES
(1, 0, '', '2015-09-07 00:20:02', '2015-09-07 00:20:02', 1),
(2, 0, '', '2015-09-07 00:20:02', '2015-09-07 00:24:07', 1),
(3, 0, '', '2015-09-07 00:20:02', '2015-09-07 00:20:02', 1),
(4, 0, '', '2015-09-07 00:20:02', '2015-09-07 00:20:02', 1),
(5, 0, '', '2015-09-07 00:20:02', '2015-09-07 00:20:02', 1),
(6, 0, '', '2015-09-07 00:20:02', '2015-09-07 00:20:02', 1),
(7, 0, 'test1.png', '2015-09-07 00:20:55', '2015-09-07 00:21:56', 1),
(8, 0, '', '2015-09-07 00:20:55', '2015-09-07 00:21:56', 1),
(9, 0, 'test1.png', '2015-09-07 00:20:55', '2015-09-07 00:21:56', 1),
(10, 0, 'test1.png', '2015-09-07 00:20:55', '2015-09-07 00:21:56', 1),
(11, 0, 'test1.png', '2015-09-07 00:20:55', '2015-09-07 00:21:56', 1),
(12, 0, 'test1.png', '2015-09-07 00:20:55', '2015-09-07 00:21:56', 1),
(13, 0, '', '2015-09-07 00:21:41', '2015-09-07 00:21:41', 1),
(14, 0, '', '2015-09-07 00:21:41', '2015-09-07 00:21:41', 1),
(15, 0, '', '2015-09-07 00:21:41', '2015-09-07 00:21:41', 1),
(16, 0, '', '2015-09-07 00:21:41', '2015-09-07 00:21:41', 1),
(17, 0, '', '2015-09-07 00:21:41', '2015-09-07 00:21:41', 1),
(18, 0, '', '2015-09-07 00:21:41', '2015-09-07 00:21:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_business_profile`
--

CREATE TABLE IF NOT EXISTS `tbl_business_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_name` text NOT NULL,
  `business_desc` text NOT NULL,
  `business_url` varchar(255) NOT NULL,
  `business_address` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `business_date` datetime NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `lunch_start_time1` varchar(255) NOT NULL,
  `lunch_end_time1` varchar(255) NOT NULL,
  `lunch_start_time2` varchar(255) NOT NULL,
  `lunch_end_time2` varchar(255) NOT NULL,
  `working_day` varchar(255) NOT NULL,
  `holi_day` varchar(255) NOT NULL,
  `business_image` text NOT NULL,
  `interval_time` int(11) NOT NULL COMMENT 'in minutes',
  `status` int(2) NOT NULL,
  `cr_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_business_profile`
--

INSERT INTO `tbl_business_profile` (`id`, `user_id`, `business_name`, `business_desc`, `business_url`, `business_address`, `city_id`, `state_id`, `country_id`, `year`, `month`, `business_date`, `start_time`, `end_time`, `lunch_start_time1`, `lunch_end_time1`, `lunch_start_time2`, `lunch_end_time2`, `working_day`, `holi_day`, `business_image`, `interval_time`, `status`, `cr_date`, `update_date`, `ip_address`) VALUES
(1, 2, 'Vrinsoft', 'vrinsoft1', 'http://www.vrinsofts.com', 'ahmedabad', 1, 1, 1, 2015, '5', '2015-08-20 00:00:00', '09:30', '19:00', '13:00', '14:00', '15:00', '15:30', '1,2,3,4', '5,6,7', 'abc.png', 30, 1, '2015-09-07 00:20:02', '2015-09-07 00:20:02', '180.211.105.202'),
(2, 2, 'testsecondbusiness', 'This is my first McDonald Business Profile...', 'https://www.mcdelivery.co.in/', 'Testing Address of McDonald', 1, 1, 1, 2015, '9', '2015-09-20 00:00:00', '09:30', '19:00', '13:00', '14:00', '15:00', '15:30', '1,2,3,4,5', '6,7', 'test.png', 60, 1, '2015-09-07 00:20:55', '2015-09-07 00:24:07', '54.235.26.32'),
(3, 2, 'Vrinsoft1', 'vrinsoft1', 'http://www.vrinsofts1.com', 'ahmedabad1', 1, 1, 1, 2015, '9', '2015-09-07 00:00:00', '09:30', '19:00', '13:00', '14:00', '17:00', '18:30', '1,2,,4', '5,7', 'abc.png', 30, 1, '2015-09-07 00:21:41', '2015-09-07 00:21:41', '180.211.105.202');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE IF NOT EXISTS `tbl_city` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(200) NOT NULL,
  `status` int(2) NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>Deleted',
  `cr_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `ip_address` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`id`, `country_id`, `state_id`, `city_name`, `status`, `cr_date`, `modified_date`, `ip_address`) VALUES
(1, 1, 1, 'Surat', 1, '2015-09-07 01:52:29', '2015-09-07 01:52:29', '180.211.105.202'),
(2, 1, 1, 'Ahmedabad', 1, '2015-09-07 01:52:43', '2015-09-07 01:52:43', '180.211.105.202'),
(3, 1, 1, 'Rajkot', 1, '2015-09-07 01:52:58', '2015-09-07 01:52:58', '180.211.105.202'),
(4, 1, 2, 'Borivali', 1, '2015-09-07 01:53:20', '2015-09-07 01:53:20', '180.211.105.202'),
(5, 1, 2, 'Andheri', 1, '2015-09-07 01:55:44', '2015-09-07 01:55:44', '180.211.105.202');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cms`
--

CREATE TABLE IF NOT EXISTS `tbl_cms` (
  `id` int(11) NOT NULL,
  `page_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` int(2) NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>Deleted',
  `cr_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `ip_address` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cms`
--

INSERT INTO `tbl_cms` (`id`, `page_name`, `description`, `status`, `cr_date`, `modified_date`, `ip_address`) VALUES
(1, 'Terms of service', '<p><em>Morbi in </em>sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. Nam nulla quam, gravida non, commodo a, sodales sit amet, nisi. Pellentesque fermentum dolor. Aliquam quam lectus, facilisis auctor, ultrices ut, elementum vulputate, nunc.</p><br />\n', 1, '2014-11-08 12:25:30', '2015-09-10 23:56:32', '122.169.67.107'),
(2, 'Privacy Policy', '<h1>Privacy Policy</h1><br />\n	       <br />\n<p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. <a href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut felis.</p><br />\n<br />\n<h2>Header Level 2</h2><br />\n	       <br />\n<ol><br />\n   <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li><br />\n   <li>Aliquam tincidunt mauris eu risus.</li><br />\n</ol><br />\n<br />\n<blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.</p></blockquote><br />\n<br />\n<h3>Header Level 3</h3><br />\n<br />\n<ul><br />\n   <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li><br />\n   <li>Aliquam tincidunt mauris eu risus.</li><br />\n</ul><br />\n<br />\n<pre><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>', 1, '2014-11-08 12:26:18', '2015-09-07 08:57:34', '180.211.105.202'),
(3, 'About Us', '<p><strong>About Us </strong>Content Dummy text Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><br />\n', 1, '2014-11-13 00:09:15', '2015-09-03 07:39:12', '180.211.105.202'),
(4, 'test', '<p>About Us Desxriptive text<br /><br />\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><br />\n', 2, '2015-07-27 00:16:40', '2015-07-27 00:16:40', '122.179.180.227');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE IF NOT EXISTS `tbl_country` (
  `id` int(11) NOT NULL,
  `country_name` varchar(200) NOT NULL,
  `country_image` varchar(250) NOT NULL,
  `status` int(2) NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>Deleted',
  `cr_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `ip_address` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_country`
--

INSERT INTO `tbl_country` (`id`, `country_name`, `country_image`, `status`, `cr_date`, `modified_date`, `ip_address`) VALUES
(1, 'India', 'default.png', 1, '2015-09-07 03:19:26', '2015-09-11 00:06:54', '122.169.67.107');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deviceregister`
--

CREATE TABLE IF NOT EXISTS `tbl_deviceregister` (
  `id` int(25) NOT NULL,
  `userid` int(25) NOT NULL,
  `devicetype` int(2) NOT NULL DEFAULT '0' COMMENT '0=>Android,1=>Iphone',
  `devicetoken` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_like`
--

CREATE TABLE IF NOT EXISTS `tbl_like` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=>like,0=>unlike'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_like`
--

INSERT INTO `tbl_like` (`id`, `user_id`, `business_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 7, 1, 1),
(3, 7, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE IF NOT EXISTS `tbl_review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  `rating` float NOT NULL,
  `cr_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_section`
--

CREATE TABLE IF NOT EXISTS `tbl_section` (
  `Section_Id` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Link` varchar(255) DEFAULT NULL,
  `Image` varchar(255) DEFAULT 'default.png',
  `Description` text,
  `Order_no` int(11) DEFAULT NULL,
  `page_name` varchar(255) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `status` tinyint(2) DEFAULT NULL COMMENT '0=>Inactive, 1=>Active, 2=>Deleted'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_section`
--

INSERT INTO `tbl_section` (`Section_Id`, `Name`, `Link`, `Image`, `Description`, `Order_no`, `page_name`, `section_name`, `status`) VALUES
(1, 'Dashboard', 'dashboard', 'dashboard.png', 'This is Dashboard Page...', 1, 'Dashboard', 'Dashboard', 1),
(2, 'Master', 'country', 'default.png', 'This is master section..', 8, 'Country', 'Country', 1),
(3, 'User Master', 'usermaster', 'default.png', NULL, 2, 'User Master', 'User Master', 1),
(4, 'Director', 'director', 'default.png', NULL, 3, 'Director', 'Director', 1),
(5, 'Currency', 'currency', 'default.png', NULL, 4, 'Currency', 'Currency', 1),
(6, 'Workout Type', 'workout', 'default.png', NULL, 5, 'Workout Type', 'Workout Type', 1),
(7, 'CMS', 'cms', 'default.png', NULL, 6, 'CMS', 'CMS', 1),
(8, 'Workouts', 'workouts', 'default.png', NULL, 7, 'Workouts', 'Workouts', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sectionlink`
--

CREATE TABLE IF NOT EXISTS `tbl_sectionlink` (
  `Subsection_Id` int(11) NOT NULL,
  `Section_Id` int(11) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Link` varchar(255) DEFAULT NULL,
  `Image` varchar(255) NOT NULL DEFAULT 'default.png',
  `Order_no` int(11) DEFAULT NULL,
  `page_name` varchar(255) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `status` tinyint(2) DEFAULT NULL COMMENT '0=>Inactive, 1=>Active, 2=>Deleted'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sectionlink`
--

INSERT INTO `tbl_sectionlink` (`Subsection_Id`, `Section_Id`, `Title`, `Link`, `Image`, `Order_no`, `page_name`, `section_name`, `status`) VALUES
(1, 2, 'Country Management', 'country', 'default.png', 1, 'Country', 'Country', 1),
(3, 2, 'City Management', 'city', 'default.png', 3, 'City', 'City', 1),
(5, 2, 'Settings', 'setting', 'default.png', 6, 'Settings', 'Settings', 1),
(6, 3, 'User Master', 'usermaster', 'default.png', 1, 'User Master', 'User Master', 1),
(7, 4, 'Event Master', 'eventmaster', 'default.png', 1, 'Event Master', 'Event Master', 2),
(8, 5, 'Event Category', 'eventcategory', 'default.png', 1, 'Event Category', 'Event Category', 1),
(11, 7, 'CMS', 'cms', 'default.png', 1, 'CMS', 'CMS', 1),
(13, 1, 'Dashboard', 'dashboard', 'default.png', 1, 'Dashboard', '', 1),
(14, 2, 'State Management', 'state', 'default.png', 2, 'State', 'State', 1),
(15, 3, 'Trainee Users', 'trainee', 'default.png', 1, 'Trainee Users', 'Trainee User Management', 1),
(16, 3, 'Trainer Users', 'trainer', 'default.png', 1, 'Trainer Users', 'Trainer User Management', 1),
(17, 3, 'Chart', 'chart', 'default.png', 1, 'Chart', 'Chart', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `Id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL COMMENT 'site info email',
  `feedback_email` varchar(255) NOT NULL COMMENT 'email format signature text',
  `websiteName` varchar(255) NOT NULL,
  `time_slot` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `info` text NOT NULL,
  `address` text NOT NULL,
  `phone` bigint(22) NOT NULL,
  `fax` bigint(22) NOT NULL,
  `startyear` int(11) NOT NULL,
  `endyear` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `ip_address` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`Id`, `email`, `feedback_email`, `websiteName`, `time_slot`, `time`, `info`, `address`, `phone`, `fax`, `startyear`, `endyear`, `modified_date`, `ip_address`) VALUES
(1, 'urvashi.patel@vrinsofts.com', 'urvashi.patel@vrinsofts.com', 'Book me', '1', 1, '', '', 2147483647, 0, 2015, 2030, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE IF NOT EXISTS `tbl_state` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_name` varchar(200) NOT NULL,
  `status` int(2) NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>Deleted',
  `cr_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `ip_address` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`id`, `country_id`, `state_name`, `status`, `cr_date`, `modified_date`, `ip_address`) VALUES
(1, 1, 'Gujrat', 1, '2015-09-07 01:51:53', '2015-09-07 01:51:53', '180.211.105.202'),
(2, 1, 'Mumbai', 1, '2015-09-07 01:52:16', '2015-09-07 01:53:56', '180.211.105.202');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_time_slot`
--

CREATE TABLE IF NOT EXISTS `tbl_time_slot` (
  `id` int(11) NOT NULL,
  `businessid` int(11) NOT NULL,
  `starttime` varchar(255) NOT NULL,
  `endtime` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=575 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_time_slot`
--

INSERT INTO `tbl_time_slot` (`id`, `businessid`, `starttime`, `endtime`) VALUES
(555, 3, '09:30', '10:00'),
(556, 3, '10:00', '10:30'),
(557, 3, '10:30', '11:00'),
(558, 3, '11:00', '11:30'),
(559, 3, '11:30', '12:00'),
(560, 3, '12:00', '12:30'),
(561, 3, '12:30', '13:00'),
(564, 3, '14:00', '14:30'),
(565, 3, '14:30', '15:00'),
(566, 3, '15:00', '15:30'),
(567, 3, '15:30', '16:00'),
(568, 3, '16:00', '16:30'),
(569, 3, '16:30', '17:00'),
(573, 3, '18:30', '19:00'),
(574, 3, '19:00', '19:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL,
  `user_type` int(2) NOT NULL COMMENT '1 - FB USERS 2 - Business Users',
  `fbid` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `gender` int(11) NOT NULL COMMENT '1=>Male,2=>Female',
  `user_image` text NOT NULL,
  `dob` date NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `cr_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `status` int(2) NOT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `user_type`, `fbid`, `user_name`, `email`, `mobile_number`, `password`, `gender`, `user_image`, `dob`, `city_name`, `cr_date`, `update_date`, `status`, `ip_address`) VALUES
(1, 1, '100006986133864', 'Viral', 'viraldesai7642@gamil.com', '988775555', '', 1, '', '1988-05-28', 'ahmedabad', '2015-09-07 00:14:26', '2015-09-07 01:42:44', 1, '180.211.105.202'),
(2, 1, '1001', 'sejal', 'sejal.patel@vrinsofts.com', '1111111', '', 2, '', '1986-10-14', 'ahmedabad', '2015-09-07 00:15:37', '2015-09-07 00:15:37', 1, '180.211.105.202'),
(3, 1, '1002', 'viral', 'viral.desai@vrinsofts.com', '1111122211', '', 2, '', '1993-02-11', 'ahmedabad', '2015-09-07 00:18:39', '2015-09-07 00:18:39', 1, '180.211.105.202'),
(4, 1, '100220133864', 'samm', 'samdsdd04@yahoo.com', '1234567890', '', 1, '', '1988-05-28', 'ahmedabad', '2015-09-07 01:19:20', '2015-09-07 01:19:20', 1, '180.211.105.202'),
(5, 1, '1000076767864', 'samm', 'samir97784@yahoo.com', '1234567890', '', 1, '', '1988-05-28', 'ahmedabad', '2015-09-07 01:20:40', '2015-09-07 01:20:40', 1, '180.211.105.202'),
(6, 1, '1000063334554', 'strtrrtrtr', 'samir9004@yahoo.com', '1234567890', '', 1, '', '1988-05-28', 'ahmedabad', '2015-09-07 05:53:02', '2015-09-07 05:53:02', 1, '180.211.105.202'),
(7, 1, '10000001992', 'DhavalPatel', 'dhaval.gol1@vrinsofts.com', '12345678905', '', 1, 'FB_DP_50091508112752.jpg', '1988-05-28', 'ahmedabad', '2015-09-08 04:20:30', '2015-09-08 04:39:10', 1, '180.211.105.202'),
(8, 1, '10003864', 'samm', 'samir92224@yahoo.com', '1234567890', '', 1, '', '1988-05-28', 'ahmedabad', '2015-09-08 04:22:31', '2015-09-08 04:22:31', 1, '180.211.105.202');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `adminid` (`adminid`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_business_images`
--
ALTER TABLE `tbl_business_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_business_profile`
--
ALTER TABLE `tbl_business_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cms`
--
ALTER TABLE `tbl_cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_country`
--
ALTER TABLE `tbl_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_deviceregister`
--
ALTER TABLE `tbl_deviceregister`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_like`
--
ALTER TABLE `tbl_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_section`
--
ALTER TABLE `tbl_section`
  ADD PRIMARY KEY (`Section_Id`);

--
-- Indexes for table `tbl_sectionlink`
--
ALTER TABLE `tbl_sectionlink`
  ADD PRIMARY KEY (`Subsection_Id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_time_slot`
--
ALTER TABLE `tbl_time_slot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_business_images`
--
ALTER TABLE `tbl_business_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tbl_business_profile`
--
ALTER TABLE `tbl_business_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_cms`
--
ALTER TABLE `tbl_cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_country`
--
ALTER TABLE `tbl_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_deviceregister`
--
ALTER TABLE `tbl_deviceregister`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_like`
--
ALTER TABLE `tbl_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_section`
--
ALTER TABLE `tbl_section`
  MODIFY `Section_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_sectionlink`
--
ALTER TABLE `tbl_sectionlink`
  MODIFY `Subsection_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_time_slot`
--
ALTER TABLE `tbl_time_slot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=575;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
