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
						<strong>Revise ads</strong> Rate
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'r_rate-newspaper');
					echo form_open('admin/r_rate/revise/'.$ad_price->id, $attributes)
					?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
				<div class="col-lg-6">					
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Newspaper</label>
						<div class="col-md-9">
							<input type="text" value="<?php echo $s_newspaper;?>" class="form-control"  onchange="get_heading();" name="newspaper" id="newspaper" readonly required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Publication  City</label>
                        <div class="col-md-9">
							<input type="text" value="<?php echo $city_name->name; ?>"   class="form-control" name="city" id="city" readonly required>
                        </div>
                    </div>
				<div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Ad Heading</label>
                        <div class="col-md-9">
                            <select id="ad_cat" name="ad_cat[]" class="select-chosen" data-placeholder="Choose Heading" style="width: 250px;" multiple required>

                            </select>
                        </div>
                    </div>
				<!--	<div class="form-group">
						<label for="price" class="col-md-3 control-label">Ad Heading</label>
						<div class="col-md-9">
							<input type="text" value="<?php echo $cat_name->name;?>" class="form-control" name="ad_cat" id="ad_cat" readonly required>
						</div>
					</div>-->
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Insertion From</label>
						<div class="col-md-9">
							<input type="number"  onkeyup="inse_to();"  onchange="inse_to();" placeholder=""  min="1"  value="<?php echo $ad_price->ins_from?>" class="form-control" name="ins_from" id="ins_from" readonly required>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Insertion To</label>
						<div class="col-md-9">
							<input type="number" placeholder="" class="form-control" min="2" name="ins_to" id="ins_to" value="<?php echo $ad_price->ins_to?>" readonly required>
						</div>
					</div>
					
					<?php
						$days1=explode(",",$ad_price->day_id);
					?>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Ad Day</label>
                        <div class="col-md-9">
							<select id="day" name="days[]" class="select-chosen"  data-placeholder="Choose Ad day"  multiple required>
								<?php foreach($days as $day){ ?>
                                        <option value="<?php echo $day->id; ?>" 
										<?php
										foreach($days1 as $day1)
											echo ($day->id==$day1)?'selected':'';
										?>										
										><?php echo $day->day; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					
				<!--	<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Color Type</label>
                        <div class="col-md-9">
							<select id="color" name="color" class="form-control" data-placeholder="" required>
								<option value="">Choose one</option>
								<option value="A">Any Color</option>
								<option value="B">Black/White</option>
								<option value="C">Color</option>
                            </select>
                        </div>
                    </div>-->					
					<?php /*
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Duration</label>
						<div class="col-md-4">
							<input type="text" placeholder="" class="form-control" name="duration" value="<?php echo $ad_price->duration?>" id="duration">
						</div>
						<div class="col-md-5">
							<select id="dur_type" name="dur_type" class="form-control" data-placeholder="" style="width: 250px;" >
								<option value="D" <?php echo ('D'==$ad_price->duration_type)?'selected':'';?>>Days</option>
								<option value="W" <?php echo ('W'==$ad_price->duration_type)?'selected':'';?>>Weeks</option>
								<option value="M" <?php echo ('M'==$ad_price->duration_type)?'selected':'';?>>Months</option>
								<option value="Y" <?php echo ('Y'==$ad_price->duration_type)?'selected':'';?> >Years</option>
                            </select>
                        </div>
					</div>
				 */?>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Minimum Unit</label>
						<div class="col-md-3">
							<input type="text" placeholder="" class="form-control" name="min_w" id="min_w" value="<?php echo $ad_price->min_w?>" required>
						</div>
						<label for="price" class="col-md-3 control-label">Maximum Unit</label>
						<div class="col-md-3">
							<input type="text"  value="<?php echo $ad_price->max_w?>"placeholder="" class="form-control" name="max_w" id="max_w" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Unit Type</label>
                        <div class="col-md-9">
							<select id="unit" name="unit" class="form-control" data-placeholder="" required>
								<option value="">Choose one</option>
								<option value="W" <?php echo ('W'==$ad_price->unit)?'selected':'';?>>Word</option>
								<option value="L" <?php echo ('L'==$ad_price->unit)?'selected':'';?>>Line</option>
                            </select>
                        </div>
                    </div>
				</div>
				<div class="col-lg-6">
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
						<label for="price" class="col-md-3 control-label">Date From</label>
                        <div class="col-md-9">
                            <input type="text" id="date_f" name="date_f" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy" required>
                        </div>
                    </div>
					<!--<div class="form-group">
						<label for="price" class="col-md-3 control-label">Date To</label>
                        <div class="col-md-9">
                            <input type="text" id="date_t" name="date_t" value="<?php //echo $ad_price->date_to?>" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
                        </div>
                    </div>-->
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Price</label>
						<div class="col-md-9">
							<input type="text" placeholder="" value="<?php echo $ad_price->ad_price?>" class="form-control" name="price" id="price" required>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Extra Price</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="eprice" id="eprice" value="<?php echo $ad_price->extra_price?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Discount</label>
						<div class="col-md-9">
							<input type="text" placeholder="" value="<?php echo $ad_price->discount?>" class="form-control" name="dis" id="dis" >
						</div>
					</div>
					<div class="form-group">
                        <label for="price" class="col-md-3 control-label">Multiple Ex Rate</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" class="form-control" name="mer" id="mer" value="<?php echo $ad_price->mul_ex?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Multiple Rate</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" class="form-control" name="mr" id="mr" value="<?php echo $ad_price->mul_rate?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Multiple</label>
                        <div class="col-md-9">
                            <select id="mul" name="mul" class="form-control" data-placeholder="Choose Ad Page">
                                <option value="">Choose One</option>
                                <option value="1" <?php if($ad_price->mul == '1') echo 'selected="selected"'; echo set_select('mul', '1'); ?>>ADD</option>
                                <option value="2" <?php if($ad_price->mul == '2') echo 'selected="selected"';echo set_select('mul', '2'); ?>>Multiple</option>
                            </select>
                        </div>
                    </div>
					<?php 
						$non_fc=explode(",",$ad_price->non_focus_charge);
					?>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Non Focus Day Charges</label>
						<div class="col-md-5">
							<input type="number" step="any" min="0" placeholder="" class="form-control" value="<?php echo $non_fc[0]?>" name="nfdc" id="nfdc" >
						</div>
						<div class="col-md-4">
							<select id="nfdct" name="nfdct" class="form-control" data-placeholder="" style="width: 250px;" >
								<option value="%" <?php echo ('%'==$non_fc[1])?'selected':'';?>>%</option>
								<option value="Rs" <?php echo ('Rs'==$non_fc[1])?'selected':'';?>>Rs.</option>
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
				</div>
				</form>
					<!-- END General Data Content -->
			</div>
			<!-- END General Data Block -->
		</div>
	<!-- END Product Edit Content -->
</div>

<script type="text/javascript">
function inse_to()
{
	var ins_f = parseInt($("#ins_from").val());
	document.getElementById("ins_to").value = ins_f;
	document.getElementById("ins_to").min = ins_f;
}


function get_heading()
{
	var newspaper = <?php echo $newspaper_id;?>;
	
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/r_rate/get_heading",
			type: "POST",				
			async: true ,               
			data: {id:newspaper},
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{
					 document.getElementById("loader").style.display = "none";
					$('#ad_cat').empty();
					
					if(data=="[]")
					{
						alert("First attach heading with newspaper.");
					}
					
					$('#ad_cat').append('<option value="">Choose One</option>');
					// Parse the returned json data
					var opts = $.parseJSON(data);
					// Use jQuery's each to iterate over the opts value
					$.each(opts, function(i, d) {
					   
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
                    $('#ad_cat').append('<option value="' + d.cat_id + '">' + d.cat_name + '</option>');
					});	
					
					$("#ad_cat option[value='<?php echo $ad_price->ad_cat_id; ?>']").attr("selected", true);
					
				},                
		complete: function ()
                {
                    sel_update();
                },
                error: function ()
                {
                    document.getElementById("loader").style.display = "none";
                    alert("Please Select Newspaper!");
                }
            });
            //setTimeout(sel_update, 500);
        }

 function sel_update()
        {
            $("#ad_cat").trigger("chosen:updated");
            document.getElementById("loader").style.display = "none";
        }
$(document).ready(function (){ get_heading(); });


$("#date_f").datepicker({
  minDate: 0,
  /*onSelect: function(date) {
    $("#date_t").datepicker('option', 'minDate', date);
  }*/
});

//$("#date_t").datepicker({});


</script>