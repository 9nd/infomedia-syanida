<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form', 'bg-green', true) ?>

<form id='form-a'>
	<input hidden class='data-sending' id='id' value='<?php if (isset($id)) echo $id ?>'>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_agentid ?></label>
			<select name='agentid' id="agentid" class="form-control custom-select data-sending col-5">

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
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_bulan ?></label>
			<input type='date' class='form-control data-sending focus-color col-5' id='bulan' name='bulan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->bulan ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_hk ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='hk' name='hk' placeholder='jumlah hari kerja' value='<?php if (isset($data)) echo $data->hk ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_kehadiran ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='kehadiran' name='kehadiran' placeholder='persentase kehadiran' value='<?php if (isset($data)) echo $data->kehadiran ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_contacted ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='contacted' name='contacted' placeholder='persentase contacted' value='<?php if (isset($data)) echo $data->contacted ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_verified ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='verified' name='verified' placeholder='persentase verified' value='<?php if (isset($data)) echo $data->verified ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_reward ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='reward' name='reward' placeholder='reward' value='<?php if (isset($data)) echo $data->reward ?>'>
		</div>
	</div>


	<!-- <div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_pendidikan ?></label>
			<input type='text' class='form-control data-sending focus-color' id='pendidikan' name='pendidikan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->pendidikan ?>'>
		</div>
	</div> -->


	<!-- <div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_foreign ?></label>
			<input type='text' class='form-control data-sending focus-color' id='foreign' name='foreign' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->foreign ?>'>
		</div>
	</div> -->


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_score ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='score' name='score' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->score ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_level ?></label>
			<select class='form-control data-sending focus-color  col-3' id='level' name='level'>
				<option>Agent</option>
				<option>Pemula</option>
				<option>Junior</option>
				<option>Madya</option>
				<option>Senior</option>
			</select>
		</div>
	</div>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_akomodasi ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='akomodasi' name='akomodasi' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->akomodasi ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_tunj_transport ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='tunj_transport' name='tunj_transport' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->tunj_transport ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_komisi ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='komisi' name='komisi' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->komisi ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_tunj_level ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='tunj_level' name='tunj_level' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->tunj_level ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_tunj_jabatan ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='tunj_jabatan' name='tunj_jabatan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->tunj_jabatan ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_thp_leveling ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='thp_leveling' name='thp_leveling' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->thp_leveling ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_ot_moss ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='ot_moss' name='ot_moss' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->ot_moss ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_other_fee ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='other_fee' name='other_fee' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->other_fee ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_tunjangan_skill ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='tunjangan_skill' name='tunjangan_skill' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->tunjangan_skill ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_lebih_hpemail ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='lebih_hpemail' name='lebih_hpemail' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->lebih_hpemail ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_lebih_emailonly ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='lebih_emailonly' name='lebih_emailonly' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->lebih_emailonly ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_lebih_rp ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='lebih_rp' name='lebih_rp' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->lebih_rp ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->sys_user_detail_payroll_tot_thp ?></label>
			<input type='number' class='form-control data-sending focus-color col-3' id='tot_thp' name='tot_thp' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->tot_thp ?>'>
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
<script type="text/javascript">
	$('#agentid').selectize({});
	// $('#agentid').multiselect();
	var page_version = "1.0.8"
</script>