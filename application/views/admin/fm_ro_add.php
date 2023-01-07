<div id="page-content" style="min-height: 1185px;">
	<!-- Product Edit Content -->
	<div class="row">
		<div class="col-lg-12">
			<!-- General Data Block -->
			<div class="block">
				<!-- General Data Title -->
				<div class="block-title">
					<h2>
						<i class="fa fa-pencil"></i>
						<strong>Book FM</strong>Ro
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				
			<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/fm_ro/add', $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>		
					<div class="form-group" style="background-color: lightblue;">
						<label class="col-md-1 control-label" for="example-chosen-multiple">FM Group</label>
                        <div class="col-md-5">
							<select id="fm_group" name="fm_group" class="form-control" onchange="get_fmc();" required>
								<option value="">Choose FM Group</option>
								<?php foreach($fm_groups as $fm_group){ ?>
                                        <option value="<?php echo $fm_group->ng_id; ?>"><?php echo $fm_group->ng_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                        <label class="col-md-1 control-label" for="example-chosen-multiple">FM Channel</label>
                        <div class="col-md-5">
							<select id="fmc" name="fmc" class="form-control" data-placeholder="Choose FM Channel" onchange="get_city();" required>
								<option value="">Choose FM</option>
                            </select>
                        </div>
                   <div class="col-md-12">
						<label class="col-md-1 control-label" for="example-chosen-multiple">City</label>
                        <div class="col-md-5">
							<select id="city" name="city" class="form-control" data-placeholder="Choose City" required>
                                <option value="">Choose City</option>
                            </select>
                        </div>
                  
						<label class="col-md-1 control-label" for="example-chosen-multiple">Client</label>
                        <div class="col-md-5">
							<select id="client" name="client" class="select-chosen" data-placeholder="Choose Classes" style="width: 250px;" required>
								<option value="">Choose Client</option>
								<?php foreach($clients as $client){ ?>
                                        <option value="<?php echo $client->id; ?>"><?php echo $client->client_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
                   
				
					   <div class="col-md-12">
            						<label for="pack-price" class="col-md-1 control-label">RO Date</label>
            						<div class="col-md-2">
            							 <input type="text" name="ro_date" id="ro_date" required class="form-control input-datepicker-close" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">							
            						</div>
            				
            						<label for="pack-price" class="col-md-1 control-label">Heading</label>
            						<div class="col-md-2">
            							<input type="text" placeholder="" class="form-control" name="heading" id="heading" required>
            						</div>
            				
            					<label for="example-textarea-input" class="col-md-1 control-label">Remarks IF Any</label>
            						<div class="col-md-5">
            						<textarea placeholder="Remarks.." class="form-control" rows="5" name="remarks" id="remarks"></textarea>
            						</div>
            			</div>
            			 </div>
            				<div class="form-group">
				        <div class="col-md-12">
						<label for="pack-price" class="col-md-1 control-label">Date From</label>
                        <div class="col-md-2">
                            <input type="text" name="date_f" id="date_f" required class="form-control input-datepicker-close" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                        </div>
                 
					<!--<div class="form-group">
						<label for="pack-price" class="col-md-1 control-label">Date From</label>
						<div class="col-md-5">
							<input type="date" placeholder="" class="form-control" name="date_f" id="date_f" required>
						</div>
					</div>
					<div class="form-group">
						<label for="pack-price" class="col-md-1 control-label">To Date</label>
						<div class="col-md-5">
							<input type="date" placeholder="" class="form-control" onchange="daycount();" name="date_t" id="date_t" required>
						</div>
					</div>-->
				
						<label for="pack-price" class="col-md-1 control-label">To Date</label>
                        <div class="col-md-2">
                            <input type="text" name="date_t" id="date_t" required class="form-control input-datepicker-close" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" onchange="daycount();">
                        </div>
                   
						<label for="pack-price" class="col-md-1 control-label">No. of Days</label>
						<div class="col-md-2">
							
							
<script type="text/javascript">
function daycount() 
{
	var date1 = new Date(document.getElementById("date_f").value);
	var date2 = new Date(document.getElementById("date_t").value);
	var days= Math.round((date2-date1)/(1000*60*60*24));
	var ele = document.getElementById('day');
	days=days+1;
	if(days<1)
	{
		alert("From Date must less then TO Date.");
		var ele1 = document.getElementById('date_t');
		ele1.value = 0;
	}
	else
	{
		ele.value = days;
	}
}
document.write("<input type=text name=day id=day class=form-control readonly>");
</script>				</div>			
						</div>
					</div>
					<div class="form-group">
					     <div class="col-md-12">
        						<label for="pack-price" class="col-md-1 control-label">Slot Duration</label>
        						<div class="col-md-2">
        							<input type="number" placeholder="Duration in Second" onkeyup="totalsec();" class="form-control" name="sd" id="sd" required>
        						</div>
        				
        						<label for="pack-price" class="col-md-1 control-label">Daily Frequency Times</label>
        						<div class="col-md-2">
        							<input type="text" placeholder="" class="form-control" onkeyup="totalsec();" name="day_times" id="day_times" required>
        						</div>
        				
        						<label for="pack-price" class="col-md-1 control-label">Total Second</label>
        						<div class="col-md-2">
        							
        							
        <script type="text/javascript">
        function totalsec() 
        {
        	var days = document.getElementById("day").value;
        	var slot = document.getElementById("sd").value;
        	var times = document.getElementById("day_times").value;
        	var ts= days*slot*times;
        	var ele2 = document.getElementById('ts');
        	
        	if(ts<0)
        	{
        		alert("Set Slot Duration or Frequency Times");
        		//var ele2 = document.getElementById('ts');
        		ele2.value = 0;
        	}
        	else
        	{
        		ele2.value = ts;
        	}
        }
        document.write("<input type=text name=ts id=ts class=form-control readonly>");
        </script>							
        						</div>
        				    </div>
					 <div class="col-md-12">
						<label for="pack-price" class="col-md-1 control-label">Rate Per 10 Second</label>
						<div class="col-md-2">
							<input type="text" placeholder="" class="form-control" name="rp10" id="rp10"  onkeyup="total_amount();" required>
						</div>
				
						<label for="pack-price" class="col-md-1 control-label">Slot Rate</label>
						<div class="col-md-2">
							<input type="text" name="slot_rate" id="slot_rate" class="form-control" readonly>
						</div>

					<label for="example-textarea-input" class="col-md-1 control-label">Matter</label>
						<div class="col-md-2">
						<textarea placeholder="Ad Matter.." class="form-control" rows="5" name="matter" id="matter"></textarea>
						</div>
				
						<label for="pack-price" class="col-md-1 control-label">Total</label>
						<div class="col-md-2">
<script type="text/javascript">
function total_amount()
{
	var days = document.getElementById("day").value;
	var slot = document.getElementById("sd").value;
	var times = document.getElementById("day_times").value;
	var rpten = document.getElementById("rp10").value;
	var ts=days*slot*times;
	var ele2 = document.getElementById('ts');
	
	if(ts<0)
	{
		alert("Set Slot Duration or Frequency Times");
		//var ele2 = document.getElementById('ts');
		ele2.value = 0;
	}
	else
	{
		var total=rpten*ts/10;
		var rate=slot*rpten/10;
		
		var ele1=document.getElementById("slot_rate");
		ele1.value =rate;
		
		var ele4=document.getElementById("total");
		ele4.value =total;
		
		//slot_rate(st);
	}	
}

</script>				
							<input type="text" name="total" id="total" class="form-control" readonly>			
						</div>
						</div>
					</div>
					<div class="form-group">
						<label for="pack-price" class="col-md-1 control-label">Commision %</label>
						<div class="col-md-2">
							<input type="text" placeholder="" class="form-control" name="comm1" id="comm1"  onkeyup="com1_amount();">
						</div>
					
<script type="text/javascript">
function com1_amount()
{
	var comm1 = document.getElementById("comm1").value;
	var s_amount = document.getElementById("total").value;
	var ca=s_amount*comm1/100;
	var ele5=document.getElementById("comm_a");
	ele5.value =ca;
		
	var ele6=document.getElementById("net_a");
	ele6.value =s_amount-ca;		
	
}

</script>
					
						<label for="pack-price" class="col-md-1 control-label">Commision %</label>
						<div class="col-md-2">
							<input type="text" placeholder="" class="form-control" name="comm2" id="comm2"  onkeyup="com2_amount();">
						</div>
				
<script type="text/javascript">
function com2_amount()
{
	var comm1 = document.getElementById("comm1").value;
	var comm2 = document.getElementById("comm2").value;
	var s_amount = document.getElementById("total").value;
	var ca=s_amount*comm1/100;
	var net=s_amount-ca;
	var ca1=net*comm2/100;
	ca=ca+ca1;
	net=net-ca1;
	
	var ele5=document.getElementById("comm_a");
	ele5.value =ca;
		
	var ele6=document.getElementById("net_a");
	ele6.value =net;		
	
}

</script>
				
						<label for="pack-price" class="col-md-1 control-label">Commision Amount</label>
						<div class="col-md-2">
							<input type="text" name="comm_a" id="comm_a" class="form-control" readonly>
						</div>
				
					<label class="col-md-1 control-label" for="example-chosen-multiple">Tax %</label>
                        <div class="col-md-2">
                            	<input type="text" name="tax" id="tax" onblur="tax_amount();" class="form-control" value="<?php echo $taxs->tax_rate; ?>" >
					
                        </div>
                    </div>
<script type="text/javascript">
function tax_amount()
{
	var net_a = document.getElementById("net_a").value;
	var tax= document.getElementById("tax").value;
	
	var ta=net_a*tax/100;
	var net=parseFloat(net_a)+ta;
	
	var ele5=document.getElementById("tax_a");
	ele5.value =ta;
		
	var ele6=document.getElementById("net_a");
	ele6.value =net.toFixed( 2 );
	
		var s_amount = document.getElementById("total").value;
	
	var tamount = document.getElementById("t_amount").value;
	var total_a=document.getElementById("t_amount");
	total_a.value = (parseFloat(tamount)+parseFloat(s_amount)).toFixed(2);

	var ca=document.getElementById("comm_a").value;
	var comm = document.getElementById("comm_amount").value;
	var comm_amount=document.getElementById("comm_amount");
	comm_amount.value = (parseFloat(comm)+parseFloat(ca)).toFixed(2);
	
//	var t=document.getElementById("tax_a").value;
		var t_tax = document.getElementById("total_tax").value;
	var tt=document.getElementById("total_tax");
	tt.value = (parseFloat(t_tax)+ parseFloat(ta)).toFixed(2);
	
	var net=document.getElementById("net_a").value;
	var netamount= document.getElementById("net_amount").value;
	var net_amt=document.getElementById("net_amount");
	net_amt.value = (parseFloat(netamount)+parseFloat(net)).toFixed(2);
	
}

</script>
					<div class="form-group">
						<label for="pack-price" class="col-md-1 control-label">Tax Amount</label>
						<div class="col-md-2">
							<input type="text" name="tax_a" id="tax_a" class="form-control" readonly>
						</div>

						<label for="pack-price" class="col-md-1 control-label">NET Amount</label>
						<div class="col-md-2">
							<input type="text" name="net_a" id="net_a" class="form-control" readonly>
						</div>
							<div class="col-md-2">
							<button class="add-row" type="button" >
								 Add Ro
							</button>
							</div>
					</div>
				
		

						<div class="form-group">
					    <br/>
					    <br/>
					    <div class="table-responsive" style="border-style: outset; height: 300px; overflow-y: scroll; background-color:#fff;">
        <table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="roTable" role="grid" aria-describedby="roTable">
            <thead>
                <tr role="row">
    
				 <!-- <td>FM Group</td>
					        <td>Channel</td>
					        <td>City</td>
					        <td>Client</td>
					        <td>RO Date</td>
					        <td>Heading</td>
					        <td>Remarks</td>-->
					        <td>Date From</td>
					        <td>Date To</td>
					        <td>No. Of Days</td>
					        <td>Slot Duration</td>
					        <td>Daily Frequency</td>
					        <td>Total Seconds</td>
					        <td>Rate per 10 Seconds</td>
					        <td>Slot Rate</td>
					        <td>Matter</td>
					        <td>Total</td>
					        <td>Commision 1(%)</td>
					        <td>Commission 2(%)</td>
					        <td>Total Commission(%)</td>
					        <td>Tax</td>
					        <td>Tax Amount</td>
					        <td>Net Amount</td>
					        <td>Cancel</td>
					        </tr>
					   </thead>
					  <tbody>
					      
					  </tbody>
					</table> 
					<br />
					<br/>
					</div>
					</div>    
					 	<label for="t_amount"> TOTAL AMOUNT</label><input type="text" id="t_amount" name="t_amount" value="0">   
					<label for="comm_amount"> TOTAL Commission</label><input type="text" id="comm_amount" name="comm_amount" value="0">   
					<label for="total_tax"> TOTAL Tax </label><input type="text" id="total_tax" name="total_tax" value="0">   
					<label for="net_amount"> TOTAL Payable Amount</label><input type="text" id="net_amount" name="net_amount" value="0">      
					<div class="form-group form-actions">	
						<div class="col-md-5 col-md-offset-1">
						    <input class="btn btn-sm btn-primary" type="button" value="Save" onclick="save_data();">
						<!--	<button class="btn btn-sm btn-primary" type="button" onclick="save_data();" >
								<i class="fa fa-floppy-o"></i> Save
							</button>
-->							<button class="btn btn-sm btn-warning" type="reset">
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


<script type="text/javascript">

function get_fmc()
{
	//alert("Please Select Newspaper!");
	var fmg_id = $("#fm_group").val();
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/fm_ro/get_channels",
			type: "POST",				
			async: true ,               
			data: {fmg_id:fmg_id},
			success: function(data)
				{
					// Parse the returned json data
					var opts = $.parseJSON(data);
					// Use jQuery's each to iterate over the opts value
					$.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
                    $('#fmc').append('<option value="' + d.id + '">' + d.name + '</option>');
					});					
				},                
			error: function() 
					{                    
						alert("Please Select group!");
					}
			});
}


