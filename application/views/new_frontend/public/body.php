<?php
	$this->load->view('new_frontend/public/header');
?>
	<div role="main" class="main">
<div class="slider-container rev_slider_wrapper">
					<div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"delay": 9000, "gridwidth": 800, "gridheight": 500}'>
						<ul>
						
							<?php if($slider_image) { foreach($slider_image as $slide) { ?>
							
							<li data-transition="fade">
								<img src="<?=base_url()."uploads/slider_images/".$slide['image_name'] ?>"  
									alt=""
									data-bgposition="center center" 
									data-bgfit="cover" 
									data-bgrepeat="no-repeat" 
									class="rev-slidebg">
								<div class="tp-caption main-label"
									data-x="center" data-hoffset="0"
									data-y="center" data-voffset="-45"
									data-start="1500"
									data-whitespace="nowrap"						 
									data-transform_in="y:[100%];s:500;"
									data-transform_out="opacity:0;s:500;"
									style="z-index: 5"
									data-mask_in="x:0px;y:0px;">
										<?php echo $slide['main_heading']; ?>
								</div>

								<div class="tp-caption bottom-label"
									data-x="center" data-hoffset="0"
									data-y="center" data-voffset="5"
									data-start="2000"
									style="z-index: 5"
									data-transform_in="y:[100%];opacity:0;s:500;">
										<?php echo $slide['sub_heading']; ?>
								</div>
								<?php if(!empty($slide['button_url']) && !empty($slide['button'])){ ?>
								<a  href="<?php echo $slide['button_url']; ?>"
								    class="tp-caption btn btn-lg btn-primary btn-slider-action"
									data-hash
									data-hash-offset="85"
									data-x="center" data-hoffset="0"
									data-y="center" data-voffset="80"
									data-start="2200"
									data-whitespace="nowrap"						 
									data-transform_in="y:[100%];s:500;"
									data-transform_out="opacity:0;s:500;"
									style="z-index: 5"
									data-mask_in="x:0px;y:0px;">
										<?php echo $slide['button']; ?>
								</a>
								
							</li>
							<? } } 
							
							} ?>
							
						</ul>
					</div>
				</div>

				<br>
				<br>
				<br>	
				<div class="container">
				
					<div class="row center">
						<div class="col-md-12">
							<h1 class="mb-sm word-rotator-title">
								<img src="<?=base_url('public/new_frontend/img/logo_below_slider.png')?>" alt="XYZ Flyers"> brings you an
								<strong class="inverted">
									<span class="word-rotate active" data-plugin-options="{&quot;delay&quot;: 2000, &quot;animDelay&quot;: 300}">
										<span class="word-rotate-items" style="width: 176.45px; top: -92px;">
											<!-- <span>Easy</span> -->
											<span>Incredible</span>
											<span>Awesome</span>
										<span>Easy</span></span>
									</span>
								</strong>
								way to generate Real Estate leads.
							</h1>
							<p class="lead">
								Connect to agents in your area & start generating leads in minutes. 
								<br>
								it’s easy. it’s quick & it’s Incredibly effective.
								<br>	
								<small>	Read more here <a href="<?php echo base_url();?>blog/articles/are-real-estate-flyers-still-effective/" target="_blank">Are Real Estate Flyers Still Effective?</a></small>
							</p>
						</div>
					</div>
				
				</div>
				<div class="home-concept">
					<div class="container">
				
						<div class="row center">
							<span class="sun"></span>
							<span class="cloud" style="top: 55px;"></span>
							<div class="col-md-2 col-md-offset-1">
								<div class="process-image appear-animation bounceIn appear-animation-visible" data-appear-animation="bounceIn">
									<img src="<?php echo base_url('public/new_frontend')?>/img/home/signup.jpg" alt="">
									<strong>Signup</strong>
								</div>
							</div>
							<div class="col-md-2">
								<div class="process-image appear-animation bounceIn appear-animation-visible" data-appear-animation="bounceIn" data-appear-animation-delay="200" style="animation-delay: 200ms;">
									<img src="<?php echo base_url('public/new_frontend')?>/img/home/create_a_flyer.jpg" alt="">
									<strong>Create Flyer</strong>
								</div>
							</div>
							<div class="col-md-2">
								<div class="process-image appear-animation bounceIn appear-animation-visible" data-appear-animation="bounceIn" data-appear-animation-delay="400" style="animation-delay: 400ms;">
									<img src="<?php echo base_url('public/new_frontend')?>/img/home/select_an_area.jpg" alt="">
									<strong>Select Area</strong>
								</div>
							</div>
							<div class="col-md-4 col-md-offset-1">
								<div class="project-image">
									<div id="fcSlideshow" class="fc-slideshow">
										<ul class="fc-slides">
											<li style="display: none;"><img class="img-responsive" src="<?php echo base_url('public/new_frontend')?>/img/home/generate_leads.jpg" alt=""></li>
											<li style="display: none;"><img class="img-responsive" src="<?php echo base_url('public/new_frontend')?>/img/home/generate_leads11.jpg" alt=""></li>
											<!-- <li style="display: list-item;"><a href="<?=site_url('register')?>"><img class="img-responsive" src="<?php echo base_url('public/new_frontend')?>/img/home/generate_leads.jpg" alt=""></a></li> -->
										</ul>
									<nav><div class="fc-left"><span></span><span></span><span></span><i class="fa fa-arrow-left"></i></div><div class="fc-right"><span></span><span></span><span></span><i class="fa fa-arrow-right"></i></div></nav><div class="fc-flip" style="transition: none 0s ease 0s ; transform: none; display: none;"><div class="fc-front"><div><a href="portfolio-single-small-slider.html"><img class="img-responsive" src="<?php echo base_url('public/new_frontend')?>/img/projects/project-home-2.jpg" alt=""></a></div><div class="fc-overlay-light" style="transition: opacity 538.462ms ease 0s; opacity: 1;"></div></div><div class="fc-back" style="transform: rotate3d(1, 1, 0, 180deg);"><div><a href="portfolio-single-small-slider.html"><img class="img-responsive" src="img/projects/project-home-3.jpg" alt=""></a></div><div class="fc-overlay-dark" style="opacity: 0; transition: opacity 538.462ms ease 0s;"></div></div></div></div>
									<strong class="our-work">Send & Generate Leads</strong>
								</div>
							</div>
						</div>
						<br><br>	
						<!-- <h5 class="text-center">>>> <a href="#">See Tips and Tricks for Commercial Real Estate Marketing</a> <<<<</h5> -->
					</div>
				</div>
					<div class="container">
						<hr class="tall">
					</div>	

				<div class="container">

					<div class="row">
						<div class="col-md-12 center">
							<h1>
								<strong>Here are a few of our inspirational numbers </strong>
							</h1>
						
						</div>
					</div>

					<div class="row mt-xl">
						<div class="counters counters-text-dark" id="counter_div">
							<div class="col-md-3 col-sm-6">
								<div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="300">
									<i class="fa fa-users"></i>
									<strong data-to="<?php echo $total_agents;?>" data-append="+" id="totAgt">0</strong>
									<h1>
										Agents
									</h1>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="600">
									<img class="" src="<?=base_url('public/new_frontend/img/county.png')?>" width="40px" height="40px" style="padding-bottom: 1px">
									<strong data-to="<?php echo $total_counties;?>" data-append="+" id="totAcnt">0</strong>
									<h1>Counties</h1>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="900">
									<img class="" src="<?=base_url('public/new_frontend/img/cities.png')?>" width="50px" height="50px" style="padding-bottom: 1px">
									<strong data-to="<?php echo $total_cities;?>" data-append="+" id="totCit">0</strong>
									<h1>Cities</h1>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="1200">
									<i class="fa fa-paper-plane-o size-large large"></i>
									<strong data-to="<?php echo $emails_delivered; ?>" data-append="+" id="delEmail">0</strong>
									<h1>Emails Delivered</h1>
								</div>
							</div>
						</div>
					</div>

				</div>
				<br>	
				<section class="call-to-action call-to-action-primary mb-none">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="call-to-action-content align-left pb-md mb-xl ml-none">
									<h2 class="text-color-light mb-none mt-xl">Readymade flyers to get you started quickly</h2>
									<p class="lead mb-xl">Here are some premade options you can choose:</p>
								</div>
								<div class="call-to-action-btn">
									<a href="<?=($this->session->user_data)?site_url('editor'):site_url('register')?>" class="btn btn-lg btn-primary btn-primary-scale-2 mr-md">Get Started Today</a>
									<!--<span class="mr-md text-color-light hidden-xs">Only <strong>$16</strong> --><span class="mr-md text-color-light hidden-xs"><span class="arrow arrow-light hlb"  style="top: -95px; right: -26px;"></span></span>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section class="section section-primary section-primary-scale-2 section-center section-no-border mt-none p-sm" id="demos">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="nav nav-pills sort-source sort-source-style-2" data-sort-id="portfolio" data-option-key="filter" data-plugin-options='{"layoutMode": "fitRows", "filter": "*"}'>
									<li data-option-value="*" class="active"><a href="#">Show all Flyers</a></li>
									<?php if(isset($front_tags) && $front_tags!=""){

										foreach($front_tags as $tag){
										?>
										<li data-option-value=".tag_<?php echo $tag['pk_flyer_tags']; ?>"><a href="#"><?php echo $tag['flyer_tags_title']; ?></a></li>


										<?php 
										}
									} ?>
								</ul>
							</div>
						</div>
					</div>
				</section>
				<div class="row">
				<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
				<ul class="portfolio-list sort-destination full-width-spaced mb-xl" data-sort-id="portfolio" id="homeOverview" style="margin-top:0">
			    <?php if(isset($front_flyer) && !empty($front_flyer)){
				 foreach($front_flyer as $flyer){ 
				 	if(file_exists('public/upload/flyer_images/thumb_'.$flyer['flyer_image'])){
				 		$tagClass=explode(",",$flyer['tags']);
				 	?>
					<li class="col-md-3 col-sm-6 col-xs-12 isotope-item <?php if(is_array($tagClass) && ($tagClass)) {foreach($tagClass as $class){ echo ($class!=""?'tag_'.$class." ":"* "); }}?>">
						<div class="portfolio-item center">
							<a href="<?php echo base_url(); ?>public/upload/flyer_images/resized_<?php echo  $flyer['flyer_image']; ?>" data-lightbox="example-set"  class="text-decoration-none block-link pt-md">
								<!-- <span class="thumb-info thumb-info-preview thumb-info-preview-long mb-md">
									<span class="thumb-info-wrapper"> -->
										<img class="thumb-info-image" style="border:2px solid rgba(0,0,0,0.5)" src="<?php echo base_url()?>public/upload/flyer_images/resized_<?php echo  $flyer['flyer_image'];?>" data-plugin-lazyload>
									<!-- </span>
								</span> -->
								<h5 class="mb-xs"><?=$flyer['flyer_title']?></h5>
							</a>
						</div>
					</li>
				<?php  $tagClass=array();}}}?>
				</ul>
				</div>
				</div>
				
				<section class="call-to-action call-to-action-default">
				 <div class="container">
				  <div class="row">
				   <div class="col-md-12">
					<div class="mb-xl ">
					 <h4 class="heading-primary alternative-font mt-xl pt-xl text-center"><strong style="font-size: 32px">Reach over 10,000 Real Estate Professionals Nationwide for a flat fee of only $39.95</strong></h4>
					
					</div>
					
				   </div>
       
					<div class="row">
						   <div class="col-md-12 text-center">
						   <div class="" style="margin-bottom: 30px">
							 <a href="<?=site_url('pricing')?>" class="btn btn-lg btn-primary btn-primary-scale-2 mr-md text-center">Get Started Today</a>

							 <!--<span class="mr-md text-color-light hidden-xs">Only <strong>$16</strong> -->
							</div>
							</div>
					</div>
				</div>
				</div>
			</section>
				</div>
		
	</div>
<script src="<?= base_url('public/new_frontend/lightbox/dist/js/lightbox-plus-jquery.min.js');?>"></script>
 