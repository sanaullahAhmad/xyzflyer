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
		
        <h2 style="margin-top:0px">Update Detail's</h2>
        <form action="<?php echo $action; ?>" method="post">
              <div class="form-group" style="display: none;">
                  <label for="int">Subscriber Id <?php echo form_error('subId') ?></label>
                  <input type="text" class="form-control" name="subId" id="subId" placeholder="Subscriber Id" value="<?php echo $subId; ?>" />
              </div>           <!--  <div class="form-group">
                  <label for="int">User Flyer Id <?php //echo form_error('daorder_user_flyer_id') ?></label>
                  <input type="text" class="form-control" name="daorder_user_flyer_id" id="daorder_user_flyer_id" placeholder="User Flyer Id" value="<?php //echo daorder_user_flyer_id; ?>" />
              </div> -->
            <div class="form-group">
                  <label for="varchar">First Name <?php echo form_error('subFirstName') ?></label>
                  <input type="text" class="form-control" name="subFirstName" id="subFirstName" placeholder="First Name" value="<?php echo $subFirstName; ?>" />
            </div>
            <div class="form-group">
                  <label for="varchar">Last Name <?php echo form_error('subLastName') ?></label>
                  <input type="text" class="form-control" name="subLastName" id="subLastName" placeholder="Last Name" value="<?php echo $subLastName; ?>" />
            </div>
            <div class="form-group">
                  <label for="varchar">Subscriber Email <?php echo form_error('subEmail') ?></label>
                  <input type="text" class="form-control" name="subEmail" id="subEmail" placeholder="Subscriber Email" value="<?php echo $subEmail; ?>" />
            </div>
            <div class="form-group">
                  <label for="varchar">Subscriber County <?php echo form_error('subCountry') ?></label>
                  <input type="text" class="form-control" name="subCountry" id="subCountry" placeholder="Subscriber County" value="<?php echo $subCountry; ?>" />
            </div>
            <div class="form-group">
                  <label for="varchar">Subscriber Country <?php echo form_error('county') ?></label>
                  <input type="text" class="form-control" name="county" id="county" placeholder="Subscriber country" value="<?php echo $county; ?>" />
            </div><!-- 
            <div class="form-group">
                  <label for="datetime">Date <?php echo form_error('daorder_date') ?></label>
                  <input type="text" class="form-control" name="daorder_date" id="daorder_date" placeholder="Date" value="<?php echo ''; ?>" />
              </div> -->
            <div class="form-group">
                  <label for="int">Status <?php echo form_error('subStatus') ?></label>
                  
                  <!-- <input type="text" class="form-control" name="subStatus" id="subStatus" placeholder="Status" value="<?php echo $subStatus; ?>" /> -->

                 <select class="form-control" name="subStatus" id="deleted" required>
                   <option value="">Select</option>
                   <option value="0" <?php if(isset($subStatus) && $subStatus==0) echo 'selected="selected"'; ?>>Subscribed</option>
                   <option value="1" <?php if(isset($subStatus) && $subStatus==1) echo 'selected="selected"'; ?>>Unsubscribed</option>
                   <option value="2" <?php if(isset($subStatus) && $subStatus==2) echo 'selected="selected"'; ?>>Deleted</option>
                 </select>
              </div>
         <!--   <div class="form-group">
                  <label for="daorder_rejection_reason">Rejection Reason <?php echo form_error('daorder_rejection_reason') ?></label>
                  <textarea class="form-control" rows="3" name="daorder_rejection_reason" id="daorder_rejection_reason" placeholder="Rejection Reason"><?php echo $daorder_rejection_reason; ?></textarea>
              </div>-->
         <!--    <div class="form-group">
               <label for="int">Subscriber Id <?php echo form_error('subId') ?></label>
               <input type="text" class="form-control" name="subId" id="subId" placeholder="User Id" value="<?php echo ''; ?>" />
           </div> -->
           
            <input type="hidden" name="daorder_id" value="<?php echo ''; ?>" /> 
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
            <a href="<?php echo site_url('reports/emails') ?>" class="btn btn-default">Cancel</a>
        </form>
        
</div>
</div>
</div>
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