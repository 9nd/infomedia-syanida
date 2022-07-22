
<?php echo _css('selectize,datepicker')?>

<?php echo card_open('Form','bg-green',true)?>	
	
	<form id='form-a'>
	<input hidden class='data-sending' id='id' value='<?php if(isset($id))echo $id?>'>
	
					<div class='col-md-12 col-xl-12'>				
					<div class='form-group'> 
							<label class='form-label'><?php echo $title->sys_user_detail_agentid ?></label> 
							<?php $v='';  if(isset($data)) $v = $data->agentid; 
								  echo create_cmb_database(array(	'id'			=>'agentid',
																	'name'			=>'agentid',
																	'table'			=>'sys_user',
																	'field_show'	=>'nama',
																	'primary_key'	=>'agentid', 
																	'selected'		=>$v,
																	'field_link'	=>'',
																	'class'			=>'custom-select data-sending')); 
						    ?> 
					</div>
					</div>			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_alamat ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='alamat' name='alamat' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->alamat ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_tempat_lahir ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='tempat_lahir' name='tempat_lahir' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->tempat_lahir ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_tanggal_lahir ?></label>
							<div class='input-group'>
							<span class='input-group-prepend' id='basic-addon1'>
							<span class='input-group-text'><i class="fa fa-calendar"></i></span>
							</span>
							<input readonly type='text' class='form-control data-sending input-simple-date' placeholder='<?php echo $title->general->desc_required ?>' id='tanggal_lahir' value='<?php if(isset($data)) echo $data->tanggal_lahir?>'>
							</div>
					</div>
					</div>
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_tanggal_gabung ?></label>
							<div class='input-group'>
							<span class='input-group-prepend' id='basic-addon1'>
							<span class='input-group-text'><i class="fa fa-calendar"></i></span>
							</span>
							<input readonly type='text' class='form-control data-sending input-simple-date' placeholder='<?php echo $title->general->desc_required ?>' id='tanggal_gabung' value='<?php if(isset($data)) echo $data->tanggal_gabung?>'>
							</div>
					</div>
					</div>
			
					<div class='col-md-12 col-xl-12'>				
					<div class='form-group'> 
							<label class='form-label'><?php echo $title->sys_user_detail_jenis_kelamin ?></label> 
							<?php $v='';  if(isset($data)) $v = $data->jenis_kelamin; 
								  echo create_cmb_database(array(	'id'			=>'jenis_kelamin',
																	'name'			=>'jenis_kelamin',
																	'table'			=>'jenis_kelamin',
																	'field_show'	=>'jenis_kelamin',
																	'primary_key'	=>'id', 
																	'selected'		=>$v,
																	'field_link'	=>'',
																	'class'			=>'custom-select data-sending')); 
						    ?> 
					</div>
					</div>			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_email ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='email' name='email' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->email ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>				
					<div class='form-group'> 
							<label class='form-label'><?php echo $title->sys_user_detail_status_perkawinan ?></label> 
							<?php $v='';  if(isset($data)) $v = $data->status_perkawinan; 
								  echo create_cmb_database(array(	'id'			=>'status_perkawinan',
																	'name'			=>'status_perkawinan',
																	'table'			=>'status_perkawinan',
																	'field_show'	=>'status_perkawinan',
																	'primary_key'	=>'id', 
																	'selected'		=>$v,
																	'field_link'	=>'',
																	'class'			=>'custom-select data-sending')); 
						    ?> 
					</div>
					</div>			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_kelurahan ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='kelurahan' name='kelurahan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->kelurahan ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_kecamatan ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='kecamatan' name='kecamatan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->kecamatan ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_kabupaten_kota ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='kabupaten_kota' name='kabupaten_kota' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->kabupaten_kota ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_provinsi ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='provinsi' name='provinsi' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->provinsi ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_no_hp ?></label>
							<input type='text' class='form-control data-sending focus-color ybs-input-number' id='no_hp' name='no_hp' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo number_format($data->no_hp,2) ?>' autocomplete='off'>
					</div>
					</div>
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_no_hp_lain ?></label>
							<input type='text' class='form-control data-sending focus-color ybs-input-number' id='no_hp_lain' name='no_hp_lain' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo number_format($data->no_hp_lain,2) ?>' autocomplete='off'>
					</div>
					</div>
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_no_ktp ?></label>
							<input type='text' class='form-control data-sending focus-color ybs-input-number' id='no_ktp' name='no_ktp' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo number_format($data->no_ktp,2) ?>' autocomplete='off'>
					</div>
					</div>
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_pendidikan ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='pendidikan' name='pendidikan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->pendidikan ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_jurusan ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='jurusan' name='jurusan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->jurusan ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_sekolah ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='sekolah' name='sekolah' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->sekolah ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_tahun_lulus ?></label>
							<input type='text' class='form-control data-sending focus-color ybs-input-number' id='tahun_lulus' name='tahun_lulus' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo number_format($data->tahun_lulus,2) ?>' autocomplete='off'>
					</div>
					</div>
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_no_rekening ?></label>
							<input type='text' class='form-control data-sending focus-color ybs-input-number' id='no_rekening' name='no_rekening' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo number_format($data->no_rekening,2) ?>' autocomplete='off'>
					</div>
					</div>
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_nama_bank ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='nama_bank' name='nama_bank' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->nama_bank ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->sys_user_detail_npwp ?></label>
							<input type='text' class='form-control data-sending focus-color ybs-input-number' id='npwp' name='npwp' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo number_format($data->npwp,2) ?>' autocomplete='off'>
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

