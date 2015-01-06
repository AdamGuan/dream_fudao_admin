<div class="am-g">

	<div class="am-u-sm-12 am-u-md-4 am-u-md-push-8"></div>

	<div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
		<form class="am-form am-form-horizontal">

			<div class="am-form-group">
				<label for="group_name" class="am-u-sm-3 am-form-label">组名</label>
				<div class="am-u-sm-9">
					<input type="text" id="group_name" value="" placeholder="输入权限组的名词,小于等于30个字符">
				</div>
			</div>
<!--
			<?php if(isset($group_list) && count($group_list) > 0){?>
			<div class="am-form-group">
				<label for="group_name" class="am-u-sm-3 am-form-label">所属父级</label>
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
				<label for="child" class="am-u-sm-3 am-form-label">子类</label>
				<div class="am-u-sm-9">
					<select id="child">
						<option value="1">所属成员可以建立子权限组</option>
						<option value="0">所属成员不可以建立子权限组</option>
					</select>
				</div>
			</div>
-->
			<div class="am-form-group">
				<label for="privity" class="am-u-sm-3 am-form-label">权限</label>
				<div class="am-u-sm-9" id="privity_html">
					<?php echo $global_privity_htmlstr;?>
				</div>
			</div>



			<div class="am-form-group">
				<div class="am-u-sm-9 am-u-sm-push-3">
					<button type="button" id="group_add_submit" class="am-btn am-btn-primary">保存添加</button>
					<button type="button" id="group_add_back" class="am-btn am-btn-primary">返回</button>
				</div>
			</div>
		</form>
	</div>
</div>