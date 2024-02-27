-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: riders
-- ------------------------------------------------------
-- Server version	8.0.31
create database riders;
use riders;

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
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking` (
  `id_booking` int NOT NULL AUTO_INCREMENT,
  `id_rider_fk` int DEFAULT NULL,
  `id_provider_fk` int DEFAULT NULL,
  `id_menu_fk` int DEFAULT NULL,
  `menu_quantity` int DEFAULT NULL,
  `id_status_fk` int DEFAULT NULL,
  `curr_date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_booking`),
  UNIQUE KEY `id_rider_fk` (`id_rider_fk`,`id_provider_fk`,`id_menu_fk`,`curr_date`),
  KEY `id_provider_fk` (`id_provider_fk`),
  KEY `id_menu_fk` (`id_menu_fk`),
  KEY `id_status_fk` (`id_status_fk`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_rider_fk`) REFERENCES `rider` (`id_rider`),
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_provider_fk`) REFERENCES `provider` (`id_provider`),
  CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`id_menu_fk`) REFERENCES `charity_menu` (`id_menu`),
  CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`id_status_fk`) REFERENCES `booking_status` (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (1,1,2,1,1,1,'HOY'),(2,1,2,1,1,1,'AYER'),(3,1,2,2,1,2,'HOY');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_status`
--

DROP TABLE IF EXISTS `booking_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking_status` (
  `id_status` int NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_status`
--

LOCK TABLES `booking_status` WRITE;
/*!40000 ALTER TABLE `booking_status` DISABLE KEYS */;
INSERT INTO `booking_status` VALUES (1,'Booked'),(2,'Cumming'),(3,'Delivered'),(4,'Not deliveredd');
/*!40000 ALTER TABLE `booking_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `charity_menu`
--

DROP TABLE IF EXISTS `charity_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `charity_menu` (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `item1` varchar(50) DEFAULT NULL,
  `item2` varchar(50) DEFAULT NULL,
  `item3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `charity_menu`
--

LOCK TABLES `charity_menu` WRITE;
/*!40000 ALTER TABLE `charity_menu` DISABLE KEYS */;
INSERT INTO `charity_menu` VALUES (1,'pollo','pizza','jesuscristo'),(2,'HOLA','que','tal');
/*!40000 ALTER TABLE `charity_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `communityk`
--

DROP TABLE IF EXISTS `communityk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `communityk` (
  `id_communityK` int NOT NULL AUTO_INCREMENT,
  `adress` varchar(50) DEFAULT NULL,
  `needs_food` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_communityK`),
  CONSTRAINT `communityk_ibfk_1` FOREIGN KEY (`id_communityK`) REFERENCES `usuario` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `communityk`
--

LOCK TABLES `communityk` WRITE;
/*!40000 ALTER TABLE `communityk` DISABLE KEYS */;
INSERT INTO `communityk` VALUES (4,'zzzxxzxz',1);
/*!40000 ALTER TABLE `communityk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `id_customer` int NOT NULL AUTO_INCREMENT,
  `location` varchar(300) DEFAULT NULL,
  `Xcoord` varchar(200) DEFAULT NULL,
  `Ycoord` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (3,'direccion mendiga','hashahsasa','asasjsajasj');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `delivery` (
  `id_delivery` int NOT NULL AUTO_INCREMENT,
  `id_booking_fk` int DEFAULT NULL,
  `delivery_date` varchar(200) DEFAULT NULL,
  `delivery_hour` varchar(200) DEFAULT NULL,
  `id_customer_fk` int DEFAULT NULL,
  `id_communityK_fk` int DEFAULT NULL,
  PRIMARY KEY (`id_delivery`),
  KEY `id_booking_fk` (`id_booking_fk`),
  KEY `id_customer_fk` (`id_customer_fk`),
  KEY `id_communityK_fk` (`id_communityK_fk`),
  CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`id_booking_fk`) REFERENCES `booking` (`id_booking`),
  CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`id_customer_fk`) REFERENCES `customer` (`id_customer`),
  CONSTRAINT `delivery_ibfk_3` FOREIGN KEY (`id_communityK_fk`) REFERENCES `communityk` (`id_communityK`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery`
--

LOCK TABLES `delivery` WRITE;
/*!40000 ALTER TABLE `delivery` DISABLE KEYS */;
INSERT INTO `delivery` VALUES (1,2,'3634-r45','4354.6776',3,NULL),(2,2,'677678','12.82',NULL,4);
/*!40000 ALTER TABLE `delivery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provider`
--

DROP TABLE IF EXISTS `provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `provider` (
  `id_provider` int NOT NULL AUTO_INCREMENT,
  `adress` varchar(50) NOT NULL,
  PRIMARY KEY (`id_provider`),
  UNIQUE KEY `adress` (`adress`),
  CONSTRAINT `provider_ibfk_1` FOREIGN KEY (`id_provider`) REFERENCES `usuario` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provider`
--

LOCK TABLES `provider` WRITE;
/*!40000 ALTER TABLE `provider` DISABLE KEYS */;
INSERT INTO `provider` VALUES (2,'callefalsa');
/*!40000 ALTER TABLE `provider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provider_has_menus`
--

DROP TABLE IF EXISTS `provider_has_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `provider_has_menus` (
  `id_prov` int NOT NULL,
  `id_m` int NOT NULL,
  `quantity` int DEFAULT NULL,
  PRIMARY KEY (`id_prov`,`id_m`),
  KEY `id_m` (`id_m`),
  CONSTRAINT `provider_has_menus_ibfk_1` FOREIGN KEY (`id_prov`) REFERENCES `provider` (`id_provider`),
  CONSTRAINT `provider_has_menus_ibfk_2` FOREIGN KEY (`id_m`) REFERENCES `charity_menu` (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provider_has_menus`
--

LOCK TABLES `provider_has_menus` WRITE;
/*!40000 ALTER TABLE `provider_has_menus` DISABLE KEYS */;
INSERT INTO `provider_has_menus` VALUES (2,1,2);
/*!40000 ALTER TABLE `provider_has_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rider`
--

DROP TABLE IF EXISTS `rider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rider` (
  `id_rider` int NOT NULL AUTO_INCREMENT,
  `surname1` varchar(50) DEFAULT NULL,
  `surname2` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `phone_number` varchar(9) NOT NULL,
  PRIMARY KEY (`id_rider`),
  UNIQUE KEY `phone_number` (`phone_number`),
  UNIQUE KEY `mail` (`mail`),
  CONSTRAINT `rider_ibfk_1` FOREIGN KEY (`id_rider`) REFERENCES `usuario` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rider`
--

LOCK TABLES `rider` WRITE;
/*!40000 ALTER TABLE `rider` DISABLE KEYS */;
INSERT INTO `rider` VALUES (1,'LOpez','perez','pedro@ssdsdsd','454545455'),(3,'RA','CISTA','hola','4734834');
/*!40000 ALTER TABLE `rider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_type` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES (1,'Admin'),(2,'Rider'),(3,'Proveedor'),(4,'ComedorSocial'),(5,'Homeless');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `pswd` varchar(500) NOT NULL,
  `dni_cif` varchar(9) DEFAULT NULL,
  `real_name` varchar(50) NOT NULL,
  `user_type` int DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `dni_cif` (`dni_cif`),
  KEY `user_type` (`user_type`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'prueba1','1234',NULL,'antonio',1),(2,'provider1','1234',NULL,'jesus',1),(3,'mendigo1','1234',NULL,'ivan',1),(4,'community_1','1234','122','com',4);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-27 10:20:24
