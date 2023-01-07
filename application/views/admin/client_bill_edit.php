<div id="page-content" style="min-height: 1189px;">
	<div class="block"  style="background-color:#dbe1e8;">
				<div class="block-title">
					<h2>
						<i class="fa fa-pencil"></i>
						<strong>Client Billing</strong>
					</h2>
				</div>
				<div class="row" style="background-color:#dbe1e8;">
	
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'ro_add');
					echo form_open_multipart('admin/client_bill/', $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo $this->session->flashdata('msg');
					echo "</div>";
	?>
	
				<div class="col-lg-4">
					<div class="form-group">
						 <?php 	$bb= array($bill);  ?>
						<label for="price" class="col-md-3 control-label">Date To</label>
                        <div class="col-md-9">
                            <input type="text" id="bill_id" name="bill_id" value="<?php echo $bill->id; ?>">
                            
						<input type="hidden" id="func" onchange="show_billable_rows();">
                            <input type="text" id="date_t" onchange="get_ros();" name="date_t" value="<?php echo $bill->bill_date; ?>" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
		</div>
		<div class="col-lg-4">
				<div class="form-group">
						<label class="col-md-2 control-label" for="example-chosen-multiple">Client<span class="text-danger">*</span></label>
                        <div class="col-md-8">
							<select id="client" name="client" onchange="get_ros();" class="form-control" data-placeholder="Choose Client" required>
								<option value="" >Select Client</option>
								<?php foreach($clients as $client){ 
									?>
									 <option value="<?php echo $client->id; ?>"
									<?php
									if($bill->client_id==$client->id){
										echo "selected='selected'";
									}
									?> ><?php echo $client->client_name; ?></option>
								<?php  } ?>
                            </select>
                        </div>
					</div>
				</div>
				<div class="col-lg-4">
				<div class="form-group">
						<label class="col-md-2 control-label" for="example-chosen-multiple">State<span class="text-danger">*</span></label>
                        <div class="col-md-8">
							<select id="client_state" name="client_state" class="form-control" data-placeholder="Choose State" required>
								<option value="">Select State</option>
                            </select>
                        </div>
					</div>
				</div>
		</form>
		</div>
			<div class="table-responsive" style="border-style: outset; height: 300px; overflow-y: scroll; background-color:#fff;">
				<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
					<thead>
						<tr role="row">
							<th style="width: 70px;" class="text-center">Ro No.</th>
							<th>Ro Date</th>
							<th class="text-center">Newspaper</th>
							<th class="text-center">Insertion</th>
							<th class="text-center">Heading</th>
							<th class="text-center">Size</th>
							<th class="text-center">Amount</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					
					foreach($unbilled_ros as $row){
							//echo '<pre>'; var_dump($row->ro_id); die;
							$dt=new DateTime($row->c_date);
							echo "<tr id=row_".$row->ro_no."  onclick=select_ro('".$row->id."','".$row->type_id."');><td class=text-center>".$row->ro_no."</td><td class=text-center>".$row->book_date."</td><td class=text-center>".$row->newspaper_name."</td><td class=text-center>"; 
							if($row->insertion==$row->publish_day){
								echo $row->insertion;
							}
							else
							{
								echo $row->publish_day;
							}
							echo "</td><td class=text-center>".$row->cat_name."</td><td class=text-center>".$row->size_words."</td><td class=text-center>".$row->p_amount."</td></tr>";
						}?>
					</tbody>
				</table>
				</div>
				<div class="table-responsive" style="border-style: outset; height: 300px; overflow-y: scroll; background-color:#fff;">
				<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products-billable" role="grid" aria-describedby="ecom-products_info">
					<thead>
						<tr role="row">
							<th style="width: 70px;" class="text-center">Bill_id/Ro Id</th>
							<th class="text-center">Booking Date</th>
														
							<th class="text-center">Newspaper</th>
							<th class="text-center">Inse</th>
							
							<th class="text-center">Heading</th>
							<th class="text-center">Rate</th>
							<th class="text-center">E_Rate</th>
							<th class="text-center">Size</th>
							<th class="text-center" colspan="2">Discount</th>
							<th class="text-center">Amount</th>
							
						</tr>

					</thead>
					<tbody>
					

						<?php 
						
							$extra_price =0;
							$box_charges =0;
						foreach($bill_details as $row)
						{
				 			$amount=0;
							$p_amount=0;
							 
$row->insertion=1;
							 $extra_price+=floatval($row->e_rate);
				            $box_charges+=floatval($row->box_charges);
				            if($row->type_id==2|| $row->type_id==3)
				            {
				            	$word_size=explode('X',$row->word_size);
				            	$len=$word_size[0];
				            	$width=$word_size[1];
				            	$amount+=floatval($row->rate)*floatval($len)*floatval($width)*($row->insertion);
				            }
				            else
				            {
				            $amount+=floatval($row->e_rate)*floatval($row->word_size)*($row->insertion);
				        	}
				        	
				            $prem=explode(",",$row->premim);

				            if($prem[1] == 'Rs')
				            {
				                $premimum+=(floatval($row->e_rate)+floatval($row->amount))+prem[0];
				            }
				            if($prem[1] == '%')
				            {
				                $premimum+=((floatval($row->e_rate)+floatval($row->amount))*prem[0])/100;
				            }

				            //premimum+=parseFloat(d.premimum);
				            $dis_per=$row->dis_per;
				            $ro_date=$row->pub_date;
				            $dis=($amount*$dis_per)/100;
				            
				            $p_amount+=$amount+$premimum-$dis;
				            $discount+=floatval($row->discount);
				             $total_Amount+=$p_amount;

						?>
						<tr style="cursor:pointer" id="billed_row_<?php echo  $row->ro_id ?>"><td class="text-center"><strong><?php echo  $row->bill_id ?>/<?php echo $row->ro_id ?></strong></td><td class="text-center"><strong><?php echo  $row->pub_date ?></strong></td><td class="text-center"><?php echo  $row->newspaper_title ?></td><td class="text-center"><?php echo  $row->insertion ?></td><td class="text-center"><?php echo  $row->cat_title ?></td><td class="text-center"><?php  echo  $row->rate ?><td class="text-center"><?php echo  $row->e_rate ?></td></td><td class="text-center"><?php echo $row->word_size ?></td><td class="text-center"><?php echo  $row->dis_per ?></td><td class="text-center"><?php echo  $row->discount ?></td><td class="text-center"><input type="hidden" name="amount_<?php echo  $row->ro_id ?>[]" value="<?php echo  $row->net_amount; ?>"><input type="hidden" name="p_am[]" value="<?php echo  $row->net_amount; ?>"><?php echo  $row->net_amount; ?>
									
									<a onclick="removeThisBillRow(<?php echo  $row->net_amount; ?>,<?php  echo $row->ro_id ?>,<?php echo $row->id ?>)" class="btn btn-danger delbtn">-</a><input type="hidden" name="ro_main_id[]" value="<?php echo  $row->ro_main_id ?>"></td>
								
							
						</tr>
					<?php 
					}
					?>
					</tbody>
				</table>
			</div>
</div>
<div class="row">
		<div class="col-lg-12">
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'client_bill');
					echo form_open('admin/client_bill/add', $attributes)
					?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
				<div class="col-lg-8 col-lg-offset-2">
				    <div class="col-md-12">
				        <div class="col-md-6">
            				    <div class="col-md-12">
                                <input type="button" name="shared_bill" id="shared_bill" value="Shared Bill" >
                                </div>
                                <div class="col-md-12">
                    
                                        <div class="table-responsive" id="share" style=" display:none; border-style: outset; height: 300px; overflow-y: scroll; background-color:#fff;">
                                             <label for="mshare" class="col-md-3">Main Party Share</label><input type="text" id="mshare" class="col-md-3"value="<?php echo $bill->Shared_Per;?>"><label class="col-md-3" for="other_share">other party share</label><input type="text" id="other_share"class="col-md-3" value="<?php echo (100-$bill->Shared_Per); ?>">
                            <table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="shared" role="grid" aria-describedby="ecom-products_info">
                                <thead style="position:sticky;top:0">
                                     
                                    <tr role="row">
                                        <th style="width: 70px;" class="text-center"><input type="checkbox" id='check' onClick="selectAll(this)"></th>
                                        <th class="text-center">Shared parties</th>
                                    </tr>
                                   
                                    
                                    
                                </thead>
                                <tbody>
                                    <?php  if(!empty($client_data1)){   foreach($client_data1 as $d) { ?>
                                    <tr ><td class="text-center"><input type="checkbox" name="sh_p" id="<?php echo $d->id ;?>" <?php foreach($sh_parties as $sp){if($d->client_id==$sp->client_id){?>onclick="cancel_party(<?php echo $sp->id ;?>)"<?php }} ?> value="<?php echo $d->client_id ;?>" <?php foreach($sh_parties as $sp){if($d->client_id==$sp->client_id){echo "checked";}}?>><input type="hidden" id="sp[]" value="<?php echo $d->client_id ;?>"></td> <td class="text-center"><?php echo $d->client_name ;?></td></tr>
                                    <?php } } ?>
                                    <button type="button" id="apply" name="apply">Apply</button>
                                </tbody>
                                <tfooter>
                                
                                </tfooter>
                            </table>
                        </div>
                                    </div>
                                    </div>
                   <div class="col-md-6">
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Due Days</label>
						<div class="col-md-9">
							<input type="number" placeholder=""  min="1" class="form-control" name="due_day" id="due_day" value="30" required>
						</div>
					</div>
					        
                
           
							<?php  if($bill->Shared=='YES')
							
							{
							    $billamount=$bill->amount;
							    
							    foreach($sh_parties as $ss)
							    {
							     $billamount+= $ss-> amount; 
							    }
							}
							?>		
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Amount</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="amount" id="amount" value="<?php if($bill->Shared=='YES'){echo $billamount;}else{echo $bill->amount;} ?>">
						</div>
					</div>					
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Box Charges</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="box_c" id="box_c"  value="<?php echo $bill->box_charges ?>" onchange="bill_amount()">
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label"><span id="dis_per1"><?php echo $bill->dis_per ?></span>% discount</label>
						<div class="col-md-9">
						<input type="hidden" name="dis_per" id="dis_per"  value="<?php $bill->dis_per ?>">
							<input type="text" placeholder="" class="form-control" name="discount" id="discount"  value="<?php echo $bill->discount ?>" onchange="bill_amount()">
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Total</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="total" id="total"  value="<?php if($bill->Shared=='YES'){echo ($billamount-$bill->discount+$bill->box_charges);}else{echo ($bill->amount-$bill->discount+$bill->box_charges);} ?> " onchange="bill_amount()">
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Art work Charges</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="at_w" id="at_w"  value="0" onchange="bill_amount()">
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Other Charges</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="other_c" id="other_c"  value="<?php echo $bill->other_charges ?>" onchange="bill_amount()">
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">CGST</label>
						<div class="col-md-3">
							<input type="text" placeholder="" class="form-control" name="cgst" id="cgst"  value="<?php $bill->cgst ?>">
						</div>	
						<div class="col-md-3">
						<label for="price" class="col-md-3 control-label">SGST</label>
						</div>
						<div class="col-md-3">
							<input type="text" placeholder="" class="form-control" name="sgst" id="sgst"  value="<?php $bill->sgst ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">IGST</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="igst" id="igst"  value="<?php $bill->igst ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Net Amount</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="net_amount" id="net_amount"  value="<?php $bill->net_amount ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-9 col-md-offset-3">
							<div class="btn btn-sm btn-primary" onclick="bill_amount();">
									Calculate
							</div>
							<input class="btn btn-sm btn-primary" type="button" value="Update Bill" onclick="update_bill();">
						</div>
					</div>
					
				</div>
				</form>
				</div>
				</div>
		</div>
