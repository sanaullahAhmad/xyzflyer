<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <h2 style="margin-top:0px">Users Read</h2>
        <table class="table">
	    <tr><td>Username</td><td><?php echo $username; ?></td></tr>
	    <tr><td>FirstName</td><td><?php echo $userFirstName; ?></td></tr>
	    <tr><td>LastName</td><td><?php echo $userLastName; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $userEmail; ?></td></tr>
	    <tr><td>Status</td><td><?php if($userStatus == 1){	echo "Active"; }elseif($userStatus == 2){ echo "Suspended"; }elseif($userStatus == 0){ echo "Unverified"; }?></td></tr>
	    <tr><td>State</td><td><?php echo $state; ?></td></tr>
		 <tr><td>City</td><td><?php echo $city; ?></td></tr>
		  <tr><td>Hear About Us</td><td><?php $string = rtrim($hereabout, ','); echo  $string; ?></td></tr>
	    <tr><td>CreationDate</td><td><?php $date = date_create($userCreationDate); echo date_format($date, 'm-d-Y'); ?></td></tr>
	    <tr><td>Admin Name</td><td><?php echo $admin_id; ?></td></tr>
	    <tr><td>Modified Date</td><td><?php echo $modified_date; ?></td></tr>
	    <tr><td>Modified By</td><td><?php echo $modified_by; ?></td></tr>
		
	    <tr><td></td><td> <div>
                        <?php  if(isset($_SERVER['HTTP_REFERER'])) {
										 echo anchor($_SERVER["HTTP_REFERER"], 'Go Back', 'class="btn btn-primary" style="margin-left: 2px;margin-bottom: 5px;"');    
							    }
                        ?>
                    </div></td></tr>
	</table>
</div>