<?php
$this->load->helper('slider_helper');
?>
<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
			
        <div class="col-md-5">
		
        <h2 style="margin-top:0px">Orders Detail</h2>
        <?php /*echo "<pre>";
      print_r($order_data);*///exit;?>
		<div class="col-md-12 text-center" style="margin-bottom: 14px;">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        <table class="table">
        <tr><td>Order #</td><td><?php echo $order_data->order_id; ?></td></tr>
	    <tr><td>Flyer Title</td><td><?php echo $order_data->flyer_title; ?></td></tr>
        <tr><td>Property info</td><td><?php echo $order_data->propertyAddress; ?></td></tr>
        <tr><td>Agent Info</td><td><?php echo $order_data->agentAddress; ?></td></tr>
	    <tr><td>Price</td><td><?php echo "$".$order_data->price; ?></td></tr>
	    <tr><td>Coupen Discount</td><td><?php echo $order_data->discount; ?></td></tr>
	    <tr><td>Coupon Type </td><td><?php if($order_data->coupen_type==0){echo 'Percentage';}else if($order_data->coupen_type==1){echo 'Fixed';}else if($order_data->coupen_type==2){echo 'Override';}else{echo 'N/A';}  ?></td></tr>
	    <?php if($order_data->coupen_type==2){?>
	    <tr><td>Total Price</td><td><?php echo "$".$order_data->discount;?></td></tr>
	    <?php }else {?>
	    <tr><td>Total Price</td><td><?php echo (($order_data->price-$order_data->discount) > 0?"$".($order_data->price-$order_data->discount):'FREE');?></td></tr>
	    <?php }?>
	    <tr><td>Total Agents</td><td><?php echo number_format($order_data->total_agents); ?></td></tr>
	    <tr><td>Date</td><td><?php $date = date_create($order_data->order_date); echo date_format($date, 'm-d-Y'); ?></td></tr>
	    <tr><td>Selected States and Counties</td><td><?php foreach ($order_detail as $orderdetail){
		 echo $orderdetail->daorder_state." - ".(get_county($orderdetail->daorder_countyFips)!= null? get_county($orderdetail->daorder_countyFips):$orderdetail->daorder_countyFips)." : ".$orderdetail->daorder_agents."<br>";
															
														} ?></td></tr>
	    <tr><td>Status</td><td><?php 
		if($order_data->status==1){echo 'Approved';}else if($order_data->status==0){echo 'Pending';}else if($order_data->status==2){echo 'Rejected';}else if($order_data->status==-1){echo 'Trashed';}else {echo 'N/A';}
		
		
		 ?></td>
		 </tr>
     <tr>
      <td>Receipt</td>
      <td><a href="<?php echo base_url('users_orders/order_detail/'. $order_data->order_id);?>" class="btn btn-danger" target="_blank">Receipt</a></td>
     </tr>
     <tr>
      <td>Email Receipt to client</td>
      <td>
        <a href="<?= base_url('users_orders/order_detail_email?email='. $user_data->userEmail.'&orderId='.$order_data->order_id); ?>" target="_blank" class="btn btn-danger">Email Reciept</a>
      </td>
     </tr>
     <tr>
      <td>Email User Flyer</td>
      <td>
        <a href="<?php echo base_url('users_orders/email_me/admin/'.$order_data->image);?>" class="btn btn-primary" target="_blank">Email Me</a>
        <br><br>
        <a href="<?= base_url('users_orders/order_detail_email?email='. $user_data->userEmail.'&orderId='.$order_data->order_id); ?>" target="_blank" class="btn btn-primary">Email Reciept</a>
      </td>
     </tr>
     <tr>
       <td>
         Email Tracking
       </td>
       <td>
         <a href="<?= base_url('admin/managereports/email_track_read/'.$order_data->user_id)?>" class="btn btn-primary" style="margin-top: 4px;width: 100px;">View</a>
       </td>
     </tr>
		 <tr><td>Action</td><td><?php if(xyzAccesscontrol('order_managment','Status')==TRUE) {
                    if ($order_data->status == 1) {
                        echo '<a style="margin:4px;" id="process_' . $order_data->order_id . '" class="processOrder btn green-jungle" href="javascript:void(0);" data-toggle="modal" data-target="#processModel" title="Approved" ><i class="fa fa-thumbs-o-up"></i></a>';

                    } else if ($order_data->status == 2) {
                        echo '<a style="margin:4px;" id="process_' . $order_data->order_id . '" class="processOrder btn grey-mint" href="javascript:void(0);" data-toggle="modal" data-target="#processModel" title="Rejected" ><i class="fa fa-thumbs-o-down"></i></a>';


                    } else if ($order_data->status == 0) {
                        echo '<a style="margin:4px;" id="process_' . $order_data->order_id . '" class="processOrder btn yellow-gold" href="javascript:void(0);" data-toggle="modal" data-target="#processModel" title="Pending" ><i class="fa fa-hourglass-end"></i></a>';

                    } else {
                        echo '<a style="margin:4px;" id="process_' . $order_data->order_id . '" class="processOrder btn yellow-gold" href="javascript:void(0);" data-toggle="tooltip" title="Error" ><i class="fa fa-pencil"></i></a>';
                    }
                } ?></td></tr>
	    <tr><td>User Name</td><td><?php echo $order_data->FirstName." ".$order_data->LastName; ?></td></tr>
	    <?php if($this->session->userdata('message')){ ?>
	    <tr><td></td><td><a href="javascript:void(0);" onclick="history.go(-2);" class="btn btn-default">Cancel</a></td></tr>
		<?php }else{ ?>
		 <tr><td></td><td><a href="javascript:void(0);" onclick="history.go(-1);" class="btn btn-default">Cancel</a></td></tr>
		<?php } ?>
	</table>
</div>
<div class="col-md-6">
 <h2 style="margin-top:0px">Flyer Image</h2>
<img src="<?php echo base_url();?>public/upload/user_flyer_store/<?php echo $order_data->image; ?>" width="100%"/>
</div>
</div>
</div>
<div id="processModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order Processing</h4>
      </div>
      <div class="modal-body" id="processOrder_body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
//Update order status
  $(function() {
    $(document).on('click', '.processOrder', function() {
        var orderID=$(this).attr("id");
        var order_id = orderID.split('_');
        $.ajax({
        url: "<?php echo base_url(); ?>admin_orders/check_order",
        type : 'POST',
        data : {"oid":order_id[1]},
        success: function(result){
          if(result=='Error'){
          $("#processOrder_body").html('<div class="alert-alert">There is an error !</div>');
          setTimeout(function(){
           window.location.href = "<?php echo base_url(); ?>admin_orders";
           },3000);
            }else{
            $("#processOrder_body").html(result);
          }
        }
     });
    });
  }); 
  $(function() {
    $(document).on('change', '.form-check-input', function() {
    var checkedId = $(this).attr("id");
        if(checkedId=='reject'){
            $("#reason").prop('disabled', false);
            $("#rejreason").show('slow');
        }else{
            $("#reason").prop('disabled', true);
            $("#rejreason").hide('slow');
           
        }
    });
  });

</script>