</div>


<script type="text/javascript">
var shared_client=[];
var shared_per =0;
var main_shared_per=0;
var bill_details=[];
var remove_bill=[];
var sparties=jQuery.parseJSON('<?php echo json_encode($sh_parties);?>');
var sp=[];
var cancel_parties=[];
$.each(sparties,function(i,d){
    sp.push(d.client_id);
});
console.log(sp);
var removeid=[];
 bill_details =jQuery.parseJSON('<?php echo json_encode($bill_details1);?>');
 var billrosize=bill_details.length-removeid.length;
  
$(document).ready(function(){
    get_state(<?php echo $bill->client_id; ?>);
    $("#mshare").change(function(){
        $v=100-$("#mshare").val();
        $("#other_share").val($v);
    });
    $("#shared_bill").click(function(){
      
        $("#share").toggle();
    });
   
     $("#apply").click(function(){
            var favorite = [];
            // $.each($("input[name='sh_p1']:checked"), function(){
            //     shared_client.push($(this).val());
              
                
            // });
            shared_client=[];
            console.log("ff"+shared_client);
            $.each($("input[name='sh_p']:checked"), function(){
                shared_client.push($(this).val());
                shared_per=$("#other_share").val();
                main_shared_per=$("#mshare").val();
                
            });
            console.log(shared_client);
            if(shared_client.length==0){alert ("NO party is selected;")}
            else{
             $("#share").hide();}
           
        });
});
function cancel_party(id)
{
    if($("#"+id).is(":checked"))
    {
        $.each(cancel_parties,function(i,d){
            if(d==id)
            {
                cancel_parties.splice(i,1);
            }
        });
      
    }
    else
    {
    cancel_parties.push(id);
    }
    console.log(cancel_parties);
}
 function get_shared()
    {
        var favorite = [];
            // $.each($("input[name='sh_p1']:checked"), function(){
            //     shared_client.push($(this).val());
              
                
            // });
            shared_client=[];
            console.log("ff"+shared_client);
            $.each($("input[name='sh_p']:checked"), function(){
                shared_client.push($(this).val());
                shared_per=$("#other_share").val();
                main_shared_per=$("#mshare").val();
                
            });
            console.log(shared_client);
            if(shared_client.length==0){alert ("NO party is selected;")}
            else{
             $("#share").hide();}
    }
