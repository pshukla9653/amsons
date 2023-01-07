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
        <form action="<?php echo base_url('admin/book_ads/edit/'.$book_ad->id); ?>" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
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
                            <strong>Edit Text Ro Booking</strong>
                        </h2>
                    </div>
                    <!-- END General Data Title -->
                    <!-- General Data Content -->
                    <div class="form-group">
                            <label for="book_date" class="col-md-3 control-label">Book Date</label>
                            <div class="col-md-9">
                                  <input type="hidden" name="ro_no" id="ro_no" value="<?php echo $book_ad->ro_no;?>">
                                <input type="text" id="book_date" name="book_date" class="form-control input-datepicker-close" placeholder="yyyy-mm-dd" value="<?php echo $book_ad->book_date; ?>">
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Bill To <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                                <select id="client" name="client"  onchange="get_client();" style="width:100%;" class="js-example-basic-single" data-placeholder="Choose Classes" required>
                                <option value="" >Select Client</option>
                                <?php foreach($clients as $client){ ?>
                                <option value="<?php echo $client->id; ?>" <?php echo ($book_ad->u_id==$client->id)?'selected':'';?>><?php echo $client->client_name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pack-price" class="col-md-3 control-label">Client Name</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" class="form-control" value="<?php echo $book_ad->party; ?>" name="party" id="party" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="left-side">
                        <label class="col-md-5 control-label" for="example-chosen-multiple">Publication  Newspaper <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select id="newspaper" name="newspaper"  style="width:100%;"class="js-example-basic-single" data-placeholder="Choose Newspaper" onchange="get_state();" required>             
                                <option value="">Choose One </option>
                                <?php foreach($newspapers as $newspaper){ ?>
                                <option value="<?php echo $newspaper->id; ?>" <?php echo ($book_ad->paper_city_id==$newspaper->id)?'selected':'';?>><?php echo $newspaper->newspaper_name .",".$newspaper->city_name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                        </div>
                      <div class="right-side">
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Select State <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <select id="state" class="form-control" data-placeholder="Choose City" required onchange="amount_calculate()">
                                <option value="" >Select State</option>
                                <?php foreach($states as $row){
                  
                                ?>
                                <option value="<?php echo $row->id; ?>" <?php if($book_ad->state_id==$row->id){ echo "selected"; } ?> ><?php echo $row->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <div class="left-side">
                        <label class="col-md-5 control-label">Add On</label>
                        <div class="col-md-7">
                            <label class="switch switch-primary">
                                <input type="checkbox" onchange="add_paper();" <?php echo ($book_ad->ro_type=='M')?'checked':'unchecked';?>  name="add_on" id="add_on">
                                <span></span>
                            </label>
                        </div>
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
                        <label for="pack-price" class="col-md-3 control-label">Insertion </label>
                        <div class="col-md-9">
                            <input type="number"  onchange="date_pic1();" onblur="date_pic1();" min="1" placeholder="" class="form-control" name="inse" id="inse" value="<?php echo $book_ad->insertion ?>" required>
                        </div>
                    </div>
                </div>

                    <div class="form-group">
                        <div class="left-side">
                        <label class="col-md-5 control-label" for="example-chosen-multiple">Scheme </label>
                        <div class="col-md-7">
                            <select id="scheme" name="scheme" onchange="get_scheme_price();"  class="form-control" data-placeholder="Choose one">
                                <option value="">Scheme</option>
                            </select>
                        </div>
                    </div>
                   <div class="right-side">
                        <label for="pack-price" class="col-md-3 control-label">Material</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" class="form-control" value="<?php echo $book_ad->material ?>" name="material" id="material" >
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <label for="pack-price" class="col-md-3 control-label">Box</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" class="form-control" name="box" id="box" value="<?php echo $book_ad->box; ?>">
                        </div>
                    </div>                      
                    <div class="form-group">
                        <label for="example-textarea-input" class="col-md-3 control-label">Matter <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea placeholder="Ad Matter.." onkeyup="wordcount(this.value)"  onchange="ad_on_paper1();" class="form-control" rows="4" name="matter" id="matter" minlength="16"><?php echo $book_ad->content; ?></textarea>
                            <div id="w_count"></div>
                            <script type="text/javascript">
                                var cnt;
                                function wordcount(count) {
                                    var words = count.split(/\s/);
                                    cnt = words.length;
                                    document.getElementById("w_count").innerHTML = cnt;
                                    var co=parseInt($("#w_count1").val());
                                    if(co>cnt && cnt < min_w)
                                    {
                                        var ele1 = document.getElementById('w_count1');
                                        ele1.value = min_w;
                                    }
                                    else
                                    {
                                        var ele1 = document.getElementById('w_count1');
                                        ele1.value = cnt;
                                    }
                                   
                                    amount_calculate();
                                     get_premimum_price();
                                }
                            </script>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pack-price" class="col-md-3 control-label">No. of words/Lines <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" placeholder="" class="form-control" name="w_count1" id="w_count1" value="<?php echo $book_ad->size_words; ?>" onchange="amount_calculate();">
                        </div>
                        <div class="col-md-3">
                            <select id="unit" name="unit" class="form-control" data-placeholder="" required>
                                <option value="">Choose</option>
                                <option value="W"<?php if ($book_ad->unit == "W") echo 'selected="selected"'; ?>>Word</option>
                                <option value="L"<?php if ($book_ad->unit == "L") echo 'selected="selected"'; ?>>Line</option>
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
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="upload_file">Change file</label>
                        <div class="col-md-9">
                            <?php if($book_ad->uploaded_file){ echo "<a href='".base_url()."images/ro/".$book_ad->uploaded_file."'>Previous Attachment</a>"; }?>
                            <input type="file" class="form-control" name="upload_file" id="upload_file">
                            <br>5 MB Max file size allowed
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
                    <div style="background-color:#CECECE; height: 190px; overflow-y: scroll;margin-top: -11px;">
                        <div id="base_p_date">
                            <div class="form-group">
                                <label for="pack-price" class="col-md-6 control-label">Main Paper Publish Dates <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <div class="box"  id="from--input">
                                        <input class="form-control" name="p_date" type="text" id="from-input" placeholder="mm/dd/yyyy, mm/dd/yyyy, ..."> <div><input type="button" data-toggle="modal" data-target="#dopModal" onclick="showModal('')" value="edit"></div>  
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
                                <label for="pack-price" class="col-md-3 control-label"></label>
                                <div class="col-md-3">
                                    <div class="btn btn-sm btn-primary" onclick="get_pack_price();">
                                        Refresh Rate
                                    </div>
                                </div>
                            </div>              
                        </div>
                        <div id="ad_on_rate">
                        </div>
                    </div>
                    <div class="form-group">
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
                                    <input type="checkbox" <?php echo ($book_ad->other_day_f=='1')?'checked':'unchecked';?> name="odf" id="odf" onchange="get_dop_price();">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="name" class="col-md-3 control-label">Commission %</label>
                    <div class="col-md-2">
                        <input type="text" min="0" placeholder="0" onchange="commission();" class="form-control" name="comm1" id="comm1" value="<?php echo $book_ad->comm1; ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm2" id="comm2" value="<?php echo $book_ad->comm2; ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm3" id="comm3" value="<?php echo $book_ad->comm3;  ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm4" id="comm4" value="<?php echo $book_ad->comm4; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label"></label>
                    <div class="col-md-2">
                        <input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm5" id="comm5" value="<?php echo $book_ad->comm5; ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm6" id="comm6" value="<?php echo $book_ad->comm6; ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm7" id="comm7" value="<?php echo $book_ad->comm7; ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" min="0" placeholder="0" onchange="commission();"  class="form-control" name="comm8" id="comm8" value="<?php echo $book_ad->comm8; ?>">
                    </div>
                </div>
                    <div class="form-group">
                        <label for="pack-price" class="col-md-3 control-label">Discount %</label>
                        <div class="col-md-3">
                            <input type="text" min="0" placeholder="" value="0" class="form-control" name="dis" id="dis" required>
                        </div>
                        <label class="col-md-3 control-label" for="example-chosen-multiple">Premimum</label>
                        <div class="col-md-3">
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
                            <input type="text" min="0"  value="0" onchange="amount_calculate();" placeholder="" class="form-control" name="premimum_a" id="premimum_a" value="<?php echo $book_ad->premium_val; ?>">
                        </div>            
                    </div>
                    <div class="form-group">
                        <label for="pack-price" class="col-md-3 control-label">Extra Charges</label>
                        <div class="col-md-3">
                            <input type="text" min="0"  value="0" onchange="amount_calculate();" placeholder="" class="form-control" name="eca" id="eca">
                        </div>
                        <label for="pack-price" class="col-md-3 control-label">Non Focusing Day Charge </label>
                        <div class="col-md-3">
                            <input type="text" min="0"  value="0"  onchange="amount_calculate();" placeholder="" class="form-control" name="nfdc" id="nfdc">
                        </div>            
                    </div>
                    <div class="form-group">
                        <label for="pack-price" class="col-md-3 control-label">Add On Amount</label>
                        <div class="col-md-3">
                            <input type="text" min="0" value="0"  onchange="amount_calculate();" placeholder="" class="form-control" name="add_a" id="add_a">
                        </div>
                        <label for="pack-price" class="col-md-3 control-label">Total Amount</label>
                        <div class="col-md-3">
                            <input type="text" min="0" value="0"   onchange="amount_calculate();" placeholder="" class="form-control" name="t_amount" id="t_amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pack-price" class="col-md-3 control-label">Box Charges</label>
                        <div class="col-md-3">
                            <input type="text" min="0" value="0"  onchange="amount_calculate();" placeholder="" class="form-control" name="box_c" id="box_c">
                        </div>
                        <label for="pack-price" class="col-md-3 control-label">Discount Amount</label>
                        <div class="col-md-3">
                            <input type="text" min="0" value="0"   onchange="amount_calculate();" placeholder="" class="form-control" name="dis_a" id="dis_a">
                        </div>            
                    </div>
                    <div class="form-group">
                        <label for="pack-price" class="col-md-3 control-label">Taxable Amount</label>
                        <div class="col-md-3">
                            <input type="text" value="0" placeholder="" class="form-control" name="taxable_amount" id="taxable_amount">
                        </div>
                        <label for="pack-price" class="col-md-3 control-label">IGST</label>
                        <div class="col-md-3">
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
                            <input type="text" value=""  step="any" min="0"  onchange="amount_calculate();" placeholder="" class="form-control" name="p_amount" id="p_amount">
                        </div>            
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
             <div><textarea name="dops" id="mdops" rows="10" cols="10" value=""></textarea>
             <button type="button" id="clearall" >Clear Dates</button></div>
             <div><input type="checkbox" name="daily" id="daily" unchecked onchange="add_date();" ><label for="daily">Daily</label>
             <input type="checkbox" name="after" id="after" unchecked ><label for="after">After</label><input type="number" name ="days" id="days" onchange="add_date();"><label for="days">Days</label> 
              <input type="checkbox" name="weekly" id="weekly" unchecked onchange="add_date();" ><label for="weekly">Weekly</label>
               <input type="checkbox" name="monthly" id="monthly" unchecked onchange="add_date();" ><label for="monthly">Monthly</label>
                <input type="checkbox" name="yearly" id="yearly" unchecked onchange="add_date();" ><label for="yearly">yearly</label>
               <input type="checkbox" name="odf1" id="odf1" unchecked onchange="add_date();" ><label for="odf1">Other Days follow</label>
               <input type="checkbox" name="same_day" id="same_day" unchecked onchange="add_date();" ><label for="same_day">Same days</label>
               </div>
             </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal End-->
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <div class="btn btn-sm btn-primary" onclick="get_premimum_price();">
                                Calculate Rate
                            </div>
                            <input class="btn btn-sm btn-primary" type="button" id="save" value="Save" onclick="save_ro();">      
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
     <script type="text/javascript">
    
    $(function () {
        var d = new Date();
           var currMonth = d.getMonth();
           var currYear = d.getFullYear();
           var currDate = d.getDate
           var startDate = new Date(currYear, currMonth, currDate);

           $("#name_dop").datepicker();
           $("#name_dop").datepicker("setDate", startDate);
        
    });
    
    
    $("#clearall").click(function(){
       var id= My_id
      // alert(id);
       $("#from-input"+id).val('');
    });
</script>
    <script  type="text/javascript">
        var days =[9,9,9,9,9,9,9];
        var min_w=0;
        var nfdc=[0,''];
        var free_days=0;
        var  m_unit="";
        var My_id =0;
     var premimum_type="";
  var inse_dop =0;
        var premimum_value=0;
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

            var  newspaper= $("#newspaper").val();

            //var  city= $("#city").val();

            var  cat= $("#cat").val();

            var  inse= $("#inse").val();
            
            var city=$("#state").val();
            
            var size= $("#w_count1").val();
            if(newspaper=="" || cat=="" || inse=="")

            {

                alert("Select Newspaper,City and Heading");

                $('#inse').val(function(){ 

                    return this.defaultValue;

                });

                return false;

            }

            var form_data= {'newspaper':newspaper,'cat':cat,'inse':inse,'city':city};

            $.ajax({

                url: "<?php echo base_url(); ?>" + "admin/book_ads/get_price",

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

                        alert("Rate not Set with this Newspaper or Heading...");

                        $('#inse').val(function() 

                                       {

                            return this.defaultValue;

                        });

                        return false;

                    }

                    var price = $.parseJSON(data);

                    min_w=price.min_w;
                    
                    m_unit=price.unit;
                    //var size = document.getElementById("w_count1").value;
                    
                   // if( size < min_w )
                   // {

                   // document.getElementById("w_count1").value = price.min_w;
                   //   $("#unit option[value='" +price.unit +"']").attr("selected", true);
                   // }
                     $("#unit option[value='" + price.unit +"']").attr("selected", true);

                    document.getElementById("comm1").value = price.discount;

                    //document.getElementById('dis').value=price.discount;

                    //document.getElementById('dis').value=20;

                    document.getElementById('gst').value=price.gst;

                  

                    days=price.day_id.split(",");

                    nfdc=price.non_focus_charge.split(",");

                    if(nfdc[1] == 'Rs')

                    {

                        //alert(nfdc[1]+"   "+nfdc[0]);

                        document.getElementById("nfdc").value = nfdc[0];

                    }
                    else
                    {
                        document.getElementById("nfdc").value=0;
                    }

                    document.getElementById("comm2").value = 0;

                    document.getElementById("comm3").value = 0;

                    document.getElementById("comm4").value = 0;

                    document.getElementById("comm5").value = 0;

                    document.getElementById("comm6").value = 0;

                    document.getElementById("comm7").value = 0;

                    document.getElementById("comm8").value = 0;

                    commission();

                },                
complete: function() 
                {
                   date_pic();
                },
                error: function() 

                {

                    document.getElementById("loader").style.display = "none";

                    alert("Rate not Set with this Newspaper or Heading.....");

                }

            });

        }
        
        function date_pic1() 

        {
             if ($('#add_on').is(":checked"))
             {
                 
                 var x = document.getElementById('add_base_dates');

                    x.style.display = 'block';
                    var x = document.getElementById('add_pub_dates');

                    x.style.display = 'block';
                    var x = document.getElementById('ad_on_rate');

                    x.style.display = 'block';
                    var x = document.getElementById('base_p_date');
                      
                    x.style.display = 'none';

                    var x = document.getElementById('pub_dates');
                 
                    x.style.display = 'none';

                    var x = document.getElementById('pack_rate');

                    x.style.display = 'none';
                get_package();
            get_base_price();
             
             }
             else
             {
               
               
                 
                 
                 var x = document.getElementById('add_base_dates');

                    x.style.display = 'none';
                    var x = document.getElementById('add_pub_dates');

                    x.style.display = 'none';
                    var x = document.getElementById('ad_on_rate');

                    x.style.display = 'none';
                    var x = document.getElementById('base_p_date');

                    x.style.display = 'block';

                    x = document.getElementById('pub_dates');

                    x.style.display = 'block';

                    x = document.getElementById('pack_rate');

                    x.style.display = 'none';
                 
               get_price();
                get_package();

            $('#from-input').multiDatesPicker('resetDates', 'picked');

            date_pic();  
             }
        }

        
        var flag=0;
      function date_pic(id=null)

        {

            var  inse= $("#inse").val();
var data= jQuery.parseJSON('<?php echo json_encode($dops) ?>'); 
            var dop="";
         var dops1=[];
         var j=0;
        
                       $.each(data, function(i, d) {
                dop=d.dop;
                
          
            
             var dop1=dop.split(", ");
             
            $.each(dop1, function(i, d) {
                if(dop1[i]!=NaN || dops1[i]!='NaN/NaN/NaN')
                {
                dops1[j] = new Date(dop1[i]);
               j++
                }
               });
            });
               
           if( dops1.length!=0||dops1!=NaN || dops1!='NaN/NaN/NaN')
             {
            $("#from-input").multiDatesPicker({
                addDates: dops1,
                  
                    });

             }
            var today = new Date();
            $( "#from-input" ).multiDatesPicker({ minDate: 0});

              

            $('#from-input').multiDatesPicker({

                //minDate: 0,

                onSelect:function()

                {     

                    var dates= $("#from-input").val();
                    
                     //var dateObject = $(this).datepicker('getDate'); 
        

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
                     $("#publishdates").val(s_days );
                        //document.getElementById("ui-datepicker-div").style.display = "none";

                      

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
            {   
                get_base_price();
            }
            else
            {
                get_price();
            }
            $('#from-input').multiDatesPicker('resetDates', 'picked');
            date_pic();
        }




        function date_pic_byid(paper_id)
        { 
            var id="from-input"+paper_id;
            var  inse= $("#inse").val();
            var  cat= $("#cat").val();
            var form_data= {'newspaper':paper_id,'cat':cat,'inse':inse};
            $.ajax({
                url: "<?php echo base_url(); ?>" + "admin/book_ads/get_fdays",
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
                        return false;
                    }
                    if(data=='2')
                    {
                        alert("Rate not Set with this Newspaper or Heading.");
                        return false;
                    }
                    var price = $.parseJSON(data);
                    days=price.day_id.split(",");
                },
                complete: function() 
                {
                    date_pic_byid1(paper_id);
                },
                error: function() 
                {
                    document.getElementById("loader").style.display = "none";
                    alert("Rate not Set with this Newspaper or Heading.");
                }
            });
        }

        
        
        
        function date_pic_byid1(paper_id)
        {
           var id=paper_id;
            var data= jQuery.parseJSON('<?php echo json_encode($dops) ?>'); 
            var dop="";
             var dops1=[];
            $.each(data, function(i, d) {
                if(paper_id == d.paper_id)
                {
                    dop=d.dop;
                
            var dops=dop.split(", ");
            $.each(dops, function(i, d) {
                if(dops[i]!=NaN || dops[i]!='NaN/NaN/NaN')
                {
                dops[i] = new Date(dops[i]);
                }
            });
            
            $("#from-input"+id).multiDatesPicker({
                addDates: dops,
                  
                  

            
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
                
            });
            $.each(data, function(i, d) {
                 if(paper_id == d.paper_id)
                {
            get_addon_dop_price(d.paper_id);
                }
            });
             get_base_dop_price(base_id);
      
            var  inse= $("#inse").val();
            var today = new Date();
            $("#from-input"+id).multiDatesPicker({
                
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

            if(newspaper=="" || cat=="" || inse=="" )

            {

                alert("Select Newspaper,City and Heading");

                $('#inse').val(function() 

                               {

                    return this.defaultValue;

                });

                return false;

            }

            var dates= $("#from-input").val();
           // alert(dates);

            var s_days=dates.split(", ");

            var c=s_days.length;

            var i;

            var p_u = document.getElementById('pub_dates');

            p_u.innerHTML = "";

            for(i=0; i<c ;i++)

            {

                //alert(s_days[i]);

                var form_data= {'newspaper':newspaper,'cat':cat,'inse':inse,'s_date':s_days[i],'count':i};

                //alert(s_days[i]);

                $.ajax({

                    url: "<?php echo base_url(); ?>" + "admin/book_ads/get_dop_price",

                    type: "POST",       

                    async: true ,               

                    data: form_data,

                    beforeSend: function(){ document.getElementById("loader").style.display = "block";},

                    success: function(data)

                    {           

                        if(data=='1')

                        {

                            alert("Rate not Set with this Newspaper or Heading on some Date.");

                            return false;

                        }

                        // Parse the returned json data

                        var data = $.parseJSON(data);

                        var html='<div id="rate_dis'+ data['values'].count +'" style="display: none;"><div class="title" style="background-color:#fff;"><i class="fa fa-money"></i><strong> Rate Of Date '+ data['values'].s_date +'</strong></div><div class="form-group"><label for="pack-price" class="col-md-3 control-label">Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['values'].count +'" id="rate'+ data['values'].count +'"></div><label for="pack-price" class="col-md-3 control-label">Extra Charges</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="erate'+ data['values'].count +'" id="erate'+ data['values'].count +'"></div></div><div class="form-group"><label for="pack-price" class="col-md-3 control-label">B Rate</label><div class="col-md-3"><input type="text" onchange="amount_calculate();" placeholder="" class="form-control" name="brate'+ data['values'].count +'" id="brate'+ data['values'].count +'"></div><label for="pack-price" class="col-md-3 control-label">B Extra Charges</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="berate'+ data['values'].count +'" id="berate'+ data['values'].count +'"></div></div></div>';

                        p_u.insertAdjacentHTML('beforeend', html);

                        document.getElementById("rate"+data['values'].count).value = data['rates'].ad_price;

                        document.getElementById("erate"+data['values'].count).value = data['rates'].extra_price;

                        document.getElementById("brate"+data['values'].count).value = data['rates'].b_rate;

                        document.getElementById("berate"+data['values'].count).value = 0;

                    },                

                    error: function() 

                    {

                        document.getElementById("loader").style.display = "none";

                        alert("Rate not Set with this Newspaper or Heading.");

                    }

                });



                //var d1 = document.getElementById('pub_dates');

            }

            setTimeout(amount_calculate, 1500);

            setTimeout(hide_div, 2000);

            document.getElementById("loader").style.display = "none"; 

        }




        function hide_div()
        {
            var x = document.getElementById('rate_dis0');
            x.style.display = 'block';

            var  inse= $("#inse").val();
            var  rate=0;
            var  erate=0;
            var  brate=0;
            var  berate=0;
            var i;
            var dates= $("#from-input").val();
            var s_days=dates.split(", ");
            var c=s_days.length;

            for(i=1 ; i < c ;i++)
            {
                rate= parseFloat($("#rate"+i).val());
                erate= parseFloat($("#erate"+i).val());

                o_rate= parseFloat($("#rate"+(i-1)).val());
                o_erate= parseFloat($("#erate"+(i-1)).val());


                if(o_rate!=rate && o_erate!=erate)
                {
                    var x = document.getElementById('rate_dis'+i);
                    x.style.display = 'block';
                }
            }
        }




      function non_focus_day(){
           // var id=id;
           if ($('#add_on').is(":checked"))
           {
            var  dates= $("#from-input"+base_id).val();
           }
           else
           {
                var  dates= $("#from-input").val();
           }
           if(dates.length!="")
           {
            var s_days=dates.split(", ");

            var i;

            var f=1;

            for(i=0; i<(s_days.length);i++) 

            {

                var fl=0;

                var d = new Date(s_days[i]);

                var day_id=d.getDay();

                var j;

                for(j=0; j < 7; j++){

                    if(day_id == days[j]){

                        fl=1;       

                    }     

                }

                if(fl==0){

                    f=0;

                }

            }

}

            if(f==0){

                return 1; 

            } else {

                return 0;

            }

        }




        function date_val()
        {
            var  dates= $("#from-input").val();
           // alert(dates);
        }




        function save_ro()
        { $("#save").prop("disabled",true);
            var  client= $("#client").val();
            var  newspaper= $("#newspaper").val();
            var  state_id= $("#state").val();
            var  title= $("#title").val();
            var  matter= $("#matter").val();
            var  cat= $("#cat").val();
            var  sheading= $("#sheading").val();
            var  pack= $("#pack").val();
            var  inse= $("#inse").val();
            var  scheme= $("#scheme").val();
            var  material= $("#material").val();
            var  party= $("#party").val();
            var  premimum= $("#premimum").val();
            var  box= $("#box").val();
            var  remark= $("#remark").val();
            var prem=parseFloat(premimum_value);
             var dis = $("#dis").val();
  var ro_no=$("#ro_no").val();
          //  var min_w = min_w;
       //    var  inse_dop= inse-free_days;
          // alert(min_w);
            if ($('#add_on').is(":checked")) 
            {
                var  price= parseFloat($("#rate"+base_id).val());   
                var  eprice= parseFloat($("#erate"+base_id).val());

                var arr = $("#a_newspaper").val();
                arr.unshift(newspaper);
                newspaper=base_id;

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
                       var  erate= parseFloat($("#erate"+d).val());
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
var erate= parseFloat($("#erate"+d).val());
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
                      price= parseFloat($("#rate"+0).val()).toFixed( 2 );

                eprice= parseFloat($("#erate"+0).val()).toFixed( 2 );

                     var  price1= parseFloat($("#rate"+0).val());		
            var  eprice1= parseFloat($("#erate"+0).val());
                    var id=newspaper;
                    data = {id : id, dop  : val, price : price1, eprice : eprice1};
                var  p_date=$("#from-input").val();
                var  ro_type="N";
                }
                else
                {
                    var  price=$("#rate").val();  
                    var  eprice=$("#erate").val();
                    var pack_dop = [];
                    if($('#sdta').is(":checked"))
                    {
                        var dop_to_all="";
                        $.each(packs, function(i, d) {

                            var val=$("#from-input"+ d.paper_id).val();
                            if(val != "")
                            {
                                dop_to_all=val;
                            }
                        });

                        $.each(packs, function(i, d) {            

                            var id=d.paper_id;
                            var data = {id : id, dop  : dop_to_all};
                            pack_dop.push(data);

                        });
                    }
                    else
                    {
                        $.each(packs, function(i, d) {

                            var val=$("#from-input"+ d.paper_id).val();
                            var id=d.paper_id;
                            var data = {id : id, dop  : val};
                            pack_dop.push(data);
                        });
                    }
                    var  p_date=pack_dop;
                    var  ro_type="P";
                }

            }
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
            var  w_count= $("#w_count1").val(); 
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
            var  igst= $("#igst").val();
            var  cgst= $("#cgst").val();
            var  sgst= $("#sgst").val();
            var  book_date= $("#book_date").val();
         //alert(p_date);
            var form_data= {'client':client,'newspaper':newspaper,'state_id':state_id,'matter':matter,'cat':cat,'sheading':sheading,'pack':pack,'inse':inse,'scheme':scheme,'material':material,'party':party,'premimum':premimum,'prem':prem,'box':box,'remark':remark,'price':price,'eprice':eprice,'min_w':min_w,'w_count':w_count,'p_date':p_date,'ro_type':ro_type,'t_amount':t_amount,'p_amount':p_amount,'dis':dis,'dis_a':dis_a,'comm1':comm1,'comm2':comm2,'comm3':comm3,'comm4':comm4,'comm5':comm5,'comm6':comm6,'comm7':comm7,'comm8':comm8,'box_c':box_c,'add_a':add_a,'odf':odf,'dop_inse':inse_dop,'book_date':book_date,'igst':igst,'cgst':cgst,'sgst':sgst,'ro_no':ro_no};

            $.ajax({                
                url: "<?php echo base_url(); ?>" + "admin/book_ads/edit/"+"<?php echo $book_ad->id; ?>",
                type: "POST",       
                async: true ,               
                data: form_data,
                beforeSend: function(){ document.getElementById("loader").style.display = "block";},
                success: function(data)
                {
                    document.getElementById("loader").style.display = "none";
                    console.log(data);
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
                    if(data=='5')
                    {
                        alert("Ro updated Successfully");
                        window.location.replace("<?php echo base_url('admin/book_ads/'); ?>");
                    }
                    if(data=='6')
                    {
                        alert("Can't Edit Billed ro");
                        window.location.replace("<?php echo base_url('admin/book_ads/'); ?>");
                    }
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
            //console.log(newspaper);
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
                url: "<?php echo base_url(); ?>" + "admin/book_ads/get_heading",
                type: "POST",       
                async: true ,               
                data: {id:newspaper},
                beforeSend: function(){ document.getElementById("loader").style.display = "block";},
                success: function(data)
                {
                    //alert ("called");
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
                        $('#cat').append('<option value="' + d.cat_id + '">' + d.cat_name + '</option>');
                    }); 

                    $("#cat option[value='<?php echo $book_ad->cat_id; ?>']").attr("selected", true);
                },
                complete: function() 
                {                    
                    get_sub_heading();
                    //get_scheme();
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
          //  alert("cat"+cat);
            $.ajax({                
                url: "<?php echo base_url(); ?>" + "admin/book_ads/get_sub_heading",
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
                        $('#sheading').append('<option value="' + d.id + '">' + d.sub_heading + '</option>');           

                    });
//alert("sub"+<?php echo $book_ad->sub_heading; ?>);
                    $("#sheading option[value='<?php echo $book_ad->sub_heading; ?>']").attr("selected", true);

                },
                complete: function() 
                {                    
                    date_pic1();
                   
                    get_package();
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
                url: "<?php echo base_url(); ?>" + "admin/book_ads/get_scheme",
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
                        $('#scheme').append('<option value="' + d.scheme_id + '">' + d.scheme_name + '</option>');
                    });

                    $("#scheme option[value='<?php echo $book_ad->scheme; ?>']").attr("selected", true);

                },
                complete: function() 
                {                    
                    get_scheme_price();
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
                //amount_calculate();
                return false;
            }
            $.ajax({                
                url: "<?php echo base_url(); ?>" + "admin/book_ads/get_scheme_price",
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
                    if((day <= inse) && (inse%day==0))
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
                url: "<?php echo base_url(); ?>" + "admin/book_ads/get_premimum",
                type: "POST",       
                async: true ,               
                data: {n_id:newspaper},
                beforeSend: function(){ document.getElementById("loader").style.display = "block";},
                success: function(data)
                {
                    document.getElementById("loader").style.display = "none";

                    $('#premimum').empty();
                    var opts = $.parseJSON(data);
                    // Use jQuery's each to iterate over the opts value
                    $.each(opts, function(i, d) {
                                                $('#premimum').append('<option value="' + d.id + '">' + d.p_type + '    ' + d.premimum + ' </option>');
                    });

                    <?php
                    $premimums=explode(",",$book_ad->premimum);
                    foreach($premimums as $premimum)
                    {
                    ?>
                    $("#premimum option[value='<?php echo $premimum; ?>']").attr("selected", true);
                    <?php } ?>
                },
                complete: function() 
                {
                    sel_update_pre();

                    document.getElementById("loader").style.display = "block";
                    setTimeout(get_premimum_price, 5000);
                    //get_premimum_price();
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

                    url: "<?php echo base_url(); ?>" + "admin/book_ads/get_premimum_price",

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

                      //  alert(prem);

                        premimum_type=prem[1];

                        premimum_value=prem[0];

                        if(prem[1] == 'Rs'){

                            //var  premimum_a= parseFloat($("#premimum_a").val());

                            pa=parseFloat(pa+prem[0]);

                            //document.getElementById("premimum_a").value = pa;

                            //amount_calculate();

                            return false;

                        }

                        if(prem[1] == '%'){

                            var  non_fdc= parseFloat($("#nfdc").val());

                            var  add_on_a= parseFloat($("#add_a").val());           
                            alert(add_on_a);
                            var  box_c= parseFloat($("#box_c").val());

                            var  amount= parseFloat($("#amount").val());            

                            var  extra_ca= parseFloat($("#eca").val());

                            var p_a=(amount + extra_ca +non_fdc + add_on_a)* parseFloat(prem[0])/100;

                            pa=parseFloat(pa + p_a);

                           // alert(pa);

                            document.getElementById("premimum_a").value =pa;

                            //document.getElementById("premimum_a").value =pa;

                            //amount_calculate();

                            return false;

                        }

                    },

                    error: function() 

                    {           

                        alert("Server not responding.");

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
                url: "<?php echo base_url(); ?>" + "admin/book_ads/get_package",
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
                        $('#pack').append('<option value="' + d.id + '">' + d.package + ' </option>');
                    });
                  // alert("package"+ <?php echo $book_ad->package; ?>);
                    $("#pack option[value='<?php echo $book_ad->package; ?>']").attr("selected", true);
                },
                complete: function() 
                {                    
                    get_pack_price();
                },
                error: function() 
                {
                    document.getElementById("loader").style.display = "none";
                    alert("Please Select Heading and Newspaper!");
                }
            });
        }




        var packs=[];
        function get_pack_dop_price(id=null)
        {   
            var pack= $("#pack").val();
            if(pack=="")
            {
                var x = document.getElementById('base_p_date');
                //x.style.display = 'block';
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
             var dates= $("#from-input"+id).val();
         

            var s_days=dates.split(", ");

            var c=s_days.length;

            var i;

          

            for(i=0; i<c ;i++)

            {

            $.ajax({
                url: "<?php echo base_url(); ?>" + "admin/book_ads/get_package_dop_price",
                type: "POST",
                async: true ,
                data: {'pack_id':pack,'s_date':s_days[i],'count':i},
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
                    document.getElementById("erate").value = data['pack'].e_rate;
                    document.getElementById("brate").value = data['pack'].b_rate;
                    document.getElementById("comm1").value = data['pack'].discount;
                    commission();

                    //var p_u = document.getElementById('pack_pub_dates');
                  //  p_u.innerHTML="";
                  //  var htm="";

                    packs=data['pack_paper'];
                    $.each(data['pack_paper'], function(i, d) {


                       // htm='<div class="form-group"> <label for="pack-price" class="col-md-6 control-label" onclick="date_pic_byid('+d.paper_id+');">Publish Dates of '+ d.newspaper_name +'</label> <div class="col-md-6">  <div class="box"  id="from--input"> <input class="form-control" name="p_date'+ d.paper_id +'" type="text" id="from-input'+ d.paper_id +'" placeholder="mm/dd/yyyy, mm/dd/yyyy, ..." > <div><input type="button" data-toggle="modal" data-target="#dopModal" onclick="showModal('+ d.paper_id +')" value="edit"></div>   </div>  <div class="code-box"></div></div></div>';

                      //  p_u.insertAdjacentHTML('beforeend', htm);

                     date_pic_byid(d.paper_id);
                    }); 
                },
                complete: function() 
                {                    
                    amount_calculate();
                },
                error: function() 
                {
                    document.getElementById("loader").style.display = "none";
                    alert("Please Select Heading and Newspaper!");
                }
            });
            }
        }

   function get_pack_price()
        {   
            var pack= $("#pack").val();
            if(pack=="")
            {
                var x = document.getElementById('base_p_date');
                //x.style.display = 'block';
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
                url: "<?php echo base_url(); ?>" + "admin/book_ads/get_package_price",
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
                    document.getElementById("erate").value = data['pack'].e_rate;
                    document.getElementById("brate").value = data['pack'].b_rate;
                    document.getElementById("comm1").value = data['pack'].discount;
                    commission();

                    var p_u = document.getElementById('pack_pub_dates');
                    p_u.innerHTML="";
                    var htm="";

                    packs=data['pack_paper'];
                    $.each(data['pack_paper'], function(i, d) {


                        htm='<div class="form-group"> <label for="pack-price" class="col-md-6 control-label" onclick="date_pic_byid('+d.paper_id+');">Publish Dates of '+ d.newspaper_name +'</label> <div class="col-md-6">  <div class="box"  id="from--input"> <input class="form-control" name="p_date'+ d.paper_id +'" type="text" id="from-input'+ d.paper_id +'" placeholder="mm/dd/yyyy, mm/dd/yyyy, ..." > <div><input type="button" data-toggle="modal" data-target="#dopModal" onclick="showModal('+ d.paper_id +')" onblur="get_package_dop_price('+ d.paper_id +');" value="edit"></div>   </div>  <div class="code-box"></div></div></div>';

                        p_u.insertAdjacentHTML('beforeend', htm);

                        date_pic_byid(d.paper_id);
                    }); 
                },
                complete: function() 
                {                    
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

            var  w_count1= parseFloat($("#w_count1").val());

            var  inse= parseInt($("#inse").val());

            //var  rate= parseFloat($("#rate").val());

            //var  erate= parseFloat($("#erate").val());

            var  non_fdc= parseFloat($("#nfdc").val());

            var  add_on_a= parseFloat($("#add_a").val());

            //document.getElementById("dis").value=20;

            var  dis= parseFloat($("#dis").val());

            var  box_c= parseFloat($("#box_c").val());

            var  extra_ca=0;

            var  amount= 0;

            var  t_amount=0;	

            var  p_amount=0

            var  dis_a=0;
            
             inse_dop= inse-free_days;

            inse=inse-free_days;
            
             var  pack= $("#pack").val();

            var from_date="";

            if ($('#add_on').is(":checked")) 

            {

                

                var  rate=0;

                var  erate=0;

                var  brate=0;

                var  berate=0;

                var i;	

                rate= parseFloat($("#rate"+base_id).val());

                erate=parseFloat($("#erate"+base_id).val());

                brate= parseFloat($("#brate"+base_id).val());

                berate=parseFloat($("#berate"+base_id).val());

                if(brate>0)

                {

                    amount=amount+brate*inse;

                }

                else



                {

                    amount=amount+rate*inse;

                }

                if(berate>0)

                {

                    if(min_w < w_count1)

                    {

                        extra_ca=extra_ca+(w_count1 - min_w)*berate*inse;

                    }

                    else

                    {

                        extra_ca=extra_ca+0;

                    }

                }

                else

                {

                    if(min_w < w_count1){

                        extra_ca=extra_ca+(w_count1 - min_w)*erate*inse;

                    }

                    else{



                        extra_ca=extra_ca+0;

                    }

                }

                var arr = $("#a_newspaper").val();
                var newspaper= $("#newspaper").val();
                arr.unshift(newspaper);
                
              
                add_on_a=0.0;

                $.each(arr, function(i, id) {
                  
                    if(id==base_id){

                        return;

                    }
                    if(id!=base_id){
                       
                    rate= parseFloat($("#rate"+id).val());

                    erate= parseFloat($("#erate"+id).val());

                    brate= parseFloat($("#brate"+id).val());

                    berate= parseFloat($("#berate"+id).val());



                    if(brate>0){

                        add_on_a=add_on_a+(brate*inse);

                    }
                    else{

                        add_on_a=add_on_a+(rate*inse);

                    }

                    if(berate>0){

                        if(min_w < w_count1){

                            add_on_a=add_on_a+(w_count1-min_w)*(berate*inse);

                        }				

                    }else{

                        if(min_w < w_count1){

                            add_on_a=add_on_a+(w_count1-min_w)*(erate*inse);

                        }				

                    }
                   
                    }

                });
                

            }
            
            else if(pack!="")
            {
            
            
                    var  rate= parseFloat($("#rate").val());

                    var  erate= parseFloat($("#erate").val());

                    var  brate= parseFloat($("#brate").val());

                    var  berate= parseFloat($("#berate").val());

                    if(brate>0){

                        amount=amount+(brate*inse);

                    }

                    else

                    {

                        amount=amount+(rate*inse);

                    }

                    if(berate>0)

                    {

                        if(min_w < w_count1){

                            extra_ca=extra_ca+(w_count1 - min_w)*(berate*inse);

                        }else{

                            extra_ca=0;

                        }

                    }
                    else
                    {

                        if(min_w < w_count1)

                        {

                            extra_ca=extra_ca+(w_count1 - min_w)*(erate*inse);

                        }else{

                            extra_ca=0;

                        }

                    }

                }

                else

                {

                    var  rate=0;

                    var  erate=0;

                    var  brate=0;

                    var  berate=0;

                    var i;

                    brate= parseFloat($("#brate0").val());

                    berate= parseFloat($("#berate0").val());

                    if(brate>0)

                    {

                        amount=amount+(brate*inse);

                        if(berate > 0)

                        {

                            if(min_w < w_count1)

                            {

                                extra_ca=extra_ca+(w_count1 - min_w)*(berate*inse);

                            }

                        }

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

                        for(i=0 ; i < c ;i++){

                            //rate= parseFloat($("#rate"+i).val());

                            //erate= parseFloat($("#erate"+i).val());

                            //brate= parseFloat($("#brate"+i).val());

                            //berate= parseFloat($("#berate"+i).val());

                            rate= parseFloat($("#rate0").val());

                            erate= parseFloat($("#erate0").val());

                            brate= parseFloat($("#brate0").val());

                            berate= parseFloat($("#berate0").val());

                            amount=amount+rate;

                            if(min_w < w_count1){

                                extra_ca=extra_ca+(w_count1 - min_w)*erate;

                            } else{

                                extra_ca=extra_ca+0;

                            }

                        }

                    }

                }

           

            //amount=rate*inse;	

            if(! isNaN( amount)){	
             /*   if  (non_fdays != 0)
{
    alert("number of non focus day charges "+ non_fdays);
                        non_focus_day_charge=(t_amount)+(non_fdc * non_fdays);
                        document.getElementById("nfdc").value = non_focus_day_charge;
}*/
     

                var condition=non_focus_day();	

                if(condition==1){		

                    if(nfdc[1]== "Rs"){

                        if(parseFloat(amount)>0){

                            t_amount=t_amount+amount;

                        }

                        if(parseFloat(premimum_a)>0){

                            t_amount=t_amount+premimum_a;

                        }

                        if(parseFloat(extra_ca)>0){

                            t_amount=t_amount+extra_ca;

                        }

                        if(parseFloat(non_fdc)>0){

                            t_amount=t_amount+(non_fdc);

                        }

                        if(parseFloat(add_on_a)>0){

                            t_amount=t_amount+add_on_a;

                        }

                        if(parseFloat(box_c)>0){

                            t_amount=t_amount+box_c;

                        }

                    } else{

                        var non_focus_day_charge=0;

                        non_focus_day_charge=(amount + extra_ca )* non_fdc /100;
                        if(! isNaN(non_focus_day_charge)){

                        document.getElementById("nfdc").value = non_focus_day_charge;
}
                        if(parseFloat(amount)>0){

                            t_amount=t_amount+amount;

                        }

                        if(parseFloat(premimum_a)>0){

                            t_amount=t_amount+premimum_a;

                        }

                        if(parseFloat(extra_ca)>0){

                            t_amount=t_amount+extra_ca;

                        }

                        if(parseFloat(non_focus_day_charge)>0){

                            t_amount=t_amount+non_focus_day_charge;

                        }

                        if(parseFloat(add_on_a)>0){

                            t_amount=t_amount+add_on_a;

                        }

                        if(parseFloat(box_c)>0){

                            t_amount=t_amount+box_c;

                        }

                        //t_amount=amount+premimum_a+extra_ca+non_focus_day_charge+add_on_a+box_c;

                    }

                    //t_amount=amount+premimum_a+extra_ca+non_fdc+add_on_a+box_c;

                }else{

                    if(parseFloat(amount)>0){

                        t_amount=t_amount+amount;

                    }

                    if(parseFloat(premimum_a)>0){

                        t_amount=t_amount+premimum_a;

                    }

                    if(parseFloat(extra_ca)>0){

                        t_amount=t_amount+extra_ca;

                    }

                    if(parseFloat(add_on_a)>0){

                        t_amount=t_amount+add_on_a;

                    }

                    if(parseFloat(box_c)>0){

                        t_amount=t_amount+box_c;

                    }

                }



                dis_a=(t_amount-box_c)*dis/100;

                p_amount=t_amount-dis_a;

                //console.log("amount: "+amount.toFixed(2));

                //console.log("city: "+document.getElementById('city').value);
if(! isNaN(extra_ca)){ document.getElementById("eca").value = extra_ca.toFixed(2);}
               
if(! isNaN(add_on_a)){
  
    document.getElementById("add_a").value = add_on_a.toFixed(2);}
                
if(! isNaN(amount)){document.getElementById("amount").value = amount.toFixed(2);}
                
if(! isNaN(t_amount)){document.getElementById("t_amount").value = t_amount.toFixed(2);}
                
if(! isNaN(t_amount)){document.getElementById("taxable_amount").value = (parseFloat(t_amount)-parseFloat(dis_a)).toFixed(2);}
                



               
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









                document.getElementById("dis_a").value = dis_a.toFixed(2);

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
                url: "<?php echo base_url(); ?>" + "admin/book_ads/get_newspaper",
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
                        $('#a_newspaper').append('<option value="' + d.id + '">' + d.newspaper_name + ' , '+ d.city_name +'</option>');
                    });
                    <?php 
                    foreach($dops as $dp)
                    {
                    ?>
                    $("#a_newspaper option[value='<?php echo $dp->paper_id; ?>']").attr("selected", true);
                    <?php } ?>
                },
                complete: function() 
                {                    
                    sel_update();
                    setTimeout(ad_on_paper1, 200);
                },

                error: function() 
                {
                    document.getElementById("loader").style.display = "none";
                    alert("Please Select Newspaper!");
                }
            });
        }




        function sel_update()
        { 
            $("#a_newspaper").trigger("chosen:updated");
            document.getElementById("loader").style.display = "none";
        }




        function ad_on_paper1()
        {
            if ($('#add_on').is(":checked")) 
            {
                setTimeout(ad_on_paper,300);
            }
        }




        function ad_on_paper(paper_id,ar){

            var arr=$("#a_newspaper").val();
            
            var cat=$("#cat").val();

            var inse=$("#inse").val();

           // var size=$("#w_count1").val(); 
            
            

            var newspaper=$("#newspaper").val();

            var city=$("#state").val();
            if(arr==null){  

                alert("Select at least one Add on newspaper!");

                return false;

            }

        //    arr.unshift(newspaper);

            //document.getElementById("loader").style.display = "block";  

var m_id = paper_id;
          // alert(b_id);
            var data="";
            var ar1=[];
            var ar1 = ar;

            var data="";

            var h_code="";

           var htm="";  

            var p_u= document.getElementById('add_pub_dates');    

            p_u.innerHTML=htm;
        $.each(ar, function(i, d) {
          
            var form_data= {"m_newspaper":m_id,"a_newspaper":d,"cat":cat,"inse":inse,"data":"",'city':city};

            //console.log(JSON.stringify(form_data));         

            $.ajax({

                url: "<?php echo base_url(); ?>" + "admin/book_ads/get_ad_on_price",

                type: "POST",       

                async: true ,               

                data: form_data,      

                success: function(data)

                {

                    //console.log(data); //return false;

                    var data = $.parseJSON(data);         

                  //  var p_u= document.getElementById('add_pub_dates');

//                    p_u.innerHTML="";

                    if(data['msg']=='1')

                    {

                        alert("Please Select Heading and Newspaper!");

                        $("#a_newspaper option[value='"+ data['id'] +"']").attr("selected", false);

                        return false;

                    }

                    if(data['msg']=='2')

                    {

                        alert("Add on Rate not Set with Some Newspaper or Heading.");

                        return false;

                    }



                   
                       var html='<div class="alert alert-info" ><i class="fa fa-money"></i><strong> DOP and Price of  '+ data['values'].data +'</strong></div>                   <div class="form-group">                     <label for="pack-price" class="col-md-6 alert alert-info" onclick="date_pic_byid('+data['values'].a_newspaper_id +');" style="cursor:crosshair">Publish Dates of '+ data['values'].data +'</label>                    <div class="col-md-6">                      <div class="box"  id="from--input">                     <input class="form-control mydata" name="p_date'+ data['values'].a_newspaper_id +'" type="text" id="from-input'+ data['values'].a_newspaper_id +'" data-id="'+ data['values'].a_newspaper_id +'" data-toggle="modal" data-target="#dopModal" onclick="showModal('+data['values'].a_newspaper_id+')"  onblur="get_addon_dop_price('+data['values'].a_newspaper_id+');" placeholder="mm/dd/yyyy, ..." >                     </div>                 <div class="code-box">                     </div>                    </div>                    </div>                          <div class="form-group">                    <label for="pack-price" class="col-md-3 control-label">Rate</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['values'].a_newspaper_id +'" id="rate'+ data['values'].a_newspaper_id +'" value="'+ data['rates'].price +'">                   </div>                    <label for="pack-price" class="col-md-3 control-label">Extra Charges</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="erate'+ data['values'].a_newspaper_id +'" id="erate'+ data['values'].a_newspaper_id +'"  value="'+ data['rates'].e_price +'">                    </div>                    </div>                    <div class="form-group"><label for="pack-price" class="col-md-3 control-label">B Rate</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="brate'+ data['values'].a_newspaper_id +'" id="brate'+ data['values'].a_newspaper_id +'" value="0">                    </div>                    <label for="pack-price" class="col-md-3 control-label">B Extra Charges</label>                    <div class="col-md-3">                    <input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="berate'+ data['values'].a_newspaper_id +'" id="berate'+ data['values'].a_newspaper_id +'"  value="0">                    </div>                    </div>';
                    p_u.insertAdjacentHTML('beforeend', html);
                   
    date_pic_byid1(d);

                        commission();
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
            document.getElementById("loader").style.display = "none";

            setTimeout(get_premimum_price,3000);
           

           

        }
        var base_id=0;

        function get_base_price(){

            var arr = $("#a_newspaper").val();

            var newspaper= $("#newspaper").val();
document.getElementById("pub_dates").style.display = "none";
            if(arr==null){  

                alert("Select at least one Add on newspaper!");

                return false;

            } 

            arr.unshift(newspaper);

            var  city= $("#state").val();

            var  cat= $("#cat").val();

            var  inse= $("#inse").val();

            //var color= $("#color").val();
           


            var p_u= document.getElementById('add_base_dates');   

            p_u.innerHTML="";

            if(newspaper=="" || cat=="" || inse=="")

            {

                alert("Select Newspaper,City and Heading");

                $('#inse').val(function(){

                    return this.defaultValue;

                });

                return false;

            }



            var form_data= {'arr':arr,'newspaper':newspaper,'cat':cat,'inse':inse,'city':city};

            $.ajax({

                url: "<?php echo base_url(); ?>" + "admin/book_ads/get_base_price",

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

                        $('#inse').val(function(){

                            return this.defaultValue;

                        });

                        return false;

                    }

                    if(data=='2')

                    {

                        alert("Base Rate not Set with this Heading.");

                        $('#inse').val(function(){

                            return this.defaultValue;

                        });

                        return false;

                    }

                    var data = $.parseJSON(data);

                    min_w=data['rates'].min_w;
                     m_unit=data['rates'].unit;
                  //  var size = document.getElementById("w_count1").value;
                  //  if( size< min_w)
                   // {
                   // document.getElementById("w_count1").value = min_w;
                   //   $("#unit option[value='" + data['rates'].unit +"']").attr("selected", true);
                   // }
                    $("#unit option[value='" + data['rates'].unit +"']").attr("selected", true);
                    document.getElementById("comm1").value = data['rates'].discount;

                  

                    //console.log(data);

                    days=data['rates'].day_id.split(",");

                    nfdc=data['rates'].non_focus_charge.split(",");

                    document.getElementById('gst').value=data['rates'].gst;

                    //console.log(data['rates'].gst);

                    if(nfdc[1] == 'Rs')

                    {

                        //alert(nfdc[1]+"   "+nfdc[0]);

                        document.getElementById("nfdc").value = nfdc[0];

                    }
                    else
                    {
                        document.getElementById("nfdc").value=0;
                    }

                    document.getElementById("comm2").value = 0;

                    document.getElementById("comm3").value = 0;

                    document.getElementById("comm4").value = 0;

                    document.getElementById("comm5").value = 0;

                    document.getElementById("comm6").value = 0;

                    document.getElementById("comm7").value = 0;

                    document.getElementById("comm8").value = 0;

                    commission();



                    base_id=data['value'];
                    
                
         //var html='<div class="alert alert-info" "><i class="fa fa-money"></i><strong> DOP and Price of  '+ data['rates'].newspaper_name +' ,'+ data['rates'].city_name +'</strong></div>                         <div class="form-group">  <label for="pack-price" class="col-md-6 alert alert-info" onclick="date_pic_byid('+data['value']+');" style="cursor:crosshair">Publish Dates of '+ data['rates'].newspaper_name +' ,'+ data['rates'].city_name +'</label> <div class="col-md-6">  <div class="box"  id="from--input"> <input class="form-control" name="p_date'+ data['value'] +'" type="text" id="from-input1'+ data['value'] +'" placeholder="mm/dd/yyyy, ..." >  </div>  <div class="code-box">  </div>  </div>  </div>                                                                       <div class="form-group"><label for="pack-price" class="col-md-3 control-label">Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['value'] +'" id="rate'+ data['value'] +'" value="'+ data['rates'].ad_price +'"></div><label for="pack-price" class="col-md-3 control-label">Extra Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="erate'+ data['value'] +'" id="erate'+ data['value'] +'" value="'+ data['rates'].extra_price +'"></div></div>                                           <div class="form-group"><label for="pack-price" class="col-md-3 control-label">B Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="brate'+ data['value'] +'" id="brate'+ data['value'] +'" value="0"></div><label for="pack-price" class="col-md-3 control-label">B Extra Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="berate'+ data['value'] +'" id="berate'+ data['value'] +'" value="0"></div></div>';
             var html='<div class="alert alert-info" "><i class="fa fa-money"></i><strong> DOP and Price of  '+ data['rates'].newspaper_name +' ,'+ data['rates'].city_name +'</strong></div>                         <div class="form-group">  <label for="pack-price" class="col-md-6 alert alert-info" onclick="date_pic_byid('+data['value']+');" style="cursor:crosshair">Publish Dates of '+ data['rates'].newspaper_name +' ,'+ data['rates'].city_name +'</label> <div class="col-md-6">  <div class="box"  id="from--input"> <input class="form-control mydata" name="p_date'+data['value'] +'" type="text" id="from-input'+ data['value']+'" data-id="'+ data['value']+'" data-toggle="modal" data-target="#dopModal" onclick="showModal('+data['value']+')"  onblur="get_base_dop_price(base_id);" placeholder="mm/dd/yyyy, ..." > </div>  <div class="code-box">  </div>  </div>  </div>                                                                       <div class="form-group"><label for="pack-price" class="col-md-3 control-label">Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['value']+'" id="rate'+data['value'] +'" value="'+ data['rates'].ad_price +'"></div><label for="pack-price" class="col-md-3 control-label">Extra Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="erate'+ data['value'] +'" id="erate'+ data['value'] +'" value="'+ data['rates'].extra_price +'"></div></div>                                           <div class="form-group"><label for="pack-price" class="col-md-3 control-label">B Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="brate'+ data['value'] +'" id="brate'+ data['value']+'" value="0"></div><label for="pack-price" class="col-md-3 control-label">B Extra Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="berate'+ data['value'] +'" id="berate'+ data['value']+'" value="0"></div></div>';
                   

                   // var p_u= document.getElementById('add_base_dates');

                    p_u.innerHTML=html;
                       for( var i = 0; i < arr.length; i++)
           { 
               
                           if ( arr[i] === base_id) {
                             arr.splice(i, 1); 
                           }
                     }
                   
                 date_pic_byid1(base_id);
                }, 
                complete: function() 
                {
                    
            ad_on_paper(base_id,arr);
            
        },

                error: function() 

                {

                    document.getElementById("loader").style.display = "none";

                    alert("Error in base rates with this Newspaper or Heading..");

                }
                
            });

          

        }
  

 function get_base_dop_price(id=null)

        {

            document.getElementById("loader").style.display = "block";

            var  newspaper= id; 
//alert(newspaper);
            var  cat= $("#cat").val();

            var  inse= $("#inse").val();

            if(newspaper=="" || cat=="" || inse=="" )

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

                var form_data= {'newspaper':newspaper,'cat':cat,'inse':inse,'s_date':s_days[i],'count':i};

                //alert(s_days[i]);

                $.ajax({

                    url: "<?php echo base_url(); ?>" + "admin/book_ads/get_base_dop_price",

                    type: "POST",       

                    async: true ,               

                    data: form_data,

                    beforeSend: function(){ document.getElementById("loader").style.display = "block";},

                    success: function(data)

                    {           

                        if(data=='1')

                        {

                            alert("Rate not Set with this Newspaper or Heading on some Date.");

                            return false;

                        }

                        // Parse the returned json data

                        var data = $.parseJSON(data);

                    //    var html='<div id="rate_dis'+ data['values'].count +'" style="display: none;"><div class="title" style="background-color:#fff;"><i class="fa fa-money"></i><strong> Rate Of Date '+ data['values'].s_date +'</strong></div><div class="form-group"><label for="pack-price" class="col-md-3 control-label">Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['values'].count +'" id="rate'+ data['values'].count +'"></div><label for="pack-price" class="col-md-3 control-label">Extra Charges</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="erate'+ data['values'].count +'" id="erate'+ data['values'].count +'"></div></div><div class="form-group"><label for="pack-price" class="col-md-3 control-label">B Rate</label><div class="col-md-3"><input type="text" onchange="amount_calculate();" placeholder="" class="form-control" name="brate'+ data['values'].count +'" id="brate'+ data['values'].count +'"></div><label for="pack-price" class="col-md-3 control-label">B Extra Charges</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="berate'+ data['values'].count +'" id="berate'+ data['values'].count +'"></div></div></div>';

                      //  p_u.insertAdjacentHTML('beforeend', html);

                        document.getElementById("rate"+id).value = data['rates'].ad_price;

                        document.getElementById("erate"+id).value = data['rates'].extra_price;

                        document.getElementById("brate"+id).value = data['rates'].b_rate;

                        document.getElementById("berate"+id).value = 0;

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

            var  cat= $("#cat").val();

            var  inse= $("#inse").val();
            var size=$("#w_count1").val();
         //   var size_r=$("#size_r").val();
            if(newspaper=="" || cat=="" || inse=="" )

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

                var form_data= {'m_newspaper':m_newspaper,'a_newspaper':a_newspaper,'cat':cat,'inse':inse,'s_date':s_days[i],'count':i,'size':size};

                //alert(s_days[i]);

                $.ajax({

                    url: "<?php echo base_url(); ?>" + "admin/book_ads/get_addon_dop_price",

                    type: "POST",       

                    async: true ,               

                    data: form_data,

                    beforeSend: function(){ document.getElementById("loader").style.display = "block";},

                    success: function(data)

                    {           

                        if(data=='1')

                        {

                            alert("Rate not Set with this Newspaper or Heading on some Date.");

                            return false;

                        }

                        // Parse the returned json data

                        var data = $.parseJSON(data);

                    //    var html='<div id="rate_dis'+ data['values'].count +'" style="display: none;"><div class="title" style="background-color:#fff;"><i class="fa fa-money"></i><strong> Rate Of Date '+ data['values'].s_date +'</strong></div><div class="form-group"><label for="pack-price" class="col-md-3 control-label">Rate</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="rate'+ data['values'].count +'" id="rate'+ data['values'].count +'"></div><label for="pack-price" class="col-md-3 control-label">Extra Charges</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="erate'+ data['values'].count +'" id="erate'+ data['values'].count +'"></div></div><div class="form-group"><label for="pack-price" class="col-md-3 control-label">B Rate</label><div class="col-md-3"><input type="text" onchange="amount_calculate();" placeholder="" class="form-control" name="brate'+ data['values'].count +'" id="brate'+ data['values'].count +'"></div><label for="pack-price" class="col-md-3 control-label">B Extra Charges</label><div class="col-md-3"><input type="text" placeholder="" onchange="amount_calculate();" class="form-control" name="berate'+ data['values'].count +'" id="berate'+ data['values'].count +'"></div></div></div>';

                      //  p_u.insertAdjacentHTML('beforeend', html);

                        document.getElementById("rate"+id).value = data['rates'].price;

                        document.getElementById("erate"+id).value = data['rates'].e_price;

                        document.getElementById("brate"+id).value = 0;

                        document.getElementById("berate"+id).value = 0;

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

                   function showModal(data)
                   {
                        My_id=data;
                     var dates1 = $("#from-input"+data).val();
                       $("#mdops").val(dates1);
                       $(".modal-body #hiddenvalue").val(My_id);
                       $("#dopModal").show();
                       
                   }
        $(document).ready(function (){
        
    $('.js-example-basic-single').select2();

            add_paper();
            get_paper();
            get_heading();
            get_premimum();
        });
    </script>
