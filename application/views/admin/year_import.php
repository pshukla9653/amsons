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
     
        <form method="post" action="<?php echo base_url('admin/import/year_import');?>" enctype="multipart/form-data">
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
                <label>Select File :</label>
                <input type="file" name="csv_file" class="form-control" accept=".csv" required>
               
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" onclick="this.prop("disabled",true)" value="Import"/>
            </div>
        </form>
    </div>
    </div>
    </div>
    </div>
    <!-- END All Products Block -->
</div>
<script type="text/javascript">
	var sum=0;
	var tax=0;
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


</script>