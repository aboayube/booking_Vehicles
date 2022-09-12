-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2022 at 12:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `royalrent1`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(111) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `user_id`) VALUES
(33, 'Private Cars', 46),
(34, 'Sport Vehicles', 46),
(35, 'Motorcycles', 46),
(36, 'Luxury Vehicles', 46),
(37, 'Motocross and more', 46),
(38, 'Boats and Jetski', 46),
(40, 'Wedding Cars', 31);

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `user_Id`, `status`) VALUES
(28, 54, '1'),
(29, 56, '1');

-- --------------------------------------------------------

--
-- Table structure for table `comments_vehicles`
--

CREATE TABLE `comments_vehicles` (
  `id` int(11) NOT NULL,
  `vehicles_id` int(11) NOT NULL,
  `message` varchar(111) NOT NULL,
  `ratting` varchar(111) NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments_vehicles`
--

INSERT INTO `comments_vehicles` (`id`, `vehicles_id`, `message`, `ratting`, `status`, `user_id`) VALUES
(61, 2336755, 'A Stable And Fast Vehicle Highly recommended for racing', '5', 1, 56);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(111) NOT NULL,
  `email` varchar(111) NOT NULL,
  `subject` varchar(111) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `subject`, `message`) VALUES
(34, 'Stefani Darwen', 'stefani@gmail.com', 'Question About The Company', 'Dear Managers,\r\nhello I want To Ask Some thing About Some Thing'),
(35, 'henry', 'henry.1999@gmail.com', 'Hello Manager', 'The Website is Amazing!!!'),
(36, 'Sharon Frank', 'sharon@gmail.com', 'Thanks', 'I\'M FROM AFULA AND I LIKED THIS VEHICLES I WANT TO RENT FROM YOUR COMPANY');

-- --------------------------------------------------------

--
-- Table structure for table `lincenesrank`
--

CREATE TABLE `lincenesrank` (
  `id` int(11) NOT NULL,
  `code` varchar(111) NOT NULL,
  `details` varchar(111) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lincenesrank`
--

INSERT INTO `lincenesrank` (`id`, `code`, `details`, `user_id`) VALUES
(26, 'B', 'Cars', 46),
(27, 'A2', 'for motorcycles 125cc', 46),
(28, 'A1', 'For Motorcycles 500cc', 46),
(29, 'A', 'For Motorcycles 1000cc', 46),
(30, 'Sailing 11', 'For Jetskii', 46),
(31, 'Sailing 50 ', 'For Type Of Boats', 46),
(32, 'Sailing 60', 'For  type of Boats', 46),
(33, 'Sailing 40', 'For Type Of Boats', 46),
(34, 'Sailing 12', 'For Type Of Boats', 46);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `title` varchar(111) NOT NULL,
  `message` varchar(111) NOT NULL,
  `from_user` varchar(111) NOT NULL,
  `read_at` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `to_id`, `title`, `message`, `from_user`, `read_at`) VALUES
(99, 54, 'Order Status', 'accept your order', '46', '1'),
(100, 54, 'Order Status', 'accept your order', '46', '1'),
(101, 54, 'Order Status', 'accept your order', '46', '1'),
(102, 56, 'Order Status', 'accept your order', '46', '1'),
(103, 56, 'Thanks', 'Thanks Mohammd For The Rental From Our Company', 'Ibraheem Zidan', '1'),
(104, 54, 'Order Status', 'accept your order', '51', '1'),
(109, 56, 'You have exceeded the permitted kilometer', 'You Should to pay 50', '51', '1'),
(110, 56, 'Order Status', 'accept your order', '51', NULL),
(111, 56, 'Order Status', 'accept your order', '51', NULL),
(112, 54, 'Order Status', 'accept your order', '51', '1'),
(113, 55, 'Order Status', 'accept your order', '51', NULL),
(114, 55, 'Order Status', 'accept your order', '51', NULL),
(115, 54, 'Order Status', 'accept your order', '46', '1'),
(116, 56, 'Order Status', 'accept your order', '46', NULL),
(117, 56, 'Order Status', 'accept your order', '46', NULL),
(118, 56, 'Order Status', 'accept your order', '46', NULL),
(119, 56, 'Order Status', 'accept your order', '46', NULL),
(120, 54, 'Order Status', 'accept your order', '46', '1'),
(121, 54, 'Order Status', 'accept your order', '31', NULL),
(122, 54, 'Order Status', 'accept your order', '31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `user_vehicles_id` int(11) NOT NULL,
  `price` varchar(111) NOT NULL,
  `Paid` varchar(111) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment` varchar(11) NOT NULL,
  `number_pay` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user_vehicles_id`, `price`, `Paid`, `user_id`, `payment`, `number_pay`) VALUES
(77, 133, '6000', '-', 54, 'PayPal', '1'),
(78, 132, '14790', '-', 54, 'PayPal', '1'),
(83, 140, '130', '130', 55, 'visa', '1'),
(84, 139, '740', '185', 55, 'visa', '4'),
(85, 136, '37800', '12600', 54, 'visa', '3'),
(87, 141, '2700', '540', 54, 'visa', '5'),
(89, 143, '700', '-', 56, 'PayPal', '1'),
(90, 144, '872', '-', 56, 'PayPal', '1'),
(91, 146, '3000', '-', 54, 'PayPal', '1');

-- --------------------------------------------------------

--
-- Table structure for table `receipt_vehicles`
--

CREATE TABLE `receipt_vehicles` (
  `id` int(11) NOT NULL,
  `vehicles_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `space` int(11) NOT NULL,
  `note` varchar(111) NOT NULL,
  `worker_name` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receipt_vehicles`
--

INSERT INTO `receipt_vehicles` (`id`, `vehicles_id`, `user_id`, `space`, `note`, `worker_name`) VALUES
(22, 3851180, 54, 300, 'Vehicle is Safe and good', 'Ibraheem Zidan'),
(23, 2336755, 56, 200, 'The Dodge All is Good', 'Ibraheem Zidan'),
(27, 2336755, 56, 2000, 'ok buy th k\"M!!', 'Aseel Agha');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(111) NOT NULL,
  `logo` varchar(111) NOT NULL,
  `email` varchar(111) NOT NULL,
  `phone` varchar(111) NOT NULL,
  `whatsapp` varchar(111) NOT NULL,
  `facebook` varchar(111) NOT NULL,
  `instagram` varchar(111) NOT NULL,
  `address` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `logo`, `email`, `phone`, `whatsapp`, `facebook`, `instagram`, `address`) VALUES
