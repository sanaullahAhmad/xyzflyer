 </div>
     <script src="<?php echo base_url('public/admin/js/bootstrap.min.js') ?>"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?php echo base_url('public/admin/js/jquery.metisMenu.js') ?>"></script>
    
    <script src="<?php echo base_url('public/admin/js/jquery-ui.js') ?>"></script>
    <script src="<?php echo base_url('public/admin/js/admin-scripts.js') ?>"></script>
    <script src="<?php echo base_url('public/admin/js/wan-spinner.js') ?>"></script> 
    <script src="<?php echo base_url('public/admin/js/bootbox.min.js') ?>"></script> 

<?php if($this->uri->segment(2)=='manageflyers' && $this->uri->segment(3)=='save'){?>
    <script src="<?php echo base_url('public/admin/js/fabric.min.js') ?>"></script> 
    <script src="<?php echo base_url('public/admin/js/fabric/fabric_api.js') ?>"></script>
    <script src="<?php echo base_url('public/admin/js/fabric/objectsAligning.js') ?>"></script>
    <script src="<?php echo base_url('public/admin/js/fabric/objectsCenter.js') ?>"></script>
    <script src="<?php echo base_url('public/admin/js/fabric/text.js') ?>"></script>
    <script src="<?php echo base_url('public/admin/js/fabric/image.js') ?>"></script>
    <script src="<?php echo base_url('public/admin/js/fabric/shapes.js') ?>"></script>
    <script src="<?php echo base_url('public/admin/js/fabric/colors.js') ?>"></script>
    <script src="<?php echo base_url('public/admin/js/evol.colorpicker.js') ?>"></script>
  <script src="<?php echo base_url('public/admin/js/colpick.js') ?>"></script>
    <script src="<?php echo base_url('public/admin/js/script.js') ?>"></script>  
  <script type="text/javascript">
  var stop_user = true;
  if(stop_user)
    {window.onbeforeunload = function(){noti('danger', "Are you Sure? All data will be Lost!"); return false;}}
  </script>
  <?php } ?>

  <?php if($this->uri->segment(1)!='flyers_management'){?>
    <script src="<?php echo base_url('public/admin'); ?>/js/datatable/media/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url('public/admin'); ?>/js/datatable/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('public/admin'); ?>/js/datatable/examples/resources/syntax/shCore.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('public/admin'); ?>/js/datatable/examples/resources/demo.js"></script>
    <script type="text/javascript" src="<?=base_url('public/admin/noty-2.3.8/js/noty/packaged/jquery.noty.packaged.min.js')?>"></script>
   
   <?php }?>
<script type="text/javascript">
    var site_url = '<?php echo site_url(); ?>';
    $(document).ready(function () {
        $("#mytable").dataTable();
    });


        function noti(type, text) {

            if(type=='default') icon = '<i class="fa fa-bell" aria-hidden="true"></i>';
            if(type=='warning') icon = '<i class="fa fa-exclamation" aria-hidden="true"></i>';
            if(type=='success') icon = '<i class="fa fa-check" aria-hidden="true"></i>';
            if(type=='danger') icon = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>';

            var n = noty({
                text        : '<div class="activity-item"> '+icon+' <div class="activity"> '+text+' </div> </div>',
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
</html>