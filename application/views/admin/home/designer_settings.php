<div id="page-wrapper" >
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
            <h2 style="margin-top:0px">Designer Settings</h2>
            <hr>

            <div class="row">
            	<div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        <?php 
                         if(xyzAccesscontrol('flyer_shapes','Full')==TRUE){
                        ?>
                        <div class="col-md-3"><a href="<?php echo site_url('admin_svgs'); ?>">
                            <div class="box">
                                <div class="icon"><i class="fa fa-square fa-lg"></i></div>
                                <h3>Manage Flyer Shapes</h3>
                            </div>
                        </a></div>
                        <?php }
                        if(xyzAccesscontrol('flyer_sizes','Full')==TRUE){
                         ?>
                        <div class="col-md-3"><a href="<?php echo site_url('flyer_size'); ?>">
                            <div class="box">
                                <div class="icon"><i class="fa fa-desktop fa-lg"></i></div>
                                <h3>Manage Flyer Sizes</h3>
                            </div>
                        </a></div>
                        <?php }
                        if(xyzAccesscontrol('flyer_fonts','Full')==TRUE){
                         ?>
                        <div class="col-md-3"><a href="<?php echo site_url('admin_fonts'); ?>">
                            <div class="box">
                                <div class="icon"><i class="fa fa-font fa-lg"></i></div>
                                <h3>Manage Fonts</h3>
                            </div>
                        </a></div>
                         <?php }
                        if(xyzAccesscontrol('flyer_tags','Full')==TRUE){
                         ?>
                        <div class="col-md-3"><a href="<?php echo site_url('flyer_tags'); ?>">
                            <div class="box">
                                <div class="icon"><i class="fa fa-tags fa-lg"></i></div>
                                <h3>Manage Flyer Tags</h3>
                            </div>
                        </a></div>
                        <?php } ?>
                    </div>
                    <br>
                    <!-- <div class="row">
                    <?php 
                        if(xyzAccesscontrol('flyer_shapes','Add')==TRUE){
                         ?>
                        <div class="col-md-3"><a href="<?php echo site_url('admin_svgs/create'); ?>">
                            <div class="box stacked">
                                <div class="icon">
                                    <span class="fa-stack fa-lg" style="margin-top: 9px;">
                                          <i class="fa fa-square-o fa-stack-2x"  style="margin-top: 21px;"></i>
                                          <i class="fa fa-plus fa-stack-1x" style="margin-top:19px;"></i>
                                    </span>
                                </div>
                                <h3>Add Flyer Shape</h3>
                            </div>
                        </a></div>
                        <?php }
                        if(xyzAccesscontrol('flyer_sizes','Add')==TRUE){
                         ?>
                        <div class="col-md-3"><a href="<?php echo site_url('flyer_size/create'); ?>">
                            <div class="box stacked">
                                <div class="icon">
                                    <span class="fa-stack fa-lg" style="margin-top: 9px;">
                                          <i class="fa fa-desktop fa-stack-2x" style="margin-top: 21px;"></i>
                                          <i class="fa fa-plus fa-stack-1x" style="margin-top: 10px;"></i>
                                    </span>
                                </div>
                                <h3>Add Flyer Size</h3>
                            </div>
                        </a></div>
                        <?php }
                        if(xyzAccesscontrol('flyer_fonts','Add')==TRUE){
                        ?>
                        <div class="col-md-3"><a href="<?php echo site_url('admin_fonts/create'); ?>">
                            <div class="box ">
                                <div class="icon"><i class="fa fa-plus fa-lg"></i></div>
                                <h3>Add Font</h3>
                            </div>
                        </a></div>
                         <?php }
                        if(xyzAccesscontrol('flyer_tags','Add')==TRUE){
                        ?>
                        <div class="col-md-3"><a href="<?php echo site_url('flyer_tags/create'); ?>">
                            <div class="box ">
                                <div class="icon"><i class="fa fa-tag fa-lg"></i></div>
                                <h3>Add Flyer Tag</h3>
                            </div>
                        </a></div>
                        <?php } ?>
                    </div> -->

                    <br><br>
                </div>
                </div>
                <!-- </div> -->
                <div class="row">
                    <div class="col-md-12">



                    </div>
                    <br>

                    <div>
                    <!-- <a class="btn btn-md btn-primary" href="<?php echo base_url('admin/manageflyers/add_button_tags'); ?>">Add Button Tags</a> <a href="<?php echo base_url('admin/manageflyers/add_button_tags'); ?>" class="btn btn-md btn-success">Add New Button Tag</a>
                    </div> -->
                    <br>
                    
                <!-- </li> -->
            	</div>
            </div>
            </div>
            
        </div>
<!--         <div>
    <?php 
        echo anchor('admin/', 'Go Back', 'class="btn btn-primary pull-right"');
    ?>
</div> -->
    </div>
</div>