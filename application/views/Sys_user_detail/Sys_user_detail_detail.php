<?php echo _css('selectize,datepicker,chartjs,datatables') ?>

<?php echo card_open('Form', 'bg-green', true) ?>

<form id='form-a'>
	<?php
	// var_dump($hadir['sakit']);
	// var_dump($hadir);
	?>
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
							<input disabled type='text' class='form-control data-sending focus-color' id='perner' name='perner' value='<?php if (isset($data)) echo $data->perner ?>' autocomplete='off'>
						</div>
					</div>
				</td>
				<td width="35%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>NO PKWT</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='no_pkwt' name='no_pkwt' value='<?php if (isset($data)) echo $data->no_pkwt ?>'>
						</div>
					</div>
				</td>
				<td width="20%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_no_ktp ?></label>
							<input disabled type='text' class='form-control data-sending focus-color' id='no_ktp' name='no_ktp' value='<?php if (isset($data)) echo $data->no_ktp ?>' autocomplete='off'>
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
							<input disabled type='text' class='form-control data-sending focus-color' id='nama_lengkap' name='nama_lengkap' value='<?php if (isset($data)) echo $data->nama_lengkap ?>'>
						</div>
					</div>
				</td>
				<td width="20%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Jenis Kelamin</label>
							<input disabled type='text' class='form-control data-sending focus-color' value='<?php if (isset($data)) if ($data->jenis_kelamin = 1) {
																													echo "laki - laki";
																												} else {
																													echo "perempuan";
																												} ?>'>


						</div>
					</div>
				</td>
				<td width="50%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_alamat ?></label>
							<input disabled type='text' class='form-control data-sending focus-color' id='alamat' name='alamat' value='<?php if (isset($data)) echo $data->alamat ?>'>
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
								<input disabled type='text' class='form-control data-sending focus-color' id='kelurahan' name='kelurahan' value='<?php if (isset($data)) echo $data->kelurahan ?>'>
							</div>
						</div>
					</td>
					<td>
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_kecamatan ?></label>
								<input disabled type='text' class='form-control data-sending focus-color' id='kecamatan' name='kecamatan' value='<?php if (isset($data)) echo $data->kecamatan ?>'>
							</div>
						</div>
					</td>
					<td>
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'>Kabupaten / Kota</label>
								<input disabled type='text' class='form-control data-sending focus-color' id='kabupaten_kota' name='kabupaten_kota' value='<?php if (isset($data)) echo $data->kabupaten_kota ?>'>
							</div>
						</div>
					</td>
					<td>
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_provinsi ?></label>
								<input disabled type='text' class='form-control data-sending focus-color' id='provinsi' name='provinsi' value='<?php if (isset($data)) echo $data->provinsi ?>'>
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
								<input disabled type='text' class='form-control data-sending focus-color' id='tempat_lahir' name='tempat_lahir' value='<?php if (isset($data)) echo $data->tempat_lahir ?>'>
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
									<input disabled type='text' class='form-control data-sending input-simple-date' id='tanggal_lahir' name='tanggal_lahir' value='<?php if (isset($data)) echo $data->tanggal_lahir ?>'>
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
								<input disabled type='text' class='form-control data-sending focus-color' id='email' name='email' value='<?php if (isset($data)) echo $data->email ?>'>
							</div>
						</div>
					</td>
					<td width="30%">
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_no_hp ?></label>
								<input disabled type='text' class='form-control data-sending focus-color' id='no_hp' name='no_hp' value='<?php if (isset($data)) echo $data->no_hp ?>' autocomplete='off'>
							</div>
						</div>
					</td>
					<td width="30%">

						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'><?php echo $title->sys_user_detail_no_hp_lain ?></label>
								<input disabled type='text' class='form-control data-sending focus-color' id='no_hp_lain' name='no_hp_lain' value='<?php if (isset($data)) echo $data->no_hp_lain ?>' autocomplete='off'>
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
									<input disabled type='text' class='form-control data-sending input-simple-date' id='tanggal_gabung' name='tanggal_gabung' value='<?php if (isset($data)) echo $data->tanggal_gabung ?>'>
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
									<input disabled type='text' class='form-control data-sending input-simple-date' id='tanggal_akhir' name='tanggal_akhir' value='<?php if (isset($data)) echo $data->tanggal_akhir ?>'>
								</div>
							</div>
						</div>
					</td>
					<td width="60%">
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'>Alamat Kosan</label>
								<div class='input-group'>
									<input disabled type='text' class='form-control data-sending focus-color' id='alamat_kosan' name='alamat_kosan' value='<?php if (isset($data)) echo $data->alamat_kosan ?>'>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</table>
			<hr>

			<table widht="100%">
				<tr>
					<td width="20%">
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'>Sosmed - Facebook</label>
								<div class='input-group'>
									<span class='input-group-prepend' id='basic-addon1'>
										<span class='input-group-text'><i class="fa fa-facebook"></i></span>
									</span>
									<input disabled type='text' class='form-control data-sending' id='fb' name='fb' value='<?php if (isset($data)) echo $data->fb ?>'>
								</div>
							</div>
						</div>
					</td>
					<td width="20%">
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'>Sosmed - Twitter</label>
								<div class='input-group'>
									<span class='input-group-prepend' id='basic-addon1'>
										<span class='input-group-text'><i class="fa fa-twitter"></i></span>
									</span>
									<input disabled type='text' class='form-control data-sending' id='twitter' name='twitter' value='<?php if (isset($data)) echo $data->twitter ?>'>
								</div>
							</div>
						</div>
					</td>
					<td width="20%">
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'>Sosmed - Instagram</label>
								<div class='input-group'>
									<span class='input-group-prepend' id='basic-addon1'>
										<span class='input-group-text'><i class="fa fa-instagram"></i></span>
									</span>
									<input disabled type='text' class='form-control data-sending' id='ig' name='ig' value='<?php if (isset($data)) echo $data->ig ?>'>
								</div>
							</div>
						</div>
					</td>

				</tr>
			</table>

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
																													$sttskawin = $data->status_perkawinan;
																												if ($sttskawin == 1) {
																													echo "Belum Kawin";
																												} else {
																													echo "Kawin";
																												} ?>'>


						</div>
					</div>
				</td>
				<td width="25%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nama Suami / Istri</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='nama_sutri' name='nama_sutri' value='<?php if (isset($data)) echo $data->nama_sutri ?>'>
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
								<input disabled type='text' class='form-control data-sending input-simple-date' id='tanggal_menikah' name='tanggal_menikah' value='<?php if (isset($data)) echo $data->tanggal_menikah ?>'>
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
							<input disabled type='text' class='form-control data-sending focus-color' id='nama_emergency' name='nama_emergency' value='<?php if (isset($data)) echo $data->nama_emergency ?>'>
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
							<input disabled type='text' class='form-control data-sending focus-color' id='nomor_emergency' name='nomor_emergency' value='<?php if (isset($data)) echo $data->nomor_emergency ?>'>
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
							<input disabled type='text' class='form-control data-sending focus-color' id='sekolah' name='sekolah' value='<?php if (isset($data)) echo $data->sekolah ?>'>
						</div>
					</div>
				</td>
				<td width="25%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_jurusan ?></label>
							<input disabled type='text' class='form-control data-sending focus-color' id='jurusan' name='jurusan' value='<?php if (isset($data)) echo $data->jurusan ?>'>
						</div>
					</div>
				</td>
				<td width="20%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Tahun Lulus</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='tahun_lulus' name='tahun_lulus' value='<?php if (isset($data)) echo $data->tahun_lulus ?>' autocomplete='off'>
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
							<input disabled type='text' class='form-control data-sending focus-color' id='no_rekening' name='no_rekening' value='<?php if (isset($data)) echo $data->no_rekening ?>' autocomplete='off'>
						</div>
					</div>
				</td>
				<td width="30%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nama Bank</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='nama_bank' name='nama_bank' value='<?php if (isset($data)) echo $data->nama_bank ?>'>
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
							<input disabled type='text' class='form-control data-sending focus-color' id='npwp' name='npwp' value='<?php if (isset($data)) echo $data->npwp ?>' autocomplete='off'>
						</div>
					</div>
				</td>
				<td width="30%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nama NPWP</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='npwp_nama' name='npwp_nama' value='<?php if (isset($data)) echo $data->npwp_nama ?>'>
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
							<input disabled type='text' class='form-control data-sending focus-color' id='bpjs_ket' name='bpjs_ket' value='<?php if (isset($data)) echo $data->bpjs_ket ?>' autocomplete='off'>
						</div>
					</div>
				</td>
				<td width="30%">
					<div class='col-md-12 col-xl-12'>
						<div class='form-group'>
							<label class='form-label'>Nomor Kartu Peserta BPJS Kesehatan</label>
							<input disabled type='text' class='form-control data-sending focus-color' id='bpjs_kes' name='bpjs_kes' value='<?php if (isset($data)) echo $data->bpjs_kes ?>' autocomplete='off'>
						</div>
					</div>
				</td>

			</tr>
		</table>
	</div>
	
	<div class="panel panel-lte">
		<div class="panel-heading lte-heading-important">Performance</div>
		<div class="container">
			Reguler
			<div class="row">

				<!--bar chart -->
				<div class="col-md">


					<canvas id="barChart" style="height:230px; min-height:230px"></canvas>

				</div>


			</div>
			<br>
			Moss
			<div class="row">

				<!--bar chart -->
				<div class="col-md">


					<canvas id="barChartmos" style="height:230px; min-height:230px"></canvas>

				</div>


			</div>
			<br>
			Temuan QC
			<div class="row">

				<!--bar chart -->
				<div class="col-md">


					<canvas id="barChartqc" style="height:230px; min-height:230px"></canvas>

				</div>


			</div>
			<br>
			Absensi
			<div class="row">
				<?php
				// $query1 = $controller->db->query("");
				?>
				<!--bar chart -->
				<div class="col-md">


					<canvas id="barChartabsen" style="height:230px; min-height:230px"></canvas>

				</div>


			</div>
		</div>

		<div class="panel panel-lte">
			<div class='col-md-12 col-xl-12'>

				<div class='form-group'>
					<a href='<?php echo $link_back ?>' id='btn-close' class='btn btn-primary'> <?php echo $title->general->button_close ?></a>
				</div>

			</div>
		</div>










