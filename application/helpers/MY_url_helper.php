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
	top_redirect(base_url("c_index/no_privity"));
}

function get_teacher_manager_list_url($parames = array()) {
	$p = http_build_query($parames);
	return base_url("c_teacher/manager?".$p);
}

/**
 * 获取login_valid url.
 *
 */
/*
function get_login_valid_url() {
	return base_url('c_login/login_valid');
}


/**
 * End of file MY_url_helper.php
 */
/**
 * Location: ./system/helpers/MY_url_helper.php
 */