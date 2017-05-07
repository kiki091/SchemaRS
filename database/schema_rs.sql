-- MySQL dump 10.13  Distrib 5.7.13, for linux-glibc2.5 (x86_64)
--
-- Host: 127.0.0.1    Database: schema_rs
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(45) DEFAULT NULL,
  `foto_images` varchar(100) DEFAULT NULL,
  `fullname` varchar(65) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `street` text,
  `districts` varchar(50) DEFAULT NULL COMMENT 'indo:kecamatan',
  `city` varchar(50) DEFAULT NULL COMMENT 'indo:kota',
  `province` varchar(50) DEFAULT NULL COMMENT 'indo:provinsi',
  `phone_number` varchar(15) DEFAULT NULL,
  `education` varchar(10) DEFAULT NULL,
  `religion` int(1) DEFAULT NULL COMMENT '1:Islam, 2:Kristen Katolik, 3:Kristen Protestan, 4:Hindu, 5:Budha, 6:Lainnya',
  `place_of_birth` varchar(55) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `specialist` varchar(40) DEFAULT NULL,
  `marital_status` varchar(45) DEFAULT NULL,
  `citizen` int(2) DEFAULT NULL COMMENT '1:WNI, 2:WNA',
  `country` varchar(40) DEFAULT NULL,
  `poliklinik_id` int(5) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nik_UNIQUE` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_schedule`
--

DROP TABLE IF EXISTS `doctor_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(15) DEFAULT NULL,
  `hour_of_entry` time DEFAULT NULL,
  `hour_of_out` time DEFAULT NULL,
  `description` text,
  `doctor_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_jadwal_dokter_1_idx` (`doctor_id`),
  CONSTRAINT `fk_doctor_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_schedule`
--

LOCK TABLES `doctor_schedule` WRITE;
/*!40000 ALTER TABLE `doctor_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctor_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history_disease`
--

DROP TABLE IF EXISTS `history_disease`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history_disease` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_of_felt` text COMMENT 'id:keluhan',
  `diagnosis` text,
  `actions` enum('0','1','2','3') DEFAULT NULL COMMENT '- 0 = Rawat Jalan\n- 1 = Rawat Inap\n- 2 = Rujukan RS Lain\n- 3 = Meninggal',
  `medical_record_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_history_disease_1_idx` (`medical_record_id`),
  CONSTRAINT `fk_history_disease_1` FOREIGN KEY (`medical_record_id`) REFERENCES `medical_records` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history_disease`
--

