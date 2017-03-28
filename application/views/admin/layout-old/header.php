<html xmlns="http://www.w3.org/1999/xhtml">
    <?php $this->load->view('admin/layout/head'); ?>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url('admin'); ?>"><?php
                        if ($this->session->userdata('admin_data') != "") {
                            echo $this->session->userdata['admin_data']['username'];
                        }
                        ?></a> 
                </div>
                <div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;"> &nbsp; 
                    <a href="<?php echo base_url('logout'); ?>" class="btn btn-danger square-btn-adjust">Logout</a> </div>
            </nav> 

            <!-- Main Nav -->
            <?php 
            if($nav){
            $this->load->view('admin/layout/nav'); 
            }?>
            <!-- End Main Nav -->

