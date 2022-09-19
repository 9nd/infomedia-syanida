<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->
<?php echo _css("selectize,multiselect") ?>
<?php echo _css('datatables,icheck') ?>

<div class='col-md-12 col-xl-12'>
	<div class="card">
		<div class="card-status bg-green"></div>
		<div class="card-header">
			<h3 class="card-title">Tambah Input Keterangan Absensi
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
								<label class='form-label'>Agent </label>
								<select name='agentid[]' id="agentid" class="form-control custom-select">

									<?php
									if ($user_categori != 8) {
									?>
										<option selected disabled>--Pilih Agent--</option>
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
							<div class='form-group'>
								<label class='form-label'>Tanggal Absen</label>
								<input type='date' class='form-control data-sending focus-color' id='start' name='start' value='<?php if (isset($_GET['start'])) echo $_GET['start'] ?>'>
							</div>
							<div class='form-group'>
								<label class='form-label'>Keterangan</label>
								<select name='agentid[]' id="agentid" class="form-control custom-select">
									<option disabled selected>Pilih Status..</option>
									<option>Sakit</option>
									<option>Izin</option>
								</select>
							</div>
							<div class='form-group'>
								<button id='btn-save' type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Simpan</button>

							</div>
						</div>


						<div class="clearfix"></div>



					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-status bg-green"></div>
	<div class="card-header">
		<h3 class="card-title">Tambah Input Keterangan Absensi
		</h3>
		<div class="card-options">
			<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
			<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
		</div>
	</div>
	<div class="card-body">
				<div class='box-body table-responsive' id='box-table'>
					<small>
					<table class='timecard' id="tabel_absensi_reg" style="width: 100%;">
					<thead>
						<tr>
							<th><b>No</b></th>
							<th nowrap><b>Nama Agent</b></th>
							<th nowrap><b>NIK</b></th>
							<th nowrap><b>Tanggal Izin</b></th>
							<th nowrap><b>Keterangan</b></th>
							<th nowrap><b>Opsi</b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>a</td>
							<td>a</td>
							<td>a</td>
							<td>a</td>
							<td>a</td>
							<td>Edit | Hapus</td>
						</tr>
					</tbody>
				</table>
			</small>

		</div>
	</div>
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
</script>


<!-- load library selectize -->
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->
<?php echo _js("ybs,selectize,multiselect") ?>
<script type="text/javascript">
	$('#agentid').selectize({});
	// $('#agentid').multiselect();
	var page_version = "1.0.8"
</script>

<?php echo _js('datatables,icheck') ?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#tabel_absensi_reg").DataTable();



	});
</script>