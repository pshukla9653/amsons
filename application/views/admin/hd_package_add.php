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
						<strong>Add HD Package</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/hd_package/add', $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Package Name</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="p_title" id="p_title" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper Group</label>
                        <div class="col-md-9">
							<select id="newspaper_group" name="newspaper_group" onchange="get_newspaper();" class="select-chosen" data-placeholder="Choose Newspaper Group" required>
									<option value="">Choose One</option>
								<?php foreach($news_groups as $news_group){ ?>
                                        <option value="<?php echo $news_group->ng_id; ?>"><?php echo $news_group->ng_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper</label>
                        <div class="col-md-9">
							<select id="newspaper" name="newspaper[]" class="select-chosen" data-placeholder="Choose Newspaper" multiple required>
                            </select>
                        </div>
                    </div>					
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Ad Heading</label>
                        <div class="col-md-9">
							<select id="ad_cat" name="ad_cat[]" class="select-chosen" data-placeholder="Choose Heading" style="width: 250px;" multiple required>
								<?php foreach($cats as $cat){ ?>
                                        <option value="<?php echo $cat->id; ?>"><?php echo $cat->position; ?></option>
								<?php }?>								
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Insertion From</label>
						<div class="col-md-9">
							<input type="number"  onkeyup="inse_to();"  onchange="inse_to();" placeholder=""  min="1" class="form-control" name="ins_from" id="ins_from" required>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Insertion To</label>
						<div class="col-md-9">
							<input type="number" placeholder="" class="form-control" min="1" name="ins_to" id="ins_to" required>
						</div>
					</div>
					<div class="form-group">
                        <label for="price" class="col-md-3 control-label">Date From</label>
                        <div class="col-md-9">
                            <input type="text" id="date_f" name="date_f" value="<?php echo set_value('date_f'); ?>" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Rate For Minimum</label>
						<div class="col-md-9">
							<input type="text" placeholder="" value="0" class="form-control" name="rate" id="rate" required>
						</div>						
					</div>					
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Discount %</label>
						<div class="col-md-9">
							<input type="text" placeholder="" value="0" class="form-control" name="dis" id="dis">
						</div>						
					</div>
					<div class="form-group form-actions">
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

function inse_to()
{
	var ins_f = parseInt($("#ins_from").val());
	document.getElementById("ins_to").value =ins_f;
	document.getElementById("ins_to").min =ins_f;
}


function get_newspaper()
{
	var  news_g= $("#newspaper_group").val();	
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/hd_package/get_newspaper",
			type: "POST",				
			async: true ,               
			data: {'news_g':news_g},
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{					 
					$('#newspaper').empty();					
					// Parse the returned json data
					var opts = $.parseJSON(data);
					// Use jQuery's each to iterate over the opts value
					$.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
                    $('#newspaper').append('<option value="' + d.id + '">' + d.newspaper_name + ' , '+ d.city_name +'</option>');
										
					});	
					
				},
			complete: function() 
					{                    
						sel_update();
					},
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Please Select Newspaper Group!");
					}
			});
	//$("#newspaper").chosen("destroy");
	//$("#newspaper").chosen();
	//$("#newspaper").trigger("chosen:updated");
	//setTimeout(sel_update, 2000);	
}

function sel_update()
{	
	$("#newspaper").trigger("chosen:updated");
	document.getElementById("loader").style.display = "none";
}

$(document).ready(function(){
     $("#date_f").datepicker();
});

 // $("#date_f").datepicker({minDate: 0});
	 //  $("#date_f").datepicker();
</script>
