<style>
	.buttons .col-md-2, .taggs .col-md-2{width: 15.67%;}
	.buttons a{margin: 3px; padding: 5px 10px;}
</style>
<!-- <div class="row">
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
</div> -->

<h4>Choose Flyer Tags</h4>

<div class="row">
	<div class="checkbox-2-col col-md-12">
		<div class="input-wrap clearfix taggs">

			<?php $num = 0;
			foreach ($flyerTags as $tags) { $num++;?>
			<label class="box-checkbox btn btn-primary col-md-2" id="checkbox_<?php echo $tags['pk_flyer_tags']; ?>">
				<input type="checkbox" name="flyer_tags" class="flyer_tags" value="<?php echo $tags['pk_flyer_tags']; ?>" id="tag_<?php echo $tags['pk_flyer_tags']; ?>"> <?php echo $tags['flyer_tags_title']; ?>
			</label>
			<?php } ?>
		</div>
		<input type="hidden" id="selected_flyer" value="" />
	</div>
</div>

<div class="row">
	<div class="button-group-warp clearfix mt-20 col-md-12">
		<div class="col-md-3 pull-left">
			Total Tags: (<span id="tags_number">0</span>)
		</div>
		<div class="col-sm-5">
			<div class="status alert alert-warning" id="status" style="padding: 10px; display: none;"><strong>Tags Not Saved</strong> Added: <strong><span id="added"></span></strong> Removed: <strong><span id="removed"></span></strong></div>
		</div>
		<div class="col-md-4 pull-right">
			<ul class="list-inline pull-right">
				<li><button class="btn btn-warning" id="reset_flyer_tags"><i class="fa fa-reset"></i> Reset</button></li>
				<li><button class="btn btn-success" id="save_flyer_tags"><i class="fa fa-save"></i> Save</button></li>
				<!-- <li><input type="submit" class="btn btn-warning" value="Undo" /></li> -->
				<li><button  class="btn btn-danger" id="clear_all" ><i class="fa fa-paint-brush"></i> Clear Selection</li>
			</ul>
		</div>
	</div>
</div>


