CREATE DATABASE  IF NOT EXISTS `RepositorioUrquiza` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `RepositorioUrquiza`;
-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: RepositorioUrquiza
-- ------------------------------------------------------
-- Server version	5.7.39-0ubuntu0.18.04.2

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
-- Table structure for table `año`
--

DROP TABLE IF EXISTS `año`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `año` (
  `idaño` int(11) NOT NULL AUTO_INCREMENT,
  `numeroaño` varchar(45) NOT NULL,
  PRIMARY KEY (`idaño`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `año`
--

LOCK TABLES `año` WRITE;
/*!40000 ALTER TABLE `año` DISABLE KEYS */;
INSERT INTO `año` VALUES (1,'Segundo'),(2,'Tercero');
/*!40000 ALTER TABLE `año` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carreras`
--

DROP TABLE IF EXISTS `carreras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carreras` (
  `idcarrera` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`idcarrera`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carreras`
--

LOCK TABLES `carreras` WRITE;
/*!40000 ALTER TABLE `carreras` DISABLE KEYS */;
INSERT INTO `carreras` VALUES (1,'Desarrollo de software'),(2,'Infraestructura de Tecnología de la Información'),(3,'Análisis Funcional de Sistemas Informáticos');
/*!40000 ALTER TABLE `carreras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias`
--

DROP TABLE IF EXISTS `materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materias` (
  `idmateria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `idaño` int(11) NOT NULL,
  `idcarrera` int(11) NOT NULL,
  PRIMARY KEY (`idmateria`),
  KEY `idaño` (`idaño`),
  KEY `idcarrera` (`idcarrera`),
  CONSTRAINT `materias_ibfk_3` FOREIGN KEY (`idaño`) REFERENCES `año` (`idaño`) ON UPDATE CASCADE,
  CONSTRAINT `materias_ibfk_4` FOREIGN KEY (`idcarrera`) REFERENCES `carreras` (`idcarrera`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias`
--

LOCK TABLES `materias` WRITE;
/*!40000 ALTER TABLE `materias` DISABLE KEYS */;
INSERT INTO `materias` VALUES (1,'Practica profesionalizante 1',1,1),(2,'Practica profesionalizante 1',1,2),(3,'Practica profesionalizante 1',1,3),(4,'Practica profesionalizante 2',2,1),(5,'Practica profesionalizante 2',2,2),(6,'Practica profesionalizante 2',2,3);
/*!40000 ALTER TABLE `materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trabajos`
--

DROP TABLE IF EXISTS `trabajos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trabajos` (
  `idtrabajo` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `idaño` int(11) NOT NULL,
  `idmateria` int(11) NOT NULL,
  `idcarrera` int(11) NOT NULL,
  `alumnos` varchar(1000) NOT NULL,
  `archivo` varchar(255) NOT NULL,
  PRIMARY KEY (`idtrabajo`),
  KEY `idmateria` (`idmateria`),
  KEY `idaño` (`idaño`),
  KEY `idusuario` (`idusuario`),
  KEY `idcarrera` (`idcarrera`),
  CONSTRAINT `trabajos_ibfk_3` FOREIGN KEY (`idmateria`) REFERENCES `materias` (`idmateria`) ON UPDATE CASCADE,
  CONSTRAINT `trabajos_ibfk_5` FOREIGN KEY (`idaño`) REFERENCES `año` (`idaño`) ON UPDATE CASCADE,
  CONSTRAINT `trabajos_ibfk_6` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON UPDATE CASCADE,
  CONSTRAINT `trabajos_ibfk_7` FOREIGN KEY (`idcarrera`) REFERENCES `carreras` (`idcarrera`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabajos`
--

LOCK TABLES `trabajos` WRITE;
/*!40000 ALTER TABLE `trabajos` DISABLE KEYS */;
INSERT INTO `trabajos` VALUES (3,4,'Eccommerce- tienda de ropa',2,4,1,'Gino RIbeca, Agustin Di Lonardo, Matias Aguirre, Franco Garcia',''),(4,4,'Tiendeme Ha Hand',1,1,2,'Alex Vigo, Sergio Barreto, Martin Insaurralde',''),(18,1,'Tiendeme Ha Hand',1,1,1,'Renzo Ferronato, Renzo Torrente','TIENDE A HAND (1).pdf'),(19,1,'Eccommerce- Tienda de ropa',2,5,2,'Gino RIbeca, Agustin Di Lonardo, Matias Aguirre, Franco Garcia','Base de datos- teoria cap1 .pdf'),(20,1,'Repositorio Urquiza',2,4,1,'Renzo ferronato, Alejandro Domizi, Patricio Strazuizo','02 - Conceptos Misiòn,  Visión y proposito.pdf'),(21,1,'Renzo Ferronato',2,5,2,'Alex Vigo, Sergio Barreto, Martin Insaurralde','02 - Conceptos Misiòn,  Visión y proposito.pdf');
/*!40000 ALTER TABLE `trabajos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'renzoferro','$2y$10$MKEZOE1o/HEE2KAgDMBkq.j6kjw0tiu.FGMSKLdi9wU8MMDQIlpFO','Renzo','Ferronato'),(2,'flaco','$2y$10$99HxZOJgRZWBzi93UMF5iOpRPU1FZN6iL4FK8tAk2fsYKhzDU6DTu','Renzo','SALCEDO'),(3,'ProfeCalivia','$2y$10$cfhe8RKgCKDfxBzWLq77oe6/cUldS5Jwhiqm6SEcSy4EzfEf3F8yG','Gabriela','Calivia'),(4,'julianferro','$2y$10$KfEBEJu4W7G2qSNRvnnM.uWMDk2Ilt.lqSpb2yCwUXTw0F9FTxfD2','julian','ferronato'),(5,'roman','$2y$10$6FVgC6bLpeI4xBBS5IpHRukFcXBEOIaK0nN1LjQIfYCBE.fbxxhKu','Roman','Riquelme'),(6,'maximeza','$2y$10$RJdZVuTfvyQV7xZLnjj3kOIhq13AJ5g3OQx4ej8iha9iyll.tYH7K','Maximiliano','Meza'),(7,'maxi8','$2y$10$Bs8kZfzhdwXNmO/.Q9sTB.ntyBM57BOfFtQk66GdS4CeGFGDTTY06','Maximiliano','Meza'),(8,'roman','$2y$10$rIurG.xLLovQUfjTP3bnleH622zqjFVdfdgZp0Wi4W3aHRou8Rhqm','Roman','Riquelme'),(9,'maxi10','$2y$10$xUO8C7oQzuYI7vETSqZf4..WhVFpOScXPOyO2YBzJf2K08MC6lxXi','Maximiliano','Sosa');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-20 22:45:43