function selectAll(source) {
  checkboxes = document.getElementsByName('sh_p');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
    // $("#date_t").datepicker().datepicker("setDate", new Date());
    function get_ros()
    {	
        var date_2= $("#date_t").val();
        var client= $("#client").val();
        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/client_bill/get_ros",
            type: "POST",				
            async: true ,               
            data: {'date_t':date_2,'client':client},
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                //console.log(data); return false;
                document.getElementById("loader").style.display = "none";
                if(data=='1')
                {
                    alert("Fill All Mandatory Fields.");
                    return false;
                }
                if(data=='2')
                {
                    alert("No Ro Found.");
                    return false;
                }
                var tr = $.parseJSON(data);
                $("#ecom-products tbody").html("");
                $("#shared tbody").html("");
                $.each(tr.ros, function(i, d) 
                       {
                    $("#ecom-products tbody").append('<tr id="row_'+d.ro_no+' onclick="select_ro('+ d.id +','+ d.type_id +');" style="cursor:pointer" id="row_'+d.ro_no+'"><td class="text-center"><strong>'+d.ro_no+'</strong></td><td>'+d.book_date+'</td><td class="text-center">'+d.newspaper_name+'</td><td class="text-center">'+d.publish_day+'</td><td class="text-center">'+d.cat_title+'</td><td class="text-center">'+d.size_words+'</td><td class="text-center">'+d.payable_amount+'</td></tr>');
                });
                $.each(tr.client_data, function(i, d) 
                       {
                           //alert(d.client_name);
                    $("#shared tbody").append('<tr ><td class="text-center"><input type="checkbox" name="sh_p" id="check[]" value="'+d.client_id+'"><input type="hidden" id="sp[]" value="'+d.client_id+'"></td> <td class="text-center">'+d.client_name+'</td></tr>');
                });
            },                
            error: function() 
            {
                document.getElementById("loader").style.display = "none";
                alert("Please Select Position!");
            }
        });
        get_state(client);
    }

