
<?php echo _css('selectize,datepicker')?>

<?php echo card_open('Form','bg-green',true)?>	
	
	<form id='form-a'>
	<input hidden class='data-sending' id='id' value='<?php if(isset($id))echo $id?>'>
	
					<div class='col-md-12 col-xl-12'>				
					<div class='form-group'> 
							<label class='form-label'><?php echo $title->trans_digital_channel_digital_channel ?></label> 
							<?php $v='';  if(isset($data)) $v = $data->digital_channel; 
								  echo create_cmb_database(array(	'id'			=>'digital_channel',
																	'name'			=>'digital_channel',
																	'table'			=>'digital_channel',
																	'field_show'	=>'channel',
																	'primary_key'	=>'id', 
																	'selected'		=>$v,
																	'field_link'	=>'',
																	'class'			=>'custom-select data-sending')); 
						    ?> 
					</div>
					</div>			
			
					<div class='col-md-12 col-xl-12'>				
					<div class='form-group'> 
							<label class='form-label'><?php echo $title->trans_digital_channel_template ?></label> 
							<?php $v='';  if(isset($data)) $v = $data->template; 
								  echo create_cmb_database(array(	'id'			=>'template',
																	'name'			=>'template',
																	'table'			=>'template_digital_channel',
																	'field_show'	=>'template',
																	'primary_key'	=>'id', 
																	'selected'		=>$v,
																	'field_link'	=>'',
																	'class'			=>'custom-select data-sending')); 
						    ?> 
					</div>
					</div>			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_digital_channel_konten_1 ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='konten_1' name='konten_1' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->konten_1 ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_digital_channel_konten_2 ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='konten_2' name='konten_2' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->konten_2 ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_digital_channel_konten_3 ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='konten_3' name='konten_3' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->konten_3 ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_digital_channel_konten_4 ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='konten_4' name='konten_4' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->konten_4 ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_digital_channel_konten_5 ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='konten_5' name='konten_5' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->konten_5 ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_digital_channel_konten ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='konten' name='konten' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->konten ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_digital_channel_distribution ?></label>
							<div class='input-group'>
							<span class='input-group-prepend' id='basic-addon1'>
							<span class='input-group-text'><i class="fa fa-calendar"></i></span>
							</span>
							<input readonly type='text' class='form-control data-sending input-simple-date' placeholder='<?php echo $title->general->desc_required ?>' id='distribution' value='<?php if(isset($data)) echo $data->distribution?>'>
							</div>
					</div>
					</div>
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_digital_channel_veri_call ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='veri_call' name='veri_call' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->veri_call ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_digital_channel_delivery ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='delivery' name='delivery' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->delivery ?>' >
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

