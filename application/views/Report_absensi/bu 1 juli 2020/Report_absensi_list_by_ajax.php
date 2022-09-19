<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->
<?php echo _css("selectize,multiselect") ?>

<div class='col-md-12 col-xl-12'>
	<div class="card">
		<div class="card-status bg-green"></div>
		<div class="card-header">
			<h3 class="card-title">Pilih Periode Rekapitulasi Absensi
			</h3>
			<div class="card-options">
				<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
				<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
			</div>
		</div>
		<div class="card-body">
			<div class='box-body' id='box-table'>

				<form id='form-a' methode="GET">
					<div class="row">
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Mulai Dari</label>
								<input type='date' class='form-control data-sending focus-color' id='start' name='start' value='<?php if (isset($_GET['start'])) echo $_GET['start'] ?>'>
							</div>
						</div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Sampai </label>
								<input type='date' class='form-control data-sending focus-color' id='end' name='end' value='<?php if (isset($_GET['end'])) echo $_GET['end'] ?>'>
							</div>
						</div>
						<div class="clearfix"></div>
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
									if ($list_agent_d['num'] > 0) {
										foreach ($list_agent_d['results'] as $list_agent) {
											$selected = "";
											if (isset($_GET['agentid'])) {

												if (count($_GET['agentid']) > 1) {

													foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
														if ($v_agentid == $list_agent->agentid) {
															$selected = 'selected';
														}
													}
												} else {
													$selected = ($list_agent->agentid == $_GET['agentid'][0]) ? 'selected' : '';
												}
											}
											echo "<option value='" . $list_agent->agentid . "' " . $selected . ">" . $list_agent->agentid . " | " . $list_agent->nama . "</option>";
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
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<?php

if (isset($_GET['start']) && isset($_GET['end'])) {


?>
	<div class='col-md-6 col-xl-7'>
		<div class="card">
			<div class="card-status bg-orange"></div>
			<div class="card-header">
				<h3 class="card-title">Summary Absensi Agent <?php echo $_GET['start'] . " sd " . $_GET['end'] ?>
				</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div class='box-body table-responsive' id='box-table'>
					<small>
						<table class='table'>
							<thead>
								<tr>
									<th nowrap> Jumlah Agent </th>
									<th nowrap>f. kehadiran</th>
									<th nowrap>f. absen</th>
									<th nowrap>f. ontime</th>
									<th nowrap>f. late</th>
									<th nowrap>Rasio Ontime</th>
								</tr>
							</thead>
							<tbody id="num_area">
								<tr>

									<td align="center" id="jml_agent">-</td>
									<td align="center" id="kehadiran">-</td>
									<td align="center" id="absen">-</td>
									<td align="center" id="ontime">-</td>
									<td align="center" id="late">-</td>
									<td align="center" id="rasio">-</td>
								</tr>
							</tbody>
						</table>
					</small>
				</div>
			</div>
		</div>
	</div>

	<div class='col-md-12 col-xl-12' id="list_area">

	</div>
	<script type="text/javascript">
		function update_base_num_area() {
			var start = $("#start").val();
			var end = $("#end").val();
			var periode = $("#periode").val();
			var agentid = $("#agentid").val();
			$.ajax({
				url: "<?php echo base_url() . "Report_profiling/Report_profiling/get_data_num_live_query" ?>",
				data: {
					start: start,
					end: end,
					periode: periode,
					agentid: agentid
				},
				methode: "get",
				success: function(response) {
					$("#num_area").html(response);
				}
			});
		}

		function update_base_list_area() {
			var start = $("#start").val();
			var end = $("#end").val();
			var agentid = $("#agentid").val();
			$.ajax({
				url: "<?php echo base_url() . "Report_absensi/Report_absensi/get_data_list" ?>",
				data: {
					start: start,
					end: end,
					agentid: agentid
				},
				methode: "get",
				success: function(response) {
					$("#list_area").html(response);
				}
			});
		}

		function update_base_num_hp_email_area() {
			var start = $("#start").val();
			var end = $("#end").val();
			var periode = $("#periode").val();
			var agentid = $("#agentid").val();
			$.ajax({
				url: "<?php echo base_url() . "Report_profiling/Report_profiling/get_list_hp_email" ?>",
				data: {
					start: start,
					end: end,
					periode: periode,
					agentid: agentid
				},
				methode: "get",
				success: function(response) {
					$("#num_hp_email_area").html(response);
				}
			});
		}
		$(document).ready(function() {
			update_base_list_area();
			// update_base_num_hp_email_area();
			// update_base_num_area();
		});
	</script>
<?php
}

?>

<!-- load library selectize -->
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->
<?php echo _js("ybs,selectize,multiselect") ?>
<script type="text/javascript">
	$('#agentid').selectize({});
	// $('#agentid').multiselect();
	var page_version = "1.0.8"
</script>