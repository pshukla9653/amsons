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
                        <strong>Set ads</strong> Price
                    </h2>
                </div>
                <!-- END General Data Title -->
                <!-- General Data Content -->
                <?php
                        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
                        echo form_open('admin/price/add', $attributes)
                ?>
                <?php
                        echo "<div class='text-danger'>";
                        echo validation_errors();
                        echo "</div>";
                ?>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper</label>
                        <div class="col-md-9">
                            <select id="newspaper" name="newspaper" class="select-chosen form-control"  onchange="get_heading();" data-placeholder="Choose Newspaper" required>
                                <option value="">Choose Newspaper</option>
                                <?php foreach ($newspapers as $newspaper) { ?>
                                            <option value="<?php echo $newspaper->id; ?>" <?php echo set_select('newspaper', $newspaper->id); ?>
                                                    ><?php echo $newspaper->newspaper_name . " , " . $newspaper->city_name; ?></option>
                                                <?php } ?>
                            </select>
                        </div>
                    </div>					
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Ad Heading</label>
                        <div class="col-md-9">
                            <select id="ad_cat" name="ad_cat[]" class="select-chosen" data-placeholder="Choose Heading" style="width: 250px;" multiple required>

                            </select>
                        </div>
                    </div>
                    <!--	<div class="form-group">
                                    <label class="col-md-3 control-label" for="example-chosen-multiple">Publication  City</label>
            <div class="col-md-9">
                                            <select id="city" name="city" class="form-control" data-placeholder="Choose City" required>
                </select>
            </div>
        </div>	-->				
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Ad Day</label>
                        <div class="col-md-9">
                            <select id="day" name="days[]" class="select-chosen"  data-placeholder="Choose Ad day"  multiple required>
                                <?php foreach ($days as $day) { ?>
                                            <option value="<?php echo $day->id; ?>" <?php echo set_select('days[]', $day->id); ?>><?php echo $day->day; ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Select All Days</label>
                        <div class="col-md-3">
                            <label class="switch switch-primary">
                                <input type="checkbox"  name="all_day" id="all_day">
                                <span></span>
                            </label>
                        </div>                      
                    </div>
                    <!--	<div class="form-group">
                                    <label class="col-md-3 control-label" for="example-chosen-multiple">Color Type</label>
            <div class="col-md-9">
                                            <select id="color" name="color" class="form-control" data-placeholder="" required>
                                                    <option value="">Choose one</option>
                                                    <option value="A">Any Color</option>
                                                    <option value="B">Black/White</option>
                                                    <option value="C">Color</option>
                </select>
            </div>
        </div>-->
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Insertion From</label>
                        <div class="col-md-9">
                            <input type="number" value="<?php echo set_value('ins_from'); ?>"  onkeyup="inse_to();"  onchange="inse_to();" placeholder=""  min="1" class="form-control" name="ins_from" id="ins_from" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Insertion To</label>
                        <div class="col-md-9">
                            <input type="number" placeholder="" class="form-control" min="1" name="ins_to" id="ins_to" value="<?php echo set_value('ins_to'); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Duration</label>
                        <div class="col-md-4">
                            <input type="text" placeholder="" class="form-control" name="duration" id="duration" value="<?php echo set_value('duration'); ?>">
                        </div>
                        <div class="col-md-5">
                            <select id="dur_type" name="dur_type" class="form-control" data-placeholder="" style="width: 250px;" >
                                <option value="D" <?php echo set_select('dur_type', 'D'); ?>>Days</option>
                                <option value="W" <?php echo set_select('dur_type', 'W'); ?>>Weeks</option>
                                <option value="M" <?php echo set_select('dur_type', 'M'); ?>>Months</option>
                                <option value="Y" <?php echo set_select('dur_type', 'Y'); ?>>Years</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Minimum Unit</label>
                        <div class="col-md-3">
                            <input type="text" placeholder="" class="form-control" name="min_w" id="min_w" value="<?php echo set_value('min_w'); ?>" required>
                        </div>
                        <label for="price" class="col-md-3 control-label">Maximum Unit</label>
                        <div class="col-md-3">
                            <input type="text" placeholder="" class="form-control" name="max_w" id="max_w" value="<?php echo set_value('max_w'); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Unit Type</label>
                        <div class="col-md-9">
                            <select id="unit" name="unit" class="form-control" data-placeholder="" required>
                                <option value="">Choose one</option>
                                <option value="W">Word</option>
                                <option value="L">Line</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!--<div class="form-group">
                            <label class="col-md-3 control-label" for="example-chosen-multiple">Fixed Rate</label>
    <div class="col-md-9">
                                    <select id="fix" name="fix" class="select-chosen" data-placeholder="" style="width: 250px;" >
                                            <option value="">Choose one</option>
                                            <option value="1">Fixed Rate</option>
        </select>
    </div>
</div>-->
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Date From</label>
                        <div class="col-md-9">
                            <input type="text" id="date_f" name="date_f" value="<?php echo set_value('date_f'); ?>" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
                    <!--<div class="form-group">
                            <label for="price" class="col-md-3 control-label">Date To</label>
    <div class="col-md-9">
        <input type="text" id="date_t" name="date_t" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
    </div>
</div>-->
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Price</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" class="form-control" name="price" id="price" value="<?php echo set_value('price'); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Extra Price</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" class="form-control" name="eprice" id="eprice" value="<?php echo set_value('eprice'); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Discount</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" class="form-control" name="dis" id="dis" value="<?php echo set_value('dis'); ?>">
                        </div>
                    </div>					
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Multiple Ex Rate</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" class="form-control" name="mer" id="mer" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Multiple Rate</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" class="form-control" name="mr" id="mr" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Multiple</label>
                        <div class="col-md-9">
                            <select id="mul" name="mul" class="form-control" data-placeholder="Choose Ad Page">
                                <option value="">Choose One</option>
                                <option value="1" <?php echo set_select('mul', '1'); ?>>ADD</option>
                                <option value="2" <?php echo set_select('mul', '2'); ?>>Multiple</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Non Focus Day Charges</label>
                        <div class="col-md-5">
                            <input type="number" step="any" min="0" placeholder="" class="form-control" name="nfdc" id="nfdc" value="<?php echo set_value('nfdc'); ?>">
                        </div>
                        <div class="col-md-4">
                            <select id="nfdct" name="nfdct" class="form-control" data-placeholder="" style="width: 250px;" >								
                                <option value="Rs" <?php echo set_select('nfdct', 'Rs'); ?>>Rs.</option>
                                <option value="%" <?php echo set_select('nfdct', '%'); ?>>%</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <button class="btn btn-sm btn-primary" type="submit">
                                <i class="fa fa-floppy-o"></i> Save
                            </button>
                            <button class="btn btn-sm btn-warning" type="reset">
                                <i class="fa fa-repeat"></i> Reset
                            </button>							
                        </div>
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
        function inse_to()
        {
            var ins_f = parseInt($("#ins_from").val());
            document.getElementById("ins_to").value = ins_f;
            document.getElementById("ins_to").min = ins_f;
        }

        function get_heading()
        {
            var newspaper = $("#newspaper").val();
            $.ajax({
                url: "<?php echo base_url(); ?>" + "admin/price/get_heading",
                type: "POST",
                async: true,
                data: {id: newspaper},
                beforeSend: function () {
                    document.getElementById("loader").style.display = "block";
                },
                success: function (data)
                {

                    $('#ad_cat').empty();

                    if (data == "[]")
                    {
                        alert("First attach heading with newspaper.");
                    }

                    //$('#ad_cat').append('<option value="">Choose One</option>');
                    // Parse the returned json data
                    var opts = $.parseJSON(data);
                    // Use jQuery's each to iterate over the opts value
                    $.each(opts, function (i, d) {
                        // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data					
                        $('#ad_cat').append('<option value="' + d.cat_id + '" >' + d.cat_name + '</option>');
                    });
                },
                complete: function ()
                {
                    sel_update();
                },
                error: function ()
                {
                    document.getElementById("loader").style.display = "none";
                    alert("Please Select Newspaper!");
                }
            });
            //setTimeout(sel_update, 500);
        }

        function get_heading1()
        {
            var newspaper = $("#newspaper").val();
            if (newspaper != '')
            {
                window.location.assign("<?php echo base_url(); ?>admin/price/add/" + newspaper)
            }
        }

        function get_city1()
        {
            //alert("Please Select Newspaper!");
            var newspaper = $("#newspaper").val();
            $.ajax({
                url: "<?php echo base_url(); ?>" + "admin/price/get_city",
                type: "POST",
                async: true,
                data: {newspaper_id: newspaper},
                success: function (data)
                {
                    $('#city').empty();
                    // Parse the returned json data
                    var opts = $.parseJSON(data);
                    // Use jQuery's each to iterate over the opts value
                    $.each(opts, function (i, d) {
                        // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                        $('#city').append('<option value="' + d + '">' + d + '</option>');
                    });
                },
                error: function ()
                {
                    alert("Please Select Newspaper!");
                }
            });

        }
        /*
         $(document).ready(function (){
     
         var newspaper = $("#newspaper").val();
         if(newspaper != '')
         {
         get_city(); 
         }	
         });
         */

       // $("#date_f").datepicker({minDate: 0});
	   $("#date_f").datepicker();

    //$("#date_t").datepicker({});


        function sel_update()
        {
            $("#ad_cat").trigger("chosen:updated");
            document.getElementById("loader").style.display = "none";
        }
        
$('#all_day').click(function()
{
    if ($('#all_day').is(":checked"))
    {
        $('#day option').prop('selected', true);  
        $('#day').trigger('chosen:updated');
    }
    else
    {
        $('#day option').prop('selected', false);  
        $('#day').trigger('chosen:updated');
    }


});

    </script>