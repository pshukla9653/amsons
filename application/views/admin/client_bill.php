<div id="page-content" style="min-height: 1189px;">
    <div class="block"  style="background-color:#dbe1e8;">
        <div class="block-title">
            <h2>
                <i class="fa fa-pencil"></i>
                <strong>Client Billing</strong>
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
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="price" class="col-md-3 control-label">Date To</label>
                    <div class="col-md-8">
                        <input type="hidden" id="func" onchange="show_billable_rows();">
                        <input type="text" id="date_t" onchange="get_ros();" name="bill_date" class="form-control input-datepicker-close" placeholder="mm/dd/yyyy">
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="example-chosen-multiple">State<span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <select id="client_state" name="client_state" class="form-control" data-placeholder="Choose State" required>
                            <option value="">Select State</option>
                        </select>
                    </div>
                </div>
            </div>
           <!--  <div class="col-lg-2">
                <div class="form-group">
                    <div class="col-md-4">
                        <button type="hidden" id="add_ro" onclick="add_ro();">Add Ro</button>
                    </div>
                </div>
            </div>-->
    </div>
    <div class="table-responsive" style="border-style: outset; height: 300px; overflow-y: scroll; background-color:#fff;">
        <table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
            <thead>
                <tr role="row">
                    <th style="width: 70px;" class="text-center">Ro No.</th>
                    <th>Ro Date</th>
                    <th class="text-center">Newspaper</th>
                    <th class="text-center">Insertion</th>
                    <th class="text-center">Heading</th>
                    <th class="text-center">Size</th>
                    <th class="text-center">Amount</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="table-responsive" style="border-style: outset; height: 300px; overflow-y: scroll; background-color:#fff;">
        <table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products-billable" role="grid" aria-describedby="ecom-products_info">
            <thead>
                <tr role="row">
                    <th style="width: 70px;" class="text-center">Ro No.</th>
                    <th>Ro Date</th>
                    <th class="text-center">Newspaper</th>
                    <th class="text-center">Insertion</th>
                    <th class="text-center">Heading</th>
                    <th class="text-center">Size</th>
                    <th class="text-center" colspan="2">Discount</th>
                    <th class="text-center">Amount</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php 
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'client_bill');
        echo form_open('admin/client_bill/add', $attributes)
        ?>
        <?php
            echo "<div class='text-danger'>";
        echo validation_errors();
        echo "</div>";
        ?>
        <div class="col-md-2 col-md-offset-5">
            <input type="button" name="shared_bill" id="shared_bill" value="Shared Bill" >
            </div>
        <div class="col-lg-8 col-lg-offset-2">
            <div class="form-group">
                <label for="price" class="col-md-3 control-label">Due Days</label>
                <div class="col-md-3">
                    <input type="number" placeholder=""  min="1" class="form-control" name="due_day" id="due_day" value="30" required>
                </div>
                 <div class="col-md-6">
                    
                    <div class="table-responsive" id="share" style=" display:none; border-style: outset; height: 300px; overflow-y: scroll; background-color:#fff;">
                         <label for="mshare" class="col-md-3">Main Party Share</label><input type="text" id="mshare" class="col-md-2"value=""><label class="col-md-3" for="other_share">other party share</label><input type="text" id="other_share"class="col-md-2" value="0">
        <table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="shared" role="grid" aria-describedby="ecom-products_info">
            <thead>
                 
                <tr role="row">
                    <th style="width: 70px;" class="text-center"><input type="checkbox" id='check' onClick="selectAll(this)"></th>
                    <th class="text-center">Shared parties</th>
                </tr>
               
                
                
            </thead>
            <tbody>
                <button type="button" id="apply" name="apply">Apply</button>
            </tbody>
            <tfooter>
            
            </tfooter>
        </table>
    </div>
                </div>
                
            </div>
            <div class="form-group">
                <label for="price" class="col-md-3 control-label">Amount</label>
                <div class="col-md-6">
                    <input type="text" placeholder="" class="form-control" name="amount" id="amount" value="0">
                </div>
            </div>					
            <div class="form-group">
                <label for="price" class="col-md-3 control-label">Box Charges</label>
                <div class="col-md-6">
                    <input type="text" placeholder="" class="form-control" name="box_c" id="box_c"  value="0" onchange="bill_amount()">
                    <input type="hidden" placeholder="" class="form-control" id="ro_date"  value="0">
                </div>
            </div>
            <!-- <div class="form-group">
