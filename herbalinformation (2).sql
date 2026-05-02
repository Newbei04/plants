-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 11:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `herbalinformation`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertData` (IN `in_username` VARCHAR(40), IN `in_gender` VARCHAR(8), IN `in_mobile` VARCHAR(20), IN `in_email` VARCHAR(20), IN `in_dob` VARCHAR(10), IN `in_joining_date` VARCHAR(10), IN `in_userid` VARCHAR(20))   BEGIN
INSERT INTO users(username, gender, mobile, email, dob, joining_date, userid) VALUES(in_username,in_gender,in_mobile,in_email,in_dob,in_joining_date,in_userid);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(500) NOT NULL,
  `gender` varchar(500) NOT NULL,
  `dob` text NOT NULL,
  `contact` text NOT NULL,
  `address` varchar(500) NOT NULL,
  `image` varchar(2000) NOT NULL,
  `created_on` date NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `fname`, `lname`, `gender`, `dob`, `contact`, `address`, `image`, `created_on`, `group_id`) VALUES
(1, 'admin', 'admin@gmail.com', 'f27017fb62bcaa9c913909026fc0d64d429322415a48e72ba8a6cd3166046a43', 'admin', 'admin', 'Female', '2001-11-21', '0902900903', 'Nashik', 'young-woman-avatar-facial-features-stylish-userpic-flat-cartoon-design-elegant-lady-blue-jacket-close-up-portrait-80474088.jpg', '2018-04-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `flucategories`
--

CREATE TABLE `flucategories` (
  `id` int(11) NOT NULL,
  `scientific_name` varchar(255) NOT NULL,
  `herbal_plant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flucategories`
--

INSERT INTO `flucategories` (`id`, `scientific_name`, `herbal_plant`) VALUES
(2, 'sample11', 'Sample'),
(3, 'Ubo', 'Sample, sample123, Oregano'),
(4, 'Oregano', 'sample123'),
(5, 'Oregano', 'sample123'),
(6, 'Oregano', 'Oregano'),
(7, 'Oregano', 'Oregano'),
(8, 'sada', 'Oregano'),
(9, 'sada', 'Oregano');

-- --------------------------------------------------------

--
-- Table structure for table `herbal_details`
--

CREATE TABLE `herbal_details` (
  `id` int(11) NOT NULL,
  `scientific_name` varchar(255) NOT NULL,
  `meaning` varchar(255) NOT NULL,
  `can_use_to` varchar(255) NOT NULL,
  `how_to_use` text NOT NULL,
  `trivia` text NOT NULL,
  `image` text NOT NULL,
  `qr_code` text NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `herbal_details`
--

INSERT INTO `herbal_details` (`id`, `scientific_name`, `meaning`, `can_use_to`, `how_to_use`, `trivia`, `image`, `qr_code`, `value`) VALUES
(30, 'sample123', 'kahit ano', 'kahit ano', 'kahit ano', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '../uploads/easter.jpg', '../qrcodes/qr_30.png', 0),
(32, 'Oregano', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', '../uploads/herb-profile-oregano-1761786-5-5c01c4fc1b4d4d748680c261c760497e.jpg', '../qrcodes/qr_32.png', 0),
(33, 'AASA', 'ASDAD', 'DSADA`ASDAD`A`', 'ASDADA`', 'SDASDA', '../uploads/easter-removebg-preview.png', '../qrcodes/qr_33.png', 0),
(34, 'SAMPLE', 'SAMPLE', 'SAMPLE', 'SAMPLE', 'SAMPLE', '../uploads/logo1.png', '../qrcodes/qr_34.png', 0),
(35, 'xcscs', 'njnjnj', 'jhnjnj', 'nhjjhnjh', 'njhjhn', '../uploads/easter.jpg', '../qrcodes/qr_35.png', 0),
(36, 'Oregano', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'scsdc', 'dcsccs', '../uploads/easter.jpg', '../qrcodes/qr_36.png', 0),
(37, 'scsdcscsq`n', 'kjnjknjk', 'nkjn', 'kjnkj', 'njknkj', '../uploads/231231.png', '../qrcodes/qr_37.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `action` varchar(40) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `userid`, `action`, `date`) VALUES
(1, '1529336794', 'User Deleted Succesfully', '2021-07-07 16:10:18'),
(2, '1572760056', 'User Deleted Succesfully', '2021-07-07 16:10:18'),
(3, '1622822786', 'User Deleted Succesfully', '2021-07-07 16:10:18'),
(4, '', 'Data Inserted Succesfully', '2023-12-06 18:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `manage_website`
--

CREATE TABLE `manage_website` (
  `id` int(11) NOT NULL,
  `title` varchar(600) NOT NULL,
  `short_title` varchar(600) NOT NULL,
  `logo` text NOT NULL,
  `footer` text NOT NULL,
  `currency_code` varchar(600) NOT NULL,
  `currency_symbol` varchar(600) NOT NULL,
  `login_logo` text NOT NULL,
  `invoice_logo` text NOT NULL,
  `background_login_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `manage_website`
--

INSERT INTO `manage_website` (`id`, `title`, `short_title`, `logo`, `footer`, `currency_code`, `currency_symbol`, `login_logo`, `invoice_logo`, `background_login_image`) VALUES
(1, 'Our Farm Republic', 'Our Farm Republic', 'logo1.png', 'Our Farm Republic', 'INR', 'â‚¹', 'logo1.png', 'logo1.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `not_herbal_details`
--

CREATE TABLE `not_herbal_details` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `scientific_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `qrcode` text NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `not_herbal_details`
--

INSERT INTO `not_herbal_details` (`id`, `image`, `scientific_name`, `description`, `qrcode`, `value`) VALUES
(3, '../uploads/herb-profile-oregano-1761786-5-5c01c4fc1b4d4d748680c261c760497e.jpg', 'sample', 'sample', '../qrcodes/qr_3.png', 0),
(4, '../uploads/easter.jpg', 'sample', 'sample', '../qrcodes/qr_4.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flucategories`
--
ALTER TABLE `flucategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `herbal_details`
--
ALTER TABLE `herbal_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_website`
--
ALTER TABLE `manage_website`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `not_herbal_details`
--
ALTER TABLE `not_herbal_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `flucategories`
--
ALTER TABLE `flucategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `herbal_details`
--
ALTER TABLE `herbal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `manage_website`
--
ALTER TABLE `manage_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `not_herbal_details`
--
ALTER TABLE `not_herbal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
