-- MariaDB dump 10.19  Distrib 10.11.3-MariaDB, for osx10.17 (x86_64)
--
-- Host: localhost    Database: barangkiriman
-- ------------------------------------------------------
-- Server version	10.11.3-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `api_setting`
--

DROP TABLE IF EXISTS `api_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `api_setting` (
  `apiID` int(10) NOT NULL AUTO_INCREMENT,
  `companyID` bigint(10) NOT NULL,
  `api_username` varchar(100) NOT NULL,
  `api_password` varchar(100) NOT NULL,
  `api_npwp` varchar(100) NOT NULL,
  `ref_prefix` varchar(50) NOT NULL,
  PRIMARY KEY (`apiID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_setting`
--

LOCK TABLES `api_setting` WRITE;
/*!40000 ALTER TABLE `api_setting` DISABLE KEYS */;
INSERT INTO `api_setting` VALUES
(3,1,'-','-','-','ES'),
(5,6,'balisuryas^$balisuryas','T1RRNU56TXpPVGMyTFRJeg0K','949733976905000','BSS');
/*!40000 ALTER TABLE `api_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `companyID` bigint(10) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `company_logo` varchar(100) NOT NULL,
  `company_status` int(5) NOT NULL,
  `rootdir` varchar(100) NOT NULL,
  PRIMARY KEY (`companyID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES
(1,'Eirene Solutions','',1,'eirenesolutions'),
(6,'PT BALI SURYA SENTOSA','1689991424.jpeg',1,'ptbalisuryasentosa');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_jenis_aju`
--

DROP TABLE IF EXISTS `master_jenis_aju`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_jenis_aju` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_jenis_aju`
--

LOCK TABLES `master_jenis_aju` WRITE;
/*!40000 ALTER TABLE `master_jenis_aju` DISABLE KEYS */;
INSERT INTO `master_jenis_aju` VALUES
(1,'1','CN'),
(2,'2','PIBK'),
(3,'3','BC 1.4'),
(4,'4','PIB');
/*!40000 ALTER TABLE `master_jenis_aju` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_jenis_pibk`
--

DROP TABLE IF EXISTS `master_jenis_pibk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_jenis_pibk` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_jenis_pibk`
--

LOCK TABLES `master_jenis_pibk` WRITE;
/*!40000 ALTER TABLE `master_jenis_pibk` DISABLE KEYS */;
INSERT INTO `master_jenis_pibk` VALUES
(1,'1','Barang Pindahan'),
(2,'2','Barang Kiriman Melalui PJT'),
(3,'3','Barang Impor Sementara Di Bawa Penumpang'),
(4,'4','Barang Impor Tertentu'),
(5,'5','Barang Pribadi Penumpang'),
(6,'6','Lainnya');
/*!40000 ALTER TABLE `master_jenis_pibk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_jenis_pungutan`
--

DROP TABLE IF EXISTS `master_jenis_pungutan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_jenis_pungutan` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_jenis_pungutan`
--

LOCK TABLES `master_jenis_pungutan` WRITE;
/*!40000 ALTER TABLE `master_jenis_pungutan` DISABLE KEYS */;
INSERT INTO `master_jenis_pungutan` VALUES
(1,'1','BM'),
(2,'2','PPH'),
(3,'3','PPN'),
(4,'4','PPNBM');
/*!40000 ALTER TABLE `master_jenis_pungutan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_jenis_tarif`
--

DROP TABLE IF EXISTS `master_jenis_tarif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_jenis_tarif` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_jenis_tarif`
--

LOCK TABLES `master_jenis_tarif` WRITE;
/*!40000 ALTER TABLE `master_jenis_tarif` DISABLE KEYS */;
INSERT INTO `master_jenis_tarif` VALUES
(1,'1','PROSENTASE (ADVALORUM)'),
(2,'2','SPESIFIK');
/*!40000 ALTER TABLE `master_jenis_tarif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userID` bigint(10) NOT NULL AUTO_INCREMENT,
  `companyID` bigint(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `status` int(5) NOT NULL,
  `level` int(5) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,1,'work.johannesherman@gmail.com','f15c0cf5c907f9b1484c5e953a65df8f','Johannes Herman',1,1),
(4,6,'master@bss','affe5870bbbcbf705e602f8abd7d1f30','master@bss',1,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-22 10:21:40
