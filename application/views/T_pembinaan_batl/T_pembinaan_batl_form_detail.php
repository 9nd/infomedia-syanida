<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form', 'bg-green', true) ?>
<div class="row">
	<div class="col-4">
		<form id='form-a'>
			<input hidden class='data-sending' id='id' value='<?php if (isset($id)) echo $id ?>'>

			<div class='col-md-12 col-xl-12'>
				<div class='form-group'>
					<label class='form-label'>Penerima Teguran</label>
					<select name='penerima_teguran' id="penerima_teguran" class="form-control custom-select data-sending">

						<?php
						if (isset($data)) {
							echo "<option value='" . $data->penerima_teguran . "' " . $selected . ">" . $data->penerima_teguran .  " | " . $nama_penerima . "</option>";
						}
						if ($list_agent_d['num'] > 0) {
							foreach ($list_agent_d['results'] as $list_agent) {
								$selected = "";
								echo "<option value='" . $list_agent->agentid . "' " . $selected . ">" . $list_agent->agentid . " | " . $list_agent->nama . "</option>";
							}
						}
						?>

					</select>
				</div>
			</div>

			<div class='col-md-12 col-xl-12'>
				<div class='form-group'>
					<label class='form-label'><?php echo $title->t_pembinaan_batl_pemberi_teguran ?></label>
					<input readonly type='text' class='form-control data-sending focus-color' id='pemberi_teguran' name='pemberi_teguran' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data->pemberi_teguran)) echo $data->pemberi_teguran ?>'>
				</div>
			</div>


			<div class='col-md-12 col-xl-12'>
				<div class='form-group'>
					<label class='form-label'><?php echo $title->t_pembinaan_batl_tanggal_teguran ?></label>
					<input type='date' class='form-control data-sending focus-color' id='tanggal_teguran' name='tanggal_teguran' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->tanggal_teguran ?>'>
				</div>
			</div>


			<div class='col-md-12 col-xl-12'>
				<div class='form-group'>
					<label class='form-label'><?php echo $title->t_pembinaan_batl_isi_teguran_lisan ?></label>
					<textarea class='form-control data-sending focus-color' id='isi_teguran_lisan' name='isi_teguran_lisan'>
 <?php if (isset($data)) echo $data->isi_teguran_lisan ?>
</textarea>
				</div>
			</div>


			<div class='col-md-12 col-xl-12'>
				<div class='form-group'>
					<label class='form-label'><?php echo $title->t_pembinaan_batl_pertimbangan_tindakan ?></label>
					<textarea class='form-control data-sending focus-color' id='pertimbangan_tindakan' name='pertimbangan_tindakan'>
 <?php if (isset($data)) echo $data->pertimbangan_tindakan ?>
