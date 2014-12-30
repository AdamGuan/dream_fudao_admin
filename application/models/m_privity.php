<?php
class M_privity extends MY_Model {

	public function __construct() {
		parent :: __construct();
		$this -> load -> database();
	}

	/**
	 * 获取权限组列表
	 * @param array $parames
	 * @return array    二维数组
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

	public function get_privity_htmlstr($parames = array()){
		$global_left_bar = $this->my_config['data']['global_left_bar'];
		$privity = isset($parames['privity'])?$parames['privity']:array();
		return build_privity_str($global_left_bar,$privity);
	}

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


}

/**
 * End of file m_privity.php
 */
/**
 * Location: ./app/models/m_privity.php
 */