(1, 'RoyalRent', '1659819068-1658404154-ShopForce.png', 'royalrent2022@gmail.com', '0585919542', '0585919542', 'Royal Rent', 'RoyalRent', 'Acre Israel');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(111) NOT NULL,
  `username` varchar(111) NOT NULL,
  `email` varchar(111) NOT NULL,
  `password` varchar(111) NOT NULL,
  `role` varchar(111) NOT NULL,
  `status` varchar(1) NOT NULL,
  `linces` varchar(111) DEFAULT NULL,
  `address` varchar(111) NOT NULL,
  `phone` varchar(111) NOT NULL,
  `card_photo` varchar(111) DEFAULT NULL,
  `image` varchar(111) NOT NULL,
  `dateofbirthday` varchar(111) NOT NULL,
  `LicenseNum` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `role`, `status`, `linces`, `address`, `phone`, `card_photo`, `image`, `dateofbirthday`, `LicenseNum`) VALUES
(31, 'Rolan Zahra', 'rolan', 'rolanzahra2000@gmail.com', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 'admin', '1', NULL, 'EL-JISH', '0548600987', NULL, 'rolan.jpg', '27/5/2000', ''),
(46, 'Ibraheem Zidan', 'admin', 'ibraheemzidan31@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', '1', NULL, 'Acre', '0585919542', NULL, '1654954472-1654675609-ibro.jpg', '20/6/2001', '1528382'),
(51, 'Aseel Agha', 'Aseel12', 'aseelagha@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'worker', '1', NULL, 'Acre', '0549227319', NULL, '1658940768-AseelWorker.jpg', '6/11/2000', ''),
(52, 'Feras Wane', 'feras1', 'feraswane@gmail.com', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 'worker', '1', NULL, 'Shefaamr', '0549258771', NULL, '1658941994-1658613792-feras.jpg', '31/7/2000', '1764523'),
(54, 'rawad bishara', 'rawad', 'rawadbishara@gmail.com', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 'users', '1', '26', 'Nazareth', '0558875580', NULL, '1659202395-rawad.jpg', '15/2/2000', '1234567'),
(55, 'Slieem Gannaima', 'slieemz1', 'slieeemz@gmail.com', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 'users', '1', '26,30,33,34', 'Der Hanna', '0503833311', NULL, '1659818484-slieem.jpg', '19/3/2000', '6578987'),
(56, 'Mhmad Zidan', 'Mhmad_z10', 'mhmad@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'users', '1', '26,27,28,29', 'Acre', '0585919545', NULL, '1659818654-mhmad.jpg', '29/6/2004', '1278456');

-- --------------------------------------------------------

--
-- Table structure for table `vec_order`
--

CREATE TABLE `vec_order` (
  `id` int(11) NOT NULL,
  `vehicles_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` varchar(111) NOT NULL,
  `period` varchar(111) NOT NULL,
  `status` varchar(1) NOT NULL,
  `startday` date NOT NULL,
  `endday` date NOT NULL,
  `image_id` varchar(111) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vec_order`
--

INSERT INTO `vec_order` (`id`, `vehicles_id`, `user_id`, `price`, `period`, `status`, `startday`, `endday`, `image_id`, `category_id`) VALUES
(132, 3851180, 54, '14790', '17', '2', '2022-08-02', '2022-08-19', '1659881125-1659178734-1658948039-rawad-license.jpg', 33),
(133, 12540001, 54, '6000', '10', '2', '2022-08-24', '2022-09-03', '1659881136-1659178734-1658948039-rawad-license.jpg', 34),
(136, 678542, 54, '37800', '14', '2', '2022-08-11', '2022-08-25', '1659891847-1659178332-1658948039-rawad-license.jpg', 36),
(139, 1889, 55, '740', '2', '2', '2022-08-09', '2022-08-11', '1659899347-1658946046-license2.jpg', 38),
(140, 40950, 55, '130', '1', '2', '2022-08-08', '2022-08-09', '1659899496-1658946046-license2.jpg', 38),
(141, 445532, 54, '2700', '6', '2', '2022-08-10', '2022-08-16', '1659915862-1658942344-rawad-license.jpg', 37),
(143, 2310178, 56, '700', '1', '2', '2022-08-16', '2022-08-17', '1659966929-1659180162-1658957493-1658946046-license2.jpg', 34),
(144, 31649601, 56, '872', '8', '2', '2022-08-16', '2022-08-24', '1659967767-1658946046-license2.jpg', 35),
(145, 423423, 56, '2500', '1', '1', '2022-08-17', '2022-08-11', '1659981442-1658943947-1658942668-rawad-license.jpg', 36),
(146, 2336755, 54, '3000', '6', '2', '2022-08-24', '2022-08-30', '1660027462-1658942344-rawad-license.jpg', 34),
(147, 423423, 54, '12500', '5', '0', '2022-08-19', '2022-08-24', '1660043584-1658943947-1658942668-rawad-license.jpg', 36),
(148, 12540001, 54, '6000', '10', '2', '2022-09-04', '2022-09-15', '1659881136-1659178734-1658948039-rawad-license.jpg', 34),
(149, 12540001, 54, '6000', '10', '2', '2022-09-16', '2022-09-19', '1659881136-1659178734-1658948039-rawad-license.jpg', 34),
(152, 2364534, 54, '8078', '14', '1', '2022-08-17', '2022-08-31', '1660372645-contact-us.png', 33),
(154, 2364534, 54, '1731', '3', '1', '2022-08-15', '2022-08-16', '1660373626-contactus.png', 33),
(155, 2364534, 54, '1154', '2', '0', '2022-08-13', '2022-08-15', '1660373715-contactus.png', 33),
(156, 2364534, 54, '8655', '15', '0', '2022-08-31', '2022-09-15', '1660373959-flags.png', 33),
(157, 4456738, 55, '1000', '4', '1', '2022-08-13', '2022-08-17', '1660376673-contact-us.png', 33),
(158, 2640038, 54, '990', '3', '1', '2022-08-13', '2022-08-16', '1660384987-about-first.png', 33);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `LicenseNum` int(11) NOT NULL,
  `v_name` varchar(111) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(111) NOT NULL,
  `VType` varchar(111) NOT NULL,
  `price` int(11) NOT NULL,
  `Year` varchar(111) NOT NULL,
  `passengers` varchar(111) NOT NULL,
  `season_type` varchar(111) NOT NULL,
  `status` varchar(1) NOT NULL,
  `quantity` varchar(111) NOT NULL,
  `InsuranceVali` varchar(111) NOT NULL,
  `transmission` varchar(111) NOT NULL,
  `category_id` int(11) NOT NULL,
  `lincenes_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `testvalidity` varchar(100) NOT NULL,
  `allow_km` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`LicenseNum`, `v_name`, `description`, `image`, `VType`, `price`, `Year`, `passengers`, `season_type`, `status`, `quantity`, `InsuranceVali`, `transmission`, `category_id`, `lincenes_id`, `user_id`, `testvalidity`, `allow_km`) VALUES
(1257, 'BOWRIDER', 'The Activ 675 Bowrider is a great boat to stay in touch with the water. Up to 7 people pick a spot in the bow area or in the cockpit. Not a single inch of deck surface is left unused, yet the designers still found a way to integrate a compact, functional cabin.', '1654956305-boat1.jpg', 'ACTIV 675', 400, '2019', '7', '2', '2', '1', '2023', 'AUTOMATIC', 38, 33, 46, '2023', '500'),
(1889, 'ULTRA® 310LX-S', 'ADDITIONAL VEHICLE FEATURES:\r\nNEW LED accent lights\r\nNEW Rearview camera\r\nNEW ULTRA® deck with two multi-mount rails', '1654956508-jet1.jpg', 'KAWASAKI', 370, '2022', '3', '2', '2', '0', '2023', 'AUTOMATIC', 38, 30, 46, '2025', '500'),
(2756, 'PILOTHOUSE', 'The days you had to choose between comfort and performance, between fishing and cruising are gone. With the 905 Pilothouse you can have both! Designed without compromise for fishing, adventure & fun, and all in perfect safety and comfort. The 905 Pilothouse is suited for offshore cruising (category B) and carries up to 10 people. It features a comprehensive fishing station, as well as overnighting capacity for up to 6 persons. Performance is safe and agile thanks to the Mercury engine offering, and power of up to 500 hp. means you get to the fish in almost no time at all. The 905 Pilothouse; why settle for less when you can have it all.', '1654956594-boat2.jpg', 'ACTIV 905', 2000, '2020', '6', '2', '2', '1', '2023', 'AUTOMATIC ', 38, 31, 46, '2023', '700'),
(2920, 'YACHT', 'The Ermis2 features exterior design by Humphreys Yacht Design, while her interior was penned by Humphreys Yacht Design, with naval architecture by Humphreys Yacht Design. Up to 8 guests are accommodated on board the superyacht Ermis2, and she also has accommodation for 4 crew members including the captain of Ermis2. The yacht Ermis2 has a grp hull and grp superstructure. She is powered by 3 MTU engines, which give her a cruising speed of 45.0 kn and a top speed of 55.0 kn. The yacht has a speed of 45.0 kn. The yacht carries 55,000 liters of fuel on board, and 2,100 liters of water.\r\n', '1654956674-boat3.jpg', 'Ermis2', 3000, '2007', '7', '2', '2', '1', '2023', 'AUTOMATIC', 38, 32, 46, '2023', '2000'),
(5438, 'EX ', 'One look at Yamaha’s Freestyle WaveRunners and it’s easy to see why there’s only one Freestyle series in the industry. The lightweight JetBlaster features wider handlebars for a firm grip on the action, foot chocks to keep you planted when pulling off tricks and a custom tuned electric trim to dial in the ride. The Yamaha SuperJet continues to reign supreme as the industry’s leading stand-up model with a four-stroke engine and lightweight hull.', '1654956764-jet3.jpg', 'YAMAHA', 288, '2022', '2', '2', '2', '1', '2023', 'AUTOMATIC', 38, 30, 46, '2025', '20000'),
(6688, 'ULTRA® 310X', '	Supercharged and intercooled, 4-stroke, DOHC, four valves per cylinder, inline 4-cylinder', '1654966874-jet2.jpg', 'KAWASAKI', 400, '2018', '2', '2', '2', '1', '2023', 'AUTOMATIC', 38, 30, 46, '2023', '2000'),
(19013, '27 HARDTOP', 'This boat is highly recommended to sail and enjoy the vacation you are going on!', '1654966963-boat6.jpg', 'VEITCH', 1000, '2017', '8', '2', '2', '1', '2023', 'AUTOMATIC', 38, 33, 46, '2023', '1500'),
(40950, 'Boat Hire‬', 'Polycraft Tuff tender no boat license needed. Very safe and stable boats. A day hire is from 130₪.  ', '1654967095-boat4.jpg', 'Redland Bay ', 130, '2008', '3', '2', '2', '0', '2023', 'ENGINE', 38, 34, 46, '2023', '300'),
(423423, 'DE VILLE', 'We couldn\'t talk about vintage cars without including the Cadillac de Ville. A true American classic that turns heads, this chic model has a stylish shape that is made unique by it\'s front grille, bumper, and headlights. Its rocking curves makes it feel like you have just stepped out of the \'60s when this car was first manufactured.', '1654967567-cadi.jpg', 'CADILLAC', 2500, '1966', '4', '1', '2', '1', '2023', 'MANUAL', 36, 26, 46, '2023', '3000'),
(445532, '1000 XP', 'XP is the world\'s most capable crossover side-by-side with room for your crew. With a 64” stance, 30” Pro Armor tires, high clearance A-arms and Walker Evans Velocity shocks, it will elevate your off-road experience and take you on adventures that break new ground.', '1654967692-general.jpg', 'GENERAL', 450, '2021', '6', '3', '2', '0', '2023', 'AUTOMATIC', 37, 26, 46, '2023', '700'),
(678542, 'MK VI HIRE', 'The Bentley Mark IV is another traditional wedding car that we have on offer.\r\nThis stunning vehicle has been fully restored and looks the epitome of classic luxury making it a popular choice with our customers.\r\n', '1654967755-bent.jpg', 'BENTLEY', 2700, '1970', '4', '1', '2', '0', '2023', 'MANUAL', 36, 26, 46, '2023', '2000'),
(1254411, 'DOWNTOWN 300i', 'With this drive-train, the Kymco Downtown 300i is capable of reaching a maximum top speed of 144.8 km/h (90.0 mph) .', '1654967340-down.jpg', 'KYMCO', 115, '2013', '2', '1', '1', '1', '2023', 'AUTOMATIC', 35, 28, 46, '2023', '300'),
(2310178, 'MUSTANG GT', 'Ford Mustang review – V8 GT, EcoBoost and Bullitt driven Flawed, fun and fast - Mustang\'s not a great sports car, but it\'s a great muscle car', '1654967863-must.jpg', 'FORD', 700, '2015', '2', '1', '2', '0', '2023', 'AUTOMATIC', 34, 26, 46, '2023', '1000'),
(2336755, 'CHALENGER', 'The Dodge Challenger R/T features a 5.7-liter Hemi V8 engine, a performance exhaust, and an upgraded rear axle. The Hemi is rated at 375 horsepower with a standard six-speed manual transmission, and it\'s 372 horsepower with an optional eight-speed automatic.', '1654967963-dodge.jpg', 'DODGE', 500, '2017', '2', '1', '2', '0', '2023', 'AUTOMATIC', 34, 26, 46, '2023', '1500'),
(2345622, 'MT-07 ', 'The MT-07 features an updated, compact 689cc liquid-cooled, inline twin cylinder, DOHC engine with fuel injection. The unique power character of the engine provides outstanding low- to mid-range torque with a linear throttle response and strong high-rpm pulling power.', '1654968061-mt07.jpg', 'YAMAHA', 200, '2017', '2', '1', '2', '0', '2023', 'MANUAL', 35, 28, 46, '2023', '200'),
(2364534, 'CR-V', 'Honda states \"CR-V\" stands for \"Comfortable Runabout Vehicle,\" while the term \"Compact Recreational Vehicle\" is used in a British car review article that was republished by Honda.', '1654968370-honda.jpg', 'HONDA', 577, '2015', '7', '1', '2', '1', '2023', 'AUTOMATIC', 33, 26, 46, '2023', '800'),
(2640038, 'SUPERB L&K 220', 'With a fuel consumption of 6.1 litres/100km - 46 mpg UK - 39 mpg US (Average), 0 to 100 km/h (62mph) in 7.0 seconds, a maximum top speed of 151 mph (243 km/h), a curb weight of 3318 lbs (1505 kgs), the Superb 3 2.0 TSI 220HP DSG 6 Speeds has a turbocharged Inline 4 cylinder engine, Petrol motor.', '1654969091-superb.jpg', 'SKODA', 330, '2017', '5', '1', '2', '1', '2023', 'AUTOMATIC', 33, 26, 46, '2023', '1000'),
(2735539, 'CRUZE TURBO', 'It has a new engine from the ECOTEC family with 1.4 L Turbo that develops 153 hp and 240 Nm of torque. provides a perfect balance between performance, efficiency and refinement.', '1654969180-cruze.jpg', 'CHEVROLET', 238, '2017', '5', '1', '2', '1', '2023', 'AUTOMATIC', 33, 26, 46, '2023', '800'),
(3828328, '1000 XP', 'When you want to feel the edge of crazy off-road riding - RZR 1000 XP - 4 Seat.\r\n', '1655147009-rzr1.jpg', 'RZR', 950, '2023', '4', '3', '2', '1', '2023', 'AUTOMATIC', 37, 26, 31, '2023', '300'),
(3851180, 'OCTAVIA 1400T', 'This vehicle has a 5 door hatchback body style with a front mounted engine driving through the front wheels. Its 1.4 litre engine is a turbocharged, double overhead camshaft, 4 cylinder unit that produces 148 bhp (150 PS/110 kW) of power at 5000-6000 rpm, and maximum torque of 250 N·m (184 lb·ft/25.5 kgm) at 1500-3500 rpm.', '1655147168-octavia.jpg', 'SKODA', 870, '2017', '5', '1', '2', '1', '2023', 'AUTOMATIC', 33, 26, 31, '2023', '1500'),
(4364571, 'CRF EXC 500 ENDURO', 'The 2022 KTM dual-sport lineup is here, and the big news is updated WP Xplor suspension. There are two high-performance KTM dual-sport models for 2022—the SOHC 511cc 500 EXC-F and the DOHC 350cc 350 EXC-F.', '1655147302-crf.jpg', 'HONDA', 240, '2016', '5', '1', '2', '1', '2023', 'MANUAL', 35, 28, 31, '2023', '2000'),
(4456738, 'SPORTAGE LX', 'The LX is the entry-level model for 2021 and provides all of the above in spades. It\'s powered by a naturally-aspirated 2.4-liter four-cylinder engine mated to a six-speed automatic transmission. The exterior features automatic headlights and 17-inch alloy wheels.', '1655147442-kia.jpg', 'KIA', 250, '2016', '7', '1', '2', '1', '2023', 'AUTOMATIC', 33, 26, 31, '2023', '1500'),
(5456712, '690 ENDURO R', 'We recently had the opportunity to test a 2014 KTM 690 Enduro R. This was an impression ride since we had limited time with the machine. After riding the “updated” 690 R, we determined that KTM’s phone will be blowing up until they decide to give us one for a more thorough, long-term test.', '1655147544-ktm.jpg', 'KTM', 320, '2014', '1', '3', '2', '1', '2023', 'MANUAL', 35, 29, 31, '2023', '1200'),
(6545612, 'avenis 125', 'Suzuki Avenis 125 is a scooter available at a starting price of Rs. 89,645 in India. It is available in 2 variants and 5 colours with top variant price starting from Rs. 89,945. The Suzuki Avenis 125 is powered by 124cc BS6 engine which develops a power of 8.58 bhp and a torque of 10 Nm.', '1655148170-suzuki.jpg', 'SUZUKI', 75, '2015', '2', '1', '2', '0', '2023', 'AUTOMATIC', 35, 27, 31, '2023', '1000'),
(6764331, 'RR 1000', ' Unbridled power pushes your RR to the max - with a maximum torque of 83 lb-ft at 11,000 rpm and a torque curve of at least 74 lb-ft over a range of 5,500 to 14,500 [rpm]. Ten years after the first generation of the RR first mesmerized the world of motorcycles, we\'re now entering the next level of performance.', '1655148281-rr.jpg', 'BMW', 320, '2015', '2', '1', '2', '1', '2023', 'MANUAL', 35, 29, 31, '2023', '1400'),
(7684432, 'TMAX 530 LUXMAX', 'Abbreviating the specifications,it has an engine displacement of 530.00 cc(32.34 ci) and a total power of 45.86 hp(33.5 kw) at 6750 rpm with an twin-cylinder,4-stroke engine with electric starter.  When this model became widespread,it was available in the colors:nimbus grey.', '1655148506-t530.jpg', 'YAMAHA', 176, '2017', '2', '1', '2', '1', '2023', 'AUTOMATIC', 35, 28, 31, '2023', '1300'),
(8079680, 'RAPIDE 6.0 V12', 'Aston Martin Rapide S 6.0 V12 (560 Hp) Automatic has a combined fuel consumption of 12.9 l/100 km | 18.2 mpg US | 21.9 mpg UK urban fuel consumption of 19.5 l/100 km | 12.1 mpg US | 14.5 mpg UK extra urban fuel consumption of 9.1 l/100 km | 25.8 mpg US | 31.0 mpg UK Aston Martin Rapide S 6.0 V12 (560 Hp) Automatic accelerates from 0 to 100 km/h in 4.4 sec. The maximum speed is 327 km/h | 203 mph.', '1655148687-aston.jpg', 'ASTON MARTIN', 978, '2017', '2', '1', '2', '1', '2023', 'AUTOMATIC', 36, 26, 31, '2023', '1200'),
(9856480, 'CAMARO RS', 'The Chevrolet Camaro RS Auto has a naturally aspirated six cylinders in V longitudinal front engine providing a maximum torque of 385 Nm available from 5300 rpm and a maximum power outpup of 340 PS available at 6800 rpm transmitted to the 20 inch rear wheels by an automatic 8 speed gearbox.', '1655148794-camaro.jpg', 'CHEVROLET', 590, '2017', '4', '1', '2', '1', '2023', 'AUTOMATIC', 34, 26, 31, '2023', '1100'),
(12166201, 'XT6 DIESEL', 'The model line of the 2021 Cadillac XT6 expands to include a new entry-level model: Luxury. The addition of the Luxury trim enables the XT6 to follow Cadillac’s Y trim level strategy, wherein Luxury serves as as the base model, ', '1655148911-cadilac.jpg', 'CADILAC', 589, '2019', '7', '1', '2', '1', '2023', 'AUTOMATIC', 36, 26, 31, '2023', '1400'),
(12504402, 'TMAX 560', 'SPARE PARTS AND ACCESSORIES FOR YAMAHA T-MAX 560 TECH MAX XP 560 (EURO 5) SJ18', '1655149523-tmax.jpg', 'Yamaha', 325, '2021', '2', '1', '2', '1', '2023', 'AUTOMATIC', 35, 28, 31, '2023', '1000'),
(12504501, 'RUBICON 392', 'A V8 engine is finally being put under the hood of a Jeep Wrangler again. It\'s been so long since an open-top Jeep had an optional V8 that back then the Wrangler was still a CJ, or civilian Jeep, and the engine came from American Motors Corporation. Suffice it to say, the 2021 Jeep Wrangler Rubicon 392\'s 6.4-liter Hemi engine shares nothing at all in common with AMC\'s old 304 cubic-inch block.', '1655149618-jeep.jpg', 'JEEP', 800, '2018', '5', '3', '2', '1', '2023', 'AUTOMATIC', 37, 26, 31, '2023', '1300'),
(12540001, 'STINGER GT', 'The Stinger uses a shortened version of the Hyundai Genesis\' front-engine, rear-wheel-drive platform with additional steel reinforcement and is offered with a choice of two engines: a 2.0-liter turbocharged four-cylinder that produces 188 kW (255 PS; 252 hp); and a 3,342 cc (3.3 L; 203.9 cu in) twin-turbo V6 engine ...', '1655149698-stinger.jpg', 'KIA', 600, '2019', '5', '1', '2', '1', '2023', 'AUTOMATIC', 34, 26, 31, '2023', '1500'),
(12576801, 'MT-09 SP', 'The MT-09 SP features a newly developed 890cc liquid-cooled three-cylinder, DOHC, four-valve-per-cylinder fuel-injected (YCC-T) engine with a downdraft intake.', '1655149797-mt.jpg', 'YAMAHA', 234, '2019', '2', '1', '2', '1', '2023', 'MANUAL', 35, 29, 31, '2023', '1300'),
(12854802, '1000 XP Limited Edition', 'The ultimate razer is at your fingertips, with a powerful 110 hp engine, 29-inch tires, a tremendous suspension travel, breathtaking design and a luxurious driver environment with many improvements.', '1655149928-rzr.jpg', 'RZR', 689, '2020', '2', '3', '2', '1', '2023', 'AUTOMATIC', 37, 26, 31, '2023', '1400'),
(13594782, 'C63s AMG', 'The 2021 Mercedes-AMG C63 and C63 S have a hand-built, twin-turbo 4.0-liter V-8 engine. In the C63, it makes 469 horsepower and 479 lb-ft of torque. The C63 S ups the performance ante with 503 horsepower and 516 lb-ft. Both engines use a nine-speed automatic with rear-wheel drive.', '1654968228-c63s.jpg', 'MERCEDES', 1500, '2021', '4', '1', '3', '1', '2023', 'AUTOMATIC', 34, 26, 46, '2023', '1000'),
(16782802, 'TE 150i ', 'Now, more than ever, without the need for directions or fuel mixing combined with an electric starter, the new TE 150i is simply the easiest way to control the terrain.', '1655150095-husq.jpg', 'HUSQVARNA', 290, '2022', '1', '1', '2', '1', '2023', 'MANUAL', 37, 27, 31, '2023', '1100'),
(20211501, 'M4', 'bmw description', '1655150243-m4.jpg', 'BMW', 500, '2018', '5', '1', '2', '1', '2023', 'AUTOMATIC', 34, 26, 31, '2023', '1000'),
(20277302, 'RS3 SEDAN', 'The new Audi RS 3 2 offers driving dynamics on the highest level and optimum values in its segment. With a 400-hp five-cylinder engine that generates 500 Nm of torque, the car ensures quick acceleration and highly emotional sound.', '1655150448-rs3.jpg', 'AUDI', 688, '2020', '5', '1', '2', '1', '2023', 'AUTOMATIC', 34, 26, 31, '2023', '1300'),
(20503803, 'XP PRO', 'The Pro XP Ultimate Rockford Fosgate Limited Edition features a factory-installed Stage 4 high-output audio bringing 800-watts, stainless-steel rear & tweeter speaker grills, LED back-lit speakers, and exclusive Rockford Fosgate® exterior graphics.', '1658941476-xppro.jpg', 'RZR', 640, '2022', '2', '3', '3', '1', '2023', 'AUTOMATIC', 37, 26, 46, '2025', '300'),
(21354201, 'Rang Rover', 'The Land Rover Range Rover (generally known simply as the Range Rover) is a 4x4 motor car produced by Land Rover, a marque and sub-brand of Jaguar Land Rover. The Range Rover line was launched in 1970 by British Leyland and is now in its fifth generation.', '1655150664-range.jpg', 'LAND ROVER', 800, '2018', '7', '1', '2', '1', '2023', 'AUTOMATIC', 36, 26, 31, '2023', '1200'),
(21854602, 'S500 ', 'The S-Class stands for the fascination of Mercedes-Benz: legendary and traditional engineering expertise defines the luxury segment in the automobile industry.', '1655150887-mercedess.jpg', 'MERCEDES', 986, '2022', '5', '1', '2', '1', '2023', 'AUTOMATIC', 36, 26, 31, '2023', '1500'),
(22200303, 'C8', 'he Chevrolet Corvette (C8) is the eighth generation of the Corvette sports car manufactured by American automobile manufacturer Chevrolet. It is the first mid-engine Corvette since the model\'s introduction in 1953, differing from the traditional front-engine design.', '1658941277-C8.webp', 'CORVETTE', 700, '2022', '2', '1', '3', '1', '2023', 'AUTOMATIC', 34, 26, 51, '2026', '500'),
(22801702, 'SVR', 'Range Rover Sport SVR goes from 0-60mph in 4.3 seconds (0-100kph in 4.5 seconds). It has a top speed of 176mph* (283 kph). Its 5.0 litre Supercharged V8 Petrol engine delivers up to 575PS and 700Nm.', '1655150958-svr.jpg', 'RANGE ROVER', 1050, '2020', '5', '1', '2', '1', '2023', 'AUTOMATIC', 36, 26, 31, '2023', '1200'),
(23156702, '1000 DPS OUTLANDER', 'OUTLANDER 1000 for an excellent and unique chassis tool of the new generation SST G2 with a geometric structure for rigidity, lightness and precision in riding.', '1655151066-dbs.jpg', 'CAN-AM', 320, '2022', '2', '1', '2', '1', '2023', 'MANUAL', 37, 29, 31, '2023', '1000'),
(23288101, 'ATECA ', 'The SEAT Ateca is a compact crossover SUV (C-segment) manufactured by Spanish automaker SEAT.', '1655151161-seat.jpg', 'SEAT', 557, '2018', '7', '1', '1', '1', '2023', 'AUTOMATIC', 33, 26, 31, '2023', '1500'),
(23304102, '500', 'The Fiat 500  is a rear-engined, four-seat, small city car that was manufactured and marketed by Fiat Automobiles from 1957 to 1975 over a single generation in two-door saloon and two-door station wagon bodystyles.', '1655151241-500.jpg', 'FIAT', 125, '2019', '4', '1', '2', '1', '2023', 'AUTOMATIC', 33, 26, 31, '2023', '1300'),
(28166701, ' CIVIC TYPE-R ', 'The Type R is built with a 6-speed manual transmission with Rev-match control. The chassis is made from lightweight aluminum to give the car greater agility and a more rigid body. The Civic Type R has three driving modes: Comfort, Sport, and +R.', '1655151383-typer.jpg', 'HONDA', 778, '2018', '4', '1', '2', '1', '2023', 'MANUAL', 33, 26, 31, '2023', '1300'),
(30311202, 'MEGANE ', 'The Renault Mégane is a small family car produced by the French car manufacturer Renault for model year 1996, and was the successor to the Renault 19.', '1655151499-renault.jpg', 'RENAULT', 324, '2021', '5', '1', '2', '1', '2023', 'AUTOMATIC', 33, 26, 31, '2023', '1400'),
(31649601, 'X-TOWN 125 cc', 'The all-new X-Town CT 125 is equipped with a 124.8cc 4V liquid-cooled engine with a fuel injection system which fully complies with Euro 4 regulation. After proper tuning, the maximum horsepower output is 10.5kW/9,000rpm, and the peak torque is 11.2Nm/7,000rpm.', '1655151590-xtown.jpg', 'KYMCO', 109, '2017', '2', '1', '2', '0', '2023', 'MANUAL', 35, 27, 31, '2023', '1200'),
(33256402, 'H2 1000cc', 'Kawasaki Ninja H2 is powered by 998 cc engine.This Ninja H2 engine generates a power of 310 PS @ 14000 rpm and a torque of 165 Nm @ 12500 rpm. Kawasaki Ninja H2 gets Disc brakes in the front and rear. The kerb weight of Ninja H2 is 216 Kg. Kawasaki Ninja H2 has Tubeless', '1655151694-H2.jpg', 'KAWASAKI', 558, '2020', '1', '1', '2', '1', '2023', 'MANUAL', 35, 29, 31, '2023', '1200'),
(33309302, '100 cc', 'Get a taste of genuine Italian style with the new LEGO® Vespa 125 model inspired by the iconic Vespa Piaggio. This elegant 1,106 piece set is designed to help style lovers find a moment of mindfulness through LEGO building as they step back in time to create this elegant display piece.', '1655151826-vespa.png', 'VESPA', 110, '2020', '1', '1', '2', '0', '2023', 'AUTOMATIC', 35, 27, 31, '2023', '1400'),
(33376202, 'URUS', 'Lamborghini Urus is the first Super Sport Utility Vehicle in the world to merge the soul of a super sports car with the functionality of an SUV. Powered by a 4.0-liter twin-turbo V8 engine producing 650 CV and 850 Nm of torque, Urus accelerates from 0 to 62 mph in 3.6 seconds and reaches a top speed of 190 mph.', '1655234564-lambo.jpg', 'LAMBORGENI', 1300, '2022', '4', '1', '2', '1', '2023', 'AUTOMATIC', 36, 26, 31, '2023', '1200'),
(34587602, 'Z900', 'Kawasaki Z900 is powered by 948 cc engine.This Z900 engine generates a power of 125 PS  9500 rpm and a torque of 98.6 Nm @ 7700 rpm. Kawasaki Z900 gets Disc brakes in the front and rear. The kerb weight of Z900 is 212 Kg. Kawasaki Z900 has Tubeless Tyre and Alloy Wheels.', '1655234677-z900.jpg', 'KAWASAKI', 360, '2022', '2', '1', '2', '1', '2023', 'MANUAL', 35, 28, 31, '2023', '1000'),
(34855901, 'CAYENNE', 'The Porsche Cayenne is a series of mid-size luxury crossover sport utility vehicles manufactured by the German automaker Porsche since 2002, with North American sales beginning in 2003. It is the first V8-engined vehicle built by Porsche since 1995, when the Porsche 928 was discontinued.', '1655234759-cayyene.jpg', 'PORCHE', 1000, '2018', '5', '1', '2', '1', '2023', 'AUTOMATIC', 36, 26, 31, '2023', '1000'),
(39988201, 'M2', 'When it comes to max performance, the word \"compromise\" is a curse, but never fear, the 2021 BMW M2 Competition doesn\'t have to put a quarter in the swear jar. Compared with the regular BMW 2-series, this souped-up coupe badass boasts a meaner mug and wider hips, a chassis tuned for attacking racetracks, and a more powerful engine.', '1655234860-m2.jpg', 'BMW', 777, '2018', '2', '1', '2', '1', '2023', 'AUTOMATIC', 34, 26, 31, '2023', '1100'),
(42144302, 'JIMNY 4X4', 'This is the new Suzuki Jimny. Huge off-road competence in the loveliest packaging man has ever witnessed. Its ancestors are legends of the off-road park/forest/communal snow plowing service. Its direct predecessor has been on the market since 1998, and has enjoyed great popularity for 20 years, and this is not solely due to a massive lack of competition.', '1655234950-jimny.jpg', 'SUZUKI', 400, '2020', '4', '1', '2', '1', '2023', 'AUTOMATIC', 37, 26, 31, '2023', '1500'),
(43678901, 'GTR NISMO', 'It\'s powered by a 3.8-liter twin-turbocharged V6 engine with peak outputs of 600 hp and 481 lb-ft of torque. Paired with all-wheel drive and a six-speed dual-clutch automatic transmission, the GT-R Nismo can reach 60 mph in a mere 2.5 seconds.', '1655235040-GTR.jpg', 'NISSAN', 900, '2019', '2', '1', '2', '1', '2023', 'AUTOMATIC', 34, 26, 31, '2023', '1400'),
(45500201, 'G-CLASS AMG', 'All G63s come with a twin-turbocharged 4.0-liter V-8 engine that makes 577 horsepower and 627 lb-ft of torque. A nine-speed automatic gearbox with steering-wheel-mounted paddle shifters sends all that power to the all-wheel-drive system (4Matic, in Mercedes marketing lingo).', '1655235143-g63.jpg', 'MERCEDES', 1100, '2019', '5', '1', '2', '1', '2023', 'AUTOMATIC', 36, 26, 31, '2023', '1100'),
(45562702, 'F8 TRIBUTO', 'The Ferrari F8 Tributo is the new mid-rear-engined sports car that represents the highest expression of the Prancing Horse\'s classic two-seater berlinetta. It is a car with unique characteristics and, as its name implies, is an homage to the most powerful V8 in Ferrari history.', '1655235213-f8.jpg', 'FERRARI', 1100, '2019', '2', '1', '2', '1', '2023', 'AUTOMATIC', 36, 26, 31, '2023', '1300'),
(54436101, 'SWIFT ', 'The Swift now comes with two engine options. The regular Swift uses only a 1.2-litre 12V mild hybrid, with a demure 82bhp and 79lb ft driving either the front or all four wheels. Yep, a 4x4 version is an option, though it stretches out the 0-62mph time from 13.1 to 13.8secs. But admirably still weighs less than a tonne.', '1655235453-swift.jpg', 'SUZUKI', 200, '2018', '5', '1', '2', '1', '2023', 'AUTOMATIC', 33, 26, 31, '2023', '1400'),
(54476902, 'HR', 'The Swift now comes with two engine options. The regular Swift uses only a 1.2-litre 12V mild hybrid, with a demure 82bhp and 79lb ft driving either the front or all four wheels. Yep, a 4x4 version is an option, though it stretches out the 0-62mph time from 13.1 to 13.8secs. But admirably still weighs less than a tonne.', '1655235544-rolse.jpg', 'ROLLS ROYCE', 1800, '2021', '5', '1', '2', '1', '2023', 'AUTOMATIC', 36, 26, 31, '2023', '1000'),
(54732601, 'JUKE', 'The Nissan Juke is a subcompact crossover SUV (B-segment) produced by the Japanese car manufacturer Nissan since 2019.', '1655235751-juke.jpg', 'NISSAN', 232, '2019', '5', '1', '2', '1', '2023', 'AUTOMATIC', 33, 26, 31, '2023', '1300'),
(55540902, 'MODEL X', 'With 2200x1300 resolution, ultra bright, true colors and exceptional responsiveness, the new center display is the best screen to watch anywhere.The ultimate focus on driving: no stalks, no shifting. Model X is the best SUV to drive, and the best SUV to be driven in.', '1655235808-tesla.jpg', 'TESLA', 300, '2022', '5', '1', '2', '1', '2023', 'AUTOMATIC', 36, 26, 31, '2023', '1400'),
(55674202, 'SUPERB L&K 280', 'The Skoda Superb Estate is a truly fabulous thing. For a start, it\'s absolutely massive, so it has the practicality base covered. Yet it\'s far from a one-trick pony, proving pretty comfy, nicely made, well equipped and great value for money. If you can forego a premium German or Swedish badge, it\'s a spankingly good estate car.', '1655235875-superb1.jpg', 'SKODA', 665, '2021', '5', '1', '1', '1', '2023', 'AUTOMATIC', 33, 26, 31, '2023', '1400'),
(57089202, 'X3 DS TURBO R 200', '\r\nEngine – 976 cc TURBOCHARGED, V-twin, liquid cooled, SOHC, 8-valve , with integrated intercooler and high-performance Donaldson air filter. GROUND CLEARANCE – 13 in (33 cm) WHEELBASE – 88 in (223.5 cm) LENGTH – 117.3 in (297.9  CM)', '1655236002-canam1.jpg', 'CAN-AM', 480, '2020', '2', '1', '2', '1', '2023', 'AUTOMATIC', 37, 26, 31, '2023', '1000'),
(60011303, 'New Tmax 560', 'The new TMAX is a good, big and expensive motorcycle with excellent on-pavement performance, stable handling and outstanding braking. You get into it, feel comfortable and controllable, pushing harder and faster on winding roads to use the engine’s torque for acceleration.', '1658941736-tmax2023.jpg', 'YAMAHA', 202, '2022', '2', '1', '3', '1', '2023', 'AUTOMATIC', 35, 28, 46, '2026', '250'),
(63272202, '330i ', 'The 330i features a turbocharged 2.0-liter four-cylinder that makes 255 horsepower and 295 pound-feet of torque. The M340i pairs with a turbocharged 3.0-liter inline-six that produces 385 ponies and 369 pound-feet.', '1655236067-bmw330.jpg', 'BMW', 650, '2020', '5', '1', '2', '1', '2023', 'AUTOMATIC', 33, 26, 31, '2023', '1300'),
(67611802, 'X6 M', 'The BMW M models are precisely engineered and built for performance driving. Details such as the seats, exhaust, suspension, steering, wheels, and aerodynamics are designed with performance at the forefront. This is apparent through the pure power of the 4.4-liter V-8 BMW M TwinPower Turbo engine that delivers 617 hp, made possible by the optional Competition Package.', '1655236156-x6.jpg', 'BMW ', 1750, '2021', '5', '1', '2', '1', '2023', 'AUTOMATIC', 36, 26, 31, '2023', '1500'),
(67733502, 'OCTAVIA VRS', 'The new Octavia isn’t just going to come as a hybrid, though – you’ll also be able to get a purely-petrol-powered version with a 245hp 2.0-litre engine. This model will come with a six-speed manual gearbox as standard, or you can upgrade to a seven-speed DSG automatic, and it also features an electronic limited-slip differential for maximum traction out of corners.', '1655236216-vrs.jpg', 'SKODA', 980, '2021', '5', '1', '2', '1', '2023', 'AUTOMATIC', 34, 26, 31, '2023', '1300'),
(67744802, 'TT-RS CABARIOLET', 'The Audi TT RS Roadster is the fastest version of the TT convertible with monumental performance courtesy of a 400hp five-cylinder engine powering all four wheels. It rivals other fast roadsters such as the Porsche 718 Boxster, Ford Mustang GT Convertible, and the Mercedes-AMG SLC43.', '1655236271-tt.jpg', 'AUDI', 442, '2022', '2', '1', '2', '1', '2023', 'AUTOMATIC', 34, 26, 31, '2023', '1200'),
(76589002, ' X3 XRS TURBO MAVERICK', 'Super sporty four-seater 200 hp.\r\n', '1655236344-canam.jpg', 'CAN-AM', 470, '2022', '4', '1', '2', '1', '2023', 'AUTOMATIC', 37, 26, 31, '2023', '1200'),
(79453201, 'MOVIE 125s', 'Here we have tried to collect the pictures and information about all the model years of Kymco Movie S. You can choose any of these to view more detailed specifications and photos about it! We have accurately collected this data for you.', '1655236425-movie.jpg', 'KYMCO', 75, '2018', '2', '1', '1', '1', '2023', 'AUTOMATIC', 35, 27, 31, '2023', '1200'),
(90122362, 'A7', 'Audi RS7 cheap wedding car hire\r\n', '1655236657-a7.jpg', 'AUDI', 2500, '2021', '5', '1', '2', '1', '2023', 'AUTOMATIC', 40, 26, 31, '2023', '1000'),
(90192362, 'HIRE', 'Making a special occassion or event even better by having a luxury limo to and from the venues will alway be something to remember.\r\n', '1655236736-lemo.jpg', 'LIMOUSINE', 2000, '2021', '4', '1', '2', '1', '2023', 'AUTOMATIC', 40, 26, 31, '2023', '1400'),
(90192406, 'ROVER', 'The Range Rover Sport with more sporty elements and looks, is designed to impress. Its powerful engines will make your ride comfortable and stunning, while there are no discounts inside.', '1655236803-rang.jpg', 'RANGE', 2200, '2021', '5', '1', '2', '1', '2023', 'AUTOMATIC', 40, 26, 31, '2023', '1100'),
(92736623, 'ROYCE', 'Contemporary and dynamic, our luxury Rolls Royce Ghost is finished in pearlescent white with handstitched white sea shell leather interior. A top of the range Rolls Royce, the hand built masterpiece is the perfect wedding car.', '1655236871-royce.jpg', 'ROLLS', 2300, '2021', '4', '1', '2', '1', '2023', 'AUTOMATIC', 40, 26, 31, '2023', '1000'),
(99854201, 'GLE250D AMG', 'Mercedes-Benz GLE 250d is a low priced variant in this updated model series, which also comes with the company\'s new nomenclature – “the GLE”. On the exterior front, a few changes have been made to it. There is a new radiator grille with twin slats that dominates its front facade. It is further made to look attractive owing to the trendy LED headlamps and eye brow', '1655236936-gle.jpg', 'MERCEDES', 677, '2019', '7', '1', '2', '1', '2023', 'AUTOMATIC', 40, 26, 31, '2023', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `days` varchar(111) NOT NULL,
  `date` varchar(111) NOT NULL,
  `status` varchar(1) NOT NULL,
  `id_number` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `user_Id`, `days`, `date`, `status`, `id_number`) VALUES
(21, 51, 'Sunday And Wednesday', '31/7 and 4/8', '1', '1'),
(22, 52, 'Monday and Tuesday', '1/8-2/8', '1', '22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_Id` (`user_Id`);

--
-- Indexes for table `comments_vehicles`
--
ALTER TABLE `comments_vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_id` (`vehicles_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lincenesrank`
--
ALTER TABLE `lincenesrank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_id` (`to_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_vehicles_id` (`user_vehicles_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `receipt_vehicles`
--
ALTER TABLE `receipt_vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vehicles_id` (`vehicles_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vec_order`
--
ALTER TABLE `vec_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_id` (`vehicles_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`LicenseNum`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `lincenes_id` (`lincenes_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_Id` (`user_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `comments_vehicles`
--
ALTER TABLE `comments_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `lincenesrank`
--
ALTER TABLE `lincenesrank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `receipt_vehicles`
--
ALTER TABLE `receipt_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `vec_order`
--
ALTER TABLE `vec_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `clubs_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments_vehicles`
--
ALTER TABLE `comments_vehicles`
  ADD CONSTRAINT `comments_vehicles_ibfk_2` FOREIGN KEY (`vehicles_id`) REFERENCES `vehicles` (`LicenseNum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_vehicles_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_vehicles_id`) REFERENCES `vec_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receipt_vehicles`
--
ALTER TABLE `receipt_vehicles`
  ADD CONSTRAINT `receipt_vehicles_ibfk_1` FOREIGN KEY (`vehicles_id`) REFERENCES `vehicles` (`LicenseNum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receipt_vehicles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vec_order`
--
ALTER TABLE `vec_order`
  ADD CONSTRAINT `vec_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vec_order_ibfk_2` FOREIGN KEY (`vehicles_id`) REFERENCES `vehicles` (`LicenseNum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vec_order_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehicles_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehicles_ibfk_3` FOREIGN KEY (`lincenes_id`) REFERENCES `lincenesrank` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workers`
--
ALTER TABLE `workers`
  ADD CONSTRAINT `workers_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
