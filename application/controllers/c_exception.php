<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_exception extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

	/**
	 * 回放管理
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

		//get playback list
		if(!isset($parames['page']))
		{
			$parames['page'] = 1;
		}
		$parames2 = array();
		$parames2['page'] = $parames['page'];
		if(isset($parames['F_teacher_real_name']))
		{
			$parames2['F_teacher_real_name'] = $parames['F_teacher_real_name'];
		}
		if(isset($parames['F_user_real_name']))
		{
			$parames2['F_user_real_name'] = $parames['F_user_real_name'];
		}
		$parames3 = $parames2;
		$this -> load -> model('M_playback', 'mplayback');
		$tmp = $parames;
		$tmp['type'] = 3;
		$playback_list_result = $this->mplayback->get_playback_list($tmp);
		//set page list
		$page_total = 1;
		if(isset($playback_list_result['total']))
		{
			$page_total = (int)ceil($playback_list_result['total']/$this->my_config['page']);
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
			$parames2['page'] = $i;
			$item['url'] = get_playback_manager_list_url($parames2);
			$item['page'] = $i;
			if($i == (int)$parames['page'])
			{
				$item['url'] = "#";
				$item['active'] = 1;
				$parames2['page'] = $i-1;
				$page_pre_url = get_playback_manager_list_url($parames2);
				$parames2['page'] = $i+1;
				$page_next_url = get_playback_manager_list_url($parames2);
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
		$data['playback_list'] = isset($playback_list_result['list'])?$playback_list_result['list']:array();
		$data['playback_total'] = isset($playback_list_result['total'])?$playback_list_result['total']:0;
		$data['page_total'] = $page_total;
		$data['page_list'] = $page_list;
		$data['page_pre_active'] = $page_pre_active;
		$data['page_next_active'] = $page_next_active;
		$data['page_pre_url'] = $page_pre_url;
		$data['page_next_url'] = $page_next_url;
		$data['search_text'] = isset($parames3['F_user_real_name'])?$parames3['F_user_real_name']:"";

		$this->_output_view("exception/v_manager", $data);
	}

}

/* End of file c_exception.php */
/* Location: ./application/controllers/c_exception.php */