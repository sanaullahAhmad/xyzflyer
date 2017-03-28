<?php
$this->load->view('new_frontend/public/head');
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
				<h1>Profile Settings</h1>
				</div>
			</div>
		</div>
	</section>

	<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->


	<div class="container">
		<? $this->load->view('new_frontend/incs/settings_menu'); ?>

		<!-- Registor -->
			<div class="col-md-9">

				<div class="alert alert-success hidden mt-lg" id="contactSuccess">
					<strong>Success!</strong> Your message has been sent to us.
				</div>

				<div class="alert alert-danger hidden mt-lg" id="contactError">
					<strong>Error!</strong> There was an error sending your message.
					<span class="font-size-xs mt-sm display-block" id="mailErrorMessage"></span>
				</div>

				<?php
				if(isset($formerror1) && !empty($formerror1) ){
					echo "<div class='alert alert-danger'>".current($formerror1)."</div>";
				}
				echo $this->session->flashdata('message');
				?>
				<form id="contactForm" action="<?php echo base_url('updateaccount'); ?>" method="POST">
					<div class="row">
						<div class="form-group">
							<div class="col-md-6">
								<label>First Name *</label>
								<input type="text" value="<?php echo $userFirstName; ?>" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="userFirstName" id="userFirstName" required>
							</div>
							<div class="col-md-6">
								<label>Last Name *</label>
								<input type="text" value="<?php echo $userLastName; ?>" data-msg-required="Please enter your last name." maxlength="100" class="form-control" name="userLastName" id="userLastName" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6">
								<label>Email Address *</label>
								<input type="email" value="<?php echo $userEmail; ?>" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="userEmail" id="userEmail" required>
							</div>
							<div class="col-md-6">
								<label>Phone Number</label>
								<input type="text" value="<?php echo $userPhone; ?>" data-msg-required="Phone Number" min='0' maxLength="12" placeholder="212-555-1234" class="form-control" name="phone" id="phone" onkeypress="return isNumberKeyCnic(event);">
							</div>
						</div>
						<div class="form-group">

							<div class="col-md-6">
								<label>State</label>
								<select class="form-control" name="state">
									<option value="">Select a State</option>
									<?php  if(isset($us_state) && is_array($us_state)){
										foreach($us_state as $key => $value){
											echo "<option ".($state==$key?"selected='selected'":"")." value='".$key."'>".$value."</option>";
										}}?>
									</select>
								</div>
								<div class="col-md-6">
									<label>City</label>
									<input type="text"  name="city" value="<?php echo $userCity; ?>"  class="form-control"  autocomplete="off">
								</div>
							</div>

							<input type="hidden"  value="<?php echo $userId; ?>"  name="userId" class="form-control" autocomplete="off">

						</div>

						<div class="row">
							<div style="position:relative;left:15px;" class="g-recaptcha" data-sitekey="6LeiygkUAAAAAMAhHKCpIOHXtvGLlYtfBQ5wMhh7"></div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<input type="submit" value="Update" class="btn btn-primary btn-lg mb-xlg" data-loading-text="Loading...">
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