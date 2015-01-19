<div class="am-g">

	<div class="am-u-md-3 am-cf">
		<div class="am-fr">
			<div class="am-input-group am-input-group-sm">
				<input type="text" class="am-form-field" placeholder="输入老师账号或学生搜索" id="search_text" value="<?php echo $search_text;?>">
                <span class="am-input-group-btn">
                  <button class="am-btn am-btn-default" type="button" id="search_btn_search"><i class="am-icon-search"></i>搜索</button>
                </span>
			</div>
		</div>
	</div>

</div>


<div class="am-g">
<div class="am-u-sm-12">
<form class="am-form">
<table class="am-table am-table-striped am-table-hover table-main">
<thead>
<tr>
	<th>序号</th><th>教师姓名</th><th>学生姓名</th><th>订单ID号</th><th>关系类型</th><th>异常号码</th><th>异常描述</th><th>异常时间</th>
</tr>
</thead>
<tbody>
<?php foreach($playback_list as $k=>$playback){
	$relation = ((int)$playback['F_relation_type'] == 0)?"老师":"学生";
	$str = '';
	$str .= '<tr>';
	$str .= '<td>'.($k+1).'</td>';
	$str .= '<td>'.$playback['F_teacher_real_name'].'</td>';
	$str .= '<td>'.$playback['F_user_real_name'].'</td>';
	$str .= '<td>'.$playback['F_order_id'].'</td>';
	$str .= '<td>'.$relation.'</td>';
	$str .= '<td>'.$playback['F_exception_num'].'</td>';
	$str .= '<td>'.$playback['F_exception_desc'].'</td>';
	$str .= '<td>'.$playback['F_exception_time'].'</td></tr>';
	echo $str;
}?>
</tbody>
</table>
<div class="am-cf">
	共 <?php echo $playback_total;?> 条记录
	<div class="am-fr">
		<ul class="am-pagination">
			<?php $page_pre_class = "am-disabled";if($page_pre_active){$page_pre_class = "";} ?>
			<?php $page_next_class = "am-disabled";if($page_next_active){$page_next_class = "";} ?>
			<li class="<?php echo $page_pre_class;?>"><a href="<?php echo $page_pre_url;?>">«</a></li>
			<?php foreach($page_list as $page){
				$class = "";
				if($page['active'])
				{
					$class = "am-active";
				}
				echo '<li class="'.$class.'"><a href="'.$page['url'].'">'.$page['page'].'</a></li>';
			}?>
			<li class="<?php echo $page_next_class;?>"><a href="<?php echo $page_next_url;?>">»</a></li>
		</ul>
	</div>
</div>
</form>
</div>

</div>