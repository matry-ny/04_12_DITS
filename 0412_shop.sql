-- MySQL dump 10.16  Distrib 10.1.25-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: 0412_shop
-- ------------------------------------------------------
-- Server version	10.1.25-MariaDB

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
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (1,'Joan Roaling'),(2,'Den Brown');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cathegories`
--

DROP TABLE IF EXISTS `cathegories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cathegories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cathegories`
--

LOCK TABLES `cathegories` WRITE;
/*!40000 ALTER TABLE `cathegories` DISABLE KEYS */;
INSERT INTO `cathegories` VALUES (3,'Anime'),(1,'Fantasy'),(2,'Horror');
/*!40000 ALTER TABLE `cathegories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `fk-product_images-product_id-products-id` (`product_id`),
  CONSTRAINT `fk-product_images-product_id-products-id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (1,'Chrysanthemum.jpg','dc93e62dd2bd5ce2f1ac1ec1eb0dea5d.jpg',40),(2,'Desert - ?????.jpg','6ac3560c87c76a6ea08b1086bd63ca16.jpg',40),(3,'Desert.jpg','9f528e37254a012f519cb55464c0fb8d.jpg',40);
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_to_cathegory`
--

DROP TABLE IF EXISTS `product_to_cathegory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_to_cathegory` (
  `product_id` int(11) DEFAULT NULL,
  `cathegory_id` int(11) DEFAULT NULL,
  KEY `fk-product_to_cathegory-product_id-products-id` (`product_id`),
  KEY `fk-products_to_cathegory-cathegory_id-cathegories-id` (`cathegory_id`),
  CONSTRAINT `fk-product_to_cathegory-product_id-products-id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-products_to_cathegory-cathegory_id-cathegories-id` FOREIGN KEY (`cathegory_id`) REFERENCES `cathegories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_to_cathegory`
--

LOCK TABLES `product_to_cathegory` WRITE;
/*!40000 ALTER TABLE `product_to_cathegory` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_to_cathegory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk-products-author_id-authors-id` (`author_id`),
  CONSTRAINT `fk-products-author_id-authors-id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Harry Potter and The Smart Stone',1,20.00,'2019-01-15 20:10:09'),(2,'Harry Potter PART 2',1,19.99,'2019-01-15 20:24:18'),(3,'Harry Potter PART 3',1,76.25,'2019-01-15 20:24:18'),(4,'Code DaVinchi',2,35.55,'2019-01-15 21:43:15'),(13,'Angels And Demons',2,123.00,'2019-01-24 21:40:01'),(14,'Angels And Demons 2',2,123.00,'2019-01-24 21:40:10'),(15,'Angels And Demons 2',2,123.00,'2019-01-24 21:40:21'),(17,'Angels and Demons',2,123.00,'2019-01-24 21:42:05'),(18,'Inferno',2,231.25,'2019-01-24 21:42:47'),(19,'Angels and Demons',2,123.00,'2019-01-24 21:48:16'),(20,'Angels and Demons',2,123.00,'2019-01-24 21:51:13'),(21,'Angels and Demons',2,123.00,'2019-01-24 21:51:19'),(23,'Angels and Demons',2,123.00,'2019-01-24 21:57:06'),(24,'Audi A8',1,21.25,'2019-01-24 21:57:09'),(25,'Audi A8',1,123.00,'2019-01-31 21:33:47'),(26,'Audi A8',1,123.00,'2019-01-31 21:36:17'),(27,'Audi A8',1,123.00,'2019-01-31 21:37:18'),(28,'Audi A8',1,123.00,'2019-01-31 21:40:07'),(29,'Audi A8',1,123.00,'2019-01-31 21:45:46'),(30,'Audi A8',1,123.00,'2019-01-31 21:50:33'),(31,'Audi A8',1,123.00,'2019-01-31 21:51:05'),(32,'Audi A8',1,123.00,'2019-01-31 21:51:19'),(33,'Audi A8',1,123.00,'2019-01-31 21:51:21'),(34,'Audi A8',1,123.00,'2019-01-31 21:51:22'),(35,'Audi A8',1,123.00,'2019-01-31 21:51:24'),(36,'Audi A8',1,123.00,'2019-01-31 21:51:26'),(37,'Audi A8',1,123.00,'2019-01-31 21:54:19'),(38,'Audi A8',1,123.00,'2019-01-31 21:54:40'),(39,'Audi A8',1,123.00,'2019-01-31 22:00:56'),(40,'Audi A8',1,123.00,'2019-01-31 22:01:59');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'dkotenko','$2y$10$qAHkEqnUZ7SIZKLOUPAPLuV/cQ7onOzHS3qnnpULCC2CY/AibajS6');
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

-- Dump completed on 2019-02-05 19:38:11
