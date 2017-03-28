<?php $this->load->view($header); ?>
<?php
if(isset($tracker)){echo $tracker;}
?>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          
          <!-- <tr>
            <td class="header-lg">
              <?php /*if (isset($subject)) {
                echo $subject;
              } */?>
            </td>
          </tr> -->
          <tr>
            <td class="free-text">
            <?php if (isset($bodycontent) && !empty($bodycontent)){
                echo $bodycontent;
              } 
              // else
              // {
            ?>
              <!-- Thank you for signing up with XYZ Flyers! We hope you enjoy your time with us. Check out some of our newest offers below or the button to view your new account. -->
            <?php /*}*/?>
            </td>
          </tr>
          
          <tr>
            <td class="free-text" style="border-top: 1px solid #cccccc; margin-top: 10px;">
              <small>
              Please visit <a href="<?=site_url()?>">www.xyzflyers.com</a> to learn more. <br>Use the <a href="<?=site_url('unsubscribe_me')?>">link to unsubscribe</a>
                if you do not want to recieve such emails.</small>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>


 <?php $this->load->view($footer); ?>