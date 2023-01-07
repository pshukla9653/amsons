<div id="page-content" style="min-height: 1189px;">
	<!-- Product Edit Content -->
	<div class="row">
	
	<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'ro_add');
					echo form_open_multipart('admin/cancel_letter/add', $attributes); ?>
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
						<strong>Cancel Letter</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<div class="form-group">
				    <input type="hidden" id="letter_id" name="letter_id" value="<?php echo $letters->id; ?>">
				    <input type="hidden" id="letter_no" name="letter_no" value="<?php echo $letters->letter_no; ?>">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Letter<span class="text-danger">*</span></label>
                        <div class="col-md-9">
							<select id="letter_type" name="letter_type"  class="form-control" data-placeholder="Choose Classes" required>
								<option value="" >Select Letter Type</option>
								<option value="C" <?php if($letters->letter_type=='C'){echo "selected";} ?>>Cancel Letter</option>
								<option value="Pre" <?php if($letters->letter_type=='Pre'){echo "selected";} ?>>Prepone Letter</option>
								<option value="Post" <?php if($letters->letter_type=='Post'){echo "selected";} ?>>Postpone Letter</option>
                            </select>
                        </div>
                    </div>	
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Client<span class="text-danger">*</span></label>
                        <div class="col-md-9">
							<select id="client" name="client"  class="form-control" data-placeholder="Choose Classes" required>
								<option value="" >Select Client</option>
								<?php foreach($clients as $client){ ?>
                                        <option value="<?php echo $client->id; ?>"<?php if($letters->client_id==$client->id){echo "selected";} ?>><?php echo $client->client_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>					
					<!--<div class="form-group">-->
					<!--	<label for="price" class="col-md-3 control-label">Date From</label>-->
     <!--                   <div class="col-md-9">-->
     <!--                       <input type="text" id="date_f" name="date_f" value="<?php echo set_value('date_f'); ?>" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">-->
     <!--                   </div>-->
     <!--               </div>-->
					<!--<div class="form-group">-->
					<!--	<label for="price" class="col-md-3 control-label">Date To</label>-->
     <!--                   <div class="col-md-9">-->
     <!--                       <input type="text" id="date_t" name="date_t" value="<?php echo set_value('date_f'); ?>" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">-->
     <!--                   </div>-->
     <!--               </div>-->
					<!--<div style="border-style: outset; height: 300px; overflow-y: scroll;">-->
					<!--	<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">-->
					<!--		<div class="table-responsive">-->
					<!--			<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">-->
					<!--				<thead>-->
					<!--					<tr role="row">-->
					<!--						<th class="text-center" >Ro No</th>-->
					<!--						<th class="text-center" style="width: 175px;" >Ro Date</th>-->
					<!--						<th class="text-center" style="width: 50px;" >Insertion</th>-->
					<!--					</tr>-->
					<!--				</thead>-->
					<!--				<tbody>-->
						
					<!--				</tbody>-->
					<!--			</table>-->
					<!--		</div>-->
					<!--	</div>					-->
					<!--</div>-->
									
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
							<input type="text" placeholder="" class="form-control" name="ro_no" id="ro_no" value="<?php echo $letters->ro_no; ?>" readonly>
						</div>
						<label for="pack-price" class="col-md-3 control-label">Ro Date</label>
						<div class="col-md-3">
							<input type="text" placeholder="" class="form-control" name="ro_date" id="ro_date" value="<?php echo $letters->ro_date; ?>" readonly>
						</div>						
					</div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Heading</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="cat" id="cat" readonly>
							<input type="hidden" placeholder="" class="form-control" name="cat1" id="cat1" >
							<input type="hidden" placeholder="" class="form-control" name="work_year" id="work_year" >
							<input type="hidden" placeholder="" class="form-control" name="scheme" id="scheme" >
							<input type="hidden" placeholder="" class="form-control" name="ro_id" id="ro_id" >
							<input type="hidden" placeholder="" class="form-control" name="type_id" id="type_id" >
								<input type="hidden" placeholder="" class="form-control" name="inse" id="inse" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Color Type</label>
                        <div class="col-md-9">
							<select id="color" name="color" class="form-control" data-placeholder="" required>
								<option value="Send By E-mail"<?php if($letters->material=="Send By E-mail"){echo "selected";} ?>>Send By E-mail</option>
								<option value="Attached" <?php if($letters->material=="Attached"){echo "selected";} ?>>Attached</option>
								<option value="Followed" <?php if($letters->material=="Followed"){echo "selected";} ?>>Followed</option>
                            </select>
                        </div>
                    </div>
					<div style="border-style: outset; height: 300px; overflow-y: scroll;">
						<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">
							<div class="table-responsive">
									<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products-cancel" role="grid" aria-describedby="ecom-products_info">
									<thead>
										<tr role="row">
										    <th class="text-center" >Select</th>
											<th class="text-center" >Ro No</th>
											<th class="text-center" style="width: 175px;" >DOP</th>
											<th class="text-center" style="width: 50px;" >Insertion</th>
											<th class="text-center" style="width: 50px;" >Pre/Post DOP</th>
										</tr>
									</thead>
									<tbody>
						
									</tbody>
								</table>
							</div>
						</div>					
					</div>
					
					<div class="form-group">
					<label for="example-textarea-input" class="col-md-3 control-label">Remarks To Print </label>
						<div class="col-md-9">
						<textarea placeholder="Add Remarks"   class="form-control" rows="5" name="remark" id="remark" value="<?php echo $letters->remark;?>" ></textarea>		
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
							
							<input class="btn btn-sm btn-primary" type="button" value="Save" onclick="save_letter();">
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

$(document).ready(function(){
    select_ro();
    $("#date_f").datepicker({maxDate: 0});
$("#date_t").datepicker({maxDate: 0});
});


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
			url: "<?php echo base_url(); ?>" + "admin/cancel_letter/get_ros",
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
var val=0;
function select_ro(id)
{
// 	$.ajax({                
// 			url: "<?php echo base_url(); ?>" + "admin/cancel_letter/get_ro_details",
// 			type: "POST",				
// 			async: true ,               
// 			data: {'ro_id':id},
// 			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
// 			success: function(data)
// 				{
// 					document.getElementById("loader").style.display = "none";
// 					if(data=='1')
// 					{
// 						alert("Ro not Found.");
// 						return false;
// 					}									
					
					var book_ad = $.parseJSON('<?php echo json_encode($book_ad); ?>');
					var letter_dops = $.parseJSON('<?php echo json_encode($letter_dops); ?>');
					var letters = $.parseJSON('<?php echo json_encode($letters); ?>');
					console.log(book_ad);
						console.log(letter_dops);
						console.log(letters);
				document.getElementById("ro_no").value = book_ad.ro_no;
					document.getElementById("ro_id").value = book_ad.id;
					document.getElementById("ro_date").value = book_ad.book_date;
					document.getElementById("cat").value = book_ad.cat_name;
					document.getElementById("work_year").value = book_ad.work_year;
					document.getElementById("cat1").value = book_ad.cat_id;
					document.getElementById("inse").value = book_ad.insertion;
					document.getElementById("type_id").value = book_ad.type_id;
					document.getElementById("scheme").value=book_ad.scheme;  
				// 	var sche=scheme.split('+');
				// 	document.getElementById('Paid').value=sche[0];
				// 	document.getElementById('Free').value=sche[1];
				// 	var p_u= document.getElementById('ins_dops');
				// 	p_u.innerHTML="";
					
					var count=1;
					var c=0;
					$.each(letter_dops, function(i, d) 
					{	
					    
					        if($("#letter_type").val()=="C")
					        {
						$("#ecom-products-cancel tbody").append('<tr><td><input type="hidden" id="last_inse['+c+']" value="'+d.last_inse+'"><input type="checkbox" id="ro_main_id" name="ro_main_id['+c+']" value="'+d.id+'" checked><input type="hidden" id="paper_id" name="paper_id['+c+']" value="'+d.paper_id+'"></td><td class="text-center"><strong>'+letters.ro_no+'</strong></td><td><input type="text" id="dop" name="cdop['+c+']" value="'+d.last_dop+'" readonly></td><td class="text-center"><input type="text" id="inse_no" name="inse_no['+c+']" value="'+d.insertion_no+'" readonly></td><td class="text-center"><input type="text" id="new_dop" name="new_dop['+c+']" value="'+d.dops+'" readonly></td></tr>');
					        }
					        else
					        {
					            	$("#ecom-products-cancel tbody").append('<tr><td><input type="hidden" id="last_inse['+c+']" value="'+d.last_inse+'"><input type="checkbox" id="ro_main_id" name="ro_main_id['+c+']" value="'+d.id+'" checked><input type="hidden" id="paper_id" name="paper_id['+c+']" value="'+d.paper_id+'"></td><td class="text-center"><strong>'+letters.ro_no+'</strong></td><td><input type="text" id="dop" name="cdop['+c+']" value="'+d.last_dop+'" readonly></td><td class="text-center"><input type="text" id="inse_no" name="inse_no['+c+']" value="'+d.insertion_no+'" readonly></td><td class="text-center"><input type="date" id="new_dop" name="new_dop['+c+']" value="'+d.dops+'" ></td></tr>');
					        }
						c++;
					   // }
					    //count++;
					});
					val=c;
				}                
// 			error: function() 
// 					{
// 						document.getElementById("loader").style.display = "none";
// 						alert("Please Select Position!");
// 					}
// 			});
//} 

function save_letter()
{
    if($("#letter_type").val()=="")
    {
        alert("please select letter_type");
    }
	var type_id= $("#type_id").val();
	var ro_no= $("#ro_no").val();
	var ro_id= $("#ro_id").val();
	var ro_date=$("#ro_date").val();
	var client= $("#client").val();	
	var sheading= $("#cat").val();	
	var inse= $("#inse").val();
	var scheme= $("#scheme").val();
	var material= $("#color").val();
		var work_year= $("#work_year").val();

	var  remark= $("#remark").val();
	var letter_type=$("#letter_type").val();
var add_dop = [];
var letter_id=$("#letter_id").val();
var letter_no=$("#letter_no").val();
for(i=0;i<=val;i++)
{ 
    
   if($('input[name="ro_main_id['+i+']"]').is(":checked"))
   {
   var paper_id=$("input[name='paper_id["+i+"]']").val();
       var ro_main_id=$("input[name='ro_main_id["+i+"]']").val();
       var dop=$("input[name='cdop["+i+"]']").val();
       var insertion_no=$("input[name='inse_no["+i+"]']").val();
       var last_inse=$("input[name='last_inse["+i+"]']").val();
        var new_dop=$("input[name='new_dop["+i+"]']").val();
       var data = { id : paper_id, ro_main_id : ro_main_id,dop  : dop, insertion_no : insertion_no,last_ins:last_inse, new_dop : new_dop};
       add_dop.push(data);
   }
   
   
		
   
}



 	var  p_date=add_dop;
// 	//var  box_c= $("#box_c").val();
	
 	var form_data= {'ro_no':ro_no,'ro_id':ro_id,'ro_date':ro_date,'client':client,'work_year':work_year,'sheading':sheading,'inse':inse,'scheme':scheme,'material':material,'remark':remark,'p_date':p_date,'letter_type':letter_type,'letter_id':letter_id,'letter_no':letter_no};
	console.log(form_data);
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/cancel_letter/edit",
			type: "POST",				
			async: true ,               
			data: form_data,
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{
				    console.log(data);
					document.getElementById("loader").style.display = "none";
					if(data=='1')
					{
						alert("Fill All Mandatory Felids.");
						return false;
					}
					if(data=='2')
					{
						alert("No. of publish Dates must be equal to insertion.");
						return false;
					}
					if(data=='3')
					{
						alert("Rate Not Set with this newspaper.");
						return false;
					}
					
					
					
					if(data=='5')
					{
						alert("Letter add Successfully. ");	
					 window.location.replace("<?php echo base_url('admin/cancel_letter'); ?>");
					}
				
				},                
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Ro not add !");
					}
			});
} 

</script>