<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-5">
        <h2 style="margin-top:0px">View Shape</h2>
        <table class="table">
	    <tr><td>Title</td><td><?php echo $svgTitle; ?></td></tr>
	    <tr><td>File url</td><td><a target="_blank" href="<?php echo base_url('uploads/svgs/'.$svgFileUrl); ?>">See Uploaded File</a></td></tr>
	    <tr><td>Created Date</td><td><?php $date = date_create($createdDate); echo date_format($date, 'm-d-Y'); ?></td></tr>
	    <tr><td>Last Updated</td><td><?php $date = date_create($modifiedDate); echo date_format($date, 'm-d-Y'); ?></td></tr>
	    <!-- <tr><td>Created By: </td><td><?php echo $adminId; ?></td></tr> -->
	    <tr><td colspan="2"><a href="<?php echo site_url('admin_svgs') ?>" class="btn btn-default">&laquo; Go Back</a></td></tr>
	</table>
</div>
</div>
    </div>