 <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<!-- BEGIN QUICK SIDEBAR -->

<script>
function adminNotifications(){
$.ajax({
  type: "POST",
  cache: false,  
  url: "<?php echo base_url();?>Users_activity/ajax_get_users", 
  datatype: "text",
  data: "",
  success: function(x) {
	var x = JSON.parse(x);
	var output='';
		for(var i = 0; i < x.length; i++) {
			var activity = x[i].activity_text;
			
			var myarr = activity.split(" ");

			//Then read the values from the array where 0 is the first
			var myvar = myarr[2] + " " + myarr[3]+" "+myarr[4];
			output+='<li class="media">';
			output+='<div class="media-status">';
			output+='<span class="badge badge-success">' + myarr[7]+' ' + myarr[8]+'</span>';
			output+='</div>';
			output+='<div class="media-body">';
			output+='<h4 class="media-heading">' +myarr[2]+ '</h4>';
			output+='</div>';
			output+='<div class="media-heading-sub">Ordered</div>';
			output+='</li>';
			$('#output').append(output);
		 
		}
  }, 
  error: function(XMLHttpRequest, textStatus, errorThrown) {
       alert(XMLHttpRequest);
    }
 });
}
</script>

<script>

function adminActivity(){
 $.ajax({
  type: "POST",
  cache: false,  
  url: "<?php echo base_url();?>Admin_activity/ajax_get_admin_", 
  datatype: "text",
  data: "",
  success: function(x) {
	 var x = JSON.parse(x);
	var output='';
		for(var i = 0; i < x.length; i++) {
			var activity = x[i].activity_text;
			
			var myarr = activity.split(" ");

			//Then read the values from the array where 0 is the first
			var myvar = myarr[2] + " " + myarr[3]+" "+myarr[4];
			output+='<li class="media">';
			output+='<div class="media-status">';
			output+='<span class="badge badge-success">' + myarr[7]+' ' + myarr[8]+'</span>';
			output+='</div>';
			output+='<div class="media-body">';
			output+='<h4 class="media-heading">' +myarr[2]+ '</h4>';
			output+='</div>';
			output+='<div class="media-heading-sub">Ordered</div>';
			output+='</li>';
			$('#output1').append(output);
		 
		}
  }, 
  error: function(XMLHttpRequest, textStatus, errorThrown) {
       alert(XMLHttpRequest);
    }
 });  // END ajax
}

</script>

<a href="javascript:;" class="page-quick-sidebar-toggler">
    <i class="icon-login"></i>
</a>
<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
    <div class="page-quick-sidebar">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="javascript:;" data-target="#quick_sidebar_tab_1" data-toggle="tab"> User Activity Logs
                 
                </a>
            </li>
            <li onclick="adminActivity()">
                <a href="javascript:;" data-target="#quick_sidebar_tab_2" data-toggle="tab"> Admin Activity Logs
                  
                </a>
            </li>
         
        </ul>
		<div class="tab-content">
			<div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
			<a href="<?php echo base_url();?>Users_activity">	<h3 class="list-heading">View All</h3></a>
				<div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
							
								<ul class="media-list list-items" id="output">
							 
								</ul> 
					
				</div>
			</div>
			    <div class="tab-pane page-quick-sidebar-chat" id="quick_sidebar_tab_2">
				<a href="<?php echo base_url();?>Admin_activity">	<h3 class="list-heading">View All</h3></a>
						<div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
							
							<ul class="media-list list-items" id="output1">
							 
							</ul> 
						</div>
						
				</div>
		</div>
    </div>
					<!-- END QUICK SIDEBAR -->
                                                            </div>
                                                            <!-- END CONTAINER -->
                                                            <!-- BEGIN FOOTER -->
                                                            <div class="page-footer">
                                                                <div class="page-footer-inner">
                                                                    <div class="scroll-to-top">
                                                                        <i class="icon-arrow-up"></i>
                                                                    </div>
                                                                </div>
                                                                <!-- END FOOTER -->
                                                            </div>
