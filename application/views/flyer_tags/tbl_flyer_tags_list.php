<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
            <h2 style="margin-top:0px">Flyer Tags List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('flyer_tags/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('flyer_tags/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('flyer_tags'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Flyer Tags Title</th>
		<th>Flyer Tags Status</th>
		<th>Flyer Tags Date</th>
		<th>Admin Name</th>
		<th>Action</th>
            </tr><?php
            foreach ($flyer_tags_data as $flyer_tags)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $flyer_tags->flyer_tags_title ?></td>
			<td><?php echo $flyer_tags->flyer_tags_status ?></td>
			<td><?php $date = date_create($flyer_tags->flyer_tags_date); echo date_format($date, 'm-d-Y'); ?></td>
			<td><a href="<?php echo base_url('admins/read/'.$flyer_tags->admin_id); ?>"><?php echo $flyer_tags->admin_firstname." ".$flyer_tags->admin_lastname?></a></td>
			<td style="text-align:center" width="200px">
				<?php
                if(xyzAccesscontrol('flyer_tags','Read')==TRUE) {
				echo '<a style="margin:2px;" class="btn btn-primary" href="'.site_url('flyer_tags/read/'.$flyer_tags->pk_flyer_tags).'" data-toggle="tooltip" title="View"><i class="fa fa-bars"></i></a>';
                }
                if(xyzAccesscontrol('flyer_tags','Edit')==TRUE){
                echo '<a style="margin:2px;" class="btn btn-warning" href="'.site_url('flyer_tags/update/'.$flyer_tags->pk_flyer_tags).'" data-toggle="tooltip" title="update" ><i class="fa fa-pencil"></i></a>';
                }
                if(xyzAccesscontrol('flyer_tags','Delete')==TRUE) {
                    echo '<a style="margin:2px;" class="btn btn-danger" href="' . site_url('flyer_tags/delete/' . $flyer_tags->pk_flyer_tags) . '" onclick="javasciprt: return confirm(\'Are You Sure ?\')" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>';
                }
                ?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('flyer_tags/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('flyer_tags/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
</div>