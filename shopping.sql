-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2020 at 07:30 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryParent` int(11) NOT NULL DEFAULT 0,
  `CategoryName` varchar(255) NOT NULL,
  `CategoryDescription` text NOT NULL,
  `CategoryOrder` int(11) DEFAULT NULL,
  `CategoryVisibility` tinyint(4) NOT NULL DEFAULT 0,
  `CategoryADs` tinyint(4) NOT NULL DEFAULT 0,
  `CategoryComments` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='The Categories Table';

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryParent`, `CategoryName`, `CategoryDescription`, `CategoryOrder`, `CategoryVisibility`, `CategoryADs`, `CategoryComments`) VALUES
(3, 0, 'Electronics', 'This Is The Electronics Category', 1, 0, 0, 0),
(12, 0, 'Clothing', 'All About Clothing & Fashion', 3, 0, 0, 1),
(14, 3, 'Nokia', 'Nokia Phones', 1, 0, 0, 0),
(16, 3, 'Blackberry', 'Blackberry Phones', 2, 0, 0, 0),
(17, 12, 'Hand-Made', 'Hand-Made Clothes', 1, 0, 0, 0),
(18, 0, 'Books', 'Books Of All Types', 4, 0, 0, 0),
(19, 0, 'Tools', 'Hand Tools', 5, 0, 0, 0),
(20, 0, 'Games', 'Video Games', 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentID` int(11) NOT NULL,
  `CommentContent` text NOT NULL,
  `CommentStatus` tinyint(4) NOT NULL,
  `Date` date NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='The Comments Table';

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentID`, `CommentContent`, `CommentStatus`, `Date`, `Item_ID`, `User_ID`) VALUES
(1, 'Very Good Product, Thanks Pro', 1, '2020-04-24', 5, 33),
(10, 'So Powerful PC, It Helps Me So Much, Thanks Pro For This Product.', 1, '2020-04-28', 8, 71),
(12, 'So Powerful PC', 1, '2020-04-28', 8, 33),
(16, 'Awesome', 0, '2020-04-29', 5, 71);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` int(11) NOT NULL,
  `ItemName` varchar(255) NOT NULL,
  `ItemDescription` text NOT NULL,
  `ItemPrice` text NOT NULL,
  `ItemDate` date NOT NULL,
  `ItemCountry` varchar(255) NOT NULL,
  `ItemImage` varchar(255) NOT NULL,
  `ItemStatus` varchar(255) NOT NULL,
  `ItemRating` smallint(6) NOT NULL,
  `ItemApproval` tinyint(4) NOT NULL DEFAULT 0,
  `ItemTags` varchar(255) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Category_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='The Items Table';

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `ItemName`, `ItemDescription`, `ItemPrice`, `ItemDate`, `ItemCountry`, `ItemImage`, `ItemStatus`, `ItemRating`, `ItemApproval`, `ItemTags`, `User_ID`, `Category_ID`) VALUES
(5, 'PS4', 'Play Station Four', '3000', '2020-04-23', 'USA', '85438660_no_image.png', '1', 0, 1, '', 33, 3),
(8, 'PC', 'Dell PC', '3000', '2020-04-24', 'USA', '85438660_no_image.png', '2', 0, 1, '', 33, 3),
(9, 'Skirt', 'Nice Skirt', '200', '2020-04-25', 'Egypt', '85438660_no_image.png', '1', 0, 1, '', 71, 12),
(11, 'Speaker', 'Very Good Speaker', '200', '2020-04-27', 'USA', '85438660_no_image.png', '1', 0, 1, '', 71, 3),
(12, 'T-Shirt', 'So Nice T-Shirt', '150', '2020-04-27', 'USA', '85438660_no_image.png', '1', 0, 0, '', 71, 12),
(18, 'Printer', 'So Powerful Printer', '300', '2020-04-27', 'USA', '85438660_no_image.png', '1', 0, 1, 'printer, Paper, electronics', 33, 3),
(35, 'Labtop', 'Tohiba Labtop', '3000', '2020-04-29', 'USA', '85438660_no_image.png', '1', 0, 1, 'Labtop, electronics', 33, 3),
(36, 'Fifa 2020', 'PC Electronic Game', '200', '2020-05-01', 'USA', '85438660_no_image.png', '1', 0, 1, 'PC, Pes', 33, 3),
(37, 'Pes 2020', 'PC Electronic Game', '200', '2020-05-01', 'USA', '85438660_no_image.png', '1', 0, 1, '', 33, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `GroupID` int(3) NOT NULL DEFAULT 0,
  `TrustStatus` int(3) NOT NULL DEFAULT 0,
  `RegistrationStatus` tinyint(4) NOT NULL DEFAULT 0,
  `Date` date NOT NULL,
  `UserImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='The Users Table';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `Password`, `Fullname`, `GroupID`, `TrustStatus`, `RegistrationStatus`, `Date`, `UserImage`) VALUES
(33, 'AhmedRamzy', 'ahmed@yahoo.com', '123', 'Ahmed Ramzy Sayed Ahmed', 0, 0, 1, '2020-04-12', '20126297_425340099_no_image.png'),
(71, 'MostafaRamzy', 'mostafa@gmail.com', '12', 'Mostafa Ramzy Sayed Ahmed', 1, 0, 1, '2020-04-30', '681510897_195228503_no_image.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `CategoryNameUnique` (`CategoryName`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `Item_ID_Constraint` (`Item_ID`),
  ADD KEY `User_ID_Constraint` (`User_ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `User_ID Constraint` (`User_ID`),
  ADD KEY `Category_ID Constraint` (`Category_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Item_ID_Constraint` FOREIGN KEY (`Item_ID`) REFERENCES `items` (`ItemID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User_ID_Constraint` FOREIGN KEY (`User_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `Category_ID Constraint` FOREIGN KEY (`Category_ID`) REFERENCES `categories` (`CategoryID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User_ID Constraint` FOREIGN KEY (`User_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
