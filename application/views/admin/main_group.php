<div id="page-content" style="min-height: 1189px;">
	<!-- Product Edit Content -->
	<div class="row">
		<div class="col-lg-12">
			<!-- General Data Block -->
			<div class="block">
				<!-- General Data Title -->
				<div class="block-title">
					<h2>
						<i class="fa fa-pencil"></i>
						<strong>Add New</strong> Newspaper Group
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
<div class="col-md-10">
<h3><span>All Tbl_main_group</span>
<a class="btn btn-sm btn-danger pull-right" href="<?= base_url() ?>admin/account_group/main_group_insert">
<span class="glyphicon glyphicon-plus"></span> 
Add Record
</a>
</h3>
<span class="text-danger"> <?php 
if(isset($message)){
echo $message; 
}?>

<?php $error=validation_errors(); 
if(!empty($error)){
echo "Errors: ".validation_errors();
?>

<?php
}
?>
</span>
</div>
<table id="example" class="table table-striped table-bordered">
<thead>
<tr>
<th>Ser.</th>

<th>Group Name</th>
<th>Group Type</th>

<th>Update</th>
</tr>
</thead>
<tbody>
<?php $i=1; if(isset($results)){ foreach($results as $row) { ?>
<tr>
<td><?php echo $i;?></td>

<td><?php echo $row['group_name'];?></td>
<td><?php echo $row['group_type'];?></td>

<td>
<a href="<?= base_url('admin/account_group/main_group_edit/')?><?php echo $row['group_id'];?>" class="btn btn-sm btn-success">Update</a>
</td>
</tr>
<?php $i++; } } else{ echo '<tr>
<td colspan="8">
<div align="center">-------No record found -----</div>
</td>
</tr>'; }?> 
</tbody>
</table>
</div>
</div>
			<!-- END General Data Block -->
		</div>
	<!-- END Product Edit Content -->
</div>