-- MySQL dump 10.13  Distrib 8.0.41, for Linux (x86_64)
--
-- Host: localhost    Database: base_resultat_examen
-- ------------------------------------------------------
-- Server version	8.0.41-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','$2y$10$Vx5bX2WgRf6ZkKJ3QYqZNuJ7tTd1UZoL1Lb2sDq9Wz1cKvLmNpSdG'),(3,'adminphp','$2y$10$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ecole`
--

DROP TABLE IF EXISTS `ecole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ecole` (
  `codeEcole` int NOT NULL AUTO_INCREMENT,
  `nom_ecole` varchar(90) DEFAULT NULL,
  `code_DPE` int DEFAULT NULL,
  `code_DCE` int DEFAULT NULL,
  PRIMARY KEY (`codeEcole`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ecole`
--

LOCK TABLES `ecole` WRITE;
/*!40000 ALTER TABLE `ecole` DISABLE KEYS */;
INSERT INTO `ecole` VALUES (3,'COLLE ALFAGERIE',333,444),(4,'ecole francaise ',12,123);
/*!40000 ALTER TABLE `ecole` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edition`
--

DROP TABLE IF EXISTS `edition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `edition` (
  `idedition` int NOT NULL AUTO_INCREMENT,
  `annee` int DEFAULT NULL,
  `resultat_idResultat` int DEFAULT NULL,
  PRIMARY KEY (`idedition`),
  KEY `edition_ibfk_1` (`resultat_idResultat`),
  CONSTRAINT `edition_ibfk_1` FOREIGN KEY (`resultat_idResultat`) REFERENCES `resultat` (`idResultat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edition`
--

LOCK TABLES `edition` WRITE;
/*!40000 ALTER TABLE `edition` DISABLE KEYS */;
INSERT INTO `edition` VALUES (1,2023,1),(2,2023,2);
/*!40000 ALTER TABLE `edition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eleve` (
  `idEleve` int NOT NULL AUTO_INCREMENT,
  `nomComplet` varchar(100) DEFAULT NULL,
  `codeEleve` varchar(50) DEFAULT NULL,
  `ecole` varchar(100) DEFAULT NULL,
  `cycle` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `option_idoption` int DEFAULT NULL,
  `resultat_idResultat` int DEFAULT NULL,
  `sexe` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idEleve`),
  KEY `option_idoption` (`option_idoption`),
  KEY `eleve_ibfk_2` (`resultat_idResultat`),
  CONSTRAINT `eleve_ibfk_1` FOREIGN KEY (`option_idoption`) REFERENCES `options_exam` (`idoption`),
  CONSTRAINT `eleve_ibfk_2` FOREIGN KEY (`resultat_idResultat`) REFERENCES `resultat` (`idResultat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eleve`
--

LOCK TABLES `eleve` WRITE;
/*!40000 ALTER TABLE `eleve` DISABLE KEYS */;
/*!40000 ALTER TABLE `eleve` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options_exam`
--

DROP TABLE IF EXISTS `options_exam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `options_exam` (
  `idoption` int NOT NULL AUTO_INCREMENT,
  `nomOption` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idoption`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options_exam`
--

LOCK TABLES `options_exam` WRITE;
/*!40000 ALTER TABLE `options_exam` DISABLE KEYS */;
INSERT INTO `options_exam` VALUES (1,'sociale'),(2,'comerciale'),(3,'Technique');
/*!40000 ALTER TABLE `options_exam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recherche_log`
--

DROP TABLE IF EXISTS `recherche_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recherche_log` (
  `idLog` int NOT NULL AUTO_INCREMENT,
  `nom_recherche` varchar(100) DEFAULT NULL,
  `annee` int DEFAULT NULL,
  `date_recherche` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idLog`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recherche_log`
--

LOCK TABLES `recherche_log` WRITE;
/*!40000 ALTER TABLE `recherche_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `recherche_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultat`
--

DROP TABLE IF EXISTS `resultat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resultat` (
  `idResultat` int NOT NULL AUTO_INCREMENT,
  `pourcentage` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`idResultat`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultat`
--

LOCK TABLES `resultat` WRITE;
/*!40000 ALTER TABLE `resultat` DISABLE KEYS */;
INSERT INTO `resultat` VALUES (1,'10'),(2,'70');
/*!40000 ALTER TABLE `resultat` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-20 10:01:23
