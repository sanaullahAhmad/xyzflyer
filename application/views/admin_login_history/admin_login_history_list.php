<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Admin Login History</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php //echo anchor(site_url('admin_login_history/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('admin_login_history/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('admin_login_history/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">Sr.#</th>
		    <th>Ip</th>
		    <th>Browser Info</th>
		    <th>Referer</th>
		    <th>Date</th>
		    <th>Admin Name</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($admin_login_history_data as $admin_login_history)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo (filter_var($admin_login_history->history_ip, FILTER_VALIDATE_IP)==true?'<a href="http://geomaplookup.net/?ip='.$admin_login_history->history_ip.'" target="_blank">'.$admin_login_history->history_ip.'</a>':$admin_login_history->history_ip);  ?></td>
		    <td><?php echo $admin_login_history->history_browser_info ?></td>
		    <td><?php echo $admin_login_history->history_referer ?></td>
		    <td><?php $date = date_create($admin_login_history->history_date); echo date_format($date, 'm-d-Y Hi').'hrs';?></td>
		    <td><a href="<?php echo base_url(); ?>admins/read/<?php echo $admin_login_history->admin_id; ?>"><?php echo (format($admin_login_history->admin_id, 'admin_name')!=""?format($admin_login_history->admin_id, 'admin_name'):$admin_login_history->admin_id);?></a></td>
		    <td style="text-align:center" width="200px">
			<?php 
            if(xyzAccesscontrol('activity_managment','Read')==TRUE){
			echo '<a style="margin:2px;" class="btn btn-primary" href="'.site_url('admin_login_history/read/'.$admin_login_history->histoy_id).'" data-toggle="tooltip" title="View"><i class="fa fa-bars"></i></a>';
             }
             if(xyzAccesscontrol('activity_managment','Delete')==TRUE){
			echo '<a style="margin:2px;" class="btn btn-danger" href="'.site_url('admin_login_history/delete/'.$admin_login_history->histoy_id).'" onclick="javasciprt: return confirm(\'Are You Sure ?\')" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>';
             }
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>
</div>