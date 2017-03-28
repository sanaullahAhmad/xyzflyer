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
        <h2>Tbl_flyer_tags List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Flyer Tags Title</th>
		<th>Flyer Tags Status</th>
		<th>Flyer Tags Date</th>
		<th>Admin Id</th>

            </tr><?php
            foreach ($flyer_tags_data as $flyer_tags)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $flyer_tags->flyer_tags_title ?></td>
		      <td><?php echo $flyer_tags->flyer_tags_status ?></td>
		      <td><?php echo $flyer_tags->flyer_tags_date ?></td>
		      <td><?php echo format($flyer_tags->admin_id, 'admin') ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>