function get_state(client){
	$.ajax({                
		url: "<?php echo base_url(); ?>" + "admin/client_bill/get_states",
		type: "POST",				
		async: true ,               
		data: {'client':client},
		beforeSend: function(){ document.getElementById("loader").style.display = "block";},
		success: function(data)
		{
			document.getElementById("loader").style.display = "none";
			var tr = $.parseJSON(data);
			$("#client_state").html("");
			$.each(tr, function(i, d) 
			{
				$("#client_state").append('<option value='+ d.state +'>'+ d.state +'</option>');
			});
		},                
		error: function() 
		{
			document.getElementById("loader").style.display = "none";
			alert("Please Select Position!");
		}
	});
}
var bill_detail=[];
var popup;
function select_ro(id,type,bill_no=0)
{
	if(bill_no!=''||bill_no!=0){
		if(type==1)
		{
			var url="<?php echo base_url(); ?>" + "admin/ro_billing/bill_text_edit/"+id+"/"+bill_no;
		}
		if(type==2)
		{
			var url="<?php echo base_url(); ?>" + "admin/ro_billing/bill_cd_edit/"+id;
		}
		if(type==3)
		{
			var url="<?php echo base_url(); ?>" + "admin/ro_billing/bill_hd_edit/"+id;
		}
	}else
	{
		if(type==1)
		{
			var url="<?php echo base_url(); ?>" + "admin/ro_billing/text_edit/"+id;
		}
		if(type==2)
		{
			var url="<?php echo base_url(); ?>" + "admin/ro_billing/cd_edit/"+id;
		}
		if(type==3)
		{
			var url="<?php echo base_url(); ?>" + "admin/ro_billing/hd_edit/"+id;
		}
	}

	popup = window.open(url, "Popup", top='0', right='100');
	popup.focus();
	bill_detail=[];
	return false;
}






 function show_billable_rows(){
       console.log('bill_detail'+bill_details);
console.log('remove_bill'+remove_bill);
        var payable_amount=0;
        var amount=0;
        var extra_price=0;
        var box_charges=0;
        var dis_per=0;
        var discount=0;
        var premimum=0;
        var tr = $.parseJSON(bill_detail);
        //$.each(bill_details,function(i,d){alert(d.bill_id);})     ;
        var c=0;
        $("input[name='ro_main_id[]']").each(function(){c++});
        billrosize=bill_details.length-removeid.length;
        console.log(bill_details.length);
        console.log(removeid);
        var ss=parseInt(billrosize)-parseInt(1);
       alert(ss);
    
    if(ss != -1)
       {
        $("#ecom-products-billable tbody").find("tr:gt('"+ parseInt(c) +"')").remove();
           }
       else
       {
         $("#ecom-products-billable tbody").html("");  
       }
      //  alert("remoe");
// 		 $.each(bill_details,function(i,d){
		 	
// 		 	if(jQuery.inArray(parseInt(d.id),remove_bill)>=0)
// 		 	{
// 		 		return;
// 		 	}
// 		 	else
// 		 	{	
			 //	 extra_price+=parseFloat(d.e_rate);
			 	
	   //         box_charges+=parseFloat(d.box_charges);
	   //         if(d.type_id==2|| d.type_id==3)
	   //         {
	   //         	var word_size=d.word_size.split('X');
	   //         	var len=word_size[0];
	   //         	var width=word_size[1];
	   //         	amount+=parseFloat(d.rate)*parseFloat(len)*parseFloat(width)*(d.insertion);
	   //         }
	   //         else
	   //         {
	   //         amount+=parseFloat(d.e_rate)*parseFloat(d.word_size)*(d.insertion);
	   //     	}
	   //         amount+=parseFloat(d.e_rate)*parseFloat(d.word_size)*(d.insertion);

	   //         prem=d.premimum.split(",");

	   //         if(prem[1] == 'Rs')
	   //         {
	   //             premimum+=(parseFloat(d.e_rate)+parseFloat(d.amount))+prem[0];
	   //         }
	   //         if(prem[1] == '%')
	   //         {
	   //             premimum+=((parseFloat(d.e_rate)+parseFloat(d.amount))*prem[0])/100;
	   //         }

	   //         //premimum+=parseFloat(d.premimum);
	   //         dis_per=d.dis_per;
	   //         ro_date=d.pub_date;
	            
	   //         dis=(amount*dis_per)/100;
	   //      //   alert(amount+'+'+dis);
	   //         p_amount=amount+premimum-dis;
	   //         discount+=parseFloat(d.discount);
	             
	            
	   //         $('#row_'+d.ro_no).hide();
	   //     	 $("#ecom-products-billable tbody").append('<tr style="cursor:pointer" id="billed_row_'+d.id+'"><td class="text-center"><strong>'+d.id/d.ro_no+'</strong></td><td>'+d.pub_date+'</td><td class="text-center" onclick="select_ro('+ d.ro_id +','+d.type_id+','+d.bill_id+');">'+d.newspaper_title+'</td><td class="text-center">'+d.insertion+'</td><td class="text-center">'+d.cat_title+'</td><td class="text-center">'+d.rate+'</td><td class="text-center">'+d.e_rate+'</td><td class="text-center">'+d.word_size+'</td><td class="text-center">'+d.dis_per+'</td><td class="text-center">'+dis+'</td><td class="text-center">'+p_amount+'<a onclick="removeThisRow('+d.payable_amount+','+d.ro_no+','+d.emp_id+','+d.ro_id+','+d.work_year+')" class="btn btn-danger delbtn">-</a></td></tr>');
	   //     	 payable_amount=(parseFloat(payable_amount)+parseFloat(p_amount)).toFixed(2);
    //     	//}
    //     });
        $.each(tr, function(i, d) 
               {


            extra_price+=parseFloat(d.extra_price);
            box_charges+=parseFloat(d.box_charges);
            amount+=parseFloat(d.amount);

            prem=d.premimum.split(",");

            if(prem[1] == 'Rs')
            {
                premimum+=(parseFloat(d.extra_price)+parseFloat(d.amount))+prem[0];
            }
            if(prem[1] == '%')
            {
                premimum+=((parseFloat(d.extra_price)+parseFloat(d.amount))*prem[0])/100;
            }

            //premimum+=parseFloat(d.premimum);
            dis_per=d.dis_per;
            ro_date=d.ro_date;
            discount+=parseFloat(d.discount);
            $('#row_'+d.ro_no).hide();
            $("#ecom-products-billable tbody").append('<tr style="cursor:pointer" id="billed_row_'+d.ro_no+'"><td class="text-center"><strong>'+d.ro_no+'</strong></td><td>'+d.ro_date+'</td><td class="text-center" onclick="select_ro('+ d.ro_id +','+d.type_id+');">'+d.newspaper_title+'</td><td class="text-center">'+d.insertion+'</td><td class="text-center">'+d.cat_title+'</td><td class="text-center">'+d.price+'</td><td class="text-center">'+d.eprice+'</td><td class="text-center">'+d.size_words+'</td><td class="text-center">'+d.dis_per+'</td><td class="text-center">'+d.discount+'</td><td class="text-center"><input type="hidden" name="p_amount[]" value="'+d.payable_amount+'">'+d.payable_amount+'<a onclick="removeThisRow('+d.payable_amount+','+d.ro_no+','+d.emp_id+','+d.ro_id+','+d.work_year+')" class="btn btn-danger delbtn">-</a></td></tr>');
            payable_amount=(parseFloat(payable_amount)+parseFloat(d.payable_amount)).toFixed(2);
            $("input[name='p_am[]']").each(function(){
   
    payable_amount=parseFloat(payable_amount)+parseFloat($(this).val());
});
           // alert(d.payable_amount);
        });

       // document.getElementById("amount").value=(parseFloat(amount)+parseFloat(extra_price)+parseFloat(premimum)-parseFloat(discount)).toFixed(2);	
        $("#amount").val(payable_amount);	
        $("#dis_per1").html(dis_per);
        $("#dis_per").val(dis_per);
        $("#discount").val(discount);
        $("#box_c").val(box_charges);
        $("#ro_date").val(ro_date);
        $("#total").val((parseFloat(payable_amount)+parseFloat(box_charges)).toFixed(2));
        bill_amount();
    }
