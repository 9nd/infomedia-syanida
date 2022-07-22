<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->

<?php echo _css('icheck,chartjs,selectize,multiselect') ?>
<div class='col-md-12 col-xl-12'>
	<div class="card">
		<div class="card-status bg-green"></div>
		<div class="card-header">
			<h3 class="card-title">FILTER
			</h3>
			<div class="card-options">
				<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
				<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
			</div>
		</div>
		<div class="card-body">
			<div class='box-body' id='box-table'>

				<form id='form-a' methode="GET">

					<div class='col-md-6 col-xl-6'>
						<div class='form-group'>
							<label class='form-label'>Search</label>
							<table>
								<tr>
									<td></td>
									<td></td>
								</tr>
							</table>Tahun<input type='text' min="" placeholder="2020" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='tahun' name='tahun' value='<?php if (isset($_GET['tahun'])) echo $_GET['tahun'] ?>'>
							Bulan<input type='text' min="" placeholder="07" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='bulan' name='bulan' value='<?php if (isset($_GET['bulan'])) echo $_GET['bulan'] ?>'>
							Peak<input type='text' min="" placeholder="01" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='peak' name='peak' value='<?php if (isset($_GET['peak'])) echo $_GET['peak'] ?>'>
						</div>
					</div>

					<div class='col-md-6 col-xl-6'>
						<div class='form-group'>
							<label class='form-label'>Agent </label>
							<select name='agentid[]' id="agentid" class="form-control custom-select" multiple="multiple">
								<?php
								if ($user_categori != 8) {
								?>
									<option value="0">--Semua Agent--</option>
								<?php
								}
								if ($list_agent['num'] > 0) {
									foreach ($list_agent['results'] as $d_agent) {
										$selected = "";
										if (isset($_GET['agentid'])) {

											if (count($_GET['agentid']) > 1) {

												foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
													if ($v_agentid == $d_agent->agentid) {
														$selected = 'selected';
													}
												}
											} else {
												$selected = ($d_agent->agentid == $_GET['agentid'][0]) ? 'selected' : '';
											}
										}
										echo "<option value='" . $d_agent->agentid . "' " . $selected . ">" . $d_agent->agentid . "-" . $d_agent->nama . "</option>";
									}
								}
								?>

							</select>
						</div>
					</div>


					<div class='col-md-12 col-xl-12'>

						<div class='form-group'>
							<button id='btn-save' type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Search</button>
						</div>

					</div>
				</form>

			</div>
		</div>


	</div>
</div>
<?php



