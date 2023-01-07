<div id="page-content" style="min-height: 1189px;">


    <div class="col-lg-offset-2 col-lg-7">
        <h4 style="text-align:center"><i class="icon-paragraph-justify2"></i>Edit bank</h4>
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
        <form method="post" action="<?php echo base_url('admin/bank/edit');?>"> 

            <div class="form-group">
                <label>User Name :</label>
                <select name="user_id" class="form-control" >
                    <?php foreach($users as $row){
                        echo "<option value='".$row['id']."'";  if($row['id']==$results['user_id']){ echo "selected"; } echo">".$row['name']."</option>";  
                    }?>
                </select>
            </div>
            <div class="form-group">
                <label>Bank Name :</label>
                <input type="text" name="bank_name" id="bank_name" class="form-control" value="<?= $results['bank_name'] ?>">
            </div>

            <div class="form-group">
                <label>Acc Name :</label>
                <input type="text" name="acc_name" id="acc_name" class="form-control" value="<?= $results['acc_name'] ?>">
            </div>

            <div class="form-group">
                <label>Acc Number :</label>
                <input type="text" name="acc_number" id="acc_number" class="form-control" value="<?= $results['acc_number'] ?>">
            </div>

            <div class="form-group">
                <label>Ifsc :</label>
                <input type="text" name="ifsc" id="ifsc" class="form-control" value="<?= $results['ifsc'] ?>">
            </div>

            <div class="form-group">
                <label>Created At :</label>
                <input type="text" name="created_at" id="created_at" class="form-control" value="<?= $results['created_at'] ?>">
            </div>

            <div class="form-group">
                <label>Updated At :</label>
                <input type="text" name="updated_at" id="updated_at" class="form-control" value="<?= $results['updated_at'] ?>">
            </div>

            <div class="form-group">

                <span id="add">
                    <input type="hidden" name="id" id="id" value="<?= $results['id'] ?>">
                    <input type="submit" class="btn btn-primary" value="Update"/>
                </span> 
            </div>
        </form>
    </div>
</div>