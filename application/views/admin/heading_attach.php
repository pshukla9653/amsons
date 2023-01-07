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
						<strong>Attach Heading with Newspaper</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open('admin/heading/add', $attributes)
					?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
				
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper</label>
                        <div class="col-md-9">
							<select id="newspaper" name="newspaper" class="form-control" data-placeholder="Choose Newspaper" required>
							<option value="">Choose Newspaper</option>
							<?php foreach($newspapers as $newspaper){ ?>
                                   <option value="<?php echo $newspaper->id; ?>"><?php echo $newspaper->name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>									
				
				
					<!--<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Fixed Rate</label>
                        <div class="col-md-9">
							<select id="fix" name="fix" class="select-chosen" data-placeholder="" style="width: 250px;" >
								<option value="">Choose one</option>
								<option value="1">Fixed Rate</option>
                            </select>
                        </div>
                    </div>-->
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Ad Heading</label>
                        <div class="col-md-9">
							<select id="ad_cat" name="ad_cat[]" class="select-chosen" data-placeholder="Choose Heading" multiple required>
								<?php foreach($cats as $cat){ ?>
                                        <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>					
					<div class="form-group">
						<div class="col-md-9 col-md-offset-3">
							<button class="btn btn-sm btn-primary" type="submit">
								<i class="fa fa-floppy-o"></i> Save
							</button>
							<button class="btn btn-sm btn-warning" type="reset">
								<i class="fa fa-repeat"></i> Reset
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