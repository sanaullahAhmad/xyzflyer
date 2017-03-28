 <section class="page-wrap contact-page-wrap pt-60 pb-60">

    <div class="page-inner container">

        <div class="page-row row">

            <form action="/frontend/register_action" class="register-form col-md-12" method="post">
                <div class="row input-wrap">
                    <div class="input-item col-md-6">
                        <label for="first-name">First Name</label>
                        <input name="userFirstName" type="text" class="form-control mb-20" id="first-name" placeholder="First Name" value="<?php echo set_value('userFirstName'); ?>" />
                        <div class="alert-danger"><?php echo form_error('userFirstName'); ?></div>
                    </div>

                    <div class="input-item col-md-6">
                        <label for="last-name">Last Name</label>
                        <input type="text" name="userLastName" class="form-control mb-20" id="last-name" placeholder="Last Name" value="<?php echo set_value('userLastName'); ?>" />
                        <div class="alert-danger"><?php echo form_error('userLastName'); ?></div>
                    </div>

                </div>

                <div class="row input-wrap">
                    <div class="input-item col-md-12">
                        <label for="username">Username</label>
                        <input name="username"  type="text" class="form-control mb-20" id="username" placeholder="Username" value="<?php echo set_value('username'); ?>" />
                        <div class="alert-danger"><?php echo form_error('username'); ?></div>
                    </div>
                </div>

                <div class="row input-wrap">
                    <div class="input-item col-md-6">
                        <label for="email-address">Email Address</label>
                        <input name="userEmail" type="text" class="form-control mb-20" id="email-address" placeholder="Email Address" value="<?php echo set_value('userEmail'); ?>" />
                            <div class="alert-danger"><?php echo form_error('userEmail'); ?></div>
                    </div>
                    <div class="input-item col-md-6">
                        <label for="conf-email">Confirm Email</label>
                        <input name="reUserEmail" type="text" class="form-control mb-20" id="conf-email" placeholder="Confirm Email" />
                        <div class="alert-danger"><?php echo form_error('reUserEmail'); ?></div>
                    </div>
                </div>


                <div class="row input-wrap">

                    <div class="input-item col-md-6">
                        <label for="password">Password</label>
                        <input name="userPassword" type="password" class="form-control mb-20" id="password" placeholder="Password" value="<?php echo set_value('userPassword'); ?>" />
                        <div class="alert-danger"><?php echo form_error('userPassword'); ?></div>
                    </div>
                    <div class="input-item col-md-6">
                        <label for="repassword">Retype Password</label>
                        <input name="reUserPassword" type="password" class="form-control mb-20" id="repassword" placeholder="Retype Password" />
                        <div class="alert-danger"><?php echo form_error('reUserPassword'); ?></div>
                    </div>
                </div>


                <div class="row input-wrap">
                    <div class="input-item col-md-6">
                        <label for="userDob">Date of birth</label>
                        <input name="userDob" type="date" class="form-control mb-20" id="userDob" placeholder="Date of Birth" value="<?php echo set_value('userDob'); ?>" />
                        <div class="alert-danger"><?php echo form_error('userDob'); ?></div>
                    </div>
                    <div class="input-item col-md-6">
                        <label  for="gender">Gender</label>
                        <select name="userGender">
                            <option <?php set_value('gender') == 0 ? "selected" : "" ;   ?> value="0">Male</option>
                            <option <?php set_value('gender') == 1 ? "selected" : "" ; ?> value="1">Female</option>
                        </select>
                        <div class="alert-danger"><?php echo form_error('userGender'); ?></div>
                    </div>
                </div>

                <div class="row input-wrap clearfix">
                    <div class="input-item col-sm-3 col-sm-offset-9">
                        <input type="submit" id="submit" class="button button-purple pull-right" value="Continue"
                    </div>
                </div>
            </form>


        </div>

    </div>

</section>


