<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_index extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

	//没有权限显示页
	public function no_privity()
	{
		echo "no privity!";exit;
	}

	//后台首页
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
		$this -> load -> model('M_index', 'mindex');
		$result = $this->mindex->get_online_num();
		$action_link = $this->my_config['data']['action_link'];
		foreach($action_link as $key=>$item)
		{
			if(isset($item['list']) && is_array($item['list']) && count($item['list']) > 0)
			{
				foreach($item['list'] as $k=>$it)
				{
					if(!check_privity($it['action']))
					{
						unset($item['list'][$k]);
					}
				}
				if(count($item['list']) <= 0)
				{
					unset($action_link[$key]);
				}
			}
			else{
				unset($action_link[$key]);
			}
		}
		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['teacher_online_num'] = $result['teacher_online_num'];
		$data['student_online_num'] = $result['student_online_num'];
		$data['action_link'] = $action_link;
		$this->_output_view("index/v_index", $data);
	}


}

/* End of file c_index.php */
/* Location: ./application/controllers/c_index.php */