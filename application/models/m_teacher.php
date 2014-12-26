<?php
class M_teacher extends MY_Model {

	protected $captcha_table;

	public function __construct() {
		parent :: __construct();
//		$this -> load -> database();
	}

	/**
	 * 获取老师列表
	 * @param array $parames
	 * @return array
	 */
	public function get_teacher_list($parames = array()){
		$data = array(
			'version'=>'server_v1',
			'c'=>'teacher',
			'm'=>'get_teacher_list',
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

	public function change_teacher_status($parames = array()){
		if(isset($parames['F_teacher_ids'],$parames['F_status']))
		{
			$data = array(
				'version'=>'server_v1',
				'c'=>'teacher',
				'm'=>'change_teacher_status',
				'F_teacher_ids'=>$parames['F_teacher_ids'],
				'F_status'=>$parames['F_status'],
				'F_who'=>"",
			);

			$result = api_curl($this->my_config['api_uri'], $data, "POST",$this->my_config['api_key']);
			$result = json_decode($result,true);
			if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
			{
				return true;
			}
		}
		return false;
	}


}

/**
 * End of file m_teacher.php
 */
/**
 * Location: ./app/models/m_teacher.php
 */