<div id="page-content" style="min-height: 1189px;">
	
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
				<strong>All</strong> Ros of <?php if(isset($book_ads[0]->client_name)) echo $book_ads[0]->client_name ;?>
			
			</h2>
		</div>
		<h2>
			<?php echo $this->session->flashdata('msg'); ?>			
		</h2>
		<!-- END All Products Title -->
		<!-- All Products Content -->		
		<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">
				<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
					<thead>
						<tr role="row">
							<th class="text-center" >ID</th>
							<th class="text-center" style="width: 209px;">Newspaper</th>
							<th class="text-center" style="width: 100px;">Ad Type</th>
							<th class="text-center" style="width: 150px;" >Category</th>
							<th class="text-center" style="width: 150px;" >Amount</th>
							<th class="text-center" style="width: 150px;" >Ad Days</th>
							<th class="text-center " style="width: 128px;" >Action</th>
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
							<td class="text-center">
								<?php echo $book_ad->cat_name;?>
							</td>
							<td class="text-center">
								<?php echo $book_ad->t_amount;?>
							</td>
							<td class="text-center">
								<?php echo $book_ad->insertion;?>
							</td>							
							<td class="text-center">
								<?php if($book_ad->status=='A'){ ?>
									<a title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/client_bill/get/<?php echo $book_ad->id ; ?>" data-original-title="Generate Bill">
										<div class="btn btn-sm btn-info">
											<i class="fa fa-plus"></i> Select Ro
										</div>
									</a>
								<?php }  
								else { ?>
									<a title="" data-toggle="tooltip" href="" data-original-title="Print NOW">
										<div class="btn btn-sm btn-warning">
											<i class="fa fa-plus"></i> Bill Generated
										</div>
									</a>
								<?php } ?>
								</td>
						</tr>
						<?php } ?>					
						
					</tbody>
				</table>
				
			</div>
			<!-- END All Products Content -->
		</div>
		<!-- END All Products Block -->
	</div>