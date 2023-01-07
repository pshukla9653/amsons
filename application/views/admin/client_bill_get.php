<div id="page-content" style="min-height: 1189px;">
	<!-- Product Edit Content -->
	<div class="row">
		<div class="col-lg-12">
			<!-- General Data Block -->
			<div class="block">
				<!-- General Data Title -->				
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-pack');
					echo form_open('admin/client_bill/get/'.$book_ad->id, $attributes); ?>
					<?php
					echo "<div class='text-danger' align='center'>";
					echo validation_errors();
					echo "</div>";
					?>
					<input type="hidden" placeholder="" class="form-control" name="c_id" id="c_id" value="<?php echo $book_ad->u_id;?>" >
						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Amount</label>
							<div class="col-md-9">
								<input type="text" placeholder="" required="required" class="form-control" name="amt" id="amt" value="<?php echo $book_ad->t_amount;?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Add on Amt</label>
							<div class="col-md-9">
								<input type="number" min="0" onkeyup="total_amount();"  value="0"  class="form-control" name="aoa" id="aoa" >
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Box Charges</label>
							<div class="col-md-9">
								<input type="number" min="0" onkeyup="total_amount();"  value="0"  class="form-control" name="bc" id="bc" >
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-md-3 control-label">EL Charges</label>
							<div class="col-md-9">
								<input type="number" min="0" onkeyup="total_amount();"  value="0"  class="form-control" name="elc" id="elc" >
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Non Focus Day</label>
							<div class="col-md-9">
								<input type="number" min="0" onkeyup="total_amount();"  value="0"  class="form-control" name="nfd" id="nfd" >
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Premium</label>
							<div class="col-md-9">
								<input type="number" min="0" onkeyup="total_amount();"  value="0"  class="form-control" name="premium" id="premium" >
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Discount %</label>
							<div class="col-md-9">
								<input type="text" onkeyup="total_amount();"   value="<?php echo $discount;?>"  class="form-control" name="dis" id="dis" >
							</div>
						</div>
						<div class="form-group">
							<label for="pack-price" class="col-md-3 control-label">Total Amount</label>
							<div class="col-md-9">
								<input type="text" name="total" id="total" class="form-control" readonly>			
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="example-chosen-multiple">Tax %</label>
							<div class="col-md-9">
								<select id="tax" name="tax"  onkeyup="total_amount();" class="form-control" data-placeholder="Choose one" required>
								<?php foreach($taxs as $tax){ ?>
                                        <option value="<?php echo $tax->tax_rate; ?>"><?php echo $tax->tax_rate; ?></option>
								<?php }?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Tax Amount</label>
							<div class="col-md-9">
								<input type="text" value="<?php echo $discount;?>"  class="form-control" name="tax_a" id="tax_a" >
							</div>
						</div>						
						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Net</label>
							<div class="col-md-9">
								<input type="text" onkeyup="total_amount();"   value="0"  class="form-control" name="net" id="net" readonly>
							</div>
						</div>
						<div class="form-group form-actions">
							<div class="col-md-9 col-md-offset-3">
								<button class="btn btn-sm btn-warning" type="reset">
									<i class="fa fa-repeat"></i> Reset
								</button>
								<button class="btn btn-sm btn-primary" type="submit">
									<i class="fa fa-floppy-o"></i> Save
								</button>
							</div>
						</div>
					</form>
					<!-- END General Data Content -->
			</div>
			<!-- END General Data Block -->
		</div>
	<!-- END Product Edit Content -->
</div>

<script type="text/javascript">


function total_amount()
{
	var amt = parseFloat(document.getElementById("amt").value);
	var aoa =  parseFloat(document.getElementById("aoa").value);
	var bc =  parseFloat(document.getElementById("bc").value);
	var elc =  parseFloat(document.getElementById("elc").value);
	var nfd =  parseFloat(document.getElementById("nfd").value);
	var premium =  parseFloat(document.getElementById("premium").value);
	
	var tax = parseFloat(document.getElementById("tax").value);	
	var dis =  parseFloat(document.getElementById("dis").value);
		
	var s_total=amt + aoa + bc + elc + nfd + premium;
		
	var total=s_total-(dis*s_total/100);
	
	var tax_a=tax*total/100;
	
	var net=total+tax_a
	
	document.getElementById("total").value = total.toFixed( 2 );
	document.getElementById("tax_a").value = tax_a.toFixed( 2 );
	document.getElementById("net").value = net.toFixed( 2 );
		//slot_rate(st);	
}

$(document).ready(function (){ 

total_amount();


});
</script>