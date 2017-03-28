<?php //$this->load->view('admin/layout/page_javascript'); ?>
<div id="page-wrapper" >
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h2>Add Service</h2>   
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
                        Add Service
                    </div>
                    <form method="post" enctype="multipart/form-data" action="">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">

                                    
                                    <div class="form-group">
                                        <label>Services Title</label>
                                        <input required="required" name="services_title" value="<?php if(isset($services_title)){ echo $services_title;} ?>" class="form-control" placeholder="PLease Enter Keyword" />
                                        <span class="error"><?php echo form_error('services_title'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Page Featured Image</label>
                                        <input type="file" name="photo_file" <?php if($services_images == ''){ ?> required="required" <?php } ?> >
                                        <?php if(isset($services_images) && $services_images!=''){ ?> <img width="130" height="150" src="<?php echo base_url().'public/upload/pages/'.$services_images; ?>" alt=""> <?php } ?>
                                    </div>
                                </div>


                            </div>
                            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        </div>
                    </form>

                </div>
            </div>
        </div>