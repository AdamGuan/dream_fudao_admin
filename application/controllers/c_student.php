<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_student extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

	/**
	 * 学生管理
	 * @param array $parames
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
			$item['url'] = get_student_manager_list_url(array('page'=>$i));
			$item['page'] = $i;
			if($i == (int)$parames['page'])
			{
				$item['url'] = "#";
				$item['active'] = 1;
				$page_pre_url = get_student_manager_list_url(array('page'=>$i-1));
				$page_next_url = get_student_manager_list_url(array('page'=>$i+1));
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

		$this->_output_view("student/v_manager", $data);
	}


}

/* End of file c_student.php */
/* Location: ./application/controllers/c_student.php */