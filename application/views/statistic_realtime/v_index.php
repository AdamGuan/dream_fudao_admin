<div class="am-cf am-padding">
	<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">当前实时状态</strong></div>
</div>

<div class="am-g">
	<div class="am-u-sm-6">
		<div class="am-panel am-panel-primary am-avg-sm-2">
			<header class="am-panel-hd">
				<h3 class="am-panel-title" style="text-align:center;">老师在线统计</h3>
			</header>
			<div class="am-panel-bd">
				<ul class="am-avg-sm-1 am-avg-md-3  am-text-center">
					<li><a href="#" class="am-text-warning"><br/>总人数<br/><strong><?php echo isset($result['teacher_online_info']['teacher_total'])?$result['teacher_online_info']['teacher_total']:0;?></a></strong></li>
					<li><a href="#" class="am-text-warning"><br/>在线人数<br/><strong><?php echo isset($result['teacher_online_info']['teacher_total'])?($result['teacher_online_info']['teacher_total'] - $result['teacher_online_info']['teacher_offline']):0;?></a></strong></li>
					<li><a href="#" class="am-text-warning"><br/>辅导中<br/><strong><?php echo isset($result['teacher_online_info']['teacher_online_teaching'])?$result['teacher_online_info']['teacher_online_teaching']:0;?></a></strong></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="am-u-sm-6">
		<div class="am-panel am-panel-success am-avg-sm-2">
			<header class="am-panel-hd">
				<h3 class="am-panel-title" style="text-align:center;">学生在线统计</h3>
			</header>
			<div class="am-panel-bd">
				<ul class="am-avg-sm-1 am-avg-md-3  am-text-center">
					<li><a href="#" class="am-text-warning"><br/>总人数<br/><strong><?php echo isset($result['student_online_info']['user_total'])?$result['student_online_info']['user_total']:0;?></strong></a></li>
					<li><a href="#" class="am-text-warning"><br/>在线人数<br/><strong><?php echo isset($result['student_online_info']['user_total'])?($result['student_online_info']['user_total'] - $result['student_online_info']['user_offline']):0;?></strong></a></li>
					<li><a href="#" class="am-text-warning"><br/>辅导中<br/><strong><?php echo isset($result['student_online_info']['user_online_teaching'])?$result['student_online_info']['user_online_teaching']:0;?></strong></a></li>
				</ul>
			</div>
		</div>
	</div>

</div>


<div class="am-cf am-padding">
	<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">今日时段统计</strong></div>&nbsp;
	<select id="typelist">
	<?php foreach($type_list  as $item){
		$selected = '';
		if(isset($item['selected']))
		{
			$selected = ' selected = "selected"';
		}
		echo '<option value="'.$item['key'].'"'.$selected.'>'.$item['value'].'</option>';
	}?>
</select>
</div>


<div id="chars"></div>

<script>
	<?php if(isset($result['desc'])){ ?>
	var charDesc = "<?php echo $result['desc'];?>";
	<?php }?>

	var categories = new Array();
	var data = new Array();
	<?php if(isset($result['info']) && is_array($result['info']) && count($result['info']) > 0){
		foreach($result['info'] as $item){
			$times = $item['times'];
			$time = (int)$item['start_time'];
	 ?>
	categories[categories.length] = "<?php echo $time;?>";
	data[data.length] = <?php echo $times;?>;
	<?php
	 }}?>
</script>