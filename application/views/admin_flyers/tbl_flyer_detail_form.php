<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-5">
        <h2 style="margin-top:0px">Flyer <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Flyer Title <?php echo form_error('flyer_title') ?></label>
            <input type="text" class="form-control" name="flyer_title" id="flyer_title" placeholder="Flyer Title" value="<?php echo $flyer_title; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Flyer Image <?php echo form_error('flyer_image') ?></label>
            <input type="text" class="form-control" name="flyer_image" id="flyer_image" placeholder="Flyer Image" value="<?php echo $flyer_image; ?>" readonly />
        </div>
	    <div class="form-group">
            <label for="int">Flyer Image Size <?php echo form_error('flyer_image_size') ?></label>
            <input type="text" class="form-control" name="flyer_image_size" id="flyer_image_size" placeholder="Flyer Image Size" value="<?php echo $flyer_image_size; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Flyer Created Image <?php echo form_error('flyer_created_image') ?></label>
            <input type="text" class="form-control" name="flyer_created_image" id="flyer_created_image" placeholder="Flyer Created Image" value="<?php echo $flyer_created_image; ?>"readonly />
        </div>
	    <div class="form-group">
            <label for="varchar">Flyer Json File <?php echo form_error('flyer_json_file') ?></label>
            <input type="text" class="form-control" name="flyer_json_file" id="flyer_json_file" placeholder="Flyer Json File" value="<?php echo $flyer_json_file; ?>" readonly />
        </div>
	    <div class="form-group">
            <label for="enum">Flyer Status <?php echo form_error('flyer_status') ?></label>
            <input type="text" class="form-control" name="flyer_status" id="flyer_status" placeholder="Flyer Status" value="<?php echo $flyer_status; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Flyer Approved <?php echo form_error('flyer_approved') ?></label>
            <input type="text" class="form-control" name="flyer_approved" id="flyer_approved" placeholder="Flyer Approved" value="<?php echo $flyer_approved; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Flyer Approved By <?php echo form_error('flyer_approved_by') ?></label>
            <input type="text" class="form-control" name="flyer_approved_by" id="flyer_approved_by" placeholder="Flyer Approved By" value="<?php echo $flyer_approved_by; ?>" />
        </div>
	   
	    <div class="form-group">
            <label for="int">Admin Name <?php echo form_error('admin_id') ?></label>
            <input type="text" class="form-control" name="admin_name" id="admin_name" placeholder="Admin Name" value="<?php echo $admin_name; ?>" readonly />
			 <input type="hidden" class="form-control" name="admin_id" id="admin_id" placeholder="Admin Id" value="<?php echo $admin_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Modified By <?php echo form_error('modified_by') ?></label>
            <input type="text" class="form-control" name="modified_by" id="modified_by" placeholder="Modified By" value="<?php echo $modified_by; ?>" />
        </div>
	   
	    <input type="hidden" name="pk_flyer_detail_id" value="<?php echo $pk_flyer_detail_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('admin_flyers') ?>" class="btn btn-default">Cancel</a>
	</form>
    </div>
    </div>
    </div>