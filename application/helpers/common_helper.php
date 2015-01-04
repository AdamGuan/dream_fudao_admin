<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

function unescape($str) {
	$ret = '';
	$len = strlen($str);
	for ($i = 0; $i < $len; $i ++) {
		if ($str[$i] == '%' && $str[$i + 1] == 'u') {
			$val = hexdec(substr($str, $i + 2, 4));
			if ($val < 0x7f)
				$ret .= chr($val);
			else
			if ($val < 0x800)
				$ret .= chr(0xc0 | ($val >> 6)) .
				chr(0x80 | ($val &0x3f));
			else
				$ret .= chr(0xe0 | ($val >> 12)) .
				chr(0x80 | (($val >> 6) &0x3f)) .
				chr(0x80 | ($val &0x3f));
			$i += 5;
		} else
		if ($str[$i] == '%') {
			$ret .= urldecode(substr($str, $i, 3));
			$i += 2;
		} else
			$ret .= $str[$i];
	} 
	return $ret;
} 

/**
 * js escape php 实现
 * 
 * @param  $string the sting want to be escaped
 * @param  $in_encoding 
 * @param  $out_encoding 
 */
function escape($string, $in_encoding = 'UTF-8', $out_encoding = 'UCS-2') {
	$return = '';
	if (function_exists('mb_get_info')) {
		for($x = 0; $x < mb_strlen ($string, $in_encoding); $x ++) {
			$str = mb_substr ($string, $x, 1, $in_encoding);
			if (strlen ($str) > 1) { // 多字节字符
				$return .= '%u' . strtoupper (bin2hex (mb_convert_encoding ($str, $out_encoding, $in_encoding)));
			} else {
				$return .= '%' . strtoupper (bin2hex ($str));
			} 
		} 
	} 
	return $return;
} 

/**
 * 读取整个文件里面的内容，并返回.
 * 
 * @parame $file	string	包含路径的文件名.
 * @return string or false	如果文件不存在，返回false.
 */
function get_file_content($file) {
	if (file_exists($file)) {
		return file_get_contents($file);
	} else {
		return false;
	} 
}


/**
 * 分库，分表算法
 *
 * @parame $id	int
 * @return $list    array
 */
function get_hash_db($id)
{
	//分库，分表算法
	$md5_str = md5($id,true);
	$index0 = ord(substr($md5_str,1,1));
	$index = ord(substr($md5_str,0,1))%100;
	$list[] = chr(($index0%10)+ord('0'));     //库
	$list[] = chr(($index/10)+ord('0'));     //表
	$list[] = chr(($index%10)+ord('0'));     //表
	return $list;
}

/**
 * 创建密码(0-9a-z)
 *
 * @parame $length	int
 * @return $pwd string
 */
function generate_pwd($length)
{
	$pwd = '';
	if(isset($length))
	{
		for($i=0;$i<$length;$i++)
		{
			$tmp = rand(0,2);
			switch($tmp)
			{
				case 0:
					$tmp2 = rand(ord('0'),ord('9'));
					$pwd .= chr($tmp2);
					break;
				case 1:
					$tmp2 = rand(ord('A'),ord('Z'));
					$pwd .= chr($tmp2);
					break;
				case 2:
					$tmp2 = rand(ord('a'),ord('z'));
					$pwd .= chr($tmp2);
					break;
			}
		}
	}
	return $pwd;
}

/**
 * sign检查
 *
 * @parame $key	string
 * @parame $parames	array
 * @parame $open	int
 * @return $result  int
 */
function sign_check($key,$parames,$open = 0)
{
	
	$result = 0;
	if($open == 1)
	{
		$debug_data = array();
		if(isset($parames['sign']))
		{
			$sign = $parames['sign'];
			unset($parames['sign']);
			ksort($parames);
			$tmp = md5(http_build_query($parames)."&key=".$key);

			if($tmp == $sign)//sign正确
			{
				$result = 1;
			}
		}
	}
	else
	{
		$result = 1;
	}
	return $result;
	
}

/**
 * curl
 *
 * @parame $url	string
 * @parame $data	array
 * @parame $method	string
 * @return $document    mix
 */
