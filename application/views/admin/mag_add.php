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
						<strong>Add New</strong> Magazine
					</h2>
				</div>
				<!-- END General Data Title -->
				<!-- General Data Content -->
				<?php 
					$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add-newspaper');
					echo form_open_multipart('admin/magazine/add', $attributes); ?>
					<?php
					echo "<div class='text-danger'>";
					echo validation_errors();
					echo "</div>";
					?>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Magazine Group </label>
                        <div class="col-md-9">
							<select id="g_id" name="g_id" class="select-chosen" data-placeholder="Choose Classes" style="width: 250px;" required>
								<?php foreach($news_groups as $news_group){ ?>
                                        <option value="<?php echo $news_group->ng_id; ?>"><?php echo $news_group->ng_name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Name</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Magazine Name.." required="required" class="form-control" name="name" id="name">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Short Name</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Magazine Short Name.." required="required" class="form-control" name="sname" id="sname">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Publish Cities</label>
                        <div class="col-md-9">
							<select id="cities" name="cities[]" class="select-chosen" data-placeholder="Choose Cities" style="width: 250px;" multiple required>
								<?php foreach($cities as $city){ ?>
                                        <option value="<?php echo $city->name; ?>"><?php echo $city->name; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Magazine Language </label>
                        <div class="col-md-9">
							<select id="language" name="language" class="select-chosen" data-placeholder="Choose language" style="width: 250px;" required>
							<option value="">Choose language</option>
								<option value="Afrikanns">Afrikanns</option>
<option value="Albanian">Albanian</option>
<option value="Arabic">Arabic</option>
<option value="Armenian">Armenian</option>
<option value="Basque">Basque</option>
<option value="Bengali">Bengali</option>
<option value="Bulgarian">Bulgarian</option>
<option value="Catalan">Catalan</option>
<option value="Cambodian">Cambodian</option>
<option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
<option value="Croation">Croation</option>
<option value="Czech">Czech</option>
<option value="Danish">Danish</option>
<option value="Dutch">Dutch</option>
<option value="English">English</option>
<option value="Estonian">Estonian</option>
<option value="Fiji">Fiji</option>
<option value="Finnish">Finnish</option>
<option value="French">French</option>
<option value="Georgian">Georgian</option>
<option value="German">German</option>
<option value="Greek">Greek</option>
<option value="Gujarati">Gujarati</option>
<option value="Hebrew">Hebrew</option>
<option value="Hindi">Hindi</option>
<option value="Hungarian">Hungarian</option>
<option value="Icelandic">Icelandic</option>
<option value="Indonesian">Indonesian</option>
<option value="Irish">Irish</option>
<option value="Italian">Italian</option>
<option value="Japanese">Japanese</option>
<option value="Javanese">Javanese</option>
<option value="Korean">Korean</option>
<option value="Latin">Latin</option>
<option value="Latvian">Latvian</option>
<option value="Lithuanian">Lithuanian</option>
<option value="Macedonian">Macedonian</option>
<option value="Malay">Malay</option>
<option value="Malayalam">Malayalam</option>
<option value="Maltese">Maltese</option>
<option value="Maori">Maori</option>
<option value="Marathi">Marathi</option>
<option value="Mongolian">Mongolian</option>
<option value="Nepali">Nepali</option>
<option value="Norwegian">Norwegian</option>
<option value="Persian">Persian</option>
<option value="Polish">Polish</option>
<option value="Portuguese">Portuguese</option>
<option value="Punjabi">Punjabi</option>
<option value="Quechua">Quechua</option>
<option value="Romanian">Romanian</option>
<option value="Russian">Russian</option>
<option value="Samoan">Samoan</option>
<option value="Serbian">Serbian</option>
<option value="Slovak">Slovak</option>
<option value="Slovenian">Slovenian</option>
<option value="Spanish">Spanish</option>
<option value="Swahili">Swahili</option>
<option value="Swedish ">Swedish </option>
<option value="Tamil">Tamil</option>
<option value="Tatar">Tatar</option>
<option value="Telugu">Telugu</option>
<option value="Thai">Thai</option>
<option value="Tibetan">Tibetan</option>
<option value="Tonga">Tonga</option>
<option value="Turkish">Turkish</option>
<option value="Ukranian">Ukranian</option>
<option value="Urdu">Urdu</option>
<option value="Uzbek">Uzbek</option>
<option value="Vietnamese">Vietnamese</option>
<option value="Welsh">Welsh</option>
<option value="Xhosa">Xhosa</option>
							</select>
                        </div>
                    </div>				
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Full Address</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Address.." required="required" class="form-control" name="address" id="address">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="example-chosen-multiple">Magazine Type </label>
                        <div class="col-md-9">
							<select id="nt" name="nt" class="select-chosen" data-placeholder="Choose Classes" style="width: 250px;" required>
								<?php foreach($paper_types as $paper_type){ ?>
                                        <option value="<?php echo $paper_type->type; ?>"><?php echo $paper_type->type; ?></option>
								<?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">No. of Addition</label>
						<div class="col-md-9">
							<input type="number" placeholder="" class="form-control" name="addition" id="addition">
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">No. of Copies</label>
						<div class="col-md-9">
							<input type="number" placeholder="" class="form-control" name="copy" id="copy">
						</div>
					</div>
					
					<div class="form-group">
						<label for="example-file-input" class="col-md-3 control-label">Magazine Logo</label>
						<div class="col-md-9">
							<input type="file" name="logo" size="20" required="required">
						</div>
					</div>
					<!--<div class="form-group">
						<label class="col-md-3 control-label">Print</label>
						<div class="col-md-9">
							<label class="switch switch-primary">
								<input type="checkbox" unchecked name="print" id="print">
								<span></span>
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Outdoor</label>
						<div class="col-md-9">
							<label class="switch switch-primary">
								<input type="checkbox" unchecked name="outdoor" id="outdoor">
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