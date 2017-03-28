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
        <h2>Subscriber Activity</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
        <th>Sr.#</th>
		<th>Ip</th>
		<th>Browser Info</th>
		<th>Email</th>
		<th>Referred</th>
		<th>Date</th>
            </tr><?php
            foreach ($subscriber_activity_data as $subscriber_activity)
            {
                ?>
                <tr>
				  <td><?php echo ++$start ?></td>
				  <td><?php echo $subscriber_activity->history_ip ?></td>
				  <td><?php echo $subscriber_activity->history_browser_info ?></td>
				   <td><?php echo $subscriber_activity->subEmail ?></td>
				  <td><?php echo $subscriber_activity->history_referer ?></td>
				  <td><?php $date = date_create($subscriber_activity->history_date); echo date_format($date, 'm-d-Y Hi').'hrs';?></td>
		    
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>