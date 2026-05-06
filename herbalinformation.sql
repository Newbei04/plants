-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql300.infinityfree.com
-- Generation Time: May 06, 2026 at 07:18 PM
-- Server version: 11.4.10-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_41686620_herbalinformation`
--

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
(1, 'Sore throat', 'Oregano / Origanum vulgare,Vitex negundo (Lagundi)'),
(2, 'Mild breathing discomfort', 'Vitex negundo (Lagundi)'),
(3, 'Blood sugar', 'Serpentina/ Andrographis paniculata'),
(4, 'Cough', 'Vitex negundo (Lagundi),Oregano / Origanum vulgare'),
(7, 'Fever', 'Oregano / Origanum vulgare'),
(8, 'Headache', 'Atchuete / Bixa orellana'),
(9, 'Menstrual', 'Serpentina/ Andrographis paniculata'),
(10, 'stomach cramps', 'Serpentina/ Andrographis paniculata'),
(11, 'Arthritis', 'Thai Basil / Ocimum basilicum');

-- --------------------------------------------------------

--
-- Table structure for table `herbal_details`
--

CREATE TABLE `herbal_details` (
  `id` int(11) NOT NULL,
  `scientific_name` varchar(255) NOT NULL,
  `meaning` varchar(255) NOT NULL,
  `can_use_to` text NOT NULL,
  `how_to_use` text NOT NULL,
  `trivia` text NOT NULL,
  `image` text NOT NULL,
  `qr_code` text DEFAULT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `herbal_details`
--

INSERT INTO `herbal_details` (`id`, `scientific_name`, `meaning`, `can_use_to`, `how_to_use`, `trivia`, `image`, `qr_code`, `value`) VALUES
(1, 'Aloe vera', '\"Aloe\" comes from Arabic \"alloeh\" meaning \"bitter substance,\" while \"vera\" means \"true\" in Latin\' together meaning \"true aloe.\"', 'You can use it to treat minor burns, soothe skin irritation, heal small cuts and wounds, and moisturize dry skin.', 'Cut a mature leaf and extract the gel inside. Apply directly to the affected skin area 2ï¿½3 times a day. Can also be mixed into skincare products or drinks (in controlled amounts).', 'Aloe vera has been used for over 6,000 years in ancient Egypt, where it was known as the ï¿½plant of immortality.ï¿½', 'uploads/aloe vera.jpg', 'qrcodes/qr_1.png', 1),
(2, 'Vitex negundo (Lagundi)', 'A medicinal plant symbolizing natural healing and respiratory relief.', '[\n    {\n        \"category\": \"Common Flu (Influenza)\",\n        \"can_use_to\": \"Lagundi is used in influenza to help relieve symptoms such as cough, fever, sore throat, and mild breathing discomfort.\"\n    }\n]', '', 'Lagundi is officially approved in some countries as a herbal medicine for cough and is commonly used in traditional Filipino herbal remedies.', 'uploads/Lagundi.jpg', 'qrcodes/qr_2.png', 1),
(3, 'Oregano / Origanum vulgare', 'Symbol of protection and healing', '[\n    {\n        \"category\": \"Cough\",\n        \"can_use_to\": \"Boil one cup of water, then add one to two teaspoons of dried oregano leaves or a few fresh leaves and let it steep for about five to ten minutes before straining. Add honey if desired, as it can help soothe the throat and improve the taste, and drink this oregano tea once or twice a day to help relieve cough symptoms\"\n    },\n    {\n        \"category\": \"Fever\",\n        \"can_use_to\": \"Boil one cup of water, then add one to two teaspoons of dried oregano leaves or a few fresh leaves and let it steep for about five to ten minutes before straining. Add honey if desired to improve the taste, and drink this oregano tea once or twice a day to help support the body during fever and keep you hydrated.\"\n    }\n]', '', 'Commonly known as basil and used in cooking worldwide', 'uploads/herbal_69f6e5581d35f2.92893697.jpg', 'qrcodes/qr_3.png', 0),
(4, 'Serpentina/ Andrographis paniculata', 'Serpentina is a term derived from the Latin for \"snake-like,\" commonly referring to either the bitter medicinal herb Andrographis paniculata or the long, coiled paper streamers used in celebrations.', '[\n    {\n        \"category\": \"Blood sugar\",\n        \"can_use_to\": \"â€‹Boil 1 cup of water.\\nâ€‹Add 3â€“5 fresh leaves (or 1 teaspoon of dried leaves).\\nâ€‹Steep for 5â€“10 minutes.\"\n    }\n]', 'â€‹Boil 1 cup of water.\r\nâ€‹Add 3â€“5 fresh leaves (or 1 teaspoon of dried leaves).\r\nâ€‹Steep for 5â€“10 minutes.', 'It is widely considered one of the most bitter plants in the world; the taste is so potent that it can linger on the palate for several minutes after consumption.', 'uploads/herbal_69f7f8b4dc83f1.68519334.jpg', 'qrcodes/qr_4.png', 0),
(5, 'Atchuete / Bixa orellana', 'Atchuete refers to the reddish-brown seeds of the Bixa orellana tree, primarily used as a natural food coloring and mild spice in Filipino and Latin American cuisines.', '[\n    {\n        \"category\": \"Headache\",\n        \"can_use_to\": \"1: Wash 5 to 7 fresh atchuete leaves thoroughly. \\n2: Lightly crush the leaves to release their natural oils, or quickly wilt them over a low flame.\\nâ€‹3: (Optional) Apply a thin layer of coconut oil to the leaves.\\nâ€‹4: Place the leaves directly onto the forehead, temples, or chest. Secure them with a light cloth if necessary and leave for 15â€“20 minutes.\"\n    }\n]', '', 'Commonly known as the \"Lipstick Tree,\" atchuete is a natural pigment used globally to color everything from Filipino kare-kare to British Cheddar cheese, prized for its vibrant red-orange hue and mild, earthy flavor.', 'uploads/herbal_69f85bda50d762.53745390.jpg', 'qrcodes/qr_5.png', 0),
(6, 'Sweet Basil / Ocimum basilicum', 'Sweet basil derives its name from the Greek word basilikon, meaning \"royal\" or \"kingly,\" and is culturally celebrated as a symbol of love, protection, and healing.', '[\n    {\n        \"category\": \"Blood sugar\",\n        \"can_use_to\": \"Eat Fresh Leaves Directly: Chew a few washed fresh leaves in the morning, which is a common practice to help manage blood sugar levels.\\nBasil Tea: Boil 7â€“8 washed basil (tulsi) leaves in water for a few minutes. Drink this tea, optionally mixed with other herbs like Bael Patta, on an empty stomach in the morning.\\nIncorporate into Meals: Add fresh, raw basil leaves into salads, soups, smoothies, or as a fresh garnish on meals to increase daily intake.\\nSoaked Basil Seeds (Sabja): Soak 10 grams (about 1-2 teaspoons) of sabja seeds (sweet basil seeds) in water and consume them after meals, which can help lower post-meal sugar spikes.\"\n    }\n]', '', 'In countries like Indonesia and India, basil has been used empirically for generations as a traditional remedy to decrease blood sugar.', 'uploads/herbal_69f883ae4e53e9.51012973.jpg', 'qrcodes/qr_6.png', 0),
(7, 'Thai Basil / Ocimum basilicum', 'Thai basil is a Southeast Asian herb (Ocimum basilicum) known for its small, narrow leaves, purple stems, and distinct anise/licorice flavor. Used heavily in Thai, Vietnamese, and Taiwanese cuisine, it is popular for its ability to withstand high heat in ', '[\n    {\n        \"category\": \"Blood sugar\",\n        \"can_use_to\": \"1. Prepare: Gather fresh Thai basil leaves or dried leaves.\\n2. Boil: Bring water to a boil.Steep:\\n3. Add the leaves to the hot water. Covering the cup helps retain essential oils.Wait: \\n4. Allow it to steep for several minutes.Strain: \\n5. Remove the leaves before drinking\"\n    }\n]', '', 'It contains potent compounds that have been shown to help manage blood sugar levels and reduce inflammation related to arthritis.', 'uploads/herbal_69f889a995dc85.78333549.jpg', 'qrcodes/qr_7.png', 0),
(8, 'Betel Vine / Piper betle L', 'Betel vine leaves (Piper betle), often called paan, are heart-shaped leaves with deep cultural, medicinal, and social significance across South and Southeast Asia.', '[\n    {\n        \"category\": \"stomach cramps\",\n        \"can_use_to\": \"Procedure: Wash 1â€“2 fresh, tender betel leaves thoroughly.\\nChew them slowly after meals, allowing the juices to be swallowed.\\nPurpose: Stimulates saliva and digestive enzymes, reducing gas, bloat, and indigestion.\\nTip: If the taste is too strong, you can add a small piece of fennel seeds or a small amount of gulkand (rose petal jam).\"\n    }\n]', '', 'Chewing betel leaves after meals is a popular traditional practice because it stimulates saliva and aids digestion.', 'uploads/herbal_69f88e6c2b4183.79858295.jpg', 'qrcodes/qr_8.png', 0);

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
  `qrcode` text DEFAULT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `not_herbal_details`
--

INSERT INTO `not_herbal_details` (`id`, `image`, `scientific_name`, `description`, `qrcode`, `value`) VALUES
(1, 'uploads/Bougainvillea.jpg', 'Bougainvillea', 'Bougainvillea is a colorful ornamental plant commonly used for landscaping and decoration. It is not typically used for medicinal purposes and is mainly grown for its vibrant flowers.', 'qrcodes/qr_1.png', 0),
(2, 'uploads/plant_69f6e9258c37a1.66156023.jpg', 'Mangifera indica', 'A tropical fruit tree that produces mangoes, widely cultivated for food and shade.', 'qrcodes/qr_2.png', 0),
(3, 'uploads/plant_69f874aa03da65.40673259.jpeg', 'Mahogany', 'Mahogany is a premium, straight-grained tropical hardwood prized', 'qrcodes/qr_3.png', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `herbal_details`
--
ALTER TABLE `herbal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_website`
--
ALTER TABLE `manage_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `not_herbal_details`
--
ALTER TABLE `not_herbal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
