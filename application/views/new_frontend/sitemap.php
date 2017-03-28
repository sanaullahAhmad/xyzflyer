<?php 
	$this->load->view('new_frontend/public/head');
	$this->load->view('new_frontend/public/header');
?>
<style>
ul  {
    list-style: square;
}
</style>
<div role="main" class="main">

				<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="#">Home</a></li>
									<li class="active">SiteMap</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1>Site Map</h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">

					<div class="row">
						<div class="col-md-6">
							<ul class="list-group">
								<li ><a href="<?php echo base_url();?>" class="list-group-item"><b>HOME</b></a></li>
								<li><a href="<?php echo base_url();?>how-it-works" class="list-group-item"><b>HOW IT WORKS</b></a></li>
								<li><a href="<?php echo base_url();?>about-us.aspx" class="list-group-item"><b>ABOUT US</b></a></li>
								<li><a href="<?php echo base_url();?>pricing.aspx" class="list-group-item"><b>PRICING</b></a></li>		
								<li><a href="<?php echo base_url();?>blog/" class="list-group-item"><b>BLOG</b></a></li>
								<li><a href="<?php echo base_url();?>contact-us.aspx" class="list-group-item"><b>CONTACT</b></a></li>
								
								<li><a href="<?php echo base_url();?>order.aspx" class="list-group-item"><b>ORDER</b></a></li>
								<li><a href="<?php echo base_url();?>register.aspx" class="list-group-item"><b>REGISTER</b></a></li>
								<li><a href="<?php echo base_url();?>login.aspx" class="list-group-item"><b>LOGIN</b></a></li>
								<li><a href="<?php echo base_url();?>subscribe.aspx" class="list-group-item"><b>SUBSCRIBE</b></a></li>
								<li><a href="<?php echo base_url();?>privace-policy.aspx" class="list-group-item"><b>PRIVACY POLICY</b></a></li>
								<li><a href="<?php echo base_url();?>cookie-policy.aspx" class="list-group-item"><b>COOKIE POLICY</b></a></li>
								<li><a href="<?php echo base_url();?>disclaimer.aspx" class="list-group-item"><b>DISCLAIMER</b></a></li>
								<li><a href="<?php echo base_url();?>terms.aspx" class="list-group-item"><b>TERMS AND CONDITIONS</b></a></li>
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
														
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							
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
								<span class="mr-md text-color-light hidden-xs"><span class="arrow arrow-light hlb" style="top: -88px; right: -47px;"></span></span>
							</div>
						</div>
					</div>
				</div>
			</section>

<?php 
	$this->load->view('new_frontend/public/footer');
?>