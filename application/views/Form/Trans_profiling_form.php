
<?php echo _css('selectize,datepicker')?>

<?php echo card_open('Form','bg-green',true)?>	
	
	<form id='form-a'>
	<input hidden class='data-sending' id='id' value='<?php if(isset($id))echo $id?>'>
	
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_idx ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='idx' name='idx' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->idx ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_ncli ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='ncli' name='ncli' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->ncli ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_nama ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='nama' name='nama' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->nama ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_pstn1 ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='pstn1' name='pstn1' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->pstn1 ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_no_speedy ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='no_speedy' name='no_speedy' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->no_speedy ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_kepemilikan ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='kepemilikan' name='kepemilikan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->kepemilikan ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_facebook ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='facebook' name='facebook' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->facebook ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_verfi_fb ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='verfi_fb' name='verfi_fb' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->verfi_fb ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_twitter ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='twitter' name='twitter' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->twitter ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_verfi_twitter ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='verfi_twitter' name='verfi_twitter' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->verfi_twitter ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_relasi ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='relasi' name='relasi' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->relasi ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_email ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='email' name='email' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->email ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_verfi_email ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='verfi_email' name='verfi_email' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->verfi_email ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_lup_email ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='lup_email' name='lup_email' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->lup_email ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_email_lain ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='email_lain' name='email_lain' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->email_lain ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_handphone ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='handphone' name='handphone' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->handphone ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_verfi_handphone ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='verfi_handphone' name='verfi_handphone' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->verfi_handphone ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_lup_handphone ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='lup_handphone' name='lup_handphone' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->lup_handphone ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_nama_pastel ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='nama_pastel' name='nama_pastel' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->nama_pastel ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_alamat ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='alamat' name='alamat' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->alamat ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_kota ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='kota' name='kota' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->kota ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_waktu_psb ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='waktu_psb' name='waktu_psb' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->waktu_psb ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_kec_speedy ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='kec_speedy' name='kec_speedy' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->kec_speedy ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_billing ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='billing' name='billing' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->billing ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_payment ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='payment' name='payment' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->payment ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_tgl_lahir ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='tgl_lahir' name='tgl_lahir' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->tgl_lahir ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_status ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='status' name='status' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->status ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_profiling_by ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='profiling_by' name='profiling_by' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->profiling_by ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_click_sms ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='click_sms' name='click_sms' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->click_sms ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_click_email ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='click_email' name='click_email' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->click_email ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_ip_address ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='ip_address' name='ip_address' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->ip_address ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_date_created ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='date_created' name='date_created' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->date_created ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_hub_pemilik ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='hub_pemilik' name='hub_pemilik' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->hub_pemilik ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_veri_distribusi ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='veri_distribusi' name='veri_distribusi' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->veri_distribusi ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_veri_count ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='veri_count' name='veri_count' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->veri_count ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_veri_status ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='veri_status' name='veri_status' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->veri_status ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>				
					<div class='form-group'> 
							<label class='form-label'><?php echo $title->trans_profiling_veri_call ?></label> 
							<?php $v='';  if(isset($data)) $v = $data->veri_call; 
								  echo create_cmb_database(array(	'id'			=>'veri_call',
																	'name'			=>'veri_call',
																	'table'			=>'status_call',
																	'field_show'	=>'nama_reason',
																	'primary_key'	=>'id', 
																	'selected'		=>$v,
																	'field_link'	=>'',
																	'class'			=>'custom-select data-sending')); 
						    ?> 
					</div>
					</div>			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_veri_keterangan ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='veri_keterangan' name='veri_keterangan' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->veri_keterangan ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>				
					<div class='form-group'> 
							<label class='form-label'><?php echo $title->trans_profiling_veri_upd ?></label> 
							<?php $v='';  if(isset($data)) $v = $data->veri_upd; 
								  echo create_cmb_database(array(	'id'			=>'veri_upd',
																	'name'			=>'veri_upd',
																	'table'			=>'sys_user',
																	'field_show'	=>'nama',
																	'primary_key'	=>'id', 
																	'selected'		=>$v,
																	'field_link'	=>'',
																	'class'			=>'custom-select data-sending')); 
						    ?> 
					</div>
					</div>			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_veri_lup ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='veri_lup' name='veri_lup' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->veri_lup ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_lup ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='lup' name='lup' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->lup ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_click_session ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='click_session' name='click_session' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->click_session ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_division ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='division' name='division' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->division ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_witel ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='witel' name='witel' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->witel ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_kandatel ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='kandatel' name='kandatel' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->kandatel ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_regional ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='regional' name='regional' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->regional ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_veri_system ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='veri_system' name='veri_system' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->veri_system ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_nik ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='nik' name='nik' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->nik ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_no_kk ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='no_kk' name='no_kk' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->no_kk ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_nama_ibu_kandung ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='nama_ibu_kandung' name='nama_ibu_kandung' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->nama_ibu_kandung ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_path ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='path' name='path' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->path ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_instagram ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='instagram' name='instagram' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->instagram ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_handphone_lain ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='handphone_lain' name='handphone_lain' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->handphone_lain ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->trans_profiling_opsi_call ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='opsi_call' name='opsi_call' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->opsi_call ?>' >
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

