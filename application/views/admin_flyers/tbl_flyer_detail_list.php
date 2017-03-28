<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?php echo $this->breadcrumbs->show(); ?>
	</section>
        <div class="row">
        <div class="col-md-6"><h2 style="margin-top:0px">Flyer List </h2>
			<div class="col-md-5">

                <?php 
                if(xyzAccesscontrol('flyer_managment','Add')==TRUE){
                echo anchor(site_url('admin/manageflyers/save'),'Add Flyers', 'class="btn btn-primary"'); 
                }?>
            </div>
		</div>
            <div class="col-md-6 text-right">
                <h2 class="pt-0 mt-0 pb-0 mb-0"><small>Status Codes: </small>
                    <button class="btn disabled " style="background-color: yellow; color: #000; text-shadow: none; border: 1px solid yellow;">Yellow are Draft</button>
                    <button class="btn disabled " style="background-color: green; color: white; text-shadow: none; border: 1px solid green">Greens are Published</button>
                </h2>
            </div>
        </div>
        <div class="row" style="margin-bottom: 10px">
		
		 <div class="col-md-6" style="margin-top: 10px">
			
                <form action="<?php echo site_url('admin_flyers/index'); ?>" class="form-inline" method="get">
                    <div class="form-group">
                          <label for="sel1">Sort By:</label>
						  <select  class="form-control" id="sel1" name="sort">
							<option>select</option>
							<option value="Draft" <?php if ($q == "Draft"){ echo "selected"; } ?>>Draft</option>
							<option value="Published" <?php if ($q == "Published"){ echo "selected"; } ?> >Published</option>
						  </select>
				    </div>
				    <div class="form-group">
						
                       
                            <?php
							
                                if ($q == "Draft" || $q == "Published")
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin_flyers'); ?>" class="btn btn-default" style="height:33px;">Reset</a>
                                    <?php
                                }
                            ?>
                       
						<button class="btn btn-primary" type="submit" style="height:33px;">Sort</button>
                    </div>
                </form>
			</div>
            <div class="col-md-2 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
           
           
		   <div class="col-md-4 text-right">
				  <form action="<?php echo site_url('admin_flyers/index'); ?>" class="form-inline" method="get">
                    <div class="form-group">
                       <input type="text" name="q" class="form-control">
				    </div>
				    <div class="form-group">
						
                       
                            <?php
							
                                if ($q == "search")
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin_flyers'); ?>" class="btn btn-default" style="height:33px;">Reset</a>
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
                <!-- <th>No</th> -->

        <th>Flyer Uploaded Image</th>
		<th>Flyer Created Image</th>
        <th>Flyer ID</th>
        <th>Flyer Title</th>
		<!--<th>Flyer Image Size</th>
		 <th>Flyer Json File</th> -->
		<th>Flyer Status</th>
		<th>Flyer Used</th> 
		<!-- <th>Flyer Approved</th> -->
		<!-- <th>Flyer Approved By</th> -->
		<!-- <th>Flyer Creation Date</th> -->
		<!-- <th>Admin Id</th> -->
		<!-- <th>Modified By</th> -->
		<!-- <th>Modified Date</th> -->
		<th>Action</th>
            </tr><?php
            foreach ($admin_flyers_data as $admin_flyers)
            {
                ?>
                <tr>
			<!-- <td width="80px"><?php echo ++$start ?></td> -->
            <td style="width: 210px; margin: text-align: center;">
                <a href="<?php  echo site_url('admin_flyers/read/'.$admin_flyers->pk_flyer_detail_id) ?>">
            <!-- <a target="_blank" href="<?php echo base_url('public/upload/flyer_images/'.$admin_flyers->flyer_image); ?>"> -->
                    <div style="padding: 4px; text-align: center; background-color: <?php if($admin_flyers->flyer_status=='Draft') echo 'yellow'; else echo 'green'; ?>">
                         <img src="<?php echo base_url('public/upload/flyer_images/thumb_'.$admin_flyers->flyer_image); ?>" style="width: 200px; " />
                    </div>
                </a>
            </td>


            <!-- <td><?php echo $admin_flyers->flyer_image ?></td> -->
			<!-- <td><?php //echo $admin_flyers->flyer_image_size ?></td> -->
			<td  style="width: 210px; text-align: center;"><?php if ($admin_flyers->flyer_created_image) {?>
            <a target="_blank" href="<?php echo base_url('public/upload/flyers/'.$admin_flyers->flyer_created_image); ?>">
            <img src="<?php echo base_url('public/upload/flyers/'.$admin_flyers->flyer_created_image); ?>" style="width: 200px;height: 264px!important" />
            </a>
            <?php } else{?>
            <!-- <a target="_blank" href="<?php echo base_url('imgs/blank_flyer.jpg'); ?>"> -->
            <img src="<?php echo base_url('imgs/blank_flyer.jpg'); ?>" style="width: 200px" />
            <!-- </a> -->
            <?php } ?></td>
            <td><?php echo $admin_flyers->pk_flyer_detail_id ?></td>
            <td><?php echo $admin_flyers->flyer_title ?></td>
			<!-- <td><?php //echo $admin_flyers->flyer_json_file ?></td> -->
			<td>
            <?php 
            if(xyzAccesscontrol('flyer_managment','Status')==TRUE){
                  echo '<a style="margin:2px;" href="'.site_url('flyer_status/'.$admin_flyers->pk_flyer_detail_id).' " onclick="javasciprt: return confirm(\'Are You Sure to change?\')" data-toggle="tooltip" title="Status change">'.($admin_flyers->flyer_status=='Draft'?' <span style="background-color: yellow; color: #000; text-shadow: none; border: 1px solid yellow; padding: 3px;">'.$admin_flyers->flyer_status.'</span>':'<span  style="background-color: green; color: white; text-shadow: none; border: 1px solid green padding: 3px;">'.$admin_flyers->flyer_status.'</span>').'</a>';
                 }else {
            ?>
            <span <?php if($admin_flyers->flyer_status=='Draft'){
                echo ' style="background-color: yellow; color: #000; text-shadow: none; border: 1px solid yellow; padding: 3px;"';}else {
                echo 'style="background-color: green; color: white; text-shadow: none; border: 1px solid green padding: 3px;"';
                   }
                ?>>
                <?php echo $admin_flyers->flyer_status ?></span> 
                <?php } ?></td>
				<td><?php echo (format($admin_flyers->pk_flyer_detail_id,'countAdminflyers')); ?> times</td>
				
			<!-- <td><?php //echo $admin_flyers->flyer_approved ?></td>
			<td><?php //echo $admin_flyers->flyer_approved_by ?></td>
			<td><?php //echo $admin_flyers->flyer_creation_date ?></td>
			<td><?php //echo $admin_flyers->admin_id ?></td>
			<td><?php //echo $admin_flyers->modified_by ?></td> -->
			<!-- <td><?php echo $admin_flyers->modified_date ?></td> -->
			<td style="text-align:center" width="200px">
				<?php
				
			
                if(xyzAccesscontrol('flyer_managment','Read')==TRUE){
				 echo '<a style="margin:2px;" class="btn btn-primary" href="'.site_url('admin_flyers/read/'.$admin_flyers->pk_flyer_detail_id).'"" data-toggle="tooltip" title="View"><i class="fa fa-bars"></i></a>';
				
                }
                if(xyzAccesscontrol('flyer_managment','Edit')==TRUE){
					echo '<a style="margin:2px;" class="btn btn-warning" href="'.site_url('admin_flyers/update/'.$admin_flyers->pk_flyer_detail_id).' " data-toggle="tooltip" title="update" ><i class="fa fa-pencil"></i></a>';
				
				
                 }
                 if(xyzAccesscontrol('flyer_managment','Delete')==TRUE){
			      echo '<a style="margin:2px;" class="btn btn-danger" href="'.site_url('admin_flyers/delete/'.$admin_flyers->pk_flyer_detail_id).' " onclick="javasciprt: return confirm(\'Are You Sure ?\')" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>';
				echo ' | ';
                 }
                 if(xyzAccesscontrol('flyer_managment','Status')==TRUE){
                echo anchor(site_url('admin_flyers/showfront/'.$admin_flyers->pk_flyer_detail_id),($admin_flyers->show_on_homepage==1?'<span style="margin:2px;" class="btn btn-danger">Hide':'<span style="margin:2px;" class="btn btn-primary">Show').' On Front</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                 }
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php if(xyzAccesscontrol('flyer_managment','Excel')==TRUE){ echo anchor(site_url('admin_flyers/excel'), 'Excel', 'class="btn btn-primary"'); } ?>
		<?php  if(xyzAccesscontrol('flyer_managment','Word')==TRUE){ echo anchor(site_url('admin_flyers/word'), 'Word', 'class="btn btn-primary"'); }?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>