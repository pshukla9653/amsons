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
						<strong>Newspaper Bill</strong> Entry
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open('admin/newspaper_bill/add', $attributes)
					?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
				<div class="col-lg-6">
										
					
				<!--	<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Publication  City</label>
                        <div class="col-md-9">
							<select id="city" name="city" class="form-control" data-placeholder="Choose City" required>
                            </select>
                        </div>
                    </div>	-->				
															
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
                    	<script type="text/javascript">
function noenter() {
  return !(window.event && window.event.keyCode == 13); }
</script>				
					<div class="form-group">
					    
						<label for="price" class="col-md-3 control-label">Slip No.</label>
						<div class="col-md-9">
							<input type="number" onkeypress="return noenter()" value="<?php echo $slip_no; ?>"  onkeypress="return noenter()"placeholder=""  class="form-control" name="slip_no" id="slip_no" min="1" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Publication</label>
                        <div class="col-md-9">
							<select id="publication" name="publication" class="form-control"  data-placeholder="Choose publication" onchange="get_state();" required>
							<option onkeypress="return noenter()" value="">Choose Publication</option>
							<?php 
							
							foreach($publications as $publication){ ?>
                                   <option onkeypress="return noenter()" value="<?php echo $publication->ng_id; ?>" <?php echo  set_select('publication', $publication->ng_id); ?>
									><?php echo $publication->ng_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
                      <div class="form-group">

                        <label class="col-md-3 control-label" for="example-chosen-multiple">Select State <span class="text-danger">*</span></label>

                        <div class="col-md-9">

                            <select name="state" id="state"  class="form-control" data-placeholder="Choose City" required >

                                <option onkeypress="return noenter()" value="" >Select State</option>

                            </select>

                        </div>

                    </div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Date</label>
                        <div class="col-md-9">
                            <input type="text" id="b_date" name="b_date" onkeypress="return noenter()" value="<?php echo set_value('b_date'); ?>" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" onchange="getbillamount();" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Bill No.</label>
						<div class="col-md-3">
						    
							<input type="text" placeholder="" class="form-control" name="bill_no" id="bill_no" onkeypress="return noenter()" value="<?php echo set_value('bill_no'); ?>" onchange="checkbill();" required>
						</div>
						<label for="price" class="col-md-3 control-label">Bill Amount</label>
						<div class="col-md-3">
							<input type="text" placeholder="" class="form-control" name="bill_a" id="taxable_amount" onkeypress="return noenter()" value="<?php echo set_value('bill_a'); ?>" onchange="getbillamount();" required>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">DOP</label>
                        <div class="col-md-9">
                            <input type="text" id="dop" name="dop" onkeypress="return noenter()" value="<?php echo set_value('dop'); ?>" class="form-control input-datepicker-close"  onchange="get_ro();" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Ro No.</label>
						<div class="col-md-3">
							<input type="text" placeholder="" class="form-control" name="ro_no" id="ro_no" onchange="get_ro();" onkeypress="return noenter()" value="<?php echo set_value('ro_no'); ?>" >
						</div>
					<!--	<label for="price" class="col-md-3 control-label">Add No.</label>
						<div class="col-md-3">
							<input type="text" placeholder="" class="form-control" name="add_no" id="add_no" onkeypress="return noenter()" value="<?php echo set_value('add_no'); ?>">
						</div>-->
					</div>
					<div class="table-responsive" style="border-style: outset;width:900px; height: 250px; overflow-y: scroll; background-color:#fff;">
						<div class="table-responsive">
						<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
							<thead>
								<tr role="row">
									<th class="text-center">Newspaper</th>
									<th class="text-center">DOP</th>
									<th class="text-center">RO NO.</th>
									<th class="text-center">Date</th>
									<th class="text-center">Amount</th>
									<th class="text-center">cgst</th>
									<th class="text-center">sgst</th>
									<th class="text-center">igst</th>
									<th class="text-center">Billed amount</th></th>
									<th class="text-center">Total amount</th>
								</tr>
							</thead>
							<tbody>
						
							</tbody>
						</table>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-2 control-label">Total Ro's Amount</label>
                        <div class="col-md-9">
                            
                   
					    <input type="text" name="totalamt" id="total" onkeypress="return noenter()" value="0" >
					     </div>
					     </div>
					     <div class="form-group">
					     <label for="gst" class="col-md-2 control-label">Bill CGST</label>
					   
                        <div class="col-md-4">
                            
                   
					    <input type="text" name="gst" id="gst" onkeypress="return noenter()" value="<?php echo set_value('gst'); ?>" >
					    </div>
					   
					     <label for="sgst" class="col-md-2 control-label">Bill SGST</label>
                        <div class="col-md-4">
                            
                   
					    <input type="text" name="sgst" id="sgst" onkeypress="return noenter()" value="<?php echo set_value('sgst'); ?>" >
					    </div>
					    </div>
					    <div class="form-group">
					     <label for="igst" class="col-md-2 control-label">Bill IGST</label>
                        <div class="col-md-4">
                            
                   
					    <input type="text" name="igst" id="igst" onkeypress="return noenter()" value="0" >
					      </div>
					     
					     <label for="price" class="col-md-2 control-label">ToTal Bill Amount</label>
                        <div class="col-md-4">
                            <input type="text" name="billamount" id="billamount" onkeypress="return noenter()" value="0" >
					     </div>
					     </div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Status</label>
						<div class="col-md-9">
							 <input type="radio" name="status" id="ok" onkeypress="return noenter()" value="1" checked> OK 
							 <input type="radio" name="status" id="nook" onkeypress="return noenter()" value="0"> Disputed							
						</div>
					</div>
					
					<div class="form-group">
					<label for="example-textarea-input" class="col-md-3 control-label">Remark <span class="text-danger"></span></label>
						<div class="col-md-9">
						<textarea placeholder="Remark.."   class="form-control" rows="5" name="remark" id="remark" ></textarea>
						</div>
					</div>
					<input type="hidden" name="ro_id" id="ro_id" onkeypress="return noenter()" value="">
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
					
					<!--<div class="form-group">
						<label for="price" class="col-md-3 control-label">Date To</label>
                        <div class="col-md-9">
                            <input type="text" id="date_t" name="date_t" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
                        </div>
                    </div>-->
				</div>
				</form>
					<!-- END General Data Content -->
			</div>
			<!-- END General Data Block -->
		</div>
	<!-- END Product Edit Content -->
</div>

<script type="text/javascript">
	var wsum=0;
	
	var sum=0;
	var tax=0;
	var roid=[];
//$("#b_date").datepicker();
//$("#dop").datepicker();

//$("#date_t").datepicker({});

$("#dop").focusout(function(){
    if($("#dop").val()=='')
    {    //$("#dop").attr("disabled","disabled");
        //$("#ro_no").removeAttr("disabled");
    $("#ro_no").val('');
 
    }
    else
    {
        get_ro();
   // $("#ro_no").val('');
     //   $("#ro_no").attr("disabled","disabled");
     }
});
   function getbillamount()
   {  var taxable_amount=$("#taxable_amount").val();
         var state=$("#state").val();
         var b_date=$("#b_date").val();
       //  alert(b_date);
          var second_date="2017-07-01"; 
           var second_date1="01/07/2017"; 
          if(new Date(b_date)>=new Date(second_date) || new Date(b_date)>=new Date(second_date1)){
     if(state=="6"){
					<?php if($cgst){ 
							?>
					   var cgst=(((parseFloat(<?php echo $cgst->tax_depned;?>))*(parseFloat(<?php echo $cgst->tax_rate;?>)/2))/100).toFixed(2);
					
					<?php } else {?>
                       var cgst=(((parseFloat(taxable_amount))*(parseFloat(5)/2))/100).toFixed(2);
					<?php }?>	
					<?php if($sgst){ 
							?>
					var sgst=(((parseFloat(<?php echo $sgst->tax_depned;?>)*(parseFloat(<?php echo $sgst->tax_rate;?>)/2))/100)).toFixed(2);
				
					<?php } else {?>
                        var sgst=(((parseFloat(taxable_amount)*(parseFloat(5)/2))/100)).toFixed(2);
					<?php }?>
                        var igst=0;

                    } else {

                        var cgst=0;

                        var sgst=0;

					 <?php if($igst){ 
							?>
					var igst=(((parseFloat(<?php echo $igst->tax_depned;?>)*parseFloat(<?php echo $igst->tax_rate;?>))/100)).toFixed(2);
		
					 <?php } else { ?>
                        var igst=(((parseFloat(taxable_amount)*parseFloat(5))/100)).toFixed(2);
					 <?php }?>

                    } 
          }
          else
          {
                var cgst=0;

                        var sgst=0;

                        var igst=0;
          }
	var billamount=(parseFloat(taxable_amount)+parseFloat(cgst)+parseFloat(igst)+parseFloat(sgst)).toFixed(2);

document.getElementById('gst').value=cgst;
	$("#gst").val(cgst);
	$("#sgst").val(sgst);
	$("#igst").val(igst);
	$("#billamount").val(billamount);
	 sum=0;
   }
    function checkbill()
    {
     var billno =$("#bill_no").val();   
     var billdate=$("#b_date").val();
       var  billdata=jQuery.parseJSON('<?php echo json_encode($bills)?>');
          $.ajax({                

                url: "<?php echo base_url(); ?>" + "admin/newspaper_bill/checkbill",

                type: "POST",				

                async: true ,               

                data: {'billno':billno,'billdate':billdate},

                beforeSend: function(){ document.getElementById("loader").style.display = "block"; },

                success: function(data)

                {

                    document.getElementById("loader").style.display = "none";

                  //  $('#state').empty();

                    var billdata = $.parseJSON(data);
                    console.log(billdata);
                   
          
          if(billdata.includes(billno))
          {
              alert("Bill no already exists");
              $("#bill_no").val('');
              $("#bill_no").focusin();
              exit();
          }
      

                },                

                error: function() 

                {

                    document.getElementById("loader").style.display = "none";

                    alert("Error!");

                }

            });
      
    }
     function get_state()

        {

            
            var newspaper = $("#publication").val();

            $.ajax({                

                url: "<?php echo base_url(); ?>" + "admin/newspaper_bill/get_state",

                type: "POST",				

                async: true ,               

                data: {newspaper_id:newspaper},

                beforeSend: function(){ document.getElementById("loader").style.display = "block"; },

                success: function(data)

                {

                    document.getElementById("loader").style.display = "none";

                    $('#state').empty();

                    var opts = $.parseJSON(data);
                    console.log(opts);

                    $.each(opts, function(i, d) {

                       $('#state').append('<option value="' + d.id + '">' + d.name + '</option>');

                    });

                },                

                error: function() 

                {

                    document.getElementById("loader").style.display = "none";

                    alert("Please Select Newspaper!");

                }

            });	
           
        
            
        }

function get_ro()
{	
	var ro_no= $("#ro_no").val();
	var bill_a= $("#taxable_amount").val();
	var dop =$("#dop").val();
	var publication=$("#publication").val();
	var b_date=$("#b_date").val();


		$("#ecom-products tbody").html("");
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/newspaper_bill/get_ro",
			type: "POST",				
			async: true ,               
			data: {'ro_no':ro_no,'bill_a':bill_a,'publication':publication,'dop':dop,'b_date':b_date},
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{
					document.getElementById("loader").style.display = "none";
					if(data=='1')
					{
						alert("Fill All Mandatory Felids.");
						document.getElementById("ro_no").value ="";
						return false;
					}
					if(data=='2')
					{
						alert("No Ro Found.");						
					  $("#ok").prop("checked",false);
        $("#nook").prop("checked",true);
					}
					if(data=='3')
					{
						alert("Bill amount is greater than payable amount.");
						document.getElementById("ro_no").value ="";
						document.getElementById("bill_a").value ="";
						return false;
					}
					
					var tr = $.parseJSON(data);
					
					$("#ecom-products tbody").html("");
					
					// Use jQuery's each to iterate over the opts value
					$.each(tr, function(i, d) 
					{
						// You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data		onclick="select_ro('+ d.id +','+ d.type_id +');" 
						var date=d.dop;
					//	alert (date);
						if(date=="")
						{
							alert("No Date Found for publiction bill.");
							document.getElementById("ro_no").value ="";
							return false;
						}
						var dop=date.split(", ");
						//alert(d.ro_id);
						document.getElementById("ro_id").value = d.ro_id.toString();
					  var cgst=0;

                        var sgst=0;

                        var igst=0;
	
						$.each(dop, function(x, v) 
						{ 
						    console.log(v);
						    
						    var state=$("#state").val();
						    	var da=d.c_date.split(" ");
						         var first_date=v;
                                var second_date="2017-07-01"; 

                //console.log(ro_date);
var dop_amt=parseFloat(d.dop_amount)-parseFloat(d.newspaper_billed_amount);
                 
                if(new Date(first_date)>=new Date(second_date)){
                    if(state=="6"){

                       var cgst=(((parseFloat(dop_amt))*(parseFloat(5)/2))/100).toFixed(2);

                        var sgst=(((parseFloat(dop_amt)*(parseFloat(5)/2))/100)).toFixed(2);

                        var igst=0;

                    } else {

                        var cgst=0;

                        var sgst=0;

                        var igst=(((parseFloat(dop_amt)*parseFloat(5))/100)).toFixed(2);

                    } 

                }

                else{

                      var cgst=0;

                        var sgst=0;

                        var igst=0;

                }
//var status=(d.news_bill_status).toString();

						var totalamount=(parseFloat(dop_amt)+parseFloat(cgst)+parseFloat(igst)+parseFloat(sgst)).toFixed(2);
							$("#ecom-products tbody").append('<tr id="tbl_row'+d.paper_id+'"><td class="text-center"><strong><input type="checkbox" name="p_dop_ro[]" id="p_dop'+d.id+'" value="'+d.id+'" onclick="get_val(this,'+d.id+'),getvalue('+d.id+','+d.dop_amount+','+totalamount+');">  '+d.newspaper_name+'</strong></td><td class="text-center">'+v+'</td><td class="text-center">'+d.ro_no+'</td><td class="text-center">'+da[0]+'</td><td class="text-center"><input type="text" id="dop_amount_id_'+d.id+'" name="dop_amount[]" value="'+d.dop_amount+'" disabled ></td><td class="text-center">'+cgst+'</td><td class="text-center">'+sgst+'</td><td class="text-center">'+igst+'</td><td class="text-center">'+d.newspaper_billed_amount+'</td><td class="text-center">'+totalamount+'</td></tr>');
							
							
						});	
					});
					
				},                
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Please Select Position!");
					}
			});
}
function get_val(a,id){
    if($(a).is(":checked")){
        $('#dop_amount_id_'+id).attr('disabled',false);   
            $('#dop_amount_id_'+id).attr('readonly',true);        
    
    } else {
        $('#dop_amount_id_'+id).attr('disabled',true);   
                 $('#dop_amount_id_'+id).attr('readonly',false);        
   
        
    }
    
}
function getvalue(id,amt,totalamount)
{
    // if(status=='N')
    // {
     var bill_amount=$("#taxable_amount").val();
    
	
        if($("#p_dop"+id).is(":checked"))
        {
         sum=sum+amt;
         wsum=wsum+totalamount;
        
        }
        else
        {
          sum=sum-amt;  
           wsum=wsum-totalamount;
        
        }
         $("#total").val(sum.toFixed(2));
        if(wsum<bill_amount)
        {
            $("#ok").prop("checked",false);
            $("#nook").prop("checked",true);
            
        }
        else
        {
          $("#ok").prop("checked",true);
            $("#nook").prop("checked",false);  
        }
    
}

</script>