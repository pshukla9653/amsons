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
						<strong>Edit Package</strong>
					</h2>
					<script  type="text/javascript">
						if(<?php echo ($this->session->flashdata('msg')!=null)?'1':'0'?>)
						{
							alert("<?php echo $this->session->flashdata('msg')?>");
						}
					</script>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/package/edit/'.$pack->id, $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Package Name</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="p_title" id="p_title" value="<?php echo $pack->package?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper Group</label>
                        <div class="col-md-9">
							<select id="newspaper_group" name="newspaper_group" onchange="get_newspaper();" class="select-chosen" data-placeholder="Choose Newspaper Group" required>
									<option value="">Choose One</option>
								<?php foreach($news_groups as $news_group){ ?>
                                        <option value="<?php echo $news_group->ng_id; ?>" <?php if($pack->g_id==$news_group->ng_id)echo "selected";?>><?php echo $news_group->ng_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper</label>
                        <div class="col-md-9">
							<select id="newspaper" name="newspaper[]" class="select-chosen" data-placeholder="Choose Newspaper" multiple required>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper Type </label>
                        <div class="col-md-9">
							<select id="nt" name="nt" class="select-chosen" data-placeholder="Choose Classes" style="width: 250px;">
								<?php foreach($paper_types as $paper_type){ ?>
                                        <option value="<?php echo $paper_type->id; ?>" <?php if($pack->type_id==$paper_type->id)echo "selected";?>><?php echo $paper_type->name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Ad Heading</label>
                        <div class="col-md-9">
							<select id="ad_cat" name="ad_cat" class="select-chosen" data-placeholder="Choose Heading" required>
								<?php foreach($cats as $cat){ ?>
                                        <option value="<?php echo $cat->id; ?>" <?php if($pack->cat_id==$cat->id)echo "selected";?>><?php echo $cat->name; ?></option>
								<?php }?>								
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Insertion From</label>
						<div class="col-md-9">
							<input type="number"  onkeyup="inse_to();"  onchange="inse_to();" placeholder=""  min="1" value="<?php echo $pack->ins_from;?>" class="form-control" name="ins_from" id="ins_from" required>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Insertion To</label>
						<div class="col-md-9">
							<input type="number" placeholder="" class="form-control" min="1" name="ins_to" id="ins_to" value="<?php echo $pack->ins_to;?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Rate For Minimum</label>
						<div class="col-md-9">
							<input type="text" placeholder="" value="<?php echo $pack->rate?>" class="form-control" name="rate" id="rate" required>
						</div>						
					</div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Extra Charges</label>
						<div class="col-md-9">
							<input type="text" placeholder="" value="<?php echo $pack->e_rate?>" class="form-control" name="e_rate" id="e_rate" required>
						</div>						
					</div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Discount %</label>
						<div class="col-md-9">
							<input type="text" placeholder="" value="<?php echo $pack->discount?>" class="form-control" name="dis" id="dis">
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
function inse_to()
{
	var ins_f = parseInt($("#ins_from").val());
	document.getElementById("ins_to").value =ins_f;
	document.getElementById("ins_to").min =ins_f;
}


function get_newspaper()
{
	var  news_g= $("#newspaper_group").val();	
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/package/get_newspaper",
			type: "POST",				
			async: true ,               
			data: {'news_g':news_g},
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{					 
					$('#newspaper').empty();					
					// Parse the returned json data
					var opts = $.parseJSON(data);
					// Use jQuery's each to iterate over the opts value
					$.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
                    $('#newspaper').append('<option value="' + d.id + '">' + d.newspaper_name + ' , '+ d.city_name +'</option>');
										
					});	
					
					<?php 
					foreach($pack_paper as $pack_p)
					{
					?>
						$("#newspaper option[value='<?php echo $pack_p->paper_id; ?>']").attr("selected", true);
					<?php
					}						
					?>
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
	//setTimeout(sel_update, 2000);	
}

function sel_update()
{	
	$("#newspaper").trigger("chosen:updated");
	document.getElementById("loader").style.display = "none";
}

$(document).ready(function (){ get_newspaper(); });
</script>
