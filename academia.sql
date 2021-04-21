-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: academia2
-- ------------------------------------------------------
-- Server version	8.0.21

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
-- Table structure for table `aluno`
--

DROP TABLE IF EXISTS `aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aluno` (
  `CPF` varchar(15) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Venc_Matricula` varchar(15) DEFAULT NULL,
  `Nascimento` varchar(15) DEFAULT NULL,
  `Endereco` varchar(100) DEFAULT NULL,
  `Sexo` enum('M','F','NB') DEFAULT NULL,
  `HorarioConsulta` varchar(15) DEFAULT NULL,
  `CPFNutricionista` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`CPF`),
  KEY `CPFNutricionista` (`CPFNutricionista`),
  CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`CPFNutricionista`) REFERENCES `nutricionista` (`NCPF`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aluno`
--

LOCK TABLES `aluno` WRITE;
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
INSERT INTO `aluno` VALUES ('363.352.142-96','Sarah Luana Rodrigues','20/05/2021','06/11/1991','Caminho 17, número 898. Bairro Vila Canária.','F','08:00','938.209.259-53'),('607.639.923-64','Julia Clara Nunes','26/06/2023','01/07/1961','Quadra QS 10 Conjunto 110C, número 263. Bairro Areal','F','17:00','391.433.697-82'),('713.122.738-28','Raul Carlos André Santos','26/05/2025','16/04/1979','Rua Doutor João Luiz Alves Valladão, número 779. Bairro Grama.','M',NULL,NULL),('762.323.301-70','Pedro Henrique Leonardo Oliver Silveira','20/05/2023','21/07/1997','Rua B, número 843. Bairro Zona de Expansão. ','M','10:00','938.209.259-53'),('796.019.966-30','Aline Antônia Camila Figueiredo','20/05/2021','24/10/1955','Rua Piratininga, número 725. Bairro Jardim Ibirapuera. ','F','09:00','938.209.259-53');
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionario` (
  `FCPF` varchar(15) NOT NULL,
  `Nome` varchar(30) DEFAULT NULL,
  `Nascimento` varchar(15) DEFAULT NULL,
  `Salario` float DEFAULT NULL,
  `Sexo` enum('M','F','NB') DEFAULT NULL,
  `funcao` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`FCPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionario`
--

LOCK TABLES `funcionario` WRITE;
/*!40000 ALTER TABLE `funcionario` DISABLE KEYS */;
INSERT INTO `funcionario` VALUES ('391.433.697-82','Tatiane Mariah Simone da Mota','25/09/1967',4800,'F','nutricionista'),('639.638.621-65','Silvana Evelyn da Mata','04/10/1991',7500,'F','professor'),('735.744.101-66','Antônia Marlene Maya Fernandes','03/07/1969',3000,'F','professor'),('856.333.997-80','Manuel Camargo da Silva','25/09/1967',4800,'F','professor'),('938.209.259-53','Fábio Heitor','24/01/1982',3000,'M','nutricionista');
/*!40000 ALTER TABLE `funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscreve`
--

DROP TABLE IF EXISTS `inscreve`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inscreve` (
  `CPFAluno` varchar(15) NOT NULL,
  `idTurma` int NOT NULL,
  PRIMARY KEY (`CPFAluno`,`idTurma`),
  KEY `idTurma` (`idTurma`),
  CONSTRAINT `inscreve_ibfk_1` FOREIGN KEY (`CPFAluno`) REFERENCES `aluno` (`CPF`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inscreve_ibfk_2` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscreve`
--

LOCK TABLES `inscreve` WRITE;
/*!40000 ALTER TABLE `inscreve` DISABLE KEYS */;
INSERT INTO `inscreve` VALUES ('607.639.923-64',1),('713.122.738-28',1),('762.323.301-70',2),('796.019.966-30',2);
/*!40000 ALTER TABLE `inscreve` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modalidade`
--

DROP TABLE IF EXISTS `modalidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modalidade` (
  `idMod2` int NOT NULL,
  `nomeMod` varchar(30) NOT NULL,
  PRIMARY KEY (`idMod2`),
  UNIQUE KEY `nomeMod_UNIQUE` (`nomeMod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modalidade`
--

LOCK TABLES `modalidade` WRITE;
/*!40000 ALTER TABLE `modalidade` DISABLE KEYS */;
INSERT INTO `modalidade` VALUES (1,'dança'),(2,'ginastica');
/*!40000 ALTER TABLE `modalidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nutricionista`
--

DROP TABLE IF EXISTS `nutricionista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nutricionista` (
  `NCPF` varchar(15) NOT NULL,
  PRIMARY KEY (`NCPF`),
  CONSTRAINT `nutricionista_ibfk_1` FOREIGN KEY (`NCPF`) REFERENCES `funcionario` (`FCPF`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nutricionista`
--

LOCK TABLES `nutricionista` WRITE;
/*!40000 ALTER TABLE `nutricionista` DISABLE KEYS */;
INSERT INTO `nutricionista` VALUES ('391.433.697-82'),('938.209.259-53');
/*!40000 ALTER TABLE `nutricionista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professor` (
  `PCPF` varchar(15) NOT NULL,
  PRIMARY KEY (`PCPF`),
  CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`PCPF`) REFERENCES `funcionario` (`FCPF`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor`
--

LOCK TABLES `professor` WRITE;
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` VALUES ('639.638.621-65'),('735.744.101-66'),('856.333.997-80');
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turma`
--

DROP TABLE IF EXISTS `turma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `turma` (
  `idTurma` int NOT NULL AUTO_INCREMENT,
  `Horario` varchar(15) DEFAULT NULL,
  `CPFProf` varchar(15) DEFAULT NULL,
  `idMod` int DEFAULT NULL,
  `numeroaluno` int DEFAULT '0',
  PRIMARY KEY (`idTurma`),
  KEY `CPFProf` (`CPFProf`),
  KEY `idMod` (`idMod`),
  CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`CPFProf`) REFERENCES `professor` (`PCPF`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `turma_ibfk_2` FOREIGN KEY (`idMod`) REFERENCES `modalidade` (`idMod2`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turma`
--

LOCK TABLES `turma` WRITE;
/*!40000 ALTER TABLE `turma` DISABLE KEYS */;
INSERT INTO `turma` VALUES (1,'10:00','639.638.621-65',2,0),(2,'18:00','735.744.101-66',2,0),(3,'8:00','856.333.997-80',1,0);
/*!40000 ALTER TABLE `turma` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-21  0:19:07
