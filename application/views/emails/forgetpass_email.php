<? $this->load->view("emails/style1/incs/header"); ?>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td class="header-lg">
             Password Recovery
            </td>
          </tr>
          <tr>
            <td class="free-text">
				<?php echo $html; ?>
				 <div class="button">
				 <a class="button-mobile" href="<?php echo base_url();?>frontend/reset_password/?code=<?php echo $code ?>&email=<?php echo $email; ?>"
							style="background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;">Click here to verify</a></div>
			</td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
 <? $this->load->view("emails/style1/incs/footer"); ?>