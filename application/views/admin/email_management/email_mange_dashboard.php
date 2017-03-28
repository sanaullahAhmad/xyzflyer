<div id="page-wrapper" >
    <div class="page-content">
<!--         <div class="row">
    <div class="col-md-12"> -->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Email Management</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message" class="alert">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php 
                //echo anchor(site_url('admin_flyers/create'), 'Create', 'class="btn btn-primary"'); 
                 //echo anchor(site_url('admin_flyers/excel'), 'Excel', 'class="btn btn-primary"'); 
                 //echo anchor(site_url('admin_flyers/word'), 'Word', 'class="btn btn-primary"'); ?>
             </div>
         </div>


         <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
               
                    <div class="col-md-3"><a href="<?php echo site_url('Email_databaseManagement'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-files-o fa-lg"></i></div>
                            <h3>Emails List</h3>
                        </div>
                    </a></div>
                  
                    <div class="col-md-3"><a href="<?php echo site_url('email'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-envelope fa-lg"></i></div>
                            <h3>Email Database</h3>
                        </div>
                    </a></div>
					 <div class="col-md-3"><a href="<?php echo site_url('bulk_emails'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-envelope fa-lg"></i></div>
                            <h3>Bulk Email</h3>
                        </div>
                    </a></div>
					 <div class="col-md-3"><a href="<?php echo site_url('admin/managereports/email_tracking'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-envelope fa-lg"></i></div>
                            <h3>Email Tracking</h3>
                        </div>
                    </a></div>
				</div>
			
				<div class="row" style="padding-top: 12px;">

					<div class="col-md-3"><a href="<?php echo site_url('Admin_subscription'); ?>">
						<div class="box">
						<div class="icon"><i class="fa fa-envelope fa-lg"></i></div>
						<h3>Email Subscribers</h3>
						</div>
					</a></div>
					<div class="col-md-3"><a href="<?php echo site_url('email_unsubscribers'); ?>">
						<div class="box">
						<div class="icon"><i class="fa fa-envelope fa-lg"></i></div>
						<h3>Email unsubscribers</h3>
						</div>
					</a></div>
					<div class="col-md-3"><a href="<?php echo site_url('email'); ?>">
						<div class="box">
						<div class="icon"><i class="fa fa-envelope fa-lg"></i></div>
						<h3>Email Import</h3>
						</div>
					</a></div>
				</div>
				


        </div>
    </div>

</div>