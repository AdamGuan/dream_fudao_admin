<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_statistic_student extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

	/**
	 * 学生统计
	 * @param array $parames
	 *          datetype    int 0,1,2,3
	 *          date        string,optional
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
		if(!isset($parames['date']))
		{
			switch((int)$parames['datetype']){
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
		$this -> load -> model('M_statistic_student', 'mstatisticStudent');
		$result = $this->mstatisticStudent->get_data($parames);
		if(isset($result['list'],$result['list'][0]))
		{
			foreach($result['list'] as $k=>$item)
			{
				$result['list'][$k]['F_url'] = get_statistic_student_all_teaching_info_timesection_url(array('page'=>1,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date'],'refrence_url'=>get_statistic_student_list_url(array('datetype'=>(int)$parames['datetype'],'date'=>$parames['date']))));
			}
		}
		//设置日期的选择项
		$datetype_list = array(
			'1'=>array('key'=>1,'value'=>'按月查询'),
			'2'=>array('key'=>2,'value'=>'按年查询'),
		);
		$datetype_list[$parames['datetype']]['selected'] = "selected";

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['do'] = $this->session->flashdata('do');
		$data['result'] = $result;
		$data['datetype_list'] = $datetype_list;
		$this->_output_view("statistic_student/v_index", $data);
	}

	public function teaching_info_timesection($parames = array())
	{
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//业务
		if(!isset($parames['datetype']))
		{
			$parames['datetype'] = 0;
		}
		if(!isset($parames['page']))
		{
			$parames['page'] = 1;
		}
		if(!isset($parames['teacher_id']))
		{
			$parames['teacher_id'] = "";
		}
		if(!isset($parames['refrence_url']))
		{
			$parames['refrence_url'] = "#";
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
		$this -> load -> model('M_statistic_student', 'mstatisticStudent');
		$result = $this->mstatisticStudent->teaching_info_timesection($parames);
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
		$page_first_url = get_statistic_student_teaching_info_timesection_url(array('page'=>1,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date'],'teacher_id'=>$parames['teacher_id'],'refrence_url'=>$parames['refrence_url']));
		$page_last_url = get_statistic_student_teaching_info_timesection_url(array('page'=>$page_total,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date'],'teacher_id'=>$parames['teacher_id'],'refrence_url'=>$parames['refrence_url']));
		for($i=1;$i<=$page_total;++$i)
		{
			$item = array();
			$item['active'] = 0;
			$item['url'] = get_statistic_student_teaching_info_timesection_url(array('page'=>$i,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date'],'teacher_id'=>$parames['teacher_id'],'refrence_url'=>$parames['refrence_url']));
			$item['page'] = $i;
			if($i == (int)$parames['page'])
			{
				$item['url'] = "#";
				$item['active'] = 1;
				$page_pre_url = get_statistic_student_teaching_info_timesection_url(array('page'=>$i-1,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date'],'teacher_id'=>$parames['teacher_id'],'refrence_url'=>$parames['refrence_url']));
				$page_next_url = get_statistic_student_teaching_info_timesection_url(array('page'=>$i+1,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date'],'teacher_id'=>$parames['teacher_id'],'refrence_url'=>$parames['refrence_url']));
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
		$data['page_total'] = $page_total;
		$data['page_list'] = $page_list;
		$data['page_pre_active'] = $page_pre_active;
		$data['page_next_active'] = $page_next_active;
		$data['page_pre_url'] = $page_pre_url;
		$data['page_next_url'] = $page_next_url;
		$data['page_first_url'] = $page_first_url;
		$data['page_last_url'] = $page_last_url;
		$data['refrence_url'] = $parames['refrence_url'];
		$this->_output_view("statistic_student/v_teaching_info_timesection", $data);
	}

	public function all_teaching_info_timesection($parames = array())
	{
		//检查是否有登录
		$result = $this->_check_login();
		if(is_array($result) && isset($result['redirect_url']))	//未登录
		{
			top_redirect($result['redirect_url']);
		}
		//业务
		if(!isset($parames['datetype']))
		{
			$parames['datetype'] = 0;
		}
		if(!isset($parames['page']))
		{
			$parames['page'] = 1;
		}
		if(!isset($parames['refrence_url']))
		{
			$parames['refrence_url'] = "#";
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
		$this -> load -> model('M_statistic_student', 'mstatisticStudent');
		$result = $this->mstatisticStudent->all_teaching_info_timesection($parames);
		if(isset($result['list'],$result['list'][0]))
		{
			foreach($result['list'] as $k=>$item)
			{
				if(isset($result['list'][$k])){
					$result['list'][$k]['F_grade_text'] = isset($this->my_config['class_list'][$item['F_grade']])?$this->my_config['class_list'][$item['F_grade']]:"";
					$result['list'][$k]['F_subject_text'] = isset($this->my_config['subject_list'][$item['F_subject_id']])?$this->my_config['subject_list'][$item['F_subject_id']]:"";
				}
			}
		}
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
		$page_first_url = get_statistic_student_all_teaching_info_timesection_url(array('page'=>1,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date'],'refrence_url'=>$parames['refrence_url']));
		$page_last_url = get_statistic_student_all_teaching_info_timesection_url(array('page'=>$page_total,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date'],'refrence_url'=>$parames['refrence_url']));
		for($i=1;$i<=$page_total;++$i)
		{
			$item = array();
			$item['active'] = 0;
			$item['url'] = get_statistic_student_all_teaching_info_timesection_url(array('page'=>$i,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date'],'refrence_url'=>$parames['refrence_url']));
			$item['page'] = $i;
			if($i == (int)$parames['page'])
			{
				$item['url'] = "#";
				$item['active'] = 1;
				$page_pre_url = get_statistic_student_all_teaching_info_timesection_url(array('page'=>$i-1,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date'],'refrence_url'=>$parames['refrence_url']));
				$page_next_url = get_statistic_student_all_teaching_info_timesection_url(array('page'=>$i+1,'datetype'=>(int)$parames['datetype'],'date'=>$parames['date'],'refrence_url'=>$parames['refrence_url']));
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
		$data['page_total'] = $page_total;
		$data['page_list'] = $page_list;
		$data['page_pre_active'] = $page_pre_active;
		$data['page_next_active'] = $page_next_active;
		$data['page_pre_url'] = $page_pre_url;
		$data['page_next_url'] = $page_next_url;
		$data['page_first_url'] = $page_first_url;
		$data['page_last_url'] = $page_last_url;
		$data['refrence_url'] = $parames['refrence_url'];
		$this->_output_view("statistic_student/v_all_teaching_info_timesection", $data);
	}

}

/* End of file c_statistic_student.php */
/* Location: ./application/controllers/c_statistic_student.php */