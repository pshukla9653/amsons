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
						<strong>Revise ads</strong> Price
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open('admin/cd_r_rate/revise/'.$ad_price->id, $attributes)
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
							<input type="text" value="<?php echo $s_newspaper;?>" class="form-control" name="newspaper" id="newspaper" readonly required>
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
					</div>	-->				
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
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Duration</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="duration" value="<?php echo $ad_price->duration?>" id="duration" readonly>
						</div>
						
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Size</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" value="<?php echo $ad_price->f_size?>" name="size" id="size" readonly>
						</div>						
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Color Type</label>
                        <div class="col-md-9">
							<select id="color" name="color" class="form-control" data-placeholder="" required>
								<option value="">Choose one</option>
								<option value="A" <?php echo ('A'==$ad_price->color_type)?'selected':'';?>>Any Color</option>
								<option value="B" <?php echo ('B'==$ad_price->color_type)?'selected':'';?>>Black/White</option>
								<option value="C" <?php echo ('C'==$ad_price->color_type)?'selected':'';?>>Color</option>
                            </select>
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
                            <input type="text" id="date_f" name="date_f" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label">Fix Price</label>
						<div class="col-md-3">
							<label class="switch switch-primary">
								<input type="checkbox" onchange="fix_s();" <?php echo($ad_price->size_type=='F')?"checked":"unchecked";?> name="fix_p" id="fix_p">
								<span></span>
							</label>
						</div>
						<div id="dc_b">
							<label class="col-md-3 control-label">Double Column</label>
							<div class="col-md-3">
								<label class="switch switch-primary">
									<input type="checkbox" onchange="double_column();" <?php echo($ad_price->size_type=='D')?"checked":"unchecked";?> name="dc" id="dc">
									<span></span>
								</label>
							</div>
						</div>
					</div>
					<div id="fix_s" style="display: none;">
						<div class="form-group">
							<label for="price" class="col-md-3 control-label">Fix Size</label>
							<div class="col-md-3">
								<input type="text" placeholder="" class="form-control" name="f_min_l" id="f_min_l" value="<?php echo $ad_price->f_min_l?>">
							</div>
							<div class="col-md-1 control-label">
								X
							</div>
							<div class="col-md-3">
								<input type="text" placeholder="" class="form-control" name="f_min_r" id="f_min_r" value="<?php echo $ad_price->f_min_r?>">
							</div>
						</div>						
					</div>
					<div id="single_c">
						<div class="form-group">
							<label for="price" class="col-md-3 control-label">Single Column</label>
							<div class="col-md-2 control-label">
								MIN
							</div>
							<div class="col-md-3">
								<input type="text" placeholder="" class="form-control" name="s_min_l" id="s_min_l" value="<?php echo $ad_price->s_min_l?>">
							</div>
							<div class="col-md-1 control-label">
								X
							</div>
							<div class="col-md-3">
								<input type="text" placeholder="" class="form-control" name="s_min_r" id="s_min_r" value="<?php echo $ad_price->s_min_r?>">
							</div>
						</div>					
						<div class="form-group">
							<label for="price" class="col-md-3 control-label"></label>
							<div class="col-md-2 control-label">
								Max
							</div>
							<div class="col-md-3">
								<input type="text" placeholder="" class="form-control" name="s_max_l" id="s_max_l" value="<?php echo $ad_price->s_max_l?>">
							</div>
							<div class="col-md-1 control-label">
								X
							</div>
							<div class="col-md-3">
								<input type="text" placeholder="" class="form-control" name="s_max_r" id="s_max_r" value="<?php echo $ad_price->s_max_r?>">
							</div>
						</div>
					</div>
					<div  id="double_c" style="display: none;">
						<div id="double_c" class="form-group">
							<label for="price" class="col-md-3 control-label">Double Column</label>
							<div class="col-md-2 control-label">
								MIN
							</div>
							<div class="col-md-3">
								<input type="text" placeholder="" class="form-control" name="d_min_l" id="d_min_l" value="<?php echo $ad_price->d_min_l?>">
							</div>
							<div class="col-md-1 control-label">
								X
							</div>
							<div class="col-md-3">
								<input type="text" placeholder="" class="form-control" name="d_min_r" id="d_min_r" value="<?php echo $ad_price->d_min_r?>">
							</div>
						</div>
						<div class="form-group">
							<label for="price" class="col-md-3 control-label"></label>
							<div class="col-md-2 control-label">
								Max
							</div>
							<div class="col-md-3">
								<input type="text" placeholder="" class="form-control" name="d_max_l" id="d_max_l" value="<?php echo $ad_price->d_max_l?>">
							</div>
							<div class="col-md-1 control-label">
								X
							</div>
							<div class="col-md-3">
								<input type="text" placeholder="" class="form-control" name="d_max_r" id="d_max_r" value="<?php echo $ad_price->d_max_r?>">
							</div>
						</div>
					</div>					
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Unit Type</label>
                        <div class="col-md-9">
							<select id="unit" name="unit" class="form-control" data-placeholder="" required>
								<option value="">Choose one</option>
								<option value="SC" <?php echo ('SC'==$ad_price->unit)?'selected':'';?>>SQCM</option>
								<option value="CC" <?php echo ('CC'==$ad_price->unit)?'selected':'';?>>PCC</option>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Price</label>
						<div class="col-md-9">
							<input type="text" placeholder="" value="<?php echo $ad_price->ad_price?>" class="form-control" name="price" id="price" required>
						</div>
					</div>
					<!--<div class="form-group">
						<label for="price" class="col-md-3 control-label">Extra Price</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="eprice" id="eprice" required>
						</div>
					</div>-->
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Discount</label>
						<div class="col-md-9">
							<input type="text" placeholder="" value="<?php echo $ad_price->discount?>" class="form-control" name="dis" id="dis" >
						</div>
					</div>
				<!--	<div class="form-group">
						<label for="price" class="col-md-3 control-label">Multiple Ex Rate</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="mer" id="mer" >
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Multiple Rate</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="mr" id="mr" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Multiple</label>
                        <div class="col-md-9">
							<select id="mul" name="mul" class="form-control" data-placeholder="Choose Ad Page">
								<option value="">Choose One</option>
								<option value="1">ADD</option>
								<option value="2">Multiple</option>
                            </select>
                        </div>
                    </div>-->
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Non Focus Day Charges</label>
						<div class="col-md-5">
							<input type="text" step="any" min="0" placeholder="" class="form-control" name="nfdc" id="nfdc" value="<?php echo set_value('nfdc'); ?>">
						</div>
						<div class="col-md-4">
							<select id="nfdct" name="nfdct" class="form-control" data-placeholder="" style="width: 250px;" >								
								<option value="Rs" <?php echo  set_select('nfdct', 'Rs'); ?>>Rs.</option>
								<option value="%" <?php echo  set_select('nfdct', '%'); ?>>%</option>
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
			url: "<?php echo base_url(); ?>" + "admin/Cd_r_rate/get_heading",
			type: "POST",				
			async: true ,               
			data: {id:newspaper},
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{
					
					$('#ad_cat').empty();
					
					if(data=="[]")
					{
						alert("First attach heading with newspaper.");
					}
					
					//$('#ad_cat').append('<option value="">Choose One</option>');
					// Parse the returned json data
					var opts = $.parseJSON(data);
					// Use jQuery's each to iterate over the opts value
					$.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
                    $('#ad_cat').append('<option value="' + d.cat_id + '" >' + d.cat_name + '</option>');
					});	
						$("#ad_cat option[value='<?php echo $cat_name->id; ?>']").attr("selected", true);
				},                
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Please Select Newspaper!");
					}
			});
	setTimeout(sel_update, 500);
}
 

