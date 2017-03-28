<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-5">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
            <label for="varchar">Slider Heading <div  style="margin-top: 8px" id="message" class="alert-success"> <?php echo form_error('main_heading') ?></div></label>
            <textarea type="text" class="form-control" name="main_heading" id="flyer_title" placeholder="Main Heading"><?php echo $main_heading; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Slider Sub Heading<?php echo form_error('sub_heading') ?></label>
            <textarea type="text" class="form-control" name="sub_heading" id="sub_heading" placeholder="Sub Heading"><?php echo $sub_heading; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="int">Slider Button text<?php echo form_error('button') ?></label>
            <input type="text" class="form-control" name="button_txt"  placeholder="Button text" value="<?php echo $button; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Slider Button Url <?php echo  '<p id="message" class="alert-success">'.form_error('button_url').'</p>' ?></label> 
            <input type="text" class="form-control" name="button_url" id="button_url" placeholder="Button Url" value="<?php echo $button_url; ?>" />
        </div>
	   
		<div class="form-group">
            <label for="int">Status <?php echo form_error('status') ?></label>
            <select class="form-control" name="status" required>
              <option value="">Select</option>
              <option value="1" <?php if(isset($status) && $status==1) echo 'selected="selected"'; ?>>Active</option>
              <option value="0" <?php if(isset($status) && $status==0) echo 'selected="selected"'; ?>>Disable</option>
            </select>
        </div>
		<div class="form-group">
            <label for="int">Frontend Location <?php echo form_error('frontend_location') ?></label>
            <select class="form-control" name="frontend_location" required>
              <option value="">Select</option>
              <option value="home" <?php if(isset($frontend_location) && $frontend_location== "home") echo 'selected="selected"'; ?>>Home</option>
              <option value="aboutus" <?php if(isset($frontend_location) && $frontend_location=="aboutus") echo 'selected="selected"'; ?>>About-us</option>
			  <option value="how-it-works" <?php if(isset($frontend_location) && $frontend_location=="how-it-works") echo 'selected="selected"'; ?>>How it Works</option>
            </select>
        </div>
		 <div class="form-group">
		 <label for="int">Slider image</label>
			<input type="file" name="file_upload">
			 <label style="margin:5px 5px;" >*Leave the Image upload Field Empty if you do not wish to change the Image</label>
		 </div>
	   
	    <input type="hidden" name="slider_id" value="<?php echo $slider_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $action_button ?></button> 
	    <a href="<? if(isset($_SERVER['HTTP_REFERER'])){ echo $_SERVER['HTTP_REFERER']; } ?>" class="btn btn-default">Cancel</a>
	</form>
    </div>
	 <div class="col-md-7">
	 <img  src="<? echo base_url()."uploads/slider_images/".$image_name; ?>" style="width: 600px;">
	 </div>
    </div>
    </div>