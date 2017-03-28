<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-6">
        <h2 style="margin-top:0px"><?php echo $button ?></h2>
		
    <form action="<?php echo $action; ?>" method="post" name="addAdminform">
		 <input type="hidden" name="length" value="10">
		 
		<div class="form-group">
            <label for="varchar">Email <?php echo form_error('email') ?></label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" required />
        </div>
	   
	    <input type="hidden" name="id" value="<?php echo $id; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('Admin_newsletter') ?>" class="btn btn-default">Cancel</a>
	</form>
  </div>
  </div>
    </div>

