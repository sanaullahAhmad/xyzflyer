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
    adduserform.userPassword.value = randomPassword(adduserform.length.value);
}</script>
<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-5">
        <h2 style="margin-top:0px"> <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" name="adduserform">
		 <input type="hidden" name="length" value="10">
	    <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">First Name <?php echo form_error('userFirstName') ?></label>
            <input type="text" class="form-control" name="userFirstName" id="userFirstName" placeholder="First Name" value="<?php echo $userFirstName; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Last Name <?php echo form_error('userLastName') ?></label>
            <input type="text" class="form-control" name="userLastName" id="userLastName" placeholder="Last Name" value="<?php echo $userLastName; ?>" />
        </div>
		 <div class="form-group">
            <label for="varchar">State </label>
			<select class="form-control" name="state">
				<option>Select a State</option>
				<?php  if(isset($us_state) && is_array($us_state)){
				foreach($us_state as $key => $value){
					
				echo "<option ".($state==$key?"selected='selected'":"")." value='".$key."'>".$value."</option>";
				}}?>
			</select>									
        </div>
		 <div class="form-group">
            <label for="varchar">City <?php echo form_error('userCity') ?></label>
            <input type="text" class="form-control" name="userCity" id="userCity" placeholder="City" value="<?php echo $userCity; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('userEmail') ?></label>
            <input type="text" class="form-control" name="userEmail" id="userEmail" placeholder="Email" value="<?php echo $userEmail; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password <?php echo form_error('userPassword') ?></label>
            <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Password" value="" />
			
			<span> <input type="button" class="button" value="Generate" onClick="generate();"> </span>
			<input type="checkbox" onchange="document.getElementById('userPassword').type = this.checked ? 'text' : 'password'"> Show password
			 
            <?php if ($button == 'Update'): ?>
              <label style="margin:5px 5px;" >*Leave the Password Field Empty if you do not wish to change the password</label>
            <?php endif ?>
        </div>
	    <div class="form-group">
            <label for="int">Status<?php echo form_error('userStatus') ?></label>
            <select class="form-control" name="userStatus" id="userStatus" required>
                <option value="">Select</option>
                <option value="1" <?php if(!empty($userStatus) && $userStatus==1){echo  'selected="selected"'; }?>>Active User</option>
                <option value="2" <?php if(!empty($userStatus) && $userStatus==2){ echo 'selected="selected"'; }?>>Suspended</option>
                <option value="0" <?php if(isset($userStatus) && $userStatus==0){echo  'selected="selected"'; }?>>Unverified User</option>
            </select>
        </div>
	  <!--  <div class="form-group">
            <label for="date">Dob <?php echo form_error('userDob') ?></label>
            <div class="input-group date" data-provide="datepicker">
                <input name="userDob" id="userDob" placeholder="Date of Birth" type="text" class="form-control" value="<?php echo $userDob; ?>" />
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>
	    <div class="form-group">
            <label for="int">Gender <?php 
            echo form_error('userGender') 
            ?></label>
            <select class="form-control" name="userGender" id="userGender" required>
                <option value="">Select</option>
                <option value="0" <?php 
                if(isset($userGender) && $userGender==0) echo 'selected="selected"';
                 ?>>Male</option>
                <option value="1" <?php
                 if(isset($userGender) && $userGender==1) echo 'selected="selected"';
                  ?>>Female</option>
            </select>
        </div>  -->

        <div class="form-group">
          <label for="login-info">Send info via login</label>
          <br>

          Yes
          <input type="radio" name="sendinfo" value="yes">
          &nbsp;&nbsp;&nbsp;&nbsp;
          No
          <input checked type="radio" name="sendinfo" value="no">
        </div>

	    <div class="form-group" style="display: none;">
            <label for="datetime">Creation Date <?php echo form_error('userCreationDate') ?></label>
            <input type="text" class="form-control" name="userCreationDate" id="userCreationDate" placeholder="Creation Date" value="<?php

            echo $userCreationDate = $button == "Update" ? $userCreationDate : Date('Y-m-d h:s:i'); ?>" />
        </div>
	    <div class="form-group" style="display: none;">
            <label for="int">Admin Id <?php echo form_error('admin_id') ?></label>
            <input type="text" class="form-control" name="admin_id" id="admin_id" placeholder="Admin Id" value="<?php echo $admin_id = $this->session->userdata('admin_id'); ?>" />
        </div>


	    <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('users/list_all') ?>" class="btn btn-default">Cancel</a>
	</form>
</div>
</div>
</div>