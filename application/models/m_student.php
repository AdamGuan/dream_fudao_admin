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
			'limit'=>$this->my_config['page'],
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
		if(isset($parames['F_real_name']))
		{
			$data['F_real_name'] = $parames['F_real_name'];
		}
		if(isset($parames['F_teacher_name']))
		{
			$data['F_user_name'] = $parames['F_user_name'];
		}
		if(isset($parames['F_grade']))
		{
			$data['F_grade'] = $parames['F_grade'];
		}
		if(isset($parames['F_login']))
		{
			$data['F_login'] = $parames['F_login'];
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
	 * 改变学生状态
	 * @param array $parames
	 *                 F_user_ids   string  学生IDs,如1,2,3
	 *                 F_status   int 0：激活，1：冻结，2：删除，3：彻底删除，4：测试
	 * @return boolean
	 */
	public function change_student_status($parames = array()){
		if(isset($parames['F_user_ids'],$parames['F_status']))
		{
			$data = array(
				'version'=>$this->my_config['api_version'],
				'c'=>'student',
				'm'=>'change_student_status',
				'F_user_ids'=>$parames['F_user_ids'],
				'F_status'=>$parames['F_status'],
				'F_who'=>"1",
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

	public function get_a_student_teaching_info($parames = array()){
		$return = array('total'=>0,'list'=>array());
		if(isset($parames['student_id']) && strlen($parames['student_id']) > 0)
		{
			$data = array('version'=>$this->my_config['api_version'],'c'=>'statistics_student','offset'=>0,'limit'=>10000);
			$data['m'] = 'get_a_student_all_teaching_info';
			$data['student_id'] = $parames['student_id'];
			if(isset($parames['page']))
			{
				$data['offset'] = ((int)$parames['page']-1)*$this->my_config['page'];
				$data['limit'] = $this->my_config['page'];
			}
			
			//curl
			
			$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
			$result = json_decode($result,true);
			if(is_array($result) && isset($result['responseNo'],$result['list'],$result['total']) && $result['responseNo'] == 0)
			{
				$return['list'] = $result['list'];
				$return['total'] = $result['total'];
			}
		}
		return $return;
	}

}

/**
 * End of file m_student.php
 */
/**
 * Location: ./app/models/m_student.php
 */