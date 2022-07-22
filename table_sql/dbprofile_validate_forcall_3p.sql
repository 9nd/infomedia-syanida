/*
Navicat MySQL Data Transfer

Source Server         : Infomedia
Source Server Version : 50173
Source Host           : 10.194.194.61:3306
Source Database       : db_profiling

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2020-02-07 16:46:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dbprofile_validate_forcall_3p
-- ----------------------------
DROP TABLE IF EXISTS `dbprofile_validate_forcall_3p`;
CREATE TABLE `dbprofile_validate_forcall_3p` (
  `ncli` int(11) DEFAULT NULL,
  `no_pstn` varchar(12) DEFAULT NULL,
  `no_speedy` varchar(15) DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `relasi` varchar(40) DEFAULT NULL,
  `no_handpone` varchar(55) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nama_pastel` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `KOTA` varchar(100) DEFAULT NULL,
  `regional` varchar(3) DEFAULT NULL,
  `update_by` varchar(15) DEFAULT NULL,
  `lup` datetime DEFAULT NULL,
  `sumber` varchar(15) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `is_3p` varchar(5) DEFAULT NULL,
  `reason_call` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `status2` int(11) DEFAULT NULL,
  `status3` int(11) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `no_tgl` datetime DEFAULT NULL,
  `email_veri` varchar(50) DEFAULT NULL,
  `email_kirim` datetime DEFAULT NULL,
  `email_terima` datetime DEFAULT NULL,
  `email_status` int(11) DEFAULT NULL,
  `no_hp_veri` varchar(55) DEFAULT NULL,
  `hp_kirim` datetime DEFAULT NULL,
  `hp_terima` datetime DEFAULT NULL,
  `hp_status` int(11) DEFAULT NULL,
  `verified_lama` int(11) DEFAULT NULL,
  KEY `idx_status` (`status`),
  KEY `idx_userid` (`update_by`),
  KEY `idx_notel` (`no_pstn`,`no_speedy`),
  KEY `idx_ncli` (`ncli`),
  KEY `idx_tglupdate` (`tgl_update`),
  KEY `no_tgl` (`no_tgl`),
  KEY `no_speedy` (`no_speedy`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
