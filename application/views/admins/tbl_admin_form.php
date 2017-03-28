<script>function randomPassword(length) {
    var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
    var pass = "";
    for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    return pass;
}

function generate() {
    addAdminform.admin_password.value = randomPassword(addAdminform.length.value);
}</script>

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
            <label for="varchar">First Name <?php echo form_error('firstname') ?></label>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First name" value="<?php echo $firstname; ?>" required />
        </div>
		<div class="form-group">
            <label for="varchar">Last Name <?php echo form_error('lastname') ?></label>
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name" value="<?php echo $lastname; ?>" required />
        </div>
		
	    <div class="form-group">
            <label for="varchar">Username <?php echo form_error('admin_username') ?></label>
            <input type="text" class="form-control" name="admin_username" id="admin_username" placeholder="Username" value="<?php echo $admin_username; ?>" required/>
        </div>
	    <div class="form-group">
            <label for="varchar">Password <?php echo form_error('admin_password') ?></label>
            <input type="password" class="form-control" name="admin_password" id="admin_password" placeholder="Password" value="" <?php if (!$button == 'Update') echo "required" ?>
             size="40" />
			 
			<span> <input type="button" class="button" value="Generate" onClick="generate();"> </span>
			 
			 <input type="checkbox" onchange="document.getElementById('admin_password').type = this.checked ? 'text' : 'password'"> Show password
            <?php if ($button == 'Update'): ?>
              <label style="margin:5px 5px;" >*Leave the Password Field Empty if you do not wish to change the password</label>
            <?php endif ?>
        </div>
	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('admin_email') ?></label>
            <input type="email" class="form-control" name="admin_email" id="admin_email" placeholder="Email" value="<?php echo $admin_email; ?>" required/>
        </div>
	    <div class="form-group">
            <label for="int">Role <?php echo form_error('admin_type') ?></label>
            <!-- <input type="text" class="form-control" name="admin_type" id="admin_type" placeholder="Admin Type" value="<?php echo $admin_type; ?>" /> -->
            <select class="form-control" name="admin_type" id="admin_type" required>
              <option value="">Select</option>
              <option value="0" <?php if(isset($admin_type) && $admin_type==0) echo 'selected="selected"'; ?>>Super Admin</option>
              <option value="1" <?php if(isset($admin_type) && $admin_type==1) echo 'selected="selected"'; ?>>Templates Designer</option>
              <option value="2" <?php if(isset($admin_type) && $admin_type==2) echo 'selected="selected"'; ?>>Accounts Manager</option>
              <option value="3" <?php if(isset($admin_type) && $admin_type==3) echo 'selected="selected"'; ?>>Sales/Orders Manager</option>
            </select>
        </div>
	    <div class="form-group">
            <label for="int">Status <?php echo form_error('admin_status') ?></label>
            <select class="form-control" name="admin_status" id="admin_status" required>
              <option value="">Select</option>
              <option value="1" <?php if(isset($admin_status) && $admin_status==1) echo 'selected="selected"'; ?>>Active</option>
              <option value="0" <?php if(isset($admin_status) && $admin_status==0) echo 'selected="selected"'; ?>>Closed</option>
            </select>
        </div>

        <div class="form-group">
          <label for="login-info">Send info via login</label>
          <br>

          Yes
          <input type="radio" name="sendinfo" value="yes">
          &nbsp;&nbsp;&nbsp;&nbsp;
          No
          <input checked type="radio" name="sendinfo" value="no">
        </div>
        <input type="hidden" class="form-control" name="admin_date" id="admin_date" placeholder="Date" value="<?php if(!$admin_date) echo date("Y-m-d H:i:s"); else echo $admin_date; ?>" />
	    <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('admins') ?>" class="btn btn-default">Cancel</a>
	</form>
  </div>
  </div>
    </div>
