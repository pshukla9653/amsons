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

<div class="row">
<div class="col-md-12 detail">
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
<form method="post" action="<?php echo 
base_url('admin/account_group/main_group_insert');?>">

<div class="form-group">
<label>Group Name :</label>
<input type="text" name="group_name" class="form-control" value="<?php echo set_value('group_name'); ?>">
</div>

<div class="form-group">
<label>Group Type :</label>
<select class="form-control" name="group_type">
<option value="Assets">Assets</option>
<option value="Liabilities">Liabilities</option>
<option value="Income">Income</option>
<option value="Expenditure">Expenditure</option>
</select>
</div>

<div class="form-group">
<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
<input type="submit" class="btn btn-primary" value="Add New Account Group" />
</div>
</div>
</div>
</form>
</div>
			<!-- END General Data Block -->
		</div>
	<!-- END Product Edit Content -->
</div>