<?php 
$this->load->view('new_frontend/public/head');
$this->load->view('new_frontend/public/header');
$this->load->helper('slider_helper');
$data=get_slider_aboutus();

?>

		<div role="main" class="main">
				<section class="page-header custom-product about_us" style="background-image: url('<?php if($data){ echo base_url()."uploads/slider_images/".$data->image_name ; } ?>' )" > 
					<div class="container">
						<div class="row">
							<div class="col-sm-7">
								<h1 class="white"><?php echo ($data ? $data->main_heading : ''); ?></h1>
									
									<?php echo ($data ? $data->sub_heading: ''); ?>
								<?php if($data){ ?>
								<a href="<?php echo ($data ? $data->button_url : ''); ?>" class="btn btn-default btn-lg mb-xl"><?php echo ($data ? $data->button : ''); ?></a> <span class="arrow hlt" style="top: 10px;"></span>
								<?php } ?>
							</div>
							<div class="col-sm-5">
							<!--	<img class="pull-right img-responsive" alt="" src=""> -->
							</div>
						</div>
					</div>
				</section>

				<div class="container">
					<div class="row">
						<div class="col-md-12 center">
							<p class="lead" style="text-align: Left;">

							</p>
							<hr class="tall">
						</div>
					</div>
					<div class="container">
						<div class="row mb-xlg">
						<div class="col-sm-7">
							<h2>Premium <strong>Features</strong></h2>
							<p class="lead" style="font-size: 16px">
								Real estate eFlyers are an incredibly effective sales tool, thanks to the combination of a stunning presentation and the consolidated, relevant information for your listing. What's more, the price is right. For only $39.95, your listing reaches thousands of agents; 10,000 to be exact.
							</p>
							<p class="mt-xlg" style="font-size: 16px">
									In addition, you get the PDF of your flyer, making it simple for you to print and distribute hard copies, as well. 
							</p>
							<p style="font-size: 16px">
									<!-- <p>Real estate eFlyers are an incredibly effective sales tool, thanks to the combination of a stunning presentation and the consolidated, relevant information for your listing. What's more, the price is right. For only $39, your listing reaches thousands of agents; 10,000 to be exact.</p> -->
									<p style="font-size: 16px">How does it work? It's simple. You have three options to create your flyer: using a previous flyer, uploading your own, or choosing one of our templates. Then, you customize your design, proof it, and choose your delivery area. It's a simple, hassle-free way to gather the largest potential audience for your listing. <br><a href="<?=site_url('how-it-works')?>">Read more here</a></p>
									<p style="font-size: 16px">Our ordering template even allows you to complete all of the relevant fields for your email blast: listing number and price, address, header, and the body of your email. It has never been easier to share your listings with 10,000 real estate agents.</p>
									<p style="font-size: 16px">Real estate flyers ensure you get the most out of your marketing dollars, allowing you to instead focus resources wherever you need them most. What's more, eFlyers make a terrific marketing tool for you to attract new owners looking for the best agent to sell their property.</p>
									
								</p>
							
						</div>
						<div class="col-sm-4 col-sm-offset-1 mt-xlg">
							<img class="img-responsive mt-xlg" src="<?=base_url('public/new_frontend/img/device.png')?>" alt="">
						</div>
					</div>
					</div>
					<div class="container">
						<hr class="tall">
					</div>				
				</div>

					<section class="call-to-action call-to-action-primary mb-xl">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="call-to-action-content align-left pb-md mb-xl ml-none">
								<h2 class="text-color-light mb-none mt-xl">Readymade flyers to get you started quickly</h2>
								
							</div>
								<div class="call-to-action-btn">
								<a href="<?=($this->session->user_data)?site_url('editor'):site_url('register')?>" target="_blank" class="btn btn-lg btn-primary btn-primary-scale-2 mr-md">Get Started Today</a>
								<span class="mr-md text-color-light hidden-xs"><span class="arrow arrow-light hlb" style="top: -95px; right: -26px;"></span></span>
							</div>
							</div>
						</div>
					</div>
				</section>

			</div>


<?php
	$this->load->view('new_frontend/public/footer');

?>