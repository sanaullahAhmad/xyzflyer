<div id="page-wrapper" >
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h2>Add Button Tags</h2>   
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
                        Add Button Tags
                    </div>
                     <?php if(isset($sucess) &&  $sucess!=''){ ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $sucess; ?>
                        </div>
                        <?php } ?>
                    <form method="post" enctype="multipart/form-data" action="">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">

                                    
                                    <div class="form-group">
                                        <label>Button Tags Name</label>
                                        <input required="required"  name="button_tags_title" value="<?php if(isset($button_tags_title)){ echo $button_tags_title;} ?>" class="form-control" placeholder="PLease Enter Button Title" />
                                         <span class="error"><?php echo form_error('button_tags_title'); ?></span>
                                    </div>
                                </div>


                            </div>
                            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        </div>
                    </form>

                </div>
            </div>
        </div>