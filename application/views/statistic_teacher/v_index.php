<div class="am-g">
	<div class="am-u-md am-cf">
		<div class="am-fl am-cf">

		  <div style="float: left">
			  <select id="datetypelist">
				<?php foreach($datetype_list  as $key=>$item){
					$selected = '';
					if(isset($item['selected']))
					{
						$datetype = $key;
						$selected = ' selected = "selected"';
					}
					echo '<option value="'.$item['key'].'"'.$selected.'>'.$item['value'].'</option>';
				}?>
			</select>
		  </div>

		  <div style="float: left;width: 15%;margin-left: 10px;">
				<div class="am-input-group am-datepicker-date" id="datepicker0" style="display: none">
					<input id="date0" type="text" class="am-form-field" placeholder="请选择日期" value="<?php echo date('Y-m-d',strtotime($result['date']));?>" readonly>
					<span class="am-input-group-btn am-datepicker-add-on">
						<button class="am-btn am-btn-default" type="button"><span class="am-icon-calendar"></span> </button>
					</span>
				</div>
			  <div class="am-input-group am-datepicker-date" id="datepicker1" style="display: none">
					<input id="date1" type="text" class="am-form-field" placeholder="请选择日期" value="<?php echo date('Y-m',strtotime($result['date']));?>" readonly>
					<span class="am-input-group-btn am-datepicker-add-on">
						<button class="am-btn am-btn-default" type="button"><span class="am-icon-calendar"></span> </button>
					</span>
				</div>
			  <div class="am-input-group am-datepicker-date" id="datepicker2" style="display: none">
					<input id="date2" type="text" class="am-form-field" placeholder="请选择日期" value="<?php echo date('Y',strtotime($result['date']));?>" readonly>
					<span class="am-input-group-btn am-datepicker-add-on">
						<button class="am-btn am-btn-default" type="button"><span class="am-icon-calendar"></span> </button>
					</span>
				</div>
		  </div>

			<button class="am-btn am-btn-default" id="search" style="margin-left: 10px;">
			<i class="am-icon-search"></i>
				查询
			</button>
			<div style="clear: both"></div>

		</div>
	</div>
</div>


<div class="am-g">
<div class="am-u-sm-12">
<form class="am-form">
<table class="am-table am-table-striped am-table-hover table-main">
<thead>
<tr>
	<th>ID</th><th>名字</th><th>解答次数</th><th>解答时长</th><th>获取金币</th>
</tr>
</thead>
<tbody>
<?php if(isset($result['list'])) foreach($result['list'] as $k=>$item){
	$str = '';
	$str .= '<tr>';
	$str .= '<td>'.$item['F_teacher_id'].'</td>';
	$str .= '<td>'.$item['F_real_name'].'</td>';
	$str .= '<td>'.$item['F_total_times'].'</td>';
	$str .= '<td>'.$item['F_time'].'</td>';
	$str .= '<td>'.$item['F_total_coin'].'</td></tr>';
	echo $str;
}?>
</tbody>
</table>
<div class="am-cf">
	共 <?php echo isset($result['total'])?$result['total']:0;?> 条记录
</div>
</form>
</div>

</div>


<script>

	<?php if(isset($result['datetype'])){ ?>
	var datetype = "<?php echo $result['datetype'];?>";
	<?php }?>
	var currentPageBaseUrl = "<?php echo my_site_url("c_statistic_teacher/index",array());?>";
</script>