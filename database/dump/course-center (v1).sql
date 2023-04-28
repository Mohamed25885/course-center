CREATE DATABASE  IF NOT EXISTS `course_center` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `course_center`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: course_center
-- ------------------------------------------------------
-- Server version	8.0.26

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
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance` (
  `CourseId` int DEFAULT NULL,
  `CycleId` int DEFAULT NULL,
  `StudentId` int DEFAULT NULL,
  `ClassNo` int DEFAULT NULL,
  `Arrival` time NOT NULL,
  `Departure` time NOT NULL,
  KEY `ClassNo_idx` (`ClassNo`),
  KEY `StudentId_idx` (`StudentId`),
  KEY `CourseId_idx` (`CourseId`),
  KEY `CycleId_idx` (`CycleId`),
  CONSTRAINT `AttendanceClassNo` FOREIGN KEY (`ClassNo`) REFERENCES `classes` (`ClassNo`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `AttendanceCourseId` FOREIGN KEY (`CourseId`) REFERENCES `courses` (`CourseId`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `AttendanceCycleId` FOREIGN KEY (`CycleId`) REFERENCES `cycles` (`CycleId`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `AttendanceStudentId` FOREIGN KEY (`StudentId`) REFERENCES `students` (`StudentId`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classes` (
  `ClassNo` int NOT NULL AUTO_INCREMENT,
  `CourseId` int DEFAULT NULL,
  `CycleId` int DEFAULT NULL,
  `TeacherId` int DEFAULT NULL,
  `ClassTitle` varchar(45) NOT NULL,
  `ClassDate` date NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  PRIMARY KEY (`ClassNo`),
  KEY `TeacherId_idx` (`TeacherId`),
  KEY `CourseId_idx` (`CourseId`),
  KEY `CycleId_idx` (`CycleId`),
  CONSTRAINT `ClassesCourseId` FOREIGN KEY (`CourseId`) REFERENCES `courses` (`CourseId`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `ClassesCycleId` FOREIGN KEY (`CycleId`) REFERENCES `cycles` (`CycleId`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `ClassesTeacherId` FOREIGN KEY (`TeacherId`) REFERENCES `teachers` (`TeacherId`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `CourseId` int NOT NULL AUTO_INCREMENT,
  `CourseName` varchar(45) DEFAULT NULL,
  `CourseDescription` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`CourseId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coursespercycle`
--

DROP TABLE IF EXISTS `coursespercycle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coursespercycle` (
  `CycleId` int DEFAULT NULL,
  `CoursesId` int DEFAULT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  KEY `CourseId_idx` (`CoursesId`),
  KEY `CoursesPerCycleCycleId` (`CycleId`),
  CONSTRAINT `CoursesPerCycleCourseId` FOREIGN KEY (`CoursesId`) REFERENCES `courses` (`CourseId`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `CoursesPerCycleCycleId` FOREIGN KEY (`CycleId`) REFERENCES `cycles` (`CycleId`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coursespercycle`
--

LOCK TABLES `coursespercycle` WRITE;
/*!40000 ALTER TABLE `coursespercycle` DISABLE KEYS */;
/*!40000 ALTER TABLE `coursespercycle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courseteachers`
--

DROP TABLE IF EXISTS `courseteachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courseteachers` (
  `CourseId` int DEFAULT NULL,
  `CycleId` int DEFAULT NULL,
  `TeacherId` int DEFAULT NULL,
  KEY `TeacherId_idx` (`TeacherId`),
  KEY `CourseId_idx` (`CourseId`),
  KEY `CycleId_idx` (`CycleId`),
  CONSTRAINT `CourseTeachersCourseId` FOREIGN KEY (`CourseId`) REFERENCES `courses` (`CourseId`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `CourseTeachersCycleId` FOREIGN KEY (`CycleId`) REFERENCES `cycles` (`CycleId`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `CourseTeachersTeacherId` FOREIGN KEY (`TeacherId`) REFERENCES `teachers` (`TeacherId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courseteachers`
--

LOCK TABLES `courseteachers` WRITE;
/*!40000 ALTER TABLE `courseteachers` DISABLE KEYS */;
/*!40000 ALTER TABLE `courseteachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cycles`
--

DROP TABLE IF EXISTS `cycles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cycles` (
  `CycleId` int NOT NULL AUTO_INCREMENT,
  `CycleDescription` varchar(45) DEFAULT NULL,
  `CyclesStartDate` date NOT NULL,
  `CyclesEndDate` date NOT NULL,
  PRIMARY KEY (`CycleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cycles`
--

LOCK TABLES `cycles` WRITE;
/*!40000 ALTER TABLE `cycles` DISABLE KEYS */;
/*!40000 ALTER TABLE `cycles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollments`
--

DROP TABLE IF EXISTS `enrollments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enrollments` (
  `StudentId` int DEFAULT NULL,
  `CourseId` int DEFAULT NULL,
  `CycleId` int DEFAULT NULL,
  `EnrollDate` date NOT NULL,
  `Cancelled` tinyint DEFAULT NULL,
  KEY `StudentId_idx` (`StudentId`),
  KEY `CourseId_idx` (`CourseId`),
  KEY `CycleId_idx` (`CycleId`),
  CONSTRAINT `EnrollmentsCourseId` FOREIGN KEY (`CourseId`) REFERENCES `courses` (`CourseId`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `EnrollmentsCycleId` FOREIGN KEY (`CycleId`) REFERENCES `cycles` (`CycleId`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `EnrollmentsStudentId` FOREIGN KEY (`StudentId`) REFERENCES `students` (`StudentId`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollments`
--

LOCK TABLES `enrollments` WRITE;
/*!40000 ALTER TABLE `enrollments` DISABLE KEYS */;
/*!40000 ALTER TABLE `enrollments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exams`
--

DROP TABLE IF EXISTS `exams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exams` (
  `CourseId` int DEFAULT NULL,
  `CycleId` int DEFAULT NULL,
  `TestNo` int NOT NULL AUTO_INCREMENT,
  `TestDate` date NOT NULL,
  `TestTime` time NOT NULL,
  PRIMARY KEY (`TestNo`),
  KEY `CourseId_idx` (`CourseId`),
  KEY `CycleId_idx` (`CycleId`),
  CONSTRAINT `ExamsCourseId` FOREIGN KEY (`CourseId`) REFERENCES `courses` (`CourseId`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `ExamsCycleId` FOREIGN KEY (`CycleId`) REFERENCES `cycles` (`CycleId`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exams`
--

LOCK TABLES `exams` WRITE;
/*!40000 ALTER TABLE `exams` DISABLE KEYS */;
/*!40000 ALTER TABLE `exams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examsgrades`
--

DROP TABLE IF EXISTS `examsgrades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `examsgrades` (
  `CourseId` int DEFAULT NULL,
  `CycleId` int DEFAULT NULL,
  `StudentId` int DEFAULT NULL,
  `TestNo` int NOT NULL,
  `Grade` decimal(5,2) NOT NULL,
  KEY `StudentId_idx` (`StudentId`),
  KEY `TestNo_idx` (`TestNo`),
  KEY `CourseId_idx` (`CourseId`),
  KEY `CycleId_idx` (`CycleId`),
  CONSTRAINT `ExamsGradesCourseId` FOREIGN KEY (`CourseId`) REFERENCES `courses` (`CourseId`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `ExamsGradesCycleId` FOREIGN KEY (`CycleId`) REFERENCES `cycles` (`CycleId`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `ExamsGradesStudentId` FOREIGN KEY (`StudentId`) REFERENCES `students` (`StudentId`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `ExamsGradesTestNo` FOREIGN KEY (`TestNo`) REFERENCES `exams` (`TestNo`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examsgrades`
--

LOCK TABLES `examsgrades` WRITE;
/*!40000 ALTER TABLE `examsgrades` DISABLE KEYS */;
/*!40000 ALTER TABLE `examsgrades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `StudentId` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(45) DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  PRIMARY KEY (`StudentId`),
  UNIQUE KEY `students_Email_UNIQUE` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Vbn','Bbnk','memo25885@gmail.com','1115486235','2023-04-18');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teachers` (
  `TeacherId` int NOT NULL AUTO_INCREMENT,
  `TeacherName` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Phone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`TeacherId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@course.com',NULL,'$2y$10$VBLxWBPprFLvW/lui1Xb8.T6WMVNM5SvIR/iZKsRcDPeqfVhXNpsi','sXMxS6FmI3FvKHWKOVf0nWw9ksH9P276pVwP5Turyxt0xWiVdH54n515fbQz','2023-04-26 19:38:47','2023-04-26 19:38:47');
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

-- Dump completed on 2023-04-28 19:56:34
