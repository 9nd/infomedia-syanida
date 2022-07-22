/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100137
Source Host           : localhost:3306
Source Database       : trans_profiling

Target Server Type    : MYSQL
Target Server Version : 100137
File Encoding         : 65001

Date: 2020-02-17 09:00:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for anggota3
-- ----------------------------
DROP TABLE IF EXISTS `anggota3`;
CREATE TABLE `anggota3` (
  `username` int(11) NOT NULL,
  `namalengkap` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
/*!50100 PARTITION BY RANGE (username)
(PARTITION P0 VALUES LESS THAN (20000) ENGINE = InnoDB,
 PARTITION P1 VALUES LESS THAN (40000) ENGINE = InnoDB,
 PARTITION P2 VALUES LESS THAN (60000) ENGINE = InnoDB,
 PARTITION P3 VALUES LESS THAN (80000) ENGINE = InnoDB,
 PARTITION P4 VALUES LESS THAN (100001) ENGINE = InnoDB) */;

-- ----------------------------
-- Records of anggota3
-- ----------------------------

-- ----------------------------
-- Table structure for cache_data
-- ----------------------------
DROP TABLE IF EXISTS `cache_data`;
CREATE TABLE `cache_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `agentid` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cache_data
-- ----------------------------
INSERT INTO `cache_data` VALUES ('1', 'CALLORDER', '10000', null, null);
INSERT INTO `cache_data` VALUES ('2', 'CONNECT', '9000', null, null);
INSERT INTO `cache_data` VALUES ('3', 'NOTCONNECT', '78', null, null);
INSERT INTO `cache_data` VALUES ('4', null, '334', null, '13');

-- ----------------------------
-- Table structure for filter_cache
-- ----------------------------
DROP TABLE IF EXISTS `filter_cache`;
CREATE TABLE `filter_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of filter_cache
-- ----------------------------
INSERT INTO `filter_cache` VALUES ('1', '2018-01-01', '2018-12-31');

-- ----------------------------
-- Table structure for jenis_kelamin
-- ----------------------------
DROP TABLE IF EXISTS `jenis_kelamin`;
CREATE TABLE `jenis_kelamin` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of jenis_kelamin
-- ----------------------------
INSERT INTO `jenis_kelamin` VALUES ('1', 'Laki-laki');
INSERT INTO `jenis_kelamin` VALUES ('2', 'Perempuan');

-- ----------------------------
-- Table structure for jenis_kelamin_2
-- ----------------------------
DROP TABLE IF EXISTS `jenis_kelamin_2`;
CREATE TABLE `jenis_kelamin_2` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jenis_kelamin_2
-- ----------------------------
INSERT INTO `jenis_kelamin_2` VALUES ('2', 'pria');
INSERT INTO `jenis_kelamin_2` VALUES ('3', 'perempuan');

-- ----------------------------
-- Table structure for leader_on_duty
-- ----------------------------
DROP TABLE IF EXISTS `leader_on_duty`;
CREATE TABLE `leader_on_duty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agentid` varchar(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `gelombang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of leader_on_duty
-- ----------------------------
INSERT INTO `leader_on_duty` VALUES ('1', 'TLATEU', '2020-01-31', '1');
INSERT INTO `leader_on_duty` VALUES ('2', 'TLITA', '2020-01-02', '1');
INSERT INTO `leader_on_duty` VALUES ('3', 'TLLIA', '2020-01-03', '1');
INSERT INTO `leader_on_duty` VALUES ('19', 'TLLIA', '2020-02-11', '3');
INSERT INTO `leader_on_duty` VALUES ('20', 'AR180293', '2020-02-12', '3');
INSERT INTO `leader_on_duty` VALUES ('21', 'BDG_074', '2020-02-13', '3');
INSERT INTO `leader_on_duty` VALUES ('22', 'TLITA', '2020-02-14', '3');
INSERT INTO `leader_on_duty` VALUES ('23', 'TLATEU', '2020-02-15', '3');

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(35) DEFAULT NULL,
  `joined` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of members
-- ----------------------------

-- ----------------------------
-- Table structure for monthly_report_cache
-- ----------------------------
DROP TABLE IF EXISTS `monthly_report_cache`;
CREATE TABLE `monthly_report_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `verified` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `best_agent` varchar(10) DEFAULT NULL,
  `best_teamleader` varchar(10) DEFAULT NULL,
  `verified_best_agent` int(10) DEFAULT NULL,
  `verified_best_teamleader` int(10) DEFAULT NULL,
  `best_agent_moss` varchar(255) DEFAULT NULL,
  `slg_best_agent_moss` varchar(255) DEFAULT NULL,
  `best_teamleader_moss` varchar(255) DEFAULT NULL,
  `slg_best_teamleader_moss` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of monthly_report_cache
-- ----------------------------
INSERT INTO `monthly_report_cache` VALUES ('76', '2018', '1', '100529', '2020-02-12 07:14:31', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('77', '2018', '2', '99083', '2020-02-12 07:14:32', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('78', '2018', '3', '114225', '2020-02-12 07:14:34', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('79', '2018', '4', '115592', '2020-02-12 07:14:35', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('80', '2018', '5', '121490', '2020-02-12 07:14:36', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('81', '2018', '6', '54660', '2020-02-12 07:14:38', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('82', '2018', '7', '77360', '2020-02-12 07:14:39', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('83', '2018', '8', '95898', '2020-02-12 07:14:41', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('84', '2018', '9', '110378', '2020-02-12 07:14:42', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('85', '2018', '10', '147429', '2020-02-12 07:14:44', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('86', '2018', '11', '152238', '2020-02-12 07:14:45', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('87', '2018', '12', '125040', '2020-02-12 07:14:46', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('88', '2019', '1', '131395', '2020-02-12 07:14:48', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('89', '2019', '2', '136890', '2020-02-12 07:14:49', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('90', '2019', '3', '179342', '2020-02-12 07:14:50', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('91', '2019', '4', '176902', '2020-02-12 07:14:51', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('92', '2019', '5', '150071', '2020-02-12 07:14:51', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('93', '2019', '6', '155894', '2020-02-12 07:14:52', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('94', '2019', '7', '178669', '2020-02-12 07:14:53', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('95', '2019', '8', '181873', '2020-02-12 07:14:53', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('96', '2019', '9', '197982', '2020-02-12 07:14:54', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('97', '2019', '10', '187162', '2020-02-12 07:14:55', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('98', '2019', '11', '194655', '2020-02-12 07:14:56', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('99', '2019', '12', '206051', '2020-02-12 07:14:56', 'WY0182', 'ASD', '2148', '1893', null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('100', '2020', '1', '198688', '2020-02-12 07:14:57', 'KA1095', 'TLLIA', '2309', '1700', 'BDG_046', '3.4315789473684', 'TLATEU', '7.4443540451095');
INSERT INTO `monthly_report_cache` VALUES ('101', '2020', '2', '59672', '2020-02-12 07:14:58', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('102', '2020', '3', '0', '2020-02-12 07:14:58', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('103', '2020', '4', '0', '2020-02-12 07:14:59', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('104', '2020', '5', '0', '2020-02-12 07:15:00', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('105', '2020', '6', '0', '2020-02-12 07:15:00', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('106', '2020', '7', '0', '2020-02-12 07:15:01', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('107', '2020', '8', '0', '2020-02-12 07:15:02', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('108', '2020', '9', '0', '2020-02-12 07:15:02', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('109', '2020', '10', '0', '2020-02-12 07:15:03', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('110', '2020', '11', '0', '2020-02-12 07:15:03', '', '', null, null, null, null, null, null);
INSERT INTO `monthly_report_cache` VALUES ('111', '2020', '12', '0', '2020-02-12 07:15:04', '', '', null, null, null, null, null, null);

-- ----------------------------
-- Table structure for report_cache
-- ----------------------------
DROP TABLE IF EXISTS `report_cache`;
CREATE TABLE `report_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `status_1` int(11) DEFAULT NULL,
  `status_2` int(10) DEFAULT NULL,
  `status_3` int(10) DEFAULT NULL,
  `status_4` int(11) DEFAULT NULL,
  `status_5` int(11) DEFAULT NULL,
  `status_6` int(10) DEFAULT NULL,
  `status_7` int(10) DEFAULT NULL,
  `status_8` int(11) DEFAULT NULL,
  `status_9` int(11) DEFAULT NULL,
  `status_10` int(11) DEFAULT NULL,
  `status_11` int(11) DEFAULT NULL,
  `status_12` int(11) DEFAULT NULL,
  `status_13` int(11) DEFAULT NULL,
  `status_14` int(11) DEFAULT NULL,
  `status_15` int(11) DEFAULT NULL,
  `status_16` int(11) DEFAULT NULL,
  `total_order_call` int(11) DEFAULT NULL,
  `hp_email` int(11) DEFAULT NULL,
  `hp_only` int(11) DEFAULT NULL,
  `tanpa_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=749 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of report_cache
-- ----------------------------
INSERT INTO `report_cache` VALUES ('1', '2018-01-01', null, null, '5', null, null, null, '5', '1', null, null, '1', null, '174', null, null, null, '186', '173', '1', null);
INSERT INTO `report_cache` VALUES ('2', '2018-01-02', '84', '2728', '410', '21', null, '1', '39', '41', '34', '40', '235', '50', '5187', '1350', null, null, '10220', '5187', null, null);
INSERT INTO `report_cache` VALUES ('3', '2018-01-03', '119', '3154', '491', '21', '1', null, '29', '66', '23', '48', '228', '28', '5177', '1510', null, null, '10895', '5177', null, null);
INSERT INTO `report_cache` VALUES ('4', '2018-01-04', '75', '2460', '414', '18', null, '3', '61', '24', '15', '35', '628', '33', '5436', '610', null, null, '9812', '5436', null, null);
INSERT INTO `report_cache` VALUES ('5', '2018-01-05', '143', '3276', '521', '20', null, null, '42', '71', '27', '43', '824', '32', '5016', '741', null, null, '10757', '5016', null, null);
INSERT INTO `report_cache` VALUES ('6', '2018-01-06', '104', '3034', '465', '29', null, null, '12', '96', '24', '32', '297', '38', '3048', '715', null, null, '7894', '3048', null, null);
INSERT INTO `report_cache` VALUES ('7', '2018-01-07', '2', '45', '7', null, null, '1', null, '1', null, null, '15', null, '353', '16', null, null, '440', '353', null, null);
INSERT INTO `report_cache` VALUES ('8', '2018-01-08', '82', '2625', '324', '16', null, null, '9', '53', '25', '25', '283', '31', '5156', '809', null, null, '9438', '5156', null, null);
INSERT INTO `report_cache` VALUES ('9', '2018-01-09', '115', '3350', '468', '18', null, null, '47', '49', '27', '38', '796', '39', '5228', '1176', null, null, '11351', '5228', null, null);
INSERT INTO `report_cache` VALUES ('10', '2018-01-10', '137', '3991', '673', '21', null, null, '27', '57', '27', '40', '583', '39', '5119', '1362', null, null, '12076', '5119', null, null);
INSERT INTO `report_cache` VALUES ('11', '2018-01-11', '56', '2284', '273', '12', null, null, '22', '65', '17', '21', '168', '81', '5151', '790', null, null, '8940', '5151', null, null);
INSERT INTO `report_cache` VALUES ('12', '2018-01-12', '46', '1951', '174', '8', null, null, '29', '25', '16', '15', '261', '55', '4710', '656', null, null, '7946', '4710', null, null);
INSERT INTO `report_cache` VALUES ('13', '2018-01-13', '12', '973', '97', '3', null, null, null, '30', '13', '3', '169', '57', '1085', '335', null, null, '2777', '1085', null, null);
INSERT INTO `report_cache` VALUES ('14', '2018-01-14', '2', '6', '1', null, null, null, null, null, null, null, null, null, '296', '3', null, null, '308', '296', null, null);
INSERT INTO `report_cache` VALUES ('15', '2018-01-15', '57', '1990', '168', '9', null, null, '11', '70', '7', '8', '271', '82', '4858', '461', null, null, '7993', '4858', null, null);
INSERT INTO `report_cache` VALUES ('16', '2018-01-16', '112', '3714', '473', '38', null, null, '46', '41', '24', '45', '996', '28', '3627', '1018', null, null, '10162', '3627', null, null);
INSERT INTO `report_cache` VALUES ('17', '2018-01-17', '161', '4957', '777', '56', null, null, '58', '92', '49', '51', '782', '26', '2872', '4148', null, null, '14030', '2872', null, null);
INSERT INTO `report_cache` VALUES ('18', '2018-01-18', '43', '1231', '182', '12', null, null, '70', '15', '10', '13', '340', '86', '4154', '517', null, null, '6673', '4154', null, null);
INSERT INTO `report_cache` VALUES ('19', '2018-01-19', '39', '2011', '214', '27', null, null, '35', '13', '7', '27', '403', '107', '4104', '555', null, null, '7542', '4104', null, null);
INSERT INTO `report_cache` VALUES ('20', '2018-01-20', '54', '1635', '270', '12', null, null, '8', '9', '10', '32', '469', '27', '2185', '265', null, null, '4976', '2185', null, null);
INSERT INTO `report_cache` VALUES ('21', '2018-01-21', '70', '2430', '319', '18', null, null, '12', '108', '18', '46', '186', '17', '1723', '1810', null, null, '6757', '1723', null, null);
INSERT INTO `report_cache` VALUES ('22', '2018-01-22', '184', '4852', '691', '52', null, null, '84', '64', '47', '60', '303', '45', '2544', '3921', null, null, '12847', '2544', null, null);
INSERT INTO `report_cache` VALUES ('23', '2018-01-23', '52', '1840', '155', '12', null, null, '59', '70', '9', '19', '247', '117', '4649', '363', null, null, '7593', '4649', null, null);
INSERT INTO `report_cache` VALUES ('24', '2018-01-24', '72', '1665', '255', '18', null, null, '69', '39', '17', '23', '312', '110', '4617', '402', null, null, '7599', '4617', null, null);
INSERT INTO `report_cache` VALUES ('25', '2018-01-25', '182', '5025', '689', '45', null, null, '19', '48', '47', '81', '702', '39', '3946', '2464', null, null, '13287', '3946', null, null);
INSERT INTO `report_cache` VALUES ('26', '2018-01-26', '33', '1458', '135', '25', null, null, '2', '36', '10', '23', '241', '45', '4183', '321', '21', null, '6550', '4183', null, null);
INSERT INTO `report_cache` VALUES ('27', '2018-01-27', '54', '2051', '185', '21', null, null, '38', '38', '23', '59', '193', '37', '2463', '741', '148', null, '6051', '2463', null, null);
INSERT INTO `report_cache` VALUES ('28', '2018-01-28', '22', '919', '52', '16', '1', null, '1', '10', '8', '14', '118', '83', '2336', '298', '58', null, '3936', '2336', null, null);
INSERT INTO `report_cache` VALUES ('29', '2018-01-29', '58', '2399', '247', '20', null, '1', '36', '13', '7', '34', '519', '52', '4978', '609', '94', null, '9067', '4978', null, null);
INSERT INTO `report_cache` VALUES ('30', '2018-01-30', '68', '2126', '240', '16', null, '1', '47', '41', '35', '22', '332', '98', '4838', '365', '144', null, '8373', '4838', null, null);
INSERT INTO `report_cache` VALUES ('31', '2018-02-01', '94', '3637', '303', '34', null, null, '47', '13', '19', '15', '381', '79', '4135', '966', '193', null, '9916', '4135', null, null);
INSERT INTO `report_cache` VALUES ('32', '2018-02-02', '86', '4406', '407', '31', null, null, '34', '70', '15', '28', '240', '26', '1834', '1428', '417', null, '9022', '1834', null, null);
INSERT INTO `report_cache` VALUES ('33', '2018-02-03', '37', '1632', '157', '9', null, null, '2', '8', '1', '4', '72', '28', '2000', '304', '147', null, '4401', '2000', null, null);
INSERT INTO `report_cache` VALUES ('34', '2018-02-04', '33', '912', '53', '5', null, null, null, '9', '15', '8', '50', '34', '2414', '85', '65', null, '3683', '2414', null, null);
INSERT INTO `report_cache` VALUES ('35', '2018-02-05', '69', '2087', '210', '18', null, null, '5', '10', '20', '14', '124', '37', '4757', '142', '46', null, '7539', '4757', null, null);
INSERT INTO `report_cache` VALUES ('36', '2018-02-06', '150', '3266', '527', '22', null, null, '19', '26', '26', '34', '243', '45', '4449', '115', '178', null, '9100', '4449', null, null);
INSERT INTO `report_cache` VALUES ('37', '2018-02-07', '210', '5862', '1014', '61', null, null, '40', '161', '75', '24', '521', '43', '3672', '2159', '1124', null, '14966', '3672', null, null);
INSERT INTO `report_cache` VALUES ('38', '2018-02-08', '206', '6075', '1041', '59', null, null, '61', '66', '42', '47', '1534', '33', '3415', '2212', '773', null, '15564', '3415', null, null);
INSERT INTO `report_cache` VALUES ('39', '2018-02-09', '279', '7042', '1222', '74', null, null, '102', '114', '71', '74', '3893', '54', '3578', '349', '109', null, '16961', '3578', null, null);
INSERT INTO `report_cache` VALUES ('40', '2018-02-10', '28', '794', '153', '7', null, null, '58', '14', '12', '19', '438', '24', '794', '22', '4', null, '2367', '794', null, null);
INSERT INTO `report_cache` VALUES ('41', '2018-02-11', null, '30', '9', null, null, null, null, null, null, null, '58', null, '290', null, null, null, '387', '290', null, null);
INSERT INTO `report_cache` VALUES ('42', '2018-02-12', '251', '5126', '942', '50', null, null, '97', '52', '37', '53', '2347', '39', '5552', '332', '49', null, '14927', '5552', null, null);
INSERT INTO `report_cache` VALUES ('43', '2018-02-13', '272', '6070', '1312', '72', null, null, '113', '69', '39', '65', '3236', '71', '5294', '531', '94', null, '17238', '5294', null, null);
INSERT INTO `report_cache` VALUES ('44', '2018-02-14', '202', '4217', '855', '46', null, null, '83', '48', '53', '59', '1853', '75', '5436', '251', '38', null, '13216', '5436', null, null);
INSERT INTO `report_cache` VALUES ('45', '2018-02-15', '212', '4175', '557', '27', null, null, '82', '64', '40', '63', '816', '59', '4625', '74', '29', null, '10823', '4625', null, null);
INSERT INTO `report_cache` VALUES ('46', '2018-02-16', '192', '6849', '759', '45', null, null, '26', '34', '23', '21', '857', '22', '4419', '92', '17', null, '13356', '4419', null, null);
INSERT INTO `report_cache` VALUES ('47', '2018-02-17', '27', '734', '106', '6', null, null, '7', '17', '8', '13', '74', '20', '619', '38', '4', null, '1673', '619', null, null);
INSERT INTO `report_cache` VALUES ('48', '2018-02-18', '8', '202', '9', '2', null, null, null, null, '8', '10', '7', '1', '153', null, '4', null, '404', '153', null, null);
INSERT INTO `report_cache` VALUES ('49', '2018-02-19', '295', '6589', '952', '30', null, null, '37', '50', '53', '44', '1196', '44', '5285', '82', '24', null, '14681', '5285', null, null);
INSERT INTO `report_cache` VALUES ('50', '2018-02-20', '180', '4474', '559', '24', null, null, '56', '71', '43', '36', '643', '91', '5387', '60', '55', null, '11679', '5387', null, null);
INSERT INTO `report_cache` VALUES ('51', '2018-02-21', '196', '5952', '777', '41', null, null, '42', '61', '55', '44', '715', '70', '5323', '107', '68', null, '13451', '5323', null, null);
INSERT INTO `report_cache` VALUES ('52', '2018-02-22', '224', '6533', '924', '43', null, null, '38', '57', '44', '50', '1036', '35', '5154', '85', '64', null, '14287', '5154', null, null);
INSERT INTO `report_cache` VALUES ('53', '2018-02-23', '153', '4360', '556', '37', null, null, '22', '61', '30', '33', '620', '69', '5259', '47', '31', null, '11278', '5259', null, null);
INSERT INTO `report_cache` VALUES ('54', '2018-02-24', '300', '7939', '970', '48', null, null, '81', '98', '38', '67', '1142', '36', '5054', '140', '55', null, '15968', '5054', null, null);
INSERT INTO `report_cache` VALUES ('55', '2018-02-25', '1', '63', '13', '6', null, null, null, null, '2', '1', '17', null, '400', '14', null, null, '517', '400', null, null);
INSERT INTO `report_cache` VALUES ('56', '2018-02-26', '234', '6868', '1046', '45', null, null, '86', '74', '41', '58', '1163', '40', '4882', '143', '106', null, '14786', '4882', null, null);
INSERT INTO `report_cache` VALUES ('57', '2018-02-27', '285', '7490', '1084', '54', null, null, '40', '111', '41', '54', '1340', '31', '4981', '154', '129', null, '15794', '4981', null, null);
INSERT INTO `report_cache` VALUES ('58', '2018-03-01', '218', '5868', '807', '44', null, null, '39', '101', '63', '29', '809', '45', '4875', '105', '73', null, '13077', '4875', null, null);
INSERT INTO `report_cache` VALUES ('59', '2018-03-02', '162', '5198', '755', '32', null, null, '54', '42', '31', '45', '1094', '33', '5283', '83', '76', null, '12888', '5283', null, null);
INSERT INTO `report_cache` VALUES ('60', '2018-03-03', '23', '820', '76', '3', null, null, null, '4', '2', '1', '192', '4', '724', '1', '3', null, '1853', '724', null, null);
INSERT INTO `report_cache` VALUES ('61', '2018-03-04', null, '36', '6', '1', null, null, null, null, null, null, '26', null, '317', null, null, null, '386', '317', null, null);
INSERT INTO `report_cache` VALUES ('62', '2018-03-05', '106', '2838', '410', '31', null, null, '54', '59', '24', '27', '593', '76', '5405', '46', '40', null, '9709', '5405', null, null);
INSERT INTO `report_cache` VALUES ('63', '2018-03-06', '85', '2604', '335', '18', null, null, '81', '51', '27', '19', '686', '88', '5331', '116', '23', null, '9464', '5331', null, null);
INSERT INTO `report_cache` VALUES ('64', '2018-03-07', '45', '2056', '240', '17', null, null, '38', '34', '11', '22', '550', '85', '5480', '114', '34', null, '8726', '5480', null, null);
INSERT INTO `report_cache` VALUES ('65', '2018-03-08', '101', '2941', '372', '18', null, null, '32', '57', '23', '23', '1196', '66', '5773', '134', '154', null, '10890', '5773', null, null);
INSERT INTO `report_cache` VALUES ('66', '2018-03-09', '145', '3940', '611', '41', null, null, '32', '87', '14', '19', '1493', '37', '4834', '74', '62', null, '11389', '4834', null, null);
INSERT INTO `report_cache` VALUES ('67', '2018-03-10', '142', '3885', '627', '33', null, null, '34', '57', '16', '38', '860', '30', '5780', '59', '32', null, '11593', '5780', null, null);
INSERT INTO `report_cache` VALUES ('68', '2018-03-11', '1', '149', '16', '5', null, null, null, '2', null, '2', '27', '1', '523', '17', '7', null, '750', '523', null, null);
INSERT INTO `report_cache` VALUES ('69', '2018-03-12', '73', '2250', '227', '14', null, null, '9', '57', '18', '18', '250', '101', '5957', '3', '35', null, '9012', '5957', null, null);
INSERT INTO `report_cache` VALUES ('70', '2018-03-13', '153', '4381', '570', '54', null, null, '4', '82', '24', '25', '1397', '13', '5428', '116', '100', null, '12349', '5428', null, null);
INSERT INTO `report_cache` VALUES ('71', '2018-03-14', '102', '2817', '322', '29', null, null, '30', '77', '31', '26', '1124', '103', '5674', '152', '85', null, '10572', '5674', null, null);
INSERT INTO `report_cache` VALUES ('72', '2018-03-15', '132', '3053', '555', '25', null, null, '28', '47', '10', '22', '746', '46', '5764', '96', '46', null, '10570', '5764', null, null);
INSERT INTO `report_cache` VALUES ('73', '2018-03-16', '142', '4673', '655', '22', null, null, '20', '102', '25', '25', '1688', '35', '3919', '200', '110', null, '11616', '3919', null, null);
INSERT INTO `report_cache` VALUES ('74', '2018-03-17', '7', '308', '51', '4', null, null, '34', '5', '7', '8', '43', '13', '391', '110', null, null, '981', '391', null, null);
INSERT INTO `report_cache` VALUES ('75', '2018-03-18', '2', '52', '10', '2', null, null, null, '2', null, null, '20', null, '343', '44', '2', null, '477', '343', null, null);
INSERT INTO `report_cache` VALUES ('76', '2018-03-19', '192', '4853', '936', '33', null, null, '63', '115', '26', '59', '3094', '49', '4670', '380', '196', null, '14666', '4670', null, null);
INSERT INTO `report_cache` VALUES ('77', '2018-03-20', '167', '4185', '579', '22', null, null, '14', '69', '18', '36', '1464', '46', '4142', '141', '101', null, '10984', '4142', null, null);
INSERT INTO `report_cache` VALUES ('78', '2018-03-21', '147', '5123', '632', '50', null, null, '15', '93', '27', '21', '1811', '28', '4436', '231', '41', null, '12655', '4436', null, null);
INSERT INTO `report_cache` VALUES ('79', '2018-03-22', '162', '5167', '660', '54', null, null, '17', '94', '44', '34', '2213', '92', '4955', '306', '88', null, '13886', '4955', null, null);
INSERT INTO `report_cache` VALUES ('80', '2018-03-23', '174', '4979', '764', '33', null, null, '29', '106', '31', '30', '1527', '32', '2718', '135', '64', null, '10622', '2718', null, null);
INSERT INTO `report_cache` VALUES ('81', '2018-03-24', '243', '7898', '1070', '66', null, null, '23', '179', '82', '50', '3012', '53', '4467', '303', '104', null, '17550', '4467', null, null);
INSERT INTO `report_cache` VALUES ('82', '2018-03-25', '9', '139', '10', null, null, null, null, null, null, '1', '6', '1', '321', '19', '7', null, '513', '321', null, null);
INSERT INTO `report_cache` VALUES ('83', '2018-03-26', '317', '8790', '1524', '82', null, null, '20', '127', '70', '64', '3538', '20', '5170', '236', '124', null, '20082', '5170', null, null);
INSERT INTO `report_cache` VALUES ('84', '2018-03-27', '390', '9862', '1649', '87', null, null, '32', '153', '92', '68', '4612', '45', '4813', '346', '202', null, '22351', '4813', null, null);
INSERT INTO `report_cache` VALUES ('85', '2018-03-28', '211', '5169', '804', '54', null, null, '14', '74', '45', '41', '2249', '72', '5377', '196', '79', null, '14385', '5377', null, null);
INSERT INTO `report_cache` VALUES ('86', '2018-03-29', '108', '2736', '393', '30', null, null, '5', '47', '26', '13', '942', '42', '3168', '45', '17', null, '7572', '3168', null, null);
INSERT INTO `report_cache` VALUES ('87', '2018-03-30', '1', '2', null, null, null, null, '1', '1', '1', '3', '3', '4', '192', '1', null, null, '209', '192', null, null);
INSERT INTO `report_cache` VALUES ('88', '2018-04-01', null, null, null, null, null, null, null, null, null, null, null, null, '263', null, null, null, '263', '262', '1', null);
INSERT INTO `report_cache` VALUES ('89', '2018-04-02', '220', '4952', '940', '51', null, null, '17', '112', '21', '43', '4667', '67', '6023', '276', '239', null, '17628', '6023', null, null);
INSERT INTO `report_cache` VALUES ('90', '2018-04-03', '202', '5811', '992', '57', null, null, '21', '159', '46', '52', '4430', '68', '4813', '116', '345', null, '17113', '4813', null, null);
INSERT INTO `report_cache` VALUES ('91', '2018-04-04', '287', '8437', '1549', '75', null, null, '50', '152', '50', '70', '6051', '24', '5204', '284', '437', null, '22670', '5204', null, null);
INSERT INTO `report_cache` VALUES ('92', '2018-04-05', '282', '7854', '1627', '84', null, null, '39', '96', '46', '41', '6997', '9', '5085', '397', '414', null, '22971', '5085', null, null);
INSERT INTO `report_cache` VALUES ('93', '2018-04-06', '122', '3840', '686', '37', null, null, '9', '88', '13', '23', '2503', '81', '5105', '84', '221', null, '12812', '5105', null, null);
INSERT INTO `report_cache` VALUES ('94', '2018-04-07', '74', '1808', '354', '14', null, null, '1', '34', '7', '7', '507', '2', '2425', '3', '9', null, '5245', '2425', null, null);
INSERT INTO `report_cache` VALUES ('95', '2018-04-08', '2', '41', '17', '1', null, null, null, null, null, null, '2', null, '361', null, null, null, '424', '361', null, null);
INSERT INTO `report_cache` VALUES ('96', '2018-04-09', '99', '3049', '578', '22', null, null, '4', '28', '24', '13', '1004', '41', '5744', '19', '33', null, '10658', '5744', null, null);
INSERT INTO `report_cache` VALUES ('97', '2018-04-10', '203', '5819', '1348', '34', null, null, '13', '52', '29', '36', '3009', '14', '4243', '110', '271', null, '15181', '4243', null, null);
INSERT INTO `report_cache` VALUES ('98', '2018-04-11', '236', '7034', '1621', '84', null, null, '7', '97', '13', '48', '5181', '4', '5002', '101', '455', null, '19883', '5002', null, null);
INSERT INTO `report_cache` VALUES ('99', '2018-04-12', '167', '6513', '1315', '56', null, null, '4', '67', '9', '56', '4365', '12', '4676', '89', '280', null, '17609', '4676', null, null);
INSERT INTO `report_cache` VALUES ('100', '2018-04-13', '220', '6825', '1384', '49', null, null, '12', '68', '13', '39', '5538', '20', '5008', '121', '277', null, '19574', '5008', null, null);
INSERT INTO `report_cache` VALUES ('101', '2018-04-14', '184', '6590', '1103', '47', null, '1', '12', '59', '23', '48', '4320', '3', '4268', '209', '341', null, '17208', '4268', null, null);
INSERT INTO `report_cache` VALUES ('102', '2018-04-15', '19', '557', '92', null, null, null, '2', '21', null, '3', '375', null, '600', '21', '1', null, '1691', '600', null, null);
INSERT INTO `report_cache` VALUES ('103', '2018-04-16', '270', '5783', '1276', '20', '1', null, '10', '45', '32', '41', '3379', '9', '4553', '74', '189', null, '15682', '4553', null, null);
INSERT INTO `report_cache` VALUES ('104', '2018-04-17', '194', '5061', '1118', '31', null, null, '5', '62', '15', '38', '2443', '8', '5623', '12', '76', null, '14686', '5623', null, null);
INSERT INTO `report_cache` VALUES ('105', '2018-04-18', '191', '5112', '1018', '32', null, null, '7', '56', '13', '32', '2093', '11', '5219', '4', '16', null, '13804', '5219', null, null);
INSERT INTO `report_cache` VALUES ('106', '2018-04-19', '149', '3869', '648', '29', null, null, '7', '58', '17', '18', '1393', '14', '5200', '3', '1', null, '11406', '5200', null, null);
INSERT INTO `report_cache` VALUES ('107', '2018-04-20', '27', '1310', '85', '3', null, null, null, '31', '17', '2', '125', '47', '4257', null, '1', null, '5905', '4257', null, null);
INSERT INTO `report_cache` VALUES ('108', '2018-04-21', '1', '112', '5', null, null, null, null, null, null, null, null, null, '830', null, null, null, '948', '830', null, null);
INSERT INTO `report_cache` VALUES ('109', '2018-04-22', '3', '19', '2', null, null, null, null, null, null, null, null, null, '181', null, null, null, '205', '181', null, null);
INSERT INTO `report_cache` VALUES ('110', '2018-04-23', '66', '2667', '327', '12', null, null, null, '35', '11', '9', '530', '33', '5775', '3', null, null, '9468', '5775', null, null);
INSERT INTO `report_cache` VALUES ('111', '2018-04-24', '174', '8245', '821', '34', null, null, '1', '219', '60', '25', '1905', '14', '5108', '6', '42', null, '16654', '5108', null, null);
INSERT INTO `report_cache` VALUES ('112', '2018-04-25', '239', '8160', '1415', '47', null, null, '10', '141', '28', '41', '4964', '9', '5078', '223', '164', null, '20519', '5078', null, null);
INSERT INTO `report_cache` VALUES ('113', '2018-04-26', '151', '7248', '1354', '81', null, null, '6', '176', '14', '53', '5104', '6', '4607', '183', '67', null, '19051', '4607', null, null);
INSERT INTO `report_cache` VALUES ('114', '2018-04-27', '171', '6518', '1432', '50', null, null, '7', '50', '7', '41', '5157', '4', '4223', '173', '151', null, '17984', '4223', null, null);
INSERT INTO `report_cache` VALUES ('115', '2018-04-28', '31', '914', '223', '14', null, null, '3', '9', '1', '8', '746', null, '858', null, '100', null, '2907', '858', null, null);
INSERT INTO `report_cache` VALUES ('116', '2018-04-29', null, null, null, null, null, null, null, null, null, null, null, null, '135', null, null, null, '135', '135', null, null);
INSERT INTO `report_cache` VALUES ('117', '2018-05-01', '13', '824', '175', '8', null, null, '2', '8', '1', '6', '1121', '1', '781', '9', '15', null, '2964', '781', null, null);
INSERT INTO `report_cache` VALUES ('118', '2018-05-02', '232', '6615', '1520', '54', null, null, '11', '103', '19', '41', '6917', '8', '5193', '14', '617', null, '21344', '5193', null, null);
INSERT INTO `report_cache` VALUES ('119', '2018-05-03', '188', '6880', '1083', '34', null, null, '6', '59', '26', '29', '4769', '3', '5302', '13', '61', null, '18454', '5302', null, null);
INSERT INTO `report_cache` VALUES ('120', '2018-05-04', '263', '7399', '1223', '41', null, null, '6', '79', '31', '29', '4336', '4', '5084', null, '19', null, '18514', '5084', null, null);
INSERT INTO `report_cache` VALUES ('121', '2018-05-05', '36', '1458', '139', '2', null, null, '1', '22', '1', '7', '666', null, '1187', '2', '89', null, '3610', '1187', null, null);
INSERT INTO `report_cache` VALUES ('122', '2018-05-06', '1', '125', '5', null, null, null, null, '6', null, null, '2', '4', '366', null, null, null, '509', '366', null, null);
INSERT INTO `report_cache` VALUES ('123', '2018-05-07', '227', '5514', '1083', '27', null, null, '12', '56', '20', '25', '2862', '71', '5500', '3', '165', null, '15565', '5500', null, null);
INSERT INTO `report_cache` VALUES ('124', '2018-05-08', '296', '6126', '1533', '44', null, null, '9', '51', '12', '54', '8450', '15', '4394', '9', '428', null, '21421', '4394', null, null);
INSERT INTO `report_cache` VALUES ('125', '2018-05-09', '293', '6605', '1562', '53', null, null, '12', '43', '17', '68', '10360', '8', '4788', '9', '512', null, '24330', '4788', null, null);
INSERT INTO `report_cache` VALUES ('126', '2018-05-10', '312', '7446', '1571', '61', null, null, '15', '55', '14', '73', '10553', '8', '4774', '15', '512', null, '25409', '4774', null, null);
INSERT INTO `report_cache` VALUES ('127', '2018-05-11', '290', '6777', '1703', '60', null, null, '13', '70', '15', '58', '9184', '3', '4873', '6', '479', null, '23531', '4873', null, null);
INSERT INTO `report_cache` VALUES ('128', '2018-05-12', '39', '935', '168', '8', null, null, null, '2', null, '3', '517', '1', '1033', '19', '11', null, '2736', '1033', null, null);
INSERT INTO `report_cache` VALUES ('129', '2018-05-13', '5', '273', '44', null, null, null, '1', null, '3', null, '103', null, '507', null, null, null, '936', '507', null, null);
INSERT INTO `report_cache` VALUES ('130', '2018-05-14', '98', '1950', '498', '10', null, null, '3', '18', '4', '8', '431', '13', '5734', null, '27', null, '8794', '5734', null, null);
INSERT INTO `report_cache` VALUES ('131', '2018-05-15', '165', '3482', '804', '22', null, null, '2', '30', '12', '25', '666', '10', '5689', '3', '7', null, '10917', '5689', null, null);
INSERT INTO `report_cache` VALUES ('132', '2018-05-16', '165', '3698', '974', '28', null, null, '8', '34', '14', '22', '586', '7', '5633', '1', null, null, '11170', '5633', null, null);
INSERT INTO `report_cache` VALUES ('133', '2018-05-17', '226', '4797', '1137', '38', null, null, '9', '62', '16', '24', '1538', '2', '5428', '1', '31', null, '13309', '5428', null, null);
INSERT INTO `report_cache` VALUES ('134', '2018-05-18', '155', '4268', '889', '23', null, null, '4', '45', '3', '24', '1530', '4', '5739', '7', '25', null, '12716', '5739', null, null);
INSERT INTO `report_cache` VALUES ('135', '2018-05-19', '3', '157', '20', null, null, null, null, null, null, null, '33', null, '810', null, null, null, '1023', '810', null, null);
INSERT INTO `report_cache` VALUES ('136', '2018-05-20', '1', '2', null, null, null, null, null, null, null, null, null, '3', '409', null, null, null, '415', '409', null, null);
INSERT INTO `report_cache` VALUES ('137', '2018-05-21', '97', '2946', '452', '12', null, null, '1', '10', '12', '6', '287', '13', '5736', null, '1', null, '9573', '5736', null, null);
INSERT INTO `report_cache` VALUES ('138', '2018-05-22', '49', '2938', '118', '5', null, null, null, '51', '16', '3', '44', '21', '6162', '1', null, null, '9408', '6162', null, null);
INSERT INTO `report_cache` VALUES ('139', '2018-05-23', '80', '3583', '190', '15', null, null, null, '84', '6', '1', '61', '9', '6477', '2', null, null, '10508', '6477', null, null);
INSERT INTO `report_cache` VALUES ('140', '2018-05-24', '99', '4425', '263', '14', null, '1', null, '85', '9', '3', '47', '8', '6339', '4', '1', null, '11298', '6339', null, null);
INSERT INTO `report_cache` VALUES ('141', '2018-05-25', '93', '4072', '266', '15', null, null, null, '78', '8', '4', '52', '8', '6333', '1', '1', null, '10931', '6333', null, null);
INSERT INTO `report_cache` VALUES ('142', '2018-05-26', '17', '314', '20', '2', null, null, null, '2', null, null, '7', null, '1495', null, null, null, '1857', '1495', null, null);
INSERT INTO `report_cache` VALUES ('143', '2018-05-27', null, null, null, null, null, null, null, null, null, null, null, null, '772', null, null, null, '772', '772', null, null);
INSERT INTO `report_cache` VALUES ('144', '2018-05-28', '135', '4805', '485', '12', null, null, null, '67', '40', '18', '233', '2', '5769', '4', '1', null, '11571', '5769', null, null);
INSERT INTO `report_cache` VALUES ('145', '2018-05-29', '148', '6048', '783', '31', null, null, '1', '101', '40', '41', '317', '17', '5860', '2', '33', null, '13422', '5860', null, null);
INSERT INTO `report_cache` VALUES ('146', '2018-05-30', '126', '8523', '607', '47', null, null, '2', '262', '55', '31', '781', '7', '5464', null, null, null, '15905', '5464', null, null);
INSERT INTO `report_cache` VALUES ('147', '2018-06-01', '94', '3828', '380', '21', null, null, null, '98', '44', '26', '363', '17', '6051', '10', '1', null, '10933', '6050', '1', null);
INSERT INTO `report_cache` VALUES ('148', '2018-06-02', '3', '224', '11', '1', null, null, null, '12', '6', '2', null, null, '849', null, null, null, '1108', '849', null, null);
INSERT INTO `report_cache` VALUES ('149', '2018-06-03', '1', '107', '14', null, null, null, null, '9', null, null, '2', null, '911', null, null, null, '1044', '911', null, null);
INSERT INTO `report_cache` VALUES ('150', '2018-06-04', '174', '4591', '878', '25', null, null, '1', '155', '42', '24', '659', '8', '6021', '3', null, null, '12581', '6021', null, null);
INSERT INTO `report_cache` VALUES ('151', '2018-06-05', '122', '4487', '459', '23', null, null, '1', '132', '45', '17', '594', '8', '6141', '17', '56', null, '12102', '6141', null, null);
INSERT INTO `report_cache` VALUES ('152', '2018-06-06', '118', '6744', '543', '27', null, null, null, '167', '35', '36', '904', '8', '5260', '2', '40', null, '13884', '5260', null, null);
INSERT INTO `report_cache` VALUES ('153', '2018-06-07', '193', '6853', '909', '30', null, null, '1', '63', '18', '35', '487', '1', '5350', '12', '2', null, '13954', '5350', null, null);
INSERT INTO `report_cache` VALUES ('154', '2018-06-08', '106', '3861', '451', '17', null, null, null, '61', '26', '16', '212', '4', '5856', null, null, null, '10610', '5856', null, null);
INSERT INTO `report_cache` VALUES ('155', '2018-06-09', '14', '543', '83', '2', null, null, null, null, '1', null, '12', null, '1253', '1', null, null, '1909', '1253', null, null);
INSERT INTO `report_cache` VALUES ('156', '2018-06-10', null, '61', '7', '2', null, null, null, '2', null, null, '5', null, '803', null, null, null, '880', '803', null, null);
INSERT INTO `report_cache` VALUES ('157', '2018-06-11', '78', '3091', '436', '13', null, null, null, '29', '2', '11', '205', '7', '5580', null, null, null, '9452', '5580', null, null);
INSERT INTO `report_cache` VALUES ('158', '2018-06-12', '98', '3211', '402', '22', null, null, '2', '21', '7', '18', '330', '2', '4914', null, null, null, '9027', '4914', null, null);
INSERT INTO `report_cache` VALUES ('159', '2018-06-13', '102', '4086', '549', '16', null, null, '1', '17', '5', '13', '717', '5', '4526', '1', '1', null, '10039', '4526', null, null);
INSERT INTO `report_cache` VALUES ('160', '2018-06-14', '46', '2208', '195', '9', null, null, null, '8', '3', '10', '300', '12', '4949', null, null, null, '7740', '4949', null, null);
INSERT INTO `report_cache` VALUES ('161', '2018-06-15', '27', '1', '4', null, null, null, null, null, null, null, '1', '2', '1828', null, null, null, '1863', '1828', null, null);
INSERT INTO `report_cache` VALUES ('162', '2018-06-16', '106', '29', '6', null, null, null, null, '13', null, '1', '4', null, '2187', null, '1', null, '2347', '2187', null, null);
INSERT INTO `report_cache` VALUES ('163', '2018-06-17', '234', '12', '2', null, null, null, null, '8', '1', '3', '15', '3', '2233', '1', null, null, '2512', '2233', null, null);
INSERT INTO `report_cache` VALUES ('164', '2018-06-18', '202', '44', '9', null, null, null, null, '10', '14', '3', '13', '6', '4285', null, null, null, '4586', '4285', null, null);
INSERT INTO `report_cache` VALUES ('165', '2018-06-19', '24', '17', '4', null, null, null, null, '19', '9', null, '3', '2', '4440', null, null, null, '4518', '4440', null, null);
INSERT INTO `report_cache` VALUES ('166', '2018-06-20', '26', '1067', '46', '2', null, null, null, '6', '1', '3', '57', null, '5007', null, null, null, '6215', '5007', null, null);
INSERT INTO `report_cache` VALUES ('167', '2018-06-21', '17', '846', '75', '2', null, null, null, '17', '4', '3', '29', '1', '4295', null, null, null, '5289', '4295', null, null);
INSERT INTO `report_cache` VALUES ('168', '2018-06-22', '158', '815', '91', '2', null, null, null, '23', '3', '3', '38', null, '3852', null, null, null, '4985', '3852', null, null);
INSERT INTO `report_cache` VALUES ('169', '2018-06-23', '79', '106', '8', '1', null, null, null, '19', '3', null, '23', null, '3065', null, null, null, '3304', '3065', null, null);
INSERT INTO `report_cache` VALUES ('170', '2018-06-24', '20', '1148', '90', '2', null, null, '2', '4', '6', '2', '81', null, '2562', null, null, null, '3917', '2562', null, null);
INSERT INTO `report_cache` VALUES ('171', '2018-06-25', '41', '1549', '173', '13', null, null, null, '8', '7', '2', '76', '3', '2967', '1', null, null, '4840', '2967', null, null);
INSERT INTO `report_cache` VALUES ('172', '2018-06-26', '44', '1223', '170', '4', null, null, '1', '8', '6', null, '29', '2', '2576', null, null, null, '4063', '2576', null, null);
INSERT INTO `report_cache` VALUES ('173', '2018-06-27', '59', '2006', '237', '7', null, null, null, '19', '15', '9', '151', '5', '2613', '1', null, null, '5122', '2613', null, null);
INSERT INTO `report_cache` VALUES ('174', '2018-06-28', '59', '1718', '146', '7', null, null, null, '8', '20', '3', '64', '4', '2458', null, null, null, '4487', '2458', null, null);
INSERT INTO `report_cache` VALUES ('175', '2018-06-29', '24', '1244', '164', '7', null, null, null, '18', '15', '1', '38', '1', '1802', null, null, null, '3314', '1802', null, null);
INSERT INTO `report_cache` VALUES ('176', '2018-07-01', '44', '1661', '120', '2', null, null, null, '23', '5', '6', '28', '1', '2284', null, null, null, '4174', '2280', '4', null);
INSERT INTO `report_cache` VALUES ('177', '2018-07-02', '39', '1345', '122', '5', null, null, null, '15', '2', '2', '87', null, '2613', '1', null, null, '4231', '2613', null, null);
INSERT INTO `report_cache` VALUES ('178', '2018-07-03', '39', '1640', '138', '7', null, null, null, '42', '7', '7', '127', '3', '2301', null, null, null, '4311', '2301', null, null);
INSERT INTO `report_cache` VALUES ('179', '2018-07-04', '66', '2059', '192', '10', null, null, '1', '44', '9', '9', '59', null, '2064', '2', null, null, '4515', '2064', null, null);
INSERT INTO `report_cache` VALUES ('180', '2018-07-05', '37', '1582', '191', '6', null, null, '1', '17', '1', '9', '70', null, '1857', null, null, null, '3771', '1857', null, null);
INSERT INTO `report_cache` VALUES ('181', '2018-07-06', '46', '1717', '190', '13', null, null, null, '12', '17', '8', '98', '1', '2198', null, null, null, '4300', '2198', null, null);
INSERT INTO `report_cache` VALUES ('182', '2018-07-07', '29', '1099', '113', '4', null, null, null, '10', '12', '5', '39', null, '1416', null, null, null, '2727', '1416', null, null);
INSERT INTO `report_cache` VALUES ('183', '2018-07-08', '15', '891', '98', '2', null, null, null, '12', '10', '3', '39', null, '737', null, null, null, '1807', '737', null, null);
INSERT INTO `report_cache` VALUES ('184', '2018-07-09', '53', '2864', '375', '16', null, null, null, '13', '6', '11', '97', '3', '2325', null, null, null, '5763', '2325', null, null);
INSERT INTO `report_cache` VALUES ('185', '2018-07-10', '57', '2494', '311', '3', null, null, null, '23', '5', '7', '129', '3', '2612', null, null, null, '5644', '2612', null, null);
INSERT INTO `report_cache` VALUES ('186', '2018-07-11', '52', '2098', '341', '15', null, null, null, '32', '4', '8', '103', '3', '2896', null, null, null, '5552', '2896', null, null);
INSERT INTO `report_cache` VALUES ('187', '2018-07-12', '80', '2227', '391', '12', null, null, null, '25', '5', '10', '74', null, '2613', '2', null, null, '5439', '2613', null, null);
INSERT INTO `report_cache` VALUES ('188', '2018-07-13', '80', '2001', '338', '5', null, null, null, '17', '15', '18', '187', '4', '1924', null, null, null, '4589', '1924', null, null);
INSERT INTO `report_cache` VALUES ('189', '2018-07-14', '31', '1564', '350', '6', null, null, '1', '14', '6', '19', '41', null, '2460', null, null, null, '4492', '2460', null, null);
INSERT INTO `report_cache` VALUES ('190', '2018-07-15', '28', '1529', '195', '4', null, null, null, '2', '5', '5', '93', null, '2611', null, null, null, '4472', '2611', null, null);
INSERT INTO `report_cache` VALUES ('191', '2018-07-16', '150', '4016', '918', '28', null, null, '1', '77', '20', '14', '212', '2', '4090', '4', '1', null, '9533', '4090', null, null);
INSERT INTO `report_cache` VALUES ('192', '2018-07-17', '134', '3766', '657', '20', null, null, null, '106', '14', '25', '148', null, '4588', '1', '1', null, '9460', '4588', null, null);
INSERT INTO `report_cache` VALUES ('193', '2018-07-18', '113', '4207', '752', '21', null, null, '2', '57', '21', '9', '139', '1', '5083', '1', '1', null, '10407', '5083', null, null);
INSERT INTO `report_cache` VALUES ('194', '2018-07-19', '130', '4314', '793', '28', null, null, '1', '130', '10', '17', '189', '2', '5088', '3', '2', null, '10707', '5088', null, null);
INSERT INTO `report_cache` VALUES ('195', '2018-07-20', '113', '4107', '532', '18', null, null, null, '10', '10', '13', '141', '18', '5028', '2', null, null, '9992', '5028', null, null);
INSERT INTO `report_cache` VALUES ('196', '2018-07-21', '2', '208', '27', null, null, null, null, '2', null, '1', '5', null, '397', null, null, null, '642', '397', null, null);
INSERT INTO `report_cache` VALUES ('197', '2018-07-22', null, null, null, null, null, null, null, null, null, null, null, null, '216', null, null, null, '216', '216', null, null);
INSERT INTO `report_cache` VALUES ('198', '2018-07-23', '114', '4581', '592', '23', null, null, null, '43', '15', '28', '389', '3', '4847', null, '1', null, '10637', '4847', null, null);
INSERT INTO `report_cache` VALUES ('199', '2018-07-24', '109', '4495', '568', '20', null, null, null, '42', '21', '27', '425', '2', '4822', '4', '2', null, '10537', '4822', null, null);
INSERT INTO `report_cache` VALUES ('200', '2018-07-25', '98', '3487', '379', '11', null, null, null, '62', '5', '20', '345', '2', '5025', '3', '4', null, '9441', '5025', null, null);
INSERT INTO `report_cache` VALUES ('201', '2018-07-26', '78', '3945', '348', '25', null, null, '1', '78', '15', '17', '287', '10', '4862', '1', '3', null, '9670', '4862', null, null);
INSERT INTO `report_cache` VALUES ('202', '2018-07-27', '6', '5148', '91', '2', null, null, null, null, null, '3', '4', '2', '6291', null, null, null, '11547', '6291', null, null);
INSERT INTO `report_cache` VALUES ('203', '2018-07-28', '6', '3206', '25', null, null, null, null, null, null, '1', '3', '3', '2328', null, null, null, '5572', '2328', null, null);
INSERT INTO `report_cache` VALUES ('204', '2018-07-29', null, '1667', '11', null, null, null, null, null, null, null, null, null, '1489', null, null, null, '3167', '1489', null, null);
INSERT INTO `report_cache` VALUES ('205', '2018-07-30', '142', '6177', '611', '27', null, null, null, '76', '8', '27', '30', null, '1740', null, null, null, '8838', '1740', null, null);
INSERT INTO `report_cache` VALUES ('206', '2018-08-01', '172', '7931', '774', '30', null, null, '3', '107', '16', '11', '51', '4', '2420', null, null, null, '11519', '2417', '3', null);
INSERT INTO `report_cache` VALUES ('207', '2018-08-02', '93', '4326', '411', '16', null, null, null, '72', '5', '9', '33', '1', '3876', '1', null, null, '8843', '3876', null, null);
INSERT INTO `report_cache` VALUES ('208', '2018-08-03', '115', '7633', '659', '18', null, null, '5', '109', '14', '5', '32', '2', '1957', null, '1', null, '10550', '1957', null, null);
INSERT INTO `report_cache` VALUES ('209', '2018-08-04', '2', '6', '1', null, null, null, null, null, null, null, '1', null, '434', null, null, null, '444', '434', null, null);
INSERT INTO `report_cache` VALUES ('210', '2018-08-05', null, null, null, null, null, null, null, null, null, null, null, '2', '374', null, null, null, '376', '374', null, null);
INSERT INTO `report_cache` VALUES ('211', '2018-08-06', '199', '8347', '944', '31', null, null, '1', '193', '16', '18', '22', '7', '2855', null, null, null, '12633', '2855', null, null);
INSERT INTO `report_cache` VALUES ('212', '2018-08-07', '348', '12192', '1575', '35', null, null, '5', '259', '33', '22', '45', '7', '3245', null, '1', null, '17767', '3245', null, null);
INSERT INTO `report_cache` VALUES ('213', '2018-08-08', '197', '8026', '1006', '17', null, null, null, '237', '26', '19', '131', '7', '5067', null, '2', null, '14735', '5067', null, null);
INSERT INTO `report_cache` VALUES ('214', '2018-08-09', '74', '2858', '309', '16', null, null, null, '30', '7', '5', '133', '5', '5840', '4', null, null, '9281', '5840', null, null);
INSERT INTO `report_cache` VALUES ('215', '2018-08-10', '64', '3151', '316', '7', null, null, null, '19', '5', '10', '173', '3', '5561', '1', '1', null, '9311', '5561', null, null);
INSERT INTO `report_cache` VALUES ('216', '2018-08-11', '16', '1057', '65', null, null, null, '1', '14', '9', '2', '29', '75', '876', null, null, null, '2144', '876', null, null);
INSERT INTO `report_cache` VALUES ('217', '2018-08-12', null, '24', '1', null, null, null, null, null, null, null, null, null, '77', null, null, null, '102', '77', null, null);
INSERT INTO `report_cache` VALUES ('218', '2018-08-13', '85', '3212', '296', '8', null, null, '2', '35', '6', '9', '191', '17', '5313', '3', '2', null, '9179', '5313', null, null);
INSERT INTO `report_cache` VALUES ('219', '2018-08-14', '102', '4097', '367', '10', null, null, null, '94', '14', '7', '36', '44', '5559', '1', null, null, '10331', '5559', null, null);
INSERT INTO `report_cache` VALUES ('220', '2018-08-15', '110', '4755', '568', '17', null, null, '1', '68', '23', '11', '69', '79', '5505', '2', null, null, '11208', '5505', null, null);
INSERT INTO `report_cache` VALUES ('221', '2018-08-16', '136', '5673', '636', '25', null, null, '3', '223', '33', '11', '156', '27', '5059', '1', null, null, '11983', '5059', null, null);
INSERT INTO `report_cache` VALUES ('222', '2018-08-17', null, '11', '1', null, null, null, null, null, null, null, null, null, '284', null, null, null, '296', '284', null, null);
INSERT INTO `report_cache` VALUES ('223', '2018-08-18', '3', '53', null, null, null, null, null, null, null, null, '24', null, '483', null, null, null, '563', '483', null, null);
INSERT INTO `report_cache` VALUES ('224', '2018-08-19', null, '32', '4', null, null, null, null, null, null, null, '10', null, '456', null, null, null, '502', '456', null, null);
INSERT INTO `report_cache` VALUES ('225', '2018-08-20', '221', '7972', '1121', '25', null, null, '6', '202', '49', '27', '302', '3', '4432', null, '1', null, '14361', '4432', null, null);
INSERT INTO `report_cache` VALUES ('226', '2018-08-21', '258', '8733', '1384', '26', null, null, '5', '223', '39', '34', '236', '4', '5105', '3', '1', null, '16051', '5105', null, null);
INSERT INTO `report_cache` VALUES ('227', '2018-08-22', null, null, null, null, null, null, null, null, null, null, null, null, '183', null, null, null, '183', '183', null, null);
INSERT INTO `report_cache` VALUES ('228', '2018-08-23', '172', '6284', '838', '18', null, null, '1', '184', '18', '18', '249', '32', '5655', null, '1', null, '13470', '5655', null, null);
INSERT INTO `report_cache` VALUES ('229', '2018-08-24', '155', '7468', '859', '14', null, null, '12', '201', '41', '25', '354', '7', '4552', '2', '4', null, '13694', '4552', null, null);
INSERT INTO `report_cache` VALUES ('230', '2018-08-25', '9', '875', '115', '1', null, null, '1', null, '1', null, '4', null, '1069', null, null, null, '2075', '1069', null, null);
INSERT INTO `report_cache` VALUES ('231', '2018-08-26', null, '137', '10', null, null, null, null, null, null, null, '40', null, '356', null, null, null, '543', '356', null, null);
INSERT INTO `report_cache` VALUES ('232', '2018-08-27', '181', '7992', '806', '14', null, null, '25', '211', '23', '23', '403', '62', '5323', '3', null, null, '15066', '5323', null, null);
INSERT INTO `report_cache` VALUES ('233', '2018-08-28', '185', '8393', '1031', '19', null, null, '4', '120', '29', '22', '359', '16', '5189', '5', '12', null, '15384', '5189', null, null);
INSERT INTO `report_cache` VALUES ('234', '2018-08-29', '99', '5534', '516', '12', null, null, '4', '142', '23', '15', '170', '61', '5705', null, '1', null, '12282', '5705', null, null);
INSERT INTO `report_cache` VALUES ('235', '2018-08-30', '147', '7396', '627', '24', null, null, '7', '156', '35', '17', '275', '22', '5064', null, null, null, '13770', '5064', null, null);
INSERT INTO `report_cache` VALUES ('236', '2018-09-01', '7', '223', '34', '3', null, null, null, null, '1', '2', null, null, '600', '1', null, null, '871', '598', '2', null);
INSERT INTO `report_cache` VALUES ('237', '2018-09-02', null, null, '1', null, null, null, null, null, null, null, null, null, '272', null, null, null, '273', '272', null, null);
INSERT INTO `report_cache` VALUES ('238', '2018-09-03', '153', '6384', '899', '21', null, null, '6', '46', '13', '13', '631', '3', '5419', '2', null, null, '13590', '5419', null, null);
INSERT INTO `report_cache` VALUES ('239', '2018-09-04', '117', '3902', '548', '14', null, null, '1', '40', '11', '8', '182', '17', '5639', '1', '1', null, '10481', '5639', null, null);
INSERT INTO `report_cache` VALUES ('240', '2018-09-05', '123', '3878', '515', '15', null, null, '1', '48', '4', '7', '384', '30', '5608', '1', null, null, '10614', '5608', null, null);
INSERT INTO `report_cache` VALUES ('241', '2018-09-06', '170', '7449', '1001', '15', null, null, '6', '89', '15', '18', '307', '6', '5253', '3', '3', null, '14335', '5253', null, null);
INSERT INTO `report_cache` VALUES ('242', '2018-09-07', '287', '8246', '1427', '41', null, null, '5', '36', '12', '31', '207', '8', '5022', '4', '1', null, '15327', '5022', null, null);
INSERT INTO `report_cache` VALUES ('243', '2018-09-08', '32', '1283', '214', null, null, null, null, '11', '7', '1', '15', null, '790', null, null, null, '2353', '790', null, null);
INSERT INTO `report_cache` VALUES ('244', '2018-09-09', null, null, null, null, null, null, null, null, null, null, null, null, '68', null, null, null, '68', '68', null, null);
INSERT INTO `report_cache` VALUES ('245', '2018-09-10', '279', '8055', '1509', '34', null, null, '9', '144', '14', '24', '191', '7', '5424', '2', '2', null, '15694', '5424', null, null);
INSERT INTO `report_cache` VALUES ('246', '2018-09-11', '100', '4350', '553', '14', null, null, '1', '78', '2', '8', '161', '15', '5868', '1', '1', null, '11152', '5868', null, null);
INSERT INTO `report_cache` VALUES ('247', '2018-09-12', '100', '3947', '503', '12', null, null, null, '22', '4', '8', '65', '18', '5763', null, '1', null, '10443', '5763', null, null);
INSERT INTO `report_cache` VALUES ('248', '2018-09-13', '243', '8949', '1031', '22', null, null, '3', '49', '5', '10', '484', '19', '5436', '5', null, null, '16256', '5436', null, null);
INSERT INTO `report_cache` VALUES ('249', '2018-09-14', '274', '10222', '1384', '28', null, null, '2', '101', '9', '21', '88', '4', '5232', '9', '2', null, '17376', '5232', null, null);
INSERT INTO `report_cache` VALUES ('250', '2018-09-15', '253', '9714', '1234', '23', null, null, '3', '121', '9', '22', '233', '13', '4663', '2', '4', null, '16294', '4663', null, null);
INSERT INTO `report_cache` VALUES ('251', '2018-09-16', '2', '47', '11', null, null, null, null, null, null, null, null, null, '465', null, null, null, '525', '465', null, null);
INSERT INTO `report_cache` VALUES ('252', '2018-09-17', '248', '8922', '1529', '48', null, null, '1', '118', '14', '16', '86', '10', '5062', '5', '2', null, '16061', '5062', null, null);
INSERT INTO `report_cache` VALUES ('253', '2018-09-18', '295', '9367', '1507', '31', null, null, '1', '81', '13', '23', '159', '13', '5222', '1', '5', null, '16718', '5222', null, null);
INSERT INTO `report_cache` VALUES ('254', '2018-09-19', '238', '8330', '1498', '30', null, null, '2', '65', '22', '22', '94', '15', '5333', '2', '5', null, '15656', '5333', null, null);
INSERT INTO `report_cache` VALUES ('255', '2018-09-20', '269', '7660', '1504', '44', null, null, '2', '32', '17', '31', '64', '14', '5292', '3', '4', null, '14936', '5292', null, null);
INSERT INTO `report_cache` VALUES ('256', '2018-09-21', '221', '8019', '1664', '32', null, null, '1', '22', '18', '25', '90', '5', '5282', '4', '2', null, '15385', '5282', null, null);
INSERT INTO `report_cache` VALUES ('257', '2018-09-22', '17', '568', '95', '1', null, null, '1', '17', '2', '5', '20', null, '668', null, '1', null, '1395', '668', null, null);
INSERT INTO `report_cache` VALUES ('258', '2018-09-23', null, '8', '2', null, null, null, null, null, null, null, null, null, '524', null, null, null, '534', '524', null, null);
INSERT INTO `report_cache` VALUES ('259', '2018-09-24', '280', '10127', '1767', '35', null, null, '3', '70', '47', '28', '85', '22', '5196', '6', '3', null, '17669', '5196', null, null);
INSERT INTO `report_cache` VALUES ('260', '2018-09-25', '268', '7676', '1805', '58', null, null, '2', '29', '53', '48', '96', '23', '5377', '13', '11', null, '15459', '5377', null, null);
INSERT INTO `report_cache` VALUES ('261', '2018-09-26', '255', '8132', '1666', '41', null, null, '3', '50', '37', '24', '98', '11', '5149', '6', '5', null, '15477', '5149', null, null);
INSERT INTO `report_cache` VALUES ('262', '2018-09-27', '236', '7989', '1747', '51', null, null, null, '30', '18', '17', '84', '13', '5257', '2', '7', null, '15452', '5257', null, null);
INSERT INTO `report_cache` VALUES ('263', '2018-09-28', '261', '9027', '1860', '72', null, null, '1', '46', '24', '33', '166', '19', '5235', '70', '7', null, '16821', '5235', null, null);
INSERT INTO `report_cache` VALUES ('264', '2018-09-29', '6', '393', '45', '5', null, null, null, '1', null, '1', '2', '1', '810', null, null, null, '1264', '810', null, null);
INSERT INTO `report_cache` VALUES ('265', '2018-10-01', '205', '8393', '1445', '51', null, null, null, '86', '27', '31', '117', '12', '5280', '7', '2', null, '15656', '5280', null, null);
INSERT INTO `report_cache` VALUES ('266', '2018-10-02', '365', '7843', '1917', '75', null, null, '4', '55', '22', '29', '59', '4', '4667', '4', '9', null, '15053', '4667', null, null);
INSERT INTO `report_cache` VALUES ('267', '2018-10-03', '345', '9451', '2163', '58', null, null, '3', '61', '22', '39', '74', '13', '5209', '6', '15', null, '17459', '5209', null, null);
INSERT INTO `report_cache` VALUES ('268', '2018-10-04', '241', '7095', '1525', '29', null, null, '7', '32', '15', '21', '110', '7', '5608', '4', '9', null, '14703', '5608', null, null);
INSERT INTO `report_cache` VALUES ('269', '2018-10-05', '267', '7577', '1637', '39', null, null, null, '20', '21', '32', '129', '9', '5162', '5', '6', null, '14904', '5162', null, null);
INSERT INTO `report_cache` VALUES ('270', '2018-10-06', '34', '1337', '183', '1', null, null, null, '8', '2', '3', '9', null, '988', null, null, null, '2565', '988', null, null);
INSERT INTO `report_cache` VALUES ('271', '2018-10-07', null, '3', null, null, null, null, null, '1', null, null, null, null, '267', null, null, null, '271', '267', null, null);
INSERT INTO `report_cache` VALUES ('272', '2018-10-08', '254', '8554', '1532', '49', null, null, null, '23', '16', '28', '238', '14', '4973', '1', '1', null, '15683', '4973', null, null);
INSERT INTO `report_cache` VALUES ('273', '2018-10-09', '252', '9257', '1498', '63', null, null, '5', '64', '25', '23', '147', '20', '5400', '14', '15', null, '16783', '5400', null, null);
INSERT INTO `report_cache` VALUES ('274', '2018-10-10', '209', '6494', '1254', '32', null, null, '2', '37', '20', '22', '110', '17', '5547', '4', '4', null, '13752', '5547', null, null);
INSERT INTO `report_cache` VALUES ('275', '2018-10-11', '212', '5248', '1001', '21', null, null, '1', '30', '7', '24', '129', '3', '5724', '3', '3', null, '12406', '5724', null, null);
INSERT INTO `report_cache` VALUES ('276', '2018-10-12', '261', '5780', '1146', '31', null, null, null, '22', '9', '18', '154', '6', '5561', '3', '4', null, '12995', '5561', null, null);
INSERT INTO `report_cache` VALUES ('277', '2018-10-13', '201', '5886', '1079', '32', null, null, null, '28', '23', '23', '160', '6', '5300', '1', '3', null, '12742', '5300', null, null);
INSERT INTO `report_cache` VALUES ('278', '2018-10-14', '10', '341', '78', '1', null, null, null, null, '1', '1', '7', null, '611', null, null, null, '1050', '611', null, null);
INSERT INTO `report_cache` VALUES ('279', '2018-10-15', '240', '5499', '1046', '22', null, null, null, '33', '13', '24', '57', '8', '5606', '3', '3', null, '12554', '5606', null, null);
INSERT INTO `report_cache` VALUES ('280', '2018-10-16', '240', '5399', '1092', '26', null, null, '4', '40', '17', '19', '79', '5', '5698', '12', '172', null, '12803', '5698', null, null);
INSERT INTO `report_cache` VALUES ('281', '2018-10-17', '224', '5408', '1157', '19', null, null, null, '30', '13', '21', '65', '15', '6435', '2', '4', null, '13393', '6435', null, null);
INSERT INTO `report_cache` VALUES ('282', '2018-10-18', '252', '5529', '1089', '33', null, null, null, '19', '8', '17', '74', '11', '5897', '2', '5', null, '12936', '5897', null, null);
INSERT INTO `report_cache` VALUES ('283', '2018-10-19', '211', '5421', '1094', '27', null, null, '1', '34', '6', '18', '76', '12', '5854', '5', '3', null, '12762', '5854', null, null);
INSERT INTO `report_cache` VALUES ('284', '2018-10-20', '18', '293', '53', null, null, null, null, '7', null, null, null, null, '669', null, '1', null, '1041', '669', null, null);
INSERT INTO `report_cache` VALUES ('285', '2018-10-21', '3', '36', '29', null, null, null, null, null, null, null, null, null, '312', null, '3', null, '383', '312', null, null);
INSERT INTO `report_cache` VALUES ('286', '2018-10-22', '250', '5574', '1151', '36', null, null, '2', '94', '10', '36', '84', '9', '6605', '2', '3', null, '13856', '6605', null, null);
INSERT INTO `report_cache` VALUES ('287', '2018-10-23', '237', '5820', '1083', '30', null, null, '2', '46', '8', '36', '76', '10', '6576', '3', '3', null, '13930', '6576', null, null);
INSERT INTO `report_cache` VALUES ('288', '2018-10-24', '223', '6589', '1102', '31', null, null, '7', '54', '8', '38', '88', '9', '7091', '4', '2', null, '15246', '7091', null, null);
INSERT INTO `report_cache` VALUES ('289', '2018-10-25', '238', '6720', '1136', '34', null, null, '3', '125', '26', '33', '89', '10', '7659', '5', '8', null, '16086', '7659', null, null);
INSERT INTO `report_cache` VALUES ('290', '2018-10-26', '263', '6267', '1132', '30', null, null, null, '54', '10', '43', '58', '5', '7949', '3', '6', null, '15820', '7949', null, null);
INSERT INTO `report_cache` VALUES ('291', '2018-10-27', '27', '880', '152', '1', null, null, null, null, '2', null, '5', '1', '970', null, null, null, '2038', '970', null, null);
INSERT INTO `report_cache` VALUES ('292', '2018-10-28', null, null, '1', null, null, null, null, null, null, null, null, null, '324', null, null, null, '325', '324', null, null);
INSERT INTO `report_cache` VALUES ('293', '2018-10-29', '268', '10258', '1178', '34', null, null, '4', '52', '21', '42', '84', '9', '8886', '4', '12', null, '20852', '8886', null, null);
INSERT INTO `report_cache` VALUES ('294', '2018-10-30', '258', '9451', '1212', '36', null, null, '2', '51', '25', '40', '67', '8', '8382', '3', '18', null, '19553', '8382', null, null);
INSERT INTO `report_cache` VALUES ('295', '2018-11-01', '260', '6166', '1111', '29', null, null, '1', '36', '15', '19', '58', '9', '6803', '6', '5', null, '14518', '6803', null, null);
INSERT INTO `report_cache` VALUES ('296', '2018-11-02', '95', '2841', '245', '8', null, null, '1', '50', '34', '4', '4', '10', '6906', '1', '1', null, '10200', '6906', null, null);
INSERT INTO `report_cache` VALUES ('297', '2018-11-03', '13', '520', '42', '1', null, null, null, '1', '5', null, '2', null, '1431', null, null, null, '2015', '1431', null, null);
INSERT INTO `report_cache` VALUES ('298', '2018-11-04', '7', '32', '3', null, null, null, null, '3', null, null, null, '3', '379', null, null, null, '427', '379', null, null);
INSERT INTO `report_cache` VALUES ('299', '2018-11-05', '71', '2187', '184', '9', null, null, '4', '77', '5', '19', '8', '4', '5478', '1', '2', null, '8049', '5478', null, null);
INSERT INTO `report_cache` VALUES ('300', '2018-11-06', '86', '3070', '257', '14', null, null, '5', '108', '11', '20', '6', '5', '7222', null, '1', null, '10805', '7222', null, null);
INSERT INTO `report_cache` VALUES ('301', '2018-11-07', '97', '4832', '416', '22', null, null, null, '143', '17', '21', '13', '5', '7200', '1', '1', null, '12768', '7200', null, null);
INSERT INTO `report_cache` VALUES ('302', '2018-11-08', '192', '10428', '941', '47', null, null, '2', '275', '19', '23', '68', '4', '6867', '3', '2', null, '18872', '6867', null, null);
INSERT INTO `report_cache` VALUES ('303', '2018-11-09', '138', '6541', '503', '43', null, null, null, '221', '21', '27', '52', '7', '6608', null, '4', null, '14165', '6608', null, null);
INSERT INTO `report_cache` VALUES ('304', '2018-11-10', '35', '1675', '129', '10', null, null, '1', '154', '9', '6', '73', null, '1127', null, '19', null, '3238', '1127', null, null);
INSERT INTO `report_cache` VALUES ('305', '2018-11-11', '4', '517', '42', '2', null, null, null, '20', '1', null, null, null, '443', null, '4', null, '1033', '443', null, null);
INSERT INTO `report_cache` VALUES ('306', '2018-11-12', '219', '7069', '806', '49', null, null, '7', '153', '17', '38', '137', '19', '6823', '4', '24', null, '15365', '6823', null, null);
INSERT INTO `report_cache` VALUES ('307', '2018-11-13', '247', '6873', '859', '43', null, null, '11', '107', '21', '20', '80', '2', '8410', '12', '4', null, '16689', '8410', null, null);
INSERT INTO `report_cache` VALUES ('308', '2018-11-14', '251', '8764', '1311', '37', null, null, '4', '126', '14', '26', '186', '5', '8025', '5', '9', null, '18763', '8025', null, null);
INSERT INTO `report_cache` VALUES ('309', '2018-11-15', '182', '7310', '618', '23', null, null, null, '162', '27', '25', '57', '2', '8336', '11', '7', null, '16760', '8336', null, null);
INSERT INTO `report_cache` VALUES ('310', '2018-11-16', '230', '9024', '669', '29', null, null, '4', '318', '69', '33', '52', '4', '5928', '6', '3', null, '16369', '5928', null, null);
INSERT INTO `report_cache` VALUES ('311', '2018-11-17', '12', '224', null, null, null, null, null, null, null, null, null, null, '316', null, null, null, '552', '316', null, null);
INSERT INTO `report_cache` VALUES ('312', '2018-11-18', '1', '147', '17', null, null, null, null, null, null, null, null, null, '323', null, null, null, '488', '323', null, null);
INSERT INTO `report_cache` VALUES ('313', '2018-11-19', '257', '10575', '748', '33', null, null, '2', '356', '93', '36', '41', '4', '6018', '15', '7', null, '18185', '6018', null, null);
INSERT INTO `report_cache` VALUES ('314', '2018-11-20', '308', '11936', '1172', '48', null, null, '13', '242', '48', '42', '163', '11', '7325', '6', '12', null, '21326', '7325', null, null);
INSERT INTO `report_cache` VALUES ('315', '2018-11-21', '283', '8431', '1096', '44', null, null, '13', '146', '61', '27', '351', '17', '6803', '9', '17', null, '17298', '6803', null, null);
INSERT INTO `report_cache` VALUES ('316', '2018-11-22', '350', '6044', '622', '22', null, null, '4', '140', '16', '18', '95', '16', '7487', '3', '5', null, '14822', '7487', null, null);
INSERT INTO `report_cache` VALUES ('317', '2018-11-23', '374', '7768', '666', '30', null, null, null, '242', '93', '27', '84', '12', '5417', '3', '3', null, '14719', '5417', null, null);
INSERT INTO `report_cache` VALUES ('318', '2018-11-24', '8', '761', '46', null, null, null, null, null, null, null, '41', null, '485', '8', null, null, '1349', '485', null, null);
INSERT INTO `report_cache` VALUES ('319', '2018-11-25', '3', '116', '15', null, null, null, null, '3', null, null, '12', '2', '423', null, null, null, '574', '423', null, null);
INSERT INTO `report_cache` VALUES ('320', '2018-11-26', '468', '6968', '850', '21', null, null, '3', '171', '31', '29', '155', '57', '7275', '7', '7', null, '16043', '7275', null, null);
INSERT INTO `report_cache` VALUES ('321', '2018-11-27', '260', '7830', '843', '40', null, null, '1', '143', '68', '25', '152', '43', '7555', '10', '16', null, '16986', '7555', null, null);
INSERT INTO `report_cache` VALUES ('322', '2018-11-28', '90', '5636', '283', '8', null, null, null, '188', '34', '19', '49', '21', '7428', '2', '1', null, '13759', '7428', null, null);
INSERT INTO `report_cache` VALUES ('323', '2018-11-29', '222', '12064', '549', '20', null, null, null, '311', '68', '21', '79', '21', '6183', '15', '5', null, '19558', '6183', null, null);
INSERT INTO `report_cache` VALUES ('324', '2018-12-01', '1', '119', '6', '2', null, null, null, '24', '5', '11', null, '17', '359', null, '1', null, '545', '359', null, null);
INSERT INTO `report_cache` VALUES ('325', '2018-12-02', '1', '193', '11', null, null, null, null, null, null, null, '1', '1', '361', null, '1', null, '569', '361', null, null);
INSERT INTO `report_cache` VALUES ('326', '2018-12-03', '132', '11410', '569', '26', null, null, '1', '330', '61', '55', '102', '45', '5909', '50', '3', null, '18693', '5909', null, null);
INSERT INTO `report_cache` VALUES ('327', '2018-12-04', '165', '9937', '500', '20', null, null, '1', '270', '28', '19', '23', '51', '7648', '19', '3', null, '18684', '7648', null, null);
INSERT INTO `report_cache` VALUES ('328', '2018-12-05', '144', '8720', '527', '15', null, null, '1', '183', '26', '30', '24', '49', '8097', '7', '1', null, '17824', '8097', null, null);
INSERT INTO `report_cache` VALUES ('329', '2018-12-06', '264', '14932', '751', '28', null, null, '9', '462', '32', '29', '155', '45', '7874', '6', '10', null, '24597', '7874', null, null);
INSERT INTO `report_cache` VALUES ('330', '2018-12-07', '120', '10284', '457', '37', null, null, '7', '272', '15', '20', '117', '8', '6010', '2', '2', null, '17352', '6010', null, null);
INSERT INTO `report_cache` VALUES ('331', '2018-12-08', '6', '467', '31', '1', null, null, null, '36', '8', '2', '1', null, '1257', null, null, null, '1809', '1257', null, null);
INSERT INTO `report_cache` VALUES ('332', '2018-12-09', '1', '2', '1', null, null, null, null, null, null, null, null, null, '271', null, null, null, '275', '271', null, null);
INSERT INTO `report_cache` VALUES ('333', '2018-12-10', '176', '10138', '810', '39', null, null, '4', '133', '21', '22', '258', '12', '7972', '4', '9', null, '19598', '7972', null, null);
INSERT INTO `report_cache` VALUES ('334', '2018-12-11', '203', '10706', '796', '59', null, null, '2', '253', '76', '21', '191', '22', '5857', '11', '8', null, '18206', '5857', null, null);
INSERT INTO `report_cache` VALUES ('335', '2018-12-12', '266', '13331', '1193', '57', null, null, '2', '227', '50', '30', '347', '5', '6959', '8', '9', null, '22484', '6959', null, null);
INSERT INTO `report_cache` VALUES ('336', '2018-12-13', '266', '11353', '1174', '36', null, null, '1', '309', '48', '21', '233', '8', '6805', '9', '19', null, '20282', '6805', null, null);
INSERT INTO `report_cache` VALUES ('337', '2018-12-14', '252', '10851', '984', '34', null, null, '5', '286', '47', '20', '191', '9', '5919', '3', '17', null, '18618', '5919', null, null);
INSERT INTO `report_cache` VALUES ('338', '2018-12-15', '46', '1729', '134', '14', null, null, null, '105', '13', '3', '12', null, '1068', null, null, null, '3124', '1068', null, null);
INSERT INTO `report_cache` VALUES ('339', '2018-12-16', null, null, '1', null, null, null, null, null, null, null, null, null, '295', null, null, null, '296', '295', null, null);
INSERT INTO `report_cache` VALUES ('340', '2018-12-17', '242', '11382', '1225', '45', null, null, '1', '207', '21', '37', '215', '5', '5700', '1', '8', null, '19089', '5700', null, null);
INSERT INTO `report_cache` VALUES ('341', '2018-12-18', '260', '11206', '1185', '35', null, null, null, '143', '22', '28', '169', '29', '5926', '14', '11', null, '19028', '5926', null, null);
INSERT INTO `report_cache` VALUES ('342', '2018-12-19', '242', '12553', '1263', '40', null, null, '1', '450', '42', '30', '97', '29', '5671', '3', '17', null, '20438', '5671', null, null);
INSERT INTO `report_cache` VALUES ('343', '2018-12-20', '343', '13295', '1463', '30', null, null, '1', '316', '22', '23', '82', '10', '5749', '2', '10', null, '21346', '5749', null, null);
INSERT INTO `report_cache` VALUES ('344', '2018-12-21', '299', '12050', '1298', '46', null, null, '2', '231', '41', '76', '64', '43', '5378', '9', '10', null, '19547', '5378', null, null);
INSERT INTO `report_cache` VALUES ('345', '2018-12-22', '88', '5056', '386', '21', null, null, null, '91', '17', '4', '20', null, '1924', null, '6', null, '7613', '1924', null, null);
INSERT INTO `report_cache` VALUES ('346', '2018-12-23', '3', '562', '38', null, null, null, null, null, null, null, null, null, '365', null, '3', null, '971', '365', null, null);
INSERT INTO `report_cache` VALUES ('347', '2018-12-24', '277', '14846', '1448', '53', null, null, '2', '222', '27', '50', '104', '3', '5377', '3', '16', null, '22428', '5377', null, null);
INSERT INTO `report_cache` VALUES ('348', '2018-12-25', '77', '2747', '355', '17', null, null, null, '79', null, '11', '1', '4', '1329', null, null, null, '4620', '1329', null, null);
INSERT INTO `report_cache` VALUES ('349', '2018-12-26', '241', '11404', '1351', '50', null, null, null, '208', '28', '38', '123', '2', '4962', '5', '15', null, '18427', '4962', null, null);
INSERT INTO `report_cache` VALUES ('350', '2018-12-27', '285', '12509', '1565', '68', null, null, null, '270', '30', '44', '92', '11', '5244', '5', '24', null, '20147', '5244', null, null);
INSERT INTO `report_cache` VALUES ('351', '2018-12-28', '279', '12279', '1426', '43', null, null, null, '236', '25', '37', '76', '14', '5329', '4', '16', null, '19764', '5329', null, null);
INSERT INTO `report_cache` VALUES ('352', '2018-12-29', '92', '4284', '388', '12', null, null, null, '38', '5', '19', '20', '2', '3518', '3', '1', null, '8382', '3518', null, null);
INSERT INTO `report_cache` VALUES ('353', '2018-12-30', '6', '228', '21', null, null, null, null, null, null, null, null, null, '208', null, null, null, '463', '208', null, null);
INSERT INTO `report_cache` VALUES ('354', '2019-01-01', '7', '175', '36', null, null, null, null, null, null, null, null, null, '166', null, null, null, '384', '166', null, null);
INSERT INTO `report_cache` VALUES ('355', '2019-01-02', '116', '4660', '478', '14', null, null, null, '200', '62', '53', '32', '19', '6364', '2', '4', null, '12004', '6364', null, null);
INSERT INTO `report_cache` VALUES ('356', '2019-01-03', '190', '8525', '819', '23', null, null, '3', '91', '38', '37', '77', '59', '6412', '8', '9', null, '16291', '6412', null, null);
INSERT INTO `report_cache` VALUES ('357', '2019-01-04', '252', '11847', '1325', '49', null, null, '3', '460', '83', '54', '123', '19', '5749', '6', '7', null, '19977', '5749', null, null);
INSERT INTO `report_cache` VALUES ('358', '2019-01-05', '12', '481', '49', '1', null, null, null, null, null, null, '1', null, '664', '1', null, null, '1209', '664', null, null);
INSERT INTO `report_cache` VALUES ('359', '2019-01-06', '3', '34', '7', null, null, null, null, null, null, null, null, '1', '490', null, null, null, '535', '490', null, null);
INSERT INTO `report_cache` VALUES ('360', '2019-01-07', '238', '8678', '1454', '54', null, null, '2', '225', '46', '23', '117', '1', '5670', '5', '19', null, '16532', '5670', null, null);
INSERT INTO `report_cache` VALUES ('361', '2019-01-08', '206', '7188', '1271', '37', null, null, null, '97', '22', '25', '40', '20', '6035', '3', '6', null, '14950', '6035', null, null);
INSERT INTO `report_cache` VALUES ('362', '2019-01-09', '244', '8382', '1497', '38', null, null, null, '137', '32', '37', '64', '12', '6041', '6', '17', null, '16507', '6041', null, null);
INSERT INTO `report_cache` VALUES ('363', '2019-01-10', '259', '10844', '1621', '42', null, null, null, '241', '66', '48', '101', '13', '5768', '2', '15', null, '19020', '5768', null, null);
INSERT INTO `report_cache` VALUES ('364', '2019-01-11', '219', '8262', '1158', '30', null, null, '1', '170', '28', '22', '75', '8', '5953', '40', '2', null, '15968', '5953', null, null);
INSERT INTO `report_cache` VALUES ('365', '2019-01-12', '30', '718', '84', '1', null, null, null, null, null, null, '3', null, '970', '1', null, null, '1807', '970', null, null);
INSERT INTO `report_cache` VALUES ('366', '2019-01-13', null, '86', '20', null, null, null, null, '1', null, null, null, '1', '562', null, null, null, '670', '562', null, null);
INSERT INTO `report_cache` VALUES ('367', '2019-01-14', '341', '11405', '1118', '41', null, null, null, '169', '44', '15', '222', '4', '5532', '167', '11', null, '19069', '5532', null, null);
INSERT INTO `report_cache` VALUES ('368', '2019-01-15', '262', '11542', '1326', '45', null, null, '1', '184', '27', '43', '220', '23', '4956', '67', '6', null, '18702', '4956', null, null);
INSERT INTO `report_cache` VALUES ('369', '2019-01-16', '50', '1846', '179', '4', null, null, null, '12', '2', '6', '22', '22', '6066', null, '1', null, '8210', '6066', null, null);
INSERT INTO `report_cache` VALUES ('370', '2019-01-17', '66', '2671', '320', '12', null, null, null, '32', '13', '3', '61', '38', '7199', '1', '3', null, '10419', '7199', null, null);
INSERT INTO `report_cache` VALUES ('371', '2019-01-18', '118', '3596', '458', '21', null, null, '1', '43', '8', '6', '59', '2', '7704', '3', '8', null, '12027', '7704', null, null);
INSERT INTO `report_cache` VALUES ('372', '2019-01-19', null, null, null, null, null, null, null, null, null, null, null, null, '482', null, null, null, '482', '482', null, null);
INSERT INTO `report_cache` VALUES ('373', '2019-01-20', null, null, null, null, null, null, null, null, null, null, null, null, '405', null, null, null, '405', '405', null, null);
INSERT INTO `report_cache` VALUES ('374', '2019-01-21', '102', '4517', '551', '11', null, null, '1', '80', '8', '11', '114', '5', '7272', '9', '5', null, '12686', '7272', null, null);
INSERT INTO `report_cache` VALUES ('375', '2019-01-22', '192', '8748', '977', '28', null, null, '5', '154', '22', '25', '187', '16', '5880', '6', '8', null, '16248', '5880', null, null);
INSERT INTO `report_cache` VALUES ('376', '2019-01-23', '100', '6659', '659', '19', null, null, '1', '120', '24', '10', '74', '13', '7036', '1', '4', null, '14720', '7036', null, null);
INSERT INTO `report_cache` VALUES ('377', '2019-01-24', '197', '14834', '828', '53', null, null, '1', '235', '29', '35', '138', '14', '5842', '4', '3', null, '22213', '5842', null, null);
INSERT INTO `report_cache` VALUES ('378', '2019-01-25', '61', '2042', '184', '3', null, null, null, '41', '2', '8', '50', '17', '7008', '2', null, null, '9418', '7008', null, null);
INSERT INTO `report_cache` VALUES ('379', '2019-01-26', '3', '186', '7', null, null, null, null, null, null, null, '1', null, '496', null, null, null, '693', '496', null, null);
INSERT INTO `report_cache` VALUES ('380', '2019-01-27', null, null, null, null, null, null, null, null, null, null, null, null, '418', null, null, null, '418', '418', null, null);
INSERT INTO `report_cache` VALUES ('381', '2019-01-28', '136', '8943', '745', '45', null, null, null, '178', '19', '28', '44', '17', '5795', '3', '4', null, '15957', '5795', null, null);
INSERT INTO `report_cache` VALUES ('382', '2019-01-29', '223', '13574', '1404', '69', null, null, null, '258', '31', '32', '165', '4', '6334', '25', '18', null, '22137', '6334', null, null);
INSERT INTO `report_cache` VALUES ('383', '2019-01-30', '202', '12791', '946', '49', null, null, null, '207', '41', '23', '133', '24', '5499', '2', '23', null, '19940', '5499', null, null);
INSERT INTO `report_cache` VALUES ('384', '2019-02-01', '150', '9568', '840', '21', null, null, '2', '284', '22', '29', '89', '6', '6343', '4', '7', null, '17365', '6343', null, null);
INSERT INTO `report_cache` VALUES ('385', '2019-02-02', null, null, null, null, null, null, null, null, null, null, null, null, '332', null, null, null, '332', '332', null, null);
INSERT INTO `report_cache` VALUES ('386', '2019-02-03', null, null, null, null, null, null, null, null, null, null, null, null, '339', null, null, null, '339', '339', null, null);
INSERT INTO `report_cache` VALUES ('387', '2019-02-04', '161', '10205', '810', '27', null, null, '1', '274', '42', '59', '97', '8', '5403', '4', '5', null, '17096', '5403', null, null);
INSERT INTO `report_cache` VALUES ('388', '2019-02-05', '35', '2777', '172', '5', null, null, null, '39', '4', null, '49', '4', '6977', null, null, null, '10062', '6977', null, null);
INSERT INTO `report_cache` VALUES ('389', '2019-02-06', '17', '1096', '68', '1', null, null, null, '10', '10', null, '38', '5', '7211', null, null, null, '8456', '7211', null, null);
INSERT INTO `report_cache` VALUES ('390', '2019-02-07', '22', '1385', '75', '2', null, null, null, '51', '24', '17', '34', '13', '6545', '4', '2', null, '8174', '6545', null, null);
INSERT INTO `report_cache` VALUES ('391', '2019-02-08', '42', '1753', '102', '3', null, null, null, '63', '8', '3', '40', '5', '6377', '1', null, null, '8397', '6377', null, null);
INSERT INTO `report_cache` VALUES ('392', '2019-02-09', '2', '243', '12', null, null, null, null, null, null, null, null, null, '570', null, '24', null, '851', '570', null, null);
INSERT INTO `report_cache` VALUES ('393', '2019-02-10', null, null, null, null, null, null, null, null, null, null, null, null, '310', null, null, null, '310', '310', null, null);
INSERT INTO `report_cache` VALUES ('394', '2019-02-11', '41', '1839', '140', '10', null, null, null, '54', '10', '17', '33', '11', '6747', null, null, null, '8902', '6747', null, null);
INSERT INTO `report_cache` VALUES ('395', '2019-02-12', '61', '3448', '233', '11', null, null, '1', '85', '17', '15', '38', '9', '7283', '1', '3', null, '11205', '7283', null, null);
INSERT INTO `report_cache` VALUES ('396', '2019-02-13', '122', '6963', '372', '18', null, null, null, '219', '59', '17', '67', '10', '7805', '1', '7', null, '15660', '7805', null, null);
INSERT INTO `report_cache` VALUES ('397', '2019-02-14', '116', '8748', '476', '16', null, null, '1', '205', '22', '22', '114', '16', '7858', '2', '6', null, '17602', '7858', null, null);
INSERT INTO `report_cache` VALUES ('398', '2019-02-15', '107', '6859', '470', '21', null, null, '3', '214', '12', '37', '99', '15', '7403', '2', '2', null, '15244', '7403', null, null);
INSERT INTO `report_cache` VALUES ('399', '2019-02-16', '40', '3320', '156', '7', null, null, null, '4', null, '3', '10', '2', '2820', null, '1', null, '6363', '2820', null, null);
INSERT INTO `report_cache` VALUES ('400', '2019-02-17', null, '180', '7', null, null, null, null, null, null, null, null, null, '363', null, null, null, '550', '363', null, null);
INSERT INTO `report_cache` VALUES ('401', '2019-02-18', '56', '4175', '226', '13', null, null, '1', '62', '6', '14', '21', '22', '5712', '2', '2', null, '10312', '5712', null, null);
INSERT INTO `report_cache` VALUES ('402', '2019-02-19', '103', '6564', '395', '13', null, null, '3', '187', '16', '15', '38', '23', '7509', '1', '24', null, '14891', '7509', null, null);
INSERT INTO `report_cache` VALUES ('403', '2019-02-20', '97', '7866', '375', '14', null, null, '2', '122', '19', '21', '45', '12', '8020', '3', '23', null, '16619', '8020', null, null);
INSERT INTO `report_cache` VALUES ('404', '2019-02-21', '127', '9462', '462', '45', null, null, '5', '176', '38', '22', '82', '19', '5918', '4', '23', null, '16383', '5918', null, null);
INSERT INTO `report_cache` VALUES ('405', '2019-02-22', '129', '9164', '390', '26', null, null, '6', '169', '25', '14', '129', '32', '7345', '3', '12', null, '17444', '7345', null, null);
INSERT INTO `report_cache` VALUES ('406', '2019-02-23', '34', '1808', '74', '11', null, null, null, '66', '5', '7', '23', '14', '5004', null, '2', null, '7048', '5004', null, null);
INSERT INTO `report_cache` VALUES ('407', '2019-02-24', null, '57', '6', '1', null, null, null, null, null, null, null, null, '517', null, null, null, '581', '517', null, null);
INSERT INTO `report_cache` VALUES ('408', '2019-02-25', '95', '5910', '318', '26', null, null, '10', '91', '13', '27', '138', '11', '5802', '3', '2', null, '12446', '5802', null, null);
INSERT INTO `report_cache` VALUES ('409', '2019-02-26', '127', '8967', '461', '27', null, null, '2', '144', '55', '34', '158', '3', '6161', '6', '11', null, '16156', '6161', null, null);
INSERT INTO `report_cache` VALUES ('410', '2019-02-27', '127', '9544', '417', '19', null, null, '1', '198', '16', '12', '36', '20', '5981', '3', '4', null, '16378', '5981', null, null);
INSERT INTO `report_cache` VALUES ('411', '2019-03-01', '118', '9690', '429', '32', null, null, '3', '162', '12', '12', '179', '5', '5989', '3', '12', null, '16646', '5989', null, null);
INSERT INTO `report_cache` VALUES ('412', '2019-03-02', '39', '3058', '149', '3', null, null, '1', '20', '2', '3', '8', '2', '2202', null, null, null, '5487', '2202', null, null);
INSERT INTO `report_cache` VALUES ('413', '2019-03-03', null, '26', null, '1', null, null, null, null, null, null, null, '1', '571', null, null, null, '599', '571', null, null);
INSERT INTO `report_cache` VALUES ('414', '2019-03-04', '79', '7452', '357', '29', null, null, '1', '201', '10', '13', '75', '9', '7352', '9', '6', null, '15593', '7352', null, null);
INSERT INTO `report_cache` VALUES ('415', '2019-03-05', '73', '3809', '186', '11', null, null, '25', '43', '22', '13', '74', '40', '6919', '3', '1', null, '11219', '6919', null, null);
INSERT INTO `report_cache` VALUES ('416', '2019-03-06', '138', '8427', '406', '31', null, null, '1', '222', '23', '12', '70', '16', '6764', null, '18', null, '16128', '6764', null, null);
INSERT INTO `report_cache` VALUES ('417', '2019-03-07', '124', '9469', '400', '25', null, null, '1', '215', '15', '10', '51', '11', '6845', '2', '7', null, '17175', '6845', null, null);
INSERT INTO `report_cache` VALUES ('418', '2019-03-08', '62', '3629', '154', '8', null, null, '1', '117', '36', '18', '7', '64', '6903', '2', '5', null, '11006', '6903', null, null);
INSERT INTO `report_cache` VALUES ('419', '2019-03-09', '46', '3553', '183', '4', null, null, '2', '34', '2', '3', '12', '4', '6439', null, '3', null, '10285', '6439', null, null);
INSERT INTO `report_cache` VALUES ('420', '2019-03-10', '8', '386', '32', '2', null, null, null, null, '1', '1', null, null, '765', null, null, null, '1195', '765', null, null);
INSERT INTO `report_cache` VALUES ('421', '2019-03-11', '119', '7653', '364', '19', null, null, null, '80', '8', '8', '46', '10', '8706', '5', '12', null, '17030', '8706', null, null);
INSERT INTO `report_cache` VALUES ('422', '2019-03-12', '154', '7914', '452', '20', null, null, '1', '95', '18', '17', '35', '10', '8832', '2', '11', null, '17561', '8832', null, null);
INSERT INTO `report_cache` VALUES ('423', '2019-03-13', '163', '10354', '602', '23', null, null, '1', '88', '13', '14', '57', '5', '8742', '3', '6', null, '20071', '8742', null, null);
INSERT INTO `report_cache` VALUES ('424', '2019-03-14', '186', '10683', '593', '35', null, null, '3', '74', '8', '12', '84', '5', '8336', '7', '15', null, '20041', '8336', null, null);
INSERT INTO `report_cache` VALUES ('425', '2019-03-15', '136', '9904', '508', '31', null, null, '3', '100', '8', '17', '34', '57', '8230', '2', '11', null, '19041', '8230', null, null);
INSERT INTO `report_cache` VALUES ('426', '2019-03-16', null, null, null, null, null, null, null, null, null, null, null, null, '383', null, null, null, '383', '383', null, null);
INSERT INTO `report_cache` VALUES ('427', '2019-03-17', '1', null, null, null, null, null, null, null, null, null, null, null, '328', null, null, null, '329', '328', null, null);
INSERT INTO `report_cache` VALUES ('428', '2019-03-18', '144', '8873', '636', '35', null, null, '2', '52', '6', '30', '103', '14', '8606', '1', '5', null, '18507', '8606', null, null);
INSERT INTO `report_cache` VALUES ('429', '2019-03-19', '119', '10450', '655', '26', null, null, null, '90', '9', '9', '175', '13', '5575', '9', '18', null, '17148', '5575', null, null);
INSERT INTO `report_cache` VALUES ('430', '2019-03-20', '139', '9725', '611', '39', null, null, '3', '97', '10', '27', '126', '5', '8696', '25', '18', null, '19521', '8696', null, null);
INSERT INTO `report_cache` VALUES ('431', '2019-03-21', '172', '8619', '583', '38', null, null, '1', '53', '10', '19', '138', '9', '8946', '22', '10', null, '18620', '8946', null, null);
INSERT INTO `report_cache` VALUES ('432', '2019-03-22', '82', '2884', '201', '7', null, null, null, '18', '2', '3', '41', '3', '8958', '23', '6', null, '12228', '8958', null, null);
INSERT INTO `report_cache` VALUES ('433', '2019-03-23', '1', '79', '5', '2', null, null, null, null, null, '1', null, null, '349', null, null, null, '437', '349', null, null);
INSERT INTO `report_cache` VALUES ('434', '2019-03-24', '1', '32', '4', null, null, null, null, null, null, null, null, null, '413', null, null, null, '450', '413', null, null);
INSERT INTO `report_cache` VALUES ('435', '2019-03-25', '71', '3017', '208', '12', null, null, null, '29', '9', '15', '56', '2', '9108', '7', '11', null, '12545', '9108', null, null);
INSERT INTO `report_cache` VALUES ('436', '2019-03-26', '102', '5295', '340', '14', null, null, null, '66', '6', '20', '110', '8', '8904', '4', '39', null, '14908', '8904', null, null);
INSERT INTO `report_cache` VALUES ('437', '2019-03-27', '121', '4977', '307', '10', null, null, null, '31', '13', '25', '235', '6', '8891', '6', '14', null, '14636', '8891', null, null);
INSERT INTO `report_cache` VALUES ('438', '2019-03-28', '230', '15364', '877', '34', null, null, null, '69', '30', '39', '120', '18', '8205', '21', '187', null, '25194', '8205', null, null);
INSERT INTO `report_cache` VALUES ('439', '2019-03-29', '286', '17005', '872', '30', null, null, '7', '227', '16', '31', '493', '41', '7678', '53', '128', null, '26867', '7678', null, null);
INSERT INTO `report_cache` VALUES ('440', '2019-03-30', null, null, null, null, null, null, null, null, null, null, null, null, '5012', null, null, null, '5012', '5012', null, null);
INSERT INTO `report_cache` VALUES ('441', '2019-04-01', '194', '11586', '865', '47', null, null, '6', '172', '10', '18', '277', '35', '7787', '46', '112', null, '21155', '7787', null, null);
INSERT INTO `report_cache` VALUES ('442', '2019-04-02', '200', '10890', '795', '46', null, null, '1', '233', '19', '23', '258', '192', '6494', '18', '56', null, '19225', '6494', null, null);
INSERT INTO `report_cache` VALUES ('443', '2019-04-03', '162', '8200', '788', '19', null, null, '1', '48', '10', '30', '51', '143', '8017', '2', '24', null, '17495', '8017', null, null);
INSERT INTO `report_cache` VALUES ('444', '2019-04-04', '233', '10741', '1024', '34', null, null, '2', '54', '19', '31', '68', '2', '6491', '6', '36', null, '18741', '6491', null, null);
INSERT INTO `report_cache` VALUES ('445', '2019-04-05', '270', '10549', '1093', '32', null, null, '1', '99', '9', '21', '90', '4', '7833', '5', '13', null, '20019', '7833', null, null);
INSERT INTO `report_cache` VALUES ('446', '2019-04-06', '2', '1500', '87', '2', null, null, null, null, null, '3', '1', null, '601', null, '2', null, '2198', '601', null, null);
INSERT INTO `report_cache` VALUES ('447', '2019-04-07', '4', '477', '48', null, null, null, null, null, null, null, null, '2', '356', null, '1', null, '888', '356', null, null);
INSERT INTO `report_cache` VALUES ('448', '2019-04-08', '302', '8257', '1282', '26', null, null, '1', '95', '7', '20', '68', '1', '8692', '3', '23', null, '18777', '8692', null, null);
INSERT INTO `report_cache` VALUES ('449', '2019-04-09', '245', '9718', '1132', '40', null, null, '4', '136', '14', '27', '134', '2', '8808', '8', '28', null, '20296', '8808', null, null);
INSERT INTO `report_cache` VALUES ('450', '2019-04-10', '246', '15181', '796', '49', null, null, '7', '221', '17', '37', '262', '5', '7533', '24', '114', null, '24492', '7533', null, null);
INSERT INTO `report_cache` VALUES ('451', '2019-04-11', '43', '4249', '199', '16', null, null, '1', '132', '11', '5', '80', '2', '8916', '5', '13', null, '13672', '8916', null, null);
INSERT INTO `report_cache` VALUES ('452', '2019-04-12', '132', '10135', '472', '21', null, null, null, '100', '11', '10', '118', '3', '8179', '6', '57', null, '19244', '8179', null, null);
INSERT INTO `report_cache` VALUES ('453', '2019-04-13', '85', '5233', '312', '20', null, null, null, '67', '7', '3', '112', '11', '8169', '7', '15', null, '14041', '8169', null, null);
INSERT INTO `report_cache` VALUES ('454', '2019-04-14', '1', '281', '17', null, null, null, null, '1', null, null, null, null, '465', null, null, null, '765', '465', null, null);
INSERT INTO `report_cache` VALUES ('455', '2019-04-15', '171', '12620', '599', '26', null, null, '4', '147', '11', '25', '135', '34', '7531', '36', '39', null, '21378', '7531', null, null);
INSERT INTO `report_cache` VALUES ('456', '2019-04-16', '80', '4948', '303', '26', null, null, null, '43', '18', '16', '19', '3', '9105', '5', '10', null, '14576', '9105', null, null);
INSERT INTO `report_cache` VALUES ('457', '2019-04-17', null, null, null, null, null, null, null, null, null, null, null, null, '215', null, null, null, '215', '215', null, null);
INSERT INTO `report_cache` VALUES ('458', '2019-04-18', '146', '9716', '510', '25', null, null, '1', '167', '24', '36', '136', '21', '8398', '27', '23', null, '19230', '8398', null, null);
INSERT INTO `report_cache` VALUES ('459', '2019-04-19', '122', '8232', '377', '37', null, null, '16', '158', '8', '27', '99', '32', '5081', '9', '12', null, '14210', '5081', null, null);
INSERT INTO `report_cache` VALUES ('460', '2019-04-20', '43', '2408', '127', '16', null, null, '37', '54', '5', '11', '30', '28', '7128', '8', '7', null, '9902', '7128', null, null);
INSERT INTO `report_cache` VALUES ('461', '2019-04-21', null, null, null, null, null, null, null, null, null, null, null, null, '283', null, null, null, '283', '283', null, null);
INSERT INTO `report_cache` VALUES ('462', '2019-04-22', '113', '7047', '325', '21', null, null, '2', '60', '8', '28', '56', '7', '7929', '13', '52', null, '15661', '7929', null, null);
INSERT INTO `report_cache` VALUES ('463', '2019-04-23', '99', '8105', '375', '36', null, null, '64', '95', '16', '25', '90', '29', '8987', '13', '33', null, '17967', '8987', null, null);
INSERT INTO `report_cache` VALUES ('464', '2019-04-24', '72', '7075', '222', '55', null, null, '102', '95', '15', '19', '20', '17', '9202', '8', '15', null, '16917', '9202', null, null);
INSERT INTO `report_cache` VALUES ('465', '2019-04-25', '121', '12322', '477', '65', null, null, '70', '174', '17', '25', '65', '11', '8179', '14', '86', null, '21627', '8179', null, null);
INSERT INTO `report_cache` VALUES ('466', '2019-04-26', '51', '3237', '152', '7', null, null, '15', '44', '4', '12', '14', '6', '8682', '16', '23', null, '12263', '8682', null, null);
INSERT INTO `report_cache` VALUES ('467', '2019-04-27', '9', '562', '59', '3', null, null, null, '11', null, '5', '40', '1', '2101', null, null, null, '2791', '2101', null, null);
INSERT INTO `report_cache` VALUES ('468', '2019-04-28', null, null, null, null, null, null, null, null, null, null, null, null, '313', null, null, null, '313', '313', null, null);
INSERT INTO `report_cache` VALUES ('469', '2019-04-29', '151', '9200', '596', '35', null, null, '34', '115', '17', '33', '186', '40', '8374', '67', '81', null, '18929', '8374', null, null);
INSERT INTO `report_cache` VALUES ('470', '2019-05-01', '495', '21022', '1198', '74', null, null, '103', '389', '73', '75', '830', '21', '8166', '61', '630', null, '33137', '8166', null, null);
INSERT INTO `report_cache` VALUES ('471', '2019-05-02', '530', '23779', '1269', '72', null, null, '67', '465', '73', '89', '1950', '21', '5408', '67', '951', null, '34741', '5408', null, null);
INSERT INTO `report_cache` VALUES ('472', '2019-05-03', '437', '23331', '1124', '57', null, null, '66', '378', '72', '72', '1908', '13', '7675', '98', '707', null, '35938', '7675', null, null);
INSERT INTO `report_cache` VALUES ('473', '2019-05-04', '1', '329', '10', null, null, null, null, null, '1', null, null, null, '333', null, null, null, '674', '333', null, null);
INSERT INTO `report_cache` VALUES ('474', '2019-05-05', null, null, null, null, null, null, null, null, null, null, null, null, '258', null, null, null, '258', '258', null, null);
INSERT INTO `report_cache` VALUES ('475', '2019-05-06', '217', '11154', '719', '48', null, null, '13', '188', '38', '37', '523', '29', '9089', '91', '125', null, '22271', '9089', null, null);
INSERT INTO `report_cache` VALUES ('476', '2019-05-07', '212', '11247', '770', '48', null, null, '1', '147', '43', '27', '189', '50', '9225', '8', '56', null, '22023', '9225', null, null);
INSERT INTO `report_cache` VALUES ('477', '2019-05-08', '240', '13655', '916', '55', null, null, '4', '251', '58', '39', '329', '52', '8987', '72', '182', null, '24840', '8987', null, null);
INSERT INTO `report_cache` VALUES ('478', '2019-05-09', '255', '12589', '880', '45', null, null, '4', '174', '38', '46', '84', '56', '9076', '17', '38', null, '23302', '9076', null, null);
INSERT INTO `report_cache` VALUES ('479', '2019-05-10', '212', '10058', '845', '45', null, null, '6', '182', '50', '25', '83', '36', '8662', '27', '37', null, '20268', '8662', null, null);
INSERT INTO `report_cache` VALUES ('480', '2019-05-11', '8', '878', '68', '2', null, null, null, null, null, null, '3', null, '415', null, '2', null, '1376', '415', null, null);
INSERT INTO `report_cache` VALUES ('481', '2019-05-12', null, null, null, null, null, null, null, null, null, null, null, null, '316', null, null, null, '316', '316', null, null);
INSERT INTO `report_cache` VALUES ('482', '2019-05-13', '186', '9150', '745', '51', null, null, '9', '188', '48', '32', '78', '76', '8261', '9', '40', null, '18873', '8261', null, null);
INSERT INTO `report_cache` VALUES ('483', '2019-05-14', '148', '7488', '524', '32', null, null, '7', '137', '22', '19', '107', '37', '7563', '8', '14', null, '16106', '7563', null, null);
INSERT INTO `report_cache` VALUES ('484', '2019-05-15', '155', '10620', '454', '43', null, null, '37', '272', '28', '21', '462', '43', '7763', '74', '258', null, '20230', '7763', null, null);
INSERT INTO `report_cache` VALUES ('485', '2019-05-16', '161', '9134', '435', '37', null, null, '33', '138', '19', '14', '474', '69', '6094', '110', '174', null, '16892', '6094', null, null);
INSERT INTO `report_cache` VALUES ('486', '2019-05-17', '226', '12404', '656', '31', null, null, '39', '185', '29', '19', '779', '9', '5402', '101', '344', null, '20224', '5402', null, null);
INSERT INTO `report_cache` VALUES ('487', '2019-05-18', '15', '408', '17', null, null, null, '1', null, null, null, null, null, '493', '1', '43', null, '978', '493', null, null);
INSERT INTO `report_cache` VALUES ('488', '2019-05-19', null, null, null, null, null, null, null, null, null, null, null, null, '307', null, null, null, '307', '307', null, null);
INSERT INTO `report_cache` VALUES ('489', '2019-05-20', '146', '12068', '635', '40', null, null, '31', '276', '18', '12', '959', '63', '6018', '103', '262', null, '20631', '6018', null, null);
INSERT INTO `report_cache` VALUES ('490', '2019-05-21', '103', '6722', '344', '13', null, null, '24', '223', '29', '9', '450', '70', '6016', '22', '195', null, '14220', '6016', null, null);
INSERT INTO `report_cache` VALUES ('491', '2019-05-22', '128', '6462', '346', '25', null, null, '36', '217', '28', '7', '155', '87', '6288', '26', '84', null, '13889', '6288', null, null);
INSERT INTO `report_cache` VALUES ('492', '2019-05-23', '122', '9162', '362', '21', null, null, '41', '207', '28', '12', '619', '34', '5651', '27', '128', null, '16414', '5651', null, null);
INSERT INTO `report_cache` VALUES ('493', '2019-05-24', '169', '10417', '458', '16', null, null, '28', '144', '15', '8', '801', '32', '5338', '78', '180', null, '17684', '5338', null, null);
INSERT INTO `report_cache` VALUES ('494', '2019-05-25', '135', '7473', '322', '15', null, null, '58', '166', '22', '11', '516', '51', '6261', '91', '223', null, '15344', '6261', null, null);
INSERT INTO `report_cache` VALUES ('495', '2019-05-26', null, '7', '4', null, null, null, null, null, null, null, null, '3', '328', null, null, null, '342', '328', null, null);
INSERT INTO `report_cache` VALUES ('496', '2019-05-27', '7', '796', '31', '1', null, null, '15', '25', '12', '1', '49', '37', '2240', '18', '39', null, '3271', '2240', null, null);
INSERT INTO `report_cache` VALUES ('497', '2019-05-28', '75', '3860', '169', '10', null, null, '77', '13', '6', '7', '227', '46', '6286', '72', '95', null, '10943', '6286', null, null);
INSERT INTO `report_cache` VALUES ('498', '2019-05-29', '113', '8469', '385', '33', null, null, '83', '92', '15', '14', '661', '56', '5840', '88', '259', null, '16108', '5840', null, null);
INSERT INTO `report_cache` VALUES ('499', '2019-05-30', '81', '5204', '226', '14', null, null, '179', '59', '6', '7', '331', '56', '6346', '64', '97', null, '12670', '6346', null, null);
INSERT INTO `report_cache` VALUES ('500', '2019-06-01', null, null, null, null, null, null, null, null, null, null, null, null, '217', null, null, null, '217', '217', null, null);
INSERT INTO `report_cache` VALUES ('501', '2019-06-02', null, null, null, null, null, null, null, null, null, null, null, null, '153', null, null, null, '153', '153', null, null);
INSERT INTO `report_cache` VALUES ('502', '2019-06-03', null, null, null, null, null, null, null, null, null, null, null, null, '22', null, null, null, '22', '22', null, null);
INSERT INTO `report_cache` VALUES ('503', '2019-06-04', null, null, null, null, null, null, null, null, null, null, null, null, '8', null, null, null, '8', '8', null, null);
INSERT INTO `report_cache` VALUES ('504', '2019-06-05', null, null, null, null, null, null, null, null, null, null, null, null, '11', null, null, null, '11', '11', null, null);
INSERT INTO `report_cache` VALUES ('505', '2019-06-06', null, null, null, null, null, null, null, null, null, null, null, null, '9', null, null, null, '9', '9', null, null);
INSERT INTO `report_cache` VALUES ('506', '2019-06-07', null, null, null, null, null, null, null, null, null, null, null, null, '4', null, null, null, '4', '4', null, null);
INSERT INTO `report_cache` VALUES ('507', '2019-06-08', null, null, null, null, null, null, null, null, null, null, null, null, '21', null, null, null, '21', '21', null, null);
INSERT INTO `report_cache` VALUES ('508', '2019-06-09', null, null, null, null, null, null, null, null, null, null, null, null, '29', null, null, null, '29', '29', null, null);
INSERT INTO `report_cache` VALUES ('509', '2019-06-10', '127', '7160', '352', '35', null, null, '80', '52', '19', '17', '803', '108', '10757', '37', '495', null, '20042', '10757', null, null);
INSERT INTO `report_cache` VALUES ('510', '2019-06-11', '142', '5788', '345', '18', null, null, '96', '62', '17', '5', '266', '81', '9585', '39', '121', null, '16565', '9585', null, null);
INSERT INTO `report_cache` VALUES ('511', '2019-06-12', '149', '10159', '677', '40', null, null, '15', '135', '12', '9', '181', '43', '10653', '10', '71', null, '22154', '10653', null, null);
INSERT INTO `report_cache` VALUES ('512', '2019-06-13', '109', '7195', '387', '26', null, null, '3', '80', '11', '6', '108', '27', '12593', '1', '33', null, '20579', '12593', null, null);
INSERT INTO `report_cache` VALUES ('513', '2019-06-14', '190', '12164', '691', '35', null, null, '20', '145', '9', '9', '632', '17', '12442', '30', '283', null, '26667', '12442', null, null);
INSERT INTO `report_cache` VALUES ('514', '2019-06-15', '125', '7075', '404', '24', null, null, '9', '73', '6', '1', '174', '61', '16286', '9', '37', null, '24284', '16286', null, null);
INSERT INTO `report_cache` VALUES ('515', '2019-06-16', null, null, null, null, null, null, null, null, null, null, null, null, '177', null, null, null, '177', '177', null, null);
INSERT INTO `report_cache` VALUES ('516', '2019-06-17', '147', '9933', '548', '36', null, null, '6', '193', '5', '23', '276', '39', '8145', '4', '37', null, '19392', '8145', null, null);
INSERT INTO `report_cache` VALUES ('517', '2019-06-18', '156', '10654', '734', '42', null, null, '6', '225', '8', '21', '366', '37', '6126', '5', '54', null, '18434', '6126', null, null);
INSERT INTO `report_cache` VALUES ('518', '2019-06-19', '196', '11136', '664', '23', null, null, '13', '253', '9', '14', '357', '33', '6123', '8', '79', null, '18908', '6123', null, null);
INSERT INTO `report_cache` VALUES ('519', '2019-06-20', '214', '11637', '744', '50', null, null, '12', '304', '14', '25', '383', '25', '10728', '6', '116', null, '24258', '10728', null, null);
INSERT INTO `report_cache` VALUES ('520', '2019-06-21', '204', '10377', '603', '29', null, null, '9', '133', '1', '8', '352', '47', '7862', '1', '149', null, '19775', '7862', null, null);
INSERT INTO `report_cache` VALUES ('521', '2019-06-22', '7', '278', '19', null, null, null, '1', null, null, null, null, null, '298', null, '4', null, '607', '298', null, null);
INSERT INTO `report_cache` VALUES ('522', '2019-06-23', null, null, null, null, null, null, null, null, null, null, null, null, '268', null, null, null, '268', '268', null, null);
INSERT INTO `report_cache` VALUES ('523', '2019-06-24', '260', '11192', '800', '55', null, null, '31', '344', '10', '13', '408', '31', '8319', '2', '70', null, '21535', '8319', null, null);
INSERT INTO `report_cache` VALUES ('524', '2019-06-25', '133', '9625', '655', '48', null, null, '14', '130', '6', '23', '380', '12', '9072', '3', '81', null, '20182', '9072', null, null);
INSERT INTO `report_cache` VALUES ('525', '2019-06-26', '253', '12402', '700', '52', null, null, '8', '296', '13', '10', '384', '77', '9111', '3', '80', null, '23389', '9111', null, null);
INSERT INTO `report_cache` VALUES ('526', '2019-06-27', '185', '11064', '720', '34', null, null, '27', '130', '5', '16', '406', '23', '9649', '4', '100', null, '22363', '9649', null, null);
INSERT INTO `report_cache` VALUES ('527', '2019-06-28', '73', '3744', '250', '9', null, null, '1', '32', '1', '5', '83', '13', '9128', null, '19', null, '13358', '9128', null, null);
INSERT INTO `report_cache` VALUES ('528', '2019-06-29', '3', '489', '14', null, null, null, null, null, null, null, '25', null, '6875', null, null, null, '7406', '6875', null, null);
INSERT INTO `report_cache` VALUES ('529', '2019-07-01', '195', '8150', '572', '43', null, null, '5', '247', '11', '7', '222', '53', '8820', null, '57', null, '18382', '8820', null, null);
INSERT INTO `report_cache` VALUES ('530', '2019-07-02', '65', '4202', '253', '10', null, null, '2', '67', '4', '6', '57', '71', '11082', null, '11', null, '15830', '11082', null, null);
INSERT INTO `report_cache` VALUES ('531', '2019-07-03', '37', '2135', '111', '5', null, null, null, '54', null, '10', '14', '79', '10102', '2', '6', null, '12555', '10102', null, null);
INSERT INTO `report_cache` VALUES ('532', '2019-07-04', '46', '2557', '135', '8', null, null, '3', '102', '1', '13', '21', '76', '6102', '1', '6', null, '9071', '6102', null, null);
INSERT INTO `report_cache` VALUES ('533', '2019-07-05', '62', '2260', '147', '6', null, null, null, '62', null, '6', '24', '115', '7812', null, null, null, '10494', '7812', null, null);
INSERT INTO `report_cache` VALUES ('534', '2019-07-06', null, '61', '6', null, null, null, null, null, null, null, null, null, '252', null, null, null, '319', '252', null, null);
INSERT INTO `report_cache` VALUES ('535', '2019-07-07', null, null, null, null, null, null, null, null, null, null, null, null, '259', null, null, null, '259', '259', null, null);
INSERT INTO `report_cache` VALUES ('536', '2019-07-08', '108', '5727', '419', '21', null, null, '22', '100', '3', '11', '145', '8', '7487', '1', '35', null, '14087', '7487', null, null);
INSERT INTO `report_cache` VALUES ('537', '2019-07-09', '223', '9401', '682', '32', null, null, '34', '188', '9', '22', '205', '19', '6706', '2', '83', null, '17606', '6706', null, null);
INSERT INTO `report_cache` VALUES ('538', '2019-07-10', '229', '9115', '669', '50', null, null, '24', '128', '12', '12', '280', '16', '6060', '2', '147', null, '16744', '6060', null, null);
INSERT INTO `report_cache` VALUES ('539', '2019-07-11', '208', '8102', '731', '37', null, null, '16', '183', '13', '24', '61', '25', '6000', '1', '33', null, '15434', '6000', null, null);
INSERT INTO `report_cache` VALUES ('540', '2019-07-12', '211', '9453', '695', '34', null, null, '45', '296', '9', '29', '119', '45', '9063', '6', '50', null, '20055', '9063', null, null);
INSERT INTO `report_cache` VALUES ('541', '2019-07-13', '37', '769', '61', '2', null, null, null, '7', '1', null, '4', '4', '566', '3', '3', null, '1457', '566', null, null);
INSERT INTO `report_cache` VALUES ('542', '2019-07-14', '3', '20', '1', null, null, null, null, null, null, null, null, null, '230', null, null, null, '254', '230', null, null);
INSERT INTO `report_cache` VALUES ('543', '2019-07-15', '266', '13710', '1159', '44', null, null, '18', '237', '8', '15', '149', '152', '9070', '2', '44', null, '24874', '9070', null, null);
INSERT INTO `report_cache` VALUES ('544', '2019-07-16', '304', '15461', '1018', '57', null, null, '42', '497', '21', '42', '208', '28', '6277', '4', '44', null, '24004', '6277', null, null);
INSERT INTO `report_cache` VALUES ('545', '2019-07-17', '228', '10644', '720', '33', null, null, '27', '331', '8', '23', '266', '29', '5816', '3', '98', null, '18226', '5816', null, null);
INSERT INTO `report_cache` VALUES ('546', '2019-07-18', '341', '14676', '994', '59', null, null, '31', '429', '27', '19', '464', '15', '7941', '8', '127', null, '25131', '7941', null, null);
INSERT INTO `report_cache` VALUES ('547', '2019-07-19', '226', '12143', '690', '35', null, null, '16', '243', '24', '22', '175', '23', '8488', '1', '31', null, '22117', '8488', null, null);
INSERT INTO `report_cache` VALUES ('548', '2019-07-20', '80', '4877', '245', '12', null, null, '4', '335', '8', '17', '117', '1', '1489', null, '19', null, '7204', '1489', null, null);
INSERT INTO `report_cache` VALUES ('549', '2019-07-21', '18', '276', '10', null, null, null, null, null, null, null, null, '2', '396', null, null, null, '702', '396', null, null);
INSERT INTO `report_cache` VALUES ('550', '2019-07-22', '225', '15393', '846', '75', null, null, '12', '677', '47', '57', '1021', '34', '7930', '7', '173', null, '26497', '7930', null, null);
INSERT INTO `report_cache` VALUES ('551', '2019-07-23', '136', '7746', '464', '41', null, null, '4', '164', '15', '19', '666', '21', '7572', null, '103', null, '16951', '7572', null, null);
INSERT INTO `report_cache` VALUES ('552', '2019-07-24', '291', '15216', '1038', '86', null, null, '66', '199', '19', '39', '3546', '78', '8928', '3', '379', null, '29888', '8928', null, null);
INSERT INTO `report_cache` VALUES ('553', '2019-07-25', '173', '10245', '654', '37', null, null, '58', '208', '30', '34', '2504', '65', '9756', '6', '327', null, '24097', '9756', null, null);
INSERT INTO `report_cache` VALUES ('554', '2019-07-26', '233', '16663', '817', '40', null, null, '39', '321', '16', '56', '4247', '50', '9383', '9', '445', null, '32319', '9383', null, null);
INSERT INTO `report_cache` VALUES ('555', '2019-07-27', '15', '746', '51', '2', null, null, '1', '76', '1', '7', '112', null, '4188', '2', '2', null, '5203', '4188', null, null);
INSERT INTO `report_cache` VALUES ('556', '2019-07-28', null, null, null, null, null, null, null, null, null, null, null, null, '250', null, null, null, '250', '250', null, null);
INSERT INTO `report_cache` VALUES ('557', '2019-07-29', '180', '10058', '661', '71', null, null, '9', '320', '31', '23', '4081', '74', '9315', null, '98', null, '24921', '9315', null, null);
INSERT INTO `report_cache` VALUES ('558', '2019-07-30', '176', '9371', '601', '33', null, null, '6', '194', '25', '32', '4238', '100', '6240', '6', '93', null, '21115', '6240', null, null);
INSERT INTO `report_cache` VALUES ('559', '2019-08-01', '121', '9639', '333', '25', null, null, null, '53', '11', '26', '4197', '112', '6309', '121', '9', null, '20956', '6308', '1', null);
INSERT INTO `report_cache` VALUES ('560', '2019-08-02', '150', '9698', '427', '40', null, null, '3', '83', '14', '60', '6770', '113', '5974', '13', '166', null, '23511', '5974', null, null);
INSERT INTO `report_cache` VALUES ('561', '2019-08-03', '13', '579', '18', '6', null, null, '4', '2', '2', '1', '294', '19', '2847', null, '4', null, '3789', '2847', null, null);
INSERT INTO `report_cache` VALUES ('562', '2019-08-04', null, null, null, null, null, null, null, null, null, null, null, null, '224', null, null, null, '224', '224', null, null);
INSERT INTO `report_cache` VALUES ('563', '2019-08-05', '171', '8862', '599', '41', null, null, '79', '166', '26', '38', '8028', '84', '12586', '70', '196', null, '30946', '12586', null, null);
INSERT INTO `report_cache` VALUES ('564', '2019-08-06', '111', '7021', '417', '38', null, null, '11', '49', '7', '47', '6328', '75', '6154', '50', '62', null, '20370', '6154', null, null);
INSERT INTO `report_cache` VALUES ('565', '2019-08-07', '117', '5969', '377', '25', null, null, '11', '124', '16', '19', '6523', '60', '8245', '58', '95', null, '21639', '8245', null, null);
INSERT INTO `report_cache` VALUES ('566', '2019-08-08', '178', '6335', '440', '27', null, null, '33', '58', '9', '29', '5595', '49', '7823', '63', '173', null, '20812', '7823', null, null);
INSERT INTO `report_cache` VALUES ('567', '2019-08-09', '219', '12132', '776', '45', null, null, '19', '111', '25', '49', '9031', '63', '9045', '15', '140', null, '31670', '9045', null, null);
INSERT INTO `report_cache` VALUES ('568', '2019-08-10', '32', '1060', '107', '5', null, null, '1', '28', '1', '1', '475', '15', '1133', '1', '8', null, '2867', '1133', null, null);
INSERT INTO `report_cache` VALUES ('569', '2019-08-11', null, null, null, null, null, null, null, null, null, null, null, null, '202', null, null, null, '202', '202', null, null);
INSERT INTO `report_cache` VALUES ('570', '2019-08-12', '195', '6981', '790', '40', null, null, '28', '124', '22', '68', '7177', '82', '7784', '86', '148', null, '23525', '7784', null, null);
INSERT INTO `report_cache` VALUES ('571', '2019-08-13', '153', '5974', '603', '28', null, null, '10', '130', '21', '37', '6631', '83', '7455', '49', '50', null, '21224', '7455', null, null);
INSERT INTO `report_cache` VALUES ('572', '2019-08-14', '150', '6113', '565', '30', null, null, null, '107', '17', '38', '5291', '77', '9209', '25', '69', null, '21691', '9209', null, null);
INSERT INTO `report_cache` VALUES ('573', '2019-08-15', '249', '7666', '714', '36', null, null, '68', '219', '28', '47', '4947', '57', '9141', '101', '580', null, '23853', '9141', null, null);
INSERT INTO `report_cache` VALUES ('574', '2019-08-16', '157', '4933', '512', '31', null, null, '20', '100', '18', '43', '2104', '28', '8153', '149', '153', null, '16401', '8153', null, null);
INSERT INTO `report_cache` VALUES ('575', '2019-08-17', null, null, null, null, null, null, null, null, null, null, null, null, '34', null, null, null, '34', '34', null, null);
INSERT INTO `report_cache` VALUES ('576', '2019-08-18', null, null, null, null, null, null, null, null, null, null, null, '1', '26', null, null, null, '27', '26', null, null);
INSERT INTO `report_cache` VALUES ('577', '2019-08-19', '194', '6904', '659', '36', null, null, '7', '95', '28', '30', '5583', '61', '9054', '171', '51', null, '22873', '9054', null, null);
INSERT INTO `report_cache` VALUES ('578', '2019-08-20', '140', '5718', '503', '32', null, null, '3', '137', '15', '12', '3550', '32', '8681', '46', '68', null, '18937', '8681', null, null);
INSERT INTO `report_cache` VALUES ('579', '2019-08-21', '36', '2211', '158', '7', null, null, null, '14', '6', '12', '2885', '62', '8100', '2', '84', null, '13577', '8100', null, null);
INSERT INTO `report_cache` VALUES ('580', '2019-08-22', '68', '3024', '146', '10', null, null, '3', '33', '9', '54', '5674', '29', '8243', '3', '62', null, '17358', '8243', null, null);
INSERT INTO `report_cache` VALUES ('581', '2019-08-23', '19', '1446', '89', '5', null, null, '1', '10', '2', '8', '1196', '44', '8823', '2', '27', null, '11672', '8823', null, null);
INSERT INTO `report_cache` VALUES ('582', '2019-08-24', '21', '824', '46', '2', null, null, null, null, '2', null, '1035', '9', '1465', '1', '1', null, '3406', '1465', null, null);
INSERT INTO `report_cache` VALUES ('583', '2019-08-25', null, null, null, null, null, null, null, null, null, null, null, null, '349', null, null, null, '349', '349', null, null);
INSERT INTO `report_cache` VALUES ('584', '2019-08-26', '132', '3248', '411', '13', null, null, null, '113', '5', '30', '3381', '29', '9240', '1', '48', null, '16651', '9240', null, null);
INSERT INTO `report_cache` VALUES ('585', '2019-08-27', '125', '3070', '460', '12', null, null, '6', '68', '8', '30', '4687', '43', '9319', '7', '39', null, '17874', '9319', null, null);
INSERT INTO `report_cache` VALUES ('586', '2019-08-28', '55', '2043', '212', '8', null, null, null, '8', '2', '11', '2301', '38', '8529', null, '4', null, '13211', '8529', null, null);
INSERT INTO `report_cache` VALUES ('587', '2019-08-29', '100', '2761', '345', '9', null, null, '4', '29', '2', '19', '3494', '46', '7854', '2', '6', null, '14671', '7854', null, null);
INSERT INTO `report_cache` VALUES ('588', '2019-08-30', '83', '2627', '357', '15', null, null, '1', '40', '8', '24', '2517', '50', '5075', '2', '2', null, '10801', '5075', null, null);
INSERT INTO `report_cache` VALUES ('589', '2019-09-01', null, null, null, null, null, null, null, null, null, null, '1', null, '337', null, null, null, '338', '336', '1', null);
INSERT INTO `report_cache` VALUES ('590', '2019-09-02', '117', '3720', '635', '25', null, null, '12', '33', '12', '26', '3160', '38', '8579', '4', '33', null, '16394', '8579', null, null);
INSERT INTO `report_cache` VALUES ('591', '2019-09-03', '138', '5834', '699', '48', null, null, '14', '116', '11', '15', '2181', '21', '8095', '4', '64', null, '17240', '8095', null, null);
INSERT INTO `report_cache` VALUES ('592', '2019-09-04', '154', '8156', '640', '48', null, null, '66', '189', '17', '43', '3634', '44', '8605', '31', '481', null, '22108', '8605', null, null);
INSERT INTO `report_cache` VALUES ('593', '2019-09-05', '160', '7597', '554', '34', null, null, '96', '309', '16', '27', '3284', '30', '7115', '7', '377', null, '19606', '7115', null, null);
INSERT INTO `report_cache` VALUES ('594', '2019-09-06', '130', '6244', '535', '32', null, null, '56', '280', '19', '33', '3247', '25', '5808', '15', '367', null, '16791', '5808', null, null);
INSERT INTO `report_cache` VALUES ('595', '2019-09-07', '27', '828', '114', '8', null, null, '2', '114', '10', '12', '162', '1', '1104', null, '23', null, '2405', '1104', null, null);
INSERT INTO `report_cache` VALUES ('596', '2019-09-08', '11', '225', '40', '5', null, null, null, null, '1', null, '14', null, '408', null, null, null, '704', '408', null, null);
INSERT INTO `report_cache` VALUES ('597', '2019-09-09', '207', '6018', '725', '28', null, null, '12', '169', '14', '19', '2033', '27', '9604', '2', '58', null, '18916', '9604', null, null);
INSERT INTO `report_cache` VALUES ('598', '2019-09-10', '110', '2753', '337', '18', null, null, '20', '84', '5', '21', '609', '31', '9084', '6', '38', null, '13116', '9084', null, null);
INSERT INTO `report_cache` VALUES ('599', '2019-09-11', '209', '5696', '717', '32', null, null, '34', '176', '10', '18', '1646', '32', '9000', '13', '201', null, '17785', '9000', null, null);
INSERT INTO `report_cache` VALUES ('600', '2019-09-12', '289', '7521', '925', '36', null, null, '47', '290', '18', '72', '2110', '15', '7882', '19', '300', null, '19524', '7882', null, null);
INSERT INTO `report_cache` VALUES ('601', '2019-09-13', '211', '5416', '651', '25', null, null, '45', '136', '15', '34', '1047', '45', '8818', '21', '288', null, '16752', '8818', null, null);
INSERT INTO `report_cache` VALUES ('602', '2019-09-14', '299', '8998', '859', '25', null, null, '40', '170', '11', '37', '2036', '12', '8786', '36', '330', null, '21640', '8786', null, null);
INSERT INTO `report_cache` VALUES ('603', '2019-09-15', null, '19', '7', null, null, null, null, null, null, null, '6', '1', '327', null, null, null, '360', '327', null, null);
INSERT INTO `report_cache` VALUES ('604', '2019-09-16', '87', '3808', '389', '12', null, null, '27', '44', '6', '23', '914', '20', '8665', '4', '55', null, '14054', '8665', null, null);
INSERT INTO `report_cache` VALUES ('605', '2019-09-17', '110', '4173', '412', '18', null, null, '19', '89', '10', '25', '1233', '12', '9424', '27', '164', null, '15716', '9424', null, null);
INSERT INTO `report_cache` VALUES ('606', '2019-09-18', '167', '6887', '614', '24', null, null, '18', '138', '9', '27', '1366', '29', '7558', null, '89', null, '16926', '7558', null, null);
INSERT INTO `report_cache` VALUES ('607', '2019-09-19', '129', '5355', '493', '10', null, null, '10', '51', '2', '12', '1503', '58', '6564', '3', '76', null, '14266', '6564', null, null);
INSERT INTO `report_cache` VALUES ('608', '2019-09-20', '115', '3997', '277', '16', null, null, '3', '36', '11', '16', '569', '38', '9404', '1', '23', null, '14506', '9404', null, null);
INSERT INTO `report_cache` VALUES ('609', '2019-09-21', '34', '1919', '144', '10', null, null, '7', '18', '2', '1', '421', '3', '3920', null, '49', null, '6528', '3920', null, null);
INSERT INTO `report_cache` VALUES ('610', '2019-09-22', '1', '62', '2', null, null, null, null, '4', null, null, '9', null, '3098', null, '1', null, '3177', '3098', null, null);
INSERT INTO `report_cache` VALUES ('611', '2019-09-23', '187', '6817', '554', '24', null, null, '14', '97', '13', '19', '1216', '61', '8867', '1', '180', null, '18050', '8867', null, null);
INSERT INTO `report_cache` VALUES ('612', '2019-09-24', '197', '6137', '607', '33', null, null, '15', '63', '9', '20', '1085', '52', '8962', '3', '62', null, '17245', '8962', null, null);
INSERT INTO `report_cache` VALUES ('613', '2019-09-25', '210', '6966', '673', '25', null, null, '9', '96', '14', '13', '1569', '45', '8808', '1', '97', null, '18526', '8808', null, null);
INSERT INTO `report_cache` VALUES ('614', '2019-09-26', '194', '9197', '674', '42', null, null, '8', '126', '8', '24', '2284', '29', '8543', '3', '87', null, '21219', '8543', null, null);
INSERT INTO `report_cache` VALUES ('615', '2019-09-27', '102', '4965', '319', '14', null, null, '3', '50', '10', '36', '1451', '45', '6191', '4', '27', null, '13217', '6191', null, null);
INSERT INTO `report_cache` VALUES ('616', '2019-09-28', '24', '1196', '86', '1', null, null, '1', '19', '1', '8', '271', '1', '6515', '10', '3', null, '8136', '6515', null, null);
INSERT INTO `report_cache` VALUES ('617', '2019-09-29', null, null, null, null, null, null, null, null, null, null, null, null, '3379', null, null, null, '3379', '3379', null, null);
INSERT INTO `report_cache` VALUES ('618', '2019-10-01', '189', '7347', '589', '46', null, null, '9', '60', '19', '36', '1614', '59', '8873', '48', '49', null, '18938', '8873', null, null);
INSERT INTO `report_cache` VALUES ('619', '2019-10-02', '158', '8217', '633', '39', null, null, '19', '95', '15', '50', '1627', '20', '5880', '25', '71', null, '16849', '5880', null, null);
INSERT INTO `report_cache` VALUES ('620', '2019-10-03', '73', '3242', '209', '19', null, null, '5', '57', '7', '27', '422', '61', '6429', '26', '21', null, '10598', '6429', null, null);
INSERT INTO `report_cache` VALUES ('621', '2019-10-04', '18', '774', '39', '8', null, null, '3', '14', '8', '25', '123', '14', '6268', '45', '9', null, '7348', '6268', null, null);
INSERT INTO `report_cache` VALUES ('622', '2019-10-05', '1', '6', '8', null, null, null, null, null, null, null, '1', null, '741', null, null, null, '757', '741', null, null);
INSERT INTO `report_cache` VALUES ('623', '2019-10-06', null, null, null, null, null, null, null, null, null, null, null, null, '246', null, null, null, '246', '246', null, null);
INSERT INTO `report_cache` VALUES ('624', '2019-10-07', '21', '3600', '86', '6', null, null, null, '10', '1', '10', '253', '8', '6169', '2', '3', null, '10169', '6169', null, null);
INSERT INTO `report_cache` VALUES ('625', '2019-10-08', '64', '3062', '143', '12', null, null, '1', '15', '6', '19', '224', '1', '6133', '22', '43', null, '9745', '6133', null, null);
INSERT INTO `report_cache` VALUES ('626', '2019-10-09', '104', '2773', '208', '14', null, null, null, '78', '4', '17', '360', '11', '6072', '25', '3', null, '9669', '6072', null, null);
INSERT INTO `report_cache` VALUES ('627', '2019-10-10', '120', '5482', '477', '24', null, null, '2', '51', '9', '18', '835', '10', '5730', '40', '68', null, '12866', '5730', null, null);
INSERT INTO `report_cache` VALUES ('628', '2019-10-11', '99', '3965', '207', '15', null, null, '1', '43', '12', '19', '578', '43', '5950', '31', '51', null, '11014', '5950', null, null);
INSERT INTO `report_cache` VALUES ('629', '2019-10-12', '13', '1606', '42', '4', null, null, null, null, null, '25', '103', '69', '585', null, '6', null, '2453', '585', null, null);
INSERT INTO `report_cache` VALUES ('630', '2019-10-13', '1', '326', '22', null, null, null, null, null, null, null, '131', '112', '258', null, '1', null, '851', '258', null, null);
INSERT INTO `report_cache` VALUES ('631', '2019-10-14', '307', '12420', '725', '27', null, null, '10', '234', '21', '60', '2533', '83', '8527', '34', '65', null, '25046', '8527', null, null);
INSERT INTO `report_cache` VALUES ('632', '2019-10-15', '157', '8888', '502', '30', null, null, '4', '90', '4', '30', '961', '32', '8962', '29', '10', null, '19699', '8962', null, null);
INSERT INTO `report_cache` VALUES ('633', '2019-10-16', '232', '7020', '572', '38', null, null, '1', '108', '10', '47', '1147', '49', '8652', '33', '41', null, '17950', '8652', null, null);
INSERT INTO `report_cache` VALUES ('634', '2019-10-17', '237', '9017', '573', '29', null, null, '3', '112', '6', '51', '1240', '36', '8272', '29', '28', null, '19633', '8272', null, null);
INSERT INTO `report_cache` VALUES ('635', '2019-10-18', '203', '8277', '498', '51', null, null, '6', '211', '10', '48', '826', '45', '7741', '31', '22', null, '17969', '7741', null, null);
INSERT INTO `report_cache` VALUES ('636', '2019-10-19', '38', '1743', '83', '5', null, null, '1', '37', null, '6', '284', '10', '3063', '32', '1', null, '5303', '3063', null, null);
INSERT INTO `report_cache` VALUES ('637', '2019-10-20', null, '112', '3', null, null, null, null, null, null, null, '11', null, '338', null, null, null, '464', '338', null, null);
INSERT INTO `report_cache` VALUES ('638', '2019-10-21', '114', '4424', '313', '10', null, null, '1', '127', '17', '34', '307', '39', '9739', '30', '15', null, '15170', '9739', null, null);
INSERT INTO `report_cache` VALUES ('639', '2019-10-22', '108', '2603', '255', '20', null, null, '3', '66', '6', '17', '281', '12', '9803', '7', '31', null, '13212', '9803', null, null);
INSERT INTO `report_cache` VALUES ('640', '2019-10-23', '94', '3478', '302', '25', null, null, '2', '41', '8', '21', '313', '30', '7788', '28', '28', null, '12159', '7788', null, null);
INSERT INTO `report_cache` VALUES ('641', '2019-10-24', '97', '4144', '246', '6', null, null, '9', '57', '11', '26', '278', '54', '10524', '34', '17', null, '15503', '10524', null, null);
INSERT INTO `report_cache` VALUES ('642', '2019-10-25', '139', '8108', '483', '14', null, null, '28', '163', '5', '39', '496', '13', '8547', '13', '13', null, '18061', '8547', null, null);
INSERT INTO `report_cache` VALUES ('643', '2019-10-26', '10', '481', '45', '2', null, null, null, '6', null, '8', '41', '1', '4056', '8', '1', null, '4659', '4056', null, null);
INSERT INTO `report_cache` VALUES ('644', '2019-10-27', null, '5', '1', null, null, null, null, null, null, null, '2', null, '263', null, null, null, '271', '263', null, null);
INSERT INTO `report_cache` VALUES ('645', '2019-10-28', '74', '2702', '213', '16', null, null, '1', '90', '22', '80', '207', '93', '9939', '38', '6', null, '13481', '9939', null, null);
INSERT INTO `report_cache` VALUES ('646', '2019-10-29', '204', '8550', '710', '44', null, null, '13', '267', '81', '143', '1541', '58', '11134', '87', '54', null, '22886', '11134', null, null);
INSERT INTO `report_cache` VALUES ('647', '2019-10-30', '261', '11124', '693', '41', null, null, '14', '456', '107', '165', '1563', '7', '8647', '68', '74', null, '23220', '8647', null, null);
INSERT INTO `report_cache` VALUES ('648', '2019-11-01', '10', '135', '10', null, null, null, null, '5', '3', '2', '15', null, '659', '19', null, null, '858', '658', '1', null);
INSERT INTO `report_cache` VALUES ('649', '2019-11-02', '1', '84', '3', null, null, null, null, null, null, null, '23', '33', '416', null, '1', null, '561', '416', null, null);
INSERT INTO `report_cache` VALUES ('650', '2019-11-03', null, null, null, null, null, null, null, null, null, null, null, null, '221', null, null, null, '221', '221', null, null);
INSERT INTO `report_cache` VALUES ('651', '2019-11-04', '103', '3819', '247', '26', null, null, '6', '120', '19', '71', '511', '65', '13758', '30', '45', null, '18820', '13758', null, null);
INSERT INTO `report_cache` VALUES ('652', '2019-11-05', '185', '6023', '458', '30', null, null, '106', '218', '50', '93', '4630', '46', '7927', '61', '1543', null, '21370', '7927', null, null);
INSERT INTO `report_cache` VALUES ('653', '2019-11-06', '230', '7649', '534', '40', null, null, '21', '155', '34', '92', '6234', '31', '7912', '49', '1438', null, '24419', '7912', null, null);
INSERT INTO `report_cache` VALUES ('654', '2019-11-07', '249', '8082', '564', '45', null, null, '23', '227', '42', '96', '4829', '24', '9702', '28', '1526', null, '25437', '9702', null, null);
INSERT INTO `report_cache` VALUES ('655', '2019-11-08', '233', '8104', '592', '41', null, null, '43', '325', '44', '99', '2692', '38', '9663', '134', '341', null, '22349', '9663', null, null);
INSERT INTO `report_cache` VALUES ('656', '2019-11-09', '35', '1083', '88', '3', null, null, '11', '53', '6', '13', '632', '1', '780', '62', '35', null, '2802', '780', null, null);
INSERT INTO `report_cache` VALUES ('657', '2019-11-10', '5', '309', '27', '1', null, null, null, null, null, '5', '32', null, '345', null, '2', null, '726', '345', null, null);
INSERT INTO `report_cache` VALUES ('658', '2019-11-11', '298', '9691', '758', '39', null, null, '30', '282', '49', '90', '1352', '53', '9999', '102', '343', null, '23086', '9999', null, null);
INSERT INTO `report_cache` VALUES ('659', '2019-11-12', '322', '11696', '879', '20', null, null, '3', '310', '37', '97', '2884', '94', '5900', '60', '163', null, '22465', '5900', null, null);
INSERT INTO `report_cache` VALUES ('660', '2019-11-13', '294', '9442', '844', '26', null, null, '20', '282', '37', '70', '2351', '12', '10219', '115', '303', null, '24015', '10219', null, null);
INSERT INTO `report_cache` VALUES ('661', '2019-11-14', '265', '10708', '847', '52', null, null, '6', '187', '33', '65', '2660', '16', '5296', '67', '68', null, '20270', '5296', null, null);
INSERT INTO `report_cache` VALUES ('662', '2019-11-15', '187', '7873', '531', '18', null, null, '3', '113', '24', '21', '1693', '20', '9354', '83', '57', null, '19977', '9354', null, null);
INSERT INTO `report_cache` VALUES ('663', '2019-11-16', '20', '674', '27', '1', null, null, null, '7', null, null, '274', '16', '316', '5', '4', null, '1344', '316', null, null);
INSERT INTO `report_cache` VALUES ('664', '2019-11-17', null, null, null, null, null, null, null, null, null, null, null, null, '161', null, null, null, '161', '161', null, null);
INSERT INTO `report_cache` VALUES ('665', '2019-11-18', '264', '8819', '811', '44', null, null, '7', '140', '33', '31', '1725', '22', '9358', '109', '150', null, '21513', '9358', null, null);
INSERT INTO `report_cache` VALUES ('666', '2019-11-19', '239', '8503', '785', '38', null, null, '3', '289', '28', '49', '1738', '49', '6060', '43', '124', null, '17948', '6060', null, null);
INSERT INTO `report_cache` VALUES ('667', '2019-11-20', '172', '5955', '508', '34', null, null, '1', '95', '18', '41', '908', '32', '7142', '38', '78', null, '15022', '7142', null, null);
INSERT INTO `report_cache` VALUES ('668', '2019-11-21', '259', '9917', '714', '39', null, null, '9', '273', '43', '98', '2260', '19', '8111', '103', '294', null, '22139', '8111', null, null);
INSERT INTO `report_cache` VALUES ('669', '2019-11-22', '291', '8990', '735', '37', null, null, '9', '338', '34', '117', '1979', '17', '6459', '167', '347', null, '19520', '6459', null, null);
INSERT INTO `report_cache` VALUES ('670', '2019-11-23', '138', '5619', '382', '19', null, null, null, '102', '7', '58', '802', '51', '4939', '62', '20', null, '12199', '4939', null, null);
INSERT INTO `report_cache` VALUES ('671', '2019-11-24', null, null, null, null, null, null, null, null, null, null, null, null, '173', null, null, null, '173', '173', null, null);
INSERT INTO `report_cache` VALUES ('672', '2019-11-25', '244', '8457', '643', '29', null, null, '9', '321', '21', '113', '1968', '20', '8978', '95', '232', null, '21130', '8978', null, null);
INSERT INTO `report_cache` VALUES ('673', '2019-11-26', '340', '10361', '843', '47', null, null, '6', '254', '24', '89', '2942', '20', '11649', '85', '269', null, '26929', '11649', null, null);
INSERT INTO `report_cache` VALUES ('674', '2019-11-27', '433', '12252', '1041', '51', null, null, '5', '283', '51', '150', '4127', '10', '8243', '163', '360', null, '27169', '8243', null, null);
INSERT INTO `report_cache` VALUES ('675', '2019-11-28', '312', '8983', '749', '32', null, null, '2', '295', '36', '110', '1894', '40', '8247', '106', '202', null, '21008', '8247', null, null);
INSERT INTO `report_cache` VALUES ('676', '2019-11-29', '251', '7231', '730', '37', null, null, '6', '141', '21', '30', '2902', '47', '14209', '71', '301', null, '25977', '14209', null, null);
INSERT INTO `report_cache` VALUES ('677', '2019-12-01', null, null, null, null, null, null, null, null, null, null, null, null, '132', null, null, null, '132', '132', null, null);
INSERT INTO `report_cache` VALUES ('678', '2019-12-02', '201', '5778', '455', '17', null, null, '4', '220', '29', '27', '1638', '26', '5652', '46', '22', null, '14115', '5652', null, null);
INSERT INTO `report_cache` VALUES ('679', '2019-12-03', '158', '5381', '404', '15', null, null, '2', '162', '20', '20', '1456', '28', '9977', '50', '11', null, '17684', '9977', null, null);
INSERT INTO `report_cache` VALUES ('680', '2019-12-04', '143', '6787', '456', '21', null, null, '8', '152', '26', '34', '1249', '23', '9798', '79', '34', null, '18810', '9798', null, null);
INSERT INTO `report_cache` VALUES ('681', '2019-12-05', '103', '3228', '281', '17', null, null, '1', '161', '21', '28', '724', '28', '10384', '28', '12', null, '15016', '10384', null, null);
INSERT INTO `report_cache` VALUES ('682', '2019-12-06', '87', '3003', '218', '16', null, null, '2', '68', '15', '10', '625', '13', '8730', '52', '27', null, '12866', '8730', null, null);
INSERT INTO `report_cache` VALUES ('683', '2019-12-07', '83', '4441', '290', '11', null, null, '2', '138', '9', '29', '1303', '11', '6051', '46', '55', null, '12469', '6051', null, null);
INSERT INTO `report_cache` VALUES ('684', '2019-12-08', '1', null, null, null, null, null, null, null, null, null, null, null, '152', null, null, null, '153', '152', null, null);
INSERT INTO `report_cache` VALUES ('685', '2019-12-09', '204', '8020', '588', '30', null, null, '6', '186', '40', '16', '1490', '21', '11000', '78', '48', null, '21727', '11000', null, null);
INSERT INTO `report_cache` VALUES ('686', '2019-12-10', '332', '13012', '862', '35', null, null, '35', '254', '43', '52', '3276', '31', '8839', '251', '178', null, '27200', '8839', null, null);
INSERT INTO `report_cache` VALUES ('687', '2019-12-11', '286', '9016', '573', '34', null, null, '73', '248', '51', '29', '2299', '15', '10169', '67', '217', null, '23077', '10169', null, null);
INSERT INTO `report_cache` VALUES ('688', '2019-12-12', '332', '10283', '711', '57', null, null, '45', '86', '13', '31', '2705', '44', '9081', '147', '142', null, '23677', '9081', null, null);
INSERT INTO `report_cache` VALUES ('689', '2019-12-13', '328', '8973', '690', '40', null, null, '31', '225', '20', '46', '2238', '33', '9640', '115', '69', null, '22448', '9640', null, null);
INSERT INTO `report_cache` VALUES ('690', '2019-12-14', '37', '1016', '71', '3', null, null, null, '17', null, '1', '115', '8', '1141', '40', '2', null, '2451', '1141', null, null);
INSERT INTO `report_cache` VALUES ('691', '2019-12-15', '1', null, null, null, null, null, null, null, null, null, null, null, '279', null, null, null, '280', '279', null, null);
INSERT INTO `report_cache` VALUES ('692', '2019-12-16', '168', '7553', '661', '26', null, null, '18', '137', '29', '33', '1569', '40', '10869', '18', '53', null, '21175', '10869', null, null);
INSERT INTO `report_cache` VALUES ('693', '2019-12-17', '320', '9551', '826', '26', null, null, '28', '186', '9', '22', '2329', '57', '10104', '91', '99', null, '23648', '10104', null, null);
INSERT INTO `report_cache` VALUES ('694', '2019-12-18', '140', '6280', '447', '22', null, null, '11', '138', '4', '14', '1391', '21', '43319', '81', '47', null, '51915', '43319', null, null);
INSERT INTO `report_cache` VALUES ('695', '2019-12-19', '107', '4300', '276', '16', null, null, '10', '181', '7', '24', '1941', '23', '1193', '26', '599', null, '8703', '1193', null, null);
INSERT INTO `report_cache` VALUES ('696', '2019-12-20', '202', '8497', '564', '31', null, null, '17', '248', '14', '56', '4022', '23', '6091', '80', '1074', null, '20919', '6091', null, null);
INSERT INTO `report_cache` VALUES ('697', '2019-12-21', '10', '503', '24', '1', null, null, '2', '11', '1', '4', '123', '45', '1135', null, '48', null, '1907', '1135', null, null);
INSERT INTO `report_cache` VALUES ('698', '2019-12-22', null, '39', '2', null, null, null, null, '1', null, null, null, '1', '292', null, null, null, '335', '292', null, null);
INSERT INTO `report_cache` VALUES ('699', '2019-12-23', '76', '2729', '208', '5', null, null, '2', '27', '7', '6', '440', '6', '9893', '16', '138', null, '13553', '9893', null, null);
INSERT INTO `report_cache` VALUES ('700', '2019-12-24', '190', '3779', '319', '19', null, null, '2', '101', '9', '12', '1304', '41', '6134', '26', '275', null, '12211', '6134', null, null);
INSERT INTO `report_cache` VALUES ('701', '2019-12-25', '171', '5372', '374', '20', null, null, '3', '123', '6', '17', '2004', '28', '5210', '62', '375', null, '13765', '5210', null, null);
INSERT INTO `report_cache` VALUES ('702', '2019-12-26', '91', '3767', '290', '16', null, null, '3', '93', '14', '18', '1616', '19', '3354', '80', '366', null, '9727', '3354', null, null);
INSERT INTO `report_cache` VALUES ('703', '2019-12-27', '18', '647', '50', '1', null, null, null, '33', '2', null, '87', '14', '1456', '13', '56', null, '2377', '1456', null, null);
INSERT INTO `report_cache` VALUES ('704', '2019-12-28', null, null, null, null, null, null, null, null, null, null, null, null, '31', null, null, null, '31', '31', null, null);
INSERT INTO `report_cache` VALUES ('705', '2019-12-29', null, null, null, null, null, null, null, null, null, null, null, null, '55', null, null, null, '55', '55', null, null);
INSERT INTO `report_cache` VALUES ('706', '2019-12-30', '89', '4220', '359', '21', null, null, '12', '181', '23', '14', '1683', '138', '5793', '158', '620', null, '13311', '5793', null, null);
INSERT INTO `report_cache` VALUES ('707', '2020-01-01', null, null, null, null, null, null, null, null, null, null, null, null, '40', null, null, null, '40', '40', null, null);
INSERT INTO `report_cache` VALUES ('708', '2020-01-02', '110', '4601', '317', '18', null, null, '15', '157', '9', '20', '2431', '63', '5898', '105', '728', null, '14472', '5898', null, null);
INSERT INTO `report_cache` VALUES ('709', '2020-01-03', '80', '4101', '296', '10', null, null, '3', '87', '8', '25', '2182', '82', '5642', '78', '629', null, '13223', '5642', null, null);
INSERT INTO `report_cache` VALUES ('710', '2020-01-04', '9', '682', '33', null, null, null, '1', '70', '1', null, '230', '27', '577', '8', '71', null, '1709', '577', null, null);
INSERT INTO `report_cache` VALUES ('711', '2020-01-05', null, null, null, null, null, null, null, null, null, null, null, null, '294', null, null, null, '294', '294', null, null);
INSERT INTO `report_cache` VALUES ('712', '2020-01-06', '120', '7435', '587', '22', null, null, '8', '157', '20', '39', '4624', '96', '5634', '81', '1276', null, '20099', '5634', null, null);
INSERT INTO `report_cache` VALUES ('713', '2020-01-07', '135', '6224', '510', '21', null, null, '4', '147', '20', '11', '2471', '98', '5921', '14', '511', null, '16087', '5921', null, null);
INSERT INTO `report_cache` VALUES ('714', '2020-01-08', '128', '5108', '461', '25', null, null, '3', '179', '10', '19', '1834', '53', '10399', '96', '300', null, '18615', '10399', null, null);
INSERT INTO `report_cache` VALUES ('715', '2020-01-09', '172', '7879', '518', '31', null, null, '10', '214', '12', '23', '2868', '48', '9601', '188', '380', null, '21944', '9601', null, null);
INSERT INTO `report_cache` VALUES ('716', '2020-01-10', '279', '10556', '823', '33', null, null, '22', '243', '30', '38', '3315', '28', '4770', '142', '497', null, '20776', '4770', null, null);
INSERT INTO `report_cache` VALUES ('717', '2020-01-11', '13', '505', '45', '1', null, null, null, '29', '2', null, '92', '2', '444', '30', '65', null, '1228', '444', null, null);
INSERT INTO `report_cache` VALUES ('718', '2020-01-12', '2', '83', '6', null, null, null, '2', null, null, null, '16', null, '178', null, null, null, '287', '178', null, null);
INSERT INTO `report_cache` VALUES ('719', '2020-01-13', '258', '9739', '746', '13', null, null, '9', '103', '11', '43', '3706', '68', '8302', '139', '575', null, '23712', '8302', null, null);
INSERT INTO `report_cache` VALUES ('720', '2020-01-14', '158', '7067', '473', '13', null, null, '15', '82', '21', '21', '2190', '48', '10349', '50', '274', null, '20761', '10349', null, null);
INSERT INTO `report_cache` VALUES ('721', '2020-01-15', '153', '7161', '494', '8', null, null, '12', '43', '7', '21', '2047', '41', '12296', '86', '370', null, '22739', '12296', null, null);
INSERT INTO `report_cache` VALUES ('722', '2020-01-16', '207', '8375', '521', '23', null, null, '6', '39', '13', '23', '2585', '34', '4515', '72', '476', null, '16889', '4515', null, null);
INSERT INTO `report_cache` VALUES ('723', '2020-01-17', '247', '7845', '557', '22', null, null, '16', '214', '10', '48', '2388', '39', '6474', '113', '503', null, '18476', '6474', null, null);
INSERT INTO `report_cache` VALUES ('724', '2020-01-18', '1', '191', '17', null, null, null, '2', '55', null, '6', '36', null, '2469', null, '4', null, '2781', '2469', null, null);
INSERT INTO `report_cache` VALUES ('725', '2020-01-19', null, null, null, null, null, null, null, null, null, null, null, null, '3212', null, null, null, '3212', '3212', null, null);
INSERT INTO `report_cache` VALUES ('726', '2020-01-20', '256', '9213', '737', '32', null, null, '7', '159', '35', '33', '3326', '86', '9858', '186', '496', null, '24424', '9858', null, null);
INSERT INTO `report_cache` VALUES ('727', '2020-01-21', '271', '8288', '623', '31', null, null, '8', '161', '24', '82', '2686', '109', '7318', '92', '367', null, '20060', '7318', null, null);
INSERT INTO `report_cache` VALUES ('728', '2020-01-22', '304', '10360', '824', '34', null, null, '21', '261', '20', '69', '2536', '109', '6006', '84', '396', null, '21024', '6006', null, null);
INSERT INTO `report_cache` VALUES ('729', '2020-01-23', '354', '10662', '772', '32', null, null, '14', '183', '21', '65', '3261', '80', '12323', '134', '426', null, '28328', '12323', null, null);
INSERT INTO `report_cache` VALUES ('730', '2020-01-24', '255', '8762', '668', '29', null, null, '16', '168', '23', '53', '2764', '89', '5333', '81', '330', null, '18571', '5333', null, null);
INSERT INTO `report_cache` VALUES ('731', '2020-01-25', '4', '493', '46', null, null, null, null, '4', null, null, '361', '4', '6995', null, '3', null, '7910', '6995', null, null);
INSERT INTO `report_cache` VALUES ('732', '2020-01-26', '2', '92', '6', '1', null, null, null, null, null, null, null, '1', '211', null, null, null, '313', '211', null, null);
INSERT INTO `report_cache` VALUES ('733', '2020-01-27', '352', '10446', '771', '30', null, null, '20', '246', '36', '51', '3174', '101', '12189', '133', '877', null, '28427', '12189', null, null);
INSERT INTO `report_cache` VALUES ('734', '2020-01-28', '395', '12140', '891', '22', null, null, '15', '130', '46', '54', '4203', '147', '11943', '106', '930', null, '31022', '11943', null, null);
INSERT INTO `report_cache` VALUES ('735', '2020-01-29', '321', '10272', '873', '41', null, null, '14', '216', '29', '64', '2571', '220', '12247', '35', '274', null, '27177', '12247', null, null);
INSERT INTO `report_cache` VALUES ('736', '2020-01-30', '276', '8395', '701', '21', null, null, '14', '143', '24', '41', '1985', '187', '10733', '37', '283', null, '22840', '10733', null, null);
INSERT INTO `report_cache` VALUES ('737', '2020-02-01', '11', '376', '37', null, null, null, '2', '19', null, '5', '53', '14', '422', '6', '17', null, '962', '422', null, null);
INSERT INTO `report_cache` VALUES ('738', '2020-02-02', null, null, null, null, null, null, null, null, null, null, null, null, '200', null, null, null, '200', '200', null, null);
INSERT INTO `report_cache` VALUES ('739', '2020-02-03', '225', '6984', '600', '27', null, null, '15', '205', '15', '57', '1959', '256', '9267', '46', '465', null, '20121', '9267', null, null);
INSERT INTO `report_cache` VALUES ('740', '2020-02-04', '266', '6203', '662', '38', null, null, '24', '195', '14', '56', '1878', '419', '5744', '70', '503', null, '16072', '5744', null, null);
INSERT INTO `report_cache` VALUES ('741', '2020-02-05', '208', '4113', '387', '21', null, null, '20', '171', '14', '36', '962', '412', '7446', '52', '332', null, '14174', '7446', null, null);
INSERT INTO `report_cache` VALUES ('742', '2020-02-06', '273', '6456', '583', '28', null, null, '33', '168', '17', '44', '1342', '395', '5671', '57', '447', null, '15514', '5671', null, null);
INSERT INTO `report_cache` VALUES ('743', '2020-02-07', '247', '6013', '498', '33', null, null, '31', '133', '7', '27', '1596', '363', '11887', '57', '430', null, '21322', '11887', null, null);
INSERT INTO `report_cache` VALUES ('744', '2020-02-08', '34', '1293', '92', null, null, null, '1', '24', '2', '1', '388', '8', '3590', '29', '37', null, '5499', '3590', null, null);
INSERT INTO `report_cache` VALUES ('745', '2020-02-09', null, null, null, null, null, null, null, null, null, null, null, null, '184', null, null, null, '184', '184', null, null);
INSERT INTO `report_cache` VALUES ('746', '2020-02-10', '318', '7974', '668', '17', null, null, '29', '273', '24', '66', '2136', '445', '10969', '106', '623', null, '23648', '10969', null, null);
INSERT INTO `report_cache` VALUES ('747', '2020-02-11', '307', '6669', '654', '31', null, null, '38', '206', '20', '36', '2153', '848', '5949', '93', '544', null, '17548', '5949', null, null);
INSERT INTO `report_cache` VALUES ('748', '2020-02-12', '201', '5352', '491', '19', null, null, '20', '121', '8', '28', '1226', '757', '3860', '42', '419', null, '12544', '3860', null, null);

-- ----------------------------
-- Table structure for sample_golongan
-- ----------------------------
DROP TABLE IF EXISTS `sample_golongan`;
CREATE TABLE `sample_golongan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `golongan` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sample_golongan
-- ----------------------------
INSERT INTO `sample_golongan` VALUES ('1', 'I-A');
INSERT INTO `sample_golongan` VALUES ('2', 'I-B');
INSERT INTO `sample_golongan` VALUES ('3', 'I-C');
INSERT INTO `sample_golongan` VALUES ('4', 'I-D');
INSERT INTO `sample_golongan` VALUES ('5', 'I-E');
INSERT INTO `sample_golongan` VALUES ('6', 'I-F');
INSERT INTO `sample_golongan` VALUES ('7', 'II-A');
INSERT INTO `sample_golongan` VALUES ('8', 'II-B');
INSERT INTO `sample_golongan` VALUES ('9', 'II-C');
INSERT INTO `sample_golongan` VALUES ('10', 'II-D');
INSERT INTO `sample_golongan` VALUES ('11', 'II-E');
INSERT INTO `sample_golongan` VALUES ('12', 'II-F');
INSERT INTO `sample_golongan` VALUES ('13', 'III-A');
INSERT INTO `sample_golongan` VALUES ('14', 'III-B');
INSERT INTO `sample_golongan` VALUES ('15', 'III-C');
INSERT INTO `sample_golongan` VALUES ('16', 'III-D');
INSERT INTO `sample_golongan` VALUES ('17', 'III-E');
INSERT INTO `sample_golongan` VALUES ('18', 'III-F');

-- ----------------------------
-- Table structure for sample_grup
-- ----------------------------
DROP TABLE IF EXISTS `sample_grup`;
CREATE TABLE `sample_grup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grup` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sample_grup
-- ----------------------------
INSERT INTO `sample_grup` VALUES ('1', 'SparePart');
INSERT INTO `sample_grup` VALUES ('2', 'Assets');
INSERT INTO `sample_grup` VALUES ('3', 'ATK (Alat Tulis Kantor)');

-- ----------------------------
-- Table structure for sample_jabatan
-- ----------------------------
DROP TABLE IF EXISTS `sample_jabatan`;
CREATE TABLE `sample_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sample_jabatan
-- ----------------------------
INSERT INTO `sample_jabatan` VALUES ('1', 'Staff');
INSERT INTO `sample_jabatan` VALUES ('2', 'Officer');
INSERT INTO `sample_jabatan` VALUES ('3', 'Supervisor');
INSERT INTO `sample_jabatan` VALUES ('4', 'Head');
INSERT INTO `sample_jabatan` VALUES ('5', 'Manager');

-- ----------------------------
-- Table structure for sample_karyawan
-- ----------------------------
DROP TABLE IF EXISTS `sample_karyawan`;
CREATE TABLE `sample_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `id_golongan` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sample_karyawan
-- ----------------------------
INSERT INTO `sample_karyawan` VALUES ('1', 'Dhiya', '15', '5');
INSERT INTO `sample_karyawan` VALUES ('2', 'Yayat', '13', '4');
INSERT INTO `sample_karyawan` VALUES ('3', 'Johanes', '12', '3');
INSERT INTO `sample_karyawan` VALUES ('4', 'Daud', '8', '2');
INSERT INTO `sample_karyawan` VALUES ('5', 'Togar', '8', '2');
INSERT INTO `sample_karyawan` VALUES ('6', 'Eko', '4', '1');
INSERT INTO `sample_karyawan` VALUES ('7', 'Yayunk', '4', '1');
INSERT INTO `sample_karyawan` VALUES ('8', 'Najihul', '4', '1');

-- ----------------------------
-- Table structure for sample_subgrup
-- ----------------------------
DROP TABLE IF EXISTS `sample_subgrup`;
CREATE TABLE `sample_subgrup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_grup` int(11) DEFAULT NULL,
  `subgrup` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sample_subgrup
-- ----------------------------
INSERT INTO `sample_subgrup` VALUES ('1', '1', 'Mobil');
INSERT INTO `sample_subgrup` VALUES ('2', '1', 'Motor');
INSERT INTO `sample_subgrup` VALUES ('3', '1', 'Truck');
INSERT INTO `sample_subgrup` VALUES ('4', '2', 'CPU');
INSERT INTO `sample_subgrup` VALUES ('5', '2', 'Monitor');
INSERT INTO `sample_subgrup` VALUES ('6', '3', 'Kertas');
INSERT INTO `sample_subgrup` VALUES ('7', '3', 'Pulpen');

-- ----------------------------
-- Table structure for sample_type
-- ----------------------------
DROP TABLE IF EXISTS `sample_type`;
CREATE TABLE `sample_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_subgrup` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sample_type
-- ----------------------------
INSERT INTO `sample_type` VALUES ('1', '1', 'Honda');
INSERT INTO `sample_type` VALUES ('2', '1', 'Hyndai');
INSERT INTO `sample_type` VALUES ('3', '1', 'Mitsubishi');
INSERT INTO `sample_type` VALUES ('4', '2', 'Yamaha');
INSERT INTO `sample_type` VALUES ('5', '2', 'Honda');
INSERT INTO `sample_type` VALUES ('6', '2', 'Suzuki');
INSERT INTO `sample_type` VALUES ('7', '3', 'Dyna');
INSERT INTO `sample_type` VALUES ('8', '3', 'Fuso');
INSERT INTO `sample_type` VALUES ('9', '4', 'Lenovo');
INSERT INTO `sample_type` VALUES ('10', '4', 'Acer');
INSERT INTO `sample_type` VALUES ('11', '4', 'Dell');
INSERT INTO `sample_type` VALUES ('12', '5', 'Lenovo');
INSERT INTO `sample_type` VALUES ('13', '5', 'Flatron');
INSERT INTO `sample_type` VALUES ('14', '5', 'Acer');
INSERT INTO `sample_type` VALUES ('15', '5', 'Dell');
INSERT INTO `sample_type` VALUES ('16', '6', 'Kertas A3');
INSERT INTO `sample_type` VALUES ('17', '6', 'Kertas A4');
INSERT INTO `sample_type` VALUES ('18', '7', 'Pulpen Cair');
INSERT INTO `sample_type` VALUES ('19', '7', 'Pulpen Biasa');

-- ----------------------------
-- Table structure for status_call
-- ----------------------------
DROP TABLE IF EXISTS `status_call`;
CREATE TABLE `status_call` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_reason` int(11) DEFAULT NULL,
  `nama_reason` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of status_call
-- ----------------------------
INSERT INTO `status_call` VALUES ('1', '1', 'Bertemu Pelanggan', '1');
INSERT INTO `status_call` VALUES ('2', '2', 'RNA', '0');
INSERT INTO `status_call` VALUES ('3', '3', 'Tidak Bertemu Pemilik', '1');
INSERT INTO `status_call` VALUES ('4', '4', 'Salah Sambung', '0');
INSERT INTO `status_call` VALUES ('5', '5', 'Inbound 147', '0');
INSERT INTO `status_call` VALUES ('6', '6', 'Outbound TAM', '0');
INSERT INTO `status_call` VALUES ('7', '7', 'Isolir', '0');
INSERT INTO `status_call` VALUES ('8', '8', 'Mailbox', '0');
INSERT INTO `status_call` VALUES ('9', '9', 'Telepon Sibuk', '0');
INSERT INTO `status_call` VALUES ('10', '10', 'Rejected', '0');
INSERT INTO `status_call` VALUES ('11', '11', 'Decline', '0');
INSERT INTO `status_call` VALUES ('12', '12', 'Follow Up', '1');
INSERT INTO `status_call` VALUES ('13', '13', 'Verified', '1');
INSERT INTO `status_call` VALUES ('14', '14', 'Reject By System', '0');
INSERT INTO `status_call` VALUES ('15', '15', 'Cabut', '0');

-- ----------------------------
-- Table structure for status_perkawinan
-- ----------------------------
DROP TABLE IF EXISTS `status_perkawinan`;
CREATE TABLE `status_perkawinan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_perkawinan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of status_perkawinan
-- ----------------------------

-- ----------------------------
-- Table structure for sys_authorized
-- ----------------------------
DROP TABLE IF EXISTS `sys_authorized`;
CREATE TABLE `sys_authorized` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) DEFAULT NULL,
  `id_form` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `iid` (`id`) USING BTREE,
  KEY `ilevel` (`id_level`,`id_form`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_authorized
-- ----------------------------
INSERT INTO `sys_authorized` VALUES ('30', '1', '1');
INSERT INTO `sys_authorized` VALUES ('1', '1', '2');
INSERT INTO `sys_authorized` VALUES ('2', '1', '3');
INSERT INTO `sys_authorized` VALUES ('3', '1', '4');
INSERT INTO `sys_authorized` VALUES ('4', '1', '5');
INSERT INTO `sys_authorized` VALUES ('5', '1', '6');
INSERT INTO `sys_authorized` VALUES ('6', '1', '7');
INSERT INTO `sys_authorized` VALUES ('7', '1', '8');
INSERT INTO `sys_authorized` VALUES ('8', '1', '9');
INSERT INTO `sys_authorized` VALUES ('9', '1', '10');
INSERT INTO `sys_authorized` VALUES ('10', '1', '11');
INSERT INTO `sys_authorized` VALUES ('11', '1', '12');
INSERT INTO `sys_authorized` VALUES ('12', '1', '13');
INSERT INTO `sys_authorized` VALUES ('13', '1', '14');
INSERT INTO `sys_authorized` VALUES ('14', '1', '15');
INSERT INTO `sys_authorized` VALUES ('15', '1', '16');
INSERT INTO `sys_authorized` VALUES ('16', '1', '17');
INSERT INTO `sys_authorized` VALUES ('17', '1', '18');
INSERT INTO `sys_authorized` VALUES ('18', '1', '19');
INSERT INTO `sys_authorized` VALUES ('19', '1', '20');
INSERT INTO `sys_authorized` VALUES ('20', '1', '21');
INSERT INTO `sys_authorized` VALUES ('21', '1', '22');
INSERT INTO `sys_authorized` VALUES ('22', '1', '23');
INSERT INTO `sys_authorized` VALUES ('23', '1', '24');
INSERT INTO `sys_authorized` VALUES ('24', '1', '25');
INSERT INTO `sys_authorized` VALUES ('25', '1', '26');
INSERT INTO `sys_authorized` VALUES ('27', '1', '28');
INSERT INTO `sys_authorized` VALUES ('28', '1', '29');
INSERT INTO `sys_authorized` VALUES ('29', '1', '30');
INSERT INTO `sys_authorized` VALUES ('31', '1', '31');
INSERT INTO `sys_authorized` VALUES ('32', '1', '32');
INSERT INTO `sys_authorized` VALUES ('33', '1', '33');
INSERT INTO `sys_authorized` VALUES ('34', '1', '34');
INSERT INTO `sys_authorized` VALUES ('35', '1', '35');
INSERT INTO `sys_authorized` VALUES ('36', '1', '36');
INSERT INTO `sys_authorized` VALUES ('37', '1', '37');
INSERT INTO `sys_authorized` VALUES ('38', '1', '38');
INSERT INTO `sys_authorized` VALUES ('39', '1', '39');
INSERT INTO `sys_authorized` VALUES ('40', '1', '40');
INSERT INTO `sys_authorized` VALUES ('41', '1', '41');
INSERT INTO `sys_authorized` VALUES ('42', '1', '42');
INSERT INTO `sys_authorized` VALUES ('43', '1', '43');
INSERT INTO `sys_authorized` VALUES ('44', '1', '44');
INSERT INTO `sys_authorized` VALUES ('45', '1', '45');
INSERT INTO `sys_authorized` VALUES ('46', '1', '46');
INSERT INTO `sys_authorized` VALUES ('47', '1', '47');
INSERT INTO `sys_authorized` VALUES ('48', '1', '48');
INSERT INTO `sys_authorized` VALUES ('49', '1', '49');
INSERT INTO `sys_authorized` VALUES ('50', '1', '50');
INSERT INTO `sys_authorized` VALUES ('51', '1', '51');
INSERT INTO `sys_authorized` VALUES ('52', '1', '52');
INSERT INTO `sys_authorized` VALUES ('53', '1', '53');
INSERT INTO `sys_authorized` VALUES ('54', '1', '54');
INSERT INTO `sys_authorized` VALUES ('55', '1', '55');
INSERT INTO `sys_authorized` VALUES ('56', '1', '56');
INSERT INTO `sys_authorized` VALUES ('57', '1', '57');
INSERT INTO `sys_authorized` VALUES ('58', '1', '58');
INSERT INTO `sys_authorized` VALUES ('59', '1', '59');
INSERT INTO `sys_authorized` VALUES ('60', '1', '60');
INSERT INTO `sys_authorized` VALUES ('61', '1', '61');
INSERT INTO `sys_authorized` VALUES ('62', '1', '62');
INSERT INTO `sys_authorized` VALUES ('63', '1', '63');
INSERT INTO `sys_authorized` VALUES ('64', '1', '64');
INSERT INTO `sys_authorized` VALUES ('65', '1', '65');
INSERT INTO `sys_authorized` VALUES ('66', '1', '66');
INSERT INTO `sys_authorized` VALUES ('67', '1', '67');
INSERT INTO `sys_authorized` VALUES ('68', '1', '68');
INSERT INTO `sys_authorized` VALUES ('69', '1', '69');
INSERT INTO `sys_authorized` VALUES ('70', '1', '70');
INSERT INTO `sys_authorized` VALUES ('71', '1', '71');
INSERT INTO `sys_authorized` VALUES ('72', '1', '72');
INSERT INTO `sys_authorized` VALUES ('73', '1', '73');
INSERT INTO `sys_authorized` VALUES ('74', '1', '74');
INSERT INTO `sys_authorized` VALUES ('75', '1', '75');
INSERT INTO `sys_authorized` VALUES ('92', '1', '76');
INSERT INTO `sys_authorized` VALUES ('93', '1', '76');
INSERT INTO `sys_authorized` VALUES ('101', '1', '76');
INSERT INTO `sys_authorized` VALUES ('94', '1', '77');
INSERT INTO `sys_authorized` VALUES ('102', '1', '77');
INSERT INTO `sys_authorized` VALUES ('95', '1', '78');
INSERT INTO `sys_authorized` VALUES ('103', '1', '78');
INSERT INTO `sys_authorized` VALUES ('96', '1', '79');
INSERT INTO `sys_authorized` VALUES ('112', '1', '79');
INSERT INTO `sys_authorized` VALUES ('120', '1', '80');
INSERT INTO `sys_authorized` VALUES ('121', '1', '81');
INSERT INTO `sys_authorized` VALUES ('122', '1', '82');
INSERT INTO `sys_authorized` VALUES ('130', '1', '83');
INSERT INTO `sys_authorized` VALUES ('108', '6', '76');
INSERT INTO `sys_authorized` VALUES ('109', '6', '77');
INSERT INTO `sys_authorized` VALUES ('110', '6', '78');
INSERT INTO `sys_authorized` VALUES ('131', '7', '76');
INSERT INTO `sys_authorized` VALUES ('132', '7', '77');
INSERT INTO `sys_authorized` VALUES ('133', '7', '78');
INSERT INTO `sys_authorized` VALUES ('134', '7', '79');
INSERT INTO `sys_authorized` VALUES ('135', '7', '80');
INSERT INTO `sys_authorized` VALUES ('136', '7', '81');
INSERT INTO `sys_authorized` VALUES ('137', '7', '82');
INSERT INTO `sys_authorized` VALUES ('138', '7', '83');
INSERT INTO `sys_authorized` VALUES ('119', '8', '78');
INSERT INTO `sys_authorized` VALUES ('139', '9', '78');
INSERT INTO `sys_authorized` VALUES ('140', '9', '79');
INSERT INTO `sys_authorized` VALUES ('141', '9', '83');

-- ----------------------------
-- Table structure for sys_authorized_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_authorized_menu`;
CREATE TABLE `sys_authorized_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_authorized_menu
-- ----------------------------
INSERT INTO `sys_authorized_menu` VALUES ('1', '1', '1');
INSERT INTO `sys_authorized_menu` VALUES ('2', '1', '2');
INSERT INTO `sys_authorized_menu` VALUES ('3', '1', '3');
INSERT INTO `sys_authorized_menu` VALUES ('4', '1', '4');
INSERT INTO `sys_authorized_menu` VALUES ('5', '1', '5');
INSERT INTO `sys_authorized_menu` VALUES ('6', '1', '6');
INSERT INTO `sys_authorized_menu` VALUES ('7', '1', '7');
INSERT INTO `sys_authorized_menu` VALUES ('8', '1', '8');
INSERT INTO `sys_authorized_menu` VALUES ('9', '1', '9');
INSERT INTO `sys_authorized_menu` VALUES ('10', '1', '10');
INSERT INTO `sys_authorized_menu` VALUES ('11', '1', '11');
INSERT INTO `sys_authorized_menu` VALUES ('12', '1', '12');
INSERT INTO `sys_authorized_menu` VALUES ('21', '6', '7');
INSERT INTO `sys_authorized_menu` VALUES ('22', '6', '8');
INSERT INTO `sys_authorized_menu` VALUES ('23', '6', '9');
INSERT INTO `sys_authorized_menu` VALUES ('24', '6', '10');
INSERT INTO `sys_authorized_menu` VALUES ('25', '6', '11');
INSERT INTO `sys_authorized_menu` VALUES ('26', '6', '12');
INSERT INTO `sys_authorized_menu` VALUES ('29', '1', '13');
INSERT INTO `sys_authorized_menu` VALUES ('40', '8', '11');
INSERT INTO `sys_authorized_menu` VALUES ('41', '8', '12');
INSERT INTO `sys_authorized_menu` VALUES ('42', '1', '14');
INSERT INTO `sys_authorized_menu` VALUES ('43', '1', '15');
INSERT INTO `sys_authorized_menu` VALUES ('44', '1', '16');
INSERT INTO `sys_authorized_menu` VALUES ('55', '1', '17');
INSERT INTO `sys_authorized_menu` VALUES ('56', '1', '18');
INSERT INTO `sys_authorized_menu` VALUES ('57', '7', '13');
INSERT INTO `sys_authorized_menu` VALUES ('58', '7', '15');
INSERT INTO `sys_authorized_menu` VALUES ('59', '7', '14');
INSERT INTO `sys_authorized_menu` VALUES ('60', '7', '7');
INSERT INTO `sys_authorized_menu` VALUES ('61', '7', '8');
INSERT INTO `sys_authorized_menu` VALUES ('62', '7', '9');
INSERT INTO `sys_authorized_menu` VALUES ('63', '7', '10');
INSERT INTO `sys_authorized_menu` VALUES ('64', '7', '11');
INSERT INTO `sys_authorized_menu` VALUES ('65', '7', '16');
INSERT INTO `sys_authorized_menu` VALUES ('66', '7', '12');
INSERT INTO `sys_authorized_menu` VALUES ('67', '7', '17');
INSERT INTO `sys_authorized_menu` VALUES ('68', '7', '18');
INSERT INTO `sys_authorized_menu` VALUES ('69', '9', '13');
INSERT INTO `sys_authorized_menu` VALUES ('70', '9', '11');
INSERT INTO `sys_authorized_menu` VALUES ('71', '9', '12');
INSERT INTO `sys_authorized_menu` VALUES ('72', '9', '17');
INSERT INTO `sys_authorized_menu` VALUES ('73', '9', '18');

-- ----------------------------
-- Table structure for sys_complite
-- ----------------------------
DROP TABLE IF EXISTS `sys_complite`;
CREATE TABLE `sys_complite` (
  `id` int(1) NOT NULL,
  `complite` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_complite
-- ----------------------------
INSERT INTO `sys_complite` VALUES ('1', 'COMPLITE');
INSERT INTO `sys_complite` VALUES ('2', 'NOT COMPLITE');
INSERT INTO `sys_complite` VALUES ('3', 'FAILED');

-- ----------------------------
-- Table structure for sys_dashboard
-- ----------------------------
DROP TABLE IF EXISTS `sys_dashboard`;
CREATE TABLE `sys_dashboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_form` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `i_user` (`id_user`) USING BTREE,
  KEY `i_id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_dashboard
-- ----------------------------
INSERT INTO `sys_dashboard` VALUES ('1', '78', '250');

-- ----------------------------
-- Table structure for sys_form
-- ----------------------------
DROP TABLE IF EXISTS `sys_form`;
CREATE TABLE `sys_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(10) DEFAULT NULL,
  `link` char(200) DEFAULT NULL,
  `form_name` char(200) DEFAULT NULL,
  `shortcut` int(2) DEFAULT NULL COMMENT '1=YA, 2=TIDAK\r\nAkses langsung halaman melalui exekusi kode',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `iid` (`id`) USING BTREE,
  KEY `icode` (`code`) USING BTREE,
  KEY `ilink` (`link`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_form
-- ----------------------------
INSERT INTO `sys_form` VALUES ('1', '000', '#', '--NO LINK--', '1');
INSERT INTO `sys_form` VALUES ('2', 'SP', 'sistem/Pengaturan', 'SISTEM : Daftar Menu Pengaturan Sistem', '1');
INSERT INTO `sys_form` VALUES ('3', 'SPMM', 'sistem/Pengaturan_tampilan/menu_management', 'SISTEM : Daftar Menu Management', '1');
INSERT INTO `sys_form` VALUES ('4', 'SPMM01', 'sistem/Pengaturan_tampilan/create_menu', 'SISTEM : Form Buat Menu Baru', '1');
INSERT INTO `sys_form` VALUES ('5', 'SPMM02', 'sistem/Pengaturan_tampilan/create_menu_action', 'SISTEM : Action Simpan  Menu Baru', '2');
INSERT INTO `sys_form` VALUES ('6', 'SPMM03', 'sistem/Pengaturan_tampilan/update_menu', 'SISTEM : Form Update Menu', '2');
INSERT INTO `sys_form` VALUES ('7', 'SPMM04', 'sistem/Pengaturan_tampilan/update_action', 'SISTEM : Action Simpan Update Menu', '2');
INSERT INTO `sys_form` VALUES ('8', 'SPMM05', 'sistem/Pengaturan_tampilan/delete_multiple', 'SISTEM : Action Hapus Menu', '2');
INSERT INTO `sys_form` VALUES ('9', 'SPR', 'sistem/Registrasi_form', 'SISTEM : Daftar Registrasi URL', '1');
INSERT INTO `sys_form` VALUES ('10', 'SPR01', 'sistem/Registrasi_form/create', 'SISTEM : Form Buat Registrasi URL Baru', '1');
INSERT INTO `sys_form` VALUES ('11', 'SPR02', 'sistem/Registrasi_form/create_action', 'SISTEM : Actionl Simpan Registrasi URL Baru', '2');
INSERT INTO `sys_form` VALUES ('12', 'SPR03', 'sistem/Registrasi_form/update', 'SISTEM : Form  Update Registrasi', '2');
INSERT INTO `sys_form` VALUES ('13', 'SPR04', 'sistem/Registrasi_form/update_action', 'SISTEM : Action Simpan Update Registrasi', '2');
INSERT INTO `sys_form` VALUES ('14', 'SPR05', 'sistem/Registrasi_form/delete_multiple', 'SISTEM : Action  Hapus Registrasi', '2');
INSERT INTO `sys_form` VALUES ('15', 'SPL', 'sistem/Pengaturan_level', 'SISTEM : Daftar Level', '1');
INSERT INTO `sys_form` VALUES ('16', 'SPL01', 'sistem/Pengaturan_level/create', 'SISTEM : Form  Buat Level Konfigurasi Baru', '1');
INSERT INTO `sys_form` VALUES ('17', 'SPL02', 'sistem/Pengaturan_level/create_action', 'SISTEM : Action Simpan  Level Konfigurasi Baru', '2');
INSERT INTO `sys_form` VALUES ('18', 'SPL03', 'sistem/Pengaturan_level/update', 'SISTEM : Form Update Level', '2');
INSERT INTO `sys_form` VALUES ('19', 'SPL04', 'sistem/Pengaturan_level/update_action', 'SISTEM : Action Simpan Update Level', '2');
INSERT INTO `sys_form` VALUES ('20', 'SPL05', 'sistem/Pengaturan_level/delete_multiple', 'SISTEM : Action Hapus Level', '2');
INSERT INTO `sys_form` VALUES ('21', 'SPU', 'sistem/Pengaturan_pengguna', 'SISTEM : Daftar User', '1');
INSERT INTO `sys_form` VALUES ('22', 'SPU01', 'sistem/Pengaturan_pengguna/create', 'SISTEM : Form Buat User Baru', '1');
INSERT INTO `sys_form` VALUES ('23', 'SPU02', 'sistem/Pengaturan_pengguna/create_action', 'SISTEM : Action Simpan User Baru', '2');
INSERT INTO `sys_form` VALUES ('24', 'SPU03', 'sistem/Pengaturan_pengguna/update', 'SISTEM : Form Update User', '2');
INSERT INTO `sys_form` VALUES ('25', 'SPU04', 'sistem/Pengaturan_pengguna/update_action', 'SISTEM : Action Simpan Update User', '2');
INSERT INTO `sys_form` VALUES ('26', 'SPU05', 'sistem/Pengaturan_pengguna/delete_multiple', 'SISTEM : Action  Hapus User', '2');
INSERT INTO `sys_form` VALUES ('28', 'DSI', 'sistem/Dokumentasi/sample_icon', 'SISTEM DOKUMENTASI : Daftar Sample Icon', '1');
INSERT INTO `sys_form` VALUES ('29', 'DPK', 'sistem/Dokumentasi/petunjuk_penggunaan', 'SISTEM DOKUMENTASI : Petunjuk Penggunaan', '1');
INSERT INTO `sys_form` VALUES ('30', 'DSE', 'sistem/Dokumentasi/sample_element', 'SISTEM DOKUMENTASI : Sample Element', '1');
INSERT INTO `sys_form` VALUES ('31', 'CRUD', 'sistem/Crud_generator', 'SISTEM : CRUD GENERATOR', '1');
INSERT INTO `sys_form` VALUES ('32', 'DSED', 'sistem/Dokumentasi/sample_element_dropzone', 'SISTEM DOKUMENTASI : Sample Element Dropzone', '1');
INSERT INTO `sys_form` VALUES ('33', 'DSEP', 'sistem/Dokumentasi/petunjuk_penggunaan_tahap_lanjut', 'SISTEM DOKUMENTASI : Petunjuk Penggunaan Tahap Lanjut', '1');
INSERT INTO `sys_form` VALUES ('34', 'SECER', 'sistem/Keamanan/error_report', 'SISTEM KEAMANAN: Error Report', '1');
INSERT INTO `sys_form` VALUES ('35', 'SECCSRF', 'sistem/Keamanan/csrf_protection', 'SISTEM KEAMANAN: CSRF Protection', '1');
INSERT INTO `sys_form` VALUES ('36', 'SECINJ', 'sistem/Keamanan/monitoring_injection', 'SISTEM KEAMANAN: Monitoring Injection', '1');
INSERT INTO `sys_form` VALUES ('37', 'SPU06', 'sistem/Pengaturan_pengguna/create_multiple', 'SISTEM : Form Buat User Baru From Excel', '1');
INSERT INTO `sys_form` VALUES ('38', 'SPU07', 'sistem/Pengaturan_pengguna/download_template_user', 'SISTEM : Download Template User', '2');
INSERT INTO `sys_form` VALUES ('39', 'STS', 'sistem/Template_system/style', 'SISTEM : Pengaturan Logo Template', '1');
INSERT INTO `sys_form` VALUES ('40', 'STS01', 'sistem/Template_system/update_login_setting', 'SISTEM : Pengaturan Logo Template  - Update Logo Login', '2');
INSERT INTO `sys_form` VALUES ('41', 'STS02', 'sistem/Template_system/update_template_setting', 'SISTEM : Pengaturan Logo Template  - Update Logo Template', '2');
INSERT INTO `sys_form` VALUES ('42', 'DK01', 'sistem/Dokumentasi_109', 'SISTEM : Dokumentasi 1.0.9', '1');
INSERT INTO `sys_form` VALUES ('43', 'DK02', 'sistem/Dokumentasi_109/general', 'SISTEM : Dokumentasi 1.0.9 - Introduce', '1');
INSERT INTO `sys_form` VALUES ('44', 'DK03', 'sistem/Dokumentasi_109/system_requirtment', 'SISTEM : Dokumentasi 1.0.9 - System Reqruitment', '1');
INSERT INTO `sys_form` VALUES ('45', 'DK04', 'sistem/Dokumentasi_109/pengaturan_menu', 'SISTEM : Dokumentasi 1.0.9 - Pengaturan Menu', '1');
INSERT INTO `sys_form` VALUES ('46', 'DK05', 'sistem/Dokumentasi_109/pengaturan_template', 'SISTEM : Dokumentasi 1.0.9 - Pengaturan Template', '1');
INSERT INTO `sys_form` VALUES ('47', 'DK06', 'sistem/Dokumentasi_109/registrasi_form', 'SISTEM : Dokumentasi 1.0.9 - Registrasi Form', '1');
INSERT INTO `sys_form` VALUES ('48', 'DK07', 'sistem/Dokumentasi_109/level_konfigurasi', 'SISTEM : Dokumentasi 1.0.9 - Level Konfigurasi', '1');
INSERT INTO `sys_form` VALUES ('49', 'DK08', 'sistem/Dokumentasi_109/user_konfigurasi', 'SISTEM : Dokumentasi 1.0.9 - User Konfigurasi', '1');
INSERT INTO `sys_form` VALUES ('50', 'DK09', 'sistem/Dokumentasi_109/crud_generator', 'SISTEM : Dokumentasi 1.0.9 - CRUD Generator', '1');
INSERT INTO `sys_form` VALUES ('51', 'DK10', 'sistem/Dokumentasi_109/error_report', 'SISTEM : Dokumentasi 1.0.9 - Error Report', '1');
INSERT INTO `sys_form` VALUES ('52', 'DK11', 'sistem/Dokumentasi_109/csrf_protection', 'SISTEM : Dokumentasi 1.0.9 - CSRF Protection', '1');
INSERT INTO `sys_form` VALUES ('53', 'DK12', 'sistem/Dokumentasi_109/front_end', 'SISTEM : Dokumentasi 1.0.9 - Front End', '1');
INSERT INTO `sys_form` VALUES ('54', 'DK13', 'sistem/Dokumentasi_109/page_maintenance', 'SISTEM : Dokumentasi 1.0.9 - Page Maintenance', '1');
INSERT INTO `sys_form` VALUES ('55', 'DK14', 'sistem/Dokumentasi_109/panduan_form', 'SISTEM : Dokumentasi 1.0.9 - Panduan Form', '1');
INSERT INTO `sys_form` VALUES ('56', 'DK15', 'sistem/Dokumentasi_109/panduan_form_lanjutan', 'SISTEM : Dokumentasi 1.0.9 - Panduan Form Lanjutan', '1');
INSERT INTO `sys_form` VALUES ('58', 'REGIP', 'sistem/Register_ip', 'SISTEM : Register IP', '1');
INSERT INTO `sys_form` VALUES ('59', 'REGIP01', 'sistem/Register_ip/create', 'SISTEM : Register IP - Form Buat Baru', '1');
INSERT INTO `sys_form` VALUES ('60', 'REGIP02', 'sistem/Register_ip/create_action', 'SISTEM : Register IP - Tombol Simpan Form Buat Baru', '2');
INSERT INTO `sys_form` VALUES ('61', 'REGIP03', 'sistem/Register_ip/update', 'SISTEM : Register IP - Form Update', '2');
INSERT INTO `sys_form` VALUES ('62', 'REGIP04', 'sistem/Register_ip/update_action', 'SISTEM : Register IP - Tombol Simpan Form Update', '2');
INSERT INTO `sys_form` VALUES ('63', 'REGIP05', 'sistem/Register_ip/delete_multiple', 'SISTEM : Register IP - Hapus Data', '2');
INSERT INTO `sys_form` VALUES ('64', 'MNTC01', 'sistem/Maintenance/maintenance_setting_list', 'SISTEM : MAINTENANCE - List Data', '1');
INSERT INTO `sys_form` VALUES ('65', 'MNTC02', 'sistem/Maintenance/create', 'SISTEM : MAINTENANCE - Form Buat Baru', '1');
INSERT INTO `sys_form` VALUES ('66', 'MNTC03', 'sistem/Maintenance/save_n_run', 'SISTEM : MAINTENANCE - Tombo Save n Run Form Buat Baru', '2');
INSERT INTO `sys_form` VALUES ('67', 'MNTC04', 'sistem/Maintenance/download_urlkey', 'SISTEM : MAINTENANCE -  Tombol Download Key', '2');
INSERT INTO `sys_form` VALUES ('68', 'MNTC05', 'sistem/Maintenance/delete_schedule', 'SISTEM : MAINTENANCE -  Delete Schedule', '2');
INSERT INTO `sys_form` VALUES ('69', 'MNTC06', 'sistem/Maintenance/stop_maintenance', 'SISTEM : MAINTENANCE -  Stop Maintenance', '2');
INSERT INTO `sys_form` VALUES ('70', 'SECFRN', 'sistem/Keamanan/access_front_end', 'SISTEM KEAMANAN: Access Front End', '1');
INSERT INTO `sys_form` VALUES ('71', 'SECLOG', 'sistem/User_Log', 'SISTEM KEAMANAN: Login Activity', '1');
INSERT INTO `sys_form` VALUES ('72', 'SECLOG01', 'sistem/User_Log/detail', 'SISTEM KEAMANAN: Login Activity - Detail', '2');
INSERT INTO `sys_form` VALUES ('73', 'SECLOG02', 'sistem/User_Log/delete_multiple', 'SISTEM KEAMANAN: Login Activity - Hapus Log', '2');
INSERT INTO `sys_form` VALUES ('74', 'DK16', 'sistem/Dokumentasi_109/panduan_upload_file', 'SISTEM : Dokumentasi 1.0.9 - Panduan Upload File', '1');
INSERT INTO `sys_form` VALUES ('75', 'CRUD01', 'sistem/Crud_generator/generator_form', 'SISTEM : CRUD GENERATOR - Tombol Generate Form', '2');
INSERT INTO `sys_form` VALUES ('76', 'Status_cal', 'Status_call/Status_call', 'Status_call', '1');
INSERT INTO `sys_form` VALUES ('77', 'Trans_prof', 'Trans_profiling/Trans_profiling', 'Trans_profiling', '1');
INSERT INTO `sys_form` VALUES ('78', 'Report_pro', 'Report_profiling/Report_profiling', 'Report_profiling', '1');
INSERT INTO `sys_form` VALUES ('79', 'Agent', 'Agent/Agent', 'Agent', '1');
INSERT INTO `sys_form` VALUES ('80', 'Leader_on_', 'Leader_on_duty/Leader_on_duty', 'Leader_on_duty', '1');
INSERT INTO `sys_form` VALUES ('81', 'sys_user_d', 'Sys_user_detail/Sys_user_detail', 'sys_user_detail', '1');
INSERT INTO `sys_form` VALUES ('82', 'report_dap', 'Report_profiling/Report_profiling/report_dapros', 'report_dapros', '1');
INSERT INTO `sys_form` VALUES ('83', 'check_ncli', 'Dbprofile_verified/Dbprofile_verified/check_ncli', 'check_ncli', '1');

-- ----------------------------
-- Table structure for sys_level
-- ----------------------------
DROP TABLE IF EXISTS `sys_level`;
CREATE TABLE `sys_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nmlevel` char(50) DEFAULT NULL,
  `opt_status` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `iid` (`id`) USING BTREE,
  KEY `inmlevel` (`nmlevel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_level
-- ----------------------------
INSERT INTO `sys_level` VALUES ('1', 'Configurator', '1');
INSERT INTO `sys_level` VALUES ('6', 'Administrator', '1');
INSERT INTO `sys_level` VALUES ('7', 'SV', '1');
INSERT INTO `sys_level` VALUES ('8', 'AGENT', '1');
INSERT INTO `sys_level` VALUES ('9', 'Team Leader', '1');

-- ----------------------------
-- Table structure for sys_maintenance_ip
-- ----------------------------
DROP TABLE IF EXISTS `sys_maintenance_ip`;
CREATE TABLE `sys_maintenance_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_maintenance_ip
-- ----------------------------

-- ----------------------------
-- Table structure for sys_maintenance_mode
-- ----------------------------
DROP TABLE IF EXISTS `sys_maintenance_mode`;
CREATE TABLE `sys_maintenance_mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mode` int(1) DEFAULT NULL COMMENT '0 = Disable maintenance,\r\n1 = Enable Maintenance',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_maintenance_mode
-- ----------------------------
INSERT INTO `sys_maintenance_mode` VALUES ('1', '0');

-- ----------------------------
-- Table structure for sys_maintenance_schedule
-- ----------------------------
DROP TABLE IF EXISTS `sys_maintenance_schedule`;
CREATE TABLE `sys_maintenance_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` int(11) DEFAULT NULL,
  `desc` varchar(200) DEFAULT NULL,
  `actual_finish` int(11) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `hours` int(11) DEFAULT NULL,
  `minutes` int(11) DEFAULT NULL,
  `key` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_maintenance_schedule
-- ----------------------------

-- ----------------------------
-- Table structure for sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE `sys_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_form` int(11) DEFAULT NULL,
  `name` char(50) NOT NULL,
  `icon` char(50) NOT NULL,
  `is_parent` int(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `iid` (`id`) USING BTREE,
  KEY `iname` (`name`) USING BTREE,
  KEY `iparent` (`is_parent`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_menu
-- ----------------------------
INSERT INTO `sys_menu` VALUES ('1', '1', 'Pengaturan', 'fe fe-box', '0');
INSERT INTO `sys_menu` VALUES ('2', '1', 'Dokumentasi', 'fe fe-box', '0');
INSERT INTO `sys_menu` VALUES ('3', '28', 'Sample Icon', 'fe fe-twitter', '2');
INSERT INTO `sys_menu` VALUES ('4', '30', 'Sample Element', 'fa fa-tv', '2');
INSERT INTO `sys_menu` VALUES ('5', '43', 'Petunjuk Penggunaan', 'fa fa-hand-o-up', '2');
INSERT INTO `sys_menu` VALUES ('6', '2', 'Sistem', 'fe fe-activity', '1');
INSERT INTO `sys_menu` VALUES ('7', '1', 'Master', 'fe fe-box', '0');
INSERT INTO `sys_menu` VALUES ('8', '76', 'Status Call', 'fe fe-alert-triangle', '7');
INSERT INTO `sys_menu` VALUES ('9', '77', 'Profiling', 'fe fe-users', '0');
INSERT INTO `sys_menu` VALUES ('10', '77', 'Trans Profiling', 'fe fe-users', '9');
INSERT INTO `sys_menu` VALUES ('11', '78', 'Report', 'fe fe-activity', '0');
INSERT INTO `sys_menu` VALUES ('12', '78', 'Report Profiling', 'fe fe-activity', '11');
INSERT INTO `sys_menu` VALUES ('13', '79', 'Agent', 'fe fe-users', '0');
INSERT INTO `sys_menu` VALUES ('14', '80', 'Leader On Duty', 'fa fa-user', '13');
INSERT INTO `sys_menu` VALUES ('15', '81', 'Profile Agent', 'fe fe-users', '13');
INSERT INTO `sys_menu` VALUES ('16', '82', 'Report Data Prospek', 'fe fe-airplay', '11');
INSERT INTO `sys_menu` VALUES ('17', '83', 'TELKOM', 'fe fe-airplay', '0');
INSERT INTO `sys_menu` VALUES ('18', '83', 'Check NCLI', 'fe fe-airplay', '17');

-- ----------------------------
-- Table structure for sys_show
-- ----------------------------
DROP TABLE IF EXISTS `sys_show`;
CREATE TABLE `sys_show` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `show` char(5) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `ishow` (`show`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_show
-- ----------------------------
INSERT INTO `sys_show` VALUES ('2', 'TIDAK');
INSERT INTO `sys_show` VALUES ('1', 'YA');

-- ----------------------------
-- Table structure for sys_status
-- ----------------------------
DROP TABLE IF EXISTS `sys_status`;
CREATE TABLE `sys_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `iid` (`id`) USING BTREE,
  KEY `istatus` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_status
-- ----------------------------
INSERT INTO `sys_status` VALUES ('1', 'AKTIF');
INSERT INTO `sys_status` VALUES ('2', 'NON AKTIF');

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nmuser` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `passuser` char(100) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `opt_level` int(11) DEFAULT NULL COMMENT '1=admin',
  `opt_status` int(5) DEFAULT NULL COMMENT '0=nonaktif,1=aktif, 2 = delete',
  `picture` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `nama` varchar(255) COLLATE latin1_general_cs DEFAULT NULL,
  `agentid` varchar(255) COLLATE latin1_general_cs DEFAULT NULL,
  `kategori` varchar(255) COLLATE latin1_general_cs DEFAULT NULL,
  `tl` varchar(255) COLLATE latin1_general_cs DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `iopt_level` (`opt_level`) USING BTREE,
  KEY `iagentid` (`agentid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=356 DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES ('1', 'administrator', '64be7986b632435c109b6a07b4106d36', '1', '1', '1xx_xx1580177380.jpg', 'Ahmad Sadikin', 'A001', '', null);
INSERT INTO `sys_user` VALUES ('65', 'sv', 'ba2bd7bd967cd67daa3069d05f77ad8e', '7', '1', 'default.png', 'Ahmad Sadikin', '-', '-', null);
INSERT INTO `sys_user` VALUES ('210', 'AF6540', '0cd02e311680ba280b55b3b3205d0929', '8', '1', '210xx_xx1580350049.jpg', 'AFIFATUL AZIZAH', 'AF6540', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('211', 'LE9194', 'e3be8d1aca8cb231977dc6867076c373', '8', '1', '211xx_xx1581042791.jpg', 'LISNA PUJIARTI', 'LE9194', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('212', 'EG0992', '7c4bc6065155dcd3481d79f4be00e369', '8', '1', 'default.png', 'M. HAFIZ AL FAUZAN', 'EG0992', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('213', 'MI1495', 'd7ef69fd738a6a6b861a06cb361f5a30', '8', '1', 'default.png', 'MUHAMMAD INDRA DWI LAKSANA', 'MI1495', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('214', 'DA1096', '4231d85be2f7993ac6f0cad356bab110', '8', '1', 'default.png', 'DIMAS PRADITYA AJI', 'DA1096', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('215', 'IN0812', 'f74851f06324f59b9ed62efa8ebb5980', '8', '1', 'default.png', 'MIA RAHMIYATI', 'IN0812', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('216', 'RM130994', 'aede56e8d09919b3f59508e9baf806fb', '8', '1', '216xx_xx1581044443.jpg', 'NIRA FITRIAH', 'RM130994', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('217', 'RA2708', '8ffd26ac7f91aa3bcbac6c545db94551', '8', '1', '217xx_xx1581044484.jpg', 'ANNISA', 'RA2708', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('218', 'VF0194', 'a31642e369928d0bb58d6fe66a983ac6', '8', '1', 'default.png', 'VINA FEBRIANI', 'VF0194', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('219', 'AR180293', '0702eb0cb74cfeca4c5ef2e7cc5c26ae', '9', '1', 'default.png', 'ASTI RAMDHIAN', 'AR180293', 'TL', '-');
INSERT INTO `sys_user` VALUES ('220', 'DE7748', 'ae4339000efc7d480a0379b282728df2', '8', '1', 'default.png', 'DENI YUDISTIRA', 'DE7748', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('221', 'DR2891', '0396c53cc9568bbb34e272d409fd6e9a', '8', '1', 'default.png', 'DERRY SEPTIANA AR', 'DR2891', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('222', 'BDGCTS_026', 'a71007de71a0caa933e74cf854eefa20', '8', '1', 'default.png', 'NUGRAHA NASRULLOH', 'BDGCTS_026', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('223', 'BDG_004', 'ddf7bb4473f083ead5bcba29444a8dab', '8', '1', 'default.png', 'RACHMAT MULDANI', 'BDG_004', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('224', 'RR0790', '1cf0e4c2cb5007574f9c9bdf1aab74f8', '8', '1', 'default.png', 'RATIH RAHMAWATI', 'RR0790', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('225', 'AI0292', '6046ce5d4153fc942e1f38c57380f4db', '8', '1', '225xx_xx1581044158.jpg', 'ARIEF IMAN PRASETYO', 'AI0292', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('226', 'DH1297', '28c1da774eaeea2c80897210d1a68c67', '8', '1', '226xx_xx1580874418.jpg', 'DIDAH HALIYAH', 'DH1297', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('227', 'DP0395', 'e0598c8374368eb38ebb0c8b30802897', '8', '1', '227xx_xx1581043001.jpg', 'DICKY PERMANA', 'DP0395', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('228', 'ME2205', '59a83e986330c7edf6b922385055a327', '8', '1', 'default.png', 'DWINA ANISAH GHAIDA', 'ME2205', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('229', 'FS0796', 'bc6e7669ae59186e3f2bcf156ca918a3', '8', '1', 'default.png', 'FIRDA SRI RAHMAYANTI', 'FS0796', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('230', 'NI3506', 'd16151907afae71400f925106588bcb9', '8', '1', '230xx_xx1581416156.jpg', 'AGHNIA AUDINA NUR SOLEHAH', 'NI3506', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('231', 'HA2312', '85c12eed04f6a9a7b7e65b5464c441aa', '8', '1', 'default.png', 'HANNA DELAVINA', 'HA2312', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('232', 'BDGCTS_048', '8c717e926b9b5f4d86f4e6318dd6f1c1', '8', '1', '232xx_xx1581416116.jpg', 'ISMAYANTI', 'BDGCTS_048', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('233', 'AF1204', 'c6b897e423a04a62443f78ebb07ff9a2', '8', '1', 'default.png', 'KARLINA', 'AF1204', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('234', 'KA1095', 'dd1e89e5e5eb2c7fd02ead9ae2e8a7ba', '8', '1', '234xx_xx1580872742.jpg', 'KARIN ARINDA PRAMUDHYTA', 'KA1095', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('235', 'SI0944', '67c1f29d86555d317e401e3bb9321114', '8', '1', 'default.png', 'RIA ANDRIYANI', 'SI0944', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('236', 'RA5494', '3d3a3090641c158413a0c26e81ab7c4b', '8', '1', '236xx_xx1581044538.jpg', 'RAHMAWATI ZAKIYAH', 'RA5494', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('237', 'SP2089', 'da4f62c31f793a1a7ff0057ffe176b39', '8', '1', 'default.png', 'ARIEF DHARMA SAPUTRA', 'SP2089', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('238', 'GG1090', '1244e4d8fc2e55d797bce43c918680d2', '8', '1', '238xx_xx1581043026.jpg', 'GILANG GINANJAR', 'GG1090', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('239', 'NI1303', '925b1d06cc6e89a502e205b413966c08', '8', '1', 'default.png', 'GITA BONITA', 'NI1303', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('240', 'HH0189', 'e8002c130640c446a675aecdad535599', '8', '1', 'default.png', 'HARY HAIDAR LATIEF', 'HH0189', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('241', 'PI1080', '9788be3444d3c8b225a5ccfa71313b01', '8', '1', '241xx_xx1580874494.jpg', 'PENDI', 'PI1080', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('242', 'BDGCTS_001', 'b5de02e602ced0c97e22d77518dce42a', '8', '1', '242xx_xx1581062599.jpg', 'RIZKI NUR FADHILAH', 'BDGCTS_001', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('243', 'DH4489', 'd8143d8d93859b81f72bd1db71a87795', '8', '1', 'default.png', 'ROHIMAH', 'DH4489', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('244', 'DI2202', 'b7cc25fb9a6a4dcc01edbfd186dd4f77', '8', '1', 'default.png', 'SHERA AMALIA', 'DI2202', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('245', 'SI0872', '1f0eb4f5c19e1e0ab49a56e04192ad72', '8', '1', '245xx_xx1581042756.jpg', 'SINTA DEWI SETIAWATI', 'SI0872', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('246', 'RF0994', 'b3208b6334fe5ce161f6a911319e4820', '8', '1', '246xx_xx1581042913.jpg', 'RIESLA FAUZI RACHMAN', 'RF0994', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('247', 'CH1101', '206fe5a9d1e26db28e2ab8fe37a3cdc7', '8', '1', '247xx_xx1581042885.jpg', 'SRI LESTARI', 'CH1101', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('248', 'TI2508', 'd6e1d2094f409c28dddbcf0062c5c379', '8', '1', '248xx_xx1580873264.jpg', 'TISHA AGUSTINA RAHMAWATI', 'TI2508', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('249', 'BDGCTS_041', '7dcd38fc95066e4524c5965192de2393', '8', '1', 'default.png', 'ANNISA ZAHRA NASHIROTULHAQ', 'BDGCTS_041', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('250', 'IN0394', '7249355a7af0ec7a59c8631470ed7a06', '8', '1', '250xx_xx1581040857.jpg', 'IKBAR NUR MUHAMMAD', 'IN0394', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('251', 'SS0595', 'd692fc8d5ad6c96bf978e3fbdd1e2486', '8', '1', 'default.png', 'SANDI SARIKA', 'SS0595', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('252', 'GI1704', 'e73f284c27af7b2ad17c9f9da3a1b76e', '8', '1', 'default.png', 'GIA NADIA PUTRI', 'GI1704', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('253', 'GE0397', '890374d468764be4d6188ba13b541555', '8', '1', 'default.png', 'GINA EKI AGUSTIN', 'GE0397', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('254', 'SI8254', '4c33b373bec4b5db650539f61a8e88d7', '8', '1', '254xx_xx1581042839.jpg', 'SINTA ROSITA', 'SI8254', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('255', 'SR2610', '2a8c4ca7e001785f6c86878bf7940ddf', '8', '1', '255xx_xx1580872106.jpg', 'SRI MAWATI AYUNIGUNTARI', 'SR2610', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('256', 'NJ1981', 'cd7f14e180903e57cfd03dc93930c77e', '8', '1', 'default.png', 'NUR JAIS', 'NJ1981', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('257', 'BDGCTS_025', '0cc5504669c86126ebfb329d494f0755', '8', '1', '257xx_xx1581061672.jpg', 'HENI WAHYUNI', 'BDGCTS_025', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('258', 'NR1290', 'b3bb60d01a51498889a95e218b1b1c9c', '8', '1', 'default.png', 'NADYA RACHMAWATI', 'NR1290', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('259', 'IR1502', '1a61afef68519546026b133ac3c97b7b', '8', '1', '259xx_xx1580900050.jpg', 'PUTRI RATNASARI', 'IR1502', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('260', 'RE8569', 'c00477976ddbd1e2b7823caf77b34249', '8', '1', 'default.png', 'RESI NURLITA', 'RE8569', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('261', 'BDGCTS_046', 'bb8ad6522f49e776ff77b968561dd187', '8', '1', 'default.png', 'RIRI MARDIANA', 'BDGCTS_046', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('262', 'SA0592', 'a4ecabe3d08c8b45ba76f479be2c01d0', '8', '1', 'default.png', 'SABILA AINUN HAFSAH', 'SA0592', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('263', 'IK0206', 'f26fb0c98c68998bb8bd5397238f3c28', '8', '1', 'default.png', 'SUSILAWATI', 'IK0206', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('264', 'SN0895', '70a61a0a2baba8c04172a8e41baa1502', '8', '1', 'default.png', 'SANI NURAHAYU', 'SN0895', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('265', 'BDG_008', '976d52b131f9ec469b9bc96eac03bb1e', '8', '1', 'default.png', 'EPPY ROBIATUS SADIYAH', 'BDG_008', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('266', 'BDGCTS_038', '9f75556f813695bb805f62baca4f6533', '8', '1', 'default.png', 'RIKARDO HAREFA', 'BDGCTS_038', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('267', 'RO0707', 'd76a1c73c30b5871562b870baa590bb5', '8', '1', 'default.png', 'ROSMILA', 'RO0707', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('268', 'AN6527', '83f7829093f1e30e6c317050ae59e3b2', '8', '1', '268xx_xx1581043080.jpg', 'VIAN ARAYANI', 'AN6527', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('269', 'MU3004', 'b146e5346f2d0910b46428d535b81230', '8', '1', '269xx_xx1581043107.jpg', 'VIVIT NOVITASARI', 'MU3004', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('270', 'WY0182', 'f4c3cde7e75e1c7df5f511886a4beaad', '8', '1', '270xx_xx1580874466.jpg', 'WAHYU', 'WY0182', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('271', 'YU0739', 'c332ad01949fbed5f0c9bdfa67552f76', '8', '1', 'default.png', 'YULIANA', 'YU0739', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('272', 'BDG_003', '8dad9715581ac3d657ca1e5a803ecd11', '8', '1', 'default.png', 'DIAN DARMAWAN S', 'BDG_003', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES ('273', 'RR151291', '9340791560e668a4c16eb47b293726f0', '8', '1', 'default.png', 'SARAH SITI NUR SYAMSIAH', 'RR151291', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('274', 'IF0710', '9e11b70693c15e7367166a7249fa2851', '8', '1', 'default.png', 'IMAN FIRMANSYAH', 'IF0710', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES ('275', 'NM0697', '9864e07fe8dd81bb1e225dae838789dc', '8', '1', 'default.png', 'NADYA MAHARANI PUTRI', 'NM0697', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('276', 'EM2807', '78f4836d9673ece7ab5240f05df17937', '8', '1', 'default.png', 'RIAN ADRIANA', 'EM2807', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('277', 'ID1006', 'bdfb410ef4daa7bd10c1f569f47f1008', '8', '1', 'default.png', 'SELVA NURDIN MULYANA', 'ID1006', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('278', 'RA4186', 'f85dcabe61bb70e1c83dce078d90cacf', '8', '1', 'default.png', 'SUSILAWATI MOSS', 'RA4186', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('279', 'BDG_001', 'a22e59c770b377a350a5e97ee46d1f12', '8', '1', '279xx_xx1581416727.jpg', 'VIVIT NOVITASARI MOSS', 'BDG_001', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('280', 'BDG_007', 'ee8b3b32cfddf8f16a4dade184b6d1c8', '8', '1', '280xx_xx1581416980.jpg', 'GILANG GINANJAR MOSS', 'BDG_007', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('281', 'BDG_014', '2b0a47cfd018dc4158b25a43588d3a9e', '8', '1', 'default.png', 'RACHMAT MULDANI MOSS', 'BDG_014', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('282', 'BDG_016', '3d3ab79976b8ac443b8cf0d6c2ee2c94', '8', '1', 'default.png', 'TISHA AGUSTINA RAHMAWATI MOSS', 'BDG_016', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('283', 'BDG_017', 'f53b096a1af48f72be6e2ad6103dc324', '8', '1', 'default.png', 'LISNA PUJIARTI MOSS', 'BDG_017', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('284', 'BDG_018', '6fcb053ce0558310e17322e8973f7306', '8', '1', 'default.png', 'YULIANA MOSS', 'BDG_018', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('285', 'BDG_020', '792ec86476178320768f8e408148b9f9', '8', '1', 'default.png', 'GITA BONITA MOSS', 'BDG_020', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('286', 'BDG_021', '6d12a074af398a1e66d2b3a925a73b9d', '8', '1', 'default.png', 'SRI LESTARI MOSS', 'BDG_021', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('287', 'BDG_022', 'd07140cd3dc34068eff7e1462c72186b', '8', '1', 'default.png', 'AFIFATUL AZIZAH MOSS', 'BDG_022', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('288', 'BDG_025', '42767ea58be99b2dc5c33c2cd3fbe276', '8', '1', 'default.png', 'ARIEF IMAN PRASETYO MOSS', 'BDG_025', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('289', 'BDG_026', '2ebf1355d23eae0a272b7bb00963971b', '8', '1', 'default.png', 'DWINA ANISAH MOSS', 'BDG_026', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('290', 'BDG_027', '343f44fc9f4ab98678da5dd33e9d060f', '8', '1', 'default.png', 'VIAN ARAYANI MOSS', 'BDG_027', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('291', 'BDG_028', '4d28a35f3727c2d986474a5625d3cb7f', '8', '1', 'default.png', 'RIAN ANDRIANA MOSS', 'BDG_028', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('292', 'BDG_029', '7a91cb252898b25ab14c5ce252abab89', '8', '1', 'default.png', 'EPPY ROBIATUS SADIYAH MOSS', 'BDG_029', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('293', 'BDG_030', '83e7d985e4d90af676019fcbfc2af341', '8', '1', 'default.png', 'PUTRI RATNASARI MOSS', 'BDG_030', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('294', 'BDG_033', '5de3bdf6060a2e151a5942d9dd698af2', '8', '1', 'default.png', 'SELVA NURDIN M MOSS', 'BDG_033', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('295', 'BDG_036', '9db003f38a6bfaa6116c3b6ba9c214fd', '8', '1', 'default.png', 'HARY HAIDAR LATIEF MOSS', 'BDG_036', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('296', 'BDG_037', '9bd6bc7847936d3449d98b9e1a4e238b', '8', '1', '296xx_xx1581417079.jpg', 'NUGRAHA NASRULLOH MOSS', 'BDG_037', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('297', 'BDG_041', '421ebd55dde3f0c4197974d67c02f151', '8', '1', 'default.png', 'DERY SEPTIANA AL RASYID MOSS', 'BDG_041', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('298', 'BDG_042', '2893c0c5c918bf67979c5e3ee649ea64', '8', '1', '298xx_xx1581416833.jpg', 'RIZKI NUR FADHILAH MOSS', 'BDG_042', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('299', 'BDG_043', '09327d4cbbc631b4effa1036944a6f77', '8', '1', 'default.png', 'KARLINA MOSS', 'BDG_043', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('300', 'BDG_039', 'cda92f9926df931869e1528d4b119d39', '8', '1', 'default.png', 'WAHYU MOSS', 'BDG_039', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('301', 'BDG_040', 'c5c09362b31084032d19245dab38058b', '8', '1', 'default.png', 'ANNISA MOSS', 'BDG_040', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('302', 'BDG_046', '649c1b4ab428c0d61fbce1e3ced143dd', '8', '1', '302xx_xx1581417160.jpg', 'DENI YUDISTIRA MOSS', 'BDG_046', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('303', 'BDG_048', '25bec840681d74adb09303bc7f5a52bd', '8', '1', 'default.png', 'GIA NADIA PUTRI MOSS', 'BDG_048', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('304', 'BDG_051', '8b37acc5275bf53e56eb5a5b68bde1b5', '8', '1', 'default.png', 'SINTA DEWI SETIAWATI MOSS', 'BDG_051', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('305', 'BDG_052', '4bc886129d1ef5e004a16aaddd2a3e91', '8', '1', 'default.png', 'SINTA ROSITA MOSS', 'BDG_052', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('306', 'BDG_053', 'e619a4a5f0c9eaa2c13be214401f37ee', '8', '1', 'default.png', 'AGHNIA AUDINA NUR SOLEHAH MOSS', 'BDG_053', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('307', 'BDG_055', '6b5bb4683a44bf5633cfbb954b7c69e7', '8', '1', 'default.png', 'ROHIMAH MOSS', 'BDG_055', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('308', 'BDG_056', '1863b8d4cbf11eba5274c03bdd209add', '8', '1', 'default.png', 'RIA ANDRIYANI MOSS', 'BDG_056', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('309', 'BDG_057', '161ea2fb1e83001b857af4ced5234c89', '8', '1', 'default.png', 'MIA RAHMIYATI MOSS', 'BDG_057', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('310', 'BDG_059', '39d14d972512e7428e554adf5515982b', '8', '1', 'default.png', 'RIRI MARDIANA MOSS', 'BDG_059', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('311', 'BDG_060', '8cb8682af6f1785c7ae06fd5aac073f1', '8', '1', 'default.png', 'DIAN DARMAWAN S MOSS', 'BDG_060', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('312', 'BDG_061', 'dc42c74f0b2e9a9241bb3263b74848e8', '8', '1', 'default.png', 'SHERA AMALIA MOSS', 'BDG_061', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('313', 'BDG_062', 'c3141fb61ee337eaf0ce99e8ba4439b3', '8', '1', 'default.png', 'MUHAMMAD INDRA DWI LAKSANA MOSS', 'BDG_062', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('314', 'BDG_064', 'b5d1c1dc4b8c4cd8b269783f14a01145', '8', '1', 'default.png', 'ARIEF DHARMASAPUTRA MOSS', 'BDG_064', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('315', 'BDG_066', '206b4a43a325a21c73384a62c82b9d10', '8', '1', 'default.png', 'MOHAMMAD HAFIZ AL FAUZAN MOSS', 'BDG_066', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('316', 'BDG_067', '083abfc2bb039f60aebb3d89f2ec670f', '8', '1', 'default.png', 'SRI MAWATI AYUNIGUNTARI MOSS', 'BDG_067', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('317', 'BDG_068', 'b6389dd0656a7aabdde6f8e9fec37f63', '8', '1', 'default.png', 'RIKARDO HAREFA MOSS', 'BDG_068', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('318', 'BDG_069', '9985be0f32c234c0b99dde8604c1a337', '8', '1', 'default.png', 'ROSMILA MOSS', 'BDG_069', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('319', 'BDG_070', '8b51dab01bfbe859664da118fad12c4e', '8', '1', 'default.png', 'RESI NURLITA MOSS', 'BDG_070', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('320', 'BDG_071', 'e050e6c82e3e1390356531703d639b68', '8', '1', 'default.png', 'HANNA DELAVINA MOSS', 'BDG_071', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('321', 'BDG_072', '3a3c3661b58db0a4f4a37a8f7ec37b27', '8', '1', 'default.png', 'NIRA FITRIAH MOSS', 'BDG_072', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('322', 'BDG_073', '6bfccfb7d29d1a6b2eb83cc5e4c1d53a', '8', '1', 'default.png', 'GINA EKI AGUSTIN MOSS', 'BDG_073', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('323', 'BDG_074', '084090a6a6adefd99790ee31f1239203', '9', '1', 'default.png', 'ASTI RAMDHIAN MOSS', 'BDG_074', 'TL', '-');
INSERT INTO `sys_user` VALUES ('324', 'BDG_078', '7904259b5d50e8006896aad96189fd64', '8', '1', 'default.png', 'ANNISA ZAHRA NASHIROTULHAQ MOSS', 'BDG_078', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('325', 'BDG_079', 'e18dc1660ae8786711230deb786ac2c8', '8', '1', 'default.png', 'ISMAYANTI MOSS', 'BDG_079', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('326', 'BDG_082', 'f51ad857183fce17b1f45190fc27ddc5', '8', '1', 'default.png', 'HENI WAHYUNI MOSS', 'BDG_082', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('327', 'BDG_083', 'add32bd2a83946bf2ff5e625d1c5fc2e', '8', '1', 'default.png', 'SARAH SITI NUR SYAMSIAH MOSS', 'BDG_083', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('328', 'BDG_084', 'a4cf197f2d1acdb1dda8ee673eae62cd', '8', '1', 'default.png', 'DICKY PERMANA MOSS', 'BDG_084', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('329', 'BDG_085', '74c2e5be7069e75d2d2b8b669fee5a70', '8', '1', 'default.png', 'RATIH RAHMAWATI MOSS', 'BDG_085', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('330', 'BDG_087', '065fed2679a43b20334657940d24ba04', '8', '1', 'default.png', 'IMAN FIRMANSYAH MOSS', 'BDG_087', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('331', 'BDG_110', '96bb5b409cc1c0dcda6f610876d50052', '8', '1', 'default.png', 'NADYA MAHARANI PUTRI MOSS', 'BDG_110', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('332', 'BDG_009', '82d93afac8b987fe0d5ba9db1771d169', '8', '1', 'default.png', 'NUR JAIS MOSS', 'BDG_009', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('333', 'PE1080', '55c6729673ac6a7c5af3fa615a7f707a', '8', '1', 'default.png', 'PENDI MOSS', 'PE1080', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('334', 'BDG_112', '97ddc0c089de936d90138be6ce7aaea8', '8', '1', 'default.png', 'FIRDA SRI RAHMAYANTI MOSS', 'BDG_112', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('335', 'BDG_114', 'b3179a90ee88e3c30bde70300dcd7b36', '8', '1', 'default.png', 'DIMAS PRADITYA AJI MOSS', 'BDG_114', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('336', 'BDG_115', 'bc9034a537c87ed2a80832489094ca43', '8', '1', 'default.png', 'SANI NURAHAYU MOSS', 'BDG_115', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('337', 'BDG_116', '2a634d9741a8ef1c1f328a0b08c4be4d', '8', '1', 'default.png', 'NADYA RACHMAWATI MOSS', 'BDG_116', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('338', 'BDG_117', 'f602b99c907e6544a81a3c94690a5dd3', '8', '1', 'default.png', 'DIDAH HALIYAH MOSS', 'BDG_117', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('339', 'BDG_118', '41b9dbc89775a518ebd80f9426b08934', '8', '1', 'default.png', 'RIESLA FAUZI RACHMAN MOSS', 'BDG_118', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('340', 'BDG_119', '77f90bb64d146d324721ed5a36be8c18', '8', '1', 'default.png', 'SANDI SARIKA MOSS', 'BDG_119', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('341', 'BDG_120', '9f07d90d8513a692edf1624b72d16d42', '8', '1', 'default.png', 'KRISDIYANTI MOSS', 'BDG_120', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES ('342', 'BDG_111', 'c848e42d7905d4efa4d0105cca9410ac', '8', '1', 'default.png', 'VINA FEBRIANI MOSS', 'BDG_111', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('343', 'BDG_113', '73a3d5e3f1425cc4c24ee0a65f7ddd6e', '8', '1', 'default.png', 'IKBAR NUR MUHAMMAD MOSS', 'BDG_113', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('344', 'BDG_109', '661ca8e8d37d42bae1d10169dddafe82', '8', '1', 'default.png', 'RAHMAWATI ZAKIYAH MOSS', 'BDG_109', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('345', 'BDG_107', '755dcf5332c2df5e1c7cb85a08f96364', '8', '1', '345xx_xx1581416905.jpg', 'KARIN ARINDA PRAMUDHYTA MOSS', 'BDG_107', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES ('346', 'BDG_108', 'e9a987ba33faedb4ee75ab008fb0439d', '8', '1', 'default.png', 'SABILA AINUN HAFSAH MOSS', 'BDG_108', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES ('347', 'screen', '35807ea546f4ccf5e187fa041aeccab4', '8', '1', 'default.png', 'screen', 'SC', '-', null);
INSERT INTO `sys_user` VALUES ('348', 'KD0197', 'cba8ae25d699b8f693008ea83a5911b1', '8', '1', '348xx_xx1580872356.jpg', 'KRISDIYANTI', 'KD0197', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES ('350', 'TLLIA', 'd09c2014efd52de443a8f0fcba24b0ef', '9', '1', '350xx_xx1580867106.jpg', 'TL LIA', 'TLLIA', 'TL', '-');
INSERT INTO `sys_user` VALUES ('351', 'TLITA', '9cb770d5bf067bc7ce74ff1c5c7ec4a0', '9', '1', '351xx_xx1580867246.jpg', 'Ita Modhalina Sembiring', 'TLITA', 'TL', '-');
INSERT INTO `sys_user` VALUES ('352', 'TLATEU', 'a5da8badf19a5085d8aea140bf1fa158', '9', '1', '352xx_xx1580901637.jpg', 'TL NOVA', 'TLATEU', 'TL', '-');
INSERT INTO `sys_user` VALUES ('355', 'TLALL', '6bca1c3c3821b85d8c126867c701bd42', '7', '1', 'default.png', 'Team Leader ALL', 'TLALL', '-', '-');

-- ----------------------------
-- Table structure for sys_user_detail
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_detail`;
CREATE TABLE `sys_user_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agentid` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tanggal_gabung` date DEFAULT NULL,
  `jenis_kelamin` int(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status_perkawinan` int(255) DEFAULT NULL,
  `kelurahan` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kabupaten_kota` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `no_hp_lain` varchar(255) DEFAULT NULL,
  `no_ktp` varchar(255) DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `sekolah` varchar(255) DEFAULT NULL,
  `tahun_lulus` int(255) DEFAULT NULL,
  `no_rekening` int(255) DEFAULT NULL,
  `nama_bank` varchar(255) DEFAULT NULL,
  `npwp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_user_detail
-- ----------------------------

-- ----------------------------
-- Table structure for sys_user_log_login
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_log_login`;
CREATE TABLE `sys_user_log_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `login_time` int(11) DEFAULT NULL,
  `logout_time` int(11) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `browser` varchar(100) DEFAULT NULL,
  `os` varchar(100) DEFAULT NULL,
  `agentid` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `iid` (`id`) USING BTREE,
  KEY `iuser` (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1036 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_user_log_login
-- ----------------------------
INSERT INTO `sys_user_log_login` VALUES ('1', '1', '1579586156', '1579586247', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('2', '2', '1579586252', '1579586257', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('3', '1', '1579586270', '1579586444', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('4', '347', '1579586452', '1579658117', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('5', '1', '1579587062', '1579587107', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('6', '65', '1579587187', '1579587195', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('7', '1', '1579587203', '1579588661', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('8', '65', '1579587349', '1579589979', '10.194.52.10', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('9', '279', '1579587447', '1579595423', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('10', '230', '1579587494', '1580870951', '10.194.52.200', 'Chrome 78.0.3904.108', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('11', '1', '1579588065', '1579589452', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('12', '211', '1579588674', '1579588738', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('13', '1', '1579589451', '1579601030', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('14', '65', '1579589979', '1579600995', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('15', '1', '1579601030', '1579602146', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('16', '65', '1579601185', '1579680111', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('17', '1', '1579602146', '1579602702', '10.194.52.10', 'Chrome 79.0.3945.117', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('18', '1', '1579602702', '1579602717', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('19', '1', '1579602717', '1579607023', '10.194.52.10', 'Chrome 79.0.3945.117', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('20', '1', '1579607023', '1579607044', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('21', '1', '1579607044', '1579607287', '10.194.52.10', 'Chrome 79.0.3945.117', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('22', '1', '1579607287', '1579607878', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('23', '1', '1579607878', '1579657764', '10.194.52.10', 'Chrome 79.0.3945.117', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('24', '1', '1579657764', '1579740228', '10.194.52.10', 'Chrome 79.0.3945.117', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('25', '276', '1579658152', '1579658251', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('26', '65', '1579680110', '1579798920', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('27', '1', '1579740228', '1579748027', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('28', '1', '1579748027', '1579748116', '10.194.52.10', 'Chrome 79.0.3945.117', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('29', '1', '1579748116', '1579748686', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('30', '1', '1579748686', '1579748797', '10.194.52.10', 'Chrome 79.0.3945.117', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('31', '1', '1579748797', '1579748823', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('32', '1', '1579748823', '1579748869', '10.194.52.10', 'Chrome 79.0.3945.117', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('33', '1', '1579748869', '1579748882', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('34', '1', '1579748882', '1579748958', '10.194.52.10', 'Chrome 79.0.3945.117', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('35', '1', '1579748958', '1579749138', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('36', '1', '1579749138', '1579749148', '10.194.52.10', 'Chrome 79.0.3945.117', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('37', '1', '1579749148', '1579779293', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('38', '1', '1579779293', '1579827510', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('39', '65', '1579798946', '1580089409', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('40', '1', '1579827510', '1579832815', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('41', '1', '1579832814', '1580089204', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('42', '1', '1579870855', '1580088408', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('43', '1', '1580088407', '1580090929', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('44', '65', '1580089409', '1580122829', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('45', '228', '1580089477', '1580174573', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('46', '213', '1580089770', '1580089842', '10.194.52.188', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('47', '239', '1580089900', '1580717579', '10.194.52.156', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('48', '267', '1580089995', '1580124569', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('49', '249', '1580090037', '1580091350', '10.194.52.168', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('50', '262', '1580090069', '1580129283', '10.194.52.152', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('51', '219', '1580090156', '1580109558', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('52', '244', '1580090175', '1580104942', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('53', '252', '1580090206', '1580870755', '10.194.52.157', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('54', '243', '1580090250', '1580985402', '10.194.53.105', 'Firefox 51.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('55', '216', '1580090779', '1580777688', '10.194.53.91', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('56', '1', '1580090929', '1580118088', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('57', '231', '1580090959', '1580870776', '10.194.52.155', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('58', '248', '1580090981', '1580115720', '10.194.52.172', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('59', '213', '1580091053', '1580870840', '10.194.52.188', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('60', '233', '1580091069', '1580093781', '10.194.52.167', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('61', '237', '1580091146', '1580868592', '10.194.52.192', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('62', '250', '1580091434', '1580870773', '10.194.52.158', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('63', '275', '1580091797', '1580259989', '10.194.52.185', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('64', '271', '1580091983', '1580460330', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('65', '247', '1580092590', '1580349871', '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('66', '233', '1580093781', '1580103478', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('67', '266', '1580095421', '1580095454', '10.194.52.177', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('68', '266', '1580095454', '1580097818', '10.194.52.177', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('69', '223', '1580097851', '1580112400', '10.194.52.178', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('70', '266', '1580101644', '1580108557', '10.194.52.177', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('71', '233', '1580103478', '1580118240', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('72', '210', '1580104176', '1580104264', '10.194.52.176', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('73', '244', '1580104942', '1580291809', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('74', '261', '1580108568', '1580108604', '10.194.52.177', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('75', '219', '1580109558', '1580110922', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('76', '223', '1580112400', '1580432659', '10.194.52.178', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('77', '261', '1580112468', '1580871004', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('78', '248', '1580115720', '1580693904', '10.194.52.172', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('79', '1', '1580118088', '1580119698', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('80', '233', '1580118240', '1580438279', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('81', '1', '1580119698', '1580121249', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('82', '1', '1580121249', '1580121849', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('83', '266', '1580121358', '1580179260', '10.194.52.177', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('84', '1', '1580121849', '1580122505', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('85', '1', '1580122505', '1580178757', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('86', '65', '1580122829', '1580126203', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('87', '267', '1580124569', '1580173793', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('88', '229', '1580124765', '1580182577', '10.194.52.186', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('89', '219', '1580125705', '1580129434', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('90', '65', '1580126203', '1580173763', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('91', '262', '1580129283', '1580288119', '10.194.52.152', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('92', '211', '1580171713', '1580171874', '10.194.53.102', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('93', '214', '1580171889', '1580171936', '10.194.53.102', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('94', '65', '1580173763', '1580215984', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('95', '267', '1580173793', '1580213415', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('96', '228', '1580174573', '1580194228', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('97', '285', '1580178727', '1580718321', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('98', '1', '1580178757', '1580181262', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('99', '266', '1580179260', '1580213303', '10.194.52.177', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('100', '1', '1580181262', '1580200528', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('101', '229', '1580182577', '1580789362', '10.194.52.186', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('102', '228', '1580194228', '1580212995', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('103', '1', '1580200528', '1580215631', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('104', '347', '1580203123', '1580215934', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('105', '219', '1580212163', '1580260339', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('106', '228', '1580212995', '1580263482', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('107', '266', '1580213302', '1580263076', '10.194.52.177', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('108', '267', '1580213414', '1580262715', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('109', '1', '1580215631', '1580265272', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('110', '65', '1580215984', '1580281013', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('111', '279', '1580221168', '1580222832', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('112', '275', '1580259988', '1580353222', '10.194.52.185', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('113', '219', '1580260339', '1580456958', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('114', '267', '1580262715', '1580291868', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('115', '266', '1580263076', '1580263081', '10.194.52.177', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('116', '228', '1580263482', '1580345811', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('117', '1', '1580265272', '1580266352', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('118', '1', '1580266352', '1580266414', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('119', '1', '1580266417', '1580266423', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('120', '1', '1580266652', '1580294534', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('121', '280', '1580267527', '1580267596', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('122', '288', '1580267601', '1580272125', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('123', '65', '1580281013', '1580286260', '10.194.52.10', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('124', '65', '1580286260', '1580298069', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('125', '262', '1580288119', '1580349983', '10.194.52.152', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('126', '244', '1580291808', '1580291866', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('127', '267', '1580291868', '1580373467', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('128', '1', '1580294534', '1580298385', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('129', '65', '1580298069', '1580348616', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('130', '1', '1580298385', '1580305539', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('131', '263', '1580300689', '1580300760', '10.194.52.165', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('132', '263', '1580300760', '1580871095', '10.194.52.165', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('133', '218', '1580300908', '1580301756', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('134', '257', '1580301588', '1580870983', '10.194.52.171', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('135', '226', '1580301839', '1580870795', '10.194.52.163', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('136', '218', '1580301842', '1580471357', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('137', '1', '1580305539', '1580347829', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('138', '228', '1580345810', '1580379431', '10.194.52.162', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('139', '1', '1580347829', '1580374688', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('140', '65', '1580348616', '1580438046', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('141', '247', '1580349871', '1580731220', '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('142', '262', '1580349983', '1580905025', '10.194.52.152', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('143', '275', '1580353222', '1580698155', '10.194.52.185', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('144', '267', '1580373466', '1580387405', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('145', '1', '1580374685', '1580438165', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('146', '347', '1580374917', '1580378940', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('147', '347', '1580378940', '1580462833', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('148', '228', '1580379431', '1580694270', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('149', '267', '1580387405', '1580716493', '10.194.52.10', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('150', '223', '1580432659', '1580803563', '10.194.52.178', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('151', '65', '1580438046', '1580461650', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('152', '1', '1580438164', '1580779140', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('153', '233', '1580438279', '1580456862', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('154', '233', '1580456862', '1580472612', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('155', '219', '1580456958', '1580457561', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('156', '217', '1580457577', '1580457828', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('157', '219', '1580457829', '1580465466', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('158', '271', '1580460330', '1580870960', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('159', '65', '1580461650', '1580464828', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('160', '347', '1580462833', '1580870040', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('161', '65', '1580464828', '1580470390', '10.194.52.10', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('162', '219', '1580465466', '1580473085', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('163', '65', '1580470390', '1580727645', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('164', '218', '1580471357', '1580472493', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('165', '233', '1580472612', '1580528125', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('166', '219', '1580473218', '1580874698', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('167', '233', '1580528124', '1580546772', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('168', '233', '1580546772', '1580718907', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('169', '248', '1580693904', '1580693944', '10.194.52.172', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('170', '228', '1580694270', '1580731448', '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('171', '275', '1580698153', '1580710015', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('172', '275', '1580710010', '1580732672', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('173', '267', '1580716488', '1580868922', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('174', '239', '1580717575', '1580719018', '10.194.52.178', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('175', '285', '1580718317', '1580719048', '10.194.52.178', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('176', '233', '1580718901', '1580730754', '10.194.52.195', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('177', '285', '1580719048', '1580719533', '10.194.52.178', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('178', '65', '1580727643', '1580815350', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('179', '248', '1580730579', '1580730687', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('180', '282', '1580730698', '1580779084', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('181', '233', '1580730754', '1580802932', '10.194.52.195', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('182', '247', '1580731220', '1580732765', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('183', '228', '1580731448', '1580732271', '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('184', '289', '1580732282', null, '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('185', '275', '1580732672', '1580732823', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('186', '331', '1580732839', '1580866742', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('187', '217', '1580733461', '1580733629', '10.194.52.155', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('188', '247', '1580777291', '1580777384', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('189', '286', '1580777406', '1580777442', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('190', '211', '1580777456', '1580777528', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('191', '270', '1580777543', '1580777606', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('192', '251', '1580777616', '1580777666', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('193', '216', '1580777688', '1580779799', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('194', '248', '1580778756', '1580779067', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('195', '282', '1580779084', '1580783014', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('196', '1', '1580779140', '1580800093', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('197', '228', '1580781394', '1580870740', '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('198', '259', '1580783061', '1580783542', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('199', '248', '1580784910', '1580864966', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('200', '229', '1580789362', '1580789367', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('201', '229', '1580789382', '1580789435', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('202', '275', '1580789533', '1580805560', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('203', '247', '1580794471', '1580870740', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('204', '1', '1580800093', '1580814918', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('205', '233', '1580802932', '1580817794', '10.194.52.195', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('206', '223', '1580803563', '1580870737', '10.194.52.152', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('207', '275', '1580805560', '1580805565', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('208', '275', '1580805573', '1580865952', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('209', '1', '1580814918', '1580815207', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('210', '210', '1580815211', '1580815346', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('211', '65', '1580815350', '1580816249', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('212', '65', '1580816249', '1580816589', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('213', '350', '1580816603', '1580819703', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('214', '233', '1580817794', '1580868298', '10.194.52.195', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('215', '1', '1580819628', '1580819639', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('216', '350', '1580819703', '1580825340', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('217', '351', '1580819799', '1580825331', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('218', '65', '1580820510', '1580867149', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('219', '352', '1580821523', '1580899390', '10.194.53.112', 'Firefox 56.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('220', '1', '1580825069', '1580866625', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('221', '350', '1580825340', '1580825429', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('222', '248', '1580864966', '1580880688', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('223', '275', '1580865951', '1580866732', '10.194.52.200', 'Chrome 78.0.3904.108', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('224', '351', '1580866410', '1580872222', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('225', '1', '1580866625', '1580870022', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('226', '331', '1580866742', '1580870597', '10.194.52.200', 'Chrome 78.0.3904.108', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('227', '350', '1580866745', '1580867130', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('228', '65', '1580867149', '1580869073', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('229', '233', '1580868298', '1580959250', '10.194.52.195', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('230', '237', '1580868592', '1580905880', '10.194.52.186', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('231', '267', '1580868922', '1580871552', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('232', '350', '1580869082', '1580874599', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('233', '217', '1580869894', '1580955388', '10.194.52.155', 'Firefox 46.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('234', '347', '1580870040', '1580873034', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('235', '275', '1580870610', '1580871838', '10.194.52.200', 'Chrome 78.0.3904.108', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('236', '277', '1580870703', '1580870902', '10.194.52.176', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('237', '245', '1580870727', '1580871008', '10.194.52.163', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('238', '223', '1580870737', '1580950706', '10.194.52.152', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('239', '228', '1580870739', '1580953322', '10.194.52.174', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('240', '247', '1580870740', '1580872337', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('241', '216', '1580870743', '1580871023', '10.194.52.166', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('242', '251', '1580870743', '1580870771', '10.194.52.153', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('243', '236', '1580870747', '1580870908', '10.194.52.165', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('244', '266', '1580870747', '1580870758', '10.194.52.151', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('245', '224', '1580870752', '1580870911', '10.194.52.164', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('246', '264', '1580870753', '1580870883', '10.194.52.156', 'Firefox 44.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('247', '254', '1580870753', '1580871042', '10.194.52.162', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('248', '235', '1580870754', '1580894357', '10.194.52.157', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('249', '252', '1580870755', '1580871018', '10.194.52.161', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('250', '210', '1580870765', '1580871284', '10.194.53.105', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('251', '253', '1580870769', '1580899645', '10.194.52.173', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('252', '266', '1580870770', '1580870959', '10.194.52.151', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('253', '250', '1580870773', '1580947186', '10.194.52.170', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('254', '231', '1580870776', '1580871165', '10.194.52.171', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('255', '251', '1580870779', '1580874048', '10.194.52.153', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('256', '239', '1580870780', '1580906140', '10.194.52.178', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('257', '270', '1580870783', '1580871115', '10.194.53.103', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('258', '226', '1580870795', '1580873063', '10.194.52.175', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('259', '221', '1580870800', '1580900694', '10.194.53.93', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('260', '348', '1580870803', '1580872235', '10.194.52.160', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('261', '258', '1580870816', '1580871363', '10.194.52.159', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('262', '256', '1580870832', '1580871376', '10.194.53.109', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('263', '246', '1580870838', '1581037111', '10.194.53.97', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('264', '213', '1580870840', '1580872192', '10.194.53.94', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('265', '218', '1580870844', '1580871073', '10.194.53.102', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('266', '229', '1580870850', '1580871069', '10.194.52.180', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('267', '260', '1580870861', '1580900773', '10.194.52.169', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('268', '265', '1580870868', '1580870964', '10.194.52.181', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('269', '241', '1580870875', '1580871577', '10.194.52.158', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('270', '255', '1580870890', '1580871086', '10.194.53.100', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('271', '264', '1580870891', '1580870938', '10.194.52.156', 'Firefox 44.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('272', '236', '1580870916', '1580873478', '10.194.52.165', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('273', '224', '1580870927', '1580900281', '10.194.52.164', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('274', '274', '1580870929', '1580898863', '10.194.52.176', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('275', '264', '1580870945', '1580871430', '10.194.52.156', 'Firefox 44.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('276', '230', '1580870951', '1580980203', '10.194.52.187', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('277', '271', '1580870960', '1580898147', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('278', '266', '1580870972', '1580871169', '10.194.52.151', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('279', '211', '1580870974', '1580871057', '10.194.52.181', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('280', '227', '1580870977', '1580972034', '10.194.52.177', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('281', '257', '1580870983', '1580892239', '10.194.52.189', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('282', '234', '1580870983', '1580872680', '10.194.53.108', 'Firefox 58.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('283', '261', '1580871004', '1580871429', '10.194.53.106', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('284', '245', '1580871008', '1580900316', '10.194.52.163', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('285', '268', '1580871015', '1580880329', '10.194.52.193', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('286', '216', '1580871023', '1580954120', '10.194.52.166', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('287', '249', '1580871023', '1580871134', '10.194.53.91', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('288', '252', '1580871042', '1580907033', '10.194.52.161', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('289', '254', '1580871042', '1580871068', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('290', '240', '1580871072', '1580871143', '10.194.52.181', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('291', '254', '1580871076', '1580900740', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('292', '255', '1580871086', '1580873264', '10.194.53.100', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('293', '263', '1580871095', '1580874265', '10.194.53.102', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('294', '229', '1580871107', '1580871149', '10.194.52.180', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('295', '270', '1580871115', '1580871549', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('296', '229', '1580871149', '1580871203', '10.194.52.180', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('297', '231', '1580871165', '1580898927', '10.194.52.171', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('298', '276', '1580871215', '1580871333', '10.194.52.180', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('299', '210', '1580871295', '1580906578', '10.194.53.105', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('300', '229', '1580871336', '1580905032', '10.194.52.180', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('301', '258', '1580871363', '1580880271', '10.194.52.159', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('302', '266', '1580871371', '1580871490', '10.194.52.151', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('303', '256', '1580871376', '1580871580', '10.194.53.109', 'Chrome 14.0.835.35', 'Windows 8', null);
INSERT INTO `sys_user_log_login` VALUES ('304', '214', '1580871450', '1580871775', '10.194.53.106', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('305', '266', '1580871492', '1580871502', '10.194.52.151', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('306', '266', '1580871515', '1580871549', '10.194.52.151', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('307', '266', '1580871549', '1580871708', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('308', '267', '1580871552', '1580871574', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('309', '256', '1580871580', '1580871924', '10.194.53.109', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('310', '333', '1580871596', null, '10.194.52.158', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('311', '251', '1580871715', '1580871900', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('312', '270', '1580871738', '1580872651', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('313', '232', '1580871762', '1580906528', '10.194.52.194', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('314', '261', '1580871777', '1580905358', '10.194.53.106', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('315', '331', '1580871849', '1580874918', '10.194.52.200', 'Chrome 78.0.3904.108', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('316', '256', '1580871923', '1580872075', '10.194.53.109', 'Chrome 14.0.835.35', 'Windows 8', null);
INSERT INTO `sys_user_log_login` VALUES ('317', '244', '1580871975', '1580899212', '10.194.52.192', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('318', '256', '1580872075', '1580872103', '10.194.53.109', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('319', '256', '1580872103', '1580892618', '10.194.53.109', 'Chrome 14.0.835.35', 'Windows 8', null);
INSERT INTO `sys_user_log_login` VALUES ('320', '213', '1580872192', '1580873390', '10.194.53.94', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('321', '348', '1580872235', '1580872369', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('322', '286', '1580872349', '1580873894', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('323', '234', '1580872680', '1580872700', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('324', '234', '1580872699', '1580872771', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('325', '351', '1580872806', '1580872842', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('326', '259', '1580872814', '1580877425', '10.194.52.188', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('327', '351', '1580872856', '1580873053', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('328', '65', '1580873019', '1580874606', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('329', '1', '1580873054', '1580873102', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('330', '226', '1580873063', '1580874434', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('331', '348', '1580873106', '1580954730', '10.194.52.160', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('332', '210', '1580873108', '1580873126', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('333', '347', '1580873182', '1580888226', '10.194.52.196', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('334', '313', '1580873408', '1580873497', '10.194.53.94', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('335', '213', '1580873500', '1580873511', '10.194.53.94', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('336', '1', '1580873508', '1580876495', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('337', '247', '1580873904', '1580904878', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('338', '218', '1580874279', '1580952812', '10.194.53.102', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('339', '270', '1580874456', '1580874472', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('340', '241', '1580874481', '1580874504', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('341', '65', '1580874606', '1580874676', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('342', '219', '1580874698', '1581038525', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('343', '331', '1580874941', '1580875014', '10.194.52.200', 'Chrome 78.0.3904.108', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('344', '275', '1580875303', '1580949073', '10.194.52.200', 'Chrome 78.0.3904.108', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('345', '213', '1580875534', '1580904651', '10.194.53.94', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('346', '1', '1580876495', '1580898680', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('347', '266', '1580878614', '1580879675', '10.194.52.151', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('348', '267', '1580878739', '1580905007', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('349', '266', '1580879675', '1580905517', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('350', '236', '1580879772', '1580888115', '10.194.52.165', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('351', '258', '1580880271', '1580952398', '10.194.52.159', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('352', '268', '1580880328', '1581036988', '10.194.52.193', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('353', '248', '1580880698', '1580906756', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('354', '241', '1580882408', '1580990100', '10.194.52.158', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('355', '226', '1580884317', '1580971021', '10.194.52.175', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('356', '259', '1580884574', '1580912616', '10.194.52.188', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('357', '236', '1580888123', '1580952680', '10.194.52.165', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('358', '347', '1580888226', '1580894717', '10.194.52.196', 'Chrome 49.0.2623.112', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('359', '257', '1580892239', '1580904921', '10.194.52.189', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('360', '256', '1580892618', '1581062190', '10.194.53.109', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('361', '1', '1580894274', '1580894317', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('362', '210', '1580894321', '1580894709', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('363', '235', '1580894357', '1580904628', '10.194.52.157', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('364', '347', '1580894716', '1580894724', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('365', '1', '1580894733', '1580900132', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('366', '65', '1580895318', '1580895838', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('367', '350', '1580895702', '1580895829', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('368', '65', '1580895838', '1580906181', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('369', '263', '1580896134', '1580906962', '10.194.53.101', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('370', '270', '1580896669', '1580898629', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('371', '234', '1580897387', '1580898709', '10.194.53.108', 'Firefox 58.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('372', '271', '1580898147', '1580898625', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('373', '270', '1580898629', '1580898779', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('374', '234', '1580898709', '1580900128', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('375', '251', '1580898744', '1581036800', '10.194.52.153', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('376', '271', '1580898782', '1580905755', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('377', '274', '1580898863', '1580983750', '10.194.52.172', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('378', '270', '1580898904', '1580952717', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('379', '231', '1580898927', '1580904536', '10.194.52.171', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('380', '244', '1580899212', '1580956498', '10.194.52.192', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('381', '265', '1580899257', null, '10.194.52.181', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('382', '352', '1580899390', '1580904529', '10.194.53.112', 'Firefox 56.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('383', '279', '1580899429', '1580952645', '10.194.52.10', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('384', '253', '1580899645', '1581300040', '10.194.52.173', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('385', '276', '1580899830', '1580916501', '10.194.52.184', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('386', '1', '1580900132', '1580900841', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('387', '245', '1580900316', '1580900493', '10.194.52.164', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('388', '245', '1580900497', '1580900540', '10.194.52.163', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('389', '224', '1580900501', '1580904019', '10.194.52.164', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('390', '231', '1580900548', '1580900579', '10.194.52.163', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('391', '245', '1580900586', '1580906958', '10.194.52.163', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('392', '221', '1580900694', '1580905762', '10.194.53.93', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('393', '260', '1580900773', '1580900789', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('394', '254', '1580900798', '1580903207', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('395', '260', '1580903225', '1580903244', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('396', '255', '1580903262', '1580903284', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('397', '254', '1580903295', '1580953699', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('398', '224', '1580903698', '1580904707', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('399', '231', '1580904544', '1580904622', '10.194.52.171', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('400', '235', '1580904628', '1580905857', '10.194.52.171', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('401', '313', '1580904654', '1580904762', '10.194.53.94', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('402', '1', '1580904671', '1580905293', '10.194.53.112', 'Firefox 56.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('403', '248', '1580904725', '1580904869', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('404', '213', '1580904766', '1580950874', '10.194.53.94', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('405', '255', '1580904795', '1580907008', '10.194.53.100', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('406', '214', '1580904877', '1580905027', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('407', '247', '1580904878', '1580905243', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('408', '257', '1580904931', '1581048044', '10.194.52.189', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('409', '262', '1580905025', '1580905048', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('410', '229', '1580905032', '1580905076', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('411', '267', '1580905049', '1580905349', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('412', '214', '1580905082', '1580906159', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('413', '229', '1580905117', '1580954169', '10.194.52.180', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('414', '267', '1580905185', '1580905302', '10.194.53.99', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('415', '224', '1580905290', '1580905939', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('416', '1', '1580905292', '1580952724', '10.194.52.252', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('417', '262', '1580905312', '1580905420', '10.194.53.99', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('418', '351', '1580905349', '1581472718', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('419', '261', '1580905358', '1580905373', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('420', '267', '1580905374', '1580905873', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('421', '247', '1580905378', '1580952581', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('422', '261', '1580905399', '1580905529', '10.194.53.106', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('423', '262', '1580905429', '1580955203', '10.194.53.99', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('424', '261', '1580905528', '1580905555', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('425', '266', '1580905567', '1580905755', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('426', '261', '1580905715', '1580905745', '10.194.53.106', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('427', '266', '1580905755', '1580906059', '10.194.53.106', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('428', '221', '1580905762', '1580905799', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('429', '271', '1580905802', '1580906393', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('430', '267', '1580905873', '1580905877', '10.194.52.171', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('431', '267', '1580905877', '1580905897', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('432', '237', '1580905879', '1580953739', '10.194.52.185', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('433', '266', '1580905889', '1580905912', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('434', '267', '1580905897', '1580906190', '10.194.52.171', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('435', '264', '1580905901', '1580906771', '10.194.52.156', 'Firefox 44.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('436', '261', '1580905928', '1580905974', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('437', '266', '1580905995', '1580906133', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('438', '261', '1580906062', '1580906416', '10.194.53.106', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('439', '231', '1580906137', '1580906160', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('440', '248', '1580906144', '1580906177', '10.194.52.178', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('441', '266', '1580906162', '1580906163', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('442', '266', '1580906163', '1580906179', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('443', '224', '1580906170', '1580906278', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('444', '65', '1580906181', '1580971374', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('445', '239', '1580906186', '1580976830', '10.194.52.178', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('446', '267', '1580906190', '1580906770', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('447', '214', '1580906200', '1580906412', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('448', '221', '1580906293', '1580906323', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('449', '224', '1580906337', '1580906386', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('450', '266', '1580906344', '1580906579', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('451', '224', '1580906408', '1580906419', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('452', '221', '1580906409', '1580906424', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('453', '261', '1580906416', '1580906437', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('454', '221', '1580906424', '1580906442', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('455', '214', '1580906439', '1580906632', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('456', '221', '1580906442', '1580906454', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('457', '271', '1580906460', '1580958806', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('458', '224', '1580906481', '1580952543', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('459', '231', '1580906494', '1580906603', '10.194.52.171', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('460', '232', '1580906527', '1581325623', '10.194.52.194', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('461', '248', '1580906582', '1580906624', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('462', '231', '1580906611', '1580954214', '10.194.52.171', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('463', '266', '1580906635', '1580951487', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('464', '261', '1580906637', '1580906657', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('465', '248', '1580906767', '1580951761', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('466', '214', '1580906782', '1580906908', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('467', '267', '1580906785', '1580951354', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('468', '261', '1580906881', '1580955638', '10.194.53.106', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('469', '263', '1580906962', '1580950170', '10.194.52.163', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('470', '259', '1580912616', '1580951943', '10.194.52.200', 'Chrome 78.0.3904.108', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('471', '276', '1580916501', '1580916576', '10.194.52.184', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('472', '250', '1580947186', '1580952962', '10.194.52.170', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('473', '252', '1580948209', '1580952490', '10.194.52.161', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('474', '275', '1580949073', '1580949151', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('475', '331', '1580949172', '1581138465', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('476', '264', '1580950016', '1580965087', '10.194.52.156', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('477', '263', '1580950170', '1581039988', '10.194.53.101', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('478', '276', '1580950634', '1581037346', '10.194.52.184', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('479', '223', '1580950706', '1581037423', '10.194.52.152', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('480', '213', '1580950874', '1580991523', '10.194.53.94', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('481', '221', '1580951218', '1580951443', '10.194.53.93', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('482', '235', '1580951239', '1581039050', '10.194.52.157', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('483', '267', '1580951354', '1580955366', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('484', '266', '1580951487', '1580951515', '10.194.53.93', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('485', '221', '1580951518', '1581037073', '10.194.53.93', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('486', '248', '1580951761', '1581039719', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('487', '245', '1580951800', '1580953693', '10.194.52.163', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('488', '259', '1580951942', '1581039523', '10.194.52.188', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('489', '258', '1580952398', '1581037133', '10.194.52.159', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('490', '252', '1580952490', '1580952531', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('491', '224', '1580952543', '1580952714', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('492', '247', '1580952581', '1581041635', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('493', '252', '1580952622', '1580968359', '10.194.52.161', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('494', '279', '1580952645', '1580980185', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('495', '236', '1580952680', '1580952716', '10.194.52.165', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('496', '270', '1580952717', '1580952740', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('497', '1', '1580952724', '1580952979', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('498', '236', '1580952724', '1580952772', '10.194.52.165', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('499', '224', '1580952750', '1580952838', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('500', '236', '1580952786', '1580952854', '10.194.52.165', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('501', '218', '1580952812', '1580992961', '10.194.53.102', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('502', '236', '1580952854', '1580952898', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('503', '224', '1580952906', '1580952958', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('504', '236', '1580952918', '1581040071', '10.194.52.165', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('505', '250', '1580952962', '1580952990', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('506', '347', '1580952988', '1580954220', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('507', '224', '1580953094', '1580954117', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('508', '228', '1580953322', '1581039695', '10.194.52.174', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('509', '254', '1580953699', '1580953720', '10.194.52.163', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('510', '245', '1580953727', '1581037872', '10.194.52.163', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('511', '237', '1580953739', '1581037861', '10.194.52.185', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('512', '250', '1580954010', '1581033690', '10.194.52.170', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('513', '216', '1580954120', '1580954152', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('514', '224', '1580954160', '1580954208', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('515', '229', '1580954169', '1580992941', '10.194.52.180', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('516', '231', '1580954214', '1580954242', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('517', '1', '1580954227', '1580954528', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('518', '224', '1580954292', '1581065382', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('519', '347', '1580954537', '1580954550', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('520', '1', '1580954559', '1580959515', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('521', '234', '1580954640', '1581036564', '10.194.53.108', 'Firefox 58.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('522', '348', '1580954730', '1580958013', '10.194.52.160', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('523', '266', '1580955074', '1581036707', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('524', '210', '1580955099', '1580955391', '10.194.53.105', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('525', '262', '1580955203', '1580955374', '10.194.53.99', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('526', '262', '1580955374', '1580955389', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('527', '267', '1580955391', '1581036688', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('528', '210', '1580955391', '1580955451', '10.194.52.155', 'Firefox 46.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('529', '217', '1580955452', '1580956081', '10.194.52.155', 'Firefox 46.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('530', '261', '1580955638', '1581047664', '10.194.53.106', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('531', '260', '1580956084', '1580956166', '10.194.52.155', 'Firefox 46.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('532', '217', '1580956169', '1581044463', '10.194.52.155', 'Firefox 46.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('533', '231', '1580956472', '1581057790', '10.194.52.171', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('534', '244', '1580956498', '1580985908', '10.194.52.192', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('535', '260', '1580956641', '1581037938', '10.194.52.169', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('536', '348', '1580958022', '1581039486', '10.194.52.160', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('537', '271', '1580958806', '1580971922', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('538', '233', '1580959249', '1581040486', '10.194.52.195', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('539', '1', '1580959515', '1580959884', '::1', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('540', '1', '1580959884', '1580982691', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('541', '262', '1580961376', '1581059993', '10.194.53.99', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('542', '211', '1580962073', '1580993053', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('543', '255', '1580962925', '1580984993', '10.194.53.100', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('544', '264', '1580965086', '1580972470', '10.194.52.156', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('545', '254', '1580967070', '1580967110', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('546', '254', '1580967118', '1581042811', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('547', '252', '1580968361', '1581035517', '10.194.52.161', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('548', '270', '1580969313', '1580971927', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('549', '226', '1580971020', '1581046363', '10.194.52.175', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('550', '350', '1580971327', '1580971367', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('551', '65', '1580971374', '1581049375', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('552', '270', '1580971927', '1580971963', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('553', '271', '1580971966', '1581303144', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('554', '227', '1580972043', '1581042984', '10.194.52.177', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('555', '270', '1580972155', '1581319030', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('556', '264', '1580972470', '1581046290', '10.194.52.156', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('557', '239', '1580976830', '1581059509', '10.194.52.178', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('558', '230', '1580980203', '1581035089', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('559', '1', '1580982691', '1580983929', '10.194.53.112', 'Firefox 56.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('560', '273', '1580983485', '1580983547', '10.194.52.186', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('561', '274', '1580983750', '1581413294', '10.194.52.172', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('562', '1', '1580983929', '1581041131', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('563', '275', '1580985039', '1580993065', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('564', '243', '1580985402', '1580985804', '10.194.52.191', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('565', '243', '1580985816', '1580985847', '10.194.52.191', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('566', '243', '1580985878', '1580985920', '10.194.52.191', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('567', '243', '1580985920', '1580990807', '10.194.52.192', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('568', '273', '1580990007', '1581055813', '10.194.52.186', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('569', '241', '1580990100', '1580990230', '10.194.52.158', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('570', '241', '1580990248', '1581078234', '10.194.52.158', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('571', '243', '1580990807', '1581299006', '10.194.52.191', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('572', '313', '1580991525', null, '10.194.53.94', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('573', '218', '1580992961', '1580993054', '10.194.52.180', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('574', '275', '1580993064', '1580993102', '10.194.52.180', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('575', '272', '1580993080', '1580993344', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('576', '229', '1580993106', '1581040211', '10.194.52.180', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('577', '250', '1581033690', '1581040839', '10.194.52.170', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('578', '279', '1581035094', '1581122076', '10.194.52.10', 'Chrome 79.0.3945.130', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('579', '252', '1581035517', '1581077151', '10.194.52.161', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('580', '234', '1581036564', '1581148668', '10.194.53.108', 'Firefox 58.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('581', '267', '1581036687', '1581296872', '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('582', '266', '1581036707', '1581036860', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('583', '251', '1581036800', '1581036931', '10.194.52.153', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('584', '317', '1581036872', '1581036923', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('585', '251', '1581036931', '1581036974', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('586', '268', '1581036988', '1581037058', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('587', '221', '1581037073', '1581037116', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('588', '246', '1581037111', '1581040951', '10.194.53.97', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('589', '251', '1581037129', '1581037171', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('590', '258', '1581037133', '1581045113', '10.194.52.159', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('591', '266', '1581037188', '1581037277', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('592', '276', '1581037346', '1581122059', '10.194.52.184', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('593', '251', '1581037394', '1581040692', '10.194.52.153', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('594', '223', '1581037423', '1581077679', '10.194.52.152', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('595', '244', '1581037511', '1581302485', '10.194.52.192', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('596', '237', '1581037861', '1581297365', '10.194.52.185', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('597', '245', '1581037872', '1581042725', '10.194.52.163', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('598', '221', '1581037897', '1581557318', '10.194.53.93', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('599', '260', '1581037938', '1581141189', '10.194.52.169', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('600', '219', '1581038525', '1581040680', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('601', '275', '1581038571', '1581138454', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('602', '213', '1581038894', '1581079038', '10.194.53.94', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('603', '235', '1581039050', '1581127724', '10.194.52.157', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('604', '348', '1581039486', '1581040293', '10.194.52.160', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('605', '259', '1581039523', '1581074824', '10.194.52.188', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('606', '228', '1581039694', '1581299731', '10.194.52.174', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('607', '248', '1581039719', '1581040805', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('608', '263', '1581039988', '1581381651', '10.194.53.101', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('609', '236', '1581040071', '1581044528', '10.194.52.165', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('610', '229', '1581040211', '1581306145', '10.194.52.180', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('611', '230', '1581040219', '1581297124', '10.194.52.187', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('612', '218', '1581040286', '1581298509', '10.194.53.102', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('613', '348', '1581040300', '1581313519', '10.194.52.160', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('614', '233', '1581040486', '1581128736', '10.194.52.195', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('615', '251', '1581040692', '1581044963', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('616', '282', '1581040819', '1581043893', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('617', '250', '1581040839', '1581040870', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('618', '246', '1581040951', '1581042902', '10.194.53.97', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('619', '1', '1581041131', '1581042944', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('620', '247', '1581041634', '1581042875', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('621', '266', '1581041636', '1581076432', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('622', '245', '1581042724', '1581042765', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('623', '211', '1581042773', '1581042802', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('624', '254', '1581042811', '1581042815', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('625', '254', '1581042824', '1581042849', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('626', '247', '1581042875', '1581042892', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('627', '246', '1581042902', '1581042923', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('628', '1', '1581042944', '1581042960', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('629', '245', '1581042950', '1581295529', '10.194.52.163', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('630', '227', '1581042984', '1581043009', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('631', '238', '1581043016', '1581043045', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('632', '268', '1581043055', '1581043085', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('633', '269', '1581043097', '1581043115', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('634', '1', '1581043174', '1581043472', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('635', '246', '1581043361', '1581077500', '10.194.53.97', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('636', '227', '1581043531', '1581046643', '10.194.52.177', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('637', '225', '1581043545', '1581044167', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('638', '268', '1581043648', '1581300369', '10.194.52.193', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('639', '255', '1581043707', '1581079542', '10.194.53.100', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('640', '248', '1581043895', '1581151032', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('641', '216', '1581044175', '1581044457', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('642', '217', '1581044463', '1581044501', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('643', '236', '1581044528', '1581044552', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('644', '247', '1581044642', '1581078892', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('645', '251', '1581044963', '1581079738', '10.194.52.153', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('646', '258', '1581045113', '1581137027', '10.194.52.159', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('647', '211', '1581045656', '1581054268', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('648', '280', '1581045660', '1581047944', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('649', '236', '1581045779', null, '10.194.52.165', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('650', '210', '1581045824', '1581297789', '10.194.53.105', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('651', '254', '1581046025', '1581295531', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('652', '264', '1581046290', '1581322068', '10.194.52.156', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('653', '226', '1581046363', '1581138981', '10.194.52.175', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('654', '227', '1581046657', '1581063382', '10.194.52.177', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('655', '261', '1581047664', '1581134307', '10.194.53.106', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('656', '1', '1581047977', '1581048040', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('657', '257', '1581048044', '1581048055', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('658', '217', '1581048845', '1581301172', '10.194.52.155', 'Firefox 46.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('659', '65', '1581049375', '1581063496', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('660', '283', '1581054282', '1581054334', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('661', '211', '1581054341', '1581302079', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('662', '273', '1581055813', null, '10.194.52.186', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('663', '257', '1581057737', '1581061656', '10.194.52.189', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('664', '231', '1581057789', '1581296916', '10.194.52.171', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('665', '250', '1581057944', '1581124720', '10.194.52.170', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('666', '1', '1581058288', '1581065087', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('667', '239', '1581059508', '1581140671', '10.194.52.178', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('668', '262', '1581059992', '1581297013', '10.194.53.99', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('669', '257', '1581061656', '1581061680', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('670', '256', '1581062190', '1581078910', '10.194.53.109', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('671', '257', '1581062441', '1581062531', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('672', '242', '1581062535', '1581062576', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('673', '242', '1581062588', '1581062610', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('674', '257', '1581062813', '1581081118', '10.194.52.189', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('675', '227', '1581063390', '1581069852', '10.194.52.177', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('676', '219', '1581063520', '1581063542', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('677', '65', '1581063552', '1581069856', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('678', '1', '1581065087', '1581069761', '10.194.53.112', 'Firefox 56.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('679', '224', '1581065382', '1581065420', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('680', '1', '1581069761', '1581069790', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('681', '321', '1581069793', '1581069849', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('682', '65', '1581069855', '1581069872', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('683', '227', '1581069859', '1581070827', '10.194.52.177', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('684', '1', '1581069886', '1581124697', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('685', '227', '1581070835', '1581302098', '10.194.52.177', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('686', '224', '1581072018', '1581338534', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('687', '293', '1581074839', '1581074891', '10.194.52.188', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('688', '259', '1581074900', '1581119129', '10.194.52.188', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('689', '213', '1581076448', '1581146676', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('690', '246', '1581077500', '1581078780', '10.194.53.97', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('691', '281', '1581077693', '1581077729', '10.194.52.152', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('692', '223', '1581077741', '1581303330', '10.194.52.152', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('693', '214', '1581078031', '1581078050', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('694', '266', '1581078068', '1581152221', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('695', '241', '1581078233', '1581137646', '10.194.52.158', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('696', '252', '1581078236', '1581078338', '10.194.52.161', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('697', '246', '1581078793', '1581079519', '10.194.53.97', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('698', '256', '1581078909', '1581079007', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('699', '256', '1581079020', '1581079066', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('700', '256', '1581079049', '1581079233', '10.194.53.94', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('701', '247', '1581079077', '1581079146', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('702', '332', '1581079245', null, '10.194.53.94', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('703', '246', '1581079552', '1581079644', '10.194.53.97', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('704', '255', '1581079561', '1581079585', '10.194.53.100', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('705', '251', '1581079737', '1581081505', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('706', '256', '1581081141', '1581081494', '10.194.52.189', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('707', '251', '1581081504', '1581130366', '10.194.52.189', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('708', '259', '1581119129', '1581162108', '10.194.52.188', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('709', '279', '1581122076', '1581160868', '10.194.52.184', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('710', '1', '1581124697', '1581127087', '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('711', '250', '1581124720', '1581291818', '10.194.52.183', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('712', '1', '1581127098', '1581127113', '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('713', '65', '1581127270', '1581127282', '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('714', '65', '1581127281', '1581234734', '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('715', '235', '1581127724', '1581297071', '10.194.52.157', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('716', '233', '1581128736', '1581303150', '10.194.52.195', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('717', '251', '1581130366', '1581138962', '10.194.52.153', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('718', '261', '1581135495', '1581400037', '10.194.53.106', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('719', '258', '1581137027', '1581307916', '10.194.52.159', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('720', '241', '1581137646', '1581492600', '10.194.52.158', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('721', '331', '1581138465', '1581338543', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('722', '251', '1581138962', '1581138970', '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('723', '226', '1581138981', '1581139045', '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('724', '251', '1581139052', '1581141168', '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('725', '239', '1581140671', '1581157199', '10.194.52.178', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('726', '260', '1581141189', '1581296971', '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('727', '226', '1581145877', '1581297101', '10.194.52.175', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('728', '234', '1581148668', '1581297812', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('729', '248', '1581151032', '1581300890', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('730', '266', '1581152220', '1581152286', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('731', '317', '1581152297', '1581397638', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('732', '216', '1581152949', '1581415485', '10.194.52.156', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('733', '239', '1581157199', '1581296920', '10.194.52.178', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('734', '259', '1581162108', '1581167273', '10.194.52.188', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('735', '293', '1581168749', '1581260657', '10.194.52.188', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('736', '279', '1581218165', '1581260631', '10.194.52.184', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('737', '1', '1581234754', '1581298788', '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('738', '293', '1581260657', '1581298995', '10.194.52.184', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('739', '250', '1581291818', '1581331016', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('740', '245', '1581295529', '1581299516', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('741', '254', '1581295531', '1581383234', '10.194.53.106', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('742', '252', '1581295576', '1581380560', '10.194.53.108', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('743', '256', '1581295984', '1581388326', '10.194.53.109', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('744', '257', '1581296831', '1581382421', '10.194.52.171', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('745', '267', '1581296872', '1581388037', '10.194.53.97', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('746', '231', '1581296916', '1581467937', '10.194.52.169', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('747', '239', '1581296920', '1581317141', '10.194.52.170', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('748', '260', '1581296971', '1581324546', '10.194.52.157', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('749', '262', '1581297013', '1581387794', '10.194.53.105', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('750', '235', '1581297071', '1581299528', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('751', '226', '1581297101', '1581383195', '10.194.52.180', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('752', '230', '1581297124', '1581327714', '10.194.52.183', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('753', '237', '1581297364', '1581304270', '10.194.52.185', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('754', '210', '1581297789', '1581315889', '10.194.52.10', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('755', '234', '1581297812', '1581473724', '10.194.53.101', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('756', '213', '1581297830', '1581397407', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('757', '255', '1581297940', '1581398160', '10.194.52.189', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('758', '218', '1581298508', '1581384467', '10.194.52.188', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('759', '1', '1581298788', '1581299238', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('760', '243', '1581299006', '1581332410', '10.194.52.184', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('761', '1', '1581299238', '1581299264', '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('762', '1', '1581299426', '1581299598', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('763', '245', '1581299524', '1581380004', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('764', '235', '1581299549', '1581385233', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('765', '65', '1581299602', '1581299632', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('766', '350', '1581299641', '1581299669', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('767', '228', '1581299731', '1581326076', '10.194.52.176', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('768', '1', '1581299847', '1581299862', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('769', '1', '1581299862', '1581302149', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('770', '253', '1581300040', '1581383790', '10.194.52.173', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('771', '268', '1581300369', '1581470871', '10.194.52.193', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('772', '248', '1581300890', '1581384186', '10.194.52.165', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('773', '217', '1581301172', '1581382304', '10.194.52.182', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('774', '247', '1581301245', '1581382622', '10.194.52.166', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('775', '276', '1581301754', '1581302405', '10.194.53.93', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('776', '65', '1581301949', '1581302154', '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('777', '211', '1581302079', '1581338577', '10.194.52.155', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('778', '227', '1581302098', '1581302481', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('779', '65', '1581302154', '1581302206', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('780', '65', '1581302254', '1581302286', '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('781', '65', '1581302286', '1581302287', '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('782', '65', '1581302287', '1581302295', '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('783', '65', '1581302295', '1581302657', '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('784', '266', '1581302360', '1581387664', '10.194.53.94', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('785', '276', '1581302404', '1581376716', '10.194.53.93', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('786', '227', '1581302483', '1581312255', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('787', '244', '1581302485', '1581312678', '10.194.53.99', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('788', '65', '1581302657', '1581307258', '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('789', '271', '1581303144', '1581383685', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('790', '233', '1581303150', '1581324516', '10.194.52.156', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('791', '223', '1581303330', '1581304766', '10.194.53.92', 'Chrome 14.0.835.35', 'Windows 8', null);
INSERT INTO `sys_user_log_login` VALUES ('792', '237', '1581304270', '1581331024', '10.194.52.178', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('793', '223', '1581304782', '1581305904', '10.194.53.92', 'Chrome 14.0.835.35', 'Windows 8', null);
INSERT INTO `sys_user_log_login` VALUES ('794', '259', '1581305280', '1581345134', '10.194.53.91', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('795', '229', '1581306145', '1581337446', '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('796', '65', '1581307258', '1581327778', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('797', '275', '1581307633', '1581325934', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('798', '258', '1581307916', '1581389953', '10.194.52.152', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('799', '246', '1581308124', '1581381530', '10.194.53.95', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('800', '223', '1581312238', '1581312319', '10.194.53.92', 'Chrome 14.0.835.35', 'Windows 8', null);
INSERT INTO `sys_user_log_login` VALUES ('801', '227', '1581312257', '1581316387', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('802', '223', '1581312319', '1581383662', '10.194.53.92', 'Internet Explorer 11.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('803', '251', '1581312354', '1581340347', '10.194.52.161', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('804', '244', '1581312678', '1581327644', '10.194.53.99', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('805', '348', '1581313519', '1581314209', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('806', '348', '1581314188', '1581382764', '10.194.52.167', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('807', '210', '1581315888', '1581332251', '10.194.52.186', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('808', '227', '1581316389', '1581335741', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('809', '239', '1581317140', '1581319062', '10.194.52.170', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('810', '270', '1581319030', '1581381386', '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('811', '239', '1581319062', '1581383310', '10.194.52.170', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('812', '1', '1581319858', '1581319915', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('813', '1', '1581319942', '1581319975', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('814', '355', '1581319981', '1581320047', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('815', '355', '1581320047', '1581393237', '10.194.53.112', 'Firefox 56.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('816', '264', '1581322067', null, '10.194.53.98', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('817', '233', '1581324516', '1581388297', '10.194.52.156', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('818', '260', '1581324546', '1581325418', '10.194.52.157', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('819', '260', '1581325418', '1581326855', '10.194.52.157', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('820', '232', '1581325623', '1581327435', '10.194.52.168', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('821', '275', '1581325934', '1581337986', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('822', '228', '1581326076', '1581338762', '10.194.52.176', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('823', '260', '1581326855', '1581383120', '10.194.52.157', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('824', '232', '1581327436', '1581416564', '10.194.52.168', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('825', '244', '1581327644', null, '10.194.53.99', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('826', '230', '1581327723', '1581383504', '10.194.52.183', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('827', '65', '1581327778', '1581337053', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('828', '237', '1581331024', '1581345033', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('829', '210', '1581332251', '1581332401', '10.194.52.10', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('830', '243', '1581332410', '1581332523', '10.194.52.10', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('831', '1', '1581332458', '1581385010', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('832', '328', '1581335764', '1581336316', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('833', '227', '1581336319', '1581336674', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('834', '227', '1581336676', '1581393428', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('835', '210', '1581336879', '1581391089', '10.194.52.10', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('836', '65', '1581337053', '1581393267', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('837', '272', '1581337460', '1581337687', '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('838', '229', '1581337701', '1581337965', '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('839', '275', '1581337986', '1581338482', '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('840', '275', '1581338442', '1581338533', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('841', '224', '1581338534', '1581387573', '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('842', '331', '1581338543', null, '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('843', '272', '1581338586', '1581338812', '10.194.52.155', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('844', '229', '1581338603', '1581383287', '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('845', '228', '1581338762', '1581338784', '10.194.52.176', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('846', '228', '1581338784', '1581383434', '10.194.52.176', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('847', '211', '1581338821', '1581338833', '10.194.52.155', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('848', '211', '1581338841', '1581338911', '10.194.52.155', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('849', '237', '1581339361', '1581340338', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('850', '251', '1581340347', '1581383095', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('851', '293', '1581345055', '1581345099', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('852', '259', '1581345134', '1581387857', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('853', '276', '1581376716', '1581384391', '10.194.52.184', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('854', '245', '1581380004', '1581380026', '10.194.52.190', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('855', '220', '1581380035', '1581380144', '10.194.52.190', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('856', '302', '1581380154', '1581380194', '10.194.52.190', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('857', '220', '1581380203', '1581380344', '10.194.52.190', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('858', '245', '1581380343', '1581380550', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('859', '252', '1581380560', '1581380714', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('860', '245', '1581380729', '1581466659', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('861', '270', '1581381386', '1581381528', '10.194.52.190', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('862', '246', '1581381530', '1581381613', '10.194.52.190', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('863', '263', '1581381651', '1581382210', '10.194.52.190', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('864', '252', '1581381966', '1581397754', '10.194.53.108', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('865', '249', '1581381967', null, '10.194.53.100', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('866', '217', '1581382303', '1581382349', '10.194.52.190', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('867', '257', '1581382421', '1581480183', '10.194.52.171', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('868', '247', '1581382622', '1581382729', '10.194.52.166', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('869', '211', '1581382761', '1581382838', '10.194.52.166', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('870', '348', '1581382764', '1581399369', '10.194.52.167', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('871', '247', '1581383009', '1581383069', '10.194.52.166', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('872', '286', '1581383083', '1581383127', '10.194.52.166', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('873', '251', '1581383095', '1581397766', '10.194.52.161', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('874', '260', '1581383120', '1581469336', '10.194.52.157', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('875', '250', '1581383146', '1581467922', '10.194.52.158', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('876', '226', '1581383195', '1581471298', '10.194.52.180', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('877', '254', '1581383234', '1581469288', '10.194.53.106', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('878', '229', '1581383287', '1581469429', '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('879', '239', '1581383310', '1581479310', '10.194.52.170', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('880', '228', '1581383434', null, '10.194.52.176', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('881', '230', '1581383504', '1581387298', '10.194.52.183', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('882', '223', '1581383662', '1581470823', '10.194.53.92', 'Internet Explorer 11.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('883', '271', '1581383685', '1581476484', '10.194.52.164', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('884', '253', '1581383790', null, '10.194.52.173', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('885', '248', '1581384186', '1581386290', '10.194.52.165', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('886', '276', '1581384391', '1581469213', '10.194.53.93', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('887', '218', '1581384467', '1581470635', '10.194.52.188', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('888', '1', '1581385010', '1581407202', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('889', '235', '1581385233', '1581409502', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('890', '237', '1581385653', '1581419259', '10.194.52.178', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('891', '248', '1581386328', '1581472400', '10.194.52.165', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('892', '217', '1581386518', '1581469657', '10.194.52.182', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('893', '211', '1581386804', '1581471964', '10.194.52.155', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('894', '230', '1581387305', null, '10.194.52.183', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('895', '224', '1581387573', null, '10.194.52.162', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('896', '266', '1581387664', '1581397438', '10.194.53.94', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('897', '262', '1581387794', '1581472932', '10.194.53.105', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('898', '259', '1581387857', '1581422183', '10.194.53.91', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('899', '350', '1581388012', '1581403261', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('900', '267', '1581388037', '1581467385', '10.194.53.97', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('901', '247', '1581388060', '1581473067', '10.194.52.166', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('902', '233', '1581388297', null, '10.194.52.156', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('903', '256', '1581388326', '1581475483', '10.194.53.109', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('904', '246', '1581388490', '1581420097', '10.194.53.95', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('905', '258', '1581389953', '1581475277', '10.194.52.152', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('906', '210', '1581391089', '1581477611', '10.194.52.10', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('907', '243', '1581391746', '1581469034', '10.194.52.184', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('908', '355', '1581393236', '1581510837', '10.194.53.112', 'Firefox 56.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('909', '65', '1581393267', '1581395274', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('910', '227', '1581393429', '1581474732', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('911', '65', '1581395274', '1581405030', '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('912', '214', '1581395396', '1581468654', '10.194.52.195', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('913', '266', '1581397438', '1581397795', '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('914', '317', '1581397638', '1581403644', '10.194.53.94', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('915', '252', '1581397754', '1581397758', '10.194.52.161', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('916', '251', '1581397766', '1581397845', '10.194.52.161', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('917', '213', '1581397810', null, '10.194.52.154', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('918', '252', '1581397847', '1581399107', '10.194.52.161', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('919', '255', '1581398159', '1581416555', '10.194.52.189', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('920', '252', '1581399107', '1581466521', '10.194.53.108', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('921', '348', '1581399369', '1581401085', '10.194.52.167', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('922', '261', '1581400037', '1581468651', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('923', '348', '1581401085', '1581471003', '10.194.52.167', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('924', '350', '1581403261', '1581405023', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('925', '266', '1581403660', null, '10.194.53.94', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('926', '251', '1581404597', '1581469651', '10.194.52.161', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('927', '65', '1581405029', '1581414286', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('928', '263', '1581405829', '1581471259', '10.194.53.102', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('929', '347', '1581407211', '1581408243', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('930', '275', '1581407702', '1581421338', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('931', '1', '1581408255', '1581422176', '10.194.52.10', 'Firefox 72.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('932', '270', '1581408289', null, '10.194.53.103', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('933', '235', '1581409516', '1581469333', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('934', '274', '1581413294', '1581503243', '10.194.52.151', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('935', '65', '1581414286', '1581483866', '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('936', '216', '1581415485', null, '10.194.52.159', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('937', '232', '1581416564', '1581416924', '10.194.52.168', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('938', '237', '1581419259', '1581429616', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('939', '246', '1581420097', '1581420177', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('940', '275', '1581421338', '1581471574', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('941', '293', '1581422198', '1581427990', '10.194.53.91', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('942', '246', '1581424002', '1581424041', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('943', '246', '1581424946', '1581424967', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('944', '259', '1581426322', '1581427973', '10.194.52.200', 'Chrome 78.0.3904.108', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('945', '293', '1581427990', '1581432166', '10.194.52.200', 'Chrome 78.0.3904.108', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('946', '279', '1581429619', '1581490158', '10.194.52.10', 'Chrome 80.0.3987.87', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('947', '259', '1581432204', '1581472463', '10.194.52.200', 'Chrome 78.0.3904.108', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('948', '252', '1581466521', '1581481240', '10.194.53.108', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('949', '245', '1581466659', '1581504575', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('950', '267', '1581467385', '1581467774', '10.194.53.97', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('951', '267', '1581467781', '1581467923', '10.194.53.97', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('952', '250', '1581467922', null, '10.194.52.158', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('953', '231', '1581467937', '1581468086', '10.194.53.97', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('954', '267', '1581468088', null, '10.194.53.97', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('955', '261', '1581468651', null, '10.194.52.194', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('956', '214', '1581468653', '1581506000', '10.194.52.195', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('957', '243', '1581469034', '1581503266', '10.194.52.184', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('958', '276', '1581469213', null, '10.194.53.93', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('959', '254', '1581469288', null, '10.194.53.106', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('960', '235', '1581469333', '1581471219', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('961', '260', '1581469335', null, '10.194.52.157', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('962', '229', '1581469429', null, '10.194.52.174', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('963', '251', '1581469651', '1581488415', '10.194.52.161', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('964', '217', '1581469657', null, '10.194.52.182', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('965', '218', '1581470635', null, '10.194.52.188', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('966', '223', '1581470823', '1581483877', '10.194.53.92', 'Internet Explorer 11.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('967', '237', '1581470843', null, '10.194.52.178', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('968', '268', '1581470874', null, '10.194.52.193', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('969', '348', '1581471003', '1581481065', '10.194.52.167', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('970', '350', '1581471019', null, '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('971', '235', '1581471240', '1581471346', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('972', '263', '1581471259', null, '10.194.53.102', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('973', '226', '1581471298', null, '10.194.52.180', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('974', '1', '1581471304', '1581485166', '10.194.52.10', 'Firefox 73.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('975', '235', '1581471357', '1581493318', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('976', '275', '1581471574', '1581471622', '10.194.52.153', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('977', '275', '1581471622', '1581491543', '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('978', '211', '1581471964', '1581485245', '10.194.52.155', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('979', '248', '1581472399', '1581500056', '10.194.52.165', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('980', '259', '1581472463', null, '10.194.53.91', 'Chrome 56.0.2924.76', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('981', '351', '1581472718', null, '10.194.52.10', 'Chrome 80.0.3987.100', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('982', '262', '1581472932', null, '10.194.53.105', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('983', '247', '1581473067', '1581480702', '10.194.52.166', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('984', '352', '1581473410', null, '10.194.53.112', 'Firefox 56.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('985', '234', '1581473724', null, '10.194.53.101', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('986', '227', '1581474732', '1581479624', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('987', '246', '1581474764', '1581503467', '10.194.53.95', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('988', '258', '1581475277', null, '10.194.52.152', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('989', '256', '1581475483', null, '10.194.53.109', 'Firefox 50.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('990', '271', '1581476484', '1581484662', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('991', '210', '1581477610', null, '10.194.52.198', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('992', '231', '1581478505', null, '10.194.52.169', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('993', '239', '1581479310', null, '10.194.52.170', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('994', '227', '1581479626', '1581503265', '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('995', '257', '1581480207', '1581480241', '10.194.52.171', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('996', '257', '1581480244', null, '10.194.52.171', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('997', '247', '1581480704', '1581484910', '10.194.52.166', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('998', '255', '1581480937', '1581481571', '10.194.52.189', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('999', '252', '1581481242', null, '10.194.53.108', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1000', '348', '1581481361', null, '10.194.52.167', 'Firefox 60.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1001', '65', '1581483866', '1581484947', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1002', '223', '1581483903', null, '10.194.53.92', 'Internet Explorer 11.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1003', '271', '1581484668', '1581486460', '10.194.52.10', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1004', '247', '1581484910', '1581484942', '10.194.52.10', 'Chrome 80.0.3987.100', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1005', '65', '1581484947', '1581498733', '10.194.52.10', 'Chrome 80.0.3987.100', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1006', '1', '1581485166', '1581485642', '10.194.52.10', 'Firefox 73.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('1007', '211', '1581485252', null, '10.194.52.155', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1008', '255', '1581485414', null, '10.194.52.189', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1009', '296', '1581485646', null, '10.194.52.10', 'Firefox 73.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('1010', '271', '1581486460', null, '10.194.52.200', 'Chrome 78.0.3904.108', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1011', '251', '1581488415', '1581490532', '10.194.52.161', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1012', '279', '1581490158', null, '10.194.52.10', 'Chrome 80.0.3987.100', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1013', '251', '1581490532', null, '10.194.52.161', 'Firefox 45.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1014', '275', '1581491543', null, '10.194.52.153', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('1015', '241', '1581492600', null, '10.194.52.163', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1016', '235', '1581493333', '1581503159', '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1017', '1', '1581495947', '1581501450', '10.194.52.10', 'Firefox 73.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('1018', '248', '1581500066', null, '10.194.52.165', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1019', '65', '1581500450', '1581501379', '10.194.52.203', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1020', '247', '1581501347', '1581557098', '10.194.52.166', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1021', '65', '1581501378', '1581501385', '10.194.52.10', 'Chrome 80.0.3987.100', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1022', '65', '1581501384', '1581557090', '10.194.52.10', 'Chrome 80.0.3987.100', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1023', '1', '1581501450', null, '10.194.52.10', 'Firefox 73.0', 'Windows 7', null);
INSERT INTO `sys_user_log_login` VALUES ('1024', '235', '1581503223', null, '10.194.53.104', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1025', '227', '1581503271', null, '10.194.52.179', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1026', '246', '1581503467', '1581504108', '10.194.53.95', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1027', '243', '1581503877', null, '10.194.52.184', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1028', '245', '1581504575', '1581557738', '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1029', '347', '1581504863', '1581557256', '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('1030', '355', '1581510837', null, '10.194.53.112', 'Firefox 56.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1031', '65', '1581557090', null, '10.194.52.203', 'Firefox 72.0', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1032', '247', '1581557098', null, '10.194.52.166', 'Chrome 78.0.3904.70', 'Windows 10', null);
INSERT INTO `sys_user_log_login` VALUES ('1033', '347', '1581557256', null, '10.194.52.10', 'Firefox 52.0', 'Windows XP', null);
INSERT INTO `sys_user_log_login` VALUES ('1034', '221', '1581557318', null, '10.194.52.190', 'Chrome 38.0.2125.104', 'Windows 8.1', null);
INSERT INTO `sys_user_log_login` VALUES ('1035', '245', '1581557738', null, '10.194.53.107', 'Chrome 78.0.3904.70', 'Windows 10', null);

-- ----------------------------
-- Table structure for sys_user_upload
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_upload`;
CREATE TABLE `sys_user_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `file_path` varchar(200) DEFAULT NULL,
  `orig_name` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `ext` varchar(10) DEFAULT NULL,
  `time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `iuser` (`id_user`,`time`) USING BTREE,
  KEY `iid` (`id`) USING BTREE,
  KEY `iex` (`id_user`,`ext`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_user_upload
-- ----------------------------

-- ----------------------------
-- Table structure for sys_user_upload_temp
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_upload_temp`;
CREATE TABLE `sys_user_upload_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `file_path` varchar(200) DEFAULT NULL,
  `orig_name` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `ext` varchar(10) DEFAULT NULL,
  `time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `iuser` (`id_user`,`time`) USING BTREE,
  KEY `iid` (`id`) USING BTREE,
  KEY `iex` (`id_user`,`ext`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_user_upload_temp
-- ----------------------------
INSERT INTO `sys_user_upload_temp` VALUES ('1', '1', './upload_files/none/', 'Untitled-1.png', '169d6b5489f23d3166f9ecf056a5c348.png', '.png', '1581407194');

-- ----------------------------
-- Table structure for sys_userlogin
-- ----------------------------
DROP TABLE IF EXISTS `sys_userlogin`;
CREATE TABLE `sys_userlogin` (
  `iduser` int(11) NOT NULL,
  `tokenserial` char(100) NOT NULL,
  `login_time` char(30) DEFAULT NULL,
  PRIMARY KEY (`iduser`) USING BTREE,
  KEY `iiduser` (`iduser`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_userlogin
-- ----------------------------
INSERT INTO `sys_userlogin` VALUES ('1', 'e2123eff8a01d9866b2528e1b672ac0f', '1581501450');
INSERT INTO `sys_userlogin` VALUES ('2', 'f48ec8caa00e8fb4fe0f9fb4c15af74a', '1579586252');
INSERT INTO `sys_userlogin` VALUES ('65', '7ed7ee008368ef944959637e5b4345d9', '1581557090');
INSERT INTO `sys_userlogin` VALUES ('210', '1858c68b25832be764aea83b8b7aa862', '1581477610');
INSERT INTO `sys_userlogin` VALUES ('211', 'cf340270490eb2edc8807897f553978a', '1581485252');
INSERT INTO `sys_userlogin` VALUES ('213', 'ce64b9d033efff734d16f02d43898ead', '1581397810');
INSERT INTO `sys_userlogin` VALUES ('214', '9e893975e257a5802522e259fc827f15', '1581468653');
INSERT INTO `sys_userlogin` VALUES ('216', '0552aff1c9440f5514a42ccdef323197', '1581415485');
INSERT INTO `sys_userlogin` VALUES ('217', '463f121421edda59309dcebfccdc25c1', '1581469657');
INSERT INTO `sys_userlogin` VALUES ('218', '46eade94e9337d5c2b33f6323d7f22ce', '1581470635');
INSERT INTO `sys_userlogin` VALUES ('219', 'd5530d279be78e95b0d7acbb93aa1d27', '1581063520');
INSERT INTO `sys_userlogin` VALUES ('220', 'bcb03e211bd3b269a8eb51dc4bc5a6aa', '1581380203');
INSERT INTO `sys_userlogin` VALUES ('221', 'b305ba51a49fc338d09e698a68348574', '1581557318');
INSERT INTO `sys_userlogin` VALUES ('223', '00533530f91bfcb985369f520638339e', '1581483903');
INSERT INTO `sys_userlogin` VALUES ('224', '10aef33f5b6c37f5a7c0f55767b33048', '1581387573');
INSERT INTO `sys_userlogin` VALUES ('225', 'bd79b11364487c92eeb3cd27f23526cb', '1581043545');
INSERT INTO `sys_userlogin` VALUES ('226', '67af2e043ce98f9f40bec3e45317ab05', '1581471298');
INSERT INTO `sys_userlogin` VALUES ('227', 'fa920056ee8ac20e27fbf888589663bb', '1581503271');
INSERT INTO `sys_userlogin` VALUES ('228', '4468d83a1d84c5bc4b219f8ae6756026', '1581383434');
INSERT INTO `sys_userlogin` VALUES ('229', '09eb3d61cacf0467960a0faf6799fea0', '1581469429');
INSERT INTO `sys_userlogin` VALUES ('230', 'bb1aa1d936b8d819e434061b91b1d709', '1581387305');
INSERT INTO `sys_userlogin` VALUES ('231', '6ac2563ff91671e9a5138c3bffaef274', '1581478505');
INSERT INTO `sys_userlogin` VALUES ('232', '6df107d7bb714f40f8f97c2adc7519d0', '1581416564');
INSERT INTO `sys_userlogin` VALUES ('233', '079719958c819ca3985cea1f49478adf', '1581388297');
INSERT INTO `sys_userlogin` VALUES ('234', '6fd454e3f596fc61754dbb201cb5b27f', '1581473724');
INSERT INTO `sys_userlogin` VALUES ('235', '93b223ffbdf8e857daf5265adcb16f41', '1581503223');
INSERT INTO `sys_userlogin` VALUES ('236', '537c5c2787dd2c63599cc85c36720d20', '1581045779');
INSERT INTO `sys_userlogin` VALUES ('237', '32dbcf89a53047a6e81b203be3d77f81', '1581470843');
INSERT INTO `sys_userlogin` VALUES ('238', 'd004a9f2bc1a2e46cfb7b00c735246ba', '1581043016');
INSERT INTO `sys_userlogin` VALUES ('239', '1ce191f5def65081e6744c25579a9595', '1581479310');
INSERT INTO `sys_userlogin` VALUES ('240', '5a06b37de7b8701fcc64cf81daa18373', '1580871072');
INSERT INTO `sys_userlogin` VALUES ('241', '386b42b4ec2d7c63fb8231df0da7e4b1', '1581492600');
INSERT INTO `sys_userlogin` VALUES ('242', 'c80c9bd31db8ed227b1b13759f870033', '1581062588');
INSERT INTO `sys_userlogin` VALUES ('243', '22ce196ef512a369e987dc107988339b', '1581503877');
INSERT INTO `sys_userlogin` VALUES ('244', '0df76e901ec1ddccebbc07914fc56bc2', '1581327644');
INSERT INTO `sys_userlogin` VALUES ('245', 'b7fd3a8dae07feddde0ea682a7a128b5', '1581557738');
INSERT INTO `sys_userlogin` VALUES ('246', '0f2ed76f645cf8f6e14637afb5e8c23d', '1581503467');
INSERT INTO `sys_userlogin` VALUES ('247', 'c390a2dad856d7a7922529ef017d4021', '1581557098');
INSERT INTO `sys_userlogin` VALUES ('248', '2fbaa5719e21c53bb4649e30499cf580', '1581500066');
INSERT INTO `sys_userlogin` VALUES ('249', 'b2a5688a24ab1a45ac1c98ffb0250ebf', '1581381967');
INSERT INTO `sys_userlogin` VALUES ('250', '57b1f8f68a4ed57e3145b7c347624cc6', '1581467922');
INSERT INTO `sys_userlogin` VALUES ('251', 'c5bacff7ab5cdeaa49974efe2351e796', '1581490532');
INSERT INTO `sys_userlogin` VALUES ('252', 'de1f731c6cac9cc5fb05974ee0040167', '1581481242');
INSERT INTO `sys_userlogin` VALUES ('253', '78a6674f72bf56b0db7aaa5281682498', '1581383790');
INSERT INTO `sys_userlogin` VALUES ('254', '5c1e6b9e2d2783cde21508df9a47cd7d', '1581469288');
INSERT INTO `sys_userlogin` VALUES ('255', '95e81c36d928cb3a27b22a0619052a30', '1581485414');
INSERT INTO `sys_userlogin` VALUES ('256', '876c8727a02ad1826faeb6cd9fd4cbbc', '1581475483');
INSERT INTO `sys_userlogin` VALUES ('257', '8f6b692f2db5fa667b90e9332068358d', '1581480244');
INSERT INTO `sys_userlogin` VALUES ('258', '58e5cdb634cdfc82805cd080f699c146', '1581475277');
INSERT INTO `sys_userlogin` VALUES ('259', 'c7c97454ca2df69d0bd59a060d98ff15', '1581472463');
INSERT INTO `sys_userlogin` VALUES ('260', '320a835a712715aaef994faae58508bf', '1581469335');
INSERT INTO `sys_userlogin` VALUES ('261', '354d3b5d05d8306fd9f590b704a23a09', '1581468651');
INSERT INTO `sys_userlogin` VALUES ('262', '0a4063dd7d2f5e045b0d583fae484a89', '1581472932');
INSERT INTO `sys_userlogin` VALUES ('263', '75122075d7bcbd69e62462cb0bf0042f', '1581471259');
INSERT INTO `sys_userlogin` VALUES ('264', '2af2cb34a179259b0c09cdc6a8978cf0', '1581322067');
INSERT INTO `sys_userlogin` VALUES ('265', '65f221465358d26a390b97b7eada7c59', '1580899257');
INSERT INTO `sys_userlogin` VALUES ('266', 'f8897a244f95ff6815e6d5b453231593', '1581403660');
INSERT INTO `sys_userlogin` VALUES ('267', '582cee2ab7e97de15d3a4f69a5fe20b4', '1581468088');
INSERT INTO `sys_userlogin` VALUES ('268', '7955a83eec2fef1360e373117106b78b', '1581470874');
INSERT INTO `sys_userlogin` VALUES ('269', '6f985ce00dfdb5d16fa8883087542bc9', '1581043097');
INSERT INTO `sys_userlogin` VALUES ('270', '32606821390c61dc865e0d443079762e', '1581408289');
INSERT INTO `sys_userlogin` VALUES ('271', 'ea1abb3f831f7516d33e5cdd219b6cb0', '1581486460');
INSERT INTO `sys_userlogin` VALUES ('272', '2c9c71fe811abdbc419f481d8d91a82b', '1581338586');
INSERT INTO `sys_userlogin` VALUES ('273', '6101e080d96231b4504128772b56642a', '1581055813');
INSERT INTO `sys_userlogin` VALUES ('274', '3df5bcabf21deb0fd363646cbf089ab5', '1581413294');
INSERT INTO `sys_userlogin` VALUES ('275', '55b4666d1714e119cf18720514381aa3', '1581491543');
INSERT INTO `sys_userlogin` VALUES ('276', 'c926b6aba32d8c09695d87b16620394c', '1581469213');
INSERT INTO `sys_userlogin` VALUES ('277', 'ce78e18a442826e25f64278e9219295c', '1580870703');
INSERT INTO `sys_userlogin` VALUES ('279', '7ec9e41098390a194519bb8b5a5175c4', '1581490158');
INSERT INTO `sys_userlogin` VALUES ('280', 'c801937d83b2027dc5afaf8e634ec195', '1581045660');
INSERT INTO `sys_userlogin` VALUES ('281', '52f78534cdd6124c49eff39a42501b47', '1581077693');
INSERT INTO `sys_userlogin` VALUES ('282', '5f385f1605528e85796a41ba267aea42', '1581040819');
INSERT INTO `sys_userlogin` VALUES ('283', '9474ce038d8b1217d28b0eb49c142dc8', '1581054282');
INSERT INTO `sys_userlogin` VALUES ('285', '17047b85ba6851b385056ae78ca7fd66', '1580719048');
INSERT INTO `sys_userlogin` VALUES ('286', '72a4625b414e8ef439fd385d7e00160e', '1581383083');
INSERT INTO `sys_userlogin` VALUES ('288', 'dc5abea9fcde497662d80905715ffad1', '1580267601');
INSERT INTO `sys_userlogin` VALUES ('289', '3b60006bf14ab24ebda9d4960a6bf17c', '1580732282');
INSERT INTO `sys_userlogin` VALUES ('293', 'e893d5ed5029ea447f727135c7e32529', '1581427990');
INSERT INTO `sys_userlogin` VALUES ('296', '85ee5f8720850cee0399e71bca5284db', '1581485646');
INSERT INTO `sys_userlogin` VALUES ('302', '60a6b000d1b97e6fc441ead0ab4bf5fc', '1581380154');
INSERT INTO `sys_userlogin` VALUES ('306', 'b52ed94477d50518e7984d51e527c5fe', '1579574022');
INSERT INTO `sys_userlogin` VALUES ('313', '471d4120ec1052d612cd1b930c0f7fd7', '1580991525');
INSERT INTO `sys_userlogin` VALUES ('317', '11ce36cea3f26022e499d8e2ddd1aff3', '1581397638');
INSERT INTO `sys_userlogin` VALUES ('321', '8fc1221d31bc9c90deec5bc5252a03c6', '1581069793');
INSERT INTO `sys_userlogin` VALUES ('328', '6cee2b01bc025b89ca159cc5f9ada036', '1581335764');
INSERT INTO `sys_userlogin` VALUES ('331', 'd7e1d7830b850c473df1c210990ad4f5', '1581338543');
INSERT INTO `sys_userlogin` VALUES ('332', '181c2c91e4b735ea4463114943d3a9a6', '1581079245');
INSERT INTO `sys_userlogin` VALUES ('333', 'a1e6bc8245686432c58280c7823720a8', '1580871596');
INSERT INTO `sys_userlogin` VALUES ('347', 'df70026ab1dd603b31cce661bd524822', '1581557256');
INSERT INTO `sys_userlogin` VALUES ('348', 'bac4995420634df7796147abc4154029', '1581481361');
INSERT INTO `sys_userlogin` VALUES ('350', '4076a76805555c029b79ccaafffcf77a', '1581471019');
INSERT INTO `sys_userlogin` VALUES ('351', '637f170a5a8f20f57588420f1448a2db', '1581472718');
INSERT INTO `sys_userlogin` VALUES ('352', 'cc22198de30e53c7abfb08a56e34c0c7', '1581473410');
INSERT INTO `sys_userlogin` VALUES ('355', '5a424c78481cb47554a86c2a2fb2b1d1', '1581510837');

-- ----------------------------
-- Table structure for tahun
-- ----------------------------
DROP TABLE IF EXISTS `tahun`;
CREATE TABLE `tahun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tahun
-- ----------------------------
INSERT INTO `tahun` VALUES ('1', '2018');
INSERT INTO `tahun` VALUES ('2', '2019');
INSERT INTO `tahun` VALUES ('3', '2020');
