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
                <li>
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
                <li class="active">
                    <a href="#"><i class="icon-chart mr-1"></i> AGENT</a>
                </li>
            </ul>
            <!-- END: Menu-->
            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="breadcrumb-item active">AGENT PERFORMANCE</li>
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
                            <h4 class="mb-0">AGENT PERFORMANCE</h4>
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
                            <?php
                            if ($userdata->opt_level == 7 || $userdata->opt_level == 6) {
                            ?>
                                <div class="form-group col-md-2">
                                    <select class="form-control" name="condition" id="condition">
                                        <option value='1' <?php echo ($condition == 1) ? 'selected' : ''; ?>>With Data Self</option>
                                        <option value='2' <?php echo ($condition == 2) ? 'selected' : ''; ?>>Without Data Self</option>
                                    </select>
                                </div>


                            <?php
                            } else {
                            ?>
                                <input type="hidden" id="condition" value='1' name="condition">
                            <?php
                            }
                            ?>
                            <div class="form-group col-md-2">
                                <select class="form-control" name="template" id="template">
                                    <option value='monthly' <?php echo ($template == "monthly") ? 'selected' : ''; ?>>Monthly</option>
                                    <option value='weekly' <?php echo ($template == "weekly") ? 'selected' : ''; ?>>Peak</option>
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
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <?php
                            $total_count = 0;
                            if (count($agent) > 0) {
                                $kpi = array(
                                    "cfa" => array(
                                        "title" => "Calls per Agent",
                                        "number_format" => 0,
                                        "back" => "",
                                    ),
                                    "cfn" => array(
                                        "title" => "Calls per Account",
                                        "number_format" => 2,
                                        "back" => "",
                                    ),
                                    "cfh" => array(
                                        "title" => "Calls Per Hours",
                                        "number_format" => 0,
                                        "back" => "",
                                    ),
                                    "aht" => array(
                                        "title" => "AHT",
                                        "number_format" => 0,
                                        "back" => "",
                                    ),
                                    "hitrate" => array(
                                        "title" => "Hit Rate",
                                        "number_format" => 2,
                                        "back" => "%",
                                    ),
                                    "lcr" => array(
                                        "title" => "List Closure Rate",
                                        "number_format" => 2,
                                        "back" => "%",
                                    ),
                                    "fcc" => array(
                                        "title" => "First Call Close",
                                        "number_format" => 0,
                                        "back" => "",
                                    ),
                                    "ppa" => array(
                                        "title" =>  "PPA",
                                        "number_format" => 2,
                                        "back" => "",
                                    ),
                                    "cvr" => array(
                                        "title" =>  "Convertion Rate",
                                        "number_format" => 2,
                                        "back" => "%",
                                    ),
                                    "svr" => array(
                                        "title" =>  "Successful Rate",
                                        "number_format" => 2,
                                        "back" => "%",
                                    ),
                                    "ecip" => array(
                                        "title" =>  "Achievement Target",
                                        "number_format" => 2,
                                        "back" => "%",
                                    ),
                                    "call_rate" =>  array(
                                        "title" =>  "On-Call Rate",
                                        "number_format" => 2,
                                        "back" => "%",
                                    )
                                );

                                $n = 0;
                                foreach ($agent as $r) {
                            ?>
                                    <div class="collapse" id="collapseExample<?php echo $r->agentid; ?>">
                                        <p class="border p-3">
                                        <div class="card">
                                            <div class="card-header  justify-content-between align-items-center">
                                                <h6 class="card-title">Key Performance Indikator <?php echo $r->agentid; ?></h6>
                                                <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#collapseExample<?php echo $r->agentid; ?>" aria-expanded="false" aria-controls="collapseExample">
                                                Close
                                            </button>
                                            </div>
                                            <div class="card-body table-responsive p-0">

                                                <table class="table font-w-600 mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>KPI/Periode</th>
                                                            <?php
                                                            if (count($peformance[$r->agentid]) > 0) {
                                                                echo "<th>AVG (ACH > 90% )</th>";
                                                                foreach ($peformance[$r->agentid] as $bulan => $datana) {
                                                                    echo "<th>" . $datana['axis'] . "</th>";
                                                                }
                                                            }
                                                            ?>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (count($kpi) > 0) {
                                                            foreach ($kpi as $code => $data_kpi) {
                                                                echo "<tr>";
                                                                echo "<td nowrap>" . $data_kpi['title'] . "</td>";
                                                                if ($code == "aht") {
                                                                   
                                                                    echo "<td  nowrap>" .$peformance['agent_best']['aht'][$code] . " " . $icon . "</td>";
                                                                } else {
                                                                    echo "<td  nowrap>" . number_format(($peformance['agent_best']['sum'][$code]/$peformance['agent_best']['count'][$code]), $data_kpi['number_format']) . " " . $data_kpi['back'] . " " . $icon . "</td>";
                                                                }
                                                                if (count($peformance[$r->agentid]) > 0) {
                                                                    foreach ($peformance[$r->agentid] as $bulan => $datana) {
                                                                        switch (true) {
                                                                            case ($peformance[$r->agentid][$bulan][$code] > ($peformance['agent_best']['sum'][$code]/$peformance['agent_best']['count'][$code])):
                                                                                $class = "text-success";
                                                                                $icon = '';
                                                                                break;
                                                                            case ($peformance[$r->agentid][$bulan][$code] < ($peformance['agent_best']['sum'][$code]/$peformance['agent_best']['count'][$code])):
                                                                                $class = "text-danger";
                                                                                $icon = '';
                                                                                break;
                                                                            default:
                                                                                $class = "text-info";
                                                                                $icon = '';
                                                                                break;
                                                                        }
                                                                        if ($code == "aht") {
                                                                            echo "<td class='" . $class . "' nowrap>" . $peformance[$r->agentid][$bulan][$code] . " " . $icon . "</td>";
                                                                        } else {
                                                                            echo "<td class='" . $class . "' nowrap>" . number_format($peformance[$r->agentid][$bulan][$code], $data_kpi['number_format']) . " " . $data_kpi['back'] . " " . $icon . "</td>";
                                                                        }
                                                                    }
                                                                }
                                                                echo "</tr>";
                                                            }
                                                        }

                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        </p>
                                    </div>
                            <?php
                                }
                            }
                            ?>

                            <table id="byagent" class="table dataTable table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>Nama</th>
                                        <th>AgentID</th>
                                        <th>Utilitas</th>
                                        <th>Target</th>
                                        <th>Kualitas</th>
                                        <th>Telat</th>
                                        <th>Kinerja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_count = 0;
                                    if (count($agent) > 0) {
                                        $n = 0;
                                        foreach ($agent as $r) {
                                            $n++;
                                            echo "<tr>";
                                            echo "<td nowrap>";
                                    ?>
                                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample<?php echo $r->agentid; ?>" aria-expanded="false" aria-controls="collapseExample">
                                                Detail
                                            </button>
                                    <?php
                                            echo "</td>";
                                            echo "<td nowrap>" . $r->nama . "</td>";
                                            echo "<td nowrap>" . $r->agentid . "</td>";
                                            echo "<td nowrap>" . number_format($utilisasi[$r->agentid][$m]['pencapaian'], 2) . "%</td>";
                                            echo "<td nowrap>" . number_format($target_call[$r->agentid][$m]['pencapaian'], 2) . "%</td>";
                                            echo "<td nowrap>" . number_format($kuality[$r->agentid][$m]['pencapaian'], 2) . "%</td>";
                                            $pencapaian = $keterlambatan[$r->agentid][$m];
                                            if ($pencapaian <= 0) {
                                                $lambat = 5;
                                            } elseif ($pencapaian <= 5) {
                                                $lambat = 2;
                                            } else {
                                                $lambat = 1;
                                            }
                                            $persen_lambat = ($lambat * 10) / 5;
                                            $lambatna = ($lambat / 5) * 100;
                                            $total = ($utilisasi[$r->agentid][$m]['nilai'] + $target_call[$r->agentid][$m]['nilai'] + $kuality[$r->agentid][$m]['nilai'] + $persen_lambat);
                                            echo "<td nowrap>" . number_format($pencapaian, 2) . "</td>";
                                            echo "<td nowrap>" . number_format($total, 2) . "%</td>";


                                            echo "</tr>";
                                        }
                                    }

                                    ?>


                                </tbody>
                            </table>
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
        $('#byagent').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "order": [
                [6, "desc"]
            ],
            responsive: true,

        });
        ////////////////////////////////// status Stats Chart /////////////////////////////
        var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');
        $(document).ready(function() {
            /////////////////////////////////  Multi Axis ///////////////////////////
            4
            var barmultiaxisChartData = {
                labels: [
                    <?php
                    if (count($utilisasi['bulan']) > 0) {
                        foreach ($utilisasi['bulan'] as $bulan => $datana) {
                            echo "'" . $utilisasi['bulan'][$bulan]['axis'] . "',";
                        }
                    }
                    ?>
                ],
                datasets: [{
                        label: 'Kinerja',
                        type: 'line',
                        backgroundColor: "#ffc107",
                        borderColor: "#ffc107",
                        fill: false,
                        yAxisID: 'y-axis-2',
                        data: [

                            <?php
                            if (count($utilisasi['bulan']) > 0) {
                                foreach ($utilisasi['bulan'] as $bulan => $datana) {
                                    $numna = "0,";
                                    if (isset($utilisasi['bulan'][$bulan]['sum'])) {
                                        $sum = $utilisasi['bulan'][$bulan]['sum'] + $target_call['bulan'][$bulan]['sum'] + $keterlambatan['bulan'][$bulan]['sum'] + $kuality['bulan'][$bulan]['sum'];
                                        $count = $utilisasi['bulan'][$bulan]['count'] + $target_call['bulan'][$bulan]['count'] + $keterlambatan['bulan'][$bulan]['count'] + $kuality['bulan'][$bulan]['count'];
                                        $numna = number_format($sum / $count, 2) . ",";
                                    }
                                    echo $numna;
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
                        label: 'Utilitas',
                        backgroundColor: "#fd7e14",
                        type: 'bar',
                        yAxisID: 'y-axis-1',
                        data: [
                            <?php
                            if (count($utilisasi['bulan']) > 0) {
                                foreach ($utilisasi['bulan'] as $bulan => $datana) {
                                    $numna = "0,";
                                    if (isset($utilisasi['bulan'][$bulan]['sum'])) {
                                        $numna = number_format($utilisasi['bulan'][$bulan]['sum'] / $utilisasi['bulan'][$bulan]['count'], 2) . ",";
                                    }
                                    echo $numna;
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
                        label: 'Target Call',
                        backgroundColor: "#007bff",
                        borderWidth: 1,
                        yAxisID: 'y-axis-1',
                        type: 'bar',
                        data: [<?php
                                if (count($utilisasi['bulan']) > 0) {
                                    foreach ($utilisasi['bulan'] as $bulan => $datana) {
                                        $numna = "0,";
                                        if (isset($target_call['bulan'][$bulan]['sum'])) {
                                            $numna = number_format($target_call['bulan'][$bulan]['sum'] / $target_call['bulan'][$bulan]['count'], 2) . ",";
                                        }
                                        echo $numna;
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
                        label: 'Waktu Masuk',
                        backgroundColor: "#28a745",
                        borderWidth: 1,
                        yAxisID: 'y-axis-1',
                        type: 'bar',
                        data: [
                            <?php
                            if (count($utilisasi['bulan']) > 0) {
                                foreach ($utilisasi['bulan'] as $bulan => $datana) {
                                    $numna = "0,";
                                    if (isset($keterlambatan['bulan'][$bulan]['sum'])) {
                                        $numna = number_format($keterlambatan['bulan'][$bulan]['sum'] / $keterlambatan['bulan'][$bulan]['count'], 2) . ",";
                                    }
                                    echo $numna;
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
                    },
                    {
                        label: 'Kualitas',
                        backgroundColor: "#17a2b8",
                        borderWidth: 1,
                        yAxisID: 'y-axis-1',
                        type: 'bar',
                        data: [
                            <?php
                            if (count($utilisasi['bulan']) > 0) {
                                foreach ($utilisasi['bulan'] as $bulan => $datana) {
                                    $numna = "0,";
                                    if (isset($kuality['bulan'][$bulan]['sum'])) {
                                        $numna = number_format($kuality['bulan'][$bulan]['sum'] / $kuality['bulan'][$bulan]['count'], 2) . ",";
                                    }
                                    echo $numna;
                                }
                            }
                            ?>
                        ],
                        datalabels: {
                            color: '#FFFFFF',
                            display: true,
                            backgroundColor: '#17a2b8',
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