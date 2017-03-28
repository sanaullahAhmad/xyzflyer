<div id="page-wrapper" >
    <div class="page-content">
<!--         <div class="row">
    <div class="col-md-12"> -->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Reports</h2>
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
               
                    <div class="col-md-3"><a href="<?php echo site_url('reports/orders'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-files-o fa-lg"></i></div>
                            <h3>Orders</h3>
                        </div>
                    </a></div>
                  
                    <div class="col-md-3"><a href="<?php echo site_url('reports/emails'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-envelope fa-lg"></i></div>
                            <h3>Emails</h3>
                        </div>
                    </a></div>
                   
            </div>




        </div>
    </div>

</div>