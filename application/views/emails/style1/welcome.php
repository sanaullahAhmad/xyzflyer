<?php $this->load->view($header); ?>
<?php
if(isset($tracker)){echo $tracker;}
?>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td class="header-lg">
              Welcome to XYZ Flyers!
            </td>
          </tr>
          <tr>
            <td class="header-lg">
              <?php if (isset($subject)) {
                echo $subject;
              } ?>
            </td>
          </tr>
          <tr>
            <td class="free-text">
            <?php if (isset($bodycontent) && !empty($bodycontent)){
                echo $bodycontent;
              } 
              else
              {
            ?>
              Thank you for signing up with XYZ Flyers! We hope you enjoy your time with us. Check out some of our newest offers below or the button to view your new account.
            <?php }?>
            </td>
          </tr>
          <tr>
            <td class="button">
              <div><!--[if mso]>
                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:45px;v-text-anchor:middle;width:155px;" arcsize="15%" strokecolor="#ffffff" fillcolor="#ff6f6f">
                  <w:anchorlock/>
                  <center style="color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;">My Account</center>
                </v:roundrect>
              <![endif]--><a class="button-mobile" href="https://xyzflyers.com/login.aspx"
              style="background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;">My Account</a></div>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
 <?php $this->load->view($footer); ?>