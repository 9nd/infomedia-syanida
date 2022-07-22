<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="refresh" content="300">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">

    <title>Profiling - GRAFIK</title>
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
                <h1>PROFILING PERFORMANCE GRAFIK</h1>

            </td>
            <td width="33%" style="text-align:right;">
                <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">

            </td>

        </tr>
    </table>
    <table  width="100%">
        <tr>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" valign="top">
                <i class="fa fa-cog"></i> GRAFIK VERIFIED REGULER
                <br>
                <br>
                <div class="col-xl-12">
                    <div id="chard_data_ajax" style="min-width: 800px; height: 400px; margin: 0 auto"></div>
                    <div id="grafik_area"></div>
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
      
        function get_grafik() {
            var start = $("#start").val();
            var end = $("#end").val();
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard_v2/get_grafik_verified_custom" ?>",
                methode: "get",
                data: {
                    start: start,
                    end: end
                },
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

        $(document).ready(function() {

            get_grafik();
        });
    </script>
</body>

</html>