<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row" style="margin-bottom: 10px">
        <h2 style="margin-top:0px">User Flyer Detail</h2>
         <?php if(isset($flyers_data) && $flyers_data!=""){ ?>
         <div class="col-md-6">
	        <table class="table">
		    <tr><td>Flyer Title </td><td><?php echo $flyers_data->uFlyerTitle; ?></td></tr>
		    <tr><td>Flyer Date </td><td><?php echo $flyers_data->uFlyerDate; ?></td></tr>
		    <tr><td>Flyer Property Address </td><td><?php echo $flyers_data->propertyAddress; ?></td></tr>
		    <tr><td>Flyer Property price </td><td><?php echo $flyers_data->propertyPrice; ?></td></tr>
		    <tr><td>Flyer Property Main Header </td><td><?php echo $flyers_data->propertyMainHeader; ?></td></tr>
		    <tr><td>Flyer Property  Head Line</td><td><?php echo $flyers_data->propertyHeadline; ?></td></tr>
		    <tr><td>Flyer Property  Body 1</td><td><?php echo $flyers_data->propertyBody1; ?></td></tr>
		    <tr><td>Flyer Property  Body 2</td><td><?php echo $flyers_data->propertyBody2; ?></td></tr>
		    <tr><td>Flyer Property  Body 3</td><td><?php echo $flyers_data->propertyBody3; ?></td></tr>
		    <tr><td>Agent Contact Info </td><td><?php echo $flyers_data->agent1ContactInfo; ?></td></tr>
		    <tr><td>Agent 1 License </td><td><?php echo $flyers_data->agent1License; ?></td></tr>
		    <tr><td>Agent 2 Contact Info </td><td><?php echo $flyers_data->agent2ContactInfo; ?></td></tr>
		    <tr><td>Agent 2 License </td><td><?php echo $flyers_data->agent2License; ?></td></tr>
		    <tr><td>Agent Email </td><td><?php echo $flyers_data->agentEmail; ?></td></tr>
		    <tr><td>Agent Address </td><td><?php echo $flyers_data->agentAddress; ?></td></tr>
		    <tr><td>Company 1 Info </td><td><?php echo $flyers_data->company1Info; ?></td></tr>
		    <tr><td>Company 1 License </td><td><?php echo $flyers_data->company1License; ?></td></tr>
		    <tr><td>Company 2 Info </td><td><?php echo $flyers_data->company2Info; ?></td></tr>
		    <tr><td>Company 2 License </td><td><?php echo $flyers_data->company2License; ?></td></tr>
		    <tr><td>Flyer Type </td><td><?php echo $flyers_data->flyerType; ?></td></tr>
		    <tr><td>Flyer Used </td><td><?php echo (format($flyers_data->uFlyerId,'countflyers')+1); ?> times</td></tr>
		    <tr><td>Flyer User </td><td><?php echo (format($flyers_data->userId, 'user_name')!=""?format($flyers_data->userId, 'user_name'):$flyers_data->userId); ?></td></tr>
		    
		    <tr><td></td><td><a href="<?php echo site_url('user_flyers') ?>" class="btn btn-default">Back</a></td></tr>
		</table>
	</div>
	 <div class="col-md-6">
	 <img src="<?php echo base_url().'public/upload/user_flyer_store/'.(!empty($flyers_data->flyer_created_image)?$flyers_data->flyer_created_image:'placeholder-image.jpg'); ?>" width="400" height="600"/>
	 </div>
	 <?php } ?>
</div>