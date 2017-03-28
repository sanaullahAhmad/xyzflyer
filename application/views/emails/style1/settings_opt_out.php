<? $this->load->view($header); ?>
<?php
if(isset($tracker)){echo $tracker;}
?>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td class="header-lg">
              Change in Email Settings 
            </td>
          </tr>
          <tr>
            <td class="header-lg">
              <?php if (isset($subject) && !empty($subject)){
                echo $subject;
              } 
              
            ?>
            </td>
          </tr>
          <tr>
            <td class="free-text">
            <p>You have received this email message because you have recently made a change in your email settings.</p>
  
            <p>However in order to complete this change, you will have to confirm that you want to change your "<?=$setting_name?>" email settings.<br>
              Follow the link below to <?=$change_text?> <?=$setting_name?> emails. <br>
              Please note that the link will expire in 48 hours.</p>
            </td>
          </tr>
          <tr>
            <td class="button">
              <div><!--[if mso]>
                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:45px;v-text-anchor:middle;width:155px;" arcsize="15%" strokecolor="#ffffff" fillcolor="#ff6f6f">
                  <w:anchorlock/>
                  <center style="color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;">My Account</center>
                </v:roundrect>
              <![endif]--><a class="button-mobile" href="<?=base_url('email-settings/confirm/'.$change_text.'/'.$setting_name.'/'.$code)?>"
              style="background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;">Confirm this Change</a></div>
            </td>
          </tr>
          <tr>
          <td class="free-text">
          <? if($change!=1){?>
            <p>Please note that you will not recieve any <?=$setting_name?> emails in future, unless you explicitly change the settings.</p>
            <? } ?>
            <p>If you do not want to change above mentioned email setting, do nothing and ignore this email.</p>
          </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
 <? $this->load->view($footer); ?>