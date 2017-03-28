<head>
<meta charset="utf-8" />
<title>Admin | Flyers</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>metronic_src/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>metronic_src/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>metronic_src/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>metronic_src/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
 <link href="<?php echo base_url('metronic_src'); ?>/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url('metronic_src'); ?>/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('metronic_src'); ?>/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
<!--Flyer BIGINS-->
<link href="<?php echo base_url('public/admin/css/flyer-design.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/admin/css/studio.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/admin/css/colpick.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/admin/css/evol.colorpicker.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/admin/css/bootstrap-datepicker.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/admin/css/bootstrap-datepicker.css') ?>" rel="stylesheet" />
     <link href="<?php echo base_url('metronic_src'); ?>/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <!--Flyer ENDS-->
 <link  type="text/css" href="<?php echo base_url('metronic_src'); ?>/global/plugins/amcharts/amcharts/plugins/export/export.css" rel="stylesheet">
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo base_url('metronic_src'); ?>/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo base_url('metronic_src'); ?>/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="<?php echo base_url('metronic_src'); ?>/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('metronic_src'); ?>/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="<?php echo base_url('metronic_src'); ?>/layouts/layout/css/custom.css" rel="stylesheet" type="text/css" />

<script src="<?php echo base_url('public/admin/js/jquery-1.9.1.js') ?>"></script>

<link rel="stylesheet" href="<?=base_url('public/admin/noty-2.3.8/animate.css')?>" />
    <!-- <link rel="stylesheet" href="<?=base_url('public/admin/noty-2.3.8/buttons.css')?>" /> -->

    <link href="<?php echo base_url('public/admin/css/style.css') ?>" rel="stylesheet" />
     <link href="<?php echo base_url('public/admin/css/filedrop.css') ?>" rel="stylesheet" />
<!-- END THEME LAYOUT STYLES -->
 <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url('metronic_src'); ?>/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('metronic_src'); ?>/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('metronic_src'); ?>/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

        <!-- END PAGE LEVEL PLUGINS -->
<link rel="shortcut icon" href="favicon.ico" />

<script type="text/javascript">
	var base_url = '<?php echo base_url(); ?>';
	var site_url = '<?php echo site_url(); ?>';
</script>

<?php if($this->uri->segment(1)=='pricing'){?>
<style>
    #selected_counties{font-size: 14px; height: 188px; position: relative;}
    .row_pricing, .row_additional_pricing{margin: 10px auto!important}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.13/css/perfect-scrollbar.min.css" />
<? } ?>
</head>
