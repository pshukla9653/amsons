<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->	
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
				<strong>All</strong> Ad price list<br>
				<?php
					//echo $this->session->flashdata('msg') ;
				?>
				<script  type="text/javascript">
					if(<?php echo ($this->session->flashdata('msg')!=null)?'1':'0'?>)
					{
						alert("<?php echo $this->session->flashdata('msg')?>");
					}
				</script>
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
						echo form_open('admin/hd_r_addon_rate/', $attributes);
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
							<th style="width: 70px;" class="text-center">ID</th>
							<th>Main Newspaper</th>
							<th class="text-center">add on Newspaper</th>
							<th class="text-center">Insertion</th>
							<th class="text-center">Ad Category</th>
							<th class="text-center">Price</th>
							<th class="text-center">Extra Price</th>
							<th class="text-center">Discount</th>
							<th class="text-center">Date</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($ad_prices as $ad_price){ ?>
						<tr role="row" class="odd">
							<td class="text-center">
									<strong><?php echo $ad_price->id ;?></strong>
							</td>
							<td>
								<?php echo $ad_price->newspaper_name ;?>
							</td>
							<td class="text-center">
								<?php echo $ad_price->newspaper ;?>
							</td>
							<td class="text-center">
								<?php echo $ad_price->ins_from ;?>-
								<?php echo $ad_price->ins_to ;?>
							</td>
							<td class="text-center">
								<?php echo $ad_price->cat_name ;?>
							</td>
							<td class="text-center">
								<?php echo $ad_price->price ;?>
							</td>
							<td class="text-center">
								<?php echo $ad_price->e_price ;?>
							</td>
							<td class="text-center">
								<?php echo $ad_price->discount ;?>
							</td>
							<td class="text-center">
								<?php echo date('d-m-Y',strtotime($ad_price->date_from)) ." TO ". date('d-m-Y',strtotime($ad_price->date_to)) ;?>
							</td>
							<td class="text-center">
								<?php 
									if($ad_price->revise_rate=='0')
									{
								?>
								<div class="btn-group btn-group-xs">
									<a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/hd_r_addon_rate/revise/<?php echo $ad_price->id ;?>" data-original-title="Revise Rate">
										<i class="fa fa-money"></i> Revise Rate
									</a>									
								</div>
								<?php
									}else
									{
								?>
								<div class="btn-group-xs">
									<div class="btn btn-warning" data-original-title="Rate Revised">
										<i class="fa fa-money"></i>Rate Revised 
									</div>									
								</div>
									<?php  }?>
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