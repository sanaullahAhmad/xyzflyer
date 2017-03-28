<div id="page-wrapper" >
    <div class="page-content">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Flyer Logs</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php //echo anchor(site_url('admin_activity/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('admin_activity/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('admin_activity/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">Sr.#</th>
		    <th>Action Type</th>
            <!-- <th>Activity Type</th> -->
		    <th>Activity Text</th>
		    <th>Activity Date</th>
		    <th>Admin Id</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($admin_activity_data as $admin_activity)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo format($admin_activity->action_type, 'action_type') ?></td>
           <!--  <td><?php //echo format($admin_activity->activity_type, 'activity_type') ?></td> -->
		    <td><?php echo $admin_activity->activity_text ?></td>
		    <td><?php  $date = date_create($admin_activity->activity_date); echo date_format($date, 'm-d-Y Hi') .'hrs';?></td>
		   <td><a href="<?php echo base_url(); ?>admins/read/<?php echo $admin_activity->admin_id; ?>"><?php echo (format($admin_activity->admin_id, 'admin_name')!=""?format($admin_activity->admin_id, 'admin_name'):$admin_activity->admin_id);?></a></td>
		    <td style="text-align:center" width="200px">
			<?php
             if(xyzAccesscontrol('activity_managment','Read')==TRUE){
			echo anchor(site_url('admin_activity/read/'.$admin_activity->activity_id),'View');
			echo ' | ';
            } if(xyzAccesscontrol('activity_managment','Delete')==TRUE){
			//echo anchor(site_url('admin_activity/update/'.$admin_activity->activity_id),'Update');
			//echo ' | ';
			echo anchor(site_url('admin_activity/delete/'.$admin_activity->activity_id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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