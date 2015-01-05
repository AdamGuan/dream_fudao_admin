<?php
class M_statistic_realtime extends MY_Model {

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
		{
			$type = (int)$parames['type'];
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
			switch($type){
				case 0:
					$data_list[] = array(
						'version'=>'server_v1',
						'c'=>'statistics_realtime',
						'm'=>'get_ask_times_today_timesection',
					);
					break;
				case 1:
					$data_list[] = array(
						'version'=>'server_v1',
						'c'=>'statistics_realtime',
						'm'=>'get_ask_people_number_today_timesection',
					);
					break;
				case 2:
					$data_list[] = array(
						'version'=>'server_v1',
						'c'=>'statistics_realtime',
						'm'=>'get_teaching_times_today_timesection',
					);
					break;
				case 3:
					$data_list[] = array(
						'version'=>'server_v1',
						'c'=>'statistics_realtime',
						'm'=>'get_online_people_number_today_timesection',
					);
					break;
				default:
					$data_list[] = array(
						'version'=>'server_v1',
						'c'=>'statistics_realtime',
						'm'=>'get_ask_times_today_timesection',
					);
					break;
			}

			$method_list = array("GET","GET","GET");
			$results = api_curl_multi($this->my_config['api_uri'], $data_list, $method_list,$this->my_config['api_key']);

			$return = array();

			if(is_array($results) && count($results) == 3)
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
				//
				$result = json_decode($results[2],true);
				if(is_array($result) && isset($result['responseNo'],$result['info']) && $result['responseNo'] == 0)
				{
					$key  = '';
					switch($type){
						case 0://今天全时间段提问次数
							$key  = 'ask_times';
							$return['desc'] = '提问次数';
							break;
						case 1://今天全时间段提问人数
							$key  = 'ask_people_number';
							$return['desc'] = '提问人数';
							break;
						case 2://今天全时间段辅导次数
							$key  = 'teaching_times';
							$return['desc'] = '辅导次数';
							break;
						case 3://今天全时间段在线人数
							$key  = 'online_people_number';
							$return['desc'] = '在线人数';
							break;
						default:
							break;
					}


					foreach($result['info'] as $item)
					{
						$return['info'][] = array(
							'times'=>$item[$key],
							'start_time'=>$item['start_time'],
							'end_time'=>$item['end_time'],
						);
					}

				}
			}

			return $return;
		}
		return array();
	}

}

/**
 * End of file m_statistic_realtime.php
 */
/**
 * Location: ./app/models/m_statistic_realtime.php
 */