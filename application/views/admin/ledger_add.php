
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
<div class="col-lg-12">
<h4 style="text-align:center"><i class="icon-paragraph-justify2"></i>Ledger Addition form</h4>
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

<!-- input form -->
<form method="post" action="<?php echo base_url('admin/ledger/add');?>">
<div class="row">


<div class="form-group">
<label>Group:</label>
<select name="group_id" class="form-control">
<?php foreach($main_group as $row){
    echo "<option value=".$row['group_id'].">".$row['group_name']."</option>";
}
?>
</select>
</div>

<div class="form-group">
<label>Ledger Name :</label>
<input type="text" name="ledger_name" class="form-control" value="<?php echo set_value('ledger_name'); ?>">
</div>
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label>Opening Balance :</label>
<input type="text" name="opening_balance" class="form-control" value="<?php echo set_value('opening_balance'); ?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label>Type :</label>
<select class="form-control" name="ob_type">
<option>credit</option>
<option>debit</option>
</select>
</div>
</div>
</div>

<div class="form-group">
<label>Editable :</label>
<select class="form-control" name="editable">
<option>yes</option>
<option>no</option>
</select>
</div>
<!-- 
<div class="form-group">
<label>Master Id :</label>
<input type="text" name="master_id" class="form-control" value="<?php //echo set_value('master_id'); ?>">
</div> -->

<div class="form-group">
<label>Is Deleted :</label>
<select class="form-control" name="is_deleted">
<option>no</option>
<option>yes</option>
</select>
</div>


<div class="form-group">
<input type="reset" class="btn btn-danger" value="Cancel">
<input type="submit" class="btn btn-primary" value="Add New"/>
</div>
</form>


			<!-- END General Data Block -->
            </div>
	<!-- END Product Edit Content -->
</div>