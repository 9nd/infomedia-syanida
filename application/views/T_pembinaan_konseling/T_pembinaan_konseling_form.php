<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form', 'bg-green', true) ?>
<div class="row">
	<div class="col-4">
		<form id='form-a'>
			<div class='col-md-12 col-xl-12'>

				
				<div class='form-group'>
					<label class='form-label'>Penerima Konseling</label>
					<select name='nama_konseling' id="nama_konseling" class="form-control custom-select data-sending">

						<?php
						if (isset($data)) {
							echo "<option value='" . $data->agentid . "' " . $selected . ">" . $data->agentid . "</option>";
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
					<label class='form-label'><?php echo $title->t_pembinaan_konseling_konselor ?></label>
					<input readonly type='text' class='form-control data-sending focus-color' id='konselor' name='konselor' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($userdata)) echo $userdata->agentid ?>'>
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
					<label class='form-label'><?php echo $title->t_pembinaan_konseling_jenis_pembinaan ?></label>
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

			</div>
		</form>
	</div>


	<div class="col-md" id="formnya">

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
	function transformTypedChar(charStr) {
		return charStr == "%" ? "Persen" : charStr;
	}

	document.getElementById("data_performance").onkeypress = function(evt) {
		var val = this.value;
		evt = evt || window.event;

		// Ensure we only handle printable keys, excluding enter and space
		var charCode = typeof evt.which == "number" ? evt.which : evt.keyCode;
		if (charCode && charCode > 32) {
			var keyChar = String.fromCharCode(charCode);

			// Transform typed character
			var mappedChar = transformTypedChar(keyChar);

			var start, end;
			if (typeof this.selectionStart == "number" && typeof this.selectionEnd == "number") {
				// Non-IE browsers and IE 9
				start = this.selectionStart;
				end = this.selectionEnd;
				this.value = val.slice(0, start) + mappedChar + val.slice(end);

				// Move the caret
				this.selectionStart = this.selectionEnd = start + 1;
			} else if (document.selection && document.selection.createRange) {
				// For IE up to version 8
				var selectionRange = document.selection.createRange();
				var textInputRange = this.createTextRange();
				var precedingRange = this.createTextRange();
				var bookmark = selectionRange.getBookmark();
				textInputRange.moveToBookmark(bookmark);
				precedingRange.setEndPoint("EndToStart", textInputRange);
				start = precedingRange.text.length;
				end = start + selectionRange.text.length;

				this.value = val.slice(0, start) + mappedChar + val.slice(end);
				start++;

				// Move the caret
				textInputRange = this.createTextRange();
				textInputRange.collapse(true);
				textInputRange.move("character", start - (this.value.slice(0, start).split("\r\n").length - 1));
				textInputRange.select();
			}

			return false;
		}
	};
	document.getElementById("komitmen_perbaikan").onkeypress = function(evt) {
		var val = this.value;
		evt = evt || window.event;

		// Ensure we only handle printable keys, excluding enter and space
		var charCode = typeof evt.which == "number" ? evt.which : evt.keyCode;
		if (charCode && charCode > 32) {
			var keyChar = String.fromCharCode(charCode);

			// Transform typed character
			var mappedChar = transformTypedChar(keyChar);

			var start, end;
			if (typeof this.selectionStart == "number" && typeof this.selectionEnd == "number") {
				// Non-IE browsers and IE 9
				start = this.selectionStart;
				end = this.selectionEnd;
				this.value = val.slice(0, start) + mappedChar + val.slice(end);

				// Move the caret
				this.selectionStart = this.selectionEnd = start + 1;
			} else if (document.selection && document.selection.createRange) {
				// For IE up to version 8
				var selectionRange = document.selection.createRange();
				var textInputRange = this.createTextRange();
				var precedingRange = this.createTextRange();
				var bookmark = selectionRange.getBookmark();
				textInputRange.moveToBookmark(bookmark);
				precedingRange.setEndPoint("EndToStart", textInputRange);
				start = precedingRange.text.length;
				end = start + selectionRange.text.length;

				this.value = val.slice(0, start) + mappedChar + val.slice(end);
				start++;

				// Move the caret
				textInputRange = this.createTextRange();
				textInputRange.collapse(true);
				textInputRange.move("character", start - (this.value.slice(0, start).split("\r\n").length - 1));
				textInputRange.select();
			}

			return false;
		}
	};
	document.getElementById("ketidaksesuaian").onkeypress = function(evt) {
		var val = this.value;
		evt = evt || window.event;

		// Ensure we only handle printable keys, excluding enter and space
		var charCode = typeof evt.which == "number" ? evt.which : evt.keyCode;
		if (charCode && charCode > 32) {
			var keyChar = String.fromCharCode(charCode);

			// Transform typed character
			var mappedChar = transformTypedChar(keyChar);

			var start, end;
			if (typeof this.selectionStart == "number" && typeof this.selectionEnd == "number") {
				// Non-IE browsers and IE 9
				start = this.selectionStart;
				end = this.selectionEnd;
				this.value = val.slice(0, start) + mappedChar + val.slice(end);

				// Move the caret
				this.selectionStart = this.selectionEnd = start + 1;
			} else if (document.selection && document.selection.createRange) {
				// For IE up to version 8
				var selectionRange = document.selection.createRange();
				var textInputRange = this.createTextRange();
				var precedingRange = this.createTextRange();
				var bookmark = selectionRange.getBookmark();
				textInputRange.moveToBookmark(bookmark);
				precedingRange.setEndPoint("EndToStart", textInputRange);
				start = precedingRange.text.length;
				end = start + selectionRange.text.length;

				this.value = val.slice(0, start) + mappedChar + val.slice(end);
				start++;

				// Move the caret
				textInputRange = this.createTextRange();
				textInputRange.collapse(true);
				textInputRange.move("character", start - (this.value.slice(0, start).split("\r\n").length - 1));
				textInputRange.select();
			}

			return false;
		}
	};
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
		var nama_konseling = $("#nama_konseling").val();
		var konselor = $("#konselor").val();
		var bulan_tahun = $("#bulan_tahun").val();
		var data_performance = $("#data_performance").val();
		var ketidaksesuaian = $("#ketidaksesuaian").val();
		var jenis_pembinaan = $("#jenis_pembinaan").val();
		var komitmen_perbaikan = $("#komitmen_perbaikan").val();
		$.ajax({
			url: "<?php echo base_url() . "T_pembinaan_konseling/T_pembinaan_konseling/ambilform" ?>",
			data: {
				nama_konseling: nama_konseling,
				konselor: konselor,
				bulan_tahun: bulan_tahun,
				data_performance: data_performance,
				ketidaksesuaian: ketidaksesuaian,
				jenis_pembinaan: jenis_pembinaan,
				komitmen_perbaikan: komitmen_perbaikan
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