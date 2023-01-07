<style>

    .form-bordered .form-group {

    margin: 0;

    border: none;

    padding: 5px 0px;

    border-bottom: 1px dashed #eaedf1;

}

label.col-md-3.control-label {

    font-size: 13px;

    text-align: left;

    padding: 4px 0px;

}

label.col-md-5.control-label {

    font-size: 13px;

    text-align: left;

    padding: 4px 0px;

}

label.col-md-4.control-label {

    text-align: left;

    padding: 4px 0px;

    font-size: 13px;

}

.right-side {

    width: 40%;

    float: left;

}

.left-side {

    width: 60%;

    float: left;

}

label.col-md-6.control-label {

    text-align: left;

    padding: 0;

}

</style>

<div id="page-content" style="min-height: 1189px;">

    <!-- Product Edit Content -->

    <div class="row">

    

    <?php 

                    $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'ro_add');

                    echo form_open_multipart('admin/display_ro/add', $attributes); ?>

                    <?php

                    echo "<div class='text-danger'>";

                    echo validation_errors();

                    echo $this->session->flashdata('msg');

                    echo "</div>";

    ?>

    

        <div class="col-lg-6">

            <!-- General Data Block -->

            <div class="block">

                <!-- General Data Title -->

                <div class="block-title">

                    <h2>

                        <i class="fa fa-pencil"></i>

                        <strong>New CD Ro Booking</strong>

                    </h2>

                </div>

                <!-- END General Data Title -->

                <!-- General Data Content -->

                    <div class="form-group">

                        <label class="col-md-3 control-label" for="example-chosen-multiple">Bill To <span class="text-danger">*</span></label>

                        <div class="col-md-9">

                            <select id="client" name="client"  onchange="get_client(); get_agencies();"  style="width:100%;" class="js-example-basic-single" data-placeholder="Choose Classes" required>

                                <option value="" >Select Client</option>

                                <?php foreach($clients as $client){ ?>

                                        <option value="<?php echo $client->id; ?>"><?php echo $client->client_name; ?></option>

                                <?php }?>

                            </select>

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="pack-price" class="col-md-3 control-label">Client Name</label>

                        <div class="col-md-9">

                            <input type="text" placeholder="" class="form-control" name="party" id="party" >

                        </div>

                    </div>

                    <div class="form-group">

                          <div class="left-side">

                        <label class="col-md-5 control-label" for="example-chosen-multiple">Publication  Newspaper <span class="text-danger">*</span></label>

                        <div class="col-md-7">

                            <select id="newspaper" name="newspaper"   style="width:100%;" class="js-example-basic-single" data-placeholder="Choose Newspaper" onchange="get_state();" required>                         

                                <option value="">Choose One </option>

                                <?php foreach($newspapers as $newspaper){ ?>

                                        <option value="<?php echo $newspaper->id; ?>"><?php echo $newspaper->newspaper_name .",".$newspaper->city_name; ?></option>

                                <?php }?>

                            </select>

                        </div>

                    </div>

                      <div class="right-side">

                        <label class="col-md-3 control-label" for="example-chosen-multiple">Select City <span class="text-danger">*</span></label>

                        <div class="col-md-9">

                            <select id="state" name="state_id" class="form-control" data-placeholder="Choose State" required>

                                <option value="" >Select State</option>

                            </select>

                        </div>

                    </div>

                </div>

                <div class="form-group">

                    <label class="col-md-3 control-label" for="example-chosen-multiple">Indirect Publication Party</label>

                    <div class="col-md-9">



                            <select name="pub_id"  id="pub_id" class="form-control" onLoad="get_agencies();" data-placeholder="Choose Classes">



                                <option value="" >Select One</option>



                                



                            </select>



                        </div>

                </div>

                    <div class="form-group">

                         <div class="left-side">

                        <label class="col-md-5 control-label">Add On</label>

                        <div class="col-md-7">

                            <label class="switch switch-primary">

                                <input type="checkbox" onchange="add_paper();" unchecked name="add_on" id="add_on">

                                <span></span>

                            </label>

                        </div>

                        <!--<div id="dc_b">

                            <label class="col-md-3 control-label">Double Column</label>

                            <div class="col-md-3">

                                <label class="switch switch-primary">

                                    <input type="checkbox" onchange="double_column();" unchecked name="dc" id="dc">

                                    <span></span>

                                </label>

                            </div>

                        </div>-->

                    </div>

                    <div id="add_on_paper" style="display: none;">

                        <div class="form-group">

                            <label class="col-md-3 control-label" for="example-chosen-multiple">Add On Newspaper</label>

                            <div class="col-md-9">

                                <select id="a_newspaper" name="a_newspaper[]" class="select-chosen"  data-placeholder="Choose Newspaper" multiple>

                                </select>

                            </div>

                        </div>

                    </div>

                    <!--<div class="form-group">

                        <label class="col-md-3 control-label" for="example-chosen-multiple">Publication  City *</label>

                        <div class="col-md-9">

                            <select id="city" name="city" class="form-control" data-placeholder="Choose City" required>

                                <option value="">Choose City</option>

                            </select>

                        </div>

                    </div>-->

                     <div class="right-side">

                        <label class="col-md-3 control-label" for="example-chosen-multiple">Ad Heading <span class="text-danger">*</span></label>

                        <div class="col-md-9">

                            <select id="cat" name="cat" class="form-control" onchange="get_sub_heading();" data-placeholder="Choose heading" required>

                                <option value="">Choose One</option>

                            </select>

                        </div>

                    </div>  

                    </div>              

                    <div class="form-group">

                         <div class="left-side">

                        <label class="col-md-5 control-label" for="example-chosen-multiple">Sub Heading <span class="text-danger">*</span></label>

                        <div class="col-md-7">

                            <select id="sheading" name="sheading"   class="form-control" data-placeholder="Choose one" required>

                                <option value="">Sub Heading</option>

                            </select>

                        </div>

                    </div>

                     <div class="right-side">

                        <label class="col-md-3 control-label" for="example-chosen-multiple">Color Type</label>

                        <div class="col-md-9">

                            <select id="color" name="color" onchange="get_size1()" class="form-control" data-placeholder="" required>

                                <option value="">Choose one</option>

                                <option value="A">Any Color</option>

                                <option value="B">Black/White</option>

                                <option value="C">Color</option>

                            </select>

                        </div>

                    </div>

                </div>

                <!--    <div class="form-group">

                        <label class="col-md-3 control-label">Column</label>

                        <div class="col-md-9 ">

                            <label class="radio-inline">

                                <input type="radio" id="column_type1" name="column_type" value="S" checked> Single Column

                            </label>

                            <label class="radio-inline">

                                 <input type="radio" id="column_type2" name="column_type" value="D"> Double Column

                            </label>                            

                        </div>

                    </div>-->

                   <!-- <div id="add_on_units" style="display:none;">

                    <div class="form-group">

                        <label for="size" class="col-md-3 control-label">No.of Units *</label>

                        <div class="col-md-9">

                            <input type="text" placeholder=""  class="form-control" name="size" id="size" required>

                        </div>

                    </div>

                    </div>-->

                    <div class="form-group">

                         <div class="left-side">

                        <label for="pack-price" class="col-md-5 control-label">Insertion </label>

                        <div class="col-md-7">

                            <input type="number" autocomplete="off"  onblur="date_pic1();" min="1" placeholder="" class="form-control" name="inse" id="inse" required>

                        </div>

                    </div>                  

                    <!--

                    <div class="form-group">

                        <label for="pack-price" class="col-md-3 control-label">Package</label>

                        <div class="col-md-9">

                            <input type="text" placeholder="" class="form-control" name="pack" id="pack">

                        </div>

                    </div> -->

                    

                     <div class="right-side">

                        <label class="col-md-3 control-label" for="example-chosen-multiple">Scheme </label>

                        <div class="col-md-9">

                            <select id="scheme" name="scheme" onchange="get_scheme_price();"  class="form-control" data-placeholder="Choose one">

                                <option value="">Scheme</option>

                            </select>

                        </div>

                    </div>

                </div>

                    <div class="form-group">

                         <div class="left-side">

                        <label for="pack-price" class="col-md-5 control-label">Material</label>

                        <div class="col-md-7">

                            <input type="text" placeholder="" class="form-control" name="material" id="material" >

                        </div>

                    </div>

                     <div class="right-side">

                        <label for="pack-price" class="col-md-3 control-label">Box</label>

                        <div class="col-md-9">

                            <input type="text" placeholder="" class="form-control" name="box" id="box" >

                        </div>

                    </div>

                </div>

                    <div class="form-group">

                        <label for="pack-price" class="col-md-3 control-label">Matter</label>

                        <div class="col-md-9">

                            <input type="text" placeholder="" class="form-control" name="matter" id="matter" >

                        </div>

                    </div>

                    <!--<div class="form-group">

                        <label class="col-md-3 control-label" for="example-chosen-multiple">Premimum</label>

                        <div class="col-md-9">

                            <div id="premimum123">

                                

                            </div>

                        </div>

                    </div>-->                                   

                    <div class="form-group">

                        <label for="pack-price" class="col-md-3 control-label">Size *</label>

                        <div class="col-md-2">

                            <input type="text" placeholder="" onchange="get_size(); " class="form-control" name="size_l" id="size_l" required>

                        </div>

                        <div class="col-md-1 control-label">

                            X

                        </div>

                        <div class="col-md-2">

                            <input type="text" placeholder=""  class="form-control" name="size_r" id="size_r" required>

                        </div>

                        <div class="col-md-4">

                            <select id="unit" name="unit" class="form-control" data-placeholder="" required>

                                <option value="">Choose</option>

                                <option value="SC">SQCM</option>

                                <option value="CC">PCC</option>

                            </select>

                        </div>

                    </div>                  

                    <div class="form-group">

                        <label class="col-md-3 control-label" for="example-chosen-multiple">Package</label>

                        <div class="col-md-9">

                            <select id="pack" name="pack" onchange="get_pack_price();"   class="form-control" data-placeholder="Choose one">

                                <option value="">Package</option>

                            </select>

                        </div>

                    </div>

                    <!-- END General Data Content -->

            </div>

            <!-- END General Data Block -->

        </div>

        <div class="col-lg-6">

            <!-- General Data Block -->

            <div class="block"  style="background-color:#dbe1e8;">

                <!-- General Data Title -->

                <div class="block-title">

                    <h2>

                        <i class="fa fa-pencil"></i>

                        <strong>Rate</strong>

                    </h2>

                </div>

                <!-- END General Data Title -->

                <!-- General Data Content -->

                    <div style="background-color:#CECECE; height: 120px; overflow-y: scroll;">                      

                        <div id="base_p_date">

                            <div class="form-group">

                                <label for="pack-price" class="col-md-6 control-label">Main Paper Publish Dates <span class="text-danger">*</span></label>

                                <div class="col-md-6">

                                    <div class="box"  id="from--input">

                                        <input class="form-control" name="p_date" type="text" id="from-input" onblur="get_dop_price();"data-id="" data-toggle="modal" data-target="#dopModal" placeholder="mm/dd/yyyy, ...">

                                    </div>

                                    <div class="code-box"></div>

                                </div>

                            </div>

                        </div>                      

                        <div id="pub_dates">

                            

                        </div>

                        <div id="pack_pub_dates">

                            

                        </div>

                        <div id="add_base_dates">

                            

                        </div>

                        <div id="add_pub_dates">

                            

                        </div>

                        <div id="pack_rate" style="display: none;">

                            <div class="title" style="background-color:#fff;"><i class="fa fa-money"></i><strong> Rate Of Package</strong></div>

                            <div class="form-group">

                                <label for="pack-price" class="col-md-3 control-label">Rate</label>

                                <div class="col-md-3">

                                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate" id="rate">

                                </div>

                                <label for="pack-price" class="col-md-3 control-label">B Rate</label>

                                <div class="col-md-3">

                                    <input type="text" placeholder="" class="form-control" name="brate" id="brate">

                                </div>

                            </div>

                        <!--    <div class="form-group">

                                <label for="pack-price" class="col-md-3 control-label">B Rate</label>

                                <div class="col-md-3">

                                    <input type="text" placeholder="" class="form-control" name="brate" id="brate">

                                </div>

                                <label for="pack-price" class="col-md-3 control-label"></label>

                                <div class="col-md-3">

                                    <div class="btn btn-sm btn-primary" onclick="get_pack_price();">

                                    Refresh Rate

                                    </div>

                                </div>

                            </div>  -->                     

                        </div>

                        <!--

                        <div class="form-group">

                            <label for="pack-price" class="col-md-3 control-label">Rate</label>

                            <div class="col-md-3">

                                <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate" id="rate">

                            </div>

                            <label for="pack-price" class="col-md-3 control-label">Extra Charges</label>

                            <div class="col-md-3">

                                <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="erate" id="erate">

                            </div>

                        </div>

                        <div class="form-group">

                            <label for="pack-price" class="col-md-3 control-label">B Rate</label>

                            <div class="col-md-3">

                                <input type="text" placeholder="" class="form-control" name="brate" id="brate">

                            </div>

                            <label for="pack-price" class="col-md-3 control-label">Multi Rate</label>

                            <div class="col-md-3">

                                <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="mrate" id="mrate">

                            </div>

                        </div>

                        <div class="form-group">

                            <label for="pack-price" class="col-md-3 control-label">Multi Ex. Rate</label>

                            <div class="col-md-3">

                                <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="merate" id="merate">

                            </div>

                            <label for="pack-price" class="col-md-3 control-label"></label>

                            <div class="col-md-3">

                                <div class="btn btn-sm btn-primary" onclick="get_price();">

                                    Refresh Rate

                                </div>

                            </div>

                        </div>-->

                        <div id="ad_on_rate">

                        

                        </div>

                    </div>

                    <div class="form-group">

                        <!--<label class="col-md-3 control-label">Other Dates Follows</label>

                        <div class="col-md-3">

                            <label class="switch switch-primary">

                                <input type="checkbox" unchecked name="odf" id="odf">

                                <span></span>

                            </label>

                        </div>-->

                        <div id="dc_b">

                            <label class="col-md-3 control-label">Same Dates To All</label>

                            <div class="col-md-3">

                                <label class="switch switch-primary">

                                    <input type="checkbox" unchecked name="sdta" id="sdta">

                                    <span></span>

                                </label>

                            </div>

                            <label class="col-md-3 control-label">Other Dates Follows</label>

                            <div class="col-md-3">

                                <label class="switch switch-primary">

                                    <input type="checkbox" unchecked name="odf" id="odf" onchange="get_dop_price();">

                                    <span></span>

                                </label>

                            </div>

                        </div>

                    </div>

                    

                    <div class="form-group">

                        <label for="name" class="col-md-3 control-label">Commission %</label>

                        <div class="col-md-2">

                            <input type="text" min="0" placeholder="0" onchange="commission();" class="form-control" name="comm1" id="comm1">

                        </div>

                        <div class="col-md-2">

                            <input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm2" id="comm2">

                        </div>

                        <div class="col-md-2">

                            <input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm3" id="comm3">

                        </div>

                        <div class="col-md-2">

                            <input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm4" id="comm4">

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="name" class="col-md-3 control-label"></label>

                        <div class="col-md-2">

                            <input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm5" id="comm5">

                        </div>

                        <div class="col-md-2">

                            <input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm6" id="comm6">

                        </div>

                        <div class="col-md-2">

                            <input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm7" id="comm7">

                        </div>

                        <div class="col-md-2">

                            <input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm8" id="comm8">

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="pack-price" class="col-md-3 control-label">Discount %</label>

                        <div class="col-md-9">

                            <input type="text" min="0" placeholder="" value="0" class="form-control" name="dis" id="dis" required>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-md-3 control-label" for="example-chosen-multiple">Premimum</label>

                        <div class="col-md-9">

                            <select id="premimum" name="premimum" onchange="get_premimum_price();"   class="select-chosen" data-placeholder="Choose one" multiple>

                            </select>

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="pack-price" class="col-md-3 control-label">Amount</label>

                        <div class="col-md-3">

                            <input type="text" min="0" placeholder=""  value="0" onchange="amount_calculate();" class="form-control" name="amount" id="amount">

                        </div>

                        <label for="pack-price" class="col-md-3 control-label">Premimum</label>

                        <div class="col-md-3">

                            <input type="text" min="0"  value="0" onchange="amount_calculate();" placeholder="" class="form-control" name="premimum_a" id="premimum_a">

                        </div>                      

                    </div>

                    <div class="form-group">

                        <label for="pack-price" class="col-md-3 control-label">Exter Charges</label>

                        <div class="col-md-3">

                            <input type="text" min="0"  value="0" onchange="amount_calculate();" placeholder="" class="form-control" name="eca" id="eca">

                        </div>

                        <label for="pack-price" class="col-md-3 control-label">Non Focusing Day Charge </label>

                        <div class="col-md-3">

                            <input type="text" min="0"  value="0" onchange="amount_calculate();" placeholder="" class="form-control" name="nfdc" id="nfdc">

                        </div>                      

                    </div>

                    <div class="form-group">

                        <label for="pack-price" class="col-md-3 control-label">Add On Amount</label>

                        <div class="col-md-3">

                            <input type="text" min="0" value="0"  onchange="amount_calculate();" placeholder="" class="form-control" name="add_a" id="add_a">

                        </div>

                        <label for="pack-price" class="col-md-3 control-label">Total Amount</label>

                        <div class="col-md-3">

                            <input type="text" min="0" value="0"  onchange="amount_calculate();" placeholder="" class="form-control" name="t_amount" id="t_amount">

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="pack-price" class="col-md-3 control-label">Box Charges</label>

                        <div class="col-md-3">

                            <input type="text" min="0" value="0"  onchange="amount_calculate();" placeholder="" class="form-control" name="box_c" id="box_c">

                        </div>

                        <label for="pack-price" class="col-md-3 control-label">Discount Amount</label>

                        <div class="col-md-3">

                            <input type="text" min="0" value="0"  onchange="amount_calculate();" placeholder="" class="form-control" name="dis_a" id="dis_a">

                        </div>                      

                    </div>

                    <div class="form-group">

                        <label for="pack-price" class="col-md-3 control-label">Taxable Amount</label>

                        <div class="col-md-9">

                            

                            <input type="text" value="0" placeholder="" class="form-control" name="taxable_amount" id="taxable_amount">

                        </div>

                    </div>

                        <div class="form-group">

                        <label for="pack-price" class="col-md-3 control-label">IGST</label>

                        <div class="col-md-9">

                            <input type="hidden" id="gst" value="0">

                            <input type="text" min="0" value="0" placeholder="" class="form-control" name="igst" id="igst">

                        </div>                      

                    </div>

                    <div class="form-group">

                        <label for="pack-price" class="col-md-3 control-label">CGST</label>

                        <div class="col-md-3">

                            <input type="text" min="0" value="0" placeholder="" class="form-control" name="cgst" id="cgst">

                        </div>

                        <label for="pack-price" class="col-md-3 control-label">SGST</label>

                        <div class="col-md-3">

                            <input type="text" min="0" value="0" placeholder="" class="form-control" name="sgst" id="sgst">

                        </div>                      

                    </div>

                    <div class="form-group">                        

                        <label for="pack-price" class="col-md-3 control-label">Payable Amount</label>

                        <div class="col-md-9">

                            <input type="text" value="0" step="any" min="0"  onchange="amount_calculate();" placeholder="" class="form-control" name="p_amount" id="p_amount">

                        </div>                      

                    </div>

                    

                    

                    

                    

                    <!--<div class="form-group">

                        <label for="example-file-input" class="col-md-3 control-label">Tax</label>

                        <div class="col-md-9">

                            <input type="file" name="logo" size="20">

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-md-3 control-label">Active?</label>

                        <div class="col-md-9">

                            <label class="switch switch-primary">

                                <input type="checkbox" checked="" name="status" id="status">

                                <span></span>

                            </label>

                        </div>

                    </div>-->

                    <div class="form-group">

                        <div class="col-md-9 col-md-offset-3">

                            <div class="btn btn-sm btn-primary" onclick="get_premimum_price();">

                                    Calculate Rate

                            </div>

                            <input class="btn btn-sm btn-primary" type="button"  id="save" value="Save" onclick="save_ro();">

                            <button class="btn btn-sm btn-warning" type="reset">

                                <i class="fa fa-repeat"></i> Reset

                            </button>                           

                        </div>

                    </div>

                    <div class="form-group">

                        <div id="msg" class="col-md-9 col-md-offset-3 text-success">

                            

                        </div>

                    </div>

                

                    <!-- END General Data Content -->

            </div>

            <!-- END General Data Block -->

        </div>

    <!-- END Product Edit Content -->

    </form>

