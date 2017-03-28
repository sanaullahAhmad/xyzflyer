<script>
$(document).ready(function() {
$('#mytable').DataTable( {
"paging":   false,
"ordering": false,
"info":     false,
"bFilter":     false
} );
} );
</script>
<?php // if(isset($results_for)){print_r ($results_for); exit;}  ?>
<div id="page-wrapper" >
	<div class="page-content">
		<div class="panel panel-default">
			<div class="panel-heading">Users Search</div>
				<div class="panel-body">
				
				<?php if(isset($users_data)){ ?>
				<table id="mytable" class="table table-bordered table-striped" style="margin-bottom: 10px">
				<?php if(!empty($results_for)){
					echo " <b style='color:red'>You Searched for:</b>"; 
					echo $results_for['query'];						
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
					echo '<a href="'.site_url().'users/list_all/00">Unverified User</a>';
					elseif($users->userStatus==1)
					echo '<a href="'.site_url().'users/list_all/1">Active User</a>';
					elseif($users->userStatus==2)
					echo '<a href="'.site_url().'users/list_all/2">Suspended</a>';
					/*                      elseif($users->userStatus==3)
					echo '<a href="'.site_url().'users/list_all/3"></a>';*/
					else echo "Undefined"
					?>
					</td>
					<?php } ?>
					<td><?php $date = date_create($users->userCreationDate); echo date_format($date, 'm-d-Y');?></td>
					<td>
					<form action="<?php echo base_url('admin/search/detailSearchaction'); ?>" method="get" enctype="multipart/form-data" name="search"> 			
						<input type="hidden" name="userId" class="form-control" value="<?php echo $users->userId; ?>">
						<button  type="submit" class="btn btn-default">click here<span class="glyphicon glyphicon-ok"></span></button>
					</form>
					</td>
					
				</tbody>
				</table>
					<?php } 
			}else{ ?>
			
		<?php } ?>
		</div>
	</div>

</div>