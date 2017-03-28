<body>
	<div class="body">
		<div class="loading text-center" id="ajax_loader" style="display: none">
		<div></div>
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-md-offset-4 text-center loader" style="overflow: visible!important;">
						<!-- <div><img height="80px" width="115" alt="Loading..." src="<?=base_url('public/new_frontend/img/loading_sm.gif')?>"></div> -->
						<!-- <h4 class="raleway gray">Data is loading please wait...</h4> -->
					</div>
				</div>
			</div>
		</div>
		<?php 
			$query4 = $this->db->query("select * from tbl_settings where mykey = 'frontend_contactus_email_logo'");
      		$frontend_contactus_email_logo = $query4->row();
      		$logo_url = base_url().'uploads/site_logo/'. $frontend_contactus_email_logo->Value;
		?>
		<header id="header" data-plugin-options='{"stickyEnabled": true, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 57, "stickySetTop": "-30px", "stickyChangeLogo": true}'>
			<div class="header-body">
				<div class="header-container container">
					<div class="header-row">
						<div class="header-column">
							<div class="header-logo">
								<a href="<?=site_url('alpha')?>"> 
								<img src="<?= $logo_url?>" alt="XYZ Flyers" style="width: 200px; height: 95px">
								</a>
							</div>
						</div>

						<div class="header-column">
							<div class="header-row">
								<nav class="header-nav-top">
									<ul class="nav nav-pills">
										<?php if(!$this->session->userdata('user_data')){?>
										<li class="hidden-xs">
											<a href="<?= site_url('subscribe');?>"><i class="fa fa-angle-right"></i> Subscribe</a>
										</li>
										<li class="hidden-xs">
											<a href="<?= site_url('register');?>"><i class="fa fa-angle-right"></i> Register</a>
										</li>
										<li class="hidden-xs">
											<a href="<?= site_url('login');?>"><i class="fa fa-user"></i> Login</a>
										</li>
										<?php }else{?>
										<li class="hidden-xs">
											<a href="<?= site_url('account');?>"><i class="fa fa-user"></i> Account</a>
										</li>
										<li class="hidden-xs">
											<a href="<?= site_url('logout');?>"><i class="fa fa-user"></i> Logout</a>
										</li>
										<?php } ?>
									</ul>
								</nav>
							</div>
							<?php $this->load->view('new_frontend/public/main_nav'); ?>
						</div>
					</div>
				</div>
			</div>
		</header>