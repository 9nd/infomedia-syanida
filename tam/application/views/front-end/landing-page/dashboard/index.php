<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">

    <title>Profiling - Dashboard</title>
    <script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
    <script>
        var data_token = "<?php echo  $this->_token ?>";
        var sec_val = "<?php echo $this->security->get_csrf_token_name() . "=" . $this->security->get_csrf_hash() ?>&";
        var xax = "<?php echo $fparent ?>"
    </script>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/ybs.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/fonts/fw/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/tabler/bower_components/Ionicons/css/ionicons.min.css" />

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dashboard.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/toastr-master/toastr.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/ybs-slider/ybs-slider.css">

    <script src="<?php echo base_url() ?>assets/js/vendors/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/vendors/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/dashboard.js"></script>
    <script src="<?php echo base_url() ?>assets/js/core.js"></script>
    <script src="<?php echo base_url() ?>assets/toastr-master/toastr.js"></script>


    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/EnlighterJS/Build/EnlighterJS.min.css" />
    <script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/EnlighterJS/Resources/MooTools-Core-1.6.0.js"></script>


    <script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/EnlighterJS/Build/EnlighterJS.min.js"></script>
    <meta name="EnlighterJS" content="Advanced javascript based syntax highlighting" data-language="javascript" data-indent="2" data-selector-block="pre" data-selector-inline="code" />

    <script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
    <script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/jquery-knob/jquery.knob.min.js" type="text/javascript"></script>

</head>
<?php
$thn = array("jan", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$data_lm = array(100, 80, 70, 80, 100, 80, 70, 80, 100, 80, 70, 80);
$data_lk = array(90, 100, 80, 60, 100, 80, 70, 80, 100, 80, 70, 80);
$data_ld = array(110, 78, 67, 90, 100, 80, 70, 80, 100, 80, 70, 80);
$data_sp2hp = array(87, 65, 98, 65, 100, 80, 70, 80, 100, 80, 70, 80);
$lap = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");

?>
<script type="text/javascript">
    var chart;
    var slg_chart;
    $(document).ready(function() {

        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'chard_data_ajax',
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: [
                    <?php

                    foreach ($lap as $ta) {
                        echo "'" . $ta . "',";
                    }
                    ?>
                ]
            },
            labels: {
                items: [{
                    html: '',
                    style: {
                        left: '40px',
                        top: '8px',
                        color: 'black'
                    }
                }]
            },
            series: []
        });


    });
</script>

