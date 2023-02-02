-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: testschema1
-- ------------------------------------------------------
-- Server version	8.0.32-0ubuntu0.22.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Customers`
--

DROP TABLE IF EXISTS `Customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Customers` (
  `customerID` int NOT NULL AUTO_INCREMENT,
  `customerFirstName` varchar(45) NOT NULL,
  `customerLastName` varchar(45) NOT NULL,
  `customerMail` varchar(45) DEFAULT NULL,
  `customerAddress` varchar(45) DEFAULT NULL,
  `customerPassword` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`customerID`),
  UNIQUE KEY `customerID_UNIQUE` (`customerID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Customers`
--

LOCK TABLES `Customers` WRITE;
/*!40000 ALTER TABLE `Customers` DISABLE KEYS */;
INSERT INTO `Customers` VALUES (1,'Fyrby','Fyrby','fryby.mail@mail.com','Roddbåtsvägen 24','abc123'),(2,'Leffe','STFU','leffe.mail@mail.com','Lyckåsvägen 5','fyrby<3'),(3,'Renberg','Varlog','renberg.mail@mail.com','cringeSTHLM 69','fortniteBattleP4ass'),(4,'Spiffi','Qvist','spiffi.mail@mail.com','cringeSTHLM 420','4guys<3');
/*!40000 ALTER TABLE `Customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Items`
--

DROP TABLE IF EXISTS `Items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Items` (
  `productID` int NOT NULL,
  `quantity` int NOT NULL,
  `orderID` int NOT NULL,
  KEY `orderID_idx` (`orderID`),
  KEY `productID_idx` (`productID`),
  CONSTRAINT `orderID` FOREIGN KEY (`orderID`) REFERENCES `Order` (`orderID`),
  CONSTRAINT `productID` FOREIGN KEY (`productID`) REFERENCES `Products` (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Items`
--

LOCK TABLES `Items` WRITE;
/*!40000 ALTER TABLE `Items` DISABLE KEYS */;
/*!40000 ALTER TABLE `Items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Order`
--

DROP TABLE IF EXISTS `Order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Order` (
  `orderID` int NOT NULL,
  `customerID` int NOT NULL,
  PRIMARY KEY (`orderID`),
  UNIQUE KEY `customerID_UNIQUE` (`orderID`),
  KEY `customerID_idx` (`customerID`),
  CONSTRAINT `customerID` FOREIGN KEY (`customerID`) REFERENCES `Customers` (`customerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Order`
--

LOCK TABLES `Order` WRITE;
/*!40000 ALTER TABLE `Order` DISABLE KEYS */;
/*!40000 ALTER TABLE `Order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Products` (
  `productID` int NOT NULL AUTO_INCREMENT,
  `productName` varchar(45) NOT NULL,
  `productCategory` varchar(45) NOT NULL,
  `productStock` int DEFAULT NULL,
  `productPrice` double DEFAULT NULL,
  PRIMARY KEY (`productID`),
  UNIQUE KEY `productID_UNIQUE` (`productID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` VALUES (1,'Pencil','Desk Supplies',500,5),(2,'Eraser','Desk Supplies',100,5),(3,'Keyboard','Computer Supplies',50,500),(4,'A4-Paper','Printing Supplies',1000,0.1),(5,'HDMI-Cable','Computer Supplies',60,120),(6,'Black Printer Ink','Printing Supplies',40,350),(7,'Green Printer Ink','Printing Supplies',10,350),(8,'Gucci Flip-Flops','Footwear',10000,9999);
/*!40000 ALTER TABLE `Products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-02 14:14:31
