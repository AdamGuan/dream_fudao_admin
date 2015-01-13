<?php
class M_index extends MY_Model {

	protected $captcha_table;

	public function __construct() {
		parent :: __construct();
//		$this -> load -> database();
	}

	public function get_online_teacher_num(){
		$data = array(
			'version'=>$this->my_config['api_version'],
			'c'=>'statistics_realtime',
			'm'=>'get_teacher_statistics_realtime',
		);
		$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
		$result = json_decode($result,true);
		if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
		{
			return $result['info']['teacher_total'] - $result['info']['teacher_offline'];
		}
		return 0;
	}

	public function get_online_student_num(){
		$data = array(
			'version'=>$this->my_config['api_version'],
			'c'=>'statistics_realtime',
			'm'=>'get_user_statistics_realtime',
		);
		$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
		$result = json_decode($result,true);
		if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
		{
			return $result['info']['user_total'] - $result['info']['user_offline'];
		}
		return 0;
	}

	public function get_online_num(){
		$data_list = array();
		$data_list[] = array(
			'version'=>$this->my_config['api_version'],
			'c'=>'statistics_realtime',
			'm'=>'get_teacher_statistics_realtime',
		);
		$data_list[] = array(
			'version'=>$this->my_config['api_version'],
			'c'=>'statistics_realtime',
			'm'=>'get_user_statistics_realtime',
		);
		$method_list = array("GET","GET");
		$results = api_curl_multi($this->my_config['api_uri'], $data_list, $method_list,$this->my_config['api_key']);

		if(is_array($results) && count($results) == 2)
		{
			$result = json_decode($results[0],true);
			if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
			{
				$teacher_num =  $result['info']['teacher_total'] - $result['info']['teacher_offline'];
			}
			$result = json_decode($results[1],true);
			if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
			{
				$student_num =  $result['info']['user_total'] - $result['info']['user_offline'];
			}
		}
		$return = array();
		$return['teacher_online_num'] = isset($teacher_num)?$teacher_num:0;
		$return['student_online_num'] = isset($student_num)?$student_num:0;
		return $return;
	}


}

/**
 * End of file m_index.php
 */
/**
 * Location: ./app/models/m_index.php
 */