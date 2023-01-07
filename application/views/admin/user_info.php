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
				<strong>Client</strong> Full Details<br>
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
								<strong><?php echo $user->id ;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Client Name</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->c_date; ?></strong>
							</td>
						</tr>						
						<tr>
							<td style="width: 50%;" class="text-left">Client E-mail</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->email ;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Mobile</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->mobile;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Address</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->address;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">City</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->city ;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">State</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->state;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Pin Code</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->pin_code;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Fax</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->fax;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Vat No.</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->vat_no;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">CST No.</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->cst_no;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Discount</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->discount;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Service Tax No</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->ser_tax_no;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Tin No.</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->tin_no;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">IT No.</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->it_no;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Contact Person</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->contact_person;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Website</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->website;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Opening Balance</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->opening_bal;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Account</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->account;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Credit Period</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->credit_period;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Credit limit</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo $user->credit_limit;?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Client Type</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo ($user->client_type=='D') ? 'Direct' : 'In Direct';?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Group Head</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo ($user->group_head=='1') ? 'Yes' : 'NO';?></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-left">Shared Bill Party</td>
							<td style="width: 50%;" class="text-left">
								<strong><?php echo ($user->shared=='1') ? 'Yes' : 'NO';?></strong>
							</td>
						</tr>						
				</table>
			</div>
			<!-- END All Products Content -->
		</div>
		<!-- END All Products Block -->
	</div>

