<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form', 'bg-green', true) ?>

<form id='form-a'>
	<div class="panel panel-lte">
		<div class="panel-heading lte-heading-primary">Identitias Diri</div>
		<input disabled hidden class='data-sending' id='id' value='<?php if (isset($id)) echo $id ?>'>
		<table width="100%">
			<tr>
				<td width="15%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>AgentId Reguler</label>
							<input disabled type='text' class='form-control data-sending focus-color' value='<?php if (isset($data)) echo $data->agentid ?>'>

						</div>
					</div>
				</td>
				<td width="15%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>AgentID Moss</label>
							<input disabled type='text' class='form-control data-sending focus-color' value='<?php if (isset($data)) echo $data->agentid ?>'>

				
						</div>
					</div>
				</td>
				<td width="10%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>PERNER</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='perner' name='perner'  value='<?php if (isset($data)) echo $data->perner ?>' autocomplete='off'>
						</div>
					</div>
				</td>
				<td width="35%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>NO PKWT</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='no_pkwt' name='no_pkwt'  value='<?php if (isset($data)) echo $data->no_pkwt ?>'>
						</div>
					</div>
				</td>
				<td width="20%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_no_ktp ?></label>
							<input disabled type='text' class='form-control data-sending focus-color' id='no_ktp' name='no_ktp'  value='<?php if (isset($data)) echo $data->no_ktp ?>' autocomplete='off'>
						</div>
					</div>
				</td>

			</tr>
		</table>
		<table width="100%">
			<tr>
				<td width="30%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nama Lengkap</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='nama_lengkap' name='nama_lengkap'  value='<?php if (isset($data)) echo $data->nama_lengkap ?>'>
						</div>
					</div>
				</td>
				<td width="20%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Jenis Kelamin</label>
							<input disabled type='text' class='form-control data-sending focus-color' value='<?php if (isset($data)) if($data->jenis_kelamin=1){echo "laki - laki";}else{echo "perempuan";} ?>'>

				
						</div>
					</div>
				</td>
				<td width="50%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_alamat ?></label>
							<input disabled type='text' class='form-control data-sending focus-color' id='alamat' name='alamat'  value='<?php if (isset($data)) echo $data->alamat ?>'>
						</div>
					</div>
				</td>

			</tr>
			<table width="100%">
				<tr>
					<td>
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_kelurahan ?></label>
								<input disabled type='text' class='form-control data-sending focus-color' id='kelurahan' name='kelurahan'  value='<?php if (isset($data)) echo $data->kelurahan ?>'>
							</div>
						</div>
					</td>
					<td>
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_kecamatan ?></label>
								<input disabled type='text' class='form-control data-sending focus-color' id='kecamatan' name='kecamatan'  value='<?php if (isset($data)) echo $data->kecamatan ?>'>
							</div>
						</div>
					</td>
					<td>
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'>Kabupaten / Kota</label>
								<input disabled type='text' class='form-control data-sending focus-color' id='kabupaten_kota' name='kabupaten_kota'  value='<?php if (isset($data)) echo $data->kabupaten_kota ?>'>
							</div>
						</div>
					</td>
					<td>
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_provinsi ?></label>
								<input disabled type='text' class='form-control data-sending focus-color' id='provinsi' name='provinsi'  value='<?php if (isset($data)) echo $data->provinsi ?>'>
							</div>
						</div>
					</td>
				</tr>
			</table>

			<table width="100%">
				<tr>
					<td width="30%">
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_tempat_lahir ?></label>
								<input disabled type='text' class='form-control data-sending focus-color' id='tempat_lahir' name='tempat_lahir'  value='<?php if (isset($data)) echo $data->tempat_lahir ?>'>
							</div>
						</div>
					</td>
					<td width="70%">
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_tanggal_lahir ?></label>
								<div class='input-group'>
									<span class='input-group-prepend' id='basic-addon1'>
										<span class='input-group-text'><i class="fa fa-calendar"></i></span>
									</span>
									<input disabled type='text' class='form-control data-sending input-simple-date'  id='tanggal_lahir' name='tanggal_lahir' value='<?php if (isset($data)) echo $data->tanggal_lahir ?>'>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td width="40%">
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_email ?></label>
								<input disabled type='text' class='form-control data-sending focus-color' id='email' name='email'  value='<?php if (isset($data)) echo $data->email ?>'>
							</div>
						</div>
					</td>
					<td width="30%">
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_no_hp ?></label>
								<input disabled type='text' class='form-control data-sending focus-color' id='no_hp' name='no_hp'  value='<?php if (isset($data)) echo $data->no_hp ?>' autocomplete='off'>
							</div>
						</div>
					</td>
					<td width="30%">

						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_no_hp_lain ?></label>
								<input disabled type='text' class='form-control data-sending focus-color' id='no_hp_lain' name='no_hp_lain'  value='<?php if (isset($data)) echo $data->no_hp_lain ?>' autocomplete='off'>
							</div>
						</div>
					</td>
				</tr>
			</table>
			<table widht="100%">
				<tr>
					<td width="20%">
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'>Tanggal Awal Kontrak</label>
								<div class='input-group'>
									<span class='input-group-prepend' id='basic-addon1'>
										<span class='input-group-text'><i class="fa fa-calendar"></i></span>
									</span>
									<input disabled type='text' class='form-control data-sending input-simple-date'  id='tanggal_gabung' name='tanggal_gabung' value='<?php if (isset($data)) echo $data->tanggal_gabung ?>'>
								</div>
							</div>
						</div>
					</td>
					<td width="20%">
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'>Tanggal Akhir Kontrak</label>
								<div class='input-group'>
									<span class='input-group-prepend' id='basic-addon1'>
										<span class='input-group-text'><i class="fa fa-calendar"></i></span>
									</span>
									<input disabled type='text' class='form-control data-sending input-simple-date'  id='tanggal_akhir' name='tanggal_akhir' value='<?php if (isset($data)) echo $data->tanggal_akhir ?>'>
								</div>
							</div>
						</div>
					</td>
					<td width="60%">
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'>Alamat Kosan</label>
								<div class='input-group'>
									<input disabled type='text' class='form-control data-sending focus-color' id='alamat_kosan' name='alamat_kosan'  value='<?php if (isset($data)) echo $data->alamat_kosan ?>'>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</table ht="100%">

	</div>
	<div class="panel panel-lte">
		<div class="panel-heading lte-heading-success">Data Keluarga</div>
		<table width="100%">
			<tr>
				<td width="15%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Status Perkawinan</label>
							<input disabled type='text' class='form-control data-sending focus-color' value='<?php if (isset($data)) 
