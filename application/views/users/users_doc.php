<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/datepicker.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap-datepicker.js') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important;
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important;
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Users List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>Sr.#</th>
				<th>Username</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>State</th>
				<th>City</th>
				<th>Status</th>
				<th>CreationDate</th>
				<th>Admin Name</th>

            </tr><?php
					foreach ($users_data as $users){
						if($users->state == ''){
							$state= "N/A";
						}else{
							$state= $users->state;
						}
                ?>				
                <tr>
			      <td><?php echo ++$start ?></td>
			      <td><?php echo $users->username ?></td>
			      <td><?php echo $users->userFirstName ?></td>
			      <td><?php echo $users->userLastName ?></td>
			      <td><?php echo $users->userEmail ?></td>
				  <td><?php echo $state ?></td>
				   <td><?php echo $users->city ?></td>
			      <td><?php echo format($users->userStatus, 'user_status') ?></td>
			      <td><?php echo $users->userCreationDate ?></td>
			      <td><?php echo format($users->admin_id, 'admin_name') ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>