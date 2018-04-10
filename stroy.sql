/*
Navicat MySQL Data Transfer

Source Server         : vagrant
Source Server Version : 50559
Source Host           : localhost:3306
Source Database       : stroy

Target Server Type    : MYSQL
Target Server Version : 50559
File Encoding         : 65001

Date: 2018-04-10 10:46:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL COMMENT 'транслитерация названия для ссылки',
  `name` text NOT NULL COMMENT 'название категории',
  `intro_description` text NOT NULL COMMENT 'краткое описание категории на главную страницу',
  `full_description` text COMMENT 'полное описание категории на страницу категории',
  `image` int(11) DEFAULT NULL COMMENT 'id логотип категории 100х100',
  `title` int(11) NOT NULL COMMENT 'id title seo',
  `description` int(11) NOT NULL COMMENT 'id description seo',
  `show` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 - показать категорию, 0 - скрыть',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_slug_unique` (`slug`),
  KEY `category_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------

-- ----------------------------
-- Table structure for `image`
-- ----------------------------
DROP TABLE IF EXISTS `image`;
CREATE TABLE `image` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `alt` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `image_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of image
-- ----------------------------

-- ----------------------------
-- Table structure for `items`
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL COMMENT 'транслитерация названия для ссылки',
  `category` int(11) NOT NULL COMMENT 'категория товара',
  `image` int(11) DEFAULT NULL COMMENT 'картинка товара',
  `name` text NOT NULL COMMENT 'название товара',
  `characteristics` text NOT NULL COMMENT 'характеристика товара',
  `title` int(11) NOT NULL COMMENT 'title seo',
  `description` int(11) NOT NULL COMMENT 'description seo',
  `show` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 - показать товар, 0 - скрыть',
  `price` double(15,2) DEFAULT NULL COMMENT 'цена',
  `existence` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'наличие',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `items_slug_unique` (`slug`),
  KEY `items_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of items
-- ----------------------------

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2018_03_14_194250_create_category_table', '1');
INSERT INTO `migrations` VALUES ('4', '2018_03_14_194551_create_items_table', '1');
INSERT INTO `migrations` VALUES ('5', '2018_03_30_145649_create_seo_table', '1');
INSERT INTO `migrations` VALUES ('6', '2018_03_30_150638_create_image_table', '1');
INSERT INTO `migrations` VALUES ('7', '2018_03_31_083413_create_order_table', '1');

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `tel` text NOT NULL,
  `visit` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 - просмотрено, 0 - не просмотрено',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `seo`
-- ----------------------------
DROP TABLE IF EXISTS `seo`;
CREATE TABLE `seo` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type_page` text NOT NULL COMMENT 'тип страницы, home - главная, category - категории',
  `data` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seo_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of seo
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Admin', 'admin@admin.net', '$2y$10$GNMZQIvYjrauSd6mfLGRSucYTPSCUmAVzC1jbs2VQZO//PR/lgny.', 'CWWlxqT3RAbNauGO4PeFcRVamMwJUDA00O73DSpHZwChGOvq6yhw3oTATTSv', null, null);
