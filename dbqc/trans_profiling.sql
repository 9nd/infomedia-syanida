/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : trans_profiling

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 27/07/2022 14:40:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for trans_profiling
-- ----------------------------
DROP TABLE IF EXISTS `trans_profiling`;
CREATE TABLE `trans_profiling`  (
  `idx` bigint NOT NULL AUTO_INCREMENT,
  `ncli` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nama` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pstn1` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `no_speedy` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kepemilikan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `facebook` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `verfi_fb` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `twitter` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `verfi_twitter` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `relasi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `verfi_email` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lup_email` datetime(0) NULL DEFAULT NULL,
  `email_lain` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `handphone` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `verfi_handphone` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lup_handphone` datetime(0) NULL DEFAULT NULL,
  `nama_pastel` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kota` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `waktu_psb` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kec_speedy` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `billing` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `payment` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_lahir` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT 0,
  `profiling_by` int NULL DEFAULT 0,
  `click_sms` int NULL DEFAULT 0,
  `click_email` int NULL DEFAULT 0,
  `ip_address` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `date_created` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `hub_pemilik` int NULL DEFAULT 0,
  `veri_distribusi` datetime(0) NOT NULL,
  `veri_count` int NULL DEFAULT 0,
  `veri_status` int NULL DEFAULT 0,
  `veri_call` int NULL DEFAULT 0,
  `veri_keterangan` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `veri_upd` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `veri_lup` datetime(0) NULL DEFAULT NULL,
  `lup` timestamp(0) NULL DEFAULT NULL,
  `click_session` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `division` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `witel` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kandatel` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `regional` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `veri_system` int NULL DEFAULT 0,
  `nik` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `no_kk` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nama_ibu_kandung` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `path` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `instagram` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `handphone_lain` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `opsi_call` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idx`) USING BTREE,
  INDEX `idx_pstn1`(`pstn1`) USING BTREE,
  INDEX `idx_upd`(`veri_upd`) USING BTREE,
  INDEX `idx_ncli`(`ncli`) USING BTREE,
  INDEX `idx_id`(`idx`) USING BTREE,
  INDEX `idx_lup`(`lup`) USING BTREE,
  INDEX `index_custom`(`pstn1`, `veri_upd`, `ncli`) USING BTREE,
  INDEX `dui`(`veri_upd`) USING BTREE,
  INDEX `idx_sessions`(`click_session`) USING BTREE,
  FULLTEXT INDEX `idx_session`(`click_session`)
) ENGINE = InnoDB AUTO_INCREMENT = 59888473 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_profiling
-- ----------------------------
INSERT INTO `trans_profiling` VALUES (51110394, '37026844', 'NGADIMAN', '07333280368', '111732103932', 'Pemilik', '', NULL, '', NULL, NULL, 'ngadiman82@gmail.com', '1435', NULL, '', '082177553305', '8135', NULL, 'NGADIMAN', 'JL DEMPO No.0 RT 0/0 KEL AIR PUTIH KEC LUBUK LINGGAU YTIMUR I LUBUK LINGGAU SUMSEL, 31621', 'LUBUK LINGGAU', '03-2018', '30', '349650', 'Banking - DB', NULL, 1, 0, 0, 0, '10.194.52.140', '2020-11-16 14:02:08', 0, '0000-00-00 00:00:00', 0, 1, 13, 'L/082177553305', 'MA0597', '2022-07-05 15:32:21', '2022-07-05 15:32:21', '1116141J8O750CY', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '', '4');
INSERT INTO `trans_profiling` VALUES (51260007, '4559952', 'SEPTI RAHAYU', '02174708903', '122212205722', 'Pemilik', '', NULL, '', NULL, NULL, '', '', NULL, '', '081218265055', '6510', NULL, 'SEPTI RAHAYU', 'JL PINUS RAYA B5 6 PAMULANG TIMUR CIPUTAT TANGERANG SELATAN 15417', 'TANGERANG SELATAN', '07-2009', '40', '469086', 'Banking - DB', NULL, 1, 0, 0, 0, '10.194.52.109', '2020-11-23 18:07:31', 0, '0000-00-00 00:00:00', 0, 1, 13, 'P/081218265055', 'LE9194', '2022-07-05 09:46:13', '2022-07-05 09:46:13', '112318137ZSQCHY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '4');

SET FOREIGN_KEY_CHECKS = 1;
