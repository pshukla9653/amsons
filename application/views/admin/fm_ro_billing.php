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
						<strong>Edit  FM</strong>Ro
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				
			<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'edit-FM');
					echo form_open_multipart('admin/ro_billing/edit', $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>		
					<div class="form-group" style="background-color: lightblue;">
						<label class="col-md-1 control-label" for="example-chosen-multiple">FM Group</label>
                        <div class="col-md-5">
							<select id="fm_group" name="fm_group" class="form-control" onchange="get_fmc();" >
								<option value="">Choose FM Group</option>
								<?php foreach($fm_groups as $fm_group){ ?>
                                        <option value="<?php echo $fm_group->g_id; ?>" <?php echo($fm->g_id == $fm_group->ng_id)?'selected':''; ?>  > <?php echo $fm_group->ng_name; ?></option>
								<?php }?>
                            </select>
                        </div>
            <div class="col-md-5">
							<select id="fmc" name="fmc" class="form-control" data-placeholder="Choose FM Channel"  onchange="get_city();" required>
								<option value="<?php echo $fmc->id; ?>" <?php echo 'selected="selected"'; ?> ><?php echo $fmc->name; ?> </option>
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
                                        <option value="<?php echo $client->id; ?>" <?php if($fm->c_id == $client->id){echo 'selected = "selected"';} ?> ><?php echo $client->client_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
                   
				
					   <div class="col-md-12">
            						<label for="pack-price" class="col-md-1 control-label">RO Date</label>
            						<div class="col-md-2">
            							 <input type="text" name="ro_date" id="ro_date" value="<?php echo $fm->ro_date; ?>" required class="form-control input-datepicker-close" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
            						</div>
            				
            						<label for="pack-price" class="col-md-1 control-label">Heading</label>
            						<div class="col-md-2">
            							<input type="text" placeholder="" class="form-control" value="<?php echo $fm->heading; ?>" name="heading" id="heading" required>
            						</div>
            				
            					<label for="example-textarea-input" class="col-md-1 control-label">Remarks IF Any</label>
            						<div class="col-md-5">
            						<textarea placeholder="Remarks.." class="form-control" rows="5"  name="remarks" id="remarks"><?php echo $fm->remark; ?></textarea>
            						</div>
            			</div>
            			 </div>
            				<div class="form-group">
				        <div class="col-md-12">
						<label for="pack-price" class="col-md-1 control-label">Date From</label>
                        <div class="col-md-2">
                            <input type="text" name="date_f" id="date_f"  class="form-control input-datepicker-close" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"  value="">
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
                            <input type="text" name="date_t" id="date_t"  class="form-control input-datepicker-close" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" placeholder="yyyy-mm-dd" onblur="daycount();">
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
<?php	if($fm->total_day){ ?>
	{ele.value=<?php echo $fm->total_day; ?>}
	<?php }?>
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
        							<input type="number" placeholder="Duration in Second" value="0" onkeyup="totalsec();" onblur="totalsec();" class="form-control" name="sd" id="sd" required>
        						</div>
        				
        						<label for="pack-price" class="col-md-1 control-label">Daily Frequency Times</label>
        						<div class="col-md-2">
        							<input type="text" placeholder="" class="form-control" value="0" onkeyup="totalsec();" onblur="totalsec();" name="day_times" id="day_times" required>
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
							<input type="text" placeholder="" class="form-control" name="rp10" id="rp10" value="0" onkeyup="total_amount();" required>
						</div>
				
						<label for="pack-price" class="col-md-1 control-label">Slot Rate</label>
						<div class="col-md-2">
							<input type="text" name="slot_rate" id="slot_rate" value="0" class="form-control" readonly>
						</div>

					<label for="example-textarea-input" class="col-md-1 control-label">Matter</label>
						<div class="col-md-2">
						<textarea placeholder="Ad Matter.." class="form-control"  rows="5" name="matter" id="matter"></textarea>
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
							<input type="text" name="total" id="total" value="0"class="form-control" readonly>			
						</div>
						</div>
					</div>
					<div class="form-group">
						<label for="pack-price" class="col-md-1 control-label">Commision %</label>
						<div class="col-md-2">
							<input type="text" placeholder="" class="form-control" value="0" name="comm1" id="comm1"  onkeyup="com1_amount();">
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
							<input type="text" placeholder="" class="form-control" value="0" name="comm2" id="comm2"  onkeyup="com2_amount();">
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
							<input type="text" name="comm_a" id="comm_a" value="0" class="form-control" readonly>
						</div>
				
						<label class="col-md-1 control-label" for="example-chosen-multiple">Tax %</label>
                        <div class="col-md-2">
                            	<input type="text" name="tax" id="tax"  value="<?php echo $taxs->tax_rate; ?>" onblur="tax_amount();" class="form-control" >
						<!--	<select id="tax" name="tax" class="select-chosen" onblur="tax_amount();" data-placeholder="Choose Tax" style="width: 250px;"  required>
								<option value="">Select Tax</option>
								<?php foreach($taxs as $tax){ ?>
                                        <option value="<?php echo $tax->tax_rate; ?>" <?php if($fm->tax == $tax->tax_rate) {echo 'selected="selected"'; }?>><?php echo $tax->tax_rate ." % ".$tax->tax; ?></option>
								<?php }?>
                            </select>-->
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
	ele5.value =ta.toFixed( 2 );
		
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
							<input type="text" name="tax_a" id="tax_a" value="0" class="form-control" readonly>
						</div>

						<label for="pack-price" class="col-md-1 control-label">NET Amount</label>
						<div class="col-md-2">
							<input type="text" name="net_a" id="net_a" value="0" class="form-control" readonly>
						</div>
						
					</div>
				
			<div class="col-md-2">
							<button class="add-row" type="button" >
								 Add Ro
							</button>
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
					      <?php foreach($fm_d as $key=>$fm_d1){
					       $fmd = array($fm_d1);
					       foreach($fmd as $fm_data)
					       {
					        ?>
					      <tr>
					         
					          <td><input type="hidden" id="date_f_1[]" name="date_f_1[]" value="<?php echo ($fm_data["date_from"]); ?>"><?php echo ($fm_data["date_from"]);  ?></td>
					          <td><input type="hidden" id="date_t_1[]" name="date_t_1[]" value="<?php echo ($fm_data["date_to"]); ?>"><?php echo ($fm_data["date_to"]);  ?></td>
					          <td><input type="hidden" id="day_1[]" name="day_1[]" value="<?php echo ($fm_data["total_day"]); ?>"><?php echo ($fm_data["total_day"]);  ?></td>
					          <td><input type="hidden" id="sd_1[]" name="sd_1[]" value="<?php echo ($fm_data["slot_dur"]); ?>"><?php echo ($fm_data["slot_dur"]);  ?></td>
					          <td><input type="hidden" id="day_times_1[]" name="day_times_1[]" value="<?php echo ($fm_data["day_times"]); ?>"><?php echo ($fm_data["day_times"]);  ?></td>
					          <td><input type="hidden" id="ts_1[]" name="ts_1[]" value="<?php echo ($fm_data["total_sec"]); ?>"><?php echo ($fm_data["total_sec"]);  ?></td>
					          <td><input type="hidden" id="rp10_1[]" name="rp10_1[]" value="<?php echo ($fm_data["rate_per_10"]); ?>"><?php echo ($fm_data["rate_per_10"]);  ?></td>
					          <td><input type="hidden" id="slot_rate_1[]" name="slot_rate_1[]" value="<?php echo ($fm_data["rate_one"]); ?>"><?php echo ($fm_data["rate_one"]);  ?></td>
					          <td><input type="hidden" id="matter_1[]" name="matter_1[]" value="<?php echo ($fm_data["material"]); ?>"><?php echo ($fm_data["material"]);  ?></td>
					          <td><input type="hidden" id="total_1[]" name="total_1[]" value="<?php echo ($fm_data["amount"]); ?>"><?php echo ($fm_data["amount"]);  ?></td>
					          <td><input type="hidden" id="com1[]" name="com1[]" value="<?php echo ($fm_data["COMM1"]); ?>"><?php echo ($fm_data["COMM1"]);  ?></td>
					           <td><input type="hidden" id="com2[]" name="com2[]" value="<?php echo ($fm_data["COMM2"]); ?>"><?php echo ($fm_data["COMM2"]);  ?></td>
					            <td><input type="hidden" id="com_a[]" name="com_a[]" value="<?php echo ($fm_data["tcom"]); ?>"><?php echo ($fm_data["tcom"]);  ?></td>
					             <td><input type="hidden" id="tax_1[]" name="tax_1[]" value="<?php echo ($fm_data["tax1"]); ?>"><?php echo ($fm_data["tax1"]);  ?></td>
					              <td><input type="hidden" id="taxa[]" name="taxa[]" value="<?php echo ($fm_data["TAX"]); ?>"><?php echo ($fm_data["TAX"]);  ?></td>
					               <td><input type="hidden" id="neta[]" name="neta[]" value="<?php echo ($fm_data["net"]); ?>"><?php echo ($fm_data["net"]);  ?></td>
					                <td><button type='button' onclick='productDelete(this);' class='btn btn-default'> <span class='glyphicon  glyphicon-remove' /> </button></td>
					                
					                
					      </tr>
					      <?php }}?> 
					  </tbody>
					</table> 
					<br />
					<br/>
					</div>
					</div>    
					<label for="t_amount"> TOTAL AMOUNT</label><input type="text" id="t_amount" name="t_amount" value="<?php echo $fm->t_amount; ?>">   
					<label for="comm_amount"> TOTAL Commission</label><input type="text" id="comm_amount" name="comm_amount" value="<?php echo $fm->total_com; ?>">   
					<label for="total_tax"> TOTAL Tax </label><input type="text" id="total_tax" name="total_tax" value="<?php echo $fm->tax_a; ?>">   
					<label for="net_amount"> TOTAL Payable Amount</label><input type="text" id="net_amount" name="net_amount" value="<?php echo $fm->pay_amount; ?>">   
					<div class="form-group form-actions">	
						<div class="col-md-5 col-md-offset-1">
						<!--	  <input class="btn btn-sm btn-primary" type="button" value="Save" onclick="save_data();"> -->
					<button class="btn btn-sm btn-primary" type="submit">
								<i class="fa fa-floppy-o"></i> Save
							</button>
						<button class="btn btn-sm btn-warning" type="reset">
								<i class="fa fa-repeat"></i> Reset
							</button>							
						</div>
					</div>
		

				<div class="form-group form-actions">	
						<div class="col-md-5 col-md-offset-1">
						   	<!-- <input class="btn btn-sm btn-primary" type="button" value="Save" onclick="save_data();">-->	
						
						<input class="btn btn-sm btn-primary" type="button" value="ADD To Bill"  onclick="save_bill_temp();" >							
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
			url: "<?php echo base_url(); ?>" + "admin/ro_billing/get_channels",
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
				$("#fmc option[value='<?php echo $fm->fmc_id; ?>']").attr('selected',true);
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
			url: "<?php echo base_url(); ?>" + "admin/ro_billing/get_city",
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
				$("#city option[value='<?php echo $fm->city; ?>']").attr('selected',true);
				
				},
			error: function() 
					{                    
						alert("Please Select Channel!");
					}
			});
}  
function save_bill_temp()
{
	var  ro_id=$("#ro_id").val();
	var  ro_no=$("#ro_no").val();
	var  client_id=$("#client_id").val();
	var  ro_date=$("#ro_date").val();
	var  fmg=$("#fm_group").val();
	var  fmc=$("#fmc").val();
	var  heading=$("#heading").val();
	var date_from=$('#date_f').val();
	var  date_ to=$('#date_t').val();
	var  day=$("#day").val();
	var  sd=$("#sd").val();;
	var  day_times=$("#day_times").val();
	var  ts=$("#ts").val();	
	var  rp10=$("#rp10").val();
	var  slot_rate=$("#slot_rate").val();
	var  matter=$("#matter").val();
	var  amount=$("#total").val();
//	var  add_on_amount=$("#add_a").val();
//	var  dis_per=$("#discount_percentage").val();
	var  discount=$("#dis_a").val();
//	var  box_charges=$("#box_c").val();
//	var  payable_amount=$("#p_amount").val();
//	var  ro_date=$("#ro_date").val();
//	var  p_date=$("#checked_dops").val();
	// alert(newspaper); 
	// alert(a_newspaper);

//	if ($('#add_on').is(":checked")) 
//	{	
//		rate=$("#rate"+newspaper).val();
//		erate=$("#erate"+newspaper).val();
		
		var form_data= {'ro_id':ro_id,'ro_no':ro_no,'client_id':client_id,'emp_id':emp_id,'newspaper_id':newspaper,'cat_id':cat_id,'insertion':insertion,'p_date':p_date,'size_words':size_words,'min_w':min_w,'height':height,'width':width,'price':rate,'eprice':erate,'amount':amount,'premimum':premimum,'extra_price':extra_price,'add_on_amount':add_on_amount,'dis_per':dis_per,'discount':discount,'box_charges':box_charges,'payable_amount':payable_amount,'ro_date':ro_date,'a_newspaper':a_newspaper};
		//console.log(form_data); return false;
		$.ajax({                
		url: "<?php echo base_url(); ?>" + "admin/ro_billing/temp_save",
		type: "POST",				
		async: false ,               
		data: form_data,
		beforeSend: function(){ document.getElementById("loader").style.display = "block";},
		success: function(data)
		{
			//console.log(data); return;
			var arr = $("#a_newspaper").val();
			
			
			$.each(arr, function(i, d) {
				
				var p_date=$("#from-input"+d).val();
				var rate=$("#rate"+d).val();
				var erate=$("#erate"+d).val();	
				var insertion=$("#inse").val();	
				set_temp_details(ro_id,ro_no,d,p_date,rate,erate,insertion);
				
			});

			document.getElementById("loader").style.display = "none";
			
			
			//data['adon']=adon_arr;
			//console.log("adon data: "+adon_arr); 
			//return false;
			window.opener.bill_detail.push(data);
			window.close();
			window.opener.document.getElementById("func").onchange();			
		},                
		error: function() 
		{
			document.getElementById("loader").style.display = "none";
			alert("Ro not add !");
		}
		});
	

}

