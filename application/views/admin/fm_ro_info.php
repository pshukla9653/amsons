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
				<strong>Ro</strong> Full Details<br>
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
							<td style="width: 50%;" class="text-left">ID</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->id; ?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">FM Group</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->group_name; ?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">FM Channel</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->channel_name; ?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">City</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->city; ?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Client</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->client_name; ?></strong>
							</td>
						</tr>						
						<tr>
							<td style="width: 50%;" class="text-left">RO Date</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo date('d-m-Y',strtotime($book_ro->ro_date))?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Heading</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->heading;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Remarks</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->remark;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Date From</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo date('d-m-Y',strtotime($book_ro->date_from)) ;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Date To</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo date('d-m-Y',strtotime($book_ro->date_to));?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">No. of Days</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->total_day;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Slot Duration</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->slot_dur;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Daily Frequency Times</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->day_times;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Total Second</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->total_sec;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Rate Per 10 Second</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->rate_per_10;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Slot Rate</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->rate_one;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Matter</td>
							<td style="width: 50%;" class="text-left">
								<strong><P><?php echo $book_ro->material;?></p></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Total</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->amount;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Commision 1 %</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->com1;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Commision 2 %</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->com2;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Commision Amount</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->total_com;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Tax %</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->tax;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Tax Amount</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->tax_a;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">NET Amount</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $book_ro->pay_amount;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Ro add Date Time</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo date('d-m-Y',strtotime($book_ro->c_date));?></strong>
							</td>
						</tr>
						<tr>
							
						</tr>
						
						<tr>
							<td style="width: 50%;" class="text-left">Print RO</td>
							<td style="width: 50%;" class="text-left">
								<a class="" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/fm_ro/ro/<?php echo $book_ro->id;
								?>" data-original-title="Get RO">
									<span class='label label-info'>Generate RO </span>
								</a>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Save RO</td>
							<td style="width: 50%;" class="text-left">
								<a class="" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/pdf_ro/index/<?php echo $book_ro->id;?>" data-original-title="Save Ro As PDF">
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

