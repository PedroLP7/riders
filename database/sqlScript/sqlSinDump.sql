-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: riders
-- ------------------------------------------------------
-- Server version	8.0.35
drop database riders;
create database riders;
use riders;

--
-- Table structure for table `booking`
--
DROP TABLE IF EXISTS `usuario`;

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE `user_type` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
);

INSERT INTO `user_type` VALUES (1,'Admin'),(2,'Rider'),(3,'Proveedor'),(4,'ComedorSocial'),(5,'Homeless');

CREATE TABLE `usuario` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `pswd` varchar(500) NOT NULL,
  `dni_cif` varchar(9) DEFAULT NULL,
  `real_name` varchar(50) NOT NULL,
  `user_type_id` int DEFAULT NULL,
  `isActive` tinyint DEFAULT NULL,
  `imgProfile` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `dni_cif` (`dni_cif`),
  KEY `user_type` (`user_type_id`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`type_id`)
);

INSERT INTO `usuario` VALUES (2,'provider1','1234',NULL,'jesus',3,NULL,NULL),(3,'mendigo1','1234',NULL,'ivan',5,NULL,NULL),(4,'community_1','1234','122','com',4,NULL,NULL),(24,'Alexander5','$2y$12$FNjW8v8I2pk5zwXxhf9yk.246egK6Pjw/MFxsP7AQAMiSUB.cBtWG','99','update2',2,0,'profile2');
--
-- Dumping data for table `booking`
--






--
-- Table structure for table `booking_status`
--

DROP TABLE IF EXISTS `booking_status`;

CREATE TABLE `booking_status` (
  `id_status` int NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
);

--
-- Dumping data for table `booking_status`
--


INSERT INTO `booking_status` VALUES (1,'Booked'),(2,'Cumming'),(3,'Delivered'),(4,'Not deliveredd');


--
-- Table structure for table `charity_menu`
--

DROP TABLE IF EXISTS `charity_menu`;

CREATE TABLE `charity_menu` (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `item1` varchar(50) DEFAULT NULL,
  `item2` varchar(50) DEFAULT NULL,
  `item3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
);

--
-- Dumping data for table `charity_menu`
--



INSERT INTO `charity_menu` VALUES (1,'pollo','pizza','jesuscristo'),(2,'HOLA','que','tal');



--
-- Table structure for table `communityk`
--

DROP TABLE IF EXISTS `communityk`;

CREATE TABLE `communityk` (
  `id_communityK` int NOT NULL AUTO_INCREMENT,
  `adress` varchar(50) DEFAULT NULL,
  `needs_food` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_communityK`),
  CONSTRAINT `communityk_ibfk_1` FOREIGN KEY (`id_communityK`) REFERENCES `usuario` (`id_user`)
);

--
-- Dumping data for table `communityk`
--
INSERT INTO `communityk` VALUES (4,'zzzxxzxz',1);





--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id_customer` int NOT NULL AUTO_INCREMENT,
  `location` varchar(300) DEFAULT NULL,
  `Xcoord` varchar(200) DEFAULT NULL,
  `Ycoord` varchar(200) DEFAULT NULL,
  `isActive` tinyint DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
);


--
-- Dumping data for table `customer`
--



INSERT INTO `customer` VALUES (3,'direccion mendiga','hashahsasa','asasjsajasj',NULL);



--
-- Table structure for table `delivery`
--




--
-- Table structure for table `provider`
--

DROP TABLE IF EXISTS `provider`;

CREATE TABLE `provider` (
  `id_provider` int NOT NULL AUTO_INCREMENT,
  `adress` varchar(50) NOT NULL,
  PRIMARY KEY (`id_provider`),
  UNIQUE KEY `adress` (`adress`),
  CONSTRAINT `provider_ibfk_1` FOREIGN KEY (`id_provider`) REFERENCES `usuario` (`id_user`)
);

--
-- Dumping data for table `provider`
--


INSERT INTO `provider` VALUES (2,'callefalsa');


--
-- Table structure for table `provider_has_menus`
--

DROP TABLE IF EXISTS `provider_has_menus`;
CREATE TABLE `provider_has_menus` (
  `id_prov` int NOT NULL,
  `id_m` int NOT NULL,
  `quantity` int DEFAULT NULL,
  PRIMARY KEY (`id_prov`,`id_m`),
  KEY `id_m` (`id_m`),
  CONSTRAINT `provider_has_menus_ibfk_1` FOREIGN KEY (`id_prov`) REFERENCES `provider` (`id_provider`),
  CONSTRAINT `provider_has_menus_ibfk_2` FOREIGN KEY (`id_m`) REFERENCES `charity_menu` (`id_menu`)
);

--
-- Dumping data for table `provider_has_menus`
--


INSERT INTO `provider_has_menus` VALUES (2,1,2);


--
-- Table structure for table `rider`
--

DROP TABLE IF EXISTS `rider`;

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
);

--
-- Dumping data for table `rider`
--


INSERT INTO `rider` VALUES (24,'LOP2','EZ2','HELOU2','692');


--
-- Table structure for table `user_type`
--



--
-- Dumping data for table `user_type`
--





--
-- Table structure for table `usuario`
--



DROP TABLE IF EXISTS `booking`;

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
); 
INSERT INTO `booking` VALUES (1,24,2,1,1,1,'HOY'),(2,24,2,2,1,1,'AYER');
--
-- Dumping data for table `usuario`
--

DROP TABLE IF EXISTS `delivery`;

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
);

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` VALUES (1,1,'HOY HAS','ahora',3,NULL),(2,2,'a','ahora2',NULL,4);
-- Dump completed on 2024-02-27 13:01:31
