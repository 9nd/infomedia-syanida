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
                            <p>Welcome to Dashboard Reguler</p>
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
                                <h2><?php echo number_format($dapros + $wo); ?></h2>
                                <h6 class="card-liner-subtitle">DATA WAITLIST</h6>
                            </div>

                        </div>
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($wo); ?></h2>
                                <h6 class="card-liner-subtitle">DATA DISTRIBUTION</h6>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($oc); ?></h2>
                                <h6 class="card-liner-subtitle">DATA CONSUME</h6>
                            </div>
                            <div class="barfiller" data-color="#1ee0ac">
                                <div class="tipWrap">
                                    <span class="tip rounded success">
                                        <span class="tip-arrow"></span>
                                    </span>
                                </div>
                                <span class="fill" data-percentage="<?php echo number_format(($oc / ($wo + $oc)) * 100, 2); ?>"></span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($not_contacted); ?></h2>
                                <h6 class="card-liner-subtitle">NOT CONTACTED</h6>
                            </div>
                            <div class="barfiller" data-color="#f64e60">
                                <div class="tipWrap">
                                    <span class="tip rounded danger">
                                        <span class="tip-arrow"></span>
                                    </span>
                                </div>
                                <span class="fill" data-percentage="<?php echo number_format(($not_contacted / $oc) * 100, 2); ?>"></span>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($contacted); ?></h2>
                                <h6 class="card-liner-subtitle">CONTACTED</h6>
                            </div>
                            <div class="barfiller" data-color="#1e3d73">
                                <div class="tipWrap">
                                    <span class="tip rounded primary">
                                        <span class="tip-arrow"></span>
                                    </span>
                                </div>
                                <span class="fill" data-percentage="<?php echo number_format(($contacted / $oc) * 100, 2); ?>"></span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($verified); ?></h2>
                                <h6 class="card-liner-subtitle">VERIFIED</h6>
                            </div>
                            <div class="barfiller" data-color="#17a2b8">
                                <div class="tipWrap">
                                    <span class="tip rounded info">
                                        <span class="tip-arrow"></span>
                                    </span>
                                </div>
                                <span class="fill" data-percentage="<?php echo $cvr; ?>"></span>
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
                                    if (count($status_rating) > 0) {
                                        foreach ($status_rating as $key => $val) {
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
                                                        <span class="fill" data-percentage="<?php echo number_format(($val / $oc) * 100); ?>"></span>
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
                                    <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo $all_agent; ?></span><br />
                                        TOTAL AGENT
                                    </div>
                                    <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0">
                                            <?php
                                            if ($agent_status_break['cache_monev_realtime']['aval_num'] < 0) {
                                                echo 0;
                                            } else {
                                                echo $agent_status_break['cache_monev_realtime']['aval_num'];
                                            }
                                            ?>
                                        </span><br />
                                        ONLINE
                                    </div>
                                </div>
                                <div class="d-flex mt-4">
                                    <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo $agent_status_break['cache_monev_realtime']['idle_num']; ?></span><br />
                                        IDLE
                                    </div>
                                    <div class="border-0 outline-badge-info w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"><?php echo $agent_status_break['cache_monev_realtime']['idle_num']; ?></span><br />
                                        BREAK
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
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="d-flex mt-4">

                                    <div class="border-0 outline-badge-info w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"><?php echo number_format($oc / $agent_online); ?></span><br />
                                        Calls per Agent
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Calls Per Agent" data-content="It’s a numbers game so knowing the more engagements an agent has, the more conversions your effort will have. Tracking the efficiency of an agent is thus crucial.  Unmotivated or tired agents can severely lower success results.  Yet, an Automated dialing platform improves this metric as the calls keeping coming in.">i</span>

                                    </div>

                                    <div class="border-0 outline-badge-info w-50 p-3 ml-2  rounded text-center"><span class="h5 mb-0"><?php echo $avg_call_per_account; ?></span><br />
                                        Calls per Account
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Calls per Account" data-content="This metric tracks the number of calls made to a contact.  A high number of calls per account, without a success, may indicate that a lead or contact should be removed from the program.">i</span>

                                    </div>

                                </div>
                                <div class="d-flex mt-4">


                                    <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo $call_per_hours; ?></span><br />
                                        Calls Per Hours
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Calls Per Hours" data-content="Calls Per Hour (CPH) is a metric used in the contact center that tells managers how productive our contact centers are based on the number of calls our agents receive in an hour.  It is a helpful tool that allows us to track over-all productivity.">i</span>

                                    </div>

                                    <div class="border-0 outline-badge-success w-50 p-3 ml-2 rounded text-center"><span class="h5 mb-0"><?php echo $aht; ?></span><br />
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
                                    <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo $hitrate_close; ?>%</span><br />
                                        Hit Rate
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Hit Rate" data-content="The hit rate is calculated by dividing the calls made by each agent with the number of those calls answered by a prospect. Success depends on having a high hit rate.">i</span>

                                    </div>
                                    <div class="border-0 outline-badge-info w-50 p-3  ml-2 rounded text-center"><span class="h5 mb-0"><?php echo $lcr; ?>%</span><br />
                                        List Closure Rate
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="List Closure Rate" data-content="This rate measures the percentage of prospects that were closed in comparison to the total number of potential prospects for a targeted, outbound call center campaign. A low rate indicates problems with the calling list, such as bad numbers, cold leads, or the improper inclusion of “do not call” numbers.">i</span>

                                    </div>
                                </div>
                                <div class="d-flex mt-4">

                                    <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo $firstcallclose; ?></span><br />
                                        First Call Close
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="The First Call Close" data-content="The First Call Close (FCC) metric indicates the number of varified that were made on an agent’s “first call” or contact with the customer.">i</span>

                                    </div>
                                    <div class="border-0 outline-badge-success w-50 p-3 ml-2  rounded text-center"><span class="h5 mb-0"><?php echo $ppa; ?></span><br />
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

                                    <div class="border-0 outline-badge-success w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo $hitrate_used; ?>%</span><br />
                                        Convertion Rate
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Convertion Rate" data-content="Convertion Rate is the percentage of calls that resulted in a successful outcome.">i</span>

                                    </div>
                                    <div class="border-0 outline-badge-success w-50 p-3  ml-2 rounded text-center"><span class="h5 mb-0"><?php echo $cvr; ?>%</span><br />
                                        Successful Rate
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Successful Rate" data-content="Convertion Rate is the percentage of calls that resulted in a successful outcome.">i</span>

                                    </div>
                                </div>
                                <div class="d-flex mt-4">
                                    <div class="border-0 outline-badge-success w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format(($verified / (110 * $agent_online)) * 100, 2); ?>%</span><br />
                                        Achievement Target
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="Achievement Target" data-content="Convertion Rate is the percentage of calls that resulted in a successful outcome.">i</span>

                                    </div>
                                    <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"><?php echo $on_call_rate; ?>%</span><br />
                                        On-Call Rate
                                        <span class="bg-success card-liner-absolute-icon text-white circle-40" style="width:15px !important;height:15px !important;line-height:15px !important;cursor: pointer;z-index:100000;" data-toggle="popover" title="On-Call Rate" data-content="Convertion Rate is the percentage of calls that resulted in a successful outcome.">i</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>




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
                                    $time1 = strtotime('08:00:00');
                                    $time2 = strtotime(date("H:i:s", strtotime($last_u[$kode_tl])));
                                    $duration_2 = round(abs($time2 - $time1) / 3600, 2);
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
                                    echo "<td style='text-align:center;'>" . number_format(($agent[$kode_tl][13]) / $duration_2) . "</td>";
                                    echo "<td style='text-align:center;'>" . number_format(($agent[$kode_tl]['oc']) / $duration_2) . "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12  mt-3">
                    <table class="table">
                        <tr>
                            <td>
                                Team Leader
                            </td>
                            <td>Underteam</td>
                            <td>Data Consume</td>
                            <td>Contacted</td>
                            <td>Convertion Rate</td>
                            <td>Verified</td>
                            <td>Successful Rate</td>
                            <td>Efficiency</td>
                            <td>Call Per Hours</td>
                        </tr>
                        <?php
                        if (count($tl) > 0) {
                            $contacted = array(1, 13, 3, 12, 11);
                            $uncontacted = array(15, 9, 8, 4, 7, 10, 14, 2);
                            foreach ($tl as $kode_tl => $datana) {
                                $contacted_tl = 0;
                                foreach ($contacted as $key => $val) {
                                    $contacted_tl = $contacted_tl + $tl[$kode_tl][$val];
                                }
                                $uncontacted_tl = 0;
                                foreach ($uncontacted as $key => $val) {
                                    $uncontacted_tl = $uncontacted_tl + $tl[$kode_tl][$val];
                                }
                                
                                echo "<tr>";
                                echo "<td>" . $controller->Sys_user_table_model->get_row(array("nmuser" => $kode_tl))->nama . "</td>";
                                echo "<td>" . count($tl[$kode_tl]['underteam']) . "</td>";
                                echo "<td>" . number_format($tl[$kode_tl]['oc']) . "</td>";
                                echo "<td>" . number_format($contacted_tl) . "</td>";
                                echo "<td>" . number_format(($tl[$kode_tl][13] / $tl[$kode_tl]['oc']) * 100, 2) . "%</td>";
                                echo "<td>" . number_format($tl[$kode_tl][13]) . "</td>";
                                echo "<td>" . number_format(($tl[$kode_tl][13] / $contacted_tl) * 100, 2) . "%</td>";
                                echo "<td>" . number_format(($tl[$kode_tl][13] / count($tl[$kode_tl]['underteam'])) / $duration) . "</td>";
                                echo "<td>" . number_format(($tl[$kode_tl]['oc'] / count($tl[$kode_tl]['underteam'])) / $duration) . "/H</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
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
                <div class="col-12 col-md-8  col-lg-6   mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="card-title">Grafik Contacted & Verified</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="chartjs-account-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8  col-lg-6   mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="card-title">Kecepatan</h6>
                            </div>
                            <div class="card-body">
                                <div id="apex_analytic_kec_speedy"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8  col-lg-4   mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="card-title">Gender</h6>
                            </div>
                            <div class="card-body">
                                <div id="apex_analytic_jk"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8  col-lg-4   mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="card-title">Opsi Call</h6>
                            </div>
                            <div class="card-body">
                                <div id="apex_analytic_opsi"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8  col-lg-4   mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="card-title">Channel Payment</h6>
                            </div>
                            <div class="card-body">
                                <div id="apex_analytic_payment"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8  col-lg-6   mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="card-title">Regional</h6>
                            </div>
                            <div class="card-body">
                                <div id="apex_analytic_regional"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8  col-lg-6   mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="card-title">ARPU</h6>
                            </div>
                            <div class="card-body">
                                <div id="apex_analytic_arpu"></div>
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
        if ($("#apex_analytic_jk").length > 0) {
            options_jk = {
                grid: {
                    yaxis: {
                        lines: {
                            show: false
                        }
                    }
                },
                chart: {
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#1e3d73'],
                series: [{
                    data: [
                        <?php
                        foreach ($general_data['jk'] as $value) {
                            echo intval($value['num']) . ",";
                        }
                        ?>
                    ]
                }],
                xaxis: {
                    categories: [
                        <?php
                        foreach ($general_data['jk'] as $value) {
                            echo "'" . $value['jk'] . "',";
                        }
                        ?>
                    ]

                }
            }

            var chart_jk = new ApexCharts(
                document.querySelector("#apex_analytic_jk"),
                options_jk
            );
            chart_jk.render();
        }

        if ($("#apex_analytic_opsi").length > 0) {
            options_opsi = {
                grid: {
                    yaxis: {
                        lines: {
                            show: false
                        }
                    }
                },
                chart: {
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#1e3d73'],
                series: [{
                    data: [
                        <?php
                        foreach ($general_data['opsi_call'] as $value) {
                            echo intval($value['num']) . ",";
                        }
                        ?>
                    ]
                }],
                xaxis: {
                    categories: [
                        <?php
                        $opsi_call = array(1 => "Telepon Rumah", 2 => "Handphone", 3 => "Email", 4 => "Chat");
                        foreach ($general_data['opsi_call'] as $value) {
                            echo "'" . $opsi_call[$value['opsi_call']] . "',";
                        }
                        ?>
                    ]

                }
            }

            var chart_opsi = new ApexCharts(
                document.querySelector("#apex_analytic_opsi"),
                options_opsi
            );
            chart_opsi.render();
        }

        if ($("#apex_analytic_payment").length > 0) {
            options_payment = {
                grid: {
                    yaxis: {
                        lines: {
                            show: false
                        }
                    }
                },
                chart: {
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#1e3d73'],
                series: [{
                    data: [
                        <?php
                        foreach ($general_data['payment'] as $value) {
                            echo intval($value['num']) . ",";
                        }
                        ?>
                    ]
                }],
                xaxis: {
                    categories: [
                        <?php
                        foreach ($general_data['payment'] as $value) {
                            echo "'" . $value['payment'] . "',";
                        }
                        ?>
                    ]

                }
            }

            var chart_payment = new ApexCharts(
                document.querySelector("#apex_analytic_payment"),
                options_payment
            );
            chart_payment.render();
        }

        if ($("#apex_analytic_kec_speedy").length > 0) {
            options_kec_speedy = {
                grid: {
                    yaxis: {
                        lines: {
                            show: false
                        }
                    }
                },
                chart: {
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#1e3d73'],
                series: [{
                    data: [
                        <?php
                        foreach ($general_data['kec_speedy'] as $value) {
                            echo intval($value['num']) . ",";
                        }
                        ?>
                    ]
                }],
                xaxis: {
                    categories: [
                        <?php
                        foreach ($general_data['kec_speedy'] as $value) {
                            echo "'" . $value['kec_speedy'] . "',";
                        }
                        ?>
                    ]

                }
            }

            var chart_kec_speedy = new ApexCharts(
                document.querySelector("#apex_analytic_kec_speedy"),
                options_kec_speedy
            );
            chart_kec_speedy.render();
        }

        if ($("#apex_analytic_regional").length > 0) {
            options_regional = {
                grid: {
                    yaxis: {
                        lines: {
                            show: false
                        }
                    }
                },
                chart: {
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#1e3d73'],
                series: [{
                    data: [
                        <?php
                        foreach ($regional['regional'] as $value) {
                            echo intval($value['num']) . ",";
                        }
                        ?>
                    ]
                }],
                xaxis: {
                    categories: [
                        <?php
                        foreach ($regional['regional'] as $value) {
                            echo "'" . $value['regional'] . "',";
                        }
                        ?>
                    ]

                }
            }

            var chart_regional = new ApexCharts(
                document.querySelector("#apex_analytic_regional"),
                options_regional
            );
            chart_regional.render();
        }

        if ($("#apex_analytic_arpu").length > 0) {
            options_arpu = {
                grid: {
                    yaxis: {
                        lines: {
                            show: false
                        }
                    }
                },
                chart: {
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#1e3d73'],
                series: [{
                    data: [
                        <?php
                        foreach ($arpu as $key => $value) {
                            echo intval($value) . ",";
                        }
                        ?>
                    ]
                }],
                xaxis: {
                    categories: [
                        <?php
                        foreach ($arpu as $key => $value) {
                            echo "'".ucwords($key) . "',";
                        }
                        ?>
                    ]

                }
            }

            var chart_arpu = new ApexCharts(
                document.querySelector("#apex_analytic_arpu"),
                options_arpu
            );
            chart_arpu.render();
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