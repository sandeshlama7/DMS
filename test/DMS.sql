-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 03, 2023 at 06:53 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `Inventories`
--

CREATE TABLE `Inventories` (
  `itemID` int(11) NOT NULL,
  `Item` varchar(30) NOT NULL,
  `Quantity` float NOT NULL,
  `Metric` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Inventories`
--

INSERT INTO `Inventories` (`itemID`, `Item`, `Quantity`, `Metric`) VALUES
(100, 'Milk', 230, 'Litre'),
(103, 'Paneer', 200, 'Kg'),
(108, 'Dahi', 290, 'Litre'),
(109, 'Ghee', 50, 'Litre'),
(110, 'Milk(Raw)', 1404.5, 'Litre'),
(112, 'Nauni', 26, 'Litre'),
(113, 'Milk(Buffalo)', 40, 'Litre'),
(117, 'Dahi(Sweet)', 90, 'Litre');

-- --------------------------------------------------------

--
-- Table structure for table `InvoiceItem`
--

CREATE TABLE `InvoiceItem` (
  `ID` int(11) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `Item` varchar(40) NOT NULL,
  `Quantity` float NOT NULL,
  `Price` int(11) NOT NULL,
  `SubTotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `InvoiceItem`
--

INSERT INTO `InvoiceItem` (`ID`, `invoiceID`, `Item`, `Quantity`, `Price`, `SubTotal`) VALUES
(6, 226, 'Ghee', 1, 1350, 1350),
(7, 226, 'Paneer', 2, 950, 1900),
(8, 226, 'Nauni', 3, 1100, 3300),
(9, 227, 'Nauni', 1, 1100, 1100),
(10, 228, 'Paneer', 5, 950, 4750),
(11, 228, 'Milk (Buffalo)', 10, 140, 1400),
(12, 229, 'Milk (Buffalo)', 20, 140, 2800),
(13, 229, 'Dahi', 10, 140, 1400),
(14, 230, 'Paneer', 10, 950, 9500),
(15, 230, 'Milk', 40, 120, 4800),
(16, 231, 'Paneer', 2, 950, 1900),
(17, 232, 'Milk', 25, 120, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `Invoices`
--

CREATE TABLE `Invoices` (
  `invoiceID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Customer` varchar(50) NOT NULL,
  `SubTotal` float NOT NULL,
  `Discount` float NOT NULL,
  `Total` float NOT NULL,
  `Status` varchar(20) NOT NULL,
  `PendingAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Invoices`
--

INSERT INTO `Invoices` (`invoiceID`, `Date`, `Customer`, `SubTotal`, `Discount`, `Total`, `Status`, `PendingAmount`) VALUES
(226, '2023-10-02', 'Dhulikhel Hospital', 6550, 500, 6050, 'paid', 0),
(227, '2023-10-02', 'Araniko Hotel', 1100, 0, 1100, 'paid', 0),
(228, '2023-10-02', 'Araniko Hotel', 6150, 0, 6150, 'paid', 0),
(229, '2023-10-02', 'Himalayan Horizon', 4200, 0, 4200, 'pending', 4200),
(230, '2023-10-02', 'Dhulikhel Lodge Resort', 14300, 0, 14300, 'paid', 14300),
(231, '2023-10-03', 'Dhulikhel Lodge Resort', 1900, 0, 1900, 'pending', 1900),
(232, '2023-10-03', 'Himalayan Horizon', 3000, 0, 3000, 'paid', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Members`
--

CREATE TABLE `Members` (
  `MemberID` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Contact` bigint(20) NOT NULL,
  `Receivables` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Members`
--

INSERT INTO `Members` (`MemberID`, `Name`, `Address`, `Contact`, `Receivables`) VALUES
(1000, 'Araniko Hotel', 'Dhulikhel-09', 9869708091, 0),
(1001, 'Himalayan Horizon', 'Dhulikhel-02', 9813049959, 4200),
(1013, 'Yubraj Neupane', 'Dhulikhel-08, Kavre', 9813229283, 0),
(1015, 'Dhulikhel Hospital', 'Dhulikhel 09', 9810203345, 0),
(1016, 'Dhulikhel Lodge Resort', 'Dhulikhel-03', 9810203049, 1900),
(1019, 'Ram Upreti', 'Dhulikhel-09, Kavre', 9810203346, 0),
(1024, 'Mirabel Resort', 'Dhulikhel-03', 9810223412, 0);

-- --------------------------------------------------------

--
-- Table structure for table `PriceList`
--

CREATE TABLE `PriceList` (
  `itemID` int(10) NOT NULL,
  `item` varchar(50) NOT NULL,
  `metric` varchar(20) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `PriceList`
--

INSERT INTO `PriceList` (`itemID`, `item`, `metric`, `price`) VALUES
(100, 'Milk', 'per litre', 120),
(101, 'Milk(Buffalo)', 'per litre', 140),
(102, 'Dahi', 'per litre', 140),
(103, 'Paneer', 'per kg', 950),
(104, 'Ghee', 'per litre', 1350),
(105, 'Nauni', 'per kg', 1100),
(106, 'Dahi(Sweet)', 'per litre', 140);

-- --------------------------------------------------------

--
-- Table structure for table `Sales`
--

CREATE TABLE `Sales` (
  `salesId` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Items` varchar(40) NOT NULL,
  `Quantity` float NOT NULL,
  `Price` int(11) NOT NULL,
  `SubTotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Sales`
--

INSERT INTO `Sales` (`salesId`, `Date`, `Items`, `Quantity`, `Price`, `SubTotal`) VALUES
(9, '2023-10-02', 'Dahi', 10, 140, 1400);

-- --------------------------------------------------------

--
-- Table structure for table `Suppliers`
--

CREATE TABLE `Suppliers` (
  `supplierID` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `SupplierType` varchar(30) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Contact` bigint(20) NOT NULL,
  `Payables` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Suppliers`
--

INSERT INTO `Suppliers` (`supplierID`, `Name`, `SupplierType`, `Address`, `Contact`, `Payables`) VALUES
(10000, 'Hari Ram Khanal', 'Middle Man', 'Dhulikhel-08, Kavre', 9813001121, 7500),
(10002, 'Manohar Waiba', 'Farmer', 'Dhulikhel-08', 9810304055, 5363),
(10005, 'Menuka Syangbo', 'Middle Man', 'Dhulikhel-04, Kavre', 9867565980, 2324),
(10007, 'Kaila Tamang', 'Farmer', 'Dhulikhel-02', 9817890879, 0),
(10008, 'Ramesh Bomjan', 'Farmer', 'Dhulikhel-03', 9849113094, 2294),
(10010, 'Shyam Bahadur Tamang', 'Farmer', 'Dhulikhel-03, Chankhubesi', 9801249011, 0);

-- --------------------------------------------------------

--
-- Table structure for table `SupplyHistory`
--

CREATE TABLE `SupplyHistory` (
  `supplyID` int(11) NOT NULL,
  `date` date NOT NULL,
  `supplierName` varchar(40) NOT NULL,
  `supplierID` int(40) NOT NULL,
  `fat` float NOT NULL,
  `quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `SupplyHistory`
--

INSERT INTO `SupplyHistory` (`supplyID`, `date`, `supplierName`, `supplierID`, `fat`, `quantity`) VALUES
(2, '2023-10-01', 'Karlton', 10002, 6.5, 20),
(3, '2023-10-01', 'Hari Ram Khanal', 10000, 7.5, 50),
(4, '2023-09-30', 'Karlton', 10002, 6.5, 20),
(5, '2023-10-02', 'Ramesh Bomjan', 10008, 5.5, 10),
(6, '2023-10-02', 'Ramesh Bomjan', 10008, 7, 12),
(7, '2023-10-02', 'Manohar Waiba', 10002, 6.5, 10),
(8, '2023-10-02', 'Menuka Syangbo', 10005, 7.7, 10),
(9, '2023-10-02', 'Menuka Syangbo', 10005, 5.3, 7.4);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `userId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` varchar(40) NOT NULL,
  `contact` bigint(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`userId`, `name`, `address`, `contact`, `email`, `password`) VALUES
(11, 'Dhulikhel Dairy Farm', 'Dhulikhel-05', 9812982090, 'dhulikheldf@gmail.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Inventories`
--
ALTER TABLE `Inventories`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `InvoiceItem`
--
ALTER TABLE `InvoiceItem`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Invoices`
--
ALTER TABLE `Invoices`
  ADD PRIMARY KEY (`invoiceID`);

--
-- Indexes for table `Members`
--
ALTER TABLE `Members`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `PriceList`
--
ALTER TABLE `PriceList`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `Sales`
--
ALTER TABLE `Sales`
  ADD PRIMARY KEY (`salesId`);

--
-- Indexes for table `Suppliers`
--
ALTER TABLE `Suppliers`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `SupplyHistory`
--
ALTER TABLE `SupplyHistory`
  ADD PRIMARY KEY (`supplyID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Inventories`
--
ALTER TABLE `Inventories`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `InvoiceItem`
--
ALTER TABLE `InvoiceItem`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `Invoices`
--
ALTER TABLE `Invoices`
  MODIFY `invoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `Members`
--
ALTER TABLE `Members`
  MODIFY `MemberID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1028;

--
-- AUTO_INCREMENT for table `PriceList`
--
ALTER TABLE `PriceList`
  MODIFY `itemID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `Sales`
--
ALTER TABLE `Sales`
  MODIFY `salesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Suppliers`
--
ALTER TABLE `Suppliers`
  MODIFY `supplierID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10011;

--
-- AUTO_INCREMENT for table `SupplyHistory`
--
ALTER TABLE `SupplyHistory`
  MODIFY `supplyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
