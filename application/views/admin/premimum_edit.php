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
						<strong>Edit Premimum</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/premimum/edit/'.$pre->id, $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper Group</label>
                        <div class="col-md-9">
							<select id="newspaper_group" name="newspaper_group" class="select-chosen" data-placeholder="Choose Newspaper Group" style="width: 250px;" required>
								<?php foreach($news_groups as $news_group){ ?>
                                        <option value="<?php echo $news_group->ng_id; ?>" <?php echo ($pre->g_id==$news_group->ng_id)?'selected':'';?>><?php echo $news_group->ng_name; ?></option>
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
                                        <option value="<?php echo $type->id; ?>" <?php echo ($pre->type_id==$type->id)?'selected':'';?>><?php echo $type->name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<?php 
						$premimum=explode(",",$pre->premimum);
					?>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Premimum Title</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="p_title" id="p_title"  value="<?php echo $pre->p_type; ?>" required>
						</div>
					</div>	
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Premimum</label>
						<div class="col-md-7">
							<input type="text" placeholder="" value="<?php echo $premimum[0]; ?>" class="form-control" name="premimum" id="premimum" required>
						</div>
						<div class="col-md-2">
							<select id="p_type" name="p_type" class="form-control" data-placeholder="">
								<option value="Rs" <?php echo ('Rs'==$premimum[1])?'selected':'';?>>Rs.</option>
								<option value="%" <?php echo ('%'==$premimum[1])?'selected':'';?>>%</option>
                            </select>
                        </div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Color Type</label>
                        <div class="col-md-9">
							<select id="color" name="color" class="form-control" data-placeholder="" required>
								<option value="">Choose one</option>
								<option value="A" <?php echo ('A'==$pre->color)?'selected':'';?>>Any Color</option>
								<option value="B" <?php echo ('B'==$pre->color)?'selected':'';?>>Black/White</option>
								<option value="C" <?php echo ('C'==$pre->color)?'selected':'';?>>Color</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Strating Date</label>
						<div class="col-md-9">
							<input type="date" placeholder="" class="form-control" name="s_date" id="s_date" value="<?php echo $pre->sdate ; ?>"required>
						</div>
					</div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">End Date</label>
						<div class="col-md-9">
							<input type="date" placeholder="" class="form-control" name="e_date" id="e_date" value="<?php echo $pre->edate ; ?>" required>
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
