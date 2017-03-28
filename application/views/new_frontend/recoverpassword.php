<?php 
	$this->load->view('new_frontend/public/head');
	$this->load->view('new_frontend/public/header');
?>
<!-- body content goes's here -->

	<div role="main" class="main">

				<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="<?= site_url('newdesign');?>">Home</a></li>
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
								
									<div class="col-sm-6 col-sm-offset-3">
									<?php 
							           echo $this->session->flashdata('message');
							           ?>
										<div class="featured-box featured-box-primary align-left mt-xlg">
											<div class="box-content">
												<form action="<?php echo site_url('repass_action'); ?>" id="frmSignIn" method="post">
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>New Password</label>
																<input type="password" value="" name="password" class="form-control input-lg">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>Confirm Password</label>
																<input type="password" value="" name="repassword" class="form-control input-lg">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
														&nbsp;
														</div>
														<div class="col-md-6">
														   <input type="hidden" value="<?php  if(isset($id)){echo $id;} ?>" name="useridentity">
														   <input type="hidden" value="<?php  if(isset($email)){echo $email;} ?>" name="useremail">
														   <input type="hidden" value="<?php  if(isset($code)){echo $code;} ?>" name="usercode">
															<input type="submit" value="Update" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
														</div>
													</div>
												</form>
											</div>
										</div>
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