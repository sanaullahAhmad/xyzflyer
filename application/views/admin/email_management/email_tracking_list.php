<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Email Tracking</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
        <?php //if(xyzAccesscontrol('flyer_shapes','Add')==TRUE){ echo anchor(site_url('admin_svgs/create'), 'Create', 'class="btn btn-primary"'); }?>
		<?php //if(xyzAccesscontrol('flyer_shapes','Excel')==TRUE){ echo anchor(site_url('admin_svgs/excel'), 'Excel', 'class="btn btn-primary"'); }?>
		<?php //if(xyzAccesscontrol('flyer_shapes','Word')==TRUE){ echo anchor(site_url('admin_svgs/word'), 'Word', 'class="btn btn-primary"'); }?>
	    </div>
        </div>
		 <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-6">
                <form action="<?php echo site_url('admin/managereports/email_tracking'); ?>" class="form-inline" method="get">
                    <div class="form-group">
                          <label for="sel1">Records:</label>
                          <select  class="form-control" id="records" name="records">
                            <option value='10' <?php if(isset($records)){ if ($records == "10"){ echo "selected"; } }?>>10</option>
                            <option value='25' <?php if(isset($records)){  if ($records == "25"){ echo "selected"; } }?> >25</option>
                            <option value='50' <?php if(isset($records)){  if ($records == "50"){ echo "selected"; } }?> >50</option>
                            <option value='100' <?php if(isset($records)){  if ($records == "100"){ echo "selected"; } }?> >100</option>
                          </select>
                    </div>
                    <div class="form-group">
                            <?php       
                                if(isset($records)){ 
                                if ($records == 10 || $records == 25 || $records == 50 || $records == 100)
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/managereports/email_tracking'); ?>" class="btn btn-default" style="height:33px;">Reset</a>
                                    <?php
                                }
                                }
                            ?>
                       
                        <button id="recordsbtn" class="btn btn-primary" type="submit" style="height:33px; display: none;">Records</button>
                    </div>
                </form>
            </div>
        </div>


        <table class="table table-bordered" style="margin-bottom: 10px; ">
            <?php
            $display = 0;
            if(isset($users_orders_data)){
                if(count($users_orders_data)>0){
                    //echo "<pre>"; print_r($users_orders_data) ;exit;
                    foreach ($users_orders_data as $users_orders){
                        ?>
                        <tr>
                            <th>Sr.#</th> 
                            <th>Order No.</th>
                            <!-- <th>Flyer title</th> -->
                            <th>Flyer</th>
                            <!-- <th>Price</th> -->
                            <th>Dated</th>
                            <th>Emails Sent</th>
                            <th colspan="4" rowspan="2" style="padding: 0!important; background-color: white;">
                                <table class="table table-bordered" style="width: 100%; border: none">
                                    <tr>
                                        <th>Opens</th>
                                        <th>Reads</th>
                                        <th>Open Rate</th>
                                        <th>Last Run</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $users_orders->daorder_count; ?></td>
                                        <td><?php echo $users_orders->daorder_count; ?></td>
                                        <td><?php echo number_format($users_orders->daorder_count/$users_orders->daorder_total_emails*100,1); ?>%</td>
                                        <td>0</td>
                                    </tr>
                                </table>
                            </th>
                            <th>Status</th>
                            <th>Action</th>
                            <!-- <th>Created By</th> -->

                            <!-- <th>Action</th> -->
                        </tr>

                        <tr>
                            <td width="50px"><?php echo ++$start ?></td> 
                            <td><?php echo $users_orders->daorder_id; ?><br>
                                <?php echo (format($users_orders->daorder_user_id, 'user')!=""?format($users_orders->daorder_user_id, 'user'):$users_orders->daorder_user_id); ?>
                            </td>
                            <!-- <td><?php echo $users_orders->flyer_title; ?></td> -->
                            <td>
                                <a href="<?php echo base_url(); ?>/public/upload/user_flyer_store/<?php echo ($users_orders->flyer_image!=""?$users_orders->flyer_image:"placeholder-image-thumb.jpg"); ?>" data-lightbox="example-<?php echo $users_orders->daorder_id; ?>">
                                    <img src="<?php echo base_url(); ?>/public/upload/user_flyer_store/_thumbs/thumb_<?php echo ($users_orders->flyer_image!=""?$users_orders->flyer_image:"placeholder-image-thumb.jpg"); ?>"style="width: 100px!important; height: 140px">
                                </a>
                            </td>

                            <!-- <td><?php echo "$".$users_orders->daorder_grand_total; ?></td> -->
                            <td>
                                <?php $date = date_create($users_orders->daorder_date); echo date_format($date, 'm/d/Y'); //echo ' '.date_format($date, 'Hi').'hrs'; ?>
                            </td>
                            <td><?php echo $users_orders->daorder_total_emails; ?></td>
                            <td><?php
                                if($users_orders->daorder_status == 0){
                                    echo "<div style='width: 35px; height: 35px; background-color: yellow; border-radius: 50%;'> </div>";
                                }elseif($users_orders->daorder_status == 1){
                                    echo "<div style='width: 35px; height: 35px; background-color: green; border-radius: 50%;'> </div>";
                                }elseif($users_orders->daorder_status == 2){
                                    echo "<div style='width: 35px; height: 35px; background-color: red; border-radius: 50%;'> </div>";
                                } ?>
                            </td>
                            <!-- <td><?php echo (format($users_orders->daorder_user_id, 'user')!=""?format($users_orders->daorder_user_id, 'user'):$users_orders->daorder_user_id); ?></td> -->
                            <td style="text-align:center" width="200px">
                                <?php
                                    echo '<a style="margin:2px;" class="btn btn-primary" href="'.site_url('admin/managereports/email_track_read/'.$users_orders->daorder_id).'" >
                                    <i class="fa fa-bars"></i>
                                    </a>';
                                ?>
                            </td>

                        </tr>
                        <?php
                    }
                }else{ ?>
                    <tr>
                        <td>
                            <br>
                            <h4>You don't have any orders yet, continue here to <a href="<?=site_url('order')?>">Create Your First Order</a></h4>
                        </td>
                    </tr>
                <?php }
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
</div>
<script>
 $('#records').on('change', function(e){
        e.preventDefault();
        $('#recordsbtn').trigger('click');

    });
</script>