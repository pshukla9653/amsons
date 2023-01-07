<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	<div class="row text-center">
		<div class="col-sm-6 col-lg-3">
			<a class="widget widget-hover-effect2" href="<?php echo base_url();?>admin/categories/add">
				<div class="widget-extra themed-background-success">
					<h4 class="widget-content-light">
						<strong>Add New</strong> Category					
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
						<strong>All</strong> Categories
					
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
				<strong>All</strong> Category
				<?php
					echo $this->session->flashdata('msg') ;
				?>
			</h2>
		</div>
		<!-- END All Products Title -->
		<!-- All Products Content -->
		<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">
			<!--
			<div class="row">
				<div class="col-sm-6 col-xs-7">
					<div id="ecom-products_filter" class="dataTables_filter">
						<label>
							<div class="input-group">
								<input type="search" class="form-control" placeholder="Search" aria-controls="ecom-products">
								<span class="input-group-addon">
									<i class="fa fa-search"></i>
								</span>
							</div>
						</label>
					</div>
				</div>
			</div>
			-->
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
					<thead>
						<tr role="row">
							<th style="width: 70px;" class="text-center">ID</th>
							<th>Category Title</th>
							<th class="text-center">Category Icon</th>
							<th class="text-center">Status</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($cats as $cat){ ?>
						<tr role="row" class="odd">
							<td class="text-center">
									<strong><?php echo $cat->id ;?></strong>
							</td>
							<td>
								<?php echo $cat->name ;?>
							</td>
							<td class="text-center">
								<img height="50" width="75" src="<?php echo base_url(); ?>include/backend/img/cat_icon/<?php echo $cat->cat_icon ;?>">
							</td>
							<td class="text-center">
								<?php
									if($cat->status == 'A')
									{
										echo "Active";
									} else {
										echo "In Active";
									}
								?>
							</td>
							
							<td class="text-center">
								<div class="btn-group btn-group-xs">
									<a class="btn btn-default" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/categories/edit/<?php echo $cat->id ;?>" data-original-title="Edit">
										<i class="fa fa-pencil"></i>
									</a>
									<a class="btn btn-xs btn-danger" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/categories/del/<?php echo $cat->id ;?>" data-original-title="Delete">
										<i class="fa fa-times"></i>
									</a>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<!--	<div class="row">
					<div class="col-sm-5 hidden-xs">
						<div class="dataTables_info" id="ecom-products_info" role="status" aria-live="polite">
							<strong>1</strong>-
							
							<strong>20</strong> of 
							
							<strong>60</strong>
						</div>
					</div>
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