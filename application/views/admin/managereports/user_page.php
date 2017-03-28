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
      <li> <span>Reports</span><i class="fa fa-circle"></i>
      </li><li><span class="thin">Emails</span></li>
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
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a style="cursor:pointer;" class="dashboard-stat dashboard-stat-v2 blue" href="javascript:subscribed_emails('0');">
      <div class="visual"> <i class="fa fa-shopping-cart"></i> </div>
      <div class="details">
        <div class="number" id="subscribed">
          <span data-counter="counterup" data-value="<?php if(isset($active_emails)){echo $active_emails;} ?>"></span> </div>
          <div class="desc">Total Active Emails</div>
        </div>
      </a> </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a style="cursor:pointer;" class="dashboard-stat dashboard-stat-v2 red" href="javascript:subscribed_emails(1);">
        <div class="visual"><i class="fa fa-close"></i></div>
        <div class="details">
          <div class="number"><span data-counter="counterup" data-value="<?php if(isset($inactive_emails)){echo $inactive_emails;} ?>"></span></div>
          <div class="desc">Total Removed Emails</div>
        </div>
      </a> </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a style="cursor:default;" class="dashboard-stat dashboard-stat-v2 yellow" href="javascript:void('0')">
        <div class="visual"> <i class="fa fa-bar-chart-o"></i> </div>
        <div class="details">
          <div class="number"> <span data-counter="counterup" data-value="<?php if(isset($sendGrid_response)){
           echo $sendGrid_response['bounces'];
          } ?>"></span></div>
          <div class="desc">Bounced Emails</div>
        </div>
      </a> </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a style="cursor:default;" class="dashboard-stat dashboard-stat-v2 purple" href="javascript:void(0)">
        <div class="visual"> <i class="fa fa-globe"></i> </div>
        <div class="details">
          <div class="number"><span data-counter="counterup" data-value="<?php if(isset($sendGrid_response)){echo $sendGrid_response['opens'];} ?>"></span> </div>
          <div class="desc"> Opened Emails </div>
        </div>
      </a> </div>
    </div>
    <div class="clearfix"></div>
     <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a style="cursor:default;" class="dashboard-stat dashboard-stat-v2 yellow" href="javascript:void('0')">
      <div class="visual"> <i class="fa fa-bar-chart-o"></i> </div>
      <div class="details">
        <div class="number">
          <span data-counter="counterup" data-value="<?php if(isset($sendGrid_response)){echo $sendGrid_response['requests'];} ?>"></span> </div>
          <div class="desc">Total Requets</div>
        </div>
      </a> </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a style="cursor:default;" class="dashboard-stat dashboard-stat-v2 purple" href="javascript:void(0)">
        <div class="visual"><i class="fa fa-shopping-cart"></i></div>
        <div class="details">
          <div class="number"><span data-counter="counterup" data-value="<?php if(isset($sent_emails)){echo $sent_emails[0]['total_emails'];} ?>"></span></div>
          <div class="desc">Sent Emails</div>
        </div>
      </a> </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a style="cursor:default;" class="dashboard-stat dashboard-stat-v2 red" href="javascript:void(0)">
        <div class="visual"> <i class="fa fa-close"></i> </div>
        <div class="details">
          <div class="number"> <span data-counter="counterup" data-value="<?php if(isset($sendGrid_response)){
           echo $sendGrid_response['invalid_emails'];
          } ?>"></span></div>
          <div class="desc">Invalid Emails</div>
        </div>
      </a> </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a style="cursor:default;" class="dashboard-stat dashboard-stat-v2 green" href="javascript:void(0)">
        <div class="visual"> <i class="fa fa-globe"></i> </div>
        <div class="details">
          <div class="number"><span data-counter="counterup" data-value="<?php if(isset($sendGrid_response)){echo $sendGrid_response['delivered'];} ?>"></span> </div>
          <div class="desc"> Delivered Emails </div>
        </div>
      </a> </div>
    </div>
    <div class="clearfix"></div>
    <!-- Begin: Demo Datatable 1 -->
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-shopping-cart"></i>
          <span class="caption-subject font-dark sbold uppercase">Emails List</span>
        </div>
        <div class="col-md-4 text-left">
             <div style="margin-top: 8px" id="message">
                 <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
             </div>
         </div>
      </div>
      <div class="portlet-body">
        <div class="table-container">
            <table class="table table-striped table-bordered table-hover table-checkable" 
            id="datatable_emails">
            <thead>
              <tr role="row" class="heading">
                <th width="2%">
                  <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                    <span></span>
                  </label>
                </th>
                <th width="3%"> Sr.&nbsp;no </th>
                <th width="10%"> Agency Name </th>
                <th width="15%"> Agent First Name</th>+
				 <th width="15%"> Agent Last Name</th>

                <th width="10%"> Email </th>
                <th width="10%"> State </th>
                <th width="10%"> County </th>
                <th width="10%"> City </th>
                <th width="10%"> Status </th>
                <th width="10%"> Actions </th>

              </tr>
              <tr role="row" class="filter">
                <td> </td>
                <td>
                 
                  <td>
                    <input type="text" class="form-control form-filter input-sm" name="agency_name" placeholder="Agency Name">
                  </td>
                  <td>
                    <input type="text" class="form-control form-filter input-sm" name="agent_First_name" placeholder="Agent First Name">
                   </td>
					<td>
                    <input type="text" class="form-control form-filter input-sm" name="agent_last_name" placeholder="Agent Last Name">
                   </td>
                    <td>
                     <input type="text" class="form-control form-filter input-sm" name="agent_email" placeholder="Email">
                      </td>
                        <td>
                        <input type="text" class="form-control form-filter input-sm" name="agent_state" placeholder="State">
                         </td>
                            <td><input type="text" class="form-control form-filter input-sm" name="agent_county" placeholder="County"></td>
                             <td><input type="text" class="form-control form-filter input-sm" name="agent_city" placeholder="City">
                             </td>
                            <td>
                              <select name="agent_status" class="form-control form-filter input-sm agent_status">
                                <option value="">Select...</option>
                                <option value="-1">Closed</option>
                                <option value="0">Subscribed</option>
                                <option value="1">Unubscribed</option>
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
<script>
function subscribed_emails(value){
	
	// $(".agent_status").attr('value', -1).attr('selected', 'selected');
	if(value == -1){
		 $('.agent_status option[value=-1]').prop('selected','selected');
        $('.filter-submit').trigger('click');
		$('html, body').animate({
        scrollTop: $("#datatable_emails").offset().top
      });
	}else if(value == 1){
		
		$('.agent_status option[value=1]').prop('selected','selected');
        $('.filter-submit').trigger('click');
		$('html, body').animate({
        scrollTop: $("#datatable_emails").offset().top
      });
	}else{
		 $('.agent_status option[value="' + value + '"]').prop('selected','selected');
        $('.filter-submit').trigger('click');
		//$( "#datatable_emails" ).scroll();
		$('html, body').animate({
        scrollTop: $("#datatable_emails").offset().top
      });
	}
}			
</script>