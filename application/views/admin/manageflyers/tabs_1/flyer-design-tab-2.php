<div class="row">
    <?php if(!empty($buttontags)){ ?>
	<div class="checkbox-3-col col-md-6">
	
		<div class="input-wrap clearfix">
			<h4 class="col-heading">Button Tags</h4>
                        <?php foreach($buttontags as $button){ ?>
			<label class="box-checkbox">
				<input type="checkbox" name="btn_tags" > <?php echo $button['button_tags_title']; ?>
			</label>
                        <?php } ?>
			
		</div>
		<div class="button-group-warp clearfix mt-20">
			<ul class="list-inline pull-right">
				<li><input type="submit" class="btn btn-primary" value="Save" /></li>
				<li><input type="submit" class="btn btn-warning" value="Undo" /></li>
				<li><input type="submit" class="btn btn-danger" value="Clear All" /></li>
			</ul>
		</div>
	</div>
    <?php } ?>
    <?php if(!empty($flyertags)){ ?>
	<div class="checkbox-3-col col-md-6">

		<div class="input-wrap clearfix">
			<h4 class="col-heading">Flyer Tags</h4>

			<?php foreach ($flyertags as $flyer){ ?>
			<label class="box-checkbox">
				<input type="checkbox" name="flyer_tags" id="tag_1"> <?php echo $flyer['flyer_tags_title']; ?>
			</label>
                        <?php } ?>
			
		</div>
		<div class="button-group-warp clearfix mt-20">
			<ul class="list-inline pull-right">
				<li><input type="submit" class="btn btn-primary" value="Save" /></li>
				<li><input type="submit" class="btn btn-warning" value="Undo" /></li>
				<li><input type="submit" class="btn btn-danger" value="Clear All" /></li>
			</ul>
		</div>
	</div>
    <?php } ?>
</div>

<h4>Choose Your Flyer</h4>

<div class="row">
	<div class="checkbox-4-col col-md-9">

		<div class="input-wrap clearfix">
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_1"> Open House Flyer
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_2"> Recruiting
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_3"> Newsletters
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_4"> Broker Tour Flyers
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_5"> For Sale Flyers
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_5"> Additional Services
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_5"> Home Inspection
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_5"> Luxury Properties
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_5"> Landscaping
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_5"> Proof Inspection
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_5"> Just Sold Flyers
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_5"> Social Media
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_5"> Market Statics Flyers
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_5"> Relocation Referral
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_5"> Multiple Agent Flyers
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_5"> Termite Inspection
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_5"> Painting
			</label>
			<label class="box-checkbox box-checkbox-3">
				<input type="checkbox" name="btn_tags" id="tag_5"> Holiday
			</label>
		</div>

		<div class="row mt-20">
			<div class="col-md-6">
				<div class="row choose-flyer-grid-wrap">
					<div class="col-md-4 mb-20">
						<img class="img-responsive" src="<?php echo base_url() . 'public/upload/flyer_images/placeholder-image.jpg' ?>" />
					</div>
					<div class="col-md-4 mb-20">
						<img class="img-responsive" src="<?php echo base_url() . 'public/upload/flyer_images/placeholder-image.jpg' ?>" />
					</div>
					<div class="col-md-4 mb-20">
						<img class="img-responsive" src="<?php echo base_url() . 'public/upload/flyer_images/placeholder-image.jpg' ?>" />
					</div>
					<div class="col-md-4 mb-20">
						<img class="img-responsive" src="<?php echo base_url() . 'public/upload/flyer_images/placeholder-image.jpg' ?>" />
					</div>
					<div class="col-md-4 mb-20">
						<img class="img-responsive" src="<?php echo base_url() . 'public/upload/flyer_images/placeholder-image.jpg' ?>" />
					</div>
					<div class="col-md-4 mb-20">
						<img class="img-responsive" src="<?php echo base_url() . 'public/upload/flyer_images/placeholder-image.jpg' ?>" />
					</div>
					<div class="col-md-4 mb-20">
						<img class="img-responsive" src="<?php echo base_url() . 'public/upload/flyer_images/placeholder-image.jpg' ?>" />
					</div>
					<div class="col-md-4 mb-20">
						<img class="img-responsive" src="<?php echo base_url() . 'public/upload/flyer_images/placeholder-image.jpg' ?>" />
					</div>
					<div class="col-md-4 mb-20">
						<img class="img-responsive" src="<?php echo base_url() . 'public/upload/flyer_images/placeholder-image.jpg' ?>" />
					</div>
					<div class="col-md-4 mb-20">
						<img class="img-responsive" src="<?php echo base_url() . 'public/upload/flyer_images/placeholder-image.jpg' ?>" />
					</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<img class="img-responsive" src="<?php echo base_url() . 'public/upload/flyer_images/placeholder-image.jpg' ?>" />
			</div>
		</div>

		<div class="button-group-warp clearfix mt-20">
			<ul class="list-inline pull-right mb-0">
				<li><input type="submit" class="btn btn-primary" value="Save" /></li>
				<li><input type="submit" class="btn btn-warning" value="Undo" /></li>
			</ul>
		</div>

	</div>
	<div class="col-md-3">

		<div class="module panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Open House Flyer</h3>
			</div>
			<div class="panel-body">
				<h4 class="mt-0 mb-10">Tags</h4>
				<select class="select-box form-control br-0" name="cars" multiple="">
					<option value="option-1">Open House</option>
					<option value="option-2">Broker Tour</option>
					<option value="option-3">For Sale</option>
					<option value="option-4">Multiple Agents</option>
					<option value="option-5">Luxury</option>
				</select>
				<h4 class="text-center mt-10 mb-0">Button Tags</h4>
			</div>
		</div>

		<div class="module panel panel-default">
			<div class="panel-body">
				<h4 class="mt-0 mb-10">Flyer</h4>
				<img class="img-responsive" src="<?php echo base_url() . 'public/upload/flyer_images/placeholder-image.jpg' ?>" />
			</div>
		</div>

		<div class="module panel panel-default">
			<div class="panel-body">
				<h4 class="mt-0 mb-10">Tags</h4>
				<select class="select-box form-control br-0" name="cars" multiple="">
					<option value="option-1">Open House</option>
					<option value="option-2">Broker Tour</option>
					<option value="option-3">For Sale</option>
				</select>
			</div>
		</div>

	</div>
</div>