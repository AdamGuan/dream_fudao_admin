<div class="am-g">

	<div class="am-u-sm-12 am-u-md-4 am-u-md-push-8"></div>

	<div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
		<form class="am-form am-form-horizontal">

			<div class="am-form-group">
				<label for="group_name" class="am-u-sm-3 am-form-label">用户名</label>
				<div class="am-u-sm-9">
					<input type="text" id="user_name" value="" placeholder="输入用户,小于等于30个字符">
				</div>
			</div>

			<div class="am-form-group">
				<label for="group_name" class="am-u-sm-3 am-form-label">用户密码</label>
				<div class="am-u-sm-9">
					<input type="password" id="user_pwd" value="" placeholder="输入密码,6-10位字母、数字以及下划线">
				</div>
			</div>

			<?php if(isset($group_list) && count($group_list) > 0){?>
			<div class="am-form-group">
				<label for="group_list" class="am-u-sm-3 am-form-label">用户权限组</label>
				<div class="am-u-sm-9">
					<select id="group_list">
						<?php foreach($group_list as $group){
							$str = '';
							if(isset($group['tab']) && $group['tab'] > 0)
							{
								$str = "|".str_repeat("----",$group['tab']);
							}
							echo '<option value="'.$group['F_id'].'">'.$str.$group['F_name'].'</option>';
						}?>
					</select>
				</div>
			</div>
			<?php }?>

			<div class="am-form-group">
				<div class="am-u-sm-9 am-u-sm-push-3">
					<button type="button" id="user_add_submit" class="am-btn am-btn-primary">保存添加</button>
					<button type="button" id="user_add_back" class="am-btn am-btn-primary">返回</button>
				</div>
			</div>

		</form>
	</div>
</div>

<script>
	var user_add_do_url = "<?php echo my_site_url('c_privity/user_add_do');?>";
</script>