<?php echo _css('selectize')?>

<div class="col-md-12 col-xl-12">
<?php echo card_open('<i class="fe fe-list"> </i> ','bg-red',true)?>
<form id="form-a">
<input hidden class="data-sending" id="id" value="<?php echo $id ?>">
<div class="form-group">
                        <label class="form-label">Type Menu</label>
                        <select  id="select-type-menu" name='is_parent' class="form-control data-sending focus-color" >
                        <option value="0" >Menu Utama</option>
						<option value="1" >Sub Menu</option>
                        </select>
						
</div>

<br>
<div id="menu-utama" class="form-group" style="display:none">
                        <label class="form-label">Pilih Menu Utama</label>
						<select id="select-menu-parent" name="menu_parent"  class="form-control custom-select data-sending focus-color">
						</select>
</div>


<div class="form-group">
    <label class="form-label">Menu</label>
    <input type="text" class="form-control data-sending focus-color" id="input-nama-menu" name='name' placeholder="Nama menu" value="<?php echo $menu_name?>">
</div>
  <div class="form-group">
    <label class="form-label">icon menu</label>
	
	 <?php echo create_select_icon('input-icon-menu');?>
	
 </div>

 
   <div class="form-group">
    <label class="form-label">Pilih URL</label>
		<select id="select-url" class="form-control data-sending custom-select focus-color" name='id_form'>
			<option value="1"  data-data='{"icon": "# "}'>--NO LINK-- </option>
			<?php foreach($list_urlform as $key =>$val){ ?>
				<option value="<?php echo $val['id']?>"  data-data='{"icon": "fe fe-link "}'>"<?php echo $val['form_name']?> " </option>
			<?php }?>
			
		</select>
		<small id='note-link' style="display:none"><p class="text-blue">* note : tidak di  akan jalankan jika <b>"Menu Utama"</b>  memiliki sub menu</p></small>  	
	</div>
 
   <div class="form-group">
	<button id="btn-apply" type="button" class="btn btn-primary"><i class="fe fe-check"></i> Setuju</button>	
	<button disabled id="btn-save" type="button" class="btn btn-primary"><i class="fe fe-save"></i> Simpan</button>	
	<button disabled id="btn-cancel" type="button" class="btn btn-primary">Batal</button>
	<a  href="<?php echo $link_back?>" id="btn-close" class="btn btn-primary">Tutup</a>
   </div>
</form>
 


<br>
<br>
<br>
<br>
<br>

<?php echo card_close()?>
</div>

<?php echo _js('selectize')?>
<script>
var  selectize_url,selectize_icon,selectize_menuutama;
$(document).ready(function(){

	var select = $('#input-icon-menu').selectize({
          render: {
					option: function (data, escape) {
					   return '<div>' +
					  '<span class="icon"><i class="'+data.icon+'"> </i> </span>' +
					  '<span class="title"> ' + escape(data.text) + ' </span>' +
					  '</div>';
					  },
					item: function (data, escape) {
					return '<div>' +
					  '<span class="icon"> <i class="'+data.icon+'"> </i> </span>' +
					   escape(data.text) +
					  '</div>';
					}
                 }
      });
	  	  

	selectize_icon = select[0].selectize;
	var a = selectize_icon.search("<?php echo $menu_icon?>").items[0];
	if(a !==undefined){
		selectize_icon.setValue(a.id);	
	}
	
	
	
	var select_url = $('#select-url').selectize({
                   render: {
					option: function (data, escape) {
					   return '<div>' +
					  '<span class="icon"><i class="'+data.icon+'"> </i> </span>' +
					  '<span class="title"> ' + escape(data.text) + ' </span>' +
					  '</div>';
					  },
					item: function (data, escape) {
					return '<div>' +
					  '<span class="icon"> <i class="'+data.icon+'"> </i> </span>' +
					   escape(data.text) +
					  '</div>';
					}
                 }
      });
	  	  

	selectize_url = select_url[0].selectize;
	selectize_url.setValue("<?php echo $selected_link?>");	
	//var bb = selectize_url.search("<?php echo $selected_link?>").items[0];
	//if(bb !==undefined){
	//	alert(bb.id);
		// selectize_url.setValue(bb.id);	
	//}
	

	 
	  
	   
})


$('#select-type-menu').ready(function(){
	$('#select-type-menu').val("<?php echo $selected_type?>");	
	$('#select-type-menu').change();
})


$('.data-sending').keydown(function(e){
	remove_message();
	switch(e.which){
		case 13 :
		apply();
		return false;
	}
});
	
$('#select-type-menu').change(function(){
	var x = $('#select-type-menu').val();
	if(x==0){
		$('#select-menu-parent option').remove();
		$('#menu-utama').css({'display':'none'});
		$('#note-link').css('display','block');
	
		
	}else{
		$('#menu-utama').css('display','block');
		$('#note-link').css({'display':'none'});
		get_parent_menu();
	}
});

function get_parent_menu(){
	
	var a = new ybsRequest();
	a.process("<?php echo $link_get_parent_menu?>",'');
	a.onSuccess  = function(data){
		$('#select-menu-parent option').remove();
		var opt;
		var selected_parent = "<?php echo $selected_parent?>";
		$.each(data.message,function(key,val){
			
			if(val.id==selected_parent){
				opt = opt + '<option selected value="'+val.id+'">'+val.name+'</option>'
		    }else{
				opt = opt + '<option value="'+val.id+'">'+val.name+'</option>'
			}
			
			
		});
		
		$('#select-menu-parent').append(opt);
		
	
	}
	
}


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
	if($('#select-type-menu').val()==1 && $('#select-menu-parent').val()==null ){
		show_error_message('Menu Utama belum dipilih');
		play_sound_failed();	
		$('#select-menu-parent').focus();
		return false;
	}
	
	if($('#input-nama-menu').val()=="" ||$('#input-nama-menu').val()==null){
		show_error_message('Nama menu tidak boleh kosong !');
		play_sound_failed();	
		$('#input-nama-menu').focus();
		return false;
	}
	
	selectize_url.disable();
	selectize_icon.disable();


	$('.form-control').attr('disabled',true);
	$('#btn-apply').attr('disabled',true);
	$('#btn-cancel').attr('disabled',false);
	$('#btn-save').attr('disabled',false);
	$('#btn-save').focus();
}
function cancel(){
	selectize_url.enable();
	selectize_icon.enable();


	
	$('.form-control').attr('disabled',false);
	$('#btn-cancel').attr('disabled',true);
	$('#btn-save').attr('disabled',true);
	$('#btn-apply').attr('disabled',false);
	
}

function simpan(){
	send_data = ybs_dataSending(get_dataSending('form-a'));

	var a = new ybsRequest();
	a.process("<?php echo $link_save?>",send_data,'POST');
	a.onAfterSuccess = function(){
			cancel();
	}
}


</script>