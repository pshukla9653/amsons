<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	<div class="row text-center">
		<div class="col-sm-6 col-lg-3">
			<a class="widget widget-hover-effect2" href="<?php echo base_url();?>admin/book_ads/add">
				<div class="widget-extra themed-background-success">
					<h4 class="widget-content-light">
						<strong>Text Ro</strong> Booking
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
						<strong>All</strong> RO
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
				<strong>All</strong> Book Ads
			
			</h2>
		</div>
		<h2>
		     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
			<?php echo $this->session->flashdata('msg'); ?>
			<script  type="text/javascript">
				if(<?php echo ($this->session->flashdata('msg')!=null)?'1':'0'?>)
				{
					alert("<?php echo $this->session->flashdata('msg')?>");
				}
			</script>
		</h2>
		<!-- END All Products Title -->
		<!-- All Products Content -->
		<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">
			<div class="row">
				<div class="col-sm-6 col-xs-7">
					<div id="ecom-products_filter" class="dataTables_filter">
					<?php 
						$attributes = array('id' => 'search');
						echo form_open('admin/book_ads/', $attributes);
					?>
					
						<label>
					<!--	<div class="input-group">
								<input type="search" name="name" id="name" class="form-controln input-sm" placeholder="Search" aria-controls="ecom-products"  value="<?php if(isset($name)) echo $name;?>">
								<span class="input-group-addon">
									<button  name="search" type="submit" ><i class="fa fa-search"></i></button>
								</span>
							</div>-->
							<div class="form-group">
    <div class="input-group">
     <span class="input-group-addon">Search</span>
     <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
    </div>
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
							<th class="text-center" >RO No.</th>					
							<th class="text-center" style="width: 100px;">Newspaper</th>
							<th class="text-center" style="width: 150px;" >Category</th>
							<th class="text-center" style="width: 100px;" >Type</th>
							<th class="text-center" style="width: 150px;" >Ad Cost</th>
							<th class="text-center" style="width: 150px;" >Ad Days</th>
							<th class="text-center" style="width: 150px;" >User</th>
							<th class="text-center" style="width: 150px;" >Uploaded File</th>				
							<th class="text-center " style="width: 128px;" >Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($book_ads as $book_ad){ ?>
						<tr role="row" class="odd">
							<td class="text-center">
									<strong><?php echo $book_ad->ro_no ;?></strong>
							</td>
							<td>
								<?php echo $book_ad->newspaper_name ;?>
							</td>													
							<td class="text-center">
								<?php echo $book_ad->cat_name;?>
							</td>
							<td class="text-center">
								<?php echo ($book_ad->ro_type=="P")?"Package":"";?>
								<?php echo ($book_ad->ro_type=="M")?"Multipaper":"";?>
								<?php echo ($book_ad->ro_type=="N")?"Single":"";?>
							</td>
							<td class="text-center">
								<?php echo $book_ad->ad_cost;?>
							</td>
							<td class="text-center">
								<?php echo $book_ad->insertion;?>
							</td>
							<td class="text-center">
								<?php echo $book_ad->client_name ."<br>".$book_ad->email ."<br>".$book_ad->mobile;?>
							</td>
							<td class="text-center">
								<?php if($book_ad->uploaded_file){
                                echo "<a href='".base_url()."images/ro/".$book_ad->uploaded_file."'>View</a>";}else{echo "not attached"; }?>
							</td>
							<td class="text-center">
								<div class="btn-group btn-group-xs">
									<a class="btn btn-default" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/book_ads/info/<?php echo $book_ad->id ; ?>" data-original-title="Details">
										<i class="fa fa-info"></i>
									</a>
									<a class="btn btn-default" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/book_ads/edit/<?php echo $book_ad->id ; ?>" data-original-title="Edit">
										<i class="fa fa-pencil"></i>
									</a>
									<a class="btn btn-xs btn-danger" title="" data-toggle="tooltip" onclick="return confirm('Are you sure you want to delete this Ad?');" href="<?php echo base_url(); ?>admin/book_ads/del/<?php echo $book_ad->id ;?>" data-original-title="Delete">
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
						<?php if($total_rows > 50){ ?>
						<div class="dataTables_info" id="ecom-products_info" role="status" aria-live="polite">
							<strong><?php echo ((($curr_page - 1)*$per_page)+1) ; ?></strong> -
							
							<strong><?php echo ($curr_page*$per_page)  ; ?></strong> of 
							
							<strong><?php echo $total_rows ; ?></strong>
						</div>
						<?php } ?>
					</div>
				<div class="col-sm-7 col-xs-12 clearfix">
					<div class="dataTables_paginate paging_bootstrap" id="ecom-products_paginate">
							<div class="pagination pagination-sm remove-margin">
							<?php echo $links ; ?>
							</div>
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
	<script>
	$(document).ready(function() {
   // $('#ecom-products').DataTable({ "paging": false});
    load_data();

 function load_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>" + "admin/book_ads/index",,
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
      
} );</script>
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
   <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
	 
	