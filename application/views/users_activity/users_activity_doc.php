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
        <h2>Users Activity List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
				<th>Sr.#</th>
				<th>Action Type</th>
				<th>Activity Text</th>
				<th>Activity Date</th>
				<th>User Name</th>

            </tr><?php
            foreach ($users_activity_data as $users_activity)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo format($users_activity->action_type, 'action_type'); ?></td>
		      <td><?php echo $users_activity->activity_text; ?></td>
		      <td><?php $date = date_create($users_activity->activity_date); echo date_format($date, 'm-d-Y Hi').'hrs'; ?></td>
		      <td><?php echo format($users_activity->user_id, 'user_name'); ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>