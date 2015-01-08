<?php
class M_statistic_student extends MY_Model {

	public function __construct() {
		parent :: __construct();
//		$this -> load -> database();
	}

	/**
	 *
	 * @param array $parames
	 *                  date        string,optional
	 *                  datetype    int 0,1,2
	 * @return array
	 */
	public function get_data($parames = array()){
		$return = array();
		if(isset($parames['datetype'],$parames['date']))
		{
			unset($parames['c']);
			unset($parames['m']);
			$return['datetype'] = (int)$parames['datetype'];
			$data = array('version'=>$this->my_config['api_version'],'c'=>'statistics_student');
			switch((int)$parames['datetype']){
				case 1: //按月
					$return['date'] = $parames['date'];
					$data['m'] = 'get_student_statistics_info_month';
					$data['date'] = $parames['date'];
					//curl
					$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
					$result = json_decode($result,true);
					if(is_array($result) && isset($result['responseNo'],$result['list']) && $result['responseNo'] == 0)
					{
						$return['list'] = $result['list'];
					}
					break;
				case 2: //按年
					$return['date'] = $parames['date'];
					$data['m'] = 'get_student_statistics_info_year';
					$data['date'] = $parames['date'];
					//curl
					$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
					$result = json_decode($result,true);
					if(is_array($result) && isset($result['responseNo'],$result['list']) && $result['responseNo'] == 0)
					{
						$return['list'] = $result['list'];
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
 * End of file m_statistic_student.php
 */
/**
 * Location: ./app/models/m_statistic_student.php
 */