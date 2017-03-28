<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
	
	<h2 style="margin-top:0px">Users</h2>
		
        <div class="row" style="margin-bottom: 10px">
           <!--  <div class="col-md-4">
                <?php echo anchor(site_url('users/create'),'Create', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('users/list_all'),'List All', 'class="btn btn-primary"'); ?>
            </div> -->

            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
               
            </div>
        </div>

        <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <div class="row">
                 <?php if(xyzAccesscontrol('user_managment','Read')==TRUE){ ?>
                    <div class="col-md-3"><a href="<?php echo site_url('users/list_all/'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-users fa-lg"></i></div>
                            <h3>All Users</h3>
                        </div>
                    </a></div>
                 <?php }
                if(xyzAccesscontrol('user_managment','Read')==TRUE){ ?>
                <div class="col-md-3"><a href="<?php echo site_url('users/list_all/1'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-user fa-lg"></i></div>
                            <h3>Active Users</h3>
                        </div>
                    </a></div>
                 <?php }
                    if(xyzAccesscontrol('user_managment','Read')==TRUE){ ?>
                <div class="col-md-3"><a href="<?php echo site_url('users/list_all/2'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-user-times fa-lg"></i></div>
                            <h3>Suspended Users</h3>
                        </div>
                    </a></div>
                <?php }
                    if(xyzAccesscontrol('user_managment','Read')==TRUE){ ?>
                <div class="col-md-3"><a href="<?php echo site_url('users/list_all/00'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-user-secret fa-lg"></i></div>
                            <h3>Unverfieid Users</h3>
                        </div>
                    </a></div>

                </div>
                <br>
                 <?php }
                    if(xyzAccesscontrol('user_managment','Add')==TRUE){ ?>
                <div class="row">
                    <div class="col-md-3"><a href="<?php echo site_url('users/create'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-user-plus fa-lg"></i></div>
                            <h3>Add New User</h3>
                        </div>
                    </a></div>
                <?php }
                 if(xyzAccesscontrol('user_managment','Word')==TRUE){ ?>
                <div class="col-md-3"><a href="<?php echo site_url('users/word'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-file-word-o fa-lg"></i></div>
                            <h3>Export Users (Word)</h3>
                        </div>
                    </a></div>
                <?php }
                    if(xyzAccesscontrol('user_managment','Excel')==TRUE){ ?>
                <div class="col-md-3"><a href="<?php echo site_url('users/excel'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-file-excel-o fa-lg"></i></div>
                            <h3>Export Users (Excel)</h3>
                        </div>
                    </a></div>
                <?php }
                    if(xyzAccesscontrol('user_managment','Report')==TRUE){ ?>
                <div class="col-md-3"><a href="">
                        <div class="box">
                            <div class="icon"><i class="fa fa-file-text-o fa-lg"></i></div>
                            <h3>User Reports</h3>
                        </div>
                    </a></div>
                 <?php } ?>
                </div>
            </div>
        </div>    
        </div>
</div>