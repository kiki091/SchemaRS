-- MySQL dump 10.13  Distrib 5.7.13, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: schema_rs
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.2

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
-- Table structure for table `dokter`
--

DROP TABLE IF EXISTS `dokter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dokter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(45) DEFAULT NULL,
  `nama_lengkap` varchar(65) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `status_penduduk` varchar(40) DEFAULT NULL,
  `alamat` text,
  `no_telpon` varchar(15) DEFAULT NULL,
  `pendidikan_terakhir` varchar(10) DEFAULT NULL,
  `tempat_lahir` varchar(55) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `spesialis` varchar(40) DEFAULT NULL,
  `status_perkawinan` varchar(45) DEFAULT NULL,
  `poli_id` int(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nik_UNIQUE` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokter`
--

LOCK TABLES `dokter` WRITE;
/*!40000 ALTER TABLE `dokter` DISABLE KEYS */;
/*!40000 ALTER TABLE `dokter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jadwal_dokter`
--

DROP TABLE IF EXISTS `jadwal_dokter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jadwal_dokter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hari` varchar(15) DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `keterangan` text,
  `dokter_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_jadwal_dokter_1_idx` (`dokter_id`),
  CONSTRAINT `fk_jadwal_dokter_1` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal_dokter`
--

LOCK TABLES `jadwal_dokter` WRITE;
/*!40000 ALTER TABLE `jadwal_dokter` DISABLE KEYS */;
/*!40000 ALTER TABLE `jadwal_dokter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jadwal_perawat`
--

DROP TABLE IF EXISTS `jadwal_perawat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jadwal_perawat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hari` varchar(15) DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `keterangan` text,
  `minggu` int(1) DEFAULT NULL,
  `bulan` varchar(15) DEFAULT NULL,
  `perawat_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal_perawat`
--

LOCK TABLES `jadwal_perawat` WRITE;
/*!40000 ALTER TABLE `jadwal_perawat` DISABLE KEYS */;
/*!40000 ALTER TABLE `jadwal_perawat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kamar_inap`
--

DROP TABLE IF EXISTS `kamar_inap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kamar_inap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kamar` varchar(55) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `kapasitas` int(2) DEFAULT NULL,
  `biaya` varchar(45) DEFAULT NULL,
  `ruang_id` int(5) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_kamar_inap_1_idx` (`ruang_id`),
  CONSTRAINT `fk_kamar_inap_1` FOREIGN KEY (`ruang_id`) REFERENCES `ruangan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kamar_inap`
--

LOCK TABLES `kamar_inap` WRITE;
/*!40000 ALTER TABLE `kamar_inap` DISABLE KEYS */;
/*!40000 ALTER TABLE `kamar_inap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pasien`
--

DROP TABLE IF EXISTS `pasien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pasien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(45) DEFAULT NULL,
  `nama_lengkap` varchar(70) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `tempat_lahir` varchar(60) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tinggi_badan` int(3) DEFAULT NULL,
  `berat_badan` int(3) DEFAULT NULL,
  `alamat` text,
  `umur` int(2) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `no_tlp` varchar(15) DEFAULT NULL,
  `keterangan` text,
  `agama` varchar(25) DEFAULT NULL,
  `pendidikan` varchar(10) DEFAULT NULL,
  `gol_darah` varchar(2) DEFAULT NULL,
  `pekerjaan` varchar(40) DEFAULT NULL,
  `status_penduduk` varchar(40) DEFAULT NULL,
  `negara` varchar(40) DEFAULT NULL,
  `pendaftaran_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nik_UNIQUE` (`nik`),
  KEY `fk_pasien_1_idx` (`pendaftaran_id`),
  CONSTRAINT `fk_pasien_1` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasien`
--

LOCK TABLES `pasien` WRITE;
/*!40000 ALTER TABLE `pasien` DISABLE KEYS */;
/*!40000 ALTER TABLE `pasien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pendaftaran`
--

DROP TABLE IF EXISTS `pendaftaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(45) DEFAULT NULL,
  `users_id` int(3) DEFAULT NULL,
  `tanggal_pendaftaran` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `registration_number_UNIQUE` (`registration_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendaftaran`
--

LOCK TABLES `pendaftaran` WRITE;
/*!40000 ALTER TABLE `pendaftaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `pendaftaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perawat`
--

DROP TABLE IF EXISTS `perawat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perawat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(45) DEFAULT NULL,
  `nama_lengkap` varchar(65) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `status_penduduk` varchar(10) DEFAULT NULL,
  `alamat` text,
  `no_telpon` varchar(15) DEFAULT NULL,
  `pendidikan_terakhir` varchar(10) DEFAULT NULL,
  `tempat_lahir` varchar(55) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `spesialis` varchar(40) DEFAULT NULL,
  `status_perkawinan` varchar(45) DEFAULT NULL,
  `poli_id` int(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nik_UNIQUE` (`nik`),
  KEY `fk_perawat_1_idx` (`poli_id`),
  CONSTRAINT `fk_perawat_1` FOREIGN KEY (`poli_id`) REFERENCES `poliklinik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perawat`
--

LOCK TABLES `perawat` WRITE;
/*!40000 ALTER TABLE `perawat` DISABLE KEYS */;
/*!40000 ALTER TABLE `perawat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poliklinik`
--

DROP TABLE IF EXISTS `poliklinik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poliklinik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_poliklinik` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `ruangan_id` int(5) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_poliklinik_1_idx` (`ruangan_id`),
  CONSTRAINT `fk_poliklinik_1` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poliklinik`
--

LOCK TABLES `poliklinik` WRITE;
/*!40000 ALTER TABLE `poliklinik` DISABLE KEYS */;
/*!40000 ALTER TABLE `poliklinik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rekam_medis`
--

DROP TABLE IF EXISTS `rekam_medis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rekam_medis` (
  `id` int(11) NOT NULL,
  `pasien_id` int(11) DEFAULT NULL,
  `dokter_id` int(11) DEFAULT NULL,
  `poliklinik_id` int(5) DEFAULT NULL,
  `tindak_lanjut` enum('0','1') DEFAULT NULL COMMENT '- 0 = Rawat Jalan\n- 1 = Rawat Inap',
  `keluhan` text,
  `diagnosa` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rekam_medis`
--

LOCK TABLES `rekam_medis` WRITE;
/*!40000 ALTER TABLE `rekam_medis` DISABLE KEYS */;
/*!40000 ALTER TABLE `rekam_medis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rekam_medis_detail`
--

DROP TABLE IF EXISTS `rekam_medis_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rekam_medis_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rekam_medis_id` int(11) DEFAULT NULL,
  `obat_id` int(11) DEFAULT NULL,
  `jumlah_obat` int(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rekam_medis_detail_1_idx` (`rekam_medis_id`),
  CONSTRAINT `fk_rekam_medis_detail_1` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rekam_medis_detail`
--

LOCK TABLES `rekam_medis_detail` WRITE;
/*!40000 ALTER TABLE `rekam_medis_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `rekam_medis_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ruangan`
--

DROP TABLE IF EXISTS `ruangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lantai` int(2) DEFAULT NULL,
  `no_ruangan` varchar(45) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_ruangan_UNIQUE` (`no_ruangan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ruangan`
--

LOCK TABLES `ruangan` WRITE;
/*!40000 ALTER TABLE `ruangan` DISABLE KEYS */;
/*!40000 ALTER TABLE `ruangan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-01 22:33:35
