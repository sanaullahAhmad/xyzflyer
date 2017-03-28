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
        <h2>Admi_coupons List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Coupon Title</th>
		<th>Coupon Description</th>
		<th>Coupon Start Date</th>
		<th>Coupone End Date</th>
		<th>Coupon Type</th>
		<th>Coupon Value</th>
		<th>Coupon Maximum Uses</th>
		<th>Coupon Apply Once</th>
		<th>Coupon New Signups</th>
		<th>Coupon Apply On Existing Client Only</th>
		<th>Coupon Date</th>

		<th>Admin Id</th>

            </tr><?php
            foreach ($admin_coupons_data as $admin_coupons)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $admin_coupons->coupon_title ?></td>
		      <td><?php echo $admin_coupons->coupon_description ?></td>
		      <td><?php echo $admin_coupons->coupon_start_date ?></td>
		      <td><?php echo $admin_coupons->coupone_end_date ?></td>
		      <td><?php echo format($admin_coupons->coupon_type, 'coupon_type') ?></td>
		      <td><?php echo $admin_coupons->coupon_value ?></td>
		      <td><?php echo $admin_coupons->coupon_maximum_uses ?></td>
		      <td><?php echo format($admin_coupons->coupon_apply_once, 'BOOL') ?></td>
		      <td><?php echo format($admin_coupons->coupon_new_signups, 'BOOL') ?></td>
		      <td><?php echo format($admin_coupons->coupon_apply_on_existing_client_only, 'BOOL') ?></td>
		      <td><?php echo $admin_coupons->coupon_date ?></td>
		      <td><?php echo format($admin_coupons->admin_id, 'admin') ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>