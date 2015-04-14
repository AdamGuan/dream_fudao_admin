<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_custom extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

	/**
	 * 客服管理
	 * @param array $parames
	 *          type    int 0：激活，1：冻结，2：删除,-1所有
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

		//get custom list
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
		$page_first_url = get_custom_manager_list_url(array('page'=>1,'type'=>(int)$parames['type']));
		$page_last_url = get_custom_manager_list_url(array('page'=>$page_total,'type'=>(int)$parames['type']));
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
		$page_list = split_page($page_list,(int)$parames['page']);
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
		$data['page_first_url'] = $page_first_url;
		$data['page_last_url'] = $page_last_url;
		$data['status_list'] = $status_list;
		$data['custom_freeze_uri'] = my_site_url("c_custom/custom_freeze");
		$data['custom_delete_uri'] = my_site_url("c_custom/custom_delete");
		$data['custom_active_uri'] = my_site_url("c_custom/custom_active");
		$data['custom_add_uri'] = my_site_url("c_custom/custom_add");

		$this->_output_view("custom/v_manager", $data);
	}

	/**
	 * 改变客服状态
	 * @param array $parames
	 *                  F_teacher_ids   string  客服IDs,如1,2,3
	 *                  F_status   int 0：激活，1：冻结，2：删除，3：彻底删除
	 */
	private  function _do_change_custom_status($parames = array()){
		//
		$this -> load -> model('M_custom', 'mcustom');
		$result = $this->mcustom->change_teacher_status($parames);
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
	 * ajax冻结客服
	 * @param array $parames
	 *                  F_teacher_ids   string  客服IDs,如1,2,3
	 */
	public function custom_freeze($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,__METHOD__) === false)
		{
			$this->_ajax_echo(array('msg'=>'没有权限'));
		}
		//业务
		$parames['F_status'] = 1;
		$this->_do_change_custom_status($parames);
	}

	/**
	 * ajax激活客服
	 * @param array $parames
	 *                  F_teacher_ids   string  客服IDs,如1,2,3
	 */
	public function custom_active($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,__METHOD__) === false)
		{
			$this->_ajax_echo(array('msg'=>'没有权限'));
		}
		//业务
		$parames['F_status'] = 0;
		$this->_do_change_custom_status($parames);
	}

	/**
	 * ajax删除客服
	 * @param array $parames
	 *                  F_teacher_ids   string  客服IDs,如1,2,3
	 */
	public function custom_delete($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,__METHOD__) === false)
		{
			$this->_ajax_echo(array('msg'=>'没有权限'));
		}
		//业务
		$parames['F_status'] = 3;
		$this->_do_change_custom_status($parames);
	}

	/**
	 * 获取一个客服的信息
	 * @param array $parames
	 *          F_teacher_id    string
	 */
	public function custom_edit($parames = array())
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
		//get custom info
		$this -> load -> model('M_custom', 'mcustom');
		$custom_info = $this->mcustom->get_custom_info($parames);

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['do'] = $this->session->flashdata('do');
		$data['content_title'] = "编辑客服";
		$data['custom_info'] = $custom_info;
		$data['gender_list'] = $this->my_config['gender_list'];
		$data['F_teacher_id'] = isset($parames['F_teacher_id'])?$parames['F_teacher_id']:0;

		$this->_output_view("custom/v_edit", $data);
	}

	/**
	 * ajax修改客服信息
	 * @param array $parames
	 */
	public function custom_modify($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"custom_edit") === false)
		{
			redirect_to_no_privity_page();
		}
		//业务
		$data = array("error"=>0);
		$this -> load -> model('M_custom', 'mcustom');
		if(isset($parames['F_teacher_name']))
		{
			unset($parames['F_teacher_name']);
		}
		$result = $this->mcustom->custom_modify($parames);
		if(!is_array($result) || count($result) <= 0)
		{
			$data["error"] = -1;
			$data["msg"] = $result['msg'];
		}
		else{
			$this->session->set_flashdata('do', 'success');
		}
		$this->_ajax_echo($data);
	}

	/**
	 * 显示添加一个客服的页面
	 * @param array $parames
	 *          F_real_name    string
	 *          F_teacher_name    string
	 *          F_teacher_password    string
	 *          F_gender    int
	 */
	public function custom_add($parames = array())
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

		$this -> load -> model('M_custom', 'mcustom');

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['content_title'] = "添加客服";
		$data['gender_list'] = $this->my_config['gender_list'];
		$data['manager_url'] = my_site_url("c_custom/manager");

		$this->_output_view("custom/v_add", $data);
	}

	/**
	 * ajax添加客服
	 * @param array $parames
	 */
	public function custom_add_do($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"custom_add") === false)
		{
			redirect_to_no_privity_page();
		}
		//业务
		$data = array("error"=>0);
		$this -> load -> model('M_custom', 'mcustom');
		$result = $this->mcustom->custom_add($parames);
		//responseNo
		if(!is_array($result) || count($result) <= 0)
		{
			$data["error"] = -1;
			$data["msg"] = "操作失败！请重试!";
		}
		else{
			if(isset($result['responseNo']) && $result['responseNo'] == 0)
			{
				$this->session->set_flashdata('do', 'success');
			}
			else{
				$data["error"] = -2;
				$data["msg"] = $result['msg'];
			}
		}
		$this->_ajax_echo($data);
	}

}

/* End of file c_custom.php */
/* Location: ./application/controllers/c_custom.php */