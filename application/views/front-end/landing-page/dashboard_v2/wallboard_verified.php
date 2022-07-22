<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    if ($start == $end) {
    ?>
        <meta http-equiv="refresh" content="300">
    <?php
    }
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">

    <title>Profiling - WALLBOARD VERIFIED</title>
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


<!-- <body style="background-color:#202938;color:#efeef0; font-family:'Open Sans',Helvetica,Arial,sans-serif;"> -->
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "GRAFIK VERIFIED PERIODE <?php echo $start;?> - <?php echo $end;?>"
	},	
	axisY: {
		title: "VERIFIED",
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC"
	},
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "Reguler",
		legendText: "Reguler",
		showInLegend: true, 
		dataPoints:[
            <?php
            $total_reg=0;
                if(count($reg) > 0){
                    foreach($reg as $d_r){
                        $total_reg=$total_reg+$d_r['jumlah'];
                        echo '{ label: "'.$d_r['day_lup'].'", y: '.$d_r['jumlah'].' },';
                    }
                }
                ?>
		]
	},{
		type: "column",
		name: "MOSS",
		legendText: "MOSS",
		showInLegend: true, 
		dataPoints:[
			<?php
            $total_moss=0;
                if(count($moss) > 0){
                    foreach($moss as $d_r){
                        $total_moss=$total_moss+$d_r['jumlah'];
                        echo '{ label: "'.$d_r['day_lup'].'", y: '.$d_r['jumlah'].' },';
                    }
                }
                ?>
		]
	},
	]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

}
</script>
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
                <h1>PROFILING WALLBOARD VERIFIED</h1>
            </td>
            <td width="33%" style="text-align:right;">
                <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">

            </td>

        </tr>
    </table>
    <table width="100%">
        <tr>

            <td style="color:#a3a8ac;font-size:25px;text-align:center;" width="50%"><i class="fa fa-cog"></i> VERIFIED REGULER</td>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" width="50%"><i class="fa fa-cog"></i> VERIFIED MOSS</td>
        </tr>
        <tr>
            <td style="color:#a0bc2e;font-size:150px;text-align:center;" id="verified_mos"><?php echo number_format($total_reg); ?></td>
            <td style="color:#a0bc2e;font-size:150px;text-align:center;" id="verified_mos"><?php echo number_format($total_moss); ?></td>
        </tr>

    </table>
    <center><div id="chartContainer" style="height: 600px; width: 90%;"></div></center>
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
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>

</html>