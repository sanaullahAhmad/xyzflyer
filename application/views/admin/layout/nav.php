<div class="page-sidebar-wrapper">
  <!-- BEGIN SIDEBAR -->
  <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
  <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
  <div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
      <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
      <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
      <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler"> <span></span> </div>
      </li>
      <!-- END SIDEBAR TOGGLER BUTTON -->
      <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
      <li class="sidebar-search-wrapper">
        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
        <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
        <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
          <!-- END RESPONSIVE QUICK SEARCH FORM -->
        </li>
        <li class="nav-item start active open"> <a href="<?php echo base_url('_backoffice'); ?>" class="nav-link nav-toggle"> <i class="icon-home"></i> <span class="title">Dashboard</span> <span class="selected"></span></a>
        </li>
		<li class="nav-item  "> <a href="<?php echo base_url('search'); ?>" class="nav-link nav-toggle"> <i class="glyphicon glyphicon-search"></i> <span class="title">Search</span></a>
        <?php if(xyzAccesscontrol('admin_managment','Full')==TRUE){ ?>
        <li class="nav-item  "> <a href="<?php echo base_url('admins'); ?>" class="nav-link nav-toggle"> <i class="icon-users"></i> <span class="title">Admin</span> <span class="arrow"></span></a>
         <ul class="sub-menu">
         <?php if(xyzAccesscontrol('admin_managment','Read')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('admins/list_all'); ?>" class="nav-link ">
              <span class="title">All Admins</span>
            </a>
          </li>
          <?php }
          if(xyzAccesscontrol('admin_managment','Read')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('admins/list_all_by_status/1'); ?>" class="nav-link ">
              <span class="title">Active Admins</span>
            </a>
          </li>
          <?php }
          if(xyzAccesscontrol('admin_managment','Read')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('admins/list_all_by_status/0'); ?>" class="nav-link ">
              <span class="title">Suspended Admins</span>
            </a>
          </li>
          <?php }
          if(xyzAccesscontrol('admin_managment','Add')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('admins/create'); ?>" class="nav-link ">
              <span class="title">Add New Admin</span>
            </a>
          </li>
          <?php } 
		  
		  if(xyzAccesscontrol('admin_managment','Word')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('admins/word'); ?>" class="nav-link ">
              <span class="title">Export Admins (Word)</span>
            </a>
          </li>
           <?php }
          if(xyzAccesscontrol('admin_managment','Excel')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('admins/excel'); ?>" class="nav-link ">
              <span class="title">Export Admins (Excel)</span>
            </a>
          </li>
           <?php } ?>
		  
        </ul>
      </li>
      <?php }
      if(xyzAccesscontrol('user_managment','Full')==TRUE){ ?>
      <li class="nav-item  "> <a href="<?php echo base_url('users'); ?>" class="nav-link nav-toggle"> <i class="icon-users"></i> <span class="title">User</span>
        <span class="arrow"></span></a>
        <ul class="sub-menu">
        <?php if(xyzAccesscontrol('user_managment','Read')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('users/list_all'); ?>" class="nav-link ">
              <span class="title">All Users</span>
            </a>
          </li>
          <?php }
          if(xyzAccesscontrol('user_managment','Read')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('users/list_all_by_status/1'); ?>" class="nav-link ">
              <span class="title">Active Users</span>
            </a>
          </li>
           <?php }
          if(xyzAccesscontrol('user_managment','Read')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('users/list_all_by_status/2'); ?>" class="nav-link ">
              <span class="title">Suspended Users</span>
            </a>
          </li>
           <?php }
          if(xyzAccesscontrol('user_managment','Read')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('users/list_all_by_status/00'); ?>" class="nav-link ">
              <span class="title">Unverfieid Users</span>
            </a>
          </li>
           <?php }
          if(xyzAccesscontrol('user_managment','Add')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('users/create'); ?>" class="nav-link ">
              <span class="title">Add New User</span>
            </a>
          </li>
           <?php }
          if(xyzAccesscontrol('user_managment','Word')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('users/word'); ?>" class="nav-link ">
              <span class="title">Export User (Word)</span>
            </a>
          </li>
           <?php }
          if(xyzAccesscontrol('user_managment','Excel')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('users/excel'); ?>" class="nav-link ">
              <span class="title">Export User (Excel)</span>
            </a>
          </li>
           <?php }
          if(xyzAccesscontrol('user_managment','Report')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="#" class="nav-link ">
              <span class="title">User Reports</span>
            </a>
          </li>
          <?php } ?>
        </ul>
      </a>
    </li>
     <?php }
      if(xyzAccesscontrol('page_managment','Full')==TRUE){ ?>
    <li class="nav-item  "> <a href="<?php echo base_url('admin/managepages'); ?>" class="nav-link nav-toggle"> <i class="icon-settings"></i> <span class="title">Page Management</span></a>
    </li>
    <?php }
      if(xyzAccesscontrol('flyer_managment','Full')==TRUE){ ?>
    <li class="nav-item  "> <a href="<?php echo base_url('flyers_management'); ?>" class="nav-link nav-toggle"> <i class="icon-bulb"></i> <span class="title">Flyer Management</span><span class="arrow"></span></a>
     <ul class="sub-menu">
     <? if(xyzAccesscontrol('flyer_managment','Read')==TRUE){ ?>
      <li class="nav-item  ">
        <a href="<?php echo base_url('admin_flyers'); ?>" class="nav-link ">
          <span class="title">View All Flyer</span>
        </a>
      </li>
      <? }if(xyzAccesscontrol('user_flyer','Read')==TRUE){ ?>
      <li class="nav-item  ">
        <a href="<?php echo base_url('user_flyers'); ?>" class="nav-link ">
          <span class="title">User Created Flyer</span>
        </a>
      </li>
      <? }if(xyzAccesscontrol('flyer_tags','Full')==TRUE){ ?>
      <li class="nav-item  ">
        <a href="<?php echo base_url('flyer_tags'); ?>" class="nav-link ">
          <span class="title">Flyer Tags</span>
        </a>
      </li>
      <? }if(xyzAccesscontrol('flyer_managment','Add')==TRUE){ ?>
      <li class="nav-item  ">
        <a href="<?php echo base_url('admin/manageflyers/save'); ?>" class="nav-link ">
          <span class="title">Add New Flyer</span>
        </a>
      </li>
      <? }if(xyzAccesscontrol('flyer_managment','Word')==TRUE){ ?>
      <li class="nav-item  ">
        <a href="<?php echo base_url('admin_flyers/word'); ?>" class="nav-link ">
          <span class="title">Export Flyer (Word)</span>
        </a>
      </li>
      <? }if(xyzAccesscontrol('flyer_managment','Excel')==TRUE){ ?>
      <li class="nav-item  ">
        <a href="<?php echo base_url('admin_flyers/excel'); ?>" class="nav-link ">
          <span class="title">Export Flyer (Excel)</span>
        </a>
      </li>
      <? }if(xyzAccesscontrol('flyer_managment','ViewLog')==TRUE){ ?>
      <li class="nav-item  ">
        <a href="<?php echo base_url('Admin_activity/flyerActivity'); ?>" class="nav-link ">
          <span class="title">Flyer Logs</span>
        </a>
      </li>
      <? } ?>
    </ul>
  </li>
  <?php }
      if(xyzAccesscontrol('order_managment','Full')==TRUE){ ?>
  <li class="nav-item  "> <a href="<?php echo base_url('admin_orders'); ?>" class="nav-link nav-toggle"> <i class="icon-briefcase"></i> <span class="title">Order Management</span></a>
  </li>
  <?php }
      if(xyzAccesscontrol('coupen_managment','Full')==TRUE){ ?>
  <li class="nav-item  "> <a href="<?php echo base_url('admin_coupons'); ?>" class="nav-link nav-toggle"> <i class="icon-wallet"></i> <span class="title">Coupon Management</span></a>
  </li>
  <?php }
      if(xyzAccesscontrol('flyer_managment','Full')==TRUE){ ?>
  <li class="nav-item  "> <a href="<?php echo base_url('admin/settings'); ?>" class="nav-link nav-toggle"> <i class="icon-pointer"></i> <span class="title">Designer Settings</span><span class="arrow"></span></a>
    <ul class="sub-menu">
    <?php if(xyzAccesscontrol('flyer_shapes','Full')==TRUE){  ?>
      <li class="nav-item  ">
        <a href="<?php echo base_url('admin_svgs'); ?>" class="nav-link ">
          <span class="title">Manage Flyer Shapes</span>
        </a>
      </li>
      <?php } 
      if(xyzAccesscontrol('flyer_sizes','Full')==TRUE){ ?>
      <li class="nav-item  ">
        <a href="<?php echo base_url('flyer_size'); ?>" class="nav-link ">
          <span class="title">Manage Flyer Sizes</span>
        </a>
      </li>
       <?php } 
      if(xyzAccesscontrol('flyer_fonts','Full')==TRUE){ ?>
      <li class="nav-item  ">
        <a href="<?php echo base_url('admin_fonts'); ?>" class="nav-link ">
          <span class="title">Manage Fonts</span>
        </a>
      </li>
      <?php } 
      if(xyzAccesscontrol('flyer_tags','Full')==TRUE){ ?>
      <li class="nav-item  ">
        <a href="<?php echo base_url('flyer_tags'); ?>" class="nav-link ">
          <span class="title">Manage Flyer Tags</span>
        </a>
      </li>
      <?php } 
      if(xyzAccesscontrol('flyer_shapes','Add')==TRUE){ ?>
      <!-- <li class="nav-item  ">
        <a href="<?php echo base_url('admin_svgs/create'); ?>" class="nav-link ">
          <span class="title">Add Flyer Shape</span>
        </a>
      </li> -->
      <?php } 
      if(xyzAccesscontrol('flyer_sizes','Add')==TRUE){ ?>
      <!-- <li class="nav-item  ">
        <a href="<?php echo base_url('flyer_size/create'); ?>" class="nav-link ">
          <span class="title">Add Flyer Size</span>
        </a>
      </li> -->
       <?php } 
      if(xyzAccesscontrol('flyer_fonts','Add')==TRUE){ ?>
     <!--  <li class="nav-item  ">
       <a href="<?php echo base_url('admin_fonts/create'); ?>" class="nav-link ">
         <span class="title">Add Font</span>
       </a>
     </li> -->
       <?php } 
      if(xyzAccesscontrol('flyer_tags','Add')==TRUE){ ?>
      <!-- <li class="nav-item  ">
        <a href="<?php echo base_url('flyer_tags/create'); ?>" class="nav-link ">
          <span class="title">Add Flyer Tag</span>
        </a>
      </li> -->
      <?php } ?>
    </ul>
  </li>
  <?php }
      if(xyzAccesscontrol('activity_managment','Full')==TRUE){ ?>
  <li class="nav-item  "> <a href="<?php echo base_url('admin_logs'); ?>" class="nav-link nav-toggle"> <i class="icon-layers"></i> <span class="title">Activity Logs</span></a>
  </li>
  <?php } 
  if(xyzAccesscontrol('email_management','Full')==TRUE){ ?>
  <li class="nav-item  <?php if($this->uri->segment(1)=='email' || $this->uri->segment(1)=='Email_databaseManagement' || $this->uri->segment(1)=='bulk_emails' || $this->uri->segment(3)=='email_tracking'){ echo 'open';}?>"> <a href="<?php echo base_url('emailmanagement'); ?>" class="nav-link nav-toggle"> <i class="icon-bar-chart"></i> <span class="title">Email Management</span><span class="arrow"></span></a>
	 <ul class="sub-menu"  <?php if($this->uri->segment(1)=='email' || $this->uri->segment(1)=='Email_databaseManagement' || $this->uri->segment(1)=='bulk_emails' || $this->uri->segment(3)=='email_tracking'){ ?> style="display: block;" <?php }?>>
    <? if(xyzAccesscontrol('reports_management','Full')==TRUE){ ?>
      <li class="nav-item <?php if($this->uri->segment(1)=='Email_databaseManagement'){ echo 'open';}?>">
        <a href="<?php echo base_url('Email_databaseManagement'); ?>" class="nav-link ">
          <span class="title">Emails List</span>
        </a>
      </li>
      <? } if(xyzAccesscontrol('reports_management','Full')==TRUE){ ?>
      <li class="nav-item <?php if($this->uri->segment(1)=='email'){ echo 'open';}?>">
        <a href="<?php echo base_url('email'); ?>" class="nav-link ">
          <span class="title">Emails Import</span>
        </a>
      </li>
      <? } ?>
       <?  if(xyzAccesscontrol('reports_management','Full')==TRUE){ ?>
         <li class="nav-item <?php if($this->uri->segment(1)=='bulk_emails'){ echo 'open';}?> ">
           <a href="<?php echo base_url('bulk_emails'); ?>" class="nav-link ">
             <span class="title">Bulk Email</span>
           </a>
         </li>
       <? } ?>
       <?  if(xyzAccesscontrol('reports_management','Full')==TRUE){ ?>
         <li class="nav-item <?php if($this->uri->segment(3)=='email_tracking'){ echo 'open';}?> ">
           <a href="<?php echo base_url('admin/managereports/email_tracking'); ?>" class="nav-link ">
             <span class="title">Email Tracking</span>
           </a>
         </li>
       <? } ?>
      <?  if(xyzAccesscontrol('reports_management','Full')==TRUE){ ?>
         <li class="nav-item">
           <a href="<?php echo base_url('Admin_subscription'); ?>" class="nav-link ">
             <span class="title">Email Subscribers</span>
           </a>
         </li>
       <? } ?>
	    <?  if(xyzAccesscontrol('reports_management','Full')==TRUE){ ?>
         <li class="nav-item">
           <a href="<?php echo base_url('email_unsubscribers'); ?>" class="nav-link ">
             <span class="title">Email Unsubscribers</span>
           </a>
         </li>
       <? } ?>
    </ul>
  
  </li>
  <? } if($this->session->userdata('admin_data')['pk_my_type']==0) { ?>
  <li class="nav-item  "> <a href="<?php echo base_url('permission'); ?>" class="nav-link nav-toggle"> <i class="icon-key"></i> <span class="title">Permission</span></a>
  </li>

  </li>

  <?php } if(xyzAccesscontrol('reports_management','Full')==TRUE){ ?>
   <li class="nav-item"> <a href="<?php echo base_url('reports'); ?>" class="nav-link nav-toggle"> <i class="fa fa-list-alt"></i> <span class="title">Reports</span><span class="arrow"></span></a>
    
    <ul class="sub-menu">
    <? if(xyzAccesscontrol('reports_management','Full')==TRUE){ ?>
      <li class="nav-item  ">
        <a href="<?php echo base_url('reports/orders'); ?>" class="nav-link ">
          <span class="title">Orders</span>
        </a>
      </li>
      <? } if(xyzAccesscontrol('reports_management','Full')==TRUE){ ?>
      <li class="nav-item  ">
        <a href="<?php echo base_url('reports/emails'); ?>" class="nav-link ">
          <span class="title">Emails</span>
        </a>
      </li>
      <? } ?>
    </ul>
  </li>
  
  <? } ?>
  
   <?php  if(xyzAccesscontrol('reports_management','Full')==TRUE){ ?>
   <li class="nav-item"> <a href="<?php echo base_url('Admin_newsletter'); ?>" class="nav-link nav-toggle"> <i class="fa fa-list-alt"></i> <span class="title">Newsletter</span><span class="arrow"></span></a>
    
    <ul class="sub-menu">
   <?  if(xyzAccesscontrol('reports_management','Full')==TRUE){ ?>
      <li class="nav-item  ">
        <a href="<?php echo base_url('Admin_newsletter/index'); ?>" class="nav-link ">
          <span class="title">Newsletter Subscriptions</span>
        </a>
      </li>
    
      <? } ?>
    </ul>
  </li>
  
  <? } ?>
 
   <li class="nav-item  "> <a href="<?php echo base_url('Frontend_settings/frontend_dashboard'); ?>" class="nav-link nav-toggle"> <i class="icon-users"></i> <span class="title">Frontend Settings</span> <span class="arrow"></span></a>
         <ul class="sub-menu">
         <?php if(xyzAccesscontrol('admin_managment','Read')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('Frontend_settings/index'); ?>" class="nav-link ">
              <span class="title">Home Slider</span>
            </a>
          </li>
          <?php }
          if(xyzAccesscontrol('admin_managment','Read')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('Frontend_settings/aboutus'); ?>" class="nav-link ">
              <span class="title">Aboutus Slider</span>
            </a>
          </li>
          <?php }
          if(xyzAccesscontrol('admin_managment','Read')==TRUE){ ?>
          <li class="nav-item  ">
            <a href="<?php echo base_url('Frontend_settings/howitworks'); ?>" class="nav-link ">
              <span class="title">How it works Slider</span>
            </a>
          </li>
          <?php } ?>
      
        </ul>
  </li>
 <li class="nav-item  <?php if($this->uri->segment(2)=='site_settings' ){ echo 'open';}?>"> <a href="<?php echo base_url('admins/site_settings'); ?>" class="nav-link nav-toggle"> <i class="icon-settings"></i> <span class="title">Site Settings</span></a>
  
</ul>
<!-- END SIDEBAR MENU -->
<!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
</div>