<div class="am-g">
	<div class="am-u-md-6 am-cf">
		<div class="am-fl am-cf">
			<div class="am-btn-toolbar am-fl">
				<div class="am-btn-group am-btn-group-xs">
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary" id="group_add"><span class="am-icon-plus"></span>新增</button>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger" id="groups_freeze"><span class="am-icon-asterisk"></span>冻结</button>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger" id="groups_delete"><span class="am-icon-remove"></span>删除</button>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary" id="groups_active"><span class="am-icon-check"></span>激活</button>
				</div>

				<?php if(is_array($status_list) && count($status_list) > 0){?>
				<div class="am-form-group am-margin-left am-fl">
					<select id="group_status_choose">
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
	<th class="table-check"><input type="checkbox" id="group_check_all" /></th><th>序号</th><th>组名</th><th>状态</th><th>管理</th>
</tr>
</thead>
<tbody>
<?php if(isset($group_list)){foreach($group_list as $k=>$group){
	if($group['F_id'] == $self_privity_id){continue;}
	if(isset($group['F_status']) && $group['F_status'] == 1)
	{
		$status = "激活";
	} else{
		$status = "冻结";
	}
	$str = '';
	$str .= '<tr>';
	$str .= '<td><input type="checkbox" F_id="'.$group['F_id'].'" id="group_check'.$group['F_id'].'" /></td>';
	$str .= '<td>'.($k).'</td>';
	$str .= '<td>'.$group['F_name'].'</td>';
	$str .= '<td>'.$status.'</td>';
	$tmp  = "";
	$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-secondary" url="'.get_controll_url("c_privity/group_edit",array('F_id'=>$group['F_id'])).'" F_id="'.$group['F_id'].'"  id="group_edit'.$k.'"><span class="am-icon-pencil-square-o"></span> 编辑</button>';
	$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_id="'.$group['F_id'].'" id="group_freezon'.$k.'"><span class="am-icon-asterisk"></span> 冻结</button>';
	$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_id="'.$group['F_id'].'" id="group_delete'.$k.'><span class="am-icon-remove"></span>删除</button>';
	$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-secondary" F_id="'.$group['F_id'].'" id="group_active'.$k.'"><span class="am-icon-check"></span>活激</button>';
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
	共 <?php echo count($group_list);?> 条记录
</div>

</form>
</div>

</div>

<script>
	var group_add_url = "<?php echo $group_add_url;?>";
	var group_active_url = "<?php echo my_site_url('c_privity/group_active');?>";
	var group_delete_url = "<?php echo my_site_url('c_privity/group_delete');?>";
	var group_freeze_url = "<?php echo my_site_url('c_privity/group_freeze');?>";
</script>