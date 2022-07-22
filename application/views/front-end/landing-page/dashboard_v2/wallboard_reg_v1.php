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

                    foreach ($thn as $ta) {
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
            <img src="<?php echo base_url('assets/images/logo2.png') ?>" class="fontlogo" alt="" width="200px">
                        <br>
                <form method="GET"  action="#">
                    MONTH 
                    <select name="bulan"  id="bulan">
                    <?php
                    $lb=0;
                    for($lb=0;$lb<=11;$lb++){
                        $n_lb=sprintf("%02d", $lb);
                        $selected="";
                        if($n_lb == $bulan){
                            $selected="selected";
                        }
                        echo "<option value='".$n_lb."' ".$selected.">".$thn[$lb]."</option>";
                    }
                    ?>
                    </select>
                    <button type="submit" id="filter"><i class="fa fa-search"></i></button><br>
                </form>

            </td>
            <td width="34%" style="text-align:center;">
                <h1>PROFILING WALLBOARD REGULER</h1>

            </td>
            <td width="33%" style="text-align:right;">
            <img src="<?php echo base_url('assets/images/logo2.png') ?>" class="fontlogo" alt="" width="200px">
               
            </td>

        </tr>
    </table>
    <table width="100%">
        <tr>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" width="25%"><i class="fa fa-cog"></i>CALL ORDER </td>
            <td rowspan="4" width="25%" valign="top">
                <table width="100%" style="text-align:center;">
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ff8e35;" valign="bottom">Contacted</td>
                        <td style="text-align:right;font-size: 50px;color:#ff8e35;border-bottom:4px solid #ff8e35;" valign="bottom" id="connected_reguler">-</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ff8e35;" valign="bottom">Contacted Rate</td>
                        <td style="text-align:right;font-size: 50px;color:#ff8e35;border-bottom:4px solid #ff8e35;" valign="bottom" id="connected_rate">-</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ce2f4f;" valign="bottom">Not Contacted</td>
                        <td style="text-align:right;font-size: 50px;color:#ce2f4f;border-bottom:4px solid #ce2f4f;" valign="bottom" id="notconnected_reguler">-</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ce2f4f;" valign="bottom">Not Contacted Rate</td>
                        <td style="text-align:right;font-size: 50px;color:#ce2f4f;border-bottom:4px solid #ce2f4f;" valign="bottom" id="notconnected_rate">-</td>
                    </tr>
                    <tr>
                        <td style="color:#fff;text-align:center;" valign='top'>
                            <span style="font-size:100px;" id="agent_online">-</span><br><span>AGENT ONLINE</span>

                        </td>
                        <td style="text-align:center;" valign="bottom">
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
            <td width="10.25%" style="color:#a3a8ac;font-size:25px;text-align:center;">
                <i class="fa fa-cog"></i> HP + EMAIL
            </td>
            <td width="10.25%" style="color:#a3a8ac;font-size:25px;text-align:center;">
                <i class="fa fa-cog"></i> HP ONLY
            </td>

        </tr>
        <tr>
            <td style="color:#ce2f4f;font-size:150px;text-align:center;" valign='top' id="callorder_reguler" >
                -
            </td>
            <td style="color:#a0bc2e;font-size:150px;text-align:center;" id="verified_reguler">-</td>
            <td rowspan="2" colspan="2">
                <div id="donut-chart" style="height: 250px;"></div>
            </td>

        </tr>
        <tr>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;"><i class="fa fa-cog"></i> WORK ORDER</td>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;"><i class="fa fa-cog"></i> CONVERSION RATE</td>
        </tr>
        <tr>
            <td style="color:#fff;font-size:100px;text-align:center;" valign='top' id="wo">-</td>
            <td style="color:#fff;font-size:100px;text-align:center;" valign='top' id="convention_rate">-</td>
            <td style="color:#ff8e35;font-size:50px;text-align:center;" valign='top' id="hp_email">
                -
            </td>
            <td style="color:#ce2f4f;font-size:50px;text-align:center;" valign='top' id="hp_only">
                -
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="40%" style="color:#a3a8ac;font-size:25px;text-align:center;" valign="top">
                <i class="fa fa-cog"></i> GRAFIK VERIFIED PROFILING
                <br>
                <br>
                <div class="col-xl-12">
                    <div id="chard_data_ajax" style="min-width: 400px; height: 270px; margin: 0 auto"></div>
                    <div id="grafik_area"></div>
                </div>
            </td>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" width="30%" valign="top">
                <i class="fa fa-cog"></i> BEST PERFORMANCE 
                <br>
                <br>
                <div class="col-xl-12">
                    <div class="row row-cards" style="color:#fff;font-size:12px;">
                        <!--image 1-->
                        <div class="col-sm-4 col-lg-4" id="best_agent_area">
                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="best_agent_foto" style="width: 200px;height: 200px;background-image: url(http://localhost/infomedia_syanida/demo/faces/male/17-.jpg)"></span>
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
                                    <span class="avatar" id="best_tl_foto" style="width: 200px;height: 200px;background-image: url(http://localhost/infomedia_syanida/demo/faces/male/17-.jpg)"></span>
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

            <td style="color:#a3a8ac;font-size:25px;text-align:center;" width="20%" valign="top">
                <i class="fa fa-cog"></i> BEST PERFORMANCE
                <br>
                <br>
                <div class="col-xl-12" style="color:#a3a8ac;font-size:12px;text-align:center;">
                    <div class="row row-cards">
                        <!--image 1-->
                        <div class="col-sm-4 col-lg-4" id="daily_1_area">

                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="agent_1_foto" style="width: 100px;height: 100px;background-image: url(http://localhost/infomedia_syanida/demo/faces/male/17-.jpg)"></span>
                                    <br><span id="agent_1_nama">-</span>
                                    <br><span id="agent_1_num">-</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 1-->
                        <!--image 1-->
                        <div class="col-sm-4 col-lg-4" id="daily_2_area">

                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="agent_2_foto" style="width: 100px;height: 100px;background-image: url(http://localhost/infomedia_syanida/demo/faces/male/17-.jpg)"></span>
                                    <br><span id="agent_2_nama">-</span>
                                    <br><span id="agent_2_num">-</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 1-->
                        <!--image 1-->
                        <div class="col-sm-4 col-lg-4" id="daily_3_area">

                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="agent_3_foto" style="width: 100px;height: 100px;background-image: url(http://localhost/infomedia_syanida/demo/faces/male/17-.jpg)"></span>
                                    <br><span id="agent_3_nama">-</span><br>
                                    <span id="agent_3_num">-</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 1-->
                        <!--image 1-->
                        <div class="col-sm-4 col-lg-4" id="daily_4_area">

                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="agent_4_foto" style="width: 100px;height: 100px;background-image: url(http://localhost/infomedia_syanida/demo/faces/male/17-.jpg)"></span>
                                    <br><span id="agent_4_nama">-</span><br>
                                    <span id="agent_4_num">-</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 1-->
                        <!--image 1-->
                        <div class="col-sm-4 col-lg-4" id="daily_5_area">

                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="agent_5_foto" style="width: 100px;height: 100px;background-image: url(http://localhost/infomedia_syanida/demo/faces/male/17-.jpg)"></span>
                                    <br><span id="agent_5_nama">-</span><br>
                                    <span id="agent_5_num">-</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 1-->
                        <!--image 1-->
                        <div class="col-sm-4 col-lg-4" id="daily_6_area">

                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="agent_6_foto" style="width: 100px;height: 100px;background-image: url(http://localhost/infomedia_syanida/demo/faces/male/17-.jpg)"></span>
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
            var bulan = $("#bulan").val();
            $("#daily_status").val(0);
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard_v1/get_daily_performance_reg" ?>",
                methode: "get",
                data: {
                    bulan: bulan
                },
                async: true,
                dataType: 'JSON',
                success: function(response) {
                    $.each(response.agent, function(key, val) {
                        $("#agent_" + key + "_nama").text(val.nama);
                        $("#agent_" + key + "_num").text(val.num + " Verified");
                        document.getElementById("agent_" + key + "_foto").style.backgroundImage = "url('<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + val.picture + "')";
                    });
                },
                error: function() {
                    alert('There was an error processing your information!');
                }
            });
        }


        function get_profiling_reguler() {
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard_v1/get_profiling_reguler" ?>",
                data: {
                    bulan : $("#bulan").val()
                },
                methode: "get",
                dataType: 'JSON',
                success: function(response) {
                    // $("#reguler_area").slideToggle();
                    $("#wo").text(response.wo);
                    $("#agent_online").text(response.agent_online);
                    $("#connected_reguler").text(response.contacted);
                    $("#hp_email").text(response.hp_email);
                    $("#hp_only").text(response.hp_only);
                    $("#connected_rate").text(response.contacted_rate + "%");
                    $("#verified_reguler").text(response.status_13);
                    $("#notconnected_reguler").text(response.uncontacted);
                    $("#notconnected_rate").text(response.uncontacted_rate + "%");
                    $("#callorder_reguler").text(response.callorder);
                    $("#convention_rate").text(response.convention_rate + "%");

                    /*
                     * DONUT CHART
                     * -----------
                     */

                    var donutData = [{
                            label: 'HP ONLY',
                            data: response.hp_only_rate,
                            color: '#ce2f4f'
                        },
                        {
                            label: 'HP + EMAIL',
                            data: response.hp_email_rate,
                            color: '#ff8e35'
                        }
                    ]
                    $.plot('#donut-chart', donutData, {
                        series: {
                            pie: {
                                show: true,
                                radius: 1,
                                innerRadius: 0.5,
                                label: {
                                    show: true,
                                    radius: 2 / 3,
                                    formatter: labelFormatter,
                                    threshold: 0.1
                                }

                            }
                        },
                        legend: {
                            show: false
                        }
                    });
                    /*
                     * END DONUT CHART
                     */
                },
                error: function() {
                    alert('There was an error processing your information!');
                }
            });
        }



        function get_grafik() {
            var start = $("#start").val();
            var end = $("#end").val();
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard_v1/get_grafik_verified" ?>",
                methode: "get",
                data: {
                    bulan : $("#bulan").val()
                },
                dataType: 'JSON',
                success: function(response) {
                    $.each(response.data, function(key, val) {
                        chart.addSeries({
                            name: key,
                            data: val
                        });
                    });
                },
                error: function() {
                    alert('There was an error processing your information!');
                }
            });
        }

        function get_best_agent() {
            $("#best_agent_status").val(0);
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard_v1/get_best_agent" ?>",
                methode: "get",
                data: {
                    bulan : $("#bulan").val()
                },
                async: true,
                dataType: 'JSON',
                success: function(response) {

                    $.each(response.agent, function(key, val) {
                        $("#best_agent_nama").text(val.nama);
                        $("#best_agent_num").text(val.num);
                        document.getElementById("best_agent_foto").style.backgroundImage = "url('<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + val.picture + "')";
                    });
                    $.each(response.tl, function(key, val) {
                        $("#best_tl_nama").text(val.nama);
                        $("#best_tl_num").text(val.num);
                        document.getElementById("best_tl_foto").style.backgroundImage = "url('<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + val.picture + "')";
                    });
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




        $(document).ready(function() {

            get_performance();
            get_profiling_reguler();
            get_grafik();
            get_best_agent();
        });
    </script>
</body>

</html>