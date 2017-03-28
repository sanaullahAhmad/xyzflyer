<?php
      $action = $this->router->fetch_class(); 
?>
<div class="header-right col-md-8">
                    <div class="social-icons-wrap pull-right">
                        <ul class="social-icons list-inline list-unstyled">
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                    <!-- social-icons-wrap -->
    
                    <button class="nav-toggle-button" data-toggle="collapse" data-target="#menu-toggle">
                    <i class="fa fa-layer"></i> Menu
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse menu-collapse" id="menu-toggle">
                        <div class="main-menu-wrap">
                            <ul class="main-menu pull-right list-inline list-unstyled">
                                <li class="<?php if ($action == 'pages' && isset($page_name) && $page_name == 'aboutus') { ?> active<?php } ?> dropdown1">
                                    <a href="<?php echo base_url().'about-us'; ?>">About &#9662;</a>
                                        <ul class="dropdown">
                                            <li <?php if ($action == 'pages' && isset($page_name) && $page_name == 'mission') { ?> class="active" <?php } ?>><a href="<?php echo base_url().'our-mission'; ?>">Mission</a></li>
                                            <li <?php if ($action == 'pages' && isset($page_name) && $page_name == 'histroy') { ?> class="active" <?php } ?>><a href="<?php echo base_url().'our-history'; ?>">History</a></li>
                                            <li <?php if ($action == 'team' && isset($page_name) && $page_name == 'leadership') { ?> class="active" <?php } ?>><a href="<?php echo base_url().'our-leadership'; ?>">Leadership</a></li>
                                        </ul>
        			</li>
                                <li class="<?php if ($action == 'property') { ?> active<?php } ?> dropdown1">
                                    <a href="<?php echo base_url().'our-listings'; ?>">Properties &#9662;</a>
                                        <ul class="dropdown">
                                            <li><a href="<?php echo base_url().'our-listings/commercial'; ?>">Commercial</a></li>
                                            <li><a href="<?php echo base_url().'our-listings/industrial'; ?>">Industrial</a></li>
                                            <li><a href="<?php echo base_url().'our-listings/residential'; ?>">Residential</a></li>
                                        </ul>
        			</li>
        			<li <?php if ($action == 'team' && isset($page_name) && $page_name == 'team') { ?> class="active" <?php } ?>><a href="<?php echo base_url().'our-team'; ?>">Team</a></li>
                                <li <?php if ($action == 'services') { ?> class="active" <?php } ?>><a href="<?php echo base_url().'our-services'; ?>">Services</a></li>
                                <li <?php if ($action == 'clients') { ?> class="active" <?php } ?> ><a href="<?php echo base_url().'our-clients'; ?>">Clients</a></li>
                                <li><a href="<?php echo base_url().'blog'; ?>">Blog</a></li>
                                <li <?php if ($action == 'pages' && isset($page_name) && $page_name == 'contactus') { ?> class="active" <?php } ?>><a href="<?php echo base_url().'contact-us'; ?>">contact</a></li>
                                
                            </ul>
                        </div>
                        <!-- main-menu-wrap -->      
                    </div>
                    <!-- collapse -->

                </div>