<!--[if lt IE 9]>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/jquery.min.js" type="text/javascript"></script>

 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

 <?php if($this->uri->segment(1)!='admin_logs' ){?>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<?php if($this->uri->segment(2)!='manageflyers' && $this->uri->segment(3)!='save'){?>


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<!--BEGIN CHART SCRIPTS-->
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>

<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>

<!--END CHART SCRIPTS-->
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/horizontal-timeline/horozontal-timeline.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>

<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/handlebars-1.0.rc.2.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/markerclusterer.js" type="text/javascript"></script>


<?php if($this->uri->segment(1)!='reports'){?>
<!-- BEGIN google map script for dashboard  -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsLbVwL6OOkitf3E1XnAl0v3wEVSXDNVM"></script>
<script src="<?php echo base_url(); ?>public/admin/js/List.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/admin/js/Mapster.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/admin/js/map-options.js" type="text/javascript"></script>
<!-- END google map script for dashboard  -->
<?php }?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url('metronic_src'); ?>/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!-- <script src="<?php //echo base_url('metronic_src'); ?>/pages/scripts/charts-amcharts.min.js" type="text/javascript"></script> -->
<script src="<?php echo base_url('metronic_src'); ?>/pages/scripts/dashboard.js" type="text/javascript"></script>
<?php if($this->uri->segment(1)!='reports'){?>
<script src="<?php echo site_url(); ?>metronic_src/pages/scripts/custom-dashboard.js"> </script>
<?php }?>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url('metronic_src'); ?>/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>

<!-- END THEME LAYOUT SCRIPTS -->
<script type="text/javascript" src="<?php echo base_url('metronic_src'); ?>/global/plugins/amcharts/amcharts/plugins/export/export.js"></script>
<?php $this->load->view('admin/layout/charts_data'); ?>


<?php } ?>
<script src="<?php echo base_url('public/admin/js/wan-spinner.js') ?>"></script>
<script src="<?php echo base_url('public/admin/js/bootbox.min.js') ?>"></script>

<?php if($this->uri->segment(1)!='flyers_management'){?>
<!-- BEGIN THEME DATATABLE SCRIPTS -->
<script src="<?php echo base_url('metronic_src'); ?>/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('metronic_src'); ?>/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url('metronic_src'); ?>/pages/scripts/table-datatables-ajax.min.js" type="text/javascript"></script>
<!-- END THEME DATATABLE SCRIPTS -->
<script type="text/javascript" language="javascript" src="<?php echo base_url('public/admin'); ?>/js/datatable/examples/resources/syntax/shCore.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url('public/admin'); ?>/js/datatable/examples/resources/demo.js"></script>
<script type="text/javascript" src="<?=base_url('public/admin/noty-2.3.8/js/noty/packaged/jquery.noty.packaged.min.js')?>"></script>
<?php }?>
<?php if($this->uri->segment(2)=='manageflyers' && $this->uri->segment(3)=='save'){?>
<script src="<?php echo base_url('public/admin/js/jquery-ui.js') ?>"></script>
<script src="<?php echo base_url('public/admin/js/admin-scripts.js') ?>"></script>
<script src="<?php echo base_url('public/admin/js/fabric.min.js') ?>"></script>
<script src="<?php echo base_url('public/admin/js/fabric/fabric_api.js') ?>"></script>
<script src="<?php echo base_url('public/admin/js/fabric/objectsAligning.js') ?>"></script>
<script src="<?php echo base_url('public/admin/js/fabric/objectsCenter.js') ?>"></script>
<script src="<?php echo base_url('public/admin/js/script.js') ?>"></script>
<script src="<?php echo base_url('public/admin/js/fabric/text.js') ?>"></script>
<script src="<?php echo base_url('public/admin/js/fabric/image.js') ?>"></script>
<script src="<?php echo base_url('public/admin/js/fabric/shapes.js') ?>"></script>
<script src="<?php echo base_url('public/admin/js/fabric/colors.js') ?>"></script>
<script src="<?php echo base_url('public/admin/js/evol.colorpicker.js') ?>"></script>
<script src="<?php echo base_url('public/admin/js/colpick.js') ?>"></script>
<script src="<?php echo base_url('public/admin/js/filedrop-min.js') ?>"></script>
<script type="text/javascript">
  var stop_user = true;
  if(stop_user)
    {window.onbeforeunload = function(){noti('danger', "Are you Sure? All data will be Lost!"); return false;}}
</script>
<?php } ?>

<script type="text/javascript">
    var site_url = '<?php echo site_url(); ?>';
    $(document).ready(function () {
        $("#mytable").dataTable();
    });
    //change date formate
     $(document).ready(function() {
            $('.date-pick').datepicker({
                format:'mm-dd-yyyy',
                autoclose: true
            });
            $('.time-pick').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false
            });
     });
    function noti(type, text) {

        if(type=='default') icon = '<i class="fa fa-bell" aria-hidden="true"></i>';
        if(type=='warning') icon = '<i class="fa fa-exclamation" aria-hidden="true"></i>';
        if(type=='success') icon = '<i class="fa fa-check" aria-hidden="true"></i>';
        if(type=='danger') icon = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>';

        var n = noty({
            text        : '<div class="activity-item"> '+icon+' '+text+'  </div>',
            type        : type,
            dismissQueue: true,
            layout      : 'topRight',
                // closeWith   : ['click'],
                timeout: 3000,
                theme       : 'relax',
                maxVisible  : 10,
                animation   : {
                    open  : 'animated bounceInRight',
                    close : 'animated bounceOutRight',
                    easing: 'swing',
                    speed : 500
                }
            });
            // console.log('html: ' + n.options.id);
        }
    </script>
    

</body>
     <?php }?>