function update_bill()
{ 
   get_shared();
    var bill_id=$("#bill_id").val();
	var amount=parseFloat($("#amount").val());
        var bill_date=$("#date_t").val();
        var box_c=parseFloat($("#box_c").val());
        var at_work_c=parseFloat($("#at_w").val());
        var other_c=parseFloat($("#other_c").val());
        var total=parseFloat($("#total").val());
        var dis_per=parseFloat($("#dis_per").val());
        var discount=parseFloat($("#discount").val());
        var art_work_charges=parseFloat($("#at_w").val());
        var other_charges=parseFloat($("#other_c").val());
        var cgst=parseFloat($("#cgst").val());
        var sgst=parseFloat($("#sgst").val());
        var igst=parseFloat($("#igst").val());
        var net_amount=parseFloat($("#net_amount").val());
        var client=$("#client").val();
        var due_day=$("#due_day").val();
       // var remove_bill=remove_bill;
        var form_data={'amount':amount,'client':client,'box_c':box_c,'art_work_c':at_work_c,'shared_client':shared_client,'shared_per':shared_per,'mshare':main_shared_per,'other_c':other_c,'total':total,'net_amount':net_amount,'due_day':due_day,'igst':igst,'cgst':cgst,'sgst':sgst,'dis_per':dis_per,'discount':discount,'art_work_charges':art_work_charges,'other_charges':other_charges,'bill_date':bill_date,'remove_bill':remove_bill,'bill_id':bill_id,'cancel_parties':cancel_parties};
        console.log(form_data);
	// var amount=parseFloat($("#amount").val());
	// var box_c=parseFloat($("#box_c").val());
	// var at_work_c=parseFloat($("#at_w").val());
	// var other_c=parseFloat($("#other_c").val());
	// var total=parseFloat($("#total").val());
	// var dis_per=parseFloat($("#dis_per").val());
	// var discount=parseFloat($("#discount").val());
	// var art_work_charges=parseFloat($("#at_w").val());
	// var other_charges=parseFloat($("#other_c").val());
	// var cgst=parseFloat($("#cgst").val());
	// var sgst=parseFloat($("#sgst").val());
	// var igst=parseFloat($("#igst").val());
	// var net_amount=parseFloat($("#net_amount").val());
	// var client=$("#client").val();
	// var due_day=$("#due_day").val();

	// var form_data= {'amount':amount,'client':client,'box_c':box_c,'art_work_c':at_work_c,'other_c':other_c,'total':total,'net_amount':net_amount,'due_day':due_day,'igst':igst,'cgst':cgst,'sgst':sgst,'dis_per':dis_per,'discount':discount,'art_work_charges':art_work_charges,'other_charges':other_charges,'remove_bill':remove_bill};
	//console.log(form_data); return false;
	$.ajax({                
		url: "<?php echo base_url(); ?>" + "admin/client_bill/update_bill",
		type: "POST",				
		async: true ,               
		data: form_data,
		beforeSend: function(){ document.getElementById("loader").style.display = "block";},
		success: function(data)
		{
			document.getElementById("loader").style.display = "none";
			console.log("data: "+data);
			if(data=='1')
			{
				alert("Fill All Mandatory Fileds.");
				return false;
			}
			if(data=='2')
			{
				alert("Select Ro For Bill.");
				return false;
			}					
			if(data=='5')
			{
				alert("Bill Updated Successfully.");
				window.location.replace("<?php echo base_url(); ?>" + "admin/client_bill/");
			}
		},                
		// error: function() 
		// {
		// 	document.getElementById("loader").style.display = "none";
		// 	alert("Ro not add !");
		// }
		error: function(request, status, error)
		{
		document.getElementById("loader").style.display = "none";
		//console.log("Error is: "+request.responseText);
		}

	});
} 

 function bill_amount(){
        var state=$("#client_state").val();
         var amount= 0;
        $("input[name='p_amount[]']").each(function(){
    
    amount+=parseFloat($(this).val());
});
        var amount= (parseFloat($("#amount").val())).toFixed(2);
        var box_c= parseFloat($("#box_c").val());	
        var at_work_c= parseFloat($("#at_w").val());
        var other_c= parseFloat($("#other_c").val());
        //var discount= parseFloat($("#discount").val());
        var ro_date=$("#ro_date").val();
        var total=0;
        var cgst=0;
        var	sgst=0;
        var	igst=0;
        //console.log("state"+state+"amount"+amount+"box_c"+box_c+"at_work_c"+at_work_c+"other_c"+other_c+"ro_date"+ro_date);
        total= taxable_amount=parseFloat(amount)+parseFloat(box_c);

        // 	var d1 = "2011-03-02T15:30:18-08:00";
        // 	var d2 = "2011-03-02T15:36:05-08:00";
        // if (new Date(d1) < new Date(d2)) {alert('newer')}
        var date_t=$("#date_t").val();
        var first_date=date_t; 
        var second_date="2017-07-01"; 
        //console.log(ro_date);
        if(new Date(first_date)>=new Date(second_date)){
            if(state==null){
                	<?php if($cgst){ ?>
				cgst=((parseFloat(<?php echo $cgst->tax_depned;?>)*<?php echo $cgst->tax_rate;?>)/100).toFixed(2);
				<?php } else {?>
                cgst=0;
				<?php }?>
					<?php if($sgst){ ?>
				sgst=((parseFloat(<?php echo $sgst->tax_depned;?>)*<?php echo $sgst->tax_rate;?>)/100).toFixed(2);
				<?php } else {?>
                sgst=0;
				<?php }?>
                igst=0;	
            }
            else if(state=="Chandigarh"){
            	<?php if($cgst){ ?>
				cgst=((parseFloat(<?php echo $cgst->tax_depned;?>)*<?php echo $cgst->tax_rate;?>)/100).toFixed(2);
				<?php } else {?>
                cgst=0;
				<?php }?>
					<?php if($sgst){ ?>
				sgst=((parseFloat(<?php echo $sgst->tax_depned;?>)*<?php echo $sgst->tax_rate;?>)/100).toFixed(2);
				<?php } else {?>
                sgst=0;
				<?php }?>
                igst=0;
                
            }
            else{
                cgst=0;
                sgst=0;
                 <?php if($igst){ 
                    
                    ?>
                    
               igst=((parseFloat(<?php echo $igst->tax_depned;?>)*<?php echo $igst->tax_rate;?>)/100).toFixed(2);
                     
                <?php } else {?>
                igst=0;
                
                <?php }?>
            }
        }
      
        document.getElementById("cgst").value=cgst;
        document.getElementById("sgst").value=sgst;
        document.getElementById("igst").value=igst;
        document.getElementById("total").value = total.toFixed(2);
        document.getElementById("net_amount").value=(parseFloat(total)+parseFloat(cgst)+parseFloat(igst)+parseFloat(sgst)+parseFloat(at_work_c)+parseFloat(other_c)).toFixed(2);
    }

