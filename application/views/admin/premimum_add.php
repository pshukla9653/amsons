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
						<strong>Add Premimum</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/premimum/add', $attributes); ?>
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
                                        <option value="<?php echo $news_group->ng_id; ?>"><?php echo $news_group->ng_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Ad Types</label>
                        <div class="col-md-6">
							<select id="type" name="type[]" class="select-chosen" data-placeholder="Choose Types" style="width: 250px;" multiple required>
								<?php foreach($types as $type){ ?>
                                        <option value="<?php echo $type->id; ?>"><?php echo $type->name; ?></option>
								<?php }?>
                            </select>
                        </div>
                        <label class="col-md-2 control-label">Select All Types</label>
                        <div class="col-md-1">
                            <label class="switch switch-primary">
                                <input type="checkbox"  name="all_tp" id="all_tp">
                                <span></span>
                            </label>
                        </div>
                    </div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Premimum Title</label>
						<div class="col-md-9">
							<input type="text" placeholder="" class="form-control" name="p_title" id="p_title" required>
						</div>
					</div>	
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Premimum</label>
						<div class="col-md-7">
							<input type="text" placeholder="" class="form-control" name="premimum" id="premimum" required>
						</div>
						<div class="col-md-2">
							<select id="p_type" name="p_type" class="form-control" data-placeholder="">
								<option value="Rs">Rs.</option>
								<option value="%">%</option>
                            </select>
                        </div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Color Type</label>
                        <div class="col-md-9">
							<select id="color" name="color" class="form-control" data-placeholder="" required>
								<option value="">Choose one</option>
								<option value="A">Any Color</option>
								<option value="B">Black/White</option>
								<option value="C">Color</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Strating Date</label>
						<div class="col-md-9">
							<input type="date" placeholder="" class="form-control" name="s_date" id="p_title" required>
						</div>
					</div>
				<!--	<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">End Date</label>
						<div class="col-md-9">
							<input type="date" placeholder="" class="form-control" name="e_date" id="p_title" required>
						</div>
					</div>-->
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

<script type="text/javascript">
	
	$('#all_tp').click(function()
{
    if ($('#all_tp').is(":checked"))
    {
        $('#type option').prop('selected', true);  
        $('#type').trigger('chosen:updated');
    }
    else
    {
        $('#type option').prop('selected', false);  
        $('#type').trigger('chosen:updated');
    }


});
</script>