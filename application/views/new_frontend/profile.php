<?php
$this->load->view('new_frontend/public/head');
$this->load->view('new_frontend/public/header');
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"> </div>
		<div class="col-xs-12 col-sm-10 col-md-8 col-lg-8">
		<div class="row">
		<?php
	if(isset($errors)){
		var_dump($errors);
	}
	?>
		</div>
			<form action="/users_profile/profile_action" method="POST" role="form"  enctype="multipart/form-data">
				<legend>Profile</legend>

				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="username" placeholder="username" name="username" readonly value="<?= $username ?>" >
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="userEmail">Email</label>
							<input type="email" class="form-control" id="userEmail" placeholder="Email" name="userEmail" readonly value="<?= $userEmail ?>">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group">
							<label for="userLicenseNumber">License Number</label>
							<input type="text" class="form-control" id="userLicenseNumber" placeholder="Enter License" name="userLicenseNumber" value="<?= $userLicenseNumber ?>" >
						</div>
					</div>
				</div>
				<!-- end of user email row -->

				<div class="row"><!-- begin of password row -->

					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

						<div class="form-group">
							<label for="password">Current Password</label>
							<input type="password" class="form-control" id="password" placeholder="Password" name="userPassword" >
							<p style="width:430px;">Leave the password fields empty if you don't want to change password</p>
						</div>

					</div>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
						<label for="new_password">New Password</label>
						<input type="password" class="form-control" id="new_password" placeholder="New Password" name="new_password">
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
						<label for="confirm_password">Confirm Password</label>
						<input type="password" class="form-control" id="confirm_password" placeholder=" Confirm Password" name="confirm_password">
					</div>
				</div><!-- end of password row -->


				<div class="row"><!-- begin name row -->
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="first_name">First Name</label>
							<input type="text" class="form-control" id="first_name" placeholder="First Name" name="userFirstName" value="<?= $userFirstName ?>">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

						<div class="form-group">
							<label for="last_name">Last Name</label>
							<input type="text" class="form-control" id="last_name" placeholder="Last Name" name="userLastName"  value="<?= $userLastName ?>" >
						</div>

					</div>
				</div><!-- end of name row -->
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="userDob">Date of Birth</label>
							<input type="date" class="form-control" id="userDob" placeholder="Date of Birth" name="userDob" value="<?= $userDob ?>" >
						</div>

					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="userGender">Gender</label>
							<div class="row">
								<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
									<div class="checkbox">
										<label>

											<input type="radio" name="userGender" value="0" <?php  if(strval($userGender) === "0") echo "checked";   ?> >
											Male
										</label>
									</div>
								</div>
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<div class="checkbox">
										<label>
											<input type="radio" name="userGender" value="1" <?php  if(strval($userGender) === "1") echo "checked";   ?>>
											Female
										</label>
									</div>

								</div>
							</div>



						</div>
					</div>
				</div> <!-- end of dob gender row -->

				<div class="row">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<div class="form-group">
							<label for="state">State</label>
							<input type="text" class="form-control" id="state" placeholder="State" name="state"  value="<?= $state ?>" >
						</div>

					</div>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<div class="form-group">
							<label for="county">County</label>
							<input type="text" class="form-control" id="county" placeholder="County" name="county" value="<?= $county ?>" >
						</div>
					</div>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<div class="form-group">
							<label for="city">City</label>
							<input type="text" class="form-control" id="city" placeholder="City" name="city" value="<?= $city ?>">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="address">Complete Address</label>
							<input type="text" class="form-control" id="address" placeholder="Address" name="address" value="<?= $address ?>">
						</div>
					</div>
				</div> <!-- end o address row -->

				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="userProfilePicture">Profile Pic</label>
							<input type="file" id="userProfilePicture" name="userProfilePicture" >

							<p class="help-block"><img width="50" height="50" src="/public/upload/profile_images/<?= $userProfilePicture ?>" alt=""></p>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="userInfo">User Info</label>
							<textarea name="userInfo" id="userInfo" class="form-control" rows="2"><?= $userInfo ?></textarea>
						</div>
					</div>
				</div> <!-- end of pic row -->



				<button type="submit" class="btn btn-primary">Save</button>
			</form>


		</div> <!-- end of form col-8 div -->
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"> </div>
	</div> <!-- end of containe row -->



</div> <!-- end of container -->



<?php
$this->load->view('new_frontend/public/footer');
?>
