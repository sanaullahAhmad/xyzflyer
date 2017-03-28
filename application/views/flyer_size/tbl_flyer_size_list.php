<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Flyer Size List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('flyer_size/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('flyer_size/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('flyer_size/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">Sr.#</th>
		    <th>Title</th>
		    <th>Width</th>
		    <th>Height</th>
		    <th>Status</th>
		    <th>Created By</th>
		    <th>Date Created</th>
		    <!-- <th>Modified Date</th> -->
		    
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($flyer_size_data as $flyer_size)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $flyer_size->flyer_size_title ?></td>
		    <td><?php echo $flyer_size->flyer_size_width ?></td>
		    <td><?php echo $flyer_size->flyer_size_height ?></td>
		    <td><?php echo $flyer_size->flyer_size_status ?></td>
		    <td><a href="<?php echo base_url('admins/read/'.$flyer_size->adminId); ?>"><?php echo (format($flyer_size->adminId, 'admin_name')!=""?format($flyer_size->adminId, 'admin_name'):$flyer_size->adminId); ?></a></td>
		    <td><?php $date = date_create($flyer_size->flyer_size_date); echo date_format($date, 'm-d-Y'); ?></td>
		    <!-- <td><?php echo $flyer_size->modifiedDate ?></td> -->
		     
		    <td style="text-align:center" width="200px">
			<?php
			if(xyzAccesscontrol('flyer_sizes','Read')==TRUE) {
			echo '<a style="margin:2px;" class="btn btn-primary" href="'.site_url('flyer_size/read/'.$flyer_size->pk_flyer_size_id).'" data-toggle="tooltip" title="View"><i class="fa fa-bars"></i></a>';
			}
			if(xyzAccesscontrol('flyer_sizes','Edit')==TRUE){
			echo '<a style="margin:2px;" class="btn btn-warning" href="'.site_url('flyer_size/update/'.$flyer_size->pk_flyer_size_id).'" data-toggle="tooltip" title="update" ><i class="fa fa-pencil"></i></a>';
			}
			if(xyzAccesscontrol('flyer_sizes','Delete')==TRUE) {
				echo '<a style="margin:2px;" class="btn btn-danger" href="' . site_url('flyer_size/delete/' . $flyer_size->pk_flyer_size_id) . '" onclick="javasciprt: return confirm(\'Are You Sure ?\')" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>';
			}
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
</div>