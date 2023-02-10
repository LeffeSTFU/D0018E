-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:3306
-- Tid vid skapande: 10 feb 2023 kl 15:15
-- Serverversion: 8.0.32-0ubuntu0.22.04.2
-- PHP-version: 8.1.2-1ubuntu2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `testschema1`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `Customers`
--

CREATE TABLE `Customers` (
  `customerID` int NOT NULL,
  `customerFirstName` varchar(45) NOT NULL,
  `customerLastName` varchar(45) NOT NULL,
  `customerMail` varchar(45) DEFAULT NULL,
  `customerAddress` varchar(45) DEFAULT NULL,
  `customerPassword` varchar(45) DEFAULT NULL,
  `customerUsername` varchar(45) NOT NULL,
  `accountType` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumpning av Data i tabell `Customers`
--

INSERT INTO `Customers` (`customerID`, `customerFirstName`, `customerLastName`, `customerMail`, `customerAddress`, `customerPassword`, `customerUsername`, `accountType`) VALUES
(1, 'Fyrby', 'Fyrby', 'fryby.mail@mail.com', 'Roddbåtsvägen 24', 'abc123', 'Fyrby', 'user'),
(2, 'Leffe', 'STFU', 'leffe.mail@mail.com', 'Lyckåsvägen 5', 'fyrby<3', 'LeffeSTFU', 'user'),
(3, 'Renberg', 'Varlog', 'renberg.mail@mail.com', 'cringeSTHLM 69', 'fortniteBattleP4ass', 'Varlog', 'user'),
(4, 'Spiffi', 'Qvist', 'spiffi.mail@mail.com', 'cringeSTHLM 420', '4guys<3', 'LimpusSensei', 'admin'),
(9, 'Tester', 'test', 'fuck@mail.com', 'din mamma', 'test', 'test', 'user');

-- --------------------------------------------------------

--
-- Tabellstruktur `Items`
--

CREATE TABLE `Items` (
  `productID` int NOT NULL,
  `quantity` int NOT NULL,
  `orderID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `Order`
--

CREATE TABLE `Order` (
  `orderID` int NOT NULL,
  `customerID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `Products`
--

CREATE TABLE `Products` (
  `productID` int NOT NULL,
  `productName` varchar(45) NOT NULL,
  `productCategory` varchar(45) NOT NULL,
  `productStock` int DEFAULT NULL,
  `productPrice` double DEFAULT NULL,
  `imageFile` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumpning av Data i tabell `Products`
--

INSERT INTO `Products` (`productID`, `productName`, `productCategory`, `productStock`, `productPrice`, `imageFile`) VALUES
(1, 'Pencil', 'Desk Supplies', 500, 5, NULL),
(2, 'Eraser', 'Desk Supplies', 100, 5, NULL),
(3, 'Keyboard', 'Computer Supplies', 50, 500, '/image/keyboard.png'),
(4, 'A4-Paper', 'Printing Supplies', 1000, 0.1, NULL),
(5, 'HDMI-Cable', 'Computer Supplies', 60, 120, '/image/hdmi-cable.png'),
(6, 'Black Printer Ink', 'Printing Supplies', 40, 350, NULL),
(7, 'Green Printer Ink', 'Printing Supplies', 10, 350, NULL),
(8, 'Gucci Sandals', 'Footwear', 10000, 9999, '/image/Sandals.jpg');

-- --------------------------------------------------------

--
-- Tabellstruktur `ShoppingCart`
--

CREATE TABLE `ShoppingCart` (
  `customerID` int NOT NULL,
  `productID` int NOT NULL,
  `poductName` varchar(45) NOT NULL,
  `productCategory` varchar(45) NOT NULL,
  `productPrice` double NOT NULL,
  `productCartQuantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumpning av Data i tabell `ShoppingCart`
--

INSERT INTO `ShoppingCart` (`customerID`, `productID`, `poductName`, `productCategory`, `productPrice`, `productCartQuantity`) VALUES
(2, 1, 'Pencil', 'Desk Supplies', 5, 1);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `customerID_UNIQUE` (`customerID`);

--
-- Index för tabell `Items`
--
ALTER TABLE `Items`
  ADD KEY `orderID_idx` (`orderID`),
  ADD KEY `productID_idx` (`productID`);

--
-- Index för tabell `Order`
--
ALTER TABLE `Order`
  ADD PRIMARY KEY (`orderID`),
  ADD UNIQUE KEY `customerID_UNIQUE` (`orderID`),
  ADD KEY `customerID_idx` (`customerID`);

--
-- Index för tabell `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`productID`),
  ADD UNIQUE KEY `productID_UNIQUE` (`productID`);

--
-- Index för tabell `ShoppingCart`
--
ALTER TABLE `ShoppingCart`
  ADD UNIQUE KEY `customerID_UNIQUE` (`customerID`),
  ADD UNIQUE KEY `productID_UNIQUE` (`productID`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `Customers`
--
ALTER TABLE `Customers`
  MODIFY `customerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT för tabell `Products`
--
ALTER TABLE `Products`
  MODIFY `productID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT för tabell `ShoppingCart`
--
ALTER TABLE `ShoppingCart`
  MODIFY `customerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `Items`
--
ALTER TABLE `Items`
  ADD CONSTRAINT `orderID` FOREIGN KEY (`orderID`) REFERENCES `Order` (`orderID`),
  ADD CONSTRAINT `productID` FOREIGN KEY (`productID`) REFERENCES `Products` (`productID`);

--
-- Restriktioner för tabell `Order`
--
ALTER TABLE `Order`
  ADD CONSTRAINT `customerID` FOREIGN KEY (`customerID`) REFERENCES `Customers` (`customerID`);

--
-- Restriktioner för tabell `ShoppingCart`
--
ALTER TABLE `ShoppingCart`
  ADD CONSTRAINT `selectedProductID` FOREIGN KEY (`productID`) REFERENCES `Products` (`productID`),
  ADD CONSTRAINT `userID` FOREIGN KEY (`customerID`) REFERENCES `Customers` (`customerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
