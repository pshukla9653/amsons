
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
						<strong>Add New</strong> Ledger
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->

<h3><span>All Ledgers</span>
<a class="btn btn-sm btn-danger pull-right" href="<?= base_url() ?>/admin/ledger/add">
<span class="glyphicon glyphicon-plus"></span> 
Add Ledger
</a>
</h3>

<table id="example" class="table table-striped table-bordered">
<thead>
<tr>
<th>Ser.</th>
<!-- <th>Ledger Id</th> -->
<th>Group Id</th>
<th>Ledger Name</th>
<th>Opening Balance</th>
<th>Editable</th>
<!-- <th>Master Id</th>
<th>Is Deleted</th> 
<th>Created At</th>
<th>Updated At</th>-->
<th>Update</th>
</tr>
</thead>
<tbody>
<?php $i=1; if(isset($results)){ foreach($results as $row) { ?>
<tr>
<td><?php echo $i;?></td>
<!-- <td><?php //echo $row['ledger_id'];?></td> -->
<td>
<?php foreach($main_group as $row1){
    if($row['group_id']==$row1['group_id']){
        echo $row1['group_name'];
    }
}
?></td>
<td><?php echo $row['ledger_name'];?></td>
<td><?php echo $row['opening_balance'];?></td>
<td><?php echo $row['editable'];?></td>
<!-- <td><?php //echo $row['master_id'];?></td>
<td><?php //echo $row['is_deleted'];?></td>
<td><?php //echo $row['created_at'];?></td>
<td><?php //echo $row['updated_at'];?></td> -->
<td><a href="<?= base_url('admin/ledger/update/')?><?php echo $row['ledger_id'];?>" class="btn btn-sm btn-success">Update</td>
</tr>
<?php $i++; } } else{ echo '<tr>
<td colspan="8">
<div align="center">-------No record found -----</div>
</td>
</tr>'; }?> 
</tbody>
</table>
</div>
			<!-- END General Data Block -->
            </div>
	<!-- END Product Edit Content -->
</div>