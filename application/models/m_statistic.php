<?php
class M_statistic extends MY_Model {

	public function __construct() {
		parent :: __construct();
//		$this -> load -> database();
	}

	/**
	 * 获取
	 * @param array $parames
	 * @return array
	 */
	public function get_online_data($parames = array()){
		if(isset($parames['type']))
		{}
		$data_list = array();
		$data_list[] = array(
			'version'=>'server_v1',
			'c'=>'statistics_realtime',
			'm'=>'get_teacher_statistics_realtime',
		);
		$data_list[] = array(
			'version'=>'server_v1',
			'c'=>'statistics_realtime',
			'm'=>'get_user_statistics_realtime',
		);
		$data_list[] = array(
			'version'=>'server_v1',
			'c'=>'statistics_realtime',
			'm'=>'get_ask_times_today_timesection',
		);
		$data_list[] = array(
			'version'=>'server_v1',
			'c'=>'statistics_realtime',
			'm'=>'get_ask_people_number_today_timesection',
		);
		$data_list[] = array(
			'version'=>'server_v1',
			'c'=>'statistics_realtime',
			'm'=>'get_teaching_times_today_timesection',
		);
		$data_list[] = array(
			'version'=>'server_v1',
			'c'=>'statistics_realtime',
			'm'=>'get_online_people_number_today_timesection',
		);
		$method_list = array("GET","GET","GET","GET","GET","GET");
		$results = api_curl_multi($this->my_config['api_uri'], $data_list, $method_list,$this->my_config['api_key']);

		$return = array();

		if(is_array($results) && count($results) == 6)
		{
			//老师实时在线
			$result = json_decode($results[0],true);
			if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
			{
				$return['teacher_online_info'] = $result['info'];
			}
			//学生实时在线
			$result = json_decode($results[1],true);
			if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
			{
				$return['student_online_info'] = $result['info'];
			}
			//今天全时间段提问次数
			$result = json_decode($results[2],true);
			if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
			{
				$return['student_online_info'] = $result['info'];
			}
			//今天全时间段提问人数
			$result = json_decode($results[2],true);
			if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
			{
				$return['student_online_info'] = $result['info'];
			}
			//今天全时间段辅导次数
			$result = json_decode($results[2],true);
			if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
			{
				$return['student_online_info'] = $result['info'];
			}
			//今天全时间段在线人数
			$result = json_decode($results[2],true);
			if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
			{
				$return['student_online_info'] = $result['info'];
			}
			//今天全时间段在线人数
			$result = json_decode($results[2],true);
			if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
			{
				$return['student_online_info'] = $result['info'];
			}
		}

		return $return;
	}

}

/**
 * End of file m_statistic.php
 */
/**
 * Location: ./app/models/m_statistic.php
 */