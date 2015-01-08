<div class="am-g">

	<div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
	</div>

	<div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
		<form class="am-form am-form-horizontal">
			<div class="am-form-group">
				<label for="publish_title" class="am-u-sm-3 am-form-label">标题</label>
				<div class="am-u-sm-9">
					<input type="text" id="publish_title" value="" placeholder="公告标题">
				</div>
			</div>

			<div class="am-form-group">
				<label for="publish_content" class="am-u-sm-3 am-form-label">内容</label>
				<div class="am-u-sm-9">
					<textarea class="" rows="5" id="publish_content" placeholder="公告内容"></textarea>
				</div>
			</div>

			<div class="am-form-group">
				<div class="am-u-sm-9 am-u-sm-push-3">
					<button type="button" id="publish_add_submit" class="am-btn am-btn-primary">提交保存</button>
					<button type="button" id="publish_add_back" class="am-btn am-btn-primary">返回</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	var add_do_url = "<?php echo my_site_url('c_publish/add_do');?>";
</script>