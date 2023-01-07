<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	<div class="row text-center">
		<div class="col-sm-6 col-lg-3">
			<a class="widget widget-hover-effect2" href="<?php echo base_url();?>admin/vouchers/insert">
				<div class="widget-extra themed-background-success">
					<h4 class="widget-content-light">
						<strong>Add </strong> Record
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
			<h2>
				<strong>All</strong> Vouchers list<br>
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
						echo form_open('admin/vouchers/', $attributes);
					?>
					
						<label>
							<div class="input-group">
							<!--	<input type="search" name="name" class="form-control" placeholder="Search" aria-controls="ecom-products" value="<?php if(isset($name)) echo $name;?>">
								<span class="input-group-addon">
									<button  name="search" type="submit" ><i class="fa fa-search"></i></button>
								</span>-->
							</div>
						</label>
					</form>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="datatable" role="grid" aria-describedby="ecom-products_info">
					<thead>
						<tr role="row">
						<th>Voucher No</th>

<th>Group Id</th>

<th>Ledger Id</th>

<th>Voucher Date</th>

<th>Entry Type</th>

<th>Voucher Type</th>

<th>Amount</th>

<th>Narration</th>

<th>Update</th>

				
						</tr>
					</thead>
				</table>
			</div>

			</div>
			<!-- END All Products Content -->
		</div>
		<!-- END All Products Block -->
	</div>
		<script>
	$(document).ready(function() {
		base_url = '<?php echo base_url();?>admin/';
		$('#datatable').DataTable({
     "pageLength" : 10,
     "serverSide": true,
     "order": [[0, "asc" ]],
     "ajax":{
              url :  base_url+'vouchers',
              type : 'POST'
            },
  }); 
} );</script>
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
     <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
	 
