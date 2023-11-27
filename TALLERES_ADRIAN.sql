-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: TALLERES_GUZMAN
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `ADMINISTRADOR`
--

DROP TABLE IF EXISTS `ADMINISTRADOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ADMINISTRADOR` (
  `PK_ID_ADMINISTRADOR` int NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `APELLIDOS` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `EMAIL` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `PASSWORD` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`PK_ID_ADMINISTRADOR`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ADMINISTRADOR`
--

LOCK TABLES `ADMINISTRADOR` WRITE;
/*!40000 ALTER TABLE `ADMINISTRADOR` DISABLE KEYS */;
INSERT INTO `ADMINISTRADOR` VALUES (1,'Adrián','Ibáñez Montalvo','adrian.ibanez@circulargo.com','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4');
/*!40000 ALTER TABLE `ADMINISTRADOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EMPLEADO`
--

DROP TABLE IF EXISTS `EMPLEADO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `EMPLEADO` (
  `PK_ID_EMPLEADO` int NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `APELLIDOS` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `FECHA_NACIMIENTO` date DEFAULT NULL,
  `BAJA` tinyint(1) NOT NULL DEFAULT '0',
  `COD_EMPLEADO` varchar(6) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`PK_ID_EMPLEADO`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EMPLEADO`
--

LOCK TABLES `EMPLEADO` WRITE;
/*!40000 ALTER TABLE `EMPLEADO` DISABLE KEYS */;
INSERT INTO `EMPLEADO` VALUES (1,'Rubén','Reinares','1998-07-01',0,'00C49B'),(2,'Rodrigo','Muñones','1998-12-25',0,'00JON3'),(3,'Jaime','Palacios','1991-11-14',0,'aSMdA1'),(4,'Pepe','Pepito','1997-11-16',0,'LwMeFG'),(5,'Lucia','Lucia','1996-12-28',0,'PmlqRp');
/*!40000 ALTER TABLE `EMPLEADO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ESTADO_RESERVA`
--

DROP TABLE IF EXISTS `ESTADO_RESERVA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ESTADO_RESERVA` (
  `PK_ID_ESTADO_RESERVA` int NOT NULL AUTO_INCREMENT,
  `NOMBRE_ESTADO` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`PK_ID_ESTADO_RESERVA`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ESTADO_RESERVA`
--

LOCK TABLES `ESTADO_RESERVA` WRITE;
/*!40000 ALTER TABLE `ESTADO_RESERVA` DISABLE KEYS */;
INSERT INTO `ESTADO_RESERVA` VALUES (1,'Pte. de aceptar'),(2,'Aceptada'),(3,'Denegada');
/*!40000 ALTER TABLE `ESTADO_RESERVA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RESERVA`
--

DROP TABLE IF EXISTS `RESERVA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RESERVA` (
  `PK_ID_RESERVA` int NOT NULL AUTO_INCREMENT,
  `FECHA_HASTA` date NOT NULL,
  `FK_ID_ESTADO` int NOT NULL DEFAULT '1',
  `FK_ID_VEHICULO` int NOT NULL,
  `FK_ID_EMPLEADO` int NOT NULL,
  `FECHA_DESDE` date NOT NULL,
  PRIMARY KEY (`PK_ID_RESERVA`),
  KEY `RESERVA_ESTADO_RESERVA_PK_ID_ESTADO_RESERVA_fk` (`FK_ID_ESTADO`),
  KEY `RESERVA_VEHICULO_PK_ID_VEHICULO_fk` (`FK_ID_VEHICULO`),
  KEY `RESERVA_EMPLEADO_PK_ID_EMPLEADO_fk` (`FK_ID_EMPLEADO`),
  CONSTRAINT `RESERVA_EMPLEADO_PK_ID_EMPLEADO_fk` FOREIGN KEY (`FK_ID_EMPLEADO`) REFERENCES `EMPLEADO` (`PK_ID_EMPLEADO`),
  CONSTRAINT `RESERVA_ESTADO_RESERVA_PK_ID_ESTADO_RESERVA_fk` FOREIGN KEY (`FK_ID_ESTADO`) REFERENCES `ESTADO_RESERVA` (`PK_ID_ESTADO_RESERVA`),
  CONSTRAINT `RESERVA_VEHICULO_PK_ID_VEHICULO_fk` FOREIGN KEY (`FK_ID_VEHICULO`) REFERENCES `VEHICULO` (`PK_ID_VEHICULO`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RESERVA`
--

LOCK TABLES `RESERVA` WRITE;
/*!40000 ALTER TABLE `RESERVA` DISABLE KEYS */;
INSERT INTO `RESERVA` VALUES (1,'2023-12-03',2,13,1,'2023-12-01'),(2,'2023-12-07',3,1,3,'2023-12-05');
/*!40000 ALTER TABLE `RESERVA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VEHICULO`
--

DROP TABLE IF EXISTS `VEHICULO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `VEHICULO` (
  `PK_ID_VEHICULO` int NOT NULL AUTO_INCREMENT,
  `MARCA` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `MODELO` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `MATRICULA` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `UBICACION` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `RUTA_IMAGEN` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`PK_ID_VEHICULO`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VEHICULO`
--

LOCK TABLES `VEHICULO` WRITE;
/*!40000 ALTER TABLE `VEHICULO` DISABLE KEYS */;
INSERT INTO `VEHICULO` VALUES (1,'Toyota','Corolla','ABC123','Elm Street',NULL),(5,'Ford','Focus','DEF456','Maple Avenue',NULL),(6,'Honda','Civic','GHI789','Oak Drive',NULL),(7,'Chevy','Malibu','JKL012','Pine Street',NULL),(8,'VolksWagen','Jetta','MNO345','Cedar Lane',NULL),(9,'Nissan','Altima','PQR678','Birch Road',NULL),(10,'Hyundai','Elantra','STU901','Elm Street',NULL),(11,'Mazda','Mazda3','VWX234','Maple Avenue',NULL),(12,'Kia','Optima','YZA567','Oak Drive',NULL),(13,'Subaru','Impreza','BCD890','Pine Street',NULL),(14,'Mercedes','Clase-C','EFG123','Cedar Lane',NULL),(15,'Audi','A4','HIJ456','Birch Road',NULL),(16,'Toyota','Rav4','KLM345','Elm Street',NULL),(17,'Ford','Escape','NOP678','Maple Avenue',NULL),(18,'Honda','Accord','QRS901','Oak Drive',NULL),(19,'Chevy','Equinox','TUV234','Pine Street',NULL),(20,'VolksWagen','Passat','WXY567','Cedar Lane',NULL),(21,'Nissan','Maxima','ZAB890','Birch Road',NULL),(22,'Hyundai','Sonata','BCD123','Elm Street',NULL),(23,'Mazda','CX-5','EFG456','Maple Avenue',NULL),(24,'Kia','Soul','HIJ789','Oak Drive',NULL),(25,'Subaru','Outback','KLM012','Pine Street',NULL),(26,'Toyota','Invented','DFG565','Calle Inventada',NULL),(27,'Toyota','Supra','938LFF','Calle Inventada','assets/images/vehiculos/Toyota_GR_Supra_SZ-R_(3BA-DB82-ZSRW).jpg'),(28,'Toyota','sdasdas','111aaa','cvbfbfb',NULL),(29,'Toyota','fgdfg','DFG567','Calle Inventada','assets/images/vehiculos/0591709e8deb1784e6885cc27763648d.jpg'),(30,'Toyota','fgdfg','hhh777','Calle Inventada','assets/images/vehiculos/51843d89ca36826ef308189ee8c5c8f6.jpg'),(31,'Toyota','fgdfg','DFG569','Calle Inventada','assets/images/vehiculos/b8ec6a317431d342932497d7045078fc.jpg');
/*!40000 ALTER TABLE `VEHICULO` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-27 19:14:51
