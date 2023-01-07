<div id="page-content" style="min-height: 1189px;">
	<!-- Product Edit Content -->
	<div class="row">
	
	<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'ro_add');
					echo form_open_multipart('admin/ins_letter/add', $attributes); ?>
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
						<strong>Insertion Letter</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Client<span class="text-danger">*</span></label>
                        <div class="col-md-9">
							<select id="client" name="client"  class="from-control js-example-basic-single" style="width:100%" data-placeholder="Choose Classes" required>
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
					<div style="border-style: outset; height: 400px; overflow-y: scroll;">
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
							<input type="hidden" name="ro_id" id="ro_id">
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
					    <>
						<label for="pack-price" class="col-md-3 control-label">Paid</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="Paid" id="Paid" value="" readonly>
						</div>
						<label for="pack-price" class="col-md-3 control-label">Free</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="Free" id="Free" value=""readonly>
						</div>
					</div>
					<input type="hidden" name="inse" id="inse">
					<input type="hidden" name="cat1" id="cat1">
					<input type="hidden" name="type_id" id="type_id">
					<input type="hidden" name="scheme" id="scheme">
						<input type="hidden" name="work_year" id="work_year">
					
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Material</label>
                        <div class="col-md-9">
							<select id="material" name="material" class="form-control" data-placeholder="" required>
								<option value="Send By E-mail">Send By E-mail</option>
								<option value="Attached">Attached</option>
								<option value="Followed">Followed</option>
                            </select>
                        </div>
                    </div>
					<div style="border-style: outset; height: 400px; overflow-y: scroll;">
						<div id="ins_dops">
						
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
     $(document).ready(function (){
        
    $('.js-example-basic-single').select2();
                    });
    </script>

<script>


var days =[9,9,9,9,9,9,9];

//$("#date_f").datepicker({maxDate: 0});
//$("#date_t").datepicker({maxDate: 0});

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
			url: "<?php echo base_url(); ?>" + "admin/ins_letter/get_ros",
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
				//	console.log(data);
					var scheme='';
					$("#ecom-products tbody").html("");
					
					// Use jQuery's each to iterate over the opts value
					$.each(tr, function(i, d) 
					{
					  
						// You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
						$("#ecom-products tbody").append('<tr id="tr_'+ d.id +'" onclick="select_ro('+ d.id +');"><td class="text-center"><strong>'+d.ro_no+'</strong></td><td>'+d.book_date+'</td><td class="text-center">'+d.insertion+'</td></tr>');
					});
				
					
				},                
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Please Select Position!");
					}
			});
}
var Paid_amount=[];
var old_dops=[];
var paper_ids=[];
function select_ro(id)
{
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/ins_letter/get_ro_details",
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
					
					var data = $.parseJSON(data);
					console.log(data);
					document.getElementById("ro_no").value = data.book_ad.ro_no;
					document.getElementById("ro_id").value = data.book_ad.id;
					document.getElementById("ro_date").value = data.book_ad.book_date;
					document.getElementById("cat").value = data.book_ad.cat_name;
					document.getElementById("work_year").value = data.book_ad.work_year;
					document.getElementById("cat1").value = data.book_ad.cat_id;
					document.getElementById("inse").value = data.book_ad.insertion;
					document.getElementById("type_id").value = data.book_ad.type_id;
					document.getElementById("scheme").value=data.book_ad.scheme;
						scheme=data.book_ad.scheme;  
					var sche=scheme.split('+');
					document.getElementById('Paid').value=sche[0];
					document.getElementById('Free').value=sche[1];
					var p_u= document.getElementById('ins_dops');
					p_u.innerHTML="";
					
					
					
					$.each(data.dops, function(i, d) 
					{	
					    var s_days="";
					    var c="";
					    var count=0;
					    var dop_amount="";
                        old_dops.push(d.paper_id);
					  
					    $.each(data.dops1, function(i, s) 
				    	    { 
            					 if(s.dop_amount!=0)
            					 {
            					     Paid_amount[s.paper_id]=s.dop_amount;
            					 }
            					    if(d.paper_id==s.paper_id)
                					{count++;
                					dop_amount=s.dop_amount;
                						var dates= s.dop;
                						 s_days=dates.split(", ");
                						 c=s_days.length;
                						c=c-1;
                					}
					        });	
					//	var html='<div class="alert alert-info" onclick="date_pic_byid('+d.paper_id+');" style="cursor:crosshair"><strong>  '+ d.newspaper_name +' ,'+ d.city_name +'</strong></div>  <div class="form-group">	<label for="pack-price" class="col-md-6 control-label" >Add New Publish Date</label> <div class="col-md-6">	<div class="box"  id="from--input">	<input class="form-control" name="from-input'+ d.paper_id +'[]" type="text" id="from-input'+ d.paper_id +'" placeholder="mm/dd/yyyy, ..." >	</div>	<div class="code-box">	</div>	</div>	</div>';
						var html='<div class="alert alert-info" onclick="date_pic_byid('+d.paper_id+');" style="cursor:crosshair"><strong>  '+ d.newspaper_name +' ,'+ d.city_name +'</strong></div>                         <div class="form-group">	<label for="pack-price" class="col-md-4 control-label" >Last Publish Date</label> <div class="col-md-3">	<div class="box"  id="from--input"><input class="form-control" name="ro_id'+ d.ro_id +'[]" type="text" id="ro_id'+ d.ro_id +'" value="'+d.ro_id+'" readonly>	<input class="form-control" name="last_dop'+ d.paper_id +'[]" type="text" id="last_dop'+ d.paper_id +'" value="'+s_days[c]+'" readonly>	</div>	<div class="code-box">	</div>	</div>	<label for="pack-price" class="col-md-3 control-label" >No of Already Insertion</label> <div class="col-md-2">	<div class="box"  id="frput">	<input class="form-control" name="last_ins'+ d.paper_id +'[]" type="text" id="last_ins'+ d.paper_id +'" value="'+ (count) +'" readonly>	</div>	<div class="code-box"><label class="col-md-3 control-label"> Dop_Amount</label><input type="text" name="dop_amount'+d.paper_id+'[]" value="'+dop_amount+'">	</div>	</div></div>                      		    <div class="form-group">	<label for="pack-price" class="col-md-6 control-label" >Add New Publish Date</label> <div class="col-md-6">	<div class="box"  id="from--input">	<input class="form-control" name="from-input'+ d.paper_id +'[]" type="text" id="from-input'+ d.paper_id +'"  placeholder="mm/dd/yyyy, ..." >	</div>	<div class="code-box">	</div>	</div>	</div>'
						p_u= document.getElementById('ins_dops');
					
						p_u.insertAdjacentHTML('beforeend', html);
						
						
					});
					  console.log(old_dops);
					    console.log(Paid_amount);
					
					
				},                
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Please Select Position!");
					}
			});						$('#tr_'+id).attr('onclick',"s");
}


