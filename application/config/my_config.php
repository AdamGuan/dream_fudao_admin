<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//输出到view的值
$config['data'] = array(
	'global_web_title_pro'=>'一对一辅导',
	'global_web_title_suffix'=>'控制平台',
	'global_web_license'=>'© 2014 dream license.',
	'global_left_bar'=>array(
		array(
			'prefix_class'=>'am-icon-home',
			'text'=>'首页',
			'link'=>'c_index/index',
			'active'=>0,
			'children'=>array()
		),
		array(
			'prefix_class'=>'am-icon-users',
			'text'=>'角色管理',
			'link'=>'',
			'active'=>0,
			'children'=>array(
				array(
					'prefix_class'=>'am-icon-list',
					'text'=>'老师管理',
					'link'=>'c_teacher/manager',
					'active'=>0,
				),
				array(
					'prefix_class'=>'am-icon-list',
					'text'=>'客服管理',
					'link'=>'c_custom/manager',
					'active'=>0
				),
				array(
					'prefix_class'=>'am-icon-list',
					'text'=>'学生管理',
					'link'=>'c_student/manager',
					'active'=>0
				),
				array(
					'prefix_class'=>'am-icon-list',
					'text'=>'工作人员',
					'link'=>'c_privity/user_manager',
					'active'=>0
				)
			)
		),
		array(
			'prefix_class'=>'am-icon-bar-chart',
			'text'=>'统计分析',
			'link'=>'',
			'active'=>0,
			'children'=>array(
				array(
					'prefix_class'=>'am-icon-line-chart',
					'text'=>'实时统计',
					'link'=>'c_statistic_realtime/index',
					'active'=>0
				),
				array(
					'prefix_class'=>'am-icon-line-chart',
					'text'=>'时段统计',
					'link'=>'c_statistic_timesection/index',
					'active'=>0
				),
				array(
					'prefix_class'=>'am-icon-list',
					'text'=>'老师统计',
					'link'=>'c_statistic_teacher/index',
					'active'=>0
				),
				array(
					'prefix_class'=>'am-icon-list',
					'text'=>'学生统计',
					'link'=>'c_statistic_student/index',
					'active'=>0
				)
			)
		),
		array(
			'prefix_class'=>'am-icon-recycle',
			'text'=>'回放分类',
			'link'=>'c_playback/manager',
			'active'=>0,
			'children'=>array()
		),
		array(
			'prefix_class'=>'am-icon-gear',
			'text'=>'权限组管理',
			'link'=>'c_privity/group_manager',
			'active'=>0,
			'children'=>array()
		),
		array(
			'prefix_class'=>'am-icon-file',
			'text'=>'日志',
			'link'=>'c_log/list',
			'children'=>array()
		),
		array(
			'prefix_class'=>'am-icon-file',
			'text'=>'个人资料',
			'link'=>'c_person/index',
			'active'=>0,
			'children'=>array()
		),
		array(
			'prefix_class'=>'am-icon-file',
			'text'=>'公告管理',
			'link'=>'c_publish/publish_manager',
			'active'=>0,
			'children'=>array()
		),
	),
	'global_all_privity_list'=>array(
		array(
			'text'=>'登录',
			'link'=>'c_login/index',
			'children'=>array(),
		),
		array(
			'text'=>'首页',
			'link'=>'c_index/index',
			'children'=>array()
		),
		array(
			'text'=>'角色管理',
			'link'=>'',
			'children'=>array(
				array(
					'text'=>'老师管理',
					'link'=>'',
					'children'=>array(
						array(
							'text'=>'老师列表',
							'link'=>'c_teacher/manager',
						),
						array(
							'text'=>'修改老师',
							'link'=>'c_teacher/teacher_edit',
						),
						array(
							'text'=>'添加老师',
							'link'=>'c_teacher/teacher_add',
						),
						array(
							'text'=>'冻结老师',
							'link'=>'c_teacher/teacher_freeze',
						),
						array(
							'text'=>'删除老师',
							'link'=>'c_teacher/teacher_delete',
						),
						array(
							'text'=>'激活老师',
							'link'=>'c_teacher/teacher_active',
						),
						array(
							'text'=>'设置老师为测试帐号',
							'link'=>'c_teacher/teacher_set_test',
						),
					)
				),
				array(
					'text'=>'客服管理',
					'link'=>'c_custom/manager',
				),
				array(
					'text'=>'学生管理',
					'link'=>'c_student/manager',
				),
				array(
					'text'=>'工作人员',
					'link'=>'c_privity/user_manager',
				)
			)
		),
		array(
			'text'=>'统计分析',
			'link'=>'',
			'children'=>array(
				array(
					'text'=>'实时统计',
					'link'=>'c_index/index5',
				),
				array(
					'text'=>'时段统计',
					'link'=>'c_index/index6',
				),
				array(
					'text'=>'老师统计',
					'link'=>'c_index/index7',
				),
				array(
					'text'=>'学生统计',
					'link'=>'c_index/index8',
				)
			)
		),
		array(
			'text'=>'回放分类',
			'link'=>'c_playback/manager',
			'children'=>array(
				array(
					'text'=>'回放列表',
					'link'=>'c_playback/manager',
				),
				array(
					'text'=>'设置精彩',
					'link'=>'c_playback/playback_active',
				),
				array(
					'text'=>'取消精彩',
					'link'=>'c_playback/playback_deactive',
				),
			)
		),
		array(
			'text'=>'日志',
			'link'=>'c_log/list',
			'children'=>array()
		),
		array(
			'text'=>'权限',
			'link'=>'',
			'children'=>array(
				array(
					'text'=>'权限组列表',
					'link'=>'c_privity/group_manager',
				),
				array(
					'text'=>'权限组添加',
					'link'=>'c_privity/group_add',
				),
			)
		),
		array(
			'text'=>'个人资料',
			'link'=>'c_index/index12',
			'children'=>array()
		),
		array(
			'text'=>'公告管理',
			'link'=>'c_publish/publish_manager',
			'children'=>array()
		),
	),
);

