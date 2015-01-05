<?php
class M_statistic_timesection extends MY_Model {

	public function __construct() {
		parent :: __construct();
//		$this -> load -> database();
	}

	/**
	 * 获取时间段统计的数据
	 * @param array $parames
	 *                  type    int 0,1,2,3
	 *                  datetype    int 0,1,2
	 * @return array
	 */
	public function get_timesection_data($parames = array()){
		$return = array();
		if(isset($parames['type'],$parames['datetype'],$parames['date']))
		{
			$return['type'] = (int)$parames['type'];
			$return['datetype'] = (int)$parames['datetype'];
			$data = array('version'=>$this->my_config['api_version'],'c'=>'statistics_timesection');
			switch((int)$parames['type']){
				case 0: //提问次数
					$return['desc'] = "提问次数";
					switch((int)$parames['datetype']){
						case 0: //按天
							$return['date'] = $parames['date'];
							$data['m'] = 'get_ask_times_someday';
							$data['date'] = $parames['date'];
							//curl
							$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
							$result = json_decode($result,true);
							if(is_array($result) && isset($result['responseNo'],$result['info']) && $result['responseNo'] == 0)
							{
								foreach($result['info'] as $item)
								{
									$return['list'][] = array('times'=>$item['ask_times'],'desc'=>(int)$item['start_time']);
								}
							}
							break;
						case 1: //按月
							$return['date'] = $parames['date'];
							$data['m'] = 'get_ask_times_somemonth';
							$data['date'] = $parames['date'];
							//curl
							$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
							$result = json_decode($result,true);
							if(is_array($result) && isset($result['responseNo'],$result['info']) && $result['responseNo'] == 0)
							{
								foreach($result['info'] as $item)
								{
									$return['list'][] = array('times'=>$item['ask_times'],'desc'=>$item['day']);
								}
							}
							break;
						case 2: //按年
							$return['date'] = $parames['date'];
							$data['m'] = 'get_ask_times_someyear';
							$data['date'] = $parames['date'];
							//curl
							$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
							$result = json_decode($result,true);
							if(is_array($result) && isset($result['responseNo'],$result['info']) && $result['responseNo'] == 0)
							{
								foreach($result['info'] as $item)
								{
									$return['list'][] = array('times'=>$item['ask_times'],'desc'=>$item['month']);
								}
							}
							break;
						default:
							break;
					}
					break;
				case 1: //提问人数
					$return['desc'] = "提问人数";
					switch((int)$parames['datetype']){
						case 0: //按天
							$return['date'] = $parames['date'];
							$data['m'] = 'get_ask_people_number_someday';
							$data['date'] = $parames['date'];
							//curl
							$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
							$result = json_decode($result,true);
							if(is_array($result) && isset($result['responseNo'],$result['info']) && $result['responseNo'] == 0)
							{
								foreach($result['info'] as $item)
								{
									$return['list'][] = array('times'=>$item['ask_people_number'],'desc'=>(int)$item['start_time']);
								}
							}
							break;
						case 1: //按月
							$return['date'] = $parames['date'];
							$data['m'] = 'get_ask_people_number_somemonth';
							$data['date'] = $parames['date'];
							//curl
							$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
							$result = json_decode($result,true);
							if(is_array($result) && isset($result['responseNo'],$result['info']) && $result['responseNo'] == 0)
							{
								foreach($result['info'] as $item)
								{
									$return['list'][] = array('times'=>$item['ask_people_number'],'desc'=>$item['day']);
								}
							}
							break;
						case 2: //按年
							$return['date'] = $parames['date'];
							$data['m'] = 'get_ask_people_number_someyear';
							$data['date'] = $parames['date'];
							//curl
							$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
							$result = json_decode($result,true);
							if(is_array($result) && isset($result['responseNo'],$result['info']) && $result['responseNo'] == 0)
							{
								foreach($result['info'] as $item)
								{
									$return['list'][] = array('times'=>$item['ask_people_number'],'desc'=>$item['month']);
								}
							}
							break;
						default:
							break;
					}
					break;
				case 2: //辅导次数
					$return['desc'] = "辅导次数";
					switch((int)$parames['datetype']){
						case 0: //按天
							$return['date'] = $parames['date'];
							$data['m'] = 'get_teaching_times_someday';
							$data['date'] = $parames['date'];
							//curl
							$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
							$result = json_decode($result,true);
							if(is_array($result) && isset($result['responseNo'],$result['info']) && $result['responseNo'] == 0)
							{
								foreach($result['info'] as $item)
								{
									$return['list'][] = array('times'=>$item['teaching_times'],'desc'=>(int)$item['start_time']);
								}
							}
							break;
						case 1: //按月
							$return['date'] = $parames['date'];
							$data['m'] = 'get_teaching_times_somemonth';
							$data['date'] = $parames['date'];
							//curl
							$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
							$result = json_decode($result,true);
							if(is_array($result) && isset($result['responseNo'],$result['info']) && $result['responseNo'] == 0)
							{
								foreach($result['info'] as $item)
								{
									$return['list'][] = array('times'=>$item['teaching_times'],'desc'=>$item['day']);
								}
							}
							break;
						case 2: //按年
							$return['date'] = $parames['date'];
							$data['m'] = 'get_teaching_times_someyear';
							$data['date'] = $parames['date'];
							//curl
							$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
							$result = json_decode($result,true);
							if(is_array($result) && isset($result['responseNo'],$result['info']) && $result['responseNo'] == 0)
							{
								foreach($result['info'] as $item)
								{
									$return['list'][] = array('times'=>$item['teaching_times'],'desc'=>$item['month']);
								}
							}
							break;
						default:
							break;
					}
					break;
				case 3: //在线人数
					$return['desc'] = "在线人数";
					switch((int)$parames['datetype']){
						case 0: //按天
							$return['date'] = $parames['date'];
							$data['m'] = 'get_online_people_number_someday';
							$data['date'] = $parames['date'];
							//curl
							$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
							$result = json_decode($result,true);
							if(is_array($result) && isset($result['responseNo'],$result['info']) && $result['responseNo'] == 0)
							{
								foreach($result['info'] as $item)
								{
									$return['list'][] = array('times'=>$item['online_people_number'],'desc'=>(int)$item['start_time']);
								}
							}
							break;
						case 1: //按月
							$return['date'] = $parames['date'];
							$data['m'] = 'get_online_people_number_somemonth';
							$data['date'] = $parames['date'];
							//curl
							$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
							$result = json_decode($result,true);
							if(is_array($result) && isset($result['responseNo'],$result['info']) && $result['responseNo'] == 0)
							{
								foreach($result['info'] as $item)
								{
									$return['list'][] = array('times'=>$item['online_people_number'],'desc'=>$item['day']);
								}
							}
							break;
						case 2: //按年
							$return['date'] = $parames['date'];
							$data['m'] = 'get_online_people_number_someyear';
							$data['date'] = $parames['date'];
							//curl
							$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
							$result = json_decode($result,true);
							if(is_array($result) && isset($result['responseNo'],$result['info']) && $result['responseNo'] == 0)
							{
								foreach($result['info'] as $item)
								{
									$return['list'][] = array('times'=>$item['online_people_number'],'desc'=>$item['month']);
								}
							}
							break;
						default:
							break;
					}
					break;
				default:
					break;
			}
		}


		return $return;
	}

}

/**
 * End of file m_statistic_timesection.php
 */
/**
 * Location: ./app/models/m_statistic_timesection.php
 */