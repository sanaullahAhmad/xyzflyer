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
        <h2>Admin Activity List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>Sr.#</th>
		<th>Action Type</th>
		<th>Activity Text</th>
		<th>Activity Date</th>
		<th>Admin Name</th>

            </tr><?php
            foreach ($admin_activity_data as $admin_activity)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo format($admin_activity->action_type, 'action_type');?></td>
		      <td><?php echo $admin_activity->activity_text ?></td>
		      <td><?php $date = date_create($admin_activity->activity_date); echo date_format($date, 'm-d-Y Hi').'hrs'; ?></td>
		      <td><?php echo format($admin_activity->admin_id, 'admin_name') ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>