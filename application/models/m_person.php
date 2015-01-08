<?php
class M_person extends MY_Model {

	public function __construct() {
		parent :: __construct();
		$this -> load -> database();
	}

	//修改用户信息
	public function update_user_info($parames = array())
	{
		$return = false;
		if(isset($parames['F_login_password']))
		{
			$this->db->where('F_id', $this -> session -> userdata('F_id'));
			$this->db->update('t_user', array('F_login_password'=>$parames['F_login_password'],'F_modify_time'=>date('Y-m-d H:i:s',time())));
			if($this->db->affected_rows() > 0)
			{
				$return = true;
			}
		}

		return $return;
	}

	//修改老师信息
	public function update_teacher_info($parames = array())
	{
		$return = false;
		if(isset($parames['F_login_password']))
		{
			unset($parames['c']);
			unset($parames['m']);
				$data = array(
					'version'=>$this->my_config['api_version'],
					'c'=>'teacher',
					'm'=>'update_a_teacher',
					'F_teacher_id'=>$this -> session -> userdata('F_id'),
					'F_teacher_password'=>$parames['F_login_password']
				);

				$data = array_merge($data,$parames);

				$result = api_curl($this->my_config['api_uri'], $data, "POST", $this->my_config['api_key']);
				$result = json_decode($result,true);

				if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
				{
					$return = true;
				}
		}

		return $return;
	}

}

/**
 * End of file m_person.php
 */
/**
 * Location: ./app/model/m_person.php
 */