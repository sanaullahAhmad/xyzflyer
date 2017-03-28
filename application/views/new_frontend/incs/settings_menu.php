<div class="row">
			<div class="col-md-3">
				<div class="list-group">
					<a class="list-group-item <?=($this->uri->segment(1)=='account')?'active':''?>" href="<?=site_url('account')?>">Profile Settings</a>
					<a class="list-group-item <?=($this->uri->segment(1)=='change-password' || $this->uri->segment(1)=='updatepassword')?'active':''?>" href="<?=site_url('change-password')?>">Change Password</a>
					<a class="list-group-item <?=($this->uri->segment(1)=='my-orders')?'active':''?>" href="<?=site_url('my-orders')?>">My Orders</a>
					<a class="list-group-item <?=($this->uri->segment(1)=='email-settings')?'active':''?>" href="<?=site_url('email-settings')?>">Email Settings</a>
				</div>
			</div>
		