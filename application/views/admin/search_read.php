<script>
$(document).ready(function() {
$('#mytable').DataTable( {
"paging":   false,
"ordering": false,
"info":     false,
"bFilter":     false
} );
} );
</script>
<?php 
      $this->load->helper('slider_helper');
?>

<div id="page-wrapper">
	<div class="page-content">
		<section>
			<?	echo $this->breadcrumbs->show(); ?>
			</section>
	<?php if(!empty($users_data)){?>
								
	<div class="row">
		<div class="col-md-12">
			
			<div class="panel panel-info">
				<div class="panel-heading">Users Info</div>
					<div class="panel-body">
						<div class="row">
						
						<div class="col-md-12">
							
							<?php if(!empty($users_data)){ 
								  foreach($users_data as $user){
							?>
								<div class="row">
									<div class="col-md-12">	
										<div class="col-md-6"> Username </div>
										<div class="col-md-6"><?php echo $user->username;  ?></div>	
									</div>	 
								</div>
								
								<div class="row">
									<div class="col-md-12">	
										<div class="col-md-6"> Full Name </div>
										<div class="col-md-6"><?php echo $user->userFirstName." ".$user->userLastName; ?></div>
											
									</div>	 
								</div>
							
								<div class="row">
									<div class="col-md-12">	
										<div class="col-md-6"> City </div>
										<div class="col-md-6"><?php echo $user->city;?></div>
											
									</div>	 
								</div>
								
								<div class="row">
									<div class="col-md-12">	
										<div class="col-md-6"> Email </div>
										<div class="col-md-6"><?php $client_email = $user->userEmail; echo $user->userEmail; ?></div>
											
									</div>	 
								</div>
								
								<div class="row">
									<div class="col-md-12">	
										<div class="col-md-6"> State </div>
										<div class="col-md-6"><?php echo $user->state; ?></div>
											
									</div>	 
								</div>
								
								<div class="row">
									<div class="col-md-12">	
										<div class="col-md-6"> Status </div>
										<div class="col-md-6"><?php if($user->userStatus == 1){	echo "Active"; }elseif($user->userStatus == 2){ echo "Suspended"; }elseif($user->userStatus == 0){ echo "Unverified"; }?></div>
											
									</div>	 
								</div>
								
								<div class="row">
									<div class="col-md-12">	
										<div class="col-md-6"> Created </div>
										<div class="col-md-6"><?php $date = date_create($user->userCreationDate); echo date_format($date, 'm-d-Y'); ?></div>
											
									</div>	 
								</div>
								 <?php } }else{ ?>
								<div class="row">
									<div class="col-md-12">	
										No Data Found
									</div>	 
								</div>
								
							<?php } ?>
							
							</div>
						</div>
									
					</div>
				</div>
		</div>
	
		 <div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">Order</div>
				<div class="panel-body" style="overflow: auto; max-height: 500px;">
					<div class="row">
					 <?php if(!empty($order_data)){  
							foreach($order_data as $order){ ?>
						<div class="row">
							
								<div class="col-md-3"><img src="<?php echo base_url();?>public/upload/user_flyer_store/<?php echo $order->userFlyer; ?>" height="100%" width="100%"></div>
									
								<div class="col-md-3">	
								<table class="table table-bordered" style="margin-bottom: 10px">
									<tr><td><span class="badge badge-info"> Order ID </span></td><td><span class="badge badge-info"><?php echo $order->order_id; ?></span></td> </tr>
									<tr><td>Price</td><td><?php echo "$".$order->grand_total; ?></td> </tr>
									<tr><td>Total Agents</td><td><?php echo $order->total_agents; ?></td> </tr>
									<tr><td>Coupen Discount</td><td><?php if($order->coupen_type==0){echo $order->discount."%"; }else{ echo $order->discount;} ?></td> </tr>
									<tr><td>Coupon Type</td><td><?php if($order->coupen_type==0){echo 'Percentage';}else if($order->coupen_type==1){echo 'Fixed';}else if($order->coupen_type==2){echo 'Override';}else{echo 'N/A';}  ?></td> </tr>
									<?php if($order->coupen_type==2){?><tr><td>Total Price</td><td><?php echo $order->discount;?></td></tr>
									<?php }else {?>
									<tr><td>Total Price</td><td><?php echo "$".(($order->price-$order->discount) > 0? $order->grand_total:'FREE');?></td></tr>
									<?php }?>
									<tr><td>Date</td><td><?php $date = date_create($order->order_date); echo date_format($date, 'm-d-Y'); ?></td> </tr>
									<tr><td>Status</td><td><?php if($order->status==1){echo 'Approved';}else if($order->status==0){echo 'Pending';}else if($order->status==2){echo 'Rejected';}else if($order->status==-1){echo 'Trashed';}else {echo 'N/A';} ?></td> </tr>
								</table>	
								 
								</div>	 
								
								<div class="col-md-3">	
								<table class="table table-bordered" style="margin-bottom: 10px">
									<tr><td><span class="badge badge-info"> Payment info </span></td><td><span class="badge badge-info"><?php echo $order->order_id; ?></span></td> </tr>
									<tr><td>Payment Status</td><td><?php echo $order->payment_status; ?></td> </tr>
									<tr><td>Amount</td><td><?php echo $order->amount; ?></td> </tr>
									<tr><td>Payment Date</td><td><?php $date = date_create($order->pay_date); echo date_format($date, 'm-d-Y'); ?></td> </tr>
									<tr><td>Receipt</td><td><a href="<?php echo base_url(); ?>users_orders/order_detail/<?=$order->order_id?>" class="btn btn-danger" target="_blank">Receipt</a>
									<tr><td>Email Receipt to client</td><td><a href="<?php echo base_url(); ?>users_orders/order_detail_email?email=<?php echo $client_email."&orderId=".$order->order_id;?>" target="_blank" class="btn btn-danger" target="_blank">Email Reciept</a>
									</td>
									<tr><td>Email User Flyer</td><td>
							<a href="<?php echo base_url(); ?>users_orders/email_me/admin/<?php echo $order->userFlyer; ?>" class="btn btn-primary" style="margin-top: 4px;width: 100px;" target="_blank">Email Me </a>
							<a href="<?php echo base_url(); ?>users_orders/email_client?email=<?php echo $client_email."&flyer=".$order->userFlyer; ?>" class="btn btn-primary" style="margin-top: 4px;" target="_blank">Email client</a>
									</td> </tr>
									</td>
									</tr>
								</table>	
								 
								</div>	 
								<div class="col-md-3">	
								<table class="table table-bordered" style="margin-bottom: 10px">
									<tr><td><span class="badge badge-info"> Emails stats </span></td><td><span class="badge badge-info"><?php echo $order->order_id; ?></span></td> </tr>
									<tr><td>Total Sent</td><td><?php if($order->status==1){echo $order->total_agents;}else{ echo "0"; } ?></td></tr>
									<tr><td>Opens</td><td><?php $email_stat=get_emails_stats($order->order_id); echo $email_stat; ?></td> </tr>
									<tr><td>Reads</td><td><?php $email_stat=get_emails_stats($order->order_id); echo $email_stat; ?></td> </tr>
									<tr><td>Open Rate</td><td><?php if($email_stat > 0){ $percentage = $email_stat/$order->total_agents*100 ;echo round($percentage, 1, PHP_ROUND_HALF_UP)."%";}else{ echo "0%";} ?></td> </tr>
									<tr><td>Email Tracking</td><td><a href="<?php echo base_url(); ?>admin/managereports/email_track_read/<?php echo $order->order_id; ?>" class="btn btn-primary" style="margin-top: 4px;width: 100px;">View</a></td> </tr>
								</table>	
								 
								</div>	 
								
							
						</div>
						<hr>
						<?php }  
						 }else{ ?>
						 <div class="row">
							<div class="col-md-12">	
								<div> No Data Found </div>
							</div>
						</div>
							<?php } ?>			
					</div>
				</div>
			</div>
		</div>
					 <div class="col-md-12">
						<div class="panel panel-info">
							<div class="panel-heading">Activity History</div>
								<div class="panel-body" style="overflow: auto; max-height: 500px;">
									
										<?php if(!empty($UserActivity)){ ?>
											<div class="row">
												<div class="col-md-12">	
													<div class="col-md-6"><span class="badge badge-info"> Date </span> </div>
													<div class="col-md-6"><span class="badge badge-info">Activity</span></div>
														
												</div>	 
											</div>
											<hr> 
										<?php	foreach ($UserActivity as $activity){ ?>
											
											<!--	<tr><td>Action Type</td><td><?php   echo $activity->activity_type; ?></td></tr> -->
										<div class="row">
											<div class="col-md-12">	
												<div class="col-md-6"><?php $date = date_create($activity->activity_date); echo date_format($date, 'm-d-Y'); ?></div>
												<div class="col-md-6"><?php echo $activity->activity_text; ?></div>
													
											</div>	 
										</div>
										<hr>
										<?php } }else{ ?>
											<div> No Data Found </div>
										<?php } ?>
														
								</div>
						</div>
						<div class="row">
					<div class="col-md-12">	
						  <?php  if($button_url) {
										 echo anchor($button_url, 'Go Back', 'class="btn btn-primary" style="margin-left: 2px;margin-bottom: 5px;"');    
							    }
                        ?>
						</div>	 
					</div>		
					</div>
			
								
									
		</div>		
	</div>
	
	<?php } ?>	
</div>
</div>