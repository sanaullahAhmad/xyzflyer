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
        <h2>Admin login history</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>Sr.#</th>
		<th>Ip</th>
		<th>Browser Info</th>
		<th>Referer</th>
		<th>Date</th>
		<th>Admin Name</th>

            </tr><?php
            foreach ($admin_login_history_data as $admin_login_history)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $admin_login_history->history_ip ?></td>
		      <td><?php echo $admin_login_history->history_browser_info ?></td>
		      <td><?php echo $admin_login_history->history_referer ?></td>
		      <td><?php $date = date_create($admin_login_history->history_date); echo date_format($date, 'm-d-Y Hi').'hrs';?></td>
		      <td><?php echo format($admin_login_history->admin_id, 'admin_name') ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>