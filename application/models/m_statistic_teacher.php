<?php
class M_statistic_teacher extends MY_Model {

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
	public function get_teaching_data($parames = array()){
		$return = array();
		if(isset($parames['datetype'],$parames['date']))
		{
			$return['datetype'] = (int)$parames['datetype'];
			$data = array('version'=>$this->my_config['api_version'],'c'=>'statistics_teacher','offset'=>0,'limit'=>10000);
			switch((int)$parames['datetype']){
				case 0: //按天
					$return['date'] = $parames['date'];
					$data['m'] = 'get_teaching_statistics_info_someday';
					$data['date'] = $parames['date'];
					//curl
					$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
					$result = json_decode($result,true);
					if(is_array($result) && isset($result['responseNo'],$result['list']) && $result['responseNo'] == 0)
					{
						$return['list'] = $result['list'];
						$return['total'] = $result['total'];
					}
					break;
				case 1: //按月
					$return['date'] = $parames['date'];
					$data['m'] = 'get_teaching_statistics_info_somemonth';
					$data['date'] = $parames['date'];
					//curl
					$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
					$result = json_decode($result,true);
					if(is_array($result) && isset($result['responseNo'],$result['list']) && $result['responseNo'] == 0)
					{
						$return['list'] = $result['list'];
						$return['total'] = $result['total'];
					}
					break;
				case 2: //按年
					$return['date'] = $parames['date'];
					$data['m'] = 'get_teaching_statistics_info_someyear';
					$data['date'] = $parames['date'];
					//curl
					$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
					$result = json_decode($result,true);
					if(is_array($result) && isset($result['responseNo'],$result['list']) && $result['responseNo'] == 0)
					{
						$return['list'] = $result['list'];
						$return['total'] = $result['total'];
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
 * End of file m_statistic_teacher.php
 */
/**
 * Location: ./app/models/m_statistic_teacher.php
 */