</form>


<?php echo card_close() ?>

<?php echo _js('selectize,datepicker,chartjs,datatables') ?>

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
	//---bar chart---// 
	<?php
	$agentmoss = $controller->db->query("SELECT agentid_mos FROM sys_user WHERE agentid='$data->agentid'")->row()->agentid_mos;
	$datanya = $controller->db->query("SELECT  DATE_FORMAT(tanggal,'%m-%y') as tgl, count(*) as jml, sum(case when status_approve = 1 then 1 else 0 end) as app, sum(case when status_approve = 0 then 1 else 0 end) as notapp FROM qc WHERE agentid='$data->agentid' or agentid='$agentmoss' group by tgl")->result();
	?>

	var areaChartData = {
		labels: [
			<?php

			$jml = count($datanya);
			$i = 0;
			foreach ($datanya as $bulan) {
				// $dateformat = $bulan->tgl;
				echo "'" . $bulan->tgl . "'";
				if (++$i != $jml) {
					echo ",";
				}
			}
			?>

		],
		datasets: [{
				label: 'Sampling',
				backgroundColor: 'blue',
				borderColor: 'rgba(60,141,188,0.8)',
				pointRadius: false,
				pointColor: '#3b8bba',
				pointStrokeColor: 'rgba(60,141,188,1)',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(60,141,188,1)',
				data: [<?php

						$jml = count($datanya);
						$i = 0;
						foreach ($datanya as $bulan) {

							echo "'" . $bulan->jml . "'";
							if (++$i != $jml) {
								echo ",";
							}
						}
						?>]
			},
			{
				label: 'Approve',
				backgroundColor: 'green',
				borderColor: 'rgba(210, 214, 222, 1)',
				pointRadius: false,
				pointColor: 'rgba(210, 214, 222, 1)',
				pointStrokeColor: '#c1c7d1',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(220,220,220,1)',
				data: [<?php

						$jml = count($datanya);
						$i = 0;
						foreach ($datanya as $bulan) {

							echo "'" . $bulan->app . "'";
							if (++$i != $jml) {
								echo ",";
							}
						}
						?>]
			},
			{
				label: 'NotApp',
				backgroundColor: 'red',
				borderColor: 'rgba(210, 214, 222, 1)',
				pointRadius: false,
				pointColor: 'rgba(210, 214, 222, 1)',
				pointStrokeColor: '#c1c7d1',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(220,220,220,1)',
				data: [<?php

						$jml = count($datanya);
						$i = 0;
						foreach ($datanya as $bulan) {

							echo "'" . $bulan->notapp . "'";
							if (++$i != $jml) {
								echo ",";
							}
						}
						?>]
			},

		]
	}

	var barChartCanvas = $('#barChartqc').get(0).getContext('2d')
	var barChartData = jQuery.extend(true, {}, areaChartData)
	var temp0 = areaChartData.datasets[0]
	var temp1 = areaChartData.datasets[1]
	var temp2 = areaChartData.datasets[2]
	var temp3 = areaChartData.datasets[3]
	barChartData.datasets[0] = temp0
	barChartData.datasets[1] = temp1
	barChartData.datasets[2] = temp2

	var barChartOptions = {
		responsive: true,
		maintainAspectRatio: false,
		datasetFill: false
	}

	var barChart = new Chart(barChartCanvas, {
		type: 'bar',
		data: barChartData,
		options: barChartOptions
	})
