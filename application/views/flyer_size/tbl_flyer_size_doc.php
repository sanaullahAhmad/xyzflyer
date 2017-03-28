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
        <h2>Tbl_flyer_size List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Flyer Size Title</th>
		<th>Flyer Size Width</th>
		<th>Flyer Size Height</th>
		<th>Flyer Size Status</th>
		<th>Flyer Size Date</th>
		<th>ModifiedDate</th>
		<th>AdminId</th>

            </tr><?php
            foreach ($flyer_size_data as $flyer_size)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $flyer_size->flyer_size_title ?></td>
		      <td><?php echo $flyer_size->flyer_size_width ?></td>
		      <td><?php echo $flyer_size->flyer_size_height ?></td>
		      <td><?php echo $flyer_size->flyer_size_status ?></td>
		      <td><?php echo $flyer_size->flyer_size_date ?></td>
		      <td><?php echo $flyer_size->modifiedDate ?></td>
		      <td><?php echo format($flyer_size->adminId,'admin') ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>