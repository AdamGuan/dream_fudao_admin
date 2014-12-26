<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 14-10-28
 * Time: 下午12:31
 */

function curlrequest($url, $data, $method = 'post',$header = array()) {
//	echo $url."\n";
//	echo $method."\n";
//	print_r($data);
	$ch = curl_init(); //初始化CURL句柄
	//$array[] = "Name:test";
	//$array[] = "Sign:testsign";
	curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
	curl_setopt($ch,CURLOPT_HEADER,0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); //设置请求方式 $array = array(); //$array[] = "X-HTTP-Method-Override: $method";
//	curl_setopt($ch, CURLOPT_HTTPHEADER, $header); //设置HTTP头信息
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); //设置提交的字符串
//	curl_setopt($ch, CURLOPT_PROXY, "http://127.0.0.1:8082");

	$document = curl_exec($ch); //执行预定义的CURL
	var_dump($document);
	if (!curl_errno($ch)) {
		$info = curl_getinfo($ch);
	} else {
	}
	curl_close($ch);

	return $document;
}

$url = "http://115.29.100.13/api/index.php";
$key = "731222260492(readboy)25489884364";
$header = array();
$data_get = array(
	'version'=>'server_v1',
	'c'=>'teacher',
	'm'=>'change_teacher_status',
);
$data_post = array(
	'F_teacher_ids'=>"7810000000403",
	'F_status'=>"2",
	'F_who'=>"1",
);
$data = array_merge($data_get,$data_post);
ksort($data);
$sign = md5(http_build_query($data)."&key=".$key);

//$url = $url."?".http_build_query($data)."&sign=".$sign;
$url = $url."?".http_build_query($data_get)."&sign=".$sign;
//$method = "GET";
$method = "POST";
//$data  = array();
$return = curlrequest($url,$data_post,$method,$header);
//var_dump($return);
//echo $return;
print_r(json_decode($return));
//var_dump(json_decode($return));
