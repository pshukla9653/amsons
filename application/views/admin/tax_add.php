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
						<strong>Add New</strong> Tax
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/tax/add', $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>

					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Tax Name</label>
                        <div class="col-md-9">
													<input type="text" placeholder="EnterTax Name" class="form-control" name="title" id="title">
                        </div>
                    </div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Tax Rate %</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Tax Rate %." class="form-control" name="tax_rate" id="tax_rate">
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Date From</label>
                        <div class="col-md-9">
                            <input type="text" id="df" name="df" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
                        </div>
                    </div>

					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Date To</label>
						<div class="col-md-9">
							<input type="text" id="dt" name="dt" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
						</div>
					</div>
					
				<div class="form-group">
					<label for="price" class="col-md-3 control-label">Tax type</label>
					<div class="col-md-9">
						<select class="form-control" name="tax_type" require>	
							<option value="newspaper">Newspaper</option>
							<option value="fm">FM</option>
							<option value="magazine">Magazine</option>
							<option value="cimema">Cinema</option>
							<option value="outdoor">Outdoor</option>
							<option value="online">Online</option>					
						</select>
						</div>
					</div>
					
					
				<div class="form-group">
					<label for="price" class="col-md-3 control-label">Tax Depend</label>
					<div class="col-md-9">
							<select class="form-control" name="tax_depned">
							    <?php
							    
							    if($tax_type) {
							        foreach($tax_type as $tax_typ){
							        ?>
							     <option value="<?php echo $tax_typ->name;?>" ><?php echo $tax_typ->name;?> </option>   
							        
							        <?php 
							        
							        }
							        
							    }?>
							</select>
						</div>
					</div>

				<div class="form-group">
					<label for="price" class="col-md-3 control-label">Status</label>
					<div class="col-md-9">
							<select class="form-control" name="status">
							<option value="active">Active</option>
							<option value="inactive">Inactive</option>		
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
