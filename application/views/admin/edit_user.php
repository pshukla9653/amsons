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
						<strong>Edit </strong> Client
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-pack');
					echo form_open_multipart('admin/user/edit/'.$user->id, $attributes); ?>
					<?php
					echo "<div class='text-danger' align='center'>";
					echo validation_errors();
					echo "</div>";
					?>
										<div class="col-md-12">

<table id="myTable" class=" table order-list">
<input type="hidden" name="user_id" value="<?=$user->id?>">
<tbody id="parameter_values">
<?php $c=1; foreach($client_details as $row){ ?>
<tr>
<td class="col-lg-2">
<input type="hidden" name="id[]" value="<?= $row->id?>">
<input type="email" placeholder="Enter Email.." required="required" class="form-control" name="email[]" value="<?= $row->email; ?>">
</td>
<td class="col-lg-2"><input type="text" placeholder="Enter Contact Number" class="form-control" name="contact[]" value="<?= $row->contact; ?>"></td>

<td class="col-lg-2">
<input type="text" placeholder="Enter Address" class="form-control" name="address[]" value="<?= $row->address; ?>">
</td>
<td class="col-lg-2">
<select name="state[]" class="states form-control" id="state1" onchange="get_city(<?= $c ?>,this.selectedIndex);" required>
<option value="">Select State</option>
<?php foreach($states as $state){ 
	
?>
<option value="<?php echo $state->name; ?>" <?php if($state->name==$row->state){ echo "selected"; } ?>><?php echo $state->name ;?></option>
<?php }?>
</select>
</td>
<td class="col-lg-2">
<div id="city_block<?= $c ?>">
<select name="city[]" class="city form-control" id="city<?= $c ?>">
<option value="">Select City</option>
<?php foreach($cities[$c] as $row1){
	?><option <?php if($row1->name==$row->city){
	echo "selected";	
	} ?>><?= $row1->name ?></option>
	<?php
}?>
</select>
</div>
</td>
<td class="col-lg-2">
<input type="text"  placeholder="Enter GST Number" name="gst_no[]"  class="form-control" value="<?php echo $row->gst_no; ?>"/>
</td>
<td class="col-lg-1">
</td>

</tr>
<?php
$c++; }  ?>
</tbody>
<tfoot>
<tr>
<td colspan="5" style="text-align: left;">
<a href="#" class="btn btn-success" id="addrow"/>+
<!-- <i class="glyphicon glyphicon-plus"></i> -->
</a><td class="col-sm-2">
</td>
</tr>

