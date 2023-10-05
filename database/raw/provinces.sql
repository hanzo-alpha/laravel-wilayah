/*
 Navicat Premium Data Transfer

 Source Server         : Laragon
 Source Server Type    : MariaDB
 Source Server Version : 101104 (10.11.4-MariaDB-log)
 Source Host           : localhost:3306
 Source Schema         : laravel_wilayah

 Target Server Type    : MariaDB
 Target Server Version : 101104 (10.11.4-MariaDB-log)
 File Encoding         : 65001

 Date: 05/10/2023 04:17:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for provinces
-- ----------------------------
DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`, `code`) USING BTREE,
  UNIQUE INDEX `id`(`id`, `code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 64 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of provinces
-- ----------------------------
INSERT INTO `provinces` VALUES (1, '11', 'ACEH');
INSERT INTO `provinces` VALUES (2, '12', 'SUMATERA UTARA');
INSERT INTO `provinces` VALUES (3, '13', 'SUMATERA BARAT');
INSERT INTO `provinces` VALUES (4, '14', 'RIAU');
INSERT INTO `provinces` VALUES (5, '15', 'JAMBI');
INSERT INTO `provinces` VALUES (6, '16', 'SUMATERA SELATAN');
INSERT INTO `provinces` VALUES (7, '17', 'BENGKULU');
INSERT INTO `provinces` VALUES (8, '18', 'LAMPUNG');
INSERT INTO `provinces` VALUES (9, '19', 'KEPULAUAN BANGKA BELITUNG');
INSERT INTO `provinces` VALUES (10, '21', 'KEPULAUAN RIAU');
INSERT INTO `provinces` VALUES (11, '31', 'DKI JAKARTA');
INSERT INTO `provinces` VALUES (12, '32', 'JAWA BARAT');
INSERT INTO `provinces` VALUES (13, '33', 'JAWA TENGAH');
INSERT INTO `provinces` VALUES (14, '34', 'DAERAH ISTIMEWA YOGYAKARTA');
INSERT INTO `provinces` VALUES (15, '35', 'JAWA TIMUR');
INSERT INTO `provinces` VALUES (16, '36', 'BANTEN');
INSERT INTO `provinces` VALUES (17, '51', 'BALI');
INSERT INTO `provinces` VALUES (18, '52', 'NUSA TENGGARA BARAT');
INSERT INTO `provinces` VALUES (19, '53', 'NUSA TENGGARA TIMUR');
INSERT INTO `provinces` VALUES (20, '61', 'KALIMANTAN BARAT');
INSERT INTO `provinces` VALUES (21, '62', 'KALIMANTAN TENGAH');
INSERT INTO `provinces` VALUES (22, '63', 'KALIMANTAN SELATAN');
INSERT INTO `provinces` VALUES (23, '64', 'KALIMANTAN TIMUR');
INSERT INTO `provinces` VALUES (24, '65', 'KALIMANTAN UTARA');
INSERT INTO `provinces` VALUES (25, '71', 'SULAWESI UTARA');
INSERT INTO `provinces` VALUES (26, '72', 'SULAWESI TENGAH');
INSERT INTO `provinces` VALUES (27, '73', 'SULAWESI SELATAN');
INSERT INTO `provinces` VALUES (28, '74', 'SULAWESI TENGGARA');
INSERT INTO `provinces` VALUES (29, '75', 'GORONTALO');
INSERT INTO `provinces` VALUES (30, '76', 'SULAWESI BARAT');
INSERT INTO `provinces` VALUES (31, '81', 'MALUKU');
INSERT INTO `provinces` VALUES (32, '82', 'MALUKU UTARA');
INSERT INTO `provinces` VALUES (33, '91', 'PAPUA');
INSERT INTO `provinces` VALUES (34, '92', 'PAPUA BARAT');
INSERT INTO `provinces` VALUES (35, '93', 'PAPUA SELATAN');
INSERT INTO `provinces` VALUES (36, '94', 'PAPUA TENGAH');
INSERT INTO `provinces` VALUES (37, '95', 'PAPUA PEGUNUNGAN');

SET FOREIGN_KEY_CHECKS = 1;
