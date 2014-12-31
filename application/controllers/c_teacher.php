<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_teacher extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

	/**
	 * 老师管理
	 * @param array $parames
	 *          type    int 0：激活，1：冻结，2：删除，3：彻底删除，4：测试
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

		//get teacher list
		if(!isset($parames['type']))
		{
			$parames['type'] = 0;
		}
		if(!isset($parames['page']))
		{
			$parames['page'] = 1;
		}
		$this -> load -> model('M_teacher', 'mteacher');
		$teacher_list_result = $this->mteacher->get_teacher_list($parames);
		if(is_array($teacher_list_result) && count($teacher_list_result) > 0)
		{
			foreach($teacher_list_result['list'] as $k=>$item)
			{
				$teacher_list_result['list'][$k]['F_grade_text'] = $this->my_config['grade_list'][$item['F_grade']];
				$teacher_list_result['list'][$k]['F_subject_text'] = $this->my_config['subject_list'][$item['F_subject_id']];
				$teacher_list_result['list'][$k]['F_status_text'] = $this->my_config['status_list'][$item['F_status']];
			}
		}
		//set page list
		$page_total = 1;
		if(isset($teacher_list_result['total']))
		{
			$page_total = (int)ceil($teacher_list_result['total']/$this->my_config['page']);
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
			$item['url'] = get_teacher_manager_list_url(array('page'=>$i,'type'=>(int)$parames['type']));
			$item['page'] = $i;
			if($i == (int)$parames['page'])
			{
				$item['url'] = "#";
				$item['active'] = 1;
				$page_pre_url = get_teacher_manager_list_url(array('page'=>$i-1,'type'=>(int)$parames['type']));
				$page_next_url = get_teacher_manager_list_url(array('page'=>$i+1, 'type'=>(int)$parames['type']));
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
		//set teacher status list
		$status_list = array();
		foreach($this->my_config['status_list_view'] as $item)
		{
			if(check_privity($item['privity']))
			{
				$it = array('key'=>get_teacher_manager_list_url(array('type'=>$item['id'])),'value'=>$item['text'],
					'active'=>false);
				if((int)$parames['type'] == $item['id'])
				{
					$it['active'] = true;
				}
				$status_list[] = $it;
			}
		}

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['do'] = $this->session->flashdata('do');
		$data['teacher_list'] = isset($teacher_list_result['list'])?$teacher_list_result['list']:array();
		$data['teacher_total'] = isset($teacher_list_result['total'])?$teacher_list_result['total']:0;
		$data['page_total'] = $page_total;
		$data['page_list'] = $page_list;
		$data['page_pre_active'] = $page_pre_active;
		$data['page_next_active'] = $page_next_active;
		$data['page_pre_url'] = $page_pre_url;
		$data['page_next_url'] = $page_next_url;
		$data['status_list'] = $status_list;
		$data['teacher_freeze_uri'] = base_url("c_teacher/teacher_freeze");
		$data['teacher_delete_uri'] = base_url("c_teacher/teacher_delete");
		$data['teacher_active_uri'] = base_url("c_teacher/teacher_active");
		$data['teacher_set_test_uri'] = base_url("c_teacher/teacher_set_test");
		$data['teacher_add_uri'] = base_url("c_teacher/teacher_add");

		$this->_output_view("teacher/v_manager", $data);
	}

	/**
	 * 改变老师状态
	 * @param array $parames
	 *                  F_teacher_ids   string  老师IDs,如1,2,3
	 *                  F_status   int 0：激活，1：冻结，2：删除，3：彻底删除，4：测试
	 */
	private  function _do_change_teacher_status($parames = array()){
		//
		$this -> load -> model('M_teacher', 'mteacher');
		$result = $this->mteacher->change_teacher_status($parames);
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
	 * ajax冻结老师
	 * @param array $parames
	 *                  F_teacher_ids   string  老师IDs,如1,2,3
	 */
	public function teacher_w($parames = array()){
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
		$this->_do_change_teacher_status($parames);
	}

	/**
	 * ajax删除老师
	 * @param array $parames
	 *                  F_teacher_ids   string  老师IDs,如1,2,3
	 */
	public function teacher_delete($parames = array()){
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
		$parames['F_status'] = 2;
		$this->_do_change_teacher_status($parames);
	}

	/**
	 * ajax激活老师
	 * @param array $parames
	 *                  F_teacher_ids   string  老师IDs,如1,2,3
	 */
	public function teacher_active($parames = array()){
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
		$this->_do_change_teacher_status($parames);
	}

	/**
	 * ajax设置老师为测试帐号
	 * @param array $parames
	 *                  F_teacher_ids   string  老师IDs,如1,2,3
	 */
	public function teacher_set_test($parames = array()){
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
		$parames['F_status'] = 4;
		$this->_do_change_teacher_status($parames);
	}

	/**
	 * 获取一个老师的信息
	 * @param array $parames
	 *          F_teacher_id    string
	 */
	public function teacher_edit($parames = array())
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
		//get teacher info
		$this -> load -> model('M_teacher', 'mteacher');
		$teacher_info = $this->mteacher->get_teacher_info($parames);

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['do'] = $this->session->flashdata('do');
		$data['teacher_info'] = $teacher_info;
		$data['grade_list'] = $this->my_config['grade_list'];
		$data['subject_list'] = $this->my_config['subject_list'];
		$data['gender_list'] = $this->my_config['gender_list'];
		$data['F_teacher_id'] = isset($parames['F_teacher_id'])?$parames['F_teacher_id']:0;
		$data['js_list'] = array(get_assets_js_url("upload/ajaxfileupload.js"));
		$data['upload_url'] = base_url("c_teacher/teacher_upload_header");

		$this->_output_view("teacher/v_edit", $data);
	}

	/**
	 * ajax上传老师头像
	 * @param array $parames
	 */
	public function teacher_upload_header($parames = array()){
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
		$data['error'] = 0;
		$data['msg'] = "成功";
		$fileElementName = 'user-pic';
		if(is_array($_FILES[$fileElementName]) && isset($_FILES[$fileElementName]['error'],
				$_FILES[$fileElementName]['tmp_name']) && $_FILES[$fileElementName]['error'] == 0 && file_exists($_FILES[$fileElementName]['tmp_name'])) {
			//判断图片格式
			//type
			if (!in_array(strtolower($_FILES[$fileElementName]['type']), array("image/png", "image/jpeg", "image/jpg"))) {
				$data['error'] = -1;
				$data['msg'] = "头像格式仅允许png,jpg";
			}
			//判断图片大小
			if ($data['error'] == 0)
			{
				//size
				if(!($_FILES[$fileElementName]['size'] <= 200*1024))
				{
					$data['error'] = -2;
					$data['msg'] = "头像文件大小应该小于200k";
				}
			}
			if ($data['error'] == 0){
				//移动图片到public
				$file = APPPATH."../public/images/upload/";
				$tmp = explode("/",$_FILES[$fileElementName]['type']);
				$tmp = $tmp[count($tmp)-1];
				$name = time().rand(0,100).".".$tmp;
				$file .= $name;
				rename($_FILES[$fileElementName]['tmp_name'],$file);
				$data['name'] = $name;
				$data['url'] = base_url("public/images/upload/".$name);
			}
		}
		else{
			$data['error'] = -3;
			$data['msg'] = "头像格式仅允许png,jpg,且文件大小应该小于200k";
		}
		//
		ob_end_clean();
		echo json_encode($data);exit;
	}

	/**
	 * ajax修改老师信息
	 * @param array $parames
	 */
	public function teacher_modify($parames = array()){
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
		$data = array("error"=>0);
		$this -> load -> model('M_teacher', 'mteacher');
		if(isset($parames['teacher_header']))
		{
			$file = APPPATH."../public/images/upload/";
			$parames['teacher_header'] = $file.$parames['teacher_header'];
		}
		if(isset($parames['F_teacher_name']))
		{
			unset($parames['F_teacher_name']);
		}
		$result = $this->mteacher->teacher_modify($parames);
		if(!is_array($result) || count($result) <= 0)
		{
			$data["error"] = -1;
			$data["msg"] = $result['msg'];
		}
		else{
			//删除已经上传的图片
			if(isset($parames['teacher_header']) && file_exists($parames['teacher_header']))
			{
				unlink($parames['teacher_header']);
			}
			$this->session->set_flashdata('do', 'success');
		}
		$this->_ajax_echo($data);
	}

	/**
	 * 显示添加一个老师的页面
	 * @param array $parames
	 *          F_teacher_id    string
	 */
	public function teacher_add($parames = array())
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

		$this -> load -> model('M_teacher', 'mteacher');

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['grade_list'] = $this->my_config['grade_list'];
		$data['subject_list'] = $this->my_config['subject_list'];
		$data['gender_list'] = $this->my_config['gender_list'];
		$data['upload_url'] = base_url("c_teacher/teacher_upload_header");

		$data['manager_test_url'] = get_controll_url("c_teacher/manager",array("type"=>4));
		$data['manager_url'] = base_url("c_teacher/manager");
		$data['js_list'] = array(get_assets_js_url("upload/ajaxfileupload.js"));

		$this->_output_view("teacher/v_add", $data);
	}

	/**
	 * ajax添加老师
	 * @param array $parames
	 */
	public function teacher_add_do($parames = array()){
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
		$data = array("error"=>0);
		$this -> load -> model('M_teacher', 'mteacher');
		if(isset($parames['teacher_header']))
		{
			$file = APPPATH."../public/images/upload/";
			$parames['teacher_header'] = $file.$parames['teacher_header'];
		}
		$parames['F_who'] = "1";
		$result = $this->mteacher->teacher_add($parames);
		if(!is_array($result) || count($result) <= 0)
		{
			$data["error"] = -1;
			$data["msg"] = $result['msg'];
		}
		else{
			//删除已经上传的图片
			if(isset($parames['teacher_header']) && file_exists($parames['teacher_header']))
			{
				unlink($parames['teacher_header']);
			}
			$this->session->set_flashdata('do', 'success');
		}
		$this->_ajax_echo($data);
	}

}

/* End of file c_teacher.php */
/* Location: ./application/controllers/c_teacher.php */