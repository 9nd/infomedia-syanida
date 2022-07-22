<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form', 'bg-green', true) ?>

<form id='form-a'>
	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->dbprofile_verified_NCLI ?></label>
			<input type='text' readonly class='form-control data-sending focus-color' id='NCLI' name='NCLI' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->NCLI ?>'>
			<input type='hidden' readonly class='form-control data-sending focus-color' id='berdasarkan' name='berdasarkan' value='<?php echo $berdasarkan ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->dbprofile_verified_NO_PSTN ?></label>
			<input type='text' class='form-control data-sending focus-color' id='NO_PSTN' name='NO_PSTN' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->NO_PSTN ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->dbprofile_verified_NO_SPEEDY ?></label>
			<input type='text' class='form-control data-sending focus-color' id='NO_SPEEDY' name='NO_SPEEDY' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->NO_SPEEDY ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->dbprofile_verified_NAMA_PELANGGAN ?></label>
			<input type='text' class='form-control data-sending focus-color' id='NAMA_PELANGGAN' name='NAMA_PELANGGAN' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->NAMA_PELANGGAN ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->dbprofile_verified_RELASI ?></label>
			<input type='text' class='form-control data-sending focus-color' id='RELASI' name='RELASI' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->RELASI ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->dbprofile_verified_NO_HP ?></label>
			<input type='text' class='form-control data-sending focus-color' id='NO_HP' name='NO_HP' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->NO_HP ?>'>
		</div>
	</div>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->dbprofile_verified_EMAIL ?></label>
			<input type='text' class='form-control data-sending focus-color' id='EMAIL' name='EMAIL' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->EMAIL ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->dbprofile_verified_NAMA_PEMILIK ?></label>
			<input type='text' class='form-control data-sending focus-color' id='NAMA_PEMILIK' name='NAMA_PEMILIK' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->NAMA_PEMILIK ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->dbprofile_verified_ALAMAT ?></label>
			<input type='text' class='form-control data-sending focus-color' id='ALAMAT' name='ALAMAT' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->ALAMAT ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->dbprofile_verified_KOTA ?></label>
			<input type='text' class='form-control data-sending focus-color' id='KOTA' name='KOTA' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->KOTA ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->dbprofile_verified_REGIONAL ?></label>
			<input type='text' class='form-control data-sending focus-color' id='REGIONAL' name='REGIONAL' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->REGIONAL ?>'>
		</div>
	</div>
	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->dbprofile_verified_TGL_VERIFIKASI ?></label>
			<input type='text' readonly class='form-control data-sending focus-color' id='TGL_VERIFIKASI' name='TGL_VERIFIKASI' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->TGL_VERIFIKASI ?>'>
		</div>
	</div>
	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->dbprofile_verified_SUMBER ?></label>
			<input type='text' readonly class='form-control data-sending focus-color' id='SUMBER' name='SUMBER' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->SUMBER ?>'>
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