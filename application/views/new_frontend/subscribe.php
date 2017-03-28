<?php
	$this->load->view('new_frontend/public/head');
	$this->load->view('new_frontend/public/header');

?>
<!-- body content's goes here  -->
<style>
.form-control{
  -webkit-border-radius: 4px!important;
}
</style>
			<div role="main" class="main">

				<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="<?= site_url('newdesign');?>">Home</a></li>
									<li class="active">Subscribe</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1>Subscribe</h1>
							</div>
						</div>
					</div>
				</section>

				<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->


				<div class="container">

					<div class="row">
						<div class="col-md-8">

							<div class="alert alert-success hidden mt-lg" id="contactSuccess">
								<strong>Success!</strong> Your message has been sent to us.
							</div>

							<div class="alert alert-danger hidden mt-lg" id="contactError">
								<strong>Error!</strong> There was an error sending your message.
								<span class="font-size-xs mt-sm display-block" id="mailErrorMessage"></span>
							</div>

							<h2 class="mb-sm mt-sm"><strong>Subscribe</strong></h2>
							<?php
							if(is_array(validation_errors_array()) && !empty(validation_errors_array())){
								echo "<div class='alert alert-danger'>".current(validation_errors_array())."</div>";
							}
							echo $this->session->flashdata('message');
							?>
							<form id="contactForm" action="<?php echo base_url('subscribe_action'); ?>" method="POST">
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>First Name *</label>
											<input type="text" value="<?php echo set_value('subFirstName'); ?>" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="subFirstName" id="subFirstName" required>
										</div>
										<div class="col-md-6">
											<label>Last Name *</label>
											<input type="text" value="<?php echo set_value('subLastName'); ?>" data-msg-required="Please enter your last name." maxlength="100" class="form-control" name="subLastName" id="subLastName" required >
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6">
											<label>Email Address *</label>
											<input type="email" value="<?php echo set_value('subEmail'); ?>" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="subEmail" id="subEmail" required>
										</div>
										<div class="col-md-6">
											<label>Confirm Email Address *</label>
											<input type="email" value="<?php echo set_value('resubEmail'); ?>" data-msg-required="Please enter Confirm email address." data-msg-email="Confirm email address." class="form-control" name="resubEmail" id="resubEmail" required >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>State</label>
											<select class="form-control" name="subCountry" id="subCountry" onChange="getState(this.value);" >
												<option value="">Select a State</option>
												<?php  if(isset($us_state) && is_array($us_state)){
													foreach($us_state as $key => $value){
													echo "<option ".($state==$key?"selected='selected'":"")." value='".$key."'>".$value."</option>";
													}}?>
											</select>
											<!-- <input type="dropdown" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="subject" id="subject" required> -->
										</div>
										<script>
										 function getState(val) { 
																$.ajax({
																	 type: "POST",
																   url: '<?php echo base_url(); ?>newdesign/counties',
																   dataType: 'html',
																   data: { state : val },
																   success: function(data) {
																	  $('#county').html( data );
																   }
																});
													}
									    </script>
										
										<div class="col-md-6">
											<label>County</label>
											<select name="county" id="county" class="form-control">
											<option value="">Select County</option>
											 <?php if(isset($county)){ 
												foreach ($counties as $count){
													
													echo "<option ".($county==$count['county']?"selected='selected'":"")." value='".$count['county']."'>".$count['county']."</option> " ;
												}
											 }
											 ?>
												
											</select>
											<!-- <input type="dropdown" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="subject" id="subject" required> -->
										</div>
										
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<span class="remember-box checkbox">
												<label>
													<input type="checkbox" name="subStatus" value="0">I want to receive emails flyers in my county
												</label>
											</span>

											<p>
												By clicking Subscribe, you agree to our <a href="<?=site_url('terms')?>" target="_blank">Terms and Conditions</a> and have read our 
												<a href="<?=site_url('privacy-policy')?>" target="_blank">Privacy Policy</a>, including our <a href="<?=site_url('cookie-policy')?>" target="_blank">Cookie Use Policy</a>
											</p>
										</div>
									</div>
								</div>
								<div class="row">
									<div style="position:relative;left:15px;" class="g-recaptcha" data-sitekey="6LeiygkUAAAAAMAhHKCpIOHXtvGLlYtfBQ5wMhh7"></div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<input type="submit" value="SUBSCRIBE" name="subscribe" class="btn btn-primary btn-lg mb-xlg" data-loading-text="Loading...">
									</div>
								</div>
							</form>
							<hr>
							<?php 
								echo $this->session->flashdata('message1');
							?>
							<form action="<?php echo base_url();?>newdesign/unsub" method="GET">
							<h1  style="text-align:center;">Unsubscribe to Emails</h1>
							<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>Email Address *</label>
											<input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
										</div>
									</div>
								</div>
							<div class="row">
								<div class="from-group">
									<div class="col-md-12" >
										<input type="submit" value="UNSUBSCRIBE" placeholder="Email Address!" class="btn btn-primary btn-lg mb-xlg " data-loading-text="Loading...">
									</div>
								</div>
							</div>
							</form>
						</div>
					</div>

				</div>

			</div>

			<section class="call-to-action call-to-action-primary mb-xl">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="call-to-action-content align-left pb-md mb-xl ml-none">
								<h3>XYZFlyers is <strong>everything</strong> you need to create an <strong>effective</strong> sales stream!</h3>
								<p>XYZ Flyers is a fast, effective marketing tool that connects your property with thousands of agents.</p>
							</div>
							<div class="call-to-action-btn">
								<a href="<?=($this->session->user_data)?site_url('editor'):site_url('register')?>" target="_blank" class="btn btn-lg btn-primary btn-primary-scale-2 mr-md">Get Started Today</a>
								<span class="mr-md text-color-light hidden-xs"><span class="arrow arrow-light hlb"  style="top: -95px; right: -26px;"></span></span>
							</div>
						</div>
					</div>
				</div>
			</section>

<?php
	$this->load->view('new_frontend/public/footer');
?>