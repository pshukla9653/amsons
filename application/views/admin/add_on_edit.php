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
						<strong>Edit Add On</strong>
						<script  type="text/javascript">
							if(<?php echo ($this->session->flashdata('msg')!=null)?'1':'0'?>)
							{
								alert("<?php echo $this->session->flashdata('msg')?>");
							}
						</script>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/add_on/edit/'.$add_on->id, $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
				<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper Group</label>
                        <div class="col-md-9">
							<select id="newspaper_group" name="newspaper_group" onchange="get_a_newspaper();" class="form-control" data-placeholder="Choose Newspaper Group" required>
									<option value="">Choose One</option>
								<?php foreach($news_groups as $news_group){ ?>
                                        <option value="<?php echo $news_group->ng_id; ?>"<?php if($add_on->g_id==$news_group->ng_id)echo "selected";?>><?php echo $news_group->ng_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>					
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper</label>
                        <div class="col-md-9">
							<select id="m_newspaper" name="m_newspaper"  onchange="get_a_newspaper();" class="form-control" data-placeholder="Choose Newspaper">
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Add On Newspapers</label>\
						
						
						
						
						
						
                        <div class="col-md-9">
							<select id="a_newspaper" name="a_newspaper" class="form-control"  data-placeholder="Choose Newspapers"  required>
								
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Heading</label>
                        <div class="col-md-9">
							<select id="ad_cat" name="ad_cat" class="select-chosen" data-placeholder="Choose Heading" style="width: 250px;" required>
								<?php foreach($cats as $cat){ ?>
                                        <option value="<?php echo $cat->id; ?>" <?php if($add_on->ad_cat_id==$cat->id)echo "selected";?>><?php echo $cat->name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
                    <?php
						$days1=explode(",",$add_on->day_id);
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
                    <div class="form-group">
                        <label class="col-md-3 control-label">Select All Days</label>
                        <div class="col-md-3">
                            <label class="switch switch-primary">
                                <input type="checkbox"  name="all_day" id="all_day">
                                <span></span>
                            </label>
                        </div>                      
                    </div>					
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Insertion From</label>
						<div class="col-md-9">
							<input type="number" value="<?php echo $add_on->ins_from;?>"  onkeyup="inse_to();"  onchange="inse_to();" placeholder=""  min="1" class="form-control" name="ins_from" id="ins_from" required>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Insertion To</label>
						<div class="col-md-9">
							<input type="number" placeholder=""  value="<?php echo $add_on->ins_to;?>"  class="form-control" min="1" name="ins_to" id="ins_to" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Add/Multiple</label>
                        <div class="col-md-9">
							<select id="mul" name="mul" class="form-control" data-placeholder="Choose Ad Page" required>
								<option value="A" <?php echo ('A'==$add_on->add_mul)?'selected':'';?>>ADD</option>
								<option value="M" <?php echo ('M'==$add_on->add_mul)?'selected':'';?>>Multiple</option>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Minimum Unit</label>
						<div class="col-md-3">
							<input type="text" placeholder="" class="form-control" name="f_unit" id="f_unit" value="<?php echo $add_on->f_unit;?>" required>
						</div>
						<label for="price" class="col-md-3 control-label">Maximum Unit</label>
						<div class="col-md-3">
							<input type="text" placeholder="" value="<?php echo $add_on->t_unit;?>" class="form-control" name="t_unit" id="t_unit" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Unit Type</label>
                        <div class="col-md-9">
							<select id="unit" name="unit" class="form-control" data-placeholder="" required>
								<option value="">Choose one</option>
								<option value="W" <?php echo ('W'==$add_on->unit)?'selected':'';?>>Word</option>
								<option value="L" <?php echo ('L'==$add_on->unit)?'selected':'';?>>Line</option>
                            </select>
                        </div>
                    </div>
                    	<div class="form-group">
						<label for="price" class="col-md-3 control-label">Date From</label>
                        <div class="col-md-9">
                            <input type="text" id="date_from" name="date_from" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy" value="<?php echo $add_on->date_from;?>" required>
                        </div>
                        	<div class="form-group">
					<!--	<label for="price" class="col-md-3 control-label">Date to</label>
                        <div class="col-md-9">
                            <input type="text" id="date_to" name="date_to" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy" value="<?php echo $add_on->date_to;?>" required>
                        </div>-->
                    </div>
                    </div>
                    
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Price</label>
						<div class="col-md-9">
							<input type="text" placeholder="" value="<?php echo $add_on->price;?>" class="form-control" name="price" id="price" required>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Extra Price</label>
						<div class="col-md-9">
							<input type="text" placeholder="" value="<?php echo $add_on->e_price;?>" class="form-control" name="eprice" id="eprice" required>
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


function get_m_newspaper()
{
	var  news_g= $("#newspaper_group").val();	
	$.ajax({
			url: "<?php echo base_url(); ?>" + "admin/cd_add_on/get_newspaper",
			type: "POST",				
			async: true ,               
			data: {'news_g':news_g},
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{					 
					$('#m_newspaper').empty();
					$('#m_newspaper').append('<option value="">Select One</option>');
					// Parse the returned json data
					var opts = $.parseJSON(data);
					// Use jQuery's each to iterate over the opts value
					$.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
                    $('#m_newspaper').append('<option value="' + d.id + '">' + d.newspaper_name + ' '+ d.city_name +'</option>');
										
					});
					
					$("#m_newspaper option[value='<?php echo $add_on->m_paper_id; ?>']").attr("selected", true);
					
				},                
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Please Select Newspaper Group!");
					}
			});
	document.getElementById("loader").style.display = "none";
	//get_a_newspaper();
}

function get_a_newspaper()
{
	var  news_g= $("#newspaper_group").val();
	var  m_news= $("#m_newspaper").val();
	if(m_news=="")
	{
		alert("Please Select Newspaper First!");
		$('#a_newspaper').empty();
		//setTimeout(sel_update, 500);	
		return false;
	}
	
	$.ajax({
			url: "<?php echo base_url(); ?>" + "admin/cd_add_on/get_add_newspaper",
			type: "POST",
			async: true ,
			data: {'news_g':news_g},
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{
					var  m_paper= $("#m_newspaper").val();
					
					$('#a_newspaper').empty();					
					// Parse the returned json data
					var opts = $.parseJSON(data);
					// Use jQuery's each to iterate over the opts value
					$.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data	
						if(d.id != m_paper)
						{
							$('#a_newspaper').append('<option value="' + d.id + '">' + d.newspaper_name + ' '+ d.city_name +'</option>');
						}
						
					});
					
					$("#a_newspaper option[value='<?php echo $add_on->a_paper_id; ?>']").attr("selected", true);
					
				},
			complete: function() 
					{                    
						document.getElementById("loader").style.display = "none";
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
	//setTimeout(sel_update, 500);	
}


function sel_update()
{
	$("#a_newspaper").trigger("chosen:updated");
	document.getElementById("loader").style.display = "none";
}

$(document).ready(function (){ get_m_newspaper(); get_a_newspaper();});


$('#all_day').click(function()
{
    if ($('#all_day').is(":checked"))
    {
        $('#day option').prop('selected', true);  
        $('#day').trigger('chosen:updated');
    }
    else
    {
        $('#day option').prop('selected', false);  
        $('#day').trigger('chosen:updated');
    }


});
</script>
