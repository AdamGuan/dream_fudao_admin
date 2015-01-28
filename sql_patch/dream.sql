-- --------------------------------------------------------
-- 主机:                           115.29.100.13
-- 服务器版本:                        5.5.2-m2-log - Source distribution
-- 服务器操作系统:                      unknown-linux-gnu
-- HeidiSQL 版本:                  9.1.0.4867
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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='权限组';

-- 正在导出表  dream_fudao_admin.t_privity_group 的数据：2 rows
DELETE FROM `t_privity_group`;
/*!40000 ALTER TABLE `t_privity_group` DISABLE KEYS */;
INSERT INTO `t_privity_group` (`F_id`, `F_pid`, `F_name`, `F_description`, `F_privity`, `F_status`, `F_could_has_child`, `F_create_by_uid`, `F_create_time`, `F_modify_time`, `F_level`) VALUES
	(1, 0, '超级管理员', '', 'all', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
	(12, 1, '运营人员1', '', 'c_login/index,c_index/index,c_teacher/manager,c_teacher/teacher_edit,c_teacher/teacher_add,c_teacher/teacher_freeze,c_teacher/teacher_delete,c_teacher/teacher_active,c_custom/manager,c_custom/custom_edit,c_custom/custom_add,c_custom/custom_freeze,c_custom/custom_delete,c_custom/custom_active,c_student/manager,c_statistic_realtime/index,c_statistic_timesection/index,c_statistic_teacher/index,c_statistic_student/index,c_playback/manager,c_person/index', 1, 0, 1, '2015-01-07 08:58:54', '2015-01-08 18:20:23', -1);
/*!40000 ALTER TABLE `t_privity_group` ENABLE KEYS */;


-- 导出  表 dream_fudao_admin.t_publish 结构
DROP TABLE IF EXISTS `t_publish`;
CREATE TABLE IF NOT EXISTS `t_publish` (
  `F_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `F_title` varchar(250) NOT NULL COMMENT '标题',
  `F_content` text NOT NULL COMMENT '内容',
  `F_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(1:有效,0无效)',
  `F_create_time` datetime NOT NULL COMMENT '创建时间',
  `F_modify_time` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`F_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='公告';

-- 正在导出表  dream_fudao_admin.t_publish 的数据：1 rows
DELETE FROM `t_publish`;
/*!40000 ALTER TABLE `t_publish` DISABLE KEYS */;
INSERT INTO `t_publish` (`F_id`, `F_title`, `F_content`, `F_status`, `F_create_time`, `F_modify_time`) VALUES
	(15, '新版', '新版本上线了，请修改自己的密码', 1, '2015-01-08 16:09:02', '2015-01-08 16:09:02');
/*!40000 ALTER TABLE `t_publish` ENABLE KEYS */;


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
  `F_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0无效,1有效',
  `F_create_time` datetime NOT NULL COMMENT '添加时间',
  `F_modify_time` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`F_id`),
  UNIQUE KEY `F_login_name` (`F_login_name`),
  KEY `F_role_id` (`F_privity_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='后台用户表';

-- 正在导出表  dream_fudao_admin.t_user 的数据：1 rows
DELETE FROM `t_user`;
/*!40000 ALTER TABLE `t_user` DISABLE KEYS */;
INSERT INTO `t_user` (`F_id`, `F_login_name`, `F_login_password`, `F_nick_name`, `F_privity_group_id`, `F_status`, `F_create_time`, `F_modify_time`) VALUES
	(1, 'admin', '111111', 'admin', 1, 1, '0000-00-00 00:00:00', '2015-01-08 10:17:26');
/*!40000 ALTER TABLE `t_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
