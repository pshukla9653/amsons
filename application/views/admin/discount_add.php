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
						<strong>Add New</strong>
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/discount/add', $attributes); ?>
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
                                        <option value="<?php echo $client->id; ?>"><?php echo $client->client_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Newspaper</label>
                        <div class="col-md-6">
							<select id="newspaper" name="newspaper[]" class="select-chosen" data-placeholder="Choose Newspaper" style="width: 250px;" multiple required>
								<?php foreach($newspapers as $newspaper){ ?>
                                        <option value="<?php echo $newspaper->id; ?>"><?php echo $newspaper->name; ?></option>
								<?php }?>
                            </select>
                        </div>
                        <label class="col-md-2 control-label">Select All Newspaper</label>
                        <div class="col-md-1">
                            <label class="switch switch-primary">
                                <input type="checkbox"  name="all_np" id="all_np">
                                <span></span>
                            </label>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Ad Types</label>
                        <div class="col-md-6">
							<select id="type" name="type[]" class="select-chosen" data-placeholder="Choose Types" style="width: 250px;"  multiple required>
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
						<label class="col-md-3 control-label" for="example-chosen-multiple">Ad Category</label>
                        <div class="col-md-6">
							<select id="cat" name="cat[]" class="select-chosen" data-placeholder="Choose Category" style="width: 250px;"  multiple required>
								<?php foreach($cats as $cat){ ?>
                                        <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
								<?php }?>
                            </select>
                        </div>
                        <label class="col-md-2 control-label">Select All Category</label>
                        <div class="col-md-1">
                            <label class="switch switch-primary">
                                <input type="checkbox"  name="all_cat" id="all_cat">
                                <span></span>
                            </label>
                        </div>
                    </div>
					<div class="form-group">
						<label for="pack-price" class="col-md-3 control-label">Discount</label>
						<div class="col-md-9">
							<input type="text" placeholder="%" class="form-control" name="dis" id="dis" required>
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

<script type="text/javascript">
	
$('#all_np').click(function()
{
    if ($('#all_np').is(":checked"))
    {
        $('#newspaper option').prop('selected', true);  
        $('#newspaper').trigger('chosen:updated');
    }
    else
    {
        $('#newspaper option').prop('selected', false);  
        $('#newspaper').trigger('chosen:updated');
    }


});


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

$('#all_cat').click(function()
{
    if ($('#all_cat').is(":checked"))
    {
        $('#cat option').prop('selected', true);  
        $('#cat').trigger('chosen:updated');
    }
    else
    {
        $('#cat option').prop('selected', false);  
        $('#cat').trigger('chosen:updated');
    }


});
</script>