<div class="am-g">
	<div class="am-u-md-6 am-cf">
		<div class="am-fl am-cf">
			<div class="am-btn-toolbar am-fl">
				<div class="am-btn-group am-btn-group-xs">
					<?php if(check_privity("c_student/student_delete")){?>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger" id="students_delete"><span class="am-icon-remove"></span> 删除</button>
					<?php }?>
					<?php if(check_privity("c_student/student_freeze")){?>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger" id="students_freezon"><span class="am-icon-asterisk"></span>冻结</button>
					<?php }?>
					<?php if(check_privity("c_student/student_active")){?>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary" id="students_active"><span class="am-icon-check"></span>激活</button>
					<?php }?>
					<?php if(check_privity("c_student/student_set_test")){?>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary" id="students_test"><span class="am-icon-archive"></span>设为测试帐号</button>
					<?php }?>
				</div>

				<?php if(is_array($status_list) && count($status_list) > 0){?>
				<div class="am-form-group am-margin-left am-fl">
					<select id="student_status_choose">
						<?php foreach($status_list as $item){
							$selected = '';
							if(isset($item['active']) && $item['active'])
							{
								$selected = 'selected="selected"';
							}
							echo '<option value="'.$item['key'].'" '.$selected.'>'.$item['value'].'</option>';
						}?>
					</select>
				</div>
				<?php }?>

				<?php if(is_array($grade_list) && count($grade_list) > 0){?>
				<div class="am-form-group am-margin-left am-fl">
					<select id="student_grade_choose">
						<?php foreach($grade_list as $item){
							$selected = '';
							if(isset($item['active']) && $item['active'])
							{
								$selected = 'selected="selected"';
							}
							echo '<option value="'.$item['key'].'" '.$selected.'>'.$item['value'].'</option>';
						}?>
					</select>
				</div>
				<?php }?>

				<?php if(is_array($login_list) && count($login_list) > 0){?>
				<div class="am-form-group am-margin-left am-fl">
					<select id="student_login_choose">
						<?php foreach($login_list as $item){
							$selected = '';
							if(isset($item['active']) && $item['active'])
							{
								$selected = 'selected="selected"';
							}
							echo '<option value="'.$item['key'].'" '.$selected.'>'.$item['value'].'</option>';
						}?>
					</select>
				</div>
				<?php }?>

			</div>
		</div>
	</div>

	<div class="am-u-md-3 am-cf">
		<div class="am-fr">
			<div class="am-input-group am-input-group-sm">
				<input type="text" class="am-form-field" id="search_text" placeholder="输入账号或名字搜索" value="<?php echo isset($search_text)?$search_text:'';?>">
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
	<th class="table-check"><input type="checkbox" id="student_select" /></th><th>序号</th><th>账号</th><th>名字</th><th>ID</th><th>年级</th><th>金币</th>
</tr>
</thead>
<tbody>
<?php foreach($student_list as $k=>$student){
	$str = '';
	$str .= '<tr>';
	$str .= '<td><input type="checkbox" F_user_id="'.$student['F_user_id'].'" id="student_check'.$student['F_user_id'].'" /></td>';
	$str .= '<td>'.($k+1).'</td>';
	$str .= '<td><a href="'.$student['F_url'].'">'.$student['F_user_name'].'</a></td>';
	$str .= '<td><a href="'.$student['F_url'].'">'.$student['F_real_name'].'</a></td>';
	$str .= '<td>'.$student['F_user_id'].'</td>';
	$str .= '<td>'.$student['F_grade_text'].'</td>';
	$str .= '<td>'.$student['F_coin'].'</td></tr>';
	/*
	$tmp  = "";
	if(check_privity("c_student/student_delete")){
		$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_user_id="'.$student['F_user_id'].'" id="student_delete'.$k.'"><span class="am-icon-remove"></span>删除</button>';
	}
	if(check_privity("c_student/student_freeze")){
		$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_user_id="'.$student['F_user_id'].'" id="student_freezon'.$k.'"><span class="am-icon-asterisk"></span> 冻结</button>';
	}
	if(check_privity("c_student/student_active")){
		$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-secondary" F_user_id="'.$student['F_user_id'].'" id="student_active'.$k.'"><span class="am-icon-check"></span>活激</button>';
	}
	if(check_privity("c_student/student_set_test")){
		$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-secondary" F_user_id="'.$student['F_user_id'].'" id="student_test'.$k.'"><span  class="am-icon-archive"></span>设为测试帐号</button>';
	}
	$str .= '<td>
		<div class="am-btn-toolbar">
			<div class="am-btn-group am-btn-group-xs">'.$tmp.'</div>
		</div>
	</td></tr>';
	*/
	echo $str;
	
}?>
</tbody>
</table>
<div class="am-cf">
	共 <?php echo $student_total;?> 条记录
	<div class="am-fr">
		<ul class="am-pagination">
			<li><a href="<?php echo $page_first_url;?>">First</a></li>
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
			<li><a href="<?php echo $page_last_url;?>">Last</a></li>
		</ul>
	</div>
</div>
</form>
</div>

</div>


<script>
	var student_freeze_uri = "<?php echo $student_freeze_uri;?>";
	var student_delete_uri = "<?php echo $student_delete_uri;?>";
	var student_active_uri = "<?php echo $student_active_uri;?>";
	var student_set_test_uri = "<?php echo $student_set_test_uri;?>";
</script>