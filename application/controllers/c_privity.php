<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_privity extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

	/**
	 * 权限组管理
	 * @param array $parames
	 */
	public function group_manager($parames = array())
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

		//
		$this -> load -> model('M_privity', 'mprivity');
		$group_list_result = $this->mprivity->get_group_list($parames);

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['do'] = $this->session->flashdata('do');
		$data['group_list'] = $group_list_result;
		$data['group_add_url'] = base_url("c_privity/group_add");

		$this->_output_view("privity/v_group_manager", $data);
	}

	public function group_add($parames = array()){
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

		//获取权限组列表
		$this -> load -> model('M_privity', 'mprivity');
		$group_list = $this->mprivity->get_group_list_valid($parames);
		$group_list = build_privity_group($group_list);
		//获取权限列表
		$global_privity_htmlstr = $this->mprivity->get_privity_htmlstr(array("privity"=>$this->session->userdata('privaty')));

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['group_list'] = $group_list;
		$data['global_privity_htmlstr'] = $global_privity_htmlstr;
		if(!isset($parames['refrence']))
		{
			$parames['refrence'] = base_url("c_privity/group_manager");
		}
		$data['refrence'] = $parames['refrence'];
		$this->_output_view("privity/v_group_add", $data);
	}

	//ajax
	public function get_privity_htmlstr($parames = array()){
		$this -> load -> model('M_privity', 'mprivity');
		//查询权限组的权限
		$privity = $this->mprivity->get_group_privity($parames['group_id']);
		//获取权限列表
		$privity_htmlstr = $this->mprivity->get_privity_htmlstr(array("privity"=>$privity));
		$data = array('htmlstr'=>$privity_htmlstr,'error'=>0);
		$this->_ajax_echo($data);
	}


}

/* End of file c_privity.php */
/* Location: ./application/controllers/c_privity.php */