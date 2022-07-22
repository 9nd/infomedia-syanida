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
    <title>Syanida-Blast - DASHBOARD</title>
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

    <!-- START: Header-->
    <div id="header-fix" class="header fixed-top">
        <div class="site-width">
            <nav class="navbar navbar-expand-lg  p-0">
                <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">
                    <a href="index.html" class="horizontal-logo text-left">
                        <span class="h6 font-weight-bold align-self-center mb-0 ml-auto"><?php echo  date("h:i A", strtotime($last_update)); ?></span>
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
                    <div class="sub-header py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0">Dashboard Scoring Customer Profile</h4>
                            <p>Welcome to Dashboard</p>
                        </div>

                        <div class="col-12 col-md-6 col-lg-5" style="text-align:right;">
                            <img style="width:200px;" src="<?php echo base_url("api/Public_Access/get_logo_template") ?>" class="header-brand-img h-<?php echo $this->_appinfo['template_logo_size'] ?>" alt="Infomedia logo">
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->
            <div class="row">
                <div class="col-12 col-sm-3">
                    <div class="col-12 col-sm-12  mt-3">
                        <div class="card">
                            <div class="card-body text-info border-bottom border-info border-w-5">
                                <h2 class="text-center"><?php echo number_format($trafic); ?></h2>
                                <h6 class="text-center">Traffic</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12  mt-3">
                        <div class="card">
                            <div class="card-body text-success border-bottom border-success border-w-5">
                                <h2 class="text-center"><?php echo number_format($uniq); ?></h2>
                                <h6 class="text-center">Uniq Customer</h6>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-12 col-sm-12  mt-3">
                        <div class="card">
                            <div class="card-body text-success border-bottom border-success border-w-5">
                                <h2 class="text-center">4</h2>
                                <h6 class="text-center">Channel</h6>
                            </div>
                        </div>
                    </div> -->

                </div>
                <div class="col-12 col-sm-9   mt-3">
                    <div id="apex_heatmap_chart" class="height-250"></div>
                </div>
                <div class="col-12 col-lg-12">
                    <table id="byagent" class="table dataTable table-striped table-bordered">
                        <thead>
                            <tr>
                                <td colspan='8'>
                                    <h6>Score Pelanggan</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>No.</td>
                                <td>NCLI</td>
                                <td>No.Internet</td>
                                <td>No.Handphone</td>
                                <td>Email</td>
                                <td>Last Interaction</td>
                                <td>Date Interaction</td>
                                <td>Score</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 0;
                            if (count($raw) > 0) {
                                foreach ($raw as $r) {
                                    $n++;
                                    $profiling = ((12 - $r->durasi)) > 0  ? (12-$r->durasi) : 0;
                                    $moss = 0;
                                    $tam = 0;
                                    $pranpc = 0;
                                    $total = $profiling + $tam + $pranpc + $moss;

                            ?>
                                    <tr>

                                        <td nowrap><?php echo $n; ?></td>
                                        <td nowrap><?php echo $r->ncli; ?></td>
                                        <td nowrap><?php echo $r->no_internet; ?></td>
                                        <td nowrap><?php echo $r->no_handphone; ?></td>
                                        <td nowrap><?php echo $r->email; ?></td>
                                        <td nowrap><?php echo $r->kategori; ?></td>
                                        <td nowrap><?php echo $r->lup; ?></td>
                                        <td nowrap><?php echo $total; ?></td>
                                    </tr>
                            <?php
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
        $('#byagent').DataTable({

            responsive: true
        });

        $(document).ready(function() {
            <?php

            $sumberna = array('Profiling' => 'Profiling', 'MOSS' => 'MOSS', 'tam' => 'TAM');
            foreach ($sumberna as $ksr => $vsr) {

            ?>

                function generateHeatmapData_<?php echo $ksr; ?>(yrange) {
                    var series = [];
                    <?php
                    $param = array(0 => 'Score 0', 1 => 'Score 1', 2 => 'Score 2', 3 => 'Score 3', 4 => 'Score 4', 5 => 'Score 5', 6 => 'Score 6', 7 => 'Score 7', 8 => 'Score 8', 9 => 'Score 9', 10 => 'Score 10', 11 => 'Score 11', 12 => 'Score 12');

                    foreach ($param as $kra => $vra) {
                        $valuena = (12 - $kra) > 0 ? (12 - $kra) : 0;
                        $numval = $heat[$ksr]['dr_' . $valuena];
                       
                        if ($numval < 1) {
                            $numval = 0;
                        }
                    ?>

                        var x = '<?php echo $vra; ?>';
                        var y = parseInt(<?php echo $numval; ?>);
                        series.push({
                            x: x,
                            y: y
                        });
                    <?php
                    }
                    ?>
                    return series;
                }
            <?php
            }
            ?>
            /*  END GRAF OTHER */
            var options = {
                chart: {
                    height: 250,
                    type: 'heatmap',
                },
                dataLabels: {
                    enabled: true
                },
                colors: ["#008FFB"],
                series: [
                    <?php
                    foreach ($sumberna as $ksr => $vsr) {
                        $numval = 0;

                    ?> {
                            name: '<?php echo $vsr; ?>',
                            data: generateHeatmapData_<?php echo $ksr; ?>({
                                min: 0,
                                max: 1
                            })
                        },
                    <?php
                    }
                    ?>


                ],
                title: {
                    text: ''
                },

            }

            var chart = new ApexCharts(
                document.querySelector("#apex_heatmap_chart"),
                options
            );

            chart.render();

        });
    </script>
</body>
<!-- END: Body-->

</html>