function date_pic_byid(paper_id)
{

var id="from-input"+paper_id;


	var  inse= $("#inse").val();
	var  cat= $("#cat1").val();
	var  type_id= $("#type_id").val();
	
	var form_data= {'newspaper':paper_id,'cat':cat,'inse':inse,'type_id':type_id};
	
	$.ajax({
			url: "<?php echo base_url(); ?>" + "admin/ins_letter/get_fdays",
			type: "POST",				
			async: true ,               
			data: form_data,
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{
					  document.getElementById("loader").style.display = "none";
					  
					if(data=='1')
					{
						alert("Select Newspaper,Heading and enter Insertion First.");
						/*$('#inse').val(function() 
						{
							return this.defaultValue;
						});*/
						return false;
					}
					if(data=='2')
					{
						alert("Rate not Set with this Newspaper or Heading.");
						/*$('#inse').val(function() 
						{
							return this.defaultValue;
						});*/
						return false;
					}
													
					
					// Parse the returned json data
					var price = $.parseJSON(data);
										
					days=price.day_id.split(",");
					
					
				},
			complete: function() 
					{                    
						date_pic_byid1(paper_id);
					},
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Rate not Set with this Newspaper or Heading.");
					}
			});
	
	setTimeout(function () {						
						date_pic_byid1(paper_id);						
						}, 500);
	
	

}

