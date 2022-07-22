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
                    <a href="<?php echo base_url() . "Analitics/Analitics/summary_report" ?>"><i class="icon-chart mr-1"></i> Summary</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Report/Report/report" ?>"><i class="icon-chart mr-1"></i> Report Reguler</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Report/Report/report_moss" ?>"><i class="icon-chart mr-1"></i> Report MOSS</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Report/Report/report_kpi" ?>"><i class="icon-chart mr-1"></i> KPI</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Report/Report/report_agent" ?>"><i class="icon-chart mr-1"></i> AGENT</a>
                </li>
            </ul>
            <!-- END: Menu-->
            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="breadcrumb-item active">Summary</li>
            </ol>
        </div>
    </div>
    <!-- END: Main Menu-->


    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0">Summary Report</h4>
                            <i>*Last Update at <?php echo  date("d F Y h:i A", strtotime($last_update)); ?></i>
                        </div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Summary Report</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->
            <div class="row">

                <div class="col-12">
                    <form method="GET" action="#">

                        <div class="form-row">
                            <?php
                            if ($userdata->opt_level == 7 || $userdata->opt_level == 6) {
                            ?>
                                <div class="form-group col-md-2">
                                    <select class="form-control" name="condition" id="condition">
                                        <option value='1' <?php echo ($condition == 1) ? 'selected' : ''; ?>>With Data Self</option>
                                        <option value='2' <?php echo ($condition == 2) ? 'selected' : ''; ?>>Without Data Self</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">

                                    <select class="form-control" name="tahun" id="tahun">
                                        <option value='2020' <?php echo ($tahun == 2020) ? 'selected' : ''; ?>>2020</option>
                                        <option value='2021' <?php echo ($tahun == 2021) ? 'selected' : ''; ?>>2021</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" id="filter" class="btn btn-primary">Filter</button>
                                </div>

                            <?php
                            } else {
                            ?>
                                <div class="form-group col-md-2">

                                    <select class="form-control" name="tahun" id="tahun">
                                        <option value='2020' <?php echo ($tahun == 2020) ? 'selected' : ''; ?>>2020</option>
                                        <option value='2021' <?php echo ($tahun == 2021) ? 'selected' : ''; ?>>2021</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" id="filter" class="btn btn-primary">Filter</button>
                                </div>
                                <input type="hidden" id="condition" value='1' name="condition">
                            <?php
                            }
                            ?>

                        </div>
                    </form>
                </div>

                <br>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Total Incremental Verified (YTD)</h6>
                        </div>
                        <div class="card-body">
                            <div id="morris-area-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="card bg-primary my-3 text-left">
                                <div class="card-body">
                                    <div class="d-flex px-0 px-lg-2 py-2 align-self-center">
                                        <i class="icon-target icons card-liner-icon mt-2 text-white"></i>
                                        <div class="card-liner-content">
                                            <h2 class="card-liner-title text-white"><?php echo number_format($target); ?></h2>
                                            <h6 class="card-liner-subtitle text-white">Target (YTD)</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                        <i class="icon-pie-chart icons card-liner-icon mt-2"></i>
                                        <div class='card-liner-content'>
                                            <h2 class="card-liner-title"><?php echo number_format($actual_verified); ?></h2>
                                            <h6 class="card-liner-subtitle">Actual (YTD)</h6>
                                        </div>
                                    </div>
                                    <!-- <span class="bg-<?php echo $style_kenaikan_verified; ?> card-liner-absolute-icon text-white card-liner-small-tip"><?php echo $persen_kenaikan_verified; ?>%</span> -->
                                    <div id="apex_today_visitors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card">
                                <div class="card-body text-success border-bottom border-success border-w-5">
                                    <h2 class="text-center"><?php echo number_format(($actual_verified / $target) * 100, 2) ?>%</h2>
                                    <h6 class="text-center">Actual VS Target (YTD)</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="card bg-primary my-3 text-left">
                                <div class="card-body">
                                    <div class="d-flex px-0 px-lg-2 py-2 align-self-center">
                                        <i class="icon-target icons card-liner-icon mt-2 text-white"></i>
                                        <div class="card-liner-content">
                                            <h2 class="card-liner-title text-white"><?php echo number_format($monthly_target); ?></h2>
                                            <h6 class="card-liner-subtitle text-white">Target (MTD)</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                        <i class="icon-pie-chart icons card-liner-icon mt-2"></i>
                                        <div class='card-liner-content'>
                                            <h2 class="card-liner-title"><?php echo number_format($actual_verified_mtd); ?></h2>
                                            <h6 class="card-liner-subtitle">Actual (MTD)</h6>
                                        </div>
                                    </div>
                                    <!-- <span class="bg-<?php echo $mtd_style_kenaikan_verified; ?> card-liner-absolute-icon text-white card-liner-small-tip"><?php echo $mtd_persen_kenaikan_verified; ?>%</span> -->
                                    <div id="apex_today_visitors_mtd"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="card">
                                <div class="card-body text-success border-bottom border-success border-w-5">
                                    <h2 class="text-center"><?php echo number_format(($actual_verified_mtd / $monthly_target) * 100, 2) ?>%</h2>
                                    <h6 class="text-center">Actual VS Target (MTD)</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Performance (YTD)</h6>
                        </div>
                        <div class="card-body" style="height: 400px">
                            <canvas id="chartjs-multiaxis-data"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <hr>
                    <form>

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <select class="form-control" name="year" id="year">
                                    <option value='2018' <?php echo ($tahun == 2018) ? 'selected' : ''; ?>>2018</option>
                                    <option value='2019' <?php echo ($tahun == 2019) ? 'selected' : ''; ?>>2019</option>
                                    <option value='2020' <?php echo ($tahun == 2020) ? 'selected' : ''; ?>>2020</option>
                                    <option value='2021' <?php echo ($tahun == 2021) ? 'selected' : ''; ?>>2021</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select class="form-control" name="month" id="month">
                                    <option value='1' <?php echo ($bulan == 1) ? 'selected' : ''; ?>>January</option>
                                    <option value='2' <?php echo ($bulan == 2) ? 'selected' : ''; ?>>February</option>
                                    <option value='3' <?php echo ($bulan == 3) ? 'selected' : ''; ?>>March</option>
                                    <option value='4' <?php echo ($bulan == 4) ? 'selected' : ''; ?>>April</option>
                                    <option value='5' <?php echo ($bulan == 5) ? 'selected' : ''; ?>>May</option>
                                    <option value='6' <?php echo ($bulan == 6) ? 'selected' : ''; ?>>June</option>
                                    <option value='7' <?php echo ($bulan == 7) ? 'selected' : ''; ?>>July</option>
                                    <option value='8' <?php echo ($bulan == 8) ? 'selected' : ''; ?>>August</option>
                                    <option value='9' <?php echo ($bulan == 9) ? 'selected' : ''; ?>>September</option>
                                    <option value='10' <?php echo ($bulan == 10) ? 'selected' : ''; ?>>October</option>
                                    <option value='11' <?php echo ($bulan == 11) ? 'selected' : ''; ?>>November</option>
                                    <option value='12' <?php echo ($bulan == 12) ? 'selected' : ''; ?>>December</option>
                                </select>
                            </div>
                            <!-- <div class="form-group col-md-2">
                                <select class="form-control" name="week" id="week">
                                    <option value='0'>--Select Week--</option>
                                    <option value='1'>Week 1</option>
                                    <option value='2'>Week 2</option>
                                    <option value='3'>Week 3</option>
                                    <option value='4'>Week 4</option>
                                </select>
                            </div> -->
                            <div class="form-group col-md-2">
                                <button type="button" id="filter" onclick="get_kpi();" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-12" id="kpi">
                    <center>-----LOADING DATA-------</center>
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

    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/chartjs-plugin-datalabels.min.js"></script>

    <!---- END page datatable--->

    <!-- END: Back to top-->
    <script type="text/javascript">
        function get_kpi() {
            var condition = $("#condition").val();
            var year = $("#year").val();
            var month = $("#month").val();
            $("#kpi").html("<center style='height:244px'>-----LOADING DATA-----</center>");
            $.ajax({
                url: "<?php echo base_url() . "Analitics/Analitics/summary_kpi" ?>",
                data: {
                    condition: condition,
                    year: year,
                    month: month
                },
                methode: "get",
                success: function(response) {
                    $("#kpi").html(response);
                }
            });
        }

        ////////////////////////////////// status Stats Chart /////////////////////////////
        var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');
        $(document).ready(function() {
            get_kpi();
            if ($('#morris-area-chart').length > 0) {
                /// Morris Line chart
                Morris.Area({
                    element: 'morris-area-chart',
                    data: [
                        <?php
                        if (count($monthly_actual_verified) > 0) {
                            $graf = 0;
                            foreach ($monthly_actual_verified as $m) {
                                $graf = $m->numna + $graf;
                        ?> {
                                    period: '<?php echo $tahun ?>-<?php echo $m->bulan ?>',
                                    iphone: <?php echo $m->bulan * $monthly_target ?>,
                                    ipad: <?php echo $graf; ?>
                                },
                        <?php
                            }
                        }
                        ?>
                    ],
                    xkey: 'period',
                    ykeys: ['iphone', 'ipad'],
                    labels: ['Target', 'Actual'],
                    pointSize: 3,
                    fillOpacity: 0,
                    pointStrokeColors: [primarycolor, '#6881d6', '#16297b'],
                    behaveLikeLine: true,
                    gridLineColor: '#e0e0e0',
                    lineWidth: 1,
                    hideHover: 'auto',
                    lineColors: [primarycolor, '#6881d6', '#16297b'],
                    resize: true

                });
            }
            if ($("#apex_today_visitors").length > 0) {
                options = {
                    chart: {
                        type: 'line',
                        height: 80,
                        sparkline: {
                            enabled: true
                        },
                        dropShadow: {
                            enabled: true,
                            top: 1,
                            left: 1,
                            blur: 2,
                            color: '#28a745',
                            opacity: 0.7,
                        }
                    },
                    series: [{
                        data: [
                            <?php
                            if (count($monthly_actual_verified) > 0) {
                                foreach ($monthly_actual_verified as $m) {
                                    echo $m->numna . ",";
                                }
                            }
                            ?>
                        ]
                    }],
                    stroke: {
                        curve: 'smooth',
                        width: 2,
                    },
                    markers: {
                        size: 0
                    },
                    grid: {
                        padding: {
                            top: 0,
                            bottom: 0,
                            left: 0
                        }
                    },
                    colors: ['#28a745'],
                    tooltip: {
                        x: {
                            show: false
                        },
                        y: {
                            title: {
                                formatter: function formatter(val) {
                                    return '';
                                }
                            }
                        }
                    },
                    responsive: [{
                            breakpoint: 1351,
                            options: {
                                chart: {
                                    height: 95,
                                },
                                grid: {
                                    padding: {
                                        top: 35,
                                        bottom: 0,
                                        left: 0
                                    }
                                },
                            },
                        },
                        {
                            breakpoint: 1200,
                            options: {
                                chart: {
                                    height: 80,
                                },
                                grid: {
                                    padding: {
                                        top: 35,
                                        bottom: 0,
                                        left: 40
                                    }
                                },
                            },
                        },
                        {
                            breakpoint: 576,
                            options: {
                                chart: {
                                    height: 95,
                                },
                                grid: {
                                    padding: {
                                        top: 45,
                                        bottom: 0,
                                        left: 0
                                    }
                                },
                            },
                        }

                    ]
                }


                var chart = new ApexCharts(
                    document.querySelector("#apex_today_visitors"),
                    options
                );
                chart.render();
            }
            if ($("#apex_today_visitors_mtd").length > 0) {
                options = {
                    chart: {
                        type: 'line',
                        height: 80,
                        sparkline: {
                            enabled: true
                        },
                        dropShadow: {
                            enabled: true,
                            top: 1,
                            left: 1,
                            blur: 2,
                            color: '#28a745',
                            opacity: 0.7,
                        }
                    },
                    series: [{
                        data: [
                            <?php
                            if (count($monthly_actual_verified_mtd) > 0) {
                                foreach ($monthly_actual_verified_mtd as $m) {
                                    echo $m->numna . ",";
                                }
                            }
                            ?>
                        ]
                    }],
                    stroke: {
                        curve: 'smooth',
                        width: 2,
                    },
                    markers: {
                        size: 0
                    },
                    grid: {
                        padding: {
                            top: 0,
                            bottom: 0,
                            left: 0
                        }
                    },
                    colors: ['#28a745'],
                    tooltip: {
                        x: {
                            show: false
                        },
                        y: {
                            title: {
                                formatter: function formatter(val) {
                                    return '';
                                }
                            }
                        }
                    },
                    responsive: [{
                            breakpoint: 1351,
                            options: {
                                chart: {
                                    height: 95,
                                },
                                grid: {
                                    padding: {
                                        top: 35,
                                        bottom: 0,
                                        left: 0
                                    }
                                },
                            },
                        },
                        {
                            breakpoint: 1200,
                            options: {
                                chart: {
                                    height: 80,
                                },
                                grid: {
                                    padding: {
                                        top: 35,
                                        bottom: 0,
                                        left: 40
                                    }
                                },
                            },
                        },
                        {
                            breakpoint: 576,
                            options: {
                                chart: {
                                    height: 95,
                                },
                                grid: {
                                    padding: {
                                        top: 45,
                                        bottom: 0,
                                        left: 0
                                    }
                                },
                            },
                        }

                    ]
                }


                var chart = new ApexCharts(
                    document.querySelector("#apex_today_visitors_mtd"),
                    options
                );
                chart.render();
            }
            /////////////////////////////////  Multi Axis ///////////////////////////
            <?php
            $bulanna = array(
                1 => "January",
                2 => "February",
                3 => "March",
                4 => "April",
                5 => "May",
                6 => "June",
                7 => "July",
                8 => "August",
                9 => "September",
                10 => "October",
                11 => "November",
                12 => "December"
            )
            ?>
            var barmultiaxisChartData = {
                labels: [
                    <?php
                    if (count($summary_peformance) > 0) {
                        foreach ($summary_peformance as $k => $v) {
                            if (isset($bulanna[$k])) {
                                echo "'" . $bulanna[$k] . "',";
                            }
                        }
                    }
                    ?>
                ],
                datasets: [{
                        label: 'Convertion Rate',
                        type: 'line',
                        backgroundColor: "#ffc107",
                        borderColor: "#ffc107",
                        fill: false,
                        yAxisID: 'y-axis-2',
                        data: [

                            <?php
                            $cvr = 0;
                            if (count($summary_peformance) > 0) {

                                foreach ($summary_peformance as $k => $v) {
                                    if (isset($summary_peformance[$k]['verified'])) {
                                        $cvr = number_format((($summary_peformance[$k]['verified'] / $summary_peformance[$k]['contacted']) * 100), 2) . ",";
                                        echo $cvr;
                                    }
                                }
                            }
                            ?>
                        ],
                        datalabels: {
                            color: '#FFFFFF',
                            display: true,
                            backgroundColor: '#ffc107',
                            formatter: function(value, ctx) {
                                return value + "%";
                            }
                        }
                    }, {
                        label: 'Order Call',
                        backgroundColor: "#fd7e14",
                        type: 'bar',
                        yAxisID: 'y-axis-1',
                        data: [
                            <?php
                            if (count($summary_peformance) > 0) {
                                foreach ($summary_peformance as $k => $v) {
                                    if (isset($summary_peformance[$k]['oc'])) {
                                        echo $summary_peformance[$k]['oc'] . ",";
                                    }
                                }
                            }
                            ?>
                        ],
                        datalabels: {
                            color: '#FFFFFF',
                            display: true,
                            backgroundColor: '#fd7e14',
                            formatter: function(value, ctx) {
                                return value;
                            }
                        }
                    },
                    {
                        label: 'Contacted',
                        backgroundColor: "#007bff",
                        borderWidth: 1,
                        yAxisID: 'y-axis-1',
                        type: 'bar',
                        data: [<?php
                                if (count($summary_peformance) > 0) {
                                    foreach ($summary_peformance as $k => $v) {
                                        if (isset($summary_peformance[$k]['contacted'])) {
                                            echo $summary_peformance[$k]['contacted'] . ",";
                                        }
                                    }
                                }
                                ?>],
                        datalabels: {
                            color: '#FFFFFF',
                            display: true,
                            backgroundColor: '#007bff',
                            formatter: function(value, ctx) {
                                return value;
                            }
                        }

                    }, {
                        label: 'Verified',
                        backgroundColor: "#28a745",
                        borderWidth: 1,
                        yAxisID: 'y-axis-1',
                        type: 'bar',
                        data: [
                            <?php
                            if (count($summary_peformance) > 0) {
                                foreach ($summary_peformance as $k => $v) {
                                    if (isset($summary_peformance[$k]['verified'])) {
                                        echo $summary_peformance[$k]['verified'] . ",";
                                    }
                                }
                            }
                            ?>
                        ],
                        datalabels: {
                            color: '#FFFFFF',
                            display: true,
                            backgroundColor: '#28a745',
                            formatter: function(value, ctx) {
                                return value;
                            }
                        }
                    }
                ]

            };

            var chartjs_multiaxis_bar = document.getElementById("chartjs-multiaxis-data");

            if (chartjs_multiaxis_bar) {
                ctx = document.getElementById('chartjs-multiaxis-data').getContext('2d');
                var mixedChart = new Chart(ctx, {
                    type: 'bar',
                    data: barmultiaxisChartData,
                    options: {
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                    type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                                    display: true,
                                    position: 'right',
                                    id: 'y-axis-2',
                                    ticks: {
                                        suggestedMin: 0
                                    }
                                },
                                {
                                    id: 'y-axis-1',
                                    display: true,
                                    ticks: {
                                        suggestedMin: 0
                                    }
                                }
                            ]
                        }
                    }
                });

            }
        });
    </script>
</body>
<!-- END: Body-->

</html>