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
	 *              F_id            int
	 *              F_login_name    string
	 *              F_privity_group_name    string
	 *              F_privity    array
	 *              F_could_has_child    int
	 *              F_level    int
	 *              F_privity_group_id    int
	 */
	public function check_user_login($username,$pwd)
	{
		$result = array();
		if(isset($username,$pwd))
		{
			//在管理员表里面查询
			$sql = 'SELECT u.F_id,u.F_login_name,pg.F_name as F_privity_group_name,pg.F_privity,pg.F_could_has_child,pg.F_level,pg.F_id as F_privity_group_id
					FROM t_user as u,t_privity_group as pg
					WHERE u.F_login_name="' .$username.'"AND
					u.F_login_password= "'.$pwd.'" AND
					u.F_privity_group_id = pg.F_id AND
					pg.F_status = 1 LIMIT 1';
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0)
			{
				$resulttmp = $query->row_array();
				$result["F_id"] = $resulttmp["F_id"];
				$result["F_login_name"] = $resulttmp["F_login_name"];
				$result["F_privity_group_name"] = $resulttmp["F_privity_group_name"];
				$result["F_privity"] = $resulttmp["F_privity"];
				$result["F_could_has_child"] = $resulttmp["F_could_has_child"];
				$result["F_level"] = $resulttmp["F_level"];
				$result["F_privity_group_id"] = $resulttmp["F_privity_group_id"];
			}
			else{   //查询是否为老师
				if (1)
				{
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

						$resulttmp2 = $query->row_array();
						$result["F_id"] = $result["F_teacher_id"];
						$result["F_login_name"] = $username;
						$result["F_privity_group_name"] = '老师';
						$result["F_privity"] = implode(",",$this->my_config['data']['teacher_privity']);
						$result["F_could_has_child"] = 0;
						$result["F_level"] = 1;
						$result["F_privity_group_id"] = -1;
					}
				}
			}
		}
		if(isset($result["F_privity"]))
		{
			$result["F_privity"] = explode(",",$result["F_privity"]);
		}

		//设置session
		if(is_array($result) && isset($result['F_id']))
		{
			$is_supper_admin = false;
			$is_teacher = false;
			if(isset($result['F_level']) && $result['F_level'] == 0)
			{
				$is_supper_admin = true;
			}
			if(isset($result['F_level']) && $result['F_level'] == 1)
			{
				$is_teacher = true;
			}

			$session_array = array(
				'F_login_name'=>$result['F_login_name'],
				'F_id'=>$result['F_id'],
				'F_role_name'=>$result['F_privity_group_name'],
				'F_privity_group_id'=>$result['F_privity_group_id'],
				'privaty'=>$result['F_privity'],
				'F_could_has_child'=>$result['F_could_has_child'],
				'is_super_admin'=>$is_supper_admin,
				'is_teacher'=>$is_teacher,
			);
			$this->session->set_userdata($session_array);
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

		$F_user_id = $this -> session -> userdata('F_id');
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
				'F_id'=>'',
				'privaty'=>''
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