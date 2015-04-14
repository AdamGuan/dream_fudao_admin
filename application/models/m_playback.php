<?php
class M_playback extends MY_Model {

	public function __construct() {
		parent :: __construct();
//		$this -> load -> database();
	}

	/**
	 * 获取回放列表
	 * @param array $parames
	 *                 type    int 0所有，1精彩,2非精彩
	 *                  page   int 列表页面
	 * @return array
	 */
	public function get_playback_list($parames = array()){
		$data = array(
			'version'=>$this->my_config['api_version'],
			'c'=>'playback',
			'm'=>'get_playback_list',
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
		if(isset($parames['F_teacher_real_name']))
		{
			$data['F_teacher_real_name'] = $parames['F_teacher_real_name'];
		}
		if(isset($parames['F_user_real_name']))
		{
			$data['F_user_real_name'] = $parames['F_user_real_name'];
		}
		if(isset($parames['date']))
		{
			$data['date'] = $parames['date'];
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
	 * 改变回放状态
	 * @param array $parames
	 *                 F_order_ids   string  回放IDs,如1,2,3
	 *                 type   int   0所有，1精彩,2非精彩
	 * @return boolean
	 */
	public function change_playback_status($parames = array()){
		if(isset($parames['F_order_ids'],$parames['type']))
		{
			$data = array(
				'version'=>$this->my_config['api_version'],
				'c'=>'playback',
				'm'=>'set_playback_status',
				'F_order_ids'=>$parames['F_order_ids'],
				'type'=>$parames['type'],
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

}

/**
 * End of file m_playback.php
 */
/**
 * Location: ./app/models/m_playback.php
 */