<?php
class M_login extends MY_Model {

	public function __construct() {
		parent :: __construct();
		$this -> load -> database();
	}

	/**
	 * 检查用户名，密码是否正确
	 * @parame	$username	string
	 * @parame	$pwd		string
	 * @return	$result	array
	 */
	public function check_user_login($username,$pwd)
	{
		$result = array();
		if(isset($username,$pwd))
		{
			//在管理员表里面查询
			$this->db->select('*');
			$this->db->from('t_user');
			$array = array('F_login_name' => $username, 'F_login_password' => md5($pwd));
			$this->db->where($array);
			$this->db->limit(1);
			$query = $this->db->get();
			if ($query->num_rows() > 0)
			{
				$resulttmp = $query->row_array();
				$result["F_id"] = $resulttmp["F_id"];
				$result["F_login_name"] = $resulttmp["F_login_name"];
			}
			else{   //查询是否为老师
				$this->db->select('*');
				$this->db->from('t_teacher');
				$array = array('F_login_name' => $username);
				$this->db->where($array);
				$this->db->limit(1);
				$query = $this->db->get();
				if ($query->num_rows() > 0)
				{
					$resulttmp = $query->row_array();
					//利用api检查老师是否存在
					$data = array(
						'version'=>$this->my_config['api_version'],
						'c'=>'teacher',
						'm'=>'login',
						'F_teacher_name'=>$username,
						'F_teacher_password'=>$pwd,
					);
					$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
					$result = json_decode($result,true);
					if(is_array($result) && isset($result['responseNo']) && $result['responseNo'] == 0)
					{
						$result["F_id"] = $resulttmp["F_api_uid"];
						$result["F_login_name"] = $resulttmp["F_login_name"];
					}
				}
			}
		}
		return $result;
	}

	/**
	 * 登录页面检查是否登录
	 *
	 * @return $result	int	1登录，0未登录.
	 */
	public function login_page_check_login() {
		$result = 0;

		$F_user_id = $this -> session -> userdata('F_user_id');
		if(isset($F_user_id))
		{
			$result = 1;
		}

		return $result;
	}

	/**
	 * 登出
	 */
	public function login_out() {
		$F_user_id = $this -> session -> userdata('F_id');
		if(isset($F_user_id))
		{
			$session_array = array(
				'F_login_name'=>'',
				'F_id'=>''
			);
			$this -> session -> unset_userdata($session_array);
		}
		return 1;
	}

}

/**
 * End of file m_login.php
 */
/**
 * Location: ./app/model/m_login.php
 */