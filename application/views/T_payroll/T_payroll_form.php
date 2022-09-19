
<?php echo _css('selectize,datepicker')?>

<?php echo card_open('Form','bg-green',true)?>	
	
	<form id='form-a'>
	<input hidden class='data-sending' id='id' value='<?php if(isset($id))echo $id?>'>
	
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_agentid ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='agentid' name='agentid' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->agentid ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_kehadiran ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='kehadiran' name='kehadiran' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->kehadiran ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_contacted ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='contacted' name='contacted' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->contacted ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_verified ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='verified' name='verified' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->verified ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_tenur ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='tenur' name='tenur' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->tenur ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_pendidikan ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='pendidikan' name='pendidikan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->pendidikan ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_score ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='score' name='score' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->score ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_level ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='level' name='level' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->level ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_akomodasi ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='akomodasi' name='akomodasi' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->akomodasi ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_t_trasnport ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='t_trasnport' name='t_trasnport' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->t_trasnport ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_komisi ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='komisi' name='komisi' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->komisi ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_tunj_level ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='tunj_level' name='tunj_level' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->tunj_level ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_tunj_jabatan ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='tunj_jabatan' name='tunj_jabatan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->tunj_jabatan ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_thp_leveling ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='thp_leveling' name='thp_leveling' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->thp_leveling ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_ot_moss ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='ot_moss' name='ot_moss' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->ot_moss ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_other_fee ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='other_fee' name='other_fee' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->other_fee ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_tunj_skill ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='tunj_skill' name='tunj_skill' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->tunj_skill ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_perbantuan_hpemail ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='perbantuan_hpemail' name='perbantuan_hpemail' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->perbantuan_hpemail ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_perbantuan_hponly ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='perbantuan_hponly' name='perbantuan_hponly' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->perbantuan_hponly ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_nominal_perbantuan ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='nominal_perbantuan' name='nominal_perbantuan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->nominal_perbantuan ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_total_thp ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='total_thp' name='total_thp' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->total_thp ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_non_thp ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='non_thp' name='non_thp' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->non_thp ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_benefit_lain ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='benefit_lain' name='benefit_lain' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->benefit_lain ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_m_fee ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='m_fee' name='m_fee' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->m_fee ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->t_payroll_headcount ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='headcount' name='headcount' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->headcount ?>' >
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


<?php echo card_close()?>

<?php echo _js('selectize,datepicker')?>

<script>var page_version="1.0.8"</script>

<script> 
var custom_select = $('.custom-select').selectize({}); 	
var custom_select_link = $('.custom-select-link');

$(document).ready(function(){
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

	
$('.data-sending').keydown(function(e){
	remove_message();
	switch(e.which){
		case 13 :
		apply();
		return false;
	}
});

</script>

<script>
$('.input-simple-date').datepicker({ 
		autoclose: true ,
		format:'dd.mm.yyyy',
 })

$('#btn-apply').click(function(){
		apply();
		play_sound_apply();
});

$('#btn-close').click(function(){
	play_sound_apply();
});

$('#btn-cancel').click(function(){
	cancel();
	play_sound_apply();
});

$('#btn-save').click(function(){
	simpan();
})

function apply(){
	$.each(custom_select,function(key,val){
		val.selectize.disable();
	});
	
	<?php 
	// NOTE : FOR DISABLE CUSTOM-SELECT-LINK 
	?>
	// $.each(custom_select_link,function(key,val){
	// 		val.selectize.disable();
	// });
	
	$('.form-control').attr('disabled',true);
	$('#btn-apply').attr('disabled',true);
	$('#btn-cancel').attr('disabled',false);
	$('#btn-save').attr('disabled',false);
	$('#btn-save').focus();
}
function cancel(){
	$.each(custom_select,function(key,val){
		val.selectize.enable();
	});
	<?php 
	// NOTE : FOR ENABLE CUSTOM-SELECT-LINK  
	?>
	// $.each(custom_select_link,function(key,val){
	// 		val.selectize.enable();
	// });
	
	$('.form-control').attr('disabled',false);
	$('#btn-cancel').attr('disabled',true);
	$('#btn-save').attr('disabled',true);
	$('#btn-apply').attr('disabled',false);
	
}


function simpan(){
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
	a.process('<?php echo $link_save?>',send_data,'POST');
	a.onAfterSuccess = function(){
			cancel();
	}
	a.onBeforeFailed = function(){
			cancel();
	}
}


</script>

