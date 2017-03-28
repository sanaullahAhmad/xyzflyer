<div id="page-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="page-content">
	<section>

		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-6">
        <h2 style="margin-top:0px"><?php echo $title ?></h2>
		
        <form action="" method="post" name="addAdminform" enctype="multipart/form-data">
            <div class="form-group">
                <label for="varchar">Contact Page Receiving Email <?php echo form_error('frontend_contactus_email') ?></label>
                <input class="form-control"  type="text" name="frontend_contactus_email" id="frontend_contactus_email" placeholder="Contact Email" value="<?php echo $frontend_contactus_email->Value;?>">
            </div>
            <div class="form-group" style="display: none;">
                <label for="varchar">Footer <?php echo form_error('frontend_contactus_email_footer') ?></label>
                <select class="form-control" name="frontend_contactus_email_footer" onchange="check_coupon(this.value)">
                    <?php
                        foreach(glob(dirname(dirname(__FILE__)).'/emails/style1/incs/foo*.php') as $file) {
                            echo "<option  value='".pathinfo($file,PATHINFO_BASENAME)."'";

                            if($frontend_contactus_email_footer->Value==pathinfo($file,PATHINFO_BASENAME))
                            {
                                echo " selected ";
                            }
                            echo ">".pathinfo($file,PATHINFO_FILENAME)."</option>";
                        }
                    ?>
                </select>
            </div>
            
    	 	<div class="form-group"  id="frontend_contactus_coupon" ><?php //if($frontend_contactus_email_footer->Value=='footer.php'){ echo 'style="display: none;"';}?>
                <label for="state">Choose coupon for email footer</label>
                <select class="form-control" name="frontend_contactus_coupon" >
                        <option value="">Select a coupon</option>
                        <?php
                        if(isset($available_coupons) && is_array($available_coupons))
                        {
                            foreach($available_coupons as $key => $value){
                                echo "<option  value='".$value->coupon_code."'";
                                if($frontend_contactus_coupon->Value==$value->coupon_code)
                                {
                                    echo " selected ";
                                }
                                echo ">".$value->coupon_code."</option>";
                            }
                        }?>
                </select>
            </div>

            <div class="form-group" style="">
                <label for="varchar">Site Logo <span>Note: File dimensions 200 * 95</span><?php echo form_error('site_logo') ?></label>
                <div class="form-group">
                    <input type="file" name="frontend_contactus_email_logo">
                </div>

               <!--  <div class="form-group danger">
                   <input type="submit" class="btn btn-primary" value="Upload">
                   <a href="<? if(isset($_SERVER['HTTP_REFERER'])){ echo $_SERVER['HTTP_REFERER']; } ?>" class="btn btn-default">Cancel</a>
               </div> -->
                
            </div>
            <div class="form-group" style="">
                <fieldset>
                    <div class="form-group">
                        <img style="width: 200px" src="<?php echo base_url().$logo_url;?>">
                    </div>
                </fieldset>

            </div>


            <script type="text/javascript">
                function check_coupon(footer)
                {
                    if(footer=='footer_coupon.php')
                    {
                        $("#frontend_contactus_coupon").show();
                    }
                    else {
                        $("#frontend_contactus_coupon").hide();
                    }
                }
                function show_email_list(id)
                {
                    if(id=='')
                    {
                        $("#email_list").show();
                    }
                    else {
                        $("#email_list").hide();
                    }
                }
            </script>


        <input type="submit" name="send" class="btn btn-primary" value="<?php echo $button ?>" />
	    <a href="<?php echo site_url('_backoffice') ?>" class="btn btn-default">Cancel</a>
	</form>


        </div>
  </div>
</div>
