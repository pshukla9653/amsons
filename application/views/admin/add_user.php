<style>
.center-block-k {
    display: block;
    margin: 0 auto;
    width: 57%;
}
h1.hed {
    font-size: 14px;
    font-weight: 600;
}
</style>


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
						<strong>Add New</strong> Client
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-pack');
					echo form_open_multipart('admin/user/add', $attributes); ?>
					<?php
					echo "<div class='text-danger' align='center'>";
					echo validation_errors();
					echo "</div>";
					?>
					<div class="row">
							<div class="col-md-12">
						<div class="col-md-6">
						<div class="form-group">
								<label for="name" class="col-md-3 control-label">Name</label>
								<div class="col-md-9">
									<input type="text" onchange="check_clientname();" placeholder="Enter Name" required="required" class="form-control" name="name" id="name"value="<?php echo set_value('name'); ?>">
								</div>
							</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
								<label for="name" class="col-md-3 control-label">User Name</label>
								<div class="col-md-9">
									<input type="text"  onchange="check_username();" placeholder="Enter a Unique User Name" required="required" class="form-control" name="uname" id="uname" value="<?php echo set_value('uname'); ?>">
								</div>
							</div>
							</div>
							<div class="col-md-12 ff">
<h1 class="hed">Address Block</h1>
					<table id="myTable" class=" table order-list">

<tbody id="parameter_values">
	<tr>
		<td class="col-lg-2">
		<input type="email" placeholder="Enter Email.." required="required" class="form-control" name="email[]">
		</td>
		<td class="col-lg-2"><input type="text" placeholder="Enter Contact Number" class="form-control" name="contact[]" maxlength="10" pattern="^(7|8|9)\d{9}$"></td>

		<td class="col-lg-2">
	<input type="text" placeholder="Enter Address" class="form-control" name="address[]">
		</td>
		<td class="col-lg-2">
		<select name="state[]" class="states form-control" id="state1" onchange="get_city(1,this.selectedIndex);" required>
		<option value="">Select State</option>
		<?php foreach($states as $state){ ?>
				<option value="<?php echo $state->name; ?>" <?php echo set_select('state', $state->name); ?> ><?php echo $state->name ;?></option>
		<?php }?>
	</select>
		</td>
		<td class="col-lg-2">
			<div id="city_block1">
		<select name="city[]" class="city form-control" id="city1">
			<option value="">Select City</option>
		</select>
	</div>
		</td>
		 <td class="col-lg-2">
			<input type="text"  placeholder="Enter GST Number" name="gst_no[]"  class="form-control"/>
		</td>
		<td class="col-lg-1">
		</td>

	</tr>
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
						<div class="center-block-k">
								
							<!--						
							<div class="form-group">
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
							<label for="name" class="col-md-3 control-label">E-mail</label>
								<div class="col-md-9">
									<input type="email" placeholder="Enter E-mail" required="required" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Mobile</label>
								<div class="col-md-9">
									<input type="text" placeholder="(999) 999-9999" required="required" pattern="[0-9]{10}" class="form-control" name="mobile" id="mobile" value="<?php echo set_value('mobile'); ?>">
								</div>
							</div>
							<div class="form-group">

							</div> -->
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Fax No.</label>
								<div class="col-md-9">
									<input type="text" placeholder="Enter Fax No." class="form-control" name="fax" id="fax" value="<?php echo set_value('fax'); ?>">
								</div>
							</div>
							<!-- <div class="form-group">
							<label for="name" class="col-md-3 control-label">GST No.</label>
								<div class="col-md-9">
									<input type="text" placeholder="Enter GST No." class="form-control" name="gst" id="gst" value="<?php echo set_value('gst'); ?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">VAT No.</label>
								<div class="col-md-9">
									<input type="text" placeholder="Enter VAT No." class="form-control" name="vat" id="vat" value="<?php echo set_value('vat'); ?>">
								</div>
							</div> -->
							<!-- <div class="form-group">
							<label for="name" class="col-md-3 control-label">CST No.</label>
								<div class="col-md-9">
									<input type="text" placeholder="Enter CST No." class="form-control" name="cst" id="cst" value="<?php echo set_value('cst'); ?>">
								</div>
							</div>
						</div> -->

						
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Discount</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="dis" id="dis" value="<?php echo set_value('dis'); ?>">
								</div>
							</div>
							
							<!-- <div class="form-group">
							<label for="name" class="col-md-3 control-label">Services Tax NO.</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="stn" id="stn" value="<?php echo set_value('stn'); ?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">TIN No.</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="tin" id="tin" value="<?php echo set_value('tin'); ?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">IT No.</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="itn" id="itn" value="<?php echo set_value('itn'); ?>">
								</div>
							</div> -->
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Contact Person</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="c_per" id="c_per" value="<?php echo set_value('c_per'); ?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Website</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="website" id="website" value="<?php echo set_value('website'); ?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Opening Balance</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="ob" id="ob" value="<?php echo set_value('ob'); ?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Account</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="acc" id="acc" value="<?php echo set_value('acc'); ?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Credit Period</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="cp" id="cp" value="<?php echo set_value('cp'); ?>">
								</div>
							</div>
							<div class="form-group">
							<label for="name" class="col-md-3 control-label">Credit Limit</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="cl" id="cl" value="<?php echo set_value('cl'); ?>">
								</div>
							</div>
							<!--<div class="form-group">
								<label for="example-select" class="col-md-3 control-label">Client Type</label>
								<div class="col-md-9">
									<select size="1" class="form-control" name="ct" id="ct">
										<option value="">Please select</option>
										<option value="A">Direct</option>
										<option value="I">In Direct</option>
									</select>
								</div>
							</div>-->
							<div class="form-group">
								<label class="col-md-3 control-label">IN Direct</label>
								<div class="col-md-9">
									<label class="switch switch-primary">
										<input type="checkbox" unchecked name="ct" id="ct"  onchange="add_agency();">
										<span></span>
									</label>
								</div>
							</div>
							<div id="agency_b">
 							<div class="form-group">
								<label class="col-md-3 control-label">Agency</label>
								<div class="col-md-9">
									<label class="switch switch-primary">
										<input type="checkbox" unchecked name="agency" id="agency">
										<span></span>
									</label>
								</div>
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
										<input type="checkbox" unchecked name="gh" id="gh">
										<span></span>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Shared Bill Party</label>
								<div class="col-md-9">
									<label class="switch switch-primary">
										<input type="checkbox" unchecked name="sbp" id="sbp" onchange="add_party();">
										<span></span>
									</label>
								</div>
							</div>
							<div id="shared_party" style="display: none;">
								<div class="form-group">
									<label for="example-select" class="col-md-3 control-label">Select Party</label>
									<div class="col-md-9">
										<select id="s_party" name="s_party[]" class="select-chosen" data-placeholder="Choose Party" multiple >
										<?php foreach($users as $user){ ?>
											<option value="<?php echo $user->id; ?>" <?php echo set_select('s_party[]',$user->id);?>><?php echo $user->client_name ;?>
											</option>
										<?php }?>
										</select>
									</div>
								</div>
							</div>
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
		cols += '<td class="col-lg-2"><input type="email" placeholder="Enter Email.." required="required" class="form-control" name="email[]"></td><td class="col-lg-2"><input type="text" placeholder="Enter Contact Number" class="form-control" name="contact[]"></td><td class="col-lg-2"><input type="text" placeholder="Enter Address" class="form-control" name="address[]"></td><td class="col-lg-2"><select name="state[]" class="states form-control" id="state'+c+'"  onchange="get_city('+c+',this.selectedIndex);" required><option value="">Select State</option>';
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
			//console.log(cities);
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

