<? $this->load->view("emails/style1/incs/header"); ?>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td class="header-lg">
                Account Info
            </td>
          </tr>
          <tr>
            <td class="free-text">
				
				<?php  echo $html; ?>
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