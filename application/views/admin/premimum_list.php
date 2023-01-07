<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	<div class="row text-center">
		<div class="col-sm-6 col-lg-3">
			<a class="widget widget-hover-effect2" href="<?php echo base_url();?>admin/premimum/add">
				<div class="widget-extra themed-background-success">
					<h4 class="widget-content-light">
						<strong>Add New</strong> Premimum
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
						<strong>All</strong>Premimums
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
				<strong>All</strong> Premimums
			</h2>
		</div>
		<h2>
				<?php echo $this->session->flashdata('msg'); ?>
			
		</h2>
		<!-- END All Products Title -->
		<!-- All Products Content -->
		<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
					<thead>
						<tr role="row">
							<th>ID</th>
							<th>Newspaper Group</th>
							<th>Type</th>
							<th>Title</th>							
							<th>Premimum</th>
							<th>Color</th>
							<th>Created Date</th>
							<th>Starting Date</th>
							<th>End Date</th>
							<th class="text-center " style="width: 100px;" >Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($pres as $pre){ ?>
						<tr role="row" class="odd">
							<td class="text-center">
									<strong><?php echo $pre->id ;?></strong>
							</td>
							<td>
								<?php echo $pre->ng_name;?>
							</td>
							<td>
								<?php echo $pre->type_name;?>
							</td>
							<td>
								<?php echo $pre->p_type;?>
							</td>
							<td>
								<?php echo $pre->premimum;?>
							</td>
							<td class="text-center">
								<?php 
									if($pre->color=='A')
										echo "Any Color";
									if($pre->color=='B')
										echo "Black/White";
									if($pre->color=='C')
										echo "Color";
								?>
							</td>							
							<td>
								<?php echo date("d-m-y",strtotime($pre->c_date));?>
							</td>
								<td>
								<?php echo $pre->sdate;?>
							</td>
								<td>
								<?php echo $pre->edate;?>
							</td>
							<td class="text-center">
								<div class="btn-group btn-group-xs">
									<a class="btn btn-default" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/premimum/edit/<?php echo $pre->id ; ?>" data-original-title="Edit">
										<i class="fa fa-pencil"></i>
									</a>
									<a class="btn btn-xs btn-danger" title="" data-toggle="tooltip" onclick="return confirm('Are you sure you want to delete this premimum?');" href="<?php echo base_url(); ?>admin/premimum/del/<?php echo $pre->id ;?>" data-original-title="Delete">
										<i class="fa fa-times"></i>
									</a>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			</div>
			<!-- END All Products Content -->
		</div>
		<!-- END All Products Block -->
	</div>