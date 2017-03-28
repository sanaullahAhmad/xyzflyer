<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <div class="row">
            <div class="col-md-5">
        <h2 style="margin-top:0px">Admin Activity Detail</h2>
        <table class="table">
	    <tr><td>Action Type</td><td><?php echo $action_type; ?></td></tr>
	    <tr><td>Activity Text</td><td><?php echo $activity_text; ?></td></tr>
	    <tr><td>Activity Date</td><td><?php $date = date_create($activity_date); echo date_format($date, 'm-d-Y');?></td></tr>
	    <tr><td>Admin Name</td><td><?php  echo (format($admin_id, 'admin_name')!=""?format($admin_id, 'admin_name'):$admin_id);?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('admin_activity') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</div>
</div>
</div>