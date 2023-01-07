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
				
				<!-- END General Data Title -->
				<!-- General Data Content -->
<h4 class="modal-title" style="text-align:center"><i class="icon-paragraph-justify2"></i>
<span>Edit</span> 
Information</h4>

<form method="post" action="<?php echo base_url('admin/account_group/main_group_edit');?>">


<input type="hidden" name="group_id" value="<?= $results['group_id'] ?>">

<div class="form-group">
<label>Group Name :</label>
<input type="text" name="group_name" id="group_name" class="form-control" value="<?= $results['group_name'] ?>">
</div>

<div class="form-group">
<label>Group Type :</label>
<select class="form-control" name="group_type">
<option value='Assets' <?php if($results['group_type']=="Assets"){ echo "selected='selected'";} ?>>Assets</option>
<option value='Liabilities' <?php if($results['group_type']=="Liabilities"){ echo "selected='selected'";} ?>>Liabilities</option>
<option value='Income' <?php if($results['group_type']=="Income"){ echo "selected='selected'";} ?>>Income</option>
<option value='Expenditure' <?php if($results['group_type']=="Expenditure"){ echo "selected='selected'";} ?>>Expenditure</option>
</select>
</div>

<div class="form-group">
<label>Is Deleted :</label>
<select class="form-control" name="is_deleted">
<option value='no' <?php if($results['is_deleted']=="no"){ echo "selected='selected'";} ?>>No</option>
<option value='yes' <?php if($results['is_deleted']=="yes"){ echo "selected='selected'";} ?>>Yes</option>
</select>
</div>


</div>
<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
<span id="add">
<input type="submit" class="btn btn-primary" value="Update" />
</span></div>
</form>
</div>
</div>
			<!-- END General Data Block -->
            </div>
	<!-- END Product Edit Content -->
</div>