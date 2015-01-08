<div class="am-g">
	<div class="am-u-md-6 am-cf">
		<div class="am-fl am-cf">
			<div class="am-btn-toolbar am-fl">
				<div class="am-btn-group am-btn-group-xs">
					<?php if(check_privity("c_publish/publish_add")){?>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary" id="publish_add" url="<?php echo $publish_add_uri;?>"><span class="am-icon-plus"></span>新增</button>
					<?php }?>
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
	<th>序号</th><th>标题</th><th>管理</th>
</tr>
</thead>
<tbody>
<?php foreach($list as $k=>$item){
	$edit_url = get_publish_edit_url(array("F_id"=>$item["F_id"]));
	$str = '';
	$str .= '<tr>';
	$str .= '<td>'.($k+1).'</td>';
	$str .= '<td>'.$item['F_title'].'</td>';
	$tmp  = "";
	if(check_privity("c_publish/publish_edit")){
		$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-secondary" F_id="'.$item['F_id'].'"  id="publish_edit'.$k.'" url="'.$edit_url.'"><span class="am-icon-pencil-square-o"></span> 编辑</button>';
	}
	if(check_privity("c_publish/publish_delete")){
		$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_id="'.$item['F_id'].'" id="publish_delete'.$k.'"><span class="am-icon-remove"></span>删除</button>';
	}
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
	共 <?php echo count($list);?> 条记录
</div>
</form>
</div>

</div>

<script>
	var delete_url = "<?php echo my_site_url('c_publish/delete');?>";
</script>