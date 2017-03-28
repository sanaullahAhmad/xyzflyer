<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-5">
        <h2 style="margin-top:0px">Fonts <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">FontTitle <?php echo form_error('fontTitle') ?></label>
            <input type="text" class="form-control" name="fontTitle" id="fontTitle" placeholder="FontTitle" value="<?php echo $fontTitle; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">FontUrl <?php echo form_error('fontUrl') ?></label>
            <input type="text" class="form-control" name="fontUrl" id="fontUrl" placeholder="FontUrl" value="<?php if($fontUrl) echo $fontUrl; else echo '#' ?>" />
        </div>
	    <input type="hidden" name="createdDate" id="createdDate"  value="<?php if(!$createdDate) echo date("Y-m-d H:i:s"); else echo $createdDate; ?>" />
        <?php if($this->uri->segment(2)=='create'){?>
	    
        
        <input type="hidden" name="adminId" id="adminId" value="<?php $admin = $this->session->userdata('admin_data'); echo $admin['pk_admin_id']; ?>" />
            
        <?php } ?>
	    <input type="hidden" name="fontId" value="<?php echo $fontId; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('admin_fonts') ?>" class="btn btn-default">Cancel</a>
	</form>
</div>
</div>
    </div>