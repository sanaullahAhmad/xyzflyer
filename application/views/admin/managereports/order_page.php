<div class="page-content"> 
  <!-- BEGIN PAGE HEADER--> 
  <!--JUst Display THEME PANEL  on home page -->
  <!-- BEGIN THEME PANEL -->
  <?php if($this->uri->segment(1)=='admin'){ $this->load->view('admin/metronic_theme/common_pages/theme_setting'); }?>
  <!-- END THEME PANEL --> 
  
  <!-- BEGIN PAGE BAR -->
  <div class="page-bar">
    <ul class="page-breadcrumb">
      <li> <a href="<?php echo base_url('admin'); ?>">Home</a> <i class="fa fa-circle"></i> </li>
      <li> <span>Reports</span> <i class="fa fa-circle"></i></li> <li> <span class="thin">Orders</span></li>
    </ul>
    <div class="page-toolbar">
      <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range"> <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase hidden-xs"></span>&nbsp; <i class="fa fa-angle-down"></i> </div>
    </div>
  </div>
  <!-- END PAGE BAR --> 
  <!-- BEGIN PAGE TITLE-->
 <p>&nbsp;</p>
  <!-- END PAGE TITLE--> 
  <!-- END PAGE HEADER--> 
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a style="cursor:default;" class="dashboard-stat dashboard-stat-v2 blue" href="javascript:void(0)">
      <div class="visual"> <i class="fa fa-shopping-cart"></i> </div>
      <div class="details">
        <div class="number">
          <span data-counter="counterup" data-value="<?php if(isset($approve_orders)){echo $approve_orders;} ?>"></span> </div>
          <div class="desc">Approved Orders</div>
        </div>
      </a> </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a style="cursor:default;" class="dashboard-stat dashboard-stat-v2 red" href="javascript:void(0)">
        <div class="visual"><i class="fa fa-close"></i></div>
        <div class="details">
          <div class="number"><span data-counter="counterup" data-value="<?php if(isset($trashed_orders)){echo $trashed_orders;} ?>"></span></div>
          <div class="desc">Trashed Orders</div>
        </div>
      </a> </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a style="cursor:default;" class="dashboard-stat dashboard-stat-v2 green" href="javascript:void(0)">
        <div class="visual"> <i class="fa fa-bar-chart-o"></i> </div>
        <div class="details">
          <div class="number"> <span data-counter="counterup" data-value="<?php if(isset($pending_orders)){echo $pending_orders;} ?>"></span> </div>
          <div class="desc"> Pending Orders </div>
        </div>
      </a> </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a style="cursor:default;" class="dashboard-stat dashboard-stat-v2 purple" href="#">
        <div class="visual"> <i class="fa fa-globe"></i> </div>
        <div class="details">
          <div class="number"><span data-counter="counterup" data-value="<?php if(isset($rejected_orders)){ echo $rejected_orders;} ?>"></span></div>
          <div class="desc"> Rejected Orders </div>
        </div>
      </a> </div>
    </div>
    <div class="clearfix"></div>
    <!-- Begin: Demo Datatable 1 -->
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-shopping-cart"></i>
          <span class="caption-subject font-dark sbold uppercase">Orders List</span>
        </div>
          </div>
          <div class="portlet-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover table-checkable" 
                id="datatable_orders">
                  <thead>
                    <tr role="row" class="heading">
                      <th width="2%">
                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                          <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                          <span></span>
                        </label>
                      </th>
                      <th width="5%"> Order&nbsp;# </th>
                      <th> Flyer title </th>
                       <th> Flyer Image </th>
                      <th > Date </th>
                      <th> User Name</th>

                      <th> Total Price </th>
                      <th> Total Agents </th>
                      <th> Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th width="10%"> Actions </th>

                    </tr>
                    <tr role="row" class="filter">
                      <td> </td>
                      <td>
                        <input type="text" class="form-control form-filter input-sm" name="order_id"> </td>
                        <td>
                        <input type="text" class="form-control form-filter input-sm" name="flyer_title">
                        </td>
                        <td>
                        </td>
                        <td>
                          <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                            <input type="text" class="form-control form-filter input-sm" readonly name="order_date_from" placeholder="From">
                            <span class="input-group-btn">
                              <button class="btn btn-sm default" type="button">
                                <i class="fa fa-calendar"></i>
                              </button>
                            </span>
                          </div>
                          <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                            <input type="text" class="form-control form-filter input-sm" readonly name="order_date_to" placeholder="To">
                            <span class="input-group-btn">
                              <button class="btn btn-sm default" type="button">
                                <i class="fa fa-calendar"></i>
                              </button>
                            </span>
                          </div>
                        </td>
                        <td>
                          <input type="text" class="form-control form-filter input-sm" name="order_customer_fname" placeholder="First name"> <br/><input type="text" class="form-control form-filter input-sm" name="order_customer_lname" placeholder="Last Name"></td>

                          <td>
                            <div class="margin-bottom-5">
                              <input type="text" class="form-control form-filter input-sm" name="order_price_from" placeholder="From" /> </div>
                              <input type="text" class="form-control form-filter input-sm" name="order_price_to" placeholder="To" /> </td>
                              <td>
                                <div class="margin-bottom-5">
                                  <input type="text" class="form-control form-filter input-sm margin-bottom-5 clearfix" name="order_quantity_from" placeholder="From" /> </div>
                                  <input type="text" class="form-control form-filter input-sm" name="order_quantity_to" placeholder="To" /> </td>
                                  <td>
                                    <select name="order_status" class="form-control form-filter input-sm">
                                      <option value="">Select...</option>
                                      <option value="-1">Closed</option>
                                      <option value="'0'">Pending</option>
                                      <option value="1">Approved</option>
                                      <option value="2">Rejected</option>
                                    </select>
                                  </td>
                                  <td>
                                    <div class="margin-bottom-5">
                                      <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                        <i class="fa fa-search"></i> Search</button>
                                      </div>
                                      <button class="btn btn-sm red btn-outline filter-cancel">
                                        <i class="fa fa-times"></i> Reset</button>
                                      </td>
                                    </tr>
                                  </thead>
                                  <tbody></tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <!-- End: Demo Datatable 1 -->
                        </div>
