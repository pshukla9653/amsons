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
						<strong>HD Display Add On</strong>
						<script  type="text/javascript">
							if(<?php echo ($this->session->flashdata('msg')!=null)?'1':'0'?>)
							{
								alert("<?php echo $this->session->flashdata('msg')?>");
							}
						</script>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/hd_add_on/add', $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
				<div class="col-lg-6">
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper Group</label>
                        <div class="col-md-9">
							<select id="newspaper_group" name="newspaper_group" onchange="get_m_newspaper();" class="form-control" data-placeholder="Choose Newspaper Group" required>
									<option value="">Choose One</option>
								<?php foreach($news_groups as $news_group){ ?>
                                        <option value="<?php echo $news_group->ng_id; ?>"><?php echo $news_group->ng_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper</label>
                        <div class="col-md-9">
							<select id="m_newspaper" name="m_newspaper"  onchange="get_a_newspaper();" class="form-control" data-placeholder="Choose Newspaper">
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Ad Add On Newspapers</label>
                        <div class="col-md-9">
							<select id="a_newspaper" name="newspaper[]" class="select-chosen"  data-placeholder="Choose Newspapers"  multiple required>
								
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Heading</label>
                        <div class="col-md-9">
							<select id="ad_cat" name="ad_cat" class="select-chosen" data-placeholder="Choose Heading" style="width: 250px;" required>
								<?php foreach($cats as $cat){ ?>
                                        <option value="<?php echo $cat->id; ?>"><?php echo $cat->position; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Ad Day</label>
                        <div class="col-md-9">
                            <select id="day" name="days[]" class="select-chosen"  data-placeholder="Choose Ad day"  multiple required>
                                <?php foreach ($days as $day) { ?>
                                            <option value="<?php echo $day->id; ?>" <?php echo set_select('days[]', $day->id); ?>><?php echo $day->day; ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Select All Days</label>
                        <div class="col-md-3">
                            <label class="switch switch-primary">
                                <input type="checkbox"  name="all_day" id="all_day">
                                <span></span>
                            </label>
                        </div>                      
                    </div>					
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Insertion From</label>
						<div class="col-md-9">
							<input type="number"  onkeyup="inse_to();"  onchange="inse_to();" placeholder=""  min="1" class="form-control" name="ins_from" id="ins_from" required>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Insertion To</label>
						<div class="col-md-9">
							<input type="number" placeholder="" class="form-control" min="1" name="ins_to" id="ins_to" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Add/Multiple</label>
                        <div class="col-md-9">
							<select id="mul" name="mul" class="form-control" data-placeholder="Choose Ad Page" required>
								<option value="A">ADD</option>
								<option value="M">Multiple</option>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Unit Type</label>
                        <div class="col-md-9">
							<select id="unit" name="unit" class="form-control" data-placeholder="" required>
								<option value="">Choose one</option>
								<option value="SC">SQCM</option>
								<option value="CC">PCC</option>
                            </select>
                        </div>
                    </div>
                
                    	<div class="form-group">
						<label for="price" class="col-md-3 control-label">Date From</label>
                        <div class="col-md-9">
                            <input type="text" id="date_from" name="date_from" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy" required>
                        </div>
                        <!--	<div class="form-group">
						<label for="price" class="col-md-3 control-label">Date to</label>
                        <div class="col-md-9">
                            <input type="text" id="date_to" name="date_to" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy" required>
                        </div>-->
                    </div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">From Unit</label>
						<div class="col-md-3">
							<input type="number" placeholder="" onchange="get_unit(0)"; class="form-control" name="f_unit" id="f_unit" min="1" required>
						</div>
						<label for="price" class="col-md-3 control-label">To Unit</label>
						<div class="col-md-3">
							<input type="number" placeholder="" class="form-control" name="t_unit" id="t_unit" required>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Price</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="price" id="price" required>
						</div>						
					</div>
					</div>
					<!--<div id="unit_price" style="background-color:#CECECE; height: 500px; overflow-y: scroll;">
						
					</div>  -->
					<div class="form-group">
						<div class="col-md-9 col-md-offset-3">
							<input class="btn btn-sm btn-primary" type="button" value="Save" onclick="save();">
							<button class="btn btn-sm btn-warning" type="reset">
								<i class="fa fa-repeat"></i> Reset
							</button>
							<a href="<?php echo base_url()?>admin/hd_add_on"><div class="btn btn-sm btn-primary">
								<i class="fa fa-bars"></i> See All Add on
							</div></a>
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

function save()
{
	
	var  newspaper_group= $("#newspaper_group").val();
	var  m_newspaper= $("#m_newspaper").val();
	var  a_newspaper= $("#a_newspaper").val();
	var  ad_cat= $("#ad_cat").val();
	var  ins_from= parseInt($("#ins_from").val());
	var  ins_to= parseInt($("#ins_to").val());
	var  days= $("#day").val();
	var  unit= $("#unit").val();
	var date_from=$("#date_from").val();
	var date_to=$("#date_to").val();
	var  f_unit= parseInt($("#f_unit").val());
	var  t_unit= parseInt($("#t_unit").val());
	var  price= $("#price").val();
	//var  eprice= $("#eprice").val();
	var  mul= $("#mul").val();
	
	if(isNaN( f_unit) || isNaN( t_unit))
	{
		alert("Please enter Units");
		return false;
	}

	if(f_unit >= t_unit)
	{
		alert("Unit to always greater than unit from ");
		return false;
	}
	var form_data= {'newspaper_group':newspaper_group,'m_newspaper':m_newspaper,'a_newspaper':a_newspaper,'ad_cat':ad_cat,'ins_from':ins_from,'ins_to':ins_to,'unit':unit,'date_f':date_from,'date_t':date_to,'f_unit':f_unit,'t_unit':t_unit,'price':price,'mul':mul,'days':days};
	
	$.ajax({
			url: "<?php echo base_url(); ?>" + "admin/hd_add_on/save",
			type: "POST",				
			async: true ,               
			data: form_data,
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{
					document.getElementById("loader").style.display = "none";
					if(data=='1')
					{
						alert("Fill All Mandatory Felids.");
						return false;
					}
					
					alert(data);					
					var  t_u= parseInt($("#t_unit").val());
					t_u=t_u+1;
					//alert(t_u);
					$('#f_unit').val(t_u);
					
					$('#t_unit').val(function() 
					{
						return this.defaultValue;
					});
					$('#price').val(0);
					//$('#eprice').val(0);
					
					
					
					
					/* Parse the returned json data
					//var tr = $.parseJSON(data);
					// Use jQuery's each to iterate over the tr value
					document.getElementById("msg").innerHTML = "Ro added Successfully with ID "+tr[0].id;
					
					$.each(tr, function(i, d) 
					{
						// You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
						$("#ecom-products tbody").append('<tr><td class="text-center"><strong>'+d.id+'</strong></td><td>'+d.newspaper_name+'</td><td class="text-center">'+d.type_name+'</td><td class="text-center">'+d.cat_name+'</td><td class="text-center">'+d.ad_cost+'</td><td class="text-center">'+d.insertion+'</td><td class="text-center">'+d.client_name+'<br>'+d.email+'<br>'+d.mobile+'</td></tr>');
					
					});	
					
					$('#msg').delay(5000).fadeOut('slow');
					
					*/
					
					//document.getElementById("newspaper").selectedIndex = 0;
					//$('#client').find($('option')).attr('selected',false);
					//$('#client option').attr('selected', false);				
					//$("#client").attr('selectedIndex', '-1'); 
					
					/*
					
					$('#client').prop('selectedIndex',0);
					document.getElementById('employee').selectedIndex = 0;
					
					$('#party').val(function() 
					{
						return this.defaultValue;
					});
					$('#matter').val(function() 
					{
						return this.defaultValue;
					});
					$('#box').val(function() 
					{
						return this.defaultValue;
					});
					$('#w_count1').val(function() 
					{
						return this.defaultValue;
					});
					$('#premimum').val(function() 
					{
						return this.defaultValue;
					});
					*/
					
				
				},                
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Add on not add !");
					}
			});
}    



var count=0;

function get_unit(id)
{
	var f_unit = parseInt($("#f_unit").val());	
	document.getElementById("t_unit").min =f_unit;
	
	/*
	var t_unit = parseInt($("#t_unit"+count).val());
	t_unit=t_unit+1;
	count=count+1;
	
	var html='<div class="form-group"><label for="price" class="col-md-3 control-label">Star Unit</label><div class="col-md-3"><input type="text" placeholder="" class="form-control" name="f_unit0" id="f_unit0" required></div><label for="price" class="col-md-3 control-label">To Unit</label><div class="col-md-3"><input type="text" onchange="get_unit(0)"; placeholder="" class="form-control" name="t_unit0" id="t_unit0" required></div></div><div class="form-group"><label for="price" class="col-md-3 control-label">Price</label><div class="col-md-3"><input type="text" placeholder="" class="form-control" name="price" id="price" required></div><label for="price" class="col-md-3 control-label">Extra Price </label><div class="col-md-3"><input type="text" placeholder="" class="form-control" name="eprice" id="eprice" required>    </div></div>';
	
	var p_u= document.getElementById('unit_price');					
	p_u.insertAdjacentHTML('beforeend', html);
	*/
}


function inse_to()
{
	var ins_f = parseInt($("#ins_from").val());
	document.getElementById("ins_to").value =ins_f;
	document.getElementById("ins_to").min =ins_f;
}


function get_m_newspaper()
{
	var  news_g= $("#newspaper_group").val();	
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/add_on/get_newspaper",
			type: "POST",				
			async: true ,               
			data: {'news_g':news_g},
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{					 
					$('#m_newspaper').empty();
					$('#m_newspaper').append('<option value="">Select One</option>');
					// Parse the returned json data
					var opts = $.parseJSON(data);
					// Use jQuery's each to iterate over the opts value
					$.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
                    $('#m_newspaper').append('<option value="' + d.id + '">' + d.newspaper_name + ' '+ d.city_name +'</option>');
										
					});	
					
				},                
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Please Select Newspaper Group!");
					}
			});
	document.getElementById("loader").style.display = "none";
	//get_a_newspaper();
}

