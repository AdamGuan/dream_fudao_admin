<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//输出到view的值
$config['data'] = array(
	'global_web_title_pro'=>'一对一辅导',
	'global_web_title_suffix'=>'控制平台',
	'global_web_license'=>'© 2014 dream license.',
	'global_left_bar'=>array(
		array(
			'prefix_class'=>'am-icon-home',
			'text'=>'登录',
			'link'=>'c_login/index',
			'active'=>0,
			'children'=>array(),
			'hidden'=>1
		),
		array(
			'prefix_class'=>'am-icon-home',
			'text'=>'首页',
			'link'=>'c_index/index',
			'active'=>0,
			'children'=>array()
		),
		array(
			'prefix_class'=>'am-icon-file',
			'text'=>'角色管理',
			'link'=>'',
			'active'=>0,
			'children'=>array(
				array(
					'prefix_class'=>'am-icon-file',
					'text'=>'老师管理',
					'link'=>'c_teacher/manager',
					'active'=>0,
					'children'=>array(
						array(
							'prefix_class'=>'am-icon-file',
							'text'=>'修改老师',
							'link'=>'c_teacher/teacher_edit',
							'active'=>0,
							'hidden'=>1
						),
						array(
							'prefix_class'=>'am-icon-file',
							'text'=>'添加老师',
							'link'=>'c_teacher/teacher_add',
							'active'=>0,
							'hidden'=>1
						),
						array(
							'prefix_class'=>'am-icon-file',
							'text'=>'冻结老师',
							'link'=>'c_teacher/teacher_freeze',
							'active'=>0,
							'hidden'=>1
						),
						array(
							'prefix_class'=>'am-icon-file',
							'text'=>'删除老师',
							'link'=>'c_teacher/teacher_delete',
							'active'=>0,
							'hidden'=>1
						),
						array(
							'prefix_class'=>'am-icon-file',
							'text'=>'激活老师',
							'link'=>'c_teacher/teacher_active',
							'active'=>0,
							'hidden'=>1
						),
						array(
							'prefix_class'=>'am-icon-file',
							'text'=>'设置老师为测试帐号',
							'link'=>'c_teacher/teacher_set_test',
							'active'=>0,
							'hidden'=>1
						),
					)
				),
				array(
					'prefix_class'=>'am-icon-file',
					'text'=>'学生管理',
					'link'=>'c_student/manager',
					'active'=>0
				),
				array(
					'prefix_class'=>'am-icon-file',
					'text'=>'工作人员',
					'link'=>'c_index/index4',
					'active'=>0
				)
			)
		),
		array(
			'prefix_class'=>'am-icon-file',
			'text'=>'统计分析',
			'link'=>'',
			'active'=>0,
			'children'=>array(
				array(
					'prefix_class'=>'am-icon-file',
					'text'=>'实时统计',
					'link'=>'c_index/index5',
					'active'=>0
				),
				array(
					'prefix_class'=>'am-icon-file',
					'text'=>'时段统计',
					'link'=>'c_index/index6',
					'active'=>0
				),
				array(
					'prefix_class'=>'am-icon-file',
					'text'=>'老师统计',
					'link'=>'c_index/index7',
					'active'=>0
				),
				array(
					'prefix_class'=>'am-icon-file',
					'text'=>'学生统计',
					'link'=>'c_index/index8',
					'active'=>0
				)
			)
		),
		array(
			'prefix_class'=>'am-icon-home',
			'text'=>'回放分类',
			'link'=>'c_index/index10',
			'active'=>0,
			'children'=>array()
		),
		array(
			'prefix_class'=>'am-icon-file',
			'text'=>'权限设置',
			'link'=>'',
			'active'=>0,
			'children'=>array(
				array(
					'prefix_class'=>'am-icon-file',
					'text'=>'权限组管理',
					'link'=>'c_privity/group_manager',
					'active'=>0,
					'children'=>array(
						array(
							'prefix_class'=>'am-icon-file',
							'text'=>'添加权限组',
							'link'=>'c_privity/group_add',
							'active'=>0,
							'hidden'=>1
						),
					),
				),
				array(
					'prefix_class'=>'am-icon-file',
					'text'=>'成员列表',
					'link'=>'c_privity/user_manager',
					'active'=>0
				),
			)
		),
		array(
			'prefix_class'=>'am-icon-home',
			'text'=>'个人资料',
			'link'=>'c_index/index12',
			'active'=>0,
			'children'=>array()
		),
		array(
			'prefix_class'=>'am-icon-home',
			'text'=>'公告管理',
			'link'=>'c_publish/publish_manager',
			'active'=>0,
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
