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
    <title>Profiling - Report</title>
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
    <!-- <div class="se-pre-con">
        <div class="loader"></div>
    </div> -->
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
                <li>
                    <a href="<?php echo base_url() . "Analitics/Analitics/summary_report" ?>"><i class="icon-chart mr-1"></i> Summary</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Report/Report/report" ?>"><i class="icon-chart mr-1"></i> Report Reguler</a>
                </li>
                <li class="active">
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
                <li class="breadcrumb-item active">Report Moss</li>
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
                            <h4 class="mb-0">Report</h4>
                            <i>*Last Update at <?php echo  date("d F Y h:i A", strtotime($last_update)); ?></i>
                        </div>


                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->
            <div class="row">

                <div class="col-12">
                    <form method="GET" action="#">

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <select class="form-control" name="template" id="template">
                                    <option value='monthly' <?php echo ($template == "monthly") ? 'selected' : ''; ?>>Monthly</option>
                                    <option value='weekly' <?php echo ($template == "weekly") ? 'selected' : ''; ?>>Weekly</option>
                                    <option value='daily' <?php echo ($template == "daily") ? 'selected' : ''; ?>>Daily</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <input class="form-control" type="date" name="datena" id="datena" value="<?php echo $datena; ?>">

                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" id="filter" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>

                <br>
            </div>
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Performance </h6>
                        </div>
                        <div class="card-body" style="height: 400px">
                            <canvas id="chartjs-multiaxis-data"></canvas>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12 col-lg-12  mt-3">
                    <table id="byagent" class="table dataTable table-striped table-bordered">
                        <thead>
                            <tr>
                                <td nowrap="" style="text-align:center;">#</td>
                                <?php
                                if (count($grafik['summary_performance']) > 0) {
                                    foreach ($grafik['summary_performance'] as $k) {
                                        if (isset($k['axis'])) {
                                            echo "<td nowrap='' style='text-align:center;'>" . $k['axis'] . "</td>";
                                        }
                                    }
                                }
                                ?>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align:center;">SLFC</td>
                                <?php
                                if (count($grafik['summary_performance']) > 0) {
                                    foreach ($grafik['summary_performance'] as $k) {
                                        // if (isset($k['slfc'])) {
                                        $text_color = "";
                                        if (($k['slfc'] / $k['oc']) > 300) {
                                            $text_color = "color:red;";
                                        }
                                        echo "<td nowrap='' style='text-align:center;$text_color'>" . gmdate("H:i:s", ($k['slfc'] / $k['oc'])) . "</td>";
                                        // }
                                    }
                                }
                                ?>
                            </tr>
                            <tr>
                                <td style="text-align:center;">SLG</td>
                                <?php
                                if (count($grafik['summary_performance']) > 0) {
                                    foreach ($grafik['summary_performance'] as $k) {
                                        // if (isset($k['slg'])) {
                                        $text_color = "";
                                        if (($k['slfc'] / $k['oc']) > 300) {
                                            $text_color = "color:red;";
                                        }
                                        echo "<td nowrap='' style='text-align:center;$text_color'>" . gmdate("H:i:s", ($k['slg'] / $k['oc'])) . "</td>";
                                        // }
                                    }
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row">
                <div class="col-8 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Revenue Aktivasi </h6>
                        </div>
                        <div class="card-body" style="height: 400px">
                            <canvas id="chartjs-multiaxis-data-revenue"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Gagal Aktivasi Oleh Agent</h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body p-0">
                                <ul class="list-group list-unstyled">
                                    <?php

                                    if (count($gagal_aktivasi['reason']) > 0) {
                                        foreach ($gagal_aktivasi['reason'] as $val) {
                                            $clr = "#f64e60";
                                            $stl = "danger";

                                    ?>
                                            <li class="p-4 border-bottom">
                                                <div class="w-100">
                                                    <span><?php echo $val['axis']; ?></span>
                                                    <div class="barfiller h-7 rounded" data-color="<?php echo $clr; ?>">
                                                        <div class="tipWrap">
                                                            <span class="tip rounded <?php echo $stl; ?>">
                                                                <span class="tip-arrow"></span>
                                                            </span>
                                                        </div>
                                                        <span class="fill" data-percentage="<?php echo number_format(($val['numna'] / $gagal_aktivasi['jumlah']) * 100); ?>"></span>
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
                <?php
                // if (count($hourly['hourly_performance']['axis_param']) > 0) {
                //     foreach ($hourly['hourly_performance']['axis_param'] as $k => $v) {
                //         if (isset($v)) {

                ?>
                <div class="col-12 mt-3">
                    <hr>
                    <form>

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <select class="form-control" name="condition" id="condition">
                                    <option value='oc' selected>Order Call</option>
                                    <option value='contacted'>Contacted</option>
                                    <option value='not_contacted'>Not Contacted</option>
                                    <option value='verified'>Verified</option>
                                    <!-- <option value='slg' >SLG</option>
                                    <option value='slfc' >SLFC</option> -->
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <button type="button" id="filter" onclick="get_hourly();" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="col-12" id="hourly">
                    <center>-----LOADING DATA-------</center>
                </div>
                <?php
                //         }
                //     }
                // }
                ?>


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
        if ($('.barfiller').length > 0) {
            $(".barfiller").each(function() {
                $(this).barfiller({
                    barColor: $(this).data('color')
                });
            });
        }
        ////////////////////////////////// status Stats Chart /////////////////////////////
        var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');

        function get_hourly() {
            var filter_condition = $("#condition").val();
            var datena = $("#datena").val();
            var template = $("#template").val();
            $("#hourly").html("<center style='height:244px'>-----LOADING DATA-----</center>");
            $.ajax({
                url: "<?php echo base_url() . "Report/Report/get_hourly_weekly_moss" ?>",
                data: {
                    filter_condition: filter_condition,
                    datena: datena,
                    template: template,
                },
                methode: "get",
                success: function(response) {
                    $("#hourly").html(response);
                }
            });
        }

        $(document).ready(function() {
            /////////////////////////////////  Multi Axis ///////////////////////////
            get_hourly();
            var barmultiaxisChartData = {
                labels: [
                    <?php
                    if (count($grafik['summary_performance']) > 0) {
                        foreach ($grafik['summary_performance'] as $k) {
                            if (isset($k['axis'])) {
                                echo "'" . $k['axis'] . "',";
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
                            if (count($grafik['summary_performance']) > 0) {
                                foreach ($grafik['summary_performance'] as $k) {
                                    if (isset($k['verified'])) {
                                        $cvr = number_format((($k['verified'] / $k['contacted']) * 100), 2) . ",";
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
                            if (count($grafik['summary_performance']) > 0) {
                                foreach ($grafik['summary_performance'] as $k) {
                                    if (isset($k['oc'])) {
                                        echo $k['oc'] . ",";
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
                                if (count($grafik['summary_performance']) > 0) {
                                    foreach ($grafik['summary_performance'] as $k) {
                                        if (isset($k['contacted'])) {
                                            echo $k['contacted'] . ",";
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
                            if (count($grafik['summary_performance']) > 0) {
                                foreach ($grafik['summary_performance'] as $k) {
                                    if (isset($k['verified'])) {
                                        echo $k['verified'] . ",";
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


            ////revenue
            var barmultiaxisChartDataRevenue = {
                labels: [
                    <?php
                    if (count($revenue['summary_revenue']) > 0) {
                        foreach ($revenue['summary_revenue'] as $k) {
                            if (isset($k['axis'])) {
                                echo "'" . $k['axis'] . "',";
                            }
                        }
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Aktivasi',
                    // type: 'line',
                    backgroundColor: "#ffc107",
                    borderColor: "#ffc107",
                    fill: false,
                    yAxisID: 'y-axis-2',
                    data: [

                        <?php
                        if (count($revenue['summary_revenue']) > 0) {
                            foreach ($revenue['summary_revenue'] as $k) {
                                if (isset($k['count'])) {
                                    echo $k['count'] . ",";
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
                            return value ;
                        }
                    }
                }, {
                    label: 'Revenue',
                    backgroundColor: "#28a745",
                    borderWidth: 1,
                    yAxisID: 'y-axis-1',
                    type: 'bar',
                    data: [
                        <?php
                        if (count($revenue['summary_revenue']) > 0) {
                            foreach ($revenue['summary_revenue'] as $k) {
                                if (isset($k['revenue'])) {
                                    echo $k['revenue'] . ",";
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
                }]

            };

            var chartjs_multiaxis_bar_revenue = document.getElementById("chartjs-multiaxis-data-revenue");

            if (chartjs_multiaxis_bar_revenue) {
                ctx_revenue = document.getElementById('chartjs-multiaxis-data-revenue').getContext('2d');
                var mixedChart_revenue = new Chart(ctx_revenue, {
                    type: 'bar',
                    data: barmultiaxisChartDataRevenue,
                    options: {
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                    // type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
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