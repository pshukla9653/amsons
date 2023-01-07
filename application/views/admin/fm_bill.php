<div id="page-content" style="min-height: 1189px;">
    <div class="block"  style="background-color:#dbe1e8;">
        <div class="block-title">
            <h2>
                <i class="fa fa-pencil"></i>
                <strong>FM Billing</strong>
            </h2>
        </div>
        <div class="row" style="background-color:#dbe1e8;">            
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="example-chosen-multiple">Client<span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <select id="client" name="client" onchange="get_ros();" class="form-control" data-placeholder="Choose Client" required>
                            <option value="" >Select Client</option>
                            <?php foreach($clients as $client){ ?>
                            <option value="<?php echo $client->id; ?>"><?php echo $client->client_name; ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="price" class="col-md-3 control-label">Date To</label>
                    <div class="col-md-9">
                        <input type="hidden" id="func" onchange="show_billable_rows();">
                        <input type="text" id="date_t" onchange="get_ros();" name="bill_date" class="form-control input-datepicker-close" placeholder="mm/dd/yyyy">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="example-chosen-multiple">State<span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <select id="client_state" name="client_state" class="form-control" data-placeholder="Choose State" required>
                            <option value="">Select State</option>
                        </select>
                    </div>
                </div>
            </div>
            
    </div>
    <div class="table-responsive" style="border-style: outset; height: 300px; overflow-y: scroll; background-color:#fff;">
        <table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
            <thead>
                <tr role="row">
                    <th style="width: 70px;" class="text-center">Ro No.</th>
                    <th>Ro Date</th>
                    <th class="text-center">Date From</th>
                    <th class="text-center">Date To</th>
                     <th class="text-center">Total Days</th>
                    <th class="text-center">Slot</th>
                    <th class="text-center">Frequency</th>
                    <th class="text-center">Total Sec</th>
                    <th class="text-center">Rate/10 Sec</th>

                      <th class="text-center">Rate</th>
                      <th class="text-center">Material</th>
                      <th class="text-center">Total</th>
                      <th class="text-center">Disc Per</th>
                      <th class="text-center">Discount</th>
                      <th class="text-center">Status</th>
                     



                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
   <!-- <div class="table-responsive" style="border-style: outset; height: 300px; overflow-y: scroll; background-color:#fff;">
        <table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products-billable" role="grid" aria-describedby="ecom-products_info">
            <thead>
                <tr role="row">
                   <th style="width: 70px;" class="text-center">Ro No.</th>
                    <th>Ro Date</th>
                    <th class="text-center">Date From</th>
                    <th class="text-center">Date To</th>
                    <th class="text-center">Total Days</th>
                    <th class="text-center">Slot</th>
                    <th class="text-center">Frequency</th>
                    <th class="text-center">Total Sec</th>
                    <th class="text-center">Rate/10 Sec</th>

                      <th class="text-center">Rate</th>
                      <th class="text-center">Material</th>
                      <th class="text-center">Total</th>
                      <th class="text-center">Disc Per</th>
                      <th class="text-center">Discount</th>
                      <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>-->
</div>
<div class="row">
    <div class="col-lg-12">
        <?php 
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'fm_bill');
        echo form_open('admin/fm_bill/add', $attributes)
        ?>
        <?php
            echo "<div class='text-danger'>";
        echo validation_errors();
        echo "</div>";
        ?>
      <!--  <div class="col-lg-8 col-lg-offset-2">
            <div class="form-group">
                <label for="price" class="col-md-3 control-label">Due Days</label>
                <div class="col-md-9">
                    <input type="number" placeholder=""  min="1" class="form-control" name="due_day" id="due_day" value="30" required>
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-md-3 control-label">Amount</label>
                <div class="col-md-9">
                    <input type="text" placeholder="" class="form-control" name="amount" id="amount" value="0">
                </div>
            </div>					
            <div class="form-group">
                <label for="price" class="col-md-3 control-label">Box Charges</label>
                <div class="col-md-9">
                    <input type="text" placeholder="" class="form-control" name="box_c" id="box_c"  value="0" onchange="bill_amount()">
                    <input type="hidden" placeholder="" class="form-control" id="ro_date"  value="0">
                </div>
            </div>-->
            <!-- <div class="form-group">
