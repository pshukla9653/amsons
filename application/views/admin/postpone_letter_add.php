<div id="page-content" style="min-height: 1189px;">
	<!-- Product Edit Content -->
	<div class="row">
	
	<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'ro_add');
					echo form_open_multipart('admin/postpone_letter/add', $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo $this->session->flashdata('msg');
					echo "</div>";
	?>
	
		<div class="col-lg-6">
			<!-- General Data Block -->
			<div class="block">
				<!-- General Data Title -->
				<div class="block-title">
					<h2>
						<i class="fa fa-pencil"></i>
						<strong>Postpone Letter</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Client<span class="text-danger">*</span></label>
                        <div class="col-md-9">
							<select id="client" name="client"  class="form-control" data-placeholder="Choose Classes" required>
								<option value="" >Select Client</option>
								<?php foreach($clients as $client){ ?>
                                        <option value="<?php echo $client->id; ?>"><?php echo $client->client_name; ?></option>
								<?php }?>
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
						<label for="price" class="col-md-3 control-label">Date To</label>
                        <div class="col-md-9">
                            <input type="text" id="date_t" name="date_t" value="<?php echo set_value('date_f'); ?>" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
					<div style="border-style: outset; height: 300px; overflow-y: scroll;">
						<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
									<thead>
										<tr role="row">
											<th class="text-center" >Ro No</th>
											<th class="text-center" style="width: 175px;" >Ro Date</th>
											<th class="text-center" style="width: 50px;" >Insertion</th>
										</tr>
									</thead>
									<tbody>
						
									</tbody>
								</table>
							</div>
						</div>					
					</div>
									
					<!--<div class="form-group">
						<label for="example-file-input" class="col-md-3 control-label">Tax</label>
						<div class="col-md-9">
							<input type="file" name="logo" size="20">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Active?</label>
						<div class="col-md-9">
							<label class="switch switch-primary">
								<input type="checkbox" checked="" name="status" id="status">
								<span></span>
							</label>
						</div>
					</div>-->
				
					<!-- END General Data Content -->
			</div>
			<!-- END General Data Block -->
		</div>
		<div class="col-lg-6">
			<!-- General Data Block -->
			
			<div class="block"  style="background-color:#dbe1e8;">
				<!-- General Data Title -->
				<div class="block-title">
					<h2>
						<i class="fa fa-pencil"></i>
						<strong>Letter</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->					
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Ro No.</label>
						<div class="col-md-3">
							<input type="text" placeholder="" class="form-control" name="ro_no" id="ro_no" readonly>
						</div>
						<label for="pack-price" class="col-md-3 control-label">Ro Date</label>
						<div class="col-md-3">
							<input type="text" placeholder="" class="form-control" name="ro_date" id="ro_date" readonly>
						</div>						
					</div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Heading</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="cat" id="cat" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Color Type</label>
                        <div class="col-md-9">
							<select id="color" name="color" class="form-control" data-placeholder="" required>
								<option value="Send By E-mail">Send By E-mail</option>
								<option value="Attached">Attached</option>
								<option value="Followed">Followed</option>
                            </select>
                        </div>
                    </div>
					<div style="border-style: outset; height: 300px; overflow-y: scroll;">
						<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">
							<div class="table-responsive">
								
							</div>
						</div>					
					</div>					
					<div class="form-group">
					<label for="example-textarea-input" class="col-md-3 control-label">Remarks To Print </label>
						<div class="col-md-9">
						<textarea placeholder="Add Remarks"   class="form-control" rows="5" name="remark" id="remark" ></textarea>		
						</div>
					</div>
					
					
					
					
					
					
					
					
					<!--<div class="form-group">
						<label for="example-file-input" class="col-md-3 control-label">Tax</label>
						<div class="col-md-9">
							<input type="file" name="logo" size="20">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Active?</label>
						<div class="col-md-9">
							<label class="switch switch-primary">
								<input type="checkbox" checked="" name="status" id="status">
								<span></span>
							</label>
						</div>
					</div>-->
					<div class="form-group">
						<div class="col-md-9 col-md-offset-3">
							
							<input class="btn btn-sm btn-primary" type="button" value="Save" onclick="save_ro();">
							<button class="btn btn-sm btn-warning" type="reset">
								<i class="fa fa-repeat"></i> Reset
							</button>							
						</div>
					</div>
					<div class="form-group">
						<div id="msg" class="col-md-9 col-md-offset-3 text-success">
							
						</div>
					</div>
				
					<!-- END General Data Content -->
			</div>  
			<!-- END General Data Block -->
		</div>
	<!-- END Product Edit Content -->
	</form>
</div>


<script>

$("#date_f").datepicker({maxDate: 0});
$("#date_t").datepicker({maxDate: 0});

$("#date_t").change(function(){
   
	var  date_1= $("#date_f").val();
	var  date_2= $("#date_t").val();
	var date1 = new Date(date_1);
	var date2 = new Date(date_2);
	//alert(date1);
	//alert(date2);
	var timeDiff = (date2.getTime() - date1.getTime());
	var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
	
	if(diffDays <= -1)
	{
		alert("Date To Must Be Greater Than or Equal to Date From.");
	
		$('#date_t').val(function() 
					{
						return this.defaultValue;
					});
	}
	else
	{
		get_ros();
	}
	
	
	
});


function get_ros()
{
	var date_1= $("#date_f").val();
	var date_2= $("#date_t").val();
	var client= $("#client").val();
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/postpone_letter/get_ros",
			type: "POST",				
			async: true ,               
			data: {'date_f':date_1,'date_t':date_2,'client':client},
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{
					document.getElementById("loader").style.display = "none";
					if(data=='1')
					{
						alert("Fill All Mandatory Felids.");
						return false;
					}
					if(data=='2')
					{
						alert("No Ro Found.");
						return false;
					}
					
					
					var tr = $.parseJSON(data);
					// Use jQuery's each to iterate over the opts value
					$.each(tr, function(i, d) 
					{
						// You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
						$("#ecom-products tbody").append('<tr onclick="select_ro('+ d.id +');"><td class="text-center"><strong>'+d.ro_no+'</strong></td><td>'+d.book_date+'</td><td class="text-center">'+d.insertion+'</td></tr>');
					});
					
				},                
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Please Select Position!");
					}
			});
}

function select_ro(id)
{
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/postpone_letter/get_ro_details",
			type: "POST",				
			async: true ,               
			data: {'ro_id':id},
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{
					document.getElementById("loader").style.display = "none";
					if(data=='1')
					{
						alert("Ro not Found.");
						return false;
					}									
					
					var book_ad = $.parseJSON(data);
					
					document.getElementById("ro_no").value = book_ad.ro_no;
					document.getElementById("ro_date").value = book_ad.book_date;
					document.getElementById("cat").value = book_ad.cat_name;
					
				},                
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Please Select Position!");
					}
			});
} 


</script>