function curlrequest($url, $data, $method = 'post') {
	$ch = curl_init(); //初始化CURL句柄
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);//连接超时
	curl_setopt($ch, CURLOPT_TIMEOUT, 10 );     //接收数据超时
	curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); //设置请求方式
	$array = array();
	$array[] = "X-HTTP-Method-Override: $method";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $array); //设置HTTP头信息
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //设置提交的字符串

	$document = curl_exec($ch); //执行预定义的CURL
	if (!curl_errno($ch)) {
//		$info = curl_getinfo($ch);
	} else {
	}
	curl_close($ch);

	return $document;
}

/**
 * curl并行
 * @param $url_list     array   请求的url list
 * @param $data_list    array   请求的data list
 * @param $method_list  array   method list
 * @return array
 */
function curlrequestMulti($url_list, $data_list, $method_list)
{
	$ch_list = array();

	// 创建批处理cURL句柄
	$mh = curl_multi_init();

	foreach($url_list as $key=>$url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);//连接超时
		curl_setopt($ch, CURLOPT_TIMEOUT, 10 );     //接收数据超时
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, $method, 1);

		switch ($method_list[$key]){
			case "GET" :
				curl_setopt($ch, CURLOPT_HTTPGET, true);
				break;
			case "POST":
				curl_setopt($ch, CURLOPT_POST,true);
				break;
			case "PUT" :
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
				break;
			case "DELETE":
				curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
				break;
		}
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_list[$key]);

		// 增加句柄
		curl_multi_add_handle($mh,$ch);

		$ch_list[] = $ch;
	}

	// 执行批处理句柄
	$running=null;
	do {
		curl_multi_exec($mh,$running);
	} while ($running > 0);

	//获取内容
	$res=array();
	foreach($ch_list as $ch)
	{
		$res[] = curl_multi_getcontent($ch);
		//移除句柄
		curl_multi_remove_handle($mh,$ch);
	}
	//close
	curl_multi_close($mh);

	//return
	return $res;
}

/**
 * api curl
 * @param $url
 * @param $data
 * @param $method
 * @param $key
 * @return mixed
 */
function api_curl($url, $data, $method,$key){
	$method = strtoupper($method);

	if(count($data) > 0)
	{
		ksort($data);
		if(isset($data['teacher_header']))
		{
			$data2 = $data;
			unset($data2['teacher_header']);
			$sign = md5(http_build_query($data2)."&key=".$key);

			$data['teacher_header'] = curl_file_create($data['teacher_header']);
		}
		else{
			$sign = md5(http_build_query($data)."&key=".$key);
		}
	}
	else
	{
		$sign = md5("key=" . $key);
	}
	if($method == 'GET')
	{
		$url = $url."?".http_build_query($data)."&sign=".$sign;
		$data = array();
	}
	else{
		$tmp_data = array();
		$tmp_data['c'] = $data['c'];
		$tmp_data['m'] = $data['m'];
		unset($data['c']);
		unset($data['m']);
		$url = $url."?".http_build_query($tmp_data)."&sign=".$sign;
	}
	return curlrequest($url,$data,$method);
}

/**
 * api curl 并行
 * @param $url
 * @param $data_list
 * @param $method_list
 * @param $key
 * @return array
 */
function api_curl_multi($url, $data_list, $method_list,$key){
	$url_list = array();
	foreach($data_list as $k=>$data)
	{
		$method = strtoupper($method_list[$k]);

		if(count($data) > 0)
		{
			ksort($data);
			if(isset($data['teacher_header']))
			{
				$data2 = $data;
				unset($data2['teacher_header']);
				$sign = md5(http_build_query($data2)."&key=".$key);
			}
			else{
				$sign = md5(http_build_query($data)."&key=".$key);
			}
		}
		else
		{
			$sign = md5("key=" . $key);
		}
		if($method == 'GET')
		{
			$tmpurl = $url."?".http_build_query($data)."&sign=".$sign;
			$data = array();
		}
		else{
			$tmp_data = array();
			$tmp_data['c'] = $data['c'];
			$tmp_data['m'] = $data['m'];
			unset($data['c']);
			unset($data['m']);
			$tmpurl = $url."?".http_build_query($tmp_data)."&sign=".$sign;
		}
		$url_list[$k] = $tmpurl;
		$data_list[$k] = $data;
	}

	return curlrequestMulti($url_list, $data_list, $method_list);
}

