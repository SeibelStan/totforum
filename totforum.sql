-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: totforum
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1

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
-- Table structure for table `nodes`
--

DROP TABLE IF EXISTS `nodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes` (
  `id` varchar(16) NOT NULL,
  `thread` varchar(16) NOT NULL,
  `author` varchar(16) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` varchar(3000) NOT NULL,
  `edited` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nodes`
--

LOCK TABLES `nodes` WRITE;
/*!40000 ALTER TABLE `nodes` DISABLE KEYS */;
INSERT INTO `nodes` VALUES ('541b77cc70109','541b77cc700cb','541a2b572c656','2014-09-19 00:24:44','Начисто!',1),('541b77d18c27f','541b77cc700cb','541a2b572c656','2014-09-19 00:24:49','И сообщение',0),('541b77d58ab31','541b77cc700cb','541a2b572c656','2014-09-19 00:24:53','И ещё',0),('541b77dd2d031','541b77cc700cb','541a2b572c656','2014-09-19 00:25:01','До него удалили',0),('541f7f475ad3b','541f7f475acf8','541a2b572c656','2014-09-22 01:45:43','dsadsad',1),('541f7f499794b','541f7f475acf8','541a2b572c656','2014-09-22 01:45:45','dsad',0),('541f80ff12764','541b77cc700cb','541a2b572c656','2014-09-22 01:53:03','вывыв!',1);
/*!40000 ALTER TABLE `nodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` int(2) NOT NULL,
  `title` varchar(100) NOT NULL,
  `access` int(1) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (0,'Раздел 1',2),(1,'Раздел 2',2),(2,'Раздел 3',1),(3,'Админский',0);
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `threads` (
  `id` varchar(16) NOT NULL,
  `author` varchar(16) NOT NULL,
  `section` varchar(16) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(100) NOT NULL,
  `closed` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `threads`
--

LOCK TABLES `threads` WRITE;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
INSERT INTO `threads` VALUES ('541b77cc700cb','541a2b572c656','0','2014-09-19 00:24:44','Новая тема',0),('541f7f475acf8','541a2b572c656','2','2014-09-22 01:45:43','dsa',0);
/*!40000 ALTER TABLE `threads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` varchar(16) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `bdate` varchar(10) NOT NULL,
  `rdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rules` int(1) NOT NULL DEFAULT '2',
  `contacts` varchar(500) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'assets/img/nophoto.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('541a2b572c656','seibel.stan@ya.ru','Станислав','24.11.1992','2014-09-18 00:46:15',0,'Skype: seibel.stan\nVK: seibel.stan\nICQ: 333333\nOK: 275088875947\ne-mail: seibel.stan@ya.ru\ngplus: 113135657467799764415\ntel: +7 777 778 8455\nInstagram: masha_malinovskaya\nTwitter: mashakruglyhina\nYoutube: onashemoglavnom','c652dd1cb23e1988816966d2e6bbe0bc','http://cs617525.vk.me/v617525024/17435/Sz3rxef4EW4.jpg'),('541a41c0cf2ad','seibel.stan@gmail.com','Ещё один Станислав','24.11.1992','2014-09-18 02:21:52',2,'Нету','f373a9a82616e0798d3571be65e5dee0','http://clubfile.net/files/images/kartinka_1.jpg'),('541b2b0b9f558','totnetot91@gmail.com','Тот Нетотов','1.04.1991','2014-09-18 18:57:15',1,'','801ac09c80a82f2126991dc8de195140','http://r29.imgfast.net/users/2916/35/83/56/avatars/243-88.gif');
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

-- Dump completed on 2014-09-27  0:00:01
