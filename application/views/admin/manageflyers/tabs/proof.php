
<div class="row">
	<div class="col-md-5">
		<!-- <div class="row">
			<div class="col-md-12 pt-20 text-center">
				<button class="btn btn-primary pull-left"><i class="fa fa-arrow-left"></i> Previous Image</button>
				<button class="btn btn-default" ><i class="fa fa-pencil"></i> Edit this Design</button>
				<button class="btn btn-primary pull-right">Next Image <i class="fa fa-arrow-right"></i></button>
			</div>
		</div> -->

		<div class="row">
			<div class="col-md-12">
				<div class="pt-20">
					<img src="" id="export-image-proof" style="border:1px solid #999; width: 100%">
				</div>
			</div>
			<div class="col-md-12">
				<div id="flyer_json" style="display:none"></div>
			</div>
		</div>

		
	</div>
	<div class="col-md-7">
		<h3>If the flyer seems okay, publish it or save it for later.</h3>
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-default btn-large" id="edit_design" style="font-size: ">Edit this Design</button>
				&nbsp; 
				<button class="btn btn-primary btn-large" id="flyer_save_for_later" style="font-size: ">Save for Later</button>
				&nbsp; 
				<button class="btn btn-success btn-large" id="flyer_publish" style="font-size: ">Publish</button>
				&nbsp; 
				<button class="btn btn-danger btn-large" id="addRemove_BG"><i class="fa fa-ban"></i> Remove Background</button>
				<div id="flyer_properties" style="display:none"></div>
			</div>

		</div>
		<br>

		<div class="row bgOpacityContainer_proof">
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-3" style="margin-top:-17px">
						<p>Background Opacity:</p>
					</div>
					<div class="col-md-6" style="margin-top:7px">
						<input id="opacity_range_proof" type="range" min="0" max="100" step="5" value="100"/>
					</div>    
					<div class="col-md-3">
						<form class="form-inline">
							<div class="form-group">
								<div class="input-group">
									<input type="number" class="form-control" id="opacityByNumber_proof" min="0" max="100" step="5" value="100" />
									<div class="input-group-addon">%</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			
		</div>
		<br>				

		<div class="row">
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12">
						<a id="view_html" class="btn btn-primary btn-large" target="_blank">View HTML</a>
						&nbsp; 
						<div class="dropdown" style="display:inline-block">
							<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Email Flyer
								<span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a tabindex="-1"  id="test_email">To Me</a></li>
									<li><a tabindex="-1"  id="test_email_to_anyone">To Anyone</a></li>
								</ul>
							</div>
							<!-- <a id="test_email" class="btn btn-primary btn-large">Send Test Email</a> -->
							&nbsp; 
							<a  id="flyer_pdf" class="btn btn-primary btn-large" target="_blank">PDF Flyer</a>
							&nbsp; 
						</div>
					</div>
				</div>

			</div>
			<br>				

			<div class="row " style="display: none" id="flyer_success">
				<div class="col-sm-12 ">
					<div class="text-center alert alert-warning" style="padding:  50px;  margin:  50px;">
						<div>
							<i style="font-size: 64px;" class="fa fa-check"></i>
						</div>
						<div>
							<h1>Flyer has been saved!</h1>
						</div>
					</div>	
				</div>
			</div>

			<div class="row" id="flyer_loading" style="display: none" >
				<div class="col-sm-12 ">
					<div class="text-center alert alert-default" style="padding:  50px;  margin:  50px;">
						<div>
							<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						</div>
						<div>
							<h1>Please Wait...</h1>
						</div>
					</div>	
				</div>
			</div>

			<div class="row" id="flyer_error" style="display: none" >
				<div class="col-sm-12 ">
					<div class="text-center alert alert-danger" style="padding:  50px;  margin:  50px;">
						<div>
							<i class="fa fa-frown-o" style="font-size: 64px;"></i>
						</div>
						<div>
							<h1>An Error Occurred!</h1>
						</div>
					</div>	
				</div>
			</div>

		</div>
	</div>




	<script type="text/javascript">


		$('#test_email').on('click', function(event) {
			event.preventDefault();
			flyer_id=$('.flyer_small_selected').attr('id');

			$.ajax({
				url: site_url+'admin/manageflyers/email_flyer',
				type: 'POST',
				data: {flyer_id: flyer_id},
				success: function(res){
					// alert(res);
					if(res == "sent")
					{
						noti('success','Email has been sent!');
					}
					else{
						
						noti('danger','Please save flyer before sending test email! ');
					}
					
				},
			});

		});

		$('#test_email_to_anyone').on('click', function(event) {
			event.preventDefault();
			flyer_id=$('.flyer_small_selected').attr('id');

			bootbox.prompt({
				title: "This is a prompt with an email input!",
				inputType: 'email',
				callback: function (result) {
					console.log(result);
					if(result!='')
					{
						$.ajax({
							url: site_url+'admin/manageflyers/email_flyer_to_anyone',
							type: 'POST',
							data: {flyer_id: flyer_id, email: result},
							success: function(res){
								if(res == "sent")
								{
									noti('success','Email has been sent');
								}
								else{

									noti('danger','Email Not sent Try again latter! ');
								}

							},
						});
					}
				}
			});

		});

		$('#edit_design').on('click', function(event) {
			event.preventDefault();
			$('.nav-tabs a[href="#tab-id-1-3"]').tab('show');

		// when you click edit design and go back to designer tab you want to add background again
		// addBackgroundImage();
  //   	$('#opacity_range').val(0.5);
});

		$(document).delegate('#flyer_save_for_later', 'click', function(event) {
			_id = $('.flyer_small_selected').attr('id');
			if(_id) 
				{ flyer_id = $('.flyer_small_selected').attr('id');}
			else {
            // flyer_id = null;
            console.log(_id);
            bootbox.alert('No Flyer Selected!');
            return false;
        }
        
        json = $('#flyer_properties').text();
        $.ajax({
        	url: site_url+'admin/manageflyers/flyer_save_for_later',
        	type: 'POST',
			// async: false,
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {flyer_id: flyer_id, properties: json, image_b64: $('#export-image-proof').prop('src'), flyer_json: $('#flyer_json').html()},
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				beforeSend: function(res){
					
					//loading
					// console.log('loading new flyers');
					noti('default','Please wait while the flyer is being saved!');
					$('#flyer_success').hide();
					$('#flyer_loading').show();

				},
				success: function(res){
					// alert(res);
					if(res=='done')
					{
						noti('success','Flyer has been saved successfully!');
						$('#flyer_loading').hide();
						$('#flyer_success').fadeIn();
						stop_user = false;
					}
					else{
						noti('danger','Failed to save flyer! '+res);
					}
					
				},
				error: function(res){
					noti('danger','Something went wrong: '+res);
					$('#flyer_loading, #flyer_success').hide();
					$('#flyer_error').fadeIn();
					
				}
			});
console.log('finalColorSets => '+ finalColorSets);
$.ajax({
	url: site_url+'admin/manageflyers/save_colorsets/'+flyer_id,
	type: 'POST',
			// async: false,
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {json: finalColorSets},
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				beforeSend: function(res){
					console.log('Saving Color Sets into Database')

				},
				success: function(res){
					// alert(res);
					if(res=='true')
					{
						console.log('Color Sets saved into Database')
					}
					else{
						noti('danger','Failed to save the color set! '+res);
					}
					
				},
				error: function(res){
					noti('danger','Something went wrong: '+res);
				}
			});

});

