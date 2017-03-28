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
						<li><a href="<?= site_url();?>">Home</a></li>
						<li class="active">Unsubscribe</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>Unsubscribe</h1>
				</div>
			</div>
		</div>
	</section>
	<div class="container">

		<div class="row">
			<div class="col-md-8">

				<?php 
				echo $this->session->flashdata('message1');
				?>
				<form action="<?php echo base_url();?>unsubscribe_me_response" method="post">
					<h1>Unsubscribe to Emails</h1>
					<p>Please enter your email to unsubscribe from our email list</p>
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

	<?php
	$this->load->view('new_frontend/public/footer');
	?>