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
						<strong>Add New</strong> Voucher
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content --><div class="col-lg-12">

<span class="text-danger"> <?php 
if(isset($message)){
echo $message; 
}
$error=validation_errors(); 
if(!empty($error)){
	echo "Errors: ".validation_errors();
}?>
</span>
</div>
<form method="post" action="<?php echo base_url('admin/vouchers/insert'); ?>" id="form">
<div class="row">
<div class="col-lg-1">
	<div class="form-group">
		<label>V No :</label>
		<input type="text" id="voucher_no"  name="voucher_no" class="form-control" value="<?= $voucher_no+1 ?>" required readonly>
	</div>
</div>
<div class="col-lg-2">
	<div class="form-group">
		<label>Voucher Date :</label>
		<input type="text" id="voucher_date" autocomplete="off" name="voucher_date" class="form-control" required onblur="get_ledgers()">
	</div>
</div>

<div class="col-lg-2">
	<div class="form-group">
		<label>Entry Type</label>
		<select class="form-control" id="voucher_type" onchange="get_last_voucher_date()">
			<option value="cash_payment">Cash Payment</option>
			<option value="cash_receipt">Cash Receipt</option>
			<option value="bank_payment">Bank Payment</option>
			<option value="bank_receipt">Bank Receipt</option>
			<option value="journal">Journal</option>
			<option value="contra">Contra</option>
		</select>
	</div>
</div>
<div class="col-lg-2">
	<div class="form-group">
		<label>Entry Type :</label>
		<select class="form-control" id="entry_type" onblur="get_ledgers()" onchange="get_ledgers()">
			<option value="cr">Cr</option>
			<option value="dr">Dr</option>
		</select>
	</div>
</div>
<div class="col-lg-3">
	<div class="form-group">
		<label>Select Ledger :</label>
		<select class="form-control" id="led_id">
			<?php foreach($ledger_results as $row){
			?>
			 <option value='<?php echo $row['ledger_id']; ?>'><?php echo ucfirst($row['ledger_name']); ?></option> 
			<?php }?>
		</select>
	</div>
</div>
<div class="col-lg-2">
	<div class="form-group">
		<label>Amount :</label>
		<input type="text" id="amount" class="form-control"  value="<?php echo set_value('amount'); ?>">
	</div>
</div>
<div class="form-group">
	<label>Narration :</label>
	<input type="text" name="narration" id="narration" class="form-control" required>
</div>
<div class="form-group">
				<div class="btn btn-default" onclick="add_in_table()">Add entry</div>
</div>
<div class="form-group">
	<label for="example-select" class="col-md-3 control-label"></label>
	<div class="col-md-12">
		<table id="myTable" class="table order-list table-bordered">
		<!-- <form method="post" action="<?php //echo base_url("admin/vouchers/insert"); ?>"> -->
		<thead><tr><th>Voucher no.</th><th>Cr/Dr</th><th>Ledger name</th><th>Amount</th></tr></thead>
				<tbody id="ledger_values">
					<!-- <tr>
						<td class="col-lg-3">
						<input type="hidden" placeholder="" required="required" class="form-control" name="email[]"> 
						</td>
					<td class="col-lg-3">
					<input type="text" placeholder="" class="form-control" name="address[]">
						</td>
					
						<td class="col-lg-3">
							<input type="text"  placeholder="" name="gst[]"  class="form-control"/>
						</td>
						<td class="col-lg-3">
							<input type="text"  placeholder="" name="contact[]"  class="form-control"/>
						</td>
					</tr> -->
				</tbody>
				<!-- <tfoot>
					<tr>
						<td colspan="5" style="text-align: left;">
							<a href="#" class="btn btn-success" id="addrow"/>+
							 <i class="glyphicon glyphicon-plus"></i> 
						</a><td class="col-sm-2">
					</td>
				</tr>
			</tfoot> -->
		</table>
	</div>
</div>

</div>

<div class="form-group">
<input type="text" class="col-lg-6" id="dr_amount" value="0"><input type="text" class="col-lg-6" id="cr_amount" value="0">
</div>
<div class="form-group">
	<!-- <input type="submit" class="btn btn-primary" value="Submit voucher" onclick="save_voucher()"/> -->
	<div class="btn btn-primary" id="submit_from">Submit Voucher</div>
</div>
</form>
			<!-- END General Data Block -->
            </div>
	<!-- END Product Edit Content -->
