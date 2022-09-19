<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">

    <title>Profiling - WALLBOARD</title>
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

    <script src="<?php echo base_url() ?>assets/js/bundle.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/jquery-knob/jquery.knob.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/js/style-highcharts.js"></script>
</head>
<?php
$thn = array("jan", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
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

<!-- <body style="background-color:#202938;color:#efeef0; font-family:'Open Sans',Helvetica,Arial,sans-serif;"> -->

<body style="background-color:#202938;color:#efeef0; font-family:Arial, Helvetica, sans-serif;">
    <table width="100%">
        <tr>
            <td width="33%">
                <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">
                <br>
                <form method="GET" action="#">
                    From <input type="date" name="start" id="start" value="<?php echo $start; ?>"> To <input type="date" name="end" id="end" value="<?php echo $end; ?>"><button type="submit" id="filter"><i class="fa fa-search"></i></button><br>
                </form>
            </td>
            <td width="34%" style="text-align:center;">
                <h1>PROFILING WALLBOARD MOSS</h1>
            </td>
            <td width="33%" style="text-align:right;">
                <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">

            </td>

        </tr>
    </table>
    <table width="100%">
        <tr>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" width="25%"><i class="fa fa-cog"></i> WAITING</td>
            <td rowspan="4" width="25%" valign="top">
                <table width="100%" style="text-align:center;">
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ff8e35;" valign="bottom">Contacted</td>
                        <td style="text-align:right;font-size: 50px;color:#ff8e35;border-bottom:4px solid #ff8e35;" valign="bottom" id="connected_mos">-</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ff8e35;" valign="bottom">Contacted Rate</td>
                        <td style="text-align:right;font-size: 50px;color:#ff8e35;border-bottom:4px solid #ff8e35;" valign="bottom" id="connected_rate">-</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ce2f4f;" valign="bottom">Not Contacted</td>
                        <td style="text-align:right;font-size: 50px;color:#ce2f4f;border-bottom:4px solid #ce2f4f;" valign="bottom" id="notconnected_mos">-</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ce2f4f;" valign="bottom">Not Contacted Rate</td>
                        <td style="text-align:right;font-size: 50px;color:#ce2f4f;border-bottom:4px solid #ce2f4f;" valign="bottom" id="notconnected_rate">-</td>
                    </tr>
                    <tr>
                        <td style="color:#fff;text-align:center;" valign='top'>
                            <span style="font-size:100px;" id="agent_online">-</span><br><span>AGENT ONLINE</span>

                        </td>
                        <td style="text-align:center;;" valign="bottom">
                            <span id=tick2>
                                <script>
                                    function show2() {
                                        if (!document.all && !document.getElementById)
                                            return
                                        thelement = document.getElementById ? document.getElementById("tick2") : document.all.tick2
                                        var Digital = new Date()
                                        var hours = Digital.getHours()
                                        var minutes = Digital.getMinutes()
                                        var seconds = Digital.getSeconds()
                                        var dn = "PM"
                                        if (hours < 12)
                                            dn = "AM"
                                        if (hours > 12)
                                            hours = hours - 12
                                        if (hours == 0)
                                            hours = 12
                                        if (minutes <= 9)
                                            minutes = "0" + minutes
                                        if (seconds <= 9)
                                            seconds = "0" + seconds
                                        var ctime = "<span style='font-size:100px;'>" + hours + ":" + minutes + "</span><span> " + dn + "</span>"
                                        thelement.innerHTML = ctime
                                        setTimeout("show2()", 60000)
                                    }
                                    window.onload = show2
                                    //-->
                                </script>
                            </span>
                            <br>
                            <?php
                            $date = new DateTime();
                            echo $date->format('l') . "<br>";
                            echo $date->format('F jS, Y');
                            ?>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" width="25%"><i class="fa fa-cog"></i> VERIFIED</td>
            <td width="10%" style="color:#a3a8ac;font-size:25px;text-align:center;">
                <i class="fa fa-cog"></i> SLG
            </td>
            <td width="10%" style="color:#a3a8ac;font-size:25px;text-align:center;">
                <i class="fa fa-cog"></i> SLFC
            </td>
        </tr>
        <tr>
            <td style="color:#ce2f4f;font-size:150px;text-align:center;" valign='top' id="waiting">
                -
            </td>
            <td style="color:#a0bc2e;font-size:150px;text-align:center;" id="verified_mos">-</td>
            <td width="10%" style="color:#a3a8ac;font-size:25px;text-align:center;" valign="top">
                <div id="slg_chart" style="min-width: 250px; width: 100%; height: 100%; margin: 0 auto;color:#a0bc2e;"></div>
                <div style="color:#ff8e35;font-size:40px;text-align:center;margin-top:-90px;position:absolute;margin-left:7%" id='slg'></div>

            </td>
            <td width="10%" style="color:#a3a8ac;font-size:25px;text-align:center;" valign="top">
                <div id="slfc_chart" style="min-width: 250px; width: 100%; height: 100%; margin: 0 auto;color:#a0bc2e;"></div>
                <div style="color:#ff8e35;font-size:40px;text-align:center;margin-top:-90px;position:absolute;margin-left:7%" id='slfc'></div>

            </td>
        </tr>
        <tr>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;"><i class="fa fa-cog"></i> CALL ORDER</td>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;"><i class="fa fa-cog"></i> CONVERSION RATE</td>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" rowspan="2" valign="top" colspan="2">
                <i class="fa fa-cog"></i> BEST PERFORMANCE LAST MONTH
                <div class="col-xl-12">
                    <div class="row row-cards" style="color:#fff;font-size:12px;">
                        <!--image 1-->
                        <div class="col-sm-4 col-lg-4" id="best_agent_area">
                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="best_agent_foto" style="width: 200px;height: 200px;background-image: url(http://localhost/infomedia_app/demo/faces/male/17-.jpg)"></span>
                                    <br>
                                    <span id="best_agent_nama">-</span>
                                    <br>
                                    <span>BEST AGENT</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 1-->

                        <!--image 2-->
                        <div class="col-sm-4 col-lg-4">
                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="best_tl_foto" style="width: 200px;height: 200px;background-image: url(http://localhost/infomedia_app/demo/faces/male/17-.jpg)"></span>
                                    <br>
                                    <span id="best_tl_nama">-</span>
                                    <br>
                                    <span>BEST TEAMLEADER</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 2-->

                        <!--image 3-->
                        <div class="col-sm-4 col-lg-4">

                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" style="width: 200px;height: 200px;background-image: url('<?php echo base_url() . "YbsService/get_foto_agent/" . $picture_leader_on_duty ?>')"></span>
                                    <br>
                                    <span><?php echo $nama_leader_on_duty ?></span>
                                    <br>
                                    <span>LEADER ON DUTY</span>
                                </div>
                            </div>
                        </div>
                        <!--end image 3-->

                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="color:#fff;font-size:100px;text-align:center;" valign='top' id="callorder_moss">-</td>
            <td style="color:#fff;font-size:100px;text-align:center;" valign='top' id="convention_rate">-</td>
            
        </tr>
    </table>
    <table>
        <tr>
            <td width="50%" style="color:#a3a8ac;font-size:25px;text-align:center;" valign="top">
                <i class="fa fa-cog"></i> GRAFIK VERIFIED PROFILING
                <br>
                <br>
                <div class="col-xl-12">
                    <div id="chard_data_ajax" style="min-width: 400px; height: 270px; margin: 0 auto"></div>
                    <div id="grafik_area"></div>
                </div>
            </td>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" width="50%" valign="top">
                <i class="fa fa-cog"></i> BEST PERFORMANCE DAILY
                <br>
                <br>
                <div class="col-xl-12" style="color:#a3a8ac;font-size:12px;text-align:center;">
                    <div class="row row-cards">
                        
                        <!--image 1-->
                        <div class="col-sm-2 col-lg-2" id="daily_1_area">

                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="agent_1_foto" style="width: 150px;height: 150px;background-image: url(http://localhost/infomedia_app/demo/faces/male/17-.jpg)"></span>
                                    <br><span id="agent_1_nama">-</span>
                                    <br><span id="agent_1_num">-</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 1-->
                        <!--image 1-->
                        <div class="col-sm-2 col-lg-2" id="daily_2_area">

                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="agent_2_foto" style="width: 150px;height: 150px;background-image: url(http://localhost/infomedia_app/demo/faces/male/17-.jpg)"></span>
                                    <br><span id="agent_2_nama">-</span>
                                    <br><span id="agent_2_num">-</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 1-->
                        <!--image 1-->
                        <div class="col-sm-2 col-lg-2" id="daily_3_area">

                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="agent_3_foto" style="width: 150px;height: 150px;background-image: url(http://localhost/infomedia_app/demo/faces/male/17-.jpg)"></span>
                                    <br><span id="agent_3_nama">-</span><br>
                                    <span id="agent_3_num">-</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 1-->
                        <!--image 1-->
                        <div class="col-sm-2 col-lg-2" id="daily_4_area">

                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="agent_4_foto" style="width: 150px;height: 150px;background-image: url(http://localhost/infomedia_app/demo/faces/male/17-.jpg)"></span>
                                    <br><span id="agent_4_nama">-</span><br>
                                    <span id="agent_4_num">-</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 1-->
                        <!--image 1-->
                        <div class="col-sm-2 col-lg-2" id="daily_5_area">

                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="agent_5_foto" style="width: 150px;height: 150px;background-image: url(http://localhost/infomedia_app/demo/faces/male/17-.jpg)"></span>
                                    <br><span id="agent_5_nama">-</span><br>
                                    <span id="agent_5_num">-</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 1-->
                        <!--image 1-->
                        <div class="col-sm-2 col-lg-2" id="daily_6_area">

                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="agent_6_foto" style="width: 150px;height: 150px;background-image: url(http://localhost/infomedia_app/demo/faces/male/17-.jpg)"></span>
                                    <br><span id="agent_6_nama">-</span><br>
                                    <span id="agent_6_num">-</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 1-->
                    </div>
                </div>
            </td>

        </tr>
    </table>

    <input type="hidden" id="agent_online_reg" value="0">
    <input type="hidden" id="agent_online_moss" value="0">
    <input type="hidden" id="daily_status" value="0">
    <input type="hidden" id="mos_status" value="0">
    <input type="hidden" id="reguler_status" value="0">
    <input type="hidden" id="grafik_status" value="0">
    <input type="hidden" id="best_agent_status" value="0">
    <script id="src_ybs" src="<?php echo base_url() ?>assets/ybs.js"></script>
    <script src="<?php echo base_url() ?>assets/ybs-slider/ybs-slider.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/input-mask/js/jquery.mask.min.js"></script>
    <!-- FLOT CHARTS -->
    <script src="<?php echo base_url() ?>assets/js/plugins/bower_components/Flot/jquery.flot.js"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="<?php echo base_url() ?>assets/js/plugins/bower_components/Flot/jquery.flot.resize.js"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
    <script src="<?php echo base_url() ?>assets/js/plugins/bower_components/Flot/jquery.flot.pie.js"></script>
    <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
    <script src="<?php echo base_url() ?>assets/js/plugins/bower_components/Flot/jquery.flot.categories.js"></script>


    <script type="text/javascript">
        function get_performance() {
            var start = $("#start").val();
            var end = $("#end").val();
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard/get_daily_performance_moss" ?>",
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
            });
        }

        function get_profiling_mos() {
            var start = $("#start").val();
            var end = $("#end").val();
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard/get_profiling_mos" ?>",
                data: {
                    start: start,
                    end: end
                },
                methode: "get",
                dataType: 'JSON',
                success: function(response) {
                    $("#slg").text(response.slg);
                    $("#slfc").text(response.slfc);

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
                            var slg_num =9.9;
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
                        .gaugeChart(element, 350, gaugeOptions)
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
                        .gaugeChart(element2, 350, gaugeOptions2)
                        .updateNeedle(slfc_num * 10);
                }
            });
        }


        function get_grafik() {
            var start = $("#start").val();
            var end = $("#end").val();
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard/get_grafik_moss" ?>",
                data: {
                    start: start,
                    end: end
                },
                methode: "get",
                dataType: 'JSON',
                success: function(response) {
                    $.each(response.data, function(key, val) {
                        chart.addSeries({
                            name: key,
                            data: val
                        });
                    });
                }
            });
        }



        function get_best_agent() {

            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard/get_best_agent_moss" ?>",
                methode: "get",
                async: true,
                dataType: 'JSON',
                success: function(response) {

                    $.each(response.agent, function(key, val) {
                        $("#best_agent_nama").text(val.nama);
                        $("#best_agent_num").text("RATA-RATA SLG " + val.num);
                        document.getElementById("best_agent_foto").style.backgroundImage = "url('<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + val.picture + "')";
                    });
                    $.each(response.tl, function(key, val) {
                        $("#best_tl_nama").text(val.nama);
                        $("#best_tl_num").text("RATA-RATA SLG " + val.num);
                        document.getElementById("best_tl_foto").style.backgroundImage = "url('<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + val.picture + "')";
                    });

                },
            });
        }

        function get_waiting() {

            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard/get_waiting" ?>",
                methode: "get",
                dataType: 'JSON',
                success: function(response) {
                    $("#waiting").text(response.waiting);

                }
            });
        }
        <?php
        if ($start == date('Y-m-d')) {
        ?>
            setInterval(function() {
                get_profiling_mos();
                get_performance();

            }, 300000);
            setInterval(function() {
                get_waiting();
            }, 5000);
        <?php
        }
        ?>




        $(document).ready(function() {
            get_profiling_mos();
            get_performance();
            get_grafik();
            get_best_agent();
            get_waiting();
            // get_best_agent();
            // get_profiling_reguler();
            // get_profiling_mos();
            // get_grafik();
            /* jQueryKnob */
        });
    </script>
</body>

</html>