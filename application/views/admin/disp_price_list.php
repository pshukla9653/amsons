<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	<div class="row text-center">
		<div class="col-sm-6 col-lg-3">
			<a class="widget widget-hover-effect2" href="<?php echo base_url();?>admin/disp_price/add">
				<div class="widget-extra themed-background-success">
					<h4 class="widget-content-light">
						<strong>Set</strong> Ad Price					
					</h4>
				</div>
				<div class="widget-extra-full">
					<span class="h2 text-success animation-expandOpen">
						<i class="fa fa-plus"></i>
					</span>
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
						echo form_open('admin/disp_price/', $attributes);
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
							<th>Newspaper</th>
							<th class="text-center">City</th>
							<th class="text-center">Insertion</th>
							<th class="text-center">Ad Category</th>
							<th class="text-center">Price</th>
							<th class="text-center">Fixed Price</th>
							<th class="text-center"> Color </th>
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
								<?php echo $ad_price->city_name ;?>
							</td>
							<td class="text-center">
								<?php echo $ad_price->ins_from ;?>-
								<?php echo $ad_price->ins_to ;?>
							</td>
							<td class="text-center">
								<?php echo $ad_price->cat_name ;?>
							</td>
							<td class="text-center">
								<?php echo $ad_price->ad_price ;?>
							</td>
								<td class="text-center">
								<?php echo $ad_price->f_rate ;?>
							</td>
							<td class="text-center">
								<?php
									if($ad_price->color_type=='A')
										echo "Any Color";
									if($ad_price->color_type=='B')
										echo "Black/White";
									if($ad_price->color_type=='C')
										echo "Color";
								?>
							</td>
							<td class="text-center">
								<?php echo $ad_price->discount ;?>
							</td>
							<td class="text-center">
								<?php echo $ad_price->date_from ." TO ". $ad_price->date_to ;?>
							</td>
							<td class="text-center">
								<div class="btn-group btn-group-xs">
									<a class="btn btn-default" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/disp_price/edit/<?php echo $ad_price->id ;?>" data-original-title="Edit">
										<i class="fa fa-pencil"></i>
									</a>
									<a class="btn btn-xs btn-danger" title="" data-toggle="tooltip"  onclick="return confirm('Are you sure you want to delete this price?');" href="<?php echo base_url(); ?>admin/disp_price/del/<?php echo $ad_price->id ;?>" data-original-title="Delete">
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
				
				</div>
			</div>
			<!-- END All Products Content -->
		</div>
		<!-- END All Products Block -->
	</div>
		<script>
	$(document).ready(function() {
    $('#ecom-products').DataTable();
} );</script>
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
     <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
	 
	