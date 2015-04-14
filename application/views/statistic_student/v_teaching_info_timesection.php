<div class="am-g">
	<div class="am-u-md am-cf">
		<div class="am-fl am-cf">

		  

		</div>
	</div>
</div>


<div class="am-g">
<div class="am-u-sm-12">
<form class="am-form">
<table class="am-table am-table-striped am-table-hover table-main">
<thead>
<tr>
	<th>学生账号</th><th>学生名字</th><th>请求次数</th><th>时长</th><th>金币</th>
</tr>
</thead>
<tbody>
<?php if(isset($result['list'])) foreach($result['list'] as $k=>$item){
	$str = '';
	$str .= '<tr>';
	$str .= '<td>'.$item['F_user_name'].'</td>';
	$str .= '<td>'.$item['F_real_name'].'</td>';
	$str .= '<td>'.$item['F_teaching_times'].'</td>';
	$str .= '<td>'.$item['F_time'].'</td>';
	$str .= '<td>'.$item['F_coin'].'</td></tr>';
	echo $str;
}?>
</tbody>
</table>
<div class="am-cf">
	共 <?php echo isset($result['total'])?$result['total']:0;?> 条记录
	<div class="am-fr">
		<ul class="am-pagination">
			<li><a href="<?php echo $page_first_url;?>">First</a></li>
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
			<li><a href="<?php echo $page_last_url;?>">Last</a></li>
		</ul>
	</div>
</div>
<div><a class="am-btn am-btn-primary" href="<?php echo $refrence_url;?>">返回</a></div>
</form>
</div>

</div>