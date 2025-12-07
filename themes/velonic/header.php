<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title><?php get_title() ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <meta content="" name="description" /> -->

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=env('APP_FAVICON', asset('theme/assets/images/favicon.ico'))?>">

        <!-- Daterangepicker css -->
        <link rel="stylesheet" href="<?=asset('theme/assets/vendor/daterangepicker/daterangepicker.css')?>">

        <!-- Vector Map css -->
        <link rel="stylesheet" href="<?=asset('theme/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')?>">

        <!-- Theme Config Js -->
        <script src="<?=asset('theme/assets/js/config.js')?>"></script>

        <!-- App css -->
        <link href="<?=asset('theme/assets/css/app.min.css')?>" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="<?=asset('theme/assets/css/icons.min.css')?>" rel="stylesheet" type="text/css" />

        <!-- fontawesome -->
        <link href="<?= asset('theme/assets/css/all.min.css')?>" rel="stylesheet">

        <link href="<?= asset('theme/assets/css/dataTables.bootstrap5.min.css')?>" rel="stylesheet">

        <?php head_script() ?>

        <style>
        .logo-lg img {
            max-height: 65px!important;
            height: auto;
            max-width: 100%;
        }
        html[data-sidenav-size=condensed]:not([data-layout=topnav]) .wrapper .leftside-menu .logo, .leftside-menu {
            background-color: #FFF;
        }
        </style>
    </head>

    <body>
        <!-- Begin page -->
        <div class="wrapper">
            
            <?php get_sidebar() ?>
            
            <?php get_nav() ?>

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <?php if(get_module_name()): ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <?php if(get_breadcrumbs()): ?>
                                        <ol class="breadcrumb m-0">
                                            <?php foreach(get_breadcrumbs() as $breadcrumb): ?>
                                            <li class="breadcrumb-item"><a href="<?=isset($breadcrumb['url']) ? $breadcrumb['url'] : 'javascript:void(0)'?>"><?=$breadcrumb['title']?></a></li>
                                            <?php endforeach ?>
                                        </ol>
                                        <?php endif ?>
                                    </div>
                                    <h4 class="page-title"><?= get_module_name() ?></h4>
                                </div>
                            </div>
                        </div>
                        <?php endif ?>
                        <!-- end page title -->