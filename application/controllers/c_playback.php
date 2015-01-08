<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_playback extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

	/**
	 * 回放管理
	 * @param array $parames
	 *          type    int 0所有，1精彩,2非精彩
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

		//get playback list

		if(!isset($parames['type']))
		{
			$parames['type'] = 0;
		}
		if(!isset($parames['page']))
		{
			$parames['page'] = 1;
		}
		$parames2 = array();
		$parames2['type'] = $parames['type'];
		$parames2['page'] = $parames['page'];
		if(isset($parames['F_teacher_real_name']))
		{
			$parames2['F_teacher_real_name'] = $parames['F_teacher_real_name'];
		}
		if(isset($parames['F_user_real_name']))
		{
			$parames2['F_user_real_name'] = $parames['F_user_real_name'];
		}
		$parames3 = $parames2;
		$this -> load -> model('M_playback', 'mplayback');
		$playback_list_result = $this->mplayback->get_playback_list($parames);
		if(is_array($playback_list_result) && count($playback_list_result) > 0)
		{
			foreach($playback_list_result['list'] as $k=>$item)
			{
				$playback_list_result['list'][$k]['F_wonderful_text'] = ($item['F_wonderful'] == 1)?"是":"否";
				$F_duration_time = '';
				if(isset($item['F_end_time'],$item['F_start_time']))
				{
					$F_duration_time = strtotime($item['F_end_time'])-strtotime($item['F_start_time']);
					if($F_duration_time >= 0)
					{
						$F_duration_time = sec_to_time($F_duration_time);
					}
					else{
						$F_duration_time = '';
					}
				}
				$playback_list_result['list'][$k]['F_duration_time'] = $F_duration_time;
			}
		}
		//set page list
		$page_total = 1;
		if(isset($playback_list_result['total']))
		{
			$page_total = (int)ceil($playback_list_result['total']/$this->my_config['page']);
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
			$parames2['page'] = $i;
			$item['url'] = get_playback_manager_list_url($parames2);
			$item['page'] = $i;
			if($i == (int)$parames['page'])
			{
				$item['url'] = "#";
				$item['active'] = 1;
				$parames2['page'] = $i-1;
				$page_pre_url = get_playback_manager_list_url($parames2);
				$parames2['page'] = $i+1;
				$page_next_url = get_playback_manager_list_url($parames2);
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
		//set playback status list
		$status_list = array();
		$parames2tmp = $parames3;
		$parames2tmp['type'] = 0;
		$url = get_controll_url("c_playback/manager",$parames2tmp);
		$status_list[] = array(
			'key'=>$url,
			'value'=>'全部',
			'active'=>false
		);
		$parames2tmp['type'] = 1;
		$url = get_controll_url("c_playback/manager",$parames2tmp);
		$status_list[] = array(
			'key'=>$url,
			'value'=>'精彩',
			'active'=>false
		);
		$parames2tmp['type'] = 2;
		$url = get_controll_url("c_playback/manager",$parames2tmp);
		$status_list[] = array(
			'key'=>$url,
			'value'=>'非精彩',
			'active'=>false
		);
		unset($parames2tmp);
		switch((int)$parames3['type'])
		{
			case 0:
				$status_list[0]['active'] = true;
				break;
			case 1:
				$status_list[1]['active'] = true;
				break;
			case 2:
				$status_list[2]['active'] = true;
				break;
			default:
				$status_list[0]['active'] = true;
				break;
		}

		//set search opetional
		/*
		$search_type_list = array(
			array(
				'key'=>0,
				'value'=>'教师姓名',
				'active'=>false
			),
			array(
				'key'=>1,
				'value'=>'学生姓名',
				'active'=>false
			)
		);
		$search_text = '';
		if(isset($parames3['F_teacher_real_name']))
		{
			$search_type_list[0]['active'] = true;
			$search_text = $parames3['F_teacher_real_name'];
		}
		else if(isset($parames3['F_user_real_name']))
		{
			$search_type_list[1]['active'] = true;
			$search_text = $parames3['F_user_real_name'];
		}
		*/


		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['do'] = $this->session->flashdata('do');
		$data['playback_list'] = isset($playback_list_result['list'])?$playback_list_result['list']:array();
		$data['playback_total'] = isset($playback_list_result['total'])?$playback_list_result['total']:0;
		$data['page_total'] = $page_total;
		$data['page_list'] = $page_list;
		$data['page_pre_active'] = $page_pre_active;
		$data['page_next_active'] = $page_next_active;
		$data['page_pre_url'] = $page_pre_url;
		$data['page_next_url'] = $page_next_url;
		$data['status_list'] = $status_list;
//		$data['search_type_list'] = $search_type_list;
		$data['search_text'] = isset($parames3['F_user_real_name'])?$parames3['F_user_real_name']:"";
		$data['set_playback_active_uri'] = my_site_url("c_playback/playback_active");
		$data['set_playback_deactive_uri'] = my_site_url("c_playback/playback_deactive");

		$this->_output_view("playback/v_manager", $data);
	}

	/**
	 * 改变老师状态
	 * @param array $parames
	 *                  F_order_ids   string  回放IDs,如1,2,3
	 *                 type   int   0所有，1精彩,2非精彩
	 */
	private  function _do_change_playback_status($parames = array()){
		//
		$this -> load -> model('M_playback', 'mplayback');
		$result = $this->mplayback->change_playback_status($parames);
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
	 * ajax设置回放精彩
	 * @param array $parames
	 *                  F_order_ids   string  回放IDs,如1,2,3
	 */
	public function playback_active($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"manager") === false)
		{
			$this->_ajax_echo(array('msg'=>'没有权限'));
		}
		//业务
		$parames['type'] = 1;
		$this->_do_change_playback_status($parames);
	}

	/**
	 * ajax设置回放非精彩
	 * @param array $parames
	 *                  F_order_ids   string  回放IDs,如1,2,3
	 */
	public function playback_deactive($parames = array()){
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//检查是否有权限
		if($this->_check_privity(__CLASS__,"manager") === false)
		{
			$this->_ajax_echo(array('msg'=>'没有权限'));
		}
		//业务
		$parames['type'] = 2;
		$this->_do_change_playback_status($parames);
	}

}

/* End of file c_playback.php */
/* Location: ./application/controllers/c_playback.php */