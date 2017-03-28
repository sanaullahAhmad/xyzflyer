<div id="page-wrapper" >
    <div class="page-content">
		<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-5">

        <h2 style="margin-top:0px">Flyer Tags <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Flyer Tags Title <?php echo form_error('flyer_tags_title') ?></label>
            <input type="text" class="form-control" name="flyer_tags_title" id="flyer_tags_title" placeholder="Flyer Tags Title" value="<?php echo $flyer_tags_title; ?>" required />
        </div>
	    <div class="form-group">
            <label for="enum">Flyer Tags Status <?php echo form_error('flyer_tags_status') ?></label>
           <?php $v = $flyer_tags_status; ?>
            <select name="flyer_tags_status" required id="" class="form-control">
                <option value="">Select</option>
                <option value="Active" <?php if($v=='Active')echo 'selected'; ?>>Active</option>
                <option value="Inactive" <?php if($v=='Inactive')echo 'selected'; ?>>Inactive</option>
            </select>
        </div>
            <input type="hidden" name="flyer_tags_date" id="flyer_tags_date"  value="<?php if(!$flyer_tags_date) echo date("Y-m-d H:i:s"); else echo $flyer_tags_date; ?>" />


            <input type="hidden" name="admin_id" id="admin_id" value="<?php $admin = $this->session->userdata('admin_data'); echo $admin['pk_admin_id']; ?>" />

	    <input type="hidden" name="pk_flyer_tags" value="<?php echo $pk_flyer_tags; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('flyer_tags') ?>" class="btn btn-default">Cancel</a>
	</form>
 
 </div>
 </div>
 </div>