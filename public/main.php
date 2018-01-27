<?php include 'head.php'; ?>
	<div class="container">
		<form id="upload-form" action="./app/core/process.php" name="main" enctype="multipart/form-data" method="POST">
			<div class="row">
				<label for="repository"><?php lang('label_repo'); ?></label>
				<input id="repository" class="u-full-width" type="text" name="repository" value="<?php echo $config['repository']; ?>" disabled>
				<p class="form-help"><?php lang('help_repo'); ?></p>
			</div>
			<div class="row">
				<div class="six columns">
					<label for="modname"><?php lang('label_name'); ?></label>
					<input id="modname" class="u-full-width" type="text" name="modname">
					<p class="form-help emphasize"><?php lang('help_new_only'); ?></p>
				</div>

				<div class="six columns">
					<label for="modauthor"><?php lang('label_author'); ?></label>
					<input id="modauthor" class="u-full-width" type="text" name="modauthor">
					<p class="form-help"><?php lang('help_optional'); ?></p>
				</div>
			</div>

			<div class="row">
				<div class="six columns">
					<label for="modslug"><?php lang('label_slug'); ?></label>
					<input id="modslug" class="u-full-width" type="text" name="modslug">
					<p class="form-help emphasize"><?php lang('help_required'); ?></p>
				</div>

				<div class="six columns">
					<label for="modversion"><?php lang('label_version'); ?></label>
					<input id="modversion" class="u-full-width" type="text" name="modversion">
					<p class="form-help emphasize"><?php lang('help_required'); ?></p>
				</div>
			</div>

			<div class="row">
				<div class="six columns">
					<label for="file"><?php lang('label_files'); ?></label>
					<div class="file-container">
						<input id="file-button" class="u-full-width" type="button" name="file-button" value="Click or drag a file here to upload it">
						<input id="file" class="u-full-width" type="file" name="file">
						<p class="form-help hidden">.</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="six columns">
					<label for="type"><?php lang('label_dest'); ?></label>
					<select id="type" class="u-full-width" name="type">
						<option value="dest-bin">bin</option>
						<option value="dest-config">config</option>
						<option value="dest-mods" selected>mods</option>
						<option value="dest-scripts">scripts</option>
						<option value="dest-other"><?php lang('label_dest_other'); ?></option>
					</select>
				</div>

				<div class="six columns">
					<label class="hidden" for="otherfield">.</label>
					<input id="otherfield" class="u-full-width" type="text" name="otherfield" disabled>
					<p class="form-help"><?php lang('help_dest'); ?></p>
				</div>
			</div>

			<div class="row">
				<input class="primary" type="submit" value="<?php lang('button_upload'); ?>">
				<input class="error" type="reset" value="<?php lang('button_reset'); ?>">
			</div>
		</form>
	</div>
	<script src="//code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="./public/js/main.min.js"></script>
</body>
</html>