</div>

    <!-- Modal -->

  <div class="modal fade" id="dopModal" role="dialog">

    <div class="modal-dialog">    

      <!-- Modal content-->

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Enter DOP</h4>

        </div>

       

        <div class="modal-body">

         <input   type="text" name="date_dop" id="name_dop" class="form-control input-datepicker-close" onchange="add_date1();" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">

        <input type="hidden" name="hiddenValue" id="hiddenValue" value="" />

         <div>

             <input type="checkbox" name="daily" id="daily" unchecked onchange="add_date();" ><label for="daily">Daily</label>

             <input type="checkbox" name="after" id="after" onchange="alert("enter days");"><label for="after">After</label><input type="number" name ="days" id="days" onchange="add_date();"><label for="days">Days</label> 

              <input type="checkbox" name="weekly" id="weekly" unchecked onchange="add_date();" ><label for="weekly">Weekly</label>

               <input type="checkbox" name="monthly" id="monthly" unchecked onchange="add_date();" ><label for="monthly">Monthly</label>

               <input type="checkbox" name="yearly" id="yearly" unchecked onchange="add_date();" ><label for="yearly">yearly</label>

               <input type="checkbox" name="odf1" id="odf1" unchecked onchange="add_date();" ><label for="odf1">Other Days follow</label>

               <input type="checkbox" name="same_day" id="same_day" unchecked onchange="add_date();" ><label for="same_day">Same days</label>

             </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>

      </div>

      

    </div>

  </div>

  <!-- Modal End-->     

<div class="block full">

        <!-- All Products Title -->

        <div class="block-title">

            <!--<div class="block-options pull-right">

                <a title="" data-toggle="tooltip" class="btn btn-alt btn-sm btn-default" href="javascript:void(0)" data-original-title="Settings">

                    <i class="fa fa-cog"></i>

                </a>

            </div>-->

            <h2>

                <strong>Book</strong> Ads           

            </h2>

            <a href="<?php echo base_url()?>admin/display_ro"><div class="btn btn-sm btn-primary" style="float: right; margin-right: 10px; margin-top: 5px;">

                <i class="fa fa-bars"></i> See All Ros

            </div></a>

        </div>

        <h2>

            <?php echo $this->session->flashdata('msg'); ?>         

        </h2>

        <!-- END All Products Title -->

        <!-- All Products Content -->

        <div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">

                    <thead>

                        <tr role="row">

                            <th class="text-center" >ID</th>

                            <th class="text-center" style="width: 100px;">Newspaper</th>

                            <th class="text-center" style="width: 100px;">Type</th>

                            <th class="text-center" style="width: 150px;" >Category</th>

                            <th class="text-center" style="width: 150px;" >Ad Cost</th>

                            <th class="text-center" style="width: 150px;" >Ad Days</th>

                            <th class="text-center" style="width: 150px;" >User</th>

                        </tr>

                    </thead>

                    <tbody>

                        

                    </tbody>

                </table>

                </div>

            </div>

            <!-- END All Products Content -->

            

        </div>  


<script type="text/javascript">

 function get_size1()
    {
                    $('#size_l').val('');
                                        $('#size_r').val('');
        var cat = $("#cat").val();
        var newspaper = $("#newspaper").val();
        var color = $("#color").val();
     
        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/hd_ro/get_size",
            type: "POST",				
            async: true ,   
            dataType: "json",
            data: {cat:cat,color:color,newspaper:newspaper},
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                document.getElementById("loader").style.display = "none";
                console.log(data.unit);
            $('#size_l').val(data.f_min_l);
            $('#size_r').val(data.f_min_r);
            $('#unit').val(data.unit);
            },
            complete: function() 
            {               
            },
            error: function() 
            {
				
            }
        });
    } 
 
 
    

    $(function () {

        var d = new Date();

           var currMonth = d.getMonth();

           var currYear = d.getFullYear();

           var currDate = d.getDate

           var startDate = new Date(currYear, currMonth, currDate);



           $("#name_dop").datepicker();

           $("#name_dop").datepicker("setDate", startDate);

       

    });

</script>

<script  type="text/javascript">

var days =[9,9,9,9,9,9,9];

var min_w=0;

var datarate=[];

var s_min_l=0;

var s_min_r=0;

var s_max_l=0;

var s_max_r=0;

 var My_id =0;

 var premimum_type="";



var premimum_value=0;

var nfdc=[0,''];

  var free_days=0;

        var inse_dop =0;



var size_type="";

    function add_date1()

      { 

          

                  

           var inse =$("#inse").val();

         

          var id = My_id;

         

          var date = new Date($("#name_dop").val());

         

         var td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

         if($("#add_on").is(":checked"))

         {

               

                    var d=$("#name_dop").val();

                    var v = $("#from-input"+id).val();

                         if(v !="")

                         {

                          var dates = v.split(", ");

                      

                          var count = dates.length;

                         // alert(count);

                         }

                         else

                         {

                             var count =0;

                         }

                         if(count == inse)

                         {

                             alert("you can not enter more dates");

                             // $("#name_dop").val(""); 

                         }

                         else

                         {

                                  if($("#from-input"+id).val() == "")

                                  {

                                     $("#from-input"+id).val(function() {

                                    return this.value + d;

                                 

                                         });

                                  }

                                  else

                                  {

                                          $("#from-input"+id).val(function() {

                                       return this.value +', '+ d;

                                   

                                         });

                          }

                        // $("#name_dop").val(""); 

                        

                         }



           

         }

         else if($("#pack").val()!="")

         {

                var d=$("#name_dop").val();

                    var v = $("#from-input"+id).val();

                         if(v !="")

                         {

                          var dates = v.split(", ");

                      

                          var count = dates.length;

                         // alert(count);

                         }

                         else

                         {

                             var count =0;

                         }

                         if(count == inse)

                         {

                             alert("you can not enter more dates");

                             // $("#name_dop").val(""); 

                         }

                         else

                         {

                                  if($("#from-input"+id).val() == "")

                                  {

                                     $("#from-input"+id).val(function() {

                                    return this.value + d;

                                 

                                         });

                                  }

                                  else

                                  {

                                          $("#from-input"+id).val(function() {

                                       return this.value +', '+ d;

                                   

                                         });

                          }

                        // $("#name_dop").val(""); 

                        

                         }

         }

        else

        {

                 

                    var d=$("#name_dop").val();

                    var v = $("#from-input").val();

                   

                         if(v!="")

                         {

                          var dates = v.split(", ");

                      

                          var count = dates.length;

                        

                         }

                         else

                         {

                             var count =0;

                         }

                         if(count == inse)

                         {

                             alert("you can not enter more dates");

                           

                         }

                         else

                         {

                                  if($("#from-input").val() == "")

                                  {

                                     $("#from-input").val(function() {

                                    return this.value + d;

                                 

                                         });

                                  }

                                  else

                                  {

                                          $("#from-input").val(function() {

                                       return this.value +', '+ d;

                                   

                                         });

                          }

                      

                        

                         }



              

        }

      }

