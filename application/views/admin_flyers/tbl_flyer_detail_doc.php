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
        <h2>Tbl_flyer_detail List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Flyer Title</th>
		<th>Flyer Image</th>

		<th>Flyer Status</th>
		<th>Flyer Approved</th>
		<th>Flyer Approved By</th>
		<th>Flyer Creation Date</th>
		<th>Admin Id</th>


            </tr><?php
            foreach ($admin_flyers_data as $admin_flyers)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $admin_flyers->flyer_title ?></td>
		      <td><?php echo $admin_flyers->flyer_image ?></td>
		      <td><?php echo $admin_flyers->flyer_status ?></td>
		      <td><?php echo $admin_flyers->flyer_approved ?></td>
		      <td><?php echo format($admin_flyers->flyer_approved_by, 'admin') ?></td>
		      <td><?php echo $admin_flyers->flyer_creation_date ?></td>
		      <td><?php echo format($admin_flyers->admin_id, 'admin') ?></td>

                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>