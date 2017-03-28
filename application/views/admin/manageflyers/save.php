<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <div class="row">
            <div class="col-md-12">
                <h2>Add Flyers</h2>
                <?php if(isset($message)) {?>
                <div id="message" class="col-md-6"><?=$message?></div>
                <?php } else if($this->session->userdata('message')) {?>
                <div class="col-md-6"><?=$this->session->userdata('message')?></div>
                <?php } ?>
                
            </div>
        </div> 
		<div class="row" id="iploadedImg">
            <div class="col-md-12">
             
                <?php if(isset($flyer)){foreach($flyer as $fl){?>
                <div style="float:left; margin:10px;"><img src="<?php echo base_url();?>/public/upload/flyer_images/<?php echo $fl;?>" width="100px"></div>
                <?php } }?>
            </div>
        </div>   
		       
        <!-- /. ROW  -->
        <hr />  
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add Flyers
                    </div>

                    <!-- start: flyer-design-wrap -->
                    <div id="flyer-design-wrap" class="flyer-design-wrap">

                        <!-- tabs menu start 
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-id-1">Flyer Design</a></li>
                            <li><a data-toggle="tab" href="#tab-id-2">Customer Database</a></li>
                            <li><a data-toggle="tab" href="#tab-id-3">Payment Processing</a></li>
                        </ul>
                         tabs menu end -->

                        <!-- tabs content start -->
                        <!-- <div class="tab-content"> -->

                            <!-- start: tab 1 content -->
                            <!-- <div id="tab-id-1" class="tab-pane fade in active pt-30 pb-10"> -->
                                <?php $this->load->view( 'admin/manageflyers/tabs/flyer-design' ); ?>
                            <!-- </div> -->
                            <!-- end: tab 1 content -->

                            <!-- start: tab 2 content 
                            <div id="tab-id-2" class="tab-pane fade">
                                <?php $this->load->view( 'admin/manageflyers/tabs/customer-database' ); ?>
                            </div>
                             end: tab 2 content 

                             start: tab 3 content 
                            <div id="tab-id-3" class="tab-pane fade">
                                <?php $this->load->view( 'admin/manageflyers/tabs/payment-processing' ); ?>
                            </div>
                             end: tab 3 content -->

                        <!-- </div> -->
                        <!-- tabs content end -->
                    </div>
                    <!-- /flyer-design-wrap -->

                </div>
            </div>
        </div>