<?php // var_dump($discount_percentage);  die;?>
<div id="page-content" style="min-height: 1189px;">
	<!-- Product Edit Content -->
	<div class="row">
	
	<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'ro_add');
					echo form_open_multipart('admin/hd_ro/edit/'.$book_ad->id, $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo $this->session->flashdata('msg');
					echo "</div>";
	?>
	
		<div class="col-lg-6">
			<!-- General Data Block -->
			<div class="block">
				<!-- General Data Title -->
				<div class="block-title">
					<h2>
						<i class="fa fa-pencil"></i>
						<strong>Text Ro Billing</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Bill To <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <?php  if(empty($dops)){?>
                            <script>alert("already billed");</script>
                            <?php }?>
							<input type="hidden" id="bill_id" value=<?php if($bill->id){echo $bill->id;}else{ echo 0; } ?>>
							<input type="hidden" id="ro_id" value=<?php echo $book_ad->id;?>>
							<input type="hidden" id="work_year" value=<?php echo $book_ad->work_year;?>>
							<input type="hidden" id="type_id" value=<?php echo $book_ad->type_id;?>>
							<input type="hidden" id="ro_no" value=<?php echo $book_ad->ro_no;?>>
							<input type="hidden" id="n_id" value=<?php echo $book_ad->newspaper_id;?>>
							<input type="hidden" id="client_id" value=<?php echo $book_ad->u_id;?>>
							<input type="hidden" id="cat_id" value=<?php echo $book_ad->cat_id;?>>
							<input type="hidden" id="size_words" value=<?php echo $book_ad->size_words;?>>
							<input type="hidden" id="e_id" value=<?php echo $book_ad->e_id;?>>
							<input type="hidden" id="ro_date" value=<?php echo $book_ad->book_date;?>>
							<select id="client" name="client"  onchange="get_client();" class="form-control" data-placeholder="Choose Classes" required>
								<option value="" >Select Client</option>
								<?php foreach($clients as $client){ ?>
                                        <option value="<?php echo $client->id; ?>" <?php echo ($book_ad->u_id==$client->id)?'selected':'';?>><?php echo $client->client_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Client Name</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" value="<?php echo $book_ad->party; ?>" name="party" id="party" >
						</div>
					</div>
				 <div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Publication  Newspaper <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <select id="newspaper" name="newspaper"  class="form-control select" data-placeholder="Choose Newspaper" onchange="get_state();" required>							
                                <option value="">Choose One </option>
                                <?php foreach($newspapers as $newspaper){ ?>
                                <option value="<?php echo $newspaper->id; ?>" <?php echo ($book_ad->paper_city_id==$newspaper->id  )?'selected':'';?>><?php echo $newspaper->newspaper_name .",".$newspaper->city_name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Select State <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <select id="state" class="form-control" data-placeholder="Choose City" required >
                                <option value="" >Select State</option>
                                <?php foreach($states as $row){
                                ?>
                                <option value="<?php echo $row->id; ?>" <?php /*if($book_ad->state_id==$row->id)*/{ echo "selected"; } ?> ><?php echo $row->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Add On</label>
                        <div class="col-md-3">
                            <label class="switch switch-primary">
                                <input type="checkbox" onchange="add_paper();" <?php echo ($book_ad->ro_type=='M')?'checked':'unchecked';?>  name="add_on" id="add_on">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div id="add_on_paper" style="display: none;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="example-chosen-multiple">Add On Newspaper</label>
                            <div class="col-md-9">
                                <select id="a_newspaper" name="a_newspaper[]" class="select-chosen"  data-placeholder="Choose Newspaper" multiple>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Ad Heading <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <select id="cat" name="cat" class="form-control" onchange="get_sub_heading();" data-placeholder="Choose heading" required>
                               
                            </select>
                        </div>
                    </div>					
              <!--      <div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Sub Heading <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <select id="sheading" name="sheading"   class="form-control" data-placeholder="Choose one" required>
                                <option value="">Sub Heading</option>
                            </select>
                        </div>
                    </div>-->
                 <div class="form-group">
                    <label class="col-md-3 control-label" for="example-chosen-multiple">Color Type</label>
                    <div class="col-md-9">
                        <select id="color" name="color" class="form-control" data-placeholder="" required>
                            <option value="">Choose one</option>
                            <option value="A" <?php echo ('A'==$book_ad->color)?'selected':'';?>>Any Color</option>
                            <option value="B" <?php echo ('B'==$book_ad->color)?'selected':'';?>>Black/White</option>
                            <option value="C" <?php echo ('C'==$book_ad->color)?'selected':'';?>>Color</option>
                        </select>
                    </div>
                </div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Insertion </label>
						<div class="col-md-9">
					
						<?php 
						$j=0;
						$i=0;
						  $k=0;
						  $l=0;
						 $b_newspaper=$book_ad->paper_city_id;
						foreach($dops as $dp)
						{
						    
						    $paper=$dp->paper_id;
						  
						   
						    if($paper == $b_newspaper)
						    {
    						    $dop=explode(",",$dp->dop);
    						   $bill_dop=explode(", ",$dp->bill_dop);
    						    foreach($dop as $key=> $dp)
    						         {    
    						       
            						    $dop_arr1[$j]=$dp;
            						    $j++;
            						    }
            					foreach($bill_dop as $dp)
            					{
            					     $bill_dop_arr[$k]=$dp;
            						    $k++;
            					}
						    }
						    
						   
						  
						}
				
						$count_bill_dop_arr=count($bill_dop_arr);
						if($count_bill_dop_arr ==0)
						{
						    $dop_arr=$dop_arr1;
						}
						else{
					
						$count_dop_arr=count($dop_arr1);
						for($i=0;$i<$count_dop_arr;$i++){
						         $flag=0;
						    for($j=0;$j<$count_bill_dop_arr;$j++)
							{
								if($dop_arr1[$i]==$bill_dop_arr[$j]){
						        {
						            $flag=1;
						
								}
								
							}
							    
							}
							if($flag==0)
							{
							    	$dop_arr[$i]=$dop_arr1[$i];
							}
						}
						}
			//		echo $count_bill_dop_arr;
//echo "*"; print_r($bill_dop_arr); echo "&&";print_r($dop_arr); print_r($paper_id); echo "counts".count($dop_arr1)." - ".count($count_bill_dop_arr);
?>
						 	<input type="number"  onchange="date_pic1();" onblur="date_pic1();" min="1" placeholder="" class="form-control" name="inse" id="inse" value="<?php echo  $book_ad->insertion; ?>" required>
							 <input type="number" id="inse1" value="0">  
							<!--<input type="number"  onchange="date_pic1();" min="1" placeholder="" class="form-control" name="inse" id="inse" value="<?php //echo count($dop_arr); ?>" required>-->
			</div>
					</div>
					<!--
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Package</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="pack" id="pack">
						</div>
					</div> -->
					 <div class="form-group">
                    <label for="Paid" class="col-md-3 control-label">Paid</label>
                    <div class="col-md-2">
                        <input type="text" placeholder=""  class="form-control" name="Paid" id="Paid" value="0" required>
                    </div>
                    <label for="Free" class="col-md-3 control-label">Free</label>
                    <div class="col-md-2">
                        <input type="text" placeholder=""  class="form-control" name="Free" id="Free" value="0" required>
                    </div>
                   
                </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Scheme </label>
                        <div class="col-md-9">
							<select id="scheme" name="scheme" onchange="get_scheme_price();"  class="form-control" data-placeholder="Choose one">
                                <option value="">Scheme</option>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Material</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" value="<?php echo $book_ad->material ?>" name="material" id="material" >
						</div>
					</div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Box</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="box" id="box" value="<?php echo $book_ad->box; ?>">
						</div>
					</div>					
					<!--<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Premimum</label>
                        <div class="col-md-9">
							<div id="premimum123">
								
							</div>
                        </div>
                    </div>-->									
  <?php 
                $size=explode("X",$book_ad->size_words);
                ?>
                <div class="form-group">
                    <label for="pack-price" class="col-md-3 control-label">Size *</label>
                    <div class="col-md-2">
                        <input type="text" placeholder="" onchange="get_size();" class="form-control" name="size_l" id="size_l" value="<?php echo $size[0]; ?>" required>
                    </div>
                    <div class="col-md-1 control-label">
                        X
                    </div>
                    <div class="col-md-2">
                        <input type="text" placeholder="" onchange="get_size();" class="form-control" name="size_r" id="size_r" value="<?php echo $size[1]; ?>" required>
                    </div>
                    <div class="col-md-4">
                        <select id="unit" name="unit" class="form-control" data-placeholder="" required>
                            <option value="">Choose</option>
                            <option value="SC"<?php echo ('SC'==$book_ad->unit)?'selected':'';?>>SQCM</option>
                            <option value="CC"<?php echo ('CC'==$book_ad->unit)?'selected':'';?>>PCC</option>
                        </select>
                    </div>
                </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Package</label>
                        <div class="col-md-9">
							<select id="pack" name="pack" onchange="get_pack_price();"   class="form-control" data-placeholder="Choose one">
                                <option value="">Package</option>
                            </select>
                        </div>
                    </div>
					<!--<div class="form-group">
						<label for="example-file-input" class="col-md-3 control-label">Tax</label>
						<div class="col-md-9">
							<input type="file" name="logo" size="20">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Active?</label>
						<div class="col-md-9">
							<label class="switch switch-primary">
								<input type="checkbox" checked="" name="status" id="status">
								<span></span>
							</label>
						</div>
					</div>-->
					<!-- END General Data Content -->
			</div>
			<!-- END General Data Block -->
		</div>
		<div class="col-lg-6">
			<!-- General Data Block -->
			<div class="block"  style="background-color:#dbe1e8;">
				<!-- General Data Title -->
				<div class="block-title">
					<h2>
						<i class="fa fa-pencil"></i>
						<strong>Rate</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
					<div style="background-color:#CECECE; height: 400px; overflow-y: scroll;">						
						<div id="base_p_date">
							<div class="form-group">
								<label for="pack-price" class="col-md-6 control-label">Main Paper Publish Dates <span class="text-danger">*</span></label>
								<div class="col-md-6">
									<div class="box"  id="from--input">
									<?php
										$date="";
										$date1="";
										$i=0;
										$j=0;
										foreach($dop_arr as $value){
										
											if($date){
												$date=$date.", ". $value;
											}else
											{
												$date= $value;
											}?>
											<input type="checkbox" class="dop_checked" name="dop[]" id="dop<?= $i ?>" checked="checked" value="<?php echo $value; ?>" onchange="checkboxes();"><?php echo $value;  ?> 
										<?php $i++; }?>
										<input type="hidden" id="checked_dops" value="<?= $date ?>">
									
									
								
									
    <!--	<label for="pack-price" class="col-md-6 control-label">Add on Newspaper <span class="text-danger">*</span></label>      
                    						
										<div class="col-md-12">	
										<?php
											  $l=0;
											  $k=0;
											  $j=0;
                    						 $b_newspaper=$book_ad->newspaper_id;
                    						 foreach($dops as $dp)
                    						 {
                    						   $paper_1=$dp->paper_id;
                    						  
                    						 
                    						    if($paper_1 != $b_newspaper)
                    						    {
                    						         
                        						    $dop=explode(",",$dp->dop);
                        							   $bill_dop=explode(", ",$dp->bill_dop);
                        						    foreach($dop as $key=> $dp)
                        						         {    
                        						       
                                						    $dop_arr_ad1[$j]=$dp;
                                						    $j++;
                                						    }
                                					foreach($bill_dop as $dp)
                                					{
                                					     $bill_dop_arr_1[$k]=$dp;
                                						    $k++;
                                					}
                    						    }
                    						   
                    						  
                    					
                    				
                    						$count_bill_dop_arr=count($bill_dop_arr_1);
                    						if($count_bill_dop_arr ==0)
                    						{
                    						    $dop_arr_ad=$dop_arr_ad1;
                    						}
                    						else{
                    					
                    						$count_dop_arr=count($dop_arr_ad1);
                    						for($i=0;$i<$count_dop_arr;$i++){
                    						         $flag=0;
                    						    for($j=0;$j<$count_bill_dop_arr;$j++)
                    							{
                    								if($dop_arr_ad1[$i]==$bill_dop_arr_1[$j]){
                    						        {
                    						            $flag=1;
                    						
                    								}
                    								
                    							}
                    							    
                    							}
                    							if($flag==0)
                    							{
                    							    	$dop_arr_ad[$i]=$dop_arr_ad1[$i];
                    							}
                    						}
                    						}
                    						 }
										foreach($dop_arr_ad as $value1)
										{
										
											if($date1){
												$date1=$date1.", ". $value1;
											}else
											{
												$date1= $value1;
											}
											?>
										
											
											<input type="checkbox" class="dop_checked" name="dop_1[]" id="dop_<?= $l ?>" checked="checked" value="<?php echo $value1; ?>" onchange="checkboxes1();"><?php echo $value1; ?> 
											
										<?php 
									$l++;	}?>
									
										<?php
										
                    						 
									?>
									<input type="hidden" id="checked_dops_1" value="<?= $date1 ?>">	-->
<script>

function checkboxes(){
    

	document.getElementById('checked_dops').value="";   
	var num_checked=0;
	var i;
	var n_dops=<?php echo count($dop_arr); ?> ;
//	alert("n_dops"+n_dops);
	for(i=0;i<n_dops; i++){
		
	
	var checked = $("input[id=dop"+i+"]:checked").length;
		if(checked==1){//alert("checked"+checked);
			
			if(document.getElementById('checked_dops').value){
				document.getElementById('checked_dops').value=document.getElementById('checked_dops').value+", "+$("input[id=dop"+i+"]:checked").val();
			}
			else
			{
				document.getElementById('checked_dops').value=$("input[id=dop"+i+"]:checked").val();
			}
			num_checked++;
		}
	}

document.getElementById('inse1').value= num_checked;
//alert(num_checked1);
	amount_calculate();
}
</script>

										<input class="form-control" name="p_date" type="hidden" id="from-input" placeholder="mm/dd/yyyy, mm/dd/yyyy, ...">
									</div>
									<div class="code-box"></div>
								</div>
							</div>
						</div>
						<div id="pub_dates">
							
						</div>
						<div id="pack_pub_dates">
							
						</div>
						<div id="add_base_dates">
							
						</div>
						<div id="add_pub_dates">
							
						</div>
						<div id="pack_rate" style="display: none;">
							<div class="title" style="background-color:#fff;"><i class="fa fa-money"></i><strong> Rate Of Package</strong></div>
							<div class="form-group">
								<label for="pack-price" class="col-md-3 control-label">Rate</label>
								<div class="col-md-3">
									<input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate" id="rate">
								</div>
								<label for="pack-price" class="col-md-3 control-label">Extra Charges</label>
								<div class="col-md-3">
									<input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="erate" id="erate">
								</div>
							</div>
							<div class="form-group">
								<label for="pack-price" class="col-md-3 control-label">B Rate</label>
								<div class="col-md-3">
									<input type="text" placeholder="" class="form-control" name="brate" id="brate">
								</div>
								<label for="pack-price" class="col-md-3 control-label"></label>
								<div class="col-md-3">
									<div class="btn btn-sm btn-primary" onclick="get_pack_price();">
									Refresh Rate
									</div>
								</div>
							</div>							
						</div>
						<!--
						<div class="form-group">
							<label for="pack-price" class="col-md-3 control-label">Rate</label>
							<div class="col-md-3">
								<input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate" id="rate">
							</div>
							<label for="pack-price" class="col-md-3 control-label">Extra Charges</label>
							<div class="col-md-3">
								<input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="erate" id="erate">
							</div>
						</div>
						<div class="form-group">
							<label for="pack-price" class="col-md-3 control-label">B Rate</label>
							<div class="col-md-3">
								<input type="text" placeholder="" class="form-control" name="brate" id="brate">
							</div>
							<label for="pack-price" class="col-md-3 control-label">Multi Rate</label>
							<div class="col-md-3">
								<input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="mrate" id="mrate">
							</div>
						</div>
						<div class="form-group">
							<label for="pack-price" class="col-md-3 control-label">Multi Ex. Rate</label>
							<div class="col-md-3">
								<input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="merate" id="merate">
							</div>
							<label for="pack-price" class="col-md-3 control-label"></label>
							<div class="col-md-3">
								<div class="btn btn-sm btn-primary" onclick="get_price();">
									Refresh Rate
								</div>
							</div>
						</div>-->
						<div id="ad_on_rate">
						
						</div>
					</div>
					<div class="form-group">
						<!--<label class="col-md-3 control-label">Other Dates Follows</label>
						<div class="col-md-3">
							<label class="switch switch-primary">
								<input type="checkbox" unchecked name="odf" id="odf">
								<span></span>
							</label>
						</div>-->
						<div id="dc_b">
							<label class="col-md-3 control-label">Same Dates To All</label>
							<div class="col-md-3">
								<label class="switch switch-primary">
									<input type="checkbox" unchecked name="sdta" id="sdta">
									<span></span>
								</label>
							</div>
							<label class="col-md-3 control-label">Other Dates Follows</label>
							<div class="col-md-3">
								<label class="switch switch-primary">
									<input type="checkbox" <?php echo ($book_ad->other_day_f=='1')?'checked':'unchecked';?> name="odf" id="odf" onchange="get_dop_price();">
									<span></span>
								</label>
							</div>
						</div>
					</div>
				<div style="display: none;">
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Commission %</label>
						<div class="col-md-2">
							<input type="text" min="0" placeholder="0" onchange="commission();" class="form-control" name="comm1" id="comm1">
						</div>
						<div class="col-md-2">
							<input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm2" id="comm2">
						</div>
						<div class="col-md-2">
							<input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm3" id="comm3">
						</div>
						<div class="col-md-2">
							<input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm4" id="comm4">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label"></label>
						<div class="col-md-2">
							<input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm5" id="comm5">
						</div>
						<div class="col-md-2">
							<input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm6" id="comm6">
						</div>
						<div class="col-md-2">
							<input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm7" id="comm7">
						</div>
						<div class="col-md-2">
							<input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm8" id="comm8">
						</div>
					</div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Discount %</label>
						<div class="col-md-9">
							<input type="text" min="0" placeholder="" value="0" class="form-control" name="dis" id="dis" required>
						</div>
					</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Premimum</label>
                        <div class="col-md-9">
							<select id="premimum" name="premimum" onchange="get_premimum_price();"   class="select-chosen" data-placeholder="Choose one" multiple>
                            </select>

                        </div>
                    </div>					
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Amount</label>
						<div class="col-md-3">
							<input type="text" min="0" placeholder=""  value="0" onchange="amount_calculate();" class="form-control" name="amount" id="amount">
						</div>
						<label for="pack-price" class="col-md-3 control-label">Premimum</label>
						<div class="col-md-3">
							<input type="text" min="0"  value="<?php echo $book_ad->premium_val; ?>" onchange="amount_calculate();" placeholder="" class="form-control" name="premimum_a" id="premimum_a">
							<input type="hidden" min="0"  value="" onchange="amount_calculate();" placeholder="" class="form-control" id="premimum_type_value">
							
						</div>						
					</div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Exter Charges</label>
						<div class="col-md-3">
							<input type="text" min="0"  value="0" onchange="amount_calculate();" placeholder="" class="form-control" name="eca" id="eca">
						</div>
						<label for="pack-price" class="col-md-3 control-label">Non Focusing Day Charge </label>
						<div class="col-md-3">
							<input type="text" min="0"  value="0" onchange="amount_calculate();" placeholder="" class="form-control" name="nfdc" id="nfdc">
						</div>						
					</div>
					
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Add On Amount</label>
						<div class="col-md-3">
							<input type="text" min="0" value="0"  onchange="amount_calculate();" placeholder="" class="form-control" name="add_a" id="add_a">
						</div>
						<label for="pack-price" class="col-md-3 control-label">Total Amount</label>
						<div class="col-md-3">
							<input type="text" min="0" value="0"  onchange="amount_calculate();" placeholder="" class="form-control" name="t_amount" id="t_amount">
						</div>
					</div>
					<div class="form-group">						
						<label for="pack-price" class="col-md-3 control-label">Discount Percentage</label>
						<div class="col-md-9">
						<input type="text" min="0" placeholder="" value="<?php if($discount_percentage>0){ echo $discount_percentage; } else{ echo "0"; }?>" class="form-control" onchange="update_discount();"  id="discount_percentage" required>
						</div>						
					</div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Box Charges</label>
						<div class="col-md-3">
							<input type="text" min="0" value="<?php echo $book_ad->box_charge; ?>"  onchange="amount_calculate();" placeholder="" class="form-control" name="box_c" id="box_c">
						</div>
						<label for="pack-price" class="col-md-3 control-label">Discount Amount</label>
						<div class="col-md-3">
							<input type="text" min="0" value="0"  onchange="amount_calculate();" placeholder="" class="form-control" name="dis_a" id="dis_a">
						</div>						
					</div>
					<div class="form-group">						
						<label for="pack-price" class="col-md-3 control-label">Payable Amount</label>
						<div class="col-md-9">
							<input type="text" value="0" step="any" min="0"  onchange="amount_calculate();" placeholder="" class="form-control" name="p_amount" id="p_amount">
						</div>						
					</div>
			
					<!--<div class="form-group">
						<label for="example-file-input" class="col-md-3 control-label">Tax</label>
						<div class="col-md-9">
							<input type="file" name="logo" size="20">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Active?</label>
						<div class="col-md-9">
							<label class="switch switch-primary">
								<input type="checkbox" checked="" name="status" id="status">
								<span></span>
							</label>
						</div>
					</div>-->
					<div class="form-group">
						<div class="col-md-9 col-md-offset-3">
							<div class="btn btn-sm btn-primary" onclick="amount_calculate();">
									Calculate Rate
							</div>
							<input class="btn btn-sm btn-primary" type="button" value="ADD To Bill"  onclick="save_bill_temp();" >
							<!-- onclick="add_to_bill();" -->
							<!--<button class="btn btn-sm btn-primary" type="submit">
								<i class="fa fa-floppy-o"></i> Save
							</button>-->							
							
						</div>
					</div>
					<div class="form-group">
						<div id="msg" class="col-md-9 col-md-offset-3 text-success">
							
						</div>
					</div>
				
					<!-- END General Data Content -->
			</div>
			<!-- END General Data Block -->
		</div>
	<!-- END Product Edit Content -->
	</form>
</div>
<script  type="text/javascript">
    var days =[9,9,9,9,9,9,9];
    var datarate=[];
    var min_w=0;
    var s_min_l=0;
    var	s_min_r=0;
    var s_max_l=0;
    var	s_max_r=0;
    var nfdc=[0,''];
    var free_days=0;
    var size_type="";
    var add_mul=[];
    var premimum_type="";

   var premimum_value=0;
     function add_date1()
      { 
          
                  
           var inse =$("#inse").val();
         
          var id = My_id;
         
          var date = new Date($("#name_dop").val());
         
         var td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
         if($("#add_on").is(":checked"))
         {
               
                    var d=$("#name_dop").val();
                    var v = $("#from-input"+id).val();
                         if(v !="")
                         {
                          var dates = v.split(", ");
                      
                          var count = dates.length;
                         // alert(count);
                         }
                         else
                         {
                             var count =0;
                         }
                         if(count == inse)
                         {
                             alert("you can not enter more dates");
                             // $("#name_dop").val(""); 
                         }
                         else
                         {
                                  if($("#from-input"+id).val() == "")
                                  {
                                     $("#from-input"+id).val(function() {
                                    return this.value + d;
                                 
                                         });
                                  }
                                  else
                                  {
                                          $("#from-input"+id).val(function() {
                                       return this.value +', '+ d;
                                   
                                         });
                          }
                        // $("#name_dop").val(""); 
                        
                         }

           
         }
         else if($("#pack").val()!="")
         {
                var d=$("#name_dop").val();
                    var v = $("#from-input"+id).val();
                         if(v !="")
                         {
                          var dates = v.split(", ");
                      
                          var count = dates.length;
                         // alert(count);
                         }
                         else
                         {
                             var count =0;
                         }
                         if(count == inse)
                         {
                             alert("you can not enter more dates");
                             // $("#name_dop").val(""); 
                         }
                         else
                         {
                                  if($("#from-input"+id).val() == "")
                                  {
                                     $("#from-input"+id).val(function() {
                                    return this.value + d;
                                 
                                         });
                                  }
                                  else
                                  {
                                          $("#from-input"+id).val(function() {
                                       return this.value +', '+ d;
                                   
                                         });
                          }
                        // $("#name_dop").val(""); 
                        
                         }
         }
        else
        {
                 
                    var d=$("#name_dop").val();
                    var v = $("#from-input").val();
                   
                         if(v!="")
                         {
                          var dates = v.split(", ");
                      
                          var count = dates.length;
                        
                         }
                         else
                         {
                             var count =0;
                         }
                         if(count == inse)
                         {
                             alert("you can not enter more dates");
                           
                         }
                         else
                         {
                                  if($("#from-input").val() == "")
                                  {
                                     $("#from-input").val(function() {
                                    return this.value + d;
                                 
                                         });
                                  }
                                  else
                                  {
                                          $("#from-input").val(function() {
                                       return this.value +', '+ d;
                                   
                                         });
                          }
                      
                        
                         }

              
        }
      }
function add_date(id=null)
      {
         var inse =$("#inse").val();
         
          var id = My_id;
        
        
          var date = new Date($("#name_dop").val());
         
         var td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
         if($("#add_on").is(":checked"))
         {
             //var data = $("#from-input"+id).val("");
            // alert(data.length);
             
           if($("#daily").is(":checked"))
              {
                   
                    $("#from-input"+id).val("");
                    for(i=0;i<inse;i++)
                    { 
                       // $("#from-input"+id).val("");
                        if($("#from-input"+id).val() == "")
                          {
                         $("#from-input"+id).val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input"+id).val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                          date.setDate(date.getDate()+1);
                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
                }
            else  if($("#after").is(":checked"))
              {
                  var day =parseInt($("#days").val());
                  
                   $("#from-input"+id).val("");
                    for(i=0;i<inse;i++)
                    { 
                      
                        if($("#from-input"+id).val() == "")
                          {
                         $("#from-input"+id).val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input"+id).val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                           date.setDate(date.getDate()+day);
                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
              }
              else  if($("#weekly").is(":checked"))
              {
                  
                   $("#from-input"+id).val("");
                    for(i=0;i<inse;i++)
                    { 
                      
                        if($("#from-input"+id).val() == "")
                          {
                         $("#from-input"+id).val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input"+id).val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                           date.setDate(date.getDate()+7);
                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
              }
              else  if($("#monthly").is(":checked"))
              {
                 
                   $("#from-input"+id).val("");
                    for(i=0;i<inse;i++)
                    { 
                       // $("#from-input"+id).val("");
                        if($("#from-input"+id).val() == "")
                          {
                         $("#from-input"+id).val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input"+id).val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                           date.setMonth(date.getMonth() + 1);
                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
              }
              else  if($("#yearly").is(":checked"))
              {
                 
                   $("#from-input"+id).val("");
                    for(i=0;i<inse;i++)
                    { 
                       // $("#from-input"+id).val("");
                        if($("#from-input"+id).val() == "")
                          {
                         $("#from-input"+id).val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input"+id).val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                           date.setFullYear(date.getFullYear()+1);
                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
              }
              else if($("#same_day").is(":checked"))
              {
                 ("#from-input"+id).val("");
                 for(i=0;i<inse;i++)
                    { 
                       // $("#from-input"+id).val("");
                        if($("#from-input"+id).val() == "")
                          {
                         $("#from-input"+id).val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input"+id).val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                         //  date.setDate(date.getFullYear()+1);
                          // td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    } 
                }
                else  if($("#odf1").is(":checked"))
              {
                   
                  odf=1;
                  $("#odf").prop("checked",true);
              }
              else
              {
                   
                    var d=$("#name_dop").val();
                    var v = $("#from-input"+id).val();
                         if(v !="")
                         {
                          var dates = v.split(", ");
                      
                          var count = dates.length;
                         // alert(count);
                         }
                         else
                         {
                             var count =0;
                         }
                         if(count == inse)
                         {
                             alert("you can not enter more dates");
                             // $("#name_dop").val(""); 
                         }
                         else
                         {
                                  if($("#from-input"+id).val() == "")
                                  {
                                     $("#from-input"+id).val(function() {
                                    return this.value + d;
                                 
                                         });
                                  }
                                  else
                                  {
                                          $("#from-input"+id).val(function() {
                                       return this.value +', '+ d;
                                   
                                         });
                          }
                        // $("#name_dop").val(""); 
                        
                         }

              }
         }
          else if($("#pack").val()!="")
         {
             //var data = $("#from-input"+id).val("");
            // alert(data.length);
             
           if($("#daily").is(":checked"))
              {
                   
                    $("#from-input"+id).val("");
                    for(i=0;i<inse;i++)
                    { 
                       // $("#from-input"+id).val("");
                        if($("#from-input"+id).val() == "")
                          {
                         $("#from-input"+id).val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input"+id).val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                          date.setDate(date.getDate()+1);
                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
                }
            else  if($("#after").is(":checked"))
              {
                  var day =parseInt($("#days").val());
                  
                   $("#from-input"+id).val("");
                    for(i=0;i<inse;i++)
                    { 
                      
                        if($("#from-input"+id).val() == "")
                          {
                         $("#from-input"+id).val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input"+id).val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                           date.setDate(date.getDate()+day);
                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
              }
              else  if($("#weekly").is(":checked"))
              {
                  
                   $("#from-input"+id).val("");
                    for(i=0;i<inse;i++)
                    { 
                      
                        if($("#from-input"+id).val() == "")
                          {
                         $("#from-input"+id).val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input"+id).val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                           date.setDate(date.getDate()+7);
                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
              }
              else  if($("#monthly").is(":checked"))
              {
                 
                   $("#from-input"+id).val("");
                    for(i=0;i<inse;i++)
                    { 
                       // $("#from-input"+id).val("");
                        if($("#from-input"+id).val() == "")
                          {
                         $("#from-input"+id).val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input"+id).val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                           date.setMonth(date.getMonth() + 1);
                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
              }
              else  if($("#yearly").is(":checked"))
              {
                 
                   $("#from-input"+id).val("");
                    for(i=0;i<inse;i++)
                    { 
                       // $("#from-input"+id).val("");
                        if($("#from-input"+id).val() == "")
                          {
                         $("#from-input"+id).val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input"+id).val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                           date.setFullYear(date.getFullYear()+1);
                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
              }
              else if($("#same_day").is(":checked"))
              {
                 ("#from-input"+id).val("");
                 for(i=0;i<inse;i++)
                    { 
                       // $("#from-input"+id).val("");
                        if($("#from-input"+id).val() == "")
                          {
                         $("#from-input"+id).val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input"+id).val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                         //  date.setDate(date.getFullYear()+1);
                          // td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    } 
                }
                else  if($("#odf1").is(":checked"))
              {
                   
                  odf=1;
                  $("#odf").prop("checked",true);
              }
              else
              {
                   
                    var d=$("#name_dop").val();
                    var v = $("#from-input"+id).val();
                         if(v !="")
                         {
                          var dates = v.split(", ");
                      
                          var count = dates.length;
                         // alert(count);
                         }
                         else
                         {
                             var count =0;
                         }
                         if(count == inse)
                         {
                             alert("you can not enter more dates");
                             // $("#name_dop").val(""); 
                         }
                         else
                         {
                                  if($("#from-input"+id).val() == "")
                                  {
                                     $("#from-input"+id).val(function() {
                                    return this.value + d;
                                 
                                         });
                                  }
                                  else
                                  {
                                          $("#from-input"+id).val(function() {
                                       return this.value +', '+ d;
                                   
                                         });
                          }
                        // $("#name_dop").val(""); 
                        
                         }

              }
         }
        else
        {
            
            // var data = $("#from-input").val("");
             //alert(data.length);
         if($("#daily").is(":checked"))
              {     
                    $("#from-input").val("");
                    for(i=0;i<inse;i++)
                    { 
                       // $("#from-input").val("");
                        if($("#from-input").val() == "")
                          {
                         $("#from-input").val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input").val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                           date.setDate(date.getDate()+1);
                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
                }
            else  if($("#after").is(":checked") && $("#days").val()!="")
              {
                 
                  var d =parseInt($("#days").val());
                 
                   $("#from-input").val("");
                    for(i=0;i<inse;i++)
                    { 
                       // $("#from-input").val("");
                        if($("#from-input").val() == "")
                          {
                         $("#from-input").val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input").val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                           date.setDate(date.getDate() + d);
                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
              }
              else  if($("#weekly").is(":checked"))
              {
                 
                  $("#from-input").val("");
                    for(i=0;i<inse;i++)
                    { 
                       // $("#from-input").val("");
                        if($("#from-input").val() == "")
                          {
                         $("#from-input").val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input").val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                           date.setDate(date.getDate() + 7);
                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
              }
              else  if($("#monthly").is(":checked"))
              {
                 
                  $("#from-input").val("");
                    for(i=0;i<inse;i++)
                    { 
                       // $("#from-input").val("");
                        if($("#from-input").val() == "")
                          {
                         $("#from-input").val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input").val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                           date.setMonth(date.getMonth() + 1);
                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
                  
              }
              else if($("#yearly").is(":checked"))
              {
                 
                  $("#from-input").val("");
                for(i=0;i<inse;i++)
                    { 
                       // $("#from-input").val("");
                        if($("#from-input").val() == "")
                          {
                         $("#from-input").val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input").val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                          date.setFullYear(date.getFullYear() + 1);
                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
                  
                }
                else  if($("#same_day").is(":checked"))
              {
                 $("#from-input").val("");
                  for(i=0;i<inse;i++)
                    { 
                       // $("#from-input").val("");
                        if($("#from-input").val() == "")
                          {
                         $("#from-input").val(function() {
                        return this.value + td;
                     
                    });
                          }
                          else
                          {
                              $("#from-input").val(function() {
                        return this.value +', '+ td;
                       
                    });
                   
                          }
                         // date.setFullYear(date.getFullYear() + 1);
                          // td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
                    }
              }
               else  if($("#odf1").is(":checked"))
              {
                   odf=1;
                  $("#odf").prop("checked",true);
              }
               else  if($("#odf1").is(":unchecked"))
              {
                   odf=0;
                  $("#odf").prop("checked",false);
              }
              else
              {
                 
                    var d=$("#name_dop").val();
                    var v = $("#from-input").val();
                   // alert(v);
                         if(v!="")
                         {
                          var dates = v.split(", ");
                     // alert("dates"+dates);
                          var count = dates.length;
                     //     alert(count);
                         }
                         else
                         {
                             var count =0;
                         }
                         if(count == inse)
                         {
                             alert("you can not enter more dates");
                             // $("#name_dop").val(""); 
                         }
                         else
                         {
                                  if($("#from-input").val() == "")
                                  {
                                     $("#from-input").val(function() {
                                    return this.value + d;
                                 
                                         });
                                  }
                                  else
                                  {
                                          $("#from-input").val(function() {
                                       return this.value +', '+ d;
                                   
                                         });
                          }
                       //  $("#name_dop").val(""); 
                        
                         }

              }
        }
      }  
        
    function get_price()
    {
       
        var  newspaper= $("#newspaper").val();
        //var  city= $("#city").val();
        var  cat= $("#cat").val();
        var  inse= $("#inse").val();
        var color= $("#color").val();
       

        if(newspaper=="" || cat=="" || inse=="" || color=="")
        {
            alert("Select Newspaper,City,Position and Color");
            $('#inse').val(function() 
                           {
                return this.defaultValue;
            });
            return false;
        }
       
        var form_data= {'newspaper':newspaper,'cat':cat,'inse':inse,'color':color};
        $.ajax({
            url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_price",
            type: "POST",				
            async: true ,               
            data: form_data,
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                document.getElementById("loader").style.display = "none";

                if(data=='1')
                {
                    alert("Select Newspaper and Position First.");
                    $('#inse').val(function() 
                                   {
                        return this.defaultValue;
                    });
                    return false;
                }
                if(data=='2')
                {
                    alert("Rate3 not Set with this Newspaper or Position.");
                    $('#inse').val(function() 
                                   {
                        return this.defaultValue;
                    });
                    return false;
                }
           				

                					var price = $.parseJSON(data);
					console.log(price);
					/* Use jQuery's each to iterate over the tr value
					document.getElementById("rate").value = price.ad_price;
					document.getElementById("erate").value = price.extra_price;
					document.getElementById("mrate").value = price.mul_rate;
					document.getElementById("merate").value = price.mul_ex;
					document.getElementById("brate").value = price.b_rate;
					document.getElementById("comm1").value = price.discount;
					//document.getElementById("nfdc").value = price.discount;*/
					//min_w=price.min_w;
					size_type=price.size_type
					f_min_l=price.f_min_l;
					f_min_r=price.f_min_r;
					s_min_l=price.s_min_l;
					s_min_r=price.s_min_r;
					s_max_l=price.s_max_l;
					s_max_r=price.s_max_r;
					d_min_l=price.d_min_l;
					d_min_r=price.d_min_r;
					d_max_l=price.d_max_l;
					d_max_r=price.d_max_r;
				/*	if (price.size_type == 'F')
					{
					document.getElementById("size_l").min = f_min_l;
					document.getElementById("size_r").min = f_min_r;
					document.getElementById("size_r").value = f_min_r;
					}
					else if (price.size_type == 'S')
					{
					document.getElementById("size_l").min = s_min_l;
					document.getElementById("size_r").min = s_min_r;
					document.getElementById("size_l").max = s_max_l;
					document.getElementById("size_r").max = s_max_r;
					document.getElementById("size_r").value = s_max_r;
					}
					if (price.size_type == 'D')
					{
					document.getElementById("size_l").min = d_min_l;
					document.getElementById("size_r").min = d_min_r;
					document.getElementById("size_l").max = d_max_l;
					document.getElementById("size_r").max = d_max_r;
						document.getElementById("size_r").value = d_max_r;
				
					}
					
				*/	
					//document.getElementById("w_count1").value = price.min_w;
					document.getElementById("comm1").value = price.discount;
				//	document.getElementById('gst').value=price.gst;
			//	alert("price unit"+ price.unit);
					$("#unit option[value='" + price.unit +"']").attr("selected", true);
					
					days=price.day_id.split(",");
					nfdc=price.non_focus_charge.split(",");
					
				 if(nfdc[1] == 'Rs')

                    {

                        //alert(nfdc[1]+"   "+nfdc[0]);

                        document.getElementById("nfdc").value = nfdc[0];

                    }
                    else
                    {
                        document.getElementById("nfdc").value=0;
                    }
					
					document.getElementById("comm2").value = 0;
					document.getElementById("comm3").value = 0;
					document.getElementById("comm4").value = 0;
					document.getElementById("comm5").value = 0;
					document.getElementById("comm6").value = 0;
					document.getElementById("comm7").value = 0;
					document.getElementById("comm8").value = 0;
					commission();
				
					/*
					//var amount=price.ad_price*inse;
					//document.getElementById("amount").value = amount.toFixed( 2 );
					
					
					//amount_calculate();
					
					*/
					
				},
				complete: function() 
                {
                   date_pic();
                   get_size();
                },
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Error ");
					}
			});
		
}

    var flag=0;
  
   function date_pic(id=null)
    {
               
            var  inse= $("#inse").val();
var data= jQuery.parseJSON('<?php echo json_encode($dops) ?>'); 
            var dop="";
            var dops=[];
          var j=0;
          if(data.length!=0)
          {
            $.each(data, function(i, d) {
                dop=d.dop;
                
          
            
             var dop1=dop.split(", ");
             
            $.each(dop1, function(i, d) {
                 if( dop1!=NaN || dop1!='NaN/NaN/NaN')
             {
                dops[j] = new Date(dop1[i]);
               j++
             }
               });
            });
             if( dops.length!=0||dops!=NaN || dops!='NaN/NaN/NaN')
             {
    $.each(dops,function(i,d){
            $("#from-input").multiDatesPicker({
                addDates: dops,
                  
                    });
   
    });
       }    }
  $( "#from-input" ).multiDatesPicker({ minDate: 0});
        var today = new Date();
        $('#from-input').multiDatesPicker({


            onSelect:function()
            {			
                var dates= $("#from-input").val();
                var s_days=dates.split(", ");
                var i=s_days.length;
                if(i>= inse)
                {
                    $('#from-input').multiDatesPicker('removeIndexes', inse);
                }
                i=i-1;

                var s_date=s_days[i];
                var d = new Date(s_days[i]);
                var day_id=d.getDay();

                var f=0;
                var j;
                for(j=0; j < 7; j++)
                {
                    if(day_id== days[j])
                    {
                        f=1;
                        break;
                    }
                }

                if(f!=1 && dates!="" && flag == 0)
                {
                    var status=confirm("You select non focus Day do you want to add.");
                    if (status == true) 
                    {
                        flag=1;
                        return false;
                    } 
                    else 
                    {
                        var ind=s_days.length;
                        ind--;
                        $('#from-input').multiDatesPicker('removeIndexes', ind);
                    }
                }
                if((s_days.length)==inse)
                {
                    get_dop_price();    
                }

            },

            beforeShowDay: function(day) {
                var day = day.getDay();
                if (day == days[0] || day == days[1] || day == days[2] || day == days[3] || day == days[4] || day == days[5] || day == days[6]) 
                {
                    return [true, "focus_day_color"]
                } 
                else 
                {
                    return [true, ""]
                }
            }

        });

    }


    function date_pic1() {


        if ($('#add_on').is(":checked")) 
        {//	get_price();	
            get_base_price();
        }
        else
        {
           
            get_price();
            get_dop_price();
        }
        //get_price();
        get_package();

        $('#from-input').multiDatesPicker('resetDates', 'picked');

        date_pic();

    }

    function date_pic_byid(paper_id)
    {	

        var id="from-input"+paper_id;
        //alert(id);

        var  inse= $("#inse").val();
        var  cat= $("#cat").val();
var color= $("#color").val();
        var form_data= {'newspaper':paper_id,'cat':cat,'inse':inse,'color':color};

        $.ajax({
            url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_fdays",
            type: "POST",				
            async: true ,               
            data: form_data,
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                document.getElementById("loader").style.display = "none";

                if(data=='1')
                {
                    alert("Select Newspaper,Heading and enter Insertion First.");
                    /*$('#inse').val(function() 
						{
							return this.defaultValue;
						});*/
                    return false;
                }
                if(data=='2')
                {
                    alert("Rate4 not Set with this Newspaper or Heading.");
                    /*$('#inse').val(function() 
						{
							return this.defaultValue;
						});*/
                    return false;
                }


                // Parse the returned json data
                var price = $.parseJSON(data);

                days=price.day_id.split(",");


            },
            complete: function() 
            {
                date_pic_byid1(paper_id);
            },
            error: function() 
            {
                document.getElementById("loader").style.display = "none";
                alert("Rate5 not Set with this Newspaper or Heading.");
            }
        });

        //setTimeout(function () {date_pic_byid1(paper_id);	}, 500);



    }

    function date_pic_byid1(paper_id)
    {
       var id=paper_id;
            var data= jQuery.parseJSON('<?php echo json_encode($dops) ?>'); 
            var dop="";
            if(data.length!=0)
            {
                $.each(data, function(i, d) {
                   
                    if(paper_id == d.paper_id)
                    {
                        dop=d.dop;
                    //alert(dop);
                var dops=dop.split(", ");
               $.each(dops, function(i, d) {
                if(dops[i]!=NaN || dops[i]!='NaN/NaN/NaN')
                {
                dops[i] = new Date(dops[i]);
                }
            });
              if( dops.length!=0||dops!=NaN || dops!='NaN/NaN/NaN')
             {
            $("#from-input"+id).multiDatesPicker({
                addDates: dops,
                  
                   
                     beforeShowDay: function(day) {
                    var day = day.getDay();
                    if (day == days[0] || day == days[1] || day == days[2] || day == days[3] || day == days[4] || day == days[5] || day == days[6]) 
                    {
                        return [true, "focus_day_color"]
                    } 
                    else 
                    {
                        return [true, ""]
                    }
                }
                      
                        });
                    }
                    }     
                });
            }
          
            
        var  inse= $("#inse").val();

        var today = new Date();
        $('#form-input'+id).multiDatesPicker({
            onSelect:function()
            {			
                var dates= $("#"+id).val();
                var s_days=dates.split(", ");
                var i=s_days.length;
                if(i>= inse)
                {
                    $('#from-input'+id).multiDatesPicker('removeIndexes', inse);
                }
                i=i-1;

                var s_date=s_days[i];
                var d = new Date(s_days[i]);
                var day_id=d.getDay();

                var f=0;
                var j;
                for(j=0; j < 7; j++)
                {
                    if(day_id== days[j])
                    {
                        f=1;
                        break;
                    }
                }

                if(f!=1 && dates!="" && flag == 0)
                {
                    var status=confirm("You select non focus Day do you want to add.");
                    if (status == true) 
                    {
                        flag=1;
                        return false;
                    } 
                    else 
                    {
                        var ind=s_days.length;
                        ind--;
                        $('#from-input'+id).multiDatesPicker('removeIndexes', ind);
                    }
                }

            },

            beforeShowDay: function(day) {
                var day = day.getDay();
                if (day == days[0] || day == days[1] || day == days[2] || day == days[3] || day == days[4] || day == days[5] || day == days[6]) 
                {
                    return [true, "focus_day_color"]
                } 
                else 
                {
                    return [true, ""]
                }
            }

        });

    }
    function get_dop_price()
    {
        document.getElementById("loader").style.display = "block";
        var  newspaper= $("#newspaper").val();	
        var  cat= $("#cat").val();
        var  inse= $("#inse").val();
        var color= $("#color").val();
        if(newspaper=="" || cat=="" || inse=="" || color=="")
        {
            alert("Select Newspaper,City,Position and Color");
            $('#inse').val(function(){
                return this.defaultValue;
            });
            return false;
        }
       
        var dates= $("#from-input").val();
        var s_days=dates.split(", ");
        var c=s_days.length;
        var i;
        var p_u = document.getElementById('pub_dates');
        p_u.innerHTML = "";
        for(i=0; i<c ;i++)
        {
            //alert(s_days[i]);
            var form_data= {'newspaper':newspaper,'cat':cat,'inse':inse,'s_date':s_days[i],'count':i,'color':color,'size_type':size_type};
            //alert(s_days[i]);
            $.ajax({
                url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_dop_price",
                type: "POST",				
                async: true ,               
                data: form_data,
                beforeSend: function(){ document.getElementById("loader").style.display = "block";},
                success: function(data)
                {					  
                    if(data=='1')
                    {
                        alert("Rate not Set with this Newspaper,Color or Position on some Date.");
                        return false;
                    }
                    // Parse the returned json data
                    var data = $.parseJSON(data);
      
                    var html='<div id="rate_dis'+ data['values'].count +'" style="display: none;">	               <div class="title" style="background-color:#fff;"><i class="fa fa-money"></i><strong> Rate Of Date '+ data['values'].s_date +'</strong></div>       <div class="form-group"><label for="pack-price" class="col-md-3 control-label">Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['values'].count +'" id="rate'+ data['values'].count +'"></div> <label for="pack-price" class="col-md-3 control-label">B Rate</label><div class="col-md-3"><input type="text" onchange="amount_calculate();" placeholder="" class="form-control" name="brate'+ data['values'].count +'" id="brate'+ data['values'].count +'"></div></div></div>';
                    p_u.insertAdjacentHTML('beforeend', html);
                    datarate[0]=data['rates'].ad_price;
                    datarate[1]=data['rates'].f_rate;
                    console.log(datarate);
                    document.getElementById("rate"+data['values'].count).value = data['rates'].ad_price;
                    document.getElementById("brate"+data['values'].count).value = data['rates'].b_rate;
                },
                error: function() 
                {
                    document.getElementById("loader").style.display = "none";
                    alert("Rate not Set with this Newspaper or Position.");
                }
            });

            //var d1 = document.getElementById('pub_dates');

        }

        setTimeout(amount_calculate, 2000);
        setTimeout(hide_div, 2500);
        document.getElementById("loader").style.display = "none";	
    }


    function hide_div()
    {
        var x = document.getElementById('rate_dis0');
        x.style.display = 'block';

        var  inse= $("#inse").val();
        var  rate=0;	
        var  brate=0;	
        var i;

        var dates= $("#from-input").val();
        var s_days=dates.split(", ");
        var c=s_days.length;

        for(i=1 ; i < c ;i++)
        { 
            rate= parseFloat($("#rate"+i).val());			

            var o_rate= parseFloat($("#rate"+(i-1)).val());	

            if(o_rate!=rate)
            {
                var x = document.getElementById('rate_dis'+i);
                x.style.display = 'block';
            }
        }
    }
function non_focus_day(id=null){
           // var id=id;
           if ($('#add_on').is(":checked"))
           {
            var  dates= $("#from-input"+base_id).val();
           }
           else
           {
                var  dates= $("#from-input").val();
           }
            var i;

            var f=1;
           if(dates!=null)
           {
            var s_days=dates.split(", ");

           

            for(i=0; i<(s_days.length);i++)	

            {

                var fl=0;

                var d = new Date(s_days[i]);

                var day_id=d.getDay();

                var j;

                for(j=0; j < days.length; j++){

                    if(day_id == days[j]){

                        fl=1;				

                    }			

                }

                if(fl==0){

                    f=0;

                }

            }
}


            if(f==0){

                return 1;	

            } else {

                return 0;

            }

        }
    function date_val()
    {
        var  dates= $("#from-input").val();
      //  alert(dates);
    }

//$('#from-input').multiDatesPicker();
</script>


<script type="text/javascript">
function save_ro()
{
	/*if ($('#ro_add').validate()) {
            alert('form is valid');
        } else {
            alert('form is not valid');
			return false;
        }*/
	
	var  client= $("#client").val();
	var  employee= $("#employee").val();
	var  newspaper= $("#newspaper").val();
	var  title= $("#title").val();
	var  matter= $("#matter").val();
	var  cat= $("#cat").val();
	var  sheading= $("#sheading").val();
	
	var  pack= $("#pack").val();
	
	var  inse= $("#inse").val();
	var  scheme= $("#scheme").val();
	var  material= $("#material").val();
	var  party= $("#party").val();
	var  premimum= $("#premimum").val();
	var  box= $("#box").val();
	
	
	if ($('#add_on').is(":checked")) 
	{
		var  price= parseFloat($("#rate"+base_id).val());		
		var  eprice= parseFloat($("#erate"+base_id).val());
		
		var arr = $("#a_newspaper").val();
		if(arr!=null)
		{
		arr.unshift(newspaper);
		}
		newspaper=base_id;
		
		var add_dop = [];
		
		var val=$("#from-input"+ base_id).val();
		var id=base_id;
		
		var data = {id : id, dop  : val, rate : price , e_rate : eprice};
		add_dop.push(data);
		
		if($('#sdta').is(":checked"))
		{
			$.each(arr, function(i, d) {
				
				if(d==base_id)
				{	
			
					return;
				}
						
						var id=d;
						var  price= parseFloat($("#rate"+id).val());
						var  eprice= parseFloat($("#erate"+id).val());
						data = {id : id, dop  : val, rate : price , e_rate : eprice};						
						add_dop.push(data);
						
					//alert(pack_dop[i]);
					});
		}
		else
		{
			$.each(arr, function(i, d) {
				
					if(d==base_id)
					{
						
						return;
					}
						
						var val=$("#from-input"+ d).val();
						var id=d;
						var  price= parseFloat($("#rate"+id).val());
						var  eprice= parseFloat($("#erate"+id).val());
						data = {id : id, dop  : val, rate : price , e_rate : eprice};
						add_dop.push(data);
						
					//alert(pack_dop[i]);
					});
		}
		
		var  p_date=add_dop;
		var  ro_type="M";		
	}
	else
	{
				
	if(pack=="")
	{
		var  price = 0;	
		var  eprice = 0;
		var i;
		for(i=0;i<inse;i++)
		{
			price= price + parseFloat($("#rate"+i).val());
			eprice= eprice + parseFloat($("#erate"+i).val());				
		}
		price= price/inse;
		eprice= eprice/inse;
		
		var  p_date=$("#from-input").val();
		var  ro_type="N";
	}
	else
	{
		var  price=$("#rate").val();	
		var  eprice=$("#erate").val();
		var pack_dop = [];
		/*$.each(packs, function(i, d) {
						
						var val=$("#from-input"+ d.paper_id).val();
						var id=d.paper_id;
						var data = {id : id, dop  : val};
						pack_dop.push(data);
						
					//alert(pack_dop[i]);
					});*/
					
		if($('#sdta').is(":checked"))
		{
			var dop_to_all="";
			$.each(packs, function(i, d) {
						
						var val=$("#from-input"+ d.paper_id).val();
						if(val != "")
						{
							dop_to_all=val;
						}
						
					//alert(pack_dop[i]);
					});
			
			$.each(packs, function(i, d) {						
						
						var id=d.paper_id;
						var data = {id : id, dop  : dop_to_all, rate : price , e_rate : eprice};
						
						pack_dop.push(data);
						
					//alert(pack_dop[i]);
					});
		}
		else
		{
			$.each(packs, function(i, d) {
						
						var val=$("#from-input"+ d.paper_id).val();
						var id=d.paper_id;
						var data = {id : id, dop  : val, rate : price , e_rate : eprice};
						pack_dop.push(data);
						
					//alert(pack_dop[i]);
					});
		}
		
		var  p_date=pack_dop;
		var  ro_type="P";
	}
	
	}
	
	//var  city= $("#city").val();
	//var  p_date=$("#from-input").val();
	
	if($('#sdta').is(":checked"))
	{
		var sdta=1;
	}
	else
	{
		var sdta=0;
	}
	
	if ($('#odf').is(":checked")) 
	{
		var odf=1;
	}
	else
	{
		var odf=0;
	}
	
	
	var  w_count= ($("#size_l").val() + 'X' + $("#size_r").val());	
	var  t_amount= $("#t_amount").val();
	var  p_amount= $("#p_amount").val();	
	
	var  add_a= $("#add_a").val();
	
	var ro_id=<?php echo $book_ad->id;?>;
	
	var form_data= {'ro_id':ro_id,'newspaper':newspaper,'cat':cat,'pack':pack,'inse':inse,'scheme':scheme,'premimum':premimum,'price':price,'eprice':eprice,'w_count':w_count,'p_date':p_date,'ro_type':ro_type,'t_amount':t_amount,'p_amount':p_amount,'add_a':add_a,'odf':odf};
	
	return form_data;
}     

    function get_state()
    {
        //alert("Please Select Newspaper!");
        var newspaper = $("#newspaper").val();
        //console.log(newspaper);
        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/book_ads/get_state",
            type: "POST",				
            async: true ,               
            data: {newspaper_id:newspaper},
            beforeSend: function(){ document.getElementById("loader").style.display = "block"; },
            success: function(data)
            {
                document.getElementById("loader").style.display = "none";
                //console.log(data); return false;
                $('#state').empty();
                // Parse the returned json data
                var opts = $.parseJSON(data);
                // Use jQuery's each to iterate over the opts value
                $.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                    $('#state').append('<option value="' + d.id + '">' + d.name + '</option>');
                });
            },                
            error: function() 
            {
                document.getElementById("loader").style.display = "none";
                alert("Please Select Newspaper!");
            }
        });	
        get_premimum();
        get_heading();
        get_paper();
    }

    function get_heading()
    {
        var newspaper = $("#newspaper").val();
     
        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_heading",
            type: "POST",				
            async: true ,               
            data: {id:newspaper},
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                document.getElementById("loader").style.display = "none";
                $('#cat').empty();

                if(data=="[]")
                {
                    alert("Position not found.");
                }

                $('#cat').append('<option value="">Choose One</option>');
                // Parse the returned json data
                var opts = $.parseJSON(data);
                // Use jQuery's each to iterate over the opts value
                $.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
                    $('#cat').append('<option value="' + d.id + '">' + d.position + '</option>');
                });


                $("#cat option[value='<?php echo $book_ad->cat_id; ?>']").attr("selected", true);

            },
            complete: function() 
            {                    
               // get_sub_heading();
              date_pic1();
           //   get_package();
               get_scheme();
            },
            error: function() 
            {
                document.getElementById("loader").style.display = "none";
                alert("Please Select Position!");
            }
        });
    } 


    function get_sub_heading()
    {
        get_scheme();

        var cat = $("#cat").val();
        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_sub_heading",
            type: "POST",				
            async: true ,               
            data: {cat_id:cat},
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                document.getElementById("loader").style.display = "none";
                $('#sheading').empty();
                // Parse the returned json data
                var opts = $.parseJSON(data);
                // Use jQuery's each to iterate over the opts value
                $.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
                    $('#sheading').append('<option value="' + d.id + '">' + d.sub_heading + '</option>');
                });	
            }, 
            complete: function() 
            {                    
              alert("sub heading done");
            },
            error: function() 
            {
                document.getElementById("loader").style.display = "none";
                alert("Please Select Position!");
            }
        });
    }    


    function get_scheme()
    {
        
        var  cat= $("#cat").val();
        var newspaper = $("#newspaper").val();
        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_scheme",
            type: "POST",				
            async: true ,               
            data: {n_id:newspaper, cat_id:cat},
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                document.getElementById("loader").style.display = "none";
                $('#scheme').empty();
                myscheme();
                // Parse the returned json data
                var opts = $.parseJSON(data);
                // Use jQuery's each to iterate over the opts value
                $.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
                    $('#scheme').append('<option value="' + d.scheme_id + '">' + d.scheme_name + '</option>');
                });	
              
                    $("#scheme option[value='<?php echo $book_ad->scheme; ?>']").attr("selected", true);
            },
             complete: function() 
            {                    
              get_scheme_price();
            },
            error: function() 
            {
                document.getElementById("loader").style.display = "none";
                alert("Please Select Position!");
            }
        });
    } 

    function get_scheme_price()
    {

        var scheme_id = $("#scheme").val();
        if(scheme_id=="")
        {
            free_days = 0;
            amount_calculate();
            return false;
        }

        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_scheme_price",
            type: "POST",
            async: true ,
            data: {s_id:scheme_id},
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                document.getElementById("loader").style.display = "none";
                if(data=='1')
                {
                    alert("Scheme not Found on Server");						
                    return false;
                }
                // Parse the returned json data
                var scheme = $.parseJSON(data);
                //console.log("scheme data"+data);
                // Use jQuery's each to iterate over the opts value
                var  inse= parseInt($("#inse").val());
                var day=parseInt(scheme.free) + parseInt(scheme.paid);
                if((day <= inse) && (inse%day==0))
                {
                    free_days=(inse/day)*scheme.free;
                    alert("Scheme applied. Free Days :-"+free_days);
                }
                else
                {
                    free_days = 0;
                    alert("Scheme Not applicable.");
                    document.getElementById("scheme").selectedIndex = 0;
                }

            },                
            error: function() 
            {
                document.getElementById("loader").style.display = "none";
                alert("Server not responding.");
            }
        });
    }

    function get_premimum()
    {
        var newspaper = $("#newspaper").val();
      
        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_premimum",
            type: "POST",				
            async: true ,               
            data: {n_id:newspaper},
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                document.getElementById("loader").style.display = "none";

                $('#premimum').empty();
                //myFunction();
                //$('#premimum').append('<option value="">'"premimum"'</option>');
                // Parse the returned json data
                var opts = $.parseJSON(data);
                // Use jQuery's each to iterate over the opts value
                $.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
                    $('#premimum').append('<option value="' + d.id + '">' + d.p_type + '    ' + d.premimum + ' </option>');
                });
                $("#premimum option[value='<?php echo $book_ad->premimum; ?>']").attr("selected", true);
                /*
					//$('#premimum').empty();
					//myFunction();
					//$('#premimum').append('<option value="">'"premimum"'</option>');
					// Parse the returned json data
					var opts = $.parseJSON(data);
					// Use jQuery's each to iterate over the opts value
					var htmlcode=" ";
					$.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data

					htmlcode=htmlcode+'<input type="radio" name="premimum" value="' + d.id + '"/> '+ d.premimum + ' % , ' + d.color;

					});	

					document.getElementById("premimum123").innerHTML = htmlcode;
					*/

            },
            complete: function() 
            {                    
               sel_update_pre();

                    document.getElementById("loader").style.display = "block";
                    setTimeout(get_premimum_price, 5000);
            },
            error: function() 
            {
                document.getElementById("loader").style.display = "none";
                alert("Please Select Heading!");
            }
        });
    }


    function sel_update_pre()
    {	
        $("#premimum").trigger("chosen:updated");
        document.getElementById("loader").style.display = "none";
    }
    var pa=0;
    function get_premimum_price()
    {
        pa=0;
        var pre_id = $("#premimum").val();
        if(pre_id==null)
        {	
            document.getElementById("premimum_a").value = 0;
            amount_calculate();
            return false;
        }
        document.getElementById("loader").style.display = "block";
        $.each(pre_id, function(i, id) {
            $.ajax({                
                url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_premimum_price",
                type: "POST",				
                async: false ,               
                data: {pre_id:id},			
                success: function(data)
                {


                    if(data=='1')
                    {						
                        alert("Premimum not Found on Server!");
                        return false;
                    }
                    var pre = $.parseJSON(data);
                     if(pre.premimum!=null ||pre.premimum!= undefined)
                    {
                        document.getElementById("premimum_type_value").value=pre.premimum;
                        prem=pre.premimum.split(",");
                    }
                    else
                    {
                        alert("NUll value of Premimum");
                        return;
                    }
                   // prem=pre.premimum.split(",");
                      premimum_type=prem[1];

                       premimum_value=prem[0];
                    if(prem[1] == 'Rs')
                    {
                        pa=parseFloat(pa+ prem[0]);
                        return false;
                    }
                    if(prem[1] == '%')
                    {
                        var  non_fdc= parseFloat($("#nfdc").val());
                        var  add_on_a= parseFloat($("#add_a").val());						
                        var  box_c= parseFloat($("#box_c").val());
                        var  amount= parseFloat($("#amount").val());						
                        var  extra_ca= parseFloat($("#eca").val());
                        var p_a=(amount + extra_ca +non_fdc + add_on_a + box_c)* parseFloat(prem[0])/100;
                        pa=parseFloat(pa + p_a);
                        return false;
                    }
                },
                complete: function() 
                {                    
                    document.getElementById("premimum_a").value =pa;
                },
                error: function() 
                {
                    document.getElementById("loader").style.display = "none";
                    alert("Server not responding!");
                }
            });
        });		

        amount_calculate();	
        document.getElementById("loader").style.display = "none";
    }


  
    function get_package()
    {

        var newspaper = $("#newspaper").val();
        var cat = $("#cat").val();
        var inse= $("#inse").val();

        if(newspaper=="" || cat=="" || inse=="" )
        {
            alert("Select Newspaper,Position and enter insertion");
            $('#inse').val(function() 
                           {
                return this.defaultValue;
            });
            return false;
        }


        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_package",
            type: "POST",
            async: true ,
            data: {n_id:newspaper,cat_id:cat,ins:inse},
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                document.getElementById("loader").style.display = "none";

                $('#pack').empty();					
                $('#pack').append('<option value="">'+"Package"+'</option>');
                // Parse the returned json data
                var opts = $.parseJSON(data);
                console.log(opts);
                // Use jQuery's each to iterate over the opts value
                $.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
                    $('#pack').append('<option value="' + d.id + '">' + d.package + ' </option>');
                });
                /*
					//$('#premimum').empty();
					//myFunction();
					//$('#premimum').append('<option value="">'"premimum"'</option>');
					// Parse the returned json data
					var opts = $.parseJSON(data);
					// Use jQuery's each to iterate over the opts value
					var htmlcode=" ";
					$.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data

					htmlcode=htmlcode+'<input type="radio" name="premimum" value="' + d.id + '"/> '+ d.premimum + ' % , ' + d.color;

					});	

					document.getElementById("premimum123").innerHTML = htmlcode;
					*/

            },                
            error: function() 
            {
                document.getElementById("loader").style.display = "none";
                alert("Please Select Position and Newspaper!");
            }
        });
    }

    var packs=[];

    function get_pack_price()
    {		
        var pack= $("#pack").val();

        if(pack=="")
        {
            var x = document.getElementById('base_p_date');
            x.style.display = 'block';
            x = document.getElementById('pack_rate');
            //x.innerHTML="";
            x.style.display = 'none';
            x = document.getElementById('pack_pub_dates');
            x.style.display = 'none';
            x = document.getElementById('pub_dates');
            x.style.display = 'block';
            date_pic1();
            amount_calculate();
            return false;
        }

        $.ajax({
            url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_package_price",
            type: "POST",
            async: true ,
            data: {pack_id:pack},
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                var x = document.getElementById('base_p_date');
                x.style.display = 'none';
                x = document.getElementById('pub_dates');
                x.style.display = 'none';
                x = document.getElementById('pack_rate');
                x.style.display = 'block';

                document.getElementById("loader").style.display = "none";

                var data = $.parseJSON(data);

                document.getElementById("rate").value = data['pack'].rate;
                //document.getElementById("erate").value = data['pack'].e_rate;
                document.getElementById("brate").value = data['pack'].b_rate;
                document.getElementById("comm1").value = data['pack'].discount;
                commission();

                var p_u = document.getElementById('pack_pub_dates');
                p_u.innerHTML="";
                var htm="";

                packs=data['pack_paper'];
                $.each(data['pack_paper'], function(i, d) {


                    htm='<div class="form-group">	<label for="pack-price" class="col-md-6 control-label" onclick="date_pic_byid('+d.paper_id+');">Publish Dates of '+ d.newspaper_name +'</label>	<div class="col-md-6">	<div class="box"  id="from--input">	<input class="form-control" name="p_date'+ d.paper_id +'" type="text" id="from-input'+ d.paper_id +'" data-id="'+d.paper_id+'"  data-toggle="modal" data-target="#dopModal" onclick="showModal('+d.paper_id+')" placeholder="mm/dd/yyyy, ..." >	</div>	<div class="code-box">	</div>	</div>	</div>';

                    p_u.insertAdjacentHTML('beforeend', htm);

                    /*date_pic_byid("from-input"+d.paper_id,d.paper_id);
									var tm=10000*(i+1);
									setTimeout(function () {						
									date_pic_byid("from-input"+d.paper_id,d.paper_id);

									}, tm);
									*/

                });	

                //var d= document.getElementById('pub_dates');
                //d.innerHTML=htm;


                amount_calculate();

            },                
            error: function() 
            {
                document.getElementById("loader").style.display = "none";
                alert("Please Select Position and Newspaper!");
            }
        });

    }


    function commission()
    {
        var  comm1= $("#comm1").val();
        var  comm2= $("#comm2").val();
        var  comm3= $("#comm3").val();
        var  comm4= $("#comm4").val();
        var  comm5= $("#comm5").val();
        var  comm6= $("#comm6").val();
        var  comm7= $("#comm7").val();
        var  comm8= $("#comm8").val();

        var comm=0;
        var amount=100;
        var comm_a=0;

        comm=amount*comm1/100;
        amount=amount-comm;
        comm_a=comm_a+comm;

        comm=amount*comm2/100;
        amount=amount-comm;
        comm_a=comm_a+comm;

        comm=amount*comm3/100;
        amount=amount-comm;
        comm_a=comm_a+comm;

        comm=amount*comm4/100;
        amount=amount-comm;
        comm_a=comm_a+comm;

        comm=amount*comm5/100;
        amount=amount-comm;
        comm_a=comm_a+comm;

        comm=amount*comm6/100;
        amount=amount-comm;
        comm_a=comm_a+comm;

        comm=amount*comm7/100;
        amount=amount-comm;
        comm_a=comm_a+comm;

        comm=amount*comm8/100;
        amount=amount-comm;
        comm_a=comm_a+comm;
        document.getElementById("dis").value = comm_a.toFixed( 2 );

        setTimeout(amount_calculate, 2000);
    }

    function myFunction() {
        var x = document.getElementById("premimum");
        var option = document.createElement("option");
        option.text = "Select if Premimum";
        option.value = "";
        x.add(option);
    } 

    function myscheme() {
        var x = document.getElementById("scheme");
        var option = document.createElement("option");
        option.text = "None";
        option.value = "";
        x.add(option);
    } 
 function amount_calculate()
{	//checkboxes();
		var  premimum_a= parseFloat($("#premimum_a").val());
	var  size_l= parseFloat($("#size_l").val());
	var  size_r= parseFloat($("#size_r").val());
	var  unit= $("#unit").val();
	//var  w_count1= parseFloat($("#w_count1").val());
    var  inse= parseInt($("#inse").val());
    var  inse1= $("input[name='dop[]']:checked").length;
	//var  rate= parseFloat($("#rate").val());
	//var  erate= parseFloat($("#erate").val());
	
	var  non_fdc= parseFloat($("#nfdc").val());
	var  add_on_a= parseFloat($("#add_a").val());
	var  dis= parseFloat($("#discount_percentage").val());
	var  box_c= parseFloat($("#box_c").val());
	var  extra_ca=0;
	var  amount= 0;
	var  t_amount=0;	
	var  p_amount=0
	var  dis_a=0;
	var drop_dop=0;
		if(isNaN(add_on_a)){add_on_a=0;}
//alert("inse1"+inse1);
//alert("first inse"+inse);
	if(isNaN(dis))
	{dis=0;}
//	alert("dis" + dis);
//	alert(unit);
	if(unit == "SC")
	{
		var sqcm= size_l * size_r;
	}
	else
	{
		var sqcm= size_l;
	}
	
	
	if(inse1>0)
	{
	 drop_dop=inse-inse1;
	}
    var paid_days=0;
     var publish_day =<?php echo ($book_ad->publish_day); ?>;
     
           if(publish_day<inse && publish_day>0){
            
           var paid_days =inse-publish_day;
           inse=publish_day;
		   document.getElementById("inse").value=publish_day;
          }
            
         
   
          if(drop_dop < inse && drop_dop>0)
           {
			 
			   if(free_days>0)
			   { 
				  if(drop_dop>free_days ){
                  inse=inse-drop_dop;
                  
                  //alert("2 inse"+inse);			
                  }
					else
					{
						inse=inse-free_days;
			
					} 
			   }
			   else
			   {
				   inse=inse1;
				  
			   }
			   
            
           
           }
          
           else if(inse<free_days)
           {
               inse=0;
              	document.getElementById("Paid").value=0;
    document.getElementById("Free").value=inse;
           }
           else
           {
                inse=inse-free_days;
            
           }
         
	document.getElementById("Paid").value=inse;
    document.getElementById("Free").value=free_days;
	
if ($('#add_on').is(":checked")) 
        {
            
            var  rate=0;		
            var  brate=0;		
            var i;	

            rate= parseFloat($("#rate"+base_id).val());			
            brate= parseFloat($("#brate"+base_id).val());
             if(size_type =="F")
                 {
                    if(brate>0)
                    {
                        amount=amount+(brate * inse);
                    }
                    else
                    {
                        amount=amount+(rate * inse);
                    }
                 }
                 else
                 {
                     if(brate>0)
                    {
                        amount=amount+(brate * sqcm * inse);
                    }
                    else
                    {
                        amount=amount+(rate * sqcm * inse);
                    }
                 }
            var arr = $("#a_newspaper").val();
            var newspaper= $("#newspaper").val();
	if(arr!=null)
		{
	
            if(newspaper!=null || newspaper!=undefined)
            {
            arr.unshift(newspaper);
            }
	
            add_on_a=0.0;

            $.each(arr, function(i, id) {

                if(id==base_id)
                {
                    return;
                }
  if(isNaN(add_on_a)){add_on_a=0;}
                rate= parseFloat($("#rate"+id).val());			
                brate= parseFloat($("#brate"+id).val());			
                var add_mul= $("#add_mul"+id).val();
                 if(size_type == "F")
                 {
                        if(brate>0)
                            {
                                add_on_a=add_on_a+(brate * inse);
                            }
                            else
                            {
                                add_on_a=add_on_a+(rate * inse);
                            }
                 }
                    else
                    {
                        if(add_mul=='M')
                        {
                            if(brate>0)
                            {
                                add_on_a=add_on_a+(brate* sqcm *inse);
                            }
                            else
                            {
                                add_on_a=add_on_a+(rate* sqcm *inse);
                            }
                        }
                        else
                        {
                            if(brate>0)
                            {
                                add_on_a=add_on_a+(brate * inse);
                            }
                            else
                            {
                                add_on_a=add_on_a+(rate * inse);
                            }
                        }
                    }

            });
		}
        }
        else
        {
            var  pack= $("#pack").val();
            if(pack!="")
            {
                var  rate= parseFloat($("#rate").val());			
                var  brate= parseFloat($("#brate").val());			
            if(size_type == "F")
            {
				
                if(brate>0)
                {
                    amount=amount+(brate *  inse);
                }
                else
                {
                    amount=amount+(rate * inse);
                }
            }
            else
            {
              if(brate>0)
                {
                    amount=amount+(brate * sqcm * inse);
                }
                else
                {
                    amount=amount+(rate * sqcm * inse);
                }  
            }

            }
            else
            {
                var  rate=0;		
                var  brate=0;		
                var i;
                brate= parseFloat($("#brate0").val());	
               // alert(brate);
                if(size_type=="F"){
                    if(brate>0)
                    {
                        amount=amount+(brate  * inse);			
                    }
                    else
                    {
                        var dates= $("#from-input").val();
                        var s_days=dates.split(", ");
                        var c=s_days.length;
                        if(c>free_days)
                        {
                            c=c-free_days;
                        }

                        for(i=0 ; i < inse ;i++)
                        {
							
                            //rate= parseFloat($("#rate"+i).val());					
                            rate= parseFloat($("#rate0").val());	
                            amount=amount+(rate);
                        }
                    }
                }else{
                    if(brate>0)
                    {
                        amount=amount+(brate * sqcm * inse);			
                    }
                    else
                    {
                        var dates= $("#from-input").val();
                        var s_days=dates.split(", ");
                        var c=s_days.length;
                        if(c>free_days)
                        {
                            c=c-free_days;
                        }
                        //alert("inse"+inse);
                        for(i=0 ; i < inse ;i++)
                        {
                            //rate= parseFloat($("#rate"+i).val());					
                            rate= parseFloat($("#rate0").val());	
                            amount=amount+(rate*sqcm);
                           
                        }
                    }
                }

            }

        }
	//amount=rate*inse;	
	 if( isNaN(extra_ca)){extra_ca=0;}
		
		if( isNaN(add_on_a))	{add_on_a=0;}
		
		if(isNaN(amount))	{amount=0;}
		

	var condition=non_focus_day();	
	if(condition==1)
	{		
		if(nfdc[1]== "Rs")
		{
			t_amount=amount+premimum_a+extra_ca+non_fdc+add_on_a+box_c;
		}
		else
		{
			var non_focus_day_charge=0;
			
			non_focus_day_charge=(amount + extra_ca )* non_fdc /100;
		if(! isNaN(non_focus_day_charge))	{
			document.getElementById("nfdc").value = non_focus_day_charge;
		}
			t_amount=amount+premimum_a+extra_ca+non_focus_day_charge+add_on_a+box_c;
		}
	//t_amount=amount+premimum_a+extra_ca+non_fdc+add_on_a+box_c;
	}
	else
	{
		t_amount=amount+premimum_a+extra_ca+add_on_a+box_c;
		//t_amount = amount + premimum_a + extra_ca + add_on_a + box_c;
	}
	
	dis_a=(t_amount-box_c)*dis/100;

	p_amount=t_amount-dis_a;
	
	/*if(! isNaN( amount))
	{		
		document.getElementById("eca").value = extra_ca.toFixed( 2 );
		document.getElementById("add_a").value = add_on_a.toFixed( 2 );
		document.getElementById("amount").value = amount.toFixed( 2 );
		document.getElementById("t_amount").value = t_amount.toFixed( 2 );
		document.getElementById("taxable_amount").value = (parseFloat(t_amount)-parseFloat(dis_a)+parseFloat(box_c)).toFixed(2);
      */  
        	if(! isNaN( amount))
	{		
	//	document.getElementById("min_w").value = min_w;
		document.getElementById("eca").value = extra_ca.toFixed( 2 );
		document.getElementById("add_a").value = add_on_a.toFixed( 2 );
		document.getElementById("amount").value = amount.toFixed( 2 );
		document.getElementById("t_amount").value = t_amount.toFixed( 2 );
		document.getElementById("dis_a").value = dis_a.toFixed( 2 );
		document.getElementById("p_amount").value = p_amount.toFixed( 2 );	
	/*	if($("#discount_percentage").val()){
		    alert("")
			update_discount();
		}
*/
        
        

        
            var from_date="";
            if($('#from-input').length){
                from_date=document.getElementById("from-input").value;
            }
            if($('#from-input1').length){
                from_date=document.getElementById("from-input1").value;
            }
             if ($('#add_on').is(":checked")) 
 {
     
var newspaper= $("#newspaper").val();

                if($('#from-input'+newspaper).length){

                    from_date=document.getElementById("from-input"+newspaper).value;  

                }

                    
     

 }
 else if (pack!="")
 {
 $.each(packs, function(i, d)
                    {
                        if($('#from-input'+d.paper_id).length)
                        {
                             from_date= document.getElementById("from-input"+d.paper_id).value;
                        }
                    
                    });
}
else
{
      if($('#from-input').length)
      {
        from_date= document.getElementById("from-input").value;
      }
}
      /*      var res = from_date.split(", ", 1);
           var first_date=res[0]; 
        var second_date="2017-07-01"; 
        //console.log(ro_date);
        if(new Date(first_date)>=new Date(second_date)){
           if(document.getElementById('state').value=="6"){
                document.getElementById('cgst').value=(parseFloat(document.getElementById('taxable_amount').value)*(parseFloat(document.getElementById('gst').value)/2))/100;
                document.getElementById('sgst').value=(parseFloat(document.getElementById('taxable_amount').value)*(parseFloat(document.getElementById('gst').value)/2))/100;
                document.getElementById('igst').value=0;
            } else {
                document.getElementById('cgst').value=0;
                document.getElementById('sgst').value=0;
                document.getElementById('igst').value=(parseFloat(document.getElementById('taxable_amount').value)*parseFloat(document.getElementById('gst').value))/100;
            } 
        }
            else{
                document.getElementById('cgst').value=0;
                document.getElementById('sgst').value=0;
                document.getElementById('igst').value=0;
            }
       
        
		document.getElementById("dis_a").value = dis_a.toFixed( 2 );
		document.getElementById("p_amount").value = (p_amount+(parseFloat(document.getElementById('igst').value))+(parseFloat(document.getElementById('sgst').value))+(parseFloat(document.getElementById('cgst').value))).toFixed(2);		*/
	}
}
 function get_client()
    {
        var sel = document.getElementById("client");
        document.getElementById("party").value = sel.options[sel.selectedIndex].text;
    }

   function add_paper()
        {
            var x = document.getElementById('add_on_paper');
            var y = document.getElementById('add_pub_dates');
            var z = document.getElementById('ad_on_rate');
            var p = document.getElementById('base_p_date');
            var r = document.getElementById('add_base_dates');
            var s = document.getElementById('pub_dates');
            if ($('#add_on').is(":checked")) 
            {
                x.style.display = 'block';
                y.style.display = 'block';
                z.style.display = 'block';
                r.style.display = 'block';
                p.style.display = 'none';
                s.style.display = 'none';
            } 
            else 
            {  
                s.style.display = 'block'
                r.style.display = 'none';
                x.style.display = 'none';
                y.style.display = 'none';
                z.style.display = 'none';
                p.style.display = 'block';
            }	
        }

    function get_paper()
    {
        var  paper= $("#newspaper").val();	
        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_newspaper",
            type: "POST",				
            async: true ,               
            data: {'paper':paper},
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {					 
                $('#a_newspaper').empty();
                $('#a_newspaper').append('<option value></option>');
                var opts = $.parseJSON(data);
                $.each(opts, function(i, d) {				
                    $('#a_newspaper').append('<option value="' + d.id + '">' + d.newspaper_name + ' , '+ d.city_name +'</option>');

                });
                <?php 
                foreach($dops as $dp){ ?>
                $("#a_newspaper option[value='<?php echo $dp->paper_id; ?>']").attr("selected", true);
                <?php } ?>
            },
            complete: function() 
            {                    
                sel_update();
                setTimeout(ad_on_paper1, 200);
            },
            error: function() 
            {
                document.getElementById("loader").style.display = "none";
                alert("Please Select Newspaper!");
            }
        });
    }

    function sel_update()
    {	
        $("#a_newspaper").trigger("chosen:updated");
        document.getElementById("loader").style.display = "none";
    }

    function ad_on_paper1()
    {
        if ($('#add_on').is(":checked")) 
        {
            setTimeout(ad_on_paper,300);
        }
    }

    function ad_on_paper(id,ar){

            var arr=$("#a_newspaper").val();

            var cat=$("#cat").val();

            var inse=$("#inse").val();
            
            var color=$("#color").val();

            //var size=$("#size_l").val(); 

            var newspaper=$("#newspaper").val();
document.getElementById('pub_dates').style='none';
            var city=$("#state").val();
           if(arr==null)
            {	

                      alert("Select at least one Add on newspaper!");
                    $('#inse').val(function() 
                    						{
                    							return this.defaultValue;
                    						});
                    		return false;

            }

         arr.unshift(newspaper);
        
//alert(arr);
         //   document.getElementById("loader").style.display = "block";  
           var m_id = id;
          // alert(b_id);
            var data="";
            var ar1=[];
            var ar1 = ar;
           // alert(ar);
            var h_code="";

            var htm="";  

            var p_u= document.getElementById('add_pub_dates');		

        // p_u.innerHTML=htm;

      $.each(ar, function(i, d) {
          if(d==base_id)
                {
                    return;
                }
            var form_data= {'m_newspaper':m_id,'a_newspaper':d,'cat':cat,'inse':inse,"data":"",'city':city,'color':color};
         								
		$.ajax({
			url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_ad_on_price1",
			type: "POST",				
			async: true ,               
			data: form_data,			
			success: function(data)
	
	       
                {

                    //return false;

                    var data = $.parseJSON(data);					
 console.log(data);
                   var p_u= document.getElementById('add_pub_dates');

                   //p_u.innerHTML="";

                    if(data['msg']=='1')

                    {

                        alert("Please Select Add on Heading and Newspaper!");

                        //$("#a_newspaper option[value='"+ data['id'] +"']").attr("selected", false);

                        return false;

                    }

                    if(data['msg']=='2')

                    {

                        alert("Add on Rate not Set with Some Newspaper or Heading.");

                        return false;

                    }

add_mul[d]=data['rates'].add_mul;

                    //var html='<div class="alert alert-info" ><i class="fa fa-money"></i><strong> DOP and Price of  '+ data['values'].data +'</strong></div>                   <div class="form-group">                     <label for="pack-price" class="col-md-6 alert alert-info" onclick="date_pic_byid('+data['values'].a_newspaper_id +');" style="cursor:crosshair">Publish Dates of '+ data['values'].data +'</label>                    <div class="col-md-6">	                    <div class="box"  id="from--input">	                    <input class="form-control" name="p_date'+ data['values'].a_newspaper_id +'" type="text" id="from-input'+ data['values'].a_newspaper_id +'" placeholder="mm/dd/yyyy, ..." >	                    </div>	                    <div class="code-box">	                    </div>                    </div>                    </div>                          <div class="form-group">                    <label for="pack-price" class="col-md-3 control-label">Rate</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['values'].a_newspaper_id +'" id="rate'+ data['values'].a_newspaper_id +'" value="'+ data['rates'].price +'">                   </div>                    <label for="pack-price" class="col-md-3 control-label">Extra Charges</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="erate'+ data['values'].a_newspaper_id +'" id="erate'+ data['values'].a_newspaper_id +'"  value="'+ data['rates'].e_price +'">                    </div>                    </div>                    <div class="form-group"><label for="pack-price" class="col-md-3 control-label">B Rate</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="brate'+ data['values'].a_newspaper_id +'" id="brate'+ data['values'].a_newspaper_id +'" value="0">                    </div>                    <label for="pack-price" class="col-md-3 control-label">B Extra Charges</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="berate'+ data['values'].a_newspaper_id +'" id="berate'+ data['values'].a_newspaper_id +'"  value="0">                    </div>                    </div>';
                      var html='<div class="alert alert-info" ><i class="fa fa-money"></i><strong> DOP and Price of  '+ data['values'].data +'</strong></div>                   <div class="form-group">                     <label for="pack-price" class="col-md-6 alert alert-info" onclick="date_pic_byid('+data['values'].a_newspaper_id +');" style="cursor:crosshair">Publish Dates of '+ data['values'].data +'</label>                    <div class="col-md-6">	                    <div class="box"  id="from--input">	                    <input class="form-control" name="p_date'+ data['values'].a_newspaper_id +'" type="text" id="from-input'+ data['values'].a_newspaper_id +'" data-id="'+ data['values'].a_newspaper_id +'" data-toggle="modal" data-target="#dopModal" onclick="showModal('+data['values'].a_newspaper_id+')" onblur="get_addon_dop_price('+data['values'].a_newspaper_id+');" placeholder="mm/dd/yyyy, ..." >	                    </div>	                    <div class="code-box">	                    </div>                    </div>                    </div>                          <div class="form-group">                    <label for="pack-price" class="col-md-3 control-label">Rate</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['values'].a_newspaper_id +'" id="rate'+ data['values'].a_newspaper_id +'" value="'+ data['rates'].price +'">                   </div>                    <label for="pack-price" class="col-md-3 control-label">Extra Charges</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="erate'+ data['values'].a_newspaper_id +'" id="erate'+ data['values'].a_newspaper_id +'"  value="'+ data['rates'].e_price +'">                    </div>                    </div>                    <div class="form-group"><label for="pack-price" class="col-md-3 control-label">B Rate</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="brate'+ data['values'].a_newspaper_id +'" id="brate'+ data['values'].a_newspaper_id +'" value="0">                    </div>                    <label for="pack-price" class="col-md-3 control-label">B Extra Charges</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="berate'+ data['values'].a_newspaper_id +'" id="berate'+ data['values'].a_newspaper_id +'"  value="0">                    </div>                    </div>';
                    p_u.insertAdjacentHTML('beforeend', html);
               date_pic_byid1(d);
                },                

                error:  function (jqXHR, exception) {

                    var msg = '';

                    if (jqXHR.status === 0){

                        msg = 'Not connect.\n Verify Network.';

                    } else if (jqXHR.status == 404){

                        msg = 'Requested page not found. [404]';

                    } else if (jqXHR.status== 500){

                        msg = 'Internal Server Error [500].';

                    } else if (exception==='parsererror') {

                        msg = 'Requested JSON parse failed.';

                    } else if (exception==='timeout'){

                        msg = 'Time out error.';

                    } else if (exception==='abort'){

                        msg = 'Ajax request aborted.';

                    } else {

                        msg = 'Uncaught Error.\n' + jqXHR.responseText;

                    }

                    $('#post').html(msg);

                }

            });
          });
         /*  $.each(arr, function(i, d){

                date_pic_byid1(d);

            });*/
            document.getElementById("loader").style.display = "none";

            setTimeout(get_premimum_price,3000);
          
                   

           

        }

