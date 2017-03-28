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
        <h2>Tbl_orders List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Daorder Flyer Id</th>
		<!-- <th>Daorder User Flyer Id</th> -->
		<th>Daorder Price</th>
		<th>Daorder Date</th>
		<th>Daorder Status</th>
		<th>Daorder Rejection Reason</th>
		<th>Daorder User Id</th>
		<th>Daoder Admin Id</th>

            </tr><?php
            foreach ($admin_orders_data as $admin_orders)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $admin_orders->daorder_flyer_id ?></td>
		     <!--  <td><?php //echo $admin_orders->daorder_user_flyer_id ?></td> -->
		      <td><?php echo $admin_orders->daorder_price ?></td>
		      <td><?php echo $admin_orders->daorder_date ?></td>
		      <td><?php echo format($admin_orders->daorder_status, 'order_status') ?></td>
		      <td><?php echo $admin_orders->daorder_rejection_reason ?></td>
		      <td><?php echo format($admin_orders->daorder_user_id, 'user') ?></td>
		      <td><?php echo format($admin_orders->daoder_admin_id, 'admin') ?></td>

                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>