<h4>Choose Flyer</h4>
<div class="row">
	<div class="col-md-12">

		<div class="row buttons">
			<div class="col-md-12">
				<a class="btn btn-success  btn-design new_flyers_btn"  id="new_flyers_btn" href="">NEW FLYERS</a>
				<?php $num = 0; foreach ($flyerTags as $tags) { $num++;?>
				<a class="btn btn-primary   btn-design load_flyers" id="<?php echo $tags['pk_flyer_tags']; ?>" href=""><?php echo '('.$tags['total'].') '.$tags['flyer_tags_title']; ?></a>
				<?php } ?>
			</div>
		</div>

		<div class="row mt-20">
			<?php $num = 0; if($flyers){ ?>
			<div class="col-md-6">
				<div class="row">
					<?php foreach ($flyers as $flyer) { $num++;?>
					<div class="col-md-4 col-xs-6 col-sm-4 col-lg-4" id="flyer_small_<?php echo $flyer['pk_flyer_detail_id']?>">
						<img class="flyer_small img-responsive" id="<?php echo $flyer['pk_flyer_detail_id']?>" size="<?php echo $flyer['flyer_size_title']?>" src="<?php echo base_url() . 'public/upload/flyer_images/thumb_'.$flyer['flyer_image'] ?>" img="<?=$flyer['flyer_image']?>"	/>
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-md-6">
			<!-- $('#big_image').prop('src',base_url+'/public/admin/img/placeholder-image.jpg');  -->
				<img class="img-responsive" id="big_image" src="<?php echo base_url() . '/public/admin/img/placeholder-image.jpg' ?>"  idd=""/>
			</div>
			<?php } else{?>
			<div class="col-md-6 col-md-offset-3">
				<br>
				<p class="well text-danger text-center">
					There are no flyers to choose. Please check again later.
				</p>
			</div>
			<?php }?>
		</div>

		<div class="button-group-warp clearfix mt-20">
			<ul class="list-inline pull-right mb-0">
				<!-- <li><input type="submit" class="btn btn-primary" value="Save" /></li> -->
				<a href="#" class="btn btn-primary load_flyer_json" id="next_flyer_design"><i class="fa fa-arrow-right"></i> Next (Design Flyer)</a>
			</ul>
		</div>

	</div>
</div>


<script type="text/javascript">

	var previous_tags = Array();
	var removed = Array();
	var added = Array();

// tab activate on next button click
$('#next_flyer_design').on('click', function(event) {
	event.preventDefault();
	if($('.flyer_small_selected').length>0){
		$('.nav-tabs a[href="#tab-id-1-3"]').tab('show');
		proFabric.clearCanvas();
		$('#cs-tablist li').each(function(){
			$(this).remove();
		});
		$('#cs-tabContent div').each(function(){
			$(this).remove();
		});
		$('#cs-tablist').append('<li class="active"><a href="#cs-sample1" class="cs-sample1" data-toggle="tab">Sample 1</a></li>');
		$('#cs-tabContent').append('<div role="tabpanel" class="tab-pane active" id="cs-sample1"></div>');

	}
	else noti('warning','Please choose a flyer to continue to next step!');
});

//when small flyers/ thumbnails are clicked
$(document).delegate('.flyer_small', 'click', function(event) {
	// $('.flyer_small').on('click', function(event) {
		added = []; removed = [];
		$('#status').hide();$('#status #removed, #status #added').text(0);
		event.preventDefault();
		previous_tags = Array();
		id = $(this).attr('id');
		var i_src = $(this).attr('src');
		i_src = i_src.substring(i_src.lastIndexOf('/')+1);
		i_src = i_src.split("_")[1];
		i_src = site_url+"/public/upload/flyer_images/resized_" + i_src;
		// console.log("#######: " + i_src);
		$('#big_image').attr('src',i_src).attr('idd',id).fadeIn();
		$('.flyer_small').removeClass('flyer_small_selected');
		$(this).addClass('flyer_small_selected');
		$('#selected_flyer').val(id);
		$('#editor-canvasSize').text($(this).attr('size'));
		addBackgroundImage();

//get the tags for this flyer and select them
$.ajax({
	url: site_url+'admin/manageflyers/ajax_get_flyer_tags/'+$(this).attr('id'),
	type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {param1: 'value1'},
			beforeSend: function(res){
					// noti('default','Saving tags, please wait!');
					// console.log('getting tags:'+res);
					clear_tags();
				},
				success: function(res){
					// if(res=='done') noti('success','Tags saved!');
					if(res!='Nothing')
				{	// alert(res);

					$.each($.parseJSON(res), function() {
						$('#checkbox_'+this.fk_flyer_tag_id).addClass('checked');
						$('#tag_'+this.fk_flyer_tag_id).prop('checked',true);
									// alert(this.fk_flyer_tag_id);
									previous_tags.push(this.fk_flyer_tag_id);
								});

					$('#tags_number').text($.parseJSON(res).length);
				}else $('#tags_number').text(0);

				$('.list-inline.mb-0 .delete_this_flyer').remove();
				$('.list-inline.mb-0').prepend('<a id="'+id+'" class="btn btn-danger delete_this_flyer" href=""><i class="fa fa-trash"></i> Delete this Flyer</a>')

			},
			error: function(res){
				noti('danger','Something went wrong: '+res);
			}
		})

/* Act on the event */
});


function clear_tags()
{
	$('.box-checkbox').removeClass('checked');
	$('.flyer_tags').removeAttr('checked');
	$('#tags_number').text(0);
}

// when clear all button is clicked
$('#clear_all').on('click', function(event) {
	event.preventDefault();
	clear_tags();
	noti('success','All Tags Cleared!');
	added = []; removed = [];
	$('#status').hide();$('#status #removed, #status #added').text(0);
});

// when save flyer button is clicked
$('#save_flyer_tags').on('click', function(event) {
	event.preventDefault();
	var selected_flyer = $('#selected_flyer').val();
	if(selected_flyer=='') noti('warning', '<h4 class="text-warning">Warning!</h4>Please select a Flyer to attach the tags to it!');
	else if(!$('.box-checkbox').hasClass('checked')) noti('warning', '<h4 class="text-warning">Warning!</h4>No Tags Selected! Please select Tags!');
	else{

		var tags = [];
		$('.box-checkbox :checked').each(function() {
			tags.push($(this).val());
		});

		var removed_tags = $(previous_tags).not(tags).get();

		$.ajax({
			url: site_url+'/admin/manageflyers/ajax_save_flyer_tags_relation/'+selected_flyer,
			type: 'POST',
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				data: {flyer_tags: tags, removed_tags: removed_tags},
				beforeSend: function(res){
					// clear_tags();
					noti('default','Saving tags, please wait!');
				},
				success: function(res){
					if(res=='done')
						{noti('success','Tags saved!');}
					else noti('danger','Something went wrong: '+res);

					previous_tags = Array();

					added = []; removed = [];
					$('#status').hide();$('#status #removed, #status #added').text(0);

				},
				error: function(res){
					noti('danger','Something went wrong: '+res);
				}
			});

	}
});

// when flyer tags are clicked update the number in total tags:
$('.flyer_tags').on('click', function(event) {
		// event.preventDefault();
		$('#tags_number').text($('.box-checkbox :checked').length);

	});

// load flyers on tag's click
$(document).delegate('.load_flyers', 'click', function(event) {
	// $('.load_flyers').on('click', function(event) {
		event.preventDefault();
		clear_tags();
		text = $(this).text();
		// alert(text); return false;

		$.ajax({
			url: site_url+'admin/manageflyers/load_flyers_by_tags/',
			type: 'POST',
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				data: {tagId: $(this).prop('id')},
				beforeSend: function(res){

					//loading
					console.log('loading flyers');
					$('.choose-flyer-grid-wrap').html('');
					$('.choose-flyer-grid-wrap').html('<div class="col-md-12"><h3><i class="fa fa-loading">Loading...</h3></div>');


				},
				success: function(res){
					// alert(res);
					var jsn = $.parseJSON(res)
					$('.choose-flyer-grid-wrap').html('');
					if(jsn.length>0)
					{
						$.each(jsn, function() {

							$('.choose-flyer-grid-wrap').append(
								'<div id="flyer_small_'+this.flyer+'" class="col-md-4 mb-20">'
								+'<img src="'+base_url+'public/upload/flyer_images/thumb_'+this.flyer_image+'" size="'+this.flyer_size+'" id="'+this.flyer+'" class="img-responsive flyer_small">'
								+'</div>'
								);

						});
					}
					else {
						$('.choose-flyer-grid-wrap').html('<div class="col-md-12"><p class="text-warning">No Flyers tagged under "'+text+'"!</p></div>');

					}
				},
				error: function(res){
					noti('danger','Something went wrong: '+res);
				}
			});
});

// load new flyers on btn click
$(document).delegate('#new_flyers_btn', 'click', function(event) {
	// $('.load_flyers').on('click', function(event) {
		event.preventDefault();
		clear_tags();

		$.ajax({
			url: site_url+'admin/manageflyers/load_new_flyers/',
			type: 'GET',
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				beforeSend: function(res){

					//loading
					console.log('loading new flyers');
					$('.choose-flyer-grid-wrap').html('');
					$('.choose-flyer-grid-wrap').html('<div class="col-md-12"><h3><i class="fa fa-loading">Loading...</h3></div>');


				},
				success: function(res){
					// alert(res);
					var jsn = $.parseJSON(res)
					$('.choose-flyer-grid-wrap').html('');
					if(jsn.length>0)
					{
						$.each(jsn, function() {

							$('.choose-flyer-grid-wrap').append(
								'<div id="flyer_small_'+this.flyer+'" class="col-md-4 mb-20">'
								+'<img src="'+base_url+'public/upload/flyer_images/thumb_'+this.flyer_image+'" size="'+this.flyer_size+'" id="'+this.flyer+'" class="img-responsive flyer_small">'
								+'</div>'
								);

						});
					}
					else {
						$('.choose-flyer-grid-wrap').html('<div class="col-md-12"><p class="text-warning">No Flyers Found! Try Uploading flyers by going to step 1!</p></div>');

					}
				},
				error: function(res){
					noti('danger','Something went wrong: '+res);
				}
			});
});

//delete the selected flyer
$(document).delegate('.delete_this_flyer', 'click', function(event) {
	event.preventDefault();
	_id = $(this).prop('id');
	bootbox.confirm('Are you sure you want to delete this flyer?', function(choice){
		if(choice==true)
		{

			$.ajax({
				url: site_url+'admin/manageflyers/delete_this_flyer/',
				type: 'POST',
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				data: {flyerId: _id},
				beforeSend: function(res){
					noti('default', 'Deleting flyer, please wait');
				},
				success: function(res){
					// alert(res);
					// $('.choose-flyer-grid-wrap').html('');
					if(res=='done')
					{
						$('#flyer_small_'+_id).remove().fadeOut();
						noti('success', 'Flyer Deleted!');
						clear_tags();
						// $('#big_image').prop('src',base_url+'/public/upload/flyer_images/placeholder-image.jpg');

					}
					else {
						noti('danger', 'Error Occured! Flyer could not be deleted!');
						console.log(res);

					}
				},
				error: function(res){
					noti('danger','Something went wrong: '+res);
				}
			});

		}
	});


});

$(document).on('click', '#reset_flyer_tags', function(event) {
	event.preventDefault();
	// alert($('#big_image').attr('idd'));
	if($('#big_image').attr('idd'))
	{
	// alert($('#big_image').attr('idd'));

	//get the tags for this flyer and select them
	$.ajax({
		url: site_url+'/admin/manageflyers/ajax_get_flyer_tags/'+$('#big_image').attr('idd'),
		type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {param1: 'value1'},
			beforeSend: function(res){
					// noti('default','Saving tags, please wait!');
					console.log('getting tags:'+res);
					clear_tags();
				},
				success: function(res){
					// if(res=='done') noti('success','Tags saved!');
					if(res!='Nothing')
				{	// alert(res);

					$.each($.parseJSON(res), function() {
						$('#checkbox_'+this.fk_flyer_tag_id).addClass('checked');
						$('#tag_'+this.fk_flyer_tag_id).prop('checked',true);
									// alert(this.fk_flyer_tag_id);
									previous_tags.push(this.fk_flyer_tag_id);
								});

					$('#tags_number').text($.parseJSON(res).length);
				}else $('#tags_number').text(0);

				$('.list-inline.mb-0 .delete_this_flyer').remove();
				$('.list-inline.mb-0').prepend('<a id="'+id+'" class="btn btn-danger delete_this_flyer" href=""><i class="fa fa-trash"></i> Delete this Flyer</a>')

			},
			error: function(res){
				noti('danger','Something went wrong: '+res);
			}
		});

}else{noti('warning', 'Select a flyer to reset its tags');}

});

$('.box-checkbox input').click('click', function(event) {
	// event.preventDefault();
	/* Act on the event */

	if($('#big_image').attr('idd'))
	{
		_id = $(this).attr('id');

		if($(this).parent().hasClass('checked')){

			// removed_tags = $(previous_tags).not(tags).get();
			removed.push($(this).text());

		}
		else{
			added.push($(this).text());
		}
		// alert('removed:' +removed);
		// alert('added:' +added);

		// alert('removed:' +removed.length);
		// alert('added:' +added.length);

		console.log('removed:' +removed.length);
		console.log('added:' +added.length);
		$('#status').show();
		if(removed.length>0){$('#status #removed').text(removed.length);}
		if(added.length>0){$('#status #added').text(added.length);}

	}else{noti('warning', 'Select a flyer to reset its tags');}
	// return false;
});


</script>