//api
$config['api_uri'] = 'http://yunfudao.strongwind.cn/api/index.php';
$config['api_key'] = '731222260492(readboy)25489884364';
$config['api_version'] = 'server_v1';

//1：小学，2：初中，3：高中
$config['grade_list'] = array(
	"1"=>"小学",
	"2"=>"初中",
	"3"=>"高中"
);

//1"数学",2"语文",3"化学",4"物理",5"英语"
$config['subject_list'] = array(
	"1"=>"语文",
	"2"=>"数学",
	"3"=>"英语",
	"4"=>"化学",
	"5"=>"物理",
	"6"=>"生物",
	"7"=>"历史",
	"8"=>"地理",
	"9"=>"政治",
);

//角色 0：老师，1：客服
$config['role_list'] = array(0,1);
//1男,2女,3未知
$config['gender_list'] = array('1'=>'男','2'=>'女','3'=>'未知');
//老师状态  0：激活，1：冻结，2：删除，3：彻底删除，4：测试
$config['status_list'] = array('0'=>'激活','1'=>'冻结','2'=>'删除','3'=>'彻底删除','4'=>'测试');
$config['status_list_view'] = array(
	array("id"=>"0","text"=>"激活的老师","privity"=>"c_teacher/teacher_active"),
	array("id"=>"1","text"=>"冻结的老师","privity"=>"c_teacher/teacher_freeze"),
	array("id"=>"2","text"=>"删除的老师","privity"=>"c_teacher/teacher_delete"),
	array("id"=>"4","text"=>"测试的老师","privity"=>"c_teacher/teacher_set_test"),
);
//客服
$config['status_list_view_custom'] = array(
	array("id"=>"0","text"=>"激活的客服","privity"=>"c_custom/custom_active"),
	array("id"=>"1","text"=>"冻结的客服","privity"=>"c_custom/custom_freeze"),
);
//列表页面
$config['page'] = 10;

//年级
$config['class_list'] = array(
	'513'=>'一年级',
	'514'=> "二年级",
	'515'=> "三年级",
	'516'=> "四年级",
	'517'=> "五年级",
	'518'=> "六年级",
	'519'=> "初中一年级",
	'520'=> "初中二年级",
	'521'=> "初中三年级",
	'769'=> "高中一年级",
	'770'=> "高中二年级",
	'771'=> "高中三年级"
);

/* End of file my_config.php */
/* Location: ./application/config/my_config.php */
