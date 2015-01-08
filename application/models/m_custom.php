<?php
class M_custom extends MY_Model {

	public function __construct() {
		parent :: __construct();
//		$this -> load -> database();
	}

	/**
	 * 获取客服列表
	 * @param array $parames
	 *                 type   int 0：激活，1：冻结，2：删除,-1所有
	 *                 page   int 列表页面
	 * @return array
	 */
	public function get_custom_list($parames = array()){
		$data = array(
			'version'=>$this->my_config['api_version'],
			'c'=>'custom',
			'm'=>'get_custom_list',
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
	 * 改变客服状态
	 * @param array $parames
	 *                 F_teacher_ids   string  客服IDs,如1,2,3
	 *                 F_status   int 0：激活，1：冻结，2：删除，3：彻底删除
	 * @return boolean
	 */
	public function change_teacher_status($parames = array()){
		if(isset($parames['F_teacher_ids'],$parames['F_status']))
		{
			$data = array(
				'version'=>$this->my_config['api_version'],
				'c'=>'custom',
				'm'=>'change_custom_status',
				'F_teacher_ids'=>$parames['F_teacher_ids'],
				'F_status'=>$parames['F_status'],
			);

			$result = api_curl($this->my_config['api_uri'], $data, "POST", $this->my_config['api_key']);
			$result = json_decode($result,true);

			if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
			{
				return true;
			}
		}
		return false;
	}

	/**
	 * 获取客服信息
	 * @param array $parames
	 * @return array
	 */
	public function get_custom_info($parames = array()){
		if(isset($parames['F_teacher_id'],$parames['F_teacher_id']))
		{
			$data = array(
				'version'=>$this->my_config['api_version'],
				'c'=>'custom',
				'm'=>'get_a_custom',
				'F_teacher_id'=>$parames['F_teacher_id'],
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

	/**
	 * 修改客服信息
	 * @param array $parames
	 * @return array
	 */
	public function custom_modify($parames = array()){
		if(isset($parames['F_teacher_id']))
		{
			unset($parames['c']);
			unset($parames['m']);
			$data = array(
				'version'=>$this->my_config['api_version'],
				'c'=>'custom',
				'm'=>'update_a_custom',
				'F_teacher_id'=>$parames['F_teacher_id']
			);

			$data = array_merge($data,$parames);
			$result = api_curl($this->my_config['api_uri'], $data, "POST", $this->my_config['api_key']);
			$result = json_decode($result,true);

			if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
			{
				return $result;
			}
		}
		return array();
	}

	/**
	 * 添加客服
	 * @param array $parames
	 * @return array
	 */
	public function custom_add($parames = array()){
		if(isset($parames['F_real_name'],$parames['F_teacher_name'],$parames['F_teacher_password'],$parames['F_gender']))
		{
			unset($parames['c']);
			unset($parames['m']);
			$data = array(
				'version'=>$this->my_config['api_version'],
				'c'=>'custom',
				'm'=>'add_a_custom',
			);

			$data = array_merge($data,$parames);

			$result = api_curl($this->my_config['api_uri'], $data, "POST", $this->my_config['api_key']);
			$result = json_decode($result,true);

			if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
			{
				return $result;
			}
		}
		return array();
	}

}

/**
 * End of file m_custom.php
 */
/**
 * Location: ./app/models/m_custom.php
 */