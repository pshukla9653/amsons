<div id="page-content" style="min-height: 1189px;">
	<!-- Product Edit Content -->
	<div class="row">
		<div class="block">
			<!-- General Data Title -->
			<div class="block-title">
				<h2>
					Add Slider
				</h2>
			</div>
			<!-- END General Data Title -->
			<!-- General Data Content -->
			<?php 
			$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-slider');
			echo form_open_multipart('admin/settings/slider_add', $attributes); ?>
			<?php
			echo "<div class='error_msg'>";
			echo validation_errors();
			echo "</div>";
			?>
				<div class="form-group">
					<label for="example-text-input" class="col-md-3 control-label">Title</label>
					<div class="col-md-9">
						<input type="text" placeholder="Title" required="required" class="form-control" name="slider_title" id="slider_title">
					</div>
				</div>
				<div class="form-group">
					<label for="example-file-input" class="col-md-3 control-label">Slider Image</label>
					<div class="col-md-9">
						<input type="file" name="slider_img" size="20" />
					</div>
				</div>
				<div class="form-group">
					<label for="example-select" class="col-md-3 control-label">Status</label>
					<div class="col-md-9">
						<select size="1" class="form-control" name="slider_status" id="slider_status" required="required">
							<option value="">Please select</option>
							<option value="1">Active</option>
							<option value="0">In Active</option>
						</select>
					</div>
				</div>
				<div class="form-group form-actions">
					<div class="col-md-9 col-md-offset-3">
						<button class="btn btn-sm btn-warning" type="reset"><i class="fa fa-repeat"></i> Reset</button>
						<button class="btn btn-sm btn-primary" name="submit_btn" type="submit" value="sub"><i class="fa fa-angle-right"></i>Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>