$(document).delegate('#flyer_publish', 'click', function(event) {
	// json = $('#flyer_publish_json').text();
	_id = $('.flyer_small_selected').attr('id');
	if(_id) 
		{ flyer_id = $('.flyer_small_selected').attr('id');}
	else {
            // flyer_id = null;
            console.log(_id);
            bootbox.alert('No Flyer Selected!');
            return false;
        }
        
        json = $('#flyer_properties').text();
        $.ajax({
        	url: site_url+'admin/manageflyers/flyer_publish',
        	type: 'POST',
			// async: false,
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {flyer_id: flyer_id, properties: json, image_b64: $('#export-image-proof').prop('src'), flyer_json: $('#flyer_json').html()},
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				beforeSend: function(res){
					
					//loading
					// console.log('loading new flyers');
					noti('default','Please wait while the flyer is being saved!');
					$('#flyer_success').hide();
					$('#flyer_loading').show();

				},
				success: function(res){
					// alert(res);
					if(res=='done')
					{
						noti('success','Flyer has been saved successfully!');
						$('#flyer_loading').hide();
						$('#flyer_success').fadeIn();
						stop_user = false;
					}
					else{
						noti('danger','Failed to save flyer! '+res);
					}
					
				},
				error: function(res){
					noti('danger','Something went wrong: '+res);
					$('#flyer_loading, #flyer_success').hide();
					$('#flyer_error').fadeIn();
					
				}
			});

$.ajax({
	url: site_url+'admin/manageflyers/save_colorsets/'+flyer_id,
	type: 'POST',
			// async: false,
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {json: finalColorSets},
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				beforeSend: function(res){
					console.log('Saving Color Sets into Database')

				},
				success: function(res){
					// alert(res);
					if(res=='true')
					{
						console.log('Color Sets saved into Database')
					}
					else{
						noti('danger','Failed to save the color set! '+res);
					}
					
				},
				error: function(res){
					noti('danger','Something went wrong: '+res);
				}
			});
});
</script>