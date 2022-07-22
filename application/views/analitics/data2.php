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
    <title>Profiling - DASHBOARD DATA</title>
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
    <!-- <div class="se-pre-con">
        <div class="loader"></div>
    </div> -->
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
                            <h4 class="mb-0">ANALITICS DATA DISTRIBUTION</h4>
                            <p>Welcome to Dashboard </p>
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
                        <form method="POST" action="#">
                            <input type="hidden" name="start" id="start" value="<?php echo $start; ?>"><input type="hidden" name="end" id="end" value="<?php echo $end; ?>">
                        </form>
                        <br>
                    <?php
                    } else {
                    ?>
                        <form method="POST" action="<?php echo base_url() . "Analitics/Analitics/data_dis"; ?>">
                            From
                            <input type="date" name="start" id="start" value="<?php echo $start; ?>">
                            <input type="date" name="end" id="end" value="<?php echo $end; ?>">
                            <select name="agentid" id="agentid">
                                <?php
                                echo "<option value='0'>Semua Agent</option>";
                                if ($agent['num'] > 0) {
                                    foreach ($agent['results'] as $ag) {
                                        $selected = "";

                                        if ($agent_filter == $ag->agentid) {
                                            $selected = "selected";
                                        }
                                        echo "<option value='" . $ag->agentid . "' " . $selected . ">" . $ag->agentid . " : " . $ag->nama . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <button type="submit">Filter</button><br>
                        </form>
                        <br>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-3 mt-3">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($wo); ?></h2>
                                <h6 class="card-liner-subtitle">DATA DISTRIBUTION</h6>
                            </div>

                        </div>
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($sumber['oc']); ?></h2>
                                <h6 class="card-liner-subtitle">DATA CONSUME</h6>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format(count($rec['rec_hp'])); ?></h2>
                                <h6 class="card-liner-subtitle">VERIFIED</h6>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-12 col-sm-6 col-xl-6 mt-3">
                    <table id="sumber" class="table dataTable table-striped table-bordered">
                        <thead>
                            <tr>
                                <!-- <td>No</td> -->
                                <!-- <td nowrap>
                                    Team Leader
                                </td> -->
                                <td>Sumber</td>
                                <td nowrap style='text-align:center;'>Data Consume</td>

                                <td style='text-align:center;'>Contacted</td>
                                <td nowrap style='text-align:center;'>Not Contacted</td>
                                <td style='text-align:center;'>Verified</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 0;
                            if (count($sumber['sumber']) > 0) {
                                $contacted = array(1, 13, 3, 12, 11);
                                $uncontacted = array(15, 9, 8, 4, 7, 10, 14, 2);
                                foreach ($sumber['sumber'] as $sr => $datana) {
                                    if ($sr != "") {
                                        $n++;
                                        $contacted_tl = 0;
                                        foreach ($contacted as $key => $val) {
                                            $contacted_tl = $contacted_tl + $datana[$val];
                                        }
                                        $uncontacted_tl = 0;
                                        foreach ($uncontacted as $key => $val) {
                                            $uncontacted_tl = $uncontacted_tl + $datana[$val];
                                        }
                                        $total['oc'] = $datana['oc'] + $total['oc'];
                                        $total[13] = $datana[13] + $total[13];
                                        $total['ct'] = $contacted_tl + $total['ct'];
                                        $total['nt'] = $uncontacted_tl + $total['nt'];
                                        echo "<tr>";
                                        // echo "<td>" . $n . "</td>";
                                        // echo "<td nowrap>" . $controller->Sys_user_table_model->get_row(array("nmuser" =>  $controller->Sys_user_table_model->get_row(array("nmuser" => $kode_tl))->tl))->nama . "</td>";
                                        echo "<td nowrap>" . $sr . "</td>";
                                        echo "<td style='text-align:center;'>" . number_format($contacted_tl + $uncontacted_tl) . "</td>";

                                        echo "<td style='text-align:center;'>" . number_format($contacted_tl) . "</td>";
                                        echo "<td style='text-align:center;'>" . number_format($uncontacted_tl) . "</td>";
                                        echo "<td style='text-align:center;'>" . number_format($datana[13]) . "</td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <!-- <td>No</td> -->
                                <!-- <td nowrap>
                                    Team Leader
                                </td> -->
                                <td>Total</td>
                                <td style='text-align:center;'><?php echo number_format($total['ct'] + $total['nt']); ?></td>

                                <td style='text-align:center;'><?php echo number_format($total['ct']); ?></td>
                                <td style='text-align:center;'><?php echo number_format($total['nt']); ?></td>
                                <td style='text-align:center;'><?php echo number_format($total[13]); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-12 col-sm-6 col-xl-3 mt-3">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($num_rec); ?></h2>
                                <h6 class="card-liner-subtitle">RECORDING</h6>
                            </div>

                        </div>
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format(($sum_rec / 60)); ?></h2>
                                <h6 class="card-liner-subtitle">DURATION (Minutes)</h6>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center' style="color:red;">
                                <h2><?php echo number_format($rec['dup']); ?></h2>
                                <h6 class="card-liner-subtitle">FRAUD ALERT</h6>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12  mt-3">
                    <table id="byncli" class="table dataTable table-striped table-bordered">
                        <thead>
                            <tr>
                                <td style='text-align:center;'>NLI</td>
                                <td style='text-align:center;'>Length</td>
                                <td style='text-align:center;'>Call</td>
                                <td style='text-align:center;'>Contacted</td>
                                <td nowrap style='text-align:center;'>Not Contacted</td>
                                <td style='text-align:center;'>Verified</td>
                                <td style='text-align:center;'>CVR</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 0;
                            if (count($ncli['ncli']) > 0) {
                                $contacted = array(1, 13, 3, 12, 11);
                                $uncontacted = array(15, 9, 8, 4, 7, 10, 14, 2);
                                foreach ($ncli['ncli'] as $nclina => $datana) {
                                    $n++;
                                    if (count($ncli['ncli'][$nclina]) > 0) {
                                        foreach ($ncli['ncli'][$nclina] as $length => $d_length) {

                                            $contacted_tl = 0;
                                            foreach ($contacted as $key => $val) {
                                                $contacted_tl = $contacted_tl + $ncli['ncli'][$nclina][$length][$val];
                                            }
                                            $uncontacted_tl = 0;
                                            foreach ($uncontacted as $key => $val) {
                                                $uncontacted_tl = $uncontacted_tl + $ncli['ncli'][$nclina][$length][$val];
                                            }
                                            $cvr = ($ncli['ncli'][$nclina][$length][13] / $ncli['ncli'][$nclina][$length]['oc']) * 100;
                                            echo "<tr>";
                                            // echo "<td>" . $n . "</td>";
                                            // echo "<td nowrap>" . $controller->Sys_user_table_model->get_row(array("nmuser" =>  $controller->Sys_user_table_model->get_row(array("nmuser" => $kode_tl))->tl))->nama . "</td>";
                                            echo "<td nowrap style='text-align:center;'>" . $nclina . "</td>";
                                            echo "<td style='text-align:center;'>" . $length . "</td>";
                                            echo "<td style='text-align:center;'>" . number_format($ncli['ncli'][$nclina][$length]['oc']) . "</td>";
                                            echo "<td style='text-align:center;'>" . number_format($contacted_tl) . "</td>";
                                            echo "<td style='text-align:center;'>" . number_format($uncontacted_tl) . "</td>";
                                            echo "<td style='text-align:center;'>" . number_format($ncli['ncli'][$nclina][$length][13]) . "</td>";
                                            echo "<td style='text-align:center;'>" . number_format($cvr, 2) . "%</td>";
                                            echo "</tr>";
                                        }
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
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
                                <td style='text-align:center;'>Verified</td>
                                <td style='text-align:center;'>Recording</td>
                                <td nowrap style='text-align:center;'>Duration (Minutes)</td>
                                <td nowrap style='text-align:center;'>Multi No.Internet</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 0;
                            if ($agent['num'] > 0) {
                                foreach ($agent['results'] as $datana) {
                                    $n++;

                                    echo "<tr>";
                                    // echo "<td>" . $n . "</td>";
                                    // echo "<td nowrap>" . $controller->Sys_user_table_model->get_row(array("nmuser" =>  $controller->Sys_user_table_model->get_row(array("nmuser" => $kode_tl))->tl))->nama . "</td>";
                                    echo "<td nowrap>" . $datana->nama . "</td>";
                                    echo "<td>" . $datana->agentid . "</td>";
                                    echo "<td style='text-align:center;'>" . number_format(count($rec[$datana->agentid]['detail'])) . "</td>";
                                    echo "<td style='text-align:center;'>" . number_format($rec[$datana->agentid]['count']) . "</td>";
                                    echo "<td style='text-align:center;'>" . number_format(($rec[$datana->agentid]['sum'] / 60)) . "</td>";
                                    echo "<td style='text-align:center;'>" . number_format($rec[$datana->agentid]['dup']) . "</td>";
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
                    <table id="byhandphone" class="table dataTable table-striped table-bordered">
                        <thead>
                            <tr>
                                <!-- <td>No</td> -->
                                <!-- <td nowrap>
                                    Team Leader
                                </td> -->
                                <td>No.Handphone</td>
                                <td>AgentID</td>
                                <td style='text-align:center;'>Dial</td>
                                <td nowrap style='text-align:center;'>Duration (Minutes)</td>
                                <td nowrap style='text-align:center;'>Multi No.Internet</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 0;
                            if (count($rec['rec_hp']) > 0) {
                                foreach ($rec['rec_hp'] as $hp => $datana) {
                                    $n++;

                                    echo "<tr>";
                                    // echo "<td>" . $n . "</td>";
                                    // echo "<td nowrap>" . $controller->Sys_user_table_model->get_row(array("nmuser" =>  $controller->Sys_user_table_model->get_row(array("nmuser" => $kode_tl))->tl))->nama . "</td>";
                                    echo "<td nowrap>" . $hp . "</td>";
                                    echo "<td>" . $datana['agentid'] . "</td>";
                                    echo "<td style='text-align:center;'>" . number_format($datana['çount']) . "</td>";
                                    echo "<td style='text-align:center;'>" . number_format(($datana['sum'] / 60)) . "</td>";
                                    echo "<td style='text-align:center;'>" . number_format($datana['dup']) . "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
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
        $('#byhandphone').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "order": [[ 2, "desc" ]],
            responsive: true
        });
        $('#byagent').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "order": [[ 2, "desc" ]],
            responsive: true
        });
        $('#byncli').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "order": [[ 5, "desc" ]],
            responsive: true
        });
        // $('#sumber').DataTable({
        //     responsive: true
        // });
    </script>

</body>
<!-- END: Body-->

</html>