/**
 * 检查权限值是否在权限列表中
 * @param $privaty          array   权限值
 * @param $privaty_list     array   权限列表
 * @return bool
 */
function check_privity($privaty,$privaty_list = array()){
	$CI =& get_instance();
	if(count($privaty_list) <= 0)
	{
		$privaty_list = $CI->session->userdata('privaty');
	}
	$all = 0;
	if(is_array($privaty_list) && $privaty_list[0] == "all")
	{
		$all = 1;
	}
	if(isset($privaty) && ($all || (is_array($privaty_list) && in_array($privaty,$privaty_list)))){
		return true;
	}
	return false;
}

//build_privity_group里面用的排序比较函数
function cmp($a, $b)
{
    if ($a['F_pid'] == $b['F_pid']) {
        return 0;
    }
    return ($a['F_pid'] < $b['F_pid']) ? 1 : -1;
}

function build_privity_group($list){

	usort($list, "cmp");

	foreach($list as $key=>$item)
	{
		foreach($list as $k=>$it)
		{
			if($item['F_id'] == $it['F_pid'])
			{
				if(!isset($list[$key]['children']))
				{
					$list[$key]['children'] = array();
				}
				$list[$key]['children'][] = $it;
			}
		}
	}
	$result = array($list[count($list)-1]);

	$return = array();
	build_privity_group2($result,$return);
	return $return;
}

function build_privity_group2($list,&$return,$tab = 0){
	foreach($list as $item)
	{
		$item['tab'] = $tab;
		$children = isset($item['children'])?$item['children']:null;
		unset($item['children']);
		$return[] = $item;
		if(!is_null($children))
		build_privity_group2($children,$return,($tab+1));
	}
}

function build_privity_str($list,$privity = array('all'),$checked_privity = array(),$return='',$tab = 1,$id_pre='privity_check_',$id = 0){
	if(strlen($return) == 0)
	{
		$return .= '<div><input id="check_all" type="checkbox" value="">全部</div>';
	}
	foreach($list as $item)
	{
		if(!isset($item['children']) || count($item['children']) <= 0)
		{
			if(check_privity($item['link'],$privity))
			{
				$eid = $id_pre.$id;
				++$id;
				$checked = "";
				if(in_array($item['link'],$checked_privity))
				{
					$checked = " checked = \"checked\"";
				}
				$return .= '<div>'.str_repeat('&nbsp;',$tab*4).'<input '.$checked.' id="'.$eid.'" type="checkbox" value="'.$item['link'].'">'.$item['text'].'</div>';
			}
		}
		else{
			if(check_privity($item['link'],$privity))
			{
				$eid = $id_pre.$id;
				++$id;
				$checked = "";
				if(in_array($item['link'],$checked_privity))
				{
					$checked = " checked = \"checked\"";
				}
				$return .= '<div>'.str_repeat("&nbsp;",$tab*4).'<input '.$checked.' id="'.$eid.'" type="checkbox" value="'.$item['link'].'">'.$item['text'].'</div>';
				$return = build_privity_str($item['children'],$privity,$checked_privity,$return,($tab+1),$eid."_");
			}
		}
	}
	return $return;
}

/**
 *      把秒数转换为时分秒的格式
 *      @param Int $times 时间，单位 秒
 *      @return String
 */
function sec_to_time($times){
        $result = '00:00:00';
        if ($times>0) {
                $hour = floor($times/3600);
                $minute = floor(($times-3600 * $hour)/60);
                $second = floor((($times-3600 * $hour) - 60 * $minute) % 60);
                $result = $hour.'时'.$minute.'分'.$second.'秒';
        }
        return $result;
}

/**
 * End of file common_helper.php
 */
/**
 * Location: ./application/helpers/common_helper.php
 */
