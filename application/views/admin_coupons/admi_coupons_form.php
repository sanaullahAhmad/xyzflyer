<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <div class="row">
            <div class="col-md-12 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>

            <div class="col-md-5">
                <body>
                    <h2 style="margin-top:0px">Coupons <?php echo $button ?></h2>
                    <form action="<?php echo $action; ?>" method="post">
                     <div class="form-group">
                        <label for="coupon_title">Coupon Title <?php echo form_error('coupon_title') ?></label>
                        <input type="text" class="form-control" name="coupon_title" id="coupon_title" placeholder="Coupon Title" value="<?php echo $coupon_title; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="coupon_description">Coupon Description <?php echo form_error('coupon_description') ?></label>
                        <textarea class="form-control" rows="3" name="coupon_description" id="coupon_description" placeholder="Coupon Description"><?php echo $coupon_description; ?></textarea>
                    </div>

                        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
                        <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
                        <script>
                            webshims.setOptions('forms-ext', {types: 'date'});
                            webshims.polyfill('forms forms-ext');
                            $.webshims.formcfg = {
                                en: {
                                    dFormat: '-',
                                    dateSigns: '-',
                                    patterns: {
                                        d: "yy-mm-dd"
                                    }
                                }
                            };
                        </script>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coupon_start_date">Coupon Start Date <?php echo form_error('coupon_start_date') ?></label>
                                <input value="<?php echo $coupon_start_date; ?>" type="date" class="form-control" name="coupon_start_date" id="coupon_start_date" placeholder="mm-dd-yyyy" onkeydown="return false;" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coupon_start_time">Coupon Start Time <?php echo form_error('coupon_start_time') ?></label>
                                <input type="time" class="form-control time-pick" name="coupon_start_time" id="coupon_start_time" placeholder="hh:mm:ss" value="<?php echo $coupon_start_time; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coupone_end_date">Coupon End Date <?php echo form_error('coupone_end_date') ?></label>
                                <input type="date" class="form-control" name="coupone_end_date" id="coupone_end_date" placeholder="mm-dd-yyyy" value="<?php echo $coupone_end_date; ?>" onkeydown="return false;" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coupone_end_time">Coupon End Time <?php echo form_error('coupone_end_time') ?></label>
                                <input type="time" class="form-control time-pick" name="coupone_end_time" id="coupone_end_time" placeholder="hh:mm:ss" value="<?php echo $coupone_end_time; ?>" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="coupone_code">Coupon Code <?php echo form_error('coupon_code') ?></label>
                                <input style="height: 60px;font-size: 38px;" type="text" class="form-control" name="coupone_code" id="coupone_code"  value="<?php if(isset($coupon_code) && $coupon_code !==""){ echo $coupon_code;} else { echo substr(sha1(time()), -5); } ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-1">
                 <br><br>
                 <div class="form-group">
                    <label for="int">Coupon Type <?php echo form_error('coupon_type') ?></label>
                    <select class="form-control" name="coupon_type" id="coupon_type"  value="<?php //echo $coupon_type; ?>">
                        <option value="">Select</option>
                       <?php if($coupon_type==0)
                            {
                                echo '<option value="0" selected="selected" >Percentage</option>';
                            }
                        else{
                                echo '<option value="0" >Percentage</option>';
                            }
                        if($coupon_type==1)
                            {
                                echo '<option value="1" selected="selected" >Fixed Amount</option>';
                            }
                        else{
                                echo '<option value="1" >Fixed Amount</option>';
                            }
                        if($coupon_type==2)
                            {
                                echo '<option value="2" selected="selected">Price Override</option>';
                            }
                        else{
                                echo '<option value="2">Price Override</option>';
                            }?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="int">Coupon Status <?php echo form_error('coupon_status') ?></label>
                    <select class="form-control" name="coupon_status" id="coupon_status"  value="<?php //echo $coupon_status; ?>">
                        <option value="">Select</option>
                        <?php $type = $coupon_type;
                        if($type==0)
                            {
                                echo '<option value="0" selected="selected">Inactive</option>';
                            }
                        else
                            {
                                echo '<option value="0">Inactive</option>';
                            }
                        if($type==1)
                            {
                                echo '<option value="1" selected="selected">Activate</option>';
                            }
                        else
                            {
                                echo '<option value="1">Activate</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="float">Coupon Value <?php echo form_error('coupon_value') ?></label>
                      <div class="input-group">
                        <span class="input-group-addon">%</span>
                        <!-- <input type="text" class="form-control" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status"> -->
                        <input type="text" class="form-control" name="coupon_value" id="coupon_value" placeholder="5 - 100 " value="<?php echo $coupon_value; ?>" />
                      </div>
                </div>
                <div class="form-group">
                    <label for="int">Coupon Maximum Uses <?php echo form_error('coupon_maximum_uses') ?></label>
                    <input type="text" class="form-control" name="coupon_maximum_uses" id="coupon_maximum_uses" placeholder="Coupon Maximum Uses" value="<?php echo $coupon_maximum_uses ?>" />
                </label>
            </div>
            <div class="form-group">
                <label for="coupon_apply_once">Apply Once: <?php echo form_error('coupon_apply_once') ?>
                    <input type="checkbox" name="coupon_apply_once" id="coupon_apply_once" placeholder="Coupon Apply Once" value="1" <?php if($coupon_apply_once)echo 'checked'; ?> />
                </div>
                <div class="form-group">
                    <label for="coupon_new_signups">New Signups Only: <?php echo form_error('coupon_new_signups') ?>
                        <input type="checkbox" name="coupon_new_signups" id="coupon_new_signups" placeholder="Coupon New Signups" value="1"
                            <?php
                                if($coupon_new_signups)
                                    echo 'checked';

                            ?>
                        />
                    </label>
                </div>
                <div class="form-group">
                    <label for="coupon_apply_on_existing_client_only">Apply On Existing Client Only: <?php echo form_error('coupon_apply_on_existing_client_only') ?>
                        <input type="checkbox" name="coupon_apply_on_existing_client_only" id="coupon_apply_on_existing_client_only" placeholder="Coupon Apply On Existing Client Only" value="1"
                            <?php
                                if($coupon_apply_on_existing_client_only)
                                echo 'checked';

                                if ($coupon_new_signups == 'checked') {
                                    echo "disabled";
                                }
                            ?>


                        />
                    </label>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('body').delegate('#coupon_apply_on_existing_client_only','click',function(){
                        if (this.checked) {

                            $("#coupon_new_signups").attr('disabled','disabled');
                        } else {
                            $("#coupon_new_signups").removeAttr('disabled','disabled');

                        }
                        console.log("Rizwan");
                    });
                    $(document).delegate('#coupon_new_signups','click',function(){
                        if (this.checked) {

                            $("#coupon_apply_on_existing_client_only").attr('disabled','disabled');
                        } else {
                            $("#coupon_apply_on_existing_client_only").removeAttr('disabled','disabled');

                        }
                        console.log("Rizwan");
                    });
                    $(document).delegate('#coupon_type', 'change',function(){
                        var id = $("#coupon_type").find('option:selected').val();
                        console.log(id);
                        if (id =="") {
                            $('#coupon_value').attr('placeholder', ' ');
                        }
                        else{
                            $('#coupon_value').attr('placeholder', ' 5 - 100 ');
                        }
                        if ( id == 2 || id == 1 ) {
                            $('.input-group-addon').text("$");
                            /*$('#coupon_value').removeAttr('placeholder');*/
                        }
                        else
                        {
                            $('.input-group-addon').text("%");
                            /*$('#coupon_value').attr('placeholder', '% Amount');*/
                        }
                    });

                });
            </script>
        </div>
        <div class="row">
         <div class="col-md-5">

            <input type="hidden" class="form-control" name="coupon_date" id="coupon_date" placeholder="Coupon Date" value="<?php if(!$coupon_date) echo date("Y-m-d H:i:s"); else echo $coupon_date; ?>" />
            <?php if($this->uri->segment(2)=='update'){?>
            <input type="hidden" name="modified_date" value="">
            <input type="hidden" class="form-control" name="coupon_modified_admin" id="coupon_modified_admin" placeholder="Admin Id" value="<?php if(!$admin_id) {$d = $this->session->userdata('admin_data'); echo $d['pk_admin_id']; }else echo $admin_id; ?>" />
            <?php } else{?>
            <input type="hidden" class="form-control" name="admin_id" id="admin_id" placeholder="Admin Id" value="<?php if(!$admin_id) {$d = $this->session->userdata('admin_data'); echo $d['pk_admin_id']; }else echo $admin_id; ?>" />
            <?php }?>
            <input type="hidden" name="coupon_id" value="<?php echo $coupon_id; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            <a href="<?php echo site_url('admin_coupons') ?>" class="btn btn-default">Cancel</a>
        </form>
    </div></div>
</div>
</div>
</div>