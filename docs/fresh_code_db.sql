-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2016 at 06:01 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fresh_code_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cd_admins`
--

CREATE TABLE IF NOT EXISTS `cd_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `dob` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_dated` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `login_activity` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `verification_code` text NOT NULL,
  `access_module` text NOT NULL,
  `location_access` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cd_admins`
--

INSERT INTO `cd_admins` (`id`, `first_name`, `last_name`, `email`, `password`, `dob`, `gender`, `type`, `created_dated`, `modified_date`, `login_activity`, `status`, `verification_code`, `access_module`, `location_access`) VALUES
(1, 'admin', 'wowrooms', 'boxer.sprighttech01@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', 'super', '2015-06-12 13:09:43', '2015-08-15 11:34:38', '0000-00-00 00:00:00', 1, '', '', ''),
(3, 'Admin1', 'Admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '', '', 'super', '0000-00-00 00:00:00', '2015-10-09 14:15:11', '0000-00-00 00:00:00', 1, '', '', ''),
(5, 'gthr', 'hgj', 'admin@example.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', '2015-10-09 14:15:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cd_banners`
--

CREATE TABLE IF NOT EXISTS `cd_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cd_cities`
--

CREATE TABLE IF NOT EXISTS `cd_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `state_code` varchar(255) NOT NULL,
  `city_code` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_content` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `show_header` int(11) NOT NULL,
  `show_footer` int(11) NOT NULL,
  `title` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

--
-- Dumping data for table `cd_cities`
--

INSERT INTO `cd_cities` (`id`, `name`, `latitude`, `longitude`, `state_code`, `city_code`, `image`, `state_id`, `meta_description`, `meta_content`, `meta_title`, `meta_keyword`, `show_header`, `show_footer`, `title`, `slug`, `created_date`, `modified_date`, `status`) VALUES
(1, 'Delhi', '', '', '', 'DL', '', 1, '', '', '', '', 0, 0, 'Delhi', 'south-delhi', '2015-07-17 11:50:20', '2015-08-31 16:23:29', 1),
(2, 'East Delhi', '', '', '', 'DL', '', 1, '', '', '', '', 0, 0, 'East Delhi', 'east-delhi', '2015-07-17 11:51:13', '2015-08-31 16:23:52', 0),
(3, 'West Delhi', '', '', '', 'West Delhi', '', 1, '', '', '', '', 1, 1, 'West Delhi', 'west-delhi', '2015-07-17 11:51:42', '2015-08-31 16:23:46', 0),
(4, 'Central Delhi', '', '', '', 'DL', '', 1, '', '', '', '', 1, 1, 'Central Delhi', 'central-delhi', '2015-07-17 11:52:16', '2015-08-31 16:24:04', 0),
(5, 'North Delhi', '', '', '', '', '', 1, '', '', '', '', 0, 0, 'North Delhi', 'north-delhi', '2015-07-17 11:52:44', '0000-00-00 00:00:00', 0),
(6, 'Gurgaon', '', '', '', 'Gurgaon', '', 9, '', '', '', '', 1, 1, 'Gurgaon', 'gurgaon', '2015-07-17 11:53:23', '2015-08-05 09:26:43', 1),
(7, 'Manesar', '', '', '', '', '', 9, '', '', '', '', 0, 0, 'Manesar', 'manesar', '2015-07-17 11:54:32', '0000-00-00 00:00:00', 1),
(8, 'Dharuhera', '', '', '', '', '', 9, '', '', '', '', 0, 0, 'Dharuhera', 'dharuhera', '2015-07-17 11:58:09', '0000-00-00 00:00:00', 1),
(9, 'Bhiwadi', '', '', '', '', '', 23, '', '', '', '', 0, 0, 'Bhiwadi', 'bhiwadi', '2015-07-17 12:00:12', '0000-00-00 00:00:00', 1),
(10, 'Faridabad', '', '', '', '', '', 9, '', '', '', '', 0, 0, 'Faridabad', 'faridabad', '2015-07-17 12:01:34', '0000-00-00 00:00:00', 1),
(11, 'Palwal', '', '', '', '', '', 9, '', '', '', '', 0, 0, 'Palwal', 'palwal', '2015-07-17 12:02:25', '0000-00-00 00:00:00', 1),
(12, 'Noida', '', '', '', '', '', 27, '', '', '', '', 0, 0, 'Noida', 'noida', '2015-07-17 12:03:57', '0000-00-00 00:00:00', 1),
(13, 'Greater Noida', '', '', '', '', '', 27, '', '', '', '', 0, 0, 'Greater Noida', 'greater-noida', '2015-07-17 12:04:31', '0000-00-00 00:00:00', 1),
(14, 'Ghaziabad', '', '', '', '', '', 27, '', '', '', '', 0, 0, 'Ghaziabad', 'ghaziabad', '2015-07-17 12:06:08', '0000-00-00 00:00:00', 1),
(15, 'Neemrana', '', '', '', '', '', 23, '', '', '', '', 0, 0, 'Neemrana', 'neemrana', '2015-07-17 12:08:24', '0000-00-00 00:00:00', 1),
(16, 'Panchkula', '', '', '', '', '', 9, '', '', '', '', 0, 0, 'Panchkula', 'panchkula', '2015-07-17 12:12:23', '0000-00-00 00:00:00', 1),
(17, 'Mohali', '', '', '', '', '', 22, '', '', '', '', 0, 0, 'Mohali', 'mohali', '2015-07-17 12:15:17', '0000-00-00 00:00:00', 1),
(18, 'Zirakpur', '', '', '', '', '', 22, '', '', '', '', 0, 0, 'Zirakpur', 'zirakpur', '2015-07-17 12:16:55', '0000-00-00 00:00:00', 1),
(19, 'Patiala', '', '', '', '', '', 22, '', '', '', '', 0, 0, 'Patiala', 'patiala', '2015-07-17 12:19:36', '0000-00-00 00:00:00', 1),
(20, 'Bathinda', '', '', '', '', '', 22, '', '', '', '', 0, 0, 'Bathinda', 'bathinda', '2015-07-17 12:23:16', '0000-00-00 00:00:00', 1),
(21, 'Mandi Gobindgarh', '', '', '', '', '', 22, '', '', '', '', 0, 0, 'Mandi Gobindgarh', 'mandi-gobindgarh', '2015-07-17 12:28:44', '0000-00-00 00:00:00', 1),
(22, 'Ludhiana', '', '', '', '', '', 22, '', '', '', '', 0, 0, 'Ludhiana', 'ludhiana', '2015-07-17 12:29:50', '0000-00-00 00:00:00', 1),
(23, 'Jalandhar', '', '', '', '', '', 22, '', '', '', '', 0, 0, 'Jalandhar', 'jalandhar', '2015-07-17 12:31:22', '0000-00-00 00:00:00', 1),
(24, 'Amritsar', '', '', '', '', '', 22, '', '', '', '', 0, 0, 'Amritsar', 'amritsar', '2015-07-17 12:32:48', '0000-00-00 00:00:00', 1),
(25, 'Jammu ', '', '', '', '', '', 11, '', '', '', '', 0, 0, 'Jammu ', 'jammu-and-kashmir', '2015-07-17 12:36:06', '2015-07-17 12:36:31', 1),
(26, 'Srinagar', '', '', '', '', '', 11, '', '', '', '', 0, 0, 'Srinagar', 'srinagar', '2015-07-17 12:39:02', '0000-00-00 00:00:00', 1),
(27, 'Dharamshala', '', '', '', '', '', 10, '', '', '', '', 0, 0, 'Dharamshala', 'dharamshala', '2015-07-17 12:41:18', '0000-00-00 00:00:00', 1),
(28, 'Una/Baddi', '', '', '', '', '', 10, '', '', '', '', 0, 0, 'Una/Baddi', 'unabaddi', '2015-07-17 12:42:18', '0000-00-00 00:00:00', 1),
(29, 'Shimla', '', '', '', '', '', 10, '', '', '', '', 0, 0, 'Shimla', 'shimla', '2015-07-17 12:44:05', '0000-00-00 00:00:00', 1),
(30, 'Manali', '', '', '', '', '', 10, '', '', '', '', 0, 0, 'Manali', 'manali', '2015-07-17 12:44:47', '0000-00-00 00:00:00', 1),
(31, 'Jaipur', '', '', '', '', '', 23, '', '', '', '', 0, 0, 'Jaipur', 'jaipur', '2015-07-17 12:45:42', '2015-07-24 10:29:04', 1),
(32, 'Jodhpur ', '', '', '', '', '', 23, '', '', '', '', 0, 0, 'Jodhpur ', 'jodhpur', '2015-07-17 12:46:54', '0000-00-00 00:00:00', 1),
(33, 'Udaipur', '', '', '', '', '', 23, '', '', '', '', 0, 0, 'Udaipur', 'udaipur', '2015-07-17 12:47:46', '0000-00-00 00:00:00', 1),
(34, 'Ajmer', '', '', '', '', '', 23, '', '', '', '', 0, 0, 'Ajmer', 'ajmer', '2015-07-17 12:48:38', '0000-00-00 00:00:00', 1),
(35, 'Pushkar', '', '', '', '', '', 23, '', '', '', '', 0, 0, 'Pushkar', 'pushkar', '2015-07-17 12:49:33', '0000-00-00 00:00:00', 1),
(36, 'Jaisalmer ', '', '', '', '', '', 23, '', '', '', '', 0, 0, 'Jaisalmer ', 'jaisalmer', '2015-07-17 12:50:53', '0000-00-00 00:00:00', 1),
(37, 'Dehradun', '', '', '', '', '', 28, '', '', '', '', 0, 0, 'Dehradun', 'dehradun', '2015-07-17 12:56:37', '0000-00-00 00:00:00', 1),
(38, 'Mussoorie', '', '', '', '', '', 28, '', '', '', '', 0, 0, 'Mussoorie', 'mussoorie', '2015-07-17 12:58:10', '0000-00-00 00:00:00', 1),
(39, 'Nainital ', '', '', '', '', '', 28, '', '', '', '', 0, 0, 'Nainital ', 'nainital', '2015-07-17 12:59:36', '0000-00-00 00:00:00', 1),
(40, 'Haridwar', '', '', '', '', '', 28, '', '', '', '', 0, 0, 'Haridwar', 'haridwar', '2015-07-17 13:00:34', '0000-00-00 00:00:00', 1),
(41, 'Rudrapur', '', '', '', '', '', 28, '', '', '', '', 0, 0, 'Rudrapur', 'rudrapur', '2015-07-17 13:01:54', '2015-07-17 13:03:27', 1),
(42, 'Rishikesh', '', '', '', '', '', 28, '', '', '', '', 0, 0, 'Rishikesh', 'rishikesh', '2015-07-17 13:05:19', '0000-00-00 00:00:00', 1),
(43, 'Saharanpur', '', '', '', '', '', 27, '', '', '', '', 0, 0, 'Saharanpur', 'saharanpur', '2015-07-17 13:06:14', '0000-00-00 00:00:00', 1),
(44, 'Roorkee', '', '', '', '', '', 28, '', '', '', '', 0, 0, 'Roorkee', 'roorkee', '2015-07-17 13:07:24', '0000-00-00 00:00:00', 1),
(45, 'Lucknow', '', '', '', '', '', 27, '', '', '', '', 0, 0, 'Lucknow', 'lucknow', '2015-07-17 13:08:32', '0000-00-00 00:00:00', 1),
(46, 'Varanasi', '', '', '', '', '', 27, '', '', '', '', 0, 0, 'Varanasi', 'varanasi', '2015-07-17 13:10:10', '0000-00-00 00:00:00', 1),
(47, 'Allahabad', '', '', '', 'AL', '', 27, '', '', '', '', 0, 0, 'Allahabad', 'allahabad', '2015-07-17 13:10:59', '2015-08-03 11:17:39', 1),
(48, 'Kanpur', '', '', '', '', '', 27, '', '', '', '', 0, 0, 'Kanpur', 'kanpur', '2015-07-17 13:11:54', '0000-00-00 00:00:00', 1),
(49, 'Agra', '', '', '', '', '', 27, '', '', '', '', 0, 0, 'Agra', 'agra', '2015-07-17 13:12:34', '0000-00-00 00:00:00', 1),
(50, 'Jhansi', '', '', '', '', '', 27, '', '', '', '', 0, 0, 'Jhansi', 'jhansi', '2015-07-17 13:12:59', '0000-00-00 00:00:00', 1),
(51, 'Meerut', '', '', '', '', '', 27, '', '', '', '', 0, 0, 'Meerut', 'meerut', '2015-07-17 13:13:55', '0000-00-00 00:00:00', 1),
(52, 'South Bangalore', '', '', '', '', '', 13, '', '', '', '', 0, 0, 'South Bangalore', 'south-bangalore', '2015-07-17 13:15:36', '0000-00-00 00:00:00', 1),
(53, 'East Banglore', '', '', '', '', '', 13, '', '', '', '', 0, 0, 'East Banglore', 'east-banglore', '2015-07-17 13:16:02', '0000-00-00 00:00:00', 1),
(54, 'North Banglore', '', '', '', '', '', 13, '', '', '', '', 0, 0, 'North Banglore', 'north-banglore', '2015-07-17 13:18:04', '0000-00-00 00:00:00', 1),
(55, 'Central Banglore', '', '', '', '', '', 13, '', '', '', '', 0, 0, 'Central Banglore', 'central-banglore', '2015-07-17 13:20:16', '0000-00-00 00:00:00', 1),
(56, 'West Banglore', '', '', '', '', '', 13, '', '', '', '', 0, 0, 'West Banglore', 'west-banglore', '2015-07-17 13:20:53', '0000-00-00 00:00:00', 1),
(57, 'Blore Extention', '', '', '', '', '', 13, '', '', '', '', 0, 0, 'Blore Extention', 'blore-extention', '2015-07-17 13:22:39', '0000-00-00 00:00:00', 1),
(58, 'Mysore', '', '', '', '', '', 13, '', '', '', '', 0, 0, 'Mysore', 'mysore', '2015-07-17 13:25:46', '0000-00-00 00:00:00', 1),
(59, 'Hosur', '', '', '', '', '', 25, '', '', '', '', 0, 0, 'Hosur', 'hosur', '2015-07-17 13:27:01', '0000-00-00 00:00:00', 1),
(60, 'Mangalore', '', '', '', '', '', 13, '', '', '', '', 0, 0, 'Mangalore', 'mangalore', '2015-07-17 13:27:49', '0000-00-00 00:00:00', 1),
(61, 'Hubli', '', '', '', '', '', 13, '', '', '', '', 0, 0, 'Hubli', 'hubli', '2015-07-17 13:28:25', '0000-00-00 00:00:00', 1),
(62, 'Davangere', '', '', '', '', '', 13, '', '', '', '', 0, 0, 'Davangere', 'davangere', '2015-07-17 13:30:36', '0000-00-00 00:00:00', 1),
(63, 'Belgaum', '', '', '', '', '', 13, '', '', '', '', 0, 0, 'Belgaum', 'belgaum', '2015-07-17 13:32:06', '0000-00-00 00:00:00', 1),
(64, 'Chennai ', '', '', '', '', '', 25, '', '', '', '', 0, 0, 'Chennai ', 'chennai', '2015-07-17 13:33:24', '0000-00-00 00:00:00', 1),
(65, 'Mahabalipuram', '', '', '', '', '', 25, '', '', '', '', 0, 0, 'Mahabalipuram', 'mahabalipuram', '2015-07-17 13:34:13', '2015-07-17 13:37:40', 1),
(66, 'Vellore', '', '', '', '', '', 25, '', '', '', '', 0, 0, 'Vellore', 'vellore', '2015-07-17 13:38:22', '0000-00-00 00:00:00', 1),
(67, 'Tiruchirappalli', '', '', '', '', '', 25, '', '', '', '', 0, 0, 'Tiruchirappalli', 'tiruchirappalli', '2015-07-17 13:39:09', '0000-00-00 00:00:00', 1),
(68, 'Madurai', '', '', '', '', '', 25, '', '', '', '', 0, 0, 'Madurai', 'madurai', '2015-07-17 13:39:57', '0000-00-00 00:00:00', 1),
(69, 'Thoothukudi', '', '', '', '', '', 25, '', '', '', '', 0, 0, 'Thoothukudi', 'thoothukudi', '2015-07-17 13:42:47', '0000-00-00 00:00:00', 1),
(70, 'Coimbatore', '', '', '', '', '', 25, '', '', '', '', 0, 0, 'Coimbatore', 'coimbatore', '2015-07-17 13:43:27', '0000-00-00 00:00:00', 1),
(71, 'Kanchipuram', '', '', '', '', '', 25, '', '', '', '', 0, 0, 'Kanchipuram', 'kanchipuram', '2015-07-17 13:47:38', '0000-00-00 00:00:00', 1),
(72, 'Salem', '', '', '', '', '', 25, '', '', '', '', 0, 0, 'Salem', 'salem', '2015-07-17 13:48:23', '0000-00-00 00:00:00', 1),
(73, 'Erode', '', '', '', '', '', 25, '', '', '', '', 0, 0, 'Erode', 'erode', '2015-07-17 13:49:45', '0000-00-00 00:00:00', 1),
(74, 'Namakkal', '', '', '', '', '', 25, '', '', '', '', 0, 0, 'Namakkal', 'namakkal', '2015-07-17 13:51:01', '0000-00-00 00:00:00', 1),
(75, 'Kanyakumari', '', '', '', '', '', 25, '', '', '', '', 0, 0, 'Kanyakumari', 'kanyakumari', '2015-07-17 13:51:50', '0000-00-00 00:00:00', 1),
(76, 'Puducherry ', '', '', '', '', '', 25, '', '', '', '', 0, 0, 'Puducherry ', 'puducherry', '2015-07-17 13:53:01', '2015-07-17 13:55:00', 1),
(77, 'Hyderabad', '', '', '', '', '', 2, '', '', '', '', 0, 0, 'Hyderabad', 'hyderabad', '2015-07-17 13:57:37', '0000-00-00 00:00:00', 1),
(78, 'Sikandrabad', '', '', '', '', '', 27, '', '', '', '', 0, 0, 'Sikandrabad', 'sikandrabad', '2015-07-17 13:59:16', '0000-00-00 00:00:00', 1),
(79, 'Vijayawada', '', '', '', '', '', 2, '', '', '', '', 0, 0, 'Vijayawada', 'vijayawada', '2015-07-17 14:00:09', '0000-00-00 00:00:00', 1),
(80, 'Vishakhapattnam', '', '', '', '', '', 2, '', '', '', '', 0, 0, 'Vishakhapattnam', 'vishakhapattnam', '2015-07-17 14:01:21', '0000-00-00 00:00:00', 1),
(81, 'Vijaynagar', '', '', '', '', '', 13, '', '', '', '', 0, 0, 'Vijaynagar', 'vijaynagar', '2015-07-17 14:02:25', '0000-00-00 00:00:00', 1),
(82, 'Kurnool', '', '', '', '', '', 2, '', '', '', '', 0, 0, 'Kurnool', 'kurnool', '2015-07-17 14:03:02', '0000-00-00 00:00:00', 1),
(83, 'Warangal ', '', '', '', '', '', 2, '', '', '', '', 0, 0, 'Warangal ', 'warangal', '2015-07-17 14:06:34', '0000-00-00 00:00:00', 1),
(84, 'Guntur', '', '', '', '', '', 2, '', '', '', '', 0, 0, 'Guntur', 'guntur', '2015-07-17 14:07:56', '2015-07-17 14:09:32', 1),
(85, 'Nellore', '', '', '', '', '', 2, '', '', '', '', 0, 0, 'Nellore', 'nellore', '2015-07-17 14:09:46', '0000-00-00 00:00:00', 1),
(86, 'Chittur', '', '', '', '', '', 2, '', '', '', '', 0, 0, 'Chittur', 'chittur', '2015-07-17 14:10:45', '0000-00-00 00:00:00', 1),
(87, 'Rajahmundry', '', '', '', '', '', 2, '', '', '', '', 0, 0, 'Rajahmundry', 'rajahmundry', '2015-07-17 14:11:35', '2015-07-17 14:12:29', 1),
(88, 'Tirupati', '', '', '', '', '', 2, '', '', '', '', 0, 0, 'Tirupati', 'tirupati', '2015-07-17 14:12:48', '0000-00-00 00:00:00', 1),
(89, 'Kakinada', '', '', '', '', '', 2, '', '', '', '', 0, 0, 'Kakinada', 'kakinada', '2015-07-17 14:13:21', '2015-07-17 14:13:56', 1),
(90, 'Thiruvananthapuram', '', '', '', '', '', 14, '', '', '', '', 0, 0, 'Thiruvananthapuram', 'thiruvananthapuram', '2015-07-17 14:14:58', '2015-07-17 14:15:50', 1),
(91, 'Kochi', '', '', '', '', '', 14, '', '', '', '', 0, 0, 'Kochi', 'kochi', '2015-07-17 14:16:34', '0000-00-00 00:00:00', 1),
(92, 'Ernakulam', '', '', '', '', '', 14, '', '', '', '', 0, 0, 'Ernakulam', 'ernakulam', '2015-07-17 14:18:23', '0000-00-00 00:00:00', 1),
(93, 'Kozhikode', '', '', '', '', '', 14, '', '', '', '', 0, 0, 'Kozhikode', 'kozhikode', '2015-07-17 14:19:03', '0000-00-00 00:00:00', 1),
(94, 'Malappuram', '', '', '', '', '', 14, '', '', '', '', 0, 0, 'Malappuram', 'malappuram', '2015-07-17 14:19:53', '0000-00-00 00:00:00', 1),
(95, 'Thrissur', '', '', '', '', '', 14, '', '', '', '', 0, 0, 'Thrissur', 'thrissur', '2015-07-17 14:20:54', '0000-00-00 00:00:00', 1),
(96, 'Kollam', '', '', '', '', '', 14, '', '', '', '', 0, 0, 'Kollam', 'kollam', '2015-07-17 14:21:27', '0000-00-00 00:00:00', 1),
(97, 'Karunagappalli ', '', '', '', '', '', 14, '', '', '', '', 0, 0, 'Karunagappalli ', 'karunagappalli', '2015-07-17 14:23:03', '2015-07-17 14:24:06', 1),
(98, 'South Mumbai', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'South Mumbai', 'south-mumbai', '2015-07-17 14:25:18', '0000-00-00 00:00:00', 1),
(99, 'Central Mumbai', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'Central Mumbai', 'central-mumbai', '2015-07-17 14:25:41', '0000-00-00 00:00:00', 1),
(100, 'North Mumbai ', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'North Mumbai  ', 'north-mumbai-navi-mumbai', '2015-07-17 14:26:08', '2015-07-17 14:26:24', 1),
(101, 'Navi Mumbai', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'Navi Mumbai', 'navi-mumbai', '2015-07-17 14:26:44', '0000-00-00 00:00:00', 1),
(102, 'Thane', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'Thane', 'thane', '2015-07-17 14:27:13', '0000-00-00 00:00:00', 1),
(103, 'Raigarh', '', '', '', '', '', 6, '', '', '', '', 0, 0, 'Raigarh', 'raigarh', '2015-07-17 14:28:17', '2015-07-17 14:29:07', 1),
(104, 'Pune', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'Pune', 'pune', '2015-07-17 14:30:10', '0000-00-00 00:00:00', 1),
(105, 'Nashik ', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'Nashik ', 'nashik', '2015-07-17 14:30:47', '0000-00-00 00:00:00', 1),
(106, 'Aurangabad', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'Aurangabad', 'aurangabad', '2015-07-17 14:31:27', '0000-00-00 00:00:00', 1),
(107, 'Nagpur', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'Nagpur', 'nagpur', '2015-07-17 14:32:00', '0000-00-00 00:00:00', 1),
(108, 'Shirdi', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'Shirdi', 'shirdi', '2015-07-17 14:33:28', '0000-00-00 00:00:00', 1),
(109, 'Solapur', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'Solapur', 'solapur', '2015-07-17 14:34:27', '2015-07-17 14:34:59', 1),
(110, 'Nanded', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'Nanded', 'nanded', '2015-07-17 14:35:44', '0000-00-00 00:00:00', 1),
(111, 'Sangli', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'Sangli', 'sangli', '2015-07-17 14:36:41', '0000-00-00 00:00:00', 1),
(112, 'Amravati', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'Amravati', 'amravati', '2015-07-17 14:37:27', '0000-00-00 00:00:00', 1),
(113, 'Jalgaon', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'Jalgaon', 'jalgaon', '2015-07-17 14:38:17', '0000-00-00 00:00:00', 1),
(114, 'Kolhapur', '', '', '', '', '', 16, '', '', '', '', 0, 0, 'Kolhapur', 'kolhapur', '2015-07-17 14:39:03', '0000-00-00 00:00:00', 1),
(115, 'Panaji', '', '', '', '', '', 7, '', '', '', '', 0, 0, 'Panaji', 'panaji', '2015-07-17 14:40:40', '0000-00-00 00:00:00', 1),
(116, 'Margao', '', '', '', '', '', 7, '', '', '', '', 0, 0, 'Margao', 'margao', '2015-07-17 14:41:25', '0000-00-00 00:00:00', 1),
(117, 'Vasco da Gama', '', '', '', '', '', 7, '', '', '', '', 0, 0, 'Vasco da Gama', 'vasco-da-gama', '2015-07-17 14:42:16', '2015-07-17 14:42:27', 1),
(118, 'North Goa', '', '', '', '', '', 7, '', '', '', '', 0, 0, 'North Goa', 'north-goa', '2015-07-17 14:42:48', '0000-00-00 00:00:00', 1),
(119, 'South Goa', '', '', '', '', '', 7, '', '', '', '', 0, 0, 'South Goa', 'south-goa', '2015-07-17 14:43:02', '0000-00-00 00:00:00', 1),
(120, 'Ahmedabad', '', '', '', '', '', 8, '', '', '', '', 0, 0, 'Ahmedabad', 'ahmedabad', '2015-07-17 14:43:25', '0000-00-00 00:00:00', 1),
(121, 'Surat', '', '', '', '', '', 8, '', '', '', '', 0, 0, 'Surat', 'surat', '2015-07-17 14:44:34', '2015-07-17 14:44:48', 1),
(122, 'Baroda', '', '', '', '', '', 8, '', '', '', '', 0, 0, 'Baroda', 'baroda', '2015-07-17 14:45:17', '0000-00-00 00:00:00', 1),
(123, 'Kutch', '', '', '', '', '', 8, '', '', '', '', 0, 0, 'Kutch', 'kutch', '2015-07-17 14:45:45', '0000-00-00 00:00:00', 1),
(124, 'Morbi', '', '', '', '', '', 8, '', '', '', '', 0, 0, 'Morbi', 'morbi', '2015-07-17 14:46:13', '0000-00-00 00:00:00', 1),
(125, 'Rajkot', '', '', '', '', '', 8, '', '', '', '', 0, 0, 'Rajkot', 'rajkot', '2015-07-17 14:46:32', '0000-00-00 00:00:00', 1),
(126, 'Indore', '', '', '', '', '', 15, '', '', '', '', 0, 0, 'Indore', 'indore', '2015-07-17 14:47:06', '0000-00-00 00:00:00', 1),
(127, 'Bhopal', '', '', '', '', '', 15, '', '', '', '', 0, 0, 'Bhopal', 'bhopal', '2015-07-17 14:47:26', '0000-00-00 00:00:00', 1),
(128, 'Gwalior', '', '', '', '', '', 15, '', '', '', '', 0, 0, 'Gwalior', 'gwalior', '2015-07-17 14:47:50', '0000-00-00 00:00:00', 1),
(129, 'Panchmadi', '', '', '', '', '', 15, '', '', '', '', 0, 0, 'Panchmadi', 'panchmadi', '2015-07-17 14:48:05', '0000-00-00 00:00:00', 1),
(130, 'Ujjain', '', '', '', '', '', 15, '', '', '', '', 0, 0, 'Ujjain', 'ujjain', '2015-07-17 14:48:22', '0000-00-00 00:00:00', 1),
(131, 'Jabalpur', '', '', '', '', '', 15, '', '', '', '', 0, 0, 'Jabalpur', 'jabalpur', '2015-07-17 14:48:41', '0000-00-00 00:00:00', 1),
(132, 'Raipur', '', '', '', '', '', 6, '', '', '', '', 0, 0, 'Raipur', 'raipur', '2015-07-17 14:49:16', '0000-00-00 00:00:00', 1),
(133, 'Bhilai', '', '', '', '', '', 6, '', '', '', '', 0, 0, 'Bhilai', 'bhilai', '2015-07-17 14:49:50', '0000-00-00 00:00:00', 1),
(134, 'North Kolkota', '', '', '', '', '', 29, '', '', '', '', 0, 0, 'North Kolkota', 'north-kolkota', '2015-07-17 14:51:21', '0000-00-00 00:00:00', 1),
(135, 'South Kolkata', '', '', '', '', '', 29, '', '', '', '', 0, 0, 'South Kolkata', 'south-kolkata', '2015-07-17 14:51:51', '0000-00-00 00:00:00', 1),
(136, 'Asansol', '', '', '', '', '', 29, '', '', '', '', 0, 0, 'Asansol', 'asansol', '2015-07-17 14:54:16', '0000-00-00 00:00:00', 1),
(137, 'Brahmapur', '', '', '', '', '', 21, '', '', '', '', 0, 0, 'Brahmapur', 'brahmapur', '2015-07-17 14:55:15', '0000-00-00 00:00:00', 1),
(138, 'Durgapur', '', '', '', '', '', 29, '', '', '', '', 0, 0, 'Durgapur', 'durgapur', '2015-07-17 14:56:55', '0000-00-00 00:00:00', 1),
(139, 'Silliguri', '', '', '', '', '', 29, '', '', '', '', 0, 0, 'Silliguri', 'silliguri', '2015-07-17 14:57:13', '0000-00-00 00:00:00', 1),
(140, 'Darjeeling', '', '', '', '', '', 29, '', '', '', '', 0, 0, 'Darjeeling', 'darjeeling', '2015-07-17 14:57:54', '0000-00-00 00:00:00', 1),
(141, 'Kharagpur', '', '', '', '', '', 29, '', '', '', '', 0, 0, 'Kharagpur', 'kharagpur', '2015-07-17 14:58:32', '0000-00-00 00:00:00', 1),
(142, 'Farakka', '', '', '', '', '', 29, '', '', '', '', 0, 0, 'Farakka', 'farakka', '2015-07-17 14:59:17', '0000-00-00 00:00:00', 1),
(143, 'Jalpaiguri', '', '', '', '', '', 29, '', '', '', '', 0, 0, 'Jalpaiguri', 'jalpaiguri', '2015-07-17 14:59:51', '0000-00-00 00:00:00', 1),
(144, 'Haldia', '', '', '', '', '', 29, '', '', '', '', 0, 0, 'Haldia', 'haldia', '2015-07-17 15:00:31', '0000-00-00 00:00:00', 1),
(145, 'Ranchi', '', '', '', '', '', 12, '', '', '', '', 0, 0, 'Ranchi', 'ranchi', '2015-07-17 15:03:53', '0000-00-00 00:00:00', 1),
(146, 'Jamshedpur', '', '', '', '', '', 12, '', '', '', '', 0, 0, 'Jamshedpur', 'jamshedpur', '2015-07-17 15:04:44', '0000-00-00 00:00:00', 1),
(147, 'Dhanbad', '', '', '', '', '', 12, '', '', '', '', 0, 0, 'Dhanbad', 'dhanbad', '2015-07-17 15:08:53', '0000-00-00 00:00:00', 1),
(148, 'Bhubneshwar', '', '', '', '', '', 21, '', '', '', '', 0, 0, 'Bhubneshwar', 'bhubneshwar', '2015-07-17 15:11:09', '0000-00-00 00:00:00', 1),
(149, 'Cuttack', '', '', '', '', '', 21, '', '', '', '', 0, 0, 'Cuttack', 'cuttack', '2015-07-17 15:11:44', '0000-00-00 00:00:00', 1),
(150, 'Rourkela', '', '', '', '', '', 21, '', '', '', '', 0, 0, 'Rourkela', 'rourkela', '2015-07-17 15:12:35', '0000-00-00 00:00:00', 1),
(151, 'Puri', '', '', '', '', '', 21, '', '', '', '', 0, 0, 'Puri', 'puri', '2015-07-17 15:13:12', '0000-00-00 00:00:00', 1),
(152, 'Chandipur', '', '', '', '', '', 21, '', '', '', '', 0, 0, 'Chandipur', 'chandipur', '2015-07-17 15:13:48', '0000-00-00 00:00:00', 1),
(153, 'Sambalpur', '', '', '', '', 'Lighthouse3.jpg', 21, '', '', '', '', 0, 0, 'Sambalpur', 'sambalpur', '2015-07-17 15:17:18', '0000-00-00 00:00:00', 1),
(154, 'Barhmapur', '', '', '', '', '', 21, '', '', '', '', 0, 0, 'Barhmapur', 'barhmapur', '2015-07-17 15:18:06', '0000-00-00 00:00:00', 1),
(155, 'Patna', '', '', '', '', '', 5, '', '', '', '', 0, 0, 'Patna', 'patna', '2015-07-17 15:18:33', '0000-00-00 00:00:00', 1),
(156, 'Begusarai', '', '', '', '', '', 5, '', '', '', '', 0, 0, 'Begusarai', 'begusarai', '2015-07-17 15:19:07', '0000-00-00 00:00:00', 1),
(157, 'Gaya', '', '', '', '', '', 5, '', '', '', '', 0, 0, 'Gaya', 'gaya', '2015-07-17 15:19:37', '0000-00-00 00:00:00', 1),
(158, 'Purnea', '', '', '', '', '', 5, '', '', '', '', 0, 0, 'Purnea', 'purnea', '2015-07-17 15:20:07', '0000-00-00 00:00:00', 1),
(159, 'Muzffarpur', '', '', '', '', '', 5, '', '', '', '', 0, 0, 'Muzffarpur', 'muzffarpur', '2015-07-17 15:20:36', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cd_countries`
--

CREATE TABLE IF NOT EXISTS `cd_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=268 ;

--
-- Dumping data for table `cd_countries`
--

INSERT INTO `cd_countries` (`id`, `name`, `order`, `status`) VALUES
(1, 'Afghanistan', 1000, 1),
(2, 'Albania', 1000, 1),
(3, 'Algeria', 1000, 1),
(4, 'American Samoa', 1000, 1),
(5, 'Andorra', 1000, 1),
(6, 'Angola', 1000, 1),
(7, 'Anguilla', 1000, 1),
(8, 'Antarctica', 1000, 1),
(9, 'Antigua and Barbuda', 1000, 1),
(10, 'Arctic Ocean', 1000, 1),
(11, 'Argentina', 1000, 1),
(12, 'Armenia', 1000, 1),
(13, 'Aruba', 1000, 1),
(14, 'Ashmore & Cartier Islands', 1000, 1),
(15, 'Atlantic Ocean', 1000, 1),
(16, 'Australia', 1000, 1),
(17, 'Austria', 1000, 1),
(18, 'Azerbaijan', 1000, 1),
(19, 'Bahamas', 1000, 1),
(20, 'Bahrain', 1000, 1),
(21, 'Baker Island', 1000, 1),
(22, 'Bangladesh', 1000, 1),
(23, 'Barbados', 1000, 1),
(24, 'Bassas da India', 1000, 1),
(25, 'Belarus', 1000, 1),
(26, 'Belgium', 1000, 1),
(27, 'Belize', 1000, 1),
(28, 'Benin', 1000, 1),
(29, 'Bermuda', 1000, 1),
(30, 'Bhutan', 1000, 1),
(31, 'Bolivia', 1000, 1),
(32, 'Bosnia and Herzegovina', 1000, 1),
(33, 'Botswana', 1000, 1),
(34, 'Bouvet Island', 1000, 1),
(35, 'Brazil', 1000, 1),
(36, 'BritishIndianOcean', 1000, 1),
(37, 'British Virgin Islands', 1000, 1),
(38, 'Brunei', 1000, 1),
(39, 'Bulgaria', 1000, 1),
(40, 'Burkina Faso', 1000, 1),
(41, 'Burma', 1000, 1),
(42, 'Burundi', 1000, 1),
(43, 'Cambodia', 1000, 1),
(44, 'Cameroon', 1000, 1),
(45, 'Canada', 1000, 1),
(46, 'Cape Verde', 1000, 1),
(47, 'Cayman Islands', 1000, 1),
(48, 'Central African Republic', 1000, 1),
(49, 'Chad', 1000, 1),
(50, 'Chile', 1000, 1),
(51, 'China', 1000, 1),
(52, 'Christmas Island', 1000, 1),
(53, 'Clipperton Island', 1000, 1),
(54, 'Cocos (Keeling) Islands', 1000, 1),
(55, 'Colombia', 1000, 1),
(56, 'Comoros', 1000, 1),
(57, 'Congo, Democratic Republic', 1000, 1),
(58, 'Congo, Republic', 1000, 1),
(59, 'Cook Islands', 1000, 1),
(60, 'Coral Sea Islands', 1000, 1),
(61, 'Costa Rica', 1000, 1),
(62, 'Cote d''Ivoire', 1000, 1),
(63, 'Croatia', 1000, 1),
(64, 'Cuba', 1000, 1),
(65, 'Cyprus', 1000, 1),
(66, 'Czech Republic', 1000, 1),
(67, 'Denmark', 1000, 1),
(68, 'Djibouti', 1000, 1),
(69, 'Dominica', 1000, 1),
(70, 'Dominican Republic', 1000, 1),
(71, 'Ecuador', 1000, 1),
(72, 'Egypt', 1000, 1),
(73, 'El Salvador', 1000, 1),
(74, 'Equatorial Guinea', 1000, 1),
(75, 'Eritrea', 1000, 1),
(76, 'Estonia', 1000, 1),
(77, 'Ethiopia', 1000, 1),
(78, 'Europa Island', 1000, 1),
(79, 'Falkland Islands', 1000, 1),
(80, 'Faroe Islands', 1000, 1),
(81, 'Fiji', 1000, 1),
(82, 'Finland', 1000, 1),
(83, 'France', 1000, 1),
(84, 'French Guiana', 1000, 1),
(85, 'French Polynesia', 1000, 1),
(86, 'French Southern', 1000, 1),
(87, 'Gabon', 1000, 1),
(88, 'Gambia', 1000, 1),
(89, 'Gaza Strip', 1000, 1),
(90, 'Georgia', 1000, 1),
(91, 'Germany', 1000, 1),
(92, 'Ghana', 1000, 1),
(93, 'Gibraltar', 1000, 1),
(94, 'Glorioso Islands', 1000, 1),
(95, 'Greece', 1000, 1),
(96, 'Greenland', 1000, 1),
(97, 'Grenada', 1000, 1),
(98, 'Guadeloupe', 1000, 1),
(99, 'Guam', 1000, 1),
(100, 'Guatemala', 1000, 1),
(101, 'Guernsey', 1000, 1),
(102, 'Guinea', 1000, 1),
(103, 'Guinea-Bissau', 1000, 1),
(104, 'Guyana', 1000, 1),
(105, 'Haiti', 1000, 1),
(106, 'Heard Island', 1000, 1),
(107, 'Holy See (Vatican City)', 1000, 1),
(108, 'Honduras', 1000, 1),
(109, 'Hong Kong', 1000, 1),
(110, 'Howland Island', 1000, 1),
(111, 'Hungary', 1000, 1),
(112, 'Iceland', 1000, 1),
(113, 'India', 1000, 1),
(114, 'Indian Ocean', 1000, 1),
(115, 'Indonesia', 1000, 1),
(116, 'Iran', 1000, 1),
(117, 'Iraq', 1000, 1),
(118, 'Ireland', 1000, 1),
(119, 'Israel', 1000, 1),
(120, 'Italy', 1000, 1),
(121, 'Jamaica', 1000, 1),
(122, 'Jan Mayen', 1000, 1),
(123, 'Japan', 1000, 1),
(124, 'Jarvis Island', 1000, 1),
(125, 'Jersey', 1000, 1),
(126, 'Johnston Atoll', 1000, 1),
(127, 'Jordan', 1000, 1),
(128, 'Juan de Nova Island', 1000, 1),
(129, 'Kazakhstan', 1000, 1),
(130, 'Kenya', 1000, 1),
(131, 'Kingman Reef', 1000, 1),
(132, 'Kiribati', 1000, 1),
(133, 'North Korea', 1000, 1),
(134, 'South Korea', 1000, 1),
(135, 'Kuwait', 1000, 1),
(136, 'Kyrgyzstan', 1000, 1),
(137, 'Laos', 1000, 1),
(138, 'Latvia', 1000, 1),
(139, 'Lebanon', 1000, 1),
(140, 'Lesotho', 1000, 1),
(141, 'Liberia', 1000, 1),
(142, 'Libya', 1000, 1),
(143, 'Liechtenstein', 1000, 1),
(144, 'Lithuania', 1000, 1),
(145, 'Luxembourg', 1000, 1),
(146, 'Macau', 1000, 1),
(147, 'Macedonia', 1000, 1),
(148, 'Madagascar', 1000, 1),
(149, 'Malawi', 1000, 1),
(150, 'Malaysia', 1000, 1),
(151, 'Maldives', 1000, 1),
(152, 'Mali', 1000, 1),
(153, 'Malta', 1000, 1),
(154, 'Man, Isle of', 1000, 1),
(155, 'Marshall Islands', 1000, 1),
(156, 'Martinique', 1000, 1),
(157, 'Mauritania', 1000, 1),
(158, 'Mauritius', 1000, 1),
(159, 'Mayotte', 1000, 1),
(160, 'Mexico', 1000, 1),
(161, 'Micronesia', 1000, 1),
(162, 'Midway Islands', 1000, 1),
(163, 'Moldova', 1000, 1),
(164, 'Monaco', 1000, 1),
(165, 'Mongolia', 1000, 1),
(166, 'Montserrat', 1000, 1),
(167, 'Morocco', 1000, 1),
(168, 'Mozambique', 1000, 1),
(169, 'Namibia', 1000, 1),
(170, 'Nauru', 1000, 1),
(171, 'Navassa Island', 1000, 1),
(172, 'Nepal', 1000, 1),
(173, 'Netherlands', 1000, 1),
(174, 'Netherlands Antilles', 1000, 1),
(175, 'New Caledonia', 1000, 1),
(176, 'New Zealand', 1000, 1),
(177, 'Nicaragua', 1000, 1),
(178, 'Niger', 1000, 1),
(179, 'Nigeria', 1000, 1),
(180, 'Niue', 1000, 1),
(181, 'Norfolk Island', 1000, 1),
(182, 'Northern Mariana Islands', 1000, 1),
(183, 'Norway', 1000, 1),
(184, 'Oman', 1000, 1),
(185, 'Pacific Ocean', 1000, 1),
(186, 'Pakistan', 1000, 1),
(187, 'Palau', 1000, 1),
(188, 'Palmyra Atoll', 1000, 1),
(189, 'Panama', 1000, 1),
(190, 'Papua New Guinea', 1000, 1),
(191, 'Paracel Islands', 1000, 1),
(192, 'Paraguay', 1000, 1),
(193, 'Peru', 1000, 1),
(194, 'Philippines', 1000, 1),
(195, 'Pitcairn Islands', 1000, 1),
(196, 'Poland', 1000, 1),
(197, 'Portugal', 1000, 1),
(198, 'Puerto Rico', 1000, 1),
(199, 'Qatar', 1000, 1),
(200, 'Reunion', 1000, 1),
(201, 'Romania', 1000, 1),
(202, 'Russia', 1000, 1),
(203, 'Rwanda', 1000, 1),
(204, 'Saint Helena', 1000, 1),
(205, 'Saint Kitts and Nevis', 1000, 1),
(206, 'Saint Lucia', 1000, 1),
(207, 'Saint Pierre and Miquelon', 1000, 1),
(208, 'Saint Vincent', 1000, 1),
(209, 'Samoa', 1000, 1),
(210, 'San Marino', 1000, 1),
(211, 'Sao Tome and Principe', 1000, 1),
(212, 'Saudi Arabia', 1000, 1),
(213, 'Senegal', 1000, 1),
(214, 'Seychelles', 1000, 1),
(215, 'Sierra Leone', 1000, 1),
(216, 'Singapore', 1000, 1),
(217, 'Slovakia', 1000, 1),
(218, 'Slovenia', 1000, 1),
(219, 'Solomon Islands', 1000, 1),
(220, 'Somalia', 1000, 1),
(221, 'South Africa', 1000, 1),
(222, 'South Georgia', 1000, 1),
(223, 'Southern Ocean', 1000, 1),
(224, 'Spain', 1000, 1),
(225, 'Spratly Islands', 1000, 1),
(226, 'Sri Lanka', 1000, 1),
(227, 'Sudan', 1000, 1),
(228, 'Suriname', 1000, 1),
(229, 'Svalbard', 1000, 1),
(230, 'Swaziland', 1000, 1),
(231, 'Sweden', 1000, 1),
(232, 'Switzerland', 1000, 1),
(233, 'Syria', 1000, 1),
(234, 'Taiwan', 1000, 1),
(235, 'Tajikistan', 1000, 1),
(236, 'Tanzania', 1000, 1),
(237, 'Thailand', 1000, 1),
(238, 'Togo', 1000, 1),
(239, 'Tokelau', 1000, 1),
(240, 'Tonga', 1000, 1),
(241, 'Trinidad and Tobago', 1000, 1),
(242, 'Tromelin Island', 1000, 1),
(243, 'Tunisia', 1000, 1),
(244, 'Turkey', 1000, 1),
(245, 'Turkmenistan', 1000, 1),
(246, 'Turks and Caicos Islands', 1000, 1),
(247, 'Tuvalu', 1000, 1),
(248, 'Uganda', 1000, 1),
(249, 'Ukraine', 1000, 1),
(250, 'United Arab Emirates', 1000, 1),
(251, 'United Kingdom', 1000, 1),
(252, 'United States', 1000, 1),
(253, 'Uruguay', 1000, 1),
(254, 'Uzbekistan', 1000, 1),
(255, 'Vanuatu', 1000, 1),
(256, 'Venezuela', 1000, 1),
(257, 'Vietnam', 1000, 1),
(258, 'Virgin Islands', 1000, 1),
(259, 'Wake Island', 1000, 1),
(260, 'Wallis and Futuna', 1000, 1),
(261, 'West Bank', 1000, 1),
(262, 'Western Sahara', 1000, 1),
(263, 'World', 1000, 1),
(264, 'Yemen', 1000, 1),
(265, 'Yugoslavia', 1000, 1),
(266, 'Zambia', 1000, 1),
(267, 'Zimbabwe', 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cd_faqs`
--

CREATE TABLE IF NOT EXISTS `cd_faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `ans` text NOT NULL,
  `step_types` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cd_faqs`
--

INSERT INTO `cd_faqs` (`id`, `question`, `ans`, `step_types`, `created_date`, `modified_date`, `status`) VALUES
(1, 'I don’t have some of the mandatory documents right now, what should I do?', 'You can skip this step for now and come back later to complete it. However, you can continue with other steps now.', '5', '2015-07-04 00:00:00', '2015-07-08 07:45:57', 1),
(2, 'Do I need to take the Evaluation quiz?', 'Yes, it is a mandatory step.', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 'I don''t have access to my phone right now, what should I do?', 'You can skip this step for now and come back later to complete it. However, you can continue with other steps now.', '2', '2015-07-04 00:00:00', '2015-07-08 07:46:17', 1),
(4, 'I did not receive the PIN code, what should I do?', 'Please enter only a valid 10 digit mobile number starting with 9, 8 or 7. SMS with PIN code might take few minutes.', '2', '0000-00-00 00:00:00', '2015-07-08 07:46:28', 1),
(5, 'I don’t have some of the mandatory documents right now, what should I do?', 'You can skip this step for now and come back later to complete it. However, you can continue with other steps now.', '2', '2015-07-04 00:00:00', '2015-07-08 07:47:11', 1),
(6, 'I don’t have current account, what should I do?', 'Enter and save rest of the information. Open current account against your company name and update later.', '3', '2015-07-06 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cd_pages`
--

CREATE TABLE IF NOT EXISTS `cd_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `html_title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createtime` varchar(255) NOT NULL,
  `modifytime` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cd_pages`
--

INSERT INTO `cd_pages` (`id`, `title`, `html_title`, `slug`, `heading`, `meta_title`, `meta_keyword`, `meta_description`, `images`, `content`, `createtime`, `modifytime`, `position`, `status`) VALUES
(1, 'Policy page', 'Privacy Policy', 'privacy-policy', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', '', '<h4>\r\n	Notification of Copyright Infringement:</h4>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	WOW Rooms respects the intellectual property rights of others and expects its users to do the same.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	It is WOW Rooms policy, in appropriate circumstances and at its discretion, to disable and/or terminate the account or access of users who repeatedly infringe or are repeatedly charged with infringing the copyrights or other intellectual property rights of others.</p>\r\n<p>\r\n	WOW Rooms will respond expeditiously to claims of copyright infringement committed using the WOW Rooms website and mobile application (the &quot;Site and Application&quot;) that are reported to WOW Rooms&rsquo; Designated Copyright Agent, identified in the sample notice below.</p>\r\n<p>\r\n	If you are a copyright owner, or are authorized to act on behalf of one, or authorized to act under any exclusive right under copyright, please report alleged copyright infringements taking place on or through the Site and Application to info@wowrooms.com</p>\r\n<p>\r\n	Deliver this Notice, with all items completed, to WOW Rooms Designated Copyright Team.</p>\r\n<p>\r\n	WOW Copyrights Team<br />\r\n	Our Delhi Office Address:<br />\r\n	CUG- 1F, 1st Floor Jumbo House l<br />\r\n	15 Dr jha Marg, Ishwar Nagar , Okhla<br />\r\n	New Delhi 110020</p>\r\n<p>\r\n	For queries you can reach out to us at contact@wowrooms.com</p>\r\n', '1433478812', '1437132802', 5, 1),
(2, 'About us', 'About us', 'about-us', 'About us', 'About us', 'About us', 'About us', '', '<p>\r\n	About us</p>\r\n', '1437130964', '1437132716', 2, 1);
INSERT INTO `cd_pages` (`id`, `title`, `html_title`, `slug`, `heading`, `meta_title`, `meta_keyword`, `meta_description`, `images`, `content`, `createtime`, `modifytime`, `position`, `status`) VALUES
(3, 'Terms & conditions', 'Terms & conditions', 'terms-conditions', 'Terms & conditions', 'Terms & conditions', 'Terms & conditions', 'Terms & conditions', '', '<p>\r\n	WOW Rooms private limited provides accommodations to rent with guests seeking to rent such accommodations (collectively, the &quot;Services&quot;), which Services are accessible at www.WOWrooms.com and any other websites through which WOW makes the Services available (collectively, the &quot;Site&quot;) and as an application for mobile devices (the &quot;Application&quot;). By using the Site and Application, you agree to comply with and be legally bound by the terms and conditions of these Terms of Service (&quot;Terms&quot;), whether or not you become a registered user of the Services. These Terms govern your access to and use of the Site, Application and Services and all Collective Content (defined below), and your participation in the Referral Program (defined below), and constitute a binding legal agreement between you and WOW. Please read carefully these Terms and our Privacy Policy, which may be found at http://www.WOWrooms.com/terms, and which is incorporated by reference into these Terms. If you do not agree to these Terms, you have no right to obtain information from or otherwise continue using the Site or Application. Failure to use the Site and Application in accordance with these Terms may subject you to civil and criminal penalties.</p>\r\n<p>\r\n	THE SITE, APPLICATION AND SERVICES COMPRISE AN ONLINE PLATFORM THROUGH WHICH HOSTS (DEFINED BELOW) MAY CREATE LISTINGS (DEFINED BELOW) FOR ACCOMMODATIONS (DEFINED BELOW) AND GUESTS (DEFINED BELOW) MAY LEARN ABOUT AND BOOK ACCOMMODATIONS. YOU UNDERSTAND AND AGREE THAT WOW IS NOT A PARTY TO ANY AGREEMENTS ENTERED INTO BETWEEN HOSTS AND GUESTS, NOR IS WOW A REAL ESTATE BROKER, AGENT OR INSURER. WOW HAS NO CONTROL OVER THE CONDUCT OF HOSTS, GUESTS AND OTHER USERS OF THE SITE, APPLICATION AND SERVICES OR ANY ACCOMMODATIONS, AND DISCLAIMS ALL LIABILITY IN THIS REGARD.</p>\r\n<h4 class="red_heading">\r\n	Key Terms</h4>\r\n<p>\r\n	WOW Content means all Content that WOW makes available through the Site, Application, or Services, including any Content licensed from a third party, but excluding Member Content.</p>\r\n<p>\r\n	Collective Content means Member Content and WOW Content.</p>\r\n<p>\r\n	Content means text, graphics, images, music, software (excluding the Application), audio, video, information or other materials.</p>\r\n<p>\r\n	Guest means a Member who requests a booking of an Accommodation via the Site, Application or Services, or a Member who stays at an Accommodation and is not the Host for such Accommodation.</p>\r\n<p>\r\n	Host means a Member who creates a Listing via the Site, Application and Services.</p>\r\n<p>\r\n	Listing means an Accommodation that is listed by a Host as available for rental via the Site, Application, and Services.</p>\r\n<p>\r\n	Member means a person who completes WOW&rsquo;s account registration process, including, but not limited to Hosts and Guests, as described under &quot;Account Registration&quot; below.</p>\r\n<p>\r\n	Member Content means all Content that a Member posts, uploads, publishes, submits or transmits to be made available through the Site, Application or Services.</p>\r\n<p>\r\n	Tax or &quot;Taxes&quot; mean any sales taxes, value added taxes (VAT), goods and services taxes (GST) and other similar municipal, state and national indirect or other withholding and personal or corporate income taxes.</p>\r\n<p>\r\n	Certain areas of the Site and Application (and your access to or use of certain aspects of the Services or Collective Content) may have different terms and conditions posted or may require you to agree with and accept additional terms and conditions. If there is a conflict between these Terms and terms and conditions posted for a specific area of the Site, Application, Services, or Collective Content, the latter terms and conditions will take precedence with respect to your use of or access to that area of the Site, Application, Services, or Collective Content.</p>\r\n<p>\r\n	YOU ACKNOWLEDGE AND AGREE THAT, BY ACCESSING OR USING THE SITE, APPLICATION OR SERVICES OR BY DOWNLOADING OR POSTING ANY CONTENT FROM OR ON THE SITE, VIA THE APPLICATION OR THROUGH THE SERVICES, OR BY PARTICIPATING IN THE REFERRAL PROGRAM, YOU ARE INDICATING THAT YOU HAVE READ, AND THAT YOU UNDERSTAND AND AGREE TO BE BOUND BY THESE TERMS, WHETHER OR NOT YOU HAVE REGISTERED WITH THE SITE AND APPLICATION. IF YOU DO NOT AGREE TO THESE TERMS, THEN YOU HAVE NO RIGHT TO ACCESS OR USE THE SITE, APPLICATION, SERVICES, OR COLLECTIVE CONTENT OR TO PARTICIPATE IN THE REFERRAL PROGRAM.</p>\r\n<p>\r\n	If you accept or agree to these Terms on behalf of a company or other legal entity, you represent and warrant that you have the authority to bind that company or other legal entity to these Terms and, in such event, &quot;you&quot; and &quot;your&quot; will refer and apply to that company or other legal entity.</p>\r\n<h4 class="red_heading">\r\n	Modification</h4>\r\n<p>\r\n	WOW reserves the right, at its sole discretion, to modify the Site, Application or Services or to modify these Terms, including the Service Fees, at any time and without prior notice. If we modify these Terms, we will post the modification on the Site or via the Application or provide you with notice of the modification. We will also update the &quot;Last Updated Date&quot; at the top of these Terms. By continuing to access or use the Site, Application or Services after we have posted a modification on the Site or via the Application or have provided you with notice of a modification, you are indicating that you agree to be bound by the modified Terms. If the modified Terms are not acceptable to you, your only recourse is to cease using the Site, Application and Services.</p>\r\n<h4 class="red_heading">\r\n	Eligibility</h4>\r\n<p>\r\n	The Site, Application and Services are intended solely for persons who are 18 or older. Any access to or use of the Site, Application or Services by anyone under 18 is expressly prohibited. By accessing or using the Site, Application or Services you represent and warrant that you are 18 or older.</p>\r\n<h4 class="red_heading">\r\n	How the Site, Application and Services Work</h4>\r\n<p>\r\n	The Site, Application and Services can be used to facilitate the listing and booking of residential and other properties (&quot;Accommodations&quot;). Such Accommodations are included in Listings on the Site, Application and Services by Hosts. You may view Listings as an unregistered visitor to the Site, Application and Services; however, if you wish to book an Accommodation or create a Listing, you must first register to create an WOW Account (defined below).</p>\r\n<p>\r\n	As stated above, WOW makes available a platform or marketplace with related technology for Guests and Hosts to meet online and arrange for bookings of Accommodations. WOW is not an owner or operator of properties, including, but not limited to, hotel rooms, motel rooms, other lodgings or Accommodations, nor is it a provider of properties, including, but not limited to, hotel rooms, motel rooms, other lodgings or Accommodations and WOW does not own, sell, resell, furnish, provide, rent, re-rent, manage and/or control properties, including, but not limited to, hotel rooms, motel rooms, other lodgings or Accommodations or transportation or travel services and WOW&rsquo;s role is solely to facilitate the availability of the Site, Application and Services. Similarly, WOW is not a contracting agent or representative of any Host. Instead, WOW&rsquo;s role is solely to facilitate the availability of the Site, Application and Services for Members and to provide services related thereto.</p>\r\n<p>\r\n	PLEASE NOTE THAT, AS STATED ABOVE, THE SITE, APPLICATION AND SERVICES ARE INTENTED TO BE USED TO FACILIATE THE BOOKING OF ACCOMODATIONS. WOW CANNOT AND DOES NOT CONTROL THE CONTENT CONTAINED IN ANY LISTINGS AND THE CONDITION, LEGALITY OR SUITABILITY OF ANY ACCOMMODATIONS. WOW IS NOT RESPONSIBLE FOR AND DISCLAIMS ANY AND ALL LIABILITY RELATED TO ANY AND ALL LISTINGS AND ACCOMMODATIONS. ACCORDINGLY, ANY BOOKINGS WILL BE MADE AT THE GUEST&rsquo;S OWN RISK.</p>\r\n<h4 class="red_heading">\r\n	Account Registration</h4>\r\n<p>\r\n	In order to access certain features of the Site and Application, and to book an Accommodation or create a Listing, you must register to create an account (&quot;WOW Account&quot;) and become a Member. You may register to join the Services directly via the Site or Application or as described in this section.</p>\r\n<p>\r\n	You can also register to join by logging into your account with certain third party social networking sites (&quot;SNS&quot;) (including, but not limited to, Facebook); each such account, a &quot;Third Party Account&quot;, via our Site or Application, as described below. As part of the functionality of the Site, Application and Services, you may link your WOW Account with Third Party Accounts, by either: (i) providing your Third Party Account login information to WOW through the Site, Services or Application; or (ii) allowing WOW to access your Third Party Account, as is permitted under the applicable terms and conditions that govern your use of each Third Party Account. You represent that you are entitled to disclose your Third Party Account login information to WOW and/or grant WOW access to your Third Party Account (including, but not limited to, for use for the purposes described herein), without breach by you of any of the terms and conditions that govern your use of the applicable Third Party Account and without obligating WOW to pay any fees or making WOW subject to any usage limitations imposed by such third party service providers. By granting WOW access to any Third Party Accounts, you understand that WOW will access, make available and store (if applicable) any Content that you have provided to and stored in your Third Party Account (&quot;SNS Content&quot;) so that it is available on and through the Site, Services and Application via your WOW Account and WOW Account profile page. Unless otherwise specified in these Terms, all SNS Content, if any, shall be considered to be Member Content for all purposes of these Terms. Depending on the Third Party Accounts you choose and subject to the privacy settings that you have set in such Third Party Accounts, personally identifiable information that you post to your Third Party Accounts will be available on and through your WOW Account on the Site, Services and Application. Please note that if a Third Party Account or associated service becomes unavailable or WOW&rsquo;s access to such Third Party Account is terminated by the third party service provider, then SNS Content will no longer be available on and through the Site, Services and Application. You have the ability to disable the connection between your WOW Account and your Third Party Accounts, at any time, by accessing the &quot;Settings&quot; section of the Site and Application.</p>\r\n<p>\r\n	PLEASE NOTE THAT YOUR RELATIONSHIP WITH THE THIRD PARTY SERVICE PROVIDERS ASSOCIATED WTH YOUR THIRD PARTY ACCOUNTS IS GOVERNED SOLELY BY YOUR AGREEMENT(S) WITH SUCH THIRD PARTY SERVICE PROVIDERS. WOW makes no effort to review any SNS Content for any purpose, including but not limited to, for accuracy, legality or non-infringement and WOW is not responsible for any SNS Content.</p>\r\n<p>\r\n	We will create your WOW Account and your WOW Account profile page for your use of the Site and Application based upon the personal information you provide to us or that we obtain via an SNS as described above. You may not have more than one (1) active WOW Account. You agree to provide accurate, current and complete information during the registration process and to update such information to keep it accurate, current and complete. WOW reserves the right to suspend or terminate your WOW Account and your access to the Site, Application and Services if you create more than one (1) WOW Account or if any information provided during the registration process or thereafter proves to be inaccurate, not current or incomplete. You are responsible for safeguarding your password. You agree that you will not disclose your password to any third party and that you will take sole responsibility for any activities or actions under your WOW Account, whether or not you have authorized such activities or actions. You will immediately notify WOW of any unauthorized use of your WOW Account.</p>\r\n<h4 class="red_heading">\r\n	Account Registration</h4>\r\n<p>\r\n	As a Member, you may create Listings. To this end, you will be asked a variety of questions about the Accommodation to be listed, including, but not limited to, the location, capacity, size, features, availability of the Accommodation and pricing and related rules and financial terms. In order to be featured in Listings via the Site, Application and Services, all Accommodations must have valid physical addresses. Listings will be made publicly available via the Site, Application and Services. Other Members will be able to book your Accommodation via the Site, Application and Services based upon the information provided in your Listing. You understand and agree that once a Guest requests a booking of your Accommodation, the price for such booking may not be altered.</p>\r\n<p>\r\n	You acknowledge and agree that you are solely responsible for any and all Listings you post. Accordingly, you represent and warrant that any Listing you post and the booking of, or Guest stay at, an Accommodation in a Listing you post (i) will not breach any agreements you have entered into with any third parties and (ii) will (a) be in compliance with all applicable laws, Tax requirements, and rules and regulations that may apply to any Accommodation included in a Listing you post, including, but not limited to, zoning laws and laws governing rentals of residential and other properties and (b) not conflict with the rights of third parties. Please note that WOW assumes no responsibility for a Host&rsquo;s compliance with any applicable laws, rules and regulations.</p>\r\n<p>\r\n	You understand and agree that WOW does not act as an insurer or as a contracting agent for, or representative of, you as a Host, and if a Guest requests a booking of your Accommodation and stays at your Accommodation, any agreement you enter into with such Guest is between you and the Guest and WOW is not a party thereto. Please note that WOW reserves the right, at any time and without prior notice, to remove or disable access to any Listing for any reason, including Listings that WOW, in its sole discretion, considers to be objectionable for any reason, in violation of these Terms or otherwise harmful to the Site, Application or Services.</p>\r\n<p>\r\n	When you create a Listing, you may also choose to include certain requirements which must be met by the Members who are eligible to request a booking of your Accommodation, including, but not limited to, requiring Members to have a profile picture or verified phone number, in order to book your Accommodation. Any Member wishing to book Accommodations included in Listings with such requirements must meet these requirements. More information on how to set such requirements is available via the &quot;Hosting&quot; section of the Site, Application and Services.</p>\r\n<p>\r\n	If you are a Host, WOW makes certain tools available to you to help you to make informed decisions about which Members you choose to confirm for booking for your Accommodation. You acknowledge and agree that, as a Host, you are responsible for your own acts and omissions and are also responsible for the acts and omissions of any individuals who reside at or are otherwise present at the Accommodation at your request or invitation, excluding the Guest (and the individuals the Guest invites to the Accommodation, if applicable.)</p>\r\n<p>\r\n	WOW recommends that Hosts obtain appropriate insurance for their Accommodations. Please review any insurance policy that you may have for your Accommodation carefully, and in particular please make sure that you are familiar with and understand any exclusions to, and any deductibles that may apply for, such insurance policy, including, but not limited to, whether or not your insurance policy will cover the actions or inactions of Guests (and the individuals the Guest invites to the Accommodation, if applicable) while at your Accommodation.</p>\r\n<h4 class="red_heading">\r\n	No Endorsement</h4>\r\n<p>\r\n	WOW does not endorse any Members or any Accommodations. In addition, although these Terms require Members to provide accurate information, we do not attempt to confirm, and do not confirm, any Member&rsquo;s purported identity. You are responsible for determining the identity and suitability of others who you contact via the Site, Application and Services. Except as provided in the WOW Host Guarantee Terms and Conditions (&quot;WOW Host Guarantee&quot;), which is an agreement between WOW and Hosts, we will not be responsible for any damage or harm resulting from your interactions with other Members. (Please see WOW&rsquo;s Host Guarantee Terms and Conditions at www.WOWrooms.com/terms for information about the WOW Host Guarantee.) By using the Site, Application or Services, you agree that any legal remedy or liability that you seek to obtain for actions or omissions of other Members or other third parties will be limited to a claim against the particular Members or other third parties who caused you harm and you agree not to attempt to impose liability on, or seek any legal remedy from WOW with respect to such actions or omissions. Accordingly, we encourage you to communicate directly with other Members on the Site and Services regarding any bookings or Listings made by you.</p>\r\n<h4 class="red_heading">\r\n	Bookings and Financial Terms for Hosts</h4>\r\n<p>\r\n	If you are a Host and a booking is requested for your Accommodation via the Site, Application and Services, you will be required to either confirm or reject the booking within 24 hours of when the booking is requested (as determined by WOW in its sole discretion) or the booking request will be automatically cancelled. When a booking is requested via the Site, Application and Services, we will share with you (i) the first and last name of the Guest who has requested the booking, (ii) a link to the Guest&rsquo;s WOW Account profile page, (iii) the names of any members of an SNS with whom you are &quot;friends&quot; or associated on the SNS if such individuals are also &quot;friends&quot; or associated with the Guest on such SNS, and (iv) an indication that the name that the Guest provided to WOW when the Guest became a Member matches the name that the Guest provided to the SNSs to which the Guest has linked his or her WOW Account, so that you can view such information before confirming or rejecting the booking. If you are unable to confirm or decide to reject a booking of an Accommodation within such 24 hour period, any amounts collected by WOW for the requested booking will be refunded to the applicable Guest&rsquo;s credit or debit card and any pre-authorization of such credit or debit card will be released. When you confirm a booking requested by a Guest, WOW will send you an email, text message or message via the Application confirming such booking, depending on the selections you make via the Site, Application and Services.</p>\r\n<p>\r\n	The fees displayed in each Listing are comprised of the Accommodation Fees (defined below) and the Guest Fees (defined below.) Where applicable, Taxes may be charged in addition to the Accommodation Fees and Guest Fees. The Accommodation Fees, the Guest Fees and applicable Taxes are collectively referred to in these Terms as the &quot;Total Fees&quot;. The amounts due and payable by a Guest solely relating to a Host&rsquo;s Accommodation are the &quot;Accommodation Fees&quot;. Please note that it is the Host and not WOW which determines the Accommodation Fees. The Accommodation Fee may include a cleaning fee, at the Host&rsquo;s discretion. WOW charges a fee to Guests based upon a percentage of applicable Accommodation Fees which are the &quot;Guest Fees&quot;. The Guest Fees are added to the Accommodation Fees to calculate the Total Fees (which will also include applicable Taxes) displayed in the applicable Listing. WOW will collect the Total Fees at the time of booking confirmation (i.e. when the Host confirms the booking within 24 hours of the booking request) and will remit the Accommodation Fees (less WOW&rsquo;s Host Fees (defined below)) to the Host within 24 hours of when the Guest arrives at the applicable Accommodation.</p>\r\n<p>\r\n	Please note that WOW does not currently charge fees for the creation of Listings. However, you acknowledge and agree that WOW reserves the right, in its sole discretion, to charge you for and collect fees from you for the creation of Listings. Please note that WOW will provide notice of any Listing fee collection via the Site, Application and Services, prior to implementing such a Listing fee feature.</p>\r\n<h4 class="red_heading">\r\n	Bookings and Financial Terms for Guests</h4>\r\n<p>\r\n	The Hosts, not WOW, are solely responsible for honoring any confirmed bookings and making available any Accommodations reserved through the Site, Application and Services. If you, as a Guest, choose to enter into a transaction with a Host for the booking of an Accommodation, you agree and understand that you will be required to enter into an agreement with the Host and you agree to accept any terms, conditions, rules and restrictions associated with such Accommodation imposed by the Host. You acknowledge and agree that you, and not WOW, will be responsible for performing the obligations of any such agreements, and WOW is not a party to such agreements and disclaims all liability arising from or related to any such agreements.</p>\r\n<p>\r\n	Listings for Accommodations will specify the Total Fees. As noted above, the Host is required to either confirm or reject the booking within 24 hours of when the booking is requested (as determined by WOW in its sole discretion) or the requested booking will be automatically cancelled. If a requested booking is cancelled (i.e. not confirmed by the applicable Host), any amounts collected by WOW will be refunded to such Guest, depending on the selections the Guest makes via the Site and Application, and any pre-authorization of such Guest&rsquo;s credit or debit card will be released, if applicable.</p>\r\n<p>\r\n	You agree to pay WOW for the Total Fees for any booking requested in connection with your WOW Account if the applicable Host confirms such requested bookings. In order to establish a booking pending the applicable Host&rsquo;s confirmation of your requested booking, you understand and agree that WOW reserves the right, in its sole discretion, to (i) obtain a pre-authorization via your credit or debit card for the Total Fees or (ii) charge your credit or debit card a nominal amount, not to exceed fifty rupees (INR 50), or a similar sum in the currency in which you are transacting ( e.g. one euro or one British pound) to verify your credit or debit card. Once WOW receives confirmation of your booking from the applicable Host, WOW will collect the Total Fees in accordance with the terms and conditions of these Terms and the pricing terms set forth in the applicable Listing. Please note that WOW cannot control any fees that may be charged to a Guest by his or her bank related to WOW&rsquo;s collection of the Total Fees, and WOW disclaims all liability in this regard.</p>\r\n<p>\r\n	In connection with your requested booking, you will be asked to provide customary billing information such as name, billing address and credit or debit card information either to WOW or its third party payment processor. You agree to pay WOW for any confirmed bookings made in connection with your WOW Account in accordance with these Terms by one of the methods described on the Site or Application &ndash; e.g. by PayPal or credit or debit card. You hereby authorize the collection of such amounts by charging the credit or debit card provided as part of requesting the booking, either directly by WOW or indirectly, via a third party online payment processor or by one of the payment methods described on the Site or Application. You also authorize WOW to charge your credit or debit card in the event of damage caused at an Accommodation as contemplated under &quot;Damage to Accommodations&quot; below and for Security Deposits, if applicable. If you are directed to WOW&rsquo;s third party payment processor, you may be subject to terms and conditions governing use of that third party&rsquo;s service and that third party&rsquo;s personal information collection practices. Please review such terms and conditions and privacy policy before using the services.Once your confirmed booking transaction is complete you will receive a confirmation email summarizing your confirmed booking.</p>\r\n<h4 class="red_heading">\r\n	Security Deposits</h4>\r\n<p>\r\n	Hosts may choose to include security deposits in their Listings (&quot;Security Deposits&quot;). Each Listing will describe whether a Security Deposit is required for the applicable Accommodation. If a Security Deposit is included in a Listing for a confirmed booking of Accommodation, WOW will use its commercially reasonable efforts to obtain a pre-authorization of the Guest&rsquo;s credit or debit card in the amount the Host determines for the Security Deposit within a reasonable time prior to the Guest&rsquo;s check-in at the applicable Host&rsquo;s Accommodation. WOW will also use its commercially reasonable efforts to address Hosts&rsquo; requests and claims related to Security Deposits, but WOW is not responsible for administering or accepting any claims by Hosts related to Security Deposits, and disclaims any and all liability in this regard.</p>\r\n<h4 class="red_heading">\r\n	Service Fees</h4>\r\n<p>\r\n	In consideration for providing the Services, WOW collects service fees from Hosts and Guests (&quot;Service Fees&quot;). Service Fees are made up of two (2) components: (i) Guest Fees and (ii) a fee that is charged to the Host based upon a percentage of the amount of the Accommodation Fees (&quot;Host Fees&quot;). Where applicable, Taxes may also be charged in addition to the Host Fees. Host Fees are deducted from the Accommodation Fees before remitting the Accommodation Fees to the Host, within 24 hours of when the Guest arrives at the applicable Accommodation. Guest Fees are, as noted above, included in the Total Fees.</p>\r\n<p>\r\n	Balances will be remitted to Hosts via check, PayPal, direct deposit or other payment methods described on the Site or via the Application, in the Host&rsquo;s currency of choice, depending upon the selections the Host makes via the Site, Application and Services. Please note that for any payments by WOW in currencies other than INDIAN RUPEES, WOW may deduct foreign currency processing costs from such payments. Except as otherwise provided herein, Service Fees are non-refundable.</p>\r\n<h4 class="red_heading">\r\n	Cancellations and Refunds</h4>\r\n<p>\r\n	If, as a Guest, you cancel your requested booking before the requested booking is confirmed by a Host, WOW will refund any Accommodation Fees collected for such requested booking within a commercially reasonable time. If, as a Guest, you wish to cancel a confirmed booking made via the Site, Application and Services, the cancellation policy of the Host contained in the applicable Listing will apply to such cancellation. Also, the refund will be made to the customer&#39;s account.</p>\r\n<p>\r\n	If a Host cancels a confirmed booking made via the Site, Services, and Application, (i) WOW will refund the Total Fees for such booking to the applicable Guest within a commercially reasonable time of the cancellation and (ii) the Guest will receive an email or other communication from WOW containing alternative Listings and other related information. If the Guest requests a booking from one of the alternative Listings and the Host associated with such alternative Listing confirms the Guest&rsquo;s requested booking, then the Guest agrees to pay WOW the Total Fees relating to the confirmed booking for the Accommodation in the alternative Listing, in accordance with these Terms. If a Host cancelled a confirmed booking and you, as a Guest, have not received an email or other communication from WOW, please contact WOW at http://www.WOWrooms.com/home/contact.</p>\r\n<h4 class="red_heading">\r\n	Donations</h4>\r\n<p>\r\n	Some Hosts may pledge to donate a portion of the funds they receive from confirmed bookings made via the Site, Application and Services to a particular cause or charity. We do not control, and will not take any responsibility or liability for, whether the Host does in fact make the donation he or she pledged to make.</p>\r\n<h4 class="red_heading">\r\n	Taxes</h4>\r\n<p>\r\n	You understand and agree that you are solely responsible for determining your applicable Tax reporting requirements in consultation with your tax advisors. WOW cannot and does not offer Tax-related advice to any Members of the Site, Application and Services. Additionally, please note that each Host is responsible for determining local indirect Taxes and for including any applicable Taxes to be collected or obligations relating to applicable Taxes in Listings. Where applicable, or based upon request from a Host, WOW may issue a valid VAT invoice to such Host.</p>\r\n<h4 class="red_heading">\r\n	Damage to Accommodations</h4>\r\n<p>\r\n	As a Guest, you are responsible for leaving the Accommodation in the condition it was in when you arrived. You acknowledge and agree that, as a Guest, you are responsible for your own acts and omissions and are also responsible for the acts and omissions of any individuals who you invite to, or otherwise provide access to, the Accommodation. In the event that a Host claims otherwise and provides evidence of damage, including but not limited to, photographs, you agree to pay the cost of replacing the damaged items with equivalent items. After being notified of the claim and given forty eight (48) hours to respond, the payment will be charged to and taken from the credit or debit card on file in your WOW Account. WOW also reserves the right to charge the credit or debit card on file in your WOW Account, or otherwise collect payment from you and pursue any avenues available to WOW in this regard, including using Security Deposits, in situations in which you have been determined, in WOW&rsquo;s sole discretion, to have damaged any Accommodation, including, but not limited to, in relation to any payment requests made by Hosts under the WOW Host Guarantee, and in relation to any payments made by WOW to Hosts. If we are unable to charge the credit or debit card on file or otherwise collect payment from you, you agree to remit payment for any damage to the Accommodation to the applicable Host or to WOW (if applicable).</p>\r\n<p>\r\n	Both Guests and Hosts agree to cooperate with and assist WOW in good faith, and to provide WOW with such information and take such actions as may be reasonably requested by WOW, in connection with any complaints or claims made by Members relating to Accommodations or any personal or other property located at an Accommodation (including, without limitation, payment requests made under the WOW Host Guarantee) or with respect to any investigation undertaken by WOW or a representative of WOW regarding use or abuse of the Site, Application or the Services. If you are a Guest, upon WOW&rsquo;s reasonable request, and to the extent you are reasonably able to do so, you agree to participate in mediation or similar resolution process with a Host, at no cost to you, which process will be conducted by WOW or a third party selected by WOW, with respect to losses for which the Host is requesting payment from WOW under the WOW Host Guarantee.</p>\r\n<p>\r\n	If you are a Guest, you understand and agree that WOW reserves the right, in its sole discretion, to make a claim under your homeowner&rsquo;s, renter&rsquo;s or other insurance policy related to any damage or loss that you may have caused or been responsible for to an Accommodation or any personal or other property located at an Accommodation. You agree to cooperate with and assist WOW in good faith, and to provide WOW with such information as may be reasonably requested by WOW in order to make a claim under your homeowner&rsquo;s, renter&rsquo;s or other insurance policy, including, but not limited to, executing documents and taking such further acts as WOW may reasonably request to assist WOW in accomplishing the foregoing.</p>\r\n<h4 class="red_heading">\r\n	Member Conduct</h4>\r\n<p>\r\n	We may, in our sole discretion, permit Members to post, upload, publish, submit or transmit Member Content. By making available any Member Content on or through the Site, Application and Services, you hereby grant to WOW a worldwide, irrevocable, perpetual, non-exclusive, transferable, royalty-free license, with the right to sublicense, to use, view, copy, adapt, modify, distribute, license, sell, transfer, publicly display, publicly perform, transmit, stream, broadcast, access, view, and otherwise exploit such Member Content only on, through, or by means of the Site, Application and Services. WOW does not claim any ownership rights in any such Member Content and nothing in these Terms will be deemed to restrict any rights that you may have to use and exploit any such Member Content.</p>\r\n<p>\r\n	You acknowledge and agree that you are solely responsible for all Member Content that you make available through the Site, Application and Services. Accordingly, you represent and warrant that: (i) you either are the sole and exclusive owner of all Member Content that you make available through the Site, Application and Services or you have all rights, licenses, consents and releases that are necessary to grant to WOW the rights in such Member Content, as contemplated under these Terms; and (ii) neither the Member Content nor your posting, uploading, publication, submission or transmittal of the Member Content or WOW&rsquo;s use of the Member Content (or any portion thereof) on, through or by means of the Site, Application and the Services will infringe, misappropriate or violate a third party&rsquo;s patent, copyright, trademark, trade secret, moral rights or other proprietary or intellectual property rights, or rights of publicity or privacy, or result in the violation of any applicable law or regulation.</p>\r\n<h4 class="red_heading">\r\n	Links</h4>\r\n<p>\r\n	The Site, Application and Services may contain links to third-party websites or resources. You acknowledge and agree that WOW is not responsible or liable for: (i) the availability or accuracy of such websites or resources; or (ii) the content, products, or services on or available from such websites or resources. Links to such websites or resources do not imply any endorsement by WOW of such websites or resources or the content, products, or services available from such websites or resources. You acknowledge sole responsibility for and assume all risk arising from your use of any such websites or resources or the Content, products or services on or available from such websites or resources.</p>\r\n<h4 class="red_heading">\r\n	Proprietary Rights Notices</h4>\r\n<p>\r\n	All trademarks, service marks, logos, trade names and any other proprietary designations of WOW used herein are trademarks or registered trademarks of WOW. Any other trademarks, service marks, logos, trade names and any other proprietary designations are the trademarks or registered trademarks of their respective parties.</p>\r\n<h4 class="red_heading">\r\n	Feedback</h4>\r\n<p>\r\n	We welcome and encourage you to provide feedback, comments and suggestions for improvements to the Site, Application and Services (&quot;Feedback&quot;). You may submit Feedback by emailing us at info@WOWrooms.com or through the Contact (www.WOWrooms.com/contact) section of the Site and Application. You acknowledge and agree that all Feedback will be the sole and exclusive property of WOW and you hereby irrevocably assign to WOW and agree to irrevocably assign to WOW all of your right, title, and interest in and to all Feedback, including without limitation all worldwide patent, copyright, trade secret, moral and other proprietary or intellectual property rights therein. At WOW&rsquo;s request and expense, you will execute documents and take such further acts as WOW may reasonably request to assist WOW to acquire, perfect, and maintain its intellectual property rights and other legal protections for the Feedback.</p>\r\n<h4 class="red_heading">\r\n	Copyright Policy</h4>\r\n<p>\r\n	WOW respects copyright law and expects its users to do the same. It is WOW&rsquo;s policy to terminate in appropriate circumstances the WOW Accounts of Members or other account holders who repeatedly infringe or are believed to be repeatedly infringing the rights of copyright holders. Please see WOW&rsquo;s Copyright Policy at www.WOWrooms.com/terms for further information.</p>\r\n<h4 class="red_heading">\r\n	Termination and WOW Account Cancellation</h4>\r\n<p>\r\n	We may, in our discretion and without liability to you, with or without cause, with or without prior notice and at any time: (a) terminate these Terms or your access to our Site, Application and Services, and (b) deactivate or cancel your WOW Account. Upon termination we will promptly pay you any amounts we reasonably determine we owe you in our discretion, which we are legally obligated to pay you. In the event WOW terminates these Terms, or your access to our Site, Application and Services or deactivates or cancels your WOW Account you will remain liable for all amounts due hereunder. You may cancel your WOW Account at any time via the &quot;Cancel Account&quot; feature of the Services or by sending an email to info@WOWrooms.com. Please note that if your WOW Account is cancelled, we do not have an obligation to delete or return to you any Content you have posted to the Site, Application and Services, including, but not limited to, any reviews or Feedback.</p>\r\n<h4 class="red_heading">\r\n	Disclaimers</h4>\r\n<p>\r\n	IF YOU CHOOSE TO USE THE SITE, APPLICATION , SERVICES AND PARTICIPATE IN THE REFERRAL PROGRAM, YOU DO SO AT YOUR SOLE RISK. YOU ACKNOWLEDGE AND AGREE THAT WOW DOES NOT CONDUCT BACKGROUND CHECKS ON ANY MEMBER, INCLUDING, BUT NOT LIMITED TO, GUESTS AND HOSTS. THE SITE, APPLICATION, SERVICES, COLLECTIVE CONTENT AND REFERRAL PROGRAM ARE PROVIDED &quot;AS IS&quot;, WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED. WITHOUT LIMITING THE FOREGOING, WOW EXPLICITLY DISCLAIMS ANY WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT, AND ANY WARRANTIES ARISING OUT OF COURSE OF DEALING OR USAGE OF TRADE. WOW MAKES NO WARRANTY THAT THE SITE, APPLICATION, SERVICES, COLLECTIVE CONTENT, INCLUDING, BUT NOT LIMITED TO, THE LISTINGS OR ANY ACCOMMODATIONS, OR THE REFERRAL PROGRAM WILL MEET YOUR REQUIREMENTS OR BE AVAILABLE ON AN UNINTERRUPTED, SECURE, OR ERROR-FREE BASIS. WOW MAKES NO WARRANTY REGARDING THE QUALITY OF ANY LISTINGS, ACCOMMODATIONS, YOUR ACCRUAL OF WOW TRAVEL CREDITS, THE SERVICES OR COLLECTIVE CONTENT OR THE ACCURACY, TIMELINESS, TRUTHFULNESS, COMPLETENESS OR RELIABILITY OF ANY COLLECTIVE CONTENT OBTAINED THROUGH THE SITE, APPLICATION, SERVICES OR REFERRAL PROGRAM.</p>\r\n<p>\r\n	NO ADVICE OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED FROM WOW OR THROUGH THE SITE, APPLICATION, SERVICES OR COLLECTIVE CONTENT, WILL CREATE ANY WARRANTY NOT EXPRESSLY MADE HEREIN.</p>\r\n<p>\r\n	YOU ARE SOLELY RESPONSIBLE FOR ALL OF YOUR COMMUNICATIONS AND INTERACTIONS WITH OTHER USERS OF THE SITE, APPLICATION OR SERVICES AND WITH OTHER PERSONS WITH WHOM YOU COMMUNICATE OR INTERACT AS A RESULT OF YOUR USE OF THE SITE, APPLICATION OR SERVICES, INCLUDING, BUT NOT LIMITED TO, ANY HOSTS OR GUESTS. YOU UNDERSTAND THAT WOW DOES NOT MAKE ANY ATTEMPT TO VERIFY THE STATEMENTS OF USERS OF THE SITE, APPLICATION OR SERVICES OR TO REVIEW OR VISIT ANY ACCOMMODATIONS. WOW MAKES NO REPRESENTATIONS OR WARRANTIES AS TO THE CONDUCT OF USERS OF THE SITE, APPLICATION OR SERVICES OR THEIR COMPATIBILITY WITH ANY CURRENT OR FUTURE USERS OF THE SITE, APPLICATION OR SERVICES. YOU AGREE TO TAKE REASONABLE PRECAUTIONS IN ALL COMMUNICATIONS AND INTERACTIONS WITH OTHER USERS OF THE SITE, APPLICATION OR SERVICES AND WITH OTHER PERSONS WITH WHOM YOU COMMUNICATE OR INTERACT AS A RESULT OF YOUR USE OF THE SITE, APPLICATION OR SERVICES, INCLUDING, BUT NOT LIMITED TO, GUESTS AND HOSTS, PARTICULARLY IF YOU DECIDE TO MEET OFFLINE OR IN PERSON.</p>\r\n<h4 class="red_heading">\r\n	Limitation of Liability</h4>\r\n<p>\r\n	YOU ACKNOWLEDGE AND AGREE THAT, TO THE MAXIMUM EXTENT PERMITTED BY LAW, THE ENTIRE RISK ARISING OUT OF YOUR ACCESS TO AND USE OF THE SITE, APPLICATION, SERVICES AND COLLECTIVE CONTENT, AND YOUR LISTING OR BOOKING OF ANY ACCOMMODATIONS VIA THE SITE, APPLICATION AND SERVICES, AND YOUR PARTICIPATION IN THE REFERRAL PROGRAM REMAINS WITH YOU. NEITHER WOW NOR ANY OTHER PARTY INVOLVED IN CREATING, PRODUCING, OR DELIVERING THE SITE, APPLICATION, SERVICES, COLLECTIVE CONTENT OR THE REFERRAL PROGRAM WILL BE LIABLE FOR ANY INCIDENTAL, SPECIAL, EXEMPLARY OR CONSEQUENTIAL DAMAGES, INCLUDING LOST PROFITS, LOSS OF DATA OR LOSS OF GOODWILL, SERVICE INTERRUPTION, COMPUTER DAMAGE OR SYSTEM FAILURE OR THE COST OF SUBSTITUTE PRODUCTS OR SERVICES, OR FOR ANY DAMAGES FOR PERSONAL OR BODILY INJURY OR EMOTIONAL DISTRESS ARISING OUT OF OR IN CONNECTION WITH THESE TERMS, FROM THE USE OF OR INABILITY TO USE THE SITE, APPLICATION, SERVICES OR COLLECTIVE CONTENT, FROM ANY COMMUNICATIONS, INTERACTIONS OR MEETINGS WITH OTHER USERS OF THE SITE, APPLICATION, OR SERVICES OR OTHER PERSONS WITH WHOM YOU COMMUNICATE OR INTERACT AS A RESULT OF YOUR USE OF THE SITE, APPLICATION, SERVICES, OR YOUR PARTICIPATION IN THE REFERRAL PROGRAM OR FROM YOUR LISTING OR BOOKING OF ANY ACCOMMODATION VIA THE SITE, APPLICATION AND SERVICES, WHETHER BASED ON WARRANTY, CONTRACT, TORT (INCLUDING NEGLIGENCE), PRODUCT LIABILITY OR ANY OTHER LEGAL THEORY, AND WHETHER OR NOT WOW HAS BEEN INFORMED OF THE POSSIBILITY OF SUCH DAMAGE, EVEN IF A LIMITED REMEDY SET FORTH HEREIN IS FOUND TO HAVE FAILED OF ITS ESSENTIAL PURPOSE.</p>\r\n<p>\r\n	EXCEPT FOR OUR OBLIGATIONS TO PAY AMOUNTS TO APPLICABLE HOSTS PURSUANT TO AN APPROVED PAYMENT REQUEST UNDER THE WOW HOST GUARANTEE, IN NO EVENT WILL WOW&rsquo;S AGGREGATE LIABILITY ARISING OUT OF OR IN CONNECTION WITH THESE TERMS AND YOUR USE OF THE SITE, APPLICATION AND SERVICES INCLUDING, BUT NOT LIMITED TO, FROM YOUR LISTING OR BOOKING OF ANY ACCOMMODATION VIA THE SITE, APPLICATION AND SERVICES, OR FROM THE USE OF OR INABILITY TO USE THE SITE, APPLICATION, SERVICES, OR COLLECTIVE CONTENT OR YOUR PARTICIPATION IN THE REFERRAL PROGRAM AND IN CONNECTION WITH ANY ACCOMMODATION OR INTERACTIONS WITH ANY OTHER MEMBERS, EXCEED THE AMOUNTS YOU HAVE PAID OR OWE FOR BOOKINGS VIA THE SITE, APPLICATION AND SERVICES AS A GUEST IN THE TWELVE (12) MONTH PERIOD PRIOR TO THE EVENT GIVING RISE TO THE LIABILITY, OR IF YOU ARE A HOST, THE AMOUNTS PAID BY WOW TO YOU IN THE TWELVE (12) MONTH PERIOD PRIOR TO THE EVENT GIVING RISE TO THE LIABILITY, OR ONE THOUSAND RUPEES (INR1000), IF NO SUCH PAYMENTS HAVE BEEN MADE, AS APPLICABLE. THE LIMITATIONS OF DAMAGES SET FORTH ABOVE ARE FUNDAMENTAL ELEMENTS OF THE BASIS OF THE BARGAIN BETWEEN WOW AND YOU. SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OR LIMITATION OF LIABILITY FOR CONSEQUENTIAL OR INCIDENTAL DAMAGES, SO THE ABOVE LIMITATION MAY NOT APPLY TO YOU.</p>\r\n<h4 class="red_heading">\r\n	Indemnification</h4>\r\n<p>\r\n	You agree to release, defend, indemnify, and hold WOW and its affiliates and subsidiaries, and their officers, directors, employees and agents, harmless from and against any claims, liabilities, damages, losses, and expenses, including, without limitation, reasonable legal and accounting fees, arising out of or in any way connected with (a) your access to or use of the Site, Application, Services, or Collective Content or your violation of these Terms; (b) your Member Content; (c) your (i) interaction with any Member, (ii) booking of an Accommodation, (iii) creation of a Listing or (iv) the use, condition or rental of an Accommodation by you, including, but not limited to any injuries, losses, or damages (compensatory, direct, incidental, consequential or otherwise) of any kind arising in connection with or as a result of a rental, booking or use of a Accommodation and (d) your participation in the Referral Program or your accrual of any WOW Travel Credits.</p>\r\n<h4 class="red_heading">\r\n	Reporting Misconduct</h4>\r\n<p>\r\n	If you stay with or host anyone who you feel is acting or has acted inappropriately, including but not limited to, anyone who (i) engages in offensive, violent or sexually inappropriate behavior, (ii) you suspect of stealing from you, or (iii) engages in any other disturbing conduct, you should immediately report such person to the appropriate authorities and then to WOW by contacting us with your police station and report number at info@WOWrooms.com; provided that your report will not obligate us to take any action beyond that required by law (if any) or cause us to incur any liability to you.</p>\r\n<h4 class="red_heading">\r\n	Entire Agreement</h4>\r\n<p>\r\n	These Terms constitute the entire and exclusive understanding and agreement between WOW and you regarding the Site, Application, Services, Collective Content, Referral Program, and any bookings or Listings of Accommodations made via the Site, Application and Services, and these Terms supersede and replace any and all prior oral or written understandings or agreements between WOW and you regarding bookings or listings of Accommodations, the Site, Application, Services, Collective Content and Referral Program.</p>\r\n<h4 class="red_heading">\r\n	Assignment</h4>\r\n<p>\r\n	You may not assign or transfer these Terms, by operation of law or otherwise, without WOW&rsquo;s prior written consent. Any attempt by you to assign or transfer these Terms, without such consent, will be null and of no effect. WOW may assign or transfer these Terms, at its sole discretion, without restriction. Subject to the foregoing, these Terms will bind and inure to the benefit of the parties, their successors and permitted assigns.</p>\r\n<h4 class="red_heading">\r\n	Notices</h4>\r\n<p>\r\n	Any notices or other communications permitted or required hereunder, including those regarding modifications to these Terms, will be in writing and given by WOW (i) via email (in each case to the address that you provide) or (ii) by posting to the Site or via the Application. For notices made by e-mail, the date of receipt will be deemed the date on which such notice is transmitted.</p>\r\n<h4 class="red_heading">\r\n	Controlling Law and Jurisdiction</h4>\r\n<p>\r\n	These Terms will be interpreted in accordance with the laws of the Jurisdiction of Kota District Rajasthan where the registered office of WOW is present, without regard to its conflict-of-law provisions. You and we agree to submit to the personal jurisdiction of a court located in New Delhi, India for any actions for which the parties retain the right to seek injunctive or other equitable relief in a court of competent jurisdiction to prevent the actual or threatened infringement, misappropriation or violation of a party&rsquo;s copyrights, trademarks, trade secrets, patents, or other intellectual property rights, as set forth in the Dispute Resolution provision below.</p>\r\n<h4 class="red_heading">\r\n	Dispute Resolution</h4>\r\n<p>\r\n	You and WOW agree that any dispute, claim or controversy arising out of or relating to these Terms or the breach, termination, enforcement, interpretation or validity thereof, or to the use of the Services or use of the Site or Application (collectively, &quot;Disputes&quot;) will be settled by binding arbitration , except that each party retains the right to seek injunctive or other equitable relief in a court of competent jurisdiction to prevent the actual or threatened infringement, misappropriation or violation of a party&rsquo;s copyrights, trademarks, trade secrets, patents, or other intellectual property rights. You acknowledge and agree that you and WOW are each waiving the right to a trial by jury or to participate as a plaintiff or class member in any purported class action or representative proceeding. Further, unless both you and WOW otherwise agree in writing, the arbitrator may not consolidate more than one person&#39;s claims, and may not otherwise preside over any form of any class or representative proceeding. If this specific paragraph is held unenforceable, then the entirety of this &quot;Dispute Resolution&quot; section will be deemed void. Except as provided in the preceding sentence, this &quot;Dispute Resolution&quot; section will survive any termination of these Terms.</p>\r\n<p>\r\n	Arbitration Rules and Governing Law. The arbitration will be administered by the Judicial Courts in accordance with the Indian Laws.</p>\r\n<p>\r\n	Changes. Notwithstanding the provisions of the &quot;Modification&quot; section above, if WOW changes this &quot;Dispute Resolution&quot; section after the date you first accepted these Terms (or accepted any subsequent changes to these Terms), you may reject any such change by sending us written notice (including by email to info@WOWrooms.com within 30 days of the date such change became effective, as indicated in the &quot;Last Updated Date&quot; above or in the date of WOW&rsquo;s email to you notifying you of such change. By rejecting any change, you are agreeing that you will arbitrate any Dispute between you and WOW in accordance with the provisions of this &quot;Dispute Resolution&quot; section as of the date you first accepted these Terms (or accepted any subsequent changes to these Terms).</p>\r\n<h4 class="red_heading">\r\n	General</h4>\r\n<p>\r\n	The failure of WOW to enforce any right or provision of these Terms will not constitute a waiver of future enforcement of that right or provision. The waiver of any such right or provision will be effective only if in writing and signed by a duly authorized representative of WOW. Except as expressly set forth in these Terms, the exercise by either party of any of its remedies under these Terms will be without prejudice to its other remedies under these Terms or otherwise. If for any reason an arbitrator or a court of competent jurisdiction finds any provision of these Terms invalid or unenforceable, that provision will be enforced to the maximum extent permissible and the other provisions of these Terms will remain in full force and effect.</p>\r\n<h4 class="red_heading">\r\n	Contacting WOW</h4>\r\n<p>\r\n	If you have any questions about these Terms or any App Store Sourced Application, please contact WOW at info@WOWrooms.com</p>\r\n', '1438176715', '1438231344', 3, 1);
INSERT INTO `cd_pages` (`id`, `title`, `html_title`, `slug`, `heading`, `meta_title`, `meta_keyword`, `meta_description`, `images`, `content`, `createtime`, `modifytime`, `position`, `status`) VALUES
(4, 'faq', 'FAQ', 'faq', 'FAQ', 'FAQ', 'FAQ', 'FAQ', '', '<p></p>', '1438341644', '', 4, 1),
(5, 'Contact us', 'Contact us', 'contact-us', 'contact us', 'contact us', 'contact us', 'contact us', '', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the i </p>', '1438346975', '1438417290', 5, 1),
(6, 'Careers', 'Careers', 'careers', 'careers', 'Careers', 'Careers', 'Careers', '', '<p></p>', '1438760059', '1438762770', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cd_settings`
--

CREATE TABLE IF NOT EXISTS `cd_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `website_title` varchar(255) NOT NULL,
  `site_logo_image` text NOT NULL,
  `site_favicon_icon` text NOT NULL,
  `download_app_url` text NOT NULL,
  `booking_manager_email` varchar(255) NOT NULL,
  `booking_manger_phone` varchar(255) NOT NULL,
  `hotel_room_manager_email` varchar(255) NOT NULL,
  `from_email` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `linkedin_url` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `address2` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `wow_disscount` varchar(255) NOT NULL,
  `fb_url` text NOT NULL,
  `twitter_url` text NOT NULL,
  `google_plus_url` text NOT NULL,
  `you_tube` text NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cd_settings`
--

INSERT INTO `cd_settings` (`id`, `website_title`, `site_logo_image`, `site_favicon_icon`, `download_app_url`, `booking_manager_email`, `booking_manger_phone`, `hotel_room_manager_email`, `from_email`, `contact_email`, `linkedin_url`, `email`, `address`, `address2`, `city`, `pincode`, `contact_no`, `wow_disscount`, `fb_url`, `twitter_url`, `google_plus_url`, `you_tube`, `created_date`, `modified_date`, `status`) VALUES
(1, '1888zerotax', '9bea8ece82924c52fcd9375cb3e22143.png', '90cbc82e9ff1e5d22c92489e72d81259.png', '', '', '', '', 'noreply@1888zerotax.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '2015-06-15 14:39:56', '2015-10-12 10:21:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cd_states`
--

CREATE TABLE IF NOT EXISTS `cd_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `state_code` varchar(255) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `state_fk1` (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `cd_states`
--

INSERT INTO `cd_states` (`id`, `name`, `state_code`, `country_id`, `status`) VALUES
(1, 'Delhi', 'DL', 113, 1),
(2, 'Andhra Pradesh', 'AP', 113, 1),
(3, 'Arunachal Pradesh', 'AR', 113, 1),
(4, 'Assam', 'AS', 113, 1),
(5, 'Bihar', 'BR', 113, 1),
(6, 'Chhattisgarh', 'CT', 113, 1),
(7, 'Goa', 'GA', 113, 1),
(8, 'Gujarat', 'GJ', 113, 1),
(9, 'Haryana', 'HR', 113, 1),
(10, 'Himachal Pradesh', 'HP', 113, 1),
(11, 'Jammu and Kashmir', 'JK', 113, 1),
(12, 'Jharkhand', 'JH', 113, 1),
(13, 'Karnataka', 'KA', 113, 1),
(14, 'Kerala', 'KL', 113, 1),
(15, 'Madhya Pradesh', 'MP', 113, 1),
(16, 'Maharashtra', 'MH', 113, 1),
(17, 'Manipur', 'MN', 113, 1),
(18, 'Meghalaya', 'ML', 113, 1),
(19, 'Mizoram', 'MZ', 113, 1),
(20, 'Nagaland', 'NL', 113, 1),
(21, 'Orissa', 'OR', 113, 1),
(22, 'Punjab', 'PB', 113, 1),
(23, 'Rajasthan', 'RJ', 113, 1),
(24, 'Sikkim', 'SK', 113, 1),
(25, 'Tamil Nadu', 'TN', 113, 1),
(26, 'Tripura', 'TR', 113, 1),
(27, 'Uttar Pradesh', 'UP', 113, 1),
(28, 'Uttarakhand', 'UK', 113, 1),
(29, 'West Bengal', 'WB', 113, 1),
(30, 'Andaman and Nicobar', 'AN', 113, 1),
(31, 'Chandigarh', 'CH', 113, 1),
(32, 'Dadra and Nagar Have', 'DN', 113, 1),
(33, 'Daman and Diu', 'DD', 113, 1),
(34, 'Lakshadweep', 'LD', 113, 1),
(35, 'National Capital Ter', '', 113, 1),
(36, 'Pondicherry', 'PY', 113, 1),
(37, 'Andaman and Nicobar Islands', 'ANI', 113, 1),
(38, 'Uttaranchal', 'UT', 113, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cd_users`
--

CREATE TABLE IF NOT EXISTS `cd_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `pincode` int(11) NOT NULL,
  `verification_code` text NOT NULL,
  `ip` varchar(255) NOT NULL,
  `one_time_verify_pin` varchar(255) NOT NULL,
  `mobile_verify` int(11) NOT NULL,
  `created` bigint(20) NOT NULL,
  `modified` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cd_user_types`
--

CREATE TABLE IF NOT EXISTS `cd_user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(2) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
