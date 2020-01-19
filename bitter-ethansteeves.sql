CREATE DATABASE  IF NOT EXISTS `bitter-ethansteeves` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bitter-ethansteeves`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: bitter-ethansteeves
-- ------------------------------------------------------
-- Server version	5.7.26

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
-- Table structure for table `follows`
--

DROP TABLE IF EXISTS `follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `follows` (
  `follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  PRIMARY KEY (`follow_id`),
  KEY `FK_follows` (`from_id`),
  KEY `FK_follows2` (`to_id`),
  CONSTRAINT `FK_follows` FOREIGN KEY (`from_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `FK_follows2` FOREIGN KEY (`to_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follows`
--

LOCK TABLES `follows` WRITE;
/*!40000 ALTER TABLE `follows` DISABLE KEYS */;
INSERT INTO `follows` VALUES (13,33,36),(14,33,37),(15,33,38),(16,33,35),(17,33,46),(18,36,46),(19,36,42),(20,36,33),(21,35,33),(22,35,41),(23,35,36),(24,33,42),(25,33,34),(26,34,33),(27,34,36),(28,40,33),(29,35,38);
/*!40000 ALTER TABLE `follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`like_id`),
  KEY `FK_tweet_id_idx` (`tweet_id`),
  KEY `FK_user_id_idx` (`user_id`),
  CONSTRAINT `FK_tweet_id` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`tweet_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (7,47,35,'2019-12-05 19:03:16'),(8,51,35,'2019-12-05 19:03:23'),(9,52,33,'2019-12-05 19:03:40'),(10,53,35,'2019-12-05 19:51:51');
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message_text` varchar(255) NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_toid_idx` (`id`,`from_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (7,33,34,'Some Message here','2019-12-04 18:22:59'),(8,33,33,'Some Message here','2019-12-04 18:24:05'),(9,33,33,'test','2019-12-04 18:25:13'),(10,33,33,'another','2019-12-04 18:26:40'),(11,35,33,'work','2019-12-04 18:46:37'),(12,33,33,'','2019-12-06 16:48:07');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tweets`
--

DROP TABLE IF EXISTS `tweets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tweets` (
  `tweet_id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_text` varchar(280) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `original_tweet_id` int(11) NOT NULL DEFAULT '0',
  `reply_to_tweet_id` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tweet_id`),
  KEY `FK_tweets` (`user_id`),
  CONSTRAINT `FK_tweets` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tweets`
--

LOCK TABLES `tweets` WRITE;
/*!40000 ALTER TABLE `tweets` DISABLE KEYS */;
INSERT INTO `tweets` VALUES (42,'I am bitter today',33,0,0,'2019-11-08 02:18:35'),(43,'I am also bitter',36,0,0,'2019-11-08 02:18:53'),(44,'Stop being bitter',35,0,43,'2019-11-08 02:19:11'),(45,'Another tweet today',35,0,0,'2019-11-08 02:32:55'),(46,'Just checking',35,0,0,'2019-11-08 02:33:07'),(47,'First tweet',33,0,0,'2019-11-08 02:38:00'),(48,'Second tweet',35,0,47,'2019-11-08 02:38:16'),(49,'Third Tweet',35,0,48,'2019-11-08 02:47:18'),(50,'Third Tweet',35,49,0,'2019-11-08 02:50:59'),(51,'retweet',33,0,50,'2019-11-19 21:48:06'),(52,'show up',33,0,50,'2019-11-19 21:48:31'),(53,'test tweet',33,0,0,'2019-12-05 19:15:46'),(54,'test tweet',33,53,0,'2019-12-05 19:15:55'),(55,'test tweet',35,53,0,'2019-12-05 19:16:49'),(56,'First tweet',35,47,0,'2019-12-05 21:59:01'),(57,'a reply should show',34,0,54,'2019-12-06 00:35:55'),(58,'test tweet',33,54,0,'2019-12-06 16:29:41');
/*!40000 ALTER TABLE `tweets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `screen_name` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `address` varchar(200) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postal_code` varchar(7) NOT NULL,
  `contact_number` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `url` varchar(50) NOT NULL,
  `description` varchar(160) NOT NULL,
  `location` varchar(50) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profile_pic` varchar(200) DEFAULT 'Images/profilepics/default.jfif',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (33,'e','e','e','$2y$10$..bEMSOp1aL9b/IWd1KYlOxTPSka5zju9nzm1FQVPaRpws.g.hqVm','e','Alberta','T7N 1A0','(506)2384547','ethansteeves@gmail.com','e','e','Fredericton','2019-10-21 12:25:58','Images/profilepics/33.jpg'),(34,'Nick','Taggart','Nick','$2y$10$A8PD/0Iefr0z9J69lBqWYeoP8Qswa2YZPaG.MNTLLNkU2lzAxl1n2','26 Duffie Dr','New Brunswick','E3B 0R6','(506)444-3234','nick.taggart@nbcc.ca','nbcc.ca','Teacher','Fredericton','2019-10-21 15:29:05','Images/profilepics/34.jpeg'),(35,'Ethan','Steeves','Ethan','$2y$10$kTB3VaSUr.S1jTZjlFV/3O10qEYi3sOOcMsOkDbsCnF9l1lxcawUy','1067 York St','New Brunswick','e3b 3s4','(506)2384547','ethansteeves@gmail.com','ethan_steeves.com','Student','Fredericton','2019-10-21 15:30:42','Images/profilepics/35.jpeg'),(36,'Test','Test','Test','$2y$10$4e9W4MJCTIBBmUTSPRf1TutvwZ.PRa9VeEDoutmVbjZK4zDeMFT06','5 test st','Ontario','L0R 1B0','(555)5555555','test@test.test','test.com','Test','Test','2019-10-21 15:33:16','Images/profilepics/36.jpeg'),(37,'Tico','Dog','Tico','$2y$10$JCCt9DJcqtTzqIqRpcrE8.ZVdSQteKJLHyF9VOKKGWCG2hLk9PvXS','Dog House','New Brunswick','e3b 3s4','(506)1234567','ticodog@dogmail.com','tico.com','Im a Dog','Parks','2019-10-22 14:58:18','Images/profilepics/37.jpeg'),(38,'Tundra','Dog','Tundra','$2y$10$UIXngBWhQaWM1vzbu8kQ2.Hwl0EZDy5lTF.u.vTcMJ9ALYFnAPYEC','1067 York St','New Brunswick','e3b 3s4','(506)3568003','ima@tuntun.dog','tuntun.dog','Im a tun tun','Fredericton','2019-10-22 16:02:16','Images/profilepics/38.jpeg'),(40,'New','new','new','$2y$10$mtEa6VTCjyfzFLkut3eXeenRulKJr8Wo3MDctxIrCgmjSrmujxFJe','new st','Prince Edward Island','C1A 1M0','(506)2385656','new@new.com','new.com','i\'m new','her','2019-10-23 17:58:14','Images/profilepics/40.jpeg'),(41,'Person','Person','Person','$2y$10$M/cHq7hCQ89EfnNHTJyVueEAk7.cNfCU.aWhxL/DQhIen8EHNZgVG','Person st','Prince Edward Island','C1A 1M0','(506)555-6666','person@person.com','person.com','Person','Person','2019-10-25 17:39:53','Images/profilepics/default.jfif'),(42,'Donald','Trump','Donald','$2y$10$SOe7gSq2vEuN8mLSivzRa.5ey2LqRBR73BUXnZ85Gd1j3oV5vApUK','Trump Tower','Alberta','T7N 1A0','(555)2313465','donaldTrump@trumpmail.com','trump.com','I\'m Donald','Trump Tower','2019-11-01 11:03:36','Images/profilepics/default.jfif'),(46,'User','User','User','$2y$10$B536PdC338k24/MtIVlesuZ3ART3DX46mbXjQODl964Nb56TZ47jG','user st','Yukon','Y1A 2B0','(111)111-1111','user@user.com','user.com','I\'m a user','User','2019-11-01 11:27:41','Images/profilepics/default.jfif'),(66,'e','@','eth','$2y$10$3lT7gjZXyTBTNO/.nKfd0eRrCnl3eGVn1g7lUVVjodr9WJC9t0KIu','e','New Brunswick','e3b 3s4','5062384547','e@e.e','e','e','e','2019-11-30 20:32:34','Images/profilepics/default.jfif');
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

-- Dump completed on 2019-12-06 13:06:49
