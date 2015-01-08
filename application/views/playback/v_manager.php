<div class="am-g">
	<div class="am-u-md-6 am-cf">
		<div class="am-fl am-cf">
			<div class="am-btn-toolbar am-fl">
				<div class="am-btn-group am-btn-group-xs">
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger" id="playbacks_active"><span class="am-icon-check"></span>设为精彩</button>
					<button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary" id="playbacks_deactive"><span class="am-icon-close"></span>设为非精彩</button>
				</div>

				<?php if(is_array($status_list) && count($status_list) > 0){?>
				<div class="am-form-group am-margin-left am-fl">
					<select id="playback_status_choose">
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

<!--
	<select id="search_type_choose" class="am-u-md-1 am-fr">
		<?php foreach($search_type_list as $item){
			$selected = '';
			if(isset($item['active']) && $item['active'])
			{
				$selected = 'selected="selected"';
			}
			echo '<option value="'.$item['key'].'" '.$selected.'>'.$item['value'].'</option>';
		}?>
	</select>
	-->
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
	<th class="table-check"><input type="checkbox" id="playback_select" /></th><th>序号</th><th>教师姓名</th><th>学生姓名</th><th>ID</th><th>封面图</th><th>开始时间</th><th>回放时长</th><th>精彩回放</th><th>管理</th>
</tr>
</thead>
<tbody>
<?php foreach($playback_list as $k=>$playback){
	$str = '';
	$str .= '<tr>';
	$str .= '<td><input type="checkbox" F_order_id="'.$playback['F_order_id'].'" id="playback_check'.$playback['F_order_id'].'" /></td>';
	$str .= '<td>'.($k+1).'</td>';
	$str .= '<td>'.$playback['F_teacher_real_name'].'</td>';
	$str .= '<td>'.$playback['F_user_real_name'].'</td>';
	$str .= '<td>'.$playback['F_order_id'].'</td>';
	$str .= '<td><img src="'.$playback['F_cover_url'].'"></td>';
	$str .= '<td>'.$playback['F_start_time'].'</td>';
	$str .= '<td>'.$playback['F_duration_time'].'</td>';
	$str .= '<td>'.$playback['F_wonderful_text'].'</td>';
	$tmp  = "";
	$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-danger" F_order_id="'.$playback['F_order_id'].'"  id="playback_active'.$k.'"><span class="am-icon-check"></span> 设为精彩</button>';
	$tmp .= '<button class="am-btn am-btn-default am-btn-xs am-text-secondary" F_order_id="'.$playback['F_order_id'].'"  id="playback_deactive'.$k.'"><span class="am-icon-close"></span> 设为非精彩</button>';
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

<script>
	var set_playback_active_uri = "<?php echo $set_playback_active_uri;?>";
	var set_playback_deactive_uri = "<?php echo $set_playback_deactive_uri;?>";
</script>