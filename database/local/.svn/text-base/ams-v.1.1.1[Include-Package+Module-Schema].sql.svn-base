/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.1.73 : Database - ams
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `campaign_batch_status` */

DROP TABLE IF EXISTS `campaign_batch_status`;

CREATE TABLE `campaign_batch_status` (
  `campaign_batch_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_id` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_updated_on` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`campaign_batch_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `campaign_batch_status` */

/*Table structure for table `campaign_batches` */

DROP TABLE IF EXISTS `campaign_batches`;

CREATE TABLE `campaign_batches` (
  `campaign_batch_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `campaign_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `template_id` bigint(20) DEFAULT NULL,
  `list_id` bigint(20) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `start_date` datetime DEFAULT NULL,
  `cut_off_date` date DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_updated_on` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`campaign_batch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `campaign_batches` */

/*Table structure for table `campaigns` */

DROP TABLE IF EXISTS `campaigns`;

CREATE TABLE `campaigns` (
  `campaign_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_updated_on` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`campaign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `campaigns` */

/*Table structure for table `contacts` */

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `contact_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `address` text COLLATE utf8_unicode_ci,
  `zipcode` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_updated_on` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `contacts` */

/*Table structure for table `contacts_meta` */

DROP TABLE IF EXISTS `contacts_meta`;

CREATE TABLE `contacts_meta` (
  `contacts_meta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `contact_type` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_value` text COLLATE utf8_unicode_ci,
  `created_on` datetime DEFAULT NULL,
  `last_updated_on` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`contacts_meta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `contacts_meta` */

/*Table structure for table `core_config` */

DROP TABLE IF EXISTS `core_config`;

CREATE TABLE `core_config` (
  `config_id` int(11) NOT NULL,
  `config_name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `config_value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `last_updated_by` int(11) NOT NULL,
  `last_updated_on` datetime NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `core_config` */

/*Table structure for table `elements` */

DROP TABLE IF EXISTS `elements`;

CREATE TABLE `elements` (
  `element_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `element_type` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `last_updated_on` datetime DEFAULT NULL,
  `last_updated_by` int(11) NOT NULL,
  PRIMARY KEY (`element_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `elements` */

insert  into `elements`(`element_id`,`title`,`element_type`,`created_on`,`created_by`,`last_updated_on`,`last_updated_by`) values (1,'Heading One','label','2014-12-30 14:22:43',1,NULL,0);

/*Table structure for table `fold_elements` */

DROP TABLE IF EXISTS `fold_elements`;

CREATE TABLE `fold_elements` (
  `fold_element_id` int(11) NOT NULL AUTO_INCREMENT,
  `fold_id` int(11) DEFAULT NULL,
  `element_id` bigint(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`fold_element_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `fold_elements` */

insert  into `fold_elements`(`fold_element_id`,`fold_id`,`element_id`,`created_on`,`created_by`) values (1,1,1,'2014-12-31 14:39:28',1);

/*Table structure for table `folds` */

DROP TABLE IF EXISTS `folds`;

CREATE TABLE `folds` (
  `fold_id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `last_updated_on` datetime NOT NULL,
  `last_updated_by` int(11) NOT NULL,
  PRIMARY KEY (`fold_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `folds` */

insert  into `folds`(`fold_id`,`template_id`,`title`,`description`,`image`,`created_on`,`created_by`,`last_updated_on`,`last_updated_by`) values (1,1,'Business Cards-Front','The side or part of an object that presents itself to view or that is normally seen or used first; the most forward part of something.',NULL,'2014-12-30 14:21:14',1,'0000-00-00 00:00:00',0),(2,1,'Business Cards-Back','The side or part of an object that presents itself to view or that is normally seen or used first; the most forward part of something.',NULL,'2014-12-30 16:09:29',1,'0000-00-00 00:00:00',0);

/*Table structure for table `list_members` */

DROP TABLE IF EXISTS `list_members`;

CREATE TABLE `list_members` (
  `list_member_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `list_id` int(11) DEFAULT NULL,
  `contact_id` bigint(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_updated_on` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`list_member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `list_members` */

/*Table structure for table `lists` */

DROP TABLE IF EXISTS `lists`;

CREATE TABLE `lists` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_updated_on` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `lists` */

/*Table structure for table `modules` */

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_updated_on` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `modules` */

insert  into `modules`(`module_id`,`title`,`description`,`created_on`,`created_by`,`last_updated_on`,`last_updated_by`) values (1,'CRM','Customer relationship management (CRM) is a system for managing a company\'s interactions with current and future customers. It often involves using technology to organize, automate and synchronize sales, marketing, customer service, and technical support.','2015-01-06 13:16:11',1,NULL,NULL);

/*Table structure for table `package_modules` */

DROP TABLE IF EXISTS `package_modules`;

CREATE TABLE `package_modules` (
  `package_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_updated_on` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`package_module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `package_modules` */

insert  into `package_modules`(`package_module_id`,`package_id`,`module_id`,`created_on`,`created_by`,`last_updated_on`,`last_updated_by`) values (1,20,1,'2015-01-06 09:47:48',1,NULL,NULL),(2,21,1,'2015-01-06 09:55:59',1,NULL,NULL);

/*Table structure for table `package_product_templates` */

DROP TABLE IF EXISTS `package_product_templates`;

CREATE TABLE `package_product_templates` (
  `package_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_updated_on` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`package_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `package_product_templates` */

insert  into `package_product_templates`(`package_detail_id`,`package_id`,`product_id`,`template_id`,`created_on`,`created_by`,`last_updated_on`,`last_updated_by`) values (1,1,1,1,'2015-01-02 02:37:25',1,NULL,NULL),(2,1,1,2,'2015-01-02 02:37:25',1,NULL,NULL),(3,1,3,3,'2015-01-02 02:37:25',1,NULL,NULL),(4,2,1,1,'2015-01-05 10:13:56',1,NULL,NULL),(5,5,1,1,'2015-01-05 02:52:06',1,NULL,NULL),(6,5,1,2,'2015-01-05 02:52:06',1,NULL,NULL),(7,5,3,3,'2015-01-05 02:52:06',1,NULL,NULL),(8,7,1,2,'2015-01-05 02:54:34',1,NULL,NULL),(9,8,1,1,'2015-01-05 03:01:07',1,NULL,NULL),(10,9,1,1,'2015-01-05 03:03:31',1,NULL,NULL),(11,9,1,2,'2015-01-05 03:03:31',1,NULL,NULL),(12,9,3,3,'2015-01-05 03:03:31',1,NULL,NULL),(13,10,3,3,'2015-01-05 03:12:25',1,NULL,NULL),(14,10,1,2,'2015-01-05 03:12:25',1,NULL,NULL),(15,11,1,1,'2015-01-06 08:27:16',1,NULL,NULL),(16,11,1,2,'2015-01-06 08:27:16',1,NULL,NULL),(17,12,3,3,'2015-01-06 08:31:26',1,NULL,NULL),(18,13,1,1,'2015-01-06 08:35:24',1,NULL,NULL),(19,13,1,2,'2015-01-06 08:35:24',1,NULL,NULL),(20,14,3,3,'2015-01-06 08:36:40',1,NULL,NULL),(21,15,3,3,'2015-01-06 08:41:02',1,NULL,NULL),(22,15,1,1,'2015-01-06 08:41:02',1,NULL,NULL),(23,15,1,2,'2015-01-06 08:41:02',1,NULL,NULL),(24,16,1,1,'2015-01-06 08:49:44',1,NULL,NULL),(25,16,1,2,'2015-01-06 08:49:44',1,NULL,NULL),(26,17,3,3,'2015-01-06 09:45:51',1,NULL,NULL),(27,18,3,3,'2015-01-06 09:47:16',1,NULL,NULL),(28,19,3,3,'2015-01-06 09:47:25',1,NULL,NULL),(29,20,3,3,'2015-01-06 09:47:48',1,NULL,NULL),(30,21,3,3,'2015-01-06 09:55:59',1,NULL,NULL);

/*Table structure for table `package_products` */

DROP TABLE IF EXISTS `package_products`;

CREATE TABLE `package_products` (
  `package_product_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `last_updated_on` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`package_product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `package_products` */

insert  into `package_products`(`package_product_id`,`package_id`,`product_id`,`created_on`,`created_by`,`last_updated_on`,`last_updated_by`) values (1,1,1,'2015-01-02 02:37:25',1,NULL,NULL),(2,1,3,'2015-01-02 02:37:25',1,NULL,NULL),(3,2,1,'2015-01-05 10:13:56',1,NULL,NULL),(4,3,3,'2015-01-05 01:08:06',1,NULL,NULL),(5,3,1,'2015-01-05 01:08:06',1,NULL,NULL),(6,4,1,'2015-01-05 01:08:40',1,NULL,NULL),(7,5,1,'2015-01-05 02:52:06',1,NULL,NULL),(8,5,3,'2015-01-05 02:52:06',1,NULL,NULL),(9,7,1,'2015-01-05 02:54:34',1,NULL,NULL),(10,8,1,'2015-01-05 03:01:07',1,NULL,NULL),(11,9,1,'2015-01-05 03:03:31',1,NULL,NULL),(12,9,3,'2015-01-05 03:03:31',1,NULL,NULL),(13,10,3,'2015-01-05 03:12:25',1,NULL,NULL),(14,10,1,'2015-01-05 03:12:25',1,NULL,NULL),(15,11,1,'2015-01-06 08:27:16',1,NULL,NULL),(16,12,3,'2015-01-06 08:31:26',1,NULL,NULL),(17,13,1,'2015-01-06 08:35:24',1,NULL,NULL),(18,14,3,'2015-01-06 08:36:40',1,NULL,NULL),(19,15,3,'2015-01-06 08:41:02',1,NULL,NULL),(20,15,1,'2015-01-06 08:41:02',1,NULL,NULL),(21,16,1,'2015-01-06 08:49:44',1,NULL,NULL),(22,17,3,'2015-01-06 09:45:51',1,NULL,NULL),(23,18,3,'2015-01-06 09:47:16',1,NULL,NULL),(24,19,3,'2015-01-06 09:47:25',1,NULL,NULL),(25,20,3,'2015-01-06 09:47:48',1,NULL,NULL),(26,21,3,'2015-01-06 09:55:59',1,NULL,NULL);

/*Table structure for table `packages` */

DROP TABLE IF EXISTS `packages`;

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(10) DEFAULT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `promotion_code` text COLLATE utf8_unicode_ci,
  `price` double NOT NULL,
  `currency` tinyint(10) NOT NULL,
  `charging_frequency` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(10) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `last_updated_on` datetime NOT NULL,
  `last_updated_by` int(11) NOT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `packages` */

insert  into `packages`(`package_id`,`type`,`title`,`description`,`promotion_code`,`price`,`currency`,`charging_frequency`,`status`,`created_on`,`created_by`,`last_updated_on`,`last_updated_by`) values (1,NULL,'gold++','golden pakagae',NULL,10,0,NULL,NULL,'2015-01-02 02:37:25',1,'0000-00-00 00:00:00',0),(2,NULL,'dsad','sadsad',NULL,10,0,NULL,NULL,'2015-01-05 10:13:56',1,'0000-00-00 00:00:00',0),(3,NULL,'11','2222',NULL,10,0,NULL,NULL,'2015-01-05 01:08:06',1,'0000-00-00 00:00:00',0),(4,NULL,'sdas','asd',NULL,10,0,NULL,NULL,'2015-01-05 01:08:40',1,'0000-00-00 00:00:00',0),(5,NULL,'asd','saa',NULL,10,0,NULL,NULL,'2015-01-05 02:52:06',1,'0000-00-00 00:00:00',0),(6,NULL,'sad','asd',NULL,10,0,NULL,NULL,'2015-01-05 02:53:49',1,'0000-00-00 00:00:00',0),(7,NULL,'asdas','dasdasd',NULL,10,0,NULL,NULL,'2015-01-05 02:54:34',1,'0000-00-00 00:00:00',0),(8,NULL,'sad','sada',NULL,10,0,NULL,NULL,'2015-01-05 03:01:07',1,'0000-00-00 00:00:00',0),(9,NULL,'sad','asda',NULL,10,0,NULL,NULL,'2015-01-05 03:03:31',1,'0000-00-00 00:00:00',0),(10,NULL,'sadas','sad',NULL,10,0,NULL,NULL,'2015-01-05 03:12:25',1,'0000-00-00 00:00:00',0),(11,NULL,'sadsad','asda',NULL,10,0,NULL,NULL,'2015-01-06 08:27:16',1,'0000-00-00 00:00:00',0),(12,NULL,'eqwe','qwe',NULL,10,0,NULL,NULL,'2015-01-06 08:31:26',1,'0000-00-00 00:00:00',0),(13,NULL,'asd','asdas',NULL,10,0,NULL,NULL,'2015-01-06 08:35:24',1,'0000-00-00 00:00:00',0),(14,NULL,'asd','sada',NULL,10,0,NULL,NULL,'2015-01-06 08:36:40',1,'0000-00-00 00:00:00',0),(15,NULL,'asda','asda',NULL,10,0,NULL,NULL,'2015-01-06 08:41:02',1,'0000-00-00 00:00:00',0),(16,NULL,'asdasd','asd',NULL,10,0,NULL,NULL,'2015-01-06 08:49:44',1,'0000-00-00 00:00:00',0),(17,NULL,'sadad','dasd',NULL,100,0,NULL,NULL,'2015-01-06 09:45:51',1,'0000-00-00 00:00:00',0),(18,NULL,'sadad','dasd',NULL,100,0,NULL,NULL,'2015-01-06 09:47:16',1,'0000-00-00 00:00:00',0),(19,NULL,'sadad','dasd',NULL,100,0,NULL,NULL,'2015-01-06 09:47:25',1,'0000-00-00 00:00:00',0),(20,NULL,'sadad','dasd',NULL,100,0,NULL,NULL,'2015-01-06 09:47:48',1,'0000-00-00 00:00:00',0),(21,NULL,'sdsa','dsad',NULL,100,0,NULL,NULL,'2015-01-06 09:55:59',1,'0000-00-00 00:00:00',0);

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price_matrix_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `last_updated_on` datetime NOT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`product_id`,`title`,`description`,`price_matrix_id`,`created_on`,`created_by`,`last_updated_on`,`last_updated_by`,`is_active`) values (1,'Cards','a piece of thick, stiff paper or thin pasteboard, in particular one used for writing or printing on.',0,'2014-12-29 18:09:27',1,'0000-00-00 00:00:00',NULL,1),(3,'Envelopes','A flat paper container with a sealable flap, used to enclose a letter or document.',0,'2014-12-30 14:15:58',1,'0000-00-00 00:00:00',NULL,1),(4,'Brochures','A brochure is a flyer, pamphlet or leaflet that is used to pass information about something. Brochures are advertising pieces mainly used to introduce a company or organization and inform about products and/or services to a target audience.',0,'2014-12-30 14:16:00',0,'0000-00-00 00:00:00',NULL,1);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`role_id`,`title`,`created_on`) values (1,'Administrator','2014-12-29 17:55:31'),(2,'Subscriber','2014-12-29 17:55:50');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`session_id`,`ip_address`,`user_agent`,`last_activity`,`user_data`) values ('21d4f5dd488e6f88e4e4d859e7026902','192.175.3.217','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',1420556621,'a:2:{s:9:\"user_data\";s:0:\"\";s:16:\"LoggedInUserData\";a:7:{s:7:\"user_id\";s:1:\"1\";s:7:\"role_id\";s:1:\"1\";s:10:\"first_name\";s:5:\"Super\";s:9:\"last_name\";s:13:\"Administrator\";s:10:\"package_id\";s:1:\"0\";s:5:\"email\";s:15:\"admin@admin.com\";s:9:\"logged_in\";b:1;}}');

/*Table structure for table `template_content` */

DROP TABLE IF EXISTS `template_content`;

CREATE TABLE `template_content` (
  `template_content_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `campaign_batch_id` bigint(20) DEFAULT NULL,
  `template_id` bigint(20) DEFAULT NULL,
  `fold_id` int(50) NOT NULL,
  `element_id` int(11) NOT NULL,
  `element_data` mediumtext COLLATE utf8_unicode_ci,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_updatd_on` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`template_content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `template_content` */

/*Table structure for table `templates` */

DROP TABLE IF EXISTS `templates`;

CREATE TABLE `templates` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `printing_price` float NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `cut_off_date` datetime DEFAULT NULL,
  `status` tinyint(10) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `last_updated_on` datetime NOT NULL,
  `last_updated_by` int(11) NOT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `templates` */

insert  into `templates`(`template_id`,`product_id`,`title`,`description`,`printing_price`,`width`,`height`,`cut_off_date`,`status`,`created_on`,`created_by`,`last_updated_on`,`last_updated_by`) values (1,1,'Business Cards','This is a sample business card of a fixed layout.',1,250,350,NULL,NULL,'2014-12-29 18:12:10',1,'0000-00-00 00:00:00',0),(2,1,'Wedding Cards','This is a sample wedding card of a fixed layout.',1.5,400,550,NULL,NULL,'2014-12-30 14:13:43',1,'0000-00-00 00:00:00',0),(3,3,'Envelopes 1','This is a sample wedding card of a fixed layout.',34,500,550,NULL,NULL,'2015-01-02 18:03:56',1,'0000-00-00 00:00:00',0),(4,400,'Brochures 1','This is a sample wedding card of a fixed layout.',232,500,550,NULL,NULL,'2015-01-02 18:03:58',1,'0000-00-00 00:00:00',0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `package_id` int(11) NOT NULL,
  `account_type` tinyint(5) DEFAULT '1',
  `first_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8_unicode_ci,
  `joined_on` datetime DEFAULT NULL,
  `promotion_code` text COLLATE utf8_unicode_ci,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`user_id`,`role_id`,`package_id`,`account_type`,`first_name`,`last_name`,`email`,`password`,`joined_on`,`promotion_code`,`last_login`) values (1,1,0,0,'Super','Administrator','admin@admin.com','21232f297a57a5a743894a0e4a801fc3','2014-12-29 17:57:46',NULL,'2015-01-06 08:04:52'),(2,2,1,1,'Umair','Ahmed','umair.ahmed@ephlux.com','e10adc3949ba59abbe56e057f20f883e','2014-12-29 18:04:20',NULL,NULL),(3,2,2,2,'Shoaib','Ahmed','shoaib@ephlux.com','e10adc3949ba59abbe56e057f20f883e','2014-12-29 18:05:04',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
