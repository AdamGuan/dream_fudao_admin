<div class="am-g">
	<div class="am-u-md am-cf">
		<div class="am-fl am-cf">

		  <div style="float: left">
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

		  <div style="float: left;margin-left: 10px;">
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


<div id="chars"></div>

<script>
	<?php if(isset($result['desc'])){ ?>
	var charDesc = "<?php echo $result['desc'];?>";
	<?php }?>

	<?php if(isset($datetype)){ ?>
	var datetype = "<?php echo $datetype;?>";
	<?php }?>

	var categories = new Array();
	var data = new Array();
	<?php if(isset($result['list']) && is_array($result['list']) && count($result['list']) > 0){
		foreach($result['list'] as $item){
			$times = $item['times'];
			$time = $item['desc'];
	 ?>
	categories[categories.length] = "<?php echo $time;?>";
	data[data.length] = <?php echo $times;?>;
	<?php
	 }}?>

	var currentPageBaseUrl = "<?php echo my_site_url("c_statistic_timesection/index",array());?>";
</script>