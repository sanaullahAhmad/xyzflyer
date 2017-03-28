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
                            <?php if ($subject) {
                                echo $subject;
                            } 
                            else {?>
                                Beautiful Listing Home $123,456
                            <?}?>
                        </td>
                    </tr>
                    <tr>
                        <td class="free-text">
                            <img class="img img-responsive" width="100%" src="<?=base_url('public/upload/flyer_images/resized_a9b395d33f727c96491cfbb36e4c0f3c.jpg')?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="free-text">
                            <?php if ($bodycontent) {
                                echo $bodycontent;
                            }?>
                        </td>
                    </tr>
                    <tr>
                        <td class="free-text">
                            <small>This flyer was sent for the listing agent by XYZ Flyers. We send flyers and announcements on listings, from real estate agents to other real estate agents, selected by areas.
                                XYZ Flyers neither endorses nor verifies the information contained on this flyer is true or correct.
                                <br>
                                Please visit <a href="<?=site_url()?>">www.xyzflyers.com</a> to learn more. Use the link to <a href="<?=site_url('unsubscribe/verification?code=1234567&email=null')?>">unsubscribe</a>
                                if you do not want to recieve this email.</small>
                        </td>
                    </tr>
                </table>
            </center>
        </td>
    </tr>
 <? $this->load->view($footer); ?>