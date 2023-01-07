<div id="page-content" style="min-height: 1189px;">
	<!-- Product Edit Content -->
	<div class="row">
		<div class="block">
			<!-- General Data Title -->
			<div class="block-title">
				<h2>
					Change Your Password admin...
				</h2>
				
			</div>
			<h2>
					<?php echo $this->session->flashdata('pass_err'); ?>
			</h2>
			<!-- END General Data Title -->
			<!-- General Data Content -->
			<!-- Register Form -->
        <form action="<?php echo base_url();?>admin/settings/pass_c" method="post" id="form-edit" class="form-horizontal form-bordered form-control-borderless">
                        
<!--
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                        <input type="password" id="old-password" name="old-password" class="form-control input-lg" placeholder="Old Password"  required>
                    </div>
                </div>
            </div>
-->
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                        <input type="password" id="new-password" name="new-password" class="form-control input-lg" placeholder="New Password" required>
                    </div>
                </div>
            </div>
			<div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                        <input type="password" id="verify-password" name="verify-password" class="form-control input-lg" placeholder="Verify Password"  required>
                    </div>
                </div>
            </div>
            <div class="form-group form-actions">
                
                <div class="col-xs-6 text-right">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Save</button>
                </div>
            </div>
            
        </form>
        <!-- END Register Form -->
		</div>
	</div>
</div>


