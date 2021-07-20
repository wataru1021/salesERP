-- MySQL dump 10.14  Distrib 5.5.64-MariaDB, for Linux (x86_64)
--
-- Host: mysql5002.xserver.jp    Database: gameagelayer_serp
-- ------------------------------------------------------
-- Server version	5.7.27

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
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '企業名',
  `manager_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '担当者名',
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '郵便番号',
  `prefecture_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '都道府県ID',
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '市区町村',
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '番地',
  `building_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '物件名、部屋番号',
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '電話番号',
  `status` tinyint(4) DEFAULT '1' COMMENT 'ステータス（0:無効、1:有効）',
  `plan_id` tinyint(4) DEFAULT '1' COMMENT 'プランID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_template`
--

DROP TABLE IF EXISTS `email_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_template` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_template`
--

LOCK TABLES `email_template` WRITE;
/*!40000 ALTER TABLE `email_template` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_template` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2020_03_12_111400_create_email_template_table',1),(2,'2021_07_02_092156_create_users_table',1),(3,'2021_07_02_094610_create_companies_table',1),(4,'2021_07_02_095203_create_roles_table',1),(5,'2021_07_02_095501_create_prefectures_table',1),(6,'2021_07_02_095704_create_sale_daily_reports_table',1),(7,'2021_07_05_034631_change_column_created_at_from_sale_daily_reports_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prefectures`
--

DROP TABLE IF EXISTS `prefectures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prefectures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '都道府県名',
  `order_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '表示順',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prefectures`
--