</textarea>
				</div>
			</div>


			<div class='col-md-12 col-xl-12'>
				<div class='form-group'>
					<label class='form-label'><?php echo $title->t_pembinaan_batl_komitmen ?></label>
					<input type='text' class='form-control data-sending focus-color' id='komitmen' name='komitmen' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->komitmen ?>'>
				</div>
			</div>


			<div class='col-md-12 col-xl-12'>
				<div class='form-group'>
					<label class='form-label'><?php echo $title->t_pembinaan_batl_verifikasi ?></label>
					<input type='text' class='form-control data-sending focus-color' id='verifikasi' name='verifikasi' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->verifikasi ?>'>
				</div>
			</div>


			<div class='col-md-12 col-xl-12'>
				<div class='form-group'>
					<label class='form-label'><?php echo $title->t_pembinaan_batl_evidance ?></label>
					<input type='file' class='form-control data-sending focus-color' id='evidance' name='evidance' placeholder='<?php echo $title->general->desc_required ?>'>
					<!-- <input type='text' class='form-control data-sending focus-color' id='evidance' name='evidance' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->evidance ?>'> -->
				</div>
			</div>


			<div class='col-md-12 col-xl-12'>

				<div class='form-group'>
					<button id='btn-apply' type='button' class='btn btn-primary'><i class='fe fe-check'></i> <?php echo $title->general->button_apply ?></button>
					<button disabled='' id='btn-save' type='button' class='btn btn-primary'><i class="fe fe-save"></i> <?php echo $title->general->button_save ?></button>
					<button disabled='' id='btn-cancel' type='button' class='btn btn-primary'> <?php echo $title->general->button_cancel ?></button>
					<a href='<?php echo $link_back ?>' id='btn-close' class='btn btn-primary'> <?php echo $title->general->button_close ?></a>
				</div>

			</div>
		</form>
	</div>
	<div class="col-md" id="formnya">
		<a class="btn-lte3 btn-app text-black  pull-right" onclick="printDiv('printableArea')">
			<i class="fas fa-print"></i> Print
		</a>
		<br>
		<br>

		<div id="printableArea">
			<div align="center">
				<h3>BERITA ACARA TEGURAN LISAN</h3>
			</div>

			<table width="100%" border="1">
				<tbody>
					<tr>
						<td colspan="3">
							<table width="100%" border="0">
								<tr>
									<td width="25%"><b>NAMA</b></td>
									<td width="1%">
										<div align="center">:</div>
									</td>
									<td width="74%"><?php echo $nama_penerima; ?></td>
								</tr>
								<tr>
									<td><b>UNIT KERJA</b></td>
									<td>
										<div align="center">:</div>
									</td>
									<td>CC PROFILING</td>
								</tr>
								<tr>
									<td><b>PEMBERI TEGURAN</b></td>
									<td>
										<div align="center">:</div>
									</td>
									<td><?php echo $nama_pemberi; ?></td>
								</tr>
								<tr>
									<td><b>TANGGAL TEGURAN</b></td>
									<td>
										<div align="center">:</div>
									</td>
									<td><?php echo $tanggal_teguran; ?></td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table width="100%" border="0">
								<tr>
									<td colspan="3"><b>ISI TEGURAN LISAN :</b></td>
								</tr>
								<tr>
									<td height="250" colspan="3"><?php echo $isi_teguran_lisan;
																	echo "<br>";
																	echo $pertimbangan_tindakan; ?></td>
								</tr>
							</table>
						</td>
					</tr>

					<tr>
						<td colspan="3">
							<p><b>KOMITMEN :</b></p>
							<?php echo $komitmen; ?>
							<p>&nbsp;</p>
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<p><b>VERIFIKASI : </b></p>
							<?php echo $verifikasi; ?>
							<p>&nbsp;</p>
						</td>

					</tr>

				</tbody>
			</table>

			<table width="100%" border="0">
				<tbody>
					<tr>
						<td colspan="3"><b>Bandung, <?php echo $tanggal_teguran; ?></b></td>
					</tr>
					<tr>
						<td colspan="3">Mengetahui,</td>
					</tr>
					<tr>
						<td>
							<p align="center"><b>Atasan Penegur</b></p>
							<p align="center">&nbsp;</p>
							<p align="center">&nbsp;</p>
							<p align="center"><b>Erick Yanida Firmansyah</b></p>
						</td>
						<td>
							<p align="center"><b>Pegawai yang ditegur</b></p>
							<p align="center">&nbsp;</p>
							<p align="center">&nbsp;</p>
							<p align="center"><b><?php echo $nama_penerima; ?></b></p>
						</td>
						<td>
							<p align="center"><b>Pemberi Teguran Lisan</b></p>
							<p align="center">&nbsp;</p>
							<p align="center">&nbsp;</p>
							<p align="center"><b><?php echo $nama_pemberi; ?></b></p>
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
		ambil_form();
	})

	function ambil_form() {
		var penerima_teguran = $("#penerima_teguran").val();
		var pemberi_teguran = $("#pemberi_teguran").val();
		var tanggal_teguran = $("#tanggal_teguran").val();
		var isi_teguran_lisan = $("#isi_teguran_lisan").val();
		var pertimbangan_tindakan = $("#pertimbangan_tindakan").val();
		var komitmen = $("#komitmen").val();
		var verifikasi = $("#verifikasi").val();
		var evidance = $("#evidance").val();
		$.ajax({
			url: "<?php echo base_url() . "T_pembinaan_batl/T_pembinaan_batl/ambilform" ?>",
			data: {
				penerima_teguran: penerima_teguran,
				pemberi_teguran: pemberi_teguran,
				tanggal_teguran: tanggal_teguran,
				isi_teguran_lisan: isi_teguran_lisan,
				pertimbangan_tindakan: pertimbangan_tindakan,
				komitmen: komitmen,
				verifikasi: verifikasi,
				evidance: evidance
			},
			methode: "get",
			success: function(response) {
				$("#formnya").html(response);
			},

		});
	}

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