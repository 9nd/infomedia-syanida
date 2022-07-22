<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
    <?php
    if (isset($_GET['start'])) {
    } else {
    ?>
        <!-- <meta http-equiv="refresh" content="300"> -->
    <?php
    }
    function nice_number($n)
    {
        // first strip any formatting;
        $n = (0 + str_replace(",", "", $n));

        // is this a number?
        if (!is_numeric($n)) return false;

        // now filter it;
        if ($n > 1000000000000) return round(($n / 1000000000000), 2) . ' T';
        elseif ($n > 1000000000) return round(($n / 1000000000), 2) . ' B';
        elseif ($n > 1000000) return round(($n / 1000000), 2) . ' M';
        elseif ($n > 1000) return $n;

        return number_format($n);
    }

    ?>

    <meta charset="UTF-8">
    <title>Digital Channel - Campaign</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/flags-icon/css/flag-icon.min.css">
    <!-- END Template CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.css">
    <link href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.lineProgressbar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/tambahan/editor_text/src/richtext.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/tambahan/editor_text/font-awesome.min.css">

    <!-- END: Page CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.css">
    <!-- END: Page CSS-->
    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/css/main.css">
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/plugins/jquery-knob/jquery.knob.min.js" type="text/javascript"></script> -->
    <!-- END: Page CSS-->
    <script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bundle.js"></script>
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" class="default horizontal-menu">

    <!-- START: Pre Loader-->
    <div class="se-pre-con">
        <div class="loader"></div>
    </div>
    <!-- END: Pre Loader-->

    <!-- START: Header-->
    <div id="header-fix" class="header fixed-top">
        <div class="site-width">
            <nav class="navbar navbar-expand-lg  p-0">
                <img src="<?php echo base_url("api/Public_Access/get_logo_template") ?>" class="header-brand-img h-<?php echo $this->_appinfo['template_logo_size'] ?>" alt="ybs logo">

            </nav>
        </div>
    </div>
    <!-- END: Header-->
    <!-- START: Main Menu-->
    <div class="sidebar">
        <div class="site-width">

            <!-- START: Menu-->
            <ul id="side-menu" class="sidebar-menu">
                <li>
                    <a href="<?php echo base_url(); ?>"><i class="icon-home mr-1"></i> Home</a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url() . "Dc/Dc" ?>"><i class="icon-chart mr-1"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/dalalead" ?>"><i class="icon-chart mr-1"></i> Data Lead</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/engine" ?>"><i class="icon-chart mr-1"></i> Engine</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/lp" ?>"><i class="icon-chart mr-1"></i> landing Page</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/campaign" ?>"><i class="icon-chart mr-1"></i> Campaign</a>
                </li>
                <!-- <li>
                    <a href="<?php echo base_url() . "Dc/Dc/qc" ?>"><i class="icon-chart mr-1"></i> Quality Control</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/report" ?>"><i class="icon-chart mr-1"></i> Report</a>
                </li> -->


            </ul>
            <!-- END: Menu-->

        </div>
    </div>
    <!-- END: Main Menu-->


    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->

            <!-- END: Breadcrumbs-->
            <form method="GET" action="#">
                <div class="row">
                    <div class="col-6">
                        <div class="form">

                            <div class="form-group row mt-3 ">
                                <label class="mt-2">Periode</label> <select class="form-control col-2 ml-2">
                                    <option>Daily</option>
                                    <option>Weekly</option>
                                    <option>Monthly</option>
                                </select>
                                <label class="mt-2 ml-3">Date</label> <input type="date" class="form-control col-4 ml-2">
                                <div class="btn btn-primary ml-2"><i class="fa fa-search"></i></div>
                            </div>

                        </div>

                    </div>


                </div>

            </form>
        </div>
        <div class="container-fluid site-width">
            <div class="col-12 col-lg-12  mt-3">
                <div class="card overflow-hidden">
                    <div class="card-content">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-12 col-lg-3 d-block d-md-flex d-lg-block">
                                    <div class="card bg-primary rounded-0 col-12 col-md-4 col-lg-12">
                                        <div class="card-body">
                                            <div class="d-flex px-0 px-lg-2 py-2 align-self-center">
                                                <i class="fa fa-circle-o card-liner-icon mt-2 text-white"></i>
                                                <div class="card-liner-content">
                                                    <h2 class="card-liner-title text-white">1,760,390</h2>
                                                    <h6 class="card-liner-subtitle text-white">Data Leads</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card bg-primary  rounded-0 col-12 col-md-4 col-lg-12 mt-3">
                                        <div class="card-body">
                                            <div class="d-flex px-0 px-lg-2 py-3 align-self-center">
                                                <i class="fa fa-circle card-liner-icon mt-2 text-white"></i>
                                                <div class="card-liner-content">
                                                    <h2 class="card-liner-title text-white">1,500,390</h2>
                                                    <h6 class="card-liner-subtitle text-white">Data Distribution</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-2">
                                        <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h6 mb-0">78,600</span><br>
                                            Whatsapp
                                        </div>
                                        <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h6 mb-0">1,240,600</span><br>
                                            Email
                                        </div>
                                    </div>
                                    <div class="d-flex mt-2">
                                        <div class="border-0 outline-badge-dark w-50 p-3 rounded text-center"><span class="h6 mb-0">4,600</span><br>
                                            SMS
                                        </div>
                                        <div class="border-0 outline-badge-danger w-50 p-3 rounded ml-2 text-center"><span class="h6 mb-0">2,600</span><br>
                                            OBC
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8  col-lg-5">

                                    <div class="card-content">
                                        <div class="card-body text-center">

                                            <div class="card bg-primary my-1 text-left">
                                                <div class="card-body">
                                                    <div class="d-flex px-0 px-lg-2 align-self-center">
                                                        <i class="fa fa-angle-double-up card-liner-icon mt-2 text-white"></i>
                                                        <div class="card-liner-content">
                                                            <h2 class="card-liner-title text-white">1,760,390</h2>
                                                            <h6 class="card-liner-subtitle text-white">Blast</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <ul class="list-group list-unstyled">
                                                    <li class="border-bottom zoom">
                                                        <div class="p-1 media d-flex w-100">
                                                            <div class="transaction-date text-center rounded bg-primary text-white p-2">
                                                                <small class="d-block">Success Sent</small>
                                                            </div>
                                                            <div class="ml-auto my-auto font-weight-bold text-right text-primary">
                                                                10.000<br>
                                                            </div>
                                                            <div class="text-center rounded bg-secondary text-white p-2 ml-4">
                                                                <small class="d-block">20%</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="border-bottom zoom ml-5">
                                                        <div class="p-1 media d-flex w-100">
                                                            <div class="transaction-date text-center rounded bg-primary text-white p-2">
                                                                <small class="d-block">Deliver</small>
                                                            </div>
                                                            <div class="ml-auto my-auto font-weight-bold text-right text-primary">
                                                                1.000<br>
                                                            </div>
                                                            <div class="text-center rounded bg-secondary text-white p-2 ml-4">
                                                                <small class="d-block">20%</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="border-bottom zoom ml-5">
                                                        <div class="p-1 media d-flex w-100">
                                                            <div class="transaction-date text-center rounded bg-primary text-white p-2">
                                                                <small class="d-block">Read</small>
                                                            </div>
                                                            <div class="ml-auto my-auto font-weight-bold text-right text-primary">
                                                                1.000<br>
                                                            </div>
                                                            <div class="text-center rounded bg-secondary text-white p-2 ml-4">
                                                                <small class="d-block">20%</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="border-bottom zoom ml-5">
                                                        <div class="p-1 media d-flex w-100">
                                                            <div class="transaction-date text-center rounded bg-primary text-white p-2">
                                                                <small class="d-block">Klicked</small>
                                                            </div>
                                                            <div class="ml-auto my-auto font-weight-bold text-right text-primary">
                                                                1.000<br>
                                                            </div>
                                                            <div class="text-center rounded bg-secondary text-white p-2 ml-4">
                                                                <small class="d-block">20%</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="border-bottom zoom ml-5">
                                                        <div class="p-1 media d-flex w-100">
                                                            <div class="transaction-date text-center rounded bg-primary text-white p-2">
                                                                <small class="d-block">Verified</small>
                                                            </div>
                                                            <div class="ml-auto my-auto font-weight-bold text-right text-success">
                                                                1.000<br>
                                                            </div>
                                                            <div class="text-center rounded bg-secondary text-white p-2 ml-4">
                                                                <small class="d-block">20%</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="border-bottom zoom">
                                                        <div class="p-1 media d-flex w-100">
                                                            <div class="transaction-date text-center rounded bg-danger text-white p-2">
                                                                <small class="d-block">Send Failed</small>
                                                            </div>
                                                            <div class="ml-auto my-auto font-weight-bold text-right text-danger">
                                                                1.000<br>
                                                            </div>
                                                            <div class="text-center rounded bg-secondary text-white p-2 ml-4">
                                                                <small class="d-block">20%</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="border-bottom zoom ml-5">
                                                        <div class="p-1 media d-flex w-100">
                                                            <div class="transaction-date text-center rounded bg-danger text-white p-2">
                                                                <small class="d-block">Wrong Format Contact</small>
                                                            </div>
                                                            <div class="ml-auto my-auto font-weight-bold text-right text-danger">
                                                                1.000<br>
                                                            </div>
                                                            <div class="text-center rounded bg-secondary text-white p-2 ml-4">
                                                                <small class="d-block">20%</small>
                                                            </div>
                                                        </div>
                                                    </li>


                                                </ul>
                                            </div>


                                        </div>
                                    </div>


                                </div>
                                <div class="col-12 col-lg-4 d-block d-md-flex d-lg-block">
                                    <div class="card bg-primary rounded-0 col-12 col-md-4 col-lg-12">
                                        <div class="card-body">
                                            <div class="d-flex px-0 px-lg-2 py-2 align-self-center">
                                                <i class="fa fa-check card-liner-icon mt-2 text-white"></i>
                                                <div class="card-liner-content">
                                                    <h2 class="card-liner-title text-white">1,760,390</h2>
                                                    <h6 class="card-liner-subtitle text-white">Verified by DC</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-2">
                                        <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h6 mb-0">78,600</span><br>
                                            Verified Whatsapp
                                        </div>
                                        <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h6 mb-0">1,24,600</span><br>
                                            Verified Email
                                        </div>
                                    </div>
                                    <div class="d-flex mt-2">
                                        <div class="border-0 outline-badge-dark w-50 p-3 rounded text-center"><span class="h6 mb-0">4,600</span><br>
                                            Verified SMS
                                        </div>
                                        <div class="border-0 outline-badge-danger w-50 p-3 rounded ml-2 text-center"><span class="h6 mb-0">2,600</span><br>
                                            Verified OBC
                                        </div>
                                    </div>
                                    <div class="card bg-primary  rounded-0 col-12 col-md-4 col-lg-12 mt-4">
                                        <div class="card-body">
                                            <div class="d-flex px-0 px-lg-2 py-3 align-self-center">
                                                <i class="fas fa-donate card-liner-icon mt-2 text-white"></i>
                                                <div class="card-liner-content">
                                                    <h2 class="card-liner-title text-white">1,500,390</h2>
                                                    <h6 class="card-liner-subtitle text-white">Verified by OBC Source DC</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="container-fluid site-width mt-3">
            <div class="row">
                <div class="col-8  mt-3">
                    <div class="card overflow-hidden">
                        <div class="card-content">
                            <div class="card-body" style="position: relative;">
                                <div id="chart_blast_verif" class="height-500" style="min-height: 280px;">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Top 5 Campaign</h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body p-0">
                                <ul class="list-group list-unstyled">
                                    <li class="p-2 border-bottom">
                                        <div class="media d-flex w-100">
                                            <div class="media-body align-self-center pl-2">
                                                <span class="mb-0 font-w-600">Nama Campaign</span><br>
                                                <small class="mb-0 font-w-500">Landing Page</small>
                                            </div>
                                            <div class="ml-auto my-auto font-weight-bold">
                                                10.000
                                            </div>
                                        </div>
                                    </li>
                                    <li class="p-2 border-bottom">
                                        <div class="media d-flex w-100">
                                            <div class="media-body align-self-center pl-2">
                                                <span class="mb-0 font-w-600">Nama Campaign</span><br>
                                                <small class="mb-0 font-w-500">Landing Page</small>
                                            </div>
                                            <div class="ml-auto my-auto font-weight-bold">
                                                10.000
                                            </div>
                                        </div>
                                    </li>
                                    <li class="p-2 border-bottom">
                                        <div class="media d-flex w-100">
                                            <div class="media-body align-self-center pl-2">
                                                <span class="mb-0 font-w-600">Nama Campaign</span><br>
                                                <small class="mb-0 font-w-500">Landing Page</small>
                                            </div>
                                            <div class="ml-auto my-auto font-weight-bold">
                                                10.000
                                            </div>
                                        </div>
                                    </li>
                                    <li class="p-2 border-bottom">
                                        <div class="media d-flex w-100">
                                            <div class="media-body align-self-center pl-2">
                                                <span class="mb-0 font-w-600">Nama Campaign</span><br>
                                                <small class="mb-0 font-w-500">Landing Page</small>
                                            </div>
                                            <div class="ml-auto my-auto font-weight-bold">
                                                10.000
                                            </div>
                                        </div>
                                    </li>
                                    <li class="p-2 border-bottom">
                                        <div class="media d-flex w-100">
                                            <div class="media-body align-self-center pl-2">
                                                <span class="mb-0 font-w-600">Nama Campaign</span><br>
                                                <small class="mb-0 font-w-500">Landing Page</small>
                                            </div>
                                            <div class="ml-auto my-auto font-weight-bold">
                                                10.000
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>


        <!-- END: Breadcrumbs-->

        </div>



    </main>
    <!-- END: Content-->
    <!-- START: Footer-->
    <footer class="site-footer">
        2020 © Sy-ANIDA
    </footer>
    <!-- END: Footer-->



    <!-- START: Back to top-->
    <a href="#" class="scrollup text-center">
        <i class="icon-arrow-up"></i>
    </a>


    <!-- START: Template JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/moment/moment.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- END: Template JS-->

    <!-- START: APP JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/app.js"></script>
    <!-- END: APP JS-->



    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.lineProgressbar.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.barfiller.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- START: Page JS-->
    <!-- <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/home.script.js"></script> -->
    <!-- END: Page JS-->

    <!---- START page datatable--->
    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/jszip/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- START: Page Script JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/datatable.script.js"></script>
    <!-- END: Page Script JS-->

    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/chartjs-plugin-datalabels.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/new_theme/tambahan/editor_text/src/jquery.richtext.js"></script>

    <!---- END page datatable--->

    <!-- END: Back to top-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.temp_wa').richText({
                ol: false,
                ul: false,
                heading: false,
                imageUpload: false,
                fileUpload: false,
                removeStyles: false,

            });
            $('.temp_sms').richText();
            $('.temp_email').richText({
                ol: false,
                ul: false,
                heading: false,
                imageUpload: false,
                fileUpload: false,
                removeStyles: false,

            });
        });

        function countChar(val) {
            var len = val.value.length;
            if (len >= 160) {
                val.value = val.value.substring(0, 160);
            } else {
                $('#charNum').text(160 - len);
            }
        };
        $('#datalist').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            responsive: true
        });
    </script>
    <script>
        (function($) {
            "use strict";
            var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');
            var bordercolor = getComputedStyle(document.body).getPropertyValue('--bordercolor');
            var bodycolor = getComputedStyle(document.body).getPropertyValue('--bodycolor');
            var theme = 'light';
            if ($('body').hasClass('dark')) {
                theme = 'dark';
            }
            if ($('body').hasClass('dark-alt')) {
                theme = 'dark';
            }
            /////////////////////////////////// Analytic Chart /////////////////////
            if ($("#chart_blast_verif").length > 0) {
                options = {
                    theme: {
                        mode: theme
                    },
                    chart: {
                        height: 320,
                        type: 'bar',
                    },
                    responsive: [{
                        breakpoint: 767,
                        options: {
                            chart: {
                                height: 220
                            }
                        }
                    }],
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    colors: ['#1e3d73', '#17a2b8'],
                    series: [{
                        name: 'Blast',
                        data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                    }, {
                        name: 'Verified',
                        data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                    }],
                    xaxis: {
                        categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9'],
                    },
                    yaxis: {
                        title: {
                            text: '(Jumlah Data)'
                        }
                    },
                    fill: {
                        opacity: 1

                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val + " Data"
                            }
                        }
                    }
                }

                var chart = new ApexCharts(
                    document.querySelector("#chart_blast_verif"),
                    options
                );
                chart.render();
            }


            /////////////////////////////////// Bitcoin Chart /////////////////////
            if ($("#stats_apex_area_chart").length > 0) {
                var series = {
                    "monthDataSeries1": {
                        "prices": [11, 32, 45, 32, 34, 52, 41]
                    }
                }
                var options = {
                    theme: {
                        mode: theme
                    },
                    chart: {

                        type: 'area',
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        }
                    },
                    colors: ['#17a2b8', '#d43f4d', '#da5965', '#de6f79', '#e88790'],
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    series: [{
                        name: "STOCK ABC",
                        data: series.monthDataSeries1.prices
                    }],
                    xaxis: {
                        show: !1,
                        labels: {
                            show: !1
                        },
                        axisBorder: {
                            show: !1
                        }
                    },
                    yaxis: {
                        show: !1
                    },
                    grid: {
                        show: !1,
                        padding: {
                            top: 0,
                            bottom: -40,
                            left: 0,
                            right: 0
                        }
                    },
                    legend: {
                        horizontalAlign: 'left'
                    }
                }

                var chart = new ApexCharts(
                    document.querySelector("#stats_apex_area_chart"),
                    options
                );
                chart.render();
            }

        })(jQuery);
    </script>

</body>
<!-- END: Body-->

</html>