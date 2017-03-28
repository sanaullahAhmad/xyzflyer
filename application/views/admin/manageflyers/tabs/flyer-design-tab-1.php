<form method="post" id="flayer_form" enctype="multipart/form-data" name="flayer_form">
<h3>Step 1:</h3>
<h4>Select Flyer to add</h4>
<input type="file" required id="fileinput" name="fileinput[]" multiple="multiple" />
<hr>
<h3>Step 2:</h3>
<h4>Select Flyer Size</h4>
<div id="select-flyer-size">
    <input type="hidden" name="hidden_flayer_images_id" id="hidden_flayer_images_id" value="">

   <?php
   	foreach ($flyerSize as $size) { ?>
   		<label class="box-radio btn btn-success" required>
            <input type="radio" name="flyer_size" required value="<?php echo $size['pk_flyer_size_id']; ?>" id="option1"><?php echo $size['flyer_size_title']; ?>
		</label>
   	<?php }  ?>
    </div>
<hr>
<h3>Step 3:</h3>
<hr>
<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
<button class="btn btn-primary" id="step2"><i class="fa fa-arrow-right"></i> Next (Choose Flyer)</button>
</form>

<script type="text/javascript">
	$('#step2').on('click', function(event) {
		event.preventDefault();
    $('.nav-tabs a[href="#tab-id-1-2"]').tab('show');
});
</script>