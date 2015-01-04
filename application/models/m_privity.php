<?php
class M_privity extends MY_Model {

	public function __construct() {
		parent :: __construct();
		$this -> load -> database();
	}

	/**
	 * 获取权限组列表
	 * @param array $parames    下面返回参数中的条件数组
	 * @return array    二维数组
	 *              F_id                int
	 *              F_pid               int
	 *              F_name              string
	 *              F_description       string
	 *              F_privity           string
	 *              F_status            int
	 *              F_could_has_child   int
	 *              F_create_by_uid     int
	 *              F_create_time       datetime
	 *              F_modify_time       datetime
	 *              F_level             int
	 */
	public function get_group_list($parames = array()){
		$result = array();
		$F_privity_group_id = $this->session->userdata('F_privity_group_id');
		$is_super_admin = $this->session->userdata('is_super_admin');
		if($F_privity_group_id !== false)
		{
			if($is_super_admin === true)
			{
				$where = array();
			}
			else{
				$where = array('F_pid' => $F_privity_group_id);
			}
			$where = array_merge($where,$parames);
			$query = $this->db->get_where('t_privity_group',$where);
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}
		}
		return $result;
	}

	/**
	 * 获取有效的权限组列表
	 * @param array $parames
	 * @return mixed
	 */
	public function get_group_list_valid($parames = array()){
		return $this->get_group_list(array("F_status"=>1));
	}

	/**
	 * 获取在前端显示的权限选择check html代码
	 * @param array $parames
	 *          privity array   权限数组,optional
	 *          checked_privity array   已经选择的权限数组,optional
	 * @return string
	 */
	public function get_privity_htmlstr($parames = array()){
		$global_all_privity_list = $this->my_config['data']['global_all_privity_list'];
		$privity = isset($parames['privity'])?$parames['privity']:array();
		$checked_privity = isset($parames['checked_privity'])?$parames['checked_privity']:array();
		return build_privity_str($global_all_privity_list,$privity,$checked_privity);
	}

	/**
	 * 获取一个权限组的权限值
	 * @param $group_id
	 * @return array
	 */
	public function get_group_privity($group_id){
		$result = array();
		if(isset($group_id))
		{
			$group_id = (int)$group_id;
			$query = $this->db->get_where('t_privity_group',array('F_id'=>$group_id,'F_status'=>1));
			if($query->num_rows() > 0)
			{
				$tmp = $query->row_array();
				$tmp = $tmp['F_privity'];
				$result = explode(",",$tmp);
			}
		}
		return $result;
	}

	/**
	 * 添加一个权限组
	 * @param array $parame
	 *              F_pid               int,optional
	 *              F_name              string
	 *              F_description       string,optional
	 *              F_privity           string
	 *              F_status            int,optional
	 *              F_could_has_child   int,optional
	 * @return array
	 */
	public function group_add($parame = array())
	{
		$result = array("error"=>-1,"msg"=>"操作失败,请重试!");
		if(isset($parame['F_name'],$parame['F_privity']))
		{
			$valid = 1;
			//检查$parame['F_name']的有效性
			if(strlen($parame['F_name']) > 0 && strlen($parame['F_name']) <= 30)
			{
				$sql = 'SELECT F_id FROM t_privity_group WHERE F_name = "'.$parame['F_name'].'" LIMIT 1';
				$query = $this->db->query($sql);
				if($query->num_rows() > 0){
					$valid = 0;
					$result = array("error"=>-2,"msg"=>"组名已使用,请修改组名");
				}
			}
			else{
				$valid = 0;
				$result = array("error"=>-1,"msg"=>"组名无效");
			}
			//检查$parame['F_privity']的有效性
			if($valid === 1)
			{
				$parame['F_privity'] = (string)$parame['F_privity'];
			}

			if($valid === 1)
			{
				$parame['F_pid'] = isset($parame['F_pid'])?$parame['F_pid']:$this->session->userdata('F_id');
				$parame['F_create_by_uid'] = $this->session->userdata('F_id');
				$now = date("Y-m-d H:i:s",time());
				$parame['F_create_time'] =$now;
				$parame['F_modify_time'] =$now;

				$this->db->insert('t_privity_group', $parame);
				if(!($this->db->insert_id() > 0))
				{
					$result = array("error"=>-3,"msg"=>"操作失败,请重试!");
				}
				else{
					$result = array("error"=>0,"msg"=>"成功");
				}
			}
		}
		return $result;
	}

	public function group_change_status($parame = array())
	{
		$result = false;
		if(isset($parame['F_ids'],$parame['F_status']) && in_array($parame['F_status'],array(0,1)))
		{
			$idlist = explode(",",$parame['F_ids']);
			if(is_array($idlist) && count($idlist) > 0)
			{
				//验证是否有权限 冻结/激活
				$valid = 0;
				if($this->session->userdata('is_super_admin'))
				{
					$valid = 1;
				}
				else
				{
					$sql = "SELECT F_id FROM t_privity_group WHERE F_pid = ".$this->session->userdata('F_privity_group_id');
					$query = $this->db->query($sql);
					if($query->num_rows() > 0)
					{
						$tmp = $query->result_array();
						foreach($idlist as $id)
						{
							$valid = 1;
							if(!in_array($id,$tmp))
							{
								$valid = 0;
								break;
							}
						}
					}
				}
				//
				if($valid === 1)
				{
					$this->db->where_in('F_id', $idlist);
					$this->db->update('t_privity_group', array("F_status"=>$parame['F_status'],'F_modify_time'=>date("Y-m-d H:i:s",time())));
					if($this->db->affected_rows() > 0)
					{
						$result = true;
					}
				}
			}
		}
		return $result;
	}

	public function group_change_delete($parame = array())
	{
		$result = false;
		if(isset($parame['F_ids']))
		{
			$idlist = explode(",",$parame['F_ids']);
			if(is_array($idlist) && count($idlist) > 0)
			{
				//验证是否有删除权限
				$valid = 0;
				if($this->session->userdata('is_super_admin'))
				{
					$valid = 1;
				}
				else
				{
					$sql = "SELECT F_id FROM t_privity_group WHERE F_pid = ".$this->session->userdata('F_privity_group_id');
					$query = $this->db->query($sql);
					if($query->num_rows() > 0)
					{
						$tmp = $query->result_array();
						foreach($idlist as $id)
						{
							$valid = 1;
							if(!in_array($id,$tmp))
							{
								$valid = 0;
								break;
							}
						}
					}
				}
				//
				if($valid === 1)
				{
					$this->db->where_in('F_id', $idlist);
					$this->db->delete('t_privity_group');
					if($this->db->affected_rows() > 0)
					{
						$result = true;
					}
				}
			}
		}
		return $result;
	}

	public function get_group_info($parame = array()){
		$return = array();
		if(isset($parame['F_id']))
		{
			//验证是否有编辑权限
			$info = array();
			$valid = 0;
			if($this->session->userdata('is_super_admin'))
			{
				$sql = "SELECT * FROM t_privity_group WHERE F_id = ".(int)$parame['F_id']." LIMIT 1";
				$query = $this->db->query($sql);
				if($query->num_rows() > 0)
				{
					$info = $query->row_array();
					$valid = 1;
				}
			}
			else
			{
				$sql = "SELECT * FROM t_privity_group WHERE F_pid = ".$this->session->userdata('F_privity_group_id')." AND F_id = ".(int)$parame['F_id']." LIMIT 1";
				$query = $this->db->query($sql);
				if($query->num_rows() > 0)
				{
					$info = $query->row_array();
					$valid = 1;
				}
			}
			//
			if($valid === 1 && count($info) > 0)
			{
				//获取权限列表
				$global_privity_htmlstr = $this->get_privity_htmlstr(array("privity"=>$this->session->userdata('privaty'),"checked_privity"=>explode(",",$info['F_privity'])));
				$return = $info;
				$return['privity_html'] = $global_privity_htmlstr;
			}
		}
		return $return;
	}

	public function group_update($parame = array())
	{
		$result = array("error"=>-1,"msg"=>"操作失败,请重试!");
		if(isset($parame['F_id'],$parame['F_name'],$parame['F_privity']))
		{
			$valid = 1;
			$parame['F_id'] = (int)$parame['F_id'];
			//检查$parame['F_name']的有效性
			if(strlen($parame['F_name']) > 0 && strlen($parame['F_name']) <= 30)
			{
				$sql = 'SELECT F_id FROM t_privity_group WHERE F_id != '.$parame['F_id'].' AND F_name = "'.$parame['F_name'].'" LIMIT 1';
				$query = $this->db->query($sql);
				if($query->num_rows() > 0){
					$valid = 0;
					$result = array("error"=>-2,"msg"=>"组名已使用,请修改组名");
				}
			}
			else{
				$valid = 0;
				$result = array("error"=>-1,"msg"=>"组名无效");
			}
			//检查$parame['F_privity']的有效性
			if($valid === 1)
			{
				$parame['F_privity'] = (string)$parame['F_privity'];
			}

			if($valid === 1)
			{
				$parame['F_modify_time'] =date("Y-m-d H:i:s",time());
				$this->db->where('F_id', $parame['F_id']);
				unset($parame['F_id']);
				$this->db->update('t_privity_group', $parame);
				if(!($this->db->affected_rows() > 0))
				{
					$result = array("error"=>-3,"msg"=>"操作失败,请重试!");
				}
				else{
					$result = array("error"=>0,"msg"=>"成功");
				}
			}
		}
		return $result;
	}

	/**
	 * @param array $parame
	 * @return array
	 */
	public function get_user_list($parame = array()){
		$return = array();
		$valid = 0;
		$where = "1 AND t_user.F_privity_group_id = t_privity_group.F_id";
		//查询条件：
		$is_super_admin = $this->session->userdata('is_super_admin');
		if(!$is_super_admin)
		{
			//查询当前用户的子权限组id列表
			$sql = "SELECT F_id FROM t_privity_group WHERE F_pid = ".$this->session->userdata('F_privity_group_id');
			$query = $this->db->query($sql);
			if($query->num_rows() > 0)
			{
				$tmp = $query->result_array();
				$valid = 1;
				$where .= ' AND t_user.F_privity_group_id IN('.explode(",",$tmp).')';
			}
		}
		else{
			$valid = 1;
		}
		//查询条件：
		if($valid === 1 && isset($parame['F_privity_group_id']))
		{
			$where .= ' AND t_user.F_privity_group_id = '.(int)$parame['F_privity_group_id'];
		}
		//查询条件：
		if($valid === 1 && isset($parame['F_status']))
		{
			$where .= ' AND t_user.F_status = '.(int)$parame['F_status'];
		}
		$where .= ' AND t_user.F_id != '.$this->session->userdata('F_id');
		$sql = 'SELECT t_user.*,t_privity_group.F_name FROM t_user,t_privity_group WHERE '.$where;
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			$return = $query->result_array();
		}
		return $return;
	}

	public function user_change_status($parame = array())
	{
		$result = false;
		if(isset($parame['F_ids'],$parame['F_status']) && in_array($parame['F_status'],array(0,1)))
		{
			$idlist = explode(",",$parame['F_ids']);
			if(is_array($idlist) && count($idlist) > 0)
			{
				//验证是否有权限 冻结/激活
				if($this->session->userdata('is_super_admin'))
				{
					$this->db->where_in('F_id', $idlist);
					$this->db->update('t_user', array("F_status"=>$parame['F_status'],'F_modify_time'=>date("Y-m-d H:i:s",time())));
					if($this->db->affected_rows() > 0)
					{
						$result = true;
					}
				}
				else
				{
					$sql = "SELECT F_id FROM t_privity_group WHERE F_pid = ".$this->session->userdata('F_privity_group_id');
					$query = $this->db->query($sql);
					if($query->num_rows() > 0)
					{
						$tmp = $query->result_array();

						$this->db->where_in('F_id', $idlist);
						$this->db->where_in('F_privity_group_id', $tmp);
						$this->db->update('t_user', array("F_status"=>$parame['F_status'],'F_modify_time'=>date("Y-m-d H:i:s",time())));
						if($this->db->affected_rows() > 0)
						{
							$result = true;
						}
					}
				}

			}
		}
		return $result;
	}

	public function user_delete($parame = array())
	{
		$result = false;
		if(isset($parame['F_ids']))
		{
			$idlist = explode(",",$parame['F_ids']);
			if(is_array($idlist) && count($idlist) > 0)
			{
				//验证是否有删除权限
				if($this->session->userdata('is_super_admin'))
				{
					$this->db->where_in('F_id', $idlist);
					$this->db->delete('t_user');
					if($this->db->affected_rows() > 0)
					{
						$result = true;
					}
				}
				else
				{
					$sql = "SELECT F_id FROM t_privity_group WHERE F_pid = ".$this->session->userdata('F_privity_group_id');
					$query = $this->db->query($sql);
					if($query->num_rows() > 0)
					{
						$tmp = $query->result_array();

						$this->db->where_in('F_id', $idlist);
						$this->db->where_in('F_privity_group_id', $tmp);
						$this->db->delete('t_user');
						if($this->db->affected_rows() > 0)
						{
							$result = true;
						}
					}
				}

			}
		}
		return $result;
	}

	public function user_add($parame = array())
	{
		$result = array("error"=>-1,"msg"=>"操作失败,请重试!");
		if(isset($parame['F_login_name'],$parame['F_login_password'],$parame['F_privity_group_id']))
		{
			$valid = 1;
			//检查$parame['F_login_name']的有效性
			if(strlen($parame['F_login_name']) > 0 && strlen($parame['F_login_name']) <= 30)
			{
				$sql = 'SELECT F_id FROM t_user WHERE F_login_name = "'.$parame['F_login_name'].'" LIMIT 1';
				$query = $this->db->query($sql);
				if($query->num_rows() > 0){
					$valid = 0;
					$result = array("error"=>-2,"msg"=>"用户名已使用,请修用户名");
				}
			}
			else{
				$valid = 0;
				$result = array("error"=>-1,"msg"=>"用户名无效");
			}
			//检查$parame['F_login_password']的有效性
			if($valid === 1)
			{
				if(strlen($parame['F_login_password']) >= 6 && strlen($parame['F_login_password']) <= 9)
				{
					$valid = 1;
				}
				else{
					$valid = 0;
					$result = array("error"=>-3,"msg"=>"用户密码无效");
				}
			}
			//检查$parame['F_privity_group_id']的有效性
			if($valid === 1){}

			//
			if($valid === 1)
			{
				$parame['F_nick_name'] = isset($parame['F_nick_name'])?$parame['F_nick_name']:$parame['F_login_name'];
				$parame['F_status'] = isset($parame['F_status'])?$parame['F_status']:1;
				$now = date("Y-m-d H:i:s",time());
				$parame['F_create_time'] =$now;
				$parame['F_modify_time'] =$now;

				$this->db->insert('t_user', $parame);
				if(!($this->db->insert_id() > 0))
				{
					$result = array("error"=>-4,"msg"=>"操作失败,请重试!");
				}
				else{
					$result = array("error"=>0,"msg"=>"成功");
				}
			}
		}
		return $result;
	}

}

/**
 * End of file m_privity.php
 */
/**
 * Location: ./app/models/m_privity.php
 */