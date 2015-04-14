<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_statistic_teacher extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

	/**
	 * 时段统计
	 * @param array $parames
	 *          type    int 0,1,2,3
	 *          datetype    int 0,1,2,3
	 */
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
		if(!isset($parames['datetype']))
		{
			$parames['datetype'] = 1;
		}
		if(!isset($parames['page']))
		{
			$parames['page'] = 1;
		}
		if(!isset($parames['date']))
		{
			switch((int)$parames['datetype']){
				case 0: //天
					$parames['date'] = date('Y-m-d',time());
					break;
				case 1: //月
					$parames['date'] = date('Y-m',time());
					break;
				case 2://年
					$parames['date'] = date('Y',time());
					break;
				default:
					break;
			}
		}
		$this -> load -> model('M_statistic_teacher', 'mstatisticTeacher');
		$result = $this->mstatisticTeacher->get_teaching_data($parames);
		if(isset($result['list'],$result['list'][0]))
		{
			foreach($result['list'] as $k=>$item)
			{
				$result['list'][$k]['F_grade_text'] = $this->my_config['grade_list'][$item['F_grade']];
				$result['list'][$k]['F_subject_text'] = $this->my_config['subject_list'][$item['F_subject_id']];
				$result['list'][$k]['F_url'] = get_statistic_student_teaching_info_timesection_url(array('page'=>1,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date'],'teacher_id'=>$item['F_teacher_id'],'refrence_url'=>get_statistic_teacher_list_url(array('page'=>$parames['page'],'datetype'=>(int)$parames['datetype'],'date'=>$parames['date']))));
			}
		}
		//设置日期的选择项
		$datetype_list = array(
			array('key'=>0,'value'=>'按日查询'),
			array('key'=>1,'value'=>'按月查询'),
			array('key'=>2,'value'=>'按年查询'),
		);
		$datetype_list[$parames['datetype']]['selected'] = "selected";
		//set page list
		$page_total = 1;
		if(isset($result['total']))
		{
			$page_total = (int)ceil($result['total']/$this->my_config['page']);
		}
		$page_list = array();
		$page_pre_active =  true;
		$page_pre_url =  "#";
		$page_next_active =  true;
		$page_next_url =  "#";
		$page_first_url = get_statistic_teacher_list_url(array('page'=>1,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date']));
		$page_last_url = get_statistic_teacher_list_url(array('page'=>$page_total,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date']));
		for($i=1;$i<=$page_total;++$i)
		{
			$item = array();
			$item['active'] = 0;
			$item['url'] = get_statistic_teacher_list_url(array('page'=>$i,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date']));
			$item['page'] = $i;
			if($i == (int)$parames['page'])
			{
				$item['url'] = "#";
				$item['active'] = 1;
				$page_pre_url = get_statistic_teacher_list_url(array('page'=>$i-1,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date']));
				$page_next_url = get_statistic_teacher_list_url(array('page'=>$i+1,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date']));
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

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['do'] = $this->session->flashdata('do');
		$data['result'] = $result;
		$data['datetype_list'] = $datetype_list;
		$data['page_total'] = $page_total;
		$data['page_list'] = $page_list;
		$data['page_pre_active'] = $page_pre_active;
		$data['page_next_active'] = $page_next_active;
		$data['page_pre_url'] = $page_pre_url;
		$data['page_next_url'] = $page_next_url;
		$data['page_first_url'] = $page_first_url;
		$data['page_last_url'] = $page_last_url;
		$this->_output_view("statistic_teacher/v_index", $data);
	}

}

/* End of file c_statistic_teacher.php */
/* Location: ./application/controllers/c_statistic_teacher.php */