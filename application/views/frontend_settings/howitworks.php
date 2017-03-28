	<div id="page-wrapper" >
		<div class="page-content">
			<section>
			<?	echo $this->breadcrumbs->show(); ?>
			</section>
			<h2 style="margin-top:0px"><?=$title?></h2>
				
				<div class="col-md-5">

                <?php 
                if(xyzAccesscontrol('flyer_managment','Add')==TRUE){
                echo anchor(site_url('Frontend_settings/add_howworks_slider'),'Add Slider', 'class="btn btn-primary"'); 
				
                }?>
				</div>
			<div class="row" style="margin-bottom: 10px">
				<div class="col-md-2 text-center">
					<div style="margin-top: 8px" id="message" class="alert-success">
						<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
					</div>
				</div>			   
			</div>
			<div class="">
				<table class="table table-bordered table-striped" id="mytable">
					<thead>
						<tr>
						 
							<th>Slder Image</th>
							<th>Image type</th>
							<th>Location</th>
							<th>Main Heading</th>
							<th>Button</th> 
							<th>Status</th> 
							<th>Action</th>
						</tr>
					</thead>
					  <tbody>
					<?php foreach($slider as $slide){ ?>
					<tr>
					
					<td style="text-align:center" style="width: 210px; margin: text-align: center;">
						<img  src="<? echo base_url()."uploads/slider_images/".$slide->image_name; ?>" style="width: 200px;">
					</td>
						<td>
							<? echo $slide->image_type; ?>
						</td>
					<td>
						<? echo $slide->frontend_location; ?>
					</td>
						<td>
							<? echo $slide->main_heading; ?>
						</td>
					<td>
						<? echo $slide->button; ?>
						
					</td>
				
					<td>
						<? echo anchor(site_url('Frontend_settings/enable_aboutus_slider/'.$slide->id),($slide->status==1?'<span style="margin:2px;" class="btn btn-primary">Enable':'<span style="margin:2px;" class="btn btn-danger">Disable').'</span>','onclick="javasciprt: return confirm(\'Are You Sure ? your other images will be disable automatically\')",data-toggle="tooltip" title="Click to change status"'); ?>
					</td>
					<td>
					<? echo '<a style="margin:2px;" class="btn btn-danger" href="'.site_url('Frontend_settings/delete_image/'.$slide->id).' " onclick="javasciprt: return confirm(\'Are You Sure ?\')" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>';
					   echo ' | '; 	
					   echo '<a style="margin:2px;" class="btn btn-primary" href="'.site_url('Frontend_settings/read/'.$slide->id).'"" data-toggle="tooltip" title="View"><i class="fa fa-bars"></i></a>';
					   echo ' | '; 
				       echo '<a style="margin:2px;" class="btn btn-warning" href="'.site_url('Frontend_settings/update/'.$slide->id).' " data-toggle="tooltip" title="update" ><i class="fa fa-pencil"></i></a>';
				    ?>
						
					</td>
					
					</tr>
					<? } ?>
				</tbody>
				</table>
			</div>
		</div>