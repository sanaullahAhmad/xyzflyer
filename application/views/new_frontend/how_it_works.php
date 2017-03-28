<?php
	$this->load->view('new_frontend/public/head');
	$this->load->view('new_frontend/public/header');
	$this->load->helper('slider_helper');
	$data=get_slider_works();
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

				<section class="section section-default mt-xl mb-none pb-none">
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<div class="row">
									<div class="col-md-12 center mb-xl">
										<h2 class="mb-sm mt-md">How it <strong>Works?</strong></h2>
										<p class="lead mb-xl">It's simple. You have three options to create your flyer: using a previous flyer, uploading your own, or choosing one of our templates. Then, you customize your design, proof it, and choose your delivery area. It's a simple, hassle-free way to gather the largest potential audience for your listing.</p>
										<h4 class="heading-primary alternative-font mt-xl pt-xl">Tons of <strong class="custom-underline">Readymade Templates!</strong></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
<br>
				<div class="container">
					<br>
					<div class="row">
						<div class="col-md-7 col-sm-8 col-xs-12">
							<h2><strong>Step One:</strong> Start</h2>
							<p class="font_16">
								Once you choose to begin designing a flyer, you receive an order number and see three options: Create New Flyer, Use Previous Flyer, and Upload Your Own Flyer. Make your choice and move onto the next step.
							</p>
						</div>
						<div class="col-md-5 col-sm-4 col-xs-12"><img class="pull-right img-responsive" alt="" src="<?=base_url('public/new_frontend')?>/img/step1.gif"></div>
					</div>
					<hr class="tall">
					<div class="row">
						<div class="col-md-5 col-sm-4 col-xs-12"><img class="img-responsive" alt="" src="<?=base_url('public/new_frontend')?>/img/step2.gif"></div>
						<div class="col-md-7 col-sm-8 col-xs-12">
							<h2><strong>Step Two:</strong> Choose Your Flyer</h2>
							<p class="font_16">
								This is where you select your flyer type. Choices include Open House Flyer, Holiday Flyer, and Property Flyer. You'll see a selection of templates for each type, as well as a large preview of the highlighted option. Make your choice and hit Save and Continue.
							</p>
						</div>
					</div>

					<hr class="tall">
					
					<div class="row">
						<div class="col-md-7 col-sm-8 col-xs-12">
							<h2><strong>Step Three:</strong> Design Your Flyer</h2>
							<p class="font_16">
								This is where the fun starts. Upload images, choose your color palette, pick your favorite font, and start entering property details. Moving photos around and changing colors and fonts is a breeze, and if you don't like a change, simply hit the Undo button; problem solved!
							</p>
						</div>
						<div class="col-md-5 col-sm-4 col-xs-12"><img class="pull-right img-responsive" alt="" src="<?=base_url('public/new_frontend')?>/img/step3.gif"></div> 
					</div>

					<hr class="tall">
					
					<div class="row">
						<div class="col-md-5 col-sm-4 col-xs-12"><img class="img-responsive" alt="" src="<?=base_url('public/new_frontend')?>/img/step4.gif"></div>
						<div class="col-md-7 col-sm-8 col-xs-12">
							<h2><strong>Step Four:</strong> Proof</h2>
							<p class="font_16">Now is the time to review your flyer. Look out for typos, misused words, and anything else you don't want to wind up in the finished product.</p>
							<p class="font_16">You also get to look enter the information for your email campaign, including the listing number and price, address, and what you want to say.</p>
						</div>
					</div>
					<hr class="tall">
					
					<div class="row">
						<div class="col-md-7 col-sm-8 col-xs-12">
							<h2><strong>Step Five:</strong> Send</h2>
							<p class="font_16">Once you have your flyer and email created, choose your delivery area, enter your payment information, and click Send. Congratulations! You've just emailed 10,000 agents your listing.</p>
						</div>
						<div class="col-md-5 col-sm-4 col-xs-12"><img class="pull-right img-responsive" alt="" src="<?=base_url('public/new_frontend')?>/img/step5.gif"></div>
					</div>


				</div>

			</div>
<?php 
	$this->load->view('new_frontend/public/footer');
?>