<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_statistic_teaching extends MY_Controller {

	public function __construct() {
		parent :: __construct();
	}

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
		if(!isset($parames['date']))
		{
			$parames['date'] = date('Y-m-d',time());
		}
		$this -> load -> model('M_statistic_teaching', 'mstatisticTeaching');
		$result = $this->mstatisticTeaching->get_teaching_data($parames);
		if(isset($result['list'],$result['list'][0]))
		{
			foreach($result['list'] as $k=>$item)
			{
				$result['list'][$k]['F_grade_text'] = $this->my_config['class_list'][$item['F_grade']];
				$result['list'][$k]['F_subject_text'] = $this->my_config['subject_list'][$item['F_subject_id']];
			}
		}

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['result'] = $result;
		$data['date'] = $parames['date'];
		$data['total'] = isset($result['list'])?count($result['list']):0;
		$data['currentPageUrl'] = get_statistics_teaching_url(array());
		$this->_output_view("statistic_teaching/v_index", $data);
	}

}

/* End of file c_statistic_teaching.php */
/* Location: ./application/controllers/c_statistic_teaching.php */