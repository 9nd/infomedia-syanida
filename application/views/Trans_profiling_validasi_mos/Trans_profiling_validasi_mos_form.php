
<?php echo _css('selectize,datepicker')?>

<?php echo card_open('Form','bg-green',true)?>	
	
	<form id='form-a'>
	<input hidden class='data-sending' id='id' value='<?php if(isset($id))echo $id?>'>
	
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_idx ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='idx' name='idx' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->idx ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_ncli ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='ncli' name='ncli' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->ncli ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_no_pstn ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='no_pstn' name='no_pstn' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->no_pstn ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_no_speedy ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='no_speedy' name='no_speedy' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->no_speedy ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_nama_pelanggan ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='nama_pelanggan' name='nama_pelanggan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->nama_pelanggan ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_relasi ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='relasi' name='relasi' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->relasi ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_no_handpone ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='no_handpone' name='no_handpone' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->no_handpone ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_verfi_handphone ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='verfi_handphone' name='verfi_handphone' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->verfi_handphone ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_email ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='email' name='email' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->email ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_verfi_email ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='verfi_email' name='verfi_email' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->verfi_email ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_facebook ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='facebook' name='facebook' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->facebook ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_twitter ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='twitter' name='twitter' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->twitter ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_nama_pastel ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='nama_pastel' name='nama_pastel' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->nama_pastel ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_alamat ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='alamat' name='alamat' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->alamat ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_kota ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='kota' name='kota' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->kota ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_regional ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='regional' name='regional' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->regional ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_update_by ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='update_by' name='update_by' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->update_by ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_lup ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='lup' name='lup' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->lup ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_sumber ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='sumber' name='sumber' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->sumber ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_tgl_insert ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='tgl_insert' name='tgl_insert' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->tgl_insert ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_is_3p ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='is_3p' name='is_3p' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->is_3p ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_layanan ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='layanan' name='layanan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->layanan ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_reason_call ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='reason_call' name='reason_call' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->reason_call ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_status ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='status' name='status' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->status ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_keterangan ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='keterangan' name='keterangan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->keterangan ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_tgl_bayar ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='tgl_bayar' name='tgl_bayar' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->tgl_bayar ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_waktu_bayar ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='waktu_bayar' name='waktu_bayar' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->waktu_bayar ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_kecepatan ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='kecepatan' name='kecepatan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->kecepatan ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_tagihan ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='tagihan' name='tagihan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->tagihan ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_validasi_mos_click_time ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='click_time' name='click_time' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->click_time ?>' >
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

