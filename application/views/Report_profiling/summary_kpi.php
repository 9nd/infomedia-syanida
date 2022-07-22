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
                <li class="active">
                    <a href="#"><i class="icon-chart mr-1"></i> KPI</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Report/Report/report_agent" ?>"><i class="icon-chart mr-1"></i> AGENT</a>
                </li>
            </ul>
            <!-- END: Menu-->
            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="breadcrumb-item active">Key Performance Indicator</li>
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
                            <h4 class="mb-0">Key Performance Indicator</h4>
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
                                    <option value='weekly' <?php echo ($template == "weekly") ? 'selected' : ''; ?>>Weekly</option>
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
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="d-flex mt-4">
                                    <div class="border-0 outline-badge-info w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"><?php echo number_format($peformance['summary'][$m]['cfa']); ?></span><br />
                                        Calls per Agent
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Calls Per Agent" data-content="It’s a numbers game so knowing the more engagements an agent has, the more conversions your effort will have. Tracking the efficiency of an agent is thus crucial.  Unmotivated or tired agents can severely lower success results.  Yet, an Automated dialing platform improves this metric as the calls keeping coming in.">i</span>

                                    </div>
                                    <div class="border-0 outline-badge-info w-50 p-3 ml-2  rounded text-center"><span class="h5 mb-0"><?php echo number_format($peformance['summary'][$m]['cfn'], 2); ?></span><br />
                                        Calls per Account
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Calls per Account" data-content="This metric tracks the number of calls made to a contact.  A high number of calls per account, without a success, may indicate that a lead or contact should be removed from the program.">i</span>

                                    </div>
                                </div>
                                <div class="d-flex mt-4">


                                    <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format($peformance['summary'][$m]['cfh']); ?></span><br />
                                        Calls Per Hours
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Calls Per Hours" data-content="Calls Per Hour (CPH) is a metric used in the contact center that tells managers how productive our contact centers are based on the number of calls our agents receive in an hour.  It is a helpful tool that allows us to track over-all productivity.">i</span>

                                    </div>

                                    <div class="border-0 outline-badge-success w-50 p-3 ml-2 rounded text-center"><span class="h5 mb-0"><?php echo $peformance['summary'][$m]['aht']; ?></span><br />
                                        AHT
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Average Handle Time" data-content="Average Handle Time (AHT) is the average amount of time agents talk to customers and the average amount of time an agent takes to wrap-up a call">i</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="d-flex mt-4">
                                    <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format($peformance['summary'][$m]['hitrate'], 2); ?>%</span><br />
                                        Hit Rate
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Hit Rate" data-content="The hit rate is calculated by dividing the calls made by each agent with the number of those calls answered by a prospect. Success depends on having a high hit rate.">i</span>

                                    </div>
                                    <div class="border-0 outline-badge-info w-50 p-3  ml-2 rounded text-center"><span class="h5 mb-0"><?php echo number_format($peformance['summary'][$m]['lcr'], 2); ?>%</span><br />
                                        List Closure Rate
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="List Closure Rate" data-content="This rate measures the percentage of prospects that were closed in comparison to the total number of potential prospects for a targeted, outbound call center campaign. A low rate indicates problems with the calling list, such as bad numbers, cold leads, or the improper inclusion of “do not call” numbers.">i</span>

                                    </div>
                                </div>
                                <div class="d-flex mt-4">

                                    <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format($peformance['summary'][$m]['fcc']); ?></span><br />
                                        First Call Close
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="The First Call Close" data-content="The First Call Close (FCC) metric indicates the number of varified that were made on an agent’s “first call” or contact with the customer.">i</span>

                                    </div>
                                    <div class="border-0 outline-badge-success w-50 p-3 ml-2  rounded text-center"><span class="h5 mb-0"><?php echo number_format($peformance['summary'][$m]['ppa'], 2); ?></span><br />
                                        PPA
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="PPA" data-content="PPA is Average Verifed Per Agent.">i</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="d-flex mt-4">

                                    <div class="border-0 outline-badge-success w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format($peformance['summary'][$m]['cvr'], 2); ?>%</span><br />
                                        Convertion Rate
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Convertion Rate" data-content="Convertion Rate is the percentage of calls that resulted in a successful outcome.">i</span>

                                    </div>
                                    <div class="border-0 outline-badge-success w-50 p-3  ml-2 rounded text-center"><span class="h5 mb-0"><?php echo number_format($peformance['summary'][$m]['svr'], 2); ?>%</span><br />
                                        Successful Rate
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Successful Rate" data-content="Convertion Rate is the percentage of calls that resulted in a successful outcome.">i</span>
                                    </div>
                                </div>
                                <div class="d-flex mt-4">
                                    <div class="border-0 outline-badge-success w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format($peformance['summary'][$m]['ecip'], 2); ?>%</span><br />
                                        Achievement Target
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Achievement Target" data-content="Convertion Rate is the percentage of calls that resulted in a successful outcome.">i</span>
                                    </div>
                                    <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"><?php echo number_format($peformance['summary'][$m]['call_rate'], 2); ?>%</span><br />
                                        On-Call Rate
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="On-Call Rate" data-content="Convertion Rate is the percentage of calls that resulted in a successful outcome.">i</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Key Performance Indikator </h6>
                        </div>
                        <div class="card-body table-responsive p-0">

                            <table class="table font-w-600 mb-0">
                                <thead>
                                    <tr>
                                        <th>KPI/Periode</th>
                                        <?php
                                        if (count($peformance['summary']) > 0) {
                                            foreach ($peformance['summary'] as $bulan => $datana) {
                                                echo "<th>" . $datana['axis'] . "</th>";
                                            }
                                        }
                                        ?>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
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
                                    ?>
                                    <!-- <td class="text-success">1,12,51,520 <i class="ion ion-arrow-graph-up-right"></i></td>
                                        <td class="text-danger">3,23,55,479 <i class="ion ion-arrow-graph-down-right"></i></td>
                                        <td class="text-info">4,23,27,346</td> -->
                                    <?php
                                    if (count($kpi) > 0) {
                                        foreach ($kpi as $code => $data_kpi) {
                                            echo "<tr>";
                                            echo "<td nowrap>" . $data_kpi['title'] . "</td>";
                                            if (count($peformance['summary']) > 0) {
                                                foreach ($peformance['summary'] as $bulan => $datana) {
                                                    $before = $peformance['summary'][$bulan]['before'];
                                                    switch (true) {
                                                        case ($peformance['summary'][$bulan][$code] > $peformance['summary'][$before][$code]):
                                                            $class = "text-success";
                                                            $icon = '';
                                                            break;
                                                        case ($peformance['summary'][$bulan][$code] < $peformance['summary'][$before][$code]):
                                                            $class = "text-danger";
                                                            $icon = '';
                                                            break;
                                                        default:
                                                            $class = "text-info";
                                                            $icon = '';
                                                            break;
                                                    }
                                                    if ($code == "aht") {
                                                        echo "<td class='" . $class . "' nowrap>" . $peformance['summary'][$bulan][$code] . " " . $icon . "</td>";
                                                    } else {
                                                        echo "<td class='" . $class . "' nowrap>" . number_format($peformance['summary'][$bulan][$code], $data_kpi['number_format']) . " " . $data_kpi['back'] . " " . $icon . "</td>";
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

</body>
<!-- END: Body-->

</html>