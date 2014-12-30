<div class="am-g">
	<div class="am-u-md-6 am-cf">
		<div class="am-fl am-cf">
			<div class="am-btn-toolbar am-fl">
				<div class="am-btn-group am-btn-group-xs">
					<button type="button" class="am-btn am-btn-default" id="group_add"><span class="am-icon-plus"></span>新增</button>
					<button type="button" class="am-btn am-btn-default" id="groups_delete"><span class="am-icon-save"></span> 删除</button>
					<button type="button" class="am-btn am-btn-default" id="groups_freezon"><span class="am-icon-archive"></span>冻结</button>
					<button type="button" class="am-btn am-btn-default" id="groups_active"><span class="am-icon-archive"></span>激活</button>
				</div>
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
	<th>序号</th><th>组名</th><th>状态</th><th>管理</th>
</tr>
</thead>
<tbody>
<?php if(isset($group_list)) foreach($group_list as $k=>$group){
	if(isset($group['F_status']) == 1)
	{
		$status = "激活";
	}
	else{
		$status = "冻结";
	}
	$str = '';
	$str .= '<tr>';
	$str .= '<td>'.($k+1).'</td>';
	$str .= '<td>'.$group['F_name'].'</td>';
	$str .= '<td>'.$status.'</td>';
	$tmp  = "";
	$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-secondary" F_id="'.$group['F_id'].'"  id="group_edit'.$k.'"><span class="am-icon-pencil-square-o"></span> 编辑</button>';
	$tmp .= '<button class="am-btn am-btn-default am-btn-xs" F_id="'.$group['F_id'].'" id="group_freezon'.$k.'"><span class="am-icon-copy"></span> 冻结</button>';
	$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_id="'.$group['F_id'].'" id="group_delete'.$k.'><span class="am-icon-trash-o"></span>删除</button>';
	$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_id="'.$group['F_id'].'" id="group_active'.$k.'"><span class="am-icon-trash-o"></span>活激</button>';
	$str .= '<td>
		<div class="am-btn-toolbar">
			<div class="am-btn-group am-btn-group-xs">'.$tmp.'</div>
		</div>
	</td>';
	echo $str;
}?>
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
</script>