</tfoot>
</table>
</div>
						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Name</label>
							<div class="col-md-9">
								<input type="text" placeholder="Enter Name" required="required" class="form-control" name="name" id="name" value="<?php echo (empty($user)) ? '' : $user->client_name ;?>">
							</div>
							</div>
							<!-- <div class="form-group">
							<label for="name" class="col-md-3 control-label">E-mail</label>
								<div class="col-md-9">
									<input type="email" placeholder="Enter E-mail" required="required" class="form-control" name="email" id="email" value="<?php echo (empty($user)) ? '' : $user->email ;?>">
								</div>
							</div> -->
							<!--<div class="form-group">
                                <label class="col-md-3 control-label" for="val_password">Password <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="password" id="val_password" name="pass" class="form-control" placeholder="Choose a crazy one.." required>
										<span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
									</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="val_confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <div class="input-group">
										<input type="password" id="val_confirm_password" name="c_pass" class="form-control" placeholder="..and confirm it!" required>
										<span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                    </div>
                                </div>
                            </div>-->
							<!-- <div class="form-group">
							<label for="name" class="col-md-3 control-label">Mobile</label>
								<div class="col-md-9">
									<input type="text" placeholder="Enter Mobile" required="required" class="form-control" name="mobile" id="mobile" value="<?php echo (empty($user)) ? '' : $user->mobile ;?>">
								</div>
							</div> -->
							<!-- <div class="form-group">
								<label class="col-md-3 control-label" for="pack-overview">Address</label>
								<div class="col-md-9">
									<textarea id="address" name="address" required="required" class="form-control"><?php echo (empty($user)) ? '' : $user->address ;?></textarea>
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">State</label>
								<div class="col-md-9">
									<select name="state" onchange="get_city();" class="states form-control" id="state" required>
										<option value="">Select State</option>
										<?php //foreach($states as $state){ ?>
											<option value="<?php //echo $state->name; ?>" <?php //echo ($state->name==$user->state)?'selected':'';?>><?php //echo $state->name ;?></option>
										<?php //}?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-md-3 control-label">City</label>
								<div class="col-md-9">
									<select name="city" class="cities form-control" id="city" required>
										<option value="">Select City</option>
									</select>
								</div>
							</div>							 -->
							<!-- <div class="form-group">
							<label for="name" class="col-md-3 control-label">Pin No.</label>
								<div class="col-md-9">
									<input type="text" placeholder="Enter Pin No." class="form-control" name="pin" id="pin" value="<?php echo (empty($user)) ? '' : $user->pin_code ;?>">
								</div>
							</div> -->
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Fax No.</label>
								<div class="col-md-9">
									<input type="text" placeholder="Enter Fax No." class="form-control" name="fax" id="fax" value="<?php echo (empty($user)) ? '' : $user->fax ;?>">
								</div>
							</div>
							<!-- <div class="form-group">
							<label for="name" class="col-md-3 control-label">VAT No.</label>
								<div class="col-md-9">
									<input type="text" placeholder="Enter VAT No." class="form-control" name="vat" id="vat" value="<?php echo (empty($user)) ? '' : $user->vat_no ;?>">
								</div>
							</div> -->
							<!-- <div class="form-group">
							<label for="name" class="col-md-3 control-label">CST No.</label>
								<div class="col-md-9">
									<input type="text" placeholder="Enter CST No." class="form-control" name="cst" id="cst" value="<?php echo (empty($user)) ? '' : $user->cst_no ;?>">
								</div>
							</div> -->
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Discount</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="dis" id="dis" value="<?php echo (empty($user)) ? '' : $user->discount ;?>">
								</div>
							</div>
							<!-- <div class="form-group">
							<label for="name" class="col-md-3 control-label">Services Tax NO.</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="stn" id="stn" value="<?php echo (empty($user)) ? '' : $user->ser_tax_no ;?>">
								</div>
							</div> -->
							<!-- <div class="form-group">
							<label for="name" class="col-md-3 control-label">TIN No.</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="tin" id="tin" value="<?php echo (empty($user)) ? '' : $user->tin_no ;?>">
								</div>
							</div> -->
							<!-- <div class="form-group">
							<label for="name" class="col-md-3 control-label">IT No.</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="itn" id="itn" value="<?php echo (empty($user)) ? '' : $user->it_no ;?>">
								</div>
							</div> -->
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Contact Person</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="c_per" id="c_per" value="<?php echo (empty($user)) ? '' : $user->contact_person ;?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Website</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="website" id="website" value="<?php echo (empty($user)) ? '' : $user->website ;?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Opening Balance</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="ob" id="ob" value="<?php echo (empty($user)) ? '' : $user->opening_bal ;?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Account</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="acc" id="acc" value="<?php echo (empty($user)) ? '' : $user->account ;?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Credit Period</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="cp" id="cp" value="<?php echo (empty($user)) ? '' : $user->credit_period ;?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Credit Limit</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="cl" id="cl" value="<?php echo (empty($user)) ? '' : $user->credit_limit ;?>">
								</div>
							</div>
							<div class="form-group">
								<label for="example-select" class="col-md-3 control-label">Client Type</label>
								<div class="col-md-9">
									<select size="1" class="form-control" name="ct" id="ct" onchange="add_agency();">
										<option value="">Please select</option>
										<option value="D" <?php echo ($user->client_type=='D') ? 'selected' : '';?>>Direct</option>
										<option value="I" <?php echo ($user->client_type=='I') ? 'selected' : '';?>>In Direct</option>
									</select>
								</div>
							</div>
								<div id="agency_l" style="display: none;">
								<div class="form-group">
									<label for="example-chosen-multiple" class="col-md-3 control-label">Select Agency</label>
									<div class="col-md-9">
										<select id="agency_id" name="agency_id[]" class="select-chosen" data-placeholder="Choose Agency" multiple>
										<?php foreach($agencydata as $ag){ ?>
											<option value="<?php echo $ag->agency_id ;//$ag->id; ?>" <?php echo set_select("agency_id[]",$ag->agency_id);?>><?php echo $ag->agency_name ;?>
											</option>
										<?php }?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Group Head</label>
								<div class="col-md-9">
									<label class="switch switch-primary">
										<input type="checkbox" <?php echo ($user->group_head=='1') ? 'checked' : 'unchecked';?> name="gh" id="gh">
										<span></span>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Shared Bill Party</label>
								<div class="col-md-9">
									<label class="switch switch-primary">
										<input type="checkbox" <?php echo ($user->shared=='1') ? 'checked' : 'unchecked';?> name="sbp" id="sbp" onchange="add_party();">
										<span></span>
									</label>
								</div>
							</div>
							<div id="shared_party" style="display: <?php echo ($user->shared=='1')?'block':'none';?>">
								<div class="form-group">
									<label for="example-select" class="col-md-3 control-label">Select Party</label>
									<div class="col-md-9">
										<select id="s_party" name="s_party[]" class="select-chosen" data-placeholder="Choose Party" multiple >
										<?php foreach($users as $key=>$user){  ?>
										<?php 
										
												if($share_party) {
											foreach($share_party as $select_val){
											
												if($user->id==$select_val->group_head) {
													$users[$key]->selected = 1;
													
												}
											}
											
										}
										 $selected_s = isset($users[$key]->selected)?'selected':'';?>
											<option value="<?php echo $user->id; ?>" <?php echo $selected_s;?> <?php echo set_select('s_party[]',$user->id);?>><?php echo $user->client_name ;?>
											</option>
										<?php }?>
										</select>
									</div>
								</div>
							</div>
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
$(document).ready(function (){
	var counter = 0;
	var c=2;
	$("#addrow").on("click", function () {
		var states = <?php echo json_encode($states); ?>;
		var newRow = $("<tr>");
		var cols = "";
		cols += '<td class="col-lg-2"><input type="hidden" name="id[]" value="0"><input type="email" placeholder="Enter Email.." required="required" class="form-control" name="email[]"></td><td class="col-lg-2"><input type="text" placeholder="Enter Contact Number" class="form-control" name="contact[]"></td><td class="col-lg-2"><input type="text" placeholder="Enter Address" class="form-control" name="address[]"></td><td class="col-lg-2"><select name="state[]" class="states form-control" id="state'+c+'"  onchange="get_city('+c+',this.selectedIndex);" required><option value="">Select State</option>';
		for(var i = 0; i < states.length; i++) {
			cols+='<option value='+states[i].name+'>'+states[i].name+'</option>';
			}
		cols+='</select></td><td class="col-lg-2"><div id="city_block'+c+'"></div></td><td class="col-lg-2"><input type="text" class="form-control" name="gst_no[]"  placeholder="Enter GST Number"/></td>';
		cols += '<td class="col-lg-1"><a href="#" class="ibtnDel btn btn-md btn-danger "  value="Delete">-</a></td>';
		newRow.append(cols);
		$("table.order-list").append(newRow);
		counter++;
		c++;
	});

	$("table.order-list").on("click", ".ibtnDel", function (event) {
		$(this).closest("tr").remove();
		counter -= 1
	});
});


