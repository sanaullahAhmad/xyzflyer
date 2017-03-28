<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-5">
        <h2 style="margin-top:0px">Orders <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Flyer Id <?php echo form_error('daorder_flyer_id') ?></label>
            <input type="text" class="form-control" name="daorder_flyer_id" id="daorder_flyer_id" placeholder="Flyer Id" value="<?php echo $daorder_flyer_id; ?>" />
        </div>
	   <!--  <div class="form-group">
                   <label for="int">User Flyer Id <?php //echo form_error('daorder_user_flyer_id') ?></label>
                   <input type="text" class="form-control" name="daorder_user_flyer_id" id="daorder_user_flyer_id" placeholder="User Flyer Id" value="<?php //echo $daorder_user_flyer_id; ?>" />
               </div> -->
	    <div class="form-group">
            <label for="varchar">Price <?php echo form_error('daorder_price') ?></label>
            <input type="text" class="form-control" name="daorder_price" id="daorder_price" placeholder="Price" value="<?php echo $daorder_price; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Date <?php echo form_error('daorder_date') ?></label>
            <input type="text" class="form-control" name="daorder_date" id="daorder_date" placeholder="Date" value="<?php echo $daorder_date; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Status <?php echo form_error('daorder_status') ?></label>
            <input type="text" class="form-control" name="daorder_status" id="daorder_status" placeholder="Status" value="<?php echo $daorder_status; ?>" />
        </div>
	 <!--   <div class="form-group">
            <label for="daorder_rejection_reason">Rejection Reason <?php echo form_error('daorder_rejection_reason') ?></label>
            <textarea class="form-control" rows="3" name="daorder_rejection_reason" id="daorder_rejection_reason" placeholder="Rejection Reason"><?php echo $daorder_rejection_reason; ?></textarea>
        </div>-->
	    <div class="form-group">
            <label for="int">User Id <?php echo form_error('daorder_user_id') ?></label>
            <input type="text" class="form-control" name="daorder_user_id" id="daorder_user_id" placeholder="User Id" value="<?php echo $daorder_user_id; ?>" />
        </div>
	   
	    <input type="hidden" name="daorder_id" value="<?php echo $daorder_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('admin_orders') ?>" class="btn btn-default">Cancel</a>
	</form>
</div>
</div>
</div>