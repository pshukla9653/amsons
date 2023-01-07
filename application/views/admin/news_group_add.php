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
						<strong>Add New</strong> Newspaper Group
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/newspaper/group_add', $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Name</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Newspaper Group Name.." required="required" class="form-control" name="name" id="name" value="<?php echo set_value('name'); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="example-select" class="col-md-3 control-label">Address, State & GST</label>
					</div>
					<div class="form-group">
						<label for="example-select" class="col-md-3 control-label"></label>
						<div class="col-md-12">
							<table id="myTable" class=" table order-list">
                                    <tbody id="parameter_values">
                                        <tr>
											<td class="col-lg-2">
											<input type="email" placeholder="Enter Email.." required="required" class="form-control" name="email[]">
											</td>
										<td class="col-lg-2">
										<input type="text" placeholder="Enter Address" class="form-control" name="address[]">
											</td>
											<td class="col-lg-2">
											<select name="state[]" class="states form-control" id="state1" onchange="get_city(1,this.selectedIndex);" required>
											<option value="">Select State</option>
											<?php foreach($states as $state){ ?>
													<option value="<?php echo $state->id; ?>" <?php echo set_select('state', $state->name); ?> ><?php echo $state->name ;?></option>
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
                                                <input type="text"  placeholder="GST No." name="gst[]"  class="form-control"/>
                                            </td>
											<td class="col-lg-1">
                                                <input type="text"  placeholder="Contact No." name="contact[]"  class="form-control"/>
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
					</div>

					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Fax No.</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Fax No.." class="form-control" name="fax" id="fax" value="<?php echo set_value('fax'); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Opening</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="opening" id="opening" value="<?php echo set_value('opening'); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Contact Person</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Contact Person Name.." class="form-control" name="c_p" id="c_p" value="<?php echo set_value('c_p'); ?>">
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
		cols += '	<td class="col-lg-2"><input type="email" placeholder="Enter Email.." required="required" class="form-control" name="email[]"></td><td class="col-lg-2"><input type="text" placeholder="Enter Address" class="form-control" name="address[]"></td><td class="col-lg-2"><select name="state[]" class="states form-control" id="state'+c+'"  onchange="get_city('+c+',this.selectedIndex);" required><option value="">Select State</option>';
		for(var i = 0; i < states.length; i++) {
			cols+='<option value='+states[i].id+'>'+states[i].name+'</option>';
			}
		cols+='</select></div></td><td class="col-lg-2"><div id="city_block'+c+'"></td><td class="col-lg-2"><input type="text" class="form-control" name="gst[]"  placeholder="GST No"/></td><td class="col-lg-1"><input type="text"  placeholder="Contact No." name="contact[]"  class="form-control"></td>';
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
		url: "<?php echo base_url(); ?>" + "admin/newspaper/get_city",
		type: "POST",
		async: true ,
		data: {state:i},
		beforeSend: function(){ document.getElementById("loader").style.display = "block";},
		success: function(data)
		{
			console.log(data);
			var cities = $.parseJSON(data);
			console.log(cities);
			var st="<select name='city[]' class='city form-control' id='city"+c+"'>";
				for (var key in cities) {
					//console.log(cities[key].name);
					st+="<option value='"+cities[key].id+"'>"+cities[key].name+"</option>";
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
</script>
