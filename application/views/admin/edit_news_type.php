<div id="page-content" style="min-height: 1189px;">
	<!-- Product Edit Content -->
	<div class="row">
		<div class="block">
			<!-- General Data Title -->
			<div class="block-title">
				<h2>
					Edit <i class="text-warning"><?php echo $news_type[0]->name; ?></i> Category
				</h2>
			</div>
			<!-- END General Data Title -->
			<!-- General Data Content -->
			<?php 
			$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-category');
			echo form_open('admin/news_type/edit/'.$news_type[0]->id, $attributes); ?>
			<?php
			echo "<div class='text-danger'>";
			echo validation_errors();
			echo "</div>";
			?>
				<div class="form-group">
					<label for="example-text-input" class="col-md-3 control-label">News Type</label>
					<div class="col-md-9">
						<input type="text" placeholder="Type Name" required="required" class="form-control" name="name" id="name" value="<?php echo $news_type[0]->name; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="example-select" class="col-md-3 control-label">Base Type</label>
					<div class="col-md-9">
						<select size="1" class="form-control" name="bt" id="bt" required="required">
							<option value="">Please select</option>
							<option value="T" <?php echo ($news_type[0]->base_type=='T')?'selected':'';?>>Text</option>
							<option value="D" <?php echo ($news_type[0]->base_type=='D')?'selected':'';?>>Display</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="example-textarea-input" class="col-md-3 control-label">Description</label>
					<div class="col-md-9">
						<textarea placeholder="Description.." class="form-control" rows="9" name="type_desc" id="type_desc"><?php echo $news_type[0]->description; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="example-select" class="col-md-3 control-label">Status</label>
					<div class="col-md-9">
						<select size="1" class="form-control" name="status" id="status" required="required">
							<option value="">Please select</option>
							<option value="A" <?php echo ($news_type[0]->status=='A')?'selected':'';?>>Active</option>
							<option value="I"<?php echo ($news_type[0]->status=='I')?'selected':'';?>>In Active</option>
						</select>
					</div>
				</div>
				<div class="form-group form-actions">
					<div class="col-md-9 col-md-offset-3">
						<button class="btn btn-sm btn-warning" type="reset"><i class="fa fa-repeat"></i> Reset</button>
						<button class="btn btn-sm btn-primary" name="submit_btn" type="submit" value="sub"><i class="fa fa-angle-right"></i>Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>