function get_city()
{
	//alert("Please Select Newspaper!");
	var fmc = $("#fmc").val();
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/fm_ro/get_city",
			type: "POST",				
			async: true ,               
			data: {fmc_id:fmc},
			success: function(data)
				{
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
						alert("Please Select Channel!");
					}
			});
}       

function save_data()
{
           var FM_G = $("#fm_group").val();
           var fmc = $("#fmc").val();
        
           var city = $("#city").val();
           var client = $("#client").val();
           var ro_date = $("#ro_date").val();
           var heading = $("#heading").val();
           var remarks = $("#remarks").val();
           var comm_a = $("#comm_amount").val();
           alert(comm_a)
           var tax_a= $("#total_tax").val();
           var t_amount =$("#t_amount").val();
           var p_amount=$("#net_amount").val();
    var TableData;
    TableData =storeTblValues();
  
  
 $.ajax({ 
        	url: "<?php echo base_url(); ?>" + "admin/fm_ro/show_data",
			type: "POST",				
			async: true ,    
			data :{'td':JSON.stringify(TableData),'FMG':FM_G,'fmc':fmc,'client':client,'city':city,'ro_date':ro_date,'heading':heading,'remarks':remarks,'comm_a':comm_a,'tax_a':tax_a,'t_amount':t_amount,'p_amount':p_amount},
           dataType: 'json',
	  beforeSend: function(){ document.getElementById("loader").style.display = "block";},

       success: function(data)

                {

                    document.getElementById("loader").style.display = "none";

                  
                 // alert(url);
                        window.location = "<?php echo base_url(); ?>" + "admin/fm_ro";
               
                }, 
    	 error: function(jqXHR,error, errorThrown) {  
    	     
           if(jqXHR.status&&jqXHR.status==400){
                document.getElementById("loader").style.display = "none";
                alert(jqXHR.responseText); 
           }
          
      }
        });
  //  });
 
}

