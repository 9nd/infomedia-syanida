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

    <?php
    $contacted = array(1, 13, 3, 12, 11);
    $uncontacted = array(15, 9, 8, 4, 7, 10, 14, 2);
    $contacted_tl = 0;
    foreach ($contacted as $key => $val) {
        $contacted_tl = $contacted_tl + $agent[$agentid][$val];
    }
    $uncontacted_tl = 0;
    foreach ($uncontacted as $key => $val) {
        $uncontacted_tl = $uncontacted_tl + $agent[$agentid][$val];
    }
    ?>

    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0">Dashboard</h4>
                            <p>Welcome to Dashboard</p>
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
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($agent[$agentid]['oc']); ?></h2>
                                <h6 class="card-liner-subtitle">DATA CONSUME</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($uncontacted_tl); ?></h2>
                                <h6 class="card-liner-subtitle">NOT CONTACTED</h6>
                            </div>
                            <div class="barfiller" data-color="#f64e60">
                                <div class="tipWrap">
                                    <span class="tip rounded danger">
                                        <span class="tip-arrow"></span>
                                    </span>
                                </div>
                                <span class="fill" data-percentage="<?php echo number_format(($uncontacted_tl / $agent[$agentid]['oc']) * 100, 2); ?>"></span>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($contacted_tl); ?></h2>
                                <h6 class="card-liner-subtitle">CONTACTED</h6>
                            </div>
                            <div class="barfiller" data-color="#1e3d73">
                                <div class="tipWrap">
                                    <span class="tip rounded primary">
                                        <span class="tip-arrow"></span>
                                    </span>
                                </div>
                                <span class="fill" data-percentage="<?php echo number_format(($contacted_tl / $agent[$agentid]['oc']) * 100, 2); ?>"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-4 mt-3">

                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($agent[$agentid][13]); ?></h2>
                                <h6 class="card-liner-subtitle">VERIFIED</h6>
                            </div>
                            <div class="barfiller" data-color="#17a2b8">
                                <div class="tipWrap">
                                    <span class="tip rounded info">
                                        <span class="tip-arrow"></span>
                                    </span>
                                </div>
                                <span class="fill" data-percentage="<?php echo number_format((($agent[$agentid][13] / $contacted_tl) * 100), 2); ?>"></span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($hpemail); ?></h2>
                                <h6 class="card-liner-subtitle">HP + EMAIL</h6>
                            </div>
                            <div class="barfiller" data-color="#17a2b8">
                                <div class="tipWrap">
                                    <span class="tip rounded info">
                                        <span class="tip-arrow"></span>
                                    </span>
                                </div>
                                <span class="fill" data-percentage="<?php echo number_format((($hpemail / $agent[$agentid][13]) * 100), 2); ?>"></span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($hponly); ?></h2>
                                <h6 class="card-liner-subtitle">HP ONLY</h6>
                            </div>
                            <div class="barfiller" data-color="#17a2b8">
                                <div class="tipWrap">
                                    <span class="tip rounded info">
                                        <span class="tip-arrow"></span>
                                    </span>
                                </div>
                                <span class="fill" data-percentage="<?php echo number_format((($hponly / $agent[$agentid][13]) * 100), 2); ?>"></span>
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
                                    if (count($status_rating_agent) > 0) {
                                        foreach ($status_rating_agent as $key => $val) {
                                            $stat_call = $controller->status_call->get_row(array("id_reason" => str_replace('status_call_', '', $key)));
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
                                                        <span class="fill" data-percentage="<?php echo number_format(($val / $agent[$agentid]['oc']) * 100); ?>"></span>
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
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="d-flex mt-4">

                                    <div class="border-0 outline-badge-success w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format((($agent[$agentid][13] / $agent[$agentid]['oc']) * 100), 2); ?>%</span><br />
                                        Convertion Rate
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Convertion Rate" data-content="Convertion Rate is the percentage of calls that resulted in a successful outcome.">i</span>
                                    </div>
                                    <div class="border-0 outline-badge-info w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"><?php echo number_format(($agent[$agentid]['oc'] / $duration_2), 2); ?></span><br />
                                        Calls Per Hours
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Calls Per Hours" data-content="Calls Per Hour (CPH) is a metric used in the contact center that tells managers how productive our contact centers are based on the number of calls our agents receive in an hour.  It is a helpful tool that allows us to track over-all productivity.">i</span>
                                    </div>
                                </div>
                                <div class="d-flex mt-4">
                                    <div class="border-0 outline-badge-success w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format((($agent[$agentid][13] / 110) * 100), 2); ?>%</span><br />
                                        Achievement Target
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Achievement Target" data-content="Convertion Rate is the percentage of calls that resulted in a successful outcome.">i</span>

                                    </div>
                                    <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"><?php echo number_format($oncallrate, 2); ?>%</span><br />
                                        On-Call Rate
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="On-Call Rate" data-content="Convertion Rate is the percentage of calls that resulted in a successful outcome.">i</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div style="font-size:25px;text-align:center;position:absolute;margin-left:160px;">BREAK</div>
                    <div id="break_chart" style="min-width: 250px; width: 100%;margin-top:10px;color:#a0bc2e;"></div>
                    <div style="color:#ff8e35;font-size:40px;text-align:center;margin-top:-50px;position:absolute;margin-left:160px;" id='break'><?php echo number_format($agent_status_break['break']['total']); ?></div>
                </div>

                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div style="height:200px;">
                        <canvas id="chartjs-other-pie"></canvas>
                    </div>

                </div>
            </div>
            <!-- START: Card Data-->





            <div class="row">
                <div class="col-12 col-lg-12  mt-3">
                    <table id="byagent" class="table dataTable table-striped table-bordered">
                        <thead>
                            <tr>
                                <!-- <td>No</td> -->
                                <!-- <td nowrap>
                                    Team Leader
                                </td> -->
                                <td>Name</td>
                                <td>AgentID</td>
                                <td nowrap style='text-align:center;'>Data Consume</td>
                                <td style='text-align:center;'>Contacted</td>
                                <td nowrap style='text-align:center;'>CVR</td>
                                <td style='text-align:center;'>Verified</td>
                                <td nowrap style='text-align:center;'>Successful Rate</td>
                                <td style='text-align:center;'>Efficiency</td>
                                <td nowrap style='text-align:center;'>CFH</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 0;
                            if (count($agent) > 0) {
                                $contacted = array(1, 13, 3, 12, 11);
                                $uncontacted = array(15, 9, 8, 4, 7, 10, 14, 2);
                                foreach ($agent as $kode_tl => $datana) {
                                    $n++;
                                    $contacted_tl = 0;
                                    foreach ($contacted as $key => $val) {
                                        $contacted_tl = $contacted_tl + $agent[$kode_tl][$val];
                                    }
                                    $uncontacted_tl = 0;
                                    foreach ($uncontacted as $key => $val) {
                                        $uncontacted_tl = $uncontacted_tl + $agent[$kode_tl][$val];
                                    }
                                    echo "<tr>";
                                    // echo "<td>" . $n . "</td>";
                                    // echo "<td nowrap>" . $controller->Sys_user_table_model->get_row(array("nmuser" =>  $controller->Sys_user_table_model->get_row(array("nmuser" => $kode_tl))->tl))->nama . "</td>";
                                    echo "<td nowrap>" . $controller->Sys_user_table_model->get_row(array("nmuser" => $kode_tl))->nama . "</td>";
                                    echo "<td>" . $controller->Sys_user_table_model->get_row(array("nmuser" => $kode_tl))->agentid . "</td>";
                                    echo "<td style='text-align:center;'>" . number_format($agent[$kode_tl]['oc']) . "</td>";
                                    echo "<td style='text-align:center;'>" . number_format($contacted_tl) . "</td>";
                                    echo "<td style='text-align:center;'>" . number_format(($agent[$kode_tl][13] / $agent[$kode_tl]['oc']) * 100, 2) . "%</td>";
                                    echo "<td style='text-align:center;'>" . number_format($agent[$kode_tl][13]) . "</td>";
                                    echo "<td style='text-align:center;'>" . number_format(($agent[$kode_tl][13] / $contacted_tl) * 100, 2) . "%</td>";
                                    echo "<td style='text-align:center;'>" . number_format(($agent[$kode_tl][13]) / $duration) . "</td>";
                                    echo "<td style='text-align:center;'>" . number_format(($agent[$kode_tl]['oc']) / $duration) . "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">

                <div class="col-12 col-md-8  col-lg-12   mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div id="apex_analytic_chart"></div>
                            </div>
                        </div>
                    </div>
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
        $('#byagent').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "order": [[ 5, "desc" ]],
            responsive: true
        });
        /////////////////////////////////// Analytic Chart /////////////////////
        if ($("#apex_analytic_chart").length > 0) {
            options = {
                theme: {
                    mode: 'light'
                },
                chart: {
                    height: 350,
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
                colors: ['#1ee0ac', '#1e3d73', '#17a2b8'],
                series: [{
                    name: 'Data Consume',
                    data: [
                        <?php
                        foreach ($log_oc as $key => $value) {
                            echo intval($value) . ",";
                        }
                        ?>
                    ]
                }, {
                    name: 'Contacted',
                    data: [
                        <?php
                        foreach ($log_contacted as $key => $value) {
                            echo intval($value) . ",";
                        }
                        ?>
                    ]
                }, {
                    name: 'Verified',
                    data: [
                        <?php
                        foreach ($log_veri as $key => $value) {
                            echo intval($value) . ",";
                        }
                        ?>
                    ]
                }, ],
                xaxis: {
                    categories: [
                        <?php
                        foreach ($log_veri as $key => $value) {
                            echo "'" . $key . "',";
                        }

                        ?>
                    ],
                },
                yaxis: {
                    title: {
                        text: ''
                    }
                },
                fill: {
                    opacity: 1

                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " "
                        }
                    }
                }
            }

            var chart = new ApexCharts(
                document.querySelector("#apex_analytic_chart"),
                options
            );
            chart.render();
        }
        



        ////////////////////////////////// status Stats Chart /////////////////////////////


        ////pie chart break///
        var chart;
        var bodycolor = getComputedStyle(document.body).getPropertyValue('--bodycolor');
        var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');
        var bordercolor = getComputedStyle(document.body).getPropertyValue('--bordercolor');
        var config_break = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [<?php echo intval($agent_status_break['break']['Break'] / 60) . "," . intval($agent_status_break['break']['Pray'] / 60) . "," . intval($agent_status_break['break']['Toilet'] / 60) . "," . intval($agent_status_break['break']['Handsup'] / 60); ?>],
                    backgroundColor: [
                        '#1e3d73',
                        '#17a2b8',
                        '#ffc107',
                        '#fd9644',
                    ],
                    label: 'Break'
                }],
                labels: [
                    'Lunch',
                    'Pray',
                    'Toilet',
                    'Handsup'
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    position: 'left',
                    labels: {
                        fontColor: bodycolor
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
            }
        };
        var chartjs_other_pie = document.getElementById("chartjs-other-pie");
        if (chartjs_other_pie) {
            var ctx_break = document.getElementById('chartjs-other-pie').getContext('2d');
            window.myDoughnut = new Chart(ctx_break, config_break);
        }

        // Element inside which you want to see the chart
        $("#break_chart").html("");
        let element5 = document.querySelector('#break_chart');

        // // Properties of the gauge

        var break_num = <?php echo $agent_status_break['break']['break_persen'] ?>;
        var break_label = <?php echo $agent_status_break['break']['break_persen'] ?>;
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
            rangeLabel: ['0', '<?php echo number_format($agent_status_break['break']['max']); ?>'],
            centralLabel: "",
        };
        GaugeChart
            .gaugeChart(element5, 400, gaugeOptions5)
            .updateNeedle(break_num);
        ///end break pie///


        $(document).ready(function() {


            var chartjs_multiaxis_bar = document.getElementById("chartjs-account-chart");
            if (chartjs_multiaxis_bar) {
                var barmultiaxisChartData = {
                    labels: ['08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'],
                    datasets: [

                        {
                            label: 'Contacted Rate (%)',
                            type: 'line',
                            // backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                            borderColor: primarycolor,
                            fill: false,
                            yAxisID: 'Contacted Rate',
                            borderWidth: 2,
                            data: [
                                <?php
                                foreach ($peak_hours['rate_contacted'] as $bulanna => $valna) {
                                    echo intval($valna) . ',';
                                }

                                ?>
                            ]
                        }, {
                            label: 'Verified',
                            type: 'bar',
                            backgroundColor: 'green',
                            borderColor: bodycolor,
                            borderWidth: 1,
                            yAxisID: 'Verified',
                            data: [
                                <?php
                                foreach ($peak_hours['verified'] as $bulanna => $valna) {
                                    echo intval($valna) . ',';
                                }
                                ?>
                            ]
                        },
                    ]

                };
                ctx = document.getElementById('chartjs-account-chart').getContext('2d');
                window.myBar = new Chart(ctx, {
                    type: 'bar',
                    data: barmultiaxisChartData,
                    options: {
                        responsive: true,
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: ' '
                        },
                        scales: {
                            yAxes: [{
                                id: 'Verified',
                                position: 'right',
                            }, {
                                id: 'Contacted Rate',
                                position: 'left',
                                ticks: {
                                    max: 100,
                                    min: 0
                                }
                            }]
                        }
                    }
                });
            }
        });
    </script>
</body>
<!-- END: Body-->

</html>