</script>
<script>
	//---bar chart absensi---// 


	var areaChartData = {
		labels: [
			<?php

			$jml = count($hadir);
			$i = 0;
			$newhadir = array_slice($hadir['hadir'], -12);
			foreach ($newhadir as $khadir => $vhadir) {
				echo "'" . $khadir . "',";
				if (++$i == $jml) {
					// echo ",";
				}
			}
			?>

		],
		datasets: [{
				label: 'hadir',
				backgroundColor: 'green',
				borderColor: 'rgba(60,141,188,0.8)',
				pointRadius: false,
				pointColor: '#3b8bba',
				pointStrokeColor: 'rgba(60,141,188,1)',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(60,141,188,1)',
				data: [<?php
						$newhadir = array_slice($hadir['hadir'], -12);
						foreach ($newhadir as $khadir => $vhadir) {
							echo "'" . $vhadir . "',";
						}
						?>]
			},
			{
				label: 'Telat (Jam)',
				backgroundColor: 'lime',
				borderColor: 'rgba(210, 214, 222, 1)',
				pointRadius: false,
				pointColor: 'rgba(210, 214, 222, 1)',
				pointStrokeColor: '#c1c7d1',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(220,220,220,1)',
				data: [<?php
						$newhadir = array_slice($hadir['late'], -12);
						foreach ($newhadir as $khadir => $vhadir) {
							echo "'" . $vhadir . "',";
						}
						?>]
			},
			{
				label: 'Kurang HK',
				backgroundColor: 'red',
				borderColor: 'rgba(210, 214, 222, 1)',
				pointRadius: false,
				pointColor: 'rgba(210, 214, 222, 1)',
				pointStrokeColor: '#c1c7d1',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(220,220,220,1)',
				data: [<?php
						$newhadir = array_slice($hadir['absen'], -12);
						foreach ($newhadir as $khadir => $vhadir) {
							echo "'" . $vhadir . "',";
						}
						?>]
			},
			{
				label: 'sakit',
				backgroundColor: 'yellow',
				borderColor: 'rgba(210, 214, 222, 1)',
				pointRadius: false,
				pointColor: 'rgba(210, 214, 222, 1)',
				pointStrokeColor: '#c1c7d1',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(220,220,220,1)',
				data: [<?php
						$newhadir = array_slice($hadir['sakit'], -12);
						foreach ($newhadir as $khadir => $vhadir) {
							echo "'" . $vhadir . "',";
						}
						?>]
			},
		]
	}

	var barChartCanvas = $('#barChartabsen').get(0).getContext('2d')
	var barChartData = jQuery.extend(true, {}, areaChartData)
	var temp0 = areaChartData.datasets[0]
	var temp1 = areaChartData.datasets[1]
	var temp2 = areaChartData.datasets[2]
	var temp3 = areaChartData.datasets[3]
	barChartData.datasets[0] = temp0
	barChartData.datasets[1] = temp1
	barChartData.datasets[2] = temp2
	barChartData.datasets[3] = temp3

	var barChartOptions = {
		responsive: true,
		maintainAspectRatio: false,
		datasetFill: false
	}

	var barChart = new Chart(barChartCanvas, {
		type: 'bar',
		data: barChartData,
		options: barChartOptions
	})
