<?php
	$this->load->view('admin/layout/head');
	$this->load->view('admin/layout/header');

?>
<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row" style="margin-bottom: 10px">
       
         <?php if(isset($slider) && $slider!=""){  ?>
         <div class="col-md-6">
	        <table class="table">
			
					</td></tr>
		    <tr><td>Image type </td><td><? echo $slider->image_type; ?></td></tr>
		    <tr><td>Slider Heading </td><td><? echo $slider->main_heading; ?></td></tr>
		    <tr><td>Slider Sub Heading </td><td><? echo $slider->sub_heading; ?></td></tr>
		    <tr><td>Slider Button text </td><td><? echo $slider->button; ?></td></tr>
		    <tr><td>Slider Button Url </td><td><? echo $slider->button_url; ?></td></tr>
		    <tr><td>Slider status</td><td> <?php echo ($slider->status == 0 ? 'Disable' :  'Enable'); ?></td></tr>
		    <tr><td>Slider Location</td><td><? echo $slider->frontend_location; ?></td></tr>
		    
			
			
			 <div class="col-md-6">
				<img  src="<? echo base_url()."uploads/slider_images/".$slider->image_name; ?>" width="800"/>
			</div>
			<tr><td></td><td><a href="<?=$_SERVER['HTTP_REFERER']?>"  class="btn btn-default">Back</a></td></tr>
			</table>
	</div>
	
	 <?php } ?>
</div>