if (isset($_GET['tahun']) && isset($_GET['bulan']) && isset($_GET['peak'])) {

?>

	<div class='col-md-12 col-xl-12'>
		<div class="card">
			<div class="card-status bg-orange"></div>
			<div class="card-header">
				<h3 class="card-title">Report QC Periode

				</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<table width="100%">
					<tr>
						<td width="50%">

						</td>
						<td width="50%">

						</td>
					</tr>
				</table>


				<div class='box-body' id=''>
					<small>
						<table class='' border=1 width="100%" id="report_table_reg">
							<thead>
								<tr style="background-color: red; color: white;" align="center">
									<th rowspan=2><b>No</b></th>
									<th rowspan=2><b>Kategori</b></th>
									<th rowspan=2><b>Parameter</b></th>
									<th rowspan=2><b>Bobot</b></th>
									<th nowrap colspan=3><b>Jumlah Sample</b></th>
									<th colspan=2><b>Persentase</b></th>
									<th rowspan=2><b>Pencapaian</b></th>
								</tr>
								<tr style="background-color: red; color: white;" align="center">
									<th nowrap>Nilai 1</th>
									<th nowrap>Nilai 0</th>
									<th>Total</th>
									<th nowrap>Nilai 1</th>
									<th nowrap>Nilai 0</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$n = 0;
								if ($qm_score_parameter['num'] > 0) {
									foreach ($qm_score_parameter_1['results'] as $param_1) {
										$n++;
										// $sub_total['bobot'][1]['sum'] = $sub_total['bobot'][1]['sum'] + $param_1->bobot;
										// $sub_total['bobot'][1][1] = $sub_total['bobot'][1][1] + [$param_1->id][1];
										// $sub_total['bobot'][1][0] = intval($sub_total['bobot'][1][0]) + intval($total[$param_1->id][0]);

										$sub_total['bobot'][1]['sum'] = $sub_total['bobot'][1]['sum'] + $param_1->bobot;
										$sub_total['bobot'][1][1] = $sub_total['bobot'][1][1] + $total[$param_1->id][1];
										$sub_total['bobot'][1][0] = $sub_total['bobot'][1][0] + $total[$param_1->id][0];
										echo "<tr>";
										echo "<td>" . $n . "</td>";
										if ($n == 1) {
											echo "<td rowspan='6' valign='center'>Phone and Communication Skill</td>";
										} else {
											// echo "<td></td>";
										}
										$persen1 = (intval($total[$param_1->id][1]) / (intval($total[$param_1->id][1]) + intval($total[$param_1->id][0]))) * 100;
										$persen2 = (intval($total[$param_1->id][0]) / (intval($total[$param_1->id][1]) + intval($total[$param_1->id][0]))) * 100;
										$totl = intval($total[$param_1->id][1]) + intval($total[$param_1->id][0]);
										echo "<td>" . $param_1->keterangan . "</td>";
										echo "<td>" . $param_1->bobot . "%</td>";
										echo "<td>" . intval($total[$param_1->id][1]) . "</td>";
										echo "<td>" . intval($total[$param_1->id][0]) . "</td>";
										echo "<td>" . $totl . "</td>";
										echo "<td>" . $persen1 . "%</td>";
										echo "<td>" . $persen2 . "%</td>";
										echo "<td>" . (intval($param_1->bobot) * intval($total[$param_1->id][1])) / (intval($total[$param_1->id][1]) + intval($total[$param_1->id][0])) . "%</td>";
										echo "</tr>";
									}
									$persen_sub_1 = ($sub_total['bobot'][1][1] / ($sub_total['bobot'][1][1] + $sub_total['bobot'][1][0])) * 100;
									$persen_sub_2 = ($sub_total['bobot'][1][0] / ($sub_total['bobot'][1][1] + $sub_total['bobot'][1][0])) * 100;
									$totl_sub_1 = $sub_total['bobot'][1][1] + $sub_total['bobot'][1][0];
									echo "<tr style='background-color: #d9e0e7; font-weight: bold;' align='right'>";
									echo "	<td colspan='3'>Sub Total</td>";
									echo "	<td>" . $sub_total['bobot'][1]['sum'] . "%</td>";
									echo "	<td>" . $sub_total['bobot'][1][1] . "</td>";
									echo "	<td>" . $sub_total['bobot'][1][0] . "</td>";
									echo "	<td>" . $totl_sub_1 . "</td>";
									echo "	<td>" . round($persen_sub_1) . "%</td>";
									echo "	<td>" . round($persen_sub_2) . "%</td>";
									echo "	<td>" . round(($sub_total['bobot'][1]['sum'] * $sub_total['bobot'][1][1]) / ($sub_total['bobot'][1][1] + $sub_total['bobot'][1][0])) . "%</td>";
									echo "</tr>";

									foreach ($qm_score_parameter_2['results'] as $param_2) {
										$n++;
										$sub_total['bobot'][2]['sum'] = $sub_total['bobot'][2]['sum'] + $param_2->bobot;
										$sub_total['bobot'][2][1] = $sub_total['bobot'][2][1] + $total[$param_2->id][1];
										$sub_total['bobot'][2][0] = $sub_total['bobot'][2][0] + $total[$param_2->id][0];
										echo "<tr>";
										echo "<td>" . $n . "</td>";
										if ($n == 7) {
											echo "<td rowspan='5' valign='center'>Validation</td>";
										} else {
											// echo "<td></td>";
										}
										$subtot1 =  $total[$param_2->id][0] + $total[$param_2->id][1];

										echo "<td>" . $param_2->keterangan . "</td>";
										echo "<td>" . $param_2->bobot . "%</td>";
										echo "<td>" . $total[$param_2->id][1] . "</td>";
										echo "<td>" . $total[$param_2->id][0] . "</td>";
										echo "<td>" . $subtot1 . "</td>";
										echo "<td>" . (($total[$param_2->id][1] / ($total[$param_2->id][1] + $total[$param_2->id][0])) * 100) . "%</td>";
										echo "<td>" . (($total[$param_2->id][1] / ($total[$param_2->id][0] + $total[$param_2->id][0])) * 100) . "%</td>";
										echo "<td>" . ($param_2->bobot * $total[$param_2->id][1]) / ($total[$param_2->id][1] + $total[$param_2->id][0]) . "%</td>";
										echo "</tr>";
									}
									$subtot2 = $sub_total['bobot'][2][1] + $sub_total['bobot'][2][0];
									echo "<tr style='background-color: #d9e0e7; font-weight: bold;' align='right'>";
									echo "	<td colspan='3'>Sub Total</td>";
									echo "	<td>" . $sub_total['bobot'][2]['sum'] . "%</td>";
									echo "	<td>" . $sub_total['bobot'][2][1] . "</td>";
									echo "	<td>" . $sub_total['bobot'][2][0] . "</td>";
									echo "	<td>" . $subtot2 . "</td>";
									echo "	<td>" . (($sub_total['bobot'][2][1] / ($sub_total['bobot'][2][1] + $sub_total['bobot'][2][0])) * 100) . "%</td>";
									echo "	<td>" . (($sub_total['bobot'][2][0] / ($sub_total['bobot'][2][1] + $sub_total['bobot'][2][0])) * 100) . "%</td>";
									echo "	<td>" . ($sub_total['bobot'][2]['sum'] * $sub_total['bobot'][2][1]) / ($sub_total['bobot'][2][1] + $sub_total['bobot'][2][0]) . "%</td>";
									echo "</tr>";

									foreach ($qm_score_parameter_3['results'] as $param_3) {
										$n++;
										$sub_total['bobot'][3]['sum'] = $sub_total['bobot'][3]['sum'] + $param_3->bobot;
										$sub_total['bobot'][3][1] = $sub_total['bobot'][3][1] + $total[$param_3->id][1];
										$sub_total['bobot'][3][0] = $sub_total['bobot'][3][0] + $total[$param_3->id][0];
										echo "<tr>";
										echo "<td>" . $n . "</td>";
										if ($n == 12) {
											echo "<td rowspan='2' valign='center'>Documentation & Information</td>";
										} else {
											// echo "<td></td>";
										}
										$subtot3 = $total[$param_3->id][1] + $total[$param_3->id][0];
										echo "<td>" . $param_3->keterangan . "</td>";
										echo "<td>" . $param_3->bobot . "%</td>";
										echo "<td>" . $total[$param_3->id][1] . "</td>";
										echo "<td>" . $total[$param_3->id][0] . "</td>";
										echo "<td>" . $subtot3 . "</td>";
										echo "<td>" . (($total[$param_3->id][1] / ($total[$param_3->id][1] + $total[$param_3->id][0])) * 100) . "%</td>";
										echo "<td>" . (($total[$param_3->id][1] / ($total[$param_3->id][0] + $total[$param_3->id][0])) * 100) . "%</td>";
										echo "<td>" . ($param_3->bobot * $total[$param_3->id][1]) / ($total[$param_3->id][1] + $total[$param_3->id][0]) . "%</td>";
										echo "</tr>";
									}


									$subtot3 = $sub_total['bobot'][3][1] + $sub_total['bobot'][3][0];
									echo "<tr style='background-color: #d9e0e7; font-weight: bold;' align='right'>";
									echo "	<td colspan='3'>Sub Total</td>";
									echo "	<td>" . $sub_total['bobot'][3]['sum'] . "%</td>";
									echo "	<td>" . $sub_total['bobot'][3][1] . "</td>";
									echo "	<td>" . $sub_total['bobot'][3][0] . "</td>";
									echo "	<td>" . $subtot3 . "</td>";
									echo "	<td>" . (($sub_total['bobot'][3][1] / ($sub_total['bobot'][3][1] + $sub_total['bobot'][3][0])) * 100) . "%</td>";
									echo "	<td>" . (($sub_total['bobot'][3][0] / ($sub_total['bobot'][3][1] + $sub_total['bobot'][3][0])) * 100) . "%</td>";
									echo "	<td>" . ($sub_total['bobot'][3]['sum'] * $sub_total['bobot'][3][1]) / ($sub_total['bobot'][3][1] + $sub_total['bobot'][3][0]) . "%</td>";
									echo "</tr>";
								}
								?>


							</tbody>
							<tfoot>
								<tr>
									<th colspan="3" style="text-align:right;">GRAND TOTAL</th>
									<?php
									$total_bobot = $sub_total['bobot'][1]['sum'] + $sub_total['bobot'][2]['sum'] + $sub_total['bobot'][3]['sum'];
									$total_1 = $sub_total['bobot'][1][1] + $sub_total['bobot'][2][1] + $sub_total['bobot'][3][1];
									$total_0 = $sub_total['bobot'][1][0] + $sub_total['bobot'][2][0] + $sub_total['bobot'][3][0];
									$total_0_1 = $total_0 + $total_1;
									$tot1pers = ($total_1 / $total_0_1) * 100;
									$tot0pers = ($total_0 / $total_0_1) * 100;
									$totfinal1 = round(($sub_total['bobot'][1]['sum'] * $sub_total['bobot'][1][1]) / ($sub_total['bobot'][1][1] + $sub_total['bobot'][1][0]));
									$totfinal2 = ($sub_total['bobot'][2]['sum'] * $sub_total['bobot'][2][1]) / ($sub_total['bobot'][2][1] + $sub_total['bobot'][2][0]);
									$totfinal3 = ($sub_total['bobot'][3]['sum'] * $sub_total['bobot'][3][1]) / ($sub_total['bobot'][3][1] + $sub_total['bobot'][3][0]);
									$totalfinalall = $totfinal1 + $totfinal2 + $totfinal3;

									echo "<td>" . $total_bobot . "%</td>";
									echo "<td>" . $total_1 . "</td>";
									echo "<td>" . $total_0 . "</td>";
									echo "<td>" . $total_0_1 . "</td>";
									echo "<td>" . round($tot1pers) . "%</td>";
									echo "<td>" . round($tot0pers) . "%</td>";
									echo "<td>" . $totalfinalall . "%</td>";
									?>
								</tr>
							</tfoot>
						</table>
					</small>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-lte">
			<div class="panel-heading lte-heading-success">Tabel data</div>
			<div class="panel-body">
				<table width="100%" border=1>
					<tr align="center" style="background-color: red; color: white;">
						<td>No</td>
						<td>Kategori</td>
						<td>Target</td>
						<td>Pencapaian</td>
						<td>%Pencapaian</td>
					</tr>
					<tr align="center">
						<td>1</td>
						<td>Phone and Communication Skill</td>
						<td><?php
							echo $sub_total['bobot'][1]['sum']
							?></td>
						<td><?php
							echo $totfinal1
							?></td>
						<td><?php echo round((($sub_total['bobot'][1][1] / ($sub_total['bobot'][1][1] + $sub_total['bobot'][1][0])) * 100), 2) ?>%</td>
					</tr>
					<tr align="center">
						<td>2</td>
						<td>Validation</td>
						<td><?php
							echo $sub_total['bobot'][2]['sum']
							?></td>
						<td><?php
							echo $totfinal2
							?></td>
						<td><?php echo round((($sub_total['bobot'][2][1] / ($sub_total['bobot'][2][1] + $sub_total['bobot'][2][0])) * 100), 2) ?>%</td>
					</tr>
					<tr align="center">
						<td>3</td>
						<td>Documentation & Information</td>
						<td><?php
							echo $sub_total['bobot'][3]['sum']
							?></td>
						<td><?php
							echo $totfinal3
							?></td>
						<td><?php echo round((($sub_total['bobot'][3][1] / ($sub_total['bobot'][3][1] + $sub_total['bobot'][3][0])) * 100), 2) ?>%</td>
					</tr>
					<tr style="background-color: red; color: white;">
						<td colspan="2" align="right">Qm Score</td>
						<td><?php echo $total_bobot ?></td>
						<td><?php echo $totalfinalall ?></td>
						<td><?php echo $totfinal1 + $totfinal2 + $totfinal3 ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-lte">
			<div class="panel-heading lte-heading-success">Bar Chart QM Score </div>
			<div class="panel-body">
				<canvas id="barChart" style="height:230px; min-height:230px"></canvas>
			</div>
		</div>
	</div>

<?php
}

