<div id="page-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="page-content">
	<section>

		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-6">
        <h2 style="margin-top:0px"><?php echo $button ?></h2>
		
        <form action="<?php echo $action; ?>" method="post" name="addAdminform"  target="_blank">
            <div class="form-group">
                <label for="varchar">Header <?php echo form_error('tempheader') ?></label>
                <select class="form-control" name="tempheader">
                    <?php
                        foreach(glob(dirname(dirname(dirname(__FILE__))).'/emails/style1/incs/hea*.php') as $file) {
                            echo "<option  value='".pathinfo($file,PATHINFO_BASENAME)."'>".pathinfo($file,PATHINFO_FILENAME)."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="varchar">Footer <?php echo form_error('tempfooter') ?></label>
                <select class="form-control" name="tempfooter">
                    <?php
                        foreach(glob(dirname(dirname(dirname(__FILE__))).'/emails/style1/incs/foo*.php') as $file) {
                            echo "<option  value='".pathinfo($file,PATHINFO_BASENAME)."'>".pathinfo($file,PATHINFO_FILENAME)."</option>";
                        }
                    ?>
                </select>
            </div>
    		<div class="form-group">
                <label for="state">State</label>
        		<select class="form-control" name="state" onchange="show_email_list(this.value);">
        				<option value="">Select a State</option>
        				<?php
                        if(isset($us_state) && is_array($us_state))
                        {
        				foreach($us_state as $key => $value){
        					
        				echo "<option  value='".$key."'>".$value."</option>";
        				}
                        }?>
        		</select>
            </div>

            <script type="text/javascript">
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
           <!--  <div class="form-group">
               <label for="varchar">Select Template <?php echo form_error('First_Name') ?></label>
               <select class="form-control" name="template">
                   <?php
                       foreach(glob(dirname(dirname(dirname(__FILE__))).'/emails/style1/*.php') as $file) {
                           echo "<option  value='".pathinfo($file,PATHINFO_BASENAME)."'>".pathinfo($file,PATHINFO_FILENAME)."</option>";
                       }
                   ?>
               </select>
           </div> -->
            <div class="form-group">
                <label for="subject">Subject</label>
                <input class="form-control"  type="text" name="subject" id="subject" placeholder="Subject">
            </div>
            <div class="form-group">
                <label for="bodycontent">Body Content</label>
                <textarea  class="form-control" type="text" name="bodycontent" id="bodycontent" placeholder="Body Content"></textarea>
            </div>
            <div class="form-group" id="email_list" >
                <label for="varchar">Email List <small>(1 email address per line)</small></label>
                <textarea class="form-control" name="email_list"  placeholder="Write one email in each line.."></textarea>
            </div>
	    <input type="submit" name="view" class="btn btn-primary" value="<?php echo $viewemail ?>"/>
        <input type="submit" name="send" class="btn btn-primary" value="<?php echo $button ?>" />
	    <a href="<?php echo site_url('Email_databaseManagement') ?>" class="btn btn-default">Cancel</a>
	</form>


        </div>
  </div>
    </div>
