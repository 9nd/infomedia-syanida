<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->

<?php echo _css('datatables,icheck,selectize,multiselect') ?>
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
							<label class='form-label'>Mulai Dari</label>
							<input type='date' min="" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='id_reason' name='start' value='<?php if (isset($_GET['start'])) echo $_GET['start'] ?>'>
						</div>
					</div>
					<div class='col-md-6 col-xl-6'>
						<div class='form-group'>
							<label class='form-label'>Sampai </label>
							<input type='date' min="<?php echo date("Y-m-d", strtotime("-" . (date('d') + 15) . " days")); ?>" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='id_reason' name='end' value='<?php if (isset($_GET['end'])) echo $_GET['end'] ?>'>
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

if (isset($_GET['start']) && isset($_GET['end'])) {
?>

	<div class='col-md-12 col-xl-12'>
		<div class="card">
			<div class="card-status bg-orange"></div>
			<div class="card-header">
				<h3 class="card-title">Report Efektifitas Periode <?php echo $_GET['start'] . " sd " . $_GET['end'] ?>

				</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div class='box-body table-responsive' id='box-table'>
					<small>
						<table class='table' id="report_table_reg">
							<thead>
								<tr>
									<th><b>No</b></th>
									<th nowrap><b>Nama Agent</b></th>
									<th nowrap><b>ID</b></th>
									<th nowrap><b>Dial</b></th>
									<th nowrap><b>Durasi</b></th>
									<th nowrap><b>HK</b></th>
									<th nowrap><b>Dial/D</b></th>
									<th nowrap><b>Durasi/D</b></th>
									<th nowrap><b>Contacted</b></th>
									<th nowrap><b>Break</b></th>
									<th nowrap><b>Pray</b></th>
									<th nowrap><b>Toilet</b></th>
									<th nowrap><b>handsup</b></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								if ($list_agent['num'] > 0) {

									foreach ($list_agent['results'] as $ag) {
										$seconds = $recording['recording'][$ag->agentid]['durasina'];
										$seconds_break_ = $aux['all_status'][$ag->agentid]['Break_'];
										$seconds_pray_ = $aux['all_status'][$ag->agentid]['Pray_'];
										$seconds_toilet_ = $aux['all_status'][$ag->agentid]['Toilet_'];
										$seconds_handsup_ = $aux['all_status'][$ag->agentid]['Handsup_'];


										$seconds_day = $recording['recording'][$ag->agentid]['durasina'] / $recording['nod'][$ag->agentid]['datena'];
										$hours = floor($seconds / 3600);
										$mins = floor($seconds / 60 % 60);
										$secs = floor($seconds % 60);
										$timeFormat = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

										$hours_day = floor($seconds_day / 3600);
										$mins_day = floor($seconds_day / 60 % 60);
										$secs_day = floor($seconds_day % 60);
										$timeFormat_day = sprintf('%02d:%02d:%02d', $hours_day, $mins_day, $secs_day);

										$hours_day = floor($seconds_day / 3600);
										$mins_day = floor($seconds_day / 60 % 60);
										$secs_day = floor($seconds_day % 60);
										$timeFormat_day = sprintf('%02d:%02d:%02d', $hours_day, $mins_day, $secs_day);


										$hours_day_break = floor($seconds_break_ / 3600);
										$mins_day_break = floor($seconds_break_ / 60 % 60);
										$secs_day_break = floor($seconds_break_ % 60);
										$timeFormat_day_break = sprintf('%02d:%02d:%02d', $hours_day_break, $mins_day_break, $secs_day_break);

										$hours_day_pray = floor($seconds_pray_ / 3600);
										$mins_day_pray = floor($seconds_pray_ / 60 % 60);
										$secs_day_pray = floor($seconds_pray_ % 60);
										$timeFormat_day_pray = sprintf('%02d:%02d:%02d', $hours_day_pray, $mins_day_pray, $secs_day_pray);

										$hours_day_toilet = floor($seconds_toilet_ / 3600);
										$mins_day_toilet = floor($seconds_toilet_ / 60 % 60);
										$secs_day_toilet = floor($seconds_toilet_ % 60);
										$timeFormat_day_toilet = sprintf('%02d:%02d:%02d', $hours_day_toilet, $mins_day_toilet, $secs_day_toilet);

										$hours_day_handsup = floor($seconds_handsup_ / 3600);
										$mins_day_handsup = floor($seconds_handsup_ / 60 % 60);
										$secs_day_handsup = floor($seconds_handsup_ % 60);
										$timeFormat_day_handsup = sprintf('%02d:%02d:%02d', $hours_day_handsup, $mins_day_handsup, $secs_day_handsup);

								?>
										<tr>
											<td><?php echo $no; ?></td>
											<td style="text-align:left;" nowrap><?php echo $ag->nama; ?></td>
											<td style="text-align:left;"><?php echo $ag->agentid; ?></td>
											<td><?php echo number_format($recording['recording'][$ag->agentid]['dialna']); ?></td>
											<td><?php echo $timeFormat; ?></td>
											<td><?php echo number_format($recording['nod'][$ag->agentid]['datena']); ?></td>
											<td><?php echo number_format($recording['recording'][$ag->agentid]['dialna'] / $recording['nod'][$ag->agentid]['datena']); ?></td>
											<td><?php echo $timeFormat_day; ?></td>
											<td><?php echo number_format($recording['answered'][$ag->agentid]['dialna']); ?></td>
											<td><?php echo $timeFormat_day_break; ?></td>
											<td><?php echo $timeFormat_day_pray; ?></td>
											<td><?php echo $timeFormat_day_toilet; ?></td>
											<td><?php echo $timeFormat_day_handsup; ?></td>


										</tr>
								<?php
										$no++;
									}
								}

								?>

							</tbody>

						</table>
					</small>
				</div>
			</div>
		</div>
	</div>

<?php
}

?>

<!-- load library selectize -->
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->

<?php echo _js('ybs,selectize,datatables,icheck,multiselect') ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#agentid').selectize({});
		$("#report_table_reg").DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf'
			]
		});
	});
</script>