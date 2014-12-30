<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_Login extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}
	
	/**
	 * 显示login界面
	 *
	 */
	public function index()
	{
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			//data
			$data = $this->_get_data(__CLASS__,__METHOD__);
			$data['login_valid_url'] = get_login_valid_url();
			$this->_output_view("login/v_login", $data,true);
		}
		else	//已登录
		{
			//跳转到首页
			top_redirect(get_index_url());
		}
	}
	
	/**
	 * login验证
	 *
	 */
	public function login_valid($parames = array())
	{
		$data = array();
		$data['error'] = 0;

		//验证登录
		$this -> load -> model('M_login', 'mlogin');
		$user_info = $this->mlogin->check_user_login($parames['name'],$parames['pwd']);
		if(!(is_array($user_info) && isset($user_info['F_id'])))
		{
			//用户名或密码错误
			$data['error'] = -1;
		}

		//返回json数据
		if($data['error'] == 0)
		{

			$data['redirect_url'] = get_index_url();
		}

		$this->_ajax_echo($data);
	}

	/**
	 * login out
	 *
	 */
	public function login_out()
	{
		//销毁session
		$this -> load -> model('M_login', 'mlogin');
		$cap = $this->mlogin->login_out();
		
		//跳转到登陆页面
		top_redirect(get_login_url());
	}

}

/* End of file c_login.php */
/* Location: ./application/controllers/c_login.php */