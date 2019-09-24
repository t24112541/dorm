/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : mount_db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-04-02 11:39:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for my_admin
-- ----------------------------
DROP TABLE IF EXISTS `my_admin`;
CREATE TABLE `my_admin` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_username` text COLLATE utf8_unicode_ci,
  `ad_password` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of my_admin
-- ----------------------------
INSERT INTO `my_admin` VALUES ('5', 'veh', '77e2edcc9b40441200e31dc57dbb8829');

-- ----------------------------
-- Table structure for my_match
-- ----------------------------
DROP TABLE IF EXISTS `my_match`;
CREATE TABLE `my_match` (
  `m_id` int(10) NOT NULL AUTO_INCREMENT,
  `m_host_id` int(10) NOT NULL,
  `m_target_id` int(10) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of my_match
-- ----------------------------
INSERT INTO `my_match` VALUES ('1', '1', '2');

-- ----------------------------
-- Table structure for my_mount
-- ----------------------------
DROP TABLE IF EXISTS `my_mount`;
CREATE TABLE `my_mount` (
  `my_id` int(10) NOT NULL AUTO_INCREMENT,
  `my_host` text COLLATE utf8_unicode_ci NOT NULL,
  `my_user` text COLLATE utf8_unicode_ci NOT NULL,
  `my_pass` text COLLATE utf8_unicode_ci,
  `my_name` text COLLATE utf8_unicode_ci NOT NULL,
  `my_port` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`my_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of my_mount
-- ----------------------------
INSERT INTO `my_mount` VALUES ('1', 'localhost', 'root', '', '12561', '3306');
INSERT INTO `my_mount` VALUES ('2', 'localhost', 'root', '', 'project_vehicle', '3306');
