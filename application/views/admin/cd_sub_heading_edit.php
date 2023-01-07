<div id="page-content" style="min-height: 1189px;">
	<!-- Product Edit Content -->
	<div class="row">
		<div class="block">
			<!-- General Data Title -->
			<div class="block-title">
				<h2>
					Edit Sub Heading
				</h2>
			</div>
			<!-- END General Data Title -->
			<!-- General Data Content -->
			<?php 
			$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-category');
			echo form_open_multipart('admin/cd_categories/sub_edit/'.$sub_heading->id, $attributes); ?>
			<?php
			echo "<div class='error_msg'>";
			echo validation_errors();
			echo "</div>";
			?>
				<div class="form-group">
					<label class="col-md-3 control-label" for="example-chosen-multiple">Heading</label>
                    <div class="col-md-9">
						<select id="cat" name="cat" class="select-chosen" data-placeholder="Choose Newspaper" style="width: 250px;" required>
							<?php foreach($cats as $cat){ ?>
                                    <option value="<?php echo $cat->id; ?>" <?php echo($cat->id==$sub_heading->cat_id)?'selected':'';?>><?php echo $cat->name; ?></option>
							<?php }?>
                        </select>
                    </div>
                </div>
				<div class="form-group">
					<label for="example-text-input" class="col-md-3 control-label">Sub Heading</label>
					<div class="col-md-9">
						<input type="text" placeholder="Sub Heading Name" required="required" class="form-control" name="heading" id="heading" value="<?php echo $sub_heading->sub_heading; ?>">
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