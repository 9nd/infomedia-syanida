<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form', 'bg-green', true) ?>

<form id='form-a'>
	<input disabled hidden class='data-sending' id='idx' value='<?php if (isset($idx)) echo $idx ?>'>
	<input disabled hidden type='text' class='form-control data-sending focus-color' id='sumber' name='sumber' value='IndiBox'>
	<input disabled hidden type='text' class='form-control data-sending focus-color' id='idx' name='idx' value='<?php if (isset($data)) echo $data->idx ?>'>
	<input disabled hidden type='text' class='form-control data-sending focus-color' id='lup' name='lup' value='<?php echo date('Y-m-d h:i:s', time()); ?>'>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'>NCLI</label>
			<input disabled onkeypress="return hanyaAngka(event)" type='text' class='form-control data-sending focus-color' id='ncli' name='ncli' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->ncli ?>'>
		</div>
	</div>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'>Nomor PSTN</label>
			<input disabled onkeypress="return hanyaAngka(event)" type='text' class='form-control data-sending focus-color' id='no_pstn' name='no_pstn' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->no_pstn ?>'>
		</div>
	</div>
	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'>Nomor Speedy</label>
			<input disabled onkeypress="return hanyaAngka(event)" type='text' class='form-control data-sending focus-color' id='no_speedy' name='no_speedy' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->no_speedy ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'>Nama Pelanggan</label>
			<input disabled type='text' class='form-control data-sending focus-color' id='nama_pelanggan' name='nama_pelanggan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->nama_pelanggan ?>'>
		</div>
	</div>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'>Layanan</label>
			<input  class='form-control data-sending focus-color' disabled value="<?php
								if (isset($data)) {
									echo $data->layanan;
								} else {
									echo "Pilih";
								} ?>">
			
		</div>
	</div>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'>Relasi Kepemilikan</label>
			<input  class='form-control data-sending focus-color'  disabled value="<?php
								if (isset($data)) {
									echo $data->relasi;
								} else {
									echo "Pilih";
								} ?>">
			
		</div>
	</div>
	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_no_handpone ?></label>
			<input  class='form-control data-sending focus-color' disabled onkeypress="return hanyaAngka(event)" type='text' class='form-control data-sending focus-color' id='no_handpone' name='no_handpone' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->no_handpone ?>'>
		</div>
	</div>
	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_email ?></label>
			<input disabled type='text' class='form-control data-sending focus-color' id='email' name='email' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->email ?>'>
			<span id="error" style="display:none;color:red;">Alamat Email Salah kak :)</span>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_reason_call ?></label>
			<!-- <input disabled type='text' class='form-control data-sending focus-color' id='reason_call' name='reason_call' placeholder='' value='<?php if (isset($data)) echo $data->reason_call ?>'> -->
			<input  class='form-control data-sending focus-color' disabled value="<?php
								if (isset($data))
									echo $data->reason_call;
								?>">
			
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_status ?></label>
			<!-- <input disabled type='text' class='form-control data-sending focus-color' id='status' name='status' placeholder='' value='<?php if (isset($data)) echo $data->status ?>'> -->
			<input  class='form-control data-sending focus-color' disabled value="<?php
								if (isset($data))
									echo $data->status;
								?>">
			
		</div>
	</div>
	

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'>Nama Pemilik</label>
			<input disabled type='text' class='form-control data-sending focus-color' id='nama_pastel' name='nama_pastel' placeholder='' value='<?php if (isset($data)) echo $data->nama_pastel ?>'>
		</div>
	</div>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'>Alamat</label>
			<input disabled type='text' class='form-control data-sending focus-color' id='alamat' name='alamat' placeholder='' value='<?php if (isset($data)) echo $data->alamat ?>'>
		</div>
	</div>
	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_kota ?></label>
			<input disabled type='text' class='form-control data-sending focus-color' id='kota' name='kota' placeholder='' value='<?php if (isset($data)) echo $data->kota ?>'>
		</div>
	</div>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'>Keceptan</label>
			<input disabled type='text' class='form-control data-sending focus-color' id='keceptan' name='kecepatan' placeholder='' value='<?php if (isset($data)) echo $data->kecepatan ?>'>
		</div>
	</div>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'>Tagihan</label>
			<input disabled type='text' class='form-control data-sending focus-color' id='tagihan' name='tagihan' placeholder='' value='<?php if (isset($data)) echo $data->tagihan ?>'>
		</div>
	</div>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'>Tahun Pemasangan</label>
			<input disabled type='text' class='form-control data-sending focus-color' id='tahun_pemasangan' name='tahun_pemasangan' placeholder='' value='<?php if (isset($data)) echo $data->tahun_pemasangan ?>'>
		</div>
	</div>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'>Tempat Bayar</label>
			<input disabled type='text' class='form-control data-sending focus-color' id='tempat_bayar' name='tempat_bayar' placeholder='' value='<?php if (isset($data)) echo $data->tempat_bayar ?>'>
		</div>
	</div>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_keterangan ?></label>
			<input disabled type='text' class='form-control data-sending focus-color' id='keterangan' name='keterangan' placeholder='' value='<?php if (isset($data)) echo $data->keterangan ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>

		<div class='form-group'>
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
	$('#email').on('keypress', function() {
		var re = /([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(this.value);
		if (!re) {
			$('#error').show();
		} else {
			$('#error').hide();
		}
	})
</script>
<script>
	function hanyaAngka(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))

			return false;
		return true;
	}
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

		$('.form-control').attr('disabled ', true);
		$('#btn-apply').attr('disabled ', true);
		$('#btn-cancel').attr('disabled ', false);
		$('#btn-save').attr('disabled ', false);
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

		$('.form-control').attr('disabled ', false);
		$('#btn-cancel').attr('disabled ', true);
		$('#btn-save').attr('disabled ', true);
		$('#btn-apply').attr('disabled ', false);

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