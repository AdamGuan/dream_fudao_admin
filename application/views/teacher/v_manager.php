<div class="am-g">
	<div class="am-u-md-6 am-cf">
		<div class="am-fl am-cf">
			<div class="am-btn-toolbar am-fl">
				<div class="am-btn-group am-btn-group-xs">
					<?php if(check_privity("c_teacher/teacher_add")){?>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary" id="teacher_add" url="<?php echo $teacher_add_uri;?>"><span class="am-icon-plus"></span>新增</button>
					<?php }?>
					<?php if(check_privity("c_teacher/teacher_delete")){?>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger" id="teachers_delete"><span class="am-icon-remove"></span> 删除</button>
					<?php }?>
					<?php if(check_privity("c_teacher/teacher_freeze")){?>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger" id="teachers_freezon"><span class="am-icon-asterisk"></span>冻结</button>
					<?php }?>
					<?php if(check_privity("c_teacher/teacher_active")){?>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary" id="teachers_active"><span class="am-icon-check"></span>激活</button>
					<?php }?>
					<?php if(check_privity("c_teacher/teacher_set_test")){?>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary" id="teachers_test"><span class="am-icon-archive"></span>设为测试帐号</button>
					<?php }?>
				</div>

				<?php if(is_array($status_list) && count($status_list) > 0){?>
				<div class="am-form-group am-margin-left am-fl">
					<select id="teacher_status_choose">
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
	<th class="table-check"><input type="checkbox" id="teacher_select" /></th><th>序号</th><th>账号</th><th>名字</th><th>ID</th><th>专长学科</th><th>年级</th><th>状态</th><th>金币</th><th>管理</th>
</tr>
</thead>
<tbody>
<?php foreach($teacher_list as $k=>$teacher){
	$edit_url = get_teacher_edit_url(array("F_teacher_id"=>$teacher["F_teacher_id"]));
	$str = '';
	$str .= '<tr>';
	$str .= '<td><input type="checkbox" F_teacher_id="'.$teacher['F_teacher_id'].'" id="teacher_check'.$teacher['F_teacher_id'].'" /></td>';
	$str .= '<td>'.($k+1).'</td>';
	$str .= '<td>'.$teacher['F_teacher_name'].'</td>';
	$str .= '<td>'.$teacher['F_real_name'].'</td>';
	$str .= '<td>'.$teacher['F_teacher_id'].'</td>';
	$str .= '<td>'.$teacher['F_subject_text'].'</td>';
	$str .= '<td>'.$teacher['F_grade_text'].'</td>';
	$str .= '<td>'.$teacher['F_status_text'].'</td>';
	$str .= '<td>'.$teacher['F_coin'].'</td>';
	$tmp  = "";
	if(check_privity("c_teacher/teacher_edit")){
		$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-secondary" F_teacher_id="'.$teacher['F_teacher_id'].'"  id="teacher_edit'.$k.'" url="'.$edit_url.'"><span class="am-icon-pencil-square-o"></span> 编辑</button>';
	}
	if(check_privity("c_teacher/teacher_delete")){
		$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_teacher_id="'.$teacher['F_teacher_id'].'" id="teacher_delete'.$k.'"><span class="am-icon-remove"></span>删除</button>';
	}
	if(check_privity("c_teacher/teacher_freeze")){
		$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_teacher_id="'.$teacher['F_teacher_id'].'" id="teacher_freezon'.$k.'"><span class="am-icon-asterisk"></span> 冻结</button>';
	}
	if(check_privity("c_teacher/teacher_active")){
		$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-secondary" F_teacher_id="'.$teacher['F_teacher_id'].'" id="teacher_active'.$k.'"><span class="am-icon-check"></span>活激</button>';
	}
	if(check_privity("c_teacher/teacher_set_test")){
		$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-secondary" F_teacher_id="'.$teacher['F_teacher_id'].'" id="teacher_test'.$k.'"><span  class="am-icon-archive"></span>设为测试帐号</button>';
	}
	$str .= '<td>
		<div class="am-btn-toolbar">
			<div class="am-btn-group am-btn-group-xs">'.$tmp.'</div>
		</div>
	</td></tr>';
	echo $str;
}?>
</tbody>
</table>
<div class="am-cf">
	共 <?php echo $teacher_total;?> 条记录
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

<script>
	var teacher_freeze_uri = "<?php echo $teacher_freeze_uri;?>";
	var teacher_delete_uri = "<?php echo $teacher_delete_uri;?>";
	var teacher_active_uri = "<?php echo $teacher_active_uri;?>";
	var teacher_set_test_uri = "<?php echo $teacher_set_test_uri;?>";
</script>