<?php //$this->load->view('admin/layout/page_javascript'); ?>
<div id="page-wrapper" >
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h2>Add Client</h2>   
                <h5>Welcome <?php
                    if ($this->session->userdata('admin_data') != "") {
                        echo $this->session->userdata['admin_data']['username'];
                    }
                    ?> , Love to see you back. </h5>
            </div>
        </div>              
        <!-- /. ROW  -->
        <hr />  
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add Client
                    </div>
                    <form method="post" enctype="multipart/form-data" action="">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">

                                    
                                    <div class="form-group">
                                        <label>Client Name</label>
                                        <input required="required"  name="client_name" value="<?php if(isset($client_name)){ echo $client_name;} ?>" class="form-control" placeholder="PLease Enter Client Name" />
                                         <span class="error"><?php echo form_error('client_name'); ?></span>
                                    </div>
                                                                        
                                    <div class="form-group">
                                        <label>Client Logo</label>
                                        <input type="file" name="photo_file" <?php if(!isset($client_logo)){ ?>required="required" <?php } ?> >
                                        <?php if(isset($client_logo) && $client_logo!=''){ ?> <img width="130" height="150" src="<?php echo base_url().'public/upload/client_images/'.$client_logo; ?>" alt=""> <?php } ?>
                                    </div>
                                </div>


                            </div>
                            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        </div>
                    </form>

                </div>
            </div>
        </div>