function get_city(c,i){
	console.log(c+"/"+i+"<br>");
	$.ajax({
		url: "<?php echo base_url(); ?>" + "admin/user/get_city",
		type: "POST",
		async: true ,
		data: {state:i},
		beforeSend: function(){ document.getElementById("loader").style.display = "block";},
		success: function(data)
		{
			//console.log(data);
			var cities = $.parseJSON(data);
			console.log(cities);
			var st="<select name='city[]' class='city form-control' id='city"+c+"'>";

				for (var key in cities) {
					//console.log(cities[key].name);
					st+="<option>"+cities[key].name+"</option>";
				}
				st+="</select>";
				document.getElementById("city_block"+c).innerHTML=st;
			document.getElementById("loader").style.display = "none";
		},
		error: function(request, status, error)
		{
			document.getElementById("loader").style.display = "none";
			console.log("Error: "+request.responseText);
		}
	});
}
function add_party()
{
	var x = document.getElementById('shared_party');
	
    if ($('#sbp').is(":checked")) 
	{
        x.style.display = 'block';
    } 
	else 
	{
        x.style.display = 'none';
    }
	
}
function add_agency()
{
	var x = document.getElementById('agency_l');
	var y = document.getElementById('agency_b');
	
    if ($('#ct').val()=='I') 
	{
        x.style.display = 'block';
        y.style.display = 'none';
    } 
	else 
	{
        x.style.display = 'none';
        y.style.display = 'block';
    }
	
}

</script>