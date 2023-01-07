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
						<strong>Attach Scheme with Newspaper</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open('admin/cd_scheme_attach/add', $attributes)
					?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
				
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper <span class="text-danger">*</span></label>
                        <div class="col-md-9">
							<select id="newspaper" name="newspaper" style="width:100%" class="js-example-basic-single" data-placeholder="Choose Newspaper" onchange="get_city();" required>							
								<option value="">Choose One </option>
								<?php foreach($newspapers as $newspaper){ ?>
                                        <option value="<?php echo $newspaper->id; ?>"><?php echo $newspaper->newspaper_name .",".$newspaper->city_name; ?></option>
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
						<label class="col-md-3 control-label" for="example-chosen-multiple">Ad Day</label>
                        <div class="col-md-9">
							<select id="day" name="days[]" class="select-chosen"  data-placeholder="Choose Ad day"  multiple required>
								<?php foreach($days as $day){ ?>
                                        <option value="<?php echo $day->id; ?>" <?php echo  set_select('days[]', $day->id); ?>><?php echo $day->day; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Schemes</label>
                        <div class="col-md-9">
							<select id="schemes" name="schemes[]" class="select-chosen"  data-placeholder="Choose Schemes"  multiple required>
								<?php foreach($schemes as $scheme){ ?>
                                        <option value="<?php echo $scheme->scheme_id; ?>" <?php echo  set_select('scheme[]', $scheme->scheme_id); ?>><?php echo $scheme->scheme_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Duration</label>
						<div class="col-md-2">
							<input type="number" placeholder="" class="form-control" name="duration" id="duration" value="<?php echo set_value('duration'); ?>">
						</div>
						<div class="col-md-2">
							<select id="dur_type" name="dur_type" class="form-control" data-placeholder="" style="width: 250px;" >
								<option value="D" <?php echo  set_select('dur_type', 'D'); ?>>Days</option>
								<option value="W" <?php echo  set_select('dur_type', 'W'); ?>>Weeks</option>
								<option value="M" <?php echo  set_select('dur_type', 'M'); ?>>Months</option>
								<option value="Y" <?php echo  set_select('dur_type', 'Y'); ?>>Years</option>
                            </select>
                        </div>
					
						<label for="price" class="col-md-2 control-label">Discount</label>
						<div class="col-md-2">
							<input type="text" placeholder="1.0" step="0.01" min="0" max="10" class="form-control" name="dis" id="dis" value="">
						</div>
						<div class="col-md-1">
							<select id="dis_type" name="dis_type" class="form-control" data-placeholder="" style="width: 250px;" >
								<option value="Rs" <?php echo  set_select('nfdct', 'Rs'); ?>>Rs.</option>
								<option value="%" <?php echo  set_select('nfdct', '%'); ?>>%</option>
                            </select>
                        </div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Date From</label>
                        <div class="col-md-9">
                            <input type="text" id="date_f" name="date_f" value="<?php echo set_value('date_f'); ?>" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
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
<script>
 $(document).ready(function (){
        
    $('.js-example-basic-single').select2();
                    });
$("#date_f").datepicker({
  minDate: 0,
  onSelect: function(date) {
    $("#date_t").datepicker('option', 'minDate', date);
  }
});

</script>