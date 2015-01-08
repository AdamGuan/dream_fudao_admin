<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_student extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

	/**
	 * 学生管理
	 * @param array $parames
	 *          type    int 0：激活，1：冻结，2：删除，3：彻底删除，4：测试
	 *          page    int 列表页面
	 */
	public function manager($parames = array())
	{
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,__METHOD__) === false)
		{
			redirect_to_no_privity_page();
		}
		//业务

		//get student list
		if(!isset($parames['type']))
		{
			$parames['type'] = 0;
		}
		if(!isset($parames['page']))
		{
			$parames['page'] = 1;
		}
		$this -> load -> model('M_student', 'mstudent');
		$student_list_result = $this->mstudent->get_student_list($parames);
		if(is_array($student_list_result) && count($student_list_result) > 0)
		{
			foreach($student_list_result['list_info'] as $k=>$item)
			{
				$student_list_result['list_info'][$k]['F_grade_text'] = isset
				($this->my_config['class_list'][$item['F_grade']])?$this->my_config['class_list'][$item['F_grade']]:"";
			}
		}
		//set page list
		$page_total = 1;
		if(isset($student_list_result['student_total']))
		{
			$page_total = (int)ceil($student_list_result['student_total']/$this->my_config['page']);
		}
		$page_list = array();
		$page_pre_active =  true;
		$page_pre_url =  "#";
		$page_next_active =  true;
		$page_next_url =  "#";
		for($i=1;$i<=$page_total;++$i)
		{
			$item = array();
			$item['active'] = 0;
			$tmp = $parames;
			$tmp['page'] = $i;
			$item['url'] = get_student_manager_list_url($tmp);
			$item['page'] = $i;
			if($i == (int)$parames['page'])
			{
				$item['url'] = "#";
				$item['active'] = 1;
				$tmp = $parames;
				$tmp['page'] = $i-1;
				$page_pre_url = get_student_manager_list_url($tmp);
				$tmp['page'] = $i+1;
				$page_next_url = get_student_manager_list_url($tmp);
				if($i == 1)
				{
					$page_pre_active = false;
					$page_pre_url = "#";
				}
				if($i == $page_total)
				{
					$page_next_active =  false;
					$page_next_url = "#";
				}
			}
			$page_list[] = $item;
		}
		//set student status list
		$status_list = array();
		foreach($this->my_config['status_list_view_student'] as $item)
		{
			if(check_privity($item['privity']))
			{
				$it = array('key'=>get_student_manager_list_url(array('type'=>$item['id'])),'value'=>$item['text'],
					'active'=>false);
				if((int)$parames['type'] == $item['id'])
				{
					$it['active'] = true;
				}
				$status_list[] = $it;
			}
		}


		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['do'] = $this->session->flashdata('do');
		$data['student_list'] = isset($student_list_result['list_info'])?$student_list_result['list_info']:array();
		$data['student_total'] = isset($student_list_result['student_total'])?$student_list_result['student_total']:0;
		$data['page_total'] = $page_total;
		$data['page_list'] = $page_list;
		$data['page_pre_active'] = $page_pre_active;
		$data['page_next_active'] = $page_next_active;
		$data['page_pre_url'] = $page_pre_url;
		$data['page_next_url'] = $page_next_url;
		$data['status_list'] = $status_list;
		$data['student_freeze_uri'] = my_site_url("c_student/student_freeze");
		$data['student_delete_uri'] = my_site_url("c_student/student_delete");
		$data['student_active_uri'] = my_site_url("c_student/student_active");
		$data['student_set_test_uri'] = my_site_url("c_student/student_set_test");
		$data['search_text'] = isset($parames['F_user_name'])?$parames['F_user_name']:'';

		$this->_output_view("student/v_manager", $data);
	}

	/**
	 * 改变学生状态
	 * @param array $parames
	 *                  F_user_ids   string  学生IDs,如1,2,3
	 *                 F_status   int 0：激活，1：冻结，2：删除，3：彻底删除，4：测试
	 */
	private  function _do_change_student_status($parames = array()){
		//
		$this -> load -> model('M_student', 'mstudent');
		$result = $this->mstudent->change_student_status($parames);
		if($result === true)
		{
			$this->session->set_flashdata('do', 'success');
		}else{
			$this->session->set_flashdata('do', 'fail');
		}

		$data = array('result'=>$result);
		$this->_ajax_echo($data);
	}

	/**
	 * ajax冻结学生
	 * @param array $parames
	 *                  F_user_ids   string  学生IDs,如1,2,3
	 */
	public function student_freeze($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,__METHOD__) === false)
		{
			$this->_ajax_echo(array('msg'=>'没有权限'));
		}
		//业务
		$parames['F_status'] = 1;
		$this->_do_change_student_status($parames);
	}

	/**
	 * ajax删除学生
	 * @param array $parames
	 *                  F_user_ids   string  学生IDs,如1,2,3
	 */
	public function student_delete($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,__METHOD__) === false)
		{
			$this->_ajax_echo(array('msg'=>'没有权限'));
		}
		//业务
		$parames['F_status'] = 2;
		$this->_do_change_student_status($parames);
	}

	/**
	 * ajax激活学生
	 * @param array $parames
	 *                  F_user_ids   string  学生IDs,如1,2,3
	 */
	public function student_active($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,__METHOD__) === false)
		{
			$this->_ajax_echo(array('msg'=>'没有权限'));
		}
		//业务
		$parames['F_status'] = 0;
		$this->_do_change_student_status($parames);
	}

	/**
	 * ajax设置学生为测试帐号
	 * @param array $parames
	 *                  F_teacher_ids   string  老师IDs,如1,2,3
	 */
	public function student_set_test($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,__METHOD__) === false)
		{
			$this->_ajax_echo(array('msg'=>'没有权限'));
		}
		//业务
		$parames['F_status'] = 4;
		$this->_do_change_student_status($parames);
	}

}

/* End of file c_student.php */
/* Location: ./application/controllers/c_student.php */