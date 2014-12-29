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
		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['teacher_online_num'] = $result['teacher_online_num'];
		$data['student_online_num'] = $result['student_online_num'];
		$this->_output_view("index/v_index", $data);
	}

	public function index2()
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
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$this->_output_view("v_index2", $data);
	}

	public function index3()
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
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$this->_output_view("v_index3", $data);
	}

	public function index4()
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
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$this->_output_view("v_index4", $data);
	}


}

/* End of file c_index.php */
/* Location: ./application/controllers/c_index.php */