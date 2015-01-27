

<div class="am-cf am-padding">
	<strong class="am-text-primary am-text-lg">当前状态</strong>
</div>

<ul class="am-avg-sm-1 am-avg-md-2 am-margin am-padding am-text-center admin-content-list ">
	<li><a href="javascript:void(0)" class="am-text-success"><span class="am-icon-btn am-icon-file-text"></span><br/>在线老师<br/><?php echo $teacher_online_num;?></a></li>
	<li><a href="javascript:void(0)" class="am-text-warning"><span class="am-icon-btn am-icon-briefcase"></span><br/>在线学生<br/><?php echo $student_online_num;?></a></li>
</ul>

<?php if(isset($action_link) && is_array($action_link) && count($action_link) > 0){?>
	<div class="am-cf am-padding">
		<strong class="am-text-primary am-text-lg">快捷操作</strong>
	</div>
	<div class="am-margin am-padding" style="background-color:#f3f3f3;margin-top:0px;">
	<?php
	foreach($action_link as $item)
	{
		echo '<div class="am-margin"><strong>'.$item['title'].'</strong></div>';
		echo '<ul class="am-avg-sm am-margin am-padding am-text-left admin-content-list" style="border: none;">';
		foreach($item['list'] as $it)
		{
			echo '<li style="margin-right: 50px;background-color:white;border: solid 1px #ddd;padding-right:10px;"><a href="'.$it['url'].'"><span class="am-icon-btn '.$it['prefix_class'].'" style="background-color:white;border-right:solid 1px;border-radius:0;padding-left:10px;padding-right:10px;margin-right:10px;border-color:#ddd"></span>'.$it['title'].'</a></li>';
		}
		echo '</ul>';
	}?>
	</div>
	<!--
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
	-->
<?php }?>