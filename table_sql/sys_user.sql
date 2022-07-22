/*
 Navicat Premium Data Transfer

 Source Server         : DATA
 Source Server Type    : MySQL
 Source Server Version : 50616
 Source Host           : localhost:3306
 Source Schema         : trans_profiling

 Target Server Type    : MySQL
 Target Server Version : 50616
 File Encoding         : 65001

 Date: 07/02/2020 10:13:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nmuser` char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `passuser` char(100) CHARACTER SET latin1 COLLATE latin1_bin NULL DEFAULT NULL,
  `opt_level` int(11) NULL DEFAULT NULL COMMENT '1=admin',
  `opt_status` int(5) NULL DEFAULT NULL COMMENT '0=nonaktif,1=aktif, 2 = delete',
  `picture` char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NULL DEFAULT NULL,
  `agentid` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NULL DEFAULT NULL,
  `kategori` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NULL DEFAULT NULL,
  `tl` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `iopt_level`(`opt_level`) USING BTREE,
  INDEX `iagentid`(`agentid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 355 CHARACTER SET = latin1 COLLATE = latin1_general_cs ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES (1, 'administrator', '6841837e293c824a4d60b4b1217e1d28', 1, 1, '1xx_xx1580177380.jpg', 'Ahmad Sadikin', 'A001', '', NULL);
INSERT INTO `sys_user` VALUES (65, 'sv', 'ba2bd7bd967cd67daa3069d05f77ad8e', 7, 1, 'default.png', 'Ahmad Sadikin', '-', '-', NULL);
INSERT INTO `sys_user` VALUES (210, 'AF6540', '0cd02e311680ba280b55b3b3205d0929', 8, 1, '210xx_xx1580350049.jpg', 'AFIFATUL AZIZAH', 'AF6540', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (211, 'LE9194', 'e3be8d1aca8cb231977dc6867076c373', 8, 1, '211xx_xx1581042791.jpg', 'LISNA PUJIARTI', 'LE9194', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (212, 'EG0992', '7c4bc6065155dcd3481d79f4be00e369', 8, 1, 'default.png', 'M. HAFIZ AL FAUZAN', 'EG0992', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (213, 'MI1495', 'd7ef69fd738a6a6b861a06cb361f5a30', 8, 1, 'default.png', 'MUHAMMAD INDRA DWI LAKSANA', 'MI1495', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (214, 'DA1096', '4231d85be2f7993ac6f0cad356bab110', 8, 1, 'default.png', 'DIMAS PRADITYA AJI', 'DA1096', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (215, 'IN0812', 'f74851f06324f59b9ed62efa8ebb5980', 8, 1, 'default.png', 'MIA RAHMIYATI', 'IN0812', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (216, 'RM130994', 'aede56e8d09919b3f59508e9baf806fb', 8, 1, '216xx_xx1581044443.jpg', 'NIRA FITRIAH', 'RM130994', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (217, 'RA2708', '8ffd26ac7f91aa3bcbac6c545db94551', 8, 1, '217xx_xx1581044484.jpg', 'ANNISA', 'RA2708', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (218, 'VF0194', 'a31642e369928d0bb58d6fe66a983ac6', 8, 1, 'default.png', 'VINA FEBRIANI', 'VF0194', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (219, 'AR180293', '0702eb0cb74cfeca4c5ef2e7cc5c26ae', 9, 1, 'default.png', 'ASTI RAMDHIAN', 'AR180293', 'TL', '-');
INSERT INTO `sys_user` VALUES (220, 'DE7748', 'ae4339000efc7d480a0379b282728df2', 8, 1, 'default.png', 'DENI YUDISTIRA', 'DE7748', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (221, 'DR2891', '0396c53cc9568bbb34e272d409fd6e9a', 8, 1, 'default.png', 'DERRY SEPTIANA AR', 'DR2891', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (222, 'BDGCTS_026', 'a71007de71a0caa933e74cf854eefa20', 8, 1, 'default.png', 'NUGRAHA NASRULLOH', 'BDGCTS_026', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (223, 'BDG_004', 'ddf7bb4473f083ead5bcba29444a8dab', 8, 1, 'default.png', 'RACHMAT MULDANI', 'BDG_004', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (224, 'RR0790', '1cf0e4c2cb5007574f9c9bdf1aab74f8', 8, 1, 'default.png', 'RATIH RAHMAWATI', 'RR0790', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (225, 'AI0292', '6046ce5d4153fc942e1f38c57380f4db', 8, 1, '225xx_xx1581044158.jpg', 'ARIEF IMAN PRASETYO', 'AI0292', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (226, 'DH1297', '28c1da774eaeea2c80897210d1a68c67', 8, 1, '226xx_xx1580874418.jpg', 'DIDAH HALIYAH', 'DH1297', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (227, 'DP0395', 'e0598c8374368eb38ebb0c8b30802897', 8, 1, '227xx_xx1581043001.jpg', 'DICKY PERMANA', 'DP0395', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (228, 'ME2205', '59a83e986330c7edf6b922385055a327', 8, 1, 'default.png', 'DWINA ANISAH GHAIDA', 'ME2205', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (229, 'FS0796', 'bc6e7669ae59186e3f2bcf156ca918a3', 8, 1, 'default.png', 'FIRDA SRI RAHMAYANTI', 'FS0796', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (230, 'NI3506', 'd16151907afae71400f925106588bcb9', 8, 1, 'default.png', 'AGHNIA AUDINA NUR SOLEHAH', 'NI3506', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (231, 'HA2312', '85c12eed04f6a9a7b7e65b5464c441aa', 8, 1, 'default.png', 'HANNA DELAVINA', 'HA2312', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (232, 'BDGCTS_048', '8c717e926b9b5f4d86f4e6318dd6f1c1', 8, 1, 'default.png', 'ISMAYANTI', 'BDGCTS_048', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (233, 'AF1204', 'c6b897e423a04a62443f78ebb07ff9a2', 8, 1, 'default.png', 'KARLINA', 'AF1204', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (234, 'KA1095', 'dd1e89e5e5eb2c7fd02ead9ae2e8a7ba', 8, 1, '234xx_xx1580872742.jpg', 'KARIN ARINDA PRAMUDHYTA', 'KA1095', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (235, 'SI0944', '67c1f29d86555d317e401e3bb9321114', 8, 1, 'default.png', 'RIA ANDRIYANI', 'SI0944', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (236, 'RA5494', '3d3a3090641c158413a0c26e81ab7c4b', 8, 1, '236xx_xx1581044538.jpg', 'RAHMAWATI ZAKIYAH', 'RA5494', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (237, 'SP2089', 'da4f62c31f793a1a7ff0057ffe176b39', 8, 1, 'default.png', 'ARIEF DHARMA SAPUTRA', 'SP2089', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (238, 'GG1090', '1244e4d8fc2e55d797bce43c918680d2', 8, 1, '238xx_xx1581043026.jpg', 'GILANG GINANJAR', 'GG1090', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (239, 'NI1303', '925b1d06cc6e89a502e205b413966c08', 8, 1, 'default.png', 'GITA BONITA', 'NI1303', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (240, 'HH0189', 'e8002c130640c446a675aecdad535599', 8, 1, 'default.png', 'HARY HAIDAR LATIEF', 'HH0189', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (241, 'PI1080', '9788be3444d3c8b225a5ccfa71313b01', 8, 1, '241xx_xx1580874494.jpg', 'PENDI', 'PI1080', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (242, 'BDGCTS_001', 'b5de02e602ced0c97e22d77518dce42a', 8, 1, 'default.png', 'RIZKI NUR FADHILAH', 'BDGCTS_001', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (243, 'DH4489', 'd8143d8d93859b81f72bd1db71a87795', 8, 1, 'default.png', 'ROHIMAH', 'DH4489', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (244, 'DI2202', 'b7cc25fb9a6a4dcc01edbfd186dd4f77', 8, 1, 'default.png', 'SHERA AMALIA', 'DI2202', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (245, 'SI0872', '1f0eb4f5c19e1e0ab49a56e04192ad72', 8, 1, '245xx_xx1581042756.jpg', 'SINTA DEWI SETIAWATI', 'SI0872', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (246, 'RF0994', 'b3208b6334fe5ce161f6a911319e4820', 8, 1, '246xx_xx1581042913.jpg', 'RIESLA FAUZI RACHMAN', 'RF0994', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (247, 'CH1101', '206fe5a9d1e26db28e2ab8fe37a3cdc7', 8, 1, '247xx_xx1581042885.jpg', 'SRI LESTARI', 'CH1101', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (248, 'TI2508', 'd6e1d2094f409c28dddbcf0062c5c379', 8, 1, '248xx_xx1580873264.jpg', 'TISHA AGUSTINA RAHMAWATI', 'TI2508', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (249, 'BDGCTS_041', '7dcd38fc95066e4524c5965192de2393', 8, 1, 'default.png', 'ANNISA ZAHRA NASHIROTULHAQ', 'BDGCTS_041', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (250, 'IN0394', '7249355a7af0ec7a59c8631470ed7a06', 8, 1, '250xx_xx1581040857.jpg', 'IKBAR NUR MUHAMMAD', 'IN0394', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (251, 'SS0595', 'd692fc8d5ad6c96bf978e3fbdd1e2486', 8, 1, 'default.png', 'SANDI SARIKA', 'SS0595', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (252, 'GI1704', 'e73f284c27af7b2ad17c9f9da3a1b76e', 8, 1, 'default.png', 'GIA NADIA PUTRI', 'GI1704', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (253, 'GE0397', '890374d468764be4d6188ba13b541555', 8, 1, 'default.png', 'GINA EKI AGUSTIN', 'GE0397', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (254, 'SI8254', '4c33b373bec4b5db650539f61a8e88d7', 8, 1, '254xx_xx1581042839.jpg', 'SINTA ROSITA', 'SI8254', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (255, 'SR2610', '2a8c4ca7e001785f6c86878bf7940ddf', 8, 1, '255xx_xx1580872106.jpg', 'SRI MAWATI AYUNIGUNTARI', 'SR2610', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (256, 'NJ1981', 'cd7f14e180903e57cfd03dc93930c77e', 8, 1, 'default.png', 'NUR JAIS', 'NJ1981', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (257, 'BDGCTS_025', 'f0356fa80cc2c71b80938c3c2b84748d', 8, 1, 'default.png', 'HENI WAHYUNI', 'BDGCTS_025', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (258, 'NR1290', 'b3bb60d01a51498889a95e218b1b1c9c', 8, 1, 'default.png', 'NADYA RACHMAWATI', 'NR1290', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (259, 'IR1502', '1a61afef68519546026b133ac3c97b7b', 8, 1, '259xx_xx1580900050.jpg', 'PUTRI RATNASARI', 'IR1502', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (260, 'RE8569', 'c00477976ddbd1e2b7823caf77b34249', 8, 1, 'default.png', 'RESI NURLITA', 'RE8569', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (261, 'BDGCTS_046', 'bb8ad6522f49e776ff77b968561dd187', 8, 1, 'default.png', 'RIRI MARDIANA', 'BDGCTS_046', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (262, 'SA0592', 'a4ecabe3d08c8b45ba76f479be2c01d0', 8, 1, 'default.png', 'SABILA AINUN HAFSAH', 'SA0592', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (263, 'IK0206', 'f26fb0c98c68998bb8bd5397238f3c28', 8, 1, 'default.png', 'SUSILAWATI', 'IK0206', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (264, 'SN0895', '70a61a0a2baba8c04172a8e41baa1502', 8, 1, 'default.png', 'SANI NURAHAYU', 'SN0895', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (265, 'BDG_008', '976d52b131f9ec469b9bc96eac03bb1e', 8, 1, 'default.png', 'EPPY ROBIATUS SADIYAH', 'BDG_008', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (266, 'BDGCTS_038', '9f75556f813695bb805f62baca4f6533', 8, 1, 'default.png', 'RIKARDO HAREFA', 'BDGCTS_038', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (267, 'RO0707', 'd76a1c73c30b5871562b870baa590bb5', 8, 1, 'default.png', 'ROSMILA', 'RO0707', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (268, 'AN6527', '83f7829093f1e30e6c317050ae59e3b2', 8, 1, '268xx_xx1581043080.jpg', 'VIAN ARAYANI', 'AN6527', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (269, 'MU3004', 'b146e5346f2d0910b46428d535b81230', 8, 1, '269xx_xx1581043107.jpg', 'VIVIT NOVITASARI', 'MU3004', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (270, 'WY0182', 'f4c3cde7e75e1c7df5f511886a4beaad', 8, 1, '270xx_xx1580874466.jpg', 'WAHYU', 'WY0182', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (271, 'YU0739', 'c332ad01949fbed5f0c9bdfa67552f76', 8, 1, 'default.png', 'YULIANA', 'YU0739', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (272, 'BDG_003', '8dad9715581ac3d657ca1e5a803ecd11', 8, 1, 'default.png', 'DIAN DARMAWAN S', 'BDG_003', 'REG', 'TLITA');
INSERT INTO `sys_user` VALUES (273, 'RR151291', '9340791560e668a4c16eb47b293726f0', 8, 1, 'default.png', 'SARAH SITI NUR SYAMSIAH', 'RR151291', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (274, 'IF0710', '9e11b70693c15e7367166a7249fa2851', 8, 1, 'default.png', 'IMAN FIRMANSYAH', 'IF0710', 'REG', 'TLLIA');
INSERT INTO `sys_user` VALUES (275, 'NM0697', '9864e07fe8dd81bb1e225dae838789dc', 8, 1, 'default.png', 'NADYA MAHARANI PUTRI', 'NM0697', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (276, 'EM2807', '78f4836d9673ece7ab5240f05df17937', 8, 1, 'default.png', 'RIAN ADRIANA', 'EM2807', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (277, 'ID1006', 'bdfb410ef4daa7bd10c1f569f47f1008', 8, 1, 'default.png', 'SELVA NURDIN MULYANA', 'ID1006', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (278, 'RA4186', 'f85dcabe61bb70e1c83dce078d90cacf', 8, 1, 'default.png', 'SUSILAWATI MOSS', 'RA4186', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (279, 'BDG_001', 'a22e59c770b377a350a5e97ee46d1f12', 8, 1, 'default.png', 'VIVIT NOVITASARI MOSS', 'BDG_001', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (280, 'BDG_007', 'ee8b3b32cfddf8f16a4dade184b6d1c8', 8, 1, 'default.png', 'GILANG GINANJAR MOSS', 'BDG_007', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (281, 'BDG_014', '2b0a47cfd018dc4158b25a43588d3a9e', 8, 1, 'default.png', 'RACHMAT MULDANI MOSS', 'BDG_014', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (282, 'BDG_016', '3d3ab79976b8ac443b8cf0d6c2ee2c94', 8, 1, 'default.png', 'TISHA AGUSTINA RAHMAWATI MOSS', 'BDG_016', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (283, 'BDG_017', 'f53b096a1af48f72be6e2ad6103dc324', 8, 1, 'default.png', 'LISNA PUJIARTI MOSS', 'BDG_017', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (284, 'BDG_018', '6fcb053ce0558310e17322e8973f7306', 8, 1, 'default.png', 'YULIANA MOSS', 'BDG_018', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (285, 'BDG_020', '792ec86476178320768f8e408148b9f9', 8, 1, 'default.png', 'GITA BONITA MOSS', 'BDG_020', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (286, 'BDG_021', '6d12a074af398a1e66d2b3a925a73b9d', 8, 1, 'default.png', 'SRI LESTARI MOSS', 'BDG_021', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (287, 'BDG_022', 'd07140cd3dc34068eff7e1462c72186b', 8, 1, 'default.png', 'AFIFATUL AZIZAH MOSS', 'BDG_022', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (288, 'BDG_025', '42767ea58be99b2dc5c33c2cd3fbe276', 8, 1, 'default.png', 'ARIEF IMAN PRASETYO MOSS', 'BDG_025', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (289, 'BDG_026', '2ebf1355d23eae0a272b7bb00963971b', 8, 1, 'default.png', 'DWINA ANISAH MOSS', 'BDG_026', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (290, 'BDG_027', '343f44fc9f4ab98678da5dd33e9d060f', 8, 1, 'default.png', 'VIAN ARAYANI MOSS', 'BDG_027', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (291, 'BDG_028', '4d28a35f3727c2d986474a5625d3cb7f', 8, 1, 'default.png', 'RIAN ANDRIANA MOSS', 'BDG_028', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (292, 'BDG_029', '7a91cb252898b25ab14c5ce252abab89', 8, 1, 'default.png', 'EPPY ROBIATUS SADIYAH MOSS', 'BDG_029', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (293, 'BDG_030', '83e7d985e4d90af676019fcbfc2af341', 8, 1, 'default.png', 'PUTRI RATNASARI MOSS', 'BDG_030', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (294, 'BDG_033', '5de3bdf6060a2e151a5942d9dd698af2', 8, 1, 'default.png', 'SELVA NURDIN M MOSS', 'BDG_033', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (295, 'BDG_036', '9db003f38a6bfaa6116c3b6ba9c214fd', 8, 1, 'default.png', 'HARY HAIDAR LATIEF MOSS', 'BDG_036', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (296, 'BDG_037', '9bd6bc7847936d3449d98b9e1a4e238b', 8, 1, 'default.png', 'NUGRAHA NASRULLOH MOSS', 'BDG_037', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (297, 'BDG_041', '421ebd55dde3f0c4197974d67c02f151', 8, 1, 'default.png', 'DERY SEPTIANA AL RASYID MOSS', 'BDG_041', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (298, 'BDG_042', '2893c0c5c918bf67979c5e3ee649ea64', 8, 1, 'default.png', 'RIZKI NUR FADHILAH MOSS', 'BDG_042', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (299, 'BDG_043', '09327d4cbbc631b4effa1036944a6f77', 8, 1, 'default.png', 'KARLINA MOSS', 'BDG_043', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (300, 'BDG_039', 'cda92f9926df931869e1528d4b119d39', 8, 1, 'default.png', 'WAHYU MOSS', 'BDG_039', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (301, 'BDG_040', 'c5c09362b31084032d19245dab38058b', 8, 1, 'default.png', 'ANNISA MOSS', 'BDG_040', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (302, 'BDG_046', '649c1b4ab428c0d61fbce1e3ced143dd', 8, 1, 'default.png', 'DENI YUDISTIRA MOSS', 'BDG_046', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (303, 'BDG_048', '25bec840681d74adb09303bc7f5a52bd', 8, 1, 'default.png', 'GIA NADIA PUTRI MOSS', 'BDG_048', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (304, 'BDG_051', '8b37acc5275bf53e56eb5a5b68bde1b5', 8, 1, 'default.png', 'SINTA DEWI SETIAWATI MOSS', 'BDG_051', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (305, 'BDG_052', '4bc886129d1ef5e004a16aaddd2a3e91', 8, 1, 'default.png', 'SINTA ROSITA MOSS', 'BDG_052', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (306, 'BDG_053', 'e619a4a5f0c9eaa2c13be214401f37ee', 8, 1, 'default.png', 'AGHNIA AUDINA NUR SOLEHAH MOSS', 'BDG_053', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (307, 'BDG_055', '6b5bb4683a44bf5633cfbb954b7c69e7', 8, 1, 'default.png', 'ROHIMAH MOSS', 'BDG_055', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (308, 'BDG_056', '1863b8d4cbf11eba5274c03bdd209add', 8, 1, 'default.png', 'RIA ANDRIYANI MOSS', 'BDG_056', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (309, 'BDG_057', '161ea2fb1e83001b857af4ced5234c89', 8, 1, 'default.png', 'MIA RAHMIYATI MOSS', 'BDG_057', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (310, 'BDG_059', '39d14d972512e7428e554adf5515982b', 8, 1, 'default.png', 'RIRI MARDIANA MOSS', 'BDG_059', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (311, 'BDG_060', '8cb8682af6f1785c7ae06fd5aac073f1', 8, 1, 'default.png', 'DIAN DARMAWAN S MOSS', 'BDG_060', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (312, 'BDG_061', 'dc42c74f0b2e9a9241bb3263b74848e8', 8, 1, 'default.png', 'SHERA AMALIA MOSS', 'BDG_061', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (313, 'BDG_062', 'c3141fb61ee337eaf0ce99e8ba4439b3', 8, 1, 'default.png', 'MUHAMMAD INDRA DWI LAKSANA MOSS', 'BDG_062', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (314, 'BDG_064', 'b5d1c1dc4b8c4cd8b269783f14a01145', 8, 1, 'default.png', 'ARIEF DHARMASAPUTRA MOSS', 'BDG_064', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (315, 'BDG_066', '206b4a43a325a21c73384a62c82b9d10', 8, 1, 'default.png', 'MOHAMMAD HAFIZ AL FAUZAN MOSS', 'BDG_066', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (316, 'BDG_067', '083abfc2bb039f60aebb3d89f2ec670f', 8, 1, 'default.png', 'SRI MAWATI AYUNIGUNTARI MOSS', 'BDG_067', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (317, 'BDG_068', 'b6389dd0656a7aabdde6f8e9fec37f63', 8, 1, 'default.png', 'RIKARDO HAREFA MOSS', 'BDG_068', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (318, 'BDG_069', '9985be0f32c234c0b99dde8604c1a337', 8, 1, 'default.png', 'ROSMILA MOSS', 'BDG_069', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (319, 'BDG_070', '8b51dab01bfbe859664da118fad12c4e', 8, 1, 'default.png', 'RESI NURLITA MOSS', 'BDG_070', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (320, 'BDG_071', 'e050e6c82e3e1390356531703d639b68', 8, 1, 'default.png', 'HANNA DELAVINA MOSS', 'BDG_071', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (321, 'BDG_072', '3a3c3661b58db0a4f4a37a8f7ec37b27', 8, 1, 'default.png', 'NIRA FITRIAH MOSS', 'BDG_072', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (322, 'BDG_073', '6bfccfb7d29d1a6b2eb83cc5e4c1d53a', 8, 1, 'default.png', 'GINA EKI AGUSTIN MOSS', 'BDG_073', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (323, 'BDG_074', '084090a6a6adefd99790ee31f1239203', 9, 1, 'default.png', 'ASTI RAMDHIAN MOSS', 'BDG_074', 'TL', '-');
INSERT INTO `sys_user` VALUES (324, 'BDG_078', '7904259b5d50e8006896aad96189fd64', 8, 1, 'default.png', 'ANNISA ZAHRA NASHIROTULHAQ MOSS', 'BDG_078', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (325, 'BDG_079', 'e18dc1660ae8786711230deb786ac2c8', 8, 1, 'default.png', 'ISMAYANTI MOSS', 'BDG_079', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (326, 'BDG_082', 'f51ad857183fce17b1f45190fc27ddc5', 8, 1, 'default.png', 'HENI WAHYUNI MOSS', 'BDG_082', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (327, 'BDG_083', 'add32bd2a83946bf2ff5e625d1c5fc2e', 8, 1, 'default.png', 'SARAH SITI NUR SYAMSIAH MOSS', 'BDG_083', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (328, 'BDG_084', 'a4cf197f2d1acdb1dda8ee673eae62cd', 8, 1, 'default.png', 'DICKY PERMANA MOSS', 'BDG_084', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (329, 'BDG_085', '74c2e5be7069e75d2d2b8b669fee5a70', 8, 1, 'default.png', 'RATIH RAHMAWATI MOSS', 'BDG_085', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (330, 'BDG_087', '065fed2679a43b20334657940d24ba04', 8, 1, 'default.png', 'IMAN FIRMANSYAH MOSS', 'BDG_087', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (331, 'BDG_110', '96bb5b409cc1c0dcda6f610876d50052', 8, 1, 'default.png', 'NADYA MAHARANI PUTRI MOSS', 'BDG_110', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (332, 'BDG_009', '82d93afac8b987fe0d5ba9db1771d169', 8, 1, 'default.png', 'NUR JAIS MOSS', 'BDG_009', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (333, 'PE1080', '55c6729673ac6a7c5af3fa615a7f707a', 8, 1, 'default.png', 'PENDI MOSS', 'PE1080', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (334, 'BDG_112', '97ddc0c089de936d90138be6ce7aaea8', 8, 1, 'default.png', 'FIRDA SRI RAHMAYANTI MOSS', 'BDG_112', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (335, 'BDG_114', 'b3179a90ee88e3c30bde70300dcd7b36', 8, 1, 'default.png', 'DIMAS PRADITYA AJI MOSS', 'BDG_114', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (336, 'BDG_115', 'bc9034a537c87ed2a80832489094ca43', 8, 1, 'default.png', 'SANI NURAHAYU MOSS', 'BDG_115', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (337, 'BDG_116', '2a634d9741a8ef1c1f328a0b08c4be4d', 8, 1, 'default.png', 'NADYA RACHMAWATI MOSS', 'BDG_116', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (338, 'BDG_117', 'f602b99c907e6544a81a3c94690a5dd3', 8, 1, 'default.png', 'DIDAH HALIYAH MOSS', 'BDG_117', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (339, 'BDG_118', '41b9dbc89775a518ebd80f9426b08934', 8, 1, 'default.png', 'RIESLA FAUZI RACHMAN MOSS', 'BDG_118', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (340, 'BDG_119', '77f90bb64d146d324721ed5a36be8c18', 8, 1, 'default.png', 'SANDI SARIKA MOSS', 'BDG_119', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (341, 'BDG_120', '9f07d90d8513a692edf1624b72d16d42', 8, 1, 'default.png', 'KRISDIYANTI MOSS', 'BDG_120', 'MOS', 'TLATEU');
INSERT INTO `sys_user` VALUES (342, 'BDG_111', 'c848e42d7905d4efa4d0105cca9410ac', 8, 1, 'default.png', 'VINA FEBRIANI MOSS', 'BDG_111', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (343, 'BDG_113', '73a3d5e3f1425cc4c24ee0a65f7ddd6e', 8, 1, 'default.png', 'IKBAR NUR MUHAMMAD MOSS', 'BDG_113', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (344, 'BDG_109', '661ca8e8d37d42bae1d10169dddafe82', 8, 1, 'default.png', 'RAHMAWATI ZAKIYAH MOSS', 'BDG_109', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (345, 'BDG_107', '755dcf5332c2df5e1c7cb85a08f96364', 8, 1, 'default.png', 'KARIN ARINDA PRAMUDHYTA MOSS', 'BDG_107', 'MOS', 'TLLIA');
INSERT INTO `sys_user` VALUES (346, 'BDG_108', 'e9a987ba33faedb4ee75ab008fb0439d', 8, 1, 'default.png', 'SABILA AINUN HAFSAH MOSS', 'BDG_108', 'MOS', 'TLITA');
INSERT INTO `sys_user` VALUES (347, 'screen', '35807ea546f4ccf5e187fa041aeccab4', 8, 1, 'default.png', 'screen', 'SC', '-', NULL);
INSERT INTO `sys_user` VALUES (348, 'KD0197', 'cba8ae25d699b8f693008ea83a5911b1', 8, 1, '348xx_xx1580872356.jpg', 'KRISDIYANTI', 'KD0197', 'REG', 'TLATEU');
INSERT INTO `sys_user` VALUES (350, 'TLLIA', 'd09c2014efd52de443a8f0fcba24b0ef', 9, 1, '350xx_xx1580867106.jpg', 'TL LIA', 'TLLIA', 'TL', '-');
INSERT INTO `sys_user` VALUES (351, 'TLITA', '9cb770d5bf067bc7ce74ff1c5c7ec4a0', 9, 1, '351xx_xx1580867246.jpg', 'Ita Modhalina Sembiring', 'TLITA', 'TL', '-');
INSERT INTO `sys_user` VALUES (352, 'TLATEU', 'a5da8badf19a5085d8aea140bf1fa158', 9, 1, '352xx_xx1580901637.jpg', 'TL NOVA', 'TLATEU', 'TL', '-');

SET FOREIGN_KEY_CHECKS = 1;
