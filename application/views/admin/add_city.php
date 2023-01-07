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
						<strong>Add New</strong>City
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-pack');
					echo form_open('admin/city/add_city', $attributes); ?>
					<?php
					echo "<div class='text-danger'  align='center'>";
					echo validation_errors();
					echo "</div>";
					?>
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