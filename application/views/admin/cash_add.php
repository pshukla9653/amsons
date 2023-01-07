<div id="page-content" style="min-height: 1189px;">
<div class="col-lg-12">
    <h4 style="text-align:center"><i class="icon-paragraph-justify2"></i>Add new client</h4>
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
<form method="post" action="<?php echo base_url('admin/client/add');?>">
    <div class="row">
    <div class="form-group">
        <label>Agency Id :</label>
        <input type="text" name="agency_id" class="form-control" value="<?php echo set_value('agency_id'); ?>">
    </div>

    <div class="form-group">
        <label>User Name :</label>
        <input type="text" name="user_name" class="form-control" value="<?php echo set_value('user_name'); ?>">
    </div>

    <div class="form-group">
        <label>Email :</label>
        <input type="text" name="email" class="form-control" value="<?php echo set_value('email'); ?>">
    </div>

    <div class="form-group">
        <label>Passcode :</label>
        <input type="text" name="passcode" class="form-control" value="<?php echo set_value('passcode'); ?>">
    </div>

    <div class="form-group">
        <label>Mobile :</label>
        <input type="text" name="mobile" class="form-control" value="<?php echo set_value('mobile'); ?>">
    </div>

    <div class="form-group">
        <label>Client Name :</label>
        <input type="text" name="client_name" class="form-control" value="<?php echo set_value('client_name'); ?>">
    </div>

    <div class="form-group">
        <label>Device Type :</label>
        <input type="text" name="device_type" class="form-control" value="<?php echo set_value('device_type'); ?>">
    </div>

    <div class="form-group">
        <label>Imei Number :</label>
        <input type="text" name="imei_number" class="form-control" value="<?php echo set_value('imei_number'); ?>">
    </div>

    <div class="form-group">
        <label>Device Id :</label>
        <input type="text" name="device_id" class="form-control" value="<?php echo set_value('device_id'); ?>">
    </div>

    <div class="form-group">
        <label>Login Type :</label>
        <input type="text" name="login_type" class="form-control" value="<?php echo set_value('login_type'); ?>">
    </div>

    <div class="form-group">
        <label>Address :</label>
        <input type="text" name="address" class="form-control" value="<?php echo set_value('address'); ?>">
    </div>

    <div class="form-group">
        <label>City :</label>
        <input type="text" name="city" class="form-control" value="<?php echo set_value('city'); ?>">
    </div>

    <div class="form-group">
        <label>State :</label>
        <input type="text" name="state" class="form-control" value="<?php echo set_value('state'); ?>">
    </div>

    <div class="form-group">
        <label>Pin Code :</label>
        <input type="text" name="pin_code" class="form-control" value="<?php echo set_value('pin_code'); ?>">
    </div>

    <div class="form-group">
        <label>Fax :</label>
        <input type="text" name="fax" class="form-control" value="<?php echo set_value('fax'); ?>">
    </div>

    <div class="form-group">
        <label>Vat No :</label>
        <input type="text" name="vat_no" class="form-control" value="<?php echo set_value('vat_no'); ?>">
    </div>

    <div class="form-group">
        <label>Cst No :</label>
        <input type="text" name="cst_no" class="form-control" value="<?php echo set_value('cst_no'); ?>">
    </div>

    <div class="form-group">
        <label>Discount :</label>
        <input type="text" name="discount" class="form-control" value="<?php echo set_value('discount'); ?>">
    </div>

    <div class="form-group">
        <label>Ser Tax No :</label>
        <input type="text" name="ser_tax_no" class="form-control" value="<?php echo set_value('ser_tax_no'); ?>">
    </div>

    <div class="form-group">
        <label>Tin No :</label>
        <input type="text" name="tin_no" class="form-control" value="<?php echo set_value('tin_no'); ?>">
    </div>

    <div class="form-group">
        <label>Gst No :</label>
        <input type="text" name="gst_no" class="form-control" value="<?php echo set_value('gst_no'); ?>">
    </div>

    <div class="form-group">
        <label>It No :</label>
        <input type="text" name="it_no" class="form-control" value="<?php echo set_value('it_no'); ?>">
    </div>

    <div class="form-group">
        <label>Contact Person :</label>
        <input type="text" name="contact_person" class="form-control" value="<?php echo set_value('contact_person'); ?>">
    </div>

    <div class="form-group">
        <label>Website :</label>
        <input type="text" name="website" class="form-control" value="<?php echo set_value('website'); ?>">
    </div>

    <div class="form-group">
        <label>Opening Bal :</label>
        <input type="text" name="opening_bal" class="form-control" value="<?php echo set_value('opening_bal'); ?>">
    </div>

    <div class="form-group">
        <label>Credit Bal :</label>
        <input type="text" name="credit_bal" class="form-control" value="<?php echo set_value('credit_bal'); ?>">
    </div>

    <div class="form-group">
        <label>Account :</label>
        <input type="text" name="account" class="form-control" value="<?php echo set_value('account'); ?>">
    </div>

    <div class="form-group">
        <label>Credit Period :</label>
        <input type="text" name="credit_period" class="form-control" value="<?php echo set_value('credit_period'); ?>">
    </div>

    <div class="form-group">
        <label>Credit Limit :</label>
        <input type="text" name="credit_limit" class="form-control" value="<?php echo set_value('credit_limit'); ?>">
    </div>

    <div class="form-group">
        <label>Client Type :</label>
            <select class="form-control" name="client_type">
            <option value="D">D</option>
            <option value="I">I</option>
        </select>
    </div>

    <div class="form-group">
        <label>Agency :</label>
        <input type="text" name="agency" class="form-control" value="<?php echo set_value('agency'); ?>">
    </div>

    <div class="form-group">
        <label>Group Head :</label>
        <input type="text" name="group_head" class="form-control" value="<?php echo set_value('group_head'); ?>">
    </div>

    <div class="form-group">
        <label>Shared :</label>
        <input type="text" name="shared" class="form-control" value="<?php echo set_value('shared'); ?>">
    </div>

    <div class="form-group">
        <label>C Date :</label>
        <input type="text" name="c_date" class="form-control" value="<?php echo set_value('c_date'); ?>">
    </div>

    <div class="form-group">
        <input type="reset" class="btn btn-danger" value="Cancel">
        <input type="submit" class="btn btn-primary" value="Add New"/>
    </div>
</form>