</div>
<?php echo date("y/m/d"); ?>
<script>
$( "#submit_from" ).click(function() {
if(parseFloat($("#cr_amount").val())==0 || parseFloat($("#dr_amount").val())==0){
	alert("Credit or debit can't be zero.");
}
else if(parseFloat($("#cr_amount").val())==parseFloat($("#dr_amount").val())){
	$( "#form" ).submit();
}else
{
	alert("Credit and debit is not equal");
}
 
});
$('#voucher_date').multiDatesPicker({
    dateFormat: 'yy-mm-dd',
    // addDates: ['2017-02-22', '2017-03-19'],
    // numberOfMonths: [3,2],
	maxDate:<?php echo date("y/m/d"); ?>
});

$("table.order-list").on("click", ".delbtn", function (event) {
	$(this).closest("tr").remove();
	var entry_type=$('#entry_type').val();
	var amount=parseFloat($(this).closest('tr').find('.current_amount').val());
	if(entry_type==="cr"){
		$("#cr_amount").val(parseFloat($("#cr_amount").val())-parseFloat(amount));
	}else if(entry_type==="dr"){
		$("#dr_amount").val(parseFloat($("#dr_amount").val())-parseFloat(amount));
	}	
});

function add_in_table(){
	var ledger_id=parseInt($('#led_id').val());
	var ledger_name=$('#led_id').find(":selected").text();
	var entry_type=$('#entry_type').val();
	var voucher_type=$('#voucher_type').val();
	var amount=parseFloat($('#amount').val());
	if(ledger_id > 0 && entry_type !== null && voucher_type !== null && amount > 0  && ledger_id > 0 ){
		$("#ledger_values").append('<tr><td lass="text-center"><strong><input type="hidden" value="'+ledger_id+'" name="ledger_id[]">'+ledger_name+'</strong></td><td><input type="hidden" value="'+entry_type+'" name="entry_type[]">'+entry_type+'</td><td class="text-center"><input type="hidden" value="'+voucher_type+'" name="voucher_type[]">'+voucher_type+'</td><td class="text-center"><input type="hidden" value="'+amount+'" name="amount[]" class="current_amount">'+amount+'</td><td class="text-center"><input type="button" class="btn btn-danger delbtn" value="-"></td></tr>');
		//update cr_amount and dr_amount
	if(entry_type==="cr"){
			$("#cr_amount").val(parseFloat($("#cr_amount").val())+parseFloat(amount));
	}else if(entry_type==="dr"){
			$("#dr_amount").val(parseFloat($("#dr_amount").val())+parseFloat(amount));
	}
	$('#led_id').focus();
	}	
}

function get_last_voucher_date(){
var voucher_type=$("#voucher_type").val();
var form_data={'voucher_type':voucher_type};
	//console.log(form_data);
	$.ajax({                
		url: "<?php echo base_url(); ?>" + "admin/vouchers/get_last_voucher_date",
		type: "POST",				            
		data: form_data,
		beforeSend: function(){ document.getElementById("loader").style.display = "block";},
		success: function(data)
		{
			document.getElementById("loader").style.display = "none";
			//alert("new");
			$("#voucher_no").val(data);
		},                
		error: function(request, status, error)
		{
			document.getElementById("loader").style.display = "none";
			console.log("Error is: "+request.responseText);
		}
	});
}

function get_ledgers(){
var entry_type=$("#entry_type").val();
var voucher_type=$("#voucher_type").val();
var form_data={'entry_type':entry_type,'voucher_type':voucher_type};
	//console.log(form_data);
	$.ajax({                
		url: "<?php echo base_url(); ?>" + "admin/vouchers/get_ledgers",
		type: "POST",				            
		data: form_data,
		beforeSend: function(){ document.getElementById("loader").style.display = "block";},
		success: function(data)
		{
			document.getElementById("loader").style.display = "none";
			console.log("data: "+data);
			var tr = $.parseJSON(data);
			$("#led_id").find('option').remove();
			$.each(tr, function(i, d)
			{
				//alert('i'+i+","+"d"+d);
				$("#led_id").append('<option value="'+d.ledger_id+'">'+d.ledger_name+'</option>');
			});
		},                
		error: function(request, status, error)
		{
			document.getElementById("loader").style.display = "none";
			console.log("Error is: "+request.responseText);
		}
	});
}
</script>




