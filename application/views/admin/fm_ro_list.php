<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	<div class="row text-center">
		<div class="col-sm-6 col-lg-3">
			<a class="widget widget-hover-effect2" href="<?php echo base_url();?>admin/fm_ro/add">
				<div class="widget-extra themed-background-success">
					<h4 class="widget-content-light">
						<strong>FM Ro</strong> Booking
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
						<strong>All</strong>FM RO
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
				<strong>All</strong> FM Ro
			
			</h2>
		</div>
		<h2>
			<?php echo $this->session->flashdata('msg'); ?>			
		</h2>
		<!-- END All Products Title -->
		<!-- All Products Content -->
		<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">
			<div class="row">
				<div class="col-sm-6 col-xs-7">
					<div id="ecom-products_filter" class="dataTables_filter">
					<?php 
						$attributes = array('id' => 'search');
						echo form_open('admin/fm_ro/', $attributes);
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
							<th class="text-center"  style="width: 100px;">Ro Date</th>
							<th class="text-center" style="width: 209px;">Heading</th>
							<th class="text-center" style="width: 100px;">Remarks</th>
							<th class="text-center" style="width: 150px;" >FM Channel</th>
							<!--<th class="text-center" style="width: 150px;" >Days</th>
							<th class="text-center" style="width: 150px;" >Slot</th>-->
							<th class="text-center" style="width: 150px;" >Total</th>
							<th class="text-center " style="width: 128px;" >Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($book_ros as $book_ro){ ?>
						<tr role="row" class="odd">
							<td class="text-center">
									<strong><?php echo $book_ro->ro_no ;?></strong>
							</td>
							<td class="text-center">
								<?php echo date('d-m-Y',strtotime($book_ro->ro_date)) ;?>
							</td>
							<td class="text-center">
								<?php echo $book_ro->heading ;?>
							</td>
							<td>
								<?php echo $book_ro->remark ;?>
							</td>
														
							<td class="text-center">
								<?php echo $book_ro->channel_name;?>
							</td>
							<!--<td class="text-center">
								<?php echo date('d-m-Y',strtotime($book_ro->date_to));?>
							</td>
							<td class="text-center">
								<?php echo $book_ro->total_day;?>
							</td>
							<td class="text-center">
								<?php echo $book_ro->slot_dur;?>
							</td>-->
							<td class="text-center">
								<?php echo $book_ro->pay_amount;?>
							</td>
							<td class="text-center">
								<div class="btn-group btn-group-xs">
									<a class="btn btn-default" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/fm_ro/info/<?php echo $book_ro->id ; ?>" data-original-title="Details">
										<i class="fa fa-info"></i>
									</a>
									<a class="btn btn-default" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/fm_ro/edit/<?php echo $book_ro->id ; ?>" data-original-title="Edit">
										<i class="fa fa-pencil"></i>
									</a>
									<a class="btn btn-xs btn-danger" title="" data-toggle="tooltip" onclick="return confirm('Are you sure you want to delete this Ad?');" href="<?php echo base_url(); ?>admin/fm_ro/del/<?php echo $book_ro->id ;?>" data-original-title="Delete">
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
							<strong><?php echo ((($curr_page - 1)*$per_page)+1) ; ?></strong> -							
							<strong><?php echo ($curr_page*$per_page)  ; ?></strong> of 
							
							<strong><?php echo $total_rows ; ?></strong>
						</div>
					</div>
				<?php }?>
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