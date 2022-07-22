<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form', 'bg-green', true) ?>

<form id='form-a'>
	<div class="panel panel-lte">
		<div class="panel-heading lte-heading-primary">Identitias Diri</div>
		<input hidden class='data-sending' id='id' value='<?php if (isset($id)) echo $id ?>'>
		<table width="100%">
			<tr>
				<td width="15%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>AgentId Reguler</label>
							<?php $v = '';
							if (isset($data)) $v = $data->agentid;
							echo create_cmb_database(array(
								'id'			=> 'agentid',
								'name'			=> 'agentid',
								'table'			=> 'sys_user',
								'field_show'	=> 'nama',
								'primary_key'	=> 'agentid',
								'selected'		=> $v,
								'field_link'	=> '',
								'class'			=> 'custom-select data-sending'
							));
							?>
						</div>
					</div>
				</td>
				<td width="15%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>AgentID Moss</label>
							<?php $v = '';
							if (isset($data)) $v = $data->agentid;
							echo create_cmb_database(array(
								'id'			=> 'agentid',
								'name'			=> 'agentid',
								'table'			=> 'sys_user',
								'field_show'	=> 'nama',
								'primary_key'	=> 'agentid',
								'selected'		=> $v,
								'field_link'	=> '',
								'class'			=> 'custom-select data-sending'
							));
							?>
						</div>
					</div>
				</td>
				<td width="10%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>PERNER</label>
							<input type='text' class='form-control data-sending focus-color' id='perner' name='perner' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->perner ?>' autocomplete='off'>
						</div>
					</div>
				</td>
				<td width="35%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>NO PKWT</label>
							<input type='text' class='form-control data-sending focus-color' id='no_pkwt' name='no_pkwt' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->no_pkwt ?>'>
						</div>
					</div>
				</td>
				<td width="20%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_no_ktp ?></label>
							<input type='text' class='form-control data-sending focus-color' id='no_ktp' name='no_ktp' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->no_ktp ?>' autocomplete='off'>
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
							<input type='text' class='form-control data-sending focus-color' id='nama_lengkap' name='nama_lengkap' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->nama_lengkap ?>'>
						</div>
					</div>
				</td>
				<td width="20%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Jenis Kelamin</label>
							<?php $v = '';
							if (isset($data)) $v = $data->jenis_kelamin;
							echo create_cmb_database(array(
								'id'			=> 'jenis_kelamin',
								'name'			=> 'jenis_kelamin',
								'table'			=> 'jenis_kelamin',
								'field_show'	=> 'jenis_kelamin',
								'primary_key'	=> 'id',
								'selected'		=> $v,
								'field_link'	=> '',
								'class'			=> 'custom-select data-sending'
							));
							?>
						</div>
					</div>
				</td>
				<td width="50%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_alamat ?></label>
							<input type='text' class='form-control data-sending focus-color' id='alamat' name='alamat' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->alamat ?>'>
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
								<input type='text' class='form-control data-sending focus-color' id='kelurahan' name='kelurahan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->kelurahan ?>'>
							</div>
						</div>
					</td>
					<td>
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_kecamatan ?></label>
								<input type='text' class='form-control data-sending focus-color' id='kecamatan' name='kecamatan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->kecamatan ?>'>
							</div>
						</div>
					</td>
					<td>
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'>Kabupaten / Kota</label>
								<input type='text' class='form-control data-sending focus-color' id='kabupaten_kota' name='kabupaten_kota' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->kabupaten_kota ?>'>
							</div>
						</div>
					</td>
					<td>
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_provinsi ?></label>
								<input type='text' class='form-control data-sending focus-color' id='provinsi' name='provinsi' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->provinsi ?>'>
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
								<input type='text' class='form-control data-sending focus-color' id='tempat_lahir' name='tempat_lahir' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->tempat_lahir ?>'>
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
									<input type='text' class='form-control data-sending input-simple-date' placeholder='<?php echo $title->general->desc_required ?>' id='tanggal_lahir' name='tanggal_lahir' value='<?php if (isset($data)) echo $data->tanggal_lahir ?>'>
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
								<input type='text' class='form-control data-sending focus-color' id='email' name='email' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->email ?>'>
							</div>
						</div>
					</td>
					<td width="30%">
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_no_hp ?></label>
								<input type='text' class='form-control data-sending focus-color' id='no_hp' name='no_hp' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->no_hp ?>' autocomplete='off'>
							</div>
						</div>
					</td>
					<td width="30%">

						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_no_hp_lain ?></label>
								<input type='text' class='form-control data-sending focus-color' id='no_hp_lain' name='no_hp_lain' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->no_hp_lain ?>' autocomplete='off'>
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
									<input type='text' class='form-control data-sending input-simple-date' placeholder='<?php echo $title->general->desc_required ?>' id='tanggal_gabung' name='tanggal_gabung' value='<?php if (isset($data)) echo $data->tanggal_gabung ?>'>
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
									<input type='text' class='form-control data-sending input-simple-date' placeholder='<?php echo $title->general->desc_required ?>' id='tanggal_akhir' name='tanggal_akhir' value='<?php if (isset($data)) echo $data->tanggal_akhir ?>'>
								</div>
							</div>
						</div>
					</td>
					<td width="60%">
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'>Alamat Kosan</label>
								<div class='input-group'>
									<input type='text' class='form-control data-sending focus-color' id='alamat_kosan' name='alamat_kosan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->alamat_kosan ?>'>
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
							<?php $v = '';
							if (isset($data)) $v = $data->status_perkawinan;
							echo create_cmb_database(array(
								'id'			=> 'status_perkawinan',
								'name'			=> 'status_perkawinan',
								'table'			=> 'status_perkawinan',
								'field_show'	=> 'status_perkawinan',
								'primary_key'	=> 'id',
								'selected'		=> $v,
								'field_link'	=> '',
								'class'			=> 'custom-select data-sending'
							));
							?>
						</div>
					</div>
				</td>
				<td width="25%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nama Suami / Istri</label>
							<input type='text' class='form-control data-sending focus-color' id='nama_sutri' name='nama_sutri' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->nama_sutri ?>'>
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
								<input type='text' class='form-control data-sending input-simple-date' placeholder='<?php echo $title->general->desc_required ?>' id='tanggal_menikah' name='tanggal_menikah' value='<?php if (isset($data)) echo $data->tanggal_menikah ?>'>
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
								<input type='text' class='form-control data-sending input-simple-date' placeholder='<?php echo $title->general->desc_required ?>' id='tanggal_lhrsutri' name='tanggal_lhrsutri' value='<?php if (isset($data)) echo $data->tanggal_lhrsutri ?>'>
							</div>
						</div>
					</div>
				</td>
				<td width="10%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Jumlah Anak</label>
							<input type='text' class='form-control data-sending focus-color' id='jml_anak' name='jml_anak' value='<?php if (isset($data)) echo $data->jml_anak ?>'>
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
								<input type='text' class='form-control data-sending input-simple-date' placeholder='<?php echo $title->general->desc_required ?>' id='u_anakterakhir' name='u_anakterakhir' value='<?php if (isset($data)) echo $data->u_anakterakhir ?>'>
							</div>
						</div>
					</div>
				</td>
			</tr>
		</table>
		<hr>
		<table width="100%">
			<tr>
				<td width="15%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Emergency Kontak</label>
							<select class='form-control data-sending focus-color' id='emergency_kontak' name='emergency_kontak'>
								<?php
								if (isset($data)) {
									echo "<option value='$data->emergency_kontak'>" . $data->emergency_kontak . "</option>";
								?>
									<option value=0>--Pilih--</option>
									<option value="ayah">Ayah</option>
									<option value="ibu">Ibu</option>
									<option value="saudara">Saudara</option>
									<option value="suami/istri">Suami/istri</option>
									<option value="wali">Wali</option>
								<?php
								} else {
								?>

									<option value=0>--Pilih--</option>
									<option value="ayah">Ayah</option>
									<option value="ibu">Ibu</option>
									<option value="saudara">Saudara</option>
									<option value="suami/istri">Suami/istri</option>
									<option value="wali">Wali</option>
								<?php
								}
								?>
							</select>
						</div>
					</div>
				</td>
				<td width="25%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nama</label>
							<input type='text' class='form-control data-sending focus-color' id='nama_emergency' name='nama_emergency' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->nama_emergency ?>'>
						</div>
					</div>
				</td>
				<td width="25%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nomor Kontak</label>
							<input type='text' class='form-control data-sending focus-color' id='nomor_emergency' name='nomor_emergency' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->nomor_emergency ?>'>
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
							<!-- <input type='text' class='form-control data-sending focus-color' id='pendidikan' name='pendidikan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->pendidikan ?>'> -->
							<select class='form-control data-sending focus-color' id='pendidikan' name='pendidikan'>
								<?php if (isset($data)) {
									echo "<option value='" . $data->pendidikan . "'>" . $data->pendidikan . "</option>";
								?>
									<option value="0" disabled>--Pilih--</option>
									<option value="SD">SD Sederajat</option>
									<option value="SMP">SMP Sederajat</option>
									<option value="SMA">SMA/SMK Sederajat</option>
									<option value="D1">Diploma I</option>
									<option value="D3">Diploma III</option>
									<option value="D4">Diploma IV</option>
									<option value="S1">Sarjana</option>
									<option value="S2">Magister</option>
									<option value="S3">Doktoral</option>
								<?php
								} else {
								?>
									<option value="0" disabled>--Pilih--</option>
									<option value="SD">SD Sederajat</option>
									<option value="SMP">SMP Sederajat</option>
									<option value="SMA">SMA/SMK Sederajat</option>
									<option value="D1">Diploma I</option>
									<option value="D3">Diploma III</option>
									<option value="D4">Diploma IV</option>
									<option value="S1">Sarjana</option>
									<option value="S2">Magister</option>
									<option value="S3">Doktoral</option>
								<?php } ?>
							</select>
						</div>
					</div>
				</td>
				<td width="25%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nama Sekolah / Perguruan Tinggi</label>
							<input type='text' class='form-control data-sending focus-color' id='sekolah' name='sekolah' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->sekolah ?>'>
						</div>
					</div>
				</td>
				<td width="25%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_jurusan ?></label>
							<input type='text' class='form-control data-sending focus-color' id='jurusan' name='jurusan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->jurusan ?>'>
						</div>
					</div>
				</td>
				<td width="20%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Tahun Lulus</label>
							<input type='text' class='form-control data-sending focus-color' id='tahun_lulus' name='tahun_lulus' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->tahun_lulus ?>' autocomplete='off'>
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
							<input type='text' class='form-control data-sending focus-color' id='no_rekening' name='no_rekening' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->no_rekening ?>' autocomplete='off'>
						</div>
					</div>
				</td>
				<td width="30%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nama Bank</label>
							<input type='text' class='form-control data-sending focus-color' id='nama_bank' name='nama_bank' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->nama_bank ?>'>
						</div>
					</div>
				</td>
				<td width="30%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Atas Nama</label>
							<input type='text' class='form-control data-sending focus-color' id='bank_an' name='bank_an' value='<?php if (isset($data)) echo $data->bank_an ?>'>
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
							<input type='text' class='form-control data-sending focus-color' id='npwp' name='npwp' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->npwp ?>' autocomplete='off'>
						</div>
					</div>
				</td>
				<td width="30%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nama NPWP</label>
							<input type='text' class='form-control data-sending focus-color' id='npwp_nama' name='npwp_nama' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->npwp_nama ?>'>
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
							<input type='text' class='form-control data-sending focus-color' id='bpjs_ket' name='bpjs_ket' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->bpjs_ket ?>' autocomplete='off'>
						</div>
					</div>
				</td>
				<td width="30%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nomor Kartu Peserta BPJS Kesehatan</label>
							<input type='text' class='form-control data-sending focus-color' id='bpjs_kes' name='bpjs_kes' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->bpjs_kes ?>' autocomplete='off'>
						</div>
					</div>
				</td>

			</tr>
		</table>
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