</script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".add-row").click(function(){
           var FM_G = $("#fm_group1").val();
         //  alert(FM_G);
           var fmc = $("#fmc").val();
           var city = $("#city").val();
           var client = $("#client").val();
           var ro_date = $("#ro_date").val();
           var heading = $("#heading").val();
           var remarks = $("#remarks").val();
           var date_f = $("#date_f").val();
           var date_t = $("#date_t").val();
           var day = $("#day").val();
           var sd = $("#sd").val();
           var day_times = $("#day_times").val();
           var ts = $("#ts").val();
           var rp10 = $("#rp10").val();
           var slot_rate = $("#slot_rate").val();
           var matter = $("#matter").val();
           var total = $("#total").val();
           var comm1 = $("#comm1").val();
           var comm2 = $("#comm2").val();
           var comm_a = $("#comm_a").val();
           var tax = $("#tax").val();
           var tax_a = $("#tax_a").val();
           var net_a = $("#net_a").val();
          
            
            //var markup = "<tr><td ><input type='hidden' id='fmg[]' name='fmg[]' value='"+FM_G+ "'>"+FM_G+ "</td><td><input type='hidden' id='fmc_1[]' name='fmc_1[]' value='"+fmc+ "'>" + fmc + "</td><td><input type='hidden' id='city_1[]' name='city_1[]' value='"+city+ "'>" + city + "</td><td><input type='hidden' id='client_1[]' name='client_1[]' value='"+client+ "'>" + client + "</td><td><input type='hidden' id='rodate[]' name='rodate[]' value='"+ro_date+ "'>" + ro_date + "</td><td><input type='hidden' id='heading_1[]' name='heading_1[]' value='"+heading+ "'>" + heading + "</td><td><input type='hidden' id='remarks_1[]' name='remarks_1[]' value='"+remarks+ "'>" + remarks + "</td><td><input type='hidden' id='date_f_1[]' name='date_f_1[]' value='"+date_f+ "'>" + date_f + "</td><td><input type='hidden' id='date_t_1[]' name='date_t_1[]' value='"+date_t+ "'>" + date_t + "</td><td><input type='hidden' id='day_1[]' name='day_1[]' value='"+day+ "'>" + day + "</td><td><input type='hidden' id='sd_1[]' name='sd_1[]' value='"+sd+ "'>" + sd + "</td><td><input type='hidden' id='day_times_1[]' name='day_times_1[]' value='"+day_times+ "'>" + day_times + "</td><td><input type='hidden' id='ts_1[]' name='ts_1[]' value='"+ts+ "'>" + ts + "</td><td><input type='hidden' id='rp10_1[]' name='rp10_1[]' value='"+rp10+ "'>" + rp10 + "</td><td><input type='hidden' id='slot_rate_1[]' name='slot_rate_1[]' value='"+slot_rate+ "'>" + slot_rate + "</td><td><input type='hidden' id='matter_1[]' name='matter_1[]' value='"+matter+ "'>" + matter + "</td><td><input type='hidden' id='total_1[]' name='total_1[]' value='"+total+ "'>" + total + "</td><td><input type='hidden' id='com1[]' name='com1[]' value='"+comm1+ "'>" + comm1 + "</td><td><input type='hidden' id='com2[]' name='com2[]' value='"+comm2+ "'>" + comm2 + "</td><td><input type='hidden' id='com_a[]' name='com_a[]' value='"+comm_a+ "'>" + comm_a + "</td><td><input type='hidden' id='tax_1[]' name='tax_1[]' value='"+tax+ "'>" + tax + "</td><td><input type='hidden' id='taxa[]' name='taxa[]' value='"+tax_a+ "'>" + tax_a + "</td><td><input type='hidden' id='neta[]' name='neta[]' value='"+net_a+ "'>" + net_a + "</td><td>"  + "<button type='button' " + "onclick='productDelete(this);' " + "class='btn btn-default'>" + "<span class='glyphicon  glyphicon-remove' />" + "</button>" + "</td></tr>";
            var markup = "<tr><td><input type='hidden' id='date_f_1[]' name='date_f_1[]' value='"+date_f+ "'>" + date_f + "</td><td><input type='hidden' id='date_t_1[]' name='date_t_1[]' value='"+date_t+ "'>" + date_t + "</td><td><input type='hidden' id='day_1[]' name='day_1[]' value='"+day+ "'>" + day + "</td><td><input type='hidden' id='sd_1[]' name='sd_1[]' value='"+sd+ "'>" + sd + "</td><td><input type='hidden' id='day_times_1[]' name='day_times_1[]' value='"+day_times+ "'>" + day_times + "</td><td><input type='hidden' id='ts_1[]' name='ts_1[]' value='"+ts+ "'>" + ts + "</td><td><input type='hidden' id='rp10_1[]' name='rp10_1[]' value='"+rp10+ "'>" + rp10 + "</td><td><input type='hidden' id='slot_rate_1[]' name='slot_rate_1[]' value='"+slot_rate+ "'>" + slot_rate + "</td><td><input type='hidden' id='matter_1[]' name='matter_1[]' value='"+matter+ "'>" + matter + "</td><td><input type='hidden' id='total_1[]' name='total_1[]' value='"+total+ "'>" + total + "</td><td><input type='hidden' id='com1[]' name='com1[]' value='"+comm1+ "'>" + comm1 + "</td><td><input type='hidden' id='com2[]' name='com2[]' value='"+comm2+ "'>" + comm2 + "</td><td><input type='hidden' id='com_a[]' name='com_a[]' value='"+comm_a+ "'>" + comm_a + "</td><td><input type='hidden' id='tax_1[]' name='tax_1[]' value='"+tax+ "'>" + tax + "</td><td><input type='hidden' id='taxa[]' name='taxa[]' value='"+tax_a+ "'>" + tax_a + "</td><td><input type='hidden' id='neta[]' name='neta[]' value='"+net_a+ "'>" + net_a + "</td><td>"  + "<button type='button' " + "onclick='productDelete(this);' " + "class='btn btn-default'>" + "<span class='glyphicon  glyphicon-remove' />" + "</button>" + "</td></tr>";
            $("table").append(markup);
          
          //  $("#ro_date").val('');
          /// $("#heading").val('');
         // $("#remarks").val('');
           $("#date_f").val('');
           $("#date_t").val('');
           $("#day").val('');
           $("#sd").val('');
           $("#day_times").val('');
           $("#ts").val('');
            $("#rp10").val('');
            $("#slot_rate").val('');
           $("#matter").val('');
            $("#total").val('');
           $("#comm1").val('');
           $("#comm2").val('');
           $("#comm_a").val('');
           $("#tax").val('');
           $("#tax_a").val('');
           $("#net_a").val('');
           $("#date_f").focus();    
        });
          
             
      
    });    
    function productDelete(ctl) {
  $(ctl).parents("tr").remove();
}



