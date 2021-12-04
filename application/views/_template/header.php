<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?= base_url('public/') ?>assets/images/favicon.ico">

    <title><?= isset($title) ? $title : 'Sentiment Analysis' ?> </title>

    <!-- App css -->
    <link href="<?= base_url('public/') ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('public/') ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('public/') ?>assets/css/style.css" rel="stylesheet" type="text/css" />
    <!-- animated  -->
    <link href="<?= base_url('public/') ?>assets/plugins/animate.less/animate.min.css" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="<?= base_url('public/') ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('public/') ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?= base_url('public/') ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Multi Item Selection examples -->
    <link href="<?= base_url('public/') ?>assets/plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?= base_url('public/') ?>assets/plugins/morris/morris.css">

    <script src="<?= base_url('public/') ?>assets/js/modernizr.min.js"></script>

    <!-- jquery  -->
    <script src="<?= base_url('public/') ?>assets/js/jquery.min.js"></script>

</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="index.html" class="logo"><span>Admin<span>to</span></span><i class="mdi mdi-layers"></i></a>
            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container-fluid">

                    <!-- Page title -->
                    <ul class="nav navbar-nav list-inline navbar-left">
                        <li class="list-inline-item">
                            <button class="button-menu-mobile open-left">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                        <li class="list-inline-item">
                            <h4 class="page-title"><?= isset($title) ? $title : 'Sentiment Analysis' ?></h4>
                        </li>
                    </ul>

                </div><!-- end container -->
            </div><!-- end navbar -->
        </div>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">

                <!-- User -->
                <div class="user-box">
                    <div class="user-img">
                        <img src="<?= base_url('public/') ?>assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail img-responsive">
                        <div class="user-status offline"><i class="mdi mdi-adjust"></i></div>
                    </div>
                    <h5><a href="#">Mat Helme</a> </h5>

                </div>
                <!-- End User -->

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <ul>
                        <li class="text-muted menu-title">Main Menu</li>

                        <li>
                            <a href="<?= base_url('') ?>" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-play"></i> <span> Analisis Sentiment </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="analisis-sentimen-realtime">Realtime</a></li>
                                <li><a href="analisis-sentimen-static">Static</a></li>
                            </ul>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>

            </div>

        </div>
        <!-- Left Sidebar End -->



        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">