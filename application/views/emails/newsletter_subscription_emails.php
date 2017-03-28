<? $this->load->view("emails/style1/incs/header"); ?>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td class="header-lg">
              Newsletter Subscription
            </td>
          </tr>
          <tr>
            <td class="free-text">
				<p>You have received this email message because you have recently submitted this email address to the XYZ Flyers Newsletter.</p>
				<p>However, your Subscription now requires that you receive this email and want to receive emails from XYZ Flyers.</p>			
				 <div class="button">
				 <a class="button-mobile" href="<?php echo base_url();?>Newsletter/verification?code=<?php echo $code ?>&email=<?php echo $email; ?>"
							style="background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;">Click here to verify</a></div>
				<p>If you do not want to Subscribe, do nothing. You will automatically be removed.</p>
				<p>Thank you,</p>
				<p>XYZ Flyers Mailing List Management </p>
				<p><b style='text-align:center;'>We will not share your email address with anyone else.</p>
				<p>XYZ Flyers <a href="<?php echo base_url();?>privace-policy">Privacy Policy</a></p>
			</td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
 <? $this->load->view("emails/style1/incs/footer"); ?>