<? $this->load->view("emails/style1/incs/header"); ?>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td class="header-lg">
                UnSubscription
            </td>
          </tr>
          <tr>
            <td class="free-text">
				<p>You have received this email message because you have recently submitted this email address to the XYZ Flyers Subscription page.</p>
				 <div class="button">
				 <a class="button-mobile" href="<?php echo base_url();?>unsubscribe/verification?code=<?php if(isset($code)){ echo $code; } ?>&email=<?php if(isset($email)){ echo $email; } ?>"
							style="background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;">Click here to verify</a></div>
				<p>If you do not want to UnSubscribe, do nothing. Your UnSubscription request will automatically be removed.</p>
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