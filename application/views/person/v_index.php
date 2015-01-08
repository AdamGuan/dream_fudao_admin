<div class="am-g">

	<div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
	</div>

	<div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
		<form class="am-form am-form-horizontal">
			<div class="am-form-group">
				<label for="teacher_login_name" class="am-u-sm-3 am-form-label">帐号</label>
				<div class="am-u-sm-9">
					<input type="text" value="<?php echo isset($info['name'])?$info['name']:"";?>" disabled>
				</div>
			</div>

			<div class="am-form-group">
				<label for="login_pwd" class="am-u-sm-3 am-form-label">密码</label>
				<div class="am-u-sm-9">
					<input type="password" id="login_pwd" placeholder="为空则保持不变.6-10位字母、数字以及下划线" value="">
				</div>
			</div>

			<div class="am-form-group">
				<label for="group" class="am-u-sm-3 am-form-label">权限组</label>
				<div class="am-u-sm-9">
					<select id="group" disabled>
						<option><?php echo isset($info['group'])?$info['group']:"";?></option>
					</select>
				</div>
			</div>

			<div class="am-form-group">
				<div class="am-u-sm-9 am-u-sm-push-3">
					<button type="button" id="edit_submit" class="am-btn am-btn-primary">保存修改</button>
					<button type="button" id="edit_back" class="am-btn am-btn-primary">返回</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	var do_modify_info_url = "<?php echo my_site_url('c_person/do_modify_info');?>";
</script>