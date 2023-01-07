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
                        <strong>Add New</strong> Newspaper
                    </h2>
                </div>
                <!-- END General Data Title -->
                <!-- General Data Content -->
                <?php
                        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
                        echo form_open_multipart('admin/newspaper/add', $attributes);
                ?>
                <?php
                        echo "<div class='text-danger'>";
                        echo validation_errors();
                        echo "</div>";
                ?>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper Group </label>
                    <div class="col-md-9">
                        <select id="g_id" name="g_id" class="form-control" data-placeholder="Choose Classes" required>
                            <?php foreach ($news_groups as $news_group) { ?>
                                     <option value="<?php echo $news_group->ng_id; ?>" <?php echo set_select('g_id', $news_group->ng_id); ?> ><?php echo $news_group->ng_name.", ".$news_group->ng_city; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">Name</label>
                    <div class="col-md-9">
                        <input type="text" onchange="check_newspaper();" placeholder="Enter Newspaper Name.."  class="form-control" name="name" id="name" value="<?php echo set_value('name'); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">Short Name</label>
                    <div class="col-md-9">
                        <input type="text" placeholder="Enter Newspaper Short Name.." class="form-control" name="sname" id="sname"  value="<?php echo set_value('sname'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-select" class="col-md-3 control-label">Select State</label>
                    <div class="col-md-9">
                     
                        <select id="state" name="states[]" class="select-chosen" data-placeholder="Choose State" multiple  onchange="get_city();">
                                <?php foreach($states as $state){ ?>
                                    <option value="<?php echo $state->id; ?>" <?php echo set_select('states[]',$state->id);?>><?php echo $state->name ;?>
                                    </option>
                                <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="example-chosen-multiple">Publish Cities</label>
                    <div class="col-md-9">
                        <select id="cities" name="cities[]" class="select-chosen" data-placeholder="Choose Cities" style="width: 250px;" multiple>
                          
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper Language </label>
                    <div class="col-md-9">
                        <select id="language" name="language" class="form-control" data-placeholder="Choose language" required>
                            <option value="">Choose language</option>
                            <?php foreach($languages as $language){ ?>
                                <option value="<?php echo $language->name; ?>" <?php echo set_select('language', $language->name);?> ><?php echo $language->name ;?>
                                </option>
                            <?php }?>
                        </select>
                    </div>
                </div>				
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">Full Address</label>
                    <div class="col-md-9">
                        <input type="text" placeholder="Enter Address.." class="form-control" name="address" id="address" value="<?php echo set_value('address'); ?>">
                    </div>
                </div>
               
                <div class="form-group">
                    <label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper Type </label>
                    <div class="col-md-9">
                        <select id="nt" name="nt" class="form-control" data-placeholder="Choose Type" >
                            <?php foreach ($paper_types as $paper_type) { ?>
                                        <option value="<?php echo $paper_type->type; ?>" <?php echo set_select('nt',$paper_type->type);?> ><?php echo $paper_type->type; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="example-chosen-multiple">Ad Types</label>
                    <div class="col-md-6">
                        <select id="type" name="type[]" class="select-chosen" data-placeholder="Choose Types" style="width: 250px;"  multiple required>
                                <?php foreach($types as $type){ ?>
                                        <option value="<?php echo $type->id; ?>" <?php echo set_select('type[]',$type->id);?>><?php echo $type->name; ?></option>
                                <?php }?>
                        </select>
                    </div>
                    <label class="col-md-2 control-label">Select All Types</label>
                    <div class="col-md-1">
                        <label class="switch switch-primary">
                            <input type="checkbox"  name="all_tp" id="all_tp"  <?php echo set_checkbox('all_tp','on'); ?>>
                                <span></span>
                        </label>
                    </div>
                </div>
                <!--<div class="form-group">
                    <label for="name" class="col-md-3 control-label">No. of Addition</label>
                    <div class="col-md-9">
                        <input type="number" placeholder="" class="form-control" name="addition" id="addition">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">No. of Copies</label>
                    <div class="col-md-9">
                        <input type="number" placeholder="" class="form-control" name="copy" id="copy">
                    </div>
                </div>-->

<!--
                <div class="form-group">
                    <label for="example-file-input" class="col-md-3 control-label">Newspaper Logo</label>
                    <div class="col-md-9">
                        <input type="file" name="logo" size="20">
                    </div>
                </div>
                <div class="form-group">

                </div>
-->
                <div class="form-group">
                    <label class="col-md-2 control-label">Main Publication</label>
                    <div class="col-md-2">
                        <label class="switch switch-primary">
                            <input type="checkbox" name="main_p" id="main_p" <?php echo set_checkbox('main_p','on'); ?>>
                            <span></span>
                        </label>
                    </div>
                    <label class="col-md-2 control-label">Print</label>
                    <div class="col-md-2">
                        <label class="switch switch-primary">
                            <input type="checkbox" name="print" id="print" <?php echo set_checkbox('print','on'); ?>>
                            <span></span>
                        </label>
                    </div>
                    <label class="col-md-2 control-label">Outdoor</label>
                    <div class="col-md-2">
                        <label class="switch switch-primary">
                            <input type="checkbox" name="outdoor" id="outdoor" <?php echo set_checkbox('outdoor','on'); ?>>
                            <span></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">						
                </div>
                <div class="form-group form-actions">
                    <div class="col-md-9 col-md-offset-3">
                        <button class="btn btn-sm btn-primary" type="submit">
                            <i class="fa fa-floppy-o"></i> Save
                        </button>
                        <button class="btn btn-sm btn-warning" type="reset">
                            <i class="fa fa-repeat"></i> Reset
                        </button>
                    </div>
                </div>
                </form>
                <!-- END General Data Content -->
            </div>
            <!-- END General Data Block -->
        </div>

        <!-- END Product Edit Content -->
    </div>
<script type="text/javascript">
$('#all_tp').click(function()
{
    if ($('#all_tp').is(":checked"))
    {
        $('#type option').prop('selected', true);  
        $('#type').trigger('chosen:updated');
    }
    else
    {
        $('#type option').prop('selected', false);  
        $('#type').trigger('chosen:updated');
    }
});        
        
function check_newspaper()
{
    var newspaper = $("#name").val();
    var group= $("#g_id").val();
    
    if(newspaper=="")
    {
        alert("Please Enter Newspaper name!");
        $('#cities').empty();
        update_city();
        return false;
    }
    $.ajax({
        url: "<?php echo base_url(); ?>" + "admin/newspaper/get_newspaper",
        type: "POST",
        async: true,
        data: {'name': newspaper,'group':group},
        beforeSend: function () {
            document.getElementById("loader").style.display = "block";
        },
        success: function (data)
        {
            if (data == "Y")
            {
                alert("Newspaper with this name already added.");
                $('#name').val('');
            }            
        },
        complete: function ()
        {
            document.getElementById("loader").style.display = "none";
        },
        error: function ()
        {
            document.getElementById("loader").style.display = "none";
            alert("Please Enter Newspaper name!");
        }
    });
    //setTimeout(sel_update, 500);
}

function get_city()
{   
    var st = $("#state").val();
    if((st==null) || (st.length ==0) )
    {
        alert("Please select atleast one states.");		
		$('#cities').empty();
		update_city();
        return false;
    }
    $.ajax({                
    url: "<?php echo base_url(); ?>" + "admin/newspaper/get_mul_city",
    type: "POST",               
    async: true ,               
    data: {state:st},
    beforeSend: function(){ document.getElementById("loader").style.display = "block";},
    success: function(data)
    {
        $('#cities').empty();
        var opts = $.parseJSON(data);
        // Use jQuery's each to iterate over the opts value
        $.each(opts, function(i, d) {
        

        $('#cities').append('<option value="' + d.id + '">' + d.name + '</option>');
        });
        
        document.getElementById("loader").style.display = "none";
    },
    complete: function() 
    {                    
        update_city();
    },               
    error: function() 
    {
        document.getElementById("loader").style.display = "none";
        alert("Please Select State!");
    }
    });
}


function update_city()
{
$('#cities').trigger('chosen:updated');

    //$("#city option[value=<?php //echo set_select('cities[]');?>]").attr("selected", true);
}
</script> 
