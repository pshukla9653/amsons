<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	<div class="row text-center">
		<div class="col-sm-6 col-lg-3">
			<a class="widget widget-hover-effect2" href="javascript:void(0)">
				<div class="widget-extra themed-background-dark">
					<h4 class="widget-content-light">
						<strong>All Pending</strong> RO
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
				<strong>All</strong> Pending Ros
			
			</h2>
		</div>
		<div class="text-info">
			<h2>
				<?php echo $this->session->flashdata('msg'); ?>			
			</h2>
		</div>
		<!-- END All Products Title -->
		<!-- All Products Content -->
		<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">
			<div class="row">
				<div class="col-sm-6 col-xs-7">
					<div id="ecom-products_filter" class="dataTables_filter">
					<?php 
						$attributes = array('id' => 'search');
						echo form_open('admin/pending_ro/', $attributes);
					?>
					
						<label>
							<div class="input-group">
								<input type="search" name="name" class="form-control" placeholder="Search" aria-controls="ecom-products" value="<?php if(isset($name)) echo $name;?>">
								<span class="input-group-addon">
									<button  name="search" type="submit" ><i class="fa fa-search"></i></button>
								</span>
							</div>
						</label>
					</form>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
					<thead>
						<tr role="row">
							<th class="text-center" >ID</th>
							<th class="text-center">Title</th>
							<th class="text-center">Newspaper</th>
							<!--<th class="text-center">Category</th>-->
							<th class="text-center">Ad Cost</th>
							<th class="text-center">Ad Days</th>
							<th class="text-center">User</th>
							<th class="text-center">Move To Ro</th>
							<th class="text-center " style="width: 100px;" >Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($book_ads as $book_ad){ ?>
						<tr role="row" class="odd">
							<td class="text-center">
									<strong><?php echo $book_ad->id ;?></strong>
							</td>
							<td>
								<?php echo $book_ad->newspaper_name ;?>
							</td>
							<td class="text-center">
								<?php echo $book_ad->type_name;?>
							</td>							
							<!--<td class="text-center">
								<?php// echo $book_ad->cat_name;?>
							</td>-->
							<td class="text-center">
								<?php echo $book_ad->ad_cost;?>
							</td>
							<td class="text-center">
								<?php echo $book_ad->insertion;?>
							</td>
							<td class="text-center">
								<?php echo $book_ad->client_name ."<br>".$book_ad->email ."<br>".$book_ad->mobile;?>
							</td>

							<?php
								switch ($book_ad->type_id) 
								{
									case '1':
											$ad_type="book_ads";

										break;
									case '2':
											$ad_type="display_ro";

										break;
									case '3':
											$ad_type="hd_ro";

										break;
								}


								
							?>
							<td class="text-center">
								<div class="btn-group btn-group-xs">
									<a class="btn btn-warning" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/pending_ro/move/<?php echo $book_ad->id ; ?>" data-original-title="Move">
										<i class="fa fa-level-up"></i> Move To Ro
									</a>
								</div>
							</td>
							<td class="text-center">
								<div class="btn-group btn-group-xs">
									<a class="btn btn-default" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/<?php echo $ad_type;?>/info/<?php echo $book_ad->id ; ?>" data-original-title="Details">
										<i class="fa fa-info"></i>
									</a>
									<a class="btn btn-default" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/<?php echo $ad_type;?>/edit/<?php echo $book_ad->id ; ?>" data-original-title="Edit">
										<i class="fa fa-pencil"></i>
									</a>
									<a class="btn btn-xs btn-danger" title="" data-toggle="tooltip" onclick="return confirm('Are you sure you want to delete this Ad?');" href="<?php echo base_url(); ?>admin/<?php echo $ad_type;?>/del/<?php echo $book_ad->id ;?>" data-original-title="Delete">
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
					<div class="col-sm-5 hidden-xs">
						<div class="dataTables_info" id="ecom-products_info" role="status" aria-live="polite">
							<strong><?php echo ((($curr_page - 1)*$per_page)+1) ; ?></strong>-
							
							<strong><?php echo ($curr_page*$per_page)  ; ?></strong> of 
							
							<strong><?php echo $total_rows ; ?></strong>
						</div>
					</div>
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