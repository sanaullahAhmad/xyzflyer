<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-5">
        <h2 style="margin-top:0px">Flyer Size Detail</h2>
        <table class="table">
	    <tr><td>Flyer Size Title</td><td><?php echo $flyer_size_title; ?></td></tr>
	    <tr><td>Flyer Size Width</td><td><?php echo $flyer_size_width; ?></td></tr>
	    <tr><td>Flyer Size Height</td><td><?php echo $flyer_size_height; ?></td></tr>
	    <tr><td>Flyer Size Status</td><td><?php echo $flyer_size_status; ?></td></tr>
	    <tr><td>Flyer Size Date</td><td><?php  $date = date_create($flyer_size_date); echo date_format($date, 'm-d-Y');?></td></tr>
	  
	    <tr><td>Created By</td><td> <a href="<?php echo base_url('admins/read/'.$adminId); ?>"><?php echo (format($adminId, 'admin_name')!=""?format($adminId, 'admin_name'):$adminId); ?></a></td></tr>

	    <tr><td colspan="2"><a href="<?php echo site_url('flyer_size') ?>" class="btn btn-default">&laquo; Go Back</a></td></tr>
	</table>
</div>
</div>
    </div>