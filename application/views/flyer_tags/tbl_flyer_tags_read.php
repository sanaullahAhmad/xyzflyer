<div id="page-wrapper" >
    <div class="page-content">
		<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-5">
        <h2 style="margin-top:0px">Flyer Tags Read</h2>
        <table class="table">
	    <tr><td>Flyer Tags Title</td><td><?php echo $flyer_tags_title; ?></td></tr>
	    <tr><td>Flyer Tags Status</td><td><?php echo $flyer_tags_status; ?></td></tr>
	    <tr><td>Flyer Tags Date</td><td><?php $date = date_create($flyer_tags_date); echo date_format($date, 'm-d-Y'); ?></td></tr>
	    <tr><td>Admin Name</td><td><a href="<?php echo base_url('admins/read/'.$admin_id); ?>"><?php echo $admin_username?></a></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('flyer_tags') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
  </div>
  </div>
  </div>