

<div class="am-cf am-padding">
	<div class="am-fl am-cf am-text-primary am-text-lg">当前状态</div>
</div>

<ul class="am-avg-sm-1 am-avg-md-2 am-margin am-padding am-text-center admin-content-list ">
	<li><br/>在线老师<a class="am-badge am-badge-primary am-round am-text-default am-badge-secondary"><?php echo $teacher_online_num;?></a></li>
	<li><br/>在线学生<a class="am-badge am-badge-success am-round am-text-default am-badge-secondary"><?php echo $student_online_num;?></a></li>
</ul>

<?php if(isset($action_link) && is_array($action_link) && count($action_link) > 0){?>
	<div class="am-cf am-padding">
		<div class="am-fl am-cf am-text-primary am-text-lg">快捷操作</div>
	</div>
	<div class="am-cf am-padding">
	<?php
	foreach($action_link as $item)
	{
		echo '<section class="am-panel am-panel-default">';
		echo '<header class="am-panel-hd"><h3 class="am-panel-title">'.$item['title'].'</h3></header>';
		echo '<div class="am-panel-bd"><ul class="am-avg-sm am-margin am-padding am-text-left admin-content-list ">';
		foreach($item['list'] as $it)
		{
			echo '<li style="margin-left: 10px;border: none;"><a href="'.$it['url'].'"><span class="am-icon-btn '.$it['prefix_class'].'"></span>'.$it['title'].'</a></li>';
		}
		echo '</ul></div></section>';
	}?>
	</div>
<?php }?>