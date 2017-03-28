<div id="page-wrapper" >
    <div class="page-content">
        <div class="row">
            <div class="col-md-5">
        <h2 style="margin-top:0px">Users Activity <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Action Type <?php echo form_error('action_type') ?></label>
            <input type="text" class="form-control" name="action_type" id="action_type" placeholder="Action Type" value="<?php echo $action_type; ?>" />
        </div>
	    <div class="form-group">
            <label for="activity_text">Activity Text <?php echo form_error('activity_text') ?></label>
            <textarea class="form-control" rows="3" name="activity_text" id="activity_text" placeholder="Activity Text"><?php echo $activity_text; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="datetime">Activity Date <?php echo form_error('activity_date') ?></label>
            <input type="text" class="form-control" name="activity_date" id="activity_date" placeholder="Activity Date" value="<?php echo $activity_date; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">User Id <?php echo form_error('user_id') ?></label>
            <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User Id" value="<?php echo $user_id; ?>" />
        </div>
	    <input type="hidden" name="activity_id" value="<?php echo $activity_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('users_activity') ?>" class="btn btn-default">Cancel</a>
	</form>
</div></div></div>