$sttskawin=$data->status_perkawinan;
if($sttskawin == 1){
echo "Belum Kawin";
}else{
echo "Kawin";
} ?>'>

				
						</div>
					</div>
				</td>
				<td width="25%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nama Suami / Istri</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='nama_sutri' name='nama_sutri'  value='<?php if (isset($data)) echo $data->nama_sutri ?>'>
						</div>
					</div>
				</td>
				<td width="15%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Menikah Tanggal</label>
							<div class='input-group'>
								<span class='input-group-prepend' id='basic-addon1'>
									<span class='input-group-text'><i class="fa fa-calendar"></i></span>
								</span>
								<input disabled type='text' class='form-control data-sending input-simple-date'  id='tanggal_menikah' name='tanggal_menikah' value='<?php if (isset($data)) echo $data->tanggal_menikah ?>'>
							</div>
						</div>
					</div>
				</td>
				<td width="15%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Tanggal Lahir Suami/Istri</label>
							<div class='input-group'>
								<span class='input-group-prepend' id='basic-addon1'>
									<span class='input-group-text'><i class="fa fa-calendar"></i></span>
								</span>
								<input disabled type='text' class='form-control data-sending input-simple-date' id='tanggal_lhrsutri' name='tanggal_lhrsutri' value='<?php if (isset($data)) echo $data->tanggal_lhrsutri ?>'>
							</div>
						</div>
					</div>
				</td>
				<td width="10%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Jumlah Anak</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='jml_anak' name='jml_anak' value='<?php if (isset($data)) echo $data->jml_anak ?>'>
						</div>
					</div>
				</td>
				<td width="15%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Tgl Lahir Anak terakhir</label>
							<div class='input-group'>
								<span class='input-group-prepend' id='basic-addon1'>
									<span class='input-group-text'><i class="fa fa-calendar"></i></span>
								</span>
								<input disabled type='text' class='form-control data-sending input-simple-date' id='u_anakterakhir' name='u_anakterakhir' value='<?php if (isset($data)) echo $data->u_anakterakhir ?>'>
							</div>
						</div>
					</div>
				</td>
			</tr>
		</table>
		<hr>
		<table width="100%">
			<tr>
				<td width="25%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nama</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='nama_emergency' name='nama_emergency'  value='<?php if (isset($data)) echo $data->nama_emergency ?>'>
						</div>
					</div>
				</td>
				<td width="15%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Relasi</label>
							<input disabled type='text' class='form-control data-sending focus-color' value='<?php if (isset($data)) echo $data->emergency_kontak ?>'>

				
						</div>
					</div>
				</td>
				
				<td width="25%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nomor Kontak</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='nomor_emergency' name='nomor_emergency'  value='<?php if (isset($data)) echo $data->nomor_emergency ?>'>
						</div>
					</div>
				</td>

			</tr>
		</table>


	</div>

	<div class="panel panel-lte">
		<div class="panel-heading lte-heading-important">Data Pendidikan Terakhir</div>
		<table width="100%">
			<tr>
				<td width="25%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_pendidikan ?></label>
							<!-- <input disabled type='text' class='form-control data-sending focus-color' id='pendidikan' name='pendidikan'  value='<?php if (isset($data)) echo $data->pendidikan ?>'> -->
							<input disabled type='text' class='form-control data-sending focus-color' value='<?php if (isset($data)) echo $data->pendidikan ?>'>

				
						</div>
					</div>
				</td>
				<td width="25%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nama Sekolah / Perguruan Tinggi</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='sekolah' name='sekolah'  value='<?php if (isset($data)) echo $data->sekolah ?>'>
						</div>
					</div>
				</td>
				<td width="25%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_jurusan ?></label>
							<input disabled type='text' class='form-control data-sending focus-color' id='jurusan' name='jurusan'  value='<?php if (isset($data)) echo $data->jurusan ?>'>
						</div>
					</div>
				</td>
				<td width="20%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Tahun Lulus</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='tahun_lulus' name='tahun_lulus'  value='<?php if (isset($data)) echo $data->tahun_lulus ?>' autocomplete='off'>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>

	<div class="panel panel-lte">
		<div class="panel-heading lte-heading-important">Data Bank, NPWP Dan BPJS</div>
		<table width="100%">
			<tr>
				<td width="30%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nomor Rekening</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='no_rekening' name='no_rekening'  value='<?php if (isset($data)) echo $data->no_rekening ?>' autocomplete='off'>
						</div>
					</div>
				</td>
				<td width="30%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nama Bank</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='nama_bank' name='nama_bank'  value='<?php if (isset($data)) echo $data->nama_bank ?>'>
						</div>
					</div>
				</td>
				<td width="30%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Atas Nama</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='bank_an' name='bank_an' value='<?php if (isset($data)) echo $data->bank_an ?>'>
						</div>
					</div>
				</td>
			</tr>
		</table>
		<table width="100%">
			<tr>
				<td width="30%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nomor NPWP</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='npwp' name='npwp'  value='<?php if (isset($data)) echo $data->npwp ?>' autocomplete='off'>
						</div>
					</div>
				</td>
				<td width="30%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nama NPWP</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='npwp_nama' name='npwp_nama'  value='<?php if (isset($data)) echo $data->npwp_nama ?>'>
						</div>
					</div>
				</td>
			</tr>
		</table>
		<table width="100%">
			<tr>
				<td width="30%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nomor Kartu Peserta BPJS Ketenagakerjaan</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='bpjs_ket' name='bpjs_ket'  value='<?php if (isset($data)) echo $data->bpjs_ket ?>' autocomplete='off'>
						</div>
					</div>
				</td>
				<td width="30%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nomor Kartu Peserta BPJS Kesehatan</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='bpjs_kes' name='bpjs_kes'  value='<?php if (isset($data)) echo $data->bpjs_kes ?>' autocomplete='off'>
						</div>
					</div>
				</td>

			</tr>
		</table>
	</div>
	<div class="panel panel-lte">
		<div class="panel-heading lte-heading-important">Payroll</div>
		coming soon..
	</div>
	<div class="panel panel-lte">
		<div class="panel-heading lte-heading-important">Performance</div>
		coming soon..
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
</script>

<script>
	$('.input-simple-date').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd',
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
</script>