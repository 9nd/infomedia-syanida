<?php echo _css('selectize')?>
<div class="col-md-12 col-xl-12">
<?php echo card_open('<i class="fe fe-list"> </i> ','bg-red',true)?>
<form id="form-a">
<input hidden class="data-sending" id="id" value="<?php echo $id?>">

	<div class="form-group">
                        <label class="form-label">Folder Controller</label>
                        <select  id="select-folder" name='select-folder' class="form-control data-sending custom-select focus-color">
						<option value="pilih_folder" >--Pilih Folder--</option>
						<?php foreach($folder_controller as $key=>$val){?>
							<option value="<?php echo $val?>" ><?php echo $val?></option>
						<?php }?>
                        </select>
	</div>

  <div class="form-group">
    <label class="form-label">File -- Function</label>
	<div class="input-group">
		<span class="input-group-prepend" id="basic-addon3">
			 <select  id="select-file" name='select-file' class="form-control custom-select focus-color" >                       
             </select>
		 </span>	
		<span class="input-group-prepend " id="basic-addon12">
			 <select  id="function" name='function' class="form-control custom-select focus-color" >                       
             </select>
		</span>

    </div>
	<br>
	 <a href="javascript:void(0)" class="form-label label-link-form data-sending" id="label-link-form" name="link"  target="_blank" value="" >url : -</a>
 
 <br>


 </div>

<div class="form-group">
    <label class="form-label">Nama URL / Form</label>
    <input type="text" class="form-control data-sending focus-color" id="input-nama-form" name='form_name' placeholder="Nama URL / Form" value="<?php echo $form_name?>">
</div>

<div class="form-group">
    <label class="form-label">Kode URL / Form</label>
    <input type="text" class="form-control data-sending focus-color" id="input-kode-form" name='code' placeholder="Kode URL / Form" value="<?php echo $code?>">
	<small> <span class="text-blue">*for next fiture</span> </small>
</div>
  
<div class="form-group">
                        <label class="form-label">Shortcut</label>
                        <select  id="select-shortcut-form" name='shortcut' class="form-control data-sending custom-select focus-color" >
                        <option selected value="1" >YES</option>
						<option value="2" >NO</option>
                        </select>
						<small> <span class="text-blue">*for shortcut menu</span> </small>
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
$('#select-folder').ready(function(){
	$('#select-folder').val('<?php echo $selected_folder?>');
	var a = $('#select-folder').val();
	get_file(a);
	
});
$('#select-folder').change(function(){
	var a = $('#select-folder').val();
	get_file(a);
});

$('#select-file').change(function(){
	var a = $('#select-file').val();
	var f = $('#select-folder').val();
	get_function(f,a);
});

function get_file(fname){
	
	//mencegah request jika folder belum dipilih
	if(fname =='pilih_folder'){
		clear_select_file();
		return;
	}
	var n = get_json_format('name',fname);
	send_data = ybs_dataSending([n]);
	
	var a = new ybsRequest();
	 a.process("<?php echo $link_getfile?>",send_data);
	 a.onSuccess = function(data){
		clear_select_file();
		 var ha="";
		 $.each(data.message,function(key,val){
			 var selected = "<?php echo $selected_file?>";
			 if(val.trim()==selected.trim()){
				 ha =ha + '<option selected value="'+val+'" >'+val+'</option>';
			 }else{
				 ha =ha + '<option value="'+val+'" >'+val+'</option>';
			 }
		 });
		 $('#select-file').append(ha);
		 $('#select-file').change();
	}
		 
}

function clear_select_file(){
	$('#function option').remove();
	$('#select-file option').remove();
	$('.label-link-form').text(" url  : - ");
	$('.label-link-form').val('');
	$('.label-link-form').attr('href',"javascript:void(0)");
}
	


