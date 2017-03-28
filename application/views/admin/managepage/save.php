<?php $this->load->view('admin/layout/page_javascript');  ?>
<div class="page-content" >
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <div class="row">
            <div class="col-md-12">
                <h2><?php echo $page_title; ?></h2>   
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
                        <?php echo $page_title; ?>
                    </div>
                    <form method="post" enctype="multipart/form-data" action="" novalidate>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">

                                    
                                    <div class="form-group">
                                        <label>Page Title</label>
                                        <input required="required"  <?php if(isset($page_delete_able) && $page_delete_able==1){ echo 'readonly="readonly"';} ?> name="page_title" value="<?php if(isset($page_title_edit)){ echo $page_title_edit;} ?>" class="form-control" placeholder="Please Enter Keyword" />
                                        <span class="error"><?php echo form_error('page_title'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Page Description</label>
                                        <textarea required="required" name="page_description"  class="form-control" ><?php if(isset($page_body_edit)){ echo $page_body_edit;} ?></textarea>
                                        <span class="error"><?php echo form_error('page_body'); ?></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Page Featured Image</label>
                                        <input type="file" name="photo_file" >
                                        <?php if(isset($page_image_edit) && $page_image_edit!=''){ ?> <img width="130" height="150" src="<?php echo base_url().'public/upload/pages/'.$page_image_edit; ?>" alt=""> <?php } ?>
                                    </div>
                                </div>


                            </div>
                            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        </div>
                    </form>

                </div>
            </div>
        </div>
		<a href="<?php echo site_url('admin/managepages') ?>" class="btn btn-default">&laquo; Go Back</a>