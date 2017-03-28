<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-5">
        <h2 style="margin-top:0px">Flyer Size <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Flyer Size Title <?php echo form_error('flyer_size_title') ?></label>
            <input type="text" class="form-control" required  name="flyer_size_title" id="flyer_size_title" placeholder="Flyer Size Title" value="<?php echo $flyer_size_title; ?>" />
        </div>
	    <div class="form-group">
            <label for="float">Flyer Size Width <?php echo form_error('flyer_size_width') ?></label>
            <input type="text" class="form-control" required  name="flyer_size_width" id="flyer_size_width" placeholder="Flyer Size Width" value="<?php echo $flyer_size_width; ?>" />
        </div>
	    <div class="form-group">
            <label for="float">Flyer Size Height <?php echo form_error('flyer_size_height') ?></label>
            <input type="text" class="form-control" required  name="flyer_size_height" id="flyer_size_height" placeholder="Flyer Size Height" value="<?php echo $flyer_size_height; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Flyer Size Status <?php echo form_error('flyer_size_status') ?></label>
            <?php $v = $flyer_size_status; ?>
            <select name="flyer_size_status" required id="" class="form-control">
                <option value="">Select</option>
                <option value="Active" <?php if($v=='Active')echo 'selected'; ?>>Active</option>
                <option value="Inactive" <?php if($v=='Inactive')echo 'selected'; ?>>Inactive</option>
            </select>
        </div>

        <input type="hidden" class="form-control" name="flyer_size_date" id="flyer_size_date" placeholder="Flyer Size Date" value="<?php if(!$flyer_size_date) echo date("Y-m-d H:i:s"); else echo $flyer_size_date; ?>" />
        <?php if($this->uri->segment(2)=='update'){?>
        <input type="hidden" class="form-control" name="modifiedDate" id="modifiedDate" placeholder="ModifiedDate" value="<?php echo Date('Y-m-d H:i:s');?>" />
        <input type="hidden" class="form-control" name="modifiedBy" id="modifiedBy" placeholder="modifiedBy" value="<?php $d = $this->session->userdata('admin_data'); echo $d['pk_admin_id']; ?>" />
        <input type="hidden" name="pk_flyer_size_id" value="<?php echo $pk_flyer_size_id; ?>" /> 
        <?php } else {?>
        <input type="hidden" class="form-control" name="adminId" id="adminId" placeholder="AdminId" value="<?php if(!$adminId) {$d = $this->session->userdata('admin_data'); echo $d['pk_admin_id']; }else echo $adminId; ?>" />
        <?php } ?>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('flyer_size') ?>" class="btn btn-default">Cancel</a>
	</form>
</div>
</div>
    </div>