<label for="price" class="col-md-3 control-label"><span id="dis_per1"></span>% discount</label>
<div class="col-md-9">
<input type="hidden" name="dis_per" id="dis_per"  value="0">
<input type="text" placeholder="" class="form-control" name="discount" id="discount"  value="0" onchange="bill_amount()" readonly>
</div>
</div> -->
            <div class="form-group">
                <label for="price" class="col-md-3 control-label">Total</label>
                <div class="col-md-9">
                    <input type="text" placeholder="" class="form-control" name="total" id="total"  value="0" onchange="bill_amount()">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-md-3 control-label">Art work Charges</label>
                <div class="col-md-9">
                    <input type="text" placeholder="" class="form-control" name="at_w" id="at_w"  value="0" onchange="bill_amount()">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-md-3 control-label">Other Charges</label>
                <div class="col-md-9">
                    <input type="text" placeholder="" class="form-control" name="other_c" id="other_c"  value="0" onchange="bill_amount()">
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
                    <input class="btn btn-sm btn-primary" type="button" id="savebill" value="Save Bill" onclick="save_bill();">
                </div>
            </div>
        </div>
        </form>
</div>
</div>

<script type="text/javascript">
var shared_client=[];
var shared_per =0;
var main_shared_per=0;
$(document).ready(function(){
    $("#mshare").change(function(){
        $v=100-$("#mshare").val();
        $("#other_share").val($v);
    });
    $("#shared_bill").click(function(){
      
        $("#share").toggle();
    });
     $("#apply").click(function(){
            var favorite = [];
            $.each($("input[name='sh_p']:checked"), function(){
                shared_client.push($(this).val());
                shared_per=$("#other_share").val();
                main_shared_per=$("#mshare").val();
                //favorite.push($(this).val());
            });
            if(shared_client.length==0){alert ("NO party is selected;")}
            else{
             $("#share").hide();}
           // alert("My favourite sports are: " + shared_client.join(", "));
        });
});
function selectAll(source) {
  checkboxes = document.getElementsByName('sh_p');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
    $("#date_t").datepicker().datepicker("setDate", new Date());
    function get_ros()
    {	
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
                $("#shared tbody").html("");
                $.each(tr.ros, function(i, d) 
                       {
                    $("#ecom-products tbody").append('<tr onclick="select_ro('+ d.id +','+ d.type_id +');" style="cursor:pointer" id="row_'+d.ro_no+'"><td class="text-center"><strong>'+d.ro_no+'</strong></td><td>'+d.book_date+'</td><td class="text-center">'+d.newspaper_name+'</td><td class="text-center">'+d.publish_day+'</td><td class="text-center">'+d.cat_name+'</td><td class="text-center">'+d.size_words+'</td><td class="text-center">'+d.t_amount+'</td></tr>');
                });
                $.each(tr.client_data, function(i, d) 
                       {
                           //alert(d.client_name);
                    $("#shared tbody").append('<tr ><td class="text-center"><input type="checkbox" name="sh_p" id="check[]" value="'+d.client_id+'"><input type="hidden" id="sp[]" value="'+d.client_id+'"></td> <td class="text-center">'+d.client_name+'</td></tr>');
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
            url: "<?php echo base_url(); ?>" + "admin/client_bill/get_states",
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
    var bill_detail=[];

    var popup;
    function add_ro()
    {
        var id=$("#client").val();
     //   alert(id);
        if(id =='')
        {
            alert("select client name");
            exit();
        }
        else
        {
          var url="<?php echo base_url(); ?>" + "admin/ro_billing/text_edit_ro/"+id;  
           popup = window.open(url, "Popup", top='0', right='100');
            popup.focus();
            bill_detail=[];
            return false;
        }
    }
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
       
        
        popup = window.open(url, "Popup", top='0', right='100');
        popup.focus();
        bill_detail=[];
        return false;
    }
    

    function show_billable_rows(){
       console.log('bill_detail'+bill_detail);
        var payable_amount=0;
        var amount=0;
        var extra_price=0;
        var box_charges=0;
        var dis_per=0;
        var discount=0;
        var premimum=0;
        var tr = $.parseJSON(bill_detail);
        $("#ecom-products-billable tbody").html("");
        $.each(tr, function(i, d) 
               {


            extra_price+=parseFloat(d.extra_price);
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
            discount+=parseFloat(d.discount);
            $('#row_'+d.ro_no).hide();
            $("#ecom-products-billable tbody").append('<tr style="cursor:pointer" id="billed_row_'+d.ro_no+'"><td class="text-center"><strong>'+d.ro_no+'</strong></td><td>'+d.ro_date+'</td><td class="text-center" onclick="select_ro('+ d.ro_id +','+d.type_id+');">'+d.newspaper_title+'</td><td class="text-center">'+d.insertion+'</td><td class="text-center">'+d.cat_title+'</td><td class="text-center">'+d.size_words+'</td><td class="text-center">'+d.dis_per+'</td><td class="text-center">'+d.discount+'</td><td class="text-center">'+d.payable_amount+'<a onclick="removeThisRow('+d.payable_amount+','+d.ro_no+','+d.emp_id+','+d.ro_id+','+d.work_year+')" class="btn btn-danger delbtn">-</a></td></tr>');
            payable_amount=(parseFloat(payable_amount)+parseFloat(d.payable_amount)).toFixed(2);
        });

        //document.getElementById("amount").value=(parseFloat(amount)+parseFloat(extra_price)+parseFloat(premimum)-parseFloat(discount)).toFixed(2);	
        $("#amount").val(payable_amount);	
        $("#dis_per1").html(dis_per);
        $("#dis_per").val(dis_per);
        $("#discount").val(discount);
        $("#box_c").val(box_charges);
        $("#ro_date").val(ro_date);
        $("#total").val((parseFloat(payable_amount)+parseFloat(box_charges)).toFixed(2));
    }

    function save_bill()
    {
       $("#savebill").prop("disabled",true);
        bill_amount();
        var amount=parseFloat($("#amount").val());
        var bill_date=$("#date_t").val();
        var box_c=parseFloat($("#box_c").val());
        var at_work_c=parseFloat($("#at_w").val());
        var other_c=parseFloat($("#other_c").val());
        var total=parseFloat($("#total").val());
        var dis_per=parseFloat($("#dis_per").val());
        var discount=parseFloat($("#discount").val());
        var art_work_charges=parseFloat($("#at_w").val());
        var other_charges=parseFloat($("#other_c").val());
        var cgst=parseFloat($("#cgst").val());
        var sgst=parseFloat($("#sgst").val());
        var igst=parseFloat($("#igst").val());
        var net_amount=parseFloat($("#net_amount").val());
        var client=$("#client").val();
        var due_day=$("#due_day").val();
        
        var form_data={'amount':amount,'client':client,'box_c':box_c,'art_work_c':at_work_c,'shared_client':shared_client,'shared_per':shared_per,'mshare':main_shared_per,'other_c':other_c,'total':total,'net_amount':net_amount,'due_day':due_day,'igst':igst,'cgst':cgst,'sgst':sgst,'dis_per':dis_per,'discount':discount,'art_work_charges':art_work_charges,'other_charges':other_charges,'bill_date':bill_date};
        //console.log("Form Data"+JSON.stringify(form_data)); return false;
        
        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/client_bill/save_bill",
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
        var amount= parseFloat($("#amount").val());
        var box_cha= parseFloat($("#box_c").val());	
        var at_work_c= parseFloat($("#at_w").val());
        var other_c= parseFloat($("#other_c").val());
        //var discount= parseFloat($("#discount").val());
        var ro_date=$("#ro_date").val();
        var total=0;
        var cgst=0;
        var	sgst=0;
        var	igst=0;
        //console.log("state"+state+"amount"+amount+"box_c"+box_c+"at_work_c"+at_work_c+"other_c"+other_c+"ro_date"+ro_date);
        total= taxable_amount= parseFloat(amount)+parseFloat(box_cha);
	    // 	var d1 = "2011-03-02T15:30:18-08:00";
        // 	var d2 = "2011-03-02T15:36:05-08:00";
        // if (new Date(d1) < new Date(d2)) {alert('newer')}
        var date_t=$("#date_t").val();
        var first_date=date_t; 
        var second_date="2017-07-01"; 
        //console.log(ro_date);
        if(new Date(first_date)>=new Date(second_date)){
            if(state==null){
				<?php if($cgst){ ?>
				cgst=((parseFloat(<?php echo $cgst->tax_depned;?>)*<?php echo $cgst->tax_rate;?>)/100).toFixed(2);
				<?php } else {?>
                cgst=((parseFloat(total)*2.5)/100).toFixed(2);
				<?php }?>
					<?php if($sgst){ ?>
				sgst=((parseFloat(<?php echo $sgst->tax_depned;?>)*<?php echo $sgst->tax_rate;?>)/100).toFixed(2);
				<?php } else {?>
                sgst=((parseFloat(total)*2.5)/100).toFixed(2);
				<?php }?>
                igst=0;	
            }
            else if(state=="Chandigarh"){
				<?php if($cgst){ ?>
				cgst=((parseFloat(<?php echo $cgst->tax_depned;?>)*<?php echo $cgst->tax_rate;?>)/100).toFixed(2);
				<?php } else {?>
                cgst=((parseFloat(total)*2.5)/100).toFixed(2);
				<?php }?>
					<?php if($sgst){ ?>
				sgst=((parseFloat(<?php echo $sgst->tax_depned;?>)*<?php echo $sgst->tax_rate;?>)/100).toFixed(2);
				<?php } else {?>
                sgst=((parseFloat(total)*2.5)/100).toFixed(2);
				<?php }?>
                igst=0;
            }
            else{
                cgst=0;
                sgst=0;
                <?php if($igst){ 
                    
                    ?>
                    
               igst=((parseFloat(<?php echo $igst->tax_depned;?>)*<?php echo $igst->tax_rate;?>)/100).toFixed(2);
                     
                <?php } else {?>
                igst=((parseFloat(total)*5)/100).toFixed(2);
                
                <?php }?>
            }
        }
      console.log(cgst);
      console.log(sgst);
      console.log(total);
        document.getElementById("cgst").value=cgst;
        document.getElementById("sgst").value=sgst;
        document.getElementById("igst").value=igst;
        document.getElementById("total").value = total.toFixed(2);
        document.getElementById("net_amount").value=(parseFloat(total)+parseFloat(cgst)+parseFloat(igst)+parseFloat(sgst)+parseFloat(at_work_c)+parseFloat(other_c)).toFixed(2);
    }

    function removeThisRow(amount,ro_no,emp_id,ro_id,work_year){
        alert(work_year);
        $('#row_'+ro_no).show();
        $.ajax({
            url: "<?php echo base_url(); ?>" + "admin/client_bill/remove_ro",
            type: "POST",				
            async: false,               
            data: {'ro_id':ro_id,'work_year':work_year,'emp_id':emp_id},
            beforeSend: function(){ document.getElementById("loader").style.display = "block";},
            success: function(data)
            {
                alert(data);
                document.getElementById("loader").style.display = "none";
            },                
            
            error: function(request, status, error)
            {
                document.getElementById("loader").style.display = "none";
                //console.log("Error is: "+request.responseText);
            }
        });
 
        $("#amount").val(parseFloat($("#amount").val())-parseFloat(amount));
        bill_amount();
    }

    $("table#ecom-products-billable").on("click", ".delbtn", function (event) {
        $(this).closest("tr").remove();
    });
</script>