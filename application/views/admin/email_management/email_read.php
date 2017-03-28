<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <h2 style="margin-top:0px">Email Detail</h2>
        <table class="table">
			
			<tr><td>First Name</td><td><?php echo $First_Name; ?></td></tr>
			<tr><td>Last Name</td><td><?php echo $Last_Name; ?></td></tr>
			
			<tr><td>email address</td><td><?php echo $email_address; ?></td></tr>
		
			<tr><td>State</td><td><?php echo $State; ?></td></tr>
			<tr><td>County</td><td><?php echo $County; ?></td></tr>
			<tr><td>City</td><td><?php echo $City; ?></td></tr>
			<tr><td>Subscription Status</td><td>
			
			<?php echo ($unsubscribed == 0 ? "Subscribed" : "Unsubscribed"); ?>
			
			
			</td></tr>
			</tr>
		   
			<!-- <tr><td>Admin State</td><td><?php  echo $state; ?></td></tr> -->
			<tr><td colspan="2"> <div>
							<?php  if(isset($_SERVER['HTTP_REFERER'])) {
											 echo anchor($_SERVER["HTTP_REFERER"], 'Go Back', 'class="btn btn-primary" style="margin-left: 2px;margin-bottom: 5px;"');    
									}
							?>
						</div></td></tr>
		</table>
        </div>