function removeThisRow(amount,ro_no,emp_id,ro_id,work_year){
       // alert(work_year);
     //  $("#ecom-products tbody").find('#row_'+d.ro_no).show();
        $('#row_'+ro_no).show();
        $.ajax({
            url: "<?php echo base_url(); ?>" + "admin/client_bill/remove_ro",
            type: "POST",				
            async: false,               
            data: {'ro_id':ro_id,'work_year':work_year,'emp_id':emp_id},
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                alert(data);
                document.getElementById("loader").style.display = "none";
            },                
            
            error: function(request, status, error)
            {
                document.getElementById("loader").style.display = "none";
                //console.log("Error is: "+request.responseText);
            }
        });
 
        $("#amount").val(parseFloat($("#amount").val())-parseFloat(amount));
        bill_amount();
         var roid="billed_row_"+ro_no;
          $("table#ecom-products-billable").find("tr[id='"+roid+"']").remove();
    }
    function removeThisBillRow(amount,ro_id,id){
        var s="amount_"+ro_id+"[]";
        var roid="billed_row_"+ro_id;
       // alert(roid);
    	if(ro_id !=null)
    	{  removeid.push(id);
    		remove_bill.push(ro_id);
    	}
    	var am=0;
    // $.each(x,function(i,d){ am+=d;});
    // alert(am);
    //var x=	$("input[name='"+ s+"']").val();
    var arrNumber = new Array();
$("input[name='"+ s+"']").each(function(){
    arrNumber.push($(this).val());
    am+=parseFloat($(this).val());
});
//alert(am);
 //   alert(x);
 
    
        $("#amount").val(parseFloat($("#amount").val())-parseFloat(am));
        bill_amount();
        $("table#ecom-products-billable").find("tr[id='"+roid+"']").remove();
      //  $('#'+roid).remove();
       
    }
function update_amount(amount,ro_id,id)
{ var s="amount_"+ro_id+"[]";
     var arrNumber = new Array();
 $("input[name='"+ s+"']").each(function(){
    arrNumber.push($(this).val());
    am+=parseFloat($(this).val());
});
alert(am);
 //   alert(x);
 
    
        $("#amount").val(parseFloat($("#amount").val())-parseFloat(am));
        bill_amount();
   
}
    // $("table#ecom-products-billable").on("click", ".delbtn", function (event) {
    //     $(this).find("tr[id='"+roid+"']").remove();
    // });
     $(document).ready(function(){
         var sharedbi='<?php echo $bill->Shared; ?>';
         if(sharedbi=='YES')
         {
         $("#share").css({"display":"block", "border-style": "outset", "height": "300px", "overflow-y": "scroll", "background-color":"#fff"});
        get_shared();
         }
     })
</script>