<div id="page-wrapper" >
  <div class="page-content">
    <h2 style="display: inline-block; margin: 0; margin-bottom: 10px;">Welcome <?php if ($this->session->userdata('admin_data') != "") { echo $this->session->userdata['admin_data']['username'];} ?>, <small>Love to see you back. </small></h2>
    <!-- <div class="row">
      <div class="col-md-12">

       <hr>
       </div>
     </div> -->
     <?php if($check){?>

       <div class="row">
         <div class="col-md-12">
           <h4>System Statistics:</h4>

           <div class="">
             <div class="row" style="display:none;">
               <div class="col-md-3" id="admin">
                 <div class="bx">
                   <h3 id="admins">Admins</h3>
                   <hr>
                   <a data-toggle="tooltip" data-placement="left" title="View All Admins" href="<?php echo site_url().'admins/list_all'; ?>">
                     <i class="fa fa-users fa-lg"></i>

                   </a>
                   <a data-toggle="tooltip" data-placement="left" title="View Admin Logs" href="<?=site_url('admin_logs')?>">
                    <i class="fa fa-files-o fa-lg"></i>

                  </a>
                  <a data-toggle="tooltip" data-placement="left" title="View Admin Activity" href="<?=site_url('activity_logs')?>">
                    <i class="fa fa-search fa-lg"></i>

                  </a>
                  <a data-toggle="tooltip" data-placement="left" title="Add New Admin" href="<?=site_url('admins/create')?>">
                    <i class="fa fa-lg fa-plus"></i>

                  </a>
              <!-- </div>
              <div class="col-md-3"> -->
              </div>
            </div>
            <div class="col-md-3" id="users">
              <div class="bx">
               <h3 id="users">Users</h3>
               <hr>
               <a data-toggle="tooltip" data-placement="left" title="View All Users" href="<?=site_url('users')?>">
                 <i class="fa fa-users fa-lg"></i>

               </a>
               <a data-toggle="tooltip" data-placement="left" title="View User Logs" href="<?=site_url('user_logs')?>">
                <i class="fa fa-files-o fa-lg"></i>

              </a>
              <a data-toggle="tooltip" data-placement="left" title="View User Activity" href="<?=site_url('user_activity')?>">
                <i class="fa fa-search fa-lg"></i>

              </a>
              <a data-toggle="tooltip" data-placement="left" title="Add New User" href="<?=site_url('users/create')?>">
                <i class="fa fa-lg fa-plus"></i>

              </a>
            </div></div>

            <div class="col-md-3" id="flyers">
              <div class="bx">
               <h3 id="flyers">Flyers</h3>
               <hr>
               <a data-toggle="tooltip" data-placement="left" title="View All Flyers" href="">
                 <i class="fa fa-users fa-lg"></i>

               </a>
               <a data-toggle="tooltip" data-placement="left" title="View User Flyers" href="">
                <i class="fa fa-files-o fa-lg"></i>

              </a>
              <a data-toggle="tooltip" data-placement="left" title="View New Flyers" href="">
                <i class="fa fa-search fa-lg"></i>

              </a>
              <a data-toggle="tooltip" data-placement="left" title="Add New Flyer" href="">
                <i class="fa fa-lg fa-plus"></i>

              </a>
            </div></div>

            <div class="col-md-3" id="orders">
              <div class="bx">
               <h3 id="orders">Orders</h3>
               <hr>
               <a data-toggle="tooltip" data-placement="left" title="View All Orders" href="">
                 <i class="fa fa-users fa-lg"></i>

               </a>
               <a data-toggle="tooltip" data-placement="left" title="View Successful Orders" href="">
                <i class="fa fa-files-o fa-lg"></i>

              </a>
              <a data-toggle="tooltip" data-placement="left" title="View Pending Orders" href="">
                <i class="fa fa-search fa-lg"></i>

              </a>
              <a data-toggle="tooltip" data-placement="left" title="Add New Orders" href="">
                <i class="fa fa-lg fa-plus"></i>

              </a>
            </div>

            <!-- <h3>Manage Admins</h3> -->

          </div>
        </div>
        <br>
        <div class="row" style="display:none;">
          <br>
          <div  id="admins_stats"  class="summary">
            <div class="col-md-7">
              <table class="table table-bordered">
                <tr>
                  <td>Super Admins</td>
                  <td>Template Designers</td>
                  <td>Accounts Managers</td>
                  <td>Sales Managers</td>
                </tr>
                <tr>
                  <td><a href="<?php echo site_url().'admins/list_all/00'; ?>"><?php echo $super_admins; ?></a></td>
                  <td><a href="<?php echo site_url().'admins/list_all/1'; ?>"><?php echo $template_designers; ?></a></td>
                  <td><a href="<?php echo site_url().'admins/list_all/2'; ?>"><?php echo $accounts_manager; ?></a></td>
                  <td><a href="<?php echo site_url().'admins/list_all/3'; ?>"><?php echo $sales_manager; ?></a></td>
                </tr>
                <tr><td colspan="4">Total Admins: <?php echo $super_admins+$template_designers+$accounts_manager+$sales_manager; ?></td></tr>
              </table>
            </div>
            <div class="col-md-5">
              <canvas id="admins_chart" width="257" height="257"></canvas>
            </div>
          </div>

          <div  id="users_stats"  class="summary" style="display: none">
            <div class="col-md-7">
              <table class="table table-bordered">
                <tr>
                  <td>Active Users</td>
                  <td>Unverfied Users</td>
                  <td>Suspended Users</td>
                  <!-- <td>Sales Managers</td> -->
                </tr>
                <tr>
                  <td><a href="<?php echo site_url().'users/list_all/00'; ?>"><?php echo $active_users; ?></a></td>
                  <td><a href="<?php echo site_url().'users/list_all/1'; ?>"><?php echo $unverified_users; ?></a></td>
                  <td><a href="<?php echo site_url().'users/list_all/2'; ?>"><?php echo $suspended_users; ?></a></td>
                  <!-- <td><a href="<?php echo site_url().'users/list_all/3'; ?>"><?php echo $sales_manager; ?></a></td> -->
                </tr>
                <tr><td colspan="5">Total Users: <?php echo $active_users+$unverified_users+$suspended_users; ?></td></tr>
              </table>
            </div>
            <div class="col-md-5">
              <canvas id="users_chart" width="257" height="260"></canvas>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
           <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

              <div class="portlet light bordered">
                <div class="portlet-title">
                  <div class="caption ">
                    <span class="caption-subject font-dark bold uppercase">Sales By Region</span>
                    <span class="caption-helper"></span>
                  </div>

                </div>
                <div class="portlet-body">
                  <div id="dash-sales-by-region-county" style="width: 300px; height:300px; position:absolute;left:250px; bottom:150px; z-index:1;"> </div>
                  <div id="dash-sales-by-region" style="z-index:0; position:relative;" class="CSSAnimationChart"></div>
                </div>
              </div>

            </div>
          </div>


          <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

              <div class="portlet light bordered">
                <div class="portlet-title">
                  <div class="caption">
                    <i class="icon-cursor font-dark hide"></i>
                    <span class="caption-subject font-dark bold uppercase">General Stats</span>
                  </div>
                </div>
                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="easy-pie-chart">
                        <div id="number-delivered" class="number delivered">
                          <span></span>% <canvas height="75" width="75"></canvas></div>
                          <a class="title" href="javascript:;"> Delivered
                            <i class="icon-arrow-right"></i>
                          </a>
                        </div>
                      </div>
                      <div class="margin-bottom-10 visible-sm"> </div>
                      <div class="col-md-4">
                        <div class="easy-pie-chart">
                          <div id="number-clicks" class="number clicks">
                            <span></span>% <canvas height="75" width="75"></canvas></div>
                            <a class="title" href="javascript:;"> Clicks
                              <i class="icon-arrow-right"></i>
                            </a>
                          </div>
                        </div>
                        <div class="margin-bottom-10 visible-sm"> </div>
                        <div class="col-md-4">
                          <div class="easy-pie-chart">
                            <div id="number-bounce" class="number bounce">
                              <span></span>% <canvas height="75" width="75"></canvas></div>
                              <a class="title" href="javascript:;"> Bounce
                                <i class="icon-arrow-right"></i>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                <div class="portlet light bordered">

                  <div class="portlet-title">
                    <div class="caption">
                      <i class="icon-share font-dark hide"></i>
                      <span class="caption-subject font-dark bold uppercase">Regional Stats</span>
                    </div>

                  </div>

                  <div class="portlet-body">
                    <div id="dash-regional-stats">

                    </div>
                  </div> <!-- end of portley-body -->




                </div>

              </div>








            </div>

            <div class="row">

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="portlet light bordered">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="icon-bubble font-dark hide"></i>
                      <span class="caption-subject font-hide bold uppercase">Recent Users</span>
                    </div>

                  </div>
                  <div class="portlet-body">
                    <div class="row">
                      <div class="col-md-4">
                        <!--begin: widget 1-1 -->
                        <div id="mt-widget-user-1" class="mt-widget-1">
                          <div class="mt-icon">
                            <a href="#">
                              <i class="icon-plus"></i>
                            </a>
                          </div>
                          <div class="mt-img">
                            <img width="80" height="80" src="<?=base_url('metronic_src/pages/media/users/avatar80_8.jpg')?>"> </div>
                            <div class="mt-body">
                              <h3 class="mt-username">Diana Ellison</h3>
                              <p class="mt-user-title"> Lorem Ipsum is simply dummy text. </p>
                              <div class="mt-stats">
                                <div class="btn-group btn-group btn-group-justified">
                                  <a href="javascript:;" title="active users" class="btn font-red">
                                    <i class="icon-bubbles"></i> 1,7k </a>
                                    <a href="javascript:;"  title="sent email" class="btn font-green">
                                      <i class="icon-social-twitter"></i> 2,6k </a>
                                      <a href="javascript:;" title="active !!!" class="btn font-yellow">
                                        <i class="icon-emoticon-smile"></i> 3,7k </a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!--end: widget 1-1 -->
                              </div>
                              <div class="col-md-4">
                        <!--begin: widget 1-1 -->
                        <div id="mt-widget-user-2" class="mt-widget-1">
                          <div class="mt-icon">
                            <a href="#">
                              <i class="icon-plus"></i>
                            </a>
                          </div>
                          <div class="mt-img">
                            <img width="80" height="80" src="<?=base_url('metronic_src/pages/media/users/avatar80_8.jpg')?>"> </div>
                            <div class="mt-body">
                              <h3 class="mt-username">Diana Ellison</h3>
                              <p class="mt-user-title"> Lorem Ipsum is simply dummy text. </p>
                              <div class="mt-stats">
                                <div class="btn-group btn-group btn-group-justified">
                                  <a href="javascript:;" title="active users" class="btn font-red">
                                    <i class="icon-bubbles"></i> 1,7k </a>
                                    <a href="javascript:;"  title="sent email" class="btn font-green">
                                      <i class="icon-social-twitter"></i> 2,6k </a>
                                      <a href="javascript:;" title="active !!!" class="btn font-yellow">
                                        <i class="icon-emoticon-smile"></i> 3,7k </a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!--end: widget 1-1 -->
                              </div>
                              <div class="col-md-4">
                        <!--begin: widget 1-1 -->
                        <div id="mt-widget-user-3" class="mt-widget-1">
                          <div class="mt-icon">
                            <a href="#">
                              <i class="icon-plus"></i>
                            </a>
                          </div>
                          <div class="mt-img">
                            <img width="80" height="80" src="<?=base_url('metronic_src/pages/media/users/avatar80_8.jpg')?>"> </div>
                            <div class="mt-body">
                              <h3 class="mt-username">Diana Ellison</h3>
                              <p class="mt-user-title"> Lorem Ipsum is simply dummy text. </p>
                              <div class="mt-stats">
                                <div class="btn-group btn-group btn-group-justified">
                                  <a href="javascript:;" title="active users" class="btn font-red">
                                    <i class="icon-bubbles"></i> 1,7k </a>
                                    <a href="javascript:;"  title="sent email" class="btn font-green">
                                      <i class="icon-social-twitter"></i> 2,6k </a>
                                      <a href="javascript:;" title="active !!!" class="btn font-yellow">
                                        <i class="icon-emoticon-smile"></i> 3,7k </a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!--end: widget 1-1 -->
                              </div>


                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="portlet light ">
                                          <div class="portlet-title">
                                            <div class="caption">
                                              <span class="caption-subject bold uppercase font-dark">Revenue</span>
                                              <span class="caption-helper">distance stats...</span>
                                            </div>
                                            <div class="actions">
                                              <a class="btn btn-circle btn-icon-only btn-default" href="#">
                                                <i class="icon-cloud-upload"></i>
                                              </a>
                                              <a class="btn btn-circle btn-icon-only btn-default" href="#">
                                                <i class="icon-wrench"></i>
                                              </a>
                                              <a class="btn btn-circle btn-icon-only btn-default" href="#">
                                                <i class="icon-trash"></i>
                                              </a>
                                              <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
                                            </div>
                                          </div>
                                          <div class="portlet-body">
                                            <div id="dashboard_amchart_1" class="CSSAnimationChart" ></div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="portlet light ">
                                          <div class="portlet-title">
                                            <div class="caption ">
                                              <span class="caption-subject font-dark bold uppercase">Finance</span>
                                              <span class="caption-helper">distance stats...</span>
                                            </div>
                                              <div class="portlet-body">
                                                <div id="dashboard_amchart_3" class="CSSAnimationChart" ></div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="row">
                                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="portlet light calendar bordered">
                                              <div class="portlet-title ">
                                                <div class="caption">
                                                  <i class="icon-calendar font-dark hide"></i>
                                                  <span class="caption-subject font-dark bold uppercase">Feeds</span>
                                                </div>
                                              </div>
                                              <div class="portlet-body">
                                                <div id="calendar" class="fc fc-ltr fc-unthemed"> </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        <!---  ##############FEED START########################## -->

    <div class="col-md-12 col-sm-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light ">
    <div class="portlet-title tabbable-line">
    <div class="caption">
    <i class="icon-globe font-dark hide"></i>
    <span class="caption-subject font-green-steel bold uppercase">Feeds</span>
    </div>
    <ul class="nav nav-tabs">
    <li class="active">
    <a href="#tab_1_1" class="active" data-toggle="tab"> Admin </a>
    </li>
    <li>
    <a href="#tab_1_2" data-toggle="tab"> Users </a>
    </li>
    </ul>
    </div>
    <div class="portlet-body">
    <!--BEGIN TABS-->
    <div class="tab-content">
    <div class="tab-pane active" id="tab_1_1">
    <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
    <ul class="feeds">

    </ul>
    </div>
    </div>
    <div class="tab-pane" id="tab_1_2">
    <div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible1="1">
    <ul class="feeds">

    </ul>
    </div>
    </div>
    </div>
    <!--END TABS-->
    </div>
    </div>
    <!-- END PORTLET-->
    </div>
    </div>

                                        <!-- ################FEED END############# -->



                                      </div>
                                    </div>

<script id="feed-template" type="text/x-handlebars-template">

        {{#each feeds}}
        <li>
          <a href="javascript:;">
              <div class="col1">
                  <div class="cont">
                      <div class="cont-col1">
                          <div class="label label-sm label-success">
                              <i class="fa fa-bell-o"></i>
                          </div>
                      </div>
                      <div class="cont-col2">
                          <div class="desc"> {{activity_txt}} </div>
                      </div>
                  </div>
              </div>
              <div class="col2">
                  <div class="date"> {{activity_dt}} </div>
              </div>
          </a>
      </li>
        {{/each}}


</script>






                                    <script>
                                      $(function () {
                                        $('[data-toggle="tooltip"]').tooltip()
                                      })

                                      $('.bx h3').on('click', function(event) {
                                        event.preventDefault();
                                        _id = $(this).attr('id');
                                        alert(_id+'_stats');
                                        $('.summary').hide();
                                        $('#'+_id+'_stats').slideToggle();
                                      });
                                    </script>

                                    <script type="text/javascript" src="<?php echo site_url(); ?>public/Chart.min.js"></script>
                                    <script type="text/javascript" >
                                      var admins_chart = {
                                        labels: [
                                        "Super Admin",
                                        "Template Designer",
                                        "Account Manager",
                                        "Sales Manager"
                                        ],
                                        datasets: [
                                        {
                                          data: [<?=$super_admins?>, <?=$template_designers?>, <?=$accounts_manager?>, <?=$sales_manager?>],
                                          backgroundColor: [
                                          "#FF6384",
                                          "#36A2EB",
                                          "#FFCE56",
                                          "#B9FF63"
                                          ],
                                          hoverBackgroundColor: [
                                          "#FF6384",
                                          "#36A2EB",
                                          "#FFCE56",
                                          "#B9FF63"
                                          ]
                                        }]
                                      };

                                      var users_chart = {
                                        labels: [
                                        "Active Users",
                                        "Unverfied Users",
                                        "Suspended Users",
        // "Sales Manager"
                                        ],
                                        datasets: [
                                        {
                                          data: [<?=$active_users?>, <?=$unverified_users?>, <?=$suspended_users?>,],
                                          backgroundColor: [
                                          "#B9FF63",
                                          "#36A2EB",
                                          "#FFCE56",
                // "#B9FF63"
                                          ],
                                          hoverBackgroundColor: [
                                          "#B9FF63",
                                          "#36A2EB",
                                          "#FFCE56",
                // "#B9FF63"
                                          ]
                                        }]
                                      };

                                      var ctx = $("#admins_chart");
                                      var myDoughnutChart = new Chart(ctx, {
                                        type: 'doughnut',
                                        data: admins_chart,
    // options: options
                                      });

                                      var ctx = $("#users_chart");
                                      var myDoughnutChart = new Chart(ctx, {
                                        type: 'doughnut',
                                        data: users_chart,
    // options: options
                                      });
                                    </script>


                                    <?php } ?>


                                  </div>
                                </div>

                              </div>
                              <!-- /. PAGE INNER  -->
                            </div>
