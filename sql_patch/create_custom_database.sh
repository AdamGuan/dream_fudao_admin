#!/bin/bash
mysql -uroot -proot -e"drop database dream_fudao_admin"
mysql -uroot -proot -e"create database dream_fudao_admin"

mysql -uroot -proot dream_fudao_admin -e"create table dream_fudao_admin.t_role (
  F_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  F_name VARCHAR(50) NOT NULL COMMENT '角色名',
  F_description TEXT NOT NULL COMMENT '角色的描述',
  F_privity TEXT NOT NULL COMMENT '权限(例:  1,15,6),
  F_status TINYINT(1) NOT NULL DEFAULT '1' COMMENT '状态(1:有效,0无效)',
  PRIMARY KEY (F_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色表'"

mysql -uroot -proot dream_fudao_admin -e"create table dream_fudao_admin.t_teacher (
  F_api_uid VARCHAR(13) NOT NULL COMMENT 'api uid',
  F_login_name VARCHAR(50) NOT NULL COMMENT '老师登录名',
  UNIQUE INDEX F_api_uid (F_api_uid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='老师表(与api提供的老师对应)'"

mysql -uroot -proot dream_fudao_admin -e"create table dream_fudao_admin.t_user (
  F_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  F_login_name VARCHAR(50) NOT NULL COMMENT '登录名',
  F_login_password CHAR(32) NOT NULL COMMENT '登录密码',
  F_nick_name VARCHAR(50) NOT NULL COMMENT '昵称',
  F_role_id INT(10) NOT NULL COMMENT '角色ID',
  PRIMARY KEY (F_id),
  UNIQUE INDEX F_login_name (F_login_name),
  INDEX F_role_id (F_role_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台用户表'"
