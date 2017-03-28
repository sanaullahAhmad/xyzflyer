<?php
	$this->load->view('new_frontend/public/head');
	$this->load->view('new_frontend/public/header');

?>
<!-- body content's goes here  -->

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
						
					<form id="contactForm" action="<?php echo base_url('subscribe'); ?>" method="POST">
								<div class="row">
									<div class="form-group">
										<div class="alert alert-danger">
											<strong>You have been unsubscribed. <?php echo $email; ?></strong>
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="width:10px;margin-top:11px;">&times;</button>
											<p>
												if you have Unsubcribed accidently subscribe again.
											</p>
										</div>
									</div>
								<div class="row">
									<div class="col-md-12">
										<input type="submit" value="SUBSCRIBE" name="subscribe" class="btn btn-primary btn-lg mb-xlg" data-loading-text="Loading...">
									</div>
								</div>
				    </form>
							<hr>
							
						</div>
					</div>

				</div>

			</div>

			<section class="call-to-action call-to-action-default with-button-arrow call-to-action-in-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="call-to-action-content">
								<h3>Flyer is <strong>everything</strong> you need to create an <strong>awesome</strong> website!</h3>
								<p>The <strong>#1 Selling</strong> HTML Site Template on ThemeForest</p>
							</div>
							<div class="call-to-action-btn">
								<a href="http://themeforest.net/item/Flyer-responsive-html5-template/4106987" target="_blank" class="btn btn-lg btn-primary">Buy Now!</a><span class="arrow hlb hidden-xs hidden-sm hidden-md" data-appear-animation="rotateInUpLeft" style="top: -12px;"></span>
							</div>
						</div>
					</div>
				</div>
			</section>

<?php
	$this->load->view('new_frontend/public/footer');
?>