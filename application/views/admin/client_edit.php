<div class="col-md-12 detail">
<form method="post" action="<?php echo base_url('admin/client/edit');?>"> 
    <div class="form-group">
        <label>Agency Id :</label>
        <input type="text" name="agency_id" id="agency_id" class="form-control" value="<?= $results['agency_id'] ?>">
    </div>

    <div class="form-group">
        <label>User Name :</label>
        <input type="text" name="user_name" id="user_name" class="form-control" value="<?= $results['user_name'] ?>">
    </div>

    <div class="form-group">
        <label>Email :</label>
        <input type="text" name="email" id="email" class="form-control" value="<?= $results['email'] ?>">
    </div>

    <div class="form-group">
        <label>Passcode :</label>
        <input type="text" name="passcode" id="passcode" class="form-control" value="<?= $results['passcode'] ?>">
    </div>

    <div class="form-group">
        <label>Mobile :</label>
        <input type="text" name="mobile" id="mobile" class="form-control" value="<?= $results['mobile'] ?>">
    </div>

    <div class="form-group">
        <label>Client Name :</label>
        <input type="text" name="client_name" id="client_name" class="form-control" value="<?= $results['client_name'] ?>">
    </div>

    <div class="form-group">
        <label>Device Type :</label>
        <input type="text" name="device_type" id="device_type" class="form-control" value="<?= $results['device_type'] ?>">
    </div>

    <div class="form-group">
        <label>Imei Number :</label>
        <input type="text" name="imei_number" id="imei_number" class="form-control" value="<?= $results['imei_number'] ?>">
    </div>

    <div class="form-group">
        <label>Device Id :</label>
        <input type="text" name="device_id" id="device_id" class="form-control" value="<?= $results['device_id'] ?>">
    </div>

    <div class="form-group">
        <label>Login Type :</label>
        <input type="text" name="login_type" id="login_type" class="form-control" value="<?= $results['login_type'] ?>">
    </div>

    <div class="form-group">
        <label>Address :</label>
        <input type="text" name="address" id="address" class="form-control" value="<?= $results['address'] ?>">
    </div>

    <div class="form-group">
        <label>City :</label>
        <input type="text" name="city" id="city" class="form-control" value="<?= $results['city'] ?>">
    </div>

    <div class="form-group">
        <label>State :</label>
        <input type="text" name="state" id="state" class="form-control" value="<?= $results['state'] ?>">
    </div>

    <div class="form-group">
        <label>Pin Code :</label>
        <input type="text" name="pin_code" id="pin_code" class="form-control" value="<?= $results['pin_code'] ?>">
    </div>

    <div class="form-group">
        <label>Fax :</label>
        <input type="text" name="fax" id="fax" class="form-control" value="<?= $results['fax'] ?>">
    </div>

    <div class="form-group">
        <label>Vat No :</label>
        <input type="text" name="vat_no" id="vat_no" class="form-control" value="<?= $results['vat_no'] ?>">
    </div>

    <div class="form-group">
        <label>Cst No :</label>
        <input type="text" name="cst_no" id="cst_no" class="form-control" value="<?= $results['cst_no'] ?>">
    </div>

    <div class="form-group">
        <label>Discount :</label>
        <input type="text" name="discount" id="discount" class="form-control" value="<?= $results['discount'] ?>">
    </div>

    <div class="form-group">
        <label>Ser Tax No :</label>
        <input type="text" name="ser_tax_no" id="ser_tax_no" class="form-control" value="<?= $results['ser_tax_no'] ?>">
    </div>

    <div class="form-group">
        <label>Tin No :</label>
        <input type="text" name="tin_no" id="tin_no" class="form-control" value="<?= $results['tin_no'] ?>">
    </div>

    <div class="form-group">
        <label>Gst No :</label>
        <input type="text" name="gst_no" id="gst_no" class="form-control" value="<?= $results['gst_no'] ?>">
    </div>

    <div class="form-group">
        <label>It No :</label>
        <input type="text" name="it_no" id="it_no" class="form-control" value="<?= $results['it_no'] ?>">
    </div>

    <div class="form-group">
        <label>Contact Person :</label>
        <input type="text" name="contact_person" id="contact_person" class="form-control" value="<?= $results['contact_person'] ?>">
    </div>

    <div class="form-group">
        <label>Website :</label>
        <input type="text" name="website" id="website" class="form-control" value="<?= $results['website'] ?>">
    </div>

    <div class="form-group">
        <label>Opening Bal :</label>
        <input type="text" name="opening_bal" id="opening_bal" class="form-control" value="<?= $results['opening_bal'] ?>">
    </div>

    <div class="form-group">
        <label>Credit Bal :</label>
        <input type="text" name="credit_bal" id="credit_bal" class="form-control" value="<?= $results['credit_bal'] ?>">
    </div>

    <div class="form-group">
        <label>Account :</label>
        <input type="text" name="account" id="account" class="form-control" value="<?= $results['account'] ?>">
    </div>

    <div class="form-group">
        <label>Credit Period :</label>
        <input type="text" name="credit_period" id="credit_period" class="form-control" value="<?= $results['credit_period'] ?>">
    </div>

    <div class="form-group">
        <label>Credit Limit :</label>
        <input type="text" name="credit_limit" id="credit_limit" class="form-control" value="<?= $results['credit_limit'] ?>">
    </div>

    <div class="form-group">
    <label>Client Type :</label>
    <select class="form-control" name="client_type">
            <option value='D' <?php if($results['client_type']=="D"){ echo "selected='selected'";} ?>>D</option>
            <option value='I' <?php if($results['client_type']=="I"){ echo "selected='selected'";} ?>>I</option>
        </select> 
    </div>

    <div class="form-group">
        <label>Agency :</label>
        <input type="text" name="agency" id="agency" class="form-control" value="<?= $results['agency'] ?>">
    </div>

    <div class="form-group">
        <label>Group Head :</label>
        <input type="text" name="group_head" id="group_head" class="form-control" value="<?= $results['group_head'] ?>">
    </div>

    <div class="form-group">
        <label>Shared :</label>
        <input type="text" name="shared" id="shared" class="form-control" value="<?= $results['shared'] ?>">
    </div>

    <div class="form-group">
        <label>C Date :</label>
        <input type="text" name="c_date" id="c_date" class="form-control" value="<?= $results['c_date'] ?>">
    </div>

    <div class="form-group">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
        <span id="add">
        <input type="hidden" name="id" id="id" value="<?= $results['id'] ?>">
        <input type="submit" class="btn btn-primary" value="Update"/>
        </span> 
    </div>
</form>
</div>