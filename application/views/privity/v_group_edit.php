<div class="am-g">

	<div class="am-u-sm-12 am-u-md-4 am-u-md-push-8"></div>

	<div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
		<form class="am-form am-form-horizontal">

			<div class="am-form-group">
				<label for="group_name" class="am-u-sm-3 am-form-label">组名</label>
				<div class="am-u-sm-9">
					<input type="text" id="group_name" value="<?php echo $group_info['F_name'];?>" placeholder="输入权限组的名词,小于等于30个字符">
				</div>
			</div>
			<!--
			<div class="am-form-group">
				<label for="child" class="am-u-sm-3 am-form-label">子类</label>
				<div class="am-u-sm-9">
					<select id="child">
						<option value="1" <?php if($group_info['F_could_has_child'] == 1){echo 'selected="selected"';} ?>>所属成员可以建立子权限组</option>
						<option value="0" <?php if($group_info['F_could_has_child'] == 0){echo 'selected="selected"';} ?>>所属成员不可以建立子权限组</option>
					</select>
				</div>
			</div>
			-->

			<div class="am-form-group">
				<label for="privity" class="am-u-sm-3 am-form-label">权限</label>
				<div class="am-u-sm-9" id="privity_html">
					<?php echo $group_info['privity_html'];?>
				</div>
			</div>



			<div class="am-form-group">
				<div class="am-u-sm-9 am-u-sm-push-3">
					<button type="button" id="group_modify_submit" class="am-btn am-btn-primary">保存添加</button>
					<button type="button" id="group_modify_back" class="am-btn am-btn-primary">返回</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	var group_id = "<?php echo $group_info['F_id'];?>";
	var group_modify_do_url = "<?php echo my_site_url('c_privity/group_modify_do');?>";
</script>