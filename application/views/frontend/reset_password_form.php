<form style="width:400px; margin-top:50px; margin:50px auto; " action="/frontend/reset_password_action" method="POST" role="form">
	<legend>Reset Pasword</legend>

	<input type="hidden" name="id" value="<?= $id ?>" placeholder="">
	<input type="hidden" name="email" value="<?= $email ?>" placeholder="">
	<input type="hidden" name="code" value="<?= $code ?>" placeholder="">

	<div class="form-group">
		<label for="">New Password</label>
		<input type="password" name="password" class="form-control" placeholder="New Password">
	</div>

	<div class="form-group">
		<label for="">Retype Password</label>
		<input type="password" name="repassword" class="form-control" placeholder="Retype Password">
	</div>

	<button type="submit" class="btn btn-primary">Reset</button>
</form>