var base_id=0;

function get_base_price()
{
	var arr = $("#a_newspaper").val();
	var newspaper= $("#newspaper").val();
		document.getElementById("pub_dates").innerHTML = "";
		document.getElementById("pub_dates").style.display = "none";
	if(arr==null)
	{	
		alert("Select at least one Add on newspaper!");
		return false;
	}	
	arr.unshift(newspaper);
alert(newspaper);
	//var  city= $("#city").val();
	var  cat= $("#cat").val();
	var  inse= $("#inse").val();
	var color= $("#color").val();
	var city=$("#state").val();
	var p_u= document.getElementById('add_base_dates');		
	p_u.innerHTML="";
	
	if(newspaper=="" || cat=="" || inse=="" || color=="")
	{
		alert("Select Newspaper,City,Heading and Color");
		$('#inse').val(function() 
						{
							return this.defaultValue;
						});
		return false;
	}
	
/*	if ($('#column_type2').is(":checked")) 
	{
		var size_type="D"
	}
	else
	{
		var size_type="S"
	}
	
*/	
	var form_data= {'arr':arr,'newspaper':newspaper,'cat':cat,'inse':inse,'color':color,'city':city};
	
	$.ajax({
			url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_base_price",
			type: "POST",				
			async: true ,               
			data: form_data,
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{
					  document.getElementById("loader").style.display = "none";
					  
					if(data=='1')
					{
						alert("Select Newspaper and Heading First.");
						$('#inse').val(function() 
						{
							return this.defaultValue;
						});
						return false;
					}
					if(data=='2')
					{
						alert("Base Rate not Set with this Heading and Color.");
						$('#inse').val(function() 
						{
							return this.defaultValue;
						});
						return false;
					}
					
					//alert("Ro added Successfully");					
					
					// Parse the returned json data
					var data = $.parseJSON(data);
					/* Use jQuery's each to iterate over the tr value
					document.getElementById("rate").value = price.ad_price;
					document.getElementById("erate").value = price.extra_price;
					document.getElementById("mrate").value = price.mul_rate;
					document.getElementById("merate").value = price.mul_ex;
					document.getElementById("brate").value = price.b_rate;
					document.getElementById("comm1").value = price.discount;
					//document.getElementById("nfdc").value = price.discount;*/
					//min_w=price.min_w;
						size_type=data['rates'].size_type
						//alert("size_type"+size_type);
					f_min_l=data['rates'].f_min_l;
					f_min_r=data['rates'].f_min_r;
					s_min_l=data['rates'].s_min_l;
					s_min_r=data['rates'].s_min_r;
					s_max_l=data['rates'].s_max_l;
					s_max_r=data['rates'].s_max_r;
					d_min_l=data['rates'].d_min_l;
					d_min_r=data['rates'].d_min_r;
					d_max_l=data['rates'].d_max_l;
					d_max_r=data['rates'].d_max_r;
				/*	if (data['rates'].size_type == 'F')
					{
					document.getElementById("size_l").min = f_min_l;
					document.getElementById("size_r").min = f_min_r;
					document.getElementById("size_r").value = f_min_r;
					document.getElementById("size_type").value=size_type;
					}
					else if (data['rates'].size_type == 'S')
					{
					document.getElementById("size_l").min = s_min_l;
					document.getElementById("size_r").min = s_min_r;
					document.getElementById("size_l").max = s_max_l;
					document.getElementById("size_r").max = s_max_r;
					document.getElementById("size_r").value = s_max_r;
					}
					if (data['rates'].size_type == 'D')
					{
					document.getElementById("size_l").min = d_min_l;
					document.getElementById("size_r").min = d_min_r;
					document.getElementById("size_l").max = d_max_l;
					document.getElementById("size_r").max = d_max_r;
				document.getElementById("size_r").value = d_max_r;
					}
				*/
					//document.getElementById("w_count1").value = price.min_w;
					document.getElementById("comm1").value = data['rates'].discount;
						document.getElementById('gst').value=data['rates'].gst;
					$("#unit option[value='" + data['rates'].unit +"']").attr("selected", true);
					
					days=data['rates'].day_id.split(",");
					nfdc=data['rates'].non_focus_charge.split(",");
					
					if(nfdc[1] == 'Rs')
					{
						//alert(nfdc[1]+"   "+nfdc[0]);
						document.getElementById("nfdc").value = nfdc[0];
					}
					
					document.getElementById("comm2").value = 0;
					document.getElementById("comm3").value = 0;
					document.getElementById("comm4").value = 0;
					document.getElementById("comm5").value = 0;
					document.getElementById("comm6").value = 0;
					document.getElementById("comm7").value = 0;
					document.getElementById("comm8").value = 0;
					commission();
					/*
					//var amount=price.ad_price*inse;
					//document.getElementById("amount").value = amount.toFixed( 2 );
					//amount_calculate();					
					*/
					base_id=data['value'];
				//	alert(base_id);
					var html='<div class="title" style="background-color:#fff;"><i class="fa fa-money"></i><strong> DOP and Price of  '+ data['rates'].newspaper_name +' ,'+ data['rates'].city_name +'</strong></div>                         <div class="form-group">	<label for="pack-price" class="col-md-6 control-label" onclick="date_pic_byid('+data['value']+');">Publish Dates of '+ data['rates'].newspaper_name +' ,'+ data['rates'].city_name +'</label> <div class="col-md-6">	<div class="box"  id="from--input">	<input class="form-control" name="p_date'+ data['value'] +'" type="text" id="from-input'+ data['value'] +'" data-id="'+ data['value'] +'" data-toggle="modal" data-target="#dopModal" onclick="showModal('+data['value']+')" onblur="get_base_dop_price('+data['value']+');" placeholder="mm/dd/yyyy, ..." >	</div>	<div class="code-box">	</div>	</div>	</div>                                                                       <div class="form-group"><label for="pack-price" class="col-md-3 control-label">Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['value'] +'" id="rate'+ data['value'] +'" value="'+ data['rates'].ad_price +'"></div><label for="pack-price" class="col-md-3 control-label">B Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="brate'+ data['value'] +'" id="brate'+ data['value'] +'" value="0"></div></div> ';
					
					/* <div class="form-group"><label for="pack-price" class="col-md-3 control-label">B Rate</label><div class="col-md-3"><input type="text" placeholder="" class="form-control" name="brate'+ data['values'].newspaper_id +'" id="brate'+ data['values'].newspaper_id +'"></div></div> */
					
				//	var p_u= document.getElementById('add_base_dates');
					
					p_u.innerHTML=html;
					//p_u.insertAdjacentHTML('beforeend', html);
					date_pic_byid(base_id);
					 for( var i = 0; i < arr.length; i++)
					 { 
					     
                           if ( arr[i] === base_id) {
                             arr.splice(i, 1); 
                           }
                     }
                    date_pic_byid1(base_id);
				}, 
				complete:function()
				{get_size();
				    ad_on_paper(base_id,arr);
				},
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Error in base rate with this Newspaper or Heading.");
					}
			});
			

}
 function get_base_dop_price(id=null)

        {

            //	document.getElementById("loader").style.display = "block";
	
	var  newspaper= id;	
//	alert(newspaper);
	var  cat= $("#cat").val();
	var  inse= $("#inse").val();
	var color= $("#color").val();
	var city=$("#state").val();
	if(newspaper=="" || cat=="" || inse=="" || color=="")
	{
		alert("Select Newspaper,City,Heading and Color");
		$('#inse').val(function() 
						{
							return this.defaultValue;
						});
		return false;
	}
	
/*	if ($('#column_type2').is(":checked")) 
	{
		var size_type="D"
	}
	else
	{
		var size_type="S"
	}
*/	
	var dates= $("#from-input"+id).val();
	var s_days=dates.split(", ");
	var c=s_days.length;
	var i;
		

	
	for(i=0; i<c ;i++)
	{
		//alert(s_days[i]);
		var form_data= {'newspaper':newspaper,'cat':cat,'inse':inse,'s_date':s_days[i],'count':i,'color':color,'city':city};
		//alert(s_days[i]);
		$.ajax({
			url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_base_dop_price",
			type: "POST",				
			async: true ,               
			data: form_data,
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data1)
				{					  
				//	alert("vv".data1);  
					if(data1=='1')
					{
						alert("DOP Rate not Set with this Newspaper,Color or Heading on some Date.");
						
						return false;
					}
					
					// Parse the returned json data
					var data = $.parseJSON(data1);
				
				//	var html='<div id="rate_dis'+ data['values'].count +'" style="display: none;">	               <div class="title" style="background-color:#fff;"><i class="fa fa-money"></i><strong> Rate Of Date '+ data['values'].s_date +'</strong></div>       <div class="form-group"><label for="pack-price" class="col-md-3 control-label">Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['values'].count +'" id="rate'+ data['values'].count +'"></div> <label for="pack-price" class="col-md-3 control-label">B Rate</label><div class="col-md-3"><input type="text" onchange="amount_calculate();" placeholder="" class="form-control" name="brate'+ data['values'].count +'" id="brate'+ data['values'].count +'"></div></div></div>';
					
				//	p_u.insertAdjacentHTML('beforeend', html);
				//datarate=[];
				 datarate[0]=data['rates'].ad_price;
                    datarate[1]=data['rates'].f_rate;
			
					  console.log("vv");
					  console.log(datarate);
					//	alert(datarate['rates'].ad_price);				
					document.getElementById("rate"+id).value = data['rates'].ad_price;					
					document.getElementById("brate"+id).value = data['rates'].b_rate;

                    },                

                    error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Rate1 not Set with this Newspaper or Heading.");

                    }

                });




            }

          

            document.getElementById("loader").style.display = "none";	

        }
  function get_addon_dop_price(id=null)

        {

            document.getElementById("loader").style.display = "block";

            var  m_newspaper= base_id;	
            var  a_newspaper= id;	
//alert(a_newspaper);
          	var  cat= $("#cat").val();
	var  inse= $("#inse").val();
	var color= $("#color").val();
	var city=$("#state").val();
	var size_l=$("#size_l").val();
	var size_r=$("#size_r").val();
	if(newspaper=="" || cat=="" || inse=="" || color=="")

            {

                alert("Select Newspaper,City and Heading");

                $('#inse').val(function() 

                               {

                    return this.defaultValue;

                });

                return false;

            }

           	var dates= $("#from-input"+id).val();
	var s_days=dates.split(", ");
	var c=s_days.length;
	var i;
		

	
	for(i=0; i<c ;i++)
	{
		//alert(s_days[i]);
		var form_data= {'m_newspaper':m_newspaper,'a_newspaper':a_newspaper,'cat':cat,'inse':inse,'s_date':s_days[i],'count':i,'color':color,'city':city,'size_l':size_l,'size_r':size_r};
		//alert(s_days[i]);
		$.ajax({
			url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_addon_dop_price",
			type: "POST",				
			async: true ,               
			data: form_data,
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{					  
					  
					if(data=='1')
					{
						alert("DOP Rate not Set with this Newspaper,Color or Heading on some Date.");
						
						return false;
					}
					
					// Parse the returned json data
					var data = $.parseJSON(data);
				//	var html='<div id="rate_dis'+ data['values'].count +'" style="display: none;">	               <div class="title" style="background-color:#fff;"><i class="fa fa-money"></i><strong> Rate Of Date '+ data['values'].s_date +'</strong></div>       <div class="form-group"><label for="pack-price" class="col-md-3 control-label">Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['values'].count +'" id="rate'+ data['values'].count +'"></div> <label for="pack-price" class="col-md-3 control-label">B Rate</label><div class="col-md-3"><input type="text" onchange="amount_calculate();" placeholder="" class="form-control" name="brate'+ data['values'].count +'" id="brate'+ data['values'].count +'"></div></div></div>';
					
				//	p_u.insertAdjacentHTML('beforeend', html);
					
										
					document.getElementById("rate"+id).value = data['rates'].price;					
					document.getElementById("brate"+id).value = data['rates'].e_price;

                    },                

                    error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Rate2 not Set with this Newspaper or Heading.");

                    }

                });




            }

          

            document.getElementById("loader").style.display = "none";	

        }
  function get_size()
{
	var  size_l= parseFloat($("#size_l").val());
	var  size_r= parseFloat($("#size_r").val());
//	alert("ad_price"+datarate['rates'].ad_price);
if(datarate.length>0)
{
        if($("#add_on").is(":checked"))
        {
            	    if(f_min_l == size_l && size_r==f_min_r)
            	    {
            	      size_type="F";
            	    //   alert("Size type" + "F");
            	       document.getElementById("rate"+base_id).value = datarate[1];
            	    }
            	   
            	
            	else if((s_min_l <= size_l  && size_l <=s_max_l)&&(s_min_r <= size_r && size_r<=s_max_r))
            	    {
            	        size_type="S";
            	       // alert("Size type" + "S");
            	         document.getElementById("rate"+base_id).value = datarate[0];
            	    }
            	    
            	else if(s_min_l <= size_l && size_r<=s_max_l)
            	    {
            	        size_type="S";
            	      // alert("Size type" + "D");
            	       document.getElementById("rate"+base_id).value = datarate[0];
            	    }
            	    
            
            
            	else
            	{
            	    size_type="S";
            	//	alert("Size type" + "Notfound");
            	}
        }
        else
        {
               if(f_min_l == size_l && size_r==f_min_r)
            	    {
            	       size_type="F";
            	       alert("Size type" + "F");
            	       document.getElementById("rate0").value = datarate[1];
            	    }
            	   
            	
            	else if((s_min_l <= size_l  && size_l <=s_max_l)&&(s_min_r <= size_r && size_r<=s_max_r))
            	    { size_type="S";
            	      //  alert("Size type" + "S");
            	         document.getElementById("rate0").value = datarate[0];
            	    }
            	    
            	else if(s_min_l <= size_l && size_r<=s_max_l)
            	    { size_type="S";
            	      // alert("Size type" + "D");
            	    }
            	    
            
            
            	else
            	{ size_type="S";
            		alert("Size type" + "Notfound");
            	} 
        }
}

}
 function showModal(data)
                   {
                        My_id=data;
                     var dates1 = $("#from-input"+data).val();
                       $("#mdops").val(dates1);
                       $(".modal-body #hiddenvalue").val(My_id);
                       $("#dopModal").show();
                       
                   }
    $(document).ready(function (){
         add_paper();
            get_paper();
            get_heading();
            get_premimum();
        // add_paper();
        // get_paper();
        // get_heading();
        // get_scheme();
        // get_premimum();
      // get_size();
        
    $('.js-example-basic-single').select2();
                  
    });
	

