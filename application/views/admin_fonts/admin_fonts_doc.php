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
        <h2>Admin_fonts List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>FontTitle</th>
		<th>FontUrl</th>
		<th>CreatedDate</th>
		<th>ModifiedDate</th>
		<th>AdminId</th>

            </tr><?php
            foreach ($admin_fonts_data as $admin_fonts)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $admin_fonts->fontTitle ?></td>
		      <td><?php echo $admin_fonts->fontUrl ?></td>
		      <td><?php echo $admin_fonts->createdDate ?></td>
		      <td><?php echo $admin_fonts->modifiedDate ?></td>
		      <td><?php echo format($admin_fonts->adminId, 'admin') ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>