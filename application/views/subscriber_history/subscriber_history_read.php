<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-5">
        <h2 style="margin-top:0px">Subscriber Detail</h2>
        <table class="table">
	    <tr><td>Subscriber Name</td><td><?php echo $subName; ?></td></tr>
	    <tr><td>Subscriber Email</td><td><?php echo $subEmail; ?></td></tr>
	    <tr><td>Subscriber Country</td><td><?php echo $subCountry; ?></td></tr>
	    <tr><td>Creation Date</td><td><?php $date = date_create($subCreationDate); echo date_format($date, 'm-d-Y');?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('Admin_subscriber') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</div></div></div>