function check_username()
        {
            var uname = $("#uname").val();
            
            if(uname=="")
            {
                alert("Please Enter User Name!");
                return false;
            }
            $.ajax({
                url: "<?php echo base_url(); ?>" + "admin/user/get_username",
                type: "POST",
                async: true,
                data: {'name': uname},
                beforeSend: function () {
                    document.getElementById("loader").style.display = "block";
                },
                success: function (data)
                {

                    //$('#ad_cat').empty();

                    if (data == "Y")
                    {
                        alert("This username already added.");
                        //$('#uname').val('');
                    }

                    
                },
                complete: function ()
                {
                   document.getElementById("loader").style.display = "none";
                },
                error: function ()
                {
                    document.getElementById("loader").style.display = "none";
                    alert("Please Enter User name!");
                }
            });
            //setTimeout(sel_update, 500);
        }
        
        
       function check_clientname()
        {
            var uname = $("#name").val();
            
            if(uname=="")
            {
                alert("Please Enter User Name!");
                return false;
            }
            $.ajax({
                url: "<?php echo base_url(); ?>" + "admin/user/get_clientname",
                type: "POST",
                async: true,
                data: {'name': uname},
                beforeSend: function () {
                    document.getElementById("loader").style.display = "block";
                },
                success: function (data)
                {

                    //$('#ad_cat').empty();

                    if (data == "Y")
                    {
                        alert("This clientname already added.");
                        //$('#uname').val('');
                    }

                    
                },
                complete: function ()
                {
                   document.getElementById("loader").style.display = "none";
                },
                error: function ()
                {
                    document.getElementById("loader").style.display = "none";
                    alert("Please Enter Client name!");
                }
            });
            //setTimeout(sel_update, 500);
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
	
    if ($('#ct').is(":checked")) 
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


function update_city()
{
	$("#city option[value='<?php echo set_value('city'); ?>']").attr("selected", true);
}

// $(document).ready(function (){ 

// var st = $("#state").val();
// if(st!="")
// 	get_city();

// });

</script>