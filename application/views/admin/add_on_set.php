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
						<strong>Set Price of Add On</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/add_on/set', $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
					
					<input type="hidden" name="count" value="<?php echo $count;?>">
					<input type="hidden" name="m_newspaper" value="<?php echo $m_newspapers;?>">
					<input type="hidden" name="add_on_id" value="<?php echo $add_on_id;?>">
					
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Main Paper Price</label>
						<div class="col-md-9">
							<label for="price" class="col-md-3 control-label">Price</label>
							<div class="col-md-3">
								<input type="number" placeholder=""  min="0" class="form-control" name="mp_price" id="mp_price" required>
							</div>
							<label for="price" class="col-md-3 control-label">Extra Price</label>
							<div class="col-md-3">
								<input type="number" placeholder=""  min="0" class="form-control" name="emp_price" id="emp_price" required>
							</div>
						</div>
					</div>
					
					<?php
						for($i=0;$i<$count;$i++)
						{
					?>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Price of <?php echo $newspapers[$i]->newspaper_name;?></label>
						<div class="col-md-9">
							<input type="hidden" name="paper<?php echo $i;?>" value="<?php echo $newspapers[$i]->n_id;?>">
							<label for="price" class="col-md-3 control-label">Price</label>
							<div class="col-md-3">
								<input type="number" placeholder=""  min="0" class="form-control" name="price<?php echo $i;?>" id="price" required>
							</div>
							<label for="price" class="col-md-3 control-label">Extra Price</label>
							<div class="col-md-3">
								<input type="number" placeholder=""  min="0" class="form-control" name="eprice<?php echo $i;?>" id="eprice" required>
							</div>
						</div>
					</div>
					<?php
						}
					?>
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


function get_m_newspaper()
{
	var  news_g= $("#newspaper_group").val();	
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/add_on/get_newspaper",
			type: "POST",				
			async: true ,               
			data: {'news_g':news_g},
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{					 
					$('#m_newspaper').empty();					
					// Parse the returned json data
					var opts = $.parseJSON(data);
					// Use jQuery's each to iterate over the opts value
					$.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
                    $('#m_newspaper').append('<option value="' + d.id + '">' + d.newspaper_name + ' '+ d.city_name +'</option>');
										
					});	
					
				},                
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Please Select Newspaper Group!");
					}
			});
	document.getElementById("loader").style.display = "none";
	get_a_newspaper();
}

function get_a_newspaper()
{
	var  news_g= $("#newspaper_group").val();	
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/add_on/get_add_newspaper",
			type: "POST",				
			async: true ,               
			data: {'news_g':news_g},
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{					 
					$('#a_newspaper').empty();					
					// Parse the returned json data
					var opts = $.parseJSON(data);
					// Use jQuery's each to iterate over the opts value
					$.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
                    $('#a_newspaper').append('<option value="' + d.id + '">' + d.newspaper_name + ' '+ d.city_name +'</option>');
										
					});	
					
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
	setTimeout(sel_update, 2000);	
}


function sel_update()
{
	$("#a_newspaper").trigger("chosen:updated");
	document.getElementById("loader").style.display = "none";
}
</script>
