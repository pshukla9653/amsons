<div id="page-content" style="min-height: 1189px;">
    <div class="block"  style="background-color:#dbe1e8;">
        <div class="block-title">
            <h2>
                <i class="fa fa-pencil"></i>
                <strong>Generate Ro</strong>
            </h2>
        </div>
        	
        <div class="row" style="background-color:#dbe1e8;">            
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="example-chosen-multiple">Book_id<span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <select id="client" name="client" onchange="get_ros();" class="form-control" data-placeholder="Choose Client" required>
                            <option value="" >Select Booking Id</option>
                            <?php foreach($clients as $client){ ?>
                            <option value="<?php echo $client->book_id; ?>"><?php echo $client->book_id; ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>
           <!-- <div class="col-lg-4">
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
            </div>-->
            
    </div>
    <form action="generate_ros" method="POST">
    <div class="table-responsive" style="border-style: outset; height: 300px; overflow-y: scroll; background-color:#fff;">
        <table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
            <thead>
                <tr role="row">
                    <th style="width: 70px;" class="text-center">ID</th>
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
    <div>
        <input type="text" id="roid" name ="roid">
        <button type="submit">GENERATE RO</button>
        </div>

  </form>
    </div>


<script type="text/javascript">
    $("#date_t").datepicker().datepicker("setDate", new Date());
    function get_ros()
    {	
        //var date_2= $("#date_t").val();
        var client= $("#client").val();
        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/generate_ro/get_ros",
            type: "POST",				
            async: true ,               
            data: {'client':client},
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
                $("#roid").val("");
                $.each(tr, function(i, d) 
                       {
                    $("#ecom-products tbody").append('<tr onclick="select_ro('+ d.id +','+ d.type_id +');" style="cursor:pointer" id="row_'+d.id+'"><td class="text-center"><strong>'+d.id+'</strong></td><td>'+d.book_date+'</td><td class="text-center">'+d.newspaper_name+'</td><td class="text-center">'+d.publish_day+'</td><td class="text-center">'+d.cat_name+'</td><td class="text-center">'+d.size_words+'</td><td class="text-center">'+d.t_amount+'</td></tr>');
                    //alert(d.id);
                    
                    if($("#roid").val() == "")
                    {
                        $("#roid").val(function(){return this.value + d.id;}) ;
                    }
                    else
                    {
                    $("#roid").val(function(){return this.value + ","+d.id;}) ;
                    }
                });
                
            },                
            error: function() 
            {
                document.getElementById("loader").style.display = "none";
                alert("Error!");
            }
        });
        get_state(client);
    }

    function get_state(client){
        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/generate_ro/get_states",
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
        //console.log('bill_detail'+bill_detail);
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
            $("#ecom-products-billable tbody").append('<tr style="cursor:pointer" id="billed_row_'+d.ro_no+'"><td class="text-center"><strong>'+d.ro_no+'</strong></td><td>'+d.ro_date+'</td><td class="text-center" onclick="select_ro('+ d.ro_id +',1);">'+d.newspaper_title+'</td><td class="text-center">'+d.insertion+'</td><td class="text-center">'+d.cat_title+'</td><td class="text-center">'+d.size_words+'</td><td class="text-center">'+d.dis_per+'</td><td class="text-center">'+d.discount+'</td><td class="text-center">'+d.payable_amount+'<a onclick="removeThisRow('+d.payable_amount+')" class="btn btn-danger delbtn">-</a></td></tr>');
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

        var form_data={'amount':amount,'client':client,'box_c':box_c,'art_work_c':at_work_c,'other_c':other_c,'total':total,'net_amount':net_amount,'due_day':due_day,'igst':igst,'cgst':cgst,'sgst':sgst,'dis_per':dis_per,'discount':discount,'art_work_charges':art_work_charges,'other_charges':other_charges,'bill_date':bill_date};
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
        var box_c= parseFloat($("#box_c").val());	
        var at_work_c= parseFloat($("#at_w").val());
        var other_c= parseFloat($("#other_c").val());
        //var discount= parseFloat($("#discount").val());
        var ro_date=$("#ro_date").val();
        var total=0;
        var cgst=0;
        var	sgst=0;
        var	igst=0;
        //console.log("state"+state+"amount"+amount+"box_c"+box_c+"at_work_c"+at_work_c+"other_c"+other_c+"ro_date"+ro_date);
        total=parseFloat(amount)+parseFloat(box_c);

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
        document.getElementById("total").value = total.toFixed(2);
        document.getElementById("net_amount").value=(parseFloat(total)+parseFloat(cgst)+parseFloat(igst)+parseFloat(sgst)+parseFloat(at_work_c)+parseFloat(other_c)).toFixed(2);
    }

    function removeThisRow(amount){
        $("#amount").val(parseFloat($("#amount").val())-parseFloat(amount));
        bill_amount();
    }

    $("table#ecom-products-billable").on("click", ".delbtn", function (event) {
        $(this).closest("tr").remove();
    });
    function storeTblValues()
{
    var TableData = new Array();

    $('#roTable tr').each(function(row, tr){
        TableData[row]={
            "id" : $(tr).find('td:eq(0)').text()
           
        }    
    }); 
    TableData.shift();
    // first row will be empty - so remove
    return TableData;
}


</script>