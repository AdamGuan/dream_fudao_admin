<div class="am-g">
	<div class="am-u-md-6 am-cf">
		<div class="am-fl am-cf">
			<div class="am-btn-toolbar am-fl">
				<div class="am-btn-group am-btn-group-xs">
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary" id="user_add"><span class="am-icon-plus"></span>新增</button>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger" id="users_freeze"><span class="am-icon-asterisk"></span>冻结</button>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger" id="users_delete"><span class="am-icon-remove"></span>删除</button>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary" id="users_active"><span class="am-icon-check"></span>激活</button>
				</div>

				<?php if(is_array($status_list) && count($status_list) > 0){?>
				<div class="am-form-group am-margin-left am-fl">
					<select id="user_status_choose">
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

				<?php if(is_array($group_list) && count($group_list) > 0){?>
				<div class="am-form-group am-margin-left am-fl">
					<select id="user_group_choose">
						<?php foreach($group_list as $item){
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
	<th class="table-check"><input type="checkbox" id="user_check_all" /></th><th>序号</th><th>用户</th><th>状态</th><th>所属组</th><th>管理</th>
</tr>
</thead>
<tbody>
<?php if(isset($user_list)){foreach($user_list as $k=>$user){
	if(isset($user['F_status']) && $user['F_status'] == 1)
	{
		$status = "激活";
	} else{
		$status = "冻结";
	}
	$str = '';
	$str .= '<tr>';
	$str .= '<td><input type="checkbox" F_id="'.$user['F_id'].'" id="user_check'.$user['F_id'].'" /></td>';
	$str .= '<td>'.($k+1).'</td>';
	$str .= '<td>'.$user['F_login_name'].'</td>';
	$str .= '<td>'.$status.'</td>';
	$str .= '<td>'.$user['F_name'].'</td>';
	$tmp  = "";
	$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-secondary" url="'.get_controll_url("c_privity/user_edit",array('F_id'=>$user['F_id'])).'" F_id="'.$user['F_id'].'"  id="user_edit'.$k.'"><span class="am-icon-pencil-square-o"></span> 编辑</button>';
	$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_id="'.$user['F_id'].'" id="user_freezon'.$k.'"><span class="am-icon-asterisk"></span> 冻结</button>';
	$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_id="'.$user['F_id'].'" id="user_delete'.$k.'><span class="am-icon-remove"></span>删除</button>';
	$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-secondary" F_id="'.$user['F_id'].'" id="user_active'.$k.'"><span class="am-icon-check"></span>活激</button>';
	$str .= '<td>
		<div class="am-btn-toolbar">
			<div class="am-btn-group am-btn-group-xs">'.$tmp.'</div>
		</div>
	</td>';
	echo $str;
}}?>
</tbody>
</table>

<div class="am-cf">
	共 <?php echo count($user_list);?> 条记录
</div>

</form>
</div>

</div>

<script>
	var user_add_url = "<?php echo $user_add_url;?>";
	var user_active_url = "<?php echo my_site_url('c_privity/user_active');?>";
	var user_delete_url = "<?php echo my_site_url('c_privity/user_delete');?>";
	var user_freeze_url = "<?php echo my_site_url('c_privity/user_freeze');?>";
</script>