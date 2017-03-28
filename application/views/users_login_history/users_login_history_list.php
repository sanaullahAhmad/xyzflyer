<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Users Login History</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php // echo anchor(site_url('users_login_history/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('users_login_history/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('users_login_history/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">Sr.#</th>
		    <th>Ip</th>
		    <th>Browser Info</th>
		    <th>Referrer</th>
		    <th>Date</th>
		    <th>User Name</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($users_login_history_data as $users_login_history)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo (filter_var($users_login_history->history_ip, FILTER_VALIDATE_IP)==true?'<a href="http://geomaplookup.net/?ip='.$users_login_history->history_ip.'" target="_blank">'.$users_login_history->history_ip.'</a>':$users_login_history->history_ip);  ?></td>
		    <td><?php echo $users_login_history->history_browser_info ?></td>
		    <td><?php echo $users_login_history->history_referer ?></td>
		    <td><?php $date = date_create($users_login_history->history_date); echo date_format($date, 'm-d-Y Hi').'hrs';?></td>
		    <td><a href="<?php echo base_url(); ?>users/read/<?php echo $users_login_history->user_id; ?>"><?php echo (format($users_login_history->user_id, 'user_name')!=""?format($users_login_history->user_id, 'user_name'):$users_login_history->user_id);?></a></td>
		    <td style="text-align:center" width="200px">
			<?php 
            if(xyzAccesscontrol('activity_managment','Read')==TRUE){
			echo '<a style="margin:2px;" class="btn btn-primary" href="'.site_url('users_login_history/read/'.$users_login_history->histoy_id).'" data-toggle="tooltip" title="View"><i class="fa fa-bars"></i></a>';
             }
            if(xyzAccesscontrol('activity_managment','Delete')==TRUE){
			echo '<a style="margin:2px;" class="btn btn-danger" href="'.site_url('users_login_history/delete/'.$users_login_history->histoy_id).'" onclick="javasciprt: return confirm(\'Are You Sure ?\')" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>';
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