</script>
<script>
	//---bar chart---// 
	<?php
	$datanya = $controller->db->query("SELECT * FROM t_payroll WHERE agentid='$data->agentid'")->result();
	?>

	var areaChartData = {
		labels: [
			<?php
			$datanya = array_slice($datanya, -12);
			$jml = count($datanya);
			$i = 0;
			foreach ($datanya as $bulan) {
				// $dateformat = date_format((date_create($bulan->periode)), "Y-M");
				echo "'" . $bulan->periode . "'";
				if (++$i != $jml) {
					echo ",";
				}
			}
			?>

		],
		datasets: [{
				label: 'THP',
				backgroundColor: 'green',
				borderColor: 'rgba(60,141,188,0.8)',
				pointRadius: false,
				pointColor: '#3b8bba',
				pointStrokeColor: 'rgba(60,141,188,1)',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(60,141,188,1)',
				data: [<?php
						$datanya = array_slice($datanya, -12);
						$jml = count($datanya);
						$i = 0;
						foreach ($datanya as $bulan) {

							echo "'" . $bulan->total_thp . "'";
							if (++$i != $jml) {
								echo ",";
							}
						}

						?>

				]
			},

		]
	}

	var barChartCanvas = $('#barChartpayroll').get(0).getContext('2d')
	var barChartData = jQuery.extend(true, {}, areaChartData)
	var temp0 = areaChartData.datasets[0]
	barChartData.datasets[0] = temp0

	var barChartOptions = {

		responsive: true,
		maintainAspectRatio: false,
		datasetFill: false,
		animation: {
			onComplete: function() {
				var chartInstance = this.chart,
					ctx = chartInstance.ctx;

				ctx.textAlign = 'center';
				ctx.textBaseline = 'bottom';

				this.data.datasets.forEach(function(dataset, i) {
					var meta = chartInstance.controller.getDatasetMeta(i);
					meta.data.forEach(function(bar, index) {

						var data = dataset.data[index];
						ctx.fillText(data, bar._model.x, bar._model.y - -15);
					});
				});
			}
		}
	}

	var barChart = new Chart(barChartCanvas, {
		type: 'bar',
		data: barChartData,
		options: barChartOptions
	})
