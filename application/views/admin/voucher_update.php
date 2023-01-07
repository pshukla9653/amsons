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
				<!-- General Data Content --><div class="col-lg-12">

<h4 class="modal-title" style="text-align:center"><i class="icon-paragraph-justify2"></i>
<span>Edit</span> 
Information</h4>
</div>
<form method="post" action="<?php echo base_url('admin/tbl_vouchers_update_action');?>">
<div class="row">
<div class="col-md-12 detail">

<div class="form-group">
<label>Group Id :</label>
<input type="text" name="group_id" id="group_id" class="form-control" value="<?= $results['group_id'] ?>">
</div>



<div class="form-group">
<label>Ledger Id :</label>
<input type="text" name="ledger_id" id="ledger_id" class="form-control" value="<?= $results['ledger_id'] ?>">
</div>

<div class="form-group">
<label>Voucher Date :</label>
<input type="text" name="voucher_date" id="voucher_date" class="form-control" value="<?= $results['voucher_date'] ?>">
</div>

<div class="form-group">
<label>Entry Type :</label>
<select class="form-control" name="entry_type">
<option value='cr' <?php if($results['entry_type']=="cr"){ echo "selected='selected'";} ?>>Cr</option>
<option value='dr' <?php if($results['entry_type']=="dr"){ echo "selected='selected'";} ?>>Dr</option>
</select>
</div>

<div class="form-group">
<label>Amount :</label>
<input type="text" name="amount" id="amount" class="form-control" value="<?= $results['amount'] ?>">
</div>

<div class="form-group">
<label>Narration :</label>
<input type="text" name="narration" id="narration" class="form-control" value="<?= $results['narration'] ?>">
</div>

<div class="form-group">
<label>Voucher No :</label>
<input type="text" name="voucher_no" id="voucher_no" class="form-control" value="<?= $results['voucher_no'] ?>">
</div>

<div class="form-group">
<label>Voucher Session :</label>
<input type="text" name="voucher_session" id="voucher_session" class="form-control" value="<?= $results['voucher_session'] ?>">
</div>

<div class="form-group">
<label>Screen :</label>
<input type="text" name="screen" id="screen" class="form-control" value="<?= $results['screen'] ?>">
</div>

<div class="form-group">
<label>Screen Id :</label>
<input type="text" name="screen_id" id="screen_id" class="form-control" value="<?= $results['screen_id'] ?>">
</div>

<div class="form-group">
<label>Created At :</label>
<input type="text" name="created_at" id="created_at" class="form-control" value="<?= $results['created_at'] ?>">
</div>

<div class="form-group">
<label>Modified At :</label>
<input type="text" name="modified_at" id="modified_at" class="form-control" value="<?= $results['modified_at'] ?>">
</div>

<div class="form-group">
<label>Is Deleted :</label>
<select class="form-control" name="is_deleted">
<option value='yes' <?php if($results['is_deleted']=="yes"){ echo "selected='selected'";} ?>>Yes</option>
<option value='no' <?php if($results['is_deleted']=="no"){ echo "selected='selected'";} ?>>No</option>
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