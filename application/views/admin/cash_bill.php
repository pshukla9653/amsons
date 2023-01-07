<div id="page-content" style="min-height: 1189px;">
    <div class="block"  style="background-color:#dbe1e8;">
        <div class="block-title">
            <h2>
                <i class="fa fa-pencil"></i>
                <strong>Cash Billing</strong>
            </h2>
        </div>
        <div class="row" style="background-color:#dbe1e8;">            
            <div class="col-lg-3">
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
                        <input type="text" id="bill_date" onchange="get_ros();" value="<?php echo date('m/d/Y');?>" name="bill_date" class="form-control input-datepicker-close" placeholder="mm/dd/yyyy">
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="example-chosen-multiple">Payment Mode<span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <select id="payment_mode" name="payment_mode" onchange="tss(this,'#bank_div')" class="form-control" data-placeholder="Choose State" required>
                            <option value="">Select</option>
                            <option value="cheque">Cheque</option>
                            <option value="cash">Cash</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3" id="bank_div" style="display:none">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="example-chosen-multiple">bank<span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <select id="bank" name="bank" class="form-control" data-placeholder="Choose bank" required>
                            <option value="">Select</option>
                            <?php foreach($banks as $bank){ ?>
                            <option value="<?php echo $bank->id; ?>"><?php echo $bank->bank_name; ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>
    </div>
    <div class="table-responsive" style="border-style: outset; height: 300px; overflow-y: scroll; background-color:#fff;">
        <table class="table table-bordered table-striped table-vcenter dataTable no-footer" id="ecom-products" role="grid" aria-describedby="ecom-products_info">
            <thead>
                <tr role="row">
                    <th style="width: 70px;" class="text-center"></th>
                    <th style="width: 70px;" class="text-center">Bill No.</th>
                    <th>Bill Date</th>
                    <th class="text-center">Media Am</th>
                    <th class="text-center">Disc</th>
                    <th class="text-center">Bill Amount</th>
                    <th class="text-center">Net</th>
                    <th class="text-center">Status</th>

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
        echo form_open('admin/cash_bill/add', $attributes)
        ?>
        <?php
            echo "<div class='text-danger'>";
        echo validation_errors();
        echo "</div>";
        ?>
        <div class="col-lg-8 col-lg-offset-2">
            
                   <!-- <input type="hidden" placeholder="" class="form-control" name="total" id="total"  value="0" onchange="bill_amount()">
            -->
             <div class="form-group">
                <label for="price" class="col-md-3 control-label">Total</label>
                <div class="col-md-9">
                    <input type="text" placeholder="" class="form-control" name="total" id="total"  value="0">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-md-3 control-label">Received</label>
                <div class="col-md-9">
                    <input type="text" placeholder="" class="form-control" name="received" id="received"  value="0">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-md-3 control-label">Deposit Bank</label>
                <div class="col-md-9">
                    <input type="text" placeholder="" class="form-control" name="deposit_bank" id="deposit_bank"  value="0">
                </div>
            </div>
			            <div class="form-group">
                <label for="price" class="col-md-3 control-label">Cheque no & Bank</label>
                <div class="col-md-9">
                    <input type="text" placeholder="" class="form-control" name="cheque_no" id="cheque_no"  value="0">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-9 col-md-offset-3">
                    <input class="btn btn-sm btn-primary" type="button" id="savebill" value="Save Bill" onclick="save_bill();">
                </div>
            </div>
        </div>
        </form>
</div>
</div>

<script type="text/javascript">
function tss(a,div){
    
    a = $(a).val();
    
    if(a=='cheque'){
        
        $(div).show();
        $('#bank').val('');
    } else {
        $(div).hide(); 
        $('#bank').val('');
    }
    
}
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
function test(){
    var t = 0;
     $.each($("input[name='tb_bill_id']:checked"), function(){
          t += parseFloat($(this).attr('vas')); 
      //   alert($(this).attr('vas'))
            });  
        $('#total').val(t);    
}

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
            url: "<?php echo base_url(); ?>" + "admin/client_bill/get_bill",
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
                $.each(tr.client_data, function(i, d) 
                       {
                            net_amount = d.net_amount;
                          d.net_amount= net_amount.replace(',','');   
                    $("#ecom-products tbody").append('<tr  style="cursor:pointer" id="row_'+d.id+'"><td class="text-center"><strong><input type="checkbox" class="tb_bill_id" onclick="test(this)" name="tb_bill_id" value="'+d.id+'" vas="'+d.net_amount+'" /></strong></td><td class="text-center"><strong>'+d.bill_no+'</strong></td><td>'+d.bill_date+'</td><td class="text-center">'+d.total+'</td><td class="text-center">'+d.dis_per+'</td><td class="text-center">'+d.total+'</td><td class="text-center">'+d.net_amount+'</td><td class="text-center">'+d.Shared_Status+'</td></tr>');
                });
               },                
            error: function() 
            {
                document.getElementById("loader").style.display = "none";
                alert("Please Select Position!");
            }
        });
    }

    


    function save_bill()
    {
       //$("#savebill").prop("disabled",true);
        var bill_date=$("#bill_date").val();
        var client=$("#client").val();
        var payment_mode=$("#payment_mode").val();
        
		var tb_bill_id=$('input[name="tb_bill_id"]:checked').val();
        var total=parseFloat($("#total").val());
        var received=parseFloat($("#received").val());
        var deposit_bank=($("#deposit_bank").val());
        var cheque_no=($("#cheque_no").val());
	    var bank=($("#bank").val());
		
		var sList = '';
$('input[type=checkbox]').each(function () {
	if(this.checked){
	 sList +=  $(this).val();
	 sList += ',';
	}
    //sList += "(" + $(this).val() + "-" + (this.checked ? "checked" : "not checked") + ")";
});
console.log (sList);
        var form_data={'bill_date':bill_date,'client':client,'payment_mode':payment_mode,
		'tb_bill_id':sList,
		'total':total,
		'received':received,
		'deposit_bank':deposit_bank,
		'cheque_no':cheque_no,
		'bank':bank
		};
        $.ajax({                
            url: "<?php echo base_url(); ?>" + "admin/cash_bill/save_bill",
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
            error: function(request, status, error)
            {
                document.getElementById("loader").style.display = "none";
                //console.log("Error is: "+request.responseText);
            }
        });
    } 

   

    $("table#ecom-products-billable").on("click", ".delbtn", function (event) {
        $(this).closest("tr").remove();
    });
</script>