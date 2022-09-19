/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100137
Source Host           : localhost:3306
Source Database       : trans_profiling

Target Server Type    : MYSQL
Target Server Version : 100137
File Encoding         : 65001

Date: 2020-01-29 18:41:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for monthly_report_cache
-- ----------------------------
DROP TABLE IF EXISTS `monthly_report_cache`;
CREATE TABLE `monthly_report_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `verified` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `best_agent` varchar(10) DEFAULT NULL,
  `best_teamleader` varchar(10) DEFAULT NULL,
  `verified_best_agent` int(10) DEFAULT NULL,
  `verified_best_teamleader` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of monthly_report_cache
-- ----------------------------
INSERT INTO `monthly_report_cache` VALUES ('76', '2018', '1', '100529', '2020-01-29 09:48:26', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('77', '2018', '2', '99083', '2020-01-29 09:48:27', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('78', '2018', '3', '114225', '2020-01-29 09:48:28', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('79', '2018', '4', '115592', '2020-01-29 09:48:29', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('80', '2018', '5', '121490', '2020-01-29 09:48:31', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('81', '2018', '6', '54660', '2020-01-29 09:48:32', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('82', '2018', '7', '77360', '2020-01-29 09:48:33', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('83', '2018', '8', '95898', '2020-01-29 09:48:34', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('84', '2018', '9', '110378', '2020-01-29 09:48:36', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('85', '2018', '10', '147429', '2020-01-29 09:48:37', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('86', '2018', '11', '152238', '2020-01-29 09:48:38', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('87', '2018', '12', '125040', '2020-01-29 09:48:39', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('88', '2019', '1', '131395', '2020-01-29 09:48:41', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('89', '2019', '2', '136890', '2020-01-29 09:48:42', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('90', '2019', '3', '179343', '2020-01-29 09:48:43', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('91', '2019', '4', '176902', '2020-01-29 09:48:45', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('92', '2019', '5', '150071', '2020-01-29 09:48:46', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('93', '2019', '6', '155894', '2020-01-29 09:48:48', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('94', '2019', '7', '178669', '2020-01-29 09:48:49', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('95', '2019', '8', '181873', '2020-01-29 09:48:51', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('96', '2019', '9', '197982', '2020-01-29 09:48:52', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('97', '2019', '10', '187162', '2020-01-29 09:48:54', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('98', '2019', '11', '194655', '2020-01-29 09:48:55', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('99', '2019', '12', '206051', '2020-01-29 10:12:48', 'WY0182', '', '2148', null);
INSERT INTO `monthly_report_cache` VALUES ('100', '2020', '1', '164799', '2020-01-29 09:48:58', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('101', '2020', '2', '0', '2020-01-29 09:48:59', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('102', '2020', '3', '0', '2020-01-29 09:49:01', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('103', '2020', '4', '0', '2020-01-29 09:49:02', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('104', '2020', '5', '0', '2020-01-29 09:49:04', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('105', '2020', '6', '0', '2020-01-29 09:49:05', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('106', '2020', '7', '0', '2020-01-29 09:49:06', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('107', '2020', '8', '0', '2020-01-29 09:49:08', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('108', '2020', '9', '0', '2020-01-29 09:49:09', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('109', '2020', '10', '0', '2020-01-29 09:49:11', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('110', '2020', '11', '0', '2020-01-29 09:49:13', '', '', null, null);
INSERT INTO `monthly_report_cache` VALUES ('111', '2020', '12', '0', '2020-01-29 09:49:15', '', '', null, null);
