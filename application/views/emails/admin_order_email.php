<? $this->load->view($header); ?>
<?php
if(isset($tracker)){echo $tracker;}
?>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          
          <tr>
            <td class="free-text">
               <img class="img img-responsive" width="100%" src="<?=base_url('/public/upload/user_flyer_store/'.$image.'')?>" />             
            </td>
          </tr>
          <tr>
            <td class="free-text">
               <?php if (isset($bodycontent)) {
                 echo $bodycontent;
               }?>
            </td>
          </tr>
		   <tr>
            <td class="free-text">
               Order Created By
            </td>
			 <td class="free-text">
               <?php echo $user->FirstName." ".$user->LastName; ?>
            </td>
          </tr>
		   <tr>
            <td class="free-text">
              Price
            </td>
			<td class="free-text">
              <?php echo "$".$user->price; ?>
            </td>
          </tr>
		  <tr>
            <td class="free-text">
			 <b> To review order </b>
			 <div class="button">
			 
				 <a class="button-mobile" href="<?php echo base_url();?>admin_orders/read/<?php echo $order_id; ?>"
                  style="background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;">Click here</a></div>
            </td>
          </tr>
		
          <tr>
            <td class="free-text">
              <small>This flyer was sent for the listing agent by XYZ Flyers. We send flyers and announcements on listings, from real estate agents to other real estate agents, selected by areas.
                XYZ Flyers neither endorses nor verifies the information contained on this flyer is true or correct.
              <br>
              Please visit <a href="<?=site_url()?>">www.xyzflyers.com</a> to learn more. Use the link to <a href="<?=site_url('unsubscribe_me')?>">unsubscribe</a>
                if you do not want to recieve this email.</small>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
 <? $this->load->view($footer); ?>