<label for="price" class="col-md-3 control-label"><span id="dis_per1"></span>% discount</label>
<div class="col-md-9">
<input type="hidden" name="dis_per" id="dis_per"  value="0">
<input type="text" placeholder="" class="form-control" name="discount" id="discount"  value="0" onchange="bill_amount()" readonly>
</div>
</div> -->
           
            <div class="form-group">
                <label for="t_amount" class="col-md-1 control-label">TOTAL AMOUNT</label>
                <div class="col-md-2">
                    <input type="text" id="t_amount" class="form-control" name="t_amount" value="0">  
                   
                </div>
                <label for="comm_amount" class="col-md-1 control-label">TOTAL Commission</label>
                <div class="col-md-2">
                    <input type="text" id="comm_amount" class="form-control" name="comm_amount" value="0">  
                   
                </div>
                <label for="total_tax" class="col-md-1 control-label">TOTAL Tax</label>
                <div class="col-md-2">
                    <input type="text" id="total_tax" class="form-control" name="total_tax" value="0">  
                   
                </div>
                <label for="n_amount" class="col-md-1 control-label">TOTAL Payable Amount</label>
                <div class="col-md-2">
                    <input type="text" id="n_amount" class="form-control" name="n_amount" value="0">  
                   
                </div>
            </div>
           
            <div class="form-group">
                <label for="price" class="col-md-3 control-label">CGST</label>
                <div class="col-md-3">
                    <input type="text" placeholder="" class="form-control" name="cgst" id="cgst"  value="0">
                </div>	
                <div class="col-md-3">
                    <label for="price" class="col-md-3 control-label">SGST</label>
                </div>
                <div class="col-md-3">
                    <input type="text" placeholder="" class="form-control" name="sgst" id="sgst"  value="0">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-md-3 control-label">IGST</label>
                <div class="col-md-9">
                    <input type="text" placeholder="" class="form-control" name="igst" id="igst"  value="0">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-md-3 control-label">Net Amount</label>
                <div class="col-md-9">
                    <input type="text" placeholder="" class="form-control" name="net_amount" id="net_amount"  value="0">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-9 col-md-offset-3">
                    <div class="btn btn-sm btn-primary" onclick="bill_amount();">
                        Calculate
                    </div>
                    <input class="btn btn-sm btn-primary" type="button" value="Save Bill" onclick="save_bill();">
                </div>
            </div>
        </div>
        </form>
</div>
</div>

<script type="text/javascript">
  var bill_detail=[];
