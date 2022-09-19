<?php
class Template_form extends CI_Model {

function __construct(){
      parent::__construct();
}

function create_view_form($ff,$pv,$gf,$select_show_join,$field_tabel,$table,$type_input_field,$page_version){
$string = "
<?php echo _css('selectize,datepicker')?>

<?php echo card_open('Form','bg-green',true)?>	
	
	<form id='form-a'>
	<input hidden class='data-sending' id='id' value='<?php if(isset(\$id))echo \$id?>'>
	";

foreach($field_tabel as $field){
if($field !=='id' && $field !=='user_input'){
	switch($type_input_field[$field]){
			case 'combobox':
			$join =explode('___',$select_show_join[$field]);
			$table_join  = $join[0];
			$field_show  = $join[1];
			$string .= "
					<div class='col-md-12 col-xl-12'>				
					<div class='form-group'> 
							<label class='form-label'><?php echo \$title->$table"."_$field ?></label> 
							<?php \$v='';  if(isset(\$data)) \$v = \$data->$field; 
								  echo create_cmb_database(array(	'id'			=>'$field',
																	'name'			=>'$field',
																	'table'			=>'$table_join',
																	'field_show'	=>'$field_show',
																	'primary_key'	=>'id', 
																	'selected'		=>\$v,
																	'field_link'	=>'',
																	'class'			=>'custom-select data-sending')); 
						    ?> 
					</div>
					</div>			
			";
			break;
			case 'date' :
			$string .="
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo \$title->$table"."_$field ?></label>
							<div class='input-group'>
							<span class='input-group-prepend' id='basic-addon1'>
							<span class='input-group-text'><i class=\"fa fa-calendar\"></i></span>
							</span>
							<input readonly type='text' class='form-control data-sending input-simple-date' placeholder='<?php echo \$title->general->desc_required ?>' id='$field' value='<?php if(isset(\$data)) echo \$data->$field?>'>
							</div>
					</div>
					</div>
			";
			
			break;
			case 'password' :
			$string .="
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo \$title->$table"."_$field ?></label>
							<input type='password' class='form-control data-sending focus-color' id='$field' name='$field' placeholder='<?php echo \$title->general->desc_required ?>' value='<?php if(isset(\$data)) echo \$data->$field ?>'>
					</div>
					</div>
			";
			break;
			case 'number' :
			$string .="
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo \$title->$table"."_$field ?></label>
							<input type='text' class='form-control data-sending focus-color ybs-input-number' id='$field' name='$field' placeholder='<?php echo \$title->general->desc_required ?>' value='<?php if(isset(\$data)) echo number_format(\$data->$field,2) ?>' autocomplete='off'>
					</div>
					</div>
			";
			break;
			
			case 'alfa':
			$string .="
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo \$title->$table"."_$field ?></label>
							<input type='text' class='form-control data-sending focus-color input-alfa'  id='$field' name='$field' placeholder='<?php echo \$title->general->desc_required ?>' value='<?php if(isset(\$data)) echo \$data->$field ?>' >
					</div>
					</div>
			
			";
			break;
			
			case 'alfa_number':
			$string .="
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo \$title->$table"."_$field ?></label>
							<input type='text' class='form-control data-sending focus-color input-alfa-number'  id='$field' name='$field' placeholder='<?php echo \$title->general->desc_required ?>' value='<?php if(isset(\$data)) echo \$data->$field ?>' >
					</div>
					</div>
			
			";
			break;
			default :
			
			
			$string .="
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo \$title->$table"."_$field ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='$field' name='$field' placeholder='<?php echo \$title->general->desc_required ?>' value='<?php if(isset(\$data)) echo \$data->$field ?>' >
					</div>
					</div>
			
			";	
	}
}	
};	
	





$string .="				 
	
	<div class='col-md-12 col-xl-12'>

	   <div class='form-group'>
		<button id='btn-apply' type='button' class='btn btn-primary'><i class='fe fe-check'></i> <?php echo \$title->general->button_apply ?></button>	
		<button disabled='' id='btn-save' type='button' class='btn btn-primary'><i class=\"fe fe-save\"></i> <?php echo \$title->general->button_save ?></button>	
		<button disabled='' id='btn-cancel' type='button' class='btn btn-primary'> <?php echo \$title->general->button_cancel ?></button>
		<a href='<?php echo \$link_back ?>' id='btn-close' class='btn btn-primary'> <?php echo \$title->general->button_close ?></a>
	   </div>
			 
	</div>
	</form>


<?php echo card_close()?>

<?php echo _js('selectize,datepicker')?>

<script>var page_version=\"".$page_version."\"</script>

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
	|  - isi \"field_link\" pada combobox target 
	| 	 'field_link'	=>'nama_field_join_database'.
	|  - gunakan class \"custom-select-link\" pada kedua combobox ,
	|	 referensi dan target.
	|  - tambahkan script :
	|     linkToSelectize('id_cmb_referensi','id_cmb_target');
	|--------------------------------------------------------------
	| note :
	|   - struktur database harus menggunakan field id sebagai primary key
	|   - combobox harus di buat dengan php code
	|	-  \"create_cmb_database\" untuk row < 1000
	|	-  dan linkToSelectize untuk row < 1000
	|
	|	-  \"create_cmb_database_bigdata\" untuk row > 1000
	|	-  dan linkToSelectize_Big untuk row > 1000
	|   - 
	|   - class harus menggunakan \"custom-select-link\"
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
	a.process('<?php echo \$link_save?>',send_data,'POST');
	a.onAfterSuccess = function(){
			cancel();
	}
	a.onBeforeFailed = function(){
			cancel();
	}
}


</script>

";







$result = _createFile($string,$pv,$ff .'.php');		
return $result;		
}





}	