</script>
<script>
	//---bar chart---// 
	<?php
	$datanya = $controller->db->query("SELECT * FROM t_performance_agent WHERE agentid='$data->agentid'")->result();
	$datacont = $controller->db->query("SELECT * FROM ( SELECT *, sum(jumlah) as jumlahsum FROM summary_trans_profiling WHERE veri_upd = '$data->agentid' AND (veri_call = '13' OR veri_call = '11' OR veri_call = '12') GROUP BY tahun, bulan ORDER BY tahun DESC, bulan ASC LIMIT 13) SUB ORDER BY tahun ASC, bulan ASC")->result();
	$dataver = $controller->db->query("SELECT * FROM ( SELECT * FROM summary_trans_profiling WHERE veri_upd = '$data->agentid' AND veri_call = '13' ORDER BY tahun DESC, bulan ASC LIMIT 13) SUB ORDER BY tahun ASC, bulan ASC")->result();
	?>

	var areaChartData = {
		labels: [
			<?php

			$jml = count($datacont);
			$i = 0;
			foreach ($datacont as $bulan) {
				// $dateformat = date_format((date_create("$bulan->bulan")), "m");
				echo "'" . $bulan->tahun . '-' . $bulan->bulan . "'";
				if (++$i != $jml) {
					echo ",";
				}
			}
			?>

		],
		datasets: [{
				label: 'Contacted',
				backgroundColor: 'blue',
				borderColor: 'rgba(60,141,188,0.8)',
				pointRadius: false,
				pointColor: '#3b8bba',
				pointStrokeColor: 'rgba(60,141,188,1)',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(60,141,188,1)',
				data: [<?php

						$jml = count($datacont);
						$i = 0;
						foreach ($datacont as $bulan) {

							echo "'" . $bulan->jumlahsum . "'";
							if (++$i != $jml) {
								echo ",";
							}
						}
						?>]
			},
			{
				label: 'Verified',
				backgroundColor: 'green',
				borderColor: 'rgba(210, 214, 222, 1)',
				pointRadius: false,
				pointColor: 'rgba(210, 214, 222, 1)',
				pointStrokeColor: '#c1c7d1',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(220,220,220,1)',
				data: [<?php

						$jml = count($dataver);
						$i = 0;
						foreach ($dataver as $bulan) {

							echo "'" . $bulan->jumlah . "'";
							if (++$i != $jml) {
								echo ",";
							}
						}
						?>]
			},
			{
				label: 'Hp + Email',
				backgroundColor: 'lime',
				borderColor: 'rgba(210, 214, 222, 1)',
				pointRadius: false,
				pointColor: 'rgba(210, 214, 222, 1)',
				pointStrokeColor: '#c1c7d1',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(220,220,220,1)',
				data: [<?php

						$jml = count($dataver);
						$i = 0;
						foreach ($dataver as $bulan) {

							echo "'" . $bulan->hp_email . "'";
							if (++$i != $jml) {
								echo ",";
							}
						}
						?>]
			},
			{
				label: 'HP Only',
				backgroundColor: 'yellow',
				borderColor: 'rgba(210, 214, 222, 1)',
				pointRadius: false,
				pointColor: 'rgba(210, 214, 222, 1)',
				pointStrokeColor: '#c1c7d1',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(220,220,220,1)',
				data: [<?php

						$jml = count($dataver);
						$i = 0;
						foreach ($dataver as $bulan) {

							echo "'" . $bulan->hp_only . "'";
							if (++$i != $jml) {
								echo ",";
							}
						}
						?>]
			},
		]
	}

	var barChartCanvas = $('#barChart').get(0).getContext('2d')
	var barChartData = jQuery.extend(true, {}, areaChartData)
	var temp0 = areaChartData.datasets[0]
	var temp1 = areaChartData.datasets[1]
	var temp2 = areaChartData.datasets[2]
	var temp3 = areaChartData.datasets[3]
	barChartData.datasets[0] = temp0
	barChartData.datasets[1] = temp1
	barChartData.datasets[2] = temp2
	barChartData.datasets[3] = temp3

	var barChartOptions = {
		responsive: true,
		maintainAspectRatio: false,
		datasetFill: false
	}

	var barChart = new Chart(barChartCanvas, {
		type: 'bar',
		data: barChartData,
		options: barChartOptions
	})
