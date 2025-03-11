-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2025 at 05:47 AM
-- Server version: 11.5.2-MariaDB-log
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `git_backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `iProductId` int(11) NOT NULL,
  `iCategoryId` int(11) NOT NULL,
  `vName` varchar(250) NOT NULL,
  `tDescription` text NOT NULL,
  `tImagePath` text NOT NULL,
  `tAddiImagePath` text NOT NULL,
  `eLatestProduct` enum('','Yes') NOT NULL,
  `iDisplayOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`iProductId`, `iCategoryId`, `vName`, `tDescription`, `tImagePath`, `tAddiImagePath`, `eLatestProduct`, `iDisplayOrder`) VALUES
(4, 1, 'ANTIQUE Collections', '', '1741671015.jpg', '', '', 0),
(5, 1, 'DRNAMIX Collections', '', '1741671055.jpg', '', 'Yes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `iCategoryId` int(11) NOT NULL,
  `vCategoryName` varchar(250) NOT NULL,
  `tImagePath` text NOT NULL,
  `tBrochureFiles` text NOT NULL,
  `iDisplayOrder` int(11) NOT NULL,
  `eStatus` enum('y','n','d') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`iCategoryId`, `vCategoryName`, `tImagePath`, `tBrochureFiles`, `iDisplayOrder`, `eStatus`) VALUES
(1, 'Bath Fittings', '1741670820.jpg', 'Bath_Fittings_Emerald.pdf', 1, 'y'),
(2, 'Handles', '1741670831.jpg', 'Handles_Emerald.pdf', 2, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `product_specifications`
--

CREATE TABLE `product_specifications` (
  `iId` int(11) NOT NULL,
  `iProductId` int(11) NOT NULL,
  `vName` varchar(250) NOT NULL,
  `vValue` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `iUserId` bigint(20) NOT NULL,
  `vName` varchar(250) NOT NULL,
  `vEmail` varchar(250) NOT NULL,
  `vMobileno` varchar(250) NOT NULL,
  `vUserName` varchar(100) NOT NULL,
  `vPassword` varchar(250) NOT NULL,
  `tAddress` text NOT NULL,
  `dLastLoginDate` datetime NOT NULL,
  `vLastIp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`iUserId`, `vName`, `vEmail`, `vMobileno`, `vUserName`, `vPassword`, `tAddress`, `dLastLoginDate`, `vLastIp`) VALUES
(1, 'Super Admin', 'john@gmail.com', '123', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Rajkot', '2025-03-11 11:16:18', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`iProductId`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`iCategoryId`),
  ADD KEY `iCategoryId` (`iCategoryId`);

--
-- Indexes for table `product_specifications`
--
ALTER TABLE `product_specifications`
  ADD PRIMARY KEY (`iId`),
  ADD KEY `iProductId` (`iProductId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iUserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `iProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `iCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_specifications`
--
ALTER TABLE `product_specifications`
  MODIFY `iId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `iUserId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
