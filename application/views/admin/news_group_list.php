<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	<div class="row text-center">
		<div class="col-sm-6 col-lg-3">
			<a class="widget widget-hover-effect2" href="<?php echo base_url();?>admin/newspaper/group_add">
				<div class="widget-extra themed-background-success">
					<h4 class="widget-content-light">
						<strong>Add News</strong> Group
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
						<strong>All</strong> News Group
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
				<strong>All</strong> Newspaper Group
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
						echo form_open('admin/newspaper/', $attributes);
					?>
					
						<!--<label>
							<div class="input-group">
								<input type="search" name="name" class="form-control" placeholder="Search" aria-controls="ecom-products" value="<?php if(isset($name)) echo $name;?>">
								<span class="input-group-addon">
									<button  name="search" type="submit" ><i class="fa fa-search"></i></button>
								</span>
							</div>
						</label>-->
					</form>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
					<thead>
						<tr role="row">
							<th>ID</th>
							<th>Name</th>
						<!--	<th>CITY</th>
							<th>Creation Date</th>
							-->
							<th class="text-center " style="width: 100px;" >Action</th>
						</tr>
					</thead>
					<tbody>
					    
	
		<?php foreach ($newspaper_groups as $newspaper_group){ ?>
						<tr role="row" class="odd">
							<td class="text-center">
									<strong><?php echo $newspaper_group->ng_id ;?></strong>
							</td>
							<td>
						<h6>	<span class="fa fa-chevron-right fa-fw " ></span> 	<?php echo $newspaper_group->ng_name;?></h6>
							
					    <p>														<?php
												   $i=1; foreach($address as $ad){
												        if($ad->ng_id ==$newspaper_group->ng_id)
												        {
												            if(!empty($ad->name)){
							    ?>
								<?php echo "Address:"?>	<?php echo $i;?>&nbsp;&nbsp;<?php echo $ad->name;?><br>
											  
											
											<?php $i++;} } } ?>
										
							</p>
							
						
					
							</td>
<!--
							<td>
								<?php //echo $newspaper_group->ng_email;?>
							</td>
							<td>
								<?php //echo $newspaper_group->ng_phone;?>
							</td>
							<td>
								<?php //echo $newspaper_group->gst_no;?>
							</td>
							
						    
						
-->							
                            <td class="text-center">
								<div class="btn-group btn-group-xs">
									<a class="btn btn-default" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/newspaper/group_edit/<?php echo $newspaper_group->ng_id ; ?>" data-original-title="Edit">
										<i class="fa fa-pencil"></i>
									</a>
									<a class="btn btn-xs btn-danger" title="" data-toggle="tooltip" onclick="return confirm('Are you sure you want to delete this Newspaper Group?');" href="<?php echo base_url(); ?>admin/newspaper/group_del/<?php echo $newspaper_group->ng_id ;?>" data-original-title="Delete">
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
						<?php if($total_rows>=20){?>
						<div class="dataTables_info" id="ecom-products_info" role="status" aria-live="polite">
							<strong><?php echo ((($curr_page - 1)*$per_page)+1) ; ?></strong>-
							
							<strong><?php echo ($curr_page*$per_page)  ; ?></strong> of 
							
							<strong><?php echo $total_rows ; ?></strong>
						</div>
						<?php }?>
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
	 <script>
        
        $(document).ready(function() {
    $('#ecom-products').DataTable();
} );
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
     <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

	<script>
	$(document).ready(
  function() {
      

  $('td p').slideUp();
      
    $('td h6').click(
      function(){
          	if ( $('this').siblings('span.fa').hasClass("fa-rotate-90")) {
		 $(this).siblings('span.fa').removeClass("fa-rotate-90");
      	}else{
         $(this).siblings('span.fa').addClass("fa-rotate-90"); }
       $(this).siblings('p').slideToggle();
      }
      );
  }
  );
	   /*  (function() {
	$("span.fa").on("click", function() {
	
	var $span = $(this),
		$parentTr = $span.parent();

		
		if ($span.hasClass("fa-rotate-90")) {
			$span.removeClass("fa-rotate-90");
			 	  $('td div').slideUp();  
				});

			return;
		}

		
		$span.addClass("fa-rotate-90");
		$(this).siblings('div').slideToggle();

 
			
		
	});
	


})();*/
	</script>