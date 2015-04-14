<?php
class M_statistic_student extends MY_Model {

	public function __construct() {
		parent :: __construct();
//		$this -> load -> database();
	}

	/**
	 *
	 * @param array $parames
	 *                  date        string,optional
	 *                  datetype    int 0,1,2
	 * @return array
	 */
	public function get_data($parames = array()){
		$return = array();
		if(isset($parames['datetype'],$parames['date']))
		{
			unset($parames['c']);
			unset($parames['m']);
			$return['datetype'] = (int)$parames['datetype'];
			$data = array('version'=>$this->my_config['api_version'],'c'=>'statistics_student');
			switch((int)$parames['datetype']){
				case 1: //按月
					$return['date'] = $parames['date'];
					$data['m'] = 'get_student_statistics_info_month';
					$data['date'] = $parames['date'];
					//curl
					$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
					$result = json_decode($result,true);
					if(is_array($result) && isset($result['responseNo'],$result['list']) && $result['responseNo'] == 0)
					{
						$return['list'] = $result['list'];
					}
					break;
				case 2: //按年
					$return['date'] = $parames['date'];
					$data['m'] = 'get_student_statistics_info_year';
					$data['date'] = $parames['date'];
					//curl
					$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
					$result = json_decode($result,true);
					if(is_array($result) && isset($result['responseNo'],$result['list']) && $result['responseNo'] == 0)
					{
						$return['list'] = $result['list'];
					}
					break;
				default:
					break;
			}
		}


		return $return;
	}

	public function teaching_info_timesection($parames = array()){
		$return = array('F_total'=>0,'list'=>array());

		if(isset($parames['datetype'],$parames['date'],$parames['teacher_id']) && strlen($parames['teacher_id']) > 0)
		{
			$return['datetype'] = (int)$parames['datetype'];
			$data = array('version'=>$this->my_config['api_version'],'c'=>'statistics_student','offset'=>0,'limit'=>10000);
			$data['m'] = 'get_student_teaching_info_timesection';
			$data['teacher_id'] = $parames['teacher_id'];
			if(isset($parames['page']))
			{
				$data['offset'] = ((int)$parames['page']-1)*$this->my_config['page'];
				$data['limit'] = $this->my_config['page'];
			}
			switch((int)$parames['datetype']){
				case 0: //按天
					$tmp = date('Y-m-d',strtotime($parames['date']));
					$data['start_datetime'] = date('Y-m-d H:i:s',strtotime($tmp));
					$data['end_datetime'] = date('Y-m-d H:i:s',(strtotime($tmp)+3600*24-1));
					break;
				case 1: //按月
					$tmp = date('Y-m',strtotime($parames['date']))."-01";
					$data['start_datetime'] = date('Y-m-d H:i:s',strtotime($tmp));
					$data['end_datetime'] = date('Y-m-d H:i:s',(strtotime($tmp)+3600*24*30-1));
					break;
				case 2: //按年
					$tmp = date('Y',strtotime($parames['date']))."-01-01";
					$data['start_datetime'] = date('Y-m-d H:i:s',strtotime($tmp));
					$data['end_datetime'] = date('Y-m-d H:i:s',(strtotime($tmp)+3600*24*365-1));
					break;
				default:
					break;
			}
			//curl
			if(isset($data['start_datetime'],$data['end_datetime']))
			{
				$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
				$result = json_decode($result,true);
				if(is_array($result) && isset($result['responseNo'],$result['list'],$result['F_total']) && $result['responseNo'] == 0)
				{
					$return['list'] = $result['list'];
					$return['total'] = $result['F_total'];
				}
			}
		}
		return $return;
	}

	public function all_teaching_info_timesection($parames = array()){
		$return = array('total'=>0,'list'=>array());

		if(isset($parames['datetype'],$parames['date']))
		{
			$return['datetype'] = (int)$parames['datetype'];
			$data = array('version'=>$this->my_config['api_version'],'c'=>'statistics_student','offset'=>0,'limit'=>10000);
			$data['m'] = 'get_student_all_teaching_info_timesection';
			if(isset($parames['page']))
			{
				$data['offset'] = ((int)$parames['page']-1)*$this->my_config['page'];
				$data['limit'] = $this->my_config['page'];
			}
			switch((int)$parames['datetype']){
				case 0: //按天
					$tmp = date('Y-m-d',strtotime($parames['date']));
					$data['start_datetime'] = date('Y-m-d H:i:s',strtotime($tmp));
					$data['end_datetime'] = date('Y-m-d H:i:s',(strtotime($tmp)+3600*24-1));
					break;
				case 1: //按月
					$tmp = date('Y-m',strtotime($parames['date']))."-01";
					$data['start_datetime'] = date('Y-m-d H:i:s',strtotime($tmp));
					$data['end_datetime'] = date('Y-m-d H:i:s',(strtotime($tmp)+3600*24*30-1));
					break;
				case 2: //按年
					$tmp = date('Y',strtotime($parames['date']))."-01-01";
					$data['start_datetime'] = date('Y-m-d H:i:s',strtotime($tmp));
					$data['end_datetime'] = date('Y-m-d H:i:s',(strtotime($tmp)+3600*24*365-1));
					break;
				default:
					break;
			}
			//curl
			if(isset($data['start_datetime'],$data['end_datetime']))
			{
				$result = api_curl($this->my_config['api_uri'], $data, "GET",$this->my_config['api_key']);
				$result = json_decode($result,true);
				if(is_array($result) && isset($result['responseNo'],$result['list'],$result['total']) && $result['responseNo'] == 0)
				{
					$return['list'] = $result['list'];
					$return['total'] = $result['total'];
				}
			}
		}
		return $return;
	}

}

/**
 * End of file m_statistic_student.php
 */
/**
 * Location: ./app/models/m_statistic_student.php
 */