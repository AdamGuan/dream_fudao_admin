<?php
class M_publish extends MY_Model {

	public function __construct() {
		parent :: __construct();
		$this -> load -> database();
	}

	/**
	 * 获取最新一条公告内容
	 * @return string
	 */
	public function get_last_publish_content(){
		$return = '';
		$sql = 'SELECT F_content FROM t_publish WHERE F_status = 1 ORDER BY F_create_time DESC LIMIT 1';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$row = $query->row_array();
			$return = $row['F_content'];
		}
		return $return;
	}

	public function get_publish_list(){
		$return = array();
		$sql = 'SELECT * FROM t_publish WHERE 1 ORDER BY F_create_time DESC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$return = $query->result_array();
		}
		return $return;
	}

	public function add_a_publish($parames = array()){
		$return = false;
		$parames['F_create_time'] = $parames['F_modify_time'] = date('Y-m-d H:i:s',time());
		$this->db->insert('t_publish', $parames);
		if($this->db->insert_id() > 0)
		{
			$return = true;
		}
		return $return;
	}

	public function update_a_publish($parames = array()){
		unset($parames['c']);
		unset($parames['m']);
		$return = false;
		if(isset($parames['F_id']))
		{
			$this->db->where('F_id', $parames['F_id']);
			unset($parames['F_id']);
			$parames['F_modify_time'] = date('Y-m-d H:i:s',time());
			$this->db->update('t_publish', $parames);

			if($this->db->affected_rows() > 0)
			{
				$return = true;
			}
		}
		return $return;
	}

	public function delete_publish($parames = array()){
		$return = false;
		if(isset($parames['F_ids']))
		{
			$this->db->where_in('F_id', explode(",",$parames['F_ids']));
			$this->db->delete('t_publish');
			if($this->db->affected_rows() > 0)
			{
				$return = true;
			}
		}
		return $return;
	}

	public function get_a_publish_info($parames = array()){
		$return = array();
		if(isset($parames['F_id']))
		{
			$sql = 'SELECT * FROM t_publish WHERE F_id = '.(int)$parames['F_id'].' LIMIT 1';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				$return = $query->row_array();
			}
		}
		return $return;
	}

}

/**
 * End of file m_publish.php
 */
/**
 * Location: ./app/models/m_publish.php
 */