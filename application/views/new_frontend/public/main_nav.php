<div class="header-row">
	<div class="header-nav">
		<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
			<i class="fa fa-bars"></i>
		</button>
		<ul class="header-social-icons social-icons hidden-xs">
			<li class="social-icons-facebook"><a href="https://www.facebook.com/xyzflyers" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
			<li class="social-icons-twitter"><a href="http://www.twitter.com/xyzflyers" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
			<li class="social-icons-linkedin"><a href="http://www.linkedin.com/company/xyz-flyers" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
			<li class="social-icons-pinterest"><a href="https://www.pinterest.com/xyzflyers/" target="_blank" title="pinterest"><i class="fa fa-pinterest"></i></a></li>
		</ul>
		<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
			<nav>
				<ul class="nav nav-pills" id="mainNav">
					<li <?=(! $this->uri->segment(1) || $this->uri->segment(1)=='alpha')? 'class="active"' : ''?>>
						<a href="<?= site_url('alpha');?>">
							Home
						</a>
						
					</li>
					<?php if($this->session->userdata('user_data')){?>
					<li <?=($this->uri->segment(1)=='order' || $this->uri->segment(1)=='editor')? 'class="active"' : ''?>>
						<a href="<?= site_url('order');?>">
							Order
						</a>
					</li>
					<?php }?>
					<li <?=($this->uri->segment(1)=='product' || $this->uri->segment(1)=='how-it-works')? 'class="active"' : ''?>>
						<a href="<?= site_url('how-it-works');?>">
							How it Works
						</a>
					</li>
					<li <?=($this->uri->segment(1)=='aboutus' || $this->uri->segment(1)=='about-us')? 'class="active"' : ''?>>
						<a href="<?= site_url('about-us');?>">
							About Us
						</a>
						
					</li>
					<li <?=($this->uri->segment(1)=='pricing')? 'class="active"' : ''?>>
						<a href="<?= site_url('pricing');?>">
							Pricing
						</a>
						
					</li>
					
					<li>
						<a href="<?= base_url('blog');?>">
							Blog
						</a>
						
					</li>
					
					<!-- <li>
						<a href="<?= site_url('ordernow');?>">
							Order Now
						</a>
						
					</li> -->
					<li <?=($this->uri->segment(1)=='contact')? 'class="active"' : ''?>>
						<a href="<?= site_url('contact-us');?>">
							Contact
						</a>
					</li>
					<!-- <li>
						<a href="<?= site_url('new_frontend/public/cart');?>">
							<i class="fa fa fa-shopping-cart"></i>
						</a>
					</li> -->
				</ul>
			</nav>
		</div>
	</div>
</div>