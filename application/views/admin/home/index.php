<div id="page-wrapper" >
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
               <h2 style="display: inline-block;">Welcome <?php if ($this->session->userdata('admin_data') != "") { echo $this->session->userdata['admin_data']['username'];} ?>, <small>Love to see you back. </small></h2>
               <hr>
               <?php if($check){?>
               <h4>System Statistics:</h4>
               <table class="table table-bordered">
                <tr>
                    <td>Super Admins</td>
                    <td>Template Designers</td>
                    <td>Accounts Managers</td>
                    <td>Sales Managers</td>
                </tr>
                <tr>
                    <td><a href="<?php echo base_url('admins'); ?>"><?php echo $super_admins; ?></a></td>
                    <td><a href="<?php echo base_url('admins'); ?>"><?php echo $template_designers; ?></a></td>
                    <td><a href="<?php echo base_url('admins'); ?>"><?php echo $accounts_manager; ?></a></td>
                    <td><a href="<?php echo base_url('admins'); ?>"><?php echo $sales_manager; ?></a></td>
                </tr>
            </table>
            <?php } ?>
        </div>
    </div>              

</div>
<!-- /. PAGE INNER  -->
</div>