<?php 
	$this->load->view('new_frontend/public/head');
	$this->load->view('new_frontend/public/header');
?>
<style>
input[type=text]{
    -webkit-appearance: none;
    -webkit-border-radius: 4px !important;
}
</style>
<!-- body content goes here! -->
<div role="main" class="main">

				<section class="page-header" style="margin-bottom: 0px">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="#">Home</a></li>
									<li class="active">Contact Us</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1>Contact Us</h1>
							</div>
						</div>
					</div>
				</section>

				<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3177.0654997984307!2d-121.98429699999998!3d37.22242!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x20bb1ad09c0e5f65!2s9533+Designs+Inc.!5e0!3m2!1sen!2sus!4v1479819599976" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>

				<div class="container">

					<div class="row">
						<div class="col-md-6">

							<div class="alert alert-success hidden mt-lg" id="contactSuccess">
								<strong>Success!</strong> Your message has been sent to us.
							</div>

							<div class="alert alert-danger hidden mt-lg" id="contactError">
								<strong>Error!</strong> There was an error sending your message.
								<span class="font-size-xs mt-sm display-block" id="mailErrorMessage"></span>
							</div>

							<h2 class="mb-sm mt-sm"><strong>Contact</strong> Us</h2>
							<?php 
							if(is_array(validation_errors_array()) && !empty(validation_errors_array())){
								echo "<div class='alert alert-danger'>".current(validation_errors_array())."</div>";
							}
							echo $this->session->flashdata('message');
							?>
							<form id="contactForm" action="<?php echo base_url(); ?>contactus_action" method="POST">
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>Your Name *</label>
											<input type="text" value="<?php echo set_value('name'); ?>" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required>
										</div>
										<div class="col-md-6">
											<label>Your Email Address *</label>
											<input type="email" value="<?php echo set_value('email'); ?>" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<label>Subject</label>
											<input type="text" value="<?php echo set_value('subject'); ?>" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="subject" id="subject" required >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<label>Message *</label>
											<textarea maxlength="5000" data-msg-required="Please enter your message." rows="10" class="form-control" name="message" id="message" required><?php echo set_value('message'); ?></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<input type="submit" value="Send Message" class="btn btn-primary btn-lg mb-xlg" data-loading-text="Loading...">
									</div>
								</div>
							</form>
						</div>
						<div class="col-md-6">
							<hr>
							<h4 class="heading-primary">The <strong>Office</strong></h4>
							<ul class="list list-icons list-icons-style-3 mt-xlg">
								<li><i class="fa fa-map-marker"></i> <strong>Address:</strong> 20 S Santa Cruz Avenue, Suite 300, Los Gatos, CA 95030</li>
								<li><i class="fa fa-phone"></i> <strong>Phone:</strong> 408-335-6169</li>
								<li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:sales@xyzflyers.com">sales@xyzflyers.com</a></li>
							</ul>

							<hr>

							<h4 class="heading-primary">Business <strong>Hours</strong></h4>
							<ul class="list list-icons list-dark mt-xlg">
								<li><i class="fa fa-clock-o"></i> Monday - Friday - 8am to 5pm</li>
								<li><i class="fa fa-clock-o"></i> Saturday - Closed</li>
								<li><i class="fa fa-clock-o"></i> Sunday - Closed</li>
							</ul>

						</div>

					</div>

				</div>

			</div>

		<section class="call-to-action call-to-action-primary mb-xl">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="call-to-action-content align-left pb-md mb-xl ml-none">
								<h3>XYZ Flyers is <strong>everything</strong> you need to create an <strong>effective</strong> sales stream!</h3>
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