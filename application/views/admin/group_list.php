<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	<div class="row text-center">
		<div class="col-sm-6 col-lg-6">
					<?php 
			$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-category');
			echo form_open_multipart('admin/group/add', $attributes); ?>
			<?php
			echo "<div class='error_msg'>";
			echo validation_errors();
			echo "</div>";
			?>
				<div class="form-group">
					<label for="example-text-input" class="col-md-3 control-label">Group</label>
					<div class="col-md-9">
						<input type="text" placeholder="Group Name" required="required" class="form-control" name="g_name" id="g_name">
					</div>
				</div>		
				<div class="form-group">
					<div class="col-md-9 col-md-offset-3">
						<button class="btn btn-sm btn-primary" name="submit_btn" type="submit" value="sub"><i class="fa fa-floppy-o"> </i> Save </button>
					</div>
				</div>
			</form>
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
				<strong>All</strong> Groups				
			</h2>
		</div>
		<h3  align='center'>
				<?php echo $this->session->flashdata('msg'); ?>			
		</h3>
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
				<table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
					<thead>
						<tr role="row">
							<th  class="text-center" style="width: 70px;" >ID</th>
							<th  class="text-center"> Groups Name </th>
							<th class="text-center " style="width: 128px;" >Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($groups as $group){ ?>
						<tr role="row" class="odd">
							<td class="text-center sorting_1">
									<strong><?php echo $group->g_id ;?></strong>
							</td>
							<td  class="text-center">
								<?php echo $group->g_name;?>
							</td>
							<td class="text-center">
								<div class="btn-group btn-group-xs">
									<a class="btn btn-xs btn-danger" title="" data-toggle="tooltip" onclick="return confirm('Are you sure you want to delete this Group?');" href="<?php echo base_url(); ?>admin/group/del/<?php echo $group->g_id ;?>" data-original-title="Delete">
										<i class="fa fa-times"></i>
									</a>
								</div>
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