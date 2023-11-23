CREATE DATABASE  IF NOT EXISTS `final` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `final`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: final
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `collaborators`
--

DROP TABLE IF EXISTS `collaborators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `collaborators` (
  `CollaboratorsID` int NOT NULL AUTO_INCREMENT,
  `CollaboratorsUserID` int NOT NULL,
  `ProjectManagerID` int NOT NULL,
  `ProjectID` int NOT NULL,
  PRIMARY KEY (`CollaboratorsID`),
  KEY `ProjectManagerID_idx` (`ProjectManagerID`),
  KEY `CollabProjectManagerID_idx` (`ProjectManagerID`) /*!80000 INVISIBLE */,
  KEY `CollabProjectID_idx` (`ProjectID`),
  KEY `CollabUserID_idx` (`CollaboratorsUserID`),
  CONSTRAINT `CollabProjectID` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ProjectID`),
  CONSTRAINT `CollabProjectManagerID` FOREIGN KEY (`ProjectManagerID`) REFERENCES `users` (`UserID`),
  CONSTRAINT `CollabUserID` FOREIGN KEY (`CollaboratorsUserID`) REFERENCES `users` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collaborators`
--

LOCK TABLES `collaborators` WRITE;
/*!40000 ALTER TABLE `collaborators` DISABLE KEYS */;
INSERT INTO `collaborators` VALUES (1,3,11,1),(2,11,3,5),(3,12,11,6),(4,19,11,1),(5,20,4,2),(6,20,13,3);
/*!40000 ALTER TABLE `collaborators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companyprofile`
--

DROP TABLE IF EXISTS `companyprofile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `companyprofile` (
  `UserID` int NOT NULL,
  `RoleID` int NOT NULL DEFAULT '3',
  `CompanyName` varchar(128) NOT NULL,
  `Industry` varchar(64) NOT NULL,
  `NumEmployees` int NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `UserID_UNIQUE` (`UserID`),
  KEY `CompanyRoleID_idx` (`RoleID`),
  CONSTRAINT `CompanyRoleID` FOREIGN KEY (`RoleID`) REFERENCES `userroles` (`RoleID`),
  CONSTRAINT `CompanyUserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companyprofile`
--

LOCK TABLES `companyprofile` WRITE;
/*!40000 ALTER TABLE `companyprofile` DISABLE KEYS */;
INSERT INTO `companyprofile` VALUES (5,3,'Intel','Technology',100000),(6,3,'Microsoft','Technology',100000),(15,3,'Electronic Arts','Gaming',100000),(16,3,'Rockstar Games','Gaming',100000),(17,3,'Roaring Kitty','Finance',10),(18,3,'Print Fast','Printing',1000);
/*!40000 ALTER TABLE `companyprofile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumerprofile`
--

DROP TABLE IF EXISTS `consumerprofile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consumerprofile` (
  `UserID` int NOT NULL,
  `RoleID` int NOT NULL DEFAULT '2',
  PRIMARY KEY (`UserID`),
  KEY `ConsumerRoleID_idx` (`RoleID`),
  CONSTRAINT `ConsumerRoleID` FOREIGN KEY (`RoleID`) REFERENCES `userroles` (`RoleID`),
  CONSTRAINT `ConsumerUserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumerprofile`
--

LOCK TABLES `consumerprofile` WRITE;
/*!40000 ALTER TABLE `consumerprofile` DISABLE KEYS */;
INSERT INTO `consumerprofile` VALUES (1,2),(2,2),(7,2),(8,2),(9,2),(10,2);
/*!40000 ALTER TABLE `consumerprofile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contractorprofile`
--

DROP TABLE IF EXISTS `contractorprofile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contractorprofile` (
  `UserID` int NOT NULL,
  `RoleID` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`UserID`),
  KEY `ContractorRoleID_idx` (`RoleID`),
  CONSTRAINT `ContractorRoleID` FOREIGN KEY (`RoleID`) REFERENCES `userroles` (`RoleID`),
  CONSTRAINT `ContractorUserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contractorprofile`
--

LOCK TABLES `contractorprofile` WRITE;
/*!40000 ALTER TABLE `contractorprofile` DISABLE KEYS */;
INSERT INTO `contractorprofile` VALUES (3,1),(4,1),(11,1),(12,1),(13,1),(14,1),(19,1),(20,1);
/*!40000 ALTER TABLE `contractorprofile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `JobID` int NOT NULL,
  `UserID` int NOT NULL,
  `JobTitle` varchar(256) NOT NULL,
  `JobDescription` varchar(2048) DEFAULT NULL,
  `JobPrice` double NOT NULL,
  `JobDuration` varchar(64) NOT NULL,
  `DatePosted` date NOT NULL,
  PRIMARY KEY (`JobID`),
  UNIQUE KEY `JobID_UNIQUE` (`JobID`),
  KEY `JobUserID_idx` (`UserID`),
  CONSTRAINT `JobUserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,1,'UI Desinger for personal project','Email me for more information',500,'1 Week','2023-11-04'),(2,1,'Front-end Web Developer for personal project','Need front end for portfolio website',1000,'2 weeks','2023-11-01'),(3,8,'Cyber Security Specialist needed','Contact for more information',30000,'1 year','2023-10-05'),(4,7,'Red-Hat hacker needed','Contact for more details',30000,'1 year','2023-10-05'),(5,9,'Plumber to fix toilet','Roomate jammed the flush pipe for my toilet',100,'2-3 hours','2023-10-30'),(6,10,'Plumber to fix toilet','Roomate broke the flush and is now trying to blame me',110,'2-3 hours','2023-10-31'),(7,16,'App Developer','Contact for more information (super cool, top secret project ;) )',100000,'1 year','2023-08-22'),(8,15,'Digital Artist','Need to make revamped models for Need For Speed Most Wanted 2024',80000,'1 year','2023-09-05');
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `ProjectID` int NOT NULL AUTO_INCREMENT,
  `ProjectTitle` varchar(64) NOT NULL,
  `ProjectDescription` varchar(2048) DEFAULT NULL,
  `ProjectManagerID` int NOT NULL,
  `Timeline` varchar(64) NOT NULL,
  `ApplicationStatus` tinyint NOT NULL,
  PRIMARY KEY (`ProjectID`),
  KEY `ProjProjectManagerID_idx` (`ProjectManagerID`),
  CONSTRAINT `ProjProjectManagerID` FOREIGN KEY (`ProjectManagerID`) REFERENCES `users` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'Building house from scratch','I have a plot of land upon which I need to build a house, need someone who can do wiring and plumbing',11,'6 Months',1),(2,'Design Character for a graphic novel','I need a digital artist to design characters for my play as I am publishing it in the form of a graphic novel',4,'15 Days',1),(3,'Publishing music','I have some fire beats ready for a rapper who is willing to take on the project and a digital artist to make the cover art',14,'1 Week',1),(4,'Full Stack Web App development','I need a front end react developer to develop ',13,'1 Month',1),(5,'Making a bathroom in my basement','I need a wood worker to make the frame for a bathroom in my basement',3,'1 Week',0),(6,'Making stairs for a customer','I need a welder to make a metal frame for some interior stairs',11,'1 Week',0);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `ReviewID` int NOT NULL AUTO_INCREMENT,
  `CreatorUserID` int NOT NULL,
  `TargetUserID` int NOT NULL,
  `Rating` double NOT NULL,
  `Comment` varchar(1024) DEFAULT NULL,
  `RoleID` int NOT NULL,
  `DatePosted` date NOT NULL,
  PRIMARY KEY (`ReviewID`),
  KEY `ReviewUserID_idx` (`CreatorUserID`),
  KEY `ReviewRoleID_idx` (`RoleID`),
  KEY `ReviewTargetUserID_idx` (`TargetUserID`),
  CONSTRAINT `ReviewRoleID` FOREIGN KEY (`RoleID`) REFERENCES `userroles` (`RoleID`),
  CONSTRAINT `ReviewTargetUserID` FOREIGN KEY (`TargetUserID`) REFERENCES `users` (`UserID`),
  CONSTRAINT `ReviewUserID` FOREIGN KEY (`CreatorUserID`) REFERENCES `users` (`UserID`),
  CONSTRAINT `reviews_chk_1` CHECK ((`Rating` between 0.5 and 5))
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,11,12,4,'Very good with metal work, minor issues with finishing but overall, great work',1,'2023-11-05'),(2,12,11,4,'Great work, no issues',1,'2023-11-05'),(3,1,13,5,'No complaints',2,'2023-10-10'),(4,9,11,3.5,'Good furniture work but it could use more detailed finishing',2,'2023-05-12'),(5,11,9,1,'Cheaped out on final payment, unclear requirments, too many revision mid project',1,'2023-05-12'),(6,6,13,4,'Excellent work, completed all projects with ease, brings great value',3,'2023-01-12');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skillmap`
--

DROP TABLE IF EXISTS `skillmap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skillmap` (
  `SkillMapID` int NOT NULL AUTO_INCREMENT,
  `ProjID` int DEFAULT NULL,
  `JobID` int DEFAULT NULL,
  `UserID` int DEFAULT NULL,
  `SkillName` varchar(45) NOT NULL,
  PRIMARY KEY (`SkillMapID`),
  UNIQUE KEY `SkillMapID_UNIQUE` (`SkillMapID`),
  KEY `SkillProjID_idx` (`ProjID`),
  KEY `SkillJobID_idx` (`JobID`),
  KEY `SkillUserID_idx` (`UserID`),
  CONSTRAINT `SkillJobID` FOREIGN KEY (`JobID`) REFERENCES `jobs` (`JobID`),
  CONSTRAINT `SkillProjID` FOREIGN KEY (`ProjID`) REFERENCES `projects` (`ProjectID`),
  CONSTRAINT `SkillUserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skillmap`
--

LOCK TABLES `skillmap` WRITE;
/*!40000 ALTER TABLE `skillmap` DISABLE KEYS */;
INSERT INTO `skillmap` VALUES (1,NULL,NULL,3,'Plumbing'),(2,NULL,NULL,4,'Writer'),(3,NULL,NULL,11,'Wood Work'),(4,NULL,NULL,12,'Welding'),(5,NULL,NULL,12,'Plumbing'),(6,NULL,NULL,13,'Application Developer'),(7,NULL,NULL,14,'Sound Engineer'),(8,NULL,NULL,13,'Web Developer'),(9,NULL,1,NULL,'UI/UX Designer'),(10,NULL,2,NULL,'Web Developer'),(11,NULL,3,NULL,'Cyber Security'),(12,NULL,4,NULL,'Hacker'),(13,NULL,5,NULL,'Plumber'),(14,NULL,6,NULL,'Plumber'),(15,NULL,7,NULL,'App Developer'),(16,NULL,8,NULL,'Digital Artist'),(17,1,NULL,NULL,'Plumber'),(18,1,NULL,NULL,'Electrician'),(19,2,NULL,NULL,'Digital Artist'),(20,3,NULL,NULL,'Rapper'),(21,4,NULL,NULL,'Web Developer'),(22,5,NULL,NULL,'Wood Work'),(23,6,NULL,NULL,'Welding'),(24,NULL,NULL,19,'Electrician'),(25,3,NULL,NULL,'Digital Artist'),(26,NULL,NULL,20,'Digital Artist');
/*!40000 ALTER TABLE `skillmap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skills` (
  `SkillName` varchar(64) NOT NULL,
  `SkillType` varchar(6) NOT NULL,
  PRIMARY KEY (`SkillName`),
  UNIQUE KEY `SkillName_UNIQUE` (`SkillName`),
  CONSTRAINT `skills_chk_1` CHECK (((`SkillType` = _utf8mb4'local') or (`SkillType` = _utf8mb4'global')))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` VALUES ('Application Developer','global'),('Background Dancer','local'),('Control System Designer','global'),('Cyber Security','global'),('Digital Artist','global'),('Electrician','local'),('Hacker','global'),('Plumbing','local'),('Rapper','global'),('Sound Engineer','global'),('UI/UX Designer','global'),('Web Developer','global'),('Welding','local'),('Wood Work','local'),('Writer','local');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagmap`
--

DROP TABLE IF EXISTS `tagmap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tagmap` (
  `TagMapID` int NOT NULL AUTO_INCREMENT,
  `ProjID` int DEFAULT NULL,
  `JobID` int DEFAULT NULL,
  `UserID` int DEFAULT NULL,
  `TagID` int NOT NULL,
  PRIMARY KEY (`TagMapID`),
  UNIQUE KEY `TagMapID_UNIQUE` (`TagMapID`),
  KEY `TagProjID_idx` (`ProjID`),
  KEY `TagJobID_idx` (`JobID`),
  KEY `TagUserID_idx` (`UserID`),
  CONSTRAINT `TagJobID` FOREIGN KEY (`JobID`) REFERENCES `jobs` (`JobID`),
  CONSTRAINT `TagProjID` FOREIGN KEY (`ProjID`) REFERENCES `projects` (`ProjectID`),
  CONSTRAINT `TagUserID` FOREIGN KEY (`UserID`) REFERENCES `contractorprofile` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagmap`
--

LOCK TABLES `tagmap` WRITE;
/*!40000 ALTER TABLE `tagmap` DISABLE KEYS */;
INSERT INTO `tagmap` VALUES (1,2,NULL,NULL,6),(2,3,NULL,NULL,6),(3,4,NULL,NULL,1),(4,5,NULL,NULL,18),(5,6,NULL,NULL,22),(6,NULL,1,NULL,12),(7,NULL,2,NULL,1),(8,NULL,4,NULL,8),(9,NULL,8,NULL,6),(10,NULL,NULL,3,16),(11,NULL,NULL,11,18),(12,NULL,NULL,11,20),(13,NULL,NULL,12,21),(14,NULL,NULL,12,22),(15,NULL,NULL,13,1),(16,NULL,NULL,13,2),(17,NULL,NULL,14,10),(18,NULL,NULL,20,5),(19,NULL,NULL,20,6);
/*!40000 ALTER TABLE `tagmap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `TagID` int NOT NULL AUTO_INCREMENT,
  `TagName` varchar(64) NOT NULL,
  `SkillName` varchar(64) NOT NULL,
  PRIMARY KEY (`TagID`),
  UNIQUE KEY `TagID_UNIQUE` (`TagID`),
  KEY `SkillName_idx` (`SkillName`),
  CONSTRAINT `SkillName` FOREIGN KEY (`SkillName`) REFERENCES `skills` (`SkillName`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Front-End','Web Developer'),(2,'Back-End','Web Developer'),(3,'Classical','Background Dancer'),(4,'Hip Hop','Background Dancer'),(5,'Abstract','Digital Artist'),(6,'Modern','Digital Artist'),(7,'White-Hat','Hacker'),(8,'Red-Hat','Hacker'),(9,'Blue-Hat','Hacker'),(10,'Rap','Sound Engineer'),(11,'Hip Hop','Sound Engineer'),(12,'Web','UI/UX Designer'),(13,'Apps','UI/UX Designer'),(14,'Classical','Writer'),(15,'Poet','Writer'),(16,'Novelist','Writer'),(17,'Play','Writer'),(18,'Construction','Wood Work'),(19,'Creative','Wood Work'),(20,'Furniture','Wood Work'),(21,'Small-Scale','Welding'),(22,'Large-Scale','Welding');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userroles`
--

DROP TABLE IF EXISTS `userroles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userroles` (
  `RoleID` int NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(32) NOT NULL,
  PRIMARY KEY (`RoleID`),
  UNIQUE KEY `RoleID_UNIQUE` (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userroles`
--

LOCK TABLES `userroles` WRITE;
/*!40000 ALTER TABLE `userroles` DISABLE KEYS */;
INSERT INTO `userroles` VALUES (1,'Contractor'),(2,'Consumer'),(3,'Company');
/*!40000 ALTER TABLE `userroles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(128) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `FirstName` varchar(64) NOT NULL,
  `LastName` varchar(64) NOT NULL,
  `Address` varchar(256) NOT NULL,
  `DOB` date NOT NULL,
  `UserRoleID` int NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `UserID_UNIQUE` (`UserID`),
  UNIQUE KEY `Username_UNIQUE` (`Username`),
  UNIQUE KEY `email_UNIQUE` (`Email`),
  KEY `UserRoleID_idx` (`UserRoleID`),
  CONSTRAINT `UserRoleID` FOREIGN KEY (`UserRoleID`) REFERENCES `userroles` (`RoleID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Panda02','kunal.pandya2@ontariotechu.net','temppass1','Kunal','Pandya','2000 Simcoe St, Oshawa, Canada','2002-03-22',2),(2,'Nas04','tempmail@gmail.com','password0220','John','Smith','175 Church St, Toronto, Canada','2000-01-05',2),(3,'Boi543','mail@hotmail.com','passPhrase','Kyle','Mathews','245 Main St, Quebec City, Canada','1986-05-21',1),(4,'Hamlet513','shake.shpeare@gmail.com','GHOST!!!','William','Shakespeare','1 Father St, London, UK','2006-01-01',1),(5,'Intel','marketing@intel.com','coreI9Gen14','Christoph','Schell','2200 Mission College Blvd, United States','1973-12-25',3),(6,'Microsoft','notch.apple@microsoft.com','Minecraft','Markus','Persson','1 Microsoft Way, Redmond, WA, United States','1979-06-01',3),(7,'RandomMan6','brunermail@thundermail.com','fireBoy','Tester1','Tester2','1 anonymous Rd, N/A','1000-10-10',2),(8,'RandomWomen6','bruningmail@thundermail.com','waterGirl','Tester3','Tester4','1 anonymous Rd, N/A','1000-10-10',2),(9,'Tom2332','itstom2000@gmail.com','itsTom','Tom','Stalion','343 Main St, NY, United States','2000-05-30',2),(10,'Jerry2332','itsJerry2000@gmail.com','itsJerry','Jerry','Riccardo','343 Main St, NY, United States','2000-05-30',2),(11,'Woody223','WoodyBoy@hotmail.com','ILoveWood','James','Carry','12 Queens Way, London, UK','1995-02-21',1),(12,'MetalicGirl44','MetalicGirl44@gmail.com','WeldingIsLife','Tiny','McCarthy','88 Painted Post Dr, Toronto, Canada','1999-07-07',1),(13,'DevOpsGod','Developer.Operation@gmail.com','BigBrainDev','Marcus','Lit','199 Railway Ave, Manitoba, Canada','2000-05-30',1),(14,'LilRapGod','RapIsLife2260@gmail.com','M&MIsAwesome','Terry','James','455 56 Ave, Vancouver, Canada','2001-03-25',1),(15,'NFSMW2005','NFSMW2005@ea.com','BMWM3GTR','Clarence','Callahan','209 Redwood Shores Parkway, Redwood City, United States','2005-11-11',3),(16,'GTAViceCity','marketing@rockstart.com','MiamiCity','Tommy','Vercetti','575 Broadway, New York, United States','2002-10-29',3),(17,'RoaringKitty','roaringkitty@gmail.com','PaperHands','Keith','Gill','548 Market St, San Francisco, United States','1986-06-08',3),(18,'PrintFast','marketing@printfast.ca','timeIsMoney','John','Perry','12 Principal Rd #11, Scarborough, Ontario, Canada','1995-08-12',3),(19,'Electro','electro.Maxwell@gmail.com','SpiderMan','Maxwell','Dillon','1 Broadway Cres, Nevada, United States','1999-05-02',1),(20,'VincentVan321','vincent.gogh','NetherlandsIsAwesome','Vincent','Gogh','321 Vincent Rd, Zundert, Netherlands','1953-03-30',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-15 14:09:39
