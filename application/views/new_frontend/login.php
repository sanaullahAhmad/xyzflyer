<?php 
	$this->load->view('new_frontend/public/head');
	$this->load->view('new_frontend/public/header');
?>
<!-- body content goes's here -->
<script>
function recaptchaCallback() {
    $('#submitBtn').removeAttr('disabled');
}; 
</script>
	<div role="main" class="main">

				<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="<?= site_url();?>">Home</a></li>
									<li class="active">Login</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1>Login</h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">

					<div class="row">
						<div class="col-md-12">
							<div class="featured-boxes">
								<div class="row">
								
								<?if($this->session->user_order)
								{?>
								<div class="col-md-offset-1 col-md-4">
							<div class="featured-box featured-box-primary align-left mt-xlg">
							<div class="box-content"  style="padding: 20px;">
									<h3 class="heading title">Your Order</h3>
									<!-- <hr style="padding: 0px; margin: 5px 0;"> -->
									<!-- <p><pre><?=print_r($this->session->userdata('user_order'))?></pre></p> -->
									<?php $order = $this->session->user_order; $sum = 0;
										foreach ($order['details'] as $county) { $sum = $sum + $county['quantity'];
											echo "<div class='well' style='padding: 6px; margin: 4px 0px;'>". $county['county'].", ".$county['state'].
											" having <strong>".$county['quantity']."</strong> agents".
											"</div>";
										// $county['special'];
										}?>
									<hr style="padding: 0px; margin: 5px 0;">
									<h4 class="heading title">Reaching <?=$sum?> agents in <strong>$<?=$order['price']?></strong></h4>
									</div>
									</div>
								</div>
						
							<div class="col-sm-6">
								<?php }else{?>
									<div class="col-sm-6 col-sm-offset-3">
								<?php } ?>
									<?php 
							           echo $this->session->flashdata('message');
							           ?>
										<div class="featured-box featured-box-primary align-left mt-xlg">
											<div class="box-content">
												<form action="<?php echo site_url('login_action'); ?>" id="frmSignIn" method="post">
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>Email Address</label>
																<input type="text" value="" name="email" class="form-control input-lg">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<a class="pull-right" href="<?php echo site_url('lostpass');?>">(Forgot Password?)</a>
																<label>Password</label>
																<input type="password" value="" name="password" class="form-control input-lg">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<span class="remember-box checkbox">
																<label for="rememberme">
																	<input type="checkbox" id="rememberme" name="rememberme">Remember Me
																</label>
															</span>
														</div>
													</div>
													<div class="row">	
														<div class="col-md-6">
																<span>
																	<div  class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LeiygkUAAAAAMAhHKCpIOHXtvGLlYtfBQ5wMhh7"></div>
																</span>
														</div>
														
														<div class="col-md-6">
															<input type="submit" id="submitBtn" value="Login" style="position:relative;top:41px;" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading..." disabled>
														</div>														
														
													</div>
													
												</form>
												
											</div>
										</div>
									</div>

								</div>

								<div class="row">
									<div class="col-md-12 text-center">
										<h4>Don't have an account? <a href="<?=site_url('register')?>">Register Here</a></h4>
									</div>

								</div>

							</div>
						</div>
					</div>

				</div>

			</div>

<?php 

	$this->load->view('new_frontend/public/footer');
?>