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
$lap = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15');

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
                <h1>PROFILING WALLBOARD MOSS</h1>
            </td>
            <td width="33%" style="text-align:right;">
                <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">
            </td>
        </tr>
    </table>
    <table width="100%" style="text-align:center;">
        <tr>
            <td width="20%" rowspan="2">
                <div class="col-xl-12">
                    <div class="panel panel-lte">
                        <div class="panel-heading lte-heading-danger" style="background-color: #cd201f !important;">CALL ORDER</div>
                        <div class="panel-body" id="mos_area">
                            <div class='row' id="content-body" style="text-align:center;">
                                <div class="col-lg-12 col-xs-12">
                                    <div class="small-box bg-green" style="border-radius: 10px;">
                                        <div class="inner">
                                            <h3 id="verified_mos">-</h3>
                                            <p>VERIFIED</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xs-12">
                                    <div class="small-box bg-blue" style="border-radius: 10px;">
                                        <div class="inner">
                                            <h3 id="connected_mos">-</h3>
                                            <p>CONTACTED</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xs-12">
                                    <div class="small-box bg-red" style="border-radius: 10px;">
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
            <td width="20%" rowspan="2" valign="top">
                <div class="panel panel-lte" style="width:97%">
                    <div class="panel-heading lte-heading-danger" style="background-color: #cd201f !important;">SLG MOSS</div>
                    <div class="panel-body">
                        <div id="slg_chart" style="min-width: 310px; width: 100%; height: 100%; margin: 0 auto"></div>
                        <div class="small-box bg-green" style="border-radius: 10px;;margin-top:64px;">
                            <div class="inner">
                                <h3 id="convention_rate">-</h3>
                                <p>CONVENTION RATE</p>
                            </div>
                        </div>
                    </div>
                </div>



            </td>

            <td width="20%" valign="top" style="text-align:center;">
                <!-- <h2>PROFILING DASHBOARD</h2> -->
                <img src="<?php echo base_url('assets/images/logo_profiling.png') ?>" class="fontlogo" alt="" width="50%">
                <br><b><span style="font-size:100px;margin-top:-5px;"  id="agent_online">-</span><br><span style="font-size:29px;">AGENT ONLINE</span></b>
               
                <div class="small-box bg-red" style="border-radius: 10px;">
                    <div class="inner">
                        <h3 id="waiting">-</h3>
                        <p>DATA WAITING</p>
                    </div>
                </div>
            </td>
            <td width="40%" rowspan="2">
                <div class="col-xl-12">
                    <div class="panel panel-lte" style="padding-bottom:26px;">
                        <div class="panel-heading lte-heading-danger" style="background-color: #cd201f !important;">BEST PERFORMANCE DAILY</div>
                        <div class="panel-body">
                            <div class='row' id="content-body">
                                <div class="col-lg-12">
                                    <div class="card" id="daily_1_area" style="border-radius: 10px;">
                                        <div class="card-body" style="padding: 0.5rem;">
                                            <div class="media">
                                                <span class="avatar avatar-xxl mr-5" id="agent_1_foto" style="background-image: url(http://localhost/infomedia_app/demo/faces/female/21-.jpg)"></span>
                                                <div class="media-body">
                                                    <h4 class="m-0" id="agent_1_nama" style="color:black;">-</h4>
                                                    <p class="text-muted mb-0" id="agent_1_num">-</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card" id="daily_2_area" style="border-radius: 10px;">
                                        <div class="card-body" style="padding: 0.5rem;">
                                            <div class="media">
                                                <span class="avatar avatar-xxl mr-5" id="agent_2_foto" style="background-image: url(http://localhost/infomedia_app/demo/faces/female/20-.jpg)"></span>
                                                <div class="media-body">
                                                    <h4 class="m-0" id="agent_2_nama" style="color:black;">-</h4>
                                                    <p class="text-muted mb-0" id="agent_2_num">-</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card" id="daily_3_area" style="border-radius: 10px;">
                                        <div class="card-body" style="padding: 0.5rem;">
                                            <div class="media">
                                                <span class="avatar avatar-xxl mr-5" id="agent_3_foto" style="background-image: url(http://localhost/infomedia_app/demo/faces/male/21-.jpg)"></span>
                                                <div class="media-body">
                                                    <h4 class="m-0" id="agent_3_nama" style="color:black;">-</h4>
                                                    <p class="text-muted mb-0" id="agent_3_num">-</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card" id="daily_4_area" style="border-radius: 10px;">
                                        <div class="card-body" style="padding: 0.5rem;">
                                            <div class="media">
                                                <span class="avatar avatar-xxl mr-5" id="agent_4_foto" style="background-image: url(http://localhost/infomedia_app/demo/faces/male/18-.jpg)"></span>
                                                <div class="media-body">
                                                    <h4 class="m-0" id="agent_4_nama" style="color:black;">-</h4>
                                                    <p class="text-muted mb-0" id="agent_4_num">-</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card" id="daily_5_area" style="border-radius: 10px;">
                                        <div class="card-body" style="padding: 0.5rem;">
                                            <div class="media">
                                                <span class="avatar avatar-xxl mr-5" id="agent_5_foto" style="background-image: url(http://localhost/infomedia_app/demo/faces/male/17-.jpg)"></span>
                                                <div class="media-body">
                                                    <h4 class="m-0" id="agent_5_nama" style="color:black;">-</h4>
                                                    <p class="text-muted mb-0" id="agent_5_num">-</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
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
                        <div class="panel-heading lte-heading-danger" style="background-color: #cd201f !important;">DATA VERIFIED & WAITING MOSS PROFILING</div>
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
                                                    <span class="avatar" style="width: 200px;height: 200px;background-image: url('<?php echo base_url() . "YbsService/get_foto_agent/" . $picture_leader_on_duty ?>')"></span>

                                                    <h4 class="m-0" style="color:black;"><?php echo $nama_leader_on_duty ?></h4>
                                                    <p class="text-muted mb-0">LEADER ON DUTY</p>
                                                    <p class="text-muted mb-0"><?php echo $jadwal_leader_on_duty ?></p>
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
    <script type="text/javascript">
        function get_performance() {
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard/get_daily_performance_moss" ?>",
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

            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard/get_profiling_mos" ?>",
                methode: "get",
                dataType: 'JSON',
                success: function(response) {
                    $("#slg").text(response.slg);

                    agent_online = parseInt($("#agent_online_reg").val()) + parseInt(response.agent_online);
                    $("#agent_online").text(agent_online);
                    $("#agent_online_moss").val(response.agent_online);
                    $("#connected_mos").text(response.contacted);
                    $("#verified_mos").text(response.status_13);
                    $("#notconnected_mos").text(response.uncontacted);
                    $("#convention_rate").text(response.convention_rate+"%");
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
                    switch (true) {
                        case (parseInt(slg_num) > 10):
                            var slg_num = 10;
                            var slg_label = '>10';
                            var bar_color = "red";
                            break;
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


        function get_grafik() {

            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard/get_grafik_moss" ?>",
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
        setInterval(function() {
            get_profiling_mos();
            get_performance();

        }, 300000);
        setInterval(function() {
            get_waiting();
        }, 5000);



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