<body style="background-color:#00acee;color:white;">
    <table width="100%">
        <tr>
            <td width="33%">
                <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">

            </td>
            <td width="34%" style="text-align:center;">
                <h1>PROFILING DASHBOARD</h1>
            </td>
            <td width="33%" style="text-align:right;">
                <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">
            </td>
        </tr>
    </table>
    <table width="100%" style="text-align:center;">
        <tr>
            <td width="40%" rowspan="2">
                
            </td>
            <td width="20%">
                <!-- <h2>PROFILING DASHBOARD</h2> -->
                <img src="<?php echo base_url('assets/images/logo_profiling.png') ?>" class="fontlogo" alt="" width="50%">
            </td>
            <td width="20%" rowspan="2">
                <div class="col-xl-12">
                    <div class="panel panel-lte">
                        <div class="panel-heading lte-heading-danger" style="background-color: #cd201f !important;">MOSS</div>
                        <div class="panel-body" id="mos_area">
                            <div class='row' id="content-body" style="text-align:center;">
                                <div class="col-lg-12 col-xs-12">
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h3 id="verified_mos">-</h3>
                                            <p>VERIFIED</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xs-12">
                                    <div class="small-box bg-blue">
                                        <div class="inner">
                                            <h3 id="connected_mos">-</h3>
                                            <p>CONTACTED</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xs-12">
                                    <div class="small-box bg-red">
                                        <div class="inner">
                                            <h3 id="notconnected_mos">-</h3>
                                            <p>NOT CONTACTED</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td width="20%" rowspan="2">

                <div class="col-xl-12">
                    <div class="panel panel-lte">
                        <div class="panel-heading lte-heading-danger" style="background-color: #cd201f !important;">REGULER</div>
                        <div class="panel-body" id="reguler_area">
                            <div class='row' id="content-body">
                                <div class="col-lg-12 col-xs-12">
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h3 id="verified_reguler">-</h3>
                                            <p>VERIFIED</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xs-12">
                                    <div class="small-box bg-blue">
                                        <div class="inner">
                                            <h3 id="connected_reguler">-</h3>
                                            <p>CONTACTED</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xs-12">
                                    <div class="small-box bg-red">
                                        <div class="inner">
                                            <h3 id="notconnected_reguler">-</h3>
                                            <p>NOT CONTACTED</p>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </td>
        </tr>
        <tr>
            <td>
                <div class="panel panel-lte">
                    <div class="panel-heading lte-heading-danger" style="background-color: #cd201f !important;">SLG MOSS</div>
                    <div class="panel-body">
                        <div id="slg_chart" style="min-width: 310px; width: 100%; height: 100%; margin: 0 auto"></div>

                    </div>
                </div>
            </td>
        </tr>
    </table>
    <table width="100%" style="text-align:center;">
        <tr>
            <td width="50%" valign="top">

                <div class="col-xl-12">
                    <div class="panel panel-lte">
                        <div class="panel-heading lte-heading-danger" style="background-color: #cd201f !important;">DATA VERIFIED PROFILING</div>
                        <div class="panel-body">
                            <div class='row' id="content-body">
                                <div class="col-xl-12">
                                    <div id="chard_data_ajax" style="min-width: 400px; height: 270px; margin: 0 auto"></div>
                                    <div id="grafik_area"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td width="50%" valign="top">

                <div class="col-xl-12">
                    <div class="panel panel-lte">
                        <div class="panel-heading lte-heading-danger" style="background-color: #cd201f !important;">BEST PERFORMANCE LAST MONTH</div>
                        <div class="panel-body">
                            <div class='row' id="content-body">
                                <div class="col-xl-12">
                                    <div class="row row-cards">
                                        <!--image 1-->
                                        <div class="col-sm-4 col-lg-4" id="best_agent_area">

                                            <div class="media">
                                                <div class="media-body">
                                                    <span class="avatar" id="best_agent_foto" style="width: 200px;height: 200px;background-image: url(http://localhost/infomedia_app/demo/faces/male/17-.jpg)"></span>

                                                    <h4 class="m-0" id="best_agent_nama" style="color:black;">-</h4>
                                                    <p class="text-muted mb-0">BEST AGENT</p>
                                                    <p class="text-muted mb-0" id="best_agent_num" style="color:black;">-</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end image 1-->

                                        <!--image 2-->
                                        <div class="col-sm-4 col-lg-4">
                                            <div class="media">
                                                <div class="media-body">
                                                    <span class="avatar" id="best_tl_foto" style="width: 200px;height: 200px;background-image: url(http://localhost/infomedia_app/demo/faces/male/17-.jpg)"></span>

                                                    <h4 class="m-0" id="best_tl_nama" style="color:black;">-</h4>
                                                    <p class="text-muted mb-0">BEST TEAMLEADER</p>
                                                    <p class="text-muted mb-0" id="best_tl_num" style="color:black;">-</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end image 2-->

                                        <!--image 3-->
                                        <div class="col-sm-4 col-lg-4">

                                            <div class="media">
                                                <div class="media-body">
                                                    <span class="avatar" style="width: 200px;height: 200px;background-image: url('<?php echo base_url() . "YbsService/get_foto_agent/".$picture_leader_on_duty ?>')"></span>

                                                    <h4 class="m-0" style="color:black;"><?php echo $nama_leader_on_duty?></h4>
                                                    <p class="text-muted mb-0">LEADER ON DUTY</p>
                                                    <p class="text-muted mb-0"><?php echo $jadwal_leader_on_duty?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end image 3-->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </td>
        </tr>
        <tr>
            <td style="text-align:center;">
                <div class="col-xl-12">
                    <div class="panel panel-lte">
                        <div class="panel-heading lte-heading-danger" style="background-color: #cd201f !important;">MOSS</div>
                        <div class="panel-body" id="mos_area">
                            <div class='row' id="content-body">
                                <div class="col-xl-12">
                                    <a class="btn-lte3 btn-app text-black" style="background-color: #cd201f !important;">
                                        <h3 id="2_mos" style="color:white;">-</h3>
                                        RNA
                                    </a>
                                    <a class="btn-lte3 btn-app text-black" style="background-color: #cd201f !important;">
                                        <h3 id="11_mos" style="color:white;">-</h3>
                                        Decline
                                    </a>
                                    <a class="btn-lte3 btn-app text-black" style="background-color: #cd201f !important;">
                                        <h3 id="8_mos" style="color:white;">-</h3>
                                        Mailbox
                                    </a>
                                    <a class="btn-lte3 btn-app text-black" style="background-color: #cd201f !important;">
                                        <h3 id="14_mos" style="color:white;">-</h3>
                                        Reject By System
                                    </a>
                                    <a class="btn-lte3 btn-app text-black" style="background-color: #cd201f !important;">
                                        <h3 id="10_mos" style="color:white;">-</h3>
                                        Rejected
                                    </a>
                                    <a class="btn-lte3 btn-app text-black" style="background-color: #467fcf !important;;">
                                        <h3 id="1_mos" style="color:white;">-</h3>
                                        BP
                                    </a>
                                    <a class="btn-lte3 btn-app text-black" style="background-color: #467fcf !important;;">
                                        <h3 id="3_mos" style="color:white;">-</h3>
                                        TBP
                                    </a>
                                    <a class="btn-lte3 btn-app text-black" style="background-color: #467fcf !important;">
                                        <h3 id="12_mos" style="color:white;">-</h3>
                                        Follow Up
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td style="text-align:center;">
                <div class="col-xl-12">
                    <div class="panel panel-lte">
                        <div class="panel-heading lte-heading-danger" style="background-color: #cd201f !important;">REGULER</div>
                        <div class="panel-body" id="reguler_area">
                            <div class='row' id="content-body">

                                <div class="col-xl-12">

                                    <a class="btn-lte3 btn-app text-black" style="background-color: #cd201f !important;">
                                        <h3 id="2_reguler" style="color:white;">-</h3>
                                        RNA
                                    </a>
                                    <a class="btn-lte3 btn-app text-black" style="background-color: #cd201f !important;">
                                        <h3 id="11_reguler" style="color:white;">-</h3>
                                        Decline
                                    </a>
                                    <a class="btn-lte3 btn-app text-black" style="background-color: #cd201f !important;">
                                        <h3 id="8_reguler" style="color:white;">-</h3>
                                        Mailbox
                                    </a>
                                    <a class="btn-lte3 btn-app text-black" style="background-color: #cd201f !important;">
                                        <h3 id="14_reguler" style="color:white;">-</h3>
                                        Reject By System
                                    </a>
                                    <a class="btn-lte3 btn-app text-black" style="background-color: #cd201f !important;">
                                        <h3 id="10_reguler" style="color:white;">-</h3>
                                        Rejected
                                    </a>
                                    <a class="btn-lte3 btn-app text-black" style="background-color: #467fcf !important;">
                                        <h3 id="1_reguler" style="color:white;">-</h3>
                                        BP
                                    </a>
                                    <a class="btn-lte3 btn-app text-black" style="background-color: #467fcf !important;">
                                        <h3 id="3_reguler" style="color:white;">-</h3>
                                        TBP
                                    </a>
                                    <a class="btn-lte3 btn-app text-black" style="background-color: #467fcf !important;">
                                        <h3 id="12_reguler" style="color:white;">-</h3>
                                        Follow Up
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </td>
        </tr>
    </table>

    <input type="hidden" id="daily_status" value="0">
    <input type="hidden" id="mos_status" value="0">
    <input type="hidden" id="reguler_status" value="0">
    <input type="hidden" id="grafik_status" value="0">
    <input type="hidden" id="best_agent_status" value="0">
    <script id="src_ybs" src="<?php echo base_url() ?>assets/ybs.js"></script>
    <script src="<?php echo base_url() ?>assets/ybs-slider/ybs-slider.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/input-mask/js/jquery.mask.min.js"></script>
    <script type="text/javascript">
        function get_performance() {
            $("#daily_status").val(0);
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard/get_daily_performance" ?>",
                methode: "get",
                async: true,
                dataType: 'JSON',
                success: function(response) {

                    $.each(response.agent, function(key, val) {
                        // alert(key);
                        // $("#daily_" + key + "_area").slideToggle();
                        $("#agent_" + key + "_nama").text(val.nama);
                        $("#agent_" + key + "_num").text(val.num + " Verified");
                        document.getElementById("agent_" + key + "_foto").style.backgroundImage = "url('<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + val.picture + "')";
                        // $("#daily_" + key + "_area").slideToggle();
                    });
                    var mos = $("#mos_status").val();
                    if (mos == 0) {
                        get_profiling_mos();
                    }
                    $("#daily_status").val(1);
                    // get_performance();
                },
                // error: function(xhr, status, error) {
                //     var err = eval("(" + xhr.responseText + ")");
                //     alert(err.Message);
                // }
            });
        }

        function get_profiling_mos() {

            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard/get_profiling_mos" ?>",
                methode: "get",
                dataType: 'JSON',
                success: function(response) {
                    // $("#mos_area").slideToggle();
                    $("#slg").text(response.slg);
                    $("#connected_mos").text(response.contacted);
                    $("#verified_mos").text(response.status_13);
                    $("#notconnected_mos").text(response.uncontacted);
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
                    // $("#mos_area").slideToggle();
                    // get_profiling_mos();
                    var reguler = $("#reguler_status").val();
                    if (reguler == 0) {
                        get_profiling_reguler();
                    }
                    $("#mos_status").val(1);
                    // Element inside which you want to see the chart
                    $("#slg_chart").html("");
                    let element = document.querySelector('#slg_chart');

                    // Properties of the gauge

                    var slg_num = response.slg;
                    switch (true) {
                        case (parseInt(slg_num) >= 7):
                            var bar_color = "red";
                            break;
                        case (parseInt(slg_num) > 4):
                            var bar_color = "yellow";
                            break;
                        default:
                            var bar_color = "green";
                            break;

                    }
                    let gaugeOptions = {
                        hasNeedle: true,
                        needleColor: bar_color,
                        needleUpdateSpeed: 1000,
                        arcColors: [bar_color, 'lightgray'],
                        arcDelimiters: [response.slg * 10],
                        rangeLabel: ['0', '10'],
                        centralLabel: response.slg,
                    };
                    GaugeChart
                        .gaugeChart(element, 300, gaugeOptions)
                        .updateNeedle(response.slg * 10);
                }
            });
        }

        function get_profiling_reguler() {

            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard/get_profiling_reguler" ?>",
                methode: "get",
                dataType: 'JSON',
                success: function(response) {
                    // $("#reguler_area").slideToggle();
                    $("#connected_reguler").text(response.contacted);
                    $("#verified_reguler").text(response.status_13);
                    $("#notconnected_reguler").text(response.uncontacted);
                    $("#1_reguler").text(response.status_1);
                    $("#2_reguler").text(response.status_2);
                    $("#3_reguler").text(response.status_3);
                    $("#4_reguler").text(response.status_4);
                    $("#5_reguler").text(response.status_5);
                    $("#6_reguler").text(response.status_6);
                    $("#7_reguler").text(response.status_7);
                    $("#8_reguler").text(response.status_8);
                    $("#9_reguler").text(response.status_9);
                    $("#10_reguler").text(response.status_10);
                    $("#11_reguler").text(response.status_11);
                    $("#12_reguler").text(response.status_12);
                    $("#13_reguler").text(response.status_13);
                    $("#14_reguler").text(response.status_14);
                    $("#15_reguler").text(response.status_15);
                    $("#16_reguler").text(response.status_16);
                    // $("#reguler_area").slideToggle();
                    var grafik = $("#grafik_status").val();
                    if (grafik == 0) {
                        get_grafik();
                    }
                    $("#reguler_status").val(1);

                }
            });
        }



        function get_grafik() {

            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard/get_grafik_verified_yearly" ?>",
                methode: "get",
                dataType: 'JSON',
                success: function(response) {
                    $.each(response.data, function(key, val) {
                        chart.addSeries({
                            name: key,
                            data: val
                        });
                    });
                    $("#grafik_status").val(1);
                    var best_agent = $("#best_agent_status").val();
                    if (best_agent == 0) {
                        get_best_agent();
                    }

                }
            });
        }



        function get_best_agent() {
            $("#best_agent_status").val(0);
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard/get_best_agent" ?>",
                methode: "get",
                async: true,
                dataType: 'JSON',
                success: function(response) {

                    $.each(response.agent, function(key, val) {
                        // alert(key);
                        // $("#best_agent_area").slideToggle();
                        $("#best_agent_nama").text(val.nama);
                        $("#best_agent_num").text(val.num);
                        document.getElementById("best_agent_foto").style.backgroundImage = "url('<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + val.picture + "')";
                        // $("#best_agent_area").slideToggle();
                    });
                    $.each(response.tl, function(key, val) {
                        // alert(key);
                        // $("#best_tl_area").slideToggle();
                        $("#best_tl_nama").text(val.nama);
                        $("#best_tl_num").text(val.num);
                        document.getElementById("best_tl_foto").style.backgroundImage = "url('<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + val.picture + "')";
                        // $("#best_tl_area").slideToggle();
                    });
                    $("#best_agent_status").val(1);
                    // get_performance();
                },
                // error: function(xhr, status, error) {
                //     var err = eval("(" + xhr.responseText + ")");
                //     alert(err.Message);
                // }
            });
        }
        // setInterval(function() {
        //     var best_agent = $("#best_agent_status").val();
        //     if (best_agent == 1) {
        //         get_performance();
        //     } else {
        //         console.log("skiped daily");
        //     }


        // }, 30000);

        // setInterval(function() {
        //     var best_agent = $("#best_agent_status").val();
        //     if (best_agent == 1) {
        //         get_profiling_mos();
        //     } else {
        //         console.log("skiped mos");
        //     }

        // }, 30000);

        // setInterval(function() {
        //     var best_agent = $("#best_agent_status").val();
        //     var reguler_status = $("#reguler_status").val();
        //     if (best_agent == 1) {
        //         get_profiling_reguler();
        //     } else {
        //         console.log("skiped reguler");
        //     }
        // }, 30000);

        // setInterval(function() {
        //     var grafik = $("#grafik_status").val();
        //     if (grafik == 0) {
        //         console.log("get grafik");
        //         get_grafik();
        //         console.log("finish grafik");
        //     } else {
        //         console.log("skiped grafik");
        //     }

        // }, 300000);
        // setInterval(function() {
        //     var best_agent = $("#best_agent_status").val();
        //     if (best_agent == 0) {
        //         console.log("get Best Agent");
        //         get_best_agent();
        //         console.log("finish est Agent");
        //     } else {
        //         console.log("skiped est Agent");
        //     }
        // }, 450000);


        $(document).ready(function() {

            // get_performance();
            // get_best_agent();
            // get_profiling_reguler();
            // get_profiling_mos();
            // get_grafik();
            /* jQueryKnob */
        });
    </script>
</body>

</html>