function get_a_newspaper()
{
	var  news_g= $("#newspaper_group").val();
	var  m_news= $("#m_newspaper").val();
	if(m_news=="")
	{
		alert("Please Select Newspaper First!");
		$('#a_newspaper').empty();
		setTimeout(sel_update, 300);	
		return false;
	}
	
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/add_on/get_add_newspaper",
			type: "POST",				
			async: true ,               
			data: {'news_g':news_g},
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{
					var  m_paper= $("#m_newspaper").val();
					
					$('#a_newspaper').empty();					
					// Parse the returned json data
					var opts = $.parseJSON(data);
					// Use jQuery's each to iterate over the opts value
					$.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data	
						if(d.id != m_paper)
						{
							$('#a_newspaper').append('<option value="' + d.id + '">' + d.newspaper_name + ' '+ d.city_name +'</option>');
						}
						
					});	
					
				},
				complete: function() 
					{                    
						sel_update();
					},
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Please Select Newspaper Group!");
					}
			});
	//$("#newspaper").chosen("destroy");
	//$("#newspaper").chosen();
	//$("#newspaper").trigger("chosen:updated");
	//setTimeout(sel_update, 500);	
}


function sel_update()
{
	$("#a_newspaper").trigger("chosen:updated");
	document.getElementById("loader").style.display = "none";
}

$('#all_day').click(function()
{
    if ($('#all_day').is(":checked"))
    {
        $('#day option').prop('selected', true);  
        $('#day').trigger('chosen:updated');
    }
    else
    {
        $('#day option').prop('selected', false);  
        $('#day').trigger('chosen:updated');
    }


});
</script>
