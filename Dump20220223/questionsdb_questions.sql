-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: questionsdb
-- ------------------------------------------------------
-- Server version	10.4.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Question` varchar(2000) DEFAULT NULL,
  `Answer` varchar(2000) DEFAULT NULL,
  `UpVotes` int(11) DEFAULT NULL,
  `TagIDs` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (0,4,'a','a',NULL,NULL),(1,4,'what is bruh.com?','site',NULL,NULL),(2,4,'whats the deal man?','heres the deal man',NULL,NULL),(3,2,'bruh','.com',NULL,NULL),(4,2,'whats the best game','bruh.com',NULL,NULL),(5,2,'asdasd','ad',NULL,NULL),(6,4,'a','a',NULL,NULL),(7,4,'add','a',NULL,NULL),(8,4,'','',NULL,NULL),(9,4,'adasd','safdasf',NULL,NULL),(10,2,'what','an',NULL,NULL),(11,2,'what follows an if statement','an else statement',NULL,NULL),(12,2,'what follows an if statement','an else statement',NULL,NULL),(13,2,'','',NULL,NULL),(14,2,'what','an',NULL,NULL),(15,2,'what is the difference between a while loop and a for loop','one iterates until and the other iterates a set amount',NULL,NULL),(16,2,'what is the difference between a while loop and a for loop','one iterates until and the other iterates a set amount',NULL,'');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-23  6:47:02
