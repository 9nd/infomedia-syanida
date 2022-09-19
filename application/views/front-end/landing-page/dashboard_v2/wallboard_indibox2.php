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
$thn = array("januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
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
                        <span class="h6 font-weight-bold align-self-center mb-0 ml-auto"><?php echo  date("h:i A", strtotime($last_update->lup)); ?></span>
                    </a>
                </div>
                <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                    <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
                </div>
                <form class="float-left d-none d-lg-block search-form">
                    <div class="form-group mb-0 position-relative">
                        Sy-ANIDA WALLBOARD INDIBOX
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
                                                        <h2 class="card-liner-title text-white" id="waiting">-</h2>
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
                                                        <h2 class="card-liner-title text-white" id="callorder_moss">-</h2>
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
                                                <div class="border-0 outline-badge-success w-100 p-3 rounded text-center">
                                                    <span class="h1 mb-0" id='verified_mos'>-</span><br>
                                                    VERIFIED
                                                </div>
                                            </div>
                                            <div class="d-flex  mt-4">
                                                <div class="media-body align-self-center ">
                                                    <span class="mb-0 h6 font-w-600">CONVERTION RATE</span><br>
                                                </div>
                                                <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0" id='convention_rate'>-</span></div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-8  col-lg-6  mt-3">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body text-danger border-bottom border-danger border-w-5">
                                    <h5 class="text-center">-</h5>
                                    <h6 class="text-center">DATA ENTRY</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body text-warning border-bottom border-warning border-w-5">
                                    <h5 class="text-center">-</h5>
                                    <h6 class="text-center">REOPEN</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body text-success border-bottom border-success border-w-5">
                                    <h5 class="text-center">-</h5>
                                    <h6 class="text-center">DATA PS</h6>
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
                                                <p class="mb-0 font-w-500 tx-s-12">Verified</p>
                                                <p class="mb-0 font-w-500 tx-s-12">Decline</p>
                                                <p class="mb-0 font-w-500 tx-s-12">Follow Up</p>
                                            </div>
                                            <div class="ml-auto my-auto font-weight-bold text-right text-success">
                                                <p class="mb-0 font-w-500 tx-s-12" id="connected_mos">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="contacted_verified">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="contacted_decline">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="contacted_followup">-</p>
                                            </div>

                                        </div>
                                    </li>
                                    <li class="p-2 border-bottom zoom">
                                        <div class="media d-flex w-100">
                                            <div class="media-body align-self-center pl-2">
                                                <h6 class="mb-0 ">NOT CONTACTED</h6>
                                                <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_1_text">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_2_text">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_3_text">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12">Others</p>
                                            </div>
                                            <div class="ml-auto my-auto font-weight-bold text-right text-danger">
                                                <p class="mb-0 font-w-500 tx-s-12" id="notcontacted">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_1">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_2">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_3">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_4">-</p>
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
                                        <img src="<?php echo base_url() . "YbsService/get_foto_agent/default.png" ?>" id="agent_1_foto" alt="author" class="rounded-circle  ml-auto" width="65px" height="65px">
                                        <div class="media-body align-self-center pl-3">
                                            <span class="mb-0 font-w-600" id="agent_1_nama"><?php echo $nama_leader_on_duty ?></span><br>
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
                                        <span class="h4"><?php echo $cache_monev_realtime['aval_num']; ?></span>
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
        2020 © Sy-ANIDA
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
                url: "<?php echo base_url() . "api/Dashboard_v2/get_daily_performance_indibox" ?>",
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
                url: "<?php echo base_url() . "api/Dashboard_v2/get_profiling_indibox" ?>",
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
                    $("#callorder_moss").text(response.callorder);
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
                url: "<?php echo base_url() . "api/Dashboard_v2/get_slg_indibox" ?>",
                data: {
                    start: start,
                    end: end
                },
                methode: "get",
                dataType: 'JSON',
                success: function(response) {
                    $("#slg").text(response.slg);
                    $("#slfc").text(response.slfc);


                    // Element inside which you want to see the chart
                    $("#slg_chart").html("");
                    let element = document.querySelector('#slg_chart');

                    // Properties of the gauge

                    var slg_num = response.slg;
                    var slg_label = response.slg;
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

                    var slfc_num = response.slfc;
                    var slfc_label = response.slfc;
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

        function get_waiting() {

            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard_v2/get_waiting_indibox" ?>",
                methode: "get",
                dataType: 'JSON',
                success: function(response) {
                    $("#waiting").text(response.waiting);

                }
            });
        }
        setInterval(function() {
            get_waiting();
        }, 5000);



        $(document).ready(function() {

            get_performance();
            // get_profiling_reguler();
            // get_best_agent();
            get_slg_mos();
            get_profiling_mos();
            // get_grafik();
            get_waiting();
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
                            data: [
                                <?php
                                foreach ($grafik['Waiting'] as $bulanna => $valna) {
                                    echo intval($valna) . ',';
                                }

                                ?>
                            ]
                        }, {
                            label: 'Verified',
                            type: 'line',
                            // backgroundColor: 'green',
                            borderColor: 'green',
                            fill: false,
                            borderWidth: 2,
                            data: [
                                <?php
                                foreach ($grafik['Verified'] as $bulanna => $valna) {
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
                        }
                    }
                });
            }


        });
    </script>
</body>
<!-- END: Body-->

</html>