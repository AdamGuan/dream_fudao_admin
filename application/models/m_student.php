<?php
class M_student extends MY_Model {

	public function __construct() {
		parent :: __construct();
	}

	/**
	 * 获取学生列表
	 * @param array $parames
	 *                  page   int 列表页面
	 * @return array
	 */
	public function get_student_list($parames = array()){
		$data = array(
			'version'=>$this->my_config['api_version'],
			'c'=>'student',
			'm'=>'get_student_list',
			'type'=>0,
			'offset'=>0,
			'limit'=>10,
		);
		if(isset($parames['type']))
		{
			$data['type'] = $parames['type'];
		}
		if(isset($parames['page']))
		{
			$data['offset'] = ((int)$parames['page']-1)*$this->my_config['page'];
			$data['limit'] = $this->my_config['page'];
		}

		$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
		$result = json_decode($result,true);
		if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
		{
			return $result;
		}
		return array();
	}

}

/**
 * End of file m_student.php
 */
/**
 * Location: ./app/models/m_student.php
 */