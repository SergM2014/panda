# ************************************************************
# Antares - SQL Client
# Version 0.7.2
# 
# https://antares-sql.app/
# https://github.com/antares-sql/antares
# 
# Host: 127.0.0.1 (MySQL Community Server - GPL 8.0.32)
# Database: panda
# Generation time: 2023-01-28T17:44:51+02:00
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table surveys
# ------------------------------------------------------------

DROP TABLE IF EXISTS `surveys`;

CREATE TABLE `surveys` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `responses` json NOT NULL,
  `results` json NOT NULL,
  `status` enum('draft','published') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_UFOJ` (`user_id`),
  CONSTRAINT `FK_UFOJ` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;

INSERT INTO `surveys` (`id`, `user_id`, `header`, `responses`, `results`, `status`, `created_at`) VALUES
	(3, 1, "rrrupdated2", "{\"0\":\"updated response\",\"1\":\"added response\"}", "{\"0\":12230,\"1\":0}", "published", "2023-01-27 14:19:13"),
	(5, 1, "rrrupdated reale", "{\"0\":\"updated response\"}", "{\"0\":12777}", "draft", "2023-01-27 17:22:06"),
	(6, 1, "updated", "{\"0\":\"updated response\",\"1\":\"new new new\"}", "{\"0\":1223,\"1\":33}", "published", "2023-01-27 17:22:41"),
	(7, 1, "rrrupdated", "{\"0\":\"updated response\"}", "{\"0\":1223}", "draft", "2023-01-27 17:24:53"),
	(8, 1, "rrrupdated", "{\"0\":\"updated response\"}", "{\"0\":1223}", "draft", "2023-01-27 17:26:23"),
	(9, 1, "new test survey", "{\"0\":\"eee\",\"1\":\"www\",\"2\":\"www\"}", "{\"0\":0,\"1\":0,\"2\":0}", "published", "2023-01-28 12:13:07"),
	(10, 1, "the next", "{\"0\":\"ededdddddddd\",\"1\":\"gg\"}", "{\"0\":55,\"1\":3}", "published", "2023-01-28 15:26:01");

/*!40000 ALTER TABLE `surveys` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`) VALUES
	(1, "weisse011@gmail.com", "$2y$10$rhXXFbDpMuM6Kk/LmS8TOOr41bl6tAzY9vGNZUZK3VuimkvuU/wQO"),
	(2, "adm@qwe.qwe", "$2y$10$PMer3uoDU3HQCxSRX7WlwO9gRp1Zvl/zbkmpNtqZ5XReiRYuamzcC");

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of views
# ------------------------------------------------------------

# Creating temporary tables to overcome VIEW dependency errors


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# Dump completed on 2023-01-28T17:44:52+02:00
