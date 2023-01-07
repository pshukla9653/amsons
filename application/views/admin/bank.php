<div id="page-content" style="min-height: 1189px;">

	<!-- Quick Stats -->

	<div class="row text-center">

		<div class="col-sm-6 col-lg-3">

			<a class="widget widget-hover-effect2" href="<?= base_url() ?>admin/bank/add">

				<div class="widget-extra themed-background-success">

					<h4 class="widget-content-light">

						<strong>Add</strong> New Bank			

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
    <div class="col-md-12">
    <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Ser.</th>
                <th>User</th>
                <th>Bank Name</th>
                <th>Acc Name</th>
                <th>Acc Number</th>
                <th>Ifsc</th>
                <th>Modified</th>
                <th>Update</th>
                
            </tr>
        </thead>
        <tbody>
        <?php $i=1; if(isset($results)){ foreach($results as $row) { ?>
        <tr>
            <td><?php echo $i;?></td>
               <td><?php echo $row['user_name'];?></td>
                <td><?php echo $row['bank_name'];?></td>
                <td><?php echo $row['acc_name'];?></td>
                <td><?php echo $row['acc_number'];?></td>
                <td><?php echo $row['ifsc'];?></td>
                
                <td><?php echo $row['updated_at'];?></td>
                <td><a href="<?= base_url('admin/bank/edit/')?><?php echo $row['id'];?>" class="btn btn-sm btn-success">Update</td>
                 </tr>
        <?php $i++; } } else{ echo '
            <tr>
                <td colspan="8">
                    <div align="center">-------No record found -----</div>
                </td>
            </tr>'; }?> 
        </tbody>
    </table>
</div>
		</div>
		<!-- END All Products Block -->
	</div>