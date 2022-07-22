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

	<title>TELKOM - WALLBOARD</title>
	<script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>

	<script src="<?php echo base_url() ?>assets/js/bundle.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-knob/jquery.knob.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets/js/style-highcharts.js"></script>

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/grafik/skillbar/jquery.barCharts.css">
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
	var chart2;
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
		chart2 = new Highcharts.Chart({
			chart: {
				renderTo: 'chard_data_ajax2',
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

<body style="background-color:#202938;color:#efeef0; font-family:Arial, Helvetica, sans-serif;">
<table width="100%">
        <tr>
            <td width="33%">
                <!-- <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px"> -->
                <br>
                <form method="GET" action="#">
                    From <input type="date" name="start" id="start" value="<?php echo $start; ?>"> To <input type="date" name="end" id="end" value="<?php echo $end; ?>"><button type="submit" id="filter"><i class="fa fa-search"></i></button><br>
                </form>

            </td>
            <td width="34%" style="text-align:center;">
                <h2>WALLBOARD</h2>

            </td>
            <td width="33%" style="text-align:right;">
                <!-- <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px"> -->

            </td>

        </tr>
    </table>
	<table width='100%'>
		<tr style='text-align:center;'>
			<td colspan='3'><i class="fa fa-cog"></i> KUADRAN</td>
			<td><i class="fa fa-cog"></i> TOTAL KUADRAN</td>
			<td><i class="fa fa-cog"></i> CONSUME</td>
		</tr>
		<tr>

			<td width='15%'>
				<table width="100%" style="text-align:center;">
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:20px;border-bottom:2px solid green;" valign="bottom">TOTAL KW 1</td>
						<td style="text-align:right;font-size: 25px;color:green;border-bottom:2px solid green;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid green;" valign="bottom">Verified</td>
						<td style="text-align:right;font-size: 25px;color:green;border-bottom:2px solid green;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid green;" valign="bottom">% Verified</td>
						<td style="text-align:right;font-size: 25px;color:green;border-bottom:2px solid green;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid green;" valign="bottom">HP ONLY</td>
						<td style="text-align:right;font-size: 25px;color:green;border-bottom:2px solid green;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid green;" valign="bottom">EMAIL ONLY</td>
						<td style="text-align:right;font-size: 25px;color:green;border-bottom:2px solid green;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid green;" valign="bottom">HP & EMAIL</td>
						<td style="text-align:right;font-size: 25px;color:green;border-bottom:2px solid green;" valign="bottom" id="connected_reguler">-</td>
					</tr>
				</table>
			</td>
			<td rowspan='3' width='20%'>
				<div id="donut-chart" style="width:400px;height: 400px;"></div>
			</td>
			<td width='15%'>
				<table width="100%" style="text-align:center;">
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:20px;border-bottom:2px solid #ce2f4f;" valign="bottom">TOTAL KW 2</td>
						<td style="text-align:right;font-size: 25px;color:#ce2f4f;border-bottom:2px solid #ce2f4f;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid #ce2f4f;" valign="bottom">Verified</td>
						<td style="text-align:right;font-size: 25px;color:#ce2f4f;border-bottom:2px solid #ce2f4f;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid #ce2f4f;" valign="bottom">% Verified</td>
						<td style="text-align:right;font-size: 25px;color:#ce2f4f;border-bottom:2px solid #ce2f4f;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid #ce2f4f;" valign="bottom">HP ONLY</td>
						<td style="text-align:right;font-size: 25px;color:#ce2f4f;border-bottom:2px solid #ce2f4f;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid #ce2f4f;" valign="bottom">EMAIL ONLY</td>
						<td style="text-align:right;font-size: 25px;color:#ce2f4f;border-bottom:2px solid #ce2f4f;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid #ce2f4f;" valign="bottom">HP & EMAIL</td>
						<td style="text-align:right;font-size: 25px;color:#ce2f4f;border-bottom:2px solid #ce2f4f;" valign="bottom" id="connected_reguler">-</td>
					</tr>

				</table>
			</td>
			<td style="color:#ce2f4f;font-size:150px;text-align:center;" valign='top' id="wo">
				-
			</td>
			<td style="color:#ce2f4f;font-size:150px;text-align:center;" valign='top' id="wo">
				-
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td style="text-align:center;"><i class="fa fa-cog"></i> VERIFIED</td>
			<td style="text-align:center;"><i class="fa fa-cog"></i> VERIFIED</td>
		</tr>
		<tr>
			<td>
				<table width="100%" style="text-align:center;">
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:20px;border-bottom:2px solid #ff8e35;" valign="bottom">TOTAL KW 3</td>
						<td style="text-align:right;font-size: 25px;color:#ff8e35;border-bottom:2px solid #ff8e35;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid #ff8e35;" valign="bottom">Verified</td>
						<td style="text-align:right;font-size: 25px;color:#ff8e35;border-bottom:2px solid #ff8e35;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid #ff8e35;" valign="bottom">% Verified</td>
						<td style="text-align:right;font-size: 25px;color:#ff8e35;border-bottom:2px solid #ff8e35;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid #ff8e35;" valign="bottom">HP ONLY</td>
						<td style="text-align:right;font-size: 25px;color:#ff8e35;border-bottom:2px solid #ff8e35;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid #ff8e35;" valign="bottom">EMAIL ONLY</td>
						<td style="text-align:right;font-size: 25px;color:#ff8e35;border-bottom:2px solid #ff8e35;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid #ff8e35;" valign="bottom">HP & EMAIL</td>
						<td style="text-align:right;font-size: 25px;color:#ff8e35;border-bottom:2px solid #ff8e35;" valign="bottom" id="connected_reguler">-</td>
					</tr>

				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center;">
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:20px;border-bottom:2px solid blue;" valign="bottom">TOTAL KW 4</td>
						<td style="text-align:right;font-size: 25px;color:blue;border-bottom:2px solid blue;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid blue;" valign="bottom">Verified</td>
						<td style="text-align:right;font-size: 25px;color:blue;border-bottom:2px solid blue;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid blue;" valign="bottom">% Verified</td>
						<td style="text-align:right;font-size: 25px;color:blue;border-bottom:2px solid blue;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid blue;" valign="bottom">HP ONLY</td>
						<td style="text-align:right;font-size: 25px;color:blue;border-bottom:2px solid blue;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid blue;" valign="bottom">EMAIL ONLY</td>
						<td style="text-align:right;font-size: 25px;color:blue;border-bottom:2px solid blue;" valign="bottom" id="connected_reguler">-</td>
					</tr>
					<tr>
						<td style="text-align:left;color:#a3a8ac;font-size:15px;border-bottom:2px solid blue;" valign="bottom">HP & EMAIL</td>
						<td style="text-align:right;font-size: 25px;color:blue;border-bottom:2px solid blue;" valign="bottom" id="connected_reguler">-</td>
					</tr>

				</table>
			</td>
			<td style="color:#ce2f4f;font-size:150px;text-align:center;" valign='top' id="wo">
				-
			</td>
			<td style="color:#ce2f4f;font-size:150px;text-align:center;" valign='top' id="wo">
				-
			</td>
		</tr>

	</table>
	<table width='100%' style="text-align:center;">
		<tr>
			<td width='34%' valign="top">
				<i class="fa fa-cog"></i> GRAFIK VERIFIED
				<br>
				<br>
				<div class="col-xl-12">
					<div id="chard_data_ajax" style="min-width: 400px; height: 270px; margin: 0 auto"></div>
					<div id="grafik_area"></div>
				</div>
			</td>
			<td width='33%' valign="top">
				<i class="fa fa-cog"></i> SUMBER
				<br>
				<br>
				<div class="barChart">
					<div class="barChart__row" data-value="70">
						<span class="barChart__label">MYCX</span>
						<span class="barChart__value">70</span>
						<span class="barChart__bar"><span class="barChart__barFill"></span></span>
					</div>
					<div class="barChart__row" data-value="90">
						<span class="barChart__label">INF</span>
						<span class="barChart__value">80</span>
						<span class="barChart__bar"><span class="barChart__barFill"></span></span>
					</div>
					<div class="barChart__row" data-value="60">
						<span class="barChart__label">IDEAS</span>
						<span class="barChart__value">60</span>
						<span class="barChart__bar"><span class="barChart__barFill"></span></span>
					</div>
					<div class="barChart__row" data-value="50">
						<span class="barChart__label">INDIHM</span>
						<span class="barChart__value">50</span>
						<span class="barChart__bar"><span class="barChart__barFill"></span></span>
					</div>
					<div class="barChart__row" data-value="90">
						<span class="barChart__label">INF</span>
						<span class="barChart__value">80</span>
						<span class="barChart__bar"><span class="barChart__barFill"></span></span>
					</div>
					<div class="barChart__row" data-value="60">
						<span class="barChart__label">IDEAS</span>
						<span class="barChart__value">60</span>
						<span class="barChart__bar"><span class="barChart__barFill"></span></span>
					</div>
					<div class="barChart__row" data-value="50">
						<span class="barChart__label">INDIHM</span>
						<span class="barChart__value">50</span>
						<span class="barChart__bar"><span class="barChart__barFill"></span></span>
					</div>

				</div>
			</td>
			<td width='33%' valign="top">
				<i class="fa fa-cog"></i> REGIONAL
				<br>
				<br>
				<div class="col-xl-12">
					<div id="chard_data_ajax2" style="min-width: 400px; height: 270px; margin: 0 auto"></div>
					<div id="grafik_area2"></div>
				</div>
			</td>
		</tr>
	</table>
</body>
<!-- FLOT CHARTS -->
<script src="<?php echo base_url() ?>assets/js/plugins/bower_components/Flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?php echo base_url() ?>assets/js/plugins/bower_components/Flot/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?php echo base_url() ?>assets/js/plugins/bower_components/Flot/jquery.flot.pie.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?php echo base_url() ?>assets/js/plugins/bower_components/Flot/jquery.flot.categories.js"></script>

<script src="<?php echo base_url() ?>assets/grafik/skillbar/jquery.barChart.js"></script>
<script src="<?php echo base_url() ?>assets/grafik/skillbar/jquery.easing.min.js"></script>
<script>
	/*
	 * DONUT CHART
	 * -----------
	 */
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
	var donutData = [{
			label: 'KW 2',
			data: 30,
			color: '#ce2f4f'
		},
		{
			label: 'KW 4',
			data: 20,
			color: 'blue'
		},
		{
			label: 'KW 3',
			data: 25,
			color: '#ff8e35'
		},
		{
			label: 'KW 1',
			data: 25,
			color: 'green'
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

	$('.barChart').barChart({
		easing: 'easeOutQuart'
	});

	function get_grafik() {
		var start = $("#start").val();
		var end = $("#end").val();
		$.ajax({
			url: "<?php echo base_url() . "api/Dashboard_v2/get_grafik_verified" ?>",
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

	function get_grafik2() {
		var start = $("#start").val();
		var end = $("#end").val();
		$.ajax({
			url: "<?php echo base_url() . "api/Dashboard_v2/get_grafik_verified" ?>",
			methode: "get",
			data: {
				start: start,
				end: end
			},
			dataType: 'JSON',
			success: function(response) {
				$.each(response.data, function(key, val) {
					chart2.addSeries({
						name: key,
						data: val
					});
				});
			}
		});
	}
	$(document).ready(function() {

		get_grafik();
		get_grafik2();
	});
</script>

</html>