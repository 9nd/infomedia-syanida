<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form', 'bg-green', true) ?>
<div class="row">
	<div class="col-4">
		<div class='col-md-12 col-xl-12'>
			<form id='form-a'>
				<input hidden class='data-sending' id='id' value='<?php if (isset($id)) echo $id ?>'>

				<div class='form-group'>
					<label class='form-label'>Penerima Konseling</label>
					<select name='nama_konseling' id="nama_konseling" class="form-control custom-select data-sending">

						<?php
						if (isset($data->nama_konseling)) {
							echo "<option value='" . $data->nama_konseling . "' " . $selected . ">" . $data->nama_konseling . "</option>";
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
				<label class='form-label'>Konselor</label>
				<input readonly type='text' class='form-control data-sending focus-color' id='konselor' name='konselor' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->konselor ?>'>
			</div>
		</div>


		<div class='col-md-12 col-xl-12'>
			<div class='form-group'>
				<label class='form-label'>Tanggal </label>
				<input type='date' class='form-control data-sending focus-color' id='bulan_tahun' name='bulan_tahun' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->bulan_tahun ?>'>
			</div>
		</div>


		<div class='col-md-12 col-xl-12'>
			<div class='form-group'>
				<label class='form-label'><?php echo $title->t_pembinaan_konseling_data_performance ?></label>
				<textarea class='form-control data-sending focus-color' id='data_performance' name='data_performance'><?php if (isset($data)) echo $data->data_performance ?></textarea>
			</div>
		</div>


		<div class='col-md-12 col-xl-12'>
			<div class='form-group'>
				<label class='form-label'><?php echo $title->t_pembinaan_konseling_ketidaksesuaian ?></label>
				<textarea class='form-control data-sending focus-color' id='ketidaksesuaian' name='ketidaksesuaian'><?php if (isset($data)) echo $data->ketidaksesuaian ?></textarea>
			</div>
		</div>


		<div class='col-md-12 col-xl-12'>
			<div class='form-group'>
				<label class='form-label'>Jenis Pembinaan</label>
				<select class='form-control data-sending focus-color' id='jenis_pembinaan' name='jenis_pembinaan'>
					<option value="4">Konseling 1</option>
					<option value="5">Konseling 2</option>
					<option value="6">Konseling 3</option>
				</select>
			</div>
		</div>


		<div class='col-md-12 col-xl-12'>
			<div class='form-group'>
				<label class='form-label'><?php echo $title->t_pembinaan_konseling_komitmen_perbaikan ?></label>
				<textarea class='form-control data-sending focus-color' id='komitmen_perbaikan' name='komitmen_perbaikan'><?php if (isset($data)) echo $data->komitmen_perbaikan ?></textarea>
			</div>
		</div>



		<div class='col-md-12 col-xl-12'>

			<div class='form-group'>
				<button id='btn-apply' type='button' class='btn btn-primary'><i class='fe fe-check'></i> <?php echo $title->general->button_apply ?></button>
				<button disabled='' id='btn-save' type='button' class='btn btn-primary'><i class="fe fe-save"></i> <?php echo $title->general->button_save ?></button>
				<button disabled='' id='btn-cancel' type='button' class='btn btn-primary'> <?php echo $title->general->button_cancel ?></button>
				<a href='<?php echo $link_back ?>' id='btn-close' class='btn btn-primary'> <?php echo $title->general->button_close ?></a>
			</div>

			</form>
		</div>
	</div>
	<div class="col-md">
		<a class="btn-lte3 btn-app text-black  pull-right" onclick="printDiv('printableArea')">
			<i class="fas fa-print"></i> Print
		</a>
		<br>
		<br>

		<div id="printableArea">
			<table width="100%" border="0">
				<tbody>
					<tr>
						<td colspan="4">
							<div align="center"><strong>
									<h3>FORMULIR KONSELING</h3>
								</strong></div>
						</td>
					</tr>
					<tr>
						<td width="27%">Nama Yang dikonseling</td>
						<td width="3%">
							<div align="center">:</div>
						</td>
						<td colspan="2"><?php echo $nama_konseling; ?></td>
					</tr>
					<tr>
						<td>Nama Konselor</td>
						<td>
							<div align="center">:</div>
						</td>
						<td colspan="2"><?php echo $konselor; ?></td>
					</tr>
					<tr>
						<td>Bulan / Tahun</td>
						<td>
							<div align="center">:</div>
						</td>
						<td colspan="2"><?php echo $data->bulan_tahun; ?></td>
					</tr>
					<tr>
						<td>Lokasi Kerja</td>
						<td>
							<div align="center">:</div>
						</td>
						<td colspan="2">Bandung</td>
					</tr>
					<tr>
						<td colspan="4">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="4">
							<table width="100%" border="1">
								<tbody>
									<tr>
										<td width="3%">
											<div align="center">NO</div>
										</td>
										<td width="28%">
											<div align="center">DATA PERFORMANCE</div>
										</td>
										<td width="24%">
											<div align="center">KETIDAKSESUAIAN</div>
										</td>
										<td width="16%">
											<div align="center">PEMBINAAN</div>
										</td>
										<td width="29%">
											<div align="center">KOMITMEN PERBAIKAN</div>
										</td>
									</tr>
									<tr>
										<td>1</td>
										<td><?php echo $data->data_performance ?></td>
										<td><?php echo $data->ketidaksesuaian ?></td>
										<td><?php echo $get_jenis ?></td>
										<td><?php echo $data->komitmen_perbaikan ?></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="4">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="4">Bandung, <?php echo $data->bulan_tahun ?></td>
					</tr>
					<tr>
						<td colspan="2"><b>Dibuat Oleh, </b></td>
						<td width="37%">
							<div align="right"></div>
						</td>
						<td width="33%"><b>Diketahui Oleh</b></td>
					</tr>
					<tr>
						<td colspan="4">
							<table width="100%" border="0">
								<tr>
									<td width="33%">
										<div align="center">
											<p><b>Konselor</b></p>
											<p>&nbsp;</p>
											<p>&nbsp;</p>
										</div>
									</td>
									<td width="34%">
										<div align="center">
											<p><b>Pegawai yang dikonseling</b></p>
											<p>&nbsp;</p>
											<p>&nbsp;</p>
										</div>
									</td>
									<td width="33%">
										<div align="center">
											<p><b>Infomedia Solusi Humanika</b></p>
											<p>&nbsp;</p>
											<p>&nbsp;</p>
										</div>
									</td>
								</tr>
								<tbody>
									<tr>
										<td><b>Nama / NIK : <?php echo $nik_konselor->nama . " / " . $nik_konselor->nik_absensi; ?></b></td>
										<td><b>Nama / NIK : <?php echo $nik_penerima->nama . " / " . $nik_penerima->nik_absensi; ?></b></td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td><b>Jabatan : <?php $level = $ctrl->db->query("SELECT * FROM sys_level WHERE id='$nik_konselor->opt_level'")->row()->nmlevel;
															echo $level; ?></b></td>
										<td><b>Jabatan : <?php $level = $ctrl->db->query("SELECT * FROM sys_level WHERE id='$nik_penerima->opt_level'")->row()->nmlevel;
															echo $level; ?></b></td>
										<td>&nbsp;</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<script>
			function printDiv(divName) {

				var printContents = document.getElementById(divName).innerHTML;
				var originalContents = document.body.innerHTML;
				var css = '@page { size: landscape; }',
					head = document.head || document.getElementsByTagName('head')[0],
					style = document.createElement('style');

				style.type = 'text/css';
				style.media = 'print';

				if (style.styleSheet) {
					style.styleSheet.cssText = css;
				} else {
					style.appendChild(document.createTextNode(css));
				}

				document.body.innerHTML = printContents;

				window.print();

				document.body.innerHTML = originalContents;
			}
		</script>
	</div>
</div>

<?php echo card_close() ?>

<?php echo _js('selectize,datepicker') ?>

<script>
	var page_version = "1.0.8"
</script>

<script>
	var custom_select = $('.custom-select').selectize({});
	var custom_select_link = $('.custom-select-link');

	$(document).ready(function() {
		<?php
		/*
	|--------------------------------------------------------------
	| CARA MEMBUAT COMBOBOX LINK
	|--------------------------------------------------------------
	| COMBOBOX LINK adalah proses membuat sebuah combobox menjadi 
	| referensi combobox lainnya dalam menampilkan data.
	| misal :
	|  combobox grup menjadi referensi combobox subgrup.
	|  perubahan/pemilihan data combobox grup menyebabkan 
	|  perubahan data combobox subgrup. 
	|--------------------------------------------------------------
	| cara :
	|  - isi "field_link" pada combobox target 
	| 	 'field_link'	=>'nama_field_join_database'.
	|  - gunakan class "custom-select-link" pada kedua combobox ,
	|	 referensi dan target.
	|  - tambahkan script :
	|     linkToSelectize('id_cmb_referensi','id_cmb_target');
	|--------------------------------------------------------------
	| note :
	|   - struktur database harus menggunakan field id sebagai primary key
	|   - combobox harus di buat dengan php code
	|	-  "create_cmb_database" untuk row < 1000
	|	-  dan linkToSelectize untuk row < 1000
	|
	|	-  "create_cmb_database_bigdata" untuk row > 1000
	|	-  dan linkToSelectize_Big untuk row > 1000
	|   - 
	|   - class harus menggunakan "custom-select-link"
	|
	*/
		?>
	})


	$('.data-sending').keydown(function(e) {
		remove_message();
		switch (e.which) {
			case 13:
				apply();
				return false;
		}
	});
</script>

<script>
	$('.input-simple-date').datepicker({
		autoclose: true,
		format: 'dd.mm.yyyy',
	})

	$('#btn-apply').click(function() {
		apply();
		play_sound_apply();
	});

	$('#btn-close').click(function() {
		play_sound_apply();
	});

	$('#btn-cancel').click(function() {
		cancel();
		play_sound_apply();
	});

	$('#btn-save').click(function() {
		simpan();
	})



	function apply() {
		$.each(custom_select, function(key, val) {
			val.selectize.disable();
		});

		<?php
		// NOTE : FOR DISABLE CUSTOM-SELECT-LINK 
		?>
		// $.each(custom_select_link,function(key,val){
		// 		val.selectize.disable();
		// });

		$('.form-control').attr('disabled', true);
		$('#btn-apply').attr('disabled', true);
		$('#btn-cancel').attr('disabled', false);
		$('#btn-save').attr('disabled', false);
		$('#btn-save').focus();
	}

	function cancel() {
		$.each(custom_select, function(key, val) {
			val.selectize.enable();
		});
		<?php
		// NOTE : FOR ENABLE CUSTOM-SELECT-LINK  
		?>
		// $.each(custom_select_link,function(key,val){
		// 		val.selectize.enable();
		// });

		$('.form-control').attr('disabled', false);
		$('#btn-cancel').attr('disabled', true);
		$('#btn-save').attr('disabled', true);
		$('#btn-apply').attr('disabled', false);

	}


	function simpan() {
		<?php
		/* mengambil data yang akan di kirim dari form-a */
		/* dalam bentuk array json tanpa penutup.. */
		/* memungkinkan penambahan data dengan cara push */
		/* ex. data.push */
		?>
		var data = get_dataSending('form-a');

		<?php
		/* complite json format */
		/* ybs_dataSending(array); */
		?>
		send_data = ybs_dataSending(data);

		var a = new ybsRequest();
		a.process('<?php echo $link_save ?>', send_data, 'POST');
		a.onAfterSuccess = function() {
			cancel();
		}
		a.onBeforeFailed = function() {
			cancel();
		}
	}
</script>