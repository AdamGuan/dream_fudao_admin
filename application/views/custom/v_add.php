<div class="am-g">

	<div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
	</div>

	<div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
		<form class="am-form am-form-horizontal">
			<div class="am-form-group">
				<label for="custom_login_name" class="am-u-sm-3 am-form-label">帐号</label>
				<div class="am-u-sm-9">
					<input type="text" id="custom_login_name" value="" placeholder="输入客服的帐号,长度小于等于30个字符">
				</div>
			</div>

			<div class="am-form-group">
				<label for="custom_login_pwd" class="am-u-sm-3 am-form-label">密码</label>
				<div class="am-u-sm-9">
					<input type="password" id="custom_login_pwd" placeholder="输入客服的密码,6-10位字母、数字以及下划线." value="">
				</div>
			</div>

			<div class="am-form-group">
				<label for="custom_realname" class="am-u-sm-3 am-form-label">名字</label>
				<div class="am-u-sm-9">
					<input type="text" id="custom_realname" placeholder="输入客服的名字,长度小于等于12个字符" value="">
				</div>
			</div>

			<div class="am-form-group">
				<label for="custom_gender" class="am-u-sm-3 am-form-label">性别</label>
				<div class="am-u-sm-9">
					<select id="custom_gender">
						<?php foreach($gender_list as $k=>$gender){
							echo "<option value='".$k."'>".$gender."</option>";
						}?>
					</select>
				</div>
			</div>

			<div class="am-form-group">
				<div class="am-u-sm-9 am-u-sm-push-3">
					<button type="button" id="custom_add_submit" class="am-btn am-btn-primary">保存添加</button>
					<button type="button" id="custom_add_back" class="am-btn am-btn-primary">返回</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	var manager_url = "<?php echo $manager_url;?>";
	var custom_add_do_url = "<?php echo my_site_url('c_custom/custom_add_do');?>";
</script>