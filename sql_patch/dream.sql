-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.5.40-0ubuntu0.14.04.1-log - (Ubuntu)
-- 服务器操作系统:                      debian-linux-gnu
-- HeidiSQL 版本:                  8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出 dream_fudao_admin 的数据库结构
DROP DATABASE IF EXISTS `dream_fudao_admin`;
CREATE DATABASE IF NOT EXISTS `dream_fudao_admin` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dream_fudao_admin`;


-- 导出  表 dream_fudao_admin.t_privity_group 结构
DROP TABLE IF EXISTS `t_privity_group`;
CREATE TABLE IF NOT EXISTS `t_privity_group` (
  `F_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `F_pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父组ID',
  `F_name` varchar(50) NOT NULL COMMENT '组名',
  `F_description` text NOT NULL COMMENT '组的描述',
  `F_privity` text NOT NULL COMMENT '权限(例:  1,15,6)',
  `F_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(1:有效,0无效)',
  `F_could_has_child` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '组下面是否可以创建子组(1:可以,0不 可以)',
  `F_create_by_uid` int(10) unsigned NOT NULL COMMENT 't_user对应的F_id',
  `F_create_time` datetime NOT NULL COMMENT '创建时间',
  `F_modify_time` datetime NOT NULL COMMENT '修改时间',
  `F_level` tinyint(1) NOT NULL DEFAULT '-1' COMMENT '0为超级管理员，-1为其它,1为老师',
  PRIMARY KEY (`F_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='权限组';

-- 正在导出表  dream_fudao_admin.t_privity_group 的数据：4 rows
DELETE FROM `t_privity_group`;
/*!40000 ALTER TABLE `t_privity_group` DISABLE KEYS */;
INSERT INTO `t_privity_group` (`F_id`, `F_pid`, `F_name`, `F_description`, `F_privity`, `F_status`, `F_could_has_child`, `F_create_by_uid`, `F_create_time`, `F_modify_time`, `F_level`) VALUES
	(1, 0, '超级管理员', '', 'all', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
	(2, 1, '运营管理者', '', '', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', -1),
	(3, 2, '运营人员', '', '', 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', -1),
	(4, 1, '测试组', '', '', 1, 0, 1, '0000-00-00 00:00:00', '2014-12-30 15:12:43', -1);
/*!40000 ALTER TABLE `t_privity_group` ENABLE KEYS */;


-- 导出  表 dream_fudao_admin.t_teacher 结构
DROP TABLE IF EXISTS `t_teacher`;
CREATE TABLE IF NOT EXISTS `t_teacher` (
  `F_api_uid` varchar(13) NOT NULL COMMENT 'api uid',
  `F_login_name` varchar(50) NOT NULL COMMENT '老师登录名',
  UNIQUE KEY `F_api_uid` (`F_api_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='老师表(与api提供的老师对应)';

-- 正在导出表  dream_fudao_admin.t_teacher 的数据：~0 rows (大约)
DELETE FROM `t_teacher`;
/*!40000 ALTER TABLE `t_teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_teacher` ENABLE KEYS */;


-- 导出  表 dream_fudao_admin.t_user 结构
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE IF NOT EXISTS `t_user` (
  `F_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `F_login_name` varchar(50) NOT NULL COMMENT '登录名',
  `F_login_password` char(32) NOT NULL COMMENT '登录密码',
  `F_nick_name` varchar(50) NOT NULL COMMENT '昵称',
  `F_privity_group_id` int(10) NOT NULL COMMENT '权限组ID',
  PRIMARY KEY (`F_id`),
  UNIQUE KEY `F_login_name` (`F_login_name`),
  KEY `F_role_id` (`F_privity_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='后台用户表';

-- 正在导出表  dream_fudao_admin.t_user 的数据：1 rows
DELETE FROM `t_user`;
/*!40000 ALTER TABLE `t_user` DISABLE KEYS */;
INSERT INTO `t_user` (`F_id`, `F_login_name`, `F_login_password`, `F_nick_name`, `F_privity_group_id`) VALUES
	(1, 'admin', 'admin', 'admin', 1);
/*!40000 ALTER TABLE `t_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
