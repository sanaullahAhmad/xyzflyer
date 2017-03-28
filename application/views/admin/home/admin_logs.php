<style>
 button, .step3 a{
    font-size: 24px!important;
    padding: 14px!important;
    width: auto;
    height: auto;
}
</style>
<div id="page-wrapper" >
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h2 style="margin-top:0px">Logs Dashboard</h2>
                <hr>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="" class="start"  id="login_history">
                                    <div class="box">
                                        <div class="icon"><i class="fa fa-clock-o fa-lg"></i></div>
                                        <h3>Login History</h3>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="" class="start"  id="activity_logs">
                                    <div class="box">
                                        <div class="icon"><i class="fa fa-history fa-lg"></i></div>
                                        <h3>Activity Logs</h3>
                                    </div>
                                </a>
                            </div>
							 <div class="col-md-4">
                                    <a  href="" class="start"  id="sub_logs">
                                        <div class="box">
                                            <div class="icon"><i class="fa fa-history fa-lg"></i></div>
                                            <h3>Subscriber Logs</h3>
                                        </div>
                                    </a>
                             </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1 text-center">
                        <div class="choice step2" style="display: none">
                            <div class="panel panel-default">
                              <div class="panel-heading"><h3>Select which <span class="choice_text"></span> do you want?</h3></div>
                              <div class="panel-body">
                                <button class="btn btn-primary bt-lg" class="choice_step2" id="user">Users <span class="choice_text"></span></button>
                                <button class="btn btn-primary bt-lg" class="choice_step2" id="admin">Admins <span class="choice_text"></span></button>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1 text-center">
                        <div class="choice2 step5" style="display: none">
                            <div class="panel panel-default">
                              <div class="panel-heading"><h3>Select which <span class="choice_text"></span> do you want?</h3></div>
                              <div class="panel-body">
                                <a href="<?php echo base_url(); ?>Newsletter_history/" class="btn btn-primary bt-lg" class="choice_step3" id="newsletter">newsletter <span class="choice_text"></span></a>
                                <a href="<?php echo base_url(); ?>Admin_subscriber/" class="btn btn-primary bt-lg" class="choice_step3" id="subscriber">subscriber <span class="choice_text"></span></a>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>

                <div class="row  step3" style="display: none">
                    <div class="col-md-10 col-md-offset-1 text-center">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3>Display <span class="choice_text"></span> for</h3></div>
                            <div class="panel-body">
                                <a class="btn btn-primary" id="all" href="">All <span class="step3_text"></span>s</a>
                                <a class="btn btn-primary" id="specific" href="">Specific <span class="step3_text"></span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row  step4" style="display: none">
                  <div class="col-md-10 col-md-offset-1 text-center">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3>Choose <span class="step3_text"></span> to display <span class="choice_text"></span></h3></div>
                        <div class="panel-body">
                            Choose <span class="step3_text"></span>:
                            <?php //echo "<pre>";print_r($users);?>
                            <select name="" id="admin_selection" class="select2 admin_selection selection">
                                <option value="">Select an Admin</option>
                                <?php foreach ($admins as $admin) { ?>
                                    <option value="<?=$admin->admin_id?>"><?=$admin->admin_username?></option>
                                    <?php }?>
                                </select>

                                <select name="" id="user_selection" class="select2 user_selection selection">
                                <option value="">Select a User</option>
                                <?php foreach ($users as $user) { ?>
                                    <option value="<?=$user->userId?>"><?=$user->userFirstName?> <?=$user->userLastName?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <br>
                <br>
                <br> -->
                <!-- <div class="row">
                    <div class="col-md-12">
                     <a href="<?php echo base_url('admin_login_history'); ?>" class="btn btn-lg btn-success">Admin Login History</a>
                 </div>
                 <div class="col-md-6">
                     <a href="<?php echo base_url('admin_activity'); ?>" class="btn btn-lg btn-success">Admins Activity Logs</a>
                 </div>
                </div>  -->
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        var step1 = "",
        step2 = "";
        $('.start').on('click', function(event) {
            event.preventDefault();
            $('.step2, .step3, .step4').hide();
            _id = $(this).attr('id');
            if(_id=='login_history'){
                step1 = "_login_history";
                txt = "Login History";
					$('.choice_text').text(txt);
					 $('.choice2').hide();
					$('.choice').fadeIn();
            }else if(_id=='sub_logs'){
                step1 = "_sub_history";
                txt = "Subscribe History";
					$('.choice_text').text(txt);
					 $('.choice').hide();
					$('.choice2').fadeIn();
            }else{
                step1= "_activity";
                txt = "Activity Logs";
					$('.choice_text').text(txt);
					 $('.choice2').hide();
					$('.choice').fadeIn();
            }
            $('.choice_user').attr('id', 'user_'+_id);
            $('.choice_admin').attr('id', 'admin_'+_id);
        });
        $('.step2 button').on('click', function(event) {
            event.preventDefault();
            _id = $(this).attr('id');
            step2 = _id;
            $('#all').attr('href',site_url+step2+step1)
            $('.step3_text').text(_id).css('text-transform','capitalize');
            /* Act on the event */
            $('.choice').hide();
			 $('.choice2').hide();
            $('.step3').fadeIn();
        });
        $('.step3 a').on('click', function(event) {
            _id = $(this).attr('id');
            if(_id=='specific')
            {
                event.preventDefault();
                $('.step3').hide();
                // alert('#'+step2+'_selection');
                $('.selection').hide();
                $('#'+step2+'_selection').show();
                $('.step4').fadeIn();
                $("#user_selection").select2();
            }
        });
        $('.selection').on('change', function(event) {
            event.preventDefault();
            if(step2 == "user"){
                step2 = "users";
            }
            window.location = site_url+ step2 +  step1 + '/' + $(this).val();
        });
    });
</script>
