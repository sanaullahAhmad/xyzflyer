<?php
	$this->load->view('admin/layout/head');
	$this->load->view('admin/layout/header');

?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/multi-file-upload/jquery.fileupload.css">
	<div id="page-wrapper" >
		<div class="page-content">
			<section>
			<?	echo $this->breadcrumbs->show(); ?>
			</section>
			<h2 style="margin-top:0px">Slider Images</h2>
				<div class="row" style="margin-bottom: 10px">
				<div class="col-md-2 text-center">
					<div style="margin-top: 8px" id="message" class="alert-success">
						<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
					</div>
				</div>			   
			</div>
			<div class="row">
				<div class="col-md-6">	
					<form  action="<?php echo base_url(); ?>Frontend_settings/upload_home_post_images" method="post" enctype="multipart/form-data">
						
								<div class="form-group">
									<label for="exampleInputPassword1">Main Heading</label>
									<textarea type="text" class="form-control" name="main_heading" placeholder="Heading" > </textarea>
								</div>
								  <div class="form-group">
									<label for="exampleInputPassword1">Sub Heading</label>
									<textarea type="text" class="form-control" name="sub_heading" placeholder="Sub heading" > </textarea>
								  </div>
								  <div class="form-group">
									<label for="exampleInputPassword1">Button Text</label>
									<input type="text" class="form-control" name="btn_txt" placeholder="Button Text" >
								  </div>
								   <div class="form-group">
									<label for="exampleInputPassword1">Button Url</label>
									<input type="text" class="form-control" name="btn_url" placeholder="www.xyzflyers.com/pricing" >
								  </div>
								 <input type="hidden" class="form-control" name="status" value="0" >
								 
								<div class="form-group">
									<label for="int">Frontend Location </label>
									<select class="form-control" name="frontend_location" required>
									  <option value="">Select</option>
									  <option value="<?php echo $frontend_location ?>" selected><?php echo $frontend_location ?></option>
									</select>
								</div>
								  
								  <div class="form-group">
								
									<input type="file" name="file_upload" required>
							
								 </div>

								 <div class="form-group danger">
									<input type="submit" class="btn btn-primary" value="Upload">
									<a href="<? if(isset($_SERVER['HTTP_REFERER'])){ echo $_SERVER['HTTP_REFERER']; } ?>" class="btn btn-default">Cancel</a>
								 </div>
					</form>
				</div>
			
			<!-- Slider images -->
			
        
     
			</div>
           
        </div>
		 </div>
			<script>
function goBack() {
    window.history.go(-1);
}
</script>