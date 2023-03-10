-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:3306
-- Tid vid skapande: 10 mars 2023 kl 12:49
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
(1, 'Fyrby', 'Fyrby', 'fryby.mail@mail.com', 'Roddbåtsvägen 25', 'abc123', 'Fyrby', 'user'),
(2, 'Leffe', 'STFU', 'leffe.mail@mail.com', 'Luleå', 'fyrby<3', 'LeffeSTFU', 'user'),
(3, 'Renberg', 'Varlog', 'renberg.mail@mail.com', 'cringeSTHLM 69', 'fortniteBattleP4ass', 'Varlog', 'user'),
(4, 'Spiffi', 'Qvist', 'spiffi.mail@mail.com', 'cringeSTHLM 420', '4guys<3', 'LimpusSensei', 'admin'),
(11, 'Albert', 'Renell', 'albert@mail.com', 'Luleå', 'abc123', 'albren', 'user'),
(26, 'admin', 'admin', 'admin@mail.com', 'admin town', 'admin', 'admin', 'admin'),
(28, 'Leifi', 'Plomeros', 'leifi.plomeros@mail.com', 'Musta', '1234', 'leif2', 'user');

-- --------------------------------------------------------

--
-- Tabellstruktur `Orders`
--

CREATE TABLE `Orders` (
  `orderID` int NOT NULL,
  `customerID` int NOT NULL,
  `productID` int DEFAULT NULL,
  `PriceAtOrder` double DEFAULT NULL,
  `orderAmount` int DEFAULT NULL,
  `orderInstance` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumpning av Data i tabell `Orders`
--

INSERT INTO `Orders` (`orderID`, `customerID`, `productID`, `PriceAtOrder`, `orderAmount`, `orderInstance`) VALUES
(1, 11, 8, 9999, 1, 23),
(1, 11, 1, 5, 2, 24),
(1, 11, 2, 5, 2, 25),
(1, 11, 3, 500, 1, 26),
(1, 28, 3, 500, 1, 139),
(1, 28, 5, 120, 3, 140),
(1, 28, 12, 80, 1, 141),
(1, 28, 8, 9999, 1, 142),
(2, 28, 2, 5, 2, 143),
(2, 28, 11, 50, 2, 144),
(2, 28, 5, 120, 2, 145),
(2, 28, 7, 350, 2, 146);

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
(1, 'Pencil', 'Desk Supplies', 0, 50, '/image/pencil.jpg'),
(2, 'Eraser', 'Desk Supplies', 78, 5, '/image/eraser.png'),
(3, 'Keyboard', 'Computer Supplies', 28, 500, '/image/keyboard.png'),
(4, 'A4-Paper', 'Printing Supplies', 999, 0.1, '/image/a4_paper.jpg'),
(5, 'HDMI-Cable', 'Computer Supplies', 41, 120, '/image/hdmi-cable.png'),
(6, 'Black Printer Ink', 'Printing Supplies', 0, 350, '/image/black_ink.jpg'),
(7, 'Green Printer Ink', 'Printing Supplies', 6, 350, '/image/green_ink.png'),
(8, 'Gucci Sandals', 'Footwear', 9998, 9999, '/image/Sandals.jpg'),
(11, 'Party Hat', 'Desk Supplies', 51, 50, '/image/TUN-party.gif'),
(12, 'Computer Mouse', 'Computer Supplies', 1, 80, '/image/computer-mouse-icon-free-png.png');

-- --------------------------------------------------------

--
-- Tabellstruktur `Reviews`
--

CREATE TABLE `Reviews` (
  `productID` int NOT NULL,
  `comment` longtext,
  `customerID` int NOT NULL,
  `stars` double DEFAULT NULL,
  `reviewID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumpning av Data i tabell `Reviews`
--

INSERT INTO `Reviews` (`productID`, `comment`, `customerID`, `stars`, `reviewID`) VALUES
(1, 'Utmärkt skrivdon', 1, 5, 2),
(2, 'typ jävligt bra asså typ', 1, 5, 3),
(4, 'fake paper', 1, 0, 8),
(1, 'gottagetthatfortnitebattlepass', 3, 4, 10),
(6, 'very nice', 1, 3, 11),
(7, 'bad quality', 1, 2, 12),
(4, 'excellent quality, love it!', 3, 5, 13),
(8, 'comfortable and stylish, what more can you ask for?', 3, 5, 14),
(5, 'good quality and good pricing', 3, 5, 15),
(11, 'nice', 3, 5, 16);

-- --------------------------------------------------------

--
-- Tabellstruktur `ShoppingCart`
--

CREATE TABLE `ShoppingCart` (
  `productID` int NOT NULL,
  `customerID` int NOT NULL,
  `amount` int DEFAULT NULL,
  `shoppingcartItem` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumpning av Data i tabell `ShoppingCart`
--

INSERT INTO `ShoppingCart` (`productID`, `customerID`, `amount`, `shoppingcartItem`) VALUES
(3, 3, 9, 5),
(3, 3, 9, 6),
(3, 3, 9, 7),
(4, 3, 1, 66),
(6, 3, 1, 67),
(11, 11, 1, 156),
(2, 11, 1, 157),
(1, 11, 1, 158);

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
-- Index för tabell `Orders`
--
ALTER TABLE `Orders`
  ADD UNIQUE KEY `orderInstance_UNIQUE` (`orderInstance`),
  ADD KEY `customerID_idx` (`customerID`),
  ADD KEY `productID_idx` (`productID`);

--
-- Index för tabell `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`productID`),
  ADD UNIQUE KEY `productID_UNIQUE` (`productID`);

--
-- Index för tabell `Reviews`
--
ALTER TABLE `Reviews`
  ADD UNIQUE KEY `reviewID_UNIQUE` (`reviewID`),
  ADD KEY `productID_idx` (`productID`),
  ADD KEY `customerID_idx` (`customerID`);

--
-- Index för tabell `ShoppingCart`
--
ALTER TABLE `ShoppingCart`
  ADD UNIQUE KEY `shoppingcartItem_UNIQUE` (`shoppingcartItem`),
  ADD KEY `selectedCustomerID_idx` (`customerID`),
  ADD KEY `selectedProductID_idx` (`productID`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `Customers`
--
ALTER TABLE `Customers`
  MODIFY `customerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT för tabell `Orders`
--
ALTER TABLE `Orders`
  MODIFY `orderInstance` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT för tabell `Products`
--
ALTER TABLE `Products`
  MODIFY `productID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT för tabell `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `reviewID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT för tabell `ShoppingCart`
--
ALTER TABLE `ShoppingCart`
  MODIFY `shoppingcartItem` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `customerID` FOREIGN KEY (`customerID`) REFERENCES `Customers` (`customerID`),
  ADD CONSTRAINT `productID` FOREIGN KEY (`productID`) REFERENCES `Products` (`productID`);

--
-- Restriktioner för tabell `Reviews`
--
ALTER TABLE `Reviews`
  ADD CONSTRAINT `customersID` FOREIGN KEY (`customerID`) REFERENCES `Customers` (`customerID`),
  ADD CONSTRAINT `productsID` FOREIGN KEY (`productID`) REFERENCES `Products` (`productID`);

--
-- Restriktioner för tabell `ShoppingCart`
--
ALTER TABLE `ShoppingCart`
  ADD CONSTRAINT `selectedCustomerID` FOREIGN KEY (`customerID`) REFERENCES `Customers` (`customerID`),
  ADD CONSTRAINT `selectedProductID` FOREIGN KEY (`productID`) REFERENCES `Products` (`productID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
