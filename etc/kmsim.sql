CREATE DATABASE  IF NOT EXISTS `kmsim` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `kmsim`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: kmsim
-- ------------------------------------------------------
-- Server version	5.5.24-log

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
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Português','materia'),(2,'Informática','materia'),(3,'Raciocínio Lógico','materia'),(4,'Direito Administrativo','materia'),(5,'Direito Constitucional','materia'),(6,'Gramática','topico'),(7,'Ortografia','topico'),(8,'Semântica','topico'),(9,'kmSim','instituicao'),(10,'ACAFE','instituicao'),(11,'Ager','instituicao'),(12,'CAIPIMES','instituicao'),(13,'Cesgranrio','instituicao'),(14,'CESPE','instituicao'),(15,'CETRO','instituicao'),(16,'COMPERVE','instituicao'),(17,'CONESUL','instituicao'),(18,'Consulplan','instituicao'),(19,'Convest','instituicao'),(20,'COPS','instituicao'),(21,'ESAF','instituicao'),(22,'ESG','instituicao'),(23,'FCC','instituicao'),(24,'FDRH','instituicao'),(25,'FEC','instituicao'),(26,'Fepesve','instituicao'),(27,'FGV','instituicao'),(28,'FJPF','instituicao'),(29,'FUMARC','instituicao'),(30,'Fundação José Pelúcio Ferreira','instituicao'),(31,'FUNDEC','instituicao'),(32,'Funrio','instituicao'),(33,'IMES','instituicao'),(34,'Instituto Ludus','instituicao'),(35,'IPAD','instituicao'),(36,'MOVENS','instituicao'),(37,'NCE','instituicao'),(38,'Nupps','instituicao'),(39,'UFPA','instituicao'),(40,'UFPR','instituicao'),(41,'Unama','instituicao'),(42,'UNIFAP','instituicao'),(43,'Upenet','instituicao'),(44,'Vunesp','instituicao');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-21 20:00:53

DROP TABLE IF EXISTS `kmsim`.`perguntas`;
CREATE TABLE `kmsim`.`perguntas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_materia` INT NULL,
  `id_instituicao` INT NULL,
  `ano` INT NULL,
  `enunciado` VARCHAR(1000) NULL,
  `explicacao` VARCHAR(1000) NULL,
  PRIMARY KEY (`id`),
  INDEX `id_materia` (`id_materia` ASC));
