<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <h2 style="margin-top:0px">Admin Detail</h2>
        <table class="table">
	    <tr><td>Admin Username</td><td><?php echo $admin_username; ?></td></tr>
		  <tr><td>Admin First Name</td><td><?php echo $admin_firstname; ?></td></tr>
	    <tr><td>Admin Last Name</td><td><?php echo $admin_lastname; ?></td></tr>
	    <tr><td>Admin Email</td><td><?php echo $admin_email; ?></td></tr>
	    <tr><td>Created/ Updated: </td><td><?php $date = date_create($admin_date); echo date_format($date, 'm-d-Y'); ?></td></tr>
	    <tr><td>Admin Type</td>
        <td>
        <?php if($admin_type==0) echo 'Super Admin'; elseif($admin_type==1) echo 'Templates Designer';
            elseif($admin_type==2) echo 'Accounts Manager'; elseif($admin_type==3) echo 'Sales Manager'; else echo "Undefined" ?>
        </td>
        </tr>
	    <tr><td>Admin Status</td><td><?php if($admin_status==0) echo 'Closed'; else echo 'Active'; ?></td></tr>
		<!-- <tr><td>Admin State</td><td><?php  echo $state; ?></td></tr> -->
	    <tr><td colspan="2"> <div>
                        <?php  if(isset($_SERVER['HTTP_REFERER'])) {
										 echo anchor($_SERVER["HTTP_REFERER"], 'Go Back', 'class="btn btn-primary" style="margin-left: 2px;margin-bottom: 5px;"');    
							    }
                        ?>
                    </div></td></tr>
	</table>
        </div>