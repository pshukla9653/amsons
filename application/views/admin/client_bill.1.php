<div id="page-content" style="min-height: 1189px;">
    <!-- Product Edit Content -->
    <div class="block"  style="background-color:#dbe1e8;">
        <!-- General Data Title -->
        <div class="block-title">
            <h2>
                <i class="fa fa-pencil"></i>
                <strong>Client Billing</strong>
            </h2>
        </div>
        <div class="row" style="background-color:#dbe1e8;">
            <?php
            $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'ro_add');
            echo form_open_multipart('admin/client_bill/', $attributes); ?>
            <?php
                echo "<div class='text-danger'>";
                echo validation_errors();
                echo $this->session->flashdata('msg');
                echo "</div>";
            ?>
            <div class="col-lg-4">
                <!-- General Data Block -->
                <!-- General Data Content -->
                <div class="form-group">
                    <label for="price" class="col-md-3 control-label">Date To</label>
                    <div class="col-md-9">
                        <input type="text" id="date_t" onchange="get_ros();" name="date_t" value="<?php echo set_value('date_t'); ?>" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
                    </div>
                </div>
                <!-- END General Data Block -->
            </div>
            <div class="col-lg-8">
                <!-- General Data Block -->
                <!-- General Data Title -->
                <div class="form-group">
                    <label class="col-md-2 control-label" for="example-chosen-multiple">Client<span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <select id="client" name="client" onchange="get_ros();" class="form-control" data-placeholder="Choose Classes" required>
                            <option value="" >Select Client</option>
                            <?php foreach($clients as $client){ ?>
                            <option value="<?php echo $client->id; ?>"><?php echo $client->client_name; ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <!-- END General Data Block -->
            </div>
            <!-- END Product Edit Content -->
            </form>
    </div>

    <div class="table-responsive" style="border-style: outset; height: 300px; overflow-y: scroll; background-color:#fff;">
        <table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
           
        </table>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
    <div class="form-group">
                <label for="price" class="col-md-4 control-label">Due Days</label>
                <div class="col-md-8">
                <input type="text" name="due_day" id="due_day" value="30">
                </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-md-4 control-label">Amount</label>
            <div class="col-md-8">
            <input type="hidden" id="total_rows" value="0">
                <input type="text" placeholder="" class="form-control" name="amount" id="amount" value="0">
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-md-4 control-label">IGST  <?= $taxes->tax_rate; ?>%</label>
            <div class="col-md-8">
                <input type="text" placeholder="" class="form-control" name="igst" id="igst" value="0">
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-md-4 control-label">CGST <?= $taxes->tax_rate/2; ?>%</label>
            <div class="col-md-8">
                <input type="text" placeholder="" class="form-control" name="cgst" id="cgst" value="0">
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-md-4 control-label">SGST <?= $taxes->tax_rate/2; ?>%</label>
            <div class="col-md-8">
                <input type="text" placeholder="" class="form-control" name="sgst" id="sgst" value="0">
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-md-4 control-label">Total</label>
            <div class="col-md-8">
                <input type="text" placeholder="" class="form-control" name="total" id="total"  value="0">
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-md-4 control-label">At work Charges</label>
            <div class="col-md-8">
                <input type="text" placeholder="" class="form-control" name="at_work_charges" id="at_work_charges"  value="0" onchange="final_calculation();">
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-md-4 control-label">Other Charges</label>
            <div class="col-md-8">
                <input type="text" placeholder="" class="form-control" name="other_charges" id="other_charges"  value="0" onchange="final_calculation();">
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-md-4 control-label">Net Amount</label>
            <div class="col-md-8">
                <input type="text" placeholder="" class="form-control" name="net_amount" id="net_amount"  value="0">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <div class="btn btn-sm btn-primary" id="process_ro_btn">
                    Process ROs
            </div>
        </div>
</div>
<!-- END Product Edit Content -->
</div>

<script type="text/javascript">
    var bill_detail_temp=[];
    var bill_detail=[];
    //console.log(bill_detail);
    $("#date_t").datepicker().datepicker("setDate", new Date());
    var all_amount=0;
    var all_igst=0;
    var all_sgst=0;
    var all_cgst=0;
    var all_payable_amount=0;

    function get_ros()
    {
        $("#ecom-products").html("");
        //alert("working here");
        var date_2= $("#date_t").val();
        var client= $("#client").val();
        $.ajax({
            url: "<?php echo base_url(); ?>" + "admin/client_bill/get_ros",
            type: "POST",
            async: true ,
            data: {'date_t':date_2,'client':client},
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                document.getElementById("loader").style.display = "none";
                //console.log(data);
                if(data=='1')
                {
                    alert("Fill All Mandatory Felids.");
                    return false;
                }
                if(data=='2')
                {
                    alert("No Ro Found.");
                    return false;
                }
                //console.log("data in get ros"+data); return;
                var tr = $.parseJSON(data);
                //console.log(tr); return;
                $(".process_ro_div").hide();

                // Use jQuery's each to iterate over the opts value
                var c=0;

                var table_start='<thead><tr role="row"><th style="min-width:70px !important;" class="text-center">Ro No.</th><th style="min-width:70px !important;">Ro Date</th><th style="min-width:70px !important;">Type</th><th class="text-center">Newspaper</th><th class="text-center">Heading</th><th class="text-center" style="min-width:100px !important;">Words</th><th class="text-center" style="min-width:100px !important;">Price</th><th class="text-center" style="min-width:100px !important;">Insertion</th><th class="text-center">Extra W. Price</th><th class="text-center">Height</th><th class="text-center">Width</th><th class="text-center">Amount</th><th class="text-center" style="min-width:100px !important;">Disc %</th><th class="text-center" style="min-width:150px !important;">Discount</th><th class="text-center">CGST</th><th class="text-center">SGST</th><th class="text-center">IGST</th><th class="text-center">Box Charges</th><th class="text-center">Payable Amount</th></tr></thead><tbody>';
                $("#ecom-products").append(table_start);
                $.each(tr, function(i, d)
                {
                    console.log(i+": "+d+"\n");
                    bill_detail_temp[i]=d;
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                    c++;
                    var igst=0;
                    var cgst=0;
                    var sgst=0;
                    var payable_amount=0;
                    if(d.min_w==null){
                        min_w=0;
                    }
                    else
                    {
                        min_w=d.min_w;
                    }
                    var extra_price=0;
                    if(d.extra_price){
                        extra_price=d.extra_price;        
                    }
                    t_amount=(parseFloat(d.publish_day*d.price)+parseFloat((extra_price*(d.size_words-min_w))*d.publish_day));
                    if(d.igst>0){
                        igst=parseFloat(t_amount)*5/100;
                    }
                    if(d.cgst>0){
                        cgst=parseFloat(t_amount)*2.5/100;
                    }
                    if(d.sgst>0){
                        sgst=parseFloat(t_amount)*2.5/100;
                    }
                    

                    all_amount+=t_amount;
                    all_igst+=parseFloat(igst);
                    all_cgst+=parseFloat(cgst);
                    all_sgst+=parseFloat(sgst);
                    
                    payable_amount=(parseFloat(t_amount)+parseFloat(igst)+parseFloat(cgst)+parseFloat(sgst)).toFixed(2);
                    all_payable_amount+=(parseFloat(payable_amount)).toFixed(2);
                    
                    if(d.type_id==1){
                        $("#ecom-products").append('<tr style="cursor:pointer" id="tbl_row'+d.id+'"><td class="text-center" ><input type="checkbox" name="ros_id" id="ros_id'+c+'" value='+c+' checked onchange="final_calculation()"><strong>'+d.ro_no+'</strong></td><td >'+d.book_date+'</td><td >Text</td><td class="text-center" >'+d.newspaper_name+'</td><td class="text-center" >'+d.cat_name+'</td><td class="text-center" >'+d.size_words+'</td><td class="text-center"><input type=text class="border_none" name="price" id="price'+c+'" value="'+d.price+'" style="width:50px !important"><input type="hidden" value="'+(d.size_words-min_w)+'" id="extra_words'+c+'"></td><td class="text-center"><input type="text" id="insertion'+c+'" name="insertion" value="'+d.publish_day+'" style="width:50px !important" onchange="ros_calculation('+c+');"><input type="text" id="free_insertion'+c+'" name="insertion" value="0" style="width:50px !important"></td><td class="text-center" >'+extra_price+'<input type="hidden" value="'+extra_price+'" id="extra_word_price'+c+'"></td><td class="text-center">'+d.height+'</td><td class="text-center">'+d.width+'</td><td class="text-center" ><div id="div_t_amount'+c+'">'+t_amount+'</div><input type="hidden" value="'+t_amount+'" id="t_amount'+c+'"></td><td class="text-center"><input type=text name="dis_per'+c+'" id="dis_per'+c+'" value="'+d.dis_per+'" onchange="ros_calculation('+c+');" style="width:50px !important;"></td><td class="text-center"><input type="text" class="border_none" value="0" id="discount'+c+'" readonly></td><td class="text-center" ><input type="text" class="border_none" value="'+cgst+'" id="cgst'+c+'" readonly></td><td class="text-center" ><input type="hidden" value="'+d.sgst+'" id="old_sgst'+c+'"><input type="text" class="border_none" value="'+sgst+'" id="sgst'+c+'" readonly></td><td class="text-center"><input type="hidden" value="'+d.igst+'" id="old_igst'+c+'"><input type="text" class="border_none" value="'+igst+'" id="igst'+c+'" readonly></td><td class="text-center"><input type="text" name="box_charges'+c+'" value="0" id="box_charges'+c+'" style="width:50px !important;"></td><td class="text-center"><input type="text" class="border_none" value="'+payable_amount+'" id="payable_amount'+c+'" readonly></td></tr>');
                    }
                    if(d.type_id==2){
                        
                        $("#ecom-products").append('<tr style="cursor:pointer" id="tbl_row'+d.id+'"><td class="text-center" ><input type="checkbox" name="ros_id" id="ros_id'+c+'" value='+c+' checked onchange="final_calculation()"><strong>'+d.ro_no+'</strong></td><td >'+d.book_date+'</td><td >Classified Display</td><td class="text-center" >'+d.newspaper_name+'</td><td class="text-center" >'+d.cat_name+'</td><td class="text-center">0</td><td class="text-center"><input type=text class="border_none" name="price" id="price'+c+'" value="'+d.price+'" style="width:50px !important"></td><td class="text-center"><input type="text" id="insertion'+c+'" name="insertion" value="'+d.publish_day+'" style="width:50px !important" onchange="ros_calculation('+c+');"><input type="text" id="free_insertion'+c+'" name="insertion" value="0" style="width:50px !important"></td><td class="text-center" >'+extra_price+'<input type="hidden" value="'+extra_price+'" id="extra_word_price'+c+'"></td><td class="text-center"><input type="text" value="'+(d.height)+'" id="height'+c+'" style="width:50px !important" onchange="ros_calculation('+c+');"></td><td class="text-center"><input type="text" value="'+(d.width)+'" id="width'+c+'" style="width:50px !important" onchange="ros_calculation('+c+');"></td><td class="text-center" ><div id="div_t_amount'+c+'">'+d.t_amount+'</div><input type="hidden" value="'+d.t_amount+'" id="t_amount'+c+'"></td><td class="text-center"><input type=text name="dis_per'+c+'" id="dis_per'+c+'" value="'+d.dis_per+'" onchange="ros_calculation('+c+');" style="width:50px !important;"></td><td class="text-center"><input type="text" class="border_none" value="0" id="discount'+c+'" readonly></td><td class="text-center" ><input type="text" class="border_none" value="'+cgst+'" id="cgst'+c+'" readonly></td><td class="text-center" ><input type="hidden" value="'+d.sgst+'" id="old_sgst'+c+'"><input type="text" class="border_none" value="'+sgst+'" id="sgst'+c+'" readonly></td><td class="text-center"><input type="hidden" value="'+d.igst+'" id="old_igst'+c+'"><input type="text" class="border_none" value="'+igst+'" id="igst'+c+'" readonly></td><td class="text-center"><input type="text" name="box_charges'+c+'" value="0" id="box_charges'+c+'" style="width:50px !important;" onchange="ros_calculation('+c+');"></td><td class="text-center"><input type="text" class="border_none" value="'+payable_amount+'" id="payable_amount'+c+'" readonly></td></tr>');
                    }
                    if(d.type_id==3){
                        $("#ecom-products").append('<tr style="cursor:pointer" id="tbl_row'+d.id+'"><td class="text-center" ><input type="checkbox" name="ros_id" id="ros_id'+c+'" value='+c+' checked onchange="final_calculation()"><strong>'+d.ro_no+'</strong></td><td >'+d.book_date+'</td><td >Display</td><td class="text-center" >'+d.newspaper_name+'</td><td class="text-center" >'+d.cat_name+'</td><td class="text-center" >0</td><td class="text-center"><input type=text class="border_none" name="price" id="price'+c+'" value="'+d.price+'" style="width:50px !important"></td><td class="text-center"><input type="text" id="insertion'+c+'" name="insertion" value="'+d.publish_day+'" style="width:50px !important" onchange="ros_calculation('+c+');"><input type="text" id="free_insertion'+c+'" name="insertion" value="0" style="width:50px !important"></td><td class="text-center" >'+d.extra_price+'<input type="hidden" value="'+d.extra_price+'" id="extra_word_price'+c+'"></td><td class="text-center">'+d.height+'<input type="hidden" value="'+(d.height)+'" id="height'+c+'"></td><td class="text-center">'+d.width+'<input type="hidden" value="'+(d.width)+'" id="width'+c+'"></td><td class="text-center" ><div id="div_t_amount'+c+'">'+d.t_amount+'</div><input type="hidden" value="'+d.t_amount+'" id="t_amount'+c+'"></td><td class="text-center"><input type=text name="dis_per'+c+'" id="dis_per'+c+'" value="'+d.dis_per+'" onchange="ros_calculation('+c+');" style="width:50px !important;"></td><td class="text-center"><input type="text" class="border_none" value="0" id="discount'+c+'" readonly></td><td class="text-center" ><input type="text" class="border_none" value="'+cgst+'" id="cgst'+c+'" readonly></td><td class="text-center" ><input type="hidden" value="'+d.sgst+'" id="old_sgst'+c+'"><input type="text" class="border_none" value="'+sgst+'" id="sgst'+c+'" readonly></td><td class="text-center"><input type="hidden" value="'+d.igst+'" id="old_igst'+c+'"><input type="text" class="border_none" value="'+igst+'" id="igst'+c+'" readonly></td><td class="text-center"><input type="text" name="box_charges'+c+'" value="0" id="box_charges'+c+'" style="width:50px !important;"></td><td class="text-center"><input type="text" class="border_none" value="'+payable_amount+'" id="payable_amount'+c+'" readonly></td></tr>');
                    }
                });
                $("#ecom-products").append('</tbody>');
                document.getElementById('amount').value=all_amount;
                document.getElementById('igst').value=all_igst;
                document.getElementById('cgst').value=all_cgst;
                document.getElementById('sgst').value=all_sgst;
                document.getElementById('total').value=all_payable_amount;
                document.getElementById('net_amount').value=all_payable_amount;
                document.getElementById('total_rows').value=c;
                final_calculation();
            },
            // error: function()
            // {
            //     document.getElementById("loader").style.display = "none";
            //     alert("Please Select Position!");
            // }
            error: function(request, status, error)
            {
                document.getElementById("loader").style.display = "none";
                console.log("Error is: "+request.responseText);
            }
        });
    }

    var popup;
    function select_ro(id,type)
    {
        if(type==1)
        {
            var url="<?php echo base_url(); ?>" + "admin/ro_billing/text_edit/"+id;
        }
        if(type==2)
        {
            var url="<?php echo base_url(); ?>" + "admin/ro_billing/cd_edit/"+id;
        }
        if(type==3)
        {
            var url="<?php echo base_url(); ?>" + "admin/ro_billing/hd_edit/"+id;
        }

        //alert(url);
        //old="parent variable hfghf";
        popup = window.open(url, "Popup", top='0', right='100');
        popup.focus();
        return false;
    }

    $('#process_ro_btn').click(function (){
        var ros_id=[];
        $. each($("input[name='ros_id']:checked"), function(){
            ros_id.push($(this).val());
            bill_detail.push(bill_detail_temp[parseFloat($(this).val())-1]);
        }); 
        //console.log(JSON.stringify(bill_detail)); return;
        var amount=parseFloat($("#amount").val());
        var discount=parseFloat($("#discount").val());
        var box_c=parseFloat($("#box_c").val());
        var at_work_charges=parseFloat($("#at_work_charges").val());
        var other_charges=parseFloat($("#other_charges").val());
   
        var total=parseFloat($("#total").val());
        var net_amount=parseFloat($("#net_amount").val());
        var dis_per=parseFloat($("#dis_per").val());
        var client=$("#client").val();
        var due_day=$("#due_day").val();

        var igst=parseFloat($("#igst").val());
        var sgst=parseFloat($("#sgst").val());
        var cgst=parseFloat($("#cgst").val());

        //var type_id=parseFloat($("#type_id").val());
        //var tbl_paper_city_id=parseFloat($("#tbl_paper_city_id").val());
        var form_data= {'bill_detail':bill_detail,'dis_per':dis_per,'amount':amount,'discount':discount,'client':client,'box_c':box_c,'at_work_charges':at_work_charges,'other_charges':other_charges,'total':total,'net_amount':net_amount,'due_day':due_day,'cgst':cgst,'sgst':sgst,'igst':igst};
        //console.log(JSON.stringify(form_data)); return;
        $.ajax({
            url: "<?php echo base_url(); ?>" + "admin/client_bill/save_bill",
            type: "POST",
            async: true ,
            data: form_data,
            beforeSend: function(){ document.getElementById("loader").style.display="block";},
            success: function(data)
            {
                //console.log(data); return;
                //document.getElementById("loader").style.display = "none";
                if(data=='1')
                {
                    alert("Fill All Mandatory Felids.");
                    return false;
                }
                if(data=='2')
                {
                    alert("Select Ro For Bill.");
                    return false;
                }
                if(data=='5')
                {
                    alert("Bill Save Successfully.");
                    location.reload();
                    //document.getElementById("client_bill").reset();
                    //$("#ecom-products1 tbody").append('<tr><td class="text-center"><strong>'+tax_arr[2]+'</strong></td><td>'+tax_arr[1]+'</td><td class="text-center">'+s_tax_amt+'</td></tr>');
                    //document.getElementById("ecom-products1 tbody").innerHTML = "";
                }
            },
            error: function(request, status, error)
            {
                document.getElementById("loader").style.display = "none";
                console.log("Ro not add !"+request.responseText);
            }
        });
    });

    function ros_calculation(c=0){
        //console.log(document.getElementById('width'+c).value);
        //document.getElementById('t_amount'+c).value=parseFloat(document.getElementById('price'+c).value)*parseFloat(document.getElementById('insertion'+c).value);
        if(document.getElementById('width'+c)!=null){
            //console.log("in width");
            document.getElementById('t_amount'+c).value=((parseFloat(document.getElementById('price'+c).value)*parseFloat(document.getElementById('height'+c).value)*parseFloat(document.getElementById('width'+c).value))+(parseFloat(document.getElementById('extra_words'+c).value)*parseFloat(document.getElementById('extra_word_price'+c).value)))*parseFloat(document.getElementById('insertion'+c).value);
        }
        else if(document.getElementById('extra_words'+c)!=null)
        {
            document.getElementById('t_amount'+c).value=(parseFloat(document.getElementById('price'+c).value)+(parseFloat(document.getElementById('extra_words'+c).value)*parseFloat(document.getElementById('extra_word_price'+c).value)))*parseFloat(document.getElementById('insertion'+c).value);
            //console.log("in all");
        }
        $('#div_t_amount'+c).text(parseFloat(document.getElementById('t_amount'+c).value));
        document.getElementById('discount'+c).value=Math.round(parseFloat(document.getElementById('t_amount'+c).value)*parseFloat(document.getElementById('dis_per'+c).value)/100);
        document.getElementById('payable_amount'+c).value=Math.round(parseFloat(document.getElementById('t_amount'+c).value)-parseFloat(document.getElementById('discount'+c).value));
        if(!isNaN(document.getElementById('old_sgst'+c).value) && (parseFloat(document.getElementById('old_sgst'+c).value))>0){
            document.getElementById('sgst'+c).value=(parseFloat(document.getElementById('payable_amount'+c).value)*2.5)/100;
            document.getElementById('cgst'+c).value=(parseFloat(document.getElementById('payable_amount'+c).value)*2.5)/100;
        }
        if(!isNaN(document.getElementById('old_igst'+c).value) && (parseFloat(document.getElementById('old_igst'+c).value))>0 ){
            document.getElementById('igst'+c).value=(parseFloat(document.getElementById('payable_amount'+c).value)*5)/100;
        }
        document.getElementById('payable_amount'+c).value=(parseFloat(document.getElementById('payable_amount'+c).value)+parseFloat(document.getElementById('igst'+c).value)+parseFloat(document.getElementById('sgst'+c).value)+parseFloat(document.getElementById('cgst'+c).value)+parseFloat(document.getElementById('box_charges'+c).value)).toFixed(2);
        final_calculation();
    }

    function final_calculation(){
        var amount=0;
        var total=0;
        var igst=0;
        var cgst=0;
        var sgst=0;
        var net_amount=0;
        var box_charges=0;
        //alert(document.getElementById('total_rows').value);
        var total_rows=parseFloat(document.getElementById('total_rows').value);
        
        for(i=1;i<=total_rows; i++){
        //alert('index: '+i);
        var checked = $("input[id=ros_id"+i+"]:checked").length;
            if(checked==1){
                amount+=parseFloat(document.getElementById('t_amount'+i).value);
                igst+=parseFloat(document.getElementById('igst'+i).value);
                cgst+=parseFloat(document.getElementById('cgst'+i).value);
                sgst+=parseFloat(document.getElementById('sgst'+i).value);
                net_amount+=parseFloat(document.getElementById('payable_amount'+i).value);
                box_charges+=parseFloat(document.getElementById('box_charges'+i).value);
            }
        }
            document.getElementById('amount').value=amount.toFixed(2);
            document.getElementById('igst').value=igst.toFixed(2);
            document.getElementById('cgst').value=cgst.toFixed(2);
            document.getElementById('sgst').value=sgst.toFixed(2);
            document.getElementById('total').value=(parseFloat(net_amount)).toFixed(2);
            document.getElementById('net_amount').value=(parseFloat(net_amount)+parseFloat(document.getElementById('at_work_charges').value)+parseFloat(document.getElementById('other_charges').value)).toFixed(2);
    }
</script>
<style>
.border_none{
    border:none;
    background:none;
    width:50px !important;
}
</style>