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
	 *                 type    int 0：激活，1：冻结，2：删除，3：彻底删除，4：测试
	 *                  page   int 列表页面
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

	/**
	 * 改变老师状态
	 * @param array $parames
	 *                 F_teacher_ids   string  老师IDs,如1,2,3
	 *                 F_status   int 0：激活，1：冻结，2：删除，3：彻底删除，4：测试
	 * @return boolean
	 */
	public function change_teacher_status($parames = array()){
		if(isset($parames['F_teacher_ids'],$parames['F_status']))
		{
			$data = array(
				'version'=>'server_v1',
				'c'=>'teacher',
				'm'=>'change_teacher_status',
				'F_teacher_ids'=>$parames['F_teacher_ids'],
				'F_status'=>$parames['F_status'],
				'F_who'=>"1",
			);

			$result = api_curl($this->my_config['api_uri'], $data, "POST", $this->my_config['api_key']);
			$result = json_decode($result,true);
			debug($result);

			if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
			{
				return true;
			}
		}
		return false;
	}

	public function get_teacher_info($parames = array()){
		if(isset($parames['F_teacher_id'],$parames['F_teacher_id']))
		{
			$data = array(
				'version'=>'server_v1',
				'c'=>'teacher',
				'm'=>'get_a_teacher',
				'F_teacher_id'=>(int)$parames['F_teacher_id'],
			);

			$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
			$result = json_decode($result,true);

			if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0 && isset($result['info']))
			{
				return $result['info'];
			}
		}
		return array();
	}

	public function teacher_modify($parames = array()){
		/*
		$data = array(
			'version'=>'server_v1',
			'c'=>'teacher',
			'm'=>'update_a_teacher',
			'F_teacher_id'=>(int)$parames['F_teacher_id'],
		);

		$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
		$result = json_decode($result,true);

		if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0 && isset($result['info']))
		{
			return $result['info'];
		}
		*/
	}

}

/**
 * End of file m_teacher.php
 */
/**
 * Location: ./app/models/m_teacher.php
 */