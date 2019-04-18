/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 100308
 Source Host           : localhost:3306
 Source Schema         : testdb

 Target Server Type    : MySQL
 Target Server Version : 100308
 File Encoding         : 65001

 Date: 18/04/2019 12:09:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
BEGIN;
INSERT INTO `auth_assignment` VALUES ('admin', '1', 1554978122);
INSERT INTO `auth_assignment` VALUES ('user', '3', 1554982749);
INSERT INTO `auth_assignment` VALUES ('user', '4', 1555578350);
COMMIT;

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
BEGIN;
INSERT INTO `auth_item` VALUES ('admin', 1, NULL, NULL, NULL, 1554977977, 1554977977);
INSERT INTO `auth_item` VALUES ('manager', 1, NULL, NULL, NULL, 1554978019, 1554978019);
INSERT INTO `auth_item` VALUES ('user', 1, NULL, NULL, NULL, 1554978031, 1554978031);
COMMIT;

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for event
-- ----------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `date_begin` int(11) DEFAULT NULL,
  `date_end` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of event
-- ----------------------------
BEGIN;
INSERT INTO `event` VALUES (1, 'Все на лыжи', 1555754400, 1555783200, NULL, 'image_1_1555577822.jpg', 0xD092D181D0B520D0BDD0B020D0BBD18BD0B6D0B8, 1555577729, 1555577822, 'Казань, ул Ершова');
INSERT INTO `event` VALUES (2, 'Веселые старты', 1556020500, 1556114100, NULL, 'image_1_1555577873.jpg', '', 1555577873, 1555577873, '');
INSERT INTO `event` VALUES (3, 'IT конференция', 1556186400, 1556215200, NULL, 'image_1_1555577921.jpg', '', 1555577921, 1555577921, '');
INSERT INTO `event` VALUES (4, 'Дни культуры', 1556023800, 1556028000, NULL, 'image_1_1555577970.jpg', '', 1555577970, 1555577970, '');
COMMIT;

-- ----------------------------
-- Table structure for event_tag
-- ----------------------------
DROP TABLE IF EXISTS `event_tag`;
CREATE TABLE `event_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of event_tag
-- ----------------------------
BEGIN;
INSERT INTO `event_tag` VALUES (2, 1, 1);
INSERT INTO `event_tag` VALUES (3, 4, 2);
INSERT INTO `event_tag` VALUES (4, 2, 1);
INSERT INTO `event_tag` VALUES (5, 3, 3);
COMMIT;

-- ----------------------------
-- Table structure for event_user
-- ----------------------------
DROP TABLE IF EXISTS `event_user`;
CREATE TABLE `event_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of event_user
-- ----------------------------
BEGIN;
INSERT INTO `event_user` VALUES (1, 3, 1);
INSERT INTO `event_user` VALUES (2, 4, 1);
INSERT INTO `event_user` VALUES (3, 3, 4);
INSERT INTO `event_user` VALUES (4, 4, 4);
COMMIT;

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of migration
-- ----------------------------
BEGIN;
INSERT INTO `migration` VALUES ('m000000_000000_base', 1554977971);
INSERT INTO `migration` VALUES ('m130524_201442_init', 1554977972);
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', 1554977972);
INSERT INTO `migration` VALUES ('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1554977972);
INSERT INTO `migration` VALUES ('m180523_151638_rbac_updates_indexes_without_prefix', 1554977972);
INSERT INTO `migration` VALUES ('m190411_084129_table_init', 1554977972);
COMMIT;

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `mainmenu` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `frequency` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tag
-- ----------------------------
BEGIN;
INSERT INTO `tag` VALUES (1, 'Спорт', NULL, NULL, NULL, NULL, 2);
INSERT INTO `tag` VALUES (2, 'Культура', NULL, NULL, NULL, NULL, 1);
INSERT INTO `tag` VALUES (3, 'Информатика', NULL, NULL, NULL, NULL, 1);
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `fio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES (1, 'admin@admin.ru', 'dNOSCaP-4qQhImQkl9AuxmnO1hG4Vf35', '$2y$13$l4Ad/6n.sG3bfvXWXsCmderx1MSbvkceA0BCrLnetfzxshyXpTkaq', NULL, 'admin@admin.ru', 10, 1554978121, 1554984973, 'Администратор');
INSERT INTO `user` VALUES (3, 'test@test.test', '_elOcx8rdJb3RIrrgTVdD3_mMsaqjnJz', '$2y$13$LNQ6OvqfB88jSu9XD6hkbOM3jk5nVxQWKqTFq8x4wJ.E1rUyyY/6O', NULL, 'test@test.test', 10, 1554982749, 1554982749, 'test');
INSERT INTO `user` VALUES (4, 'user1@gmail.com', 'WqySaSWiQp4hMwBjN4VKojySDKVa-K-o', '$2y$13$1CaiDUsC5pIx.R.4HtnBoOPBtSXDrZwK/76/bcTUh7ii8qJo00UAG', NULL, 'user1@gmail.com', 10, 1555578350, 1555578350, 'Человек');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
