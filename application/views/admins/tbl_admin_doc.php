<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
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
        <h2>Admin List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>Sr.#</th>
        		<th>Username</th>
				<th>Firstname</th>
				<th>Lastname</th>
        		<th>Email</th>
        		<th>Date</th>
        		<th>Type</th>
        		<th>Status</th>
            </tr><?php
            foreach ($admins_data as $admins)
            {
				
                ?>
				<tr>
				  <td><?php echo ++$start ?></td>
				  <td><?php echo $admins->admin_username; ?></td>
				  <td><?php echo $admins->admin_firstname; ?></td>
				  <td><?php echo $admins->admin_lastname; ?></td>
				  <td><?php echo $admins->admin_email ?></td>
				  <td><?php $date = date_create($admins->admin_date); echo date_format($date, 'm-d-Y'); ?></td>
				  <td><?php echo format($admins->admin_type, 'admin_type'); ?></td>
				  <td><?php echo format($admins->admin_status, 'admin_status'); ?></td>
				</tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>