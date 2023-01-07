<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	<div class="row text-center">
		<div class="col-sm-6 col-lg-6">
			
		</div>
		<div class="col-sm-6 col-lg-6">
			
		</div>
	</div>
	<!-- END Quick Stats -->
	<!-- All Products Block -->
	<div class="block full">
		<!-- All Products Title -->
		<div class="block-title">
			<!--<div class="block-options pull-right">
				<a title="" data-toggle="tooltip" class="btn btn-alt btn-sm btn-default" href="javascript:void(0)" data-original-title="Settings">
					<i class="fa fa-cog"></i>
				</a>
			</div>-->			
			<h2>
				<strong>Set</strong> Access<br>
				<?php echo $this->session->flashdata('msg'); ?>
			</h2>
		</div>
		<!-- END All Products Title -->
		<!-- All Products Content -->
		<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">
			<div class="row">
				<!--<div class="col-sm-6 col-xs-7">
					<div id="ecom-products_filter" class="dataTables_filter">
					<?php 
						//$attributes = array('id' => 'search');
						//echo form_open('admin/offers/', $attributes);
					?>
					
						<label>
							<div class="input-group">
								<input type="search" name="vname" class="form-control" placeholder="Search" aria-controls="ecom-products" value="<?php if(isset($vname)) //echo $vname;?>">
								<span class="input-group-addon">
									<button  name="search" type="submit" ><i class="fa fa-search"></i></button>
								</span>
							</div>
						</label>
					</form>
					</div>
				</div>-->				
			</div>
			<div class="row">
			<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'access');
					echo form_open('admin/sub_admin/access/'.$admin->id, $attributes); ?>
					<?php
					echo "<div class='text-danger' align='center'>";
					echo validation_errors();
					echo "</div>";
					?>
				<div class="col-sm-6 col-lg-6">
				<div class="table-responsive">
				<table class="table table-bordered table-condensed" id="ecom-products" >
						<tr style="margin: 50px;">
							<th style="width: 50%;" class="text-center">Access on</th>
							<th style="width: 50%;" class="text-left">
								Status
							</th>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-center">Newspaper</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="newspaper" type="checkbox" <?php echo (isset($access)&&$access->newspaper=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>
						<!--<tr>
							<td style="width: 50%;" class="text-center">Settings</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="settings" type="checkbox" <?php //echo (isset($access)&&$access->settings=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>-->
						<tr>
							<td style="width: 50%;" class="text-center">City</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="city" type="checkbox" <?php echo (isset($access)&&$access->city=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-center">Category</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="category" type="checkbox" <?php echo (isset($access)&&$access->category=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-center">News Type</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="news_type" type="checkbox" <?php echo (isset($access)&&$access->news_type=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-center">Price Set</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="price" type="checkbox" <?php echo (isset($access)&&$access->price=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-center">Settings</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="settings" type="checkbox" <?php echo (isset($access)&&$access->settings=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-center">Ro</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="ads" type="checkbox" <?php echo (isset($access)&&$access->ads=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>	
						<tr>
							<td style="width: 50%;" class="text-center">Reports</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="reports" type="checkbox" <?php echo (isset($access)&&$access->reports=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>
				</table>
				</div>
				</div>
				<div class="col-sm-6 col-lg-6">
				<div class="table-responsive">
				<table class="table table-bordered table-condensed" id="ecom-products" >
						<tr style="margin: 50px;">
							<th style="width: 50%;" class="text-center">Access on</th>
							<th style="width: 50%;" class="text-left">
								Status
							</th>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-center">Create Master</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="creat_m" type="checkbox" <?php echo (isset($access)&&$access->creat_m=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-center">Transaction</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="transaction" type="checkbox" <?php echo (isset($access)&&$access->transaction=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-center">Letters</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="letters" type="checkbox" <?php echo (isset($access)&&$access->letters=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>
						<!--<tr>
							<td style="width: 50%;" class="text-center">Settings</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="settings" type="checkbox" <?php //echo (isset($access)&&$access->settings=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>-->
						<tr>
							<td style="width: 50%;" class="text-center">RO Booking</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="ro_booking" type="checkbox" <?php echo (isset($access)&&$access->ro_booking=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-center">Ro Entery</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="ro_entery" type="checkbox" <?php echo (isset($access)&&$access->ro_entery=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-center">FM Ro</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="fm_ro" type="checkbox" <?php echo (isset($access)&&$access->fm_ro=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-center">Client Billing</td>
							<td style="width: 50%;" class="text-left">
								<div class="form-group">
									<div class="col-xs-12">
										<label class="switch switch-primary"><input name="client_billing" type="checkbox" <?php echo (isset($access)&&$access->client_billing=='1') ? 'checked' : 'unchecked' ;?>><span></span></label>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td style="width: 50%;" class="text-center"></td>
							<td style="width: 50%;" class="text-left">
								<div class="col-xs-12">
									<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
								</div>
							</td>
						</tr>
				</table>
				</div>
				</div>
				</form>
				</div>
			</div>
			<!-- END All Products Content -->
		</div>
		<!-- END All Products Block -->
	</div>