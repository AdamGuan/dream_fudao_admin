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
		//
		//status_list
		$status_list = array(
			array("key"=>get_controll_url("c_privity/group_manager",array("F_status"=>0)),"value"=>"冻结","active"=>0),
			array("key"=>get_controll_url("c_privity/group_manager",array("F_status"=>1)),"value"=>"激活","active"=>0),
			array("key"=>get_controll_url("c_privity/group_manager",array()),"value"=>"全部","active"=>0),
		);
		if(isset($parames['F_status']) && in_array($parames['F_status'],array(-1,0,1)))
		{
			switch($parames['F_status'])
			{
				case 0:
					$status_list[0]['active'] = 1;
					break;
				case 1:
					$status_list[1]['active'] = 1;
					break;
				case -1:
					$status_list[2]['active'] = 1;
					break;
				default:
					$status_list[2]['active'] = 1;
					break;
			}
		}
		else{
			$status_list[2]['active'] = 1;
		}

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['do'] = $this->session->flashdata('do');
		$data['group_list'] = $group_list_result;
		$data['group_add_url'] = base_url("c_privity/group_add");
		$data['self_privity_id'] = $this->session->userdata('F_privity_group_id');
		$data['status_list'] = $status_list;

		$this->_output_view("privity/v_group_manager", $data);
	}

	/**
	 * 添加权限组的页面
	 * @param array $parames
	 */
	public function group_add($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"group_manager") === false)
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
		$data['content_title'] = "添加权限组";
		$data['group_list'] = $group_list;
		$data['global_privity_htmlstr'] = $global_privity_htmlstr;
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

	//ajax
	public function group_add_do($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"group_manager") === false)
		{
			redirect_to_no_privity_page();
		}
		//业务
		$this -> load -> model('M_privity', 'mprivity');
		$data = $this->mprivity->group_add($parames);

		$this->_ajax_echo($data);
	}

	//ajax
	public function group_freeze($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"group_manager") === false)
		{
			redirect_to_no_privity_page();
		}
		//业务
		$this -> load -> model('M_privity', 'mprivity');
		$parames['F_status'] = 0;
		$result = $this->mprivity->group_change_status($parames);
		$data = array("error"=>-1,"msg"=>"操作失败,请重试");
		if($result)
		{
			$this->session->set_flashdata('do', 'success');
			$data = array("error"=>0,"msg"=>"成功");
		}

		$this->_ajax_echo($data);
	}

	//ajax
	public function group_active($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"group_manager") === false)
		{
			redirect_to_no_privity_page();
		}
		//业务
		$this -> load -> model('M_privity', 'mprivity');
		$parames['F_status'] = 1;
		$result = $this->mprivity->group_change_status($parames);
		$data = array("error"=>-1,"msg"=>"操作失败,请重试");
		if($result)
		{
			$this->session->set_flashdata('do', 'success');
			$data = array("error"=>0,"msg"=>"成功");
		}

		$this->_ajax_echo($data);
	}

	//ajax
	public function group_delete($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"group_manager") === false)
		{
			redirect_to_no_privity_page();
		}
		//业务
		$this -> load -> model('M_privity', 'mprivity');
		$result = $this->mprivity->group_change_delete($parames);
		$data = array("error"=>-1,"msg"=>"操作失败,请重试");
		if($result)
		{
			$this->session->set_flashdata('do', 'success');
			$data = array("error"=>0,"msg"=>"成功");
		}

		$this->_ajax_echo($data);
	}

	/**
	 * 编辑权限组的页面
	 * @param array $parames
	 */
	public function group_edit($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"group_manager") === false)
		{
			redirect_to_no_privity_page();
		}
		//业务
		$this -> load -> model('M_privity', 'mprivity');
		$group_info = $this->mprivity->get_group_info($parames);

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['content_title'] = "编辑权限组";
		$data['group_info'] = $group_info;
		$this->_output_view("privity/v_group_edit", $data);
	}

	//ajax
	public function group_modify_do($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"group_manager") === false)
		{
			redirect_to_no_privity_page();
		}
		//业务
		$this -> load -> model('M_privity', 'mprivity');
		$data = $this->mprivity->group_update($parames);

		$this->_ajax_echo($data);
	}

	/**
	 * 用户管理
	 * @param array $parames
	 */
	public function user_manager($parames = array())
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

		//user list
		$this -> load -> model('M_privity', 'mprivity');
		$user_list_result = $this->mprivity->get_user_list($parames);
		//group list
		$group_list = array();
		$group_list_result = $this->mprivity->get_group_list();
		$p = array();
		if(isset($parames['F_status']))
		{
			$p['F_status'] = $parames['F_status'];
		}
		$group_list[] = array("key"=>get_controll_url("c_privity/user_manager",$p),"value"=>'全部',"active"=>0);
		foreach($group_list_result as $item)
		{
			$active = 0;
			if(isset($parames['F_privity_group_id']) && $item['F_id'] == $parames['F_privity_group_id'])
			{
				$active = 1;
			}
			$p['F_privity_group_id'] = $item['F_id'];
			$group_list[] = array("key"=>get_controll_url("c_privity/user_manager",$p),"value"=>$item['F_name'],"active"=>$active);
		}
		//status_list
		$p = array();
		if(isset($parames['F_privity_group_id']))
		{
			$p['F_privity_group_id'] = $parames['F_privity_group_id'];
		}
		$p1 = $p2 = $p3 = $p;
		$p1['F_status'] = 0;
		$p2['F_status'] = 1;
		$status_list = array(
			array("key"=>get_controll_url("c_privity/user_manager",$p1),"value"=>"冻结","active"=>0),
			array("key"=>get_controll_url("c_privity/user_manager",$p2),"value"=>"激活","active"=>0),
			array("key"=>get_controll_url("c_privity/user_manager",$p3),"value"=>"全部","active"=>0),
		);
		if(isset($parames['F_status']) && in_array($parames['F_status'],array(0,1)))
		{
			switch($parames['F_status'])
			{
				case 0:
					$status_list[0]['active'] = 1;
					break;
				case 1:
					$status_list[1]['active'] = 1;
					break;
				default:
					$status_list[2]['active'] = 1;
					break;
			}
		}
		else{
			$status_list[2]['active'] = 1;
		}

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['do'] = $this->session->flashdata('do');
		$data['user_list'] = $user_list_result;
		$data['group_list'] = $group_list;
		$data['status_list'] = $status_list;
		$data['user_add_url'] = base_url("c_privity/user_add");

		$this->_output_view("privity/v_user_manager", $data);
	}

	//ajax
	public function user_freeze($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"user_manager") === false)
		{
			redirect_to_no_privity_page();
		}
		//业务
		$this -> load -> model('M_privity', 'mprivity');
		$parames['F_status'] = 0;
		$result = $this->mprivity->user_change_status($parames);
		$data = array("error"=>-1,"msg"=>"操作失败,请重试");
		if($result)
		{
			$this->session->set_flashdata('do', 'success');
			$data = array("error"=>0,"msg"=>"成功");
		}

		$this->_ajax_echo($data);
	}

	//ajax
	public function user_active($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"user_manager") === false)
		{
			redirect_to_no_privity_page();
		}
		//业务
		$this -> load -> model('M_privity', 'mprivity');
		$parames['F_status'] = 1;
		$result = $this->mprivity->user_change_status($parames);
		$data = array("error"=>-1,"msg"=>"操作失败,请重试");
		if($result)
		{
			$this->session->set_flashdata('do', 'success');
			$data = array("error"=>0,"msg"=>"成功");
		}

		$this->_ajax_echo($data);
	}

	//ajax
	public function user_delete($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"user_manager") === false)
		{
			redirect_to_no_privity_page();
		}
		//业务
		$this -> load -> model('M_privity', 'mprivity');
		$result = $this->mprivity->user_delete($parames);
		$data = array("error"=>-1,"msg"=>"操作失败,请重试");
		if($result)
		{
			$this->session->set_flashdata('do', 'success');
			$data = array("error"=>0,"msg"=>"成功");
		}

		$this->_ajax_echo($data);
	}

	public function user_add($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"user_manager") === false)
		{
			redirect_to_no_privity_page();
		}
		//业务

		//获取权限组列表
		$this -> load -> model('M_privity', 'mprivity');
		$group_list = $this->mprivity->get_group_list_valid($parames);
		$group_list = build_privity_group($group_list);

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['content_title'] = "添加工作人员";
		$data['group_list'] = $group_list;
		$this->_output_view("privity/v_user_add", $data);
	}

	//ajax
	public function user_add_do($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"user_manager") === false)
		{
			redirect_to_no_privity_page();
		}
		//业务
		$this -> load -> model('M_privity', 'mprivity');
		$data = $this->mprivity->user_add($parames);

		$this->_ajax_echo($data);
	}

}

/* End of file c_privity.php */
/* Location: ./application/controllers/c_privity.php */