function storeTblValues()
{
    var TableData = new Array();

    $('#roTable tr').each(function(row, tr){
        TableData[row]={
            "date_f" :$(tr).find('td:eq(0)').text()
                  , "date_t" :$(tr).find('td:eq(1)').text()
                   , "day" :$(tr).find('td:eq(2)').text()
                    , "sd" :$(tr).find('td:eq(3)').text()
                     , "day_times" :$(tr).find('td:eq(4)').text()
                      , "ts" :$(tr).find('td:eq(5)').text()
                       , "rp10" :$(tr).find('td:eq(6)').text()
                        , "slot_rate" :$(tr).find('td:eq(7)').text()
                         , "matter" :$(tr).find('td:eq(8)').text()
                          , "total" :$(tr).find('td:eq(9)').text()
                           , "comm1" :$(tr).find('td:eq(10)').text()
                            , "comm2" :$(tr).find('td:eq(11)').text()
                             , "comm_a" :$(tr).find('td:eq(12)').text()
                              , "tax" :$(tr).find('td:eq(13)').text()
                               , "tax_a" :$(tr).find('td:eq(14)').text()
                                , "net_a" :$(tr).find('td:eq(15)').text()
                               
                                
           
        }    
    }); 
    TableData.shift();  // first row will be empty - so remove
    return TableData;
}


</script>