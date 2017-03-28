<div id="page-wrapper" >
    <div class="page-content">
<!--         <div class="row">
    <div class="col-md-12"> -->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Flyer Management</h2>
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
                <?php if(xyzAccesscontrol('flyer_managment','Read')==TRUE){ ?>
                    <div class="col-md-3"><a href="<?php echo site_url('admin_flyers'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-files-o fa-lg"></i></div>
                            <h3>View All Flyer</h3>
                        </div>
                    </a></div>
                    <?php } 
                    if(xyzAccesscontrol('flyer_tags','Full')==TRUE){?>
                    <div class="col-md-3"><a href="<?php echo site_url('flyer_tags'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-tags fa-lg"></i></div>
                            <h3>Flyer Tags</h3>
                        </div>
                    </a></div>
                    <?php }
                    if(xyzAccesscontrol('user_flyer','Full')==TRUE){ ?>
                    <div class="col-md-3"><a href="<?php echo base_url(); ?>user_flyers">
                        <div class="box">
                            <div class="icon">
                                <span class="fa-stack" style="font-size: 38px">
                                <i class="fa fa-file-o fa-stack-2x"></i>
                                  <i class="fa fa-user fa-stack-1x"></i>
                              </span>
                          </div>    
                          <h3>User Created Flyer</h3>
                      </div>
                  </a></div>
                  <?php }
                  if(xyzAccesscontrol('flyer_managment','Report')==TRUE){ ?>
                  <div class="row">
                    <div class="col-md-3"><a href="<?php echo site_url('admin/manageflyers/save'); ?>">
                        <div class="box">
                        <div class="icon"><i class="fa fa-file-text-o fa-lg"></i></div>
                        <h3>Flyer Report</h3>
                    </div>
                    </a></div>
                </div>
                <?php }
                if(xyzAccesscontrol('flyer_managment','Add')==TRUE){?>
                <div class="col-md-3"><a href="<?php echo site_url('admin/manageflyers/save'); ?>">
                   <div class="box">
                            <div class="icon"><i class="fa fa-plus fa-lg"></i></div>
                            <h3>Add New Flyer</h3>
                        </div>
                </a><br></div>  
                <?php }
                if(xyzAccesscontrol('flyer_managment','Word')==TRUE){ ?>
                <div class="col-md-3"><a href="<?php echo site_url('admin_flyers/word'); ?>">
                    <div class="box">
                        <div class="icon"><i class="fa fa-file-word-o fa-lg"></i></div>
                        <h3>Export Flyer (Word)</h3>
                    </div>
                </a></div>
                <?php }
                if(xyzAccesscontrol('flyer_managment','Excel')==TRUE){ ?>
                <div class="col-md-3"><a href="<?php echo site_url('admin_flyers/excel'); ?>">
                    <div class="box">
                        <div class="icon"><i class="fa fa-file-excel-o fa-lg"></i></div>
                        <h3>Export Flyer (Excel)</h3>
                    </div>
                </a></div>
                <?php }
                if(xyzAccesscontrol('flyer_managment','ViewLog')==TRUE){ ?>
                <div class="col-md-3"><a href="<?php echo site_url('Admin_activity/flyerActivity'); ?>">
                     <div class="box">
                        <div class="icon"><i class="fa fa-history fa-lg"></i></div>
                        <h3>Flyer Logs</h3>
                    </div>
                </a></div>
                <?php } ?>
            </div>




        </div>
    </div>

</div>