function save_bill_temp()
{
     var inse1=$("#inse1").val();
   // var old_inse = $("#inse").val()
   if(inse1 > 0){
    document.getElementById("inse").value = inse1;
   }
	var  ro_id=$("#ro_id").val();
	var work_year=$("#work_year").val();
	var  ro_no=$("#ro_no").val();
	var  client_id=$("#client_id").val();
	var  emp_id=$("#e_id").val();
	var  n_id=$("#n_id").val();
	var  newspaper=$("#newspaper").val();
	var  a_newspaper=$("#a_newspaper").val();
	var cat_id=$('#cat_id').val();
	var  insertion=$('#inse').val();
	var  size_words=$("#size_l").val()+' X '+$("#size_r").val();
	var  min_w=0
	var  height=0;
	var  width=0;
	  var  scheme= $("#scheme option:selected").text();
	  var  pack= $("#pack").val();
	var  amount=$("#amount").val();
	var  premimum=$("#premimum_type_value").val();
	var  extra_price=$("#eca").val();
	var  add_on_amount=$("#add_a").val();
	var  dis_per=$("#discount_percentage").val();
	var  discount=$("#dis_a").val();
	var  box_charges=$("#box_c").val();
	var  payable_amount=$("#p_amount").val();
	var  ro_date=$("#ro_date").val();
	var  p_date=$("#checked_dops").val();
	var type_id=3;
var Paid=$("#Paid").val();
	var Free=$("#Free").val();
	alert(premimum);
		if(p_date!="")
	{
	if ($('#add_on').is(":checked")) 
	{	
		rate=$("#rate"+base_id).val();
		erate=$("#brate"+base_id).val();
		
		var form_data= {'ro_id':ro_id,'work_year':work_year,'ro_no':ro_no,'type_id':type_id,'client_id':client_id,'emp_id':emp_id,'newspaper_id':newspaper,'cat_id':cat_id,'insertion':insertion,'p_date':p_date,'size_words':size_words,'min_w':min_w,'height':height,'width':width,'price':rate,'eprice':erate,'amount':amount,'premimum':premimum,'extra_price':extra_price,'add_on_amount':add_on_amount,'scheme':scheme,'pack':pack,'dis_per':dis_per,'discount':discount,'box_charges':box_charges,'payable_amount':payable_amount,'ro_date':ro_date,'Free':Free,'Paid':Paid,'size_type':size_type};
		console.log(form_data); return false;
		$.ajax({                
		url: "<?php echo base_url(); ?>" + "admin/ro_billing/temp_save",
		type: "POST",				
		async: false ,               
		data: form_data,
		beforeSend: function(){ document.getElementById("loader").style.display = "block";},
		success: function(data)
		{
			//console.log(data); return;
			//var arr = $("#a_newspaper").val();
			var arr=arr1;
			
		$.each(arr, function(i, d) {
			    var j=0;
			    var td=[];
			    var type_id=3;
				var work_year=$("#work_year").val();
				var p_date=$("#from-input"+d).val();
				var inse1=$("#inse1").val();
				var insertion=$("#inse").val();	
					var count=$("input[name='dop[]']:checked").length;
			//	alert (p_date);
				if (count>0)
				{
				    insertion=count;
				    var p_date1=p_date.split(',');
				    for(j=0;j<count;j++)
				    {
				      td[j]=p_date1[j];
				     // alert(td[j]);
				    }
				
				    p_date=td;
				}
			//	alert(p_date);
				var rate=$("#rate"+d).val();
				var erate=$("#erate"+d).val();	
				
				set_temp_details(ro_id,work_year,ro_no,type_id,d,td,rate,erate,insertion);
				
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
			alert("Ro not add1 !");
		}
		});
	}
	else{
		rate=$("#rate0").val();
		erate=$("#brate0").val();
	
			var form_data= {'ro_id':ro_id,'work_year':work_year,'ro_no':ro_no,'type_id':type_id,'client_id':client_id,'emp_id':emp_id,'newspaper_id':newspaper,'cat_id':cat_id,'insertion':insertion,'p_date':p_date,'size_words':size_words,'min_w':min_w,'height':height,'width':width,'price':rate,'eprice':erate,'amount':amount,'premimum':premimum,'extra_price':extra_price,'add_on_amount':add_on_amount,'scheme':scheme,'pack':pack,'dis_per':dis_per,'discount':discount,'box_charges':box_charges,'payable_amount':payable_amount,'ro_date':ro_date,'Free':Free,'Paid':Paid,'size_type':size_type};
		
		$.ajax({                
		url: "<?php echo base_url(); ?>" + "admin/ro_billing/temp_save",
		type: "POST",
		async: true,
		data: form_data,
		beforeSend: function(){ document.getElementById("loader").style.display = "block";},
		success: function(data)
		{
			document.getElementById("loader").style.display = "none";
			//console.log(data); //return false;
			//var data=save_ro();
			console.log(data);
			//add data to parent window variable.
		//	alert(data);
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
	}
	else
	{
	     alert("no dates are there.");
	}
}

function set_temp_details(ro_id,work_year,ro_no,type_id,paper_id,p_date,rate,erate,insertion){
    var  emp_id='<?php echo $_SESSION['admin']['id'];?>';
    alert(ro_id+work_year+ro_no+paper_id+p_date+rate+erate+insertion);
	$.ajax({  
	url: "<?php echo base_url(); ?>" + "admin/ro_billing/set_temp_details",
	async: false,
	type: "POST",
	data: {"ro_id":ro_id,"work_year":work_year,"ro_no":ro_no,"emp_id":emp_id,"type_id":type_id,"paper_id":paper_id,"p_date":p_date,"rate":rate,"erate":erate,"insertion":insertion},
	beforeSend: function(){ document.getElementById("loader").style.display = "block";},
	success: function(data)
		{
		    console.log(data);
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
//	alert(type_id);
	var newspaper_id = $("#newspaper").val();
	var discount_percentage = $("#discount_percentage").val();
	var city = $("#city").val();
	
	$.ajax({                
	url: "<?php echo base_url(); ?>" + "admin/ro_billing/update_discount",
	type: "POST",
	async: true ,
	data: {client_id:client_id,type_id:3,cat_id:cat_id,newspaper_id:newspaper_id,discount_percentage:discount_percentage},
	beforeSend: function(){ document.getElementById("loader").style.display = "block";},
	success: function(data)
		{
			document.getElementById("loader").style.display = "none";
			//console.log(data); return false;
		}
	});
}
$(document).ready(function(){
   document.getElementById('inse1').value=$("input[name='dop[]']").length; 
});
</script>