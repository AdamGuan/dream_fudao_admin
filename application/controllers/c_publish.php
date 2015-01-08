<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_publish extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

	/**
	 *
	 * @param array $parames
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

		//
		$this -> load -> model('M_publish', 'mpublish');
		$list = $this->mpublish->get_publish_list();

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['do'] = $this->session->flashdata('do');
		$data['list'] = $list;
		$data['publish_add_uri'] = my_site_url("c_publish/add");

		$this->_output_view("publish/v_manager", $data);
	}

	/**
	 * ajax
	 * @param array $parames
	 *                  F_ids   string  IDs,如1,2,3
	 */
	public  function delete($parames = array()){
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
		$this -> load -> model('M_publish', 'mpublish');
		$result = $this->mpublish->delete_publish($parames);
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
	 * @param array $parames
	 */
	public function add($parames = array())
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

//		$this -> load -> model('M_publish', 'mpublish');

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['content_title'] = "添加公告";

		$this->_output_view("publish/v_add", $data);
	}

	/**
	 * ajax添加
	 * @param array $parames
	 */
	public function add_do($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"publish_add") === false)
		{
			redirect_to_no_privity_page();
		}
		//业务
		$data = array("error"=>0);
		$this -> load -> model('M_publish', 'mpublish');
		$result = $this->mpublish->add_a_publish($parames);
		if($result !== true)
		{
			$data["error"] = -1;
			$data["msg"] = "添加失败";
		}
		else{
			$data["error"] = 0;
			$data["msg"] = "添加成功";
		}
		$this->_ajax_echo($data);
	}

	/**
	 * @param array $parames
	 */
	public function edit($parames = array())
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
		//get publish info
		$this -> load -> model('M_publish', 'mpublish');
		$info = $this->mpublish->get_a_publish_info($parames);

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['do'] = $this->session->flashdata('do');
		$data['content_title'] = "编辑公告";
		$data['info'] = $info;

		$this->_output_view("publish/v_edit", $data);
	}

	/**
	 * ajax
	 * @param array $parames
	 */
	public function modify($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"publish_edit") === false)
		{
			redirect_to_no_privity_page();
		}
		//业务
		$data = array("error"=>0);
		$this -> load -> model('M_publish', 'mpublish');
		$result = $this->mpublish->update_a_publish($parames);
		if($result !== true)
		{
			$data["error"] = -1;
			$data["msg"] = "失败";
		}
		else{
			$data["error"] = 0;
			$data["msg"] = "成功";
			$this->session->set_flashdata('do', 'success');
		}
		$this->_ajax_echo($data);
	}

}

/* End of file c_publish.php */
/* Location: ./application/controllers/c_publish.php */