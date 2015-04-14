<div class="am-g">
	<div class="am-u-md am-cf">
		<div class="am-fl am-cf">
			<input type="text" id="date" class="am-form-field" value="<?php echo $date;?>" data-am-datepicker readonly/>
		</div>
	</div>
</div>


<div class="am-g">
<div class="am-u-sm-12">
<form class="am-form">
<table class="am-table am-table-striped am-table-hover table-main">
<thead>
<tr>
	<th>科目</th><th>年级</th><th>总时长</th><th>总次数</th>
</tr>
</thead>
<tbody>
<?php if(isset($result['list'])) foreach($result['list'] as $k=>$item){
	$str = '';
	$str .= '<tr>';
	$str .= '<td>'.$item['F_subject_text'].'</td>';
	$str .= '<td>'.$item['F_grade_text'].'</td>';
	$str .= '<td>'.$item['time'].'</td>';
	$str .= '<td>'.$item['total'].'</td></tr>';
	echo $str;
}?>
</tbody>
</table>
<div class="am-cf">
	共 <?php echo $total;?> 条记录
</div>

</form>
</div>

</div>

<script type="text/javascript">
	var currentPageUrl = "<?php echo $currentPageUrl;?>";
</script>