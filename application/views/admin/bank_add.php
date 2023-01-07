<div id="page-content" style="min-height: 1189px;">


	<div class="col-lg-offset-2 col-lg-7">
    <h4 style="text-align:center"><i class="icon-paragraph-justify2"></i>New bank</h4>
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

<form method="post" action="<?php echo base_url('admin/bank/add');?>">
 
    <div class="form-group">
        <label>User Name :</label>
        <select name="user_id" class="form-control" >
            <?php foreach($results as $row){
            echo "<option value='".$row['id']."'>".$row['name']."</option>";  
}?>
        </select>
    </div>
    
    <div class="form-group">
        <label>Bank Name :</label>
        <input type="text" name="bank_name" class="form-control" value="<?php echo set_value('bank_name'); ?>">
    </div>

    <div class="form-group">
        <label>Acc Name :</label>
        <input type="text" name="acc_name" class="form-control" value="<?php echo set_value('acc_name'); ?>">
    </div>

    <div class="form-group">
        <label>Acc Number :</label>
        <input type="text" name="acc_number" class="form-control" value="<?php echo set_value('acc_number'); ?>">
    </div>

    <div class="form-group">
        <label>Ifsc :</label>
        <input type="text" name="ifsc" class="form-control" value="<?php echo set_value('ifsc'); ?>">
    </div>

   

    <div class="form-group">
        
        <input type="submit" class="btn btn-primary" value="Add New"/>
    </div>
</form>
</div>
		<!-- END All Products Block -->
	</div>