?>

<!-- load library selectize -->
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->

<?php echo _js('ybs,selectize,chartjs,icheck,multiselect') ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#agentid').selectize({});
		// $("#report_table_reg").DataTable({
		// 	dom: 'Bfrtip',
		// 	buttons: [
		// 		'copy', 'csv', 'excel', 'pdf'
		// 	]
		// });
	});
</script>
<script>
	//---bar chart---// 
	var areaChartData = {
		labels: [
			['Phone and', 'Communication', 'Skill'], 'Validation', ['Documentation &', 'Information']
		],
		datasets: [{
				label: 'Pencapaian',
				backgroundColor: '#d82a2a',
				borderColor: '#d82a2a',
				pointRadius: false,
				pointColor: 'rgba(210, 214, 222, 1)',
				pointStrokeColor: '#c1c7d1',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(220,220,220,1)',
				data: [<?php
						echo $totfinal1
						?>, <?php
					echo $totfinal2
					?>, <?php
					echo $totfinal3
					?>]
			},
			{
				label: 'Target',
				backgroundColor: 'rgba(60,141,188,0.9)',
				borderColor: 'rgba(60,141,188,0.8)',
				pointRadius: false,
				pointColor: '#3b8bba',
				pointStrokeColor: 'rgba(60,141,188,1)',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(60,141,188,1)',
				data: [<?php
						echo $sub_total['bobot'][1]['sum']
						?>, <?php
					echo $sub_total['bobot'][2]['sum']
					?>, <?php
					echo $sub_total['bobot'][3]['sum']
					?>]
			},
		]
	}

	var barChartCanvas = $('#barChart').get(0).getContext('2d')
	var barChartData = jQuery.extend(true, {}, areaChartData)
	var temp0 = areaChartData.datasets[0]
	var temp1 = areaChartData.datasets[1]
	barChartData.datasets[0] = temp1
	barChartData.datasets[1] = temp0
	Chart.defaults.global.defaultFontColor = 'black';

	var barChartOptions = {
		
		responsive: true,
		maintainAspectRatio: false,
		datasetFill: false,
		animation: {
			onComplete: function() {
				var chartInstance = this.chart,
					ctx = chartInstance.ctx;

				ctx.textAlign = 'center';
				ctx.textBaseline = 'bottom';

				this.data.datasets.forEach(function(dataset, i) {
					var meta = chartInstance.controller.getDatasetMeta(i);
					meta.data.forEach(function(bar, index) {
						
						var data = dataset.data[index];
						ctx.fillText(data, bar._model.x, bar._model.y - -15);
					});
				});
			}
		}
	}

	var barChart = new Chart(barChartCanvas, {
		type: 'bar',
		data: barChartData,
		options: barChartOptions
	})
</script>