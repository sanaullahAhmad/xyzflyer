<style>
    .table td, .table th{padding: 4px!important}
    .table th{background-color: #0795D6; color: white;}
    .table th td{background-color: white; color: #747474;}
    .table .table td{padding: 8px;}
</style>
<div role="main" class="main">

    <section class="page-header">
        <div class="container">
            <!-- <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>">Home</a></li>
                        <li class="active">My Orders </li>
                    </ul>
                </div>
            </div> -->
            <div class="row">
                <div class="col-md-12">
                    <h1>My Orders</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container" >
        <!--     <div class="page-content"> -->
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    <a class="btn btn-primary btn-lg <?=($this->uri->segment(1)=='account')?'active':''?>" href="<?=site_url('account')?>">Profile Settings</a>
                    <a class="btn btn-primary btn-lg <?=($this->uri->segment(1)=='change-password')?'active':''?>" href="<?=site_url('change-password')?>">Change Password</a>
                    <a class="btn btn-primary btn-lg <?=($this->uri->segment(1)=='my-orders')?'active':''?>" href="<?=site_url('my-orders')?>">My Orders</a>
                    <a class="btn btn-primary btn-lg <?=($this->uri->segment(1)=='email-settings')?'active':''?>" href="<?=site_url('email-settings')?>">Email Settings</a>
                </div>
            </div>
        </div>
        <br>

        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-6">

                <form action="<?php echo site_url('users_orders/sortOrders'); ?>" class="form-inline" method="get">
                    <div class="form-group">
                      <label for="sel1">Sort By:</label>
                      <select  class="form-control" id="sel1" name="sort" required>
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
                            <a href="<?php echo site_url('users_orders'); ?>" class="btn btn-default" style="height:33px;">Reset</a>
                            <?php
                        }
                    }
                    ?>

                    <button class="btn btn-primary" type="submit" style="height:33px;">Sort</button>
                </div>
            </form>

        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 8px" id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
        <div class="col-md-1 text-right">
        </div>
        <!-- <div class="col-md-3 text-right">
        </div> -->
    </div>

    <table class="table table-bordered" style="margin-bottom: 10px; ">
     <?php
     $display = 0;
     if(isset($users_orders_data)){
		if(count($users_orders_data)>0){
           //echo "<pre>"; print_r($users_orders_data) ;exit;
		foreach ($users_orders_data as $users_orders){
        ?>
			<tr>
					<!-- <th>Sr.#</th> -->
					<th>Order No.</th>
					<!-- <th>Flyer title</th> -->
					<th>Flyer</th>
					<th>Receipt</th>
					<!-- <th>Price</th> -->
					<th>Dated</th>
					<th>Emails Sent</th>
					<th>Status</th>
					<th colspan="4" rowspan="2" style="padding: 0!important; background-color: white;">
					   <table class="table table-bordered" style="width: 100%; border: none">
						<tr>
							<th>Opens</th>
							<th>Reads</th>
							<th>Open Rate</th>
							<th>Last Run</th>
						</tr>
						<tr>
							<td><?php echo $users_orders->daorder_count; ?></td>
							<td><?php echo $users_orders->daorder_count; ?></td>
							<td><?php if($users_orders->daorder_count > 0){ $percentage = $users_orders->daorder_count/$users_orders->daorder_total_emails*100 ;echo round($percentage, 1, PHP_ROUND_HALF_UP)."%";}else{ echo "0%";} ?></td>
							<td>0</td>
						</tr>
						<tr>
							<td colspan="4" style="padding: 10px!important">
								*Note: Emails Stats will be tracked for 2 weeks after the intial send
							</td>
						</tr>
					</table>
				</th>
				<!-- <th>Created By</th> -->
				<th></th>
				<!-- <th>Action</th> -->
			</tr>
   
			<tr>
			 <!-- <td width="80px"><?php echo ++$start ?></td> -->
			 <td><?php echo $users_orders->daorder_id; ?><br>
			 <?php echo (format($users_orders->daorder_user_id, 'user')!=""?format($users_orders->daorder_user_id, 'user'):$users_orders->daorder_user_id); ?>
			 </td>
			 <!-- <td><?php echo $users_orders->flyer_title; ?></td> -->
				<td>
					<a href="<?php echo base_url(); ?>/public/upload/user_flyer_store/<?php echo ($users_orders->flyer_image!=""?$users_orders->flyer_image:"placeholder-image-thumb.jpg"); ?>" data-lightbox="example-<?php echo $users_orders->daorder_id; ?>">
						<img src="<?php echo base_url(); ?>/public/upload/user_flyer_store/_thumbs/thumb_<?php echo ($users_orders->flyer_image!=""?$users_orders->flyer_image:"placeholder-image-thumb.jpg"); ?>"style="width: 100px!important; height: 140px">
					</a>
                    <br>
                    <a target="_blank" href="<?php echo base_url('Newdesign/pdf_image/').'/'.$users_orders->flyer_image;?>" >
                        <i class="fa fa-download"></i>
                        PDF
                    </a>
                    <a href="<?=base_url('public/upload/user_flyer_store/'.$users_orders->flyer_image)?>" target="_blank"><i class="fa fa-download"></i> JPG</a>
				</td>

				<td class="text-center">
					<a href="#"><img src="https://iconbug.com/data/5b/507/52ff0e80b07d28b590bbc4b30befde52.png" alt="Download Receipt"  width="80" height="100"/></a>
					<br><a href="<?php echo base_url(); ?>users_orders/order_detail/<?=$users_orders->daorder_id?>" class="btn btn-danger">Reciept</a>
				</td>
				<!-- <td><?php echo "$".$users_orders->daorder_grand_total; ?></td> -->
				<td><?php $date = date_create($users_orders->daorder_date); echo date_format($date, 'm/d/Y'); //echo ' '.date_format($date, 'Hi').'hrs'; ?>
					<br>
					<a href="<?php echo base_url(); ?>users_orders/email_me/user/<?php echo $users_orders->flyer_image ?>" class="btn btn-primary">Email Me</a>
				</td>
				<td><?php echo $users_orders->daorder_total_emails; ?></td>
					<td><?php
					   if($users_orders->daorder_status == 0){
						  echo "<div style='width: 35px; height: 35px; background-color: yellow; border-radius: 50%;'> </div>";
					  }elseif($users_orders->daorder_status == 1){
						  echo "<div style='width: 35px; height: 35px; background-color: green; border-radius: 50%;'> </div>";
					  }elseif($users_orders->daorder_status == 2){
						  echo "<div style='width: 35px; height: 35px; background-color: red; border-radius: 50%;'> </div>";
					  } ?>

				</td>
				<!-- <td><?php echo (format($users_orders->daorder_user_id, 'user')!=""?format($users_orders->daorder_user_id, 'user'):$users_orders->daorder_user_id); ?></td> -->
				<td class="text-center">
					<a href="" class="btn btn-warning">Stats</a>
					<br><br>
					<a href="<?php echo base_url()?>editor?flyer=<?=$users_orders->uf_flyer_id?>" class="btn btn-success" >Re-Order</a>
				</td>
			</tr>
			<?php
		}
		}else{ ?>
			<tr>
        <td>
            <br>
            <h4>You don't have any orders yet, continue here to <a href="<?=site_url('order')?>">Create Your First Order</a></h4>
        </td>
    </tr>
	<?php }
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
<script type="text/javascript">
//Update order status
$(function() {
    $(document).on('click', '.processOrder', function() {
        var orderID=$(this).attr("id");
        var order_id = orderID.split('_');
        $.ajax({
            url: "<?php echo base_url(); ?>users_orders/check_order",
            type : 'POST',
            data : {"oid":order_id[1]},
            success: function(result){
              if(result=='Error'){
                  $("#processOrder_body").html('<div class="alert-alert">There is an error !</div>');
                  setTimeout(function(){
                     window.location.href = "<?php echo base_url(); ?>users_orders";
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
function pdf_image(image_name) {
    $.ajax(
        {
            url: "<?php echo base_url('Newdesign/pdf_image')?>",
            type: "POST",
            data:{
                image_name:image_name,
            },
            success: function(result){
                $("#div1").html(result);
            }
        });
}
</script>
<script src="<?=base_url('public/new_frontend/lightbox/dist/js/lightbox-plus-jquery.min.js')?>"></script>