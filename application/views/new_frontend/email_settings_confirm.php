<?php
$this->load->view('new_frontend/public/head');
?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<style>
	.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; margin: 0;}
	.toggle.ios .toggle-handle { border-radius: 20px; }
</style>
<?
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
					<h1>Confirmation for change in Email Settings</h1>
				</div>
			</div>
		</div>
	</section>

	<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->


	<div class="container">
		<? if($this->session->user_data) $this->load->view('new_frontend/incs/settings_menu'); ?>
		<!-- Registor -->

		<div class="col-md-9">
			<div class="row" >
				<div class="col-md-12">
				<?php
				if($result['error_code'] == 2)
				{	
					//INVALID CODE
					echo "<h2>".$result['msg']."</h2>";
				}
				else if($result['error_code'] == 1)
				{
					//Code Expired
					// echo $result['msg'];
					echo "<h2>".$result['msg']."</h2>";
				}
				else{ //SUCCESS
					// echo $result['msg'];?>
					<h2>You have successfully updated your <?=$setting_name?> email setting.</h2>
				<? } ?>
					
					<h4>Please proceed to <a href="<?=site_url('email-settings')?>">Email Settings</a> 
					<?if(!$result['error_code']){?>for more information.<? } else{?>
						to update again.
					<?}?>
					</h4>
					<p><?//=$code?></p>

				</div>
			</div>
		</div>
	</div>
</div>


<?php $this->load->view('new_frontend/public/footer'); ?>
<script type="text/javascript">

</script>
