<div id="page-content" style="min-height: 1189px;">
	<!-- Product Edit Content -->
	<div class="row">
		<div class="block">
			<!-- General Data Title -->
			<div class="block-title">
				<h2>
					Add Category
				</h2>
			</div>
			<!-- END General Data Title -->
			<!-- General Data Content -->
			<?php 
			$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-category');
			echo form_open_multipart('admin/categories/add', $attributes); ?>
			<?php
			echo "<div class='text-danger'>";
			echo validation_errors();
			echo "</div>";
			?>
				<div class="form-group">
					<label for="example-text-input" class="col-md-3 control-label">Category</label>
					<div class="col-md-9">
						<input type="text" placeholder="Category Name" required="required" class="form-control" name="category_name" id="category_name">
					</div>
				</div>
				<div class="form-group">
					<label for="example-textarea-input" class="col-md-3 control-label">Description</label>
					<div class="col-md-9">
						<textarea placeholder="Description.." class="form-control" rows="9" name="cat_desc" id="cat_desc"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="example-file-input" class="col-md-3 control-label">Category Icon</label>
					<div class="col-md-9">
						<input type="file" name="cat_icon" size="20" />
					</div>
				</div>
				<div class="form-group">
					<label for="example-select" class="col-md-3 control-label">Status</label>
					<div class="col-md-9">
						<select size="1" class="form-control" name="cat_status" id="cat_status" required="required">
							<option value="">Please select</option>
							<option value="A">Active</option>
							<option value="I">In Active</option>
						</select>
					</div>
				</div>				
				<div class="form-group form-actions">
					<div class="col-md-9 col-md-offset-3">
						<button class="btn btn-sm btn-primary" name="submit_btn" type="submit" value="sub"><i class="fa fa-angle-right"></i>Submit</button>
						<button class="btn btn-sm btn-warning" type="reset"><i class="fa fa-repeat"></i> Reset</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
