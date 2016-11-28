/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : jsosuo

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-11-04 18:13:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for answer
-- ----------------------------
DROP TABLE IF EXISTS `answer`;
CREATE TABLE `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `state` tinyint(2) NOT NULL COMMENT '0/1 正常/禁止',
  `isAccepted` tinyint(2) NOT NULL COMMENT '0/1 未被采纳/采纳',
  `tm` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of answer
-- ----------------------------
INSERT INTO `answer` VALUES ('1', '2', '1', '你说的很对你说的很对你说的很对你说的很对你说的很对你说的很对你说的很对你说的很对你说的很对你说的很对你说的很对你说的很对你说的很对你说的很对你说的很对你说的很对你说的很对你说的很对你说的很对你说的很对', '0', '0', '2016-11-04 16:47:42');

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `typeId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `tm` datetime NOT NULL,
  `clickCnt` int(11) NOT NULL,
  `state` tinyint(2) NOT NULL COMMENT '0/1  正常/禁止',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '2', '2', 'php从基础到精通之路', 'php是当前的。。。。。。', '2016-11-04 10:26:14', '2', '1');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `type` tinyint(2) NOT NULL COMMENT '0/1  回答/博文',
  `targetId` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `tm` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for jbi
-- ----------------------------
DROP TABLE IF EXISTS `jbi`;
CREATE TABLE `jbi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `jbi` int(11) NOT NULL,
  `amount` decimal(5,2) NOT NULL,
  `state` tinyint(2) NOT NULL COMMENT '0/1/2  付款中/付款成功/付款失败',
  `createTm` datetime NOT NULL,
  `tm` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jbi
-- ----------------------------
INSERT INTO `jbi` VALUES ('1', '2', '100', '5.01', '1', '2016-11-04 16:10:29', '2016-11-04 16:12:38');

-- ----------------------------
-- Table structure for loginrecord
-- ----------------------------
DROP TABLE IF EXISTS `loginrecord`;
CREATE TABLE `loginrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `ipArea` varchar(50) NOT NULL,
  `tm` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of loginrecord
-- ----------------------------
INSERT INTO `loginrecord` VALUES ('1', '2', '192.2.3', '安徽-阜阳', '2016-11-04 11:46:15');

-- ----------------------------
-- Table structure for question
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `typeId` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `clickCnt` int(11) NOT NULL,
  `tm` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of question
-- ----------------------------
INSERT INTO `question` VALUES ('1', '1', '2', '怎么学好php，快速的上手，有哪位大神给我指指路', '怎么学好php，快速的上手，有哪位大神给我指指路', '1', '2016-11-04 10:11:35');

-- ----------------------------
-- Table structure for reply
-- ----------------------------
DROP TABLE IF EXISTS `reply`;
CREATE TABLE `reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `toUserId` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `tm` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reply
-- ----------------------------

-- ----------------------------
-- Table structure for reward
-- ----------------------------
DROP TABLE IF EXISTS `reward`;
CREATE TABLE `reward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `type` tinyint(2) NOT NULL COMMENT '0/1 回答/博文',
  `jbi` int(11) NOT NULL,
  `targetId` int(11) NOT NULL,
  `tm` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reward
-- ----------------------------
INSERT INTO `reward` VALUES ('1', '1', '0', '10', '1', '2016-11-04 16:34:09');

-- ----------------------------
-- Table structure for type
-- ----------------------------
DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `state` tinyint(2) NOT NULL COMMENT '0/1 不使用/使用',
  `pId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `tm` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of type
-- ----------------------------
INSERT INTO `type` VALUES ('1', 'IT技术', '互联网便捷了我们的生活，让我们仰望互联网', '1', '0', '0', '2016-11-04 11:15:39');
INSERT INTO `type` VALUES ('2', 'PHP', 'PHP是一种通用开源脚本语言。利于学习，使用广泛，主要适用于Web开发领域。', '1', '1', '0', '2016-11-04 11:15:42');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickName` varchar(15) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `picId` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `ipArea` varchar(100) NOT NULL,
  `six` int(3) NOT NULL,
  `integral` int(11) NOT NULL,
  `jbi` int(11) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `tm` datetime NOT NULL,
  `state` tinyint(2) NOT NULL COMMENT '0/1 正常/禁止',
  `phoneArea` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '我是达人', '', '0', '192.168.1.1', '上海-上海', '0', '0', '0', '18621535929', '2016-11-03 10:37:19', '0', '安徽-阜阳');
INSERT INTO `user` VALUES ('2', 'Jsosuo', '', '0', '193.126.2.3', '江苏-南京', '0', '0', '0', '188886666231', '2016-11-03 11:10:43', '1', '安徽-滁州');

-- ----------------------------
-- Table structure for visit
-- ----------------------------
DROP TABLE IF EXISTS `visit`;
CREATE TABLE `visit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vPage` varchar(255) NOT NULL,
  `fPage` varchar(255) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `ipArea` varchar(50) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `tm` datetime NOT NULL,
  `form` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of visit
-- ----------------------------
INSERT INTO `visit` VALUES ('1', 'http://www.jesslu.com', 'http://www.baidu.com/?s=jesslu.com', '192.1.1', '上海-上海', 'jesslu.com', '2016-11-04 11:29:05', '百度');

-- ----------------------------
-- Table structure for vote
-- ----------------------------
DROP TABLE IF EXISTS `vote`;
CREATE TABLE `vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `type` tinyint(2) NOT NULL COMMENT '0/1   回答/博文',
  `targetId` int(11) NOT NULL,
  `oper` tinyint(2) NOT NULL COMMENT '1/2 赞同/反对',
  `tm` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vote
-- ----------------------------
