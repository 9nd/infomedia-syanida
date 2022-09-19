<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form', 'bg-green', true) ?>

<form id='form-a'>
	<input hidden class='data-sending' id='id' value='<?php if (isset($id)) echo $id ?>'>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_log_problem_tanggal ?></label>
			<input type='datetime-local' class='form-control data-sending focus-color' id='tanggal' name='tanggal' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->tanggal ?>'>
		</div>
	</div>
	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'>Tanggal Selesai</label>
			<input type='datetime-local' class='form-control data-sending focus-color' id='tanggal_selesai' name='tanggal_selesai' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->tanggal_selesai ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_log_problem_agentid ?></label>
			<select name='agentid' id="agentid" class="form-control custom-select data-sending ">
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
                <label class='form-label'>Kategori gangguan</label>
                <div id="bngkuskategori_gangguan">
                    <input type="text"  name='kategori_gangguan' id="kategori_gangguan" class="form-control data-sending">
                   
                </div>
                <!-- <input type="checkbox" id="tambahbaru">Tambah baru kategori <input type="text" class="data-sending" name="tambahbaru" id="tambahbaru"><input type="button" value="Tambah"> -->
            </div>
        </div>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_log_problem_solusi ?></label>
			<input type='text' class='form-control data-sending focus-color' id='solusi' name='solusi' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->solusi ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_log_problem_status ?></label>
			<select class='form-control data-sending focus-color' id='status' name='status'>
				<option Value="Waiting">Waiting</option>
				<option Value="Done">Done</option>
				<option Value="Follow Up">Follow Up</option>
			</select>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_log_problem_keterangan ?></label>
			<input type='text' class='form-control data-sending focus-color' id='keterangan' name='keterangan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->keterangan ?>'>
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
	// $('#tambahbaru').click(function(e) {
	// 	$("#bngkuskategori_gangguan").hide();
	// });
	

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