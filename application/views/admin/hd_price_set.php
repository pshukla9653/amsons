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
                        echo form_open('admin/hd_price/add', $attributes)
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
                            <select id="newspaper" name="newspaper" class="select-chosen"  onchange="get_heading();" data-placeholder="Choose Newspaper" required>
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
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Ad Day</label>
                        <div class="col-md-9">
                            <select id="day" name="days[]" class="select-chosen"  data-placeholder="Choose Ad day"  multiple required>
                                <?php foreach ($days as $day) { ?>
                                            <option value="<?php echo $day->id; ?>"><?php echo $day->day; ?></option>
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
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Color Type</label>
                        <div class="col-md-9">
                            <select id="color" name="color" class="form-control" data-placeholder="" required>
                                <option value="">Choose one</option>
                                <option value="A">Any Color</option>
                                <option value="B">Black/White</option>
                                <option value="C">Color</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Insertion From</label>
                        <div class="col-md-9">
                            <input type="number"  onkeyup="inse_to();"  onchange="inse_to();" placeholder=""  min="1" class="form-control" name="ins_from" id="ins_from" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Insertion To</label>
                        <div class="col-md-9">
                            <input type="number" placeholder="" class="form-control" min="1" name="ins_to" id="ins_to" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Duration</label>
                        <div class="col-md-4">
                            <input type="text" placeholder="" class="form-control" name="duration" id="duration">
                        </div>
                        <div class="col-md-5">
                            <select id="dur_type" name="dur_type" class="form-control" data-placeholder="" style="width: 250px;" >
                                <option value="D">Days</option>
                                <option value="W">Weeks</option>
                                <option value="M">Months</option>
                                <option value="Y">Years</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Size</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" class="form-control" name="size" id="size">
                        </div>						
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Date From</label>
                        <div class="col-md-9">
                            <input type="text" id="date_f" name="date_f" value="<?php echo set_value('date_f'); ?>" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
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
                        <label class="col-md-3 control-label">Fix Price</label>
                        <div class="col-md-3">
                            <label class="switch switch-primary">
                                <input type="checkbox" onchange="fix_s();" unchecked name="fix_p" id="fix_p">
                                <span></span>
                            </label>
                        </div>						
                    </div>
                    <div id="fix_s" style="display: none;">
                        <div class="form-group">
                            <label for="price" class="col-md-3 control-label">Fix Size</label>
                            <div class="col-md-2 control-label">								
                            </div>
                            <div class="col-md-3">
                                <input type="text" placeholder="" class="form-control" name="f_min_l" id="f_min_l">
                            </div>
                            <div class="col-md-1 control-label">
                                X
                            </div>
                            <div class="col-md-3">
                                <input type="text" placeholder="" class="form-control" name="f_min_r" id="f_min_r">
                            </div>
                        </div>						
                    </div>
                    <div id="single_c">
                        <div class="form-group">
                            <label for="price" class="col-md-3 control-label">Single Column</label>
                            <div class="col-md-2 control-label">
                                MIN
                            </div>
                            <div class="col-md-3">
                                <input type="text" placeholder="" class="form-control" name="s_min_l" id="s_min_l" >
                            </div>
                            <div class="col-md-1 control-label">
                                X
                            </div>
                            <div class="col-md-3">
                                <input type="text" placeholder="" class="form-control" name="s_min_r" id="s_min_r">
                            </div>
                        </div>					
                        <div class="form-group">
                            <label for="price" class="col-md-3 control-label"></label>
                            <div class="col-md-2 control-label">
                                Max
                            </div>
                            <div class="col-md-3">
                                <input type="text" placeholder="" class="form-control" name="s_max_l" id="s_max_l">
                            </div>
                            <div class="col-md-1 control-label">
                                X
                            </div>
                            <div class="col-md-3">
                                <input type="text" placeholder="" class="form-control" name="s_max_r" id="s_max_r">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Unit Type</label>
                        <div class="col-md-9">
                            <select id="unit" name="unit" class="form-control" data-placeholder="" required>
                                <option value="">Choose one</option>
                                <option value="SC">SQCM</option>
                                <option value="CC">PCC</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Price</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" class="form-control" name="price" id="price" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Bargaining Price</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" class="form-control" name="bprice" id="bprice">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Fix Price</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" class="form-control" name="fprice" id="fprice">
                        </div>
                    </div>
                    <!--<div class="form-group">
                            <label for="price" class="col-md-3 control-label">Extra Price</label>
                            <div class="col-md-9">
                                    <input type="text" placeholder="" class="form-control" name="eprice" id="eprice" required>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Discount</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" class="form-control" name="dis" id="dis" >
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label">Discount %</label>
                        <div class="col-md-2">
                            <input type="number" min="0" placeholder="0"  class="form-control" name="comm1" id="comm1" value="0">
                        </div>
                        <div class="col-md-2">
                            <input type="number" min="0" placeholder="0"  class="form-control" name="comm2" id="comm2" value="0">
                        </div>
                        <div class="col-md-2">
                            <input type="number" min="0" placeholder="0"  class="form-control" name="comm3" id="comm3" value="0">
                        </div>
                        <div class="col-md-2">
                            <input type="number" min="0" placeholder="0" class="form-control" name="comm4" id="comm4" value="0">
                        </div>
                    </div>					
                    <!--	<div class="form-group">
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
                                                    <option value="1">ADD</option>
                                                    <option value="2">Multiple</option>
                </select>
            </div>
        </div>-->
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Non Focus Day Charges</label>
                        <div class="col-md-5">
                            <input type="number" step="any" min="0" value="0" placeholder="" class="form-control" name="nfdc" id="nfdc" >
                        </div>
                        <div class="col-md-4">
                            <select id="nfdct" name="nfdct" class="form-control" data-placeholder="" style="width: 250px;" >								
                                <option value="Rs">Rs.</option>
                                <option value="%">%</option>
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
                url: "<?php echo base_url(); ?>" + "admin/hd_price/get_heading",
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
                        $('#ad_cat').append('<option value="' + d.id + '" >' + d.position + '</option>');
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


        function fix_s()
        {
            var y = document.getElementById('single_c');
            var z = document.getElementById('fix_s');

            if ($('#fix_p').is(":checked"))
            {
                z.style.display = 'block';
                y.style.display = 'none';
            } else
            {
                z.style.display = 'none';
                y.style.display = 'block';
            }
        }

        function sel_update()
        {
            $("#ad_cat").trigger("chosen:updated");
            document.getElementById("loader").style.display = "none";
        }



    //$("#date_f").datepicker({minDate: 0});
        $("#date_f").datepicker();

          
        
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