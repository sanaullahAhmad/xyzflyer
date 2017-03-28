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
        <h2>Admin_svgs List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>SvgTitle</th>
		<th>SvgFileUrl</th>
		<th>CreatedDate</th>
		<th>AdminId</th>

            </tr><?php
            foreach ($admin_svgs_data as $admin_svgs)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $admin_svgs->svgTitle ?></td>
		      <td><?php echo $admin_svgs->svgFileUrl ?></td>
		      <td><?php echo $admin_svgs->createdDate ?></td>
		      <td><?php echo format($admin_svgs->adminId, 'admin') ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>