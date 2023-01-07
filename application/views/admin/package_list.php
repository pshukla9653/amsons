<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	<div class="row text-center">
		<div class="col-sm-6 col-lg-3">
			<a class="widget widget-hover-effect2" href="<?php echo base_url();?>admin/package/add">
				<div class="widget-extra themed-background-success">
					<h4 class="widget-content-light">
						<strong>Add New</strong> Package
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
						<strong>All </strong>Packages
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
				<strong>All</strong> Packages
			</h2>
		</div>
		<h2>
				<?php echo $this->session->flashdata('msg'); ?>
			
		</h2>
		<!-- END All Products Title -->
		<!-- All Products Content -->
		<div id="ecom-products_wrapper" class="table-responsive dataTables_wrapper form-inline no-footer">
		
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
					<thead>
						<tr role="row">
							<th>ID</th>
							<th>Packages</th>
							<th>Newspaper Group</th>							
							<th>Heading</th>
							<th>Type</th>
							<th>Inse</th>
							<th>Rate</th>
							<th>Extra Charges</th>
							<th>Discount</th>
							<th>Created Date</th>
							<th class="text-center " >Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($packs as $pack){ ?>
						<tr role="row" class="odd">
							<td class="text-center">
									<strong><?php echo $pack->id ;?></strong>
							</td>
							<td>
								<?php echo $pack->package;?>
							</td>							
							<td>
								<?php echo $pack->ng_name;?>
							</td>							
							<td>
								<?php echo $pack->cat_name;?>
							</td>
							<td>
								<?php echo $pack->type_name;?>
							</td>
							<td>
								<?php echo $pack->ins_from."-";?>
								<?php echo $pack->ins_to;?>
							</td>
							<td>
								<?php echo $pack->rate;?>
							</td>
							<td>
								<?php echo $pack->e_rate;?>
							</td>
							<td class="text-center">
								<?php echo $pack->discount;?>
							</td>							
							<td>
								<?php echo date('d-m-Y',strtotime($pack->c_date));?>
							</td>
							<td class="text-center">
								<div class="btn-group btn-group-xs">
									<a class="btn btn-default" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/package/edit/<?php echo $pack->id ; ?>" data-original-title="Edit">
										<i class="fa fa-pencil"></i>
									</a>
									<a class="btn btn-xs btn-danger" title="" data-toggle="tooltip" onclick="return confirm('Are you sure you want to delete this package?');" href="<?php echo base_url(); ?>admin/package/del/<?php echo $pack->id ;?>" data-original-title="Delete">
										<i class="fa fa-times"></i>
									</a>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
				<div class="row">
				<?php if($total_rows>=20){?>
					<div class="col-sm-5 hidden-xs">
						<div class="dataTables_info" id="ecom-products_info" role="status" aria-live="polite">
							<strong><?php echo ((($curr_page - 1)*$per_page)+1) ; ?></strong>-
							
							<strong><?php echo ($curr_page*$per_page)  ; ?></strong> of 
							
							<strong><?php echo $total_rows ; ?></strong>
						</div>
					</div>
				<?php } ?>
					<div class="col-sm-7 col-xs-12 clearfix">
						<div class="dataTables_paginate paging_bootstrap" id="ecom-products_paginate">
							<?php echo $links ; ?>
							<!--<ul class="pagination pagination-sm remove-margin">
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
							</ul>-->
						</div>
					</div>
				</div>
			
			</div>
			<!-- END All Products Content -->
		</div>
		<!-- END All Products Block -->
	</div>
