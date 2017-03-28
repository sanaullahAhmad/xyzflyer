<?php 
    if(!$this->session->flashdata('message')){
    	redirect(site_url('alpha'));
    }
	$this->load->view('new_frontend/public/head');
	$this->load->view('new_frontend/public/header');
?>

<!-- Body content goes here -->
<div role="main" class="main">

				<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="<?php echo site_url('newdesign'); ?>">Home</a></li>
									<li class="active">Info</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1>Message</h1>
							</div>
						</div>
					</div>
				</section>

				<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
				

				<div class="container text-center" style="min-height:400px;margin:0 auto;">
			    <div class="row">
			     <div class="col-md-12"><?php  echo  $this->session->flashdata('message'); ?></div>
				<div class="col-md-12">
					<img src="<?php echo base_url();?>public/new_frontend/img/left_side.png" width="300">
				</div>
				<div class="col-md-12">
				<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-1">
					<ul class="portfolio-list sort-destination full-width-spaced mb-xl" data-sort-id="portfolio" id="homeOverview" style="margin-top:0">
				    <?php 
				    if(isset($info_page_flyer) && !empty($info_page_flyer)){
					 foreach($info_page_flyer as $flyer){ 
					 	if(file_exists('public/upload/flyer_images/thumb_'.$flyer['flyer_image'])){
					 	?>
						<li class="col-md-2 col-sm-6 col-xs-12 isotope-item">
							
								<a href="<?php echo base_url(); ?>public/upload/flyer_images/resized_<?php echo  $flyer['flyer_image']; ?>" data-lightbox="example-set" class="text-decoration-none block-link pt-md">
											<img class="thumb-info-image" src="<?php echo base_url()?>public/upload/flyer_images/resized_<?php echo  $flyer['flyer_image'];?>" data-plugin-lazyload>
									<h5 class="mb-xs"><?=$flyer['flyer_title']?></h5>
								</a>
						
						</li>
					<?php  }}}?>
					</ul>
				</div>
				</div>
			</div>
			</div>
<script src="<?= base_url('public/new_frontend/lightbox/dist/js/lightbox-plus-jquery.min.js');?>"></script>
<?php

	$this->load->view('new_frontend/public/footer');
?>