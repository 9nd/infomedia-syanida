<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form', 'bg-green', true) ?>

<form id='form-a'>
	<input hidden class='data-sending' id='id' value='<?php if (isset($id)) echo $id ?>'>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'>Agent </label>
			<select name='agentid' id='agentid' class="form-control custom-select data-sending">

				<?php
				if ($user_categori != 8) {
				?>
					<option value="">--Pilih Agent--</option>
				<?php
				}
				if ($list_agent_d['num'] > 0) {
					foreach ($list_agent_d['results'] as $list_agent) {
						$selected = "";
						if (isset($_GET['agentid'])) {


							$selected = ($list_agent->agentid == $_GET['agentid']) ? 'selected' : '';
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
			<label class='form-label'><?php echo $title->t_performance_agent_bulan ?></label>
			<input type='date' class='form-control data-sending focus-color' id='bulan' name='bulan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->bulan ?>'>
		</div>
	</div>
	<hr>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_performance_agent_contactedr ?></label>
			<input type='text' class='form-control data-sending focus-color' id='contactedr' name='contactedr' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->contactedr ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_performance_agent_verifiedr ?></label>
			<input type='text' class='form-control data-sending focus-color' id='verifiedr' name='verifiedr' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->verifiedr ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_performance_agent_hpemailr ?></label>
			<input type='text' class='form-control data-sending focus-color' id='hpemailr' name='hpemailr' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->hpemailr ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_performance_agent_hpr ?></label>
			<input type='text' class='form-control data-sending focus-color' id='hpr' name='hpr' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->hpr ?>'>
		</div>
	</div>
	<hr>

	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_performance_agent_contactedm ?></label>
			<input type='text' class='form-control data-sending focus-color' id='contactedm' name='contactedm' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->contactedm ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_performance_agent_verifiedm ?></label>
			<input type='text' class='form-control data-sending focus-color' id='verifiedm' name='verifiedm' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->verifiedm ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_performance_agent_hpemailm ?></label>
			<input type='text' class='form-control data-sending focus-color' id='hpemailm' name='hpemailm' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->hpemailm ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_performance_agent_hpm ?></label>
			<input type='text' class='form-control data-sending focus-color' id='hpm' name='hpm' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->hpm ?>'>
		</div>
	</div>

	<hr>
	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_performance_agent_hadir ?></label>
			<input type='text' class='form-control data-sending focus-color' id='hadir' name='hadir' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->hadir ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_performance_agent_telat ?></label>
			<input type='text' class='form-control data-sending focus-color' id='telat' name='telat' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->telat ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_performance_agent_absen ?></label>
			<input type='text' class='form-control data-sending focus-color' id='absen' name='absen' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->absen ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_performance_agent_sakit ?></label>
			<input type='text' class='form-control data-sending focus-color' id='sakit' name='sakit' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->sakit ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_performance_agent_izin ?></label>
			<input type='text' class='form-control data-sending focus-color' id='izin' name='izin' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->izin ?>'>
		</div>
	</div>


	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'><?php echo $title->t_performance_agent_payrol ?></label>
			<input type='text' class='form-control data-sending focus-color' id='payrol' name='payrol' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->payrol ?>'>
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



			
					<!-- <div class='form-group'> 
							<label class='form-label'><?php echo $title->t_performance_agent_agentid ?></label> 
							<?php $v='';  if(isset($data)) $v = $data->agentid; 
								  echo create_cmb_database(array(	'id'			=>'agentid',
																	'name'			=>'agentid',
																	'table'			=>'sys_user',
																	'field_show'	=>'nmuser',
																	'primary_key'	=>'id', 
																	'selected'		=>$v,
																	'field_link'	=>'',
																	'class'			=>'custom-select data-sending')); 
						    ?> 
					</div> -->
					