<div class="am-g">
<div class="am-u-sm-12">
<form class="am-form">
<table class="am-table am-table-striped am-table-hover table-main">
<thead>
<tr>
	<th>序号</th><th>账号</th><th>名字</th><th>ID</th><th>年级</th><th>金币</th>
</tr>
</thead>
<tbody>
<?php foreach($student_list as $k=>$student){
	$str = '';
	$str .= '<tr>';
	$str .= '<td>'.($k+1).'</td>';
	$str .= '<td>'.$student['F_user_name'].'</td>';
	$str .= '<td>'.$student['F_real_name'].'</td>';
	$str .= '<td>'.$student['F_user_id'].'</td>';
	$str .= '<td>'.$student['F_grade_text'].'</td>';
	$str .= '<td>'.$student['F_coin'].'</td></tr>';
	echo $str;
}?>
</tbody>
</table>
<div class="am-cf">
	共 <?php echo $student_total;?> 条记录
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