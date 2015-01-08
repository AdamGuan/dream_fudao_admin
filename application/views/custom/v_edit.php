<div class="am-g">

	<div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
	</div>

	<div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
		<form class="am-form am-form-horizontal">
			<div class="am-form-group">
				<label for="custom_login_name" class="am-u-sm-3 am-form-label">帐号</label>
				<div class="am-u-sm-9">
					<input type="text" id="custom_login_name" value="<?php echo isset($custom_info['F_teacher_name'])?$custom_info['F_teacher_name']:"";?>" disabled>
				</div>
			</div>

			<div class="am-form-group">
				<label for="custom_login_pwd" class="am-u-sm-3 am-form-label">密码</label>
				<div class="am-u-sm-9">
					<input type="password" id="custom_login_pwd" placeholder="密码,为空则保持不变,6-10位字母、数字以及下划线" value="">
				</div>
			</div>

			<div class="am-form-group">
				<label for="custom_realname" class="am-u-sm-3 am-form-label">名字</label>
				<div class="am-u-sm-9">
					<input type="text" id="custom_realname" placeholder="输入客服的名字" value="<?php echo isset($custom_info['F_real_name'])?$custom_info['F_real_name']:"";?>">
				</div>
			</div>

			<div class="am-form-group">
				<label for="custom_gender" class="am-u-sm-3 am-form-label">性别</label>
				<div class="am-u-sm-9">
					<select id="custom_gender">
						<?php foreach($gender_list as $k=>$gender){
							if(isset($custom_info['F_gender']) && (int)$custom_info['F_gender'] == $k)
							{
								echo "<option value='".$k."' selected=\"selected\">".$gender."</option>";
							}
							else{
								echo "<option value='".$k."'>".$gender."</option>";
							}
						}?>
					</select>
				</div>
			</div>

			<div class="am-form-group">
				<div class="am-u-sm-9 am-u-sm-push-3">
					<button type="button" id="custom_edit_submit" class="am-btn am-btn-primary">保存修改</button>
					<button type="button" id="custom_edit_back" class="am-btn am-btn-primary">返回</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	var F_teacher_id = "<?php echo $F_teacher_id;?>";
	var custom_modify_url = "<?php echo my_site_url('c_custom/custom_modify');?>";
</script>