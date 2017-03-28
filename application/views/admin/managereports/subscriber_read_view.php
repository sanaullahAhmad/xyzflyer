<?php
$this->load->helper('slider_helper');
?>
<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
			
        <div class="col-md-5">
		
        <h2 style="margin-top:0px">Subscriber Detail</h2>
		<div class="col-md-12 text-center" style="margin-bottom: 14px;">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        <table class="table">
        <tr><td>Subscriber #</td><td><?php echo $subscriber_data->subId; ?></td></tr>
	    <tr><td>Subscriber First Name</td><td><?php echo $subscriber_data->subFirstName; ?></td></tr>
        <tr><td>Subscriber Last Name</td><td><?php echo $subscriber_data->subLastName; ?></td></tr>
        <tr><td>Subscriber Email</td><td><?php echo $subscriber_data->subEmail; ?></td></tr>
	    <tr><td>Subscriber Country</td><td><?php echo $subscriber_data->subCountry; ?></td></tr>
	    <tr><td>Subscriber county</td><td><?php echo $subscriber_data->county; ?></td></tr>
	    <tr><td>Date</td><td><?php $date = date_create($subscriber_data->subCreationDate); echo date_format($date, 'm-d-Y'); ?></td></tr>
	    <tr><td>Subscriber Status</td><td><?php 
		if($subscriber_data->subStatus==1){echo 'Approved';}else if($subscriber_data->subStatus==0){echo 'Pending';}else if($subscriber_data->subStatus==2){echo 'Rejected';}else if($subscriber_data->subStatus==-1){echo 'Trashed';}else {echo 'N/A';}
		
		
		 ?></td>
		 </tr>
	    <!-- <tr><td>User Name</td><td><?php echo $subscriber_data->FirstName." ".$subscriber_data->LastName; ?></td></tr> -->
	    
	    <tr><td></td><td><a href="javascript:void(0);" onclick="history.go(-1);" class="btn btn-default">Cancel</a></td></tr>
	</table>
</div>

</div>
</div>
<!-- <div id="processModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    Modal content
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
</div> -->
<!-- <script type="text/javascript">
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

</script> -->