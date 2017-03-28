<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Adddress Book Project</title>
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
        <!-- <link href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" rel="stylesheet" /> -->

        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    </head>

    <body>

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#"><h2>Import Emails</h2></a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li class="active"><a href="<?php echo base_url(); ?>"><i class="icon-home"></i>Home</a></li>
                            <li><a href="#about">About</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="container" style="margin-top:80px">
             <br>

            <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif;?>
            <?php if ($this->session->flashdata('success') == TRUE): ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php endif;?>


                <form method="post" action="<?php echo base_url() ?>admin/csv/importcsv" enctype="multipart/form-data">
                    <input type="file" name="userfile" ><br><br>
                    <input type="submit" name="submit" value="UPLOAD" class="btn btn-primary">
                   
                      <a style="color:white;" href="<?=base_url('email');?>">
                       <button type="button" class="btn btn-primary pull-right"  >
                        Go Back
                        </button>
                      </a>
                    
                </form>

            <br><br>
            <table class="table table-striped table-hover table-bordered">
                <caption><h3>Address List</h3></caption>
                <thead>
                    <tr>
                        <th>First Name</th>
						<th>Last Name</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>State</th>
                        <th>County</th>
                        <!--<th>Lat</th>
                        <th>Lng</th>-->
                        <th>Broker</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($csvemails == FALSE): ?>
                        <tr><td colspan="8">There are currently No Addresses</td></tr>
                    <?php else: ?>
                        <?php foreach ($csvemails as $row): ?>
                            <tr>
                                <td><?php echo $row['First_Name']; ?></td>
								 <td><?php echo $row['Last_Name']; ?></td>
                                <td><?php echo $row['email_address']; ?></td>
                                <td><?php echo $row['City']; ?></td>
                                <td><?php echo $row['State']; ?></td>
                                <td><?php echo $row['County']; ?></td>
                                <!--<td><?php /*echo $row['Latitude']; */?></td>
                                <td><?php /*echo $row['Longitude']; */?></td>-->
                                <td><?php echo $row['Agency_Name']; ?></td>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                </tbody>
            </table>


            <hr>
            <footer>

            </footer>

        </div>



    </body>
</html>