function add_date(id=null)

      {

         var inse =$("#inse").val();

         

          var id = My_id;

        

        

          var date = new Date($("#name_dop").val());

         

         var td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

         if($("#add_on").is(":checked"))

         {

             //var data = $("#from-input"+id).val("");

            // alert(data.length);

             

           if($("#daily").is(":checked"))

              {

                   

                    $("#from-input"+id).val("");

                    for(i=0;i<inse;i++)

                    { 

                       // $("#from-input"+id).val("");

                        if($("#from-input"+id).val() == "")

                          {

                         $("#from-input"+id).val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input"+id).val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                          date.setDate(date.getDate()+1);

                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

                }

            else  if($("#after").is(":checked"))

              {

                  var day =parseInt($("#days").val());

                  

                   $("#from-input"+id).val("");

                    for(i=0;i<inse;i++)

                    { 

                      

                        if($("#from-input"+id).val() == "")

                          {

                         $("#from-input"+id).val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input"+id).val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                           date.setDate(date.getDate()+day);

                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

              }

              else  if($("#weekly").is(":checked"))

              {

                  

                   $("#from-input"+id).val("");

                    for(i=0;i<inse;i++)

                    { 

                      

                        if($("#from-input"+id).val() == "")

                          {

                         $("#from-input"+id).val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input"+id).val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                           date.setDate(date.getDate()+7);

                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

              }

              else  if($("#monthly").is(":checked"))

              {

                 

                   $("#from-input"+id).val("");

                    for(i=0;i<inse;i++)

                    { 

                       // $("#from-input"+id).val("");

                        if($("#from-input"+id).val() == "")

                          {

                         $("#from-input"+id).val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input"+id).val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                           date.setMonth(date.getMonth() + 1);

                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

              }

              else  if($("#yearly").is(":checked"))

              {

                 

                   $("#from-input"+id).val("");

                    for(i=0;i<inse;i++)

                    { 

                       // $("#from-input"+id).val("");

                        if($("#from-input"+id).val() == "")

                          {

                         $("#from-input"+id).val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input"+id).val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                           date.setFullYear(date.getFullYear()+1);

                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

              }

              else if($("#same_day").is(":checked"))

              {

                 ("#from-input"+id).val("");

                 for(i=0;i<inse;i++)

                    { 

                       // $("#from-input"+id).val("");

                        if($("#from-input"+id).val() == "")

                          {

                         $("#from-input"+id).val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input"+id).val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                         //  date.setDate(date.getFullYear()+1);

                          // td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    } 

                }

                else  if($("#odf1").is(":checked"))

              {

                   

                  odf=1;

                  $("#odf").prop("checked",true);

              }

              else

              {

                   

                    var d=$("#name_dop").val();

                    var v = $("#from-input"+id).val();

                         if(v !="")

                         {

                          var dates = v.split(", ");

                      

                          var count = dates.length;

                         // alert(count);

                         }

                         else

                         {

                             var count =0;

                         }

                         if(count == inse)

                         {

                             alert("you can not enter more dates");

                             // $("#name_dop").val(""); 

                         }

                         else

                         {

                                  if($("#from-input"+id).val() == "")

                                  {

                                     $("#from-input"+id).val(function() {

                                    return this.value + d;

                                 

                                         });

                                  }

                                  else

                                  {

                                          $("#from-input"+id).val(function() {

                                       return this.value +', '+ d;

                                   

                                         });

                          }

                        // $("#name_dop").val(""); 

                        

                         }



              }

         }

          else if($("#pack").val()!="")

         {

             //var data = $("#from-input"+id).val("");

            // alert(data.length);

             

           if($("#daily").is(":checked"))

              {

                   

                    $("#from-input"+id).val("");

                    for(i=0;i<inse;i++)

                    { 

                       // $("#from-input"+id).val("");

                        if($("#from-input"+id).val() == "")

                          {

                         $("#from-input"+id).val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input"+id).val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                          date.setDate(date.getDate()+1);

                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

                }

            else  if($("#after").is(":checked"))

              {

                  var day =parseInt($("#days").val());

                  

                   $("#from-input"+id).val("");

                    for(i=0;i<inse;i++)

                    { 

                      

                        if($("#from-input"+id).val() == "")

                          {

                         $("#from-input"+id).val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input"+id).val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                           date.setDate(date.getDate()+day);

                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

              }

              else  if($("#weekly").is(":checked"))

              {

                  

                   $("#from-input"+id).val("");

                    for(i=0;i<inse;i++)

                    { 

                      

                        if($("#from-input"+id).val() == "")

                          {

                         $("#from-input"+id).val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input"+id).val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                           date.setDate(date.getDate()+7);

                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

              }

              else  if($("#monthly").is(":checked"))

              {

                 

                   $("#from-input"+id).val("");

                    for(i=0;i<inse;i++)

                    { 

                       // $("#from-input"+id).val("");

                        if($("#from-input"+id).val() == "")

                          {

                         $("#from-input"+id).val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input"+id).val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                           date.setMonth(date.getMonth() + 1);

                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

              }

              else  if($("#yearly").is(":checked"))

              {

                 

                   $("#from-input"+id).val("");

                    for(i=0;i<inse;i++)

                    { 

                       // $("#from-input"+id).val("");

                        if($("#from-input"+id).val() == "")

                          {

                         $("#from-input"+id).val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input"+id).val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                           date.setFullYear(date.getFullYear()+1);

                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

              }

              else if($("#same_day").is(":checked"))

              {

                 ("#from-input"+id).val("");

                 for(i=0;i<inse;i++)

                    { 

                       // $("#from-input"+id).val("");

                        if($("#from-input"+id).val() == "")

                          {

                         $("#from-input"+id).val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input"+id).val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                         //  date.setDate(date.getFullYear()+1);

                          // td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    } 

                }

                else  if($("#odf1").is(":checked"))

              {

                   

                  odf=1;

                  $("#odf").prop("checked",true);

              }

              else

              {

                   

                    var d=$("#name_dop").val();

                    var v = $("#from-input"+id).val();

                         if(v !="")

                         {

                          var dates = v.split(", ");

                      

                          var count = dates.length;

                         // alert(count);

                         }

                         else

                         {

                             var count =0;

                         }

                         if(count == inse)

                         {

                             alert("you can not enter more dates");

                             // $("#name_dop").val(""); 

                         }

                         else

                         {

                                  if($("#from-input"+id).val() == "")

                                  {

                                     $("#from-input"+id).val(function() {

                                    return this.value + d;

                                 

                                         });

                                  }

                                  else

                                  {

                                          $("#from-input"+id).val(function() {

                                       return this.value +', '+ d;

                                   

                                         });

                          }

                        // $("#name_dop").val(""); 

                        

                         }



              }

         }

        else

        {

            

            // var data = $("#from-input").val("");

             //alert(data.length);

         if($("#daily").is(":checked"))

              {     

                    $("#from-input").val("");

                    for(i=0;i<inse;i++)

                    { 

                       // $("#from-input").val("");

                        if($("#from-input").val() == "")

                          {

                         $("#from-input").val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input").val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                           date.setDate(date.getDate()+1);

                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

                }

            else  if($("#after").is(":checked") && $("#days").val()!="")

              {

                 

                  var d =parseInt($("#days").val());

                 

                   $("#from-input").val("");

                    for(i=0;i<inse;i++)

                    { 

                       // $("#from-input").val("");

                        if($("#from-input").val() == "")

                          {

                         $("#from-input").val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input").val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                           date.setDate(date.getDate() + d);

                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

              }

              else  if($("#weekly").is(":checked"))

              {

                 

                  $("#from-input").val("");

                    for(i=0;i<inse;i++)

                    { 

                       // $("#from-input").val("");

                        if($("#from-input").val() == "")

                          {

                         $("#from-input").val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input").val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                           date.setDate(date.getDate() + 7);

                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

              }

              else  if($("#monthly").is(":checked"))

              {

                 

                  $("#from-input").val("");

                    for(i=0;i<inse;i++)

                    { 

                       // $("#from-input").val("");

                        if($("#from-input").val() == "")

                          {

                         $("#from-input").val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input").val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                           date.setMonth(date.getMonth() + 1);

                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

                  

              }

              else if($("#yearly").is(":checked"))

              {

                 

                  $("#from-input").val("");

                for(i=0;i<inse;i++)

                    { 

                       // $("#from-input").val("");

                        if($("#from-input").val() == "")

                          {

                         $("#from-input").val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input").val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                          date.setFullYear(date.getFullYear() + 1);

                           td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

                  

                }

                else  if($("#same_day").is(":checked"))

              {

                 $("#from-input").val("");

                  for(i=0;i<inse;i++)

                    { 

                       // $("#from-input").val("");

                        if($("#from-input").val() == "")

                          {

                         $("#from-input").val(function() {

                        return this.value + td;

                     

                    });

                          }

                          else

                          {

                              $("#from-input").val(function() {

                        return this.value +', '+ td;

                       

                    });

                   

                          }

                         // date.setFullYear(date.getFullYear() + 1);

                          // td = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();

                    }

              }

               else  if($("#odf1").is(":checked"))

              {

                   odf=1;

                  $("#odf").prop("checked",true);

              }

               else  if($("#odf1").is(":unchecked"))

              {

                   odf=0;

                  $("#odf").prop("checked",false);

              }

              else

              {

                 

                    var d=$("#name_dop").val();

                    var v = $("#from-input").val();

                    alert(v);

                         if(v!="")

                         {

                          var dates = v.split(", ");

                      alert("dates"+dates);

                          var count = dates.length;

                          alert(count);

                         }

                         else

                         {

                             var count =0;

                         }

                         if(count == inse)

                         {

                             alert("you can not enter more dates");

                             // $("#name_dop").val(""); 

                         }

                         else

                         {

                                  if($("#from-input").val() == "")

                                  {

                                     $("#from-input").val(function() {

                                    return this.value + d;

                                 

                                         });

                                  }

                                  else

                                  {

                                          $("#from-input").val(function() {

                                       return this.value +', '+ d;

                                   

                                         });

                          }

                       //  $("#name_dop").val(""); 

                        

                         }



              }

        }

      }       

function get_price()

{

    /*if ($('#add_on').is(":checked")) 

    {

        return false;

    }*/

    

    

    var  newspaper= $("#newspaper").val();

    //var  city= $("#city").val();

    var  cat= $("#cat").val();

    var  inse= $("#inse").val();

    var color= $("#color").val();

    var city = $("#state").val();

 if(newspaper=="")

        {

            alert("Select Newspaper");

           $('#newspaper').val(function() 

                           {

                return this.defaultValue;

            });

          exit();

        }

         if( cat=="")

        {

            alert("Select Position ");

            $('#cat').val(function() 

                           {

                return this.defaultValue;

            });

         exit();

        }

         if( color=="")

        {

            alert("Select  Color");

            $('#color').val(function() 

                           {

                return this.defaultValue;

            });

         exit();

        }

 if(  inse=="" )

        {

            alert("Select insertion");

            // $('#inse').focus()

            $('#inse').val(function() 

                           {

                return this.defaultValue;

            });

         exit();

        }

    

/*  if ($('#column_type2').is(":checked")) 

    {

        var size_type="D"

    }

    else

    {

        var size_type="S"

    }

*/  

    

    var form_data= {'newspaper':newspaper,'cat':cat,'inse':inse,'color':color,'city':city};

    

    $.ajax({

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_price",

            type: "POST",               

            async: true ,               

            data: form_data,

            beforeSend: function(){ document.getElementById("loader").style.display = "block";},

            success: function(data)

                {

                      document.getElementById("loader").style.display = "none";

                      

                    if(data=='1')

                    {

                        alert("Select Newspaper and Heading First.");

                        $('#inse').val(function() 

                        {

                            return this.defaultValue;

                        });

                        return false;

                    }

                    if(data=='2')

                    {

                        alert("Rate not Set with this Newspaper or Heading.");

                        $('#inse').val(function() 

                        {

                            return this.defaultValue;

                        });

                        return false;

                    }

                    

                    //alert("Ro added Successfully");                   

                    

                    // Parse the returned json data

                    var price = $.parseJSON(data);

                    console.log(price);

                    /* Use jQuery's each to iterate over the tr value

                    document.getElementById("rate").value = price.ad_price;

                    document.getElementById("erate").value = price.extra_price;

                    document.getElementById("mrate").value = price.mul_rate;

                    document.getElementById("merate").value = price.mul_ex;

                    document.getElementById("brate").value = price.b_rate;

                    document.getElementById("comm1").value = price.discount;

                    //document.getElementById("nfdc").value = price.discount;*/

                    //min_w=price.min_w;

                    size_type=price.size_type

                    f_min_l=price.f_min_l;

                    f_min_r=price.f_min_r;

                    s_min_l=price.s_min_l;

                    s_min_r=price.s_min_r;

                    s_max_l=price.s_max_l;

                    s_max_r=price.s_max_r;

                    d_min_l=price.d_min_l;

                    d_min_r=price.d_min_r;

                    d_max_l=price.d_max_l;

                    d_max_r=price.d_max_r;

                    if (price.size_type == 'F')

                    {

                    document.getElementById("size_l").min = f_min_l;

                    document.getElementById("size_r").min = f_min_r;

                //  document.getElementById("size_r").value = f_min_r;

                    }

                    else if (price.size_type == 'S')

                    {

                    document.getElementById("size_l").min = s_min_l;

                    document.getElementById("size_r").min = s_min_r;

                    document.getElementById("size_l").max = s_max_l;

                    document.getElementById("size_r").max = s_max_r;

                /// document.getElementById("size_r").value = s_max_r;

                    }

                    if (price.size_type == 'D')

                    {

                    document.getElementById("size_l").min = d_min_l;

                    document.getElementById("size_r").min = d_min_r;

                    document.getElementById("size_l").max = d_max_l;

                    document.getElementById("size_r").max = d_max_r;

                    //  document.getElementById("size_r").value = d_max_r;

                

                    }

                    

                    

                    //document.getElementById("w_count1").value = price.min_w;

                    document.getElementById("comm1").value = price.discount;

                    document.getElementById('gst').value=price.gst;

                    $("#unit option[value='" + price.unit +"']").attr("selected", true);

                    

                    days=price.day_id.split(",");

                    nfdc=price.non_focus_charge.split(",");

                    

                    if(nfdc[1] == 'Rs')

                    {

                        //alert(nfdc[1]+"   "+nfdc[0]);

                        document.getElementById("nfdc").value = nfdc[0];

                    }

                    else

                    {

                            document.getElementById("nfdc").value = 0;

                    }

                    

                    document.getElementById("comm2").value = 0;

                    document.getElementById("comm3").value = 0;

                    document.getElementById("comm4").value = 0;

                    document.getElementById("comm5").value = 0;

                    document.getElementById("comm6").value = 0;

                    document.getElementById("comm7").value = 0;

                    document.getElementById("comm8").value = 0;

                    commission();

                

                    /*

                    //var amount=price.ad_price*inse;

                    //document.getElementById("amount").value = amount.toFixed( 2 );

                    

                    

                    //amount_calculate();

                    

                    */

                    

                },                

            error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Error ");

                    }

            });

        

}



var flag=0;



function date_pic()

{

    var  inse= $("#inse").val();



    var today = new Date();

//  $("#from-input").multiDatesPicker({ minDate: 0});

    $('#from-input').multiDatesPicker({

        //minDate: 0,

        

        onSelect:function()

        {           

            var dates= $("#from-input").val();

            var s_days=dates.split(", ");

            var i=s_days.length;

            if(i>= inse)

            {

                $('#from-input').multiDatesPicker('removeIndexes', inse);

            }

            i=i-1;

            

            var s_date=s_days[i];

            var d = new Date(s_days[i]);

            var day_id=d.getDay();

            

            var f=0;

            var j;

            for(j=0; j < 7; j++)

            {

                if(day_id== days[j])

                {

                    f=1;

                    break;

                }

            }

            

            if(f!=1 && dates!="" && flag == 0)

            {

                var status=confirm("You select non focus Day do you want to add.");

                if (status == true) 

                {

                    flag=1;

                     return false;

                } 

                else 

                {

                    var ind=s_days.length;

                    ind--;

                    $('#from-input').multiDatesPicker('removeIndexes', ind);

                }

            }

            if((s_days.length)==inse)

            {

               get_dop_price();

        

            }

            

        },

        

        beforeShowDay: function(day) {

            var day = day.getDay();

            if (day == days[0] || day == days[1] || day == days[2] || day == days[3] || day == days[4] || day == days[5] || day == days[6]) 

            {

                return [true, "focus_day_color"]

            } 

            else 

            {

                return [true, ""]

            }

         }

        

    });

     get_dop_price();   



}



function date_pic1() {

    

    

    if ($('#add_on').is(":checked")) 

    {   get_package();  

        get_base_price();

    //  ad_on_paper(base_id);

        

    }

    else

    {get_package();

        get_price();

        

            $('#from-input').multiDatesPicker('resetDates', 'picked');

    

    //date_pic();

    }

    

    

    

    



    

}



function date_pic_byid(paper_id)

{   



var id="from-input"+paper_id;

//alert(id);



    var  inse= $("#inse").val();

    var  cat= $("#cat").val();

    

    var form_data= {'newspaper':paper_id,'cat':cat,'inse':inse};

    

    $.ajax({

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_fdays",

            type: "POST",               

            async: true ,               

            data: form_data,

            beforeSend: function(){ document.getElementById("loader").style.display = "block";},

            success: function(data)

                {

                      document.getElementById("loader").style.display = "none";

                      

                    if(data=='1')

                    {

                        alert("Select Newspaper,Heading and enter Insertion First.");

                        /*$('#inse').val(function() 

                        {

                            return this.defaultValue;

                        });*/

                        return false;

                    }

                    if(data=='2')

                    {

                        alert("Rate not Set with this Newspaper or Heading.");

                        /*$('#inse').val(function() 

                        {

                            return this.defaultValue;

                        });*/

                        return false;

                    }

                                                    

                    

                    // Parse the returned json data

                    var price = $.parseJSON(data);

                                        

                    days=price.day_id.split(",");

                    

                    

                },

            complete: function() 

                    {                    

                    //  date_pic_byid1(paper_id);

                    },

            error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Rate not Set with this Newspaper or Heading.");

                    }

            });

    

    /*setTimeout(function () {                      

                        date_pic_byid1(paper_id);                       

                        }, 500);

    */

    



}



function date_pic_byid1(paper_id)

{   



var id=paper_id;

//$("#from-input"+id ).multiDatesPicker({ minDate: 0});

//alert(id);

    $("#from-input"+id).multiDatesPicker('removeIndexes', inse);

    var  inse= $("#inse").val();

    

    var today = new Date();

    $("#from-input"+id).multiDatesPicker({

        //minDate: 0,

        

        onSelect:function()

        {           

            var dates= $("#from-input"+id).val();

            var s_days=dates.split(", ");

            var i=s_days.length;

            if(i>= inse)

            {

                $("#from-input"+id).multiDatesPicker('removeIndexes', inse);

            }

            i=i-1;

            

            var s_date=s_days[i];

            var d = new Date(s_days[i]);

            var day_id=d.getDay();

            

            var f=0;

            var j;

            for(j=0; j < 7; j++)

            {

                if(day_id== days[j])

                {

                    f=1;

                    break;

                }

            }

            

            if(f!=1 && dates!="" && flag == 0)

            {

                var status=confirm("You select non focus Day do you want to add.");

                if (status == true) 

                {

                    flag=1;

                     return false;

                } 

                else 

                {

                    var ind=s_days.length;

                    ind--;

                    $("#from-input"+id).multiDatesPicker('removeIndexes', ind);

                }

            }

                        

        },

        

        beforeShowDay: function(day) {

            var day = day.getDay();

            if (day == days[0] || day == days[1] || day == days[2] || day == days[3] || day == days[4] || day == days[5] || day == days[6]) 

            {

                return [true, "focus_day_color"]

            } 

            else 

            {

                return [true, ""]

            }

         }

        

    });



}









function get_dop_price()

{

    

    document.getElementById("loader").style.display = "block";

    

    var  newspaper= $("#newspaper").val();  

    var  cat= $("#cat").val();

    var  inse= $("#inse").val();

    var color= $("#color").val();

    var city=$("#state").val();

    if(newspaper=="" || cat=="" || inse=="" || color=="")

    {

        alert("Select Newspaper,City,Heading and Color");

        $('#inse').val(function() 

                        {

                            return this.defaultValue;

                        });

        return false;

    }

    

/*  if ($('#column_type2').is(":checked")) 

    {

        var size_type="D"

    }

    else

    {

        var size_type="S"

    }

*/  

    var dates= $("#from-input").val();

    var s_days=dates.split(", ");

    var c=s_days.length;

    var i;

        

    var p_u = document.getElementById('pub_dates');

    

    p_u.innerHTML = "";

    

    for(i=0; i<c ;i++)

    {

        //alert(s_days[i]);

        var form_data= {'newspaper':newspaper,'cat':cat,'inse':inse,'s_date':s_days[i],'count':i,'color':color,'city':city};

        //alert(s_days[i]);

        $.ajax({

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_dop_price",

            type: "POST",               

            async: true ,               

            data: form_data,

            beforeSend: function(){ document.getElementById("loader").style.display = "block";},

            success: function(data)

                {                     

                      

                    if(data=='1')

                    {

                        alert("DOP Rate not Set with this Newspaper,Color or Heading on some Date.");

                        

                        return false;

                    }

                    

                    // Parse the returned json data

                    var data = $.parseJSON(data);

                    var html='<div id="rate_dis'+ data['values'].count +'" style="display: none;">                 <div class="title" style="background-color:#fff;"><i class="fa fa-money"></i><strong> Rate Of Date '+ data['values'].s_date +'</strong></div>       <div class="form-group"><label for="pack-price" class="col-md-3 control-label">Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['values'].count +'" id="rate'+ data['values'].count +'"></div> <label for="pack-price" class="col-md-3 control-label">B Rate</label><div class="col-md-3"><input type="text" onchange="amount_calculate();" placeholder="" class="form-control" name="brate'+ data['values'].count +'" id="brate'+ data['values'].count +'"></div></div></div>';

                     datarate=data;

                    p_u.insertAdjacentHTML('beforeend', html);

                    

                                        

                    document.getElementById("rate"+data['values'].count).value = data['rates'].ad_price;                    

                    document.getElementById("brate"+data['values'].count).value = data['rates'].b_rate;

                    

                    //document.getElementById("dis"+data['values'].count).value = data['rates'].discount;

                    /*

                    document.getElementById("mrate").value = price.mul_rate;

                    document.getElementById("merate").value = price.mul_ex;                 

                    document.getElementById("comm1").value = price.discount;

                    //document.getElementById("nfdc").value = price.discount;*/

                    //min_w=price.min_w;

                    

                    //$("#unit option[value='" +price.unit +"']").attr("selected", true);

                    

                    //days=price.day_id.split(",");

                    //nfdc=price.non_focus_charge.split(",");

                    /*

                    if(nfdc[1] == 'Rs')

                    {

                        //alert(nfdc[1]+"   "+nfdc[0]);

                        document.getElementById("nfdc").value = nfdc[0];

                    }

                    

                    document.getElementById("comm2").value = 0;

                    document.getElementById("comm3").value = 0;

                    document.getElementById("comm4").value = 0;

                    document.getElementById("comm5").value = 0;

                    document.getElementById("comm6").value = 0;

                    document.getElementById("comm7").value = 0;

                    document.getElementById("comm8").value = 0;

                    

                    var amount=price.ad_price*inse;

                    document.getElementById("amount").value = amount.toFixed( 2 );

                    

                    commission();

                    amount_calculate();

                    

                    */

                    

                },

            error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Error in dop.");

                    }

            });

        

        //var d1 = document.getElementById('pub_dates');

        

}

        

    setTimeout(amount_calculate, 2000);

    setTimeout(hide_div, 2000);

    document.getElementById("loader").style.display = "none";   

}



 function get_base_dop_price(id=null)



        {



                document.getElementById("loader").style.display = "block";

    

    var  newspaper= id; 

    alert(newspaper);

    var  cat= $("#cat").val();

    var  inse= $("#inse").val();

    var color= $("#color").val();

    var city=$("#state").val();

    if(newspaper=="" || cat=="" || inse=="" || color=="")

    {

        alert("Select Newspaper,City,Heading and Color");

        $('#inse').val(function() 

                        {

                            return this.defaultValue;

                        });

        return false;

    }

    

/*  if ($('#column_type2').is(":checked")) 

    {

        var size_type="D"

    }

    else

    {

        var size_type="S"

    }

*/  

    var dates= $("#from-input"+id).val();

    var s_days=dates.split(", ");

    var c=s_days.length;

    var i;

        



    

    for(i=0; i<c ;i++)

    {

        //alert(s_days[i]);

        var form_data= {'newspaper':newspaper,'cat':cat,'inse':inse,'s_date':s_days[i],'count':i,'color':color,'city':city};

        //alert(s_days[i]);

        $.ajax({

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_base_dop_price",

            type: "POST",               

            async: true ,               

            data: form_data,

            beforeSend: function(){ document.getElementById("loader").style.display = "block";},

            success: function(data)

                {                     

                      

                    if(data=='1')

                    {

                        alert("DOP Rate not Set with this Newspaper,Color or Heading on some Date.");

                        

                        return false;

                    }

                    

                    // Parse the returned json data

                    var data = $.parseJSON(data);

                //  var html='<div id="rate_dis'+ data['values'].count +'" style="display: none;">                 <div class="title" style="background-color:#fff;"><i class="fa fa-money"></i><strong> Rate Of Date '+ data['values'].s_date +'</strong></div>       <div class="form-group"><label for="pack-price" class="col-md-3 control-label">Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['values'].count +'" id="rate'+ data['values'].count +'"></div> <label for="pack-price" class="col-md-3 control-label">B Rate</label><div class="col-md-3"><input type="text" onchange="amount_calculate();" placeholder="" class="form-control" name="brate'+ data['values'].count +'" id="brate'+ data['values'].count +'"></div></div></div>';

                     datarate=data;

                //  p_u.insertAdjacentHTML('beforeend', html);

                    

                                        

                    document.getElementById("rate"+id).value = data['rates'].ad_price;                  

                    document.getElementById("brate"+id).value = data['rates'].b_rate;



                    },                



                    error: function() 



                    {



                        document.getElementById("loader").style.display = "none";



                        alert("Rate not Set with this Newspaper or Heading.");



                    }



                });









            }



          



            document.getElementById("loader").style.display = "none";   



        }

  function get_addon_dop_price(id=null)



        {



            document.getElementById("loader").style.display = "block";



            var  m_newspaper= base_id;  

            var  a_newspaper= id;   

//alert(a_newspaper);

            var  cat= $("#cat").val();

    var  inse= $("#inse").val();

    var color= $("#color").val();

    var city=$("#state").val();

    var size_l=$("#size_l").val();

    var size_r=$("#size_r").val();

    if(newspaper=="" || cat=="" || inse=="" || color=="")



            {



                alert("Select Newspaper,City and Heading");



                $('#inse').val(function() 



                               {



                    return this.defaultValue;



                });



                return false;



            }



            var dates= $("#from-input"+id).val();

    var s_days=dates.split(", ");

    var c=s_days.length;

    var i;

        



    

    for(i=0; i<c ;i++)

    {

        //alert(s_days[i]);

        var form_data= {'m_newspaper':m_newspaper,'a_newspaper':a_newspaper,'cat':cat,'inse':inse,'s_date':s_days[i],'count':i,'color':color,'city':city};

        //alert(s_days[i]);

        $.ajax({

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_addon_dop_price",

            type: "POST",               

            async: true ,               

            data: form_data,

            beforeSend: function(){ document.getElementById("loader").style.display = "block";},

            success: function(data)

                {                     

                      

                    if(data=='1')

                    {

                        alert("DOP Rate not Set with this Newspaper,Color or Heading on some Date.");

                        

                        return false;

                    }

                    

                    // Parse the returned json data

                    var data = $.parseJSON(data);

                //  var html='<div id="rate_dis'+ data['values'].count +'" style="display: none;">                 <div class="title" style="background-color:#fff;"><i class="fa fa-money"></i><strong> Rate Of Date '+ data['values'].s_date +'</strong></div>       <div class="form-group"><label for="pack-price" class="col-md-3 control-label">Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['values'].count +'" id="rate'+ data['values'].count +'"></div> <label for="pack-price" class="col-md-3 control-label">B Rate</label><div class="col-md-3"><input type="text" onchange="amount_calculate();" placeholder="" class="form-control" name="brate'+ data['values'].count +'" id="brate'+ data['values'].count +'"></div></div></div>';

                    

                //  p_u.insertAdjacentHTML('beforeend', html);

                    

                                        

                    document.getElementById("rate"+id).value = data['rates'].price;                 

                    document.getElementById("brate"+id).value = data['rates'].e_price;



                    },                



                    error: function() 



                    {



                        document.getElementById("loader").style.display = "none";



                        alert("Rate not Set with this Newspaper or Heading.");



                    }



                });









            }



          



            document.getElementById("loader").style.display = "none";   



        }

function hide_div()

{

    document.getElementById("pub_dates").style.display = "block";

    

    var x = document.getElementById('rate_dis0');

    x.style.display = 'block';

    

    var  inse= $("#inse").val();

    var  rate=0;    

    var  brate=0;   

    var i;

    

    var dates= $("#from-input").val();

    var s_days=dates.split(", ");

    var c=s_days.length;

    

        for(i=1 ; i < c ;i++)

        {

            rate= parseFloat($("#rate"+i).val());           

            

            var o_rate= parseFloat($("#rate"+(i-1)).val()); 

            

            if(o_rate!=rate)

            {

                var x = document.getElementById('rate_dis'+i);

                x.style.display = 'block';

            }

        }

}



function non_focus_day()

{

    if ($('#add_on').is(":checked"))

           {

            var  dates= $("#from-input"+base_id).val();

            

           }



           else

           {

                var  dates= $("#from-input").val();

           }

           alert(dates);

    var s_days=dates.split(", ");

    var i;

    

    var f=1;

    

    for(i=0; i<(s_days.length);i++) 

    {

        var fl=0;

        var d = new Date(s_days[i]);

        var day_id=d.getDay();

        var j;

        for(j=0; j < 7; j++)

        {

            if(day_id == days[j])

            {

                fl=1;               

            }           

        }

        if(fl==0)

        {

            f=0;

        }

        

    }

    

    if(f==0)

    {

        return 1;   

    }

    else

    {

        return 0;

    }

    

    

}



function date_val()

{

    var  dates= $("#from-input").val();

    alert(dates);

}



//$('#from-input').multiDatesPicker();

</script>





<script type="text/javascript">

  function save_ro()

    {
 $("#save").prop("disabled",true);
      //  check_session_date_range();

        var  book_date= $("#book_date").val();

        var  client= $("#client").val();

        var  employee= $("#employee").val();

        var  newspaper= $("#newspaper").val();

        var  pub_id= $("#pub_id").val();

        var  title= $("#title").val();

        var  matter= $("#matter").val();

        var  cat= $("#cat").val();

        var  sheading= $("#sheading").val();

        var state_id = $("#state").val();

        var  pack= $("#pack").val();

        var unit=$("#unit").val();

        var  inse= $("#inse").val();

        var  scheme= $("#scheme").val();

        var  material= $("#material").val();

        var  party= $("#party").val();

        var  premimum= $("#premimum").val();

        var  box= $("#box").val();

        var  remark= $("#remark").val();

        var  height= $("#size_l").val();

        var  width= $("#size_r").val();

        var dis = $("#dis").val();

        var a_newspaper = $("#a_newspaper").val();

          var prem=parseFloat(premimum_value);

       // var state_id = $("#state").val();

        if ($('#add_on').is(":checked")) 

        { 

            var  price= parseFloat($("#rate"+base_id).val());       

            var  eprice= parseFloat($("#erate"+base_id).val());



            var arr = $("#a_newspaper").val();

           

            newspaper=base_id;

             arr.unshift(base_id);

            var add_dop = [];



            var val=$("#from-input"+ base_id).val();

            var id=base_id;



            var data = {id : id, dop  : val, price : price, eprice : eprice};

            add_dop.push(data);



            if($('#sdta').is(":checked"))

            {

                $.each(arr, function(i, d) {



                    if(d==base_id)

                    {   



                        return;

                    }

             var  price= parseFloat($("#rate"+d).val());        

            var  eprice= parseFloat($("#erate"+d).val());

                    var id=d;

                    data = {id : id, dop  : val, price : price, eprice : eprice};

                    add_dop.push(data);



                    //alert(pack_dop[i]);

                });

            }

            else

            {

                $.each(arr, function(i, d) {



                    if(d==base_id)

                    {



                        return;

                    }



                    var val=$("#from-input"+ d).val();

                    var  price= parseFloat($("#rate"+d).val());     

            var  eprice= parseFloat($("#erate"+d).val());

                    var id=d;

                    data = {id : id, dop  : val, price : price, eprice : eprice};

                    add_dop.push(data);



                    //alert(pack_dop[i]);

                });

            }



            var  p_date=add_dop;

            var  ro_type="M";       

        }

        else

        {



            if(pack=="")

            {

                var  price = 0; 

                var  eprice = 0;

                var i;
// for(i=0;i<inse;i++)
                // {
                //     price= price + $("#rate"+i).val();
                //     eprice= eprice + $("#erate"+i).val();				
                // }
                price= parseFloat($("#rate"+0).val()).toFixed(2);		
           eprice= parseFloat($("#erate"+0).val()).toFixed(2);


var val=$("#from-input").val();

                    var  price1= parseFloat($("#rate"+0).val());     

            var  eprice1= parseFloat($("#erate"+0).val());

                    var id=0;

                    data = {id : id, dop  : val, price : price1, eprice : eprice1};
                var  p_date=$("#from-input").val();

                var  ro_type="N";

            }

            else

            {

                var  price=$("#rate").val();    

                var  eprice=$("#erate").val();

                var pack_dop = [];

                /*$.each(packs, function(i, d) {



                        var val=$("#from-input"+ d.paper_id).val();

                        var id=d.paper_id;

                        var data = {id : id, dop  : val};

                        pack_dop.push(data);



                    //alert(pack_dop[i]);

                    });*/



                if($('#sdta').is(":checked"))

                {

                    var dop_to_all="";

                    $.each(packs, function(i, d) {



                        var val=$("#from-input"+ d.paper_id).val();

                        if(val != "")

                        {

                            dop_to_all=val;

                        }



                        //alert(pack_dop[i]);

                    });



                    $.each(packs, function(i, d) {                      



                        var id=d.paper_id;

                        var data = {id : id, dop  : dop_to_all};

                        pack_dop.push(data);



                        //alert(pack_dop[i]);

                    });

                }

                else

                {

                    $.each(packs, function(i, d) {



                        var val=$("#from-input"+ d.paper_id).val();

                        var id=d.paper_id;

                        var data = {id : id, dop  : val};

                        pack_dop.push(data);



                        //alert(pack_dop[i]);

                    });

                }



                var  p_date=pack_dop;

                var  ro_type="P";

            }



        }



        //var  city= $("#city").val();

        //var  p_date=$("#from-input").val();



        if($('#sdta').is(":checked"))

        {

            var sdta=1;

        }

        else

        {

            var sdta=0;

        }



        if ($('#odf').is(":checked")) 

        {

            var odf=1;

        }

        else

        {

            var odf=0;

        }





        var  w_count= $("#size_l").val()+' X '+$("#size_r").val();

        var  t_amount= $("#t_amount").val();

        var  p_amount= $("#p_amount").val();

        var  dis_a= $("#dis_a").val();

        var  comm1= $("#comm1").val();

        var  comm2= $("#comm2").val();

        var  comm3= $("#comm3").val();

        var  comm4= $("#comm4").val();

        var  comm5= $("#comm5").val();

        var  comm6= $("#comm6").val();

        var  comm7= $("#comm7").val();

        var  comm8= $("#comm8").val();

        var  box_c= $("#box_c").val();

        var  add_a= $("#add_a").val();

var amount=$("#amount").val();

alert(prem);
        var color= $("#color").val();



        var form_data= {'client':client,'newspaper':newspaper,'amount':amount,'a_newspaper':a_newspaper,'state_id':state_id,'pub_id':pub_id,'title':title,'matter':matter,'cat':cat,'sheading':sheading,'pack':pack,'inse':inse,'scheme':scheme,'material':material,'party':party,'prem':prem,'premimum':premimum,'box':box,'remark':remark,'price':price,'eprice':eprice,'w_count':w_count,'unit':unit,'size_type':size_type,'p_date':p_date,'ro_type':ro_type,'t_amount':t_amount,'p_amount':p_amount,'dis':dis,'dis_a':dis_a,'color':color,'comm1':comm1,'comm2':comm2,'comm3':comm3,'comm4':comm4,'comm5':comm5,'comm6':comm6,'comm7':comm7,'comm8':comm8,'box_c':box_c,'add_a':add_a,'odf':odf,'dop_inse':inse_dop,'free_days':free_days};



        $.ajax({                

            url: "<?php echo base_url(); ?>" + "admin/display_ro/save",

            type: "POST",               

            async: true ,               

            data: form_data,

            beforeSend: function(){ document.getElementById("loader").style.display = "block";},

            success: function(data)

            {

                document.getElementById("loader").style.display = "none";

                if(data=='1')

                {

                    alert("Fill All Mandatory Felids.");

                    return false;

                }

                if(data=='2')

                {

                    alert("No. of publish Dates must be equal to insertion.");

                    return false;

                }

                if(data=='3')

                {

                    alert("Rate Not Set with this newspaper.");

                    return false;

                }







              //  alert("Ro added Successfully");                   



                // Parse the returned json data

                var tr = $.parseJSON(data);

                // Use jQuery's each to iterate over the tr value

                document.getElementById("msg").innerHTML = "Ro added Successfully with ID "+tr[0].id;



                $.each(tr, function(i, d) 

                       {

                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data                 

                    $("#ecom-products tbody").append('<tr><td class="text-center"><strong>'+d.id+'</strong></td><td>'+d.newspaper_name+'</td><td class="text-center">'+d.type_name+'</td><td class="text-center">'+d.cat_name+'</td><td class="text-center">'+d.ad_cost+'</td><td class="text-center">'+d.insertion+'</td><td class="text-center">'+d.client_name+'<br>'+d.email+'<br>'+d.mobile+'</td></tr>');



                }); 



                $('#msg').delay(5000).fadeOut('slow');

 window.location.replace("<?php echo base_url('admin/display_ro/add'); ?>");

                //document.getElementById("w_count").innerHTML = "";

                document.getElementById("add_on").checked = false;

                add_paper();

                document.getElementById("add_pub_dates").innerHTML = "";

                $('#a_newspaper').empty();

                setTimeout(sel_update, 500);

                $('#premimum').empty();

                setTimeout(sel_update_pre, 300);



                document.getElementById("ro_add").reset();

                $('#from-input').multiDatesPicker('resetDates', 'picked');

                $('#sheading').empty();

                //$('#city').empty();

                free_days = 0;

                days =[9,9,9,9,9,9,9];

                min_w=0;



                var s_min_l=0;

                var s_min_r=0;

                var s_max_l=0;

                var s_max_r=0;



                nfdc=[0,''];

                free_days=0;





                document.getElementById("ad_on_rate").innerHTML = "";

                document.getElementById("add_pub_dates").innerHTML = "";

                document.getElementById("add_base_dates").innerHTML = "";

                document.getElementById("pack_pub_dates").innerHTML = "";

                document.getElementById("pub_dates").innerHTML = "";



                document.getElementById("add_base_dates").style.display = "block";

                document.getElementById("ad_on_rate").style.display = "block";

                document.getElementById("add_pub_dates").style.display = "block";

                document.getElementById("pack_pub_dates").style.display = "block";

                document.getElementById("pub_dates").style.display = "block";



                document.getElementById("base_p_date").style.display = "block";

                document.getElementById("pack_rate").style.display = "none";



                //document.getElementById("newspaper").selectedIndex = 0;

                //$('#client').find($('option')).attr('selected',false);

                //$('#client option').attr('selected', false);              

                //$("#client").attr('selectedIndex', '-1'); 

                //$('#client').reset();

                /*



                    $('#client').prop('selectedIndex',0);

                    document.getElementById('employee').selectedIndex = 0;



                    $('#party').val(function() 

                    {

                        return this.defaultValue;

                    });

                    $('#matter').val(function() 

                    {

                        return this.defaultValue;

                    });

                    $('#box').val(function() 

                    {

                        return this.defaultValue;

                    });

                    $('#w_count1').val(function() 

                    {

                        return this.defaultValue;

                    });

                    $('#premimum').val(function() 

                    {

                        return this.defaultValue;

                    });

                    */





            },                

            error: function() 

            {

                document.getElementById("loader").style.display = "none";

                alert("Ro not add !");

            }

        });

    }     











function get_state()

{

    //alert("Please Select Newspaper!");

    var newspaper = $("#newspaper").val();

    console.log(newspaper);

    $.ajax({                

        url: "<?php echo base_url(); ?>" + "admin/book_ads/get_state",

        type: "POST",               

        async: true ,               

        data: {newspaper_id:newspaper},

        beforeSend: function(){ document.getElementById("loader").style.display = "block"; },

        success: function(data)

        {

            document.getElementById("loader").style.display = "none";

            //console.log(data); return false;

            $('#state').empty();

            // Parse the returned json data

            var opts = $.parseJSON(data);

            // Use jQuery's each to iterate over the opts value

            $.each(opts, function(i, d) {

            // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data

            $('#state').append('<option value="' + d.id + '">' + d.name + '</option>');

            });

        },                

        error: function() 

        {

            document.getElementById("loader").style.display = "none";

            alert("Please Select Newspaper!");

        }

    }); 

    get_premimum();

    get_heading();

    get_paper();

}



function get_heading()

{

    var newspaper = $("#newspaper").val();

    $.ajax({                

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_heading",

            type: "POST",               

            async: true ,               

            data: {id:newspaper},

            beforeSend: function(){ document.getElementById("loader").style.display = "block";},

            success: function(data)

                {

                     document.getElementById("loader").style.display = "none";

                    $('#cat').empty();

                    

                    if(data=="[]")

                    {

                        alert("First attach heading with newspaper.");

                    }

                    

                    $('#cat').append('<option value="">Choose One</option>');

                    // Parse the returned json data

                    var opts = $.parseJSON(data);

                    // Use jQuery's each to iterate over the opts value

                    $.each(opts, function(i, d) {

                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data                 

                    $('#cat').append('<option value="' + d.cat_id + '">' + d.cat_name + '</option>');

                    }); 

                },                

            error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Please Select Heading!");

                    }

            });

} 





function get_sub_heading()

{

    get_scheme();

    

    var cat = $("#cat").val();

    $.ajax({                

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_sub_heading",

            type: "POST",               

            async: true ,               

            data: {cat_id:cat},

            beforeSend: function(){ document.getElementById("loader").style.display = "block";},

            success: function(data)

                {

                     document.getElementById("loader").style.display = "none";

                    $('#sheading').empty();

                    // Parse the returned json data

                    var opts = $.parseJSON(data);

                    // Use jQuery's each to iterate over the opts value

                    $.each(opts, function(i, d) {

                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data                 

                    $('#sheading').append('<option value="' + d.id + '">' + d.sub_heading + '</option>');

                    }); 

                },                

            error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Please Select Heading!");

                    }

            });

}    





function get_scheme()

{

    var  cat= $("#cat").val();

    var newspaper = $("#newspaper").val();

    $.ajax({                

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_scheme",

            type: "POST",               

            async: true ,               

            data: {n_id:newspaper, cat_id:cat},

            beforeSend: function(){ document.getElementById("loader").style.display = "block";},

            success: function(data)

                {

                     document.getElementById("loader").style.display = "none";

                    $('#scheme').empty();

                    myscheme();

                    // Parse the returned json data

                    var opts = $.parseJSON(data);

                    // Use jQuery's each to iterate over the opts value

                    $.each(opts, function(i, d) {

                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data                 

                    $('#scheme').append('<option value="' + d.scheme_id + '">' + d.scheme_name + '</option>');

                    }); 

                },                

            error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Please Select Heading!");

                    }

            });

} 



function get_scheme_price()

{

    

    var scheme_id = $("#scheme").val();

    if(scheme_id=="")

    {

        free_days = 0;

        amount_calculate();

        return false;

    }

    

    $.ajax({                

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_scheme_price",

            type: "POST",

            async: true ,

            data: {s_id:scheme_id},

            beforeSend: function(){ document.getElementById("loader").style.display = "block";},

            success: function(data)

                {

                    document.getElementById("loader").style.display = "none";

                    if(data=='1')

                    {

                        alert("Scheme not Found on Server");                        

                        return false;

                    }

                    // Parse the returned json data

                    var scheme = $.parseJSON(data);

                    // Use jQuery's each to iterate over the opts value

                    var  inse= parseInt($("#inse").val());

                    var day=parseInt(scheme.free) + parseInt(scheme.paid);

            

                    if((day <= inse) && (inse%day == 0))

                    {

                        free_days=(inse/day)*scheme.free;

                        

                        alert("Scheme applied. Free Days :-"+free_days);

                    }

                    else

                    {

                        free_days = 0;

                        alert("Scheme Not applicable.");

                        document.getElementById("scheme").selectedIndex = 0;

                    }

                    

                },                

            error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Server not responding.");

                    }

            });

} 



function get_premimum()

{

    var newspaper = $("#newspaper").val();

    $.ajax({                

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_premimum",

            type: "POST",               

            async: true ,               

            data: {n_id:newspaper},

            beforeSend: function(){ document.getElementById("loader").style.display = "block";},

            success: function(data)

                {

                     document.getElementById("loader").style.display = "none";

                    

                    $('#premimum').empty();

                    //myFunction();

                    //$('#premimum').append('<option value="">'"premimum"'</option>');

                    // Parse the returned json data

                    var opts = $.parseJSON(data);

                    // Use jQuery's each to iterate over the opts value

                    $.each(opts, function(i, d) {

                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data                 

                    $('#premimum').append('<option value="' + d.id + '">' + d.p_type + '    ' + d.premimum + ' </option>');

                    });

                    /*

                    //$('#premimum').empty();

                    //myFunction();

                    //$('#premimum').append('<option value="">'"premimum"'</option>');

                    // Parse the returned json data

                    var opts = $.parseJSON(data);

                    // Use jQuery's each to iterate over the opts value

                    var htmlcode=" ";

                    $.each(opts, function(i, d) {

                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data

                     

                    htmlcode=htmlcode+'<input type="radio" name="premimum" value="' + d.id + '"/> '+ d.premimum + ' % , ' + d.color;

                  

                    }); 

                    

                    document.getElementById("premimum123").innerHTML = htmlcode;

                    */

                    

                },

            complete: function() 

                    {                    

                        sel_update_pre();
 document.getElementById("loader").style.display = "none";

            setTimeout(get_premimum_price,5000);
                    },

            error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Please Select Heading!");

                    }

            });

}



function sel_update_pre()

{   

    $("#premimum").trigger("chosen:updated");

    document.getElementById("loader").style.display = "none";

}



var pa=0;

function get_premimum_price()

{

    pa=0;

    var pre_id = $("#premimum").val();

    if(pre_id==null)

    {   

        document.getElementById("premimum_a").value = 0;

        amount_calculate();

        return false;

    }

    document.getElementById("loader").style.display = "block";

    

    $.each(pre_id, function(i, id) {

    

        //document.getElementById("premimum_a").value = 0;

        

        $.ajax({                

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_premimum_price",

            type: "POST",               

            async: false ,               

            data: {pre_id:id},          

            success: function(data)

                {

                    

                    

                    if(data=='1')

                    {                       

                        alert("Premimum not Found on Server!");

                        return false;

                    }

                    

                    //$('#premimum').append('<option value="">'"premimum"'</option>');

                    // Parse the returned json data

                    var pre = $.parseJSON(data);

                    // Use jQuery's each to iterate over the opts value

                    prem=pre.premimum.split(",");
                    premimum_type=prem[1];

                       premimum_value=prem[0];

                    if(prem[1] == 'Rs')

                    {

                        //alert(nfdc[1]+"   "+nfdc[0]);

                        //var  premimum_a= parseFloat($("#premimum_a").val());

                        pa=parseFloat(pa+ prem[0]);

                        //document.getElementById("premimum_a").value = pa;

                        //amount_calculate();

                        return false;

                    }

                    if(prem[1] == '%')

                    {

                        var  non_fdc= parseFloat($("#nfdc").val());

                        var  add_on_a= parseFloat($("#add_a").val());                       

                        var  box_c= parseFloat($("#box_c").val());

                        var  amount= parseFloat($("#amount").val());                        

                        var  extra_ca= parseFloat($("#eca").val());

                        var p_a=(amount + extra_ca +non_fdc + add_on_a + box_c)* parseFloat(prem[0])/100;

                        

                        //var  premimum_a= parseFloat($("#premimum_a").val());

                        pa=parseFloat(pa + p_a);

                        //document.getElementById("premimum_a").value =pa;

                        //amount_calculate();

                        return false;

                    }

                    

                    

                },

            complete: function() 

                    {                    

                        document.getElementById("premimum_a").value =pa;

                    },

            error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Server not responding!");

                    }

            });

        });     

    

    amount_calculate(); 

    document.getElementById("loader").style.display = "none";

}





function get_package()

{

    

    var newspaper = $("#newspaper").val();

    var cat = $("#cat").val();

    var inse= $("#inse").val();

    

    if(newspaper=="" || cat=="" || inse=="" )

    {

        alert("Select Newspaper,Heading and enter insertion");

        $('#inse').val(function() 

                        {

                            return this.defaultValue;

                        });

        return false;

    }

    

    

    $.ajax({                

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_package",

            type: "POST",

            async: true ,

            data: {n_id:newspaper,cat_id:cat,ins:inse},

            beforeSend: function(){ document.getElementById("loader").style.display = "block";},

            success: function(data)

                {

                     document.getElementById("loader").style.display = "none";

                    

                    $('#pack').empty();                 

                    $('#pack').append('<option value="">'+"Package"+'</option>');

                    // Parse the returned json data

                    var opts = $.parseJSON(data);

                    // Use jQuery's each to iterate over the opts value

                    $.each(opts, function(i, d) {

                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data                 

                    $('#pack').append('<option value="' + d.id + '">' + d.package + ' </option>');

                    });

                    /*

                    //$('#premimum').empty();

                    //myFunction();

                    //$('#premimum').append('<option value="">'"premimum"'</option>');

                    // Parse the returned json data

                    var opts = $.parseJSON(data);

                    // Use jQuery's each to iterate over the opts value

                    var htmlcode=" ";

                    $.each(opts, function(i, d) {

                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data

                     

                    htmlcode=htmlcode+'<input type="radio" name="premimum" value="' + d.id + '"/> '+ d.premimum + ' % , ' + d.color;

                  

                    }); 

                    

                    document.getElementById("premimum123").innerHTML = htmlcode;

                    */

                    

                },                

            error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Please Select Heading and Newspaper!");

                    }

            });

}



var packs=[];



function get_pack_price()

{       

    var pack= $("#pack").val();

    

    if(pack=="")

    {

        var x = document.getElementById('base_p_date');

        x.style.display = 'block';

        x = document.getElementById('pack_rate');

        //x.innerHTML="";

        x.style.display = 'none';

        x = document.getElementById('pack_pub_dates');

        x.style.display = 'none';

        x = document.getElementById('pub_dates');

        x.style.display = 'block';

        date_pic1();

        amount_calculate();

        return false;

    }

    

    $.ajax({

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_package_price",

            type: "POST",

            async: true ,

            data: {pack_id:pack},

            beforeSend: function(){ document.getElementById("loader").style.display = "block";},

            success: function(data)

                {

                    var x = document.getElementById('base_p_date');

                    x.style.display = 'none';

                    x = document.getElementById('pub_dates');

                    x.style.display = 'none';

                    x = document.getElementById('pack_rate');

                    x.style.display = 'block';

                                        

                    document.getElementById("loader").style.display = "none";

                                                            

                    var data = $.parseJSON(data);

                    

                    document.getElementById("rate").value = data['pack'].rate;

                    //document.getElementById("erate").value = data['pack'].e_rate;

                    document.getElementById("brate").value = data['pack'].b_rate;

                    document.getElementById("comm1").value = data['pack'].discount;

                        document.getElementById("gst").value = data['pack'].gst;

                    commission();

                    

                    var p_u = document.getElementById('pack_pub_dates');

                    p_u.innerHTML="";

                    var htm="";

                    

                    packs=data['pack_paper'];

                    

                    $.each(data['pack_paper'], function(i, d) {

                    

                    

                        htm='<div class="form-group">   <label for="pack-price" class="col-md-6 control-label" onclick="date_pic_byid('+d.paper_id+');">Publish Dates of '+ d.newspaper_name +'</label> <div class="col-md-6">  <div class="box"  id="from--input"> <input class="form-control" name="p_date'+ d.paper_id +'" type="text" id="from-input'+ d.paper_id +'" data-id="'+d.paper_id+'"  data-toggle="modal" data-target="#dopModal" onclick="showModal('+d.paper_id+')" placeholder="mm/dd/yyyy, ..." > </div>  <div class="code-box">  </div>  </div>  </div>';

                    

                        p_u.insertAdjacentHTML('beforeend', htm);

                    

                                    /*date_pic_byid("from-input"+d.paper_id,d.paper_id);

                                    var tm=10000*(i+1);

                                    setTimeout(function () {                        

                                    date_pic_byid("from-input"+d.paper_id,d.paper_id);

                        

                                    }, tm);

                                    */

                    

                    }); 

                    

                //var d= document.getElementById('pub_dates');

                //d.innerHTML=htm;

                    

                

                    amount_calculate();

                    

                },                

            error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Please Select Heading and Newspaper!");

                    }

            });

    

}





function commission()

{

    var  comm1= $("#comm1").val();

    var  comm2= $("#comm2").val();

    var  comm3= $("#comm3").val();

    var  comm4= $("#comm4").val();

    var  comm5= $("#comm5").val();

    var  comm6= $("#comm6").val();

    var  comm7= $("#comm7").val();

    var  comm8= $("#comm8").val();

    

    var comm=0;

    var amount=100;

    var comm_a=0;

    

    comm=amount*comm1/100;

    amount=amount-comm;

    comm_a=comm_a+comm;

    

    comm=amount*comm2/100;

    amount=amount-comm;

    comm_a=comm_a+comm;

    

    comm=amount*comm3/100;

    amount=amount-comm;

    comm_a=comm_a+comm;

    

    comm=amount*comm4/100;

    amount=amount-comm;

    comm_a=comm_a+comm;

    

    comm=amount*comm5/100;

    amount=amount-comm;

    comm_a=comm_a+comm;

    

    comm=amount*comm6/100;

    amount=amount-comm;

    comm_a=comm_a+comm;

    

    comm=amount*comm7/100;

    amount=amount-comm;

    comm_a=comm_a+comm;

    

    comm=amount*comm8/100;

    amount=amount-comm;

    comm_a=comm_a+comm;

    document.getElementById("dis").value = comm_a.toFixed( 2 );

    

    setTimeout(amount_calculate, 2000);

}





function myFunction() {

    var x = document.getElementById("premimum");

    var option = document.createElement("option");

    option.text = "Select if Premimum";

    option.value = "";

    x.add(option);

} 







function myscheme() {

    var x = document.getElementById("scheme");

    var option = document.createElement("option");

    option.text = "None";

    option.value = "";

    x.add(option);

} 





function amount_calculate()

{   

    var  premimum_a= parseFloat($("#premimum_a").val());

    var  size_l= parseFloat($("#size_l").val());

    var  size_r= parseFloat($("#size_r").val());

    var  unit= $("#unit").val();

    //var  w_count1= parseFloat($("#w_count1").val());

    var  inse= parseInt($("#inse").val());

    //var  rate= parseFloat($("#rate").val());

    //var  erate= parseFloat($("#erate").val());

    

    var  non_fdc= parseFloat($("#nfdc").val());

    var  add_on_a= parseFloat($("#add_a").val());

    var  dis= parseFloat($("#dis").val());

    var  box_c= parseFloat($("#box_c").val());

    var  extra_ca=0;

    var  amount= 0;

    var  t_amount=0;    

    var  p_amount=0

    var  dis_a=0;

    

    if(unit == "SC")

    {

        var sqcm= size_l * size_r;

    }

    else

    {

        var sqcm= size_l;

    }

    

     inse_dop= inse-free_days;

    inse=inse-free_days;

    

 if ($('#add_on').is(":checked")) 

        {

            var  rate=0;        

            var  brate=0;       

            var i;  



            rate= parseFloat($("#rate"+base_id).val());         

            brate= parseFloat($("#brate"+base_id).val());

             if(size_type =="F")

                 {

                    if(brate>0)

                    {

                        amount=amount+(brate * inse);

                    }

                    else

                    {

                        amount=amount+(rate * inse);

                    }

                 }

                 else

                 {

                     if(brate>0)

                    {

                        amount=amount+(brate * sqcm * inse);

                    }

                    else

                    {

                        amount=amount+(rate * sqcm * inse);

                    }

                 }

            var arr = $("#a_newspaper").val();

            var newspaper= $("#newspaper").val();



            arr.unshift(newspaper);

            add_on_a=0.0;



            $.each(arr, function(i, id) {



                if(id==base_id)

                {

                    return;

                }



                rate= parseFloat($("#rate"+id).val());          

                brate= parseFloat($("#brate"+id).val());            

               // var add_mul= $("#add_mul"+id).val();

                 if(size_type == "F")

                 {

                        if(brate>0)

                            {

                                add_on_a=add_on_a+(brate * inse);

                            }

                            else

                            {

                                add_on_a=add_on_a+(rate * inse);

                            }

                 }

                    else

                    {

                        if(add_mul[id]=='M')

                        {

                            if(brate>0)

                            {

                                add_on_a=add_on_a+(brate* sqcm *inse);

                            }

                            else

                            {

                                add_on_a=add_on_a+(rate* sqcm *inse);

                            }

                        }

                        else

                        {

                            if(brate>0)

                            {

                                add_on_a=add_on_a+(brate * inse);

                            }

                            else

                            {

                                add_on_a=add_on_a+(rate * inse);

                            }

                        }

                    }



            });

        }

     else

        {

            var  pack= $("#pack").val();

            if(pack!="")

            {

                var  rate= parseFloat($("#rate").val());            

                var  brate= parseFloat($("#brate").val());          

            if(size_type == "F")

            {

                if(brate>0)

                {

                    amount=amount+(brate *  inse);

                }

                else

                {

                    amount=amount+(rate * inse);

                }

            }

            else

            {

              if(brate>0)

                {

                    amount=amount+(brate * sqcm * inse);

                }

                else

                {

                    amount=amount+(rate * sqcm * inse);

                }  

            }



            }

            else

            {

                var  rate=0;        

                var  brate=0;       

                var i;

                brate= parseFloat($("#brate0").val());      

                if(size_type=="F"){

                    if(brate>0)

                    {

                        amount=amount+(brate  * inse);          

                    }

                    else

                    {

                        var dates= $("#from-input").val();

                        var s_days=dates.split(", ");

                        var c=s_days.length;

                        if(c>free_days)

                        {

                            c=c-free_days;

                        }



                        for(i=0 ; i < c ;i++)

                        {

                            //rate= parseFloat($("#rate"+i).val());                 

                            rate= parseFloat($("#rate0").val());    

                            amount=amount+(rate);

                        }

                    }

                }else{

                    if(brate>0)

                    {

                        amount=amount+(brate * sqcm * inse);            

                    }

                    else

                    {

                        var dates= $("#from-input").val();

                        var s_days=dates.split(", ");

                        var c=s_days.length;

                        if(c>free_days)

                        {

                            c=c-free_days;

                        }



                        for(i=0 ; i < c ;i++)

                        {

                            //rate= parseFloat($("#rate"+i).val());                 

                            rate= parseFloat($("#rate0").val());    

                            amount=amount+(rate*sqcm);

                        }

                    }

                }



            }



        }

    //amount=rate*inse; 

    



    var condition=non_focus_day();  

    if(condition==1)

    {       

        if(nfdc[1]== "Rs")

        {

            t_amount=amount+premimum_a+extra_ca+non_fdc+add_on_a+box_c;

        }

        else

        {

            var non_focus_day_charge=0;

        

            non_focus_day_charge=(amount + extra_ca )* non_fdc /100;

        if(! isNaN(non_focus_day_charge))   {   

            document.getElementById("nfdc").value = non_focus_day_charge;

            t_amount=amount+premimum_a+extra_ca+non_focus_day_charge+add_on_a+box_c;

        }

        }

    //t_amount=amount+premimum_a+extra_ca+non_fdc+add_on_a+box_c;

    }

    else

    {

        t_amount=amount+premimum_a+extra_ca+add_on_a+box_c;

        //t_amount = amount + premimum_a + extra_ca + add_on_a + box_c;

    }

    

    dis_a=(t_amount-box_c)*dis/100;

    

    p_amount=t_amount-dis_a;

    

    if(! isNaN( amount))

    {       

        if(! isNaN(extra_ca))   {document.getElementById("eca").value = extra_ca.toFixed( 2 );}

        

        if(! isNaN(add_on_a))   {document.getElementById("add_a").value = add_on_a.toFixed( 2 );}

        

        if(! isNaN(amount)) {document.getElementById("amount").value = amount.toFixed( 2 );}

        

        if(! isNaN(t_amount))   {document.getElementById("t_amount").value = t_amount.toFixed( 2 );}

        

        document.getElementById("taxable_amount").value = (parseFloat(t_amount)-parseFloat(dis_a)+parseFloat(box_c)).toFixed(2);

        

        

        

        

//      if(document.getElementById('state').value=="6"){

//          document.getElementById('cgst').value=((parseFloat(document.getElementById('taxable_amount').value)*(parseFloat(document.getElementById('gst').value)/2))/100).toFixed(2);

//          document.getElementById('sgst').value=((parseFloat(document.getElementById('taxable_amount').value)*(parseFloat(document.getElementById('gst').value)/2))/100).toFixed(2);

//          document.getElementById('igst').value=0;

//      }

//      else

//      {

//          document.getElementById('cgst').value=0;

//          document.getElementById('sgst').value=0;

//          document.getElementById('igst').value=((parseFloat(document.getElementById('taxable_amount').value)*parseFloat(document.getElementById('gst').value))/100).toFixed(2);

//      }

        

        

            var from_date="";

            if($('#from-input').length){

                from_date=document.getElementById("from-input").value;

            }

            if($('#from-input1').length){

                from_date=document.getElementById("from-input1").value;

            }

             if ($('#add_on').is(":checked")) 

 {

     

var newspaper= $("#newspaper").val();



                if($('#from-input'+newspaper).length){



                    from_date=document.getElementById("from-input"+newspaper).value;  



                }



                    

     



 }

 else if (pack!="")

 {

 $.each(packs, function(i, d)

                    {

                        if($('#from-input'+d.paper_id).length)

                        {

                             from_date= document.getElementById("from-input"+d.paper_id).value;

                        }

                    

                    });

}

else

{

      if($('#from-input').length)

      {

        from_date= document.getElementById("from-input").value;

      }

}

            var res = from_date.split(", ", 1);

           var first_date=res[0]; 

        var second_date="2017-07-01"; 

        //console.log(ro_date);

        if(new Date(first_date)>=new Date(second_date)){

           if(document.getElementById('state').value=="6"){

                document.getElementById('cgst').value=(parseFloat(document.getElementById('taxable_amount').value)*(parseFloat(document.getElementById('gst').value)/2))/100;

                document.getElementById('sgst').value=(parseFloat(document.getElementById('taxable_amount').value)*(parseFloat(document.getElementById('gst').value)/2))/100;

                document.getElementById('igst').value=0;

            } else {

                document.getElementById('cgst').value=0;

                document.getElementById('sgst').value=0;

                document.getElementById('igst').value=(parseFloat(document.getElementById('taxable_amount').value)*parseFloat(document.getElementById('gst').value))/100;

            } 

        }

            else{

                document.getElementById('cgst').value=0;

                document.getElementById('sgst').value=0;

                document.getElementById('igst').value=0;

            }

        

        

        document.getElementById("dis_a").value = dis_a.toFixed( 2 );

        document.getElementById("p_amount").value = (p_amount+(parseFloat(document.getElementById('igst').value))+(parseFloat(document.getElementById('sgst').value))+(parseFloat(document.getElementById('cgst').value))).toFixed(2);      

    }

}



function get_client()

{

    var sel = document.getElementById("client");



    document.getElementById("party").value = sel.options[sel.selectedIndex].text;

}



  function add_paper()

        {

            var x = document.getElementById('add_on_paper');

            var y = document.getElementById('add_pub_dates');

            var z = document.getElementById('ad_on_rate');

            var p = document.getElementById('base_p_date');

            var r = document.getElementById('add_base_dates');

            var s = document.getElementById('pub_dates');

            if ($('#add_on').is(":checked")) 

            {

                x.style.display = 'block';

                y.style.display = 'block';

                z.style.display = 'block';

                r.style.display = 'block';

                p.style.display = 'none';

                s.style.display = 'none';

            } 

            else 

            {  

                s.style.display = 'block'

                r.style.display = 'none';

                x.style.display = 'none';

                y.style.display = 'none';

                z.style.display = 'none';

                p.style.display = 'block';

            }   

        }





function get_paper()

{

    var  paper= $("#newspaper").val();  

    $.ajax({                

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_newspaper",

            type: "POST",               

            async: true ,               

            data: {'paper':paper},

            beforeSend: function(){ document.getElementById("loader").style.display = "block";},

            success: function(data)

                {                    

                    $('#a_newspaper').empty();

                    

                    $('#a_newspaper').append('<option value></option>');

                    // Parse the returned json data

                    var opts = $.parseJSON(data);

                    // Use jQuery's each to iterate over the opts value

                    $.each(opts, function(i, d) {

                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data                 

                    $('#a_newspaper').append('<option value="' + d.id + '">' + d.newspaper_name + ' , '+ d.city_name +'</option>');

                                        

                    }); 

                    

                },

            complete: function() 

                    {                    

                        sel_update();

                    },

            error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Please Select Newspaper!");

                    }

            });

    //$("#newspaper").chosen("destroy");

    //$("#newspaper").chosen();

    //$("#newspaper").trigger("chosen:updated");

    //setTimeout(sel_update, 2000); 

}



function sel_update()

{

    $("#a_newspaper").trigger("chosen:updated");

    document.getElementById("loader").style.display = "none";

}



function ad_on_paper1()

{

    //get_base_price();

    if ($('#add_on').is(":checked")) 

    {

        setTimeout(ad_on_paper,300);

    }

}



var add_mul=[];

  function ad_on_paper(id,ar){



            var arr=$("#a_newspaper").val();



            var cat=$("#cat").val();



            var inse=$("#inse").val();

            

            var color=$("#color").val();



            //var size=$("#size_l").val(); 



            var newspaper=$("#newspaper").val();



            var city=$("#state").val();

           if(arr==null)

            {   



                      alert("Select at least one Add on newspaper!");

                    $('#inse').val(function() 

                                            {

                                                return this.defaultValue;

                                            });

                            return false;



            }



         arr.unshift(newspaper);

        

//alert(arr);

         //   document.getElementById("loader").style.display = "block";  

           var m_id = id;

          // alert(b_id);

            var data="";

            var ar1=[];

            var ar1 = ar;

           // alert(ar);

            var h_code="";



            var htm="";  



            var p_u= document.getElementById('add_pub_dates');      



            p_u.innerHTML=htm;



      $.each(ar, function(i, d) {

         

         

            var form_data= {'m_newspaper':m_id,'a_newspaper':d,'cat':cat,'inse':inse,'city':city,'color':color};

                                        

        $.ajax({

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_ad_on_price1",

            type: "POST",               

            async: true ,               

            data: form_data,            

            success: function(data)

    

           

                {



                    //console.log(data); //return false;



                    var data = $.parseJSON(data);                   



                 //   var p_u= document.getElementById('add_pub_dates');



                   //p_u.innerHTML="";



                    if(data['msg']=='1')



                    {



                        alert("Please Select Add on Heading and Newspaper!");



                        //$("#a_newspaper option[value='"+ data['id'] +"']").attr("selected", false);



                        return false;



                    }



                    if(data['msg']=='2')



                    {



                        alert("Add on Rate not Set with Some Newspaper or Heading.");



                        return false;



                    }

//alert(data['rates'].add_mul);



add_mul[d]=data['rates'].add_mul;



                    //var html='<div class="alert alert-info" ><i class="fa fa-money"></i><strong> DOP and Price of  '+ data['values'].data +'</strong></div>                   <div class="form-group">                     <label for="pack-price" class="col-md-6 alert alert-info" onclick="date_pic_byid('+data['values'].a_newspaper_id +');" style="cursor:crosshair">Publish Dates of '+ data['values'].data +'</label>                    <div class="col-md-6">                       <div class="box"  id="from--input">                     <input class="form-control" name="p_date'+ data['values'].a_newspaper_id +'" type="text" id="from-input'+ data['values'].a_newspaper_id +'" placeholder="mm/dd/yyyy, ..." >                     </div>                      <div class="code-box">                      </div>                    </div>                    </div>                          <div class="form-group">                    <label for="pack-price" class="col-md-3 control-label">Rate</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['values'].a_newspaper_id +'" id="rate'+ data['values'].a_newspaper_id +'" value="'+ data['rates'].price +'">                   </div>                    <label for="pack-price" class="col-md-3 control-label">Extra Charges</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="erate'+ data['values'].a_newspaper_id +'" id="erate'+ data['values'].a_newspaper_id +'"  value="'+ data['rates'].e_price +'">                    </div>                    </div>                    <div class="form-group"><label for="pack-price" class="col-md-3 control-label">B Rate</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="brate'+ data['values'].a_newspaper_id +'" id="brate'+ data['values'].a_newspaper_id +'" value="0">                    </div>                    <label for="pack-price" class="col-md-3 control-label">B Extra Charges</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="berate'+ data['values'].a_newspaper_id +'" id="berate'+ data['values'].a_newspaper_id +'"  value="0">                    </div>                    </div>';

                      var html='<div class="alert alert-info" ><i class="fa fa-money"></i><strong> DOP and Price of  '+ data['values'].data +'</strong></div>                   <div class="form-group">                     <label for="pack-price" class="col-md-6 alert alert-info" onclick="date_pic_byid('+data['values'].a_newspaper_id +');" style="cursor:crosshair">Publish Dates of '+ data['values'].data +'</label>                    <div class="col-md-6">                       <div class="box"  id="from--input">                     <input class="form-control" name="p_date'+ data['values'].a_newspaper_id +'" type="text" id="from-input'+ data['values'].a_newspaper_id +'" data-id="'+ data['values'].a_newspaper_id +'" data-toggle="modal" data-target="#dopModal" onclick="showModal('+data['values'].a_newspaper_id+')" onblur="get_addon_dop_price('+data['values'].a_newspaper_id+');" placeholder="mm/dd/yyyy, ..." >                       </div>                      <div class="code-box">                      </div>                    </div>                    </div>                          <div class="form-group">                    <label for="pack-price" class="col-md-3 control-label">Rate</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['values'].a_newspaper_id +'" id="rate'+ data['values'].a_newspaper_id +'" value="'+ data['rates'].price +'">                  </div>                     <label for="pack-price" class="col-md-3 control-label">B Rate</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="brate'+ data['values'].a_newspaper_id +'" id="brate'+ data['values'].a_newspaper_id +'" value="0">                                        </div>                    </div>';

                    p_u.insertAdjacentHTML('beforeend', html);

                    

              // date_pic_byid1(d);

                },                



                error:  function (jqXHR, exception) {



                    var msg = '';



                    if (jqXHR.status === 0){



                        msg = 'Not connect.\n Verify Network.';



                    } else if (jqXHR.status == 404){



                        msg = 'Requested page not found. [404]';



                    } else if (jqXHR.status== 500){



                        msg = 'Internal Server Error [500].';



                    } else if (exception==='parsererror') {



                        msg = 'Requested JSON parse failed.';



                    } else if (exception==='timeout'){



                        msg = 'Time out error.';



                    } else if (exception==='abort'){



                        msg = 'Ajax request aborted.';



                    } else {



                        msg = 'Uncaught Error.\n' + jqXHR.responseText;



                    }



                    $('#post').html(msg);



                }



            });

          });

         /*  $.each(arr, function(i, d){



                date_pic_byid1(d);



            });*/

            document.getElementById("loader").style.display = "none";



            setTimeout(get_premimum_price,3000);

          

                   



           



        }



var base_id=0;



function get_base_price()

{

    var arr = $("#a_newspaper").val();

    var newspaper= $("#newspaper").val();

    

    if(arr==null)

    {   

        alert("Select at least one Add on newspaper!");

        return false;

    }   

    arr.unshift(newspaper);

    

    //var  city= $("#city").val();

    var  cat= $("#cat").val();

    var  inse= $("#inse").val();

    var color= $("#color").val();

    var city=$("#state").val();

    var p_u= document.getElementById('add_base_dates');     

    p_u.innerHTML="";

    

 if(newspaper=="")

        {

            alert("Select Newspaper");

           $('#newspaper').val(function() 

                           {

                return this.defaultValue;

            });

          exit();

        }

         if( cat=="")

        {

            alert("Select Position ");

            $('#cat').val(function() 

                           {

                return this.defaultValue;

            });

         exit();

        }

         if( color=="")

        {

            alert("Select  Color");

            $('#color').val(function() 

                           {

                return this.defaultValue;

            });

         exit();

        }

 if(  inse=="" )

        {

            alert("Select insertion");

            // $('#inse').focus()

            $('#inse').val(function() 

                           {

                return this.defaultValue;

            });

         exit();

        }

/*  if ($('#column_type2').is(":checked")) 

    {

        var size_type="D"

    }

    else

    {

        var size_type="S"

    }

    

*/  

    var form_data= {'arr':arr,'newspaper':newspaper,'cat':cat,'inse':inse,'color':color,'city':city};

    

    $.ajax({

            url: "<?php echo base_url(); ?>" + "admin/display_ro/get_base_price",

            type: "POST",               

            async: true ,               

            data: form_data,

            beforeSend: function(){ document.getElementById("loader").style.display = "block";},

            success: function(data)

                {

                      document.getElementById("loader").style.display = "none";

                      

                    if(data=='1')

                    {

                        alert("Select Newspaper and Heading First.");

                        $('#inse').val(function() 

                        {

                            return this.defaultValue;

                        });

                        return false;

                    }

                    if(data=='2')

                    {

                        alert("Base Rate not Set with this Heading and Color.");

                        $('#inse').val(function() 

                        {

                            return this.defaultValue;

                        });

                        return false;

                    }

                    

                    //alert("Ro added Successfully");                   

                    

                    // Parse the returned json data

                    var data = $.parseJSON(data);

                    /* Use jQuery's each to iterate over the tr value

                    document.getElementById("rate").value = price.ad_price;

                    document.getElementById("erate").value = price.extra_price;

                    document.getElementById("mrate").value = price.mul_rate;

                    document.getElementById("merate").value = price.mul_ex;

                    document.getElementById("brate").value = price.b_rate;

                    document.getElementById("comm1").value = price.discount;

                    //document.getElementById("nfdc").value = price.discount;*/

                    //min_w=price.min_w;

                        size_type=data['rates'].size_type

                        //alert("size_type"+size_type);

                    f_min_l=data['rates'].f_min_l;

                    f_min_r=data['rates'].f_min_r;

                    s_min_l=data['rates'].s_min_l;

                    s_min_r=data['rates'].s_min_r;

                    s_max_l=data['rates'].s_max_l;

                    s_max_r=data['rates'].s_max_r;

                    d_min_l=data['rates'].d_min_l;

                    d_min_r=data['rates'].d_min_r;

                    d_max_l=data['rates'].d_max_l;

                    d_max_r=data['rates'].d_max_r;

                    if (data['rates'].size_type == 'F')

                    {

                    document.getElementById("size_l").min = f_min_l;

                    document.getElementById("size_r").min = f_min_r;

                    document.getElementById("size_r").value = f_min_r;

                    }

                    else if (data['rates'].size_type == 'S')

                    {

                    document.getElementById("size_l").min = s_min_l;

                    document.getElementById("size_r").min = s_min_r;

                    document.getElementById("size_l").max = s_max_l;

                    document.getElementById("size_r").max = s_max_r;

                    document.getElementById("size_r").value = s_max_r;

                    }

                    if (data['rates'].size_type == 'D')

                    {

                    document.getElementById("size_l").min = d_min_l;

                    document.getElementById("size_r").min = d_min_r;

                    document.getElementById("size_l").max = d_max_l;

                    document.getElementById("size_r").max = d_max_r;

                document.getElementById("size_r").value = d_max_r;

                    }

                

                    //document.getElementById("w_count1").value = price.min_w;

                    document.getElementById("comm1").value = data['rates'].discount;

                        document.getElementById('gst').value=data['rates'].gst;

                    $("#unit option[value='" + data['rates'].unit +"']").attr("selected", true);

                    

                    days=data['rates'].day_id.split(",");

                    nfdc=data['rates'].non_focus_charge.split(",");

                    

                    if(nfdc[1] == 'Rs')

                    {

                        //alert(nfdc[1]+"   "+nfdc[0]);

                        document.getElementById("nfdc").value = nfdc[0];

                    }

                    

                    document.getElementById("comm2").value = 0;

                    document.getElementById("comm3").value = 0;

                    document.getElementById("comm4").value = 0;

                    document.getElementById("comm5").value = 0;

                    document.getElementById("comm6").value = 0;

                    document.getElementById("comm7").value = 0;

                    document.getElementById("comm8").value = 0;

                    commission();

                    /*

                    //var amount=price.ad_price*inse;

                    //document.getElementById("amount").value = amount.toFixed( 2 );

                    //amount_calculate();                   

                    */

                    base_id=data['rates'].newspaper_id;

                //  alert(base_id);

                    var html='<div class="title" style="background-color:#fff;"><i class="fa fa-money"></i><strong> DOP and Price of  '+ data['rates'].newspaper_name +' ,'+ data['rates'].city_name +'</strong></div>                         <div class="form-group"> <label for="pack-price" class="col-md-6 control-label" onclick="date_pic_byid('+data['rates'].newspaper_id+');">Publish Dates of '+ data['rates'].newspaper_name +' ,'+ data['rates'].city_name +'</label> <div class="col-md-6">   <div class="box"  id="from--input"> <input class="form-control" name="p_date'+ data['rates'].newspaper_id +'" type="text" id="from-input'+ data['rates'].newspaper_id +'" data-id="'+ data['rates'].newspaper_id+'" data-toggle="modal" data-target="#dopModal" onclick="showModal('+data['rates'].newspaper_id+')" onblur="get_base_dop_price(base_id);" placeholder="mm/dd/yyyy, ..." >   </div>  <div class="code-box">  </div>  </div>  </div>                                                                       <div class="form-group"><label for="pack-price" class="col-md-3 control-label">Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['rates'].newspaper_id +'" id="rate'+ data['rates'].newspaper_id +'" value="'+ data['rates'].ad_price +'"></div><label for="pack-price" class="col-md-3 control-label">B Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="brate'+ data['rates'].newspaper_id +'" id="brate'+ data['rates'].newspaper_id +'" value="0"></div></div> ';

                    

                    /* <div class="form-group"><label for="pack-price" class="col-md-3 control-label">B Rate</label><div class="col-md-3"><input type="text" placeholder="" class="form-control" name="brate'+ data['values'].newspaper_id +'" id="brate'+ data['values'].newspaper_id +'"></div></div> */

                    

                    var p_u= document.getElementById('add_base_dates');

                    

                    p_u.innerHTML=html;

                    //p_u.insertAdjacentHTML('beforeend', html);

                    date_pic_byid(base_id);

                     for( var i = 0; i < arr.length; i++)

                     { 

                         

                           if ( arr[i] === data['value']) {

                             arr.splice(i, 1); 

                           }

                     }

                    

                }, 

                complete:function()

                {

                    ad_on_paper(newspaper,arr);

                },

            error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Error in base rate with this Newspaper or Heading.");

                    }

            });

            



}



 function get_agencies()

             {

                     var id = $("#client").val();



            $.ajax({                



                url: "<?php echo base_url(); ?>" + "admin/display_ro/get_agency",



                type: "POST",               



                async: true ,               



                data: {'id':id},



                beforeSend: function(){ document.getElementById("loader").style.display = "block";},



                success: function(data)



                {



                    document.getElementById("loader").style.display = "none";



                    $('#pub_id').empty();



                    //myFunction();



                    //$('#premimum').append('<option value="">'"premimum"'</option>');



                    // Parse the returned json data



                    var opts = $.parseJSON(data);



                    // Use jQuery's each to iterate over the opts value



                    $.each(opts, function(i, d) {



                        // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data                 



                        $('#pub_id').append('<option value="' + d.agency_id + '">' + d.agency_name +  ' </option>');



                    });



                    /*



                    //$('#premimum').empty();



                    //myFunction();



                    //$('#premimum').append('<option value="">'"premimum"'</option>');



                    // Parse the returned json data



                    var opts = $.parseJSON(data);



                    // Use jQuery's each to iterate over the opts value



                    var htmlcode=" ";



                    $.each(opts, function(i, d) {



                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data



                    htmlcode=htmlcode+'<input type="radio" name="premimum" value="' + d.id + '"/> '+ d.premimum + ' % , ' + d.color;



                    }); 



                    document.getElementById("premimum123").innerHTML = htmlcode;



                    */



                },



                complete: function() 



                {                    



                    sel_update_pre();



                },



                error: function() 



                {



                    document.getElementById("loader").style.display = "none";



                    alert("There is some error!:(");



                }



            });



    }



var outbound=0;





 function get_size()

{

    var  size_l= parseFloat($("#size_l").val());

    var  size_r= parseFloat($("#size_r").val());

        if($("#add_on").is(":checked"))

        {

                    if(f_min_l == size_l && size_r==f_min_r)

                    {

                      size_type="F";

                    //   alert("Size type" + "F");

                       document.getElementById("rate"+base_id).value = datarate['rates'].f_rate;

                    }

                   

                

                else if((s_min_l <= size_l  && size_l <=s_max_l)&&(s_min_r <= size_r && size_r<=s_max_r))

                    {

                        size_type="S";

                       // alert("Size type" + "S");

                         document.getElementById("rate"+base_id).value = datarate['rates'].ad_price;

                    }

                    

                else if(s_min_l <= size_l && size_r<=s_max_l)

                    {

                        size_type="S";

                      // alert("Size type" + "D");

                       document.getElementById("rate"+base_id).value = datarate['rates'].ad_price;

                    }

                    

            

            

                else

                {

                    size_type="S";

                //  alert("Size type" + "Notfound");

                }

        }

        else

        {

               if(f_min_l == size_l && size_r<=f_min_r)

                    {

                       size_type="F";

                      // alert("Size type" + "F");

                       document.getElementById("rate0").value = datarate['rates'].f_rate;

                    }

                   

                

                else if((s_min_l <= size_l  && size_l <=s_max_l)&&(s_min_r <= size_r && size_r<=s_max_r))

                    { size_type="S";

                      //  alert("Size type" + "S");

                         document.getElementById("rate0").value = datarate['rates'].ad_price;

                    }

                    

                else if(s_min_l <= size_l && size_r<=s_max_l)

                    { size_type="S";

                      // alert("Size type" + "D");

                    }

                    

            

            

                else

                { size_type="S";

                    alert("Size type" + "Notfound");

                } 

        }



}

 function showModal(data)

                   {

                        My_id=data;

                       //alert(My_id);

                       $(".modal-body #hiddenvalue").val(My_id);

                   }

$(document).ready(function (){

        

    $('.js-example-basic-single').select2();

                    });

</script>