LOCK TABLES `prefectures` WRITE;
/*!40000 ALTER TABLE `prefectures` DISABLE KEYS */;
/*!40000 ALTER TABLE `prefectures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '権限名',
  `order_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '表示順',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
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
-- Table structure for table `sale_daily_reports`
--

DROP TABLE IF EXISTS `sale_daily_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sale_daily_reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL COMMENT 'ユーザーID',
  `report_date` date NOT NULL COMMENT '日報',
  `ping_pong_num` bigint(20) NOT NULL DEFAULT '0' COMMENT 'ピンポン数（訪問件数）',
  `meet_num` int(11) NOT NULL DEFAULT '0' COMMENT '対面数',
  `deal_num` int(11) NOT NULL DEFAULT '0' COMMENT '商談数',
  `acquisitions_num` int(11) NOT NULL DEFAULT '0' COMMENT '獲得数',
  `sale_time` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '稼働時間（時間）※休憩時間は含まない',
  `conscious_point` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '今日意識した点',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '報告時間',
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale_daily_reports`
--

LOCK TABLES `sale_daily_reports` WRITE;
/*!40000 ALTER TABLE `sale_daily_reports` DISABLE KEYS */;
INSERT INTO `sale_daily_reports` VALUES (1,1,'2021-07-14',2000,2000,2000,2000,10.50,'a\r\na\r\na','2021-07-14 02:14:28','2021-07-14 02:17:25',NULL),(2,1,'2021-07-15',70,50,25,2,8.00,'テスト','2021-07-14 21:07:53','2021-07-14 21:07:53',NULL),(3,24,'2021-07-16',33,8,3,2,11.50,'12345678aaaaaa','2021-07-16 01:01:16','2021-07-16 01:34:28',NULL),(4,1,'2021-07-16',11,11,11,11,111.00,'111','2021-07-16 04:02:50','2021-07-16 04:02:50',NULL),(5,24,'2021-07-19',80,30,40,57,60.50,'今日意識した点','2021-07-18 19:51:36','2021-07-19 01:41:05',NULL),(6,24,'2021-07-20',333,80,30,20,105.00,'今日意識した点今日意識した点今日意識した点','2021-07-20 03:33:42','2021-07-20 03:33:42',NULL);
/*!40000 ALTER TABLE `sale_daily_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ユーザー名',
  `role_id` bigint(20) NOT NULL COMMENT '権限',
  `company_id` bigint(20) DEFAULT NULL COMMENT '企業',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'メールアドレス',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'パスワード',
  `tel` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '電話番号',
  `status` tinyint(4) DEFAULT NULL COMMENT 'ステータス',
  `last_login_at` datetime DEFAULT NULL COMMENT '最終ログイン時刻',
  `reset_password_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_password_token_expire` datetime DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'営業マンA',2,1,'pacocha.gayle@example.net','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','eXwIK9lnxp',NULL,'RRn2cUqpNKlCP7Gk8NP62BW071I82aWnfGNFgqXmrZf7O8xN7Zqs2ixy6Q2F','2021-07-13 00:05:25','2021-07-19 15:22:33',NULL),(2,'営業マンB',2,1,'burdette.hoeger@example.net','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','rlIfLFZwME',NULL,'CgedrV6hqj','2021-07-13 00:05:25','2021-07-19 15:22:45',NULL),(3,'営業マンC',2,1,'maxime77@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','OoeogndbA3',NULL,'PzR1DzqKKF','2021-07-13 00:05:25','2021-07-19 15:22:54',NULL),(4,'営業マンD',2,1,'mateo27@example.net','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','mhyHiUkpsw',NULL,'wKcfRpAH7h','2021-07-13 00:05:25','2021-07-19 15:24:00',NULL),(5,'営業マンE',2,1,'jalyn.mccullough@example.org','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','CozHyUYfIm',NULL,'O4NVxGqbVD','2021-07-13 00:05:25','2021-07-19 15:24:52',NULL),(6,'営業マンF',2,1,'predovic.gordon@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','zKPCn3MVOG',NULL,'NBAKy2tSeS','2021-07-13 00:05:25','2021-07-19 15:25:03',NULL),(7,'営業マンG',2,1,'hjohns@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','91hfQ7TNGB',NULL,'H9oAYgiNgK','2021-07-13 00:05:25','2021-07-19 15:25:13',NULL),(8,'営業マンH',2,1,'halie.corwin@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','Y22QbOFNpP',NULL,'kaC302n3Z9','2021-07-13 00:05:25','2021-07-19 15:25:28',NULL),(9,'営業マンI',2,1,'stewart95@example.org','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','FkC1fAVYgv',NULL,'6lrwz9GQgH','2021-07-13 00:05:25','2021-07-19 15:25:41',NULL),(10,'Electa Hettinger',2,1,'schaden.shanie@example.net','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','G7hWNNDsWH',NULL,'ynifNCIehU','2021-07-13 00:05:25','2021-07-14 01:25:29','2021-07-14 01:25:29'),(11,'Kimberly Reinger',1,1,'goodwin.bernice@example.org','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','MxnKSN0ZNx',NULL,'Mbob4Q3NGjAEt8rMHxFnpQurNp9V5X2i80XcwaAmI3aonPn5bqK0ei3Kr1ii','2021-07-13 00:05:25',NULL,NULL),(12,'Beatrice Kautzer',1,1,'seth49@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','PNIRopnBsU',NULL,'3EXhON1CST','2021-07-13 00:05:25',NULL,NULL),(13,'Vernice Graham III',1,1,'marquise82@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','UJEDx1hXDt',NULL,'AkTr73JP9l','2021-07-13 00:05:25',NULL,NULL),(14,'Dr. Providenci Denesik DDS',1,1,'rau.callie@example.net','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','wsUhx40tDo',NULL,'shtyJdizBu','2021-07-13 00:05:25',NULL,NULL),(15,'Dr. Milan Schultz III',1,1,'fbayer@example.net','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','1G3Jnl7l3T',NULL,'8uECo43RQV','2021-07-13 00:05:25',NULL,NULL),(16,'Adell Corwin',1,1,'hbartoletti@example.org','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','FR9pBka6KG',NULL,'GxVXD2Z1cb','2021-07-13 00:05:25',NULL,NULL),(17,'Catherine Pouros',1,1,'adams.carmelo@example.net','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','CinUK8PYVh',NULL,'qCfWowT3SJ','2021-07-13 00:05:25',NULL,NULL),(18,'Mr. Dimitri Treutel',1,1,'harber.ayden@example.org','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','s5mF48gOgC',NULL,'ZPgXIStddC','2021-07-13 00:05:25',NULL,NULL),(19,'Dr. Chauncey Swaniawski III',1,1,'helga.torphy@example.org','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','ASYF5jJWtP',NULL,'T7MzKupGsN','2021-07-13 00:05:25',NULL,NULL),(20,'Prof. Timmothy Koelpin',1,1,'breitenberg.reggie@example.org','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-13 09:05:25','542RbEvkeh',NULL,'tlOOhcMIiQ','2021-07-13 00:05:25',NULL,NULL),(21,'manager',1,1,'manager@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-14 05:01:08','bbfa7fc85c9efe2600b2185f3d5abec222c136678adb848d662fcd3444d06c7b4017d3f10704fe95eccc1db448be3679900320f4c43b2d811a88a66aefaef8bf','2021-07-17 08:37:26','wFrzpXZsKSx07Yfp2vUPvX3lG6b50Un9eZo6LxMIsFd5k0Mvle9MoIrSwzx1','2021-07-13 20:01:08','2021-07-15 23:37:26',NULL),(22,'営業マンJ',2,1,'sales@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'2021-07-14 05:01:08','zLBVkt45lK',NULL,'cbUzujrqdxi7VWdDZhC1NqYlqpUgKGtClinOWwnIa52nwwI3eteqggFNOnJx','2021-07-13 20:01:08','2021-07-19 15:26:05',NULL),(23,'Test',1,1,'ngocdh94@gmail.com','$2y$10$ofIcAkW5Pvf7fiaxBIhz1.6/GLMEUA0O4nyemibQbEtaejseS5UTu',NULL,NULL,NULL,'a97d131fba5767adab49a991b393dee979be8b26de03cf5a6df9c11cfc550786db62934c32bd6d992a44b4b21243dba4b0bfb81695af545c63a9a8ab56874075','2021-07-20 10:35:36',NULL,'2021-07-15 22:14:24','2021-07-19 01:36:42',NULL),(24,'営業マンK',2,1,'shinichikudokid1412@gmail.com','$2y$10$QC0HvkiGCBVnTQZMv9RUI.Rco4sMcefax6UVRHDu3v2fAzLj4xTi6',NULL,NULL,NULL,'d06407cd2d5c603c0de4c61f336cb7910f33186b3ff7ad2bf40728d7df2836b43e65ecbf90c055209b0992c4d4fda50e706b81756ed19b7f3298f41cc260a835','2021-07-20 04:16:23',NULL,'2021-07-16 00:36:59','2021-07-19 15:26:18',NULL),(25,'営業マンL',2,1,'wataru01q.game@gmail.com','$2y$10$oR7XS3MfzJ3PMZTm34CMJOS3wWd2DBgYYNQFGi9Qa.4W0h19soxja',NULL,NULL,NULL,NULL,NULL,NULL,'2021-07-18 14:13:16','2021-07-19 15:26:33',NULL),(26,'営業マンM',2,1,'testt@gmail.com','$2y$10$nikWbZSJOZ4mdEF4DtUpKOzygkEw7NBgYKI8Jwc0HXYh/OowIrwhW',NULL,NULL,NULL,NULL,NULL,NULL,'2021-07-18 18:17:38','2021-07-19 15:32:33',NULL),(27,'営業マンN',2,1,'abc@gmail.com','$2y$10$bMmkppqjCaso5q46lbXmCeyDNrSKxiJ.bpN5fUuZbVXy2ofbIKig.',NULL,NULL,NULL,NULL,NULL,NULL,'2021-07-18 19:07:29','2021-07-19 15:34:19',NULL),(28,'quyet_admin',1,1,'ngocquyet0610@gmail.com','$2y$10$oIGvsZiaotgmri4.N.2CLOj9Ig.6hX3UALbpdmF7Llcs5MgYs6bse',NULL,NULL,NULL,'b4cb9e5b10077fade3c9256adc4320a2950e37dcd2e6adc844421486c994dbac420f8397af43fb52d076dfb6622e914a7707614157dab472dab030b280ce9be9','2021-07-20 06:34:53',NULL,'2021-07-18 21:33:32','2021-07-18 21:34:53',NULL),(29,'a',2,1,'a@gmail.comaaaaa','$2y$10$MwDhCVUhoALlkcjmLbNbtuLOaLcKFv23sOLDS0wiEzHhO.XxAgTRq',NULL,NULL,NULL,NULL,NULL,NULL,'2021-07-20 03:48:08','2021-07-20 04:25:53','2021-07-20 04:25:53');
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

-- Dump completed on 2021-07-20 20:10:25
