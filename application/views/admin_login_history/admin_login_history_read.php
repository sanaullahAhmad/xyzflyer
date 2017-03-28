<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-5">
        <h2 style="margin-top:0px">Login History Read</h2>
        <table class="table">
	    <tr><td>History Ip</td><td><?php echo $history_ip; ?></td></tr>
	    <tr><td>History Browser Info</td><td><?php echo $history_browser_info; ?></td></tr>
	    <tr><td>History Referer</td><td><?php echo $history_referer; ?></td></tr>
	    <tr><td>History Date</td><td><?php $date = date_create($history_date); echo date_format($date, 'm-d-Y');?></td></tr>
	    <tr><td>Admin Name</td><td><?php echo (format($admin_id, 'admin_name')!=""?format($admin_id, 'admin_name'):$admin_id); ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('admin_login_history') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</div>
</div>
    </div>