function get_function(fname,cname){


 
 if(cname==null || cname=="" ){
	 clear_select_file();
	 return;
 }	
 
 $('#function option').remove();	
 var n = get_json_format('name',cname);
 var fol = get_json_format('folder',fname);
 send_data = ybs_dataSending([fol,n]);
 
 var a = new ybsRequest();
 a.process("<?php echo $link_getfunction?>",send_data);
 a.onSuccess = function(data){

	 var ha="";
	
	 $.each(data.message,function(key,val){
		 var selected = "<?php echo $selected_function?>";
		 
		 if(val.trim()==selected.trim()){
			 ha =ha + '<option selected value="'+val+'" >'+val+'</option>';
		 }else{
			 ha =ha + '<option value="'+val+'" >'+val+'</option>';
		 }
		
		
	})
	$('#function').append(ha);

	var f = $('#function').val();
	set_url_link(fname,cname,f);
 }
 
}


function set_url_link(fname,cname,f){
	var folder=""
	folder = fname + '/';
	switch(f){
		case null:
			$('.label-link-form').text(" url  : - ");
			$('.label-link-form').val('');
			$('.label-link-form').attr('href',"javascript:void(0)");
			break;
		case 'index':
			$('.label-link-form').text(" url  : <?php echo site_url()?>"+folder+cname);
			$('.label-link-form').val(folder+cname);
			$('.label-link-form').attr('href',"<?php echo site_url()?>"+folder+cname);
			break;
		default :
			$('.label-link-form').text(" url  : <?php echo site_url()?>"+folder+cname+'/'+f);
			$('.label-link-form').val(folder+cname+'/'+f);
			$('.label-link-form').attr('href',"<?php echo site_url()?>"+folder+cname+'/'+f);
			break;
	}
	
}


$('#function').change(function(){
		   var fname = $('#select-folder').val();
		   var cname = $('#select-file').val();
		   var f = $(this).val();
		   
		   set_url_link(fname,cname,f);			
}); 




$('#select-shortcut-form').ready(function(){
	$('#select-shortcut-form').val("<?php echo $selected_shortcut?>");	
	$('#select-shortcut-form').change();
})

$('.data-sending').keydown(function(e){
	switch(e.which){
		case 13:
		$('#btn-apply').click();
		break;
	}
})
	



$('#btn-apply').click(function(){
	
	if($('#label-link-form').val()=="" ||$('#label-link-form').val()==null){
		show_error_message('Link URL tidak boleh kosong !');
		play_sound_failed();	
		$('#label-link-form').focus();
			return;
	}
	if($('#input-nama-form').val()=="" ||$('#input-nama-form').val()==null){
		show_error_message('Nama URL / Form tidak boleh kosong !');
		play_sound_failed();	
		$('#input-nama-form').focus();
		return;
	}
	
	if($('#input-kode-form').val()=="" ||$('#input-kode-form').val()==null){
		show_error_message('Kode Form tidak boleh kosong !');
		play_sound_failed();	
		$('#input-kode-form').focus();
		return;
	}else{
		apply();
		play_sound_apply();
	}
	
	
	
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
	$('.form-control').attr('disabled',true);
	$('#btn-apply').attr('disabled',true);
	$('#btn-cancel').attr('disabled',false);
	$('#btn-save').attr('disabled',false);
	$('#btn-controller').attr('disabled',true);
}
function cancel(){
	$('.form-control').attr('disabled',false);
	$('#btn-cancel').attr('disabled',true);
	$('#btn-save').attr('disabled',true);
	$('#btn-apply').attr('disabled',false);
	$('#btn-controller').attr('disabled',false);
	
	
}

function simpan(){
	send_data = ybs_dataSending(get_dataSending('form-a'));

	var a = new ybsRequest();
	a.process("<?php echo $link_save?>",send_data,'POST');
	a.onAfterSuccess = function(){
			cancel();
	}
	a.onFailed =function(data){
		cancel();
		$(data.elementid).focus();
		show_error_message(data.message);
	}
}


</script>