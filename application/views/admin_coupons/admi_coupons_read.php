<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <div class="row">
            <div class="col-md-6">
        <h2 style="margin-top:0px">Coupon Detail</h2>
        <table class="table">
	    <tr><td>Title</td><td><?php echo $coupon_title; ?></td></tr>
	    <tr><td>Description</td><td><?php echo $coupon_description; ?></td></tr>
      <tr><td>Coupon Code</td><td><?php echo $coupon_code; ?></td></tr>
	    <tr><td>Start Date</td><td><?php $date = date_create($coupon_start_date); echo date_format($date, 'm-d-Y');?></td></tr>
	    <tr><td>Expiry Date</td><td><?php $date = date_create($coupone_end_date); echo date_format($date, 'm-d-Y');?></td></tr>
	    <tr><td>Type</td><td><?php if($coupon_type==0) echo "Percentage"; else if($coupon_type=='1') echo "Fixed Amount"; elseif($coupon_type=='2') echo "Price Override"; else echo "Undefined"; ?></td></tr>
	    <tr><td>Status</td><td><?php if($coupon_status) echo "Activated"; else echo "Inactive"; ?>  <?php  
          if(strtotime($coupone_end_date) < time() ){
            echo '<span class="alert-danger"> Expired</span>';
            }
        ?> &nbsp;  <?php 
        if(isset($coupin_uses) && $coupin_uses!=""){ 
          if($coupin_uses[0]['total'] >=$coupon_maximum_uses){
             echo '<span class="alert-danger"> Use limit complete</span>';
            }
          }
      ?></td></tr>
	    <tr><td>Value</td><td><?php echo $coupon_value; ?></td></tr>
	    <tr><td>Maximum Uses</td><td><?php echo $coupon_maximum_uses; ?></td></tr>
	    <tr><td>Maximum Used</td><td class="alert-info">
       <?php 
        if(isset($coupin_uses) && $coupin_uses!=""){ 
          echo ($coupin_uses[0]['total']). ' times';
          }
        else {
          echo 'No use found';
          }
      ?>
      </td></tr>
	    <tr><td>Apply Once</td><td><?php if($coupon_apply_once) echo "Yes"; else echo "No"; ?></td></tr>
	    <tr><td>New Signups</td><td><?php if($coupon_new_signups) echo "Yes"; else echo "No"; ?></td></tr>
	    <tr><td>Apply On Existing Client Only</td><td><?php if($coupon_apply_on_existing_client_only) echo "Yes"; else echo "No"; ?></td></tr>
	    <tr><td>Created Date</td><td><?php if(!$coupon_date) echo "Nil"; else $date = date_create($coupon_date); echo date_format($date, 'm-d-Y');?></td></tr>
	    <tr><td>Modified Date</td><td><?php if(!$coupon_modified_date) echo "Nil"; else echo $coupon_modified_date; ?></td></tr>
	    <tr><td>Modified by (Admin)</td><td><?php if(!$coupon_modified_admin) echo "Nil"; else echo format($coupon_modified_admin, 'admin_name'); ?></td></tr>
	    <tr><td>Created by (Admin)</td><td><?php echo format($admin_id, 'admin_name'); ?></td></tr>
	    <tr><td colspan="2"><a href="<?php echo site_url('admin_coupons') ?>" class="btn btn-default">&laquo; Go Back</a></td></tr>
		</table>
       </div>
       <div class="col-md-5">
       <?php 
        if(isset($coupin_uses) && $coupin_uses!=""){ ?>
        <h3 style="margin-top:0px">Coupon (<?php echo $coupin_uses[0]['coupon_code']; ?>) Uses History</h3>
        <table class="table" width="100%">
        <tr><th>Used by</th><th>Order</th><th>Used Date</th></tr>
        <?php
        	foreach($coupin_uses as $uses){
        		$date = date_create($uses['used_date']);
        		echo "<tr><td><a href='".base_url()."users/read/".$uses['userId']."'>".(format($uses['userId'], 'user_name')!=""?format($uses['userId'], 'user_name'):$uses['userId'])."</td><td><a href='".base_url()."admin_orders/read/".$uses['order_id']."'>View</a></td><td>".date_format($date, 'm-d-Y Hi')."hrs</td></tr>";
        	}
        ?>
       
       </table>
        <?php }else {echo '<h2 style="margin-top:0px" class="alert-warning">This Coupon is not used!</h2>';} ?>
        </div></div>

       </div>