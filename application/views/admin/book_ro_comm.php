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
						<strong>Publication</strong> Commission
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open('admin/book_ads/commission/'.$ro[0]->id, $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
					
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Ro Amount</label>
						<div class="col-md-9">
							<input type="text" required="required" class="form-control" value="<?php echo $ro[0]->ad_cost;?>" name="ro_a" id="ro_a" readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Commission %</label>
						<div class="col-md-1">
							<input type="text" placeholder="0" class="form-control" name="comm1" id="comm1">
						</div>
						<div class="col-md-1">
							<h4>  +   </h4>
						</div>
						<div class="col-md-1">
							<input type="text" placeholder="0" class="form-control" name="comm2" id="comm2">
						</div>
						<div class="col-md-1">
							<h4>  +   </h4>
						</div>
						<div class="col-md-1">
							<input type="text" placeholder="0" class="form-control" name="comm3" id="comm3">
						</div>
						<div class="col-md-1">
							<h4>  +   </h4>
						</div>
						<div class="col-md-1">
							<input type="text" placeholder="0" class="form-control" name="comm4" id="comm4">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label"></label>
						<div class="col-md-1">
							<input type="text" placeholder="0" class="form-control" name="comm5" id="comm5">
						</div>
						<div class="col-md-1">
							<h4>  +   </h4>
						</div>
						<div class="col-md-1">
							<input type="text" placeholder="0" class="form-control" name="comm6" id="comm6">
						</div>
						<div class="col-md-1">
							<h4>  +   </h4>
						</div>
						<div class="col-md-1">
							<input type="text" placeholder="0" class="form-control" name="comm7" id="comm7">
						</div>
						<div class="col-md-1">
							<h4>  +   </h4>
						</div>
						<div class="col-md-1">
							<input type="text" placeholder="0" class="form-control" name="comm8" id="comm8">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Tax</label>
                        <div class="col-md-9">
							<select id="tax" name="tax" class="select-chosen" data-placeholder="Choose Tax" style="width: 250px;">
								<?php foreach($taxs as $tax){ ?>
                                        <option value="<?php echo $tax->tax_rate; ?>"><?php echo $tax->tax_rate ." % ".$tax->tax; ?></option>
								<?php }?>
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