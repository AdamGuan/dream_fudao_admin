<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 利用js在top window中跳转.
 * 
 * @parame $uri	string
 */
function top_redirect($uri = '') {
	echo("<script> top.location.href='" . $uri . "'</script>");
	exit;
}

function my_site_url($sge,$parames = array()){
	$a = 0;
	if($a == 0)
	{
		$tmp = explode("/",$sge);
		$url = "c=".$tmp[0]."&m=".$tmp[1];
		if(count($parames) > 0)
		{
			$url .= '&'.http_build_query($parames);
		}
		$url = site_url()."?".$url;
		return $url;
	}
	else{
		$p = "";
		if(is_array($parames) && count($parames) > 0)
		{
			$p = "?".http_build_query($parames);
		}
		return base_url($sge.$p);
	}
}

/**
 * 获取public下面的资源url.
 * 
 * @parame $file	string	public下面的完全路径
 * @return string 资源的url
 */
function get_public_url($file) {
	return base_url('public/' . $file);
} 

/**
 * 获取public/assets/js下面的资源url.
 * 
 * @parame $file	string	public/js下面的完全路径
 * @return string js资源的url
 */
function get_assets_js_url($file) {
	return base_url('public/assets/js/' . $file);
}

/**
 * 获取public/assets/css下面的资源url.
 * 
 * @parame $file	string	public/css下面的完全路径
 * @return string css资源的url
 */
function get_assets_css_url($file) {
	return base_url('public/assets/css/' . $file);
} 

/**
 * 获取public/assets/i下面的资源url.
 * 
 * @parame $file	string	public/image下面的完全路径
 * @return string image资源的url
 */
function get_assets_image_url($file) {
	return base_url('public/assets/i/' . $file);
}

/**
 * 跳转到没有权限页面
 */
function redirect_to_no_privity_page(){
	top_redirect(my_site_url("c_index/no_privity"));
}

function get_teacher_manager_list_url($parames = array()) {
	return my_site_url("c_teacher/manager",$parames);
}

function get_test_teacher_manager_list_url($parames = array()) {
	return my_site_url("c_teacher/test_manager",$parames);
}

function get_teacher_edit_url($parames){
	return my_site_url("c_teacher/teacher_edit",$parames);
}

function get_controll_url($uri,$parames){
	return my_site_url($uri,$parames);
}

function get_student_manager_list_url($parames = array()) {
	return my_site_url("c_student/manager",$parames);
}

function get_index_url(){
	return base_url();
}

function get_playback_manager_list_url($parames = array()) {
	return my_site_url("c_playback/manager",$parames);
}

function get_custom_manager_list_url($parames = array()) {
	return my_site_url("c_custom/manager",$parames);
}

function get_custom_edit_url($parames){
	return my_site_url("c_custom/custom_edit",$parames);
}

function get_publish_edit_url($parames){
	return my_site_url("c_publish/edit",$parames);
}

function get_exception_manager_list_url($parames = array()) {
	return my_site_url("c_exception/manager",$parames);
}

function get_statistic_teacher_list_url($parames = array()) {
	return my_site_url("c_statistic_teacher/index",$parames);
}

function get_statistic_student_teaching_info_timesection_url($parames = array()) {
	return my_site_url("c_statistic_student/teaching_info_timesection",$parames);
}

function get_statistic_student_all_teaching_info_timesection_url($parames = array()) {
	return my_site_url("c_statistic_student/all_teaching_info_timesection",$parames);
}

function get_statistic_student_list_url($parames = array()) {
	return my_site_url("c_statistic_student/index",$parames);
}

function get_a_student_teaching_info_url($parames = array()) {
	return my_site_url("c_student/get_a_student_teaching_info",$parames);
}

function get_statistics_teaching_url($parames = array()) {
	return my_site_url("c_statistic_teaching/index",$parames);
}


/**
 * 获取login_valid url.
 *
 */

function get_login_valid_url() {
	return my_site_url('c_login/login_valid');
}

function get_login_url() {
	return my_site_url('c_login/index');
}

function get_login_out_url() {
	return my_site_url('c_login/login_out');
}



/**
 * End of file MY_url_helper.php
 */
/**
 * Location: ./system/helpers/MY_url_helper.php
 */