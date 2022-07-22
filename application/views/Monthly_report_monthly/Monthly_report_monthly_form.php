
<?php echo _css('selectize,datepicker')?>

<?php echo card_open('Form','bg-green',true)?>	
	
	<form id='form-a'>
	<input hidden class='data-sending' id='id' value='<?php if(isset($id))echo $id?>'>
	
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_tahun ?></label>
							<input type='text' class='form-control data-sending focus-color ybs-input-number' id='tahun' name='tahun' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo number_format($data->tahun,2) ?>' autocomplete='off'>
					</div>
					</div>
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_bulan ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='bulan' name='bulan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->bulan ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_last_update ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='last_update' name='last_update' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->last_update ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_best_agent ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='best_agent' name='best_agent' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->best_agent ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_best_teamleader ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='best_teamleader' name='best_teamleader' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->best_teamleader ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_verified_best_agent ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='verified_best_agent' name='verified_best_agent' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->verified_best_agent ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_verified_best_teamleader ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='verified_best_teamleader' name='verified_best_teamleader' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->verified_best_teamleader ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_best_agent_moss ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='best_agent_moss' name='best_agent_moss' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->best_agent_moss ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_slg_best_agent_moss ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='slg_best_agent_moss' name='slg_best_agent_moss' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->slg_best_agent_moss ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_best_teamleader_moss ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='best_teamleader_moss' name='best_teamleader_moss' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->best_teamleader_moss ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_slg_best_teamleader_moss ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='slg_best_teamleader_moss' name='slg_best_teamleader_moss' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->slg_best_teamleader_moss ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_verified ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='verified' name='verified' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->verified ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_co ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='co' name='co' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->co ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_contacted ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='contacted' name='contacted' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->contacted ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_not_contacted ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='not_contacted' name='not_contacted' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->not_contacted ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_hp_email ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='hp_email' name='hp_email' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->hp_email ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_hp_only ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='hp_only' name='hp_only' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->hp_only ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_agent_1 ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='agent_1' name='agent_1' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->agent_1 ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_agent_1_num ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='agent_1_num' name='agent_1_num' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->agent_1_num ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_agent_2 ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='agent_2' name='agent_2' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->agent_2 ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_agent_2_num ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='agent_2_num' name='agent_2_num' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->agent_2_num ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_agent_3 ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='agent_3' name='agent_3' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->agent_3 ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_agent_3_num ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='agent_3_num' name='agent_3_num' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->agent_3_num ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_agent_4 ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='agent_4' name='agent_4' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->agent_4 ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_agent_4_num ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='agent_4_num' name='agent_4_num' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->agent_4_num ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_agent_5 ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='agent_5' name='agent_5' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->agent_5 ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_agent_5_num ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='agent_5_num' name='agent_5_num' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->agent_5_num ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_agent_6 ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='agent_6' name='agent_6' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->agent_6 ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_agent_6_num ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='agent_6_num' name='agent_6_num' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->agent_6_num ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->monthly_report_monthly_agent_online ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='agent_online' name='agent_online' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->agent_online ?>' >
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

