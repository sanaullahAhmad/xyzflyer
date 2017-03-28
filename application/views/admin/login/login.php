<!DOCTYPE html>
<html>

    <head>
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8" />
        <title>Admin Login</title>
        <meta name="keywords" content="HTML5 Bootstrap 3 Admin Template UI Theme" />
        <meta name="description" content="Stardom - A Responsive HTML5 Admin UI Template Theme" />
        <meta name="author" content="Holladay" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Font CSS  -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Core CSS  -->
        <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />

        <style>
            /*=============================================
                login STYLES    
            =============================================*/
            .square-btn-adjust {
                border: 0px solid transparent; 
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;

            }
            body.login-page .panel {
                position: relative;
            }
            .panel {
                border:1px solid #ddd;
                //box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.33);
                margin-bottom: 35px;
                overflow: hidden;
                position: relative;
            }
            .container{
                margin-top: 10%;
            }
            .panel-heading {
                background-color: #444;
                border-bottom: 1px solid #ddd;
                color: #fff;
                font-size: 25px;
                padding: 20px 30px;
            }
            .col-md-4, .col-md-offset-4{
                padding-left: 0px;
                padding-right: 0px;
            }
            .panel-footer{
                background-color: #444;
                border-top: 1px solid #ddd;
                clear: both;
                color: #fff;
                margin-top: 20px;
                text-shadow: 1px 1px 1px #000;
            }
        </style>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
    <body class="login-page">



        <!-- Start: Main -->
        <div id="main">
            <div class="container">

                <div class="row">

                    <div class=" panel col-md-4 col-md-offset-4">
                        <div class="panel-heading">
                            <div class="panel-title"> <h3><i class="fa fa-lock"></i> Login </h3></div>

                        </div>

                        <form class="cmxform" id="altForm" method="post" >
                            <div class="panel-body">
                                <?php if (isset($general_error) && ($general_error != '')) { ?>  
                                    <div class="alert alert-danger alert-dismissable">
<!--                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                                        <?php echo $general_error; ?> <a href="#" class="alert-link"></a>.
                                    </div>
                                <?php } ?>
                                <?php if (isset($username_error) && ($username_error != '')) { ?>  
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <?php echo $username_error; ?> <a href="#" class="alert-link"></a>.
                                    </div>
                                <?php } ?>
                                <?php if (isset($password_error) && ($password_error != '')) { ?>  
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <?php echo $password_error; ?><a href="#" class="alert-link"></a>.
                                    </div>
                                <?php } ?>

                                <div class="form-group">
                                    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i> </span>
                                        <input type="text" class="form-control phone" name="username" value="<?php if (isset($_POST['username'])) {echo $_POST['username'];} ?>"  autocomplete="off" placeholder="User Name" required="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-key"></i> </span>
                                        <input type="password" class="form-control product"  name="password" autocomplete="off" placeholder="Password" required="" />
                                    </div>
                                </div>

                            </div>
                            <div class="panel-footer">
                                <div class="form-group margin-bottom-none">
                                    <input class="btn btn-danger pull-right square-btn-adjust " name="submit" type="submit" value="Login" />
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>