
<form method="post" id="flayer_form" enctype="multipart/form-data" name="flayer_form">
<h3>Step 1:</h3>
<h4>Select Flyer to add</h4>
<input type="file" id="fileinput" />
<hr>
<button type="button" onclick="uploadflayer();" class="btn btn-primary" value="Save" />save</button>
</form>
<h3>Step 2:</h3>
<h4>Select Flyer Size</h4>
<form method="post" id="flayer_size_form" enctype="multipart/form-data" name="flayer_size_form">
<div id="select-flyer-size">
    <input type="hidden" name="hidden_flayer_images_id" id="hidden_flayer_images_id" value="">
	<label class="box-radio">
            <input type="radio" name="flyer_size" value="8.5-11" id="option1">Letter 8.5 x 11
	</label>
	<label class="box-radio">
		<input type="radio" name="flyer_size" value="5-7" id="option2"> Postcard 5 x 7
	</label>
	<label class="box-radio">
		<input type="radio" name="flyer_size" value="11-17" id="option3"> Tabloid 11 x 17
	</label>
	<label class="box-radio checked">
		<input type="radio" name="flyer_size" value="8.5-14" id="option4"> Legal 8.5 x 14
	</label>
	<label class="box-radio">
		<input type="radio" name="flyer_size" value="6-9" id="option5"> Postcard 6 x 9
	</label>

   <div class="button-group-warp clearfix mt-20">
    <ul class="list-inline pull-right">
        <li><button type="button" onclick="uploadflayerimagesize();"  class="btn btn-primary" value="Save" />save</button></li>
            
    </ul>
</div> 
    </div>
</form>



<hr>

<h3>Step 3:</h3>
<h4>Select buttons and tags for flyer</h4>
<div class="row">
    <?php if(!empty($buttontags)){ ?>
	<div class="checkbox-3-col col-md-6">
	
		<div class="input-wrap clearfix">
			<h4 class="col-heading">Button Tags</h4>
                        <?php foreach ($buttontags as $btn){ ?>
			<label class="box-checkbox">
				<input type="checkbox" name="btn_tags" id="tag_1"> <?php echo $btn['button_tags_title']; ?>
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
<hr>

<h3>Step 4:</h3>
<hr>
<input type="submit" class="btn btn-primary" value="Upload" />