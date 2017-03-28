<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
	<div class="row" class="col-sm-5">
	  <div class="col-sm-4">
        <h2 style="margin-top:0px">Subscriber Email</h2>
		</div>
	</div>
        <div class="row" style="margin-bottom: 10px">
             <div class="col-md-3 ">
				 <form action="<?php echo site_url('Admin_subscription'); ?>" class="form-inline" method="get">
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
											<a href="<?php echo site_url('Admin_subscription'); ?>" class="btn btn-default" style="height:33px;">Reset</a>
											<?php
										}
										}
									?>
							   
								<button id="recordsbtn" class="btn btn-primary" type="submit" style="height:33px; display: none;">Records</button>
							</div>
					</form>
			</div>
            <div class="col-md-4 text-left">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
			
            </div>
			
		 <div class="col-md-4 text-right">
				<form action="<?php echo site_url('Admin_subscription/index'); ?>" class="form-inline" method="get">
                    <div class="form-group">
                       <input type="text" name="q" class="form-control">
				    </div>
				    <div class="form-group">
						
                       
                            <?php
							
                                if ($q == "search")
                                {
                                    ?>
                                    <a href="<?php echo site_url('Admin_subscription'); ?>" class="btn btn-default" style="height:33px;">Reset</a>
                                    <?php
                                }
                            ?>
                         
                      
						 <button class="btn btn-primary" type="submit"  style="height:33px;">Search</button>
                    </div>
                </form>
        </div>
            </div>
           
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>Sr.#</th>
				<th>Full Name</th>
				<th>Email Address</th>
				
				<th>County</th>
				<th>State Name</th>
				<th>Status</th>
				<th>Created</th>
			<!--		<th>Action</th> -->
            </tr><?php
            foreach ($subscriber as $subscribers)
            {
                ?>
        <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $subscribers->subFirstName ." ".$subscribers->subLastName ; ?></td>
			<td><?php echo $subscribers->subEmail; ?></td>
			<td><?php echo $subscribers->county; ?></td>
			<td><?php echo $subscribers->subCountry; ?></td>
			<td>  <?php
            if($subscribers->subStatus==0)
            echo 'Un subscribed';
            elseif($subscribers->subStatus==1)
            echo 'Subscribed';
            else echo "Undefined"
            ?></td>
			<td><?php $date = date_create($subscribers->subCreationDate); echo date_format($date, 'm-d-Y'); ?></td>
			
		<!--	<td><?php 
			echo '<a style="margin:2px;" class="btn btn-danger" href="'.site_url('Email_databaseManagement/delete/'.$subscribers->subId).'" onclick="javasciprt: return confirm(\'Are You Sure ?\')" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>'; 
			echo '<a style="margin:2px;" class="btn btn-primary" href="'.site_url('Email_databaseManagement/read/'.$subscribers->subId).'" data-toggle="tooltip" title="View"><i class="fa fa-bars"></i></a>';
			 echo '<a style="margin:2px;" class="btn btn-warning" href="'.site_url('Email_databaseManagement/update/'.$subscribers->subId).' " data-toggle="tooltip" title="update" ><i class="fa fa-pencil"></i></a>';
			?></td>
		-->	
			
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