function calculate_amount()
{}
    $("#date_t").datepicker().datepicker("setDate", new Date());
    function get_ros()
    {	
        var date_2= $("#date_t").val();
        var client= $("#client").val();
        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/fm_bill/get_ros",
            type: "POST",				
            async: true ,               
            data: {'date_t':date_2,'client':client},
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                //console.log(data); return false;
                document.getElementById("loader").style.display = "none";
                if(data=='1')
                {
                    alert("Fill All Mandatory Fields.");
                    return false;
                }
                if(data=='2')
                {
                    alert("No Ro Found.");
                    return false;
                }
                var tr = $.parseJSON(data);
                $("#ecom-products tbody").html("");
                
                $.each(tr, function(i, d) 
                       {
                           bill_detail.push(d);
                           var ta=$("#t_amount").val();
                          
                       var cm=$("#comm_amount").val();
                       var tax=$("#total_tax").val();
                       var n_amt=$("#n_amount").val();
                        ta=parseFloat(ta) + parseFloat(d.amount);
                     cm=parseFloat(cm)  + parseFloat(d.tcom);
                     tax=parseFloat(tax) + parseFloat(d.txa);
                     n_amt=parseFloat(n_amt) + parseFloat(d.pmt);
                     document.getElementById("comm_amount").value=cm;
                     $("#t_amount").val(ta);
                      $("#total_tax").val(tax);
                       $("#n_amount").val(n_amt);
                       
                   // $("#ecom-products tbody").append('<tr onclick="select_ro(d.ro_no);" style="cursor:pointer" id="row_'+d.ro_no+'"><td class="text-center"><strong>'+d.ro_no+'</strong></td><td>'+d.ro_date+'</td><td class="text-center">'+d.date_from+'</td><td class="text-center">'+d.date_to+'</td><td class="text-center">'+d.total_day+'</td><td class="text-center">'+d.slot_dur+'</td><td class="text-center">'+d.day_times+'</td><td class="text-center">'+d.total_sec+'</td><td class="text-center">'+d.rate_per_10+'</td><td class="text-center">'+d.rate_one+'</td><td class="text-center">'+d.material+'</td><td class="text-center">'+d.amount+'</td><td class="text-center">'+d.amount+'</td><td class="text-center">'+d.total+'</td><td class="text-center">'+d.bill_status+'</td></tr>');
                    $("#ecom-products tbody").append('<tr  style="cursor:pointer" id="row_'+d.ro_no+'"><td class="text-center"><input type="hidden" name="ro_no[]" id="ro_no[]" value="'+d.ro_no+'"><strong>'+d.ro_no+'</strong></td><td>'+d.ro_date+'</td><td class="text-center">'+d.date_from+'</td><td class="text-center">'+d.date_to+'</td><td class="text-center">'+d.total_day+'</td><td class="text-center">'+d.slot_dur+'</td><td class="text-center">'+d.day_times+'</td><td class="text-center">'+d.total_sec+'</td><td class="text-center">'+d.rate_per_10+'</td><td class="text-center">'+d.rate_one+'</td><td class="text-center">'+d.material+'</td><td class="text-center">'+d.amount+'</td><td class="text-center">'+d.amount+'</td><td class="text-center">'+d.total+'</td><td class="text-center">'+d.bill_status+'</td></tr>');
                    
                    
                });
                          
            },                
            error: function() 
            {
                document.getElementById("loader").style.display = "none";
                alert("Please Select Position!");
            }
        });
        get_state(client);
    }

    function get_state(client){
        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/fm_bill/get_states",
            type: "POST",				
            async: true ,               
            data: {'client':client},
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                //console.log(data); return false;
                document.getElementById("loader").style.display = "none";
                var tr = $.parseJSON(data);
                $("#client_state").html("");
                $.each(tr, function(i, d) 
                       {
                    $("#client_state").append('<option value='+ d.state +'>'+ d.state +'</option>');
                });
            },                
            error: function() 
            {
                document.getElementById("loader").style.display = "none";
                alert("Please Select Position!");
            }
        });
    }
  

    var popup;
    function select_ro(id)
    {
          var url="<?php echo base_url(); ?>" + "admin/ro_billing/fm_edit/"+id;
        popup = window.open(url, "Popup", top='0', right='100');
        popup.focus();
        bill_detail=[];
        return false;
    }

    function show_billable_rows(){
        //console.log('bill_detail'+bill_detail);
        var payable_amount=0;
        var amount=0;
        var extra_price=0;
        var box_charges=0;
        var dis_per=0;
        var discount=0;
        var premimum=0;
        var tr = bill_detail;
        $("#ecom-products-billable tbody").html("");
        $.each(tr, function(i, d) 
               {

                    
         /*   extra_price+=parseFloat(d.extra_price);
            box_charges+=parseFloat(d.box_charges);
            amount+=parseFloat(d.amount);

            prem=d.premimum.split(",");

            if(prem[1] == 'Rs')
            {
                premimum+=(parseFloat(d.extra_price)+parseFloat(d.amount))+prem[0];
            }
            if(prem[1] == '%')
            {
                premimum+=((parseFloat(d.extra_price)+parseFloat(d.amount))*prem[0])/100;
            }

            //premimum+=parseFloat(d.premimum);
            dis_per=d.dis_per;
            ro_date=d.ro_date;
            discount+=parseFloat(d.discount);*/
            $('#row_'+d.ro_no).hide();
            $("#ecom-products-billable tbody").append('<tr onclick="select_ro('+ d.id +','+ "FM" +');" style="cursor:pointer" id="row_'+d.ro_no+'"><td class="text-center"><strong>'+d.ro_no+'</strong></td><td>'+d.ro_date+'</td><td class="text-center">'+d.date_from+'</td><td class="text-center">'+d.date_to+'</td><td class="text-center">'+d.total_day+'</td><td class="text-center">'+d.slot_dur+'</td><td class="text-center">'+d.day_times+'</td><td class="text-center">'+d.total_sec+'</td><td class="text-center">'+d.rate_per_10+'</td><td class="text-center">'+d.rate+'</td><td class="text-center">'+d.material+'</td><td class="text-center">'+d.total+'<a onclick="removeThisRow('+d.payable_amount+')" class="btn btn-danger delbtn">-</a></td></tr>');
            payable_amount=(parseFloat(payable_amount)+parseFloat(d.payable_amount)).toFixed(2);
        });

        //document.getElementById("amount").value=(parseFloat(amount)+parseFloat(extra_price)+parseFloat(premimum)-parseFloat(discount)).toFixed(2);	
        $("#amount").val(payable_amount);	
       // $("#dis_per1").html(dis_per);
       // $("#dis_per").val(dis_per);
        $("#discount").val(discount);
        //$("#box_c").val(box_charges);
        $("#ro_date").val(ro_date);
        $("#total").val((parseFloat(payable_amount)).toFixed(2));
    }

    function save_bill()
    {
        var amount=parseFloat($("#t_amount").val());
        var bill_date=$("#date_t").val();
        var box_c=0;
       var at_work_c=0;
        var other_c=0;
        var total=parseFloat($("#n_amount").val());
        var dis_per=0;
        var discount=parseFloat($("#comm_amount").val());
        var art_work_charges=0;
          var other_charges=0;
        var cgst=parseFloat($("#cgst").val());
        var sgst=parseFloat($("#sgst").val());
        var igst=parseFloat($("#igst").val());
        var net_amount=parseFloat($("#net_amount").val());
        var client=$("#client").val();
        var due_day=$("#due_day").val();
        var ro=[];
 ro =bill_detail;
 
        var form_data={'amount':amount,'client':client,'box_c':box_c,'art_work_c':at_work_c,'other_c':other_c,'total':total,'net_amount':net_amount,'due_day':due_day,'igst':igst,'cgst':cgst,'sgst':sgst,'dis_per':dis_per,'discount':discount,'art_work_charges':art_work_charges,'other_charges':other_charges,'bill_date':bill_date,'ro_no':ro};
        //console.log("Form Data"+JSON.stringify(form_data)); return false;
        
        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/fm_bill/fm_save_bill",
            type: "POST",				
            async: false,               
            data: form_data,
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                document.getElementById("loader").style.display = "none";
                console.log("data: "+data);
                if(data=='1')
                {
                    alert("Fill All Mandatory Fileds.");
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
                }
            },                
            // error: function()
            // {
            // 	document.getElementById("loader").style.display = "none";
            // 	alert("Ro not add !");
            // }
            error: function(request, status, error)
            {
                document.getElementById("loader").style.display = "none";
                //console.log("Error is: "+request.responseText);
            }
        });
    } 

    function bill_amount(){
        var state=$("#client_state").val();
        var amount= parseFloat($("#n_amount").val());
       // var box_c= parseFloat($("#box_c").val());	
        //var at_work_c= parseFloat($("#at_w").val());
        //var other_c= parseFloat($("#other_c").val());
        //var discount= parseFloat($("#discount").val());
        var ro_date=$("#ro_date").val();
        var total=0;
        var cgst=0;
        var	sgst=0;
        var	igst=0;
        //console.log("state"+state+"amount"+amount+"box_c"+box_c+"at_work_c"+at_work_c+"other_c"+other_c+"ro_date"+ro_date);
        total=parseFloat(amount);

        // 	var d1 = "2011-03-02T15:30:18-08:00";
        // 	var d2 = "2011-03-02T15:36:05-08:00";
        // if (new Date(d1) < new Date(d2)) {alert('newer')}
        var date_t=$("#date_t").val();
        var first_date=date_t; 
        var second_date="2017-07-01"; 
        //console.log(ro_date);
        if(new Date(first_date)>=new Date(second_date)){
            if(state==null){
                cgst=(parseFloat(total)*2.5)/100;
                sgst=(parseFloat(total)*2.5)/100;
                igst=0;	
            }
            else if(state=="Chandigarh"){
                cgst=(parseFloat(total)*2.5)/100;
                sgst=(parseFloat(total)*2.5)/100;
                igst=0;
            }
            else{
                cgst=0;
                sgst=0;
                igst=(parseFloat(total)*5)/100;
            }
        }
        document.getElementById("cgst").value=cgst.toFixed(2);
        document.getElementById("sgst").value=sgst.toFixed(2);
        document.getElementById("igst").value=igst.toFixed(2);
       // document.getElementById("total").value = total.toFixed(2);
        document.getElementById("net_amount").value=(parseFloat(total)+parseFloat(cgst)+parseFloat(igst)+parseFloat(sgst)).toFixed(2);
    }

    function removeThisRow(amount){
         $('#row_'+d.ro_no).hide();
        $("#amount").val(parseFloat($("#amount").val())-parseFloat(amount));
        bill_amount();
    }

    $("table#ecom-products-billable").on("click", ".delbtn", function (event) {
        $(this).closest("tr").remove();
    });
</script>