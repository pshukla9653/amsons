<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	<div class="row text-center">
		<div class="col-sm-6 col-lg-6">
			
		</div>
		<div class="col-sm-6 col-lg-6">
			
		</div>
	</div>
	<!-- END Quick Stats -->
	<!-- All Products Block -->
	<div class="block full">
		<!-- All Products Title -->
		<div class="block-title">
			<!--<div class="block-options pull-right">
				<a title="" data-toggle="tooltip" class="btn btn-alt btn-sm btn-default" href="javascript:void(0)" data-original-title="Settings">
					<i class="fa fa-cog"></i>
				</a>
			</div>-->
			<h2>
				<strong>HD Ad</strong> Full Details<br>
				<?php echo $this->session->flashdata('msg'); ?>
			</h2>
		</div>
		<!-- END All Products Title -->
		<!-- All Products Content -->
		<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">
			<div class="row">
				<!--<div class="col-sm-6 col-xs-7">
					<div id="ecom-products_filter" class="dataTables_filter">
					<?php 
						//$attributes = array('id' => 'search');
						//echo form_open('admin/offers/', $attributes);
					?>
					
						<label>
							<div class="input-group">
								<input type="search" name="vname" class="form-control" placeholder="Search" aria-controls="ecom-products" value="<?php if(isset($vname)) //echo $vname;?>">
								<span class="input-group-addon">
									<button  name="search" type="submit" ><i class="fa fa-search"></i></button>
								</span>
							</div>
						</label>
					</form>
					</div>
				</div>-->				
			</div>
				<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
						<!--<tr>
							<td style="width: 50%;" class="text-left">Image</td>
							<td style="width: 50%;" class="text-left">
								<img src="<?php //echo base_url(); ?>include/backend/img/guide/<?php //echo $guide->id."/";echo $guide->img ;?>" height="130" width="100">
							</td>
						</tr>-->
						<tr>
							<td style="width: 50%;" class="text-left">Ro No.</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->ro_no; ?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Ro Date</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo date('d-m-Y',strtotime($book_ad->book_date)); ?></strong>
							</td>
						</tr>						
						<tr>
							<td style="width: 50%;" class="text-left">Client</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->client_name ."<br>".$book_ad->email ."<br>".$book_ad->mobile;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Employee</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->e_name;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Newspaper</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->newspaper_name ;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Type</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->type_name;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Heading</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->cat_name;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Insertion</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->insertion;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Party</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->party;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Box</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->box;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Material</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->content;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">DOPS</td>
							<td style="width: 50%;" class="text-left">
								<strong>
								<?php 
									foreach($ad_dops as $ad_dop)
										{
											echo $ad_dop->newspaper_name ." :- ";
											echo $ad_dop->dop ." .<br>";
										}
								
								?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Size</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->size_words;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Price</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->price;?></strong>
							</td>
						</tr>						
						<tr>
							<td style="width: 50%;" class="text-left">RO Amount</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->ad_cost;?></strong>
							</td>
						</tr>
						<?php /* 
						<tr>
							<td style="width: 50%;" class="text-left"> Commission 1</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->comm1;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left"> Commission 2</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->comm2;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left"> Commission 3</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->comm3;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left"> Commission 4</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->comm4;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left"> Commission 5</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->comm5;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left"> Commission 6</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->comm6;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left"> Commission 7</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->comm7;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left"> Commission 8</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->comm8;?></strong>
							</td>
						</tr>
						 */ ?>
						<tr>
							<td style="width: 50%;" class="text-left"> Discount Amount</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->discount;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left"> Tax</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->tax;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left"> Tax Amount</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->tax_a;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left"> Payable Amount</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ad->p_amount;?></strong>
							</td>
						</tr>
						<tr>
						
						
							
						</tr>
						
						<tr>
							<td style="width: 50%;" class="text-left">Print RO</td>
							<td style="width: 50%;" class="text-left">
								<a class="" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/hd_ro/ro/<?php echo $book_ad->id;
								?>" data-original-title="Get RO">
									<span class='label label-info'>Generate RO </span>
								</a>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Save RO</td>
							<td style="width: 50%;" class="text-left">
								<a class="" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/pdf_ro/index/<?php echo $book_ad->id;
								?>" data-original-title="Save Ro As PDF">
									<span class='label label-info'>Save PDF </span>
								</a>
							</td>
						</tr>
				</table>
			</div>
			<!-- END All Products Content -->
		</div>
		<!-- END All Products Block -->
	</div>