LOCK TABLES `history_disease` WRITE;
/*!40000 ALTER TABLE `history_disease` DISABLE KEYS */;
/*!40000 ALTER TABLE `history_disease` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_records`
--

DROP TABLE IF EXISTS `medical_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medical_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` varchar(45) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `patient_status` varchar(10) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `polyclinic_id` int(5) DEFAULT NULL,
  `follow_up` enum('0','1','2','3') DEFAULT NULL COMMENT '- 0 = Rawat Jalan\n- 1 = Rawat Inap\n- 2 = Rujukan RS Lain\n- 3 = Meninggal',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_medical_records_1_idx` (`patient_id`),
  KEY `fk_medical_records_2_idx` (`doctor_id`),
  KEY `fk_medical_records_3_idx` (`polyclinic_id`),
  CONSTRAINT `fk_medical_records_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_medical_records_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_medical_records_3` FOREIGN KEY (`polyclinic_id`) REFERENCES `policlinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_records`
--

LOCK TABLES `medical_records` WRITE;
/*!40000 ALTER TABLE `medical_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `medical_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_records_detail`
--

DROP TABLE IF EXISTS `medical_records_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medical_records_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medical_records_id` int(11) DEFAULT NULL,
  `medicament_id` int(11) DEFAULT NULL COMMENT 'id:obat id',
  `quantity_of_medicament` int(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_medical_records_detail_1_idx` (`medical_records_id`),
  KEY `fk_medical_records_detail_2_idx` (`medicament_id`),
  CONSTRAINT `fk_medical_records_detail_1` FOREIGN KEY (`medical_records_id`) REFERENCES `medical_records` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_medical_records_detail_2` FOREIGN KEY (`medicament_id`) REFERENCES `medicament` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_records_detail`
--

LOCK TABLES `medical_records_detail` WRITE;
/*!40000 ALTER TABLE `medical_records_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `medical_records_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicament`
--

DROP TABLE IF EXISTS `medicament`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicament` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medicament_code` varchar(45) DEFAULT NULL COMMENT 'Kode Obat',
  `medicament_name` varchar(65) DEFAULT NULL COMMENT 'Nama Obat',
  `how_to_use` varchar(45) DEFAULT NULL COMMENT 'Aturan pakai',
  `at_moment` enum('Sesudah Makan','Sebelum Makan') DEFAULT NULL COMMENT '1: Sesudah Makan\n2: Sebelum Makan',
  `quantity` varchar(20) DEFAULT NULL COMMENT 'Jumlah Obat (/pac)',
  `production_date` datetime DEFAULT NULL COMMENT 'Tanggal Produksi',
  `expired_date` datetime DEFAULT NULL COMMENT 'Tanggal Kadarluarsa',
  `category_diseases` varchar(45) DEFAULT NULL COMMENT 'Kategori Penyakit',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicament`
--

LOCK TABLES `medicament` WRITE;
/*!40000 ALTER TABLE `medicament` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicament` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_05_04_162153_create_items_table',1),(4,'2017_05_04_162206_entrust_setup_tables',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nurse`
--

DROP TABLE IF EXISTS `nurse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nurse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(45) DEFAULT NULL,
  `foto_images` varchar(100) DEFAULT NULL,
  `fullname` varchar(65) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `street` text,
  `districts` varchar(50) DEFAULT NULL COMMENT 'indo:kecamatan',
  `city` varchar(50) DEFAULT NULL COMMENT 'indo:kota',
  `province` varchar(50) DEFAULT NULL COMMENT 'indo:provinsi',
  `phone_number` varchar(15) DEFAULT NULL,
  `education` varchar(10) DEFAULT NULL,
  `place_of_birth` varchar(55) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `religion` int(1) DEFAULT NULL COMMENT '1:Islam, 2:Kristen Katolik, 3:Kristen Protestan, 4:Hindu, 5:Budha, 6:Lainnya',
  `specialist` varchar(40) DEFAULT NULL,
  `marital_status` varchar(45) DEFAULT NULL,
  `citizen` int(2) DEFAULT NULL COMMENT '1:WNI, 2:WNA',
  `country` varchar(40) DEFAULT NULL,
  `policlinic_id` int(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nik_UNIQUE` (`nik`),
  KEY `fk_perawat_1_idx` (`policlinic_id`),
  CONSTRAINT `fk_perawat_1` FOREIGN KEY (`policlinic_id`) REFERENCES `policlinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nurse`
--

LOCK TABLES `nurse` WRITE;
/*!40000 ALTER TABLE `nurse` DISABLE KEYS */;
/*!40000 ALTER TABLE `nurse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nurse_schedule`
--

DROP TABLE IF EXISTS `nurse_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nurse_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(15) DEFAULT NULL,
  `hour_of_entry` time DEFAULT NULL,
  `hour_of_out` time DEFAULT NULL,
  `week` int(1) DEFAULT NULL,
  `month` varchar(2) DEFAULT NULL,
  `description` text,
  `nurse_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nurse_idx` (`nurse_id`),
  CONSTRAINT `fk_nurse` FOREIGN KEY (`nurse_id`) REFERENCES `nurse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nurse_schedule`
--

LOCK TABLES `nurse_schedule` WRITE;
/*!40000 ALTER TABLE `nurse_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `nurse_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(45) DEFAULT NULL,
  `fullname` varchar(70) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `place_of_birth` varchar(60) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `height` int(3) DEFAULT NULL,
  `weight` int(3) DEFAULT NULL,
  `street` text,
  `districts` varchar(50) DEFAULT NULL COMMENT 'indo:kecamatan',
  `city` varchar(50) DEFAULT NULL COMMENT 'indo:kota',
  `province` varchar(50) DEFAULT NULL COMMENT 'indo:provinsi',
  `age` int(2) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `description` text,
  `religion` int(1) DEFAULT NULL COMMENT '1:Islam, 2:Kristen Katolik, 3:Kristen Protestan, 4:Hindu, 5:Budha, 6:Lainnya',
  `education` varchar(10) DEFAULT NULL COMMENT '1: SD, 2:SMP, 3:SMA, 4:D3, 5:S1, 6:S2, 7:S3',
  `blood` varchar(2) DEFAULT NULL,
  `work` varchar(40) DEFAULT NULL,
  `citizen` int(1) DEFAULT NULL COMMENT '1:WNI, 2:WNA',
  `country` varchar(40) DEFAULT NULL,
  `marital_status` varchar(45) DEFAULT NULL,
  `registration_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nik_UNIQUE` (`nik`),
  KEY `fk_pasien_1_idx` (`registration_id`),
  CONSTRAINT `fk_pasien_1` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'role-list','Display Role Listing','See only Listing Of Role','2017-05-04 09:42:03','2017-05-04 09:42:03'),(2,'role-create','Create Role','Create New Role','2017-05-04 09:42:03','2017-05-04 09:42:03'),(3,'role-edit','Edit Role','Edit Role','2017-05-04 09:42:03','2017-05-04 09:42:03'),(4,'role-delete','Delete Role','Delete Role','2017-05-04 09:42:03','2017-05-04 09:42:03');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `policlinic`
--

DROP TABLE IF EXISTS `policlinic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `policlinic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `policlinic_name` varchar(45) DEFAULT NULL,
  `rooms_id` int(5) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_poliklinik_1_idx` (`rooms_id`),
  CONSTRAINT `fk_poliklinik_1` FOREIGN KEY (`rooms_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `policlinic`
--

LOCK TABLES `policlinic` WRITE;
/*!40000 ALTER TABLE `policlinic` DISABLE KEYS */;
/*!40000 ALTER TABLE `policlinic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(45) DEFAULT NULL,
  `users_id` int(3) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `registration_number_UNIQUE` (`registration_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration`
--

LOCK TABLES `registration` WRITE;
/*!40000 ALTER TABLE `registration` DISABLE KEYS */;
/*!40000 ALTER TABLE `registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registration_inpatient`
--

DROP TABLE IF EXISTS `registration_inpatient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registration_inpatient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) DEFAULT NULL,
  `person_in_charge` varchar(55) DEFAULT NULL COMMENT 'penanggung jawab',
  `relation_family` varchar(45) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `type_reference` int(1) DEFAULT NULL COMMENT '1: Kemauan Sendiri\n2: Rujukan Rs Lain\n3: Rujukan Internal',
  `complaint_of_felt` text,
  `registration_note` text,
  `room_care_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_registration_inpatient_1_idx` (`registration_id`),
  KEY `fk_registration_inpatient_2_idx` (`room_care_id`),
  KEY `fk_registration_inpatient_3_idx` (`doctor_id`),
  CONSTRAINT `fk_registration_inpatient_1` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_registration_inpatient_2` FOREIGN KEY (`room_care_id`) REFERENCES `room_care` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_registration_inpatient_3` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration_inpatient`
--

LOCK TABLES `registration_inpatient` WRITE;
/*!40000 ALTER TABLE `registration_inpatient` DISABLE KEYS */;
/*!40000 ALTER TABLE `registration_inpatient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_care`
--

DROP TABLE IF EXISTS `room_care`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room_care` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_number` varchar(55) DEFAULT NULL,
  `class` varchar(10) DEFAULT NULL,
  `capacity` int(2) DEFAULT NULL,
  `cost` varchar(45) DEFAULT NULL,
  `rooms_id` int(5) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_kamar_inap_1_idx` (`rooms_id`),
  CONSTRAINT `fk_kamar_inap_1` FOREIGN KEY (`rooms_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_care`
--

LOCK TABLES `room_care` WRITE;
/*!40000 ALTER TABLE `room_care` DISABLE KEYS */;
/*!40000 ALTER TABLE `room_care` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flor` int(2) DEFAULT NULL,
  `rooms_number` varchar(45) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_ruangan_UNIQUE` (`rooms_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'kiki','sheqbo@gmail.com','$2y$10$jWqW0ETc23XTaaDtjktAw.XRvdet5BnBHauvmJLPBCWNfbyvI3YNy','admin','Qeh7yfy0vyKPEZhKIpN5S1IzW7dELx2qsr3iIlWPpNag5hwVcOTzUfq8RA0F',1,'2017-05-04 09:58:53','2017-05-04 09:58:53'),(2,'admin','admin@mail.com','$2y$10$jWqW0ETc23XTaaDtjktAw.XRvdet5BnBHauvmJLPBCWNfbyvI3YNy','admin',NULL,1,'2017-05-04 09:58:53','2017-05-04 09:58:53'),(3,'fikri','fikri@mail.com','$2y$10$jWqW0ETc23XTaaDtjktAw.XRvdet5BnBHauvmJLPBCWNfbyvI3YNy','apoteker',NULL,1,'2017-05-04 09:58:53','2017-05-04 09:58:53');
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

-- Dump completed on 2017-05-07 20:23:01
