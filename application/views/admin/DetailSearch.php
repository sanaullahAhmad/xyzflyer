<script>
/*$(document).ready(function() {
$('#mytable').DataTable( {
"paging":   false,
"ordering": false,
"info":     false,
"bFilter":     false
} );
} );*/
</script>
<?php // if(isset($results_for)){print_r ($results_for); exit;}  ?>
<div id="page-wrapper">
	<div class="page-content">
		<div class="panel panel-info">
			<div class="panel-heading">Users Search</div>
				<div class="panel-body">
					<div class="row">
					<div class="col-md-12">
						
							<?php echo validation_errors(); ?>
					
						<form action="<?php echo base_url('admin/search/detailSearchaction'); ?>" method="get" enctype="multipart/form-data" name="search">
							<div class="col-md-2">
						<!--	<form action="<?php echo base_url('admin/search/detailSearchaction'); ?>" method="post" enctype="multipart/form-data" name="search"> -->
								<div class="form-group">
									<label for="sel1"><span id="search_concept">User Id</span></label>
									<input type="text" name="userId" class="form-control">
								</div>
								
						<!--	</form> -->
							</div>
					
						<div class="col-md-2">
						<div class="form-group">
										<label for="sel1"><span id="search_concept">Email</span></label>
										<input type="text" name="userEmail" class="form-control">
									</div>
						</div>	
							<div class="col-md-2">
							<!--	<form action="<?php echo base_url('admin/search/detailSearchaction'); ?>" method="post" enctype="multipart/form-data" name="search"> -->
									<div class="form-group">
										<label for="sel1"><span id="search_concept">First Name</span></label>
										<input type="text" name="userFirstName" class="form-control">
									</div>
									
							<!--	</form> -->
							</div>
						
							<div class="col-md-2">
							<!--	<form action="<?php echo base_url('admin/search/detailSearchaction'); ?>" method="post" enctype="multipart/form-data" name="search">  -->
									<div class="form-group">
										<label for="sel1"><span id="search_concept">Last Name</span></label>
										<input type="text" name="userLastName" class="form-control">
									</div>
									
							<!--	</form>  -->
							</div>
								
							<div class="col-md-2">
								<div class="form-group">
									<label for="sel1"><span id="search_concept">City</span></label>
									<input type="text" name="city" class="form-control">
								</div>
							</div>
							<div class="col-md-2">	
							<!--	<form action="<?php echo base_url('admin/search/detailSearchaction'); ?>" method="post" enctype="multipart/form-data" name="search">  -->
									<div class="form-group">
									<label for="sel1"><span id="search_concept">State</span> <span class="caret"></span></label>
										<select class="form-control" name="state">
											<option value="">Select a State</option>
											<?php  if(isset($us_state) && is_array($us_state)){
											foreach($us_state as $key => $value){
											echo "<option ".(set_value('state')==$key?"selected='selected'":"")." value='".$key."'>".$value."</option>";
											}}?>
										</select>
									</div>
									
									<div class="form-group">
										<span class="input-group-btn">
											<button  type="submit" class="btn btn-default" style="margin-left: 104px;"><span class="glyphicon glyphicon-search"></span></button>
										</span>
									</div>
									
							</form> 
							</div>
						</div>
					</div>
							<?php if(!empty($message)){
								echo $message;
							}
							?>
								
						
					</div>
		</div>
	<?php if(!empty($users_data)){?>
								
	<div class="row">
		<div class="col-md-12">
		 <?php if(isset($users_data)){ ?>
				<table id="mytable" class="table table-bordered table-striped" style="margin-bottom: 10px">
				<?php if(!empty($results_for)){
					//echo " <b style='color:red'>You Searched for:</b>"; 
					//echo $results_for;	
					//echo "<pre>";print_r($results_for);						
				} ?>
				<thead>
				<tr>
				<th>Sr. #</th>
				<th>Username</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>State</th>
				<?php if(xyzAccesscontrol('user_managment','Status')==TRUE){ ?>
				<th>Status</th>
				<?php } ?>
				
				<th>Created <br/>Date</th>
				<!-- <th>Action</th> -->
				<th>More Details</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$start=0;
			
					foreach ($users_data as $users)
					{
					?>
					<tr>
					<td><?php echo ++$start; ?></td>
					<td><?php echo $users->username ?></td>
					<td><?php echo $users->userFirstName ?></td>
					<td><?php echo $users->userLastName ?></td>
					<td><?php echo $users->userEmail ?></td>
					<td><?php echo $users->state ?></td>
					<?php if(xyzAccesscontrol('user_managment','Status')==TRUE){ ?>
					<td>
					<?php
					if($users->userStatus==0)
					echo 'Unverified User';
					elseif($users->userStatus==1)
					echo 'Active User';
					elseif($users->userStatus==2)
					echo 'Suspended';
					/*                      elseif($users->userStatus==3)
					echo '<a href="'.site_url().'users/list_all/3"></a>';*/
					else echo "Undefined"
					?>
					</td>
					<?php } ?>
					<td><?php $date = date_create($users->userCreationDate); echo date_format($date, 'm-d-Y');?></td>
					<td>
					<form action="<?php echo base_url('admin/search/Search_read'); ?>" method="get" enctype="multipart/form-data" name="search"> 			
						<input type="hidden" name="userId" class="form-control" value="<?php echo $users->userId; ?>">
						<button  type="submit" class="btn btn-default">More detail</button>
					</form>
					</td>
					
				
					<?php } ?>
				</tbody>
				</table>
		<?	}else{ ?>
			
		<?php } ?>
		</div>		
	</div>
	
	<?php } ?>	
</div>
</div>