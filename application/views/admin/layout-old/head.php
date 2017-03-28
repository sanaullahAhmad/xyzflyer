<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Flyers </title>
    <!-- BOOTSTRAP STYLES-->
    <link href="<?php echo base_url('public/admin/css/bootstrap.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/admin/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="<?php echo base_url('public/admin/css/jquery-ui.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/admin/css/jquery-ui.theme.min.css') ?>" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    
    <link href="<?php echo base_url('public/admin/css/flyer-design.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/admin/css/studio.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/admin/css/colpick.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/admin/css/evol.colorpicker.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/admin/css/bootstrap-datepicker.css') ?>" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="<?php echo base_url('public/admin/css/custom.css') ?>" rel="stylesheet" />

    <?php if($this->uri->segment(1)!='flyers_management' || $this->uri->segment(1)!='admin_logs'){?>
    <link rel="stylesheet" href="//cdn.datatables.net/tabletools/2.2.3/css/dataTables.tableTools.css">
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" href="//editor.datatables.net/examples/resources/bootstrap/editor.bootstrap.css">
    <?php }?>
    <link rel="stylesheet" href="<?=base_url('public/admin/noty-2.3.8/animate.css')?>" />
    <link rel="stylesheet" href="<?=base_url('public/admin/noty-2.3.8/buttons.css')?>" />

    <link href="<?php echo base_url('public/admin/css/style.css') ?>" rel="stylesheet" />
    <script src="<?php echo base_url('public/admin/js/jquery-1.9.1.js') ?>"></script>
    <script src="<?php echo base_url('public/admin/js/jquery-ui.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/admin/js/bootstrap-datepicker.js'); ?>"></script>
    <script type="text/javascript">
        var base_url = '<?php echo base_url(); ?>';
    </script>
    <style>
        .color-box {
            float:left;
            width:30px;
            height:30px;
            margin:5px;
            border: 1px solid white;
        }
        #picker {
            margin:0;
            padding:0;
            border:0;
            width:40px;
            height:20px;
            border-right:20px solid #000000;
            line-height:20px;
        }
    </style>
</head>
