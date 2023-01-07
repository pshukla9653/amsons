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
						<strong>Edit Discount</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/discount/edit/'.$discount->id, $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Select Client</label>
                        <div class="col-md-9">
							<select id="client" name="client" class="select-chosen" data-placeholder="Choose Client" style="width: 250px;" required>
								<?php foreach($clients as $client){ ?>
                                        <option value="<?php echo $client->id; ?>"<?php echo ($discount->client_id==$client->id)?'selected':'';?>><?php echo $client->client_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper</label>
                        <div class="col-md-9">
							<select id="newspaper" name="newspaper" class="select-chosen" data-placeholder="Choose Newspaper" style="width: 250px;" required>
								<?php foreach($newspapers as $newspaper){ ?>
                                        <option value="<?php echo $newspaper->id; ?>" <?php echo ($discount->newspaper_id==$newspaper->id)?'selected':'';?>><?php echo $newspaper->name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Ad Types</label>
                        <div class="col-md-9">
							<select id="type" name="type" class="select-chosen" data-placeholder="Choose Types" style="width: 250px;" required>
								<option value="" >Select Ad Type</option>
								<?php foreach($types as $type){ ?>
                                        <option value="<?php echo $type->id; ?>" <?php echo ($discount->type_id==$type->id)?'selected':'';?>><?php echo $type->name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Ad Category</label>
                        <div class="col-md-9">
							<select id="cat" name="cat" class="select-chosen" data-placeholder="Choose Category" style="width: 250px;" required>
								<?php foreach($cats as $cat){ ?>
                                        <option value="<?php echo $cat->id; ?>" <?php echo ($discount->cat_id==$cat->id)?'selected':'';?>><?php echo $cat->name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Discount</label>
						<div class="col-md-9">
							<input type="text" placeholder="%" class="form-control" name="dis" id="dis" value="<?php echo $discount->discount ?>" required>
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