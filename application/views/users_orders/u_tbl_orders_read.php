<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-5">
        <h2 style="margin-top:0px">Orders Detail</h2>
        <table class="table">
        <tr><td>Order #</td><td><?php echo $order_data->order_id; ?></td></tr>
	    <tr><td>Flyer Title</td><td><?php echo $order_data->flyer_title; ?></td></tr>
        <tr><td>Property info</td><td><?php echo $order_data->propertyAddress; ?></td></tr>
        <tr><td>Agent Info</td><td><?php echo $order_data->agentAddress; ?></td></tr>
	    <tr><td>Price</td><td><?php echo "$".$order_data->price.".00"; ?></td></tr>
	    <tr><td>Coupen Discount</td><td><?php echo $order_data->discount; ?></td></tr>
	    <tr><td>Coupon Type </td><td><?php if($order_data->coupen_type==0){echo 'Percentage';}else if($order_data->coupen_type==1){echo 'Fixed';}else if($order_data->coupen_type==2){echo 'Override';}else{echo 'N/A';}  ?></td></tr>
	    <?php if($order_data->coupen_type==2){?>
	    <tr><td>Total Price</td><td><?php echo "$".$order_data->discount.".00";?></td></tr>
	    <?php }else {?>
	    <tr><td>Total Price</td><td><?php echo (($order_data->price-$order_data->discount) > 0?"$".($order_data->price-$order_data->discount).".00":'FREE');?></td></tr>
	    <?php }?>
	    <tr><td>Total Agents</td><td><?php echo $order_data->total_agents; ?></td></tr>
	    <tr><td>Date</td><td><?php $date = date_create($order_data->order_date); echo date_format($date, 'm-d-Y'); ?></td></tr>
	    <tr><td>Selected States</td><td><?php echo $order_data->states; ?></td></tr>
	    <tr><td>Status</td><td><?php if($order_data->status==1){echo 'Approved';}else if($order_data->status==0){echo 'Pending';}else if($order_data->status==2){echo 'Rejected';}else if($order_data->status==-1){echo 'Trashed';}else {echo 'N/A';} ?></td></tr>
	    <tr><td>User Name</td><td><?php echo $order_data->FirstName." ".$order_data->LastName; ?></td></tr>
	   
	    <tr><td></td><td><a href="javascript:void(0);" onclick="history.go(-1);" class="btn btn-default">Cancel</a></td></tr>
	</table>
</div>
<div class="col-md-6">
 <h2 style="margin-top:0px">Flyer Image</h2>
<img src="<?php echo base_url();?>public/upload/user_flyer_store/<?php echo $order_data->image; ?>" width="100%"/>
</div>
</div>
</div>