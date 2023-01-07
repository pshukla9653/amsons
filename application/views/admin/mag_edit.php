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
						<strong>Edit Magazine</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/magazine/edit_mag/'.$newspaper->id, $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";					
					?>
					<input type="hidden" value="<?php echo $newspaper->name?>" required="required" name="old_name" id="old_name">
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Magazine Group </label>
                        <div class="col-md-9">
							<select id="g_id" name="g_id" class="select-chosen" data-placeholder="Choose Classes" style="width: 250px;" required>
								<?php foreach($news_groups as $news_group){ ?>
                                        <option value="<?php echo $news_group->ng_id; ?>" <?php if($news_group->ng_id==$newspaper->g_id)echo "selected";?>><?php echo $news_group->ng_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Name</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Magazine Name.." value="<?php echo $newspaper->name?>" required="required" class="form-control" name="name" id="name">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Short Name</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Magazine Short Name.." value="<?php echo $newspaper->short_name?>" required="required" class="form-control" name="sname" id="sname">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Publish Cities</label>
                        <div class="col-md-9">
							<select id="cities" name="cities[]" class="select-chosen" data-placeholder="Choose Classes" style="width: 250px;" multiple required>
								<?php foreach($cities as $city){ ?>
                                        <option value="<?php echo $city->name; ?>" <?php foreach($p_cities as $p_city){if($p_city==$city->name)echo "selected";}?>><?php echo $city->name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Magazine Language</label>
						<div class="col-md-9">
							<input type="text" placeholder=""  value="<?php echo $newspaper->language?>" class="form-control" name="language" id="language" >
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Full Address</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Address.." required="required" class="form-control" name="address" id="address" value="<?php echo $newspaper->address?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Magazine Type </label>
                        <div class="col-md-9">
							<select id="nt" name="nt" class="select-chosen" data-placeholder="Choose Classes" style="width: 250px;" required>
								<?php foreach($paper_types as $paper_type){ ?>
                                        <option value="<?php echo $paper_type->type; ?>" <?php if($paper_type->type==$newspaper->p_type)echo "selected";?>><?php echo $paper_type->type; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">No. of Addition</label>
						<div class="col-md-9">
							<input type="number" placeholder="" class="form-control" name="addition" id="addition" value="<?php echo $newspaper->no_of_additions?>">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">No. of Copies</label>
						<div class="col-md-9">
							<input type="number" placeholder="" class="form-control" name="copy" id="copy" value="<?php echo $newspaper->no_of_copies?>">
						</div>
					</div>
					
					<input type="hidden" name="logo_pic" value="<?php echo $newspaper->logo?>">
					<div class="form-group">
						<label for="example-file-input" class="col-md-3 control-label">Magazine Logo <sub>Select if want to update</sub></label>
						<div class="col-md-9">
							<input type="file" name="logo" size="20">
						</div>
					</div>
					<!--<div class="form-group">
						<label class="col-md-3 control-label">Print</label>
						<div class="col-md-9">
							<label class="switch switch-primary">
								<input type="checkbox" name="print" id="print" <?php //echo($newspaper->print=='1')?"checked":"unchecked";?>>
								<span></span>
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Outdoor</label>
						<div class="col-md-9">
							<label class="switch switch-primary">
								<input type="checkbox" name="outdoor" id="outdoor" <?php //echo($newspaper->outdoor=='1')?"checked":"unchecked";?>>
								<span></span>
							</label>
						</div>
					</div>-->
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