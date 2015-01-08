<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_person extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

	//
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
		$info = array(
				'name'=>$this -> session -> userdata('F_login_name'),
				'group'=>$this -> session -> userdata('F_role_name'),
				'is_teacher'=>$this -> session -> userdata('is_teacher')
		);

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['info'] = $info;
		$this->_output_view("person/v_index", $data);
	}

	//
	public function do_modify_info($parames = array())
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
		$data = array();
		$data['error'] = -1;
		$this -> load -> model('M_person', 'mperson');
		if(isset($parames['is_teacher']) && $parames['is_teacher'])
		{
			if($this->mperson->update_teacher_info($parames)){
				$data['error'] = 0;
			}
		}
		else{
			if($this->mperson->update_user_info($parames)){
				$data['error'] = 0;
			}
		}
		if($data['error'] == -1)
		{
			$data['msg'] = '修改失败，请重试';
		}
		$this->_ajax_echo($data);
	}


}

/* End of file c_person.php */
/* Location: ./application/controllers/c_person.php */