<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-control" content="no-cache" author="FOI ET JOIE HAITI">
    <title>SAQ-<?php echo $this->customlib->getAppName(); ?> | <?=(isset($title))?$title:''?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>backend/assets/img/favicon.ico"/>
    <link href="<?php echo base_url(); ?>backend/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>backend/assets/js/loader.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">  
    <link href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>backend/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>backend/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>backend/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>backend/assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>backend/assets/css/users/user-profile.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>backend/assets/css/components/cards/card.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>backend/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>backend/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>backend/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <?php if (isset($page) && $page == 'Rapport'): ?>
        <link href="<?php echo base_url(); ?>backend/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>backend/assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <?php endif; if(isset($page) && $page == 'list'):  ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/plugins/table/datatable/datatables.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/plugins/table/datatable/custom_dt_html5.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/plugins/table/datatable/dt-global_style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/plugins/table/datatable/datatables.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/assets/css/forms/theme-checkbox-radio.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/plugins/table/datatable/dt-global_style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/plugins/table/datatable/custom_dt_custom.css">
    <?php endif; if(isset($page) && $page == 'form'): ?>
        <link href="<?php echo base_url(); ?>backend/plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>backend/plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>backend/plugins/noUiSlider/nouislider.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>backend/plugins/bootstrap-select/bootstrap-select.min.css"rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>backend/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>backend/plugins/editors/markdown/simplemde.min.css" rel="stylesheet">
    <?php endif; if(isset($page) && $page == 'viewcourse'): ?>
       <link href="//vjs.zencdn.net/7.10.2/video-js.min.css" rel="stylesheet">
    <?php endif; if(isset($page) && $page == 'sendmessage'): ?>
        <link href="<?php echo base_url(); ?>backend/assets/css/apps/mailing-chat.css" rel="stylesheet" type="text/css" />
    <?php endif; ?>
    <link href="<?php echo base_url(); ?>backend/assets/css/pages/privacy/privacy.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
<?php $this->load->view('layout/sidebar');?>