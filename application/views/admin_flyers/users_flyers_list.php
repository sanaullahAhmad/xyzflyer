<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <h2 style="margin-top:0px">Users Flyers List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-8 text-center">
                <?php echo $this->session->flashdata('message'); ?>
            </div>
            <div class="col-md-4 text-right">
                <div>
                 <div>
                  <?php echo anchor(site_url('flyers_management'), 'Go Back', 'class="btn btn-primary pull-right" style="margin-left: 2px;margin-bottom: 5px;"'); ?>
                  </div>
              </div>
          </div>
    </div>
    <table id="mytable" class="table table-bordered table-striped" style="margin-bottom: 10px">
      <thead>
          <tr>
            <th>Sr. #</th>
            <th>Flyer Title</th>
            <th>Flyer Image</th>
            <th>Flyer Type</th>
            <!-- <th>Flyer Used</th> -->
            <th>Flyer User</th>
            <th>Created <br/>Date</th>
            <th>Action</th>
        </tr>
        </thead>
      <tbody>
        <?php
        $start=0;
        foreach ($flyers_data as $flyer)
        {
         ?>
         <tr>
          <td><?php echo ++$start; ?></td>
          <td><?php echo $flyer->uFlyerTitle; ?></td>
          <td><img src="<?php echo base_url().'public/upload/user_flyer_store/_thumbs/'.(!empty($flyer->flyer_created_thumb)?$flyer->flyer_created_thumb:'placeholder-image-thumb.jpg'); ?>" width="100" height="100">
          </td>
          <td><?php echo $flyer->flyerType; ?></td>
          <!-- <td><?php //echo (format($flyer->uFlyerId,'countflyers')+1); ?> times</td> -->
          <td><?php echo (format($flyer->userId, 'user')!=""?format($flyer->userId, 'user'):$flyer->userId); ?></td>
          <td><?php $date = date_create($flyer->uFlyerDate); echo date_format($date, 'm-d-Y');?></td>
         <td style="text-align:center" width="200px">
   <?php
    if(xyzAccesscontrol('user_flyer','Read')==TRUE){
   echo '<a style="margin:2px;" class="btn btn-primary" href="'.site_url('user_flyers/read/'.$flyer->uFlyerId).' " ><i class="fa fa-bars"></i></a>';
    }
    if(xyzAccesscontrol('user_flyer','Delete')==TRUE){
   echo '<a style="margin:2px;" class="btn btn-danger" href="'.site_url('user_flyers/delete/'.$flyer->uFlyerId).' " onclick="javasciprt: return confirm(\'Are You Sure ?\')"><i class="fa fa-times"></i></a>';
    }
   ?>
</td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
