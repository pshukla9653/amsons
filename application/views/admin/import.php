<?php set_time_limit(0);?>
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
						<strong>Import Bill</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
			
				<div class="col-lg-6">
     
        <form method="post" action="<?php echo base_url('admin/import/add');?>" enctype="multipart/form-data">
            	<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Publication</label>
                        <div class="col-md-9">
							<select id="publication" name="publication" class="form-control"  data-placeholder="Choose publication" onchange="get_state();" required>
							<option value="">Choose Publication</option>
							<?php 
							
							foreach($publications as $publication){ ?>
                                   <option value="<?php echo $publication->ng_id; ?>" <?php echo  set_select('publication', $publication->ng_id); ?>
									><?php echo $publication->ng_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
                      <div class="form-group">

                        <label class="col-md-3 control-label" for="example-chosen-multiple">Select State <span class="text-danger">*</span></label>

                        <div class="col-md-9">

                            <select name="state" id="state"  class="form-control" data-placeholder="Choose City" required >

                                <option value="" >Select State</option>

                            </select>

                        </div>

                    </div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Date</label>
                        <div class="col-md-9">
                            <input type="text" id="b_date" name="b_date" value="<?php echo set_value('b_date'); ?>" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
           <div class="form-group">
                <label>Table :</label>
                <input type="text" name="table" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Select File :</label>
                <input type="file" name="csv_file" class="form-control" accept=".csv" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Import"/>
            </div>
        </form>
    </div>
    <!-- END All Products Block -->
</div>
	</div>
			<!-- END General Data Block -->
		</div>
	<!-- END Product Edit Content -->
</div>

<script type="text/javascript">
	var sum=0;
	var tax=0;
//$("#b_date").datepicker();
//$("#dop").datepicker();

//$("#date_t").datepicker({});

$("#dop").focusout(function(){
    if($("#dop").val()=='')
    {    //$("#dop").attr("disabled","disabled");
        //$("#ro_no").removeAttr("disabled");
    $("#ro_no").val('');
 
    }
    else
    {
        get_ro();
   // $("#ro_no").val('');
     //   $("#ro_no").attr("disabled","disabled");
     }
});
   function getbillamount()
   {  var bill_amount=$("#bill_a").val();
         var state=$("#state").val();
     if(state=="6"){

                       var cgst=(((parseFloat(bill_amount))*(parseFloat(5)/2))/100).toFixed(2);

                        var sgst=(((parseFloat(bill_amount)*(parseFloat(5)/2))/100)).toFixed(2);

                        var igst=0;

                    } else {

                        var cgst=0;

                        var sgst=0;

                        var igst=(((parseFloat(bill_amount)*parseFloat(5))/100)).toFixed(2);

                    } 
	var billamount=(parseFloat(bill_amount)+parseFloat(cgst)+parseFloat(igst)+parseFloat(sgst)).toFixed(2);
	$("#gst").val(cgst);
	$("#sgst").val(sgst);
	$("#igst").val(igst);
	$("#billamount").val(billamount);
	 sum=0;
   }
    function checkbill()
    {
     var billno =$("#bill_no").val();   
       var  billdata=jQuery.parseJSON('<?php echo json_encode($bills)?>');
      
       $.each(billdata,function(i,d){
          
           if(d.bill_no==billno)
           {
               alert("Bill no already exists");
               $("#bill_no").val('');
               $("#bill_no").focusin();
               exit();
           }
       });
    }
     function get_state()

        {

            
            var newspaper = $("#publication").val();

            $.ajax({                

                url: "<?php echo base_url(); ?>" + "admin/newspaper_bill/get_state",

                type: "POST",				

                async: true ,               

                data: {newspaper_id:newspaper},

                beforeSend: function(){ document.getElementById("loader").style.display = "block"; },

                success: function(data)

                {

                    document.getElementById("loader").style.display = "none";

                    $('#state').empty();

                    var opts = $.parseJSON(data);
                    console.log(opts);

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
           
        
            
        }

function get_ro()
{	
	var ro_no= $("#ro_no").val();
	var bill_a= $("#bill_a").val();
	var dop =$("#dop").val();
	var publication=$("#publication").val();

		$("#ecom-products tbody").html("");
	$.ajax({                
			url: "<?php echo base_url(); ?>" + "admin/newspaper_bill/get_ro",
			type: "POST",				
			async: true ,               
			data: {'ro_no':ro_no,'bill_a':bill_a,'publication':publication,'dop':dop},
			beforeSend: function(){ document.getElementById("loader").style.display = "block";},
			success: function(data)
				{
					document.getElementById("loader").style.display = "none";
					if(data=='1')
					{
						alert("Fill All Mandatory Felids.");
						document.getElementById("ro_no").value ="";
						return false;
					}
					if(data=='2')
					{
						alert("No Ro Found.");						
					  $("#ok").prop("checked",false);
        $("#nook").prop("checked",true);
					}
					if(data=='3')
					{
						alert("Bill amount is greater than payable amount.");
						document.getElementById("ro_no").value ="";
						document.getElementById("bill_a").value ="";
						return false;
					}
					
					
					var tr = $.parseJSON(data);
					
					$("#ecom-products tbody").html("");
					
					// Use jQuery's each to iterate over the opts value
					$.each(tr, function(i, d) 
					{
						// You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data		onclick="select_ro('+ d.id +','+ d.type_id +');" 
						var date=d.dop;
					//	alert (date);
						if(date=="")
						{
							alert("No Date Found for publiction bill.");
							document.getElementById("ro_no").value ="";
							return false;
						}
						var dop=date.split(", ");
						//alert(d.ro_id);
						document.getElementById("ro_id").value = d.ro_id.toString();
						
						$.each(dop, function(x, v) 
						{ 
						    
						    var state=$("#state").val();
						    	var da=d.c_date.split(" ");
						         var first_date=da[0];
                                var second_date="2017-07-01"; 

                //console.log(ro_date);
var dop_amt=parseFloat(d.dop_amount)-parseFloat(d.newspaper_billed_amount);
                if(new Date(first_date)>=new Date(second_date)){

                    if(state=="6"){

                       var cgst=(((parseFloat(dop_amt))*(parseFloat(5)/2))/100).toFixed(2);

                        var sgst=(((parseFloat(dop_amt)*(parseFloat(5)/2))/100)).toFixed(2);

                        var igst=0;

                    } else {

                        var cgst=0;

                        var sgst=0;

                        var igst=(((parseFloat(dop_amt)*parseFloat(5))/100)).toFixed(2);

                    } 

                }

                else{

                      var cgst=0;

                        var sgst=0;

                        var igst=0;

                }
//var status=(d.news_bill_status).toString();

						var totalamount=(parseFloat(dop_amt)+parseFloat(cgst)+parseFloat(igst)+parseFloat(sgst)).toFixed(2);
							$("#ecom-products tbody").append('<tr id="tbl_row'+d.paper_id+'"><td class="text-center"><strong><input type="checkbox" name="p_dop_ro[]" id="p_dop'+d.id+'" value="'+d.id+'" onclick="getvalue('+d.id+','+totalamount+');">  '+d.newspaper_name+'</strong></td><td class="text-center">'+v+'</td><td class="text-center">'+d.ro_no+'</td><td class="text-center">'+da[0]+'</td><td class="text-center"><input type="text" name="dop_amount[]" value="'+d.dop_amount+'" disabled ></td><td class="text-center">'+cgst+'</td><td class="text-center">'+sgst+'</td><td class="text-center">'+igst+'</td><td class="text-center">'+d.newspaper_billed_amount+'</td><td class="text-center">'+totalamount+'</td></tr>');
							
							
						});	
					});
					
				},                
			error: function() 
					{
						document.getElementById("loader").style.display = "none";
						alert("Please Select Position!");
					}
			});
}
function getvalue(id,amt)
{
    // if(status=='N')
    // {
     var bill_amount=$("#billamount").val();
    
	
        if($("#p_dop"+id).is(":checked"))
        {
         sum=sum+amt;
        
        }
        else
        {
          sum=sum-amt;  
          //alert(sum);
        }
        
         $("#total").val(sum.toFixed(2));
        if(sum<bill_amount)
        {
            $("#ok").prop("checked",false);
            $("#nook").prop("checked",true);
            
        }
        else
        {
          $("#ok").prop("checked",true);
            $("#nook").prop("checked",false);  
        }
    
}

</script>