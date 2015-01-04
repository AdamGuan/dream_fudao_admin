<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_realtime_statistic extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

	/**
	 * 实时统计
	 * @param array $parames
	 *          type    int 0：激活，1：冻结，2：删除,-1所有
	 */
	public function index($parames = array())
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

		//获取老师以及学生在线统计
		if(!isset($parames['type']))
		{
			$parames['type'] = 0;
		}
		if(!isset($parames['page']))
		{
			$parames['page'] = 1;
		}
		$this -> load -> model('M_custom', 'mcustom');
		$custom_list_result = $this->mcustom->get_custom_list($parames);
		if(is_array($custom_list_result) && count($custom_list_result) > 0)
		{
			foreach($custom_list_result['list'] as $k=>$item)
			{
				$custom_list_result['list'][$k]['F_status_text'] = $this->my_config['status_list'][$item['F_status']];
			}
		}
		//set page list
		$page_total = 1;
		if(isset($custom_list_result['total']))
		{
			$page_total = (int)ceil($custom_list_result['total']/$this->my_config['page']);
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
			$item['url'] = get_custom_manager_list_url(array('page'=>$i,'type'=>(int)$parames['type']));
			$item['page'] = $i;
			if($i == (int)$parames['page'])
			{
				$item['url'] = "#";
				$item['active'] = 1;
				$page_pre_url = get_custom_manager_list_url(array('page'=>$i-1,'type'=>(int)$parames['type']));
				$page_next_url = get_custom_manager_list_url(array('page'=>$i+1, 'type'=>(int)$parames['type']));
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
		//set custom status list
		$status_list = array();
		foreach($this->my_config['status_list_view_custom'] as $item)
		{
			$it = array('key'=>get_custom_manager_list_url(array('type'=>$item['id'])),'value'=>$item['text'],
					'active'=>false);
			if((int)$parames['type'] == $item['id'])
			{
				$it['active'] = true;
			}
			$status_list[] = $it;
		}

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['do'] = $this->session->flashdata('do');
		$data['custom_list'] = isset($custom_list_result['list'])?$custom_list_result['list']:array();
		$data['custom_total'] = isset($custom_list_result['total'])?$custom_list_result['total']:0;
		$data['page_total'] = $page_total;
		$data['page_list'] = $page_list;
		$data['page_pre_active'] = $page_pre_active;
		$data['page_next_active'] = $page_next_active;
		$data['page_pre_url'] = $page_pre_url;
		$data['page_next_url'] = $page_next_url;
		$data['status_list'] = $status_list;
		$data['custom_freeze_uri'] = base_url("c_custom/custom_freeze");
		$data['custom_delete_uri'] = base_url("c_custom/custom_delete");
		$data['custom_active_uri'] = base_url("c_custom/custom_active");
		$data['custom_add_uri'] = base_url("c_custom/custom_add");

		$this->_output_view("custom/v_manager", $data);
	}

}

/* End of file c_realtime_statistic.php */
/* Location: ./application/controllers/c_realtime_statistic.php */