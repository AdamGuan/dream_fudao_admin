<div class="am-g">

	<div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
		<div class="am-panel am-panel-default">
			<div class="am-panel-bd">
				<div class="am-g">
					<?php if(isset($teacher_info['F_teacher_header_img_url'])){?>
					<div class="am-u-md-4">
						<img class="am-img-circle am-img-thumbnail" src="<?php echo $teacher_info['F_teacher_header_img_url'];?>" alt="老师头像,规格为：212w*182h"/>
					</div>
					<?php }?>
					<div class="am-u-md-8">
						<p>你可以使用jpg,png<br />头像规格为：212*182</p>
						<form class="am-form">
							<div class="am-form-group">
								<input type="file" id="user-pic">
								<p class="am-form-help">请选择要上传的头像...</p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
		<form class="am-form am-form-horizontal">
			<div class="am-form-group">
				<label for="teacher_login_name" class="am-u-sm-3 am-form-label">帐号</label>
				<div class="am-u-sm-9">
					<input type="text" id="teacher_login_name" placeholder="输入老师的帐号" value="<?php echo isset($teacher_info['F_teacher_name'])?$teacher_info['F_teacher_name']:"";?>">
					<small>可用于(控制平台/apk)登陆</small>
				</div>
			</div>

			<div class="am-form-group">
				<label for="user-email" class="am-u-sm-3 am-form-label">密码</label>
				<div class="am-u-sm-9">
					<input type="email" id="user-email" placeholder="输入老师的密码,为空则保持不变." value="">
				</div>
			</div>

			<div class="am-form-group">
				<label for="user-phone" class="am-u-sm-3 am-form-label">名字</label>
				<div class="am-u-sm-9">
					<input type="email" id="user-phone" placeholder="输入老师的名字" value="<?php echo isset($teacher_info['F_real_name'])?$teacher_info['F_real_name']:"";?>">
				</div>
			</div>

			<div class="am-form-group">
				<label for="user-intro" class="am-u-sm-3 am-form-label">性别</label>
				<div class="am-u-sm-9">
					<select>
						<?php foreach($gender_list as $k=>$gender){
							if(isset($teacher_info['F_gender']) && (int)$teacher_info['F_gender'] == $k)
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
				<label for="user-intro" class="am-u-sm-3 am-form-label">年级</label>
				<div class="am-u-sm-9">
					<select>
						<?php foreach($grade_list as $k=>$grade){
							if(isset($teacher_info['F_grade']) && (int)$teacher_info['F_grade'] == $k)
							{
								echo "<option value='".$k."' selected=\"selected\">".$grade."</option>";
							}
							else{
								echo "<option value='".$k."'>".$grade."</option>";
							}
						}?>
					</select>
				</div>
			</div>

			<div class="am-form-group">
				<label for="user-intro" class="am-u-sm-3 am-form-label">经验</label>
				<div class="am-u-sm-9">
					<select>
						<?php
							for($i=1;$i<15;++$i)
							{
								if(isset($teacher_info['F_teaching_experience']) && (int)$teacher_info['F_teaching_experience'] == $i)
								{
									echo "<option value='".$i."' selected=\"selected\">".$i."年</option>";
								}
								else{
									echo "<option value='".$i."'>".$i."年</option>";
								}
							}
						?>
					</select>
				</div>
			</div>

			<div class="am-form-group">
				<label for="user-intro" class="am-u-sm-3 am-form-label">擅长</label>
				<div class="am-u-sm-9">
					<select>
						<?php foreach($subject_list as $k=>$subject){
							if(isset($teacher_info['F_subject_id']) && (int)$teacher_info['F_subject_id'] == $k)
							{
								echo "<option value='".$k."' selected=\"selected\">".$subject."</option>";
							}
							else{
								echo "<option value='".$k."'>".$subject."</option>";
							}
						}?>
					</select>
				</div>
			</div>

			<?php
			if(isset($teacher_info['F_subject_ids']))
			{
				$subjects = explode(",",$teacher_info['F_subject_ids']);
			}
			?>

			<div class="am-form-group">
				<label for="user-intro" class="am-u-sm-3 am-form-label">能力</label>
				<div class="am-u-sm-9">
					<select>
						<option value="0">无</option>
						<?php foreach($subject_list as $k=>$subject){
							if(isset($subjects[0]) && (int)$subjects[0] == $k)
							{
								echo "<option value='".$k."' selected=\"selected\">".$subject."</option>";
							}
							else{
								echo "<option value='".$k."'>".$subject."</option>";
							}
						}?>
						<option>语文</option>
					</select>
				</div>
			</div>

			<div class="am-form-group">
				<label for="user-intro" class="am-u-sm-3 am-form-label"></label>
				<div class="am-u-sm-9">
					<select>
						<option value="0">无</option>
						<?php foreach($subject_list as $k=>$subject){
							if(isset($subjects[1]) && (int)$subjects[1] == $k)
							{
								echo "<option value='".$k."' selected=\"selected\">".$subject."</option>";
							}
							else{
								echo "<option value='".$k."'>".$subject."</option>";
							}
						}?>
						<option>语文</option>
					</select>
				</div>
			</div>

			<div class="am-form-group">
				<label for="user-intro" class="am-u-sm-3 am-form-label"></label>
				<div class="am-u-sm-9">
					<select>
						<option value="0">无</option>
						<?php foreach($subject_list as $k=>$subject){
							if(isset($subjects[2]) && (int)$subjects[2] == $k)
							{
								echo "<option value='".$k."' selected=\"selected\">".$subject."</option>";
							}
							else{
								echo "<option value='".$k."'>".$subject."</option>";
							}
						}?>
						<option>语文</option>
					</select>
				</div>
			</div>

			<div class="am-form-group">
				<label for="user-intro" class="am-u-sm-3 am-form-label">类型</label>
				<div class="am-u-sm-9">
					<select>
						<option>正式帐号</option>
						<option <?php if(isset($teacher_info['F_status']) && (int)$teacher_info['F_teaching_experience'] == 4){echo "selected='selected'";}?>>测试帐号</option>
					</select>
				</div>
			</div>

			<div class="am-form-group">
				<label for="user-intro" class="am-u-sm-3 am-form-label">简介</label>
				<div class="am-u-sm-9">
					<textarea class="" rows="5" id="user-intro" placeholder="输入老师的个人简介"><?php echo isset($teacher_info['F_description'])?$teacher_info['F_description']:"";?></textarea>
				</div>
			</div>

			<div class="am-form-group">
				<div class="am-u-sm-9 am-u-sm-push-3">
					<button type="button" class="am-btn am-btn-primary">保存修改</button>
				</div>
			</div>
		</form>
	</div>
</div>