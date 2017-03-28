<div class="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-4">
        <h2 style="margin-top:0px">Flyer Detail: <small><?=$pk_flyer_detail_id?></small></h2>
        <table class="table">
	    <tr><td>Flyer Title/ ID</td><td><?php if($flyer_title!='') echo $flyer_title; else echo 'Nil'; echo '/ '.$pk_flyer_detail_id; ?></td></tr>
	    <tr><td>Flyer Size</td><td><?php echo $flyer_image_size; ?></td></tr>
	    <tr><td>Flyer Json File</td><td><?php if($flyer_json_file!='') echo $flyer_json_file; else echo 'Not found'; ?></td></tr>
	    <tr><td>Flyer Status</td><td><?php echo $flyer_status; ?></td></tr>
	    <tr><td>Flyer Approved</td><td><?php echo $flyer_approved; ?></td></tr>
	    <tr><td>Flyer Approved By</td><td><?php if($flyer_approved_by!='') echo $flyer_approved_by; else echo 'Approval not required'; ?></td></tr>
	    <tr><td>Flyer Creation Date</td><td><?php $date = date_create($flyer_creation_date); echo date_format($date, 'm-d-Y'); ?></td></tr>
	    <tr><td>Created By</td><td><a href="<?=base_url('admins/read/'.$admin_id)?>"><?=$admin?></a></td></tr>
	    <tr><td>Modified By</td><td><?php if($modified_by!='') echo $modified_by; else echo 'Not Modified'; ?></td></tr>
	    <tr><td>Modified Date</td><td><?php if($modified_date!=''){$date = date_create($modified_date); echo date_format($date, 'm-d-Y');} else {echo 'Not Modified';} ?></td></tr>
		 <tr><td>Flyer Used</td><td><?php echo (format($pk_flyer_detail_id,'countflyers')+1); ?> times</td></tr>
	    <tr><td colspan="2"><a href="<?php echo site_url('admin_flyers') ?>" class="btn btn-default">&laquo; Go Back</a></td></tr>
	</table>
	</div>
	<div class="col-md-4">
	<h4>Uploaded Image:</h4>
	<a target="_blank" href="<?php echo base_url('public/upload/flyer_images/'.$flyer_image); ?>">
		<img src="<?php echo base_url('public/upload/flyer_images/'.$flyer_image); ?>" style="width: 100%" />
	</a>
	</div>

	<div class="col-md-4">
	<h4>Created Image:</h4>
	<?php 
	if($flyer_created_image){
	?>
	<a target="_blank" href="<?php echo base_url('public/upload/flyers/'.$flyer_created_image); ?>">
		<img src="<?php echo base_url('public/upload/flyers/'.$flyer_created_image); ?>" style="width: 100%" />
	</a>
	<?php }else {?>
		<img src="<?php echo base_url('imgs/blank_flyer.jpg'); ?>" style="width: 100%" />
	<?php } ?>
	</div>