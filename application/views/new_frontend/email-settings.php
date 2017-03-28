<?php
$this->load->view('new_frontend/public/head');
?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<style>
	.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; margin: 0;}
	.toggle.ios .toggle-handle { border-radius: 20px; }
</style>
<?
$this->load->view('new_frontend/public/header');
?>
<style>
	input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
</style>


<!-- Body content goes here -->
<div role="main" class="main">

	<section class="page-header">
		<div class="container">
			<!-- <div class="row">
				<div class="col-md-12">
					
				</div>
			</div> -->
			<div class="row">
				<div class="col-md-12">
					<h1>Email Settings</h1>
				</div>
			</div>
		</div>
	</section>

	<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->


	<div class="container">
		<? $this->load->view('new_frontend/incs/settings_menu'); ?>
		<!-- Registor -->

		<div class="col-md-9">
			<div class="row" >
				<div class="col-md-12">

					<div class="alert alert-success hidden mt-lg" id="contactSuccess">
						<strong>Success!</strong> Your message has been sent to us.
					</div>

					<div class="alert alert-danger hidden mt-lg" id="contactError">
						<strong>Error!</strong> There was an error sending your message.
						<span class="font-size-xs mt-sm display-block" id="mailErrorMessage"></span>
					</div>

					<?php
					if(isset($formerror2) && !empty($formerror2)){
						echo "<div class='alert alert-danger'>".current($formerror2)."</div>"; ?>

						<?php	}
						echo $this->session->flashdata('message2');
						/*echo "<pre>";
						print_r($settings);
						echo "</pre>";*/
						?>

						<!-- <form> -->
						<? foreach ($settings as $setting) {
							?>
							<div class="row">
								<div class="col-md-8">
									<label>
										<input type="checkbox" data-toggle="toggle" data-style="ios" <?=($setting->status==='false')?'':'checked'?>  name="<?=$setting->name?>"> 
										<?=$setting->title?>
										<?=($setting->note)?'<br><small>'.$setting->note.'</small>':''?>
										</label>
									</div>
								</div>
						<? }?>
					
								<div class="row">
									<div class="col-md-8">
										<p>*Note: Each of these settings will require confirmation through email. Changes appearing on this page might be temperory until you confirm by clicking the link sent in email.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<?php $this->load->view('new_frontend/public/footer'); ?>
			<script type="text/javascript">
				$('input[type=checkbox]').on('change', function(event) {
					event.preventDefault();
					var cbox = $(this);
					var cvalue = cbox.prop('checked');

					var change = 1;
					if(cvalue==1) change = 0;
					
					swal({
						title: "Changing Email Settings",
						text: "Please confirm your password to continue",
						type: "input",
						inputType: "password",
						html: true,
						showCancelButton: true,
						closeOnConfirm: false,
						showLoaderOnConfirm: true,
					},
					function(inputvalue){
						if(inputvalue!=false)
						{
							if(inputvalue.length!=0){
								$.ajax({
									url: './email-settings/confirm-password',
									type: 'post',
									data: {pass: inputvalue, setting_name: cbox.attr('name'), change: cvalue},
									beforeSend: function(){},
									error: function(){
										swal('Oops', 'Something went wrong. We could not update your email settings, please contact site administrator.', 'error');
										if(cvalue)cbox.bootstrapToggle('off');
											else cbox.bootstrapToggle('on');
									},
									success: function(res){
										if(res=='true') {
											// IF PASSWORD IS CORRECT //CONTINUE
											swal('1 more step to go', 'We have sent you a confirmation email. Please check your inbox','success');
										}
										else {
											swal.showInputError('Your password is incorrect');
											return false;
										}
									}
								});
							}else{
								swal.showInputError('Please enter your password to continue');
								return false;
							}
						}else {
							/*if(cvalue) cbox.bootstrapToggle('off');
								else cbox.bootstrapToggle('on'); */
								swal.showInputError('Please Enter Your Password');
								return false;
						}
					});
				});
</script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
