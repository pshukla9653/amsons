<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	<?php
		echo $this->session->flashdata('msg') ;
		?>
	<div class="row text-center">
		<div class="col-sm-6 col-lg-3">
			<a class="widget widget-hover-effect2" href="<?php echo base_url();?>admin/settings/slider_add">
				<div class="widget-extra themed-background-success">
					<h4 class="widget-content-light">
						<strong>Add New</strong> Slider
					
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
						<strong>All</strong> Slider
					
					</h4>
				</div>
				<div class="widget-extra-full">
					<span class="h2 themed-color-dark animation-expandOpen">4</span>
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
				<strong>All</strong> Slider
			
			</h2>
		</div>
		<h2>
				<?php echo $this->session->flashdata('slider_del'); ?>
			
		</h2>
		<!-- END All Products Title -->
		<!-- All Products Content -->
		<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">
			<!--<div class="row">
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
			</div>-->
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
					<thead>
						<tr role="row">
							<th style="width: 70px;" >ID</th>
							<th style="width: 247px;">Slider Title</th>
							<th class="text-right " style="width: 109px;" >Slider Icon</th>
							<th class="hidden-xs " style="width: 150px;" >Status</th>
							<th class="text-center " style="width: 128px;" >Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($sliders as $slider){ ?>
						<tr role="row" class="odd">
							<td class="text-center sorting_1">
									<strong><?php echo $slider->id ;?></strong>
							</td>
							<td>
								<?php echo $slider->slider_title ;?>
							</td>
							<td class="text-right hidden-xs">
								<img src="<?php echo base_url(); ?>include/backend/img/slider_image/<?php echo $slider->slider_img ;?>" height="100" width="200">
							</td>
							<td class="text-center hidden-xs">
								<?php
									if($slider->status == '1')
									{
										echo "<span class='text-success'>Active</span>";
									} else {
										echo "<span class='text-danger'>In Active</span>";
									}
								?>
							</td>
							
							<td class="text-center">
								<div class="btn-group btn-group-xs">
									<a class="btn btn-xs btn-danger" title="" data-toggle="tooltip" onclick="return confirm('Are you sure you want to delete this slider?');" href="<?php echo base_url(); ?>admin/settings/del_slider/<?php echo $slider->id ;?>" data-original-title="Delete">
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