function date_pic_byid1(paper_id)
{	

var id="from-input"+paper_id;
//alert(id);


	var  inse= $("#inse").val();
	var last_ins=$("#last_ins"+paper_id).val();
	inse=inse-last_ins;
	alert(inse);
	var today = new Date();
	$('#'+id).multiDatesPicker({
		minDate: 0,
		
		onSelect:function()
		{			
			var dates= $("#"+id).val();
			var s_days=dates.split(", ");
			var i=s_days.length;
			if(i>= inse)
			{
			    alert(i);
				$('#'+id).multiDatesPicker('removeIndexes', inse);
			}
			i=i-1;
			
			var s_date=s_days[i];
			var d = new Date(s_days[i]);
			var day_id=d.getDay();
			var flag=0;
			var f=0;
			var j;
			for(j=0; j < 7; j++)
			{
				if(day_id== days[j])
				{
					f=1;
					break;
				}
			}
			
			if(f!=1 && dates!="" && flag == 0)
			{
				var status=confirm("You select non focus Day do you want to add.");
				if (status == true) 
				{
					flag=1;
					 return false;
				} 
				else 
				{
					var ind=s_days.length;
					ind--;
					$('#'+id).multiDatesPicker('removeIndexes', ind);
				}
			}
						
		},
		
		beforeShowDay: function(day) {
            var day = day.getDay();
            if (day == days[0] || day == days[1] || day == days[2] || day == days[3] || day == days[4] || day == days[5] || day == days[6]) 
			{
                return [true, "focus_day_color"]
            } 
			else 
			{
                return [true, ""]
            }
         }
		
	});

}


function save_letter()
{
	var type_id= $("#type_id").val();
	var ro_no= $("#ro_no").val();
	var ro_id= $("#ro_id").val();
	var ro_date=$("#ro_date").val();
	var client= $("#client").val();	
	var sheading= $("#cat").val();	
	var inse= $("#inse").val();
	var scheme= $("#scheme").val();
	var material= $("#material").val();
		var work_year= $("#work_year").val();
	//var  pack= $("#pack").val();
	//var  box= $("#box").val();
	var  remark= $("#remark").val();
	
	var add_dop = [];
var Paid=$("#Paid").val();
var Free=$("#Free").val();
// var uniqueArr = [... new Set(old_dops.map(data => data.paper_id))]
// console.log(uniqueArr);
 var id=0;
$.each(old_dops,function(i,d){
    
 id=d;
var last_d = $("input[name='last_dop"+d+"\\[\\]']")
              .map(function(){return $(this).val();}).get();

var val = $("input[name='from-input"+d+"\\[\\]']")
              .map(function(){return $(this).val();}).get();
var last_ins = $("input[name='last_ins"+d+"\\[\\]']")
              .map(function(){return $(this).val();}).get();


var count=1;
for(i=0;i<val.length;i++)
{ 
   
   var data = { id : id, dop  : val[i], dop_amount:Paid_amount[id],last_dop :last_d[i], last_ins:last_ins[i]};
   
		add_dop.push(data);
	
}

 
    
});
console.log("paid"+JSON.stringify(add_dop));
// 	$.each(old_dops, function(i, d) {
					
// 		var val=$("#from-input"+d.paper_id).val();
		 
// 		var last_d=$("#last_dop"+d.paper_id).val();
// 		var last_ins=$("#last_ins"+d.paper_id).val();
// 		var id=d.paper_id;
// 		if(val!=''||val!='undefined'||val!='NaN')
// 		{
// 		var data = {id : id, dop  : val, last_dop :last_d, last_ins:last_ins};
// 		add_dop.push(data);
// 		}
// 		else
// 		{ alert("no value");}
// 		//alert(pack_dop[i]);
// 	});
 	var  p_date=add_dop;
	
// 	//var  box_c= $("#box_c").val();
	
 	var form_data= {'ro_no':ro_no,'ro_id':ro_id,'ro_date':ro_date,'client':client,'work_year':work_year,'sheading':sheading,'inse':inse,'scheme':scheme,'material':material,'remark':remark,'p_date':p_date,'Paid':Paid,'Free':Free};
	
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/ins_letter/add",
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
						 window.location.replace("<?php echo base_url('admin/ins_letter'); ?>");
				// 		if(type_id=='1')
				// 		{
				// 			window.location.replace("http://s650006054.onlinehome.us/amson/admin/book_ads/edit/"+ro_id +"/INS");
				// 			return false;
				// 		}
				// 		if(type_id=='2')
				// 		{
				// 			window.location.replace("http://s650006054.onlinehome.us/amson/admin/display_ro/edit/"+ro_id +"/INS");
				// 			return false;
				// 		}
				// 		if(type_id=='3')
				// 		{
				// 			window.location.replace("http://s650006054.onlinehome.us/amson/admin/hd_ro/edit/"+ro_id +"/INS");
				// 			return false;
				// 		}
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