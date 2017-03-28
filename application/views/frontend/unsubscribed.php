<form style="width:400px; margin-top:50px; margin:50px auto; " action="/email_database/subscribe?email=<?php if(isset($email)) echo urldecode($email); ?>" method="POST" role="form">

<div class="alert">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>You have been unsubscribed. <?php echo $email; ?></strong> Alert body ...
</div>

	<p>
		if you have subscribed accidently subscribe again.

	</p>


	<button type="submit" class="btn btn-primary">Subscribe</button>
</form>