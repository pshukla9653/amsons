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
						<strong>Edit </strong> FM Group
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/fm/group_edit/'.$newspaper_group->ng_id , $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
					<input type="hidden" value="<?php echo $newspaper_group->ng_name?>" required="required" name="old_name" id="old_name">
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Name</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Newspaper Group Name.." required="required" class="form-control" name="name" id="name" value="<?php echo $newspaper_group->ng_name?>">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Address</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Address" class="form-control" name="address" id="address" value="<?php echo $newspaper_group->ng_address?>">
						</div>
					</div>
					<div class="form-group">
						<label for="example-select" class="col-md-3 control-label">Select State</label>
						<div class="col-md-9">
							<select name="state" class="states form-control" id="stateId" required>
								<option value="">Select State</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="example-select" class="col-md-3 control-label">Select City</label>
						<div class="col-md-9">
							<select name="city" class="cities form-control" id="cityId" required>
								<option value="">Select City</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Phone No.</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Mobile No." class="form-control" name="mobile" id="mobile" value="<?php echo $newspaper_group->ng_phone?>">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Email</label>
						<div class="col-md-9">
							<input type="email" placeholder="Enter Email.." required="required" class="form-control" name="email" id="email" value="<?php echo $newspaper_group->ng_email?>">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Fax No.</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Fax No.." class="form-control" name="fax" id="fax" value="<?php echo $newspaper_group->ng_fax?>">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Opening</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="opening" id="opening" value="<?php echo $newspaper_group->ng_opening?>">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Contact Person</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Contact Person Name.." class="form-control" name="c_p" id="c_p" value="<?php echo $newspaper_group->ng_contact_parson?>">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">No. of Additions</label>
						<div class="col-md-9">
							<input type="number" placeholder="Enter addition No.." class="form-control" name="addition" id="addition" value="<?php echo $newspaper_group->ng_no_of_additions?>">
						</div>
					</div>
					<!--<div class="form-group">
						<label class="col-md-3 control-label">FM</label>
						<div class="col-md-9">
							<label class="switch switch-primary">
								<input type="checkbox" <?php// echo ($newspaper_group->ng_fm=='1')?'checked':'unchecked';?> name="fm" id="fm">
								<span></span>
							</label>
						</div>
					</div>-->
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