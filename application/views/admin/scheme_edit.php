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
						<strong>Edit Scheme</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/scheme/edit/'.$scheme->scheme_id, $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>					
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Scheme Name</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="scheme" id="scheme"  value="<?php echo $scheme->scheme_name ?>"  required>
						</div>
					</div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Paid Day</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="paid" id="paid" value="<?php echo $scheme->paid ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Free Day</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="free" id="free" value="<?php echo $scheme->free ?>" required>
						</div>
					</div>
					<div class="form-group form-actions">
						<div class="col-md-9 col-md-offset-3">
							<button class="btn btn-sm btn-primary" type="submit">
								<i class="fa fa-floppy-o"></i> Save
							</button>
							<button class="btn btn-sm btn-warning" type="reset">
								<i class="fa fa-repeat"></i> Reset
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