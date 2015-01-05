<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_statistic_timesection extends MY_Controller {

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
		if(!isset($parames['type']))
		{
			$parames['type'] = 0;
		}
		if(!isset($parames['datetype']))
		{
			$parames['datetype'] = 0;
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
		$this -> load -> model('M_statistic_timesection', 'mstatisticTimesection');
		$result = $this->mstatisticTimesection->get_timesection_data($parames);
		//设置图表的选择项
		$type_list = array(
			array('key'=>0,'value'=>'提问次数'),
			array('key'=>1,'value'=>'提问人数'),
			array('key'=>2,'value'=>'辅导次数'),
			array('key'=>3,'value'=>'在线人数'),
		);
		$type_list[$parames['type']]['selected'] = "selected";
		//设置日期的选择项
		$datetype_list = array(
			array('key'=>0,'value'=>'按日查询'),
			array('key'=>1,'value'=>'按月查询'),
			array('key'=>2,'value'=>'按年查询'),
		);
		$datetype_list[$parames['datetype']]['selected'] = "selected";

		//data
		$data = $this->_get_data(__CLASS__,__METHOD__);
		$data['do'] = $this->session->flashdata('do');
		$data['result'] = $result;
		$data['type_list'] = $type_list;
		$data['datetype_list'] = $datetype_list;
		$data['js_list'] = array(get_assets_js_url("Highcharts-4.0.3/js/highcharts.js"));
		$this->_output_view("statistic_timesection/v_index", $data);
	}

}

/* End of file c_statistic_timesection.php */
/* Location: ./application/controllers/c_statistic_timesection.php */