<div class="am-g">
	<div class="am-u-md-6 am-cf">
		<div class="am-fl am-cf">
			<div class="am-btn-toolbar am-fl">
				<div class="am-btn-group am-btn-group-xs">
					<button type="button" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</button>
					<button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 删除</button>
					<button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span>冻结</button>
					<button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span>激活</button>
					<button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span>设为测试帐号</button>
					<button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span>设为正常帐号</button>
				</div>

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
			</div>
		</div>
	</div>
	<div class="am-u-md-3 am-cf">
		<div class="am-fr">
			<div class="am-input-group am-input-group-sm">
				<input type="text" class="am-form-field">
                <span class="am-input-group-btn">
                  <button class="am-btn am-btn-default" type="button">搜索</button>
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
	<th class="table-check"><input type="checkbox" /></th><th>序号</th><th>账号</th><th>名字</th><th>ID</th><th>专长学科</th><th>年级</th><th>状态</th><th>金币</th><th>管理</th>
</tr>
</thead>
<tbody>
<?php foreach($teacher_list as $k=>$teacher){
	$str = '';
	$str .= '<tr>';
	$str .= '<td><input type="checkbox" /></td>';
	$str .= '<td>'.($k+1).'</td>';
	$str .= '<td>'.$teacher['F_teacher_name'].'</td>';
	$str .= '<td>'.$teacher['F_real_name'].'</td>';
	$str .= '<td>'.$teacher['F_teacher_id'].'</td>';
	$str .= '<td>'.$teacher['F_subject_text'].'</td>';
	$str .= '<td>'.$teacher['F_grade_text'].'</td>';
	$str .= '<td>'.$teacher['F_status_text'].'</td>';
	$str .= '<td>'.$teacher['F_coin'].'</td>';
	$str .= '<td>
		<div class="am-btn-toolbar">
			<div class="am-btn-group am-btn-group-xs">
				<button class="am-btn am-btn-default am-btn-xs am-text-secondary" F_teacher_id="'.$teacher['F_teacher_id'].'"
				 id="teacher_edit'.$k.'"><span class="am-icon-pencil-square-o"></span> 编辑</button>
				<button class="am-btn am-btn-default am-btn-xs" F_teacher_id="'.$teacher['F_teacher_id'].'" id="teacher_freezon'.$k.'"><span
				class="am-icon-copy"></span> 冻结</button>
				<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_teacher_id="'.$teacher['F_teacher_id'].'"
				 id="teacher_delete'.$k.'><span
				 class="am-icon-trash-o"></span>删除</button>
				<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_teacher_id="'.$teacher['F_teacher_id'].'"
				 id="teacher_active'.$k.'"><span
				 class="am-icon-trash-o"></span>活激</button>
				<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_teacher_id="'.$teacher['F_teacher_id'].'" id="teacher_test'.$k.'"><span
				 class="am-icon-trash-o"></span>设为测试帐号</button>
				<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_teacher_id="'.$teacher['F_teacher_id'].'"
				 id="teacher_normal'.$k.'"><span
				 class="am-icon-trash-o"></span>设为正常帐号</button>
			</div>
		</div>
	</td>';
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
	var change_teacher_status_uri = "<?php echo $change_teacher_status_uri;?>";
</script>