<div id="page-content" style="min-height: 1189px;">
	<!-- Product Edit Content -->
	<div class="row">
		<div class="col-lg-12">
			<!-- General Data Block -->
			<div class="block">
				<!-- General Data Title -->
				<div class="block-title">
					<h2>
						<i class="fa fa-pencil"></i>
						<strong>Edit </strong> Users
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-pack');
					echo form_open_multipart('admin/sub_admin/edit/'.$admin->id, $attributes); ?>
					<?php
					echo "<div class='text-danger' align='center'>";
					echo validation_errors();
					echo "</div>";
					?>
						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Name</label>
							<div class="col-md-9">
								<input type="text" placeholder="Enter Name" required="required" class="form-control" name="name" id="name" value="<?php echo (empty($admin)) ? '' : $admin->name ;?>">
							</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">E-mail</label>
								<div class="col-md-9">
									<input type="email" placeholder="Enter E-mail" required="required" class="form-control" name="email" id="email"  value="<?php echo (empty($admin)) ? '' : $admin->email ;?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Mobile</label>
								<div class="col-md-9">
									<input type="text" placeholder="Enter Mobile" required="required" class="form-control" name="mobile" id="mobile"  value="<?php echo (empty($admin)) ? '' : $admin->mobile ;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label" for="pack-overview">Address</label>
								<div class="col-md-9">
									<textarea id="address" name="address" required="required" class="ckeditor"> <?php echo (empty($admin)) ? '' : $admin->address ;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Active?</label>
								<div class="col-md-9">
									<label class="switch switch-primary">
										<input type="checkbox" <?php echo ($admin->status=='A') ? 'checked' : 'unchecked' ;?> name="status" id="status">
										<span></span>
									</label>
								</div>
							</div>
							<div class="form-group form-actions">
								<div class="col-md-9 col-md-offset-3">
									<button class="btn btn-sm btn-warning" type="reset">
										<i class="fa fa-repeat"></i> Reset
									</button>
									<button class="btn btn-sm btn-primary" type="submit">
										<i class="fa fa-floppy-o"></i> Save
									</button>
								</div>
							</div>
						</form>
					<!-- END General Data Content -->
			</div>
			<!-- END General Data Block -->
		</div>
	<!-- END Product Edit Content -->
</div>