<?php
	$this->load->view('new_frontend/public/head');
	$this->load->view('new_frontend/public/header');
?>
<style>
input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
input[type=text],input[type=password].form-control{
	-webkit-border-radius: 4px !important;
}
</style>
<!-- Body content goes here -->
<div role="main" class="main">

				<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="<?php echo site_url('newdesign'); ?>">Home</a></li>
									<li class="active">Register</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1>Register</h1>
							</div>
						</div>
					</div>
				</section>

				<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->


				<div class="container">
				<!-- Registor -->
					<div class="row">
						<div class="col-md-8">

							<div class="alert alert-success hidden mt-lg" id="contactSuccess">
								<strong>Success!</strong> Your message has been sent to us.
							</div>

							<div class="alert alert-danger hidden mt-lg" id="contactError">
								<strong>Error!</strong> There was an error sending your message.
								<span class="font-size-xs mt-sm display-block" id="mailErrorMessage"></span>
							</div>

							<h2 class="mb-sm mt-sm"><strong>Register</strong></h2>
							<?php
							if(is_array(validation_errors_array()) && !empty(validation_errors_array())){
								echo "<div class='alert alert-danger'>".current(validation_errors_array())."</div>";
							}
							echo $this->session->flashdata('message');
							?>
							<form id="contactForm" action="<?php echo base_url('register_action'); ?>" method="POST">
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>First Name *</label>
											<input type="text" value="<?php echo set_value('userFirstName'); ?>" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="userFirstName" id="userFirstName" required>
										</div>
										<div class="col-md-6">
											<label>Last Name *</label>
											<input type="text" value="<?php echo set_value('userLastName'); ?>" data-msg-required="Please enter your last name." maxlength="100" class="form-control" name="userLastName" id="userLastName" required>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6">
										  <label>State</label>
											<select class="form-control" name="state" id="state_code">
												<option value="">Select a State</option>
												<?php  if(isset($us_state) && is_array($us_state)){
													foreach($us_state as $key => $value){
														echo "<option ".(set_value('state')==$key?"selected='selected'":"")." value='".$key."'>".$value."</option>";
													}}?>
												</select>
										</div>
										<div class="col-md-6">
												<label for="city">City <span class="autocomplete-animation" style="display: none;"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></span></label>
												<input type="text"  name="city" id="city" class="form-control" autocomplete="off" >
												
											</div>
									</div>
									<div class="form-group">
										<div class="col-md-6">
											<label>Email Address *</label>
											<input type="email" value="<?php echo set_value('userEmail'); ?>" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="userEmail" id="userEmail" required>
										</div>
										<div class="col-md-6">
											<label>Confirm Email Address *</label>
											<input type="email" value="<?php echo set_value('reUserEmail'); ?>" data-msg-required="Please enter Confirm email address." data-msg-email="Confirm email address." class="form-control" name="reUserEmail" id="reUserEmail" required>
										</div>
									</div>
									<div class="form-group">
											<div class="col-md-6">
												<label>Password</label>
												<input type="password"  name="userPassword" id="userPassword" class="form-control" autocomplete="off">
											</div>
											<div class="col-md-6">
												<label>Confirm Password</label>
												<input type="password"  name="reUserPassword" id="reUserPassword" class="form-control" autocomplete="off">
											</div>
									</div>
									<div class="form-group">
										<div class="col-md-6">
											<label>Phone Number</label>
											<input type="text" value="<?php echo set_value('phone'); ?>" data-msg-required="Phone Number" min='0' maxLength="12" placeholder="212-555-1234" class="form-control" name="phone" id="phone" onkeypress="return isNumberKeyCnic(event);">
										</div>	
									</div>
									<div class="form-group">
									<div class="col-md-12">
											<label>How did you hear about us? </label>
											<div class="form-check">
												<label class="form-check-label">
												  <input type="checkbox" name="hereabout[]" value="Google" class="form-check-input">
												  Google
												</label>
											</div>
										  <div class="form-check">
											<label class="form-check-label">
											  <input type="checkbox" name="hereabout[]" value="Yahoo" class="form-check-input">
											  Yahoo
											</label>
										  </div>
										  <div class="form-check">
											<label class="form-check-label">
											  <input type="checkbox" name="hereabout[]" value="Facebook" class="form-check-input">
											  Facebook
											</label>
										  </div>
										   <div class="form-check">
											<label class="form-check-label">
											  <input type="checkbox" name="hereabout[]" value="Twitter" class="form-check-input">
											  Twitter
											</label>
										  </div>
										   <div class="form-check">
											<label class="form-check-label">
											  <input type="checkbox" class="form-check-input maxtickets_enable_cb">
											  Other
											</label>
											<div class="max_tickets">
											<textarea class="form-control"  name="hereabout[]" id="hereabout"></textarea>
											</div>
										  </div>
										  
										</div>
										</div>
								</div>

								<div class="row">
									<div style="position:relative;left:15px;" class="g-recaptcha" data-sitekey="6LeiygkUAAAAAMAhHKCpIOHXtvGLlYtfBQ5wMhh7"></div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<p>By clicking Register, you agree to our <a href="<?=site_url('terms')?>" target="_blank">Terms and Conditions</a> and have read our 
												<a href="<?=site_url('privacy-policy')?>" target="_blank">Privacy Policy</a>, including our <a href="<?=site_url('cookie-policy')?>" target="_blank">Cookie Use Policy</a></p>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<input type="submit" value="Register" class="btn btn-primary btn-lg mb-xlg" data-loading-text="Loading...">
									</div>
								</div>
							</form>
						</div>
					</div>
						</div>
					</div>
<?php

	$this->load->view('new_frontend/public/footer');
?>
<script>
$(document).ready(function () {
     $('.maxtickets_enable_cb').change(function () {
         var $this = $(this);
         if ($this.is(':checked')) {
             $('.max_tickets').show();
         } else {
             $('.max_tickets').hide();
         }
     }).change();
 });

</script>
<script>
function isNumberKeyCnic(evt)  {   
var charCode = (evt.which) ? evt.which : event.keyCode;   
console.log(charCode);   
if (charCode != 46 && charCode != 45 && charCode > 31     && (charCode < 48 || charCode > 57))    
	return false;   return true;  
}

//Put our input DOM element into a jQuery Object
var $jqDate = jQuery('input[name="phone"]');

//Bind keyup/keydown to the input
$jqDate.bind('keyup','keydown', function(e){
	
  //To accomdate for backspacing, we detect which key was pressed - if backspace, do nothing:
	if(e.which !== 4) {	
		var numChars = $jqDate.val().length;
		if(numChars === 3 || numChars === 7){
			var thisVal = $jqDate.val();
			thisVal += '-';
			$jqDate.val(thisVal);
		}
  }
});
</script>