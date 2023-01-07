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
					echo form_open('admin/newspaper_bill/edit/'.$bills->id, $attributes)
					?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
				<div class="col-lg-6">
						<script type="text/javascript">
function noenter() {
  return !(window.event && window.event.keyCode == 13); }
</script>				
					
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
					<div class="form-group">
					    
						<label for="price" class="col-md-3 control-label">Slip No.</label>
						<div class="col-md-9">
							<input type="number" value="<?php echo $bills->slip_no; ?>" placeholder="" tabindex="1" onkeypress="return noenter()" class="form-control" name="slip_no" id="slip_no" min="1" required>
							<input type="hidden" value="<?php echo $bills->id; ?>" placeholder=""  class="form-control" onkeypress="return noenter()" name="bill_id" id="bill_id" min="1" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Publication</label>
                        <div class="col-md-9">
                            	<input type="text" id="publication" onkeypress="return noenter()" name="publication" value="<?php echo $bills->publication; ?>" placeholder=""  class="form-control"  required>
                            		<input type="text" id="publicationname"  onkeypress="return noenter()" name="publicationname" value="<?php echo $bills->Publication; ?>" tabindex="2"placeholder=""  class="form-control"  required>
							                     </div>
                    </div>
                      <div class="form-group">

                        <label class="col-md-3 control-label" for="example-chosen-multiple">Select State <span class="text-danger">*</span></label>

                        <div class="col-md-9">

                            	<input type="text" id="state" onkeypress="return noenter()" name="state" value="<?php echo $bills->State; ?>" placeholder="" tabindex="3" class="form-control"  required>
                            		<input type="hidden" id="work_year" name="work_year" value="<?php echo $bills->work_year; ?>" placeholder=""  class="form-control"  required>
                            		<input type="text" id="StateName" name="StateName" onkeypress="return noenter()" value="<?php echo $bills->StateName; ?>"tabindex="4" placeholder=""  class="form-control"  required>

                        </div>

                    </div>
					<div class="form-group">
						<label for="b_date" class="col-md-3 control-label">Date</label>
                        <div class="col-md-9">
                            <input type="text" id="b_date" name="b_date" onkeypress="return noenter()" value="<?php echo $bills->dated; ?>" tabindex="5" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
					<div class="form-group">
						<label for="bill_no" class="col-md-3 control-label">Bill No.</label>
						<div class="col-md-3">
						    
							<input type="text" placeholder="" class="form-control" onkeypress="return noenter()" name="bill_no" id="bill_no" tabindex="6" value="<?php echo $bills->bill_no; ?>" onchange="checkbill();" required>
						</div>
						<label for="bill_a" class="col-md-3 control-label">Bill Amount</label>
						<div class="col-md-3">
							<input type="text" placeholder="" class="form-control" onkeypress="return noenter()" name="bill_a" id="bill_a" tabindex="7" value="<?php echo $bills->bill_amount; ?>" onchange="getbillamount();" required>
						</div>
					</div>
					<div class="form-group">
						<label for="dop" class="col-md-3 control-label">DOP</label>
                        <div class="col-md-9">
                            <input type="text" id="dop" name="dop" value="<?php echo $bills->dated; ?>"  onkeypress="return noenter()" tabindex="8" class="form-control input-datepicker-close"  onchange="get_ro();" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
					<div class="form-group">
						<label for="ro_no" class="col-md-3 control-label">Ro No.</label>
						<div class="col-md-3">
							<input type="text" placeholder="" class="form-control" name="ro_no" id="ro_no"  tabindex="9"onchange="get_ro();" value="<?php echo $bills->ro_no; ?>" >
						</div>
					<!--	<label for="price" class="col-md-3 control-label">Add No.</label>
						<div class="col-md-3">
							<input type="text" placeholder="" class="form-control" name="add_no" id="add_no" value="<?php echo set_value('add_no'); ?>">
						</div>-->
					</div>
					<div class="table-responsive" style="border-style: outset;width:1000px; height: 250px; overflow-y: scroll; background-color:#fff;">
						<div class="table-responsive">
						<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="billtable" tabindex="10" role="grid" aria-describedby="ecom-products_info">
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
												</table>
						  <?php
							//  echo var_dump($billdetails);
							$count=0;
							  foreach($billdetails as $bd1){
							  
							 ?>
						 <input type="hidden" name="billedro[]" id="billedro" value="<?php echo $bd1->ro_main_id;?>" >
						  <?php $count++; } ?>
						 
						</div>
						</div>
							<div class="table-responsive" style="border-style: outset;width:1000px; height: 250px; overflow-y: scroll; background-color:#fff;">
						<div class="table-responsive">
						<table class="table table-bordered table-striped table-vcenter dataTable no-footer" tabindex="11" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
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
							  <?php
							// echo var_dump($billdetails);
							$totalsum=0;
							  foreach($billdetails as $bd){
							      $totalsum=$totalsum+$bd->amount;
							  
							 ?>
						    <tr id="tbl_row<?php  echo $bd->ro_main_id; ?>" >
						    <td class="text-center"><strong><input type="checkbox" name="p_dop_ro[]" id="p_dop<?php  echo $bd->ro_main_id; ?>" value="<?php  echo $bd->ro_main_id; ?>" onclick="getvalue(<?php echo $bd->ro_main_id; ?>,<?php echo $bd->amount; ?>);" checked> <?php echo $bd->name; ?></strong></td>
						    <td class="text-center"><?php echo $bd->dop; ?></td>
						    <td class="text-center"><?php echo $bd->ro_no; ?></td>
						    <td class="text-center"><?php echo $bd->dop; ?></td>
						    <td class="text-center"><input type="text" name="dop_amount[]" value="<?php echo $bd->dop_amount; ?>" disabled ></td>
						    <td class="text-center"><?php echo $bd->cgst; ?></td>
						    <td class="text-center"><?php echo $bd->sgst; ?></td>
						    <td class="text-center"><?php echo $bd->igst; ?></td>
						    <td class="text-center"><?php echo $bd->newspaper_billed_amount;?></td>
						    <td class="text-center"><?php echo $bd->amount; ?></td>
						    </tr>
						   
						    <?php } ?>
							</tbody>

							</tbody>
						</table>
						</div>
					</div></div>
					<div class="form-group">
						<label for="total" class="col-md-2 control-label">Total Ro's Amount</label>
                        <div class="col-md-9">
                            
                   
					    <input type="text" name="totalamt" onkeypress="return noenter()" id="total"  tabindex="12" value="<?php echo $totalsum ;?>" >
					     </div>
					     </div>
					     <div class="form-group">
					     <label for="gst" class="col-md-2 control-label">Bill CGST</label>
					   
                        <div class="col-md-4">
                            
                   
					    <input type="text" name="gst" id="gst" onkeypress="return noenter()"  tabindex="13" value="<?php echo $bills->cgst?>" >
					    </div>
					   
					     <label for="sgst" class="col-md-2 control-label">Bill SGST</label>
                        <div class="col-md-4">
                            
                   
					    <input type="text" name="sgst" id="sgst" onkeypress="return noenter()" tabindex="14" value="<?php echo $bills->sgst?>" >
					    </div>
					    </div>
					    <div class="form-group">
					     <label for="igst" class="col-md-2 control-label">Bill IGST</label>
                        <div class="col-md-4">
                            
                   
					    <input type="text" name="igst" id="igst" onkeypress="return noenter()" tabindex="15" value="<?php echo $bills->igst?>" >
					      </div>
					     
					     <label for="billamount" class="col-md-2 control-label">ToTal Bill Amount</label>
                        <div class="col-md-4">
                            <input type="text" name="billamount" onkeypress="return noenter()" id="billamount" tabindex="16" value="<?php echo $bills->net_amount?>" >
					     </div>
					     </div>
					<div class="form-group">
						<label for="radio" class="col-md-3 control-label">Status</label>
						<div class="col-md-9">
							 <input type="radio" name="status" onkeypress="return noenter()" id="ok" tabindex="17" value="1" checked> OK 
							 <input type="radio" name="status" onkeypress="return noenter()" id="nook" tabindex="18" value="0"> Disputed							
						</div>
					</div>
					
					<div class="form-group">
					<label for="example-textarea-input" class="col-md-3 control-label">Remark <span class="text-danger"></span></label>
						<div class="col-md-9">
						<textarea placeholder="Remark.."   class="form-control" rows="5" onkeypress="return noenter()" tabindex="19" name="remark" id="remark" ></textarea>
						</div>
					</div>
					<input type="hidden" name="ro_id" id="ro_id" value="">
					<div class="form-group">
						<div class="col-md-9 col-md-offset-3">
							<button class="btn btn-sm btn-primary" tabindex="20" onkeypress="return noenter()" type="submit">
								<i class="fa fa-floppy-o"></i> Save
							</button>
							<button class="btn btn-sm btn-warning" tabindex="21" onkeypress="return noenter()" type="reset">
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
	var sum= 0;
	var tax=0;


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
   {  var bill_amount=$("#bill_a").val();
         var state=$("#state").val();
         var b_date=$("#b_date").val();
        
          var second_date="2017-07-01"; 
           var second_date1="01/07/2017"; 
          if(new Date(b_date)>=new Date(second_date)){
     if(state=="6"){

                       var cgst=(((parseFloat(bill_amount))*(parseFloat(5)/2))/100).toFixed(2);
                  //     alert(cgst);

                        var sgst=(((parseFloat(bill_amount)*(parseFloat(5)/2))/100)).toFixed(2);

                        var igst=0;

                    } else {

                        var cgst=0;

                        var sgst=0;

                        var igst=(((parseFloat(bill_amount)*parseFloat(5))/100)).toFixed(2);

                    } 
          }
          else
          {
                var cgst=0;

                        var sgst=0;

                        var igst=0;
          }
	var billamount=(parseFloat(bill_amount)+parseFloat(cgst)+parseFloat(igst)+parseFloat(sgst)).toFixed(2);
	$("#gst").val(cgst);
	$("#sgst").val(sgst);
	$("#igst").val(igst);
	$("#billamount").val(billamount);
	// sum=0;
   }
    function checkbill()
    {
     var billno =$("#bill_no").val();   
       var  billdata=jQuery.parseJSON('<?php echo json_encode($bills)?>');
      
       $.each(billdata,function(i,d){
          
           if(d.bill_no==billno)
           {
               alert("Bill no already exists");
               $("#bill_no").val('');
               $("#bill_no").focusin();
               exit();
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
	var bill_a= $("#bill_a").val();
	var dop =$("#b_date").val();
	var publication=$("#publication").val();
//		$("#ecom-products tbody").html("");
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/newspaper_bill/get_ro1",
			type: "POST",				
			async: true ,               
			data: {'ro_no':ro_no,'bill_a':bill_a,'publication':publication,'dop':dop},
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
					console.log(tr);
					$("#ecom-products tbody").find("tr:gt(<?php echo $count;?>)").remove();
					
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
						
						$.each(dop, function(x, v) 
						{ 
						    
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


						var totalamount=(parseFloat(dop_amt)+parseFloat(cgst)+parseFloat(igst)+parseFloat(sgst)).toFixed(2);
							$("#ecom-products tbody").append('<tr id="tbl_row'+d.id+'"><td class="text-center"><strong><input type="checkbox" name="p_dop_ro[]" id="p_dop'+d.id+'" value="'+d.id+'" onclick="getvalue('+d.id+','+totalamount+');">  '+d.newspaper_name+'</strong></td><td class="text-center">'+v+'</td><td class="text-center">'+d.ro_no+'</td><td class="text-center">'+da[0]+'</td><td class="text-center"><input type="text" name="dop_amount[]" value="'+d.dop_amount+'" disabled ></td><td class="text-center">'+cgst+'</td><td class="text-center">'+sgst+'</td><td class="text-center">'+igst+'</td><td class="text-center">'+d.newspaper_billed_amount+'</td><td class="text-center">'+totalamount+'</td></tr>');
							
							
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
function getvalue(id,amt)
{
    // if(status=='N')
    // {
     var bill_amount=$("#billamount").val();
    	 sum= parseFloat($("#total").val());
	
        if($("#p_dop"+id).is(":checked"))
        {
            //alert("x");
         sum=sum+amt;
        
        }
        else
        {
          sum=sum-amt;  
          if(sum<0)
          {
              sum=0;
          }
        }
        
         $("#total").val(sum.toFixed(2));
        if(sum<bill_amount)
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