-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2018 at 03:43 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE `auction` (
  `AuctionID` int(11) NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `StartValue` decimal(15,2) NOT NULL,
  `CreationDate` date NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `AuctionStatusID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`AuctionID`, `Title`, `Description`, `StartValue`, `CreationDate`, `StartDate`, `EndDate`, `AuctionStatusID`, `CategoryID`) VALUES
(3, 'Blue T-Shirt', 'Beautiful T-Shirt', '150.00', '2018-10-28', '2018-10-31', '2018-12-12', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `auction_bid`
--

CREATE TABLE `auction_bid` (
  `AuctionID` int(11) NOT NULL,
  `BidID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auction_status`
--

CREATE TABLE `auction_status` (
  `StatusID` int(11) NOT NULL,
  `Description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auction_status`
--

INSERT INTO `auction_status` (`StatusID`, `Description`) VALUES
(1, 'Open'),
(2, 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `BidID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `AuctionID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Value` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `category` (`CategoryID`, `Name`) VALUES
(1, 'Clothes'),
(2, 'Household');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `UserID` int(11) NOT NULL,
  `Login` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Address1` varchar(50) NOT NULL,
  `Address2` varchar(50) DEFAULT NULL,
  `ZipCode` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `User_Type` varchar(50) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Phone` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Company` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_auction`
--

CREATE TABLE `user_auction` (
  `UserID` int(11) NOT NULL,
  `AuctionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`AuctionID`),
  ADD KEY `IX_CategoryID` (`CategoryID`),
  ADD KEY `IX_StatusID` (`AuctionStatusID`);

--
-- Indexes for table `auction_bid`
--
ALTER TABLE `auction_bid`
  ADD KEY `IX_Auction_Bid_BidID` (`BidID`),
  ADD KEY `IX_Auction_Bid_AuctionID` (`AuctionID`);

--
-- Indexes for table `auction_status`
--
ALTER TABLE `auction_status`
  ADD PRIMARY KEY (`StatusID`);

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`BidID`),
  ADD KEY `IX_Bid_UserID` (`UserID`),
  ADD KEY `IX_Bid_AuctionID` (`AuctionID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD KEY `IX_Login_UserID` (`UserID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `user_auction`
--
ALTER TABLE `user_auction`
  ADD KEY `IX_User_Auction_UserID` (`UserID`),
  ADD KEY `IX_User_Auction_AuctionID` (`AuctionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auction`
--
ALTER TABLE `auction`
  MODIFY `AuctionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auction_status`
--
ALTER TABLE `auction_status`
  MODIFY `StatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `BidID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auction`
--

ALTER TABLE `auction`
  ADD CONSTRAINT `FK_CategoryID` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`),
  ADD CONSTRAINT `FK_statusID` FOREIGN KEY (`AuctionStatusID`) REFERENCES `auction_status` (`StatusID`);

--
-- Constraints for table `auction_bid`
--
ALTER TABLE `auction_bid`
  ADD CONSTRAINT `FK_Auction_Bid_AuctionID` FOREIGN KEY (`AuctionID`) REFERENCES `auction` (`AuctionID`),
  ADD CONSTRAINT `FK_Auction_Bid_BidID` FOREIGN KEY (`BidID`) REFERENCES `bid` (`BidID`);

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `FK_Bid_UserID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `FK_Bid_AuctionID` FOREIGN KEY (`AuctionID`) REFERENCES `auction` (`AuctionID`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `FK_Login_UserID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `user_auction`
--
ALTER TABLE `user_auction`
  ADD CONSTRAINT `FK_User_Auction_AuctionID` FOREIGN KEY (`AuctionID`) REFERENCES `auction` (`AuctionID`),
  ADD CONSTRAINT `FK_User_Auction_UserID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