function set_temp_details(ro_id,ro_no,fmg,date_from,date_to,day){
	$.ajax({                
	url: "<?php echo base_url(); ?>" + "admin/ro_billing/set_temp_details",
	async: false,
	type: "POST",
	data: {ro_id:ro_id,ro_no:ro_no,paper_id:paper_id,dop:p_date,rate:rate,erate:erate,insertion:insertion},
	beforeSend: function(){ document.getElementById("loader").style.display = "block";},
	success: function(data)
		{
			//adon_arr=[];
			document.getElementById("loader").style.display = "none";
			//adon_arr.push(data); 
		}
	});
}

function update_discount()
{
	document.getElementById('dis_a').value=((parseFloat(document.getElementById('t_amount').value))*(parseFloat(document.getElementById('discount_percentage').value))/100).toFixed(2);
	document.getElementById('p_amount').value=(parseFloat(document.getElementById('t_amount').value)-(parseFloat(document.getElementById('dis_a').value))).toFixed(2);
	var client_id = $("#client").val();
	var cat_id = $("#cat_id").val();
	var type_id = $("#type_id").val();
	var newspaper_id = $("#newspaper").val();
	var discount_percentage = $("#discount_percentage").val();
	var city = $("#city").val();
	
	$.ajax({                
	url: "<?php echo base_url(); ?>" + "admin/ro_billing/update_discount",
	type: "POST",
	async: true ,
	data: {client_id:client_id,type_id:1,cat_id:cat_id,newspaper_id:newspaper_id,discount_percentage:discount_percentage},
	beforeSend: function(){ document.getElementById("loader").style.display = "block";},
	success: function(data)
		{
			document.getElementById("loader").style.display = "none";
			//console.log(data); return false;
		}
	});
}

$(window).load(function(){
    //$("#fm_group").load(function(){
      get_fmc();  
//    });
    
    get_city();
    daycount();
    total_amount();
    totalsec()
    
    
});
</script>
