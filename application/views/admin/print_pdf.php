<div id="page-content" style="min-height: 1189px;">

	<!-- Quick Stats -->

	<div class="row text-center">

		<div class="col-sm-6 col-lg-3">


		</div>

		<div class="col-sm-6 col-lg-3">

		</div>
	</div>
	<div class="block full">
		<!-- All Products Title -->
		<div class="block-title">

			<!--<div class="block-options pull-right">

				<a title="" data-toggle="tooltip" class="btn btn-alt btn-sm btn-default" href="javascript:void(0)" data-original-title="Settings">

					<i class="fa fa-cog"></i>

				</a>

			</div>-->

			<h2>

				<strong>All</strong> Book Ads

			

			</h2>

		</div>

		<h2>

			<?php echo $this->session->flashdata('msg'); ?>

			<script  type="text/javascript">

				if(<?php echo ($this->session->flashdata('msg')!=null)?'1':'0'?>)

				{

					alert("<?php echo $this->session->flashdata('msg')?>");

				}

			</script>

		</h2>

		<!-- END All Products Title -->

		<!-- All Products Content -->

		<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">

			<div class="row">

				<div class="col-sm-6 col-xs-7">

					<div id="ecom-products_filter" class="dataTables_filter">

					<?php 

						$attributes = array('id' => 'search');

						echo form_open('admin/Pdf_ro/all', $attributes);

					?>

					

						<label>

							<div class="input-group">

						<input type="text" name="from" class="form-control" placeholder="from" aria-controls="ecom-products" value="<?php if(isset($name)) echo $name;?>">
						<input type="text" name="to" class="form-control" placeholder="to" aria-controls="ecom-products" value="<?php if(isset($name)) echo $name;?>">
						
								<span class="input-group-addon">

									<button  name="search" type="submit" ><i class="fa fa-search"></i></button>

								</span>

							</div>

						</label>

					</form>

					</div>

				</div>

			</div>

			
			</div>

			<!-- END All Products Content -->

		</div>

		<!-- END All Products Block -->

	</div>
	