<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
	<div class="row" class="col-sm-5">
	  <div class="col-sm-2">
        <h2 style="margin-top:0px">Orders List</h2>
		</div>
		<div class="col-sm-1" style="padding-left: 4px;">
		 <a href="<?php echo site_url('admin_orders/sortOrders'); ?>?sort=0" class="btn btn-warning">Pending : <?php echo $pending->pending; ?></a>
		 </div>
		 <div class="col-lg-1" style="padding-left: 4px;">
		 <a href="<?php echo site_url('admin_orders/sortOrders'); ?>?sort=1" class="btn btn-primary">Approved : <?php echo $approved->approved; ?></a>
		 </div>
		 
		 <div class="col-sm-2">
		 <a href="<?php echo site_url('admin_orders/sortOrders'); ?>?sort=2" class="btn btn-danger">Rejected : <?php echo $rejected->rejected; ?></a>
		 </div>
	</div>
	<!-- Modal -->
<div id="processModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order Processing</h4>
      </div>
      <div class="modal-body" id="processOrder_body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
            
                <form action="<?php echo site_url('admin_orders/sortOrders'); ?>" class="form-inline" method="get">
                    <div class="form-group">
                          <label for="sel1">Sort By:</label>
						  <select  class="form-control" id="sel1" name="sort">
							<option>select</option>
							<option value='0' <?php if(isset($sort)){ if ($sort == "0"){ echo "selected"; } }?>>Pending</option>
							<option value='1' <?php if(isset($sort)){  if ($sort == "1"){ echo "selected"; } }?> >Approved</option>
							<option value='2' <?php if(isset($sort)){  if ($sort == "2"){ echo "selected"; } }?> >Rejected</option>
						  </select>
				    </div>
				    <div class="form-group">
                            <?php		
								if(isset($sort)){ 
                                if ($sort == 0 || $sort == 1 || $sort == 2)
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin_orders'); ?>" class="btn btn-default" style="height:33px;">Reset</a>
                                    <?php
                                }
								}
                            ?>
                       
						<button class="btn btn-primary" type="submit" style="height:33px;">Sort</button>
                    </div>
                </form>
                <br>
                
			
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            
        </div>
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-6">
                <form action="<?php echo site_url('admin_orders/records'); ?>" class="form-inline" method="get">
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
                                    <a href="<?php echo site_url('admin_orders'); ?>" class="btn btn-default" style="height:33px;">Reset</a>
                                    <?php
                                }
                                }
                            ?>
                       
                        <button id="recordsbtn" class="btn btn-primary" type="submit" style="height:33px; display: none;">Records</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                <form action="<?php echo site_url('admin_orders/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php if(isset($q)){ echo $q; }?>">
                        <span class="input-group-btn">
                            <?php 
                            if(isset($q)){ 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin_orders'); ?>" class="btn btn-default">Reset</a>
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
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>Sr.#</th>
		<th>Order #</th>
		<th>Flyer title</th>
		<th>Flyer Image</th>
		<th>Total Price</th>
		<th>Total Agents</th>
		<th>Date</th>
		<th>Order Status</th>
		<th>Created By</th>
		<th>Action</th>
            </tr><?php
            foreach ($admin_orders_data as $admin_orders)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $admin_orders->daorder_id; ?></td>
			<td><?php echo $admin_orders->flyer_title; ?></td>
			<td><img src="<?php echo base_url(); ?>/public/upload/user_flyer_store/_thumbs/thumb_<?php echo ($admin_orders->flyer_image!=""?$admin_orders->flyer_image:"placeholder-image-thumb.jpg"); ?>" style="width: 100px; height: 100px; position: relative; display: inline-block;" class="" width="100" height="100"></td>
			<td><?php echo "$".$admin_orders->daorder_grand_total; ?></td>
			<td><?php echo number_format($admin_orders->daorder_total_emails); ?></td>
			<td><?php $date = date_create($admin_orders->daorder_date); echo date_format($date, 'm-d-Y'); ?></td>
			<td><?php
					if($admin_orders->daorder_status == 0){
						echo "Pending";
					}elseif($admin_orders->daorder_status == 1){
						echo "Approved";
					}elseif($admin_orders->daorder_status == 2){
						echo "Rejected";
					} ?>

			</td>
			<td><?php echo (format($admin_orders->daorder_user_id, 'user')!=""?format($admin_orders->daorder_user_id, 'user'):$admin_orders->daorder_user_id); ?></td>
			<td style="text-align:center" width="200px">
			
				<?php
                if(xyzAccesscontrol('order_managment','Read')==TRUE) {
                    echo '<a style="margin:2px;" class="btn btn-primary" href="' . site_url('admin_orders/read/' . $admin_orders->daorder_id) . '" data-toggle="tooltip" title="View"><i class="fa fa-bars"></i></a>';
                }

                if(xyzAccesscontrol('order_managment','Status')==TRUE) {
                    if ($admin_orders->daorder_status == 1) {
                        echo '<a style="margin:2px;" id="process_' . $admin_orders->daorder_id . '" class="processOrder btn green-jungle" href="javascript:void(0);" data-toggle="modal" data-target="#processModel" title="Approved" ><i class="fa fa-thumbs-o-up"></i></a>';

                    } else if ($admin_orders->daorder_status == 2) {
                        echo '<a style="margin:2px;" id="process_' . $admin_orders->daorder_id . '" class="processOrder btn grey-mint" href="javascript:void(0);" data-toggle="modal" data-target="#processModel" title="Rejected" ><i class="fa fa-thumbs-o-down"></i></a>';


                    } else if ($admin_orders->daorder_status == 0) {
                        echo '<a style="margin:2px;" id="process_' . $admin_orders->daorder_id . '" class="processOrder btn yellow-gold" href="javascript:void(0);" data-toggle="modal" data-target="#processModel" title="Pending" ><i class="fa fa-hourglass-end"></i></a>';

                    } else {
                        echo '<a style="margin:2px;" id="process_' . $admin_orders->daorder_id . '" class="processOrder btn yellow-gold" href="javascript:void(0);" data-toggle="tooltip" title="Error" ><i class="fa fa-pencil"></i></a>';
                    }
                }
                if(xyzAccesscontrol('order_managment','Delete')==TRUE){
				echo '<a style="margin:2px;" class="btn btn-danger" href="'.site_url('admin_orders/delete/'.$admin_orders->daorder_id).'" onclick="javasciprt: return confirm(\'Are You Sure ?\')" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>';
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
		<?php echo anchor(site_url('admin_orders/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('admin_orders/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
</div>


<script type="text/javascript">
//Update order status
$(function() {
$(document).on('click', '.processOrder', function() {
    var orderID=$(this).attr("id");
    var order_id = orderID.split('_');
    $.ajax({
    url: "<?php echo base_url(); ?>admin_orders/check_order",
    type : 'POST',
    data : {"oid":order_id[1]},
    success: function(result){
      if(result=='Error'){
      $("#processOrder_body").html('<div class="alert-alert">There is an error !</div>');
      setTimeout(function(){
       window.location.href = "<?php echo base_url(); ?>admin_orders";
       },3000);
        }else{
        $("#processOrder_body").html(result);
      }
    }
 });
});
}); 
$(function() {
$(document).on('change', '.form-check-input', function() {
    var checkedId = $(this).attr("id");
        if(checkedId=='reject'){
            $("#reason").prop('disabled', false);
            $("#rejreason").show('slow');
        }else{
            $("#reason").prop('disabled', true);
            $("#rejreason").hide('slow');
           
        }
    });
});
    $('#records').on('change', function(e){
        e.preventDefault();
        $('#recordsbtn').trigger('click');

    });
</script>