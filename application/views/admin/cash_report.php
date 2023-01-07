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
						<strong>Ro_report</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				
				<!-- General Data Content -->
			<div class="row">
			    	<div class="col-lg-6">
      <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
       <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet" />
        <form method="post" action="<?php echo base_url('admin/Reports/get_ro_report');?>" enctype="multipart/form-data">
            	<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Client</label>
                        <div class="col-md-9">
							<select id="publication" name="publication" class="form-control"  data-placeholder="Choose publication" onchange="get_state();" required>
							<option value="">Choose Client</option>
							<?php 
							
							foreach($publications as $publication){ ?>
                                   <option value="<?php echo $publication->ledger_id; ?>" <?php echo  set_select('publication', $publication->ledger_id); ?>
									><?php echo $publication->ledger_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<!--<div class="form-group">-->
					<!--	<label for="price" class="col-md-3 control-label">Date</label>-->
     <!--                   <div class="col-md-9">-->
     <!--                       <input type="text" id="b_date" name="b_date" value="<?php echo set_value('b_date'); ?>" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">-->
     <!--                   </div>-->
     <!--               </div>-->
           <!--<div class="form-group">-->
           <!--     <label>Table :</label>-->
           <!--     <input type="text" name="table" class="form-control" required>-->
           <!-- </div>-->
           <div class="form-group">
						<label for="price" class="col-md-3 control-label">Date From</label>
                        <div class="col-md-9">
                            <input type="text" id="date_f" name="date_f" value="<?php echo set_value('date_f'); ?>" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Date To</label>
                        <div class="col-md-9">
                            <input type="text" id="date_t" name="date_t" value="<?php echo set_value('date_f'); ?>" class="form-control input-datepicker-close" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
            <div class="form-group">
                <input type="button" class="btn btn-primary" onclick="get_ros();" value="Show Report"/>
            </div>
        </form>
        
        
        
    </div>
			</div>
			
			<hr>
			
    <div class="row"> <div class="col-lg-12"><table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                
                <th>Date</th>
                <th>Description</th>
                <th>Credit</th>
                <th>Debit</th>
                
                
              
            </tr>
        </thead>
        <tbody>
        
        </tbody>
     
    </table></div></div>
   
    </div>
    </div>
    </div>
    <!-- END All Products Block -->
</div>
<script type="text/javascript">
	var sum=0;
	var tax=0;
	var opts=[];
	var t;


  
    
 function get_ros()

        {

            
            var newspaper = $("#publication").val();
            var from_date=$("#date_f").val();
            var to_date=$("#date_t").val();
            

            $.ajax({                

                url: "<?php echo base_url(); ?>" + "admin/Reports/cash_report_ajax",

                type: "POST",				

                async: true ,               

                data: {client_id:newspaper,from_date:from_date,to_date:to_date},

                beforeSend: function(){ document.getElementById("loader").style.display = "block"; },

                success: function(data)

                {

                    document.getElementById("loader").style.display = "none";

                    // $('#state').empty();

                      opts = $.parseJSON(data);
                    
                  console.log(opts);
                  

                   	$("#example tbody").html("");
                   	  
                      $.each(opts, function(i, d) {
                    t.row.add( [ d.date, d.narration,d.credit,d.debit]).draw();
    

                      });

                },                

                error: function() 

                {

                    document.getElementById("loader").style.display = "none";

                    alert("Some Error");

                }

            });	
           
        
            
        }
        
 
</script>
<script>
    $(document).ready(function() {
  t = $('#example').DataTable( {
       
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
   

} );
} );
</script>



<script src="https://code.jquery.com/jquery-3.3.1.js"> </script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"> 
    
</script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>