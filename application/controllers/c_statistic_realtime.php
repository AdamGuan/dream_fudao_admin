<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_statistic_realtime extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

	/**
	 * 实时统计
	 * @param array $parames
	 *          type    int 0,1,2,3
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
		if(!isset($parames['type']))
		{
			$parames['type'] = 0;
		}
		$this -> load -> model('M_statistic_realtime', 'mstatisticRealtime');
		$result = $this->mstatisticRealtime->get_online_data($parames);
		//设置图表的选择项
		$type_list = array(
			array('key'=>get_controll_url("c_statistic_realtime/index",array("type"=>0)),'value'=>'提问次数'),
			array('key'=>get_controll_url("c_statistic_realtime/index",array("type"=>1)),'value'=>'提问人数'),
			array('key'=>get_controll_url("c_statistic_realtime/index",array("type"=>2)),'value'=>'辅导次数'),
			array('key'=>get_controll_url("c_statistic_realtime/index",array("type"=>3)),'value'=>'在线人数'),
		);
		$type_list[$parames['type']]['selected'] = "selected";
		//设置学生总人数,在线人数,辅导中 的url
		$student_total_url = get_student_manager_list_url(array('F_login'=>-2));
		$student_online_url = get_student_manager_list_url(array('F_login'=>-1));
		$student_teaching_url = get_student_manager_list_url(array('F_login'=>2));
		//设置老师总人数,在线人数,辅导中 的url
		$teacher_total_url = get_teacher_manager_list_url(array('F_login'=>-2));
		$teacher_online_url = get_teacher_manager_list_url(array('F_login'=>-1));
		$teacher_teaching_url = get_teacher_manager_list_url(array('F_login'=>2));

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['do'] = $this->session->flashdata('do');
		$data['result'] = $result;
		$data['type_list'] = $type_list;
		$data['js_list'] = array(get_assets_js_url("Highcharts-4.0.3/js/highcharts.js"));
		$data['student_total_url'] = $student_total_url;
		$data['student_online_url'] = $student_online_url;
		$data['student_teaching_url'] = $student_teaching_url;
		$data['teacher_total_url'] = $teacher_total_url;
		$data['teacher_online_url'] = $teacher_online_url;
		$data['teacher_teaching_url'] = $teacher_teaching_url;
		$this->_output_view("statistic_realtime/v_index", $data);
	}

}

/* End of file c_statistic_realtime.php */
/* Location: ./application/controllers/c_statistic_realtime.php */