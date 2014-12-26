<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_teacher extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

	//老师管理
	public function manager($parames = array())
	{
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity() === false)
		{
			redirect_to_no_privity_page();
		}
		//业务

		//get teacher list
		if(!isset($parames['type']))
		{
			$parames['type'] = 0;
		}
		if(!isset($parames['page']))
		{
			$parames['page'] = 1;
		}
		$this -> load -> model('M_teacher', 'mteacher');
		$teacher_list_result = $this->mteacher->get_teacher_list($parames);
		if(is_array($teacher_list_result) && count($teacher_list_result) > 0)
		{
			foreach($teacher_list_result['list'] as $k=>$item)
			{
				$teacher_list_result['list'][$k]['F_grade_text'] = $this->my_config['grade_list'][$item['F_grade']];
				$teacher_list_result['list'][$k]['F_subject_text'] = $this->my_config['subject_list'][$item['F_subject_id']];
				$teacher_list_result['list'][$k]['F_status_text'] = $this->my_config['status_list'][$item['F_status']];
			}
		}
		//set page list
		$page_total = 1;
		if(isset($teacher_list_result['total']))
		{
			$page_total = (int)ceil($teacher_list_result['total']/$this->my_config['page']);
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
			$item['url'] = get_teacher_manager_list_url(array('page'=>$i,'type'=>(int)$parames['type']));
			$item['page'] = $i;
			if($i == (int)$parames['page'])
			{
				$item['url'] = "#";
				$item['active'] = 1;
				$page_pre_url = get_teacher_manager_list_url(array('page'=>$i-1,'type'=>(int)$parames['type']));
				$page_next_url = get_teacher_manager_list_url(array('page'=>$i+1, 'type'=>(int)$parames['type']));
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
		//set teacher status list
		$status_list = array();
		foreach($this->my_config['status_list_view'] as $k=>$item)
		{
			$it = array('key'=>get_teacher_manager_list_url(array('type'=>$k)),'value'=>$item, 'active'=>false);
			if((int)$parames['type'] == $k)
			{
				$it['active'] = true;
			}
			$status_list[] = $it;
		}

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['teacher_list'] = isset($teacher_list_result['list'])?$teacher_list_result['list']:array();
		$data['teacher_total'] = isset($teacher_list_result['total'])?$teacher_list_result['total']:0;
		$data['page_total'] = $page_total;
		$data['page_list'] = $page_list;
		$data['page_pre_active'] = $page_pre_active;
		$data['page_next_active'] = $page_next_active;
		$data['page_pre_url'] = $page_pre_url;
		$data['page_next_url'] = $page_next_url;
		$data['status_list'] = $status_list;
		$data['change_teacher_status_uri'] = base_url("c_teacher/manager");
		$this->_output_view("teacher/v_manager", $data);
	}

	public function do_change_teacher_status($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity() === false)
		{
			$this->_ajax_echo(array('msg'=>'没有权限'));
		}
		//业务
		//
		$this -> load -> model('M_teacher', 'mteacher');
		$result = $this->mteacher->change_teacher_status($parames);

		$data = array('result'=>$result);
		$this->_ajax_echo($data);
	}

}

/* End of file c_teacher.php */
/* Location: ./application/controllers/c_teacher.php */