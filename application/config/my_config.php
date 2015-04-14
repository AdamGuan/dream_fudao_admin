<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//输出到view的值
$config['data'] = array(
	'global_web_title_pro'=>'一对一辅导',
	'global_web_title_suffix'=>'控制平台',
	'global_web_license'=>'© 2015 dream license.',
	'global_left_bar'=>array(   //左侧列表
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
					'text'=>'测试老师管理',
					'link'=>'c_teacher/test_manager',
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
				),
				array(
					'prefix_class'=>'am-icon-list',
					'text'=>'辅导统计',
					'link'=>'c_statistic_teaching/index',
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
			'prefix_class'=>'am-icon-bug',
			'text'=>'异常',
			'link'=>'c_exception/manager',
			'active'=>0,
			'children'=>array()
		),
		array(
			'prefix_class'=>'am-icon-bug',
			'text'=>'老师反馈',
			'link'=>'c_teacher_feedback/manager',
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
//		array(
//			'prefix_class'=>'am-icon-file',
//			'text'=>'日志',
//			'link'=>'c_log/list',
//			'children'=>array()
//		),
		array(
			'prefix_class'=>'am-icon-volume-up',
			'text'=>'公告管理',
			'link'=>'c_publish/manager',
			'active'=>0,
			'children'=>array()
		),
		array(
			'prefix_class'=>'am-icon-file',
			'text'=>'个人资料',
			'link'=>'c_person/index',
			'active'=>0,
			'children'=>array()
		),
	),
	'global_all_privity_list'=>array(   //权限列表
		array(
			'text'=>'正式老师管理',
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
			)
		),
		array(
			'text'=>'测试老师管理',
			'link'=>'',
			'children'=>array(
				array(
					'text'=>'老师列表',
					'link'=>'c_teacher/test_manager',
				),
				array(
					'text'=>'修改老师',
					'link'=>'c_teacher/test_teacher_edit',
				),
				array(
					'text'=>'添加老师',
					'link'=>'c_teacher/test_teacher_add',
				),
				array(
					'text'=>'删除老师',
					'link'=>'c_teacher/teacher_delete',
				),
			)
		),
		array(
			'text'=>'学生管理',
			'link'=>'',
			'children'=>array(
				array(
					'text'=>'学生列表',
					'link'=>'c_student/manager',
				),
				array(
					'text'=>'学生冻结',
					'link'=>'c_student/student_freeze',
				),
				array(
					'text'=>'学生删除',
					'link'=>'c_student/student_delete',
				),
				array(
					'text'=>'学生激活',
					'link'=>'c_student/student_active',
				),
			)
		),
		array(
			'text'=>'客服管理',
			'link'=>'',
			'children'=>array(
				array(
					'text'=>'客服列表',
					'link'=>'c_custom/manager',
				),
				array(
					'text'=>'修改客服',
					'link'=>'c_custom/custom_edit',
				),
				array(
					'text'=>'添加客服',
					'link'=>'c_custom/custom_add',
				),
				array(
					'text'=>'冻结客服',
					'link'=>'c_custom/custom_freeze',
				),
				array(
					'text'=>'删除客服',
					'link'=>'c_custom/custom_delete',
				),
				array(
					'text'=>'激活客服',
					'link'=>'c_custom/custom_active',
				),
			)
		),
		array(
			'text'=>'统计分析',
			'link'=>'',
			'children'=>array(
				array(
					'text'=>'实时统计',
					'link'=>'c_statistic_realtime/index',
				),
				array(
					'text'=>'时段统计',
					'link'=>'c_statistic_timesection/index',
				),
				array(
					'text'=>'老师统计',
					'link'=>'c_statistic_teacher/index',
				),
				array(
					'text'=>'学生统计',
					'link'=>'c_statistic_student/index',
				),
				array(
					'text'=>'辅导统计',
					'link'=>'c_statistic_teaching/index',
				)
			)
		),
		array(
			'text'=>'回放分类',
			'link'=>'c_playback/manager',
			'children'=>array()
		),
		array(
			'text'=>'查看异常',
			'link'=>'c_exception/manager',
			'children'=>array()
		),
		array(
			'text'=>'老师反馈',
			'link'=>'c_teacher_feedback/manager',
			'children'=>array()
		),
		array(
			'text'=>'个人资料',
			'link'=>'c_person/index',
			'children'=>array()
		),
	),
	'teacher_privity'=>array(   //老师权限
		'c_index/index',
		'c_statistic_teacher/index',
		'c_statistic_student/index',
		'c_person/index',
		'c_teacher_feedback/manager'
	),
	'action_link'=>array(   //快捷操作
		array(
			'title'=>'角色管理',
			'list'=>array(
				array(
					'title'=>'老师管理',
					'action'=>'c_teacher/manager',
					'parames'=>array(),
					'prefix_class'=>'am-icon-list',
				),
				array(
					'title'=>'测试老师管理',
					'action'=>'c_teacher/test_manager',
					'parames'=>array(),
					'prefix_class'=>'am-icon-list',
				),
				array(
					'title'=>'客服管理',
					'action'=>'c_custom/manager',
					'parames'=>array(),
					'prefix_class'=>'am-icon-list',
				),
				array(
					'title'=>'学生管理',
					'action'=>'c_student/manager',
					'parames'=>array(),
					'prefix_class'=>'am-icon-list',
				),
				array(
					'title'=>'工作人员',
					'action'=>'c_privity/user_manager',
					'parames'=>array(),
					'prefix_class'=>'am-icon-list',
				),
			)
		),
		array(
			'title'=>'统计分析',
			'list'=>array(
				array(
					'title'=>'实时统计',
					'action'=>'c_statistic_realtime/index',
					'parames'=>array(),
					'prefix_class'=>'am-icon-line-chart',
				),
				array(
					'title'=>'时段统计',
					'action'=>'c_statistic_timesection/index',
					'parames'=>array(),
					'prefix_class'=>'am-icon-line-chart',
				),
				array(
					'title'=>'老师统计',
					'action'=>'c_statistic_teacher/index',
					'parames'=>array(),
					'prefix_class'=>'am-icon-list',
				),
				array(
					'title'=>'学生统计',
					'action'=>'c_statistic_student/index',
					'parames'=>array(),
					'prefix_class'=>'am-icon-list',
				),
				array(
					'title'=>'辅导统计',
					'action'=>'c_statistic_teaching/index',
					'parames'=>array(),
					'prefix_class'=>'am-icon-list',
				)
			)
		),
		array(
			'title'=>'其它',
			'list'=>array(
				array(
					'title'=>'回放分类',
					'action'=>'c_playback/manager',
					'parames'=>array(),
					'prefix_class'=>'am-icon-recycle',
				),
				array(
					'title'=>'异常',
					'action'=>'c_exception/manager',
					'parames'=>array(),
					'prefix_class'=>'am-icon-bug',
				),
				array(
					'title'=>'老师反馈',
					'action'=>'c_teacher_feedback/manager',
					'parames'=>array(),
					'prefix_class'=>'am-icon-bug',
				),
				array(
					'title'=>'权限组管理',
					'action'=>'c_privity/group_manager',
					'parames'=>array(),
					'prefix_class'=>'am-icon-gear',
				),
				array(
					'title'=>'公告管理',
					'action'=>'c_publish/manager',
					'parames'=>array(),
					'prefix_class'=>'am-icon-volume-up',
				),
				array(
					'title'=>'个人资料',
					'action'=>'c_person/index',
					'parames'=>array(),
					'prefix_class'=>'am-icon-file',
				),
			)
		),
	),
);

//api
$config['api_uri'] = 'http://yunfudao.strongwind.cn/api/index.php';
$config['api_key'] = '731222260492(readboy)25489884364';
$config['api_version'] = 'server_v2';

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
//	array("id"=>"2","text"=>"删除的老师","privity"=>"c_teacher/teacher_delete"),
//	array("id"=>"4","text"=>"测试的老师","privity"=>"c_teacher/teacher_set_test"),
);
$config['status_list_view_student'] = array(
	array("id"=>"0","text"=>"激活的学生","privity"=>"c_student/student_active"),
	array("id"=>"1","text"=>"冻结的学生","privity"=>"c_student/student_freeze"),
	array("id"=>"2","text"=>"删除的学生","privity"=>"c_student/student_delete"),
	array("id"=>"4","text"=>"测试的学生","privity"=>"c_student/student_set_test"),
);
//客服
$config['status_list_view_custom'] = array(
	array("id"=>"0","text"=>"激活的客服","privity"=>"c_custom/custom_active"),
	array("id"=>"1","text"=>"冻结的客服","privity"=>"c_custom/custom_freeze"),
);
//列表页面
$config['page'] = 12;

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
