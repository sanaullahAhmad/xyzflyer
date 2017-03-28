<div id="page-wrapper" >
    <div class="page-content">
<!--         <div class="row">
            <div class="col-md-12"> -->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Admin</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message" class="alert">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php 
                //echo anchor(site_url('admins/create'), 'Create', 'class="btn btn-primary"'); 
                 //echo anchor(site_url('admins/excel'), 'Excel', 'class="btn btn-primary"'); 
                 //echo anchor(site_url('admins/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>


        <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-md-4"><a href="<?php echo site_url('admins/list_all'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-users fa-lg"></i></div>
                            <h3>All Admins</h3>
                        </div>
                    </a></div>
                <div class="col-md-4"><a href="<?php echo site_url('admins/list_all_by_status/1'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-user fa-lg"></i></div>
                            <h3>Active Admins</h3>
                        </div>
                    </a></div>
                <div class="col-md-4"><a href="<?php echo site_url('admins/list_all_by_status/0'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-user-times fa-lg"></i></div>
                            <h3>Suspended Admins</h3>
                        </div>
                    </a></div>
                    </div>
                    <br/>
                    <div class="row">
                    <div class="col-md-4"><a href="<?php echo site_url('admins/create'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-user-plus fa-lg"></i></div>
                            <h3>Add New Admin</h3>
                        </div>
                    </a></div>
               
                <div class="col-md-4"><a href="<?php echo site_url('admins/word'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-file-word-o fa-lg"></i></div>
                            <h3>Export Admins (Word)</h3>
                        </div>
                    </a></div>
                <div class="col-md-4"><a href="<?php echo site_url('admins/excel'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-file-excel-o fa-lg"></i></div>
                            <h3>Export Admins (Excel)</h3>
                        </div>
                    </a></div>
               
                </div>




                </div>
                </div>
      
</div>