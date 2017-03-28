<?php
     $action = $this->router->fetch_class(); 
?>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <img src="<?php echo base_url() ?>public/admin/img/find_user.png" class="user-image img-responsive"/>
            </li>


            <li>
                <a <?php if ($action == 'admin') { ?> class="active-menu" <?php } ?>  href="<?php echo base_url('admin'); ?>">Dashboard</a>
            </li>
            <li>
                <a <?php if ($action == 'admins') { ?> class="active-menu" <?php } ?>  href="<?php echo base_url('admins'); ?>">Admins Management</a>
            </li>
            
            <li>
                <a <?php if ($action == 'users') { ?> class="active-menu" <?php } ?>  href="<?php echo base_url('users'); ?>">Users Management</a>
            </li>

            <li>
                <a <?php if ($action == 'page') { ?> class="active-menu" <?php } ?>  href="<?php echo base_url('admin/managepages'); ?>">Pages Managment</a>
            </li>


            <li>
                <a <?php if ($action == 'manageflyers' || $action == 'admin_flyers' || $action == 'flyers_management') { ?> class="active-menu" <?php } ?>  href="<?php echo base_url('flyers_management'); ?>">Flyers Managment</a>
            </li>

            <li>
                <a <?php if ($action == 'admin_orders') { ?> class="active-menu" <?php } ?>  href="<?php echo base_url('admin_orders'); ?>">Orders Managment</a>
            </li>

            <li>
                <a <?php if ($action == 'admin_coupons') { ?> class="active-menu" <?php } ?>  href="<?php echo base_url('admin_coupons'); ?>">Coupons Managment</a>
            </li>

            <li>
                <a <?php if ($action == 'admin_designer_settings') { ?> class="active-menu" <?php } ?>  href="<?php echo base_url('admin/settings'); ?>">Designer Settings</a>
            </li>

            <li>
                <a <?php if ($action == 'admin_logs') { ?> class="active-menu" <?php } ?>  href="<?php echo base_url('admin_logs'); ?>">Activity Logs</a>
            </li>

            <li>
                <a <?php if ($action == 'admin_reports') { ?> class="active-menu" <?php } ?>  href="<?=site_url('reports')?>"">Reports</a>
            </li>
<!--         <li>
                <a <?php if ($action == 'admin_team') { ?> class="active-menu" <?php } ?>  href="<?php echo base_url('admin/manageteams'); ?>">Teams</a>
            </li>
           
                <a <?php if ($action == 'admin_clients') { ?> class="active-menu" <?php } ?>  href="<?php echo base_url('admin/manageclients'); ?>">Clients</a>
            </li>
            <li>
                <a <?php if ($action == 'manageservices') { ?> class="active-menu" <?php } ?>  href="<?php echo base_url('admin/manageservices'); ?>">Services</a>
            </li>-->
           
        </ul>
           

    </div>

</nav>   


