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
    ?>

    <meta charset="UTF-8">
    <title>Profiling - DASHBOARD</title>
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
                <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">
                    <a href="index.html" class="horizontal-logo text-left">
                        <span class="h6 font-weight-bold align-self-center mb-0 ml-auto"><?php echo  date("h:i A", strtotime($last_update->lup)); ?></span>
                    </a>
                </div>
                <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                    <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
                </div>
                <div class="navbar-right ml-auto h-100">

                    <div class="media">
                        <img src="<?php echo base_url(); ?>assets/new_theme/dist/images/logo2.png" alt="" class="d-flex img-fluid mt-1" width="150">
                    </div>

                </div>

            </nav>
        </div>
    </div>
    <!-- END: Header-->



    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0">Dashboard</h4>
                            <p>Welcome to Dashboard Moss</p>
                        </div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->
            <div class="row">
                <div class="col-12">
                    <?php

                    if ($userdata->opt_level == 8) {
                    ?>
                        <form method="GET" action="#">
                            <input type="hidden" name="start" id="start" value="<?php echo $start; ?>"><input type="hidden" name="end" id="end" value="<?php echo $end; ?>">
                        </form>
                        <br>
                    <?php
                    } else {
                    ?>
                        <form method="GET" action="#">
                            From <input type="date" name="start" id="start" value="<?php echo $start; ?>"><input type="date" name="end" id="end" value="<?php echo $end; ?>"><button type="submit" id="filter">Filter</button><br>
                        </form>
                        <br>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($peformance['summary_performance']->oc); ?></h2>
                                <h6 class="card-liner-subtitle">DATA CONSUME</h6>
                            </div>
                            <!-- <div class="barfiller" data-color="#1ee0ac">
                                <div class="tipWrap">
                                    <span class="tip rounded success">
                                        <span class="tip-arrow"></span>
                                    </span>
                                </div> -->
                            <!-- <span class="fill" data-percentage="<?php echo number_format(($oc / ($wo + $oc)) * 100, 2); ?>"></span> -->
                            <!-- </div> -->
                        </div>
                    </div>

                </div>

                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($peformance['summary_performance']->not_contacted); ?></h2>
                                <h6 class="card-liner-subtitle">NOT CONTACTED</h6>
                            </div>
                            <div class="barfiller" data-color="#f64e60">
                                <div class="tipWrap">
                                    <span class="tip rounded danger">
                                        <span class="tip-arrow"></span>
                                    </span>
                                </div>
                                <span class="fill" data-percentage="<?php echo number_format(($peformance['summary_performance']->not_contacted / $peformance['summary_performance']->oc) * 100, 2); ?>"></span>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($peformance['summary_performance']->contacted); ?></h2>
                                <h6 class="card-liner-subtitle">CONTACTED</h6>
                            </div>
                            <div class="barfiller" data-color="#1e3d73">
                                <div class="tipWrap">
                                    <span class="tip rounded primary">
                                        <span class="tip-arrow"></span>
                                    </span>
                                </div>
                                <span class="fill" data-percentage="<?php echo number_format(($peformance['summary_performance']->contacted / $peformance['summary_performance']->oc) * 100, 2); ?>"></span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($peformance['summary_performance']->numna); ?></h2>
                                <h6 class="card-liner-subtitle">VERIFIED</h6>
                            </div>
                            <div class="barfiller" data-color="#17a2b8">
                                <div class="tipWrap">
                                    <span class="tip rounded info">
                                        <span class="tip-arrow"></span>
                                    </span>
                                </div>
                                <span class="fill" data-percentage="<?php echo number_format($peformance['summary_performance']->numna / $peformance['summary_performance']->contacted, 2); ?>"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Status Call By Status</h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body p-0">
                                <ul class="list-group list-unstyled">
                                    <?php
                                    if (count($status_breakdown) > 0) {
                                        foreach ($status_breakdown as $val) {
                                            $stat_call = $controller->status_call->get_row(array("id_reason" => str_replace('status_call_', '', $val->reason_call)));
                                            $clr == "#1ee0ac";
                                            $stl = "success";
                                            if ($stat_call->status == 0) {
                                                $clr = "#f64e60";
                                                $stl = "danger";
                                            }
                                            if ($stat_call->id_reason == 13) {
                                                $clr = "#17a2b8";
                                                $stl = "info";
                                            }
                                    ?>
                                            <li class="p-4 border-bottom">
                                                <div class="w-100">
                                                    <span><?php echo $stat_call->nama_reason; ?></span>
                                                    <div class="barfiller h-7 rounded" data-color="<?php echo $clr; ?>">
                                                        <div class="tipWrap">
                                                            <span class="tip rounded <?php echo $stl; ?>">
                                                                <span class="tip-arrow"></span>
                                                            </span>
                                                        </div>
                                                        <span class="fill" data-percentage="<?php echo number_format(($val->reason_call / $peformance['summary_performance']->oc) * 100); ?>"></span>
                                                    </div>
                                                </div>
                                            </li>
                                    <?php
                                        }
                                    }

                                    ?>



                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div style="font-size:25px;text-align:center;position:absolute;margin-left:160px;">SLFC</div>
                    <div id="slfc_chart" style="min-width: 250px; width: 100%;margin-top:10px;color:#a0bc2e;"></div>
                    <!-- <div style="color:#ff8e35;font-size:40px;text-align:center;margin-top:-50px;position:absolute;margin-left:160px;" id='slfc'><?php echo number_format($peformance['summary_performance']->slfc); ?></div> -->
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div style="font-size:25px;text-align:center;position:absolute;margin-left:160px;">SLG</div>
                    <div id="slg_chart" style="min-width: 250px; width: 100%;margin-top:10px;color:#a0bc2e;"></div>
                    <!-- <div style="color:#ff8e35;font-size:40px;text-align:center;margin-top:-50px;position:absolute;margin-left:160px;" id='slg'><?php echo number_format($peformance['summary_performance']->slg); ?></div> -->
                </div>
            </div>
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


    <!---- END page datatable--->

    <!-- END: Back to top-->
    <script type="text/javascript">
        if ($('.barfiller').length > 0) {
            $(".barfiller").each(function() {
                $(this).barfiller({
                    barColor: $(this).data('color')
                });
            });
        }



        $(document).ready(function() {
            // Element inside which you want to see the chart
            $("#slfc_chart").html("");
            let element5 = document.querySelector('#slfc_chart');
            $("#slg_chart").html("");
            let element6 = document.querySelector('#slg_chart');
            // // Properties of the gauge
            <?php
            $slfc = ((($peformance['summary_performance']->slfc / $peformance['summary_performance']->oc) / 600) * 100);
            if ($slfc < 0) {
                $slfc = 1;
            }
            $slg = ((($peformance['summary_performance']->slg / $peformance['summary_performance']->oc) / 600) * 100);
            if ($slg < 0) {
                $slg = 0;
            }
            ?>
            var break_num = <?php echo $slfc; ?>;
            var break_label = '<?php echo $controller->waktu_format($peformance['summary_performance']->slfc / $peformance['summary_performance']->oc); ?>';
            // var break_num = 10;
            // var break_label = 10;
            var break_length = "lightgray";
            switch (true) {
                case (parseInt(break_num) > 100):
                    var break_num = 99.99;
                    var bar_color = "#ce2f4f";
                    var break_length = "#ce2f4f";
                    break;
                case (parseInt(break_num) > 40):
                    var bar_color = "#ce2f4f";
                    break;
                default:
                    var bar_color = "#a0bc2e";
                    break;

            }
            let gaugeOptions5 = {
                hasNeedle: true,
                needleColor: bar_color,
                needleUpdateSpeed: 1000,
                arcColors: [bar_color, break_length],
                arcDelimiters: [break_num],
                rangeLabel: ['00:00', '10:00'],
                centralLabel: break_label,
            };
            GaugeChart
                .gaugeChart(element5, 400, gaugeOptions5)
                .updateNeedle(break_num);

            var slg_num = <?php echo $slg; ?>;
            var slg_label = '<?php echo $controller->waktu_format($peformance['summary_performance']->slg / $peformance['summary_performance']->oc); ?>';
            // var break_num = 10;
            // var break_label = 10;
            var break_length = "lightgray";
            switch (true) {
                case (parseInt(slg_num) > 100):
                    var slg_num = 99.99;
                    var bar_color = "#ce2f4f";
                    var break_length = "#ce2f4f";
                    break;
                case (parseInt(slg_num) > 40):
                    var bar_color = "#ce2f4f";
                    break;
                default:
                    var bar_color = "#a0bc2e";
                    break;

            }
            let gaugeOptions6 = {
                hasNeedle: true,
                needleColor: bar_color,
                needleUpdateSpeed: 1000,
                arcColors: [bar_color, break_length],
                arcDelimiters: [slg_num],
                rangeLabel: ['00:00', '10:00'],
                centralLabel: slg_label,
            };
            GaugeChart
                .gaugeChart(element6, 400, gaugeOptions6)
                .updateNeedle(slg_num);
            ///end break pie///

        });
    </script>
</body>
<!-- END: Body-->

</html>