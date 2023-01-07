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
						<strong>Edit</strong> Employee
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-pack');
					echo form_open_multipart('admin/employee/edit/'.$employee->e_id, $attributes); ?>
					<?php
					echo "<div class='text-danger' align='center'>";
					echo validation_errors();
					echo "</div>";
					?>
						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Name</label>
							<div class="col-md-9">
								<input type="text" placeholder="Enter Employee Name"  required="required" class="form-control" name="name" id="name" value="<?php echo (empty($employee)) ? '' : $employee->e_name ;?>">
							</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">E-mail</label>
								<div class="col-md-9">
									<input type="email" placeholder="Enter E-mail" class="form-control" name="email" id="email" value="<?php echo (empty($employee)) ? '' : $employee->e_email ;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label" for="pack-overview">Address</label>
								<div class="col-md-9">
									<textarea id="address" name="address" class="form-control"><?php echo (empty($employee)) ? '' : $employee->e_address1 ;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-md-3 control-label">City</label>
								<div class="col-md-9">
									<input type="text" placeholder="Enter City" class="form-control" name="city" id="city" value="<?php echo (empty($employee)) ? '' : $employee->e_city ;?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">State</label>
								<div class="col-md-9">
									<input type="text" placeholder="Enter State" class="form-control" name="state" id="state"  value="<?php echo (empty($employee)) ? '' : $employee->e_state ;?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Pin Code</label>
								<div class="col-md-9">
									<input type="text" placeholder="Enter Postal Code" class="form-control" name="pin" id="pin" value="<?php echo (empty($employee)) ? '' : $employee->e_pin_code ;?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Mobile</label>
								<div class="col-md-9">
									<input type="text" placeholder="Enter Mobile" class="form-control" name="mobile" id="mobile" value="<?php echo (empty($employee)) ? '' : $employee->e_phone ;?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Credit Limit</label>
								<div class="col-md-9">
									<input type="text" placeholder="Enter Credit Limit" class="form-control" name="crlimit" id="crlimit" value="<?php echo (empty($employee)) ? '' : $employee->e_cr_limit ;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label" for="example-chosen-multiple">Login Name</label>
								<div class="col-md-9">
									<select id="user" name="user" class="form-control" data-placeholder="" required>
										<option value="">Choose one</option>
										<?php 
										foreach($users as $user)
										{?>
											<option value="<?php echo $user->id; ?>" <?php echo  ($user->id==$employee->user_id)?"selected":""; ?>
									><?php echo $user->name; ?></option>
										<?php
										}
										?>										
									</select>
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Last Date</label>
								<div class="col-md-9">
									<input type="date" placeholder="" class="form-control" name="last_date" id="last_date" value="<?php echo (empty($employee)) ? '' : $employee->e_last_date ;?>">
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