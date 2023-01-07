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
                <th>Ro No</th>
                <th>Ro Date</th>
                <th>Newspaper Group</th>
                <th>Newspaper Name</th>
                <th>Client Name</th>
                <th>DOP</th>
                <th>Client Bill No</th>
                     <th> Bill Amount</th>
           
                <th>Publication Bill No</th>
                     <th> Publication Bill Amount</th>
           
            </tr>
        </thead>
        <tbody>
        
        </tbody>
        <tfoot>
            <tr>
                 <th>Ro No</th>
                <th>Ro Date</th>
                <th>Newspaper Group</th>
                <th>Newspaper Name</th>
                <th>Client Name</th>
                <th>DOP</th>
                <th>Client Bill No</th>
                            <th> Bill Amount</th>
         
                <th>Publication Bill No</th>
                            <th> Publication Bill Amount</th>
         
            </tr>
        </tfoot>
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
//$("#b_date").datepicker();
//$("#dop").datepicker();

//$("#date_t").datepicker({});


  
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

 function get_ros()

        {

            
            var newspaper = $("#publication").val();
            var state=$("#state").val();
            var from_date=$("#date_f").val();
            var to_date=$("#date_t").val();
            

            $.ajax({                

                url: "<?php echo base_url(); ?>" + "admin/Reports/get_ro_report",

                type: "POST",				

                async: true ,               

                data: {newspaper_id:newspaper,state:state,from_date:from_date,to_date:to_date},

                beforeSend: function(){ document.getElementById("loader").style.display = "block"; },

                success: function(data)

                {

                    document.getElementById("loader").style.display = "none";

                    // $('#state').empty();

                      opts = $.parseJSON(data);
                    
                  console.log(opts);
                  

                   	$("#example tbody").html("");
                   	  
                      $.each(opts, function(i, d) {
                    t.row.add( [ d.ro_no, d.book_date,d.ng_name,d.name,d.client_name,d.dop,d.bill_number,d.bill_amount,d.newspaper_bill_no,d.eprice]).draw();
    
                //       $('#example tbody').append('<tr><td>'+d.ro_no+'</td><td>'+d.book_date+'</td><td>'+d.ng_name+'</td><td>'+d.client_name+'</td><td>'+d.name+'</td><td>'+d.dop+'</td><td>'+d.bill_number+'</td><td>'+d.newspaper_bill_no+'</td></tr>');

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