function get_city1()
{
	//alert("Please Select Newspaper!");
	var newspaper = $("#newspaper").val();
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/price/get_city",
			type: "POST",				
			async: true ,               
			data: {newspaper_id:newspaper},
			success: function(data)
				{
					$('#city').empty();
					// Parse the returned json data
					var opts = $.parseJSON(data);
					// Use jQuery's each to iterate over the opts value
					$.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                    $('#city').append('<option value="' + d + '">' + d + '</option>');
					});
				},                
			error: function() 
					{                    
						alert("Please Select Newspaper!");
					}
			});
			
}

function fix_s()
{
	
	var x = document.getElementById('double_c');
	var y = document.getElementById('single_c');
	var z = document.getElementById('fix_s');
	var dc_b= document.getElementById('dc_b');
	
    if ($('#fix_p').is(":checked")) 
	{
		$('#dc').prop('checked', false);
		
        z.style.display = 'block';
		x.style.display = 'none';
		y.style.display = 'none';
		dc_b.style.display = 'none';
    } 
	else 
	{
        z.style.display = 'none';
		double_column();
		y.style.display = 'block';
		dc_b.style.display = 'block';
    }
}

$(document).ready(function (){ get_heading(); });


function double_column()
{
	var dc = $("#dc").val();
	
	//alert(dc);
	dc=0;
	var x = document.getElementById('double_c');
    if ($('#dc').is(":checked")) 
	{
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}
	
function sel_update()
{	
	$("#ad_cat").trigger("chosen:updated");
	document.getElementById("loader").style.display = "none";
}

$("#date_f").datepicker({
  minDate: 0,
  onSelect: function(date) {
    $("#date_t").datepicker('option', 'minDate', date);
  }
});

$(document).ready(function (){ get_heading();  double_column(); fix_s();});

</script>