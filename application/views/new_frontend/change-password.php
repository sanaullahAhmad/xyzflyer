<?php
$this->load->view('new_frontend/public/head');
$this->load->view('new_frontend/public/header');
?>
<style>
	input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
</style>
<? $error=$this->session->flashdata('message2');

if(!empty($formerror2) || $error){ ?> 
					

<?php } ?> 



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
				<h1>Change Password</h1>
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
				<div class="row" >
					<div class="col-md-8">
						<h2 id="cpasForm">Change Password</h2>
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
							?>
							<form  action="<?php echo base_url('updatepassword'); ?>" method="POST">
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>Current Password</label>
											<input type="password"  name="olduserPassword" class="form-control" autocomplete="off" required>

										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>New Password</label>
											<input type="password"  name="userPassword" class="form-control" autocomplete="off" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>Confirm Password</label>
											<input type="password"  name="reUserPassword" class="form-control" autocomplete="off" required>
										</div>
									</div>
								</div>
								<input type="hidden" value="<?php echo $userEmail; ?>" maxlength="100" class="form-control" name="email" id="userEmail" required>
								<input type="hidden"  value="<?php echo $userId; ?>"  name="userId" class="form-control" autocomplete="off">
								
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
		</div>


		<?php

		$this->load->view('new_frontend/public/footer');
		?>