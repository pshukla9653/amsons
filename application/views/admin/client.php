<div class="col-lg-12">
    <h3><span>All Tbl_client</span>
        <a class="btn btn-sm btn-danger pull-right" href="<?= base_url() ?>admin/client/add">
        <span class="glyphicon glyphicon-plus"></span> 
        Add Record
        </a>
    </h3>

    <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Ser.</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Client Name</th>
                <th>C Date</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1; if(isset($results)){ foreach($results as $row) { ?>
        <tr>
            <td><?php echo $i;?></td>
                <td><?php echo $row['user_name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['mobile'];?></td>
                <td><?php echo $row['client_name'];?></td>
                <td><?php echo $row['c_date'];?></td>
                <td><a href="<?= base_url('admin/client/edit/')?><?php echo $row['id'];?>" class="btn btn-sm btn-success">Update</td>
                <td><a href="<?= base_url('admin/client/delete/')?><?php echo $row['id'];?>" class="btn btn-sm btn-success" onclick="return confirm('Are you sure want to delete this record?');" >Delete</td>
            </tr>
        <?php $i++; } } else{ echo '
            <tr>
                <td colspan="8">
                    <div align="center">-------No record found -----</div>
                </td>
            </tr>'; }?> 
        </tbody>
    </table>
</div>



