<? $this->load->view("emails/style1/incs/header"); ?>

<style>
.info {
text-align: justify;
	
}

</style>
<?php

$this->load->helper('slider_helper');

?>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
		  
            <td class="header-lg">
              Thank you For your order.
            </td>
          </tr>
			
			<tr> 
				<td>
					<img src="https://xyzflyers.com/public/new_frontend/img/left_side.png" width="300" align="middle" style="margin:9px 0px 5px -45px;">
					</td>
				</tr>
			
					<td>
						<table align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
							<tr>
								<td style="vertical-align: top;">
									<img src="<?php echo base_url(); ?>public/upload/user_flyer_store/<?=$order->image; ?>"  style="width: 100px;">
									<p><a href="<?php echo base_url('Newdesign/pdf_image/').'/'.$order->image?>"> Click here to download a <br>pdf copy of your flyer</a></p>
								</td>
									<td>
										<table  cellspacing="10" cellpadding="5">
												<tr>
													<td class="info">
														<b>Order#</b>
													</td>
													<td class="info">
														<?php  
															
															$date= date('Y', strtotime($order->order_date));
															echo sprintf('%03d', date('z', strtotime($order->order_date))).$date."-".$order->order_id;
																
														 ?>
													</td>
												</tr>
												<tr>
													<td class="info">
														<b>Product</b>
													</td>
													<td class="info">
														<p><?php echo "Flyer"." ".$order->flyer_id;?></p>
													</td>
												</tr>
												<tr>
													<td class="info" style="vertical-align: top;">
														<b>Delivery area</b>
													</td>
													<td class="info">
														<?php foreach ($order_detail as $orderdetail){
																
															 echo $orderdetail->daorder_state." - ".get_county($orderdetail->daorder_countyFips)." : ".$orderdetail->daorder_agents."<br>";
															
														} ?>
													</td>
												</tr>
												<tr>
													<td class="info">
														<b>Total Sent</b>
													</td>
													<td class="info">
														<p> <?php echo number_format($order->total_agents);?></p>
													</td>
												</tr>
										</table>				
										
									</td>		
								<td style="vertical-align: top;">
								Date :  <?php 	$date = date_create($order->order_date);
												$date1= date_format($date, 'm-d-Y');
												$dateObj = DateTime::createFromFormat('m-d-Y', $date1);
												echo $dateObj->format('M d, Y');
								 ?>
								</td>
					
							</tr>			
							<tr>
								<td>
									<p><b> Email sent </b>: <?php $email_stat=get_emails_stats($order->order_id); echo $email_stat; ?> </p>
									<p><b> opens </b>: <?php $email_stat=get_emails_stats($order->order_id); echo $email_stat; ?> </p>
									<p><b> open rate </b>: <?php if($email_stat > 0){ $percentage = $email_stat/$order->total_agents*100 ; echo round($percentage, 0, PHP_ROUND_HALF_UP)."%";}else{ echo "0%";} ?> </p>
								</td>
								<td>
									<table cellspacing="10" cellpadding="5">
										<tr>
											<tr>
												<td class="info">
													<b>Client Name</b>
												</td>
												<td class="info">
													<?=$order->FirstName." ".$order->LastName;?>
												</td>
											</tr>
												<tr>
													<td class="info">
														<b>Company Name</b>
													</td>
													<td class="info">
														<?=$order->company; ?>
													</td>
												</tr>
											<tr>
												<td class="info">
													<b>Billing Adress</b>
												</td>
												<td class="info">
													<?php if(isset($order) && !empty($order->usr_state)){ echo $order->usr_address; } ?>
												</td>
											</tr>
											
										</tr>
									</table>
								</td>
								<td>
								<table cellspacing="10" cellpadding="5">
										<tr>
											<tr>
												<td class="info">
													<b>Sub total</b>
												</td>
												<td class="info">
													<?if($order){ echo "$".$order->amount;}?>
												</td>
											</tr>
												<tr>
													<td class="info">
														<b>Credits</b>
													</td>
													<td class="info">
														<?="$0.00" ?>
													</td>
												</tr>									
											<?php 
												if(!empty($order)){	
												if($order->usr_state == "CA"){ ?>
														<tr>
															<td>
																<b>CA tax 8.5%</b>
															</td>
															<td>
															<?php   $percentage= (8.5/100)*$order->amount;
																	echo "$". round( $percentage, 1, PHP_ROUND_HALF_UP);?>
															</td>
														</tr>
												<?php } }?>
										</tr>
								</table>
								</td>
							</tr>
						</table>
					</td>
        </table>
      </center>
    </td>
  </tr>
 <? $this->load->view("emails/style1/incs/footer"); ?>