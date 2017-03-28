<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
	<div class="row" class="col-sm-5">
	  <div class="col-sm-5">
        <h2 style="margin-top:0px">Emails List</h2>
		</div>
	</div>

	<div class="col-md-5">

                <?php 
                    if(xyzAccesscontrol('flyer_managment','Add')==TRUE){
                        echo anchor(site_url('Email_databaseManagement/create'),'Add Email', 'class="btn btn-primary"');

                }?>
				</div>
        <div class="row" style="margin-bottom: 10px">
            
            <div class="col-md-4 text-left">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
				
            </div>
			<div class="row" style="margin-bottom: 10px">
			<div class="col-md-3 text-right">
						<form action="<?php echo site_url('Email_databaseManagement/index'); ?>" class="form-inline" method="get">
							<div class="input-group">
								<input type="text" class="form-control" name="q" value="<?php if(isset($q)){ echo $q; }?>">
								<span class="input-group-btn">
									<?php 
									if(isset($q)){ 
										if ($q <> '')
										{
											?>
											<a href="<?php echo site_url('Email_databaseManagement'); ?>" class="btn btn-default">Reset</a>
											<?php
										}
									}
									?> 
									<button class="btn btn-primary" type="submit">Search</button>
								</span>
							</div>			
						</form>
			</div>
				
			</div>
			 <form action="<?php echo site_url('Email_databaseManagement'); ?>" class="form-inline" method="get">
						<div class="form-group">
							  <label for="sel1">Records:</label>
							  <select  class="form-control" id="records" name="records">
								<option value='10' <?php if(isset($records)){ if ($records == "10"){ echo "selected"; } }?>>10</option>
								<option value='25' <?php if(isset($records)){  if ($records == "25"){ echo "selected"; } }?> >25</option>
								<option value='50' <?php if(isset($records)){  if ($records == "50"){ echo "selected"; } }?> >50</option>
								<option value='100' <?php if(isset($records)){  if ($records == "100"){ echo "selected"; } }?> >100</option>
							  </select>
						</div>
						<div class="form-group">
								<?php       
									if(isset($records)){ 
									if ($records == 10 || $records == 25 || $records == 50 || $records == 100)
									{
										?>
										<a href="<?php echo site_url('Email_databaseManagement'); ?>" class="btn btn-default" style="height:33px;">Reset</a>
										<?php
									}
									}
								?>
						   
							<button id="recordsbtn" class="btn btn-primary" type="submit" style="height:33px; display: none;">Records</button>
						</div>
				</form>
		
        </div>
			
           
       <table id="mytable" class="table table-bordered table-striped" style="margin-bottom: 10px">
            <tr>
                <th>Sr.#</th>
		<!-- <th>Agency Name </th> -->
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email address</th>
	<!-- 	<th>Address</th>  -->
	 	<th>State</th> 
		<th>County</th>
		<th>City</th> 
		<th>Broker</th>
		<th>unsubscribed</th>
		<th>Action</th>
            </tr><?php
            foreach ($emails as $email)
            {
                ?>
        <tr>
			<td width="80px"><?php echo ++$start ?></td>
		<!-- 	<td><?php echo $email->Agency_Name; ?></td>  -->
			<td><?php echo $email->First_Name; ?></td>
			<td><?php echo $email->Last_Name; ?></td>
			<td><?php echo $email->email_address; ?></td>
		<!-- 	<td><?php echo $email->Address; ?></td>    -->
		<td><?php echo $email->State; ?></td>  
			<td><?php echo $email->County; ?></td>
		<td><?php echo $email->City; ?></td>  
		<td><?php echo $email->Agency_Name; ?></td>
			<td><?php echo ($email->unsubscribed == 0 ? "Subscribed" : "Unsubscribed"); ?></td>
			<td><?php 
			echo '<a style="margin:2px;" class="btn btn-danger" href="'.site_url('Email_databaseManagement/delete/'.$email->emailId).'" onclick="javasciprt: return confirm(\'Are You Sure ?\')" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>'; 
			echo '<a style="margin:2px;" class="btn btn-primary" href="'.site_url('Email_databaseManagement/read/'.$email->emailId).'" data-toggle="tooltip" title="View"><i class="fa fa-bars"></i></a>';
			 echo '<a style="margin:2px;" class="btn btn-warning" href="'.site_url('Email_databaseManagement/update/'.$email->emailId).' " data-toggle="tooltip" title="update" ><i class="fa fa-pencil"></i></a>';
			?></td>
			
			
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
			</div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
</div>
<script>
 $('#records').on('change', function(e){
        e.preventDefault();
        $('#recordsbtn').trigger('click');

    });
</script>