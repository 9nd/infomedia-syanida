<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">

    <title>BSD - WALLBOARD</title>
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
$lap = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');

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

<!-- <body style="background-color:#202938;color:#efeef0; font-family:'Open Sans',Helvetica,Arial,sans-serif;"> -->

<body style="background-color:#202938;color:#efeef0; font-family:Arial, Helvetica, sans-serif;">
    <table width="100%">
        <tr>
            <td width="33%">
                <!-- <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px"> -->
                <br>
                <!-- <form method="GET" action="#">
                    From <input type="date" name="start" id="start" value="<?php echo $start; ?>"> To <input type="date" name="end" id="end" value="<?php echo $end; ?>"><button type="submit" id="filter"><i class="fa fa-search"></i></button><br>
                </form> -->

            </td>
            <td width="34%" style="text-align:center;">
                <h1>TAM Consumer</h1>

            </td>
            <td width="33%" style="text-align:right;">
                <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">

            </td>

        </tr>
    </table>
    <table width="100%">
        <tr>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" valign='top' rowspan='2' width="25%">
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
                            var ctime = "<span style='color:#fff;font-size:100px;'>" + hours + ":" + minutes + "</span><span> " + dn + "</span>"
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
                <br>
                <select name='site' id='site' >
                        <option value='All' <?php echo ($_GET['site'] == 'All') ? 'selected' : '';?>>ALL SITE</option>
                        <option value='CW' <?php echo ($_GET['site'] == 'SW') ? 'selected' : '';?>>Citywalk</option>
                        <option value='BSD' <?php echo ($_GET['site'] == 'BSD') ? 'selected' : '';?>>BDS</option>
                        <option value='MEDAN' <?php echo ($_GET['site'] == 'MEDAN') ? 'selected' : '';?>>Medan</option>
                        <option value='BANDUNG' <?php echo ($_GET['site'] == 'BANDUNG') ? 'selected' : '';?>>Bandung</option>
                        <option value='Semarang' <?php echo ($_GET['site'] == 'Semarang') ? 'selected' : '';?>>Semarang</option>
                        <option value='Malang' <?php echo ($_GET['site'] == 'Malang') ? 'selected' : '';?>>Malang</option>
                        <option value='Makassar' <?php echo ($_GET['site'] == 'Makassar') ? 'selected' : '';?>>Makassar</option>
                </select>
                <br>
                <br>
                <i class="fa fa-cog"></i> DATA CONSUME
                <div style="color:#ce2f4f;font-size:100px;text-align:center;" id="data_consume">-

                </div>
            </td>
            <td rowspan="5" width="20%" valign="top">
                <table width="100%" style="text-align:center;">
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ff8e35;" valign="bottom">Contacted</td>
                        <td style="text-align:right;font-size: 50px;color:#ff8e35;border-bottom:4px solid #ff8e35;" valign="bottom" id="contacted">-</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ff8e35;" valign="bottom">Contacted Rate</td>
                        <td style="text-align:right;font-size: 50px;color:#ff8e35;border-bottom:4px solid #ff8e35;" valign="bottom" id="contacted_rate">-</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ce2f4f;" valign="bottom">Agree</td>
                        <td style="text-align:right;font-size: 50px;color:#ce2f4f;border-bottom:4px solid #ce2f4f;" valign="bottom" id="agree">-</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ce2f4f;" valign="bottom">Conversion Rate</td>
                        <td style="text-align:right;font-size: 50px;color:#ce2f4f;border-bottom:4px solid #ce2f4f;" valign="bottom" id="agree_rate">-</td>
                    </tr>
                </table>
            </td>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" width="30%"><i class="fa fa-cog"></i> APPROVE</td>
            <td width="20.5%" style="color:#a3a8ac;font-size:25px;text-align:center;">
                <i class="fa fa-cog"></i> SALES REGIONAL
            </td>

        </tr>
        <tr>

            <td style="color:#a0bc2e;font-size:150px;text-align:center;">
                <span id="approve">-</span>
                <table align="center" style="padding:5px;color:#ffffff;font-size:20px;text-align:right;" width="90%">
                    <tr>
                        <td>Upgrade :</td>
                        <td id="approve-0" style="color:#ce2f4f">-</td>
                        <td> STB Tambahan :</td>
                        <td id="approve-3" style="color:#ce2f4f">-</td>
                    </tr>
                    <tr>
                        <td>Mini Pack :</td>
                        <td id="approve-1" style="color:#ce2f4f">-</td>
                        <td> Indihome 2P to 3P :</td>
                        <td id="approve-4" style="color:#ce2f4f">-</td>
                    </tr>
                    <tr>
                        <td>Indibox :</td>
                        <td id="approve-2" style="color:#ce2f4f">-</td>
                        <td> Homewifi :</td>
                        <td id="approve-5" style="color:#ce2f4f">-</td>
                    </tr>
                </table>
            </td>
            <td rowspan="1" valign='top' style="font-size:25px;text-align:center;" >
                <table width='100%'>
                    <tr style="font-size:20px;text-align:center;">
                        <th style="padding:5px;"></th>
                        <th style="padding:10px;border-right:2px solid #ff8e35;border-top:2px solid #ff8e35;">Upgrade</th>
                        <th style="padding:10px;border-right:2px solid #ff8e35;border-top:2px solid #ff8e35;">Minipack</th>
                        <th nowrap style="padding:10px;border-right:2px solid #ff8e35;border-top:2px solid #ff8e35;">2nd STB</th>
                        <th nowrap style="padding:10px;border-right:2px solid #ff8e35;border-top:2px solid #ff8e35;">Homewifi</th>
                        <th style="padding:10px;border-right:2px solid #ff8e35;border-top:2px solid #ff8e35;">2P3P</th>
                        <th style="padding:10px;border-right:2px solid #ff8e35;border-top:2px solid #ff8e35;">Indibox</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-0-0">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-0-1">-</td>
                        <td nowrap style="border-right:2px solid #ff8e35;" id="regional-0-2">-</td>
                        <td nowrap style="border-right:2px solid #ff8e35;" id="regional-0-3">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-0-4">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-0-5">-</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-1-0">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-1-1">-</td>
                        <td nowrap style="border-right:2px solid #ff8e35;" id="regional-1-2">-</td>
                        <td nowrap style="border-right:2px solid #ff8e35;" id="regional-1-3">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-1-4">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-1-5">-</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-2-0">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-2-1">-</td>
                        <td nowrap style="border-right:2px solid #ff8e35;" id="regional-2-2">-</td>
                        <td nowrap style="border-right:2px solid #ff8e35;" id="regional-2-3">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-2-4">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-2-5">-</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-3-0">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-3-1">-</td>
                        <td nowrap style="border-right:2px solid #ff8e35;" id="regional-3-2">-</td>
                        <td nowrap style="border-right:2px solid #ff8e35;" id="regional-3-3">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-3-4">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-3-5">-</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-4-0">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-4-1">-</td>
                        <td nowrap style="border-right:2px solid #ff8e35;" id="regional-4-2">-</td>
                        <td nowrap style="border-right:2px solid #ff8e35;" id="regional-4-3">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-4-4">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-4-5">-</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-5-0">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-5-1">-</td>
                        <td nowrap style="border-right:2px solid #ff8e35;" id="regional-5-2">-</td>
                        <td nowrap style="border-right:2px solid #ff8e35;" id="regional-5-3">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-5-4">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-5-5">-</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-6-0">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-6-1">-</td>
                        <td nowrap style="border-right:2px solid #ff8e35;" id="regional-6-2">-</td>
                        <td nowrap style="border-right:2px solid #ff8e35;" id="regional-6-3">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-6-4">-</td>
                        <td style="border-right:2px solid #ff8e35;" id="regional-6-5">-</td>
                    </tr>
                </table>
            </td>

        </tr>
        <tr>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" valign='top'>
                <i class="fa fa-cog"></i> AGENT ONLINE
                <div style="color:#fff;font-size:100px;text-align:center;" id="agent_online">-

                </div>
            </td>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" valign='top'>
                <i class="fa fa-cog">

                </i> APPROVE RATE
                <div style="color:#fff;font-size:100px;text-align:center;" id="approve_rate">-

                </div>
            </td>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" valign='top' colspan='2'>
            <i class="fa fa-cog">

                </i> REVENUE
                <div style="color:#fff;font-size:100px;text-align:right;margin-right:50px;" id="revenue_d">-

                </div>
                <div style="color:#a0bc2e;font-size:50px;text-align:right;margin-right:50px;" id="revenue_md">-

                </div>

            </td>
        </tr>
        <tr>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" colspan='2' valign="top">
                <i class="fa fa-cog"></i> GRAFIK APPROVE
                <br>
                <br>
                <div class="col-xl-12">
                    <div id="chard_data_ajax" style="min-width: 400px; height: 270px; margin: 0 auto"></div>
                    <div id="grafik_area"></div>
                </div>
            </td>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" valign="top">
                <i class="fa fa-cog"></i> Top Performer Site
                <br>
                <br>
                <div class="col-xl-12">
                    <div class="row row-cards" style="color:#fff;font-size:12px;">
                        <!--image 1-->
                        <div class="col-sm-4 col-lg-4" id="best_agent_area">
                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="best_agent_foto" style="width: 125px;height: 125px;background-image: url(http://localhost/infomedia_app/demo/faces/male/17-.jpg)"></span>
                                    <br>
                                    <span>Nama Agent</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 1-->

                        <!--image 2-->
                        <div class="col-sm-4 col-lg-4">
                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="best_tl_foto" style="width: 125px;height: 125px;background-image: url(http://localhost/infomedia_app/demo/faces/male/17-.jpg)"></span>
                                    <br>
                                    <span>Nama Agent</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 2-->

                        <!--image 3-->
                        <div class="col-sm-4 col-lg-4">

                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" style="width: 125px;height: 125px;background-image: url('<?php echo base_url() . "YbsService/get_foto_agent/" . $picture_leader_on_duty ?>')"></span>
                                    <br>
                                    <span>Nama Agent</span>
                                </div>
                            </div>
                        </div>
                        <!--end image 3-->

                    </div>
                </div>
                <br>
                <i class="fa fa-cog"></i> Low Performer Site
                <br>
                <div class="col-xl-12">
                    <div class="row row-cards" style="color:#fff;font-size:12px;">
                        <!--image 1-->
                        <div class="col-sm-4 col-lg-4" id="best_agent_area">
                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="best_agent_foto" style="width: 125px;height: 125px;background-image: url(http://localhost/infomedia_app/demo/faces/male/17-.jpg)"></span>
                                    <br>
                                    <span>Nama Agent</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 1-->

                        <!--image 2-->
                        <div class="col-sm-4 col-lg-4">
                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" id="best_tl_foto" style="width: 125px;height: 125px;background-image: url(http://localhost/infomedia_app/demo/faces/male/17-.jpg)"></span>
                                    <br>
                                    <span>Nama Agent</span>
                                </div>
                            </div>
                        </div>
                        <!-- end image 2-->

                        <!--image 3-->
                        <div class="col-sm-4 col-lg-4">

                            <div class="media">
                                <div class="media-body">
                                    <span class="avatar" style="width: 125px;height: 125px;background-image: url('<?php echo base_url() . "YbsService/get_foto_agent/" . $picture_leader_on_duty ?>')"></span>
                                    <br>
                                    <span>Nama Agent</span>
                                </div>
                            </div>
                        </div>
                        <!--end image 3-->

                    </div>
                </div>
            </td>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" valign="top">
                <i class="fa fa-cog"></i> PERFORMANCE SITE
                <br>
                <br>
                <div style="color:#fff;font-size:25px;text-align:center;">
                    <table width='100%'>
                        <tr style="font-size:20px;text-align:center;">
                            <th style="padding:5px;"></th>
                            <th style="padding:10px;border-right:2px solid #ff8e35;border-top:2px solid #ff8e35;">Upgrade</th>
                            <th style="padding:10px;border-right:2px solid #ff8e35;border-top:2px solid #ff8e35;">Minipack</th>
                            <th nowrap style="padding:10px;border-right:2px solid #ff8e35;border-top:2px solid #ff8e35;">2nd STB</th>
                            <th nowrap style="padding:10px;border-right:2px solid #ff8e35;border-top:2px solid #ff8e35;">Homewifi</th>
                            <th style="padding:10px;border-right:2px solid #ff8e35;border-top:2px solid #ff8e35;">2P3P</th>
                            <th style="padding:10px;border-right:2px solid #ff8e35;border-top:2px solid #ff8e35;">Indibox</th>
                        </tr>
                        <tr>
                            <td style="font-size:25px;text-align:right;">Citywalk</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-0-0">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-0-1">-</td>
                            <td nowrap style="border-right:2px solid #ff8e35;" id="site-0-2">-</td>
                            <td nowrap style="border-right:2px solid #ff8e35;" id="site-0-3">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-0-4">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-0-5">-</td>
                        </tr>
                        <tr>
                            <td style="font-size:25px;text-align:right;">BSD</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-1-0">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-1-1">-</td>
                            <td nowrap style="border-right:2px solid #ff8e35;" id="site-1-2">-</td>
                            <td nowrap style="border-right:2px solid #ff8e35;" id="site-1-3">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-1-4">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-1-5">-</td>
                        </tr>
                        <tr>
                            <td style="font-size:25px;text-align:right;">Medan</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-2-0">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-2-1">-</td>
                            <td nowrap style="border-right:2px solid #ff8e35;" id="site-2-2">-</td>
                            <td nowrap style="border-right:2px solid #ff8e35;" id="site-2-3">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-2-4">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-2-5">-</td>
                        </tr>
                        <tr>
                            <td style="font-size:25px;text-align:right;">Bandung</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-3-0">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-3-1">-</td>
                            <td nowrap style="border-right:2px solid #ff8e35;" id="site-3-2">-</td>
                            <td nowrap style="border-right:2px solid #ff8e35;" id="site-3-3">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-3-4">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-3-5">-</td>
                        </tr>
                        <tr>
                            <td style="font-size:25px;text-align:right;">Semarang</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-4-0">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-4-1">-</td>
                            <td nowrap style="border-right:2px solid #ff8e35;" id="site-4-2">-</td>
                            <td nowrap style="border-right:2px solid #ff8e35;" id="site-4-3">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-4-4">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-4-5">-</td>
                        </tr>
                        <tr>
                            <td style="font-size:25px;text-align:right;">Malang</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-5-0">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-5-1">-</td>
                            <td nowrap style="border-right:2px solid #ff8e35;" id="site-5-2">-</td>
                            <td nowrap style="border-right:2px solid #ff8e35;" id="site-5-3">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-5-4">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-5-5">-</td>
                        </tr>
                        <tr>
                            <td style="font-size:25px;text-align:right;">Makasar</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-6-0">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-6-1">-</td>
                            <td nowrap style="border-right:2px solid #ff8e35;" id="site-6-2">-</td>
                            <td nowrap style="border-right:2px solid #ff8e35;" id="site-6-3">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-6-4">-</td>
                            <td style="border-right:2px solid #ff8e35;" id="site-6-5">-</td>
                        </tr>


                    </table>
                </div>
            </td>
        </tr>
    </table>

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
        function get_daily() {
            var site=$("#site").val();
            $.ajax({
                url: "<?php echo base_url() . "api/Wallboard_tam/get_data_list?site=" ?>"+site,
                methode: "get",
                async: true,
                dataType: 'JSON',
                success: function(response) {
                    $("#data_consume").text(response.data_consume);
                    $("#contacted").text(response.contacted);
                    $("#contacted_rate").text(response.contacted_rate + "%");
                    $("#agree").text(response.agree);
                    $("#agree_rate").text(response.agree_rate + "%");
                    $("#agent_online").text(response.agent_online);
                    $("#approve").text(response.approve);
                    $("#approve_rate").text(response.approve_rate + "%");
                    $.each(response.bagi_approve, function(key, val) {
                        $("#approve-" + key).text(': ' + val);
                    });
                    get_regional();
                },
            });
        }

        function get_regional() {
            
            $.ajax({
                url: "<?php echo base_url() . "api/Wallboard_tam/get_data_regional" ?>",
                methode: "get",
                async: true,
                dataType: 'JSON',
                success: function(response) {
                    $.each(response.regional, function(key, val) {
                        $.each(val, function(key2, val2) {
                            $("#regional-" + key + "-" + key2).text(val2);
                        });


                    });
                    get_site();
                    // get_daily();

                },
            });
        }

        function get_site() {
            $.ajax({
                url: "<?php echo base_url() . "api/Wallboard_tam/get_data_site" ?>",
                methode: "get",
                async: true,
                dataType: 'JSON',
                success: function(response) {
                    $.each(response.site, function(key, val) {
                        $.each(val, function(key2, val2) {
                            $("#site-" + key + "-" + key2).text(val2);
                        });


                    });

                    // get_grafik();
                },
            });
        }

        function get_grafik() {
            var site=$("#site").val();
            $.ajax({
                url: "<?php echo base_url() . "api/Wallboard_tam/get_data_grafik?site=" ?>"+site,
                methode: "get",
                dataType: 'JSON',
                success: function(response) {
                    $.each(response.grafik, function(key, val) {
                        chart.addSeries({
                            name: key,
                            data: val
                        });
                    });
                    // get_daily();
                }
            });
        }

        function get_revenue() {
            var site=$("#site").val();
            $.ajax({
                url: "<?php echo base_url() . "api/Wallboard_tam/get_revenue?site=" ?>"+site,
                methode: "get",
                dataType: 'JSON',
                success: function(response) {
                    $("#revenue_md").text(response.revenue_md);
                    $("#revenue_d").text(response.revenue_d);
                }
            });
        }
        $(document).ready(function() {
            get_daily();
            get_revenue();
            get_grafik();
            $("#site").on("change",function(){
                window.location.href = '<?php echo base_url();?>dashboard/wallboard_reguler_v2?site='+$(this).val();
            });

        });
    </script>
</body>

</html>