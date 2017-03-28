<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <div class="row">
            <div class="col-md-5">
        <h2 style="margin-top:0px">Users Login History <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">History Ip <?php echo form_error('history_ip') ?></label>
            <input type="text" class="form-control" name="history_ip" id="history_ip" placeholder="History Ip" value="<?php echo $history_ip; ?>" />
        </div>
	    <div class="form-group">
            <label for="history_browser_info">History Browser Info <?php echo form_error('history_browser_info') ?></label>
            <textarea class="form-control" rows="3" name="history_browser_info" id="history_browser_info" placeholder="History Browser Info"><?php echo $history_browser_info; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="tinytext">History Referer <?php echo form_error('history_referer') ?></label>
            <input type="text" class="form-control" name="history_referer" id="history_referer" placeholder="History Referer" value="<?php echo $history_referer; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">History Date <?php echo form_error('history_date') ?></label>
            <input type="text" class="form-control" name="history_date" id="history_date" placeholder="History Date" value="<?php echo $history_date; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">User Id <?php echo form_error('user_id') ?></label>
            <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User Id" value="<?php echo $user_id; ?>" />
        </div>
	    <input type="hidden" name="histoy_id" value="<?php echo $histoy_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('users_login_history') ?>" class="btn btn-default">Cancel</a>
	</form>
</div></div></div>