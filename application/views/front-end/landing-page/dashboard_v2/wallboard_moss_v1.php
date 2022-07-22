<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
    <meta http-equiv="refresh" content="300">
    <meta charset="UTF-8">
    <title>Profiling - WALLBOARD</title>
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
    <!-- END: Page CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/weather-icons/css/pe-icon-set-weather.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/starrr/starrr.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- END: Page CSS-->
    <!-- jQuery Knob Chart -->

    <script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>

    <script src="<?php echo base_url() ?>assets/js/bundle.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/jquery-knob/jquery.knob.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/js/style-highcharts.js"></script>
    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/css/main.css">
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->
<?php
$thn = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$data_lm = array(100, 80, 70, 80, 100, 80, 70, 80, 100, 80, 70, 80);
$data_lk = array(90, 100, 80, 60, 100, 80, 70, 80, 100, 80, 70, 80);
$data_ld = array(110, 78, 67, 90, 100, 80, 70, 80, 100, 80, 70, 80);
$data_sp2hp = array(87, 65, 98, 65, 100, 80, 70, 80, 100, 80, 70, 80);
$lap = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15');

?>
<script type="text/javascript">
    var chart;
    var slg_chart;
    var slfc_chart;
</script>

<body id="main-container" class="default dark horizontal-menu">

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
                        <span class="h6 font-weight-bold align-self-center mb-0 ml-auto">MOSS</span>
                    </a>
                </div>
                <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                    <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
                </div>
                <form class="float-left d-none d-lg-block search-form">
                    <div class="form-group mb-0 position-relative">
                        Sy-ANIDA WALLBOARD PROFILING
                    </div>
                </form>
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

            <form method="GET" action="#">
                TAHUN
                <select name="tahun" id="tahun">
                    <?php
                    $lb = 0;
                    $tahun = $_GET["tahun"];
                    for ($lb = 2020; $lb <= 2030; $lb++) {
                        // $n_lb = sprintf("%02y", $lb);
                        $selected = "";
                        if ($lb == $tahun) {
                            $selected = "selected";
                        }
                        echo "<option value='" . $lb . "' " . $selected . ">" . $lb . "</option>";
                    }
                    ?>
                </select>
                MONTH
                <select name="bulan" id="bulan">
                    <?php
                    $lb = 1;
                    for ($lb = 1; $lb <= 12; $lb++) {
                        $n_lb = sprintf("%02d", $lb);
                        $selected = "";
                        if ($n_lb == $bulan) {
                            $selected = "selected";
                        }
                        echo "<option value='" . $n_lb . "' " . $selected . ">" . $thn[$lb] . "</option>";
                    }
                    ?>
                </select>
                <button type="submit" id="filter"><i class="fa fa-search"></i></button><br>
            </form>

            <!-- START: Card Data-->
            <div class="row">

                <div class="col-12 col-lg-3  mt-3">
                    <div class="card overflow-hidden">
                        <div class="card-content">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-12 col-lg-12 d-block d-md-flex d-lg-block">
                                        <div class="card rounded-0 col-12 col-md-4 col-lg-12" style='background-color:red;'>
                                            <div class="card-body">
                                                <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                    <i class="fas fa-address-card   card-liner-icon mt-2 text-white"></i>
                                                    <div class='card-liner-content'>
                                                        <h2 class="card-liner-title text-white" id="waiting">0</h2>
                                                        <h6 class="card-liner-subtitle text-white">DATA WAITING
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card rounded-0 col-12 col-md-4 col-lg-12" style='background-color:green;'>
                                            <div class="card-body">
                                                <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                    <i class="fab fa-teamspeak  card-liner-icon mt-2 text-white"></i>
                                                    <div class='card-liner-content'>
                                                        <h2 class="card-liner-title text-white"><?php
                                                                                                if (!isset($_GET['bulan'])) {
                                                                                                    $_GET['bulan'] = "10";
                                                                                                }
                                                                                                $controller = $this->db->query("SELECT * FROM monthly_report_monthly_moss WHERE tahun='" . $_GET['tahun'] . "' AND bulan='" . $_GET['bulan'] . "'")->row();
                                                                                                echo number_format($controller->co);
                                                                                                ?></h2>
                                                        <h6 class="card-liner-subtitle text-white">DATA CONSUME</h6>
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
                <div class="col-12 col-lg-3  mt-3">
                    <div class="card overflow-hidden">
                        <div class="card-content">
                            <div class="card-body p-0">
                                <div class="row">


                                    <div class="col-12 col-md-12  col-lg-12">
                                        <div class="p-2">

                                            <div class="d-flex mt-0">
                                                <div class="border-0 outline-badge-success w-100 p-2 rounded text-center">
                                                    <span class="h2 mb-0"><?php echo number_format($controller->verified); ?></span><br>
                                                    VERIFIED
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <div class="border-0 outline-badge-info  w-50 p-3 rounded text-center">
                                                    <span class="h6 mb-0" id="hp_email_rate"><?php echo number_format($controller->hp_email / $controller->verified * 100); ?> %</span><br>
                                                    <span class="h6 mb-0" id="hp_email"><?php echo number_format($controller->hp_email); ?></span>
                                                    <br>HP+EMAIL
                                                </div>
                                                <div class="border-0 outline-badge-warning w-50 p-3 rounded ml-2 text-center">
                                                    <span class="h6 mb-0" id="hp_only_rate"><?php echo number_format($controller->hp_only / $controller->verified * 100); ?> %</span><br>
                                                    <span class="h6 mb-0" id="hp_only"><?php echo number_format($controller->hp_only); ?></span>
                                                    <br>HP ONLY
                                                </div>
                                            </div>
                                            <div class="d-flex  mt-4">
                                                <div class="media-body align-self-center ">
                                                    <span class="mb-0 h6 font-w-600">CONVERTION RATE</span><br>
                                                </div>
                                                <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0">
                                                        <?php $cr = ($controller->verified / $controller->contacted) * 100;
                                                        echo $cr . "%";
                                                        ?>
                                                    </span></div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-8  col-lg-6  mt-3">
                    <div class="card overflow-hidden">
                        <div class="card-content">
                            <div class="card-body p-0">
                                <table class="table font-w-600 mb-0">
                                    <tbody>
                                        <tr class="zoom">
                                            <td colspan='6'>Verified Per-Channel</td>
                                        </tr>
                                        <tr class="zoom">
                                            <td>Landing Page</td>
                                            <td id="layanan_landingpage" class="text-primary">-</td>
                                            <td>Blanja.com</td>
                                            <td id="layanan_blanjacom" class="text-primary">-</td>
                                            <td>MOSS</td>
                                            <td class="text-primary"><?php echo number_format($controller->verified); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class='row'>


                        <div class="col-12 col-sm-6 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                        <i class="icon-wallet icons card-liner-icon mt-2"></i>
                                        <div class='card-liner-content'>
                                            <h2 class="card-liner-title"><?php echo number_format($arpu); ?></h2>
                                            <h6 class="card-liner-subtitle">ARPU</h6>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                        <h2><?php echo $jumlah_aktivasi; ?></h2>
                                        <div class='card-liner-content'>
                                            <h2 class="card-liner-title"><?php echo number_format($revenue); ?></h2>
                                            <h6 class="card-liner-subtitle">Revenue Aktivasi</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card overflow-hidden  mt-3">
                        <div class="card-content">
                            <div class="card-body p-0">
                                <ul class="list-group list-unstyled">
                                    <li class="p-2 border-bottom zoom">
                                        <div class="media d-flex w-100">
                                            <div class="media-body align-self-center pl-2">
                                                <h6 class="mb-0 ">CONTACTED</h6>
                                                <p class="mb-0 font-w-500 tx-s-12">Contacted Rate</p>
                                            </div>
                                            <div class="ml-auto my-auto font-weight-bold text-right text-success">
                                                <p class="mb-0 font-w-500 tx-s-12"><?php echo number_format($controller->contacted) ?></p>
                                                <p class="mb-0 font-w-500 tx-s-12"><?php $crate = ($controller->contacted / $controller->co) * 100;
                                                                                    echo round($crate, 2) . "%";
                                                                                    ?></p>

                                            </div>

                                        </div>
                                    </li>
                                    <li class="p-2 border-bottom zoom">
                                        <div class="media d-flex w-100">
                                            <div class="media-body align-self-center pl-2">
                                                <h6 class="mb-0 ">NOT CONTACTED</h6>
                                                <p class="mb-0 font-w-500 tx-s-12">Not Contacted Rate</p>
                                            </div>
                                            <div class="ml-auto my-auto font-weight-bold text-right text-danger">
                                                <p class="mb-0 font-w-500 tx-s-12"><?php echo number_format($controller->not_contacted) ?></p>
                                                <p class="mb-0 font-w-500 tx-s-12"><?php $ncrate = ($controller->not_contacted / $controller->co) * 100;
                                                                                    echo round($ncrate, 2) . "%";
                                                                                    ?></p>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card border-bottom-0  mt-3">
                            <div class="card-content border-bottom border-primary border-w-5">
                                <div class="card-body p-2">
                                    <div class="d-flex">
                                        <img src="<?php echo base_url() . "YbsService/get_foto_agent/" . $picture_leader_on_duty ?>" alt="author" class="rounded-circle  ml-auto" width="65px" height="65px">
                                        <div class="media-body align-self-center pl-3">
                                            <span class="mb-0 font-w-600"><?php echo $nama_leader_on_duty ?></span><br>
                                            <p class="mb-0 font-w-500 tx-s-12">DESK CONTROL</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card border-bottom-0  mt-3">
                            <div class="card-content border-bottom border-primary border-w-5">
                                <div class="card-body p-2">
                                    <div class="d-flex">
                                        <?php
                                        $getagent = $this->db->query("SELECT nama, picture FROM sys_user WHERE agentid='$controller->best_agent'")->row();
                                        ?>
                                        <img src="<?php echo base_url() . "YbsService/get_foto_agent/" . $getagent->picture ?>" id="agent_1_foto" alt="author" class="rounded-circle  ml-auto" width="65px" height="65px">
                                        <div class="media-body align-self-center pl-3">
                                            <span class="mb-0 font-w-600" id="agent_1_nama"><?php

                                                                                            echo $getagent->nama;
                                                                                            ?>
                                            </span><br>
                                            <p class="mb-0 font-w-500 tx-s-12">BEST SLG</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="row">
                        <div class="col-4  mt-3">
                            <div class="card bg-primary text-white h-10">
                                <div class="card-body text-center p-1 d-flex">
                                    <div class="align-self-top text-center w-100">
                                        <h6 class="card-title mt-2">AGENT ONLINE</h6>
                                        <span class="h4"><?php echo $controller->agent_online ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex mt-3">
                                    <div class="border-0 outline-badge-danger w-50 p-1 rounded text-center">
                                        <span class="mb-0"><?php echo $cache_monev_realtime['aux_num']; ?></span><br>
                                        Lunch
                                    </div>
                                    <div class="border-0 outline-badge-danger w-50 p-1 rounded ml-2 text-center">
                                        <span class="mb-0"><?php echo $cache_monev_realtime['idle_num']; ?></span><br>
                                        Idle
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex mt-3">
                                    <div class="border-0 outline-badge-danger w-50 p-1 rounded text-center">
                                        <span class="mb-0"><?php echo $cache_monev_realtime['toilet']; ?></span><br>
                                        Toilet
                                    </div>
                                    <div class="border-0 outline-badge-danger w-50 p-1 rounded ml-2 text-center">
                                        <span class="mb-0"><?php echo $cache_monev_realtime['pray']; ?></span><br>
                                        Pray
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-4">
                            <div style="color:#ffffff;font-size:25px;text-align:center;position:absolute;margin-left:120px;">SLG</div>

                            <div id="slg_chart" style="min-width: 250px; width: 100%;margin-top:10px;color:#a0bc2e;"></div>
                            <div style="color:#ff8e35;font-size:40px;text-align:center;margin-top:-50px;position:absolute;margin-left:120px;" id='slg'></div>
                        </div>
                        <div class="col-4">
                            <div style="color:#ffffff;font-size:25px;text-align:center;position:absolute;margin-left:120px;">SLFC</div>

                            <div id="slfc_chart" style="min-width: 250px; width: 100%;margin-top:10px;color:#a0bc2e;"></div>
                            <div style="color:#ff8e35;font-size:40px;text-align:center;margin-top:-50px;position:absolute;margin-left:120px;" id='slfc'></div>

                        </div>
                    </div>
                    <div class="col-12 col-md-8  col-lg-12">
                        <canvas id="chartjs-account-chart" height="70px"></canvas>
                    </div>
                </div>

            </div>

        </div>



        </div>


        </div>





        </div>
        <!-- END: Card DATA-->
        </div>
    </main>
    <!-- END: Content-->
    <!-- START: Footer-->
    <footer class="site-footer">
        2020 Â© Sy-ANIDA
    </footer>
    <!-- END: Footer-->



    <!-- START: Back to top-->
    <a href="#" class="scrollup text-center">
        <i class="icon-arrow-up"></i>
    </a>
    <!-- END: Back to top-->


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
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/starrr/starrr.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.canvaswrapper.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.colorhelpers.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.saturated.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.browser.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.drawSeries.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.uiConstants.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.legend.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- START: Page JS-->
    <!-- <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/home.script.js"></script> -->
    <!-- END: Page JS-->

    <!---- CUSTOM JS ---->
    <input type="hidden" id="agent_online_reg" value="0">
    <input type="hidden" id="agent_online_moss" value="0">
    <input type="hidden" id="daily_status" value="0">
    <input type="hidden" id="mos_status" value="0">
    <input type="hidden" id="reguler_status" value="0">
    <input type="hidden" id="grafik_status" value="0">
    <input type="hidden" id="best_agent_status" value="0">
    <script type="text/javascript">
        var bodycolor = getComputedStyle(document.body).getPropertyValue('--bodycolor');
        var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');
        var bordercolor = getComputedStyle(document.body).getPropertyValue('--bordercolor');

        function get_performance() {
            var start = $("#start").val();
            var end = $("#end").val();
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard_v2/get_daily_performance_moss" ?>",
                data: {
                    start: start,
                    end: end
                },
                methode: "get",
                async: true,
                dataType: 'JSON',
                success: function(response) {

                    $.each(response.agent, function(key, val) {
                        $("#agent_" + key + "_nama").text(val.nama);
                        $("#agent_" + key + "_num").text("SLG " + val.num);
                        document.getElementById("agent_" + key + "_foto").style.backgroundImage = "url('<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + val.picture + "')";
                    });

                },
                error: function() {
                    alert('There was an error processing your information!');
                }
            });
        }


        function get_profiling_mos() {
            var start = $("#start").val();
            var end = $("#end").val();
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard_v2/get_profiling_mos" ?>",
                data: {
                    start: start,
                    end: end
                },
                methode: "get",
                dataType: 'JSON',
                success: function(response) {

                    agent_online = parseInt($("#agent_online_reg").val()) + parseInt(response.agent_online);
                    $("#agent_online").text(agent_online);
                    $("#agent_online_moss").val(response.agent_online);
                    $("#connected_mos").text(response.contacted);
                    $("#connected_rate").text(response.contacted_rate + "%");
                    $("#notconnected_rate").text(response.uncontacted_rate + "%");
                    $("#verified_mos").text(response.status_13);
                    $("#notconnected_mos").text(response.uncontacted);
                    $("#convention_rate").text(response.convention_rate + "%");
                    $("#1_mos").text(response.status_1);
                    $("#2_mos").text(response.status_2);
                    $("#3_mos").text(response.status_3);
                    $("#4_mos").text(response.status_4);
                    $("#5_mos").text(response.status_5);
                    $("#6_mos").text(response.status_6);
                    $("#7_mos").text(response.status_7);
                    $("#8_mos").text(response.status_8);
                    $("#9_mos").text(response.status_9);
                    $("#10_mos").text(response.status_10);
                    $("#11_mos").text(response.status_11);
                    $("#12_mos").text(response.status_12);
                    $("#13_mos").text(response.status_13);
                    $("#14_mos").text(response.status_14);
                    $("#15_mos").text(response.status_15);
                    $("#16_mos").text(response.status_16);
                    $("#contacted_verified").text(response.status_13);
                    $("#contacted_followup").text(response.status_12);
                    $("#contacted_decline").text(response.status_11);
                    $("#notcontacted").text(response.uncontacted);
                    $("#notcontacted_1").text(response.not.urut_0.valna);
                    $("#notcontacted_2").text(response.not.urut_1.valna);
                    $("#notcontacted_3").text(response.not.urut_2.valna);
                    $("#notcontacted_4").text(response.not.other);
                    $("#notcontacted_1_text").text(response.not.urut_0.textna);
                    $("#notcontacted_2_text").text(response.not.urut_1.textna);
                    $("#notcontacted_3_text").text(response.not.urut_2.textna);
                    $("#layanan_landingpage").text(response.layanan_moss.landingpage);
                    $("#layanan_blanjacom").text(response.layanan_moss.blanjacom);
                    $("#layanan_moss").text(response.layanan_moss.moss);
                    <?php
                    // if ($layanan_moss['num'] > 0) {
                    //     foreach ($layanan_moss['results'] as $lm) {

                    //         echo "$('#layanan_" . $lm->name . "').text(response.layanan_moss.layanan_" . $lm->id . ");";
                    //     }
                    // }
                    ?>

                },
                error: function() {
                    alert('There was an error processing your information!');
                }
            });
        }


        /*
         * Custom Label formatter
         * ----------------------
         */
        function labelFormatter(label, series) {
            return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">' +
                label +
                '<br>' +
                Math.round(series.percent) + '%</div>'
        }

        function get_slg_mos() {
            var start = $("#start").val();
            var end = $("#end").val();
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard_v2/get_slg_mos" ?>",
                data: {
                    start: start,
                    end: end
                },
                methode: "get",
                dataType: 'JSON',
                success: function(response) {
                    $("#slg").text(<?php echo $controller->slg ?>);
                    $("#slfc").text(<?php echo $controller->slfc ?>);
                    // Element inside which you want to see the chart
                    $("#slg_chart").html("");
                    let element = document.querySelector('#slg_chart');

                    // Properties of the gauge

                    //var slg_num = response.slg;
		    var slg_num = <?php echo $controller->slg ?>;
                    var slg_label = <?php echo $controller->slg ?>;
                    var slg_length = "lightgray";
                    switch (true) {
                        case (parseInt(slg_num) > 9):
                            var bar_color = "#ce2f4f";
                            var slg_length = "#ce2f4f";
                            var slg_num = 9.9;
                            break;
                        case (parseInt(slg_num) > 4):
                            var bar_color = "#ce2f4f";
                            break;
                        default:
                            var bar_color = "#a0bc2e";
                            break;

                    }
                    let gaugeOptions = {
                        hasNeedle: true,
                        needleColor: bar_color,
                        needleUpdateSpeed: 1000,
                        arcColors: [bar_color, slg_length],
                        arcDelimiters: [slg_num * 10],
                        rangeLabel: ['0', '10'],
                        centralLabel: "",
                    };
                    GaugeChart
                        .gaugeChart(element, 300, gaugeOptions)
                        .updateNeedle(slg_num * 10);

                    // Element inside which you want to see the chart
                    $("#slfc_chart").html("");
                    let element2 = document.querySelector('#slfc_chart');

                    // // Properties of the gauge

                    var slfc_num = <?php echo $controller->slfc ?>;
                    var slfc_label = <?php echo $controller->slfc ?>;
                    var slfc_length = "lightgray";
                    switch (true) {
                        case (parseInt(slfc_num) > 9):
                            var slfc_num = 9.9;
                            var bar_color = "#ce2f4f";
                            var slfc_length = "#ce2f4f";
                            break;
                        case (parseInt(slfc_num) > 4):
                            var bar_color = "#ce2f4f";
                            break;
                        default:
                            var bar_color = "#a0bc2e";
                            break;

                    }
                    let gaugeOptions2 = {
                        hasNeedle: true,
                        needleColor: bar_color,
                        needleUpdateSpeed: 1000,
                        arcColors: [bar_color, slfc_length],
                        arcDelimiters: [slfc_num * 10],
                        rangeLabel: ['0', '10'],
                        centralLabel: "",
                    };
                    GaugeChart
                        .gaugeChart(element2, 300, gaugeOptions2)
                        .updateNeedle(slfc_num * 10);
                },
                error: function() {
                    alert('There was an error processing your information!');
                }
            });
        }





        $(document).ready(function() {


            get_slg_mos();

            var chartjs_multiaxis_bar = document.getElementById("chartjs-account-chart");
            if (chartjs_multiaxis_bar) {
                var barmultiaxisChartData = {
                    labels: ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'],
                    datasets: [

                        {
                            label: 'Waiting',
                            type: 'line',
                            // backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                            borderColor: primarycolor,
                            fill: false,
                            borderWidth: 2,
                            data: ['<?php echo $controller->w0 ?>', '<?php echo $controller->w1 ?>', '<?php echo $controller->w2 ?>', '<?php echo $controller->w3 ?>', '<?php echo $controller->w4 ?>', '<?php echo $controller->w5 ?>', '<?php echo $controller->w6 ?>', '<?php echo $controller->w7 ?>', '<?php echo $controller->w8 ?>', '<?php echo $controller->w9 ?>', '<?php echo $controller->w10 ?>', '<?php echo $controller->w11 ?>', '<?php echo $controller->w12 ?>', '<?php echo $controller->w13 ?>', '<?php echo $controller->w14 ?>', '<?php echo $controller->w15 ?>', '<?php echo $controller->w16 ?>', '<?php echo $controller->w17 ?>', '<?php echo $controller->w18 ?>', '<?php echo $controller->w19 ?>', '<?php echo $controller->w20 ?>', '<?php echo $controller->w21 ?>', '<?php echo $controller->w22 ?>', '<?php echo $controller->w23 ?>']
                        }, {
                            label: 'Verified',
                            type: 'line',
                            // backgroundColor: 'green',
                            borderColor: 'green',
                            fill: false,
                            borderWidth: 2,
                            data: ['<?php echo $controller->v0 ?>', '<?php echo $controller->v1 ?>', '<?php echo $controller->v2 ?>', '<?php echo $controller->v3 ?>', '<?php echo $controller->v4 ?>', '<?php echo $controller->v5 ?>', '<?php echo $controller->v6 ?>', '<?php echo $controller->v7 ?>', '<?php echo $controller->v8 ?>', '<?php echo $controller->v9 ?>', '<?php echo $controller->v10 ?>', '<?php echo $controller->v11 ?>', '<?php echo $controller->v12 ?>', '<?php echo $controller->v13 ?>', '<?php echo $controller->v14 ?>', '<?php echo $controller->v15 ?>', '<?php echo $controller->v16 ?>', '<?php echo $controller->v17 ?>', '<?php echo $controller->v18 ?>', '<?php echo $controller->v19 ?>', '<?php echo $controller->v20 ?>', '<?php echo $controller->v21 ?>', '<?php echo $controller->v22 ?>', '<?php echo $controller->v23 ?>']
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
                        }
                    }
                });
            }


            if ($("#apex_primary_chart").length > 0) {
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
                            color: '#000',
                            opacity: 0.7,
                        }
                    },
                    series: [{
                        name: "ARPU",
                        data: [
                            <?php
                            if (count($arpu) > 0) {
                                foreach ($arpu as $k => $v) {
                                    echo intval($v) . ",";
                                }
                            }
                            ?>
                        ]
                    }],
                    dataLabels: {
                        enabled: false
                    },
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
                    colors: ['#1e3d73'],
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
                    document.querySelector("#apex_primary_chart"),
                    options
                );
                chart.render();
            }


            if ($("#apex_main_chart").length > 0) {
                options = {
                    theme: {
                        mode: theme
                    },
                    chart: {
                        height: 380,
                        type: 'area',
                        stacked: false,
                        toolbar: {
                            show: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: [1, 1, 1],
                        curve: 'smooth'
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '50%'
                        }
                    },
                    colors: ['#1e3d73', '#17a2b8'],
                    series: [{
                        name: 'Orders',
                        type: 'area',
                        data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
                    }, {
                        name: 'Sale',
                        type: 'area',
                        data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
                    }],
                    fill: {
                        opacity: [0.85, 0.25, 1],
                        gradient: {
                            inverseColors: false,
                            shade: 'light',
                            type: "vertical",
                            opacityFrom: 0.85,
                            opacityTo: 0.55,
                            stops: [0, 100, 100, 100]
                        }
                    },
                    labels: ['01/01/2003', '02/01/2003', '03/01/2003', '04/01/2003', '05/01/2003', '06/01/2003', '07/01/2003', '08/01/2003', '09/01/2003', '10/01/2003', '11/01/2003'],
                    markers: {
                        size: 0
                    },
                    xaxis: {
                        type: 'datetime'
                    },
                    yaxis: {
                        min: 0
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        y: {
                            formatter: function(y) {
                                if (typeof y !== "undefined") {
                                    return y.toFixed(0) + " views";
                                }
                                return y;
                            }
                        }
                    },
                    legend: {
                        show: false,
                        labels: {
                            useSeriesColors: true
                        }
                    }
                }

                var chart = new ApexCharts(
                    document.querySelector("#apex_main_chart"),
                    options
                );
                chart.render();
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
                            if (count($revenue) > 0) {
                                foreach ($revenue as $k => $v) {
                                    echo intval($v) . ",";
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
        });
    </script>
</body>
<!-- END: Body-->

</html>