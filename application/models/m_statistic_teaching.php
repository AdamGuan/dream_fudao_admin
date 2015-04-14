<?php
class M_statistic_teaching extends MY_Model {

	public function __construct() {
		parent :: __construct();
//		$this -> load -> database();
	}

	
	public function get_teaching_data($parames = array()){
		$return = array();
		if(isset($parames['date']))
		{
			unset($parames['c']);
			unset($parames['m']);
			
			//curl
			$data = array('version'=>$this->my_config['api_version'],'c'=>'statistics_day','m'=>'get_teaching_data_day');
			$data['date'] = $parames['date'];
			$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
			$result = json_decode($result,true);
			if(is_array($result) && isset($result['responseNo'],$result['list']) && $result['responseNo'] == 0)
			{
				$return['list'] = $result['list'];
			}
		}
		return $return;
	}

}

/**
 * End of file m_statistic_teaching.php
 */
/**
 * Location: ./app/models/m_statistic_teaching.php
 */