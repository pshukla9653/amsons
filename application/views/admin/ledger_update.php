
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
						<strong>Update</strong> Ledger
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
              
</div>

<!-- /Update Form -->
<div id="form_edit" class="modal fade" tabindex="-1" role="dialog">
<h4 class="modal-title" style="text-align:center"><i class="icon-paragraph-justify2"></i>
<span>Edit</span> 
Information</h4>
<span class="text-danger"> <?php 
if(isset($_SESSION['error'])){
echo $_SESSION['error']; 
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
<form method="post" action="<?php echo base_url('admin/ledger/update');?>">
<div class="row">
<div class="col-md-12 detail">
<input type="hidden" name="ledger_id" id="ledger_id" class="form-control" value="<?= $results['ledger_id'] ?>">
<div class="form-group">
<label>Group Id :</label>
<select name="group_id" class="form-control">

<?php foreach($main_group as $row){
    echo "<option value=".$row['group_id'];
    if($results['ledger_id']==$row['group_id']){
        echo " selected";
    }
    echo " >".$row['group_name']."</option>";
}
?>
</select>
</div>

<div class="form-group">
<label>Ledger Name :</label>
<input type="text" name="ledger_name" id="ledger_name" class="form-control" value="<?= $results['ledger_name'] ?>">
</div>
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label>Opening Balance :</label>
<input type="text" name="opening_balance" id="opening_balance" class="form-control" value="<?= $results['opening_balance'] ?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label>Type :</label>
<select class="form-control" name="ob_type">
<option value='credit' <?php if($results['ob_type']=="credit"){ echo "selected='selected'";} ?>>Credit</option>
<option value='debit' <?php if($results['ob_type']=="debit"){ echo "selected='selected'";} ?>>Debit</option>
</select>
</div>
</div>
</div>

<div class="form-group">
<label>Editable :</label>
<select class="form-control" name="editable">
<option value='no' <?php if($results['editable']=="no"){ echo "selected='selected'";} ?>>No</option>
<option value='yes' <?php if($results['editable']=="yes"){ echo "selected='selected'";} ?>>Yes</option>
</select>
</div>

<div class="form-group">
<label>Master Id :</label>
<input type="text" name="master_id" id="master_id" class="form-control" value="<?= $results['master_id'] ?>">
</div>

<div class="form-group">
<label>Is Deleted :</label>
<select class="form-control" name="is_deleted">
<option value='no' <?php if($results['is_deleted']=="no"){ echo "selected='selected'";} ?>>No</option>
<option value='yes' <?php if($results['is_deleted']=="yes"){ echo "selected='selected'";} ?>>Yes</option>
</select>
</div>

</div>
</div>
</div>
<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
<span id="add">
<input type="hidden" name="id" value="" id="id">
<input type="submit" class="btn btn-primary" value="Update"/>
</span></div>
</form>
</div>
</div>
			<!-- END General Data Block -->
            </div>
	<!-- END Product Edit Content -->
</div>
<!-- /update form -->