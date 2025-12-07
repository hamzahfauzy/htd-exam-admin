<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php get_title() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta content="" name="description" /> -->

    <!-- App favicon -->
    <link rel="icon" type="image/x-icon" href="<?= getFavicon() ?>">

    <link href="<?= asset('theme/assets/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= asset('theme/assets/vendor/fonts/boxicons.css') ?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= asset('theme/assets/vendor/css/core.css" class="template-customizer-core-css') ?>" />
    <link rel="stylesheet" href="<?= asset('theme/assets/vendor/css/theme-default.css" class="template-customizer-theme-css') ?>" />
    <link rel="stylesheet" href="<?= asset('theme/assets/css/demo.css') ?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= asset('theme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />

    <link rel="stylesheet" href="<?= asset('theme/assets/vendor/libs/apex-charts/apex-charts.css') ?>" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?= asset('theme/assets/vendor/js/helpers.js') ?>"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= asset('theme/assets/js/config.js') ?>"></script>

    <?php head_script() ?>

    <style>
        .logo-lg img {
            max-height: 65px !important;
            height: auto;
            max-width: 100%;
        }

        html[data-sidenav-size=condensed]:not([data-layout=topnav]) .wrapper .leftside-menu .logo,
        .leftside-menu {
            background-color: #FFF;
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php get_sidebar() ?>
            <div class="layout-page">
                <?php get_nav() ?>

                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">

                        <!-- start page title -->
                         <?php /*
                        <?php if (get_module_name()) : ?>
                            <h4 class="page-title mb-2"><?= get_module_name() ?></h4>
                            <div class="page-title-left">
                                <?php if (get_breadcrumbs()) : ?>
                                    <ol class="breadcrumb m-0">
                                        <?php foreach (get_breadcrumbs() as $breadcrumb) : ?>
                                            <li class="breadcrumb-item mb-3 mt-3"><a href="<?= isset($breadcrumb['url']) ? $breadcrumb['url'] : 'javascript:void(0)' ?>"><?= $breadcrumb['title'] ?></a></li>
                                        <?php endforeach ?>
                                    </ol>
                                <?php endif ?>
                            </div>
                        

                        <?php endif ?> */ ?>