</script>
<script>
	<?php
	$moss = $controller->db->query("SELECT agentid_mos FROM sys_user WHERE agentid='$data->agentid'")->row();
	$datacont = $controller->db->query("SELECT * FROM ( SELECT *, sum(jumlah) as jumlahsum FROM summary_trans_profiling WHERE veri_upd = '$moss->agentid_mos' AND (veri_call = '13' OR veri_call = '11' OR veri_call = '12') GROUP BY tahun, bulan ORDER BY tahun DESC, bulan ASC LIMIT 13) SUB ORDER BY tahun ASC, bulan ASC")->result();
	$dataver = $controller->db->query("SELECT * FROM ( SELECT * FROM summary_trans_profiling WHERE veri_upd = '$moss->agentid_mos' AND veri_call = '13' ORDER BY tahun DESC, bulan ASC LIMIT 13) SUB ORDER BY tahun ASC, bulan ASC")->result();
	?>

	var areaChartData = {
		labels: [
			<?php

			$jml = count($datacont);
			$i = 0;
			foreach ($datacont as $bulan) {
				// $dateformat = date_format((date_create($bulan->bulan)), "m-y");
				echo "'" . $bulan->tahun . '-' . $bulan->bulan . "'";
				if (++$i != $jml) {
					echo ",";
				}
			}
			?>

		],
		datasets: [{
				label: 'Contacted',
				backgroundColor: 'blue',
				borderColor: 'rgba(60,141,188,0.8)',
				pointRadius: false,
				pointColor: '#3b8bba',
				pointStrokeColor: 'rgba(60,141,188,1)',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(60,141,188,1)',
				data: [<?php

						$jml = count($datacont);
						$i = 0;
						foreach ($datacont as $bulan) {

							echo "'" . $bulan->jumlahsum . "'";
							if (++$i != $jml) {
								echo ",";
							}
						}
						?>]
			},
			{
				label: 'Verified',
				backgroundColor: 'green',
				borderColor: 'rgba(210, 214, 222, 1)',
				pointRadius: false,
				pointColor: 'rgba(210, 214, 222, 1)',
				pointStrokeColor: '#c1c7d1',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(220,220,220,1)',
				data: [<?php

						$jml = count($dataver);
						$i = 0;
						foreach ($dataver as $bulan) {

							echo "'" . $bulan->jumlah . "'";
							if (++$i != $jml) {
								echo ",";
							}
						}
						?>]
			},
			{
				label: 'Hp + Email',
				backgroundColor: 'lime',
				borderColor: 'rgba(210, 214, 222, 1)',
				pointRadius: false,
				pointColor: 'rgba(210, 214, 222, 1)',
				pointStrokeColor: '#c1c7d1',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(220,220,220,1)',
				data: [<?php

						$jml = count($dataver);
						$i = 0;
						foreach ($dataver as $bulan) {

							echo "'" . $bulan->hp_email . "'";
							if (++$i != $jml) {
								echo ",";
							}
						}
						?>]
			},
			{
				label: 'HP Only',
				backgroundColor: 'yellow',
				borderColor: 'rgba(210, 214, 222, 1)',
				pointRadius: false,
				pointColor: 'rgba(210, 214, 222, 1)',
				pointStrokeColor: '#c1c7d1',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(220,220,220,1)',
				data: [<?php

						$jml = count($dataver);
						$i = 0;
						foreach ($dataver as $bulan) {

							echo "'" . $bulan->hp_only . "'";
							if (++$i != $jml) {
								echo ",";
							}
						}
						?>]
			},
		]
	}

	var barChartCanvas = $('#barChartmos').get(0).getContext('2d')
	var barChartData = jQuery.extend(true, {}, areaChartData)
	var temp0 = areaChartData.datasets[0]
	var temp1 = areaChartData.datasets[1]
	var temp2 = areaChartData.datasets[2]
	var temp3 = areaChartData.datasets[3]
	barChartData.datasets[0] = temp0
	barChartData.datasets[1] = temp1
	barChartData.datasets[2] = temp2
	barChartData.datasets[3] = temp3

	var barChartOptions = {
		responsive: true,
		maintainAspectRatio: false,
		datasetFill: false
	}

	var barChart = new Chart(barChartCanvas, {
		type: 'bar',
		data: barChartData,
		options: barChartOptions
	})
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
<script>
	$(document).ready(function() {

		$("#example").DataTable({
			dom: 'Bfrtip',
			"pageLength": 3,
			buttons: [
				'copy', 'csv', 'excel', 'pdf'
			]
		});
	});
</script>