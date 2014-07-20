-- MySQL dump 10.13  Distrib 5.5.34, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: alvestar
-- ------------------------------------------------------
-- Server version	5.5.34-0ubuntu0.13.04.1

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
-- Table structure for table `wp_commentmeta`
--

DROP TABLE IF EXISTS `wp_commentmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_commentmeta`
--

LOCK TABLES `wp_commentmeta` WRITE;
/*!40000 ALTER TABLE `wp_commentmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_commentmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_comments`
--

DROP TABLE IF EXISTS `wp_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_comments`
--

LOCK TABLES `wp_comments` WRITE;
/*!40000 ALTER TABLE `wp_comments` DISABLE KEYS */;
INSERT INTO `wp_comments` VALUES (1,1,'Sr. WordPress','','http://wordpress.org/','','2014-07-18 18:06:41','2014-07-18 18:06:41','Olá, Isto é um comentário.\nPara excluir um comentário, faça o login e veja os comentários de posts. Lá você terá a opção de editá-los ou excluí-los.',0,'1','','',0,0);
/*!40000 ALTER TABLE `wp_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_links`
--

DROP TABLE IF EXISTS `wp_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_links`
--

LOCK TABLES `wp_links` WRITE;
/*!40000 ALTER TABLE `wp_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_options`
--

DROP TABLE IF EXISTS `wp_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_options`
--

LOCK TABLES `wp_options` WRITE;
/*!40000 ALTER TABLE `wp_options` DISABLE KEYS */;
INSERT INTO `wp_options` VALUES (1,'siteurl','http://localhost/alvestar','yes'),(2,'blogname','Alvestar Reformas','yes'),(3,'blogdescription','Só mais um site WordPress','yes'),(4,'users_can_register','0','yes'),(5,'admin_email','pereiracruz2002@gmail.com','yes'),(6,'start_of_week','0','yes'),(7,'use_balanceTags','0','yes'),(8,'use_smilies','1','yes'),(9,'require_name_email','1','yes'),(10,'comments_notify','1','yes'),(11,'posts_per_rss','10','yes'),(12,'rss_use_excerpt','0','yes'),(13,'mailserver_url','mail.example.com','yes'),(14,'mailserver_login','login@example.com','yes'),(15,'mailserver_pass','password','yes'),(16,'mailserver_port','110','yes'),(17,'default_category','1','yes'),(18,'default_comment_status','open','yes'),(19,'default_ping_status','open','yes'),(20,'default_pingback_flag','1','yes'),(21,'posts_per_page','10','yes'),(22,'date_format','j \\d\\e F \\d\\e Y','yes'),(23,'time_format','H:i','yes'),(24,'links_updated_date_format','j \\d\\e F \\d\\e Y, H:i','yes'),(25,'links_recently_updated_prepend','<em>','yes'),(26,'links_recently_updated_append','</em>','yes'),(27,'links_recently_updated_time','120','yes'),(28,'comment_moderation','0','yes'),(29,'moderation_notify','1','yes'),(30,'permalink_structure','','yes'),(31,'gzipcompression','0','yes'),(32,'hack_file','0','yes'),(33,'blog_charset','UTF-8','yes'),(34,'moderation_keys','','no'),(35,'active_plugins','a:0:{}','yes'),(36,'home','http://localhost/alvestar','yes'),(37,'category_base','','yes'),(38,'ping_sites','http://rpc.pingomatic.com/','yes'),(39,'advanced_edit','0','yes'),(40,'comment_max_links','2','yes'),(41,'gmt_offset','0','yes'),(42,'default_email_category','1','yes'),(43,'recently_edited','','no'),(44,'template','limo','yes'),(45,'stylesheet','limo','yes'),(46,'comment_whitelist','1','yes'),(47,'blacklist_keys','','no'),(48,'comment_registration','0','yes'),(49,'html_type','text/html','yes'),(50,'use_trackback','0','yes'),(51,'default_role','subscriber','yes'),(52,'db_version','26691','yes'),(53,'uploads_use_yearmonth_folders','1','yes'),(54,'upload_path','','yes'),(55,'blog_public','1','yes'),(56,'default_link_category','2','yes'),(57,'show_on_front','posts','yes'),(58,'tag_base','','yes'),(59,'show_avatars','1','yes'),(60,'avatar_rating','G','yes'),(61,'upload_url_path','','yes'),(62,'thumbnail_size_w','150','yes'),(63,'thumbnail_size_h','150','yes'),(64,'thumbnail_crop','1','yes'),(65,'medium_size_w','300','yes'),(66,'medium_size_h','300','yes'),(67,'avatar_default','mystery','yes'),(68,'large_size_w','1024','yes'),(69,'large_size_h','1024','yes'),(70,'image_default_link_type','file','yes'),(71,'image_default_size','','yes'),(72,'image_default_align','','yes'),(73,'close_comments_for_old_posts','0','yes'),(74,'close_comments_days_old','14','yes'),(75,'thread_comments','1','yes'),(76,'thread_comments_depth','5','yes'),(77,'page_comments','0','yes'),(78,'comments_per_page','50','yes'),(79,'default_comments_page','newest','yes'),(80,'comment_order','asc','yes'),(81,'sticky_posts','a:0:{}','yes'),(82,'widget_categories','a:2:{i:2;a:4:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:12:\"hierarchical\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}','yes'),(83,'widget_text','a:0:{}','yes'),(84,'widget_rss','a:0:{}','yes'),(85,'uninstall_plugins','a:0:{}','no'),(86,'timezone_string','','yes'),(87,'page_for_posts','0','yes'),(88,'page_on_front','0','yes'),(89,'default_post_format','0','yes'),(90,'link_manager_enabled','0','yes'),(91,'initial_db_version','26691','yes'),(92,'wp_user_roles','a:5:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:62:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:9:\"add_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}}','yes'),(93,'widget_search','a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}','yes'),(94,'widget_recent-posts','a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}','yes'),(95,'widget_recent-comments','a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}','yes'),(96,'widget_archives','a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}','yes'),(97,'widget_meta','a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}','yes'),(98,'sidebars_widgets','a:9:{s:19:\"wp_inactive_widgets\";a:0:{}s:12:\"contact-form\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:17:\"map-right-sidebar\";N;s:7:\"footer1\";N;s:7:\"footer2\";N;s:7:\"footer3\";N;s:7:\"footer4\";N;s:9:\"sidebar-1\";N;s:13:\"array_version\";i:3;}','yes'),(99,'cron','a:5:{i:1405879604;a:3:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1405879791;a:1:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1405885620;a:1:{s:20:\"wp_maybe_auto_update\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1405902235;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}s:7:\"version\";i:2;}','yes'),(101,'_site_transient_update_core','O:8:\"stdClass\":4:{s:7:\"updates\";a:6:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:7:\"upgrade\";s:8:\"download\";s:65:\"https://downloads.wordpress.org/release/pt_BR/wordpress-3.9.1.zip\";s:6:\"locale\";s:5:\"pt_BR\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:65:\"https://downloads.wordpress.org/release/pt_BR/wordpress-3.9.1.zip\";s:10:\"no_content\";b:0;s:11:\"new_bundled\";b:0;s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"3.9.1\";s:7:\"version\";s:5:\"3.9.1\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"3.8\";s:15:\"partial_version\";s:0:\"\";}i:1;O:8:\"stdClass\":10:{s:8:\"response\";s:7:\"upgrade\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-3.9.1.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-3.9.1.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-3.9.1-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-3.9.1-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"3.9.1\";s:7:\"version\";s:5:\"3.9.1\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"3.8\";s:15:\"partial_version\";s:0:\"\";}i:2;O:8:\"stdClass\":10:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:65:\"https://downloads.wordpress.org/release/pt_BR/wordpress-3.9.1.zip\";s:6:\"locale\";s:5:\"pt_BR\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:65:\"https://downloads.wordpress.org/release/pt_BR/wordpress-3.9.1.zip\";s:10:\"no_content\";b:0;s:11:\"new_bundled\";b:0;s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"3.9.1\";s:7:\"version\";s:5:\"3.9.1\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"3.8\";s:15:\"partial_version\";s:0:\"\";}i:3;O:8:\"stdClass\":10:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:63:\"https://downloads.wordpress.org/release/pt_BR/wordpress-3.9.zip\";s:6:\"locale\";s:5:\"pt_BR\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:63:\"https://downloads.wordpress.org/release/pt_BR/wordpress-3.9.zip\";s:10:\"no_content\";b:0;s:11:\"new_bundled\";b:0;s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:3:\"3.9\";s:7:\"version\";s:3:\"3.9\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"3.8\";s:15:\"partial_version\";s:0:\"\";}i:4;O:8:\"stdClass\":10:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:65:\"https://downloads.wordpress.org/release/pt_BR/wordpress-3.8.3.zip\";s:6:\"locale\";s:5:\"pt_BR\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:65:\"https://downloads.wordpress.org/release/pt_BR/wordpress-3.8.3.zip\";s:10:\"no_content\";b:0;s:11:\"new_bundled\";b:0;s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"3.8.3\";s:7:\"version\";s:5:\"3.8.3\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"3.8\";s:15:\"partial_version\";s:0:\"\";}i:5;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:65:\"https://downloads.wordpress.org/release/pt_BR/wordpress-3.8.2.zip\";s:6:\"locale\";s:5:\"pt_BR\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:65:\"https://downloads.wordpress.org/release/pt_BR/wordpress-3.8.2.zip\";s:10:\"no_content\";b:0;s:11:\"new_bundled\";b:0;s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"3.8.2\";s:7:\"version\";s:5:\"3.8.2\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"3.8\";s:15:\"partial_version\";s:0:\"\";s:12:\"notify_email\";s:1:\"1\";}}s:12:\"last_checked\";i:1405857582;s:15:\"version_checked\";s:5:\"3.8.1\";s:12:\"translations\";a:0:{}}','yes'),(106,'_site_transient_timeout_browser_1564c83f163c4dbfafb7384ebe95b8f4','1406311612','yes'),(107,'_site_transient_browser_1564c83f163c4dbfafb7384ebe95b8f4','a:9:{s:8:\"platform\";s:5:\"Linux\";s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:13:\"36.0.1985.125\";s:10:\"update_url\";s:28:\"http://www.google.com/chrome\";s:7:\"img_src\";s:49:\"http://s.wordpress.org/images/browsers/chrome.png\";s:11:\"img_src_ssl\";s:48:\"https://wordpress.org/images/browsers/chrome.png\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;}','yes'),(108,'can_compress_scripts','0','yes'),(126,'theme_mods_twentyfourteen','a:1:{s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1405706996;s:4:\"data\";a:4:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:9:\"sidebar-2\";a:0:{}s:9:\"sidebar-3\";a:0:{}}}}','yes'),(127,'current_theme','Limo WP','yes'),(128,'theme_mods_Liberation','a:2:{i:0;b:0;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1405707363;s:4:\"data\";a:2:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}}}}','yes'),(129,'theme_switched','','yes'),(130,'theme_mods_Edu','a:8:{i:0;b:0;s:16:\"background_color\";s:6:\"ddc79f\";s:16:\"background_image\";s:0:\"\";s:17:\"background_repeat\";s:6:\"repeat\";s:21:\"background_position_x\";s:4:\"left\";s:21:\"background_attachment\";s:5:\"fixed\";s:18:\"nav_menu_locations\";a:1:{s:9:\"secondary\";i:2;}s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1405813299;s:4:\"data\";a:7:{s:19:\"wp_inactive_widgets\";a:0:{}s:15:\"sidebar_primary\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:17:\"sidebar_secondary\";N;s:8:\"footer_1\";N;s:8:\"footer_2\";N;s:8:\"footer_3\";N;s:8:\"footer_4\";N;}}}','yes'),(131,'edu_theme_options','a:79:{s:20:\"themater_logo_source\";s:4:\"text\";s:4:\"logo\";s:63:\"http://localhost/alvestar/wp-content/themes/Edu/images/logo.png\";s:10:\"site_title\";s:17:\"Alvestar Reformas\";s:16:\"site_description\";s:17:\"Reformas em geral\";s:7:\"favicon\";s:66:\"http://localhost/alvestar/wp-content/themes/Edu/images/favicon.png\";s:18:\"contact_form_email\";s:25:\"pereiracruz2002@gmail.com\";s:9:\"read_more\";s:9:\"Leia Mais\";s:20:\"featured_image_width\";s:3:\"200\";s:21:\"featured_image_height\";s:3:\"160\";s:23:\"featured_image_position\";s:9:\"alignleft\";s:27:\"featured_image_width_single\";s:3:\"300\";s:28:\"featured_image_height_single\";s:3:\"225\";s:30:\"featured_image_position_single\";s:9:\"alignleft\";s:18:\"footer_custom_text\";s:0:\"\";s:14:\"footer_widgets\";s:4:\"true\";s:7:\"rss_url\";s:0:\"\";s:10:\"custom_css\";s:0:\"\";s:9:\"head_code\";s:0:\"\";s:11:\"footer_code\";s:0:\"\";s:21:\"featuredposts_enabled\";a:1:{i:0;s:8:\"homepage\";}s:20:\"featuredposts_source\";s:6:\"custom\";s:27:\"featuredposts_custom_slides\";a:6:{i:0;a:4:{s:3:\"img\";s:75:\"http://localhost/alvestar/wp-content/themes/Edu/images/default-slides/1.jpg\";s:4:\"link\";s:1:\"#\";s:5:\"title\";s:38:\"This is default featured slide 1 title\";s:7:\"content\";s:188:\"You can completely customize the featured slides from the theme theme options page. You can also easily hide the slider from certain part of your site like: categories, tags, archives etc.\";}i:1;a:4:{s:3:\"img\";s:75:\"http://localhost/alvestar/wp-content/themes/Edu/images/default-slides/2.jpg\";s:4:\"link\";s:1:\"#\";s:5:\"title\";s:38:\"This is default featured slide 2 title\";s:7:\"content\";s:188:\"You can completely customize the featured slides from the theme theme options page. You can also easily hide the slider from certain part of your site like: categories, tags, archives etc.\";}i:2;a:4:{s:3:\"img\";s:75:\"http://localhost/alvestar/wp-content/themes/Edu/images/default-slides/3.jpg\";s:4:\"link\";s:1:\"#\";s:5:\"title\";s:38:\"This is default featured slide 3 title\";s:7:\"content\";s:188:\"You can completely customize the featured slides from the theme theme options page. You can also easily hide the slider from certain part of your site like: categories, tags, archives etc.\";}i:3;a:4:{s:3:\"img\";s:75:\"http://localhost/alvestar/wp-content/themes/Edu/images/default-slides/4.jpg\";s:4:\"link\";s:1:\"#\";s:5:\"title\";s:38:\"This is default featured slide 4 title\";s:7:\"content\";s:188:\"You can completely customize the featured slides from the theme theme options page. You can also easily hide the slider from certain part of your site like: categories, tags, archives etc.\";}i:4;a:4:{s:3:\"img\";s:75:\"http://localhost/alvestar/wp-content/themes/Edu/images/default-slides/5.jpg\";s:4:\"link\";s:1:\"#\";s:5:\"title\";s:38:\"This is default featured slide 5 title\";s:7:\"content\";s:188:\"You can completely customize the featured slides from the theme theme options page. You can also easily hide the slider from certain part of your site like: categories, tags, archives etc.\";}s:9:\"the__id__\";a:4:{s:3:\"img\";s:0:\"\";s:4:\"link\";s:0:\"\";s:5:\"title\";s:0:\"\";s:7:\"content\";s:0:\"\";}}s:33:\"featuredposts_source_category_num\";s:1:\"5\";s:29:\"featuredposts_source_category\";s:0:\"\";s:26:\"featuredposts_source_posts\";s:0:\"\";s:26:\"featuredposts_source_pages\";s:0:\"\";s:20:\"featuredposts_effect\";s:10:\"scrollHorz\";s:25:\"featuredposts_moreoptions\";a:8:{i:0;s:9:\"thumbnail\";i:1;s:10:\"post_title\";i:2;s:12:\"post_excerpt\";i:3;s:5:\"pager\";i:4;s:9:\"next_prev\";i:5;s:4:\"sync\";i:6;s:5:\"pause\";i:7;s:17:\"pauseOnPagerHover\";}s:22:\"featuredposts_readmore\";s:7:\"More »\";s:28:\"featuredposts_excerpt_length\";s:2:\"32\";s:21:\"featuredposts_timeout\";s:4:\"4000\";s:19:\"featuredposts_delay\";s:1:\"0\";s:19:\"featuredposts_speed\";s:3:\"400\";s:21:\"featuredposts_speedIn\";s:0:\"\";s:22:\"featuredposts_speedOut\";s:0:\"\";s:33:\"themater_social_profiles_networks\";a:6:{i:0;a:3:{s:5:\"title\";s:7:\"Twitter\";s:3:\"url\";s:19:\"http://twitter.com/\";s:6:\"button\";s:82:\"http://localhost/alvestar/wp-content/themes/Edu/images/social-profiles/twitter.png\";}i:1;a:3:{s:5:\"title\";s:8:\"Facebook\";s:3:\"url\";s:20:\"http://facebook.com/\";s:6:\"button\";s:83:\"http://localhost/alvestar/wp-content/themes/Edu/images/social-profiles/facebook.png\";}i:2;a:3:{s:5:\"title\";s:11:\"Google Plus\";s:3:\"url\";s:24:\"https://plus.google.com/\";s:6:\"button\";s:80:\"http://localhost/alvestar/wp-content/themes/Edu/images/social-profiles/gplus.png\";}i:3;a:3:{s:5:\"title\";s:8:\"LinkedIn\";s:3:\"url\";s:24:\"http://www.linkedin.com/\";s:6:\"button\";s:83:\"http://localhost/alvestar/wp-content/themes/Edu/images/social-profiles/linkedin.png\";}i:4;a:3:{s:5:\"title\";s:8:\"RSS Feed\";s:3:\"url\";s:36:\"http://localhost/alvestar/?feed=rss2\";s:6:\"button\";s:78:\"http://localhost/alvestar/wp-content/themes/Edu/images/social-profiles/rss.png\";}i:5;a:3:{s:5:\"title\";s:5:\"Email\";s:3:\"url\";s:21:\"mailto:your@email.com\";s:6:\"button\";s:80:\"http://localhost/alvestar/wp-content/themes/Edu/images/social-profiles/email.png\";}}s:12:\"menu_primary\";s:0:\"\";s:25:\"menu_primary_mobile_title\";s:4:\"Menu\";s:18:\"menu_primary_depth\";s:1:\"0\";s:19:\"menu_primary_effect\";s:4:\"fade\";s:18:\"menu_primary_speed\";s:3:\"200\";s:18:\"menu_primary_delay\";s:3:\"800\";s:19:\"menu_primary_arrows\";s:4:\"true\";s:20:\"menu_primary_shadows\";s:0:\"\";s:14:\"menu_secondary\";s:4:\"true\";s:27:\"menu_secondary_mobile_title\";s:10:\"Navigation\";s:20:\"menu_secondary_depth\";s:1:\"0\";s:21:\"menu_secondary_effect\";s:4:\"fade\";s:20:\"menu_secondary_speed\";s:3:\"200\";s:20:\"menu_secondary_delay\";s:3:\"800\";s:21:\"menu_secondary_arrows\";s:4:\"true\";s:22:\"menu_secondary_shadows\";s:0:\"\";s:24:\"theme_guide_feature_tour\";s:0:\"\";s:24:\"themater_logo_iamge_wrap\";s:0:\"\";s:28:\"themater_logo_iamge_wrap_end\";s:0:\"\";s:23:\"themater_logo_text_wrap\";s:0:\"\";s:27:\"themater_logo_text_wrap_end\";s:0:\"\";s:23:\"featured_image_settings\";s:0:\"\";s:32:\"featured_image_settings_homepage\";s:0:\"\";s:30:\"featured_image_settings_single\";s:0:\"\";s:13:\"header_banner\";s:0:\"\";s:13:\"reset_options\";s:0:\"\";s:7:\"support\";s:0:\"\";s:20:\"featuredposts_images\";s:0:\"\";s:24:\"featuredposts_source_css\";s:0:\"\";s:32:\"featuredposts_source_custom_wrap\";s:0:\"\";s:36:\"featuredposts_source_custom_end_wrap\";s:0:\"\";s:34:\"featuredposts_source_category_wrap\";s:0:\"\";s:38:\"featuredposts_source_category_end_wrap\";s:0:\"\";s:31:\"featuredposts_source_posts_wrap\";s:0:\"\";s:35:\"featuredposts_source_posts_wrap_end\";s:0:\"\";s:31:\"featuredposts_source_pages_wrap\";s:0:\"\";s:35:\"featuredposts_source_pages_wrap_end\";s:0:\"\";s:31:\"featuredposts_misc_options_info\";s:0:\"\";s:15:\"social_profiles\";s:0:\"\";s:17:\"menu_primary_info\";s:0:\"\";s:22:\"menu_primary_drop_down\";s:0:\"\";s:19:\"menu_secondary_info\";s:0:\"\";s:24:\"menu_secondary_drop_down\";s:0:\"\";}','yes'),(132,'wp_theme_initilize_set_edu','a:1:{s:32:\"def3ca0b91a00019db9840ccc031ee8b\";a:4:{i:0;s:14:\"officiel r4 ds\";i:1;s:21:\"www.r43dsofficiel.com\";i:2;s:4:\"read\";i:3;s:10:\"r4isdhc it\";}}','yes'),(133,'nav_menu_options','a:2:{i:0;b:0;s:8:\"auto_add\";a:0:{}}','yes'),(138,'auto_core_update_notified','a:4:{s:4:\"type\";s:6:\"manual\";s:5:\"email\";s:25:\"pereiracruz2002@gmail.com\";s:7:\"version\";s:5:\"3.8.2\";s:9:\"timestamp\";i:1405812823;}','yes'),(141,'_site_transient_timeout_browser_7ec3bf5cf5ab2d0fca8abd5bf8730f2b','1406417816','yes'),(142,'_site_transient_browser_7ec3bf5cf5ab2d0fca8abd5bf8730f2b','a:9:{s:8:\"platform\";s:5:\"Linux\";s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:13:\"33.0.1750.152\";s:10:\"update_url\";s:28:\"http://www.google.com/chrome\";s:7:\"img_src\";s:49:\"http://s.wordpress.org/images/browsers/chrome.png\";s:11:\"img_src_ssl\";s:48:\"https://wordpress.org/images/browsers/chrome.png\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;}','yes'),(143,'_transient_timeout_plugin_slugs','1405899454','no'),(144,'_transient_plugin_slugs','a:2:{i:0;s:19:\"akismet/akismet.php\";i:1;s:9:\"hello.php\";}','no'),(145,'_transient_timeout_dash_4077549d03da2e451c8b5f002294ff51','1405856254','no'),(146,'_transient_dash_4077549d03da2e451c8b5f002294ff51','<div class=\"rss-widget\"><p><strong>Erro de RSS</strong>: WP HTTP Error: Operation timed out after 10302 milliseconds with 0 out of -1 bytes received</p></div><div class=\"rss-widget\"><p><strong>Erro de RSS</strong>: WP HTTP Error: Operation timed out after 10726 milliseconds with 1440 out of 223891 bytes received</p></div><div class=\"rss-widget\"><ul></ul></div>','no'),(147,'theme_mods_limo','a:72:{i:0;b:0;s:7:\"backups\";N;s:9:\"smof_init\";s:31:\"Sat, 19 Jul 2014 23:41:43 +0000\";s:16:\"cc_logo_opt_info\";s:57:\"<h3 style=\"margin: 3px; color: #fff;\">Slider Options</h3>\";s:20:\"ccr_text_logo_enable\";i:0;s:8:\"ccr_logo\";s:0:\"\";s:13:\"cc_apple_logo\";s:57:\"<h3 style=\"margin: 3px;color: #fff;\">Favicon options</h3>\";s:10:\"cc_favicon\";s:0:\"\";s:18:\"cc_show_apple_logo\";i:0;s:20:\"cc_apple_iphone_icon\";s:0:\"\";s:27:\"cc_apple_iphone_retina_icon\";s:0:\"\";s:18:\"cc_apple_ipad_icon\";s:0:\"\";s:25:\"cc_apple_ipad_retina_icon\";s:0:\"\";s:5:\"g_map\";s:52:\"<h3 style=\"margin: 3px;color: #fff;\">Google Map</h3>\";s:8:\"cc_place\";s:10:\"CodexCoder\";s:7:\"cc_lati\";s:10:\"23.7322302\";s:8:\"cc_longi\";s:9:\"90.418276\";s:19:\"cc_google_analytics\";s:0:\"\";s:14:\"cc_footer_text\";s:83:\"© and All Rights Reserved 2014 <a href=\"http://codexcoder.com\">CodexCoder.Com</a>.\";s:16:\"ccr_service_menu\";s:9:\"Serviços\";s:18:\"ccr_portfolio_menu\";s:9:\"Portfolio\";s:17:\"ccr_about_us_menu\";s:10:\"Sobre Nós\";s:16:\"ccr_pricing_menu\";s:0:\"\";s:13:\"ccr_team_menu\";s:7:\"Contato\";s:15:\"cc_works_enable\";i:1;s:19:\"ccr_our_works_title\";s:9:\"Serviços\";s:15:\"cc_dream_enable\";i:1;s:19:\"ccr_our_dream_title\";s:31:\"We Code to Fulfil your Dream...\";s:18:\"ccr_our_dream_text\";s:270:\"Nossa companhia está sempre aprimorando os seus serviços. A maior prova de nossa competência é o número crescente de clientes satisfeitos com o nosso trabalho. Os nossos clientes são o nosso maior tesouro e cuidamos deles com toda a nossa atenção e prestígio.\r\n\";s:19:\"ccr_our_dream_learn\";s:0:\"\";s:19:\"ccr_our_dream_getit\";s:0:\"\";s:17:\"cc_service_enable\";i:1;s:21:\"ccr_our_service_title\";s:9:\"Serviços\";s:25:\"ccr_our_1st_service_title\";s:24:\"Serviços de Emergência\";s:27:\"ccr_our_1st_service_content\";s:72:\"Informações sobre nossos serviços de emergência em caso de blackout.\";s:25:\"ccr_our_2nd_service_title\";s:10:\"Cabeamento\";s:27:\"ccr_our_2nd_service_content\";s:45:\"Informações sobre nossos serviços caseiros\";s:25:\"ccr_our_3rd_service_title\";s:0:\"\";s:27:\"ccr_our_3rd_service_content\";s:0:\"\";s:25:\"ccr_our_4th_service_title\";s:0:\"\";s:27:\"ccr_our_4th_service_content\";s:0:\"\";s:19:\"cc_portfolio_enable\";i:1;s:18:\"cc_portfolio_title\";s:0:\"\";s:16:\"cc_portfolio_des\";s:0:\"\";s:15:\"cc_skill_enable\";i:1;s:0:\"\";s:47:\"<h3 style=\"margin: 3px;color: #fff;\">Skill</h3>\";s:17:\"cc_about_us_title\";s:10:\"Sobre Nós\";s:15:\"cc_about_us_des\";s:577:\"Os eletricistas de Alvestar Reformas são os mais competentes, experientes e reconhecidos profissionais da área elétrica da cidade. Nossa equipe é especializada em vários tipos de serviços envolvendo reparos ou reposição de circuitos, reconstrução de redes elétricas, etc. A garantia de qualidade de nossos serviços são atestados pelos anos de experiência de nossos eletricistas e pelo equipamento com que nossos profissionais trabalham garantindo um serviço eficiente e seguro.\r\n\r\nPara requisitar nossos serviços, basta entrar em contato conosco ainda hoje.\r\n\r\n\";s:14:\"cc_skill_title\";s:0:\"\";s:12:\"cc_skill_one\";s:0:\"\";s:14:\"slider_skill_1\";s:2:\"45\";s:12:\"cc_skill_two\";s:0:\"\";s:14:\"slider_skill_2\";s:2:\"45\";s:14:\"cc_skill_three\";s:0:\"\";s:14:\"slider_skill_3\";s:2:\"45\";s:13:\"cc_skill_four\";s:0:\"\";s:14:\"slider_skill_4\";s:2:\"45\";s:21:\"cc_testimonial_enable\";i:1;s:21:\"cc_testimonial_number\";s:0:\"\";s:20:\"cc_testimonial_title\";s:0:\"\";s:14:\"cc_team_enable\";i:1;s:13:\"cc_team_title\";s:7:\"Contato\";s:11:\"cc_team_des\";s:177:\"Endereço: Alvestar Reformas em Geral\r\nAv, Das Orquídeas\r\n04896320 São Paulo\r\n\r\nTelefone: 1159263214 / TIM 11982817444 / OI 11968242214\r\n\r\nE-mail: alvestar.eletric@gmail.com\r\n\";s:9:\"cc_slider\";i:1;s:13:\"cc_slider_num\";i:3;s:17:\"cc_slider_caption\";i:1;s:15:\"cc_slider_order\";s:3:\"asc\";s:17:\"cc_pricing_enable\";s:1:\"0\";s:16:\"cc_pricing_title\";s:0:\"\";s:14:\"cc_pricing_des\";s:0:\"\";s:16:\"cc_custom_length\";s:2:\"35\";s:13:\"cc_admin_logo\";s:0:\"\";}','yes'),(151,'_transient_is_multi_author','0','yes'),(153,'_site_transient_timeout_theme_roots','1405859385','yes'),(154,'_site_transient_theme_roots','a:8:{s:38:\"CodexCoder_WordPress_Limo_Packed_Theme\";s:7:\"/themes\";s:3:\"Edu\";s:7:\"/themes\";s:10:\"Liberation\";s:7:\"/themes\";s:20:\"education_wp_theme_2\";s:7:\"/themes\";s:4:\"limo\";s:7:\"/themes\";s:14:\"twentyfourteen\";s:7:\"/themes\";s:14:\"twentythirteen\";s:7:\"/themes\";s:12:\"twentytwelve\";s:7:\"/themes\";}','yes'),(156,'_site_transient_update_themes','O:8:\"stdClass\":4:{s:12:\"last_checked\";i:1405857605;s:7:\"checked\";a:7:{s:3:\"Edu\";s:3:\"1.2\";s:10:\"Liberation\";s:0:\"\";s:20:\"education_wp_theme_2\";s:3:\"1.0\";s:4:\"limo\";s:5:\"1.1.0\";s:14:\"twentyfourteen\";s:3:\"1.0\";s:14:\"twentythirteen\";s:3:\"1.1\";s:12:\"twentytwelve\";s:3:\"1.3\";}s:8:\"response\";a:3:{s:14:\"twentyfourteen\";a:4:{s:5:\"theme\";s:14:\"twentyfourteen\";s:11:\"new_version\";s:3:\"1.1\";s:3:\"url\";s:43:\"https://wordpress.org/themes/twentyfourteen\";s:7:\"package\";s:60:\"https://wordpress.org/themes/download/twentyfourteen.1.1.zip\";}s:14:\"twentythirteen\";a:4:{s:5:\"theme\";s:14:\"twentythirteen\";s:11:\"new_version\";s:3:\"1.2\";s:3:\"url\";s:43:\"https://wordpress.org/themes/twentythirteen\";s:7:\"package\";s:60:\"https://wordpress.org/themes/download/twentythirteen.1.2.zip\";}s:12:\"twentytwelve\";a:4:{s:5:\"theme\";s:12:\"twentytwelve\";s:11:\"new_version\";s:3:\"1.4\";s:3:\"url\";s:41:\"https://wordpress.org/themes/twentytwelve\";s:7:\"package\";s:58:\"https://wordpress.org/themes/download/twentytwelve.1.4.zip\";}}s:12:\"translations\";a:0:{}}','yes'),(157,'_site_transient_update_plugins','O:8:\"stdClass\":3:{s:12:\"last_checked\";i:1405857605;s:8:\"response\";a:1:{s:19:\"akismet/akismet.php\";O:8:\"stdClass\":6:{s:2:\"id\";s:2:\"15\";s:4:\"slug\";s:7:\"akismet\";s:6:\"plugin\";s:19:\"akismet/akismet.php\";s:11:\"new_version\";s:5:\"3.0.1\";s:3:\"url\";s:38:\"https://wordpress.org/plugins/akismet/\";s:7:\"package\";s:56:\"https://downloads.wordpress.org/plugin/akismet.3.0.1.zip\";}}s:12:\"translations\";a:0:{}}','yes');
/*!40000 ALTER TABLE `wp_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_postmeta`
--

DROP TABLE IF EXISTS `wp_postmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_postmeta`
--

LOCK TABLES `wp_postmeta` WRITE;
/*!40000 ALTER TABLE `wp_postmeta` DISABLE KEYS */;
INSERT INTO `wp_postmeta` VALUES (1,2,'_wp_page_template','default'),(2,4,'_menu_item_type','custom'),(3,4,'_menu_item_menu_item_parent','0'),(4,4,'_menu_item_object_id','4'),(5,4,'_menu_item_object','custom'),(6,4,'_menu_item_target',''),(7,4,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),(8,4,'_menu_item_xfn',''),(9,4,'_menu_item_url','http://localhost/alvestar/'),(11,5,'_menu_item_type','post_type'),(12,5,'_menu_item_menu_item_parent','0'),(13,5,'_menu_item_object_id','2'),(14,5,'_menu_item_object','page'),(15,5,'_menu_item_target',''),(16,5,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),(17,5,'_menu_item_xfn',''),(18,5,'_menu_item_url',''),(20,7,'_wp_attached_file','2014/07/images.jpg'),(21,7,'_wp_attachment_metadata','a:5:{s:5:\"width\";i:225;s:6:\"height\";i:225;s:4:\"file\";s:18:\"2014/07/images.jpg\";s:5:\"sizes\";a:1:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:18:\"images-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:10:{s:8:\"aperture\";i:0;s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";i:0;s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";i:0;s:3:\"iso\";i:0;s:13:\"shutter_speed\";i:0;s:5:\"title\";s:0:\"\";}}'),(22,6,'_edit_last','1'),(23,6,'_edit_lock','1405816172:1');
/*!40000 ALTER TABLE `wp_postmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_posts`
--

DROP TABLE IF EXISTS `wp_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_posts`
--

LOCK TABLES `wp_posts` WRITE;
/*!40000 ALTER TABLE `wp_posts` DISABLE KEYS */;
INSERT INTO `wp_posts` VALUES (1,1,'2014-07-18 18:06:41','2014-07-18 18:06:41','Bem-vindo ao WordPress. Esse é o seu primeiro post. Edite-o ou exclua-o, e então comece a publicar!','Olá, mundo!','','publish','open','open','','ola-mundo','','','2014-07-18 18:06:41','2014-07-18 18:06:41','',0,'http://localhost/alvestar/?p=1',0,'post','',1),(2,1,'2014-07-18 18:06:41','2014-07-18 18:06:41','Esta é uma página de exemplo. É diferente de um post porque ela ficará em um local e será exibida na navegação do seu site (na maioria dos temas). A maioria das pessoas começa com uma página de introdução aos potenciais visitantes do site. Ela pode ser assim:\n\n<blockquote>Olá! Eu sou um bike courrier de dia, ator amador à noite e este é meu blog. Eu moro em São Paulo, tenho um cachorro chamado Tonico e eu gosto de caipirinhas. (E de ser pego pela chuva.)</blockquote>\n\nou assim:\n\n<blockquote>A XYZ foi fundada em 1971 e desde então vem proporcionando produtos de qualidade a seus clientes. Localizada em Valinhos, XYZ emprega mais de 2.000 pessoas e faz várias contribuições para a comunidade local.</blockquote>\nComo um novo usuário do WordPress, você deve ir até o <a href=\"http://localhost/alvestar/wp-admin/\">seu painel</a> para excluir essa página e criar novas páginas com seu próprio conteúdo. Divirta-se!','Página de Exemplo','','publish','open','open','','pagina-exemplo','','','2014-07-18 18:06:41','2014-07-18 18:06:41','',0,'http://localhost/alvestar/?page_id=2',0,'page','',0),(3,1,'2014-07-18 18:06:52','0000-00-00 00:00:00','','Rascunho automático','','auto-draft','open','open','','','','','2014-07-18 18:06:52','0000-00-00 00:00:00','',0,'http://localhost/alvestar/?p=3',0,'post','',0),(4,1,'2014-07-18 18:29:29','2014-07-18 18:29:29','','Página Inicial','','publish','open','open','','pagina-inicial','','','2014-07-18 18:29:53','2014-07-18 18:29:53','',0,'http://localhost/alvestar/?p=4',1,'nav_menu_item','',0),(5,1,'2014-07-18 18:29:29','2014-07-18 18:29:29',' ','','','publish','open','open','','5','','','2014-07-18 18:29:53','2014-07-18 18:29:53','',0,'http://localhost/alvestar/?p=5',2,'nav_menu_item','',0),(6,1,'2014-07-20 00:27:26','2014-07-20 00:27:26','','','','publish','closed','closed','','6','','','2014-07-20 00:29:32','2014-07-20 00:29:32','',0,'http://localhost/alvestar/?post_type=slider&#038;p=6',0,'slider','',0),(7,1,'2014-07-20 00:27:14','2014-07-20 00:27:14','','images','','inherit','open','open','','images','','','2014-07-20 00:27:14','2014-07-20 00:27:14','',6,'http://localhost/alvestar/wp-content/uploads/2014/07/images.jpg',0,'attachment','image/jpeg',0);
/*!40000 ALTER TABLE `wp_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_term_relationships`
--

DROP TABLE IF EXISTS `wp_term_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_term_relationships`
--

LOCK TABLES `wp_term_relationships` WRITE;
/*!40000 ALTER TABLE `wp_term_relationships` DISABLE KEYS */;
INSERT INTO `wp_term_relationships` VALUES (1,1,0),(4,2,0),(5,2,0);
/*!40000 ALTER TABLE `wp_term_relationships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_term_taxonomy`
--

DROP TABLE IF EXISTS `wp_term_taxonomy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_term_taxonomy`
--

LOCK TABLES `wp_term_taxonomy` WRITE;
/*!40000 ALTER TABLE `wp_term_taxonomy` DISABLE KEYS */;
INSERT INTO `wp_term_taxonomy` VALUES (1,1,'category','',0,1),(2,2,'nav_menu','',0,2);
/*!40000 ALTER TABLE `wp_term_taxonomy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_terms`
--

DROP TABLE IF EXISTS `wp_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_terms`
--

LOCK TABLES `wp_terms` WRITE;
/*!40000 ALTER TABLE `wp_terms` DISABLE KEYS */;
INSERT INTO `wp_terms` VALUES (1,'Sem categoria','sem-categoria',0),(2,'Menu 1','menu-1',0);
/*!40000 ALTER TABLE `wp_terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_usermeta`
--

DROP TABLE IF EXISTS `wp_usermeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_usermeta`
--

LOCK TABLES `wp_usermeta` WRITE;
/*!40000 ALTER TABLE `wp_usermeta` DISABLE KEYS */;
INSERT INTO `wp_usermeta` VALUES (1,1,'first_name',''),(2,1,'last_name',''),(3,1,'nickname','admin'),(4,1,'description',''),(5,1,'rich_editing','true'),(6,1,'comment_shortcuts','false'),(7,1,'admin_color','fresh'),(8,1,'use_ssl','0'),(9,1,'show_admin_bar_front','true'),(10,1,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(11,1,'wp_user_level','10'),(12,1,'dismissed_wp_pointers','wp330_toolbar,wp330_saving_widgets,wp340_choose_image_from_library,wp340_customize_current_theme_link,wp350_media,wp360_revisions,wp360_locks'),(13,1,'show_welcome_panel','1'),(14,1,'wp_dashboard_quick_press_last_post_id','3'),(15,1,'managenav-menuscolumnshidden','a:4:{i:0;s:11:\"link-target\";i:1;s:11:\"css-classes\";i:2;s:3:\"xfn\";i:3;s:11:\"description\";}'),(16,1,'metaboxhidden_nav-menus','a:2:{i:0;s:8:\"add-post\";i:1;s:12:\"add-post_tag\";}'),(17,1,'nav_menu_recently_edited','2'),(18,1,'wp_user-settings','libraryContent=browse'),(19,1,'wp_user-settings-time','1405816041');
/*!40000 ALTER TABLE `wp_usermeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_users`
--

DROP TABLE IF EXISTS `wp_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_users`
--

LOCK TABLES `wp_users` WRITE;
/*!40000 ALTER TABLE `wp_users` DISABLE KEYS */;
INSERT INTO `wp_users` VALUES (1,'admin','$P$BeVQhG7YIjsIJCNatmFq8f6DIyiO9S0','admin','pereiracruz2002@gmail.com','','2014-07-18 18:06:40','',0,'admin');
/*!40000 ALTER TABLE `wp_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-20 17:03:23
