<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	<div class="row text-center">
		<div class="col-sm-6 col-lg-3">
			<a class="widget widget-hover-effect2" href="<?php echo base_url();?>admin/sub_admin/add">
				<div class="widget-extra themed-background-success">
					<h4 class="widget-content-light">
						<strong>Add New</strong> User
					</h4>
				</div>
				<div class="widget-extra-full">
					<span class="h2 text-success animation-expandOpen">
						<i class="fa fa-plus"></i>
					</span>
				</div>
			</a>
		</div>
		<div class="col-sm-6 col-lg-3">
			<a class="widget widget-hover-effect2" href="javascript:void(0)">
				<div class="widget-extra themed-background-dark">
					<h4 class="widget-content-light">
						<strong>All</strong> Users
					
					</h4>
				</div>
				<div class="widget-extra-full">
					<span class="h2 themed-color-dark animation-expandOpen"><?php echo $total_rows ; ?></span>
				</div>
			</a>
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
				<strong>All</strong> Users<br>
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
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
					<thead>
						<tr role="row">
							<th style="width: 70px;" class="text-center sorting_desc">ID</th>
							<th class="text-center">Users Name</th>
							<th class="text-center"style="width: 109px;">Mobile</th>
							<th class="text-center"style="width: 109px;">E-mail</th>
							<th class="hidden-xs" style="width: 150px;">Status</th>
							<th class="text-center sorting_disabled" style="width: 128px;" aria-label="Action">Action</th>
							<th class="text-center sorting_disabled" style="width: 128px;" aria-label="Action">Set Access</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($sadmin as $admin){ ?>
						<tr role="row" class="odd">
							<td class="text-center sorting_1">
									<strong><?php echo $admin->id; ?></strong>
								
							</td>
							<td>
								<?php echo $admin->name; ?>
							</td>
							<td class="text-center">
								<strong><?php echo $admin->mobile; ?></strong>
							</td>
							<td class="text-center">
								<strong><?php echo $admin->email; ?></strong>
							</td>
							<td class="text-center">
								<?php
									if($admin->status== 'A')
									{
										echo "<a href='".base_url()."admin/sub_admin/act/".$admin->id."' onclick=\"return confirm('Are you sure want to De-Active this admin?');\"><span class='label label-success'>Active</span></a>";
									} else {
										echo "<a href='".base_url()."admin/sub_admin/act/".$admin->id."' onclick=\"return confirm('Are you sure want to Active this admin?');\"><span class='label label-warning'>In Active</span></a>";
									}
								?>
							</td>
							<td class="text-center">
								<div class="btn-group btn-group-xs">
									<a class="btn btn-default" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/sub_admin/edit/<?php echo $admin->id ; ?>" data-original-title="Edit">
										<i class="fa fa-pencil"></i>
									</a>
									<a class="btn btn-xs btn-danger" title="" data-toggle="tooltip" onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url(); ?>admin/sub_admin/del/<?php echo $admin->id ; ?>" data-original-title="Delete">
										<i class="fa fa-times"></i>
									</a>
								</div>
							</td>
							<td class="text-center">
								<div class="btn-group btn-group-xs">
									<a href="<?php echo base_url(); ?>admin/sub_admin/access/<?php echo $admin->id ; ?>" data-original-title="access"><span class='label label-warning'>Set Access</span>
									</a>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<!--	<div class="row">
					<div class="col-sm-7 col-xs-12 clearfix">
						<div class="dataTables_paginate paging_bootstrap" id="ecom-products_paginate">
							<ul class="pagination pagination-sm remove-margin">
								<li class="prev disabled">
									<a href="javascript:void(0)">
										<i class="fa fa-chevron-left"></i>
									</a>
								</li>
								<li class="active">
									<a href="javascript:void(0)">1</a>
								</li>
								<li>
									<a href="javascript:void(0)">2</a>
								</li>
								<li>
									<a href="javascript:void(0)">3</a>
								</li>
								<li class="next">
									<a href="javascript:void(0)">
										<i class="fa fa-chevron-right"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>-->
			</div>
			<!-- END All Products Content -->
		</div>
		<!-- END All Products Block -->
	</div>