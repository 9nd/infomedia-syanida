<div class="col-md-12 col-xl-12">
<?php echo card_open('<i class="fe fe-list"> Reset Password</i> ','bg-red',true)?>
<form id="form-a">
<div class="form-group" style="display:block">
    <label class="form-label">Masukkan Password Anda</label>
    <input type="password" class="form-control data-sending focus-color" id="old-pass" name='old_pass' placeholder="Password" value="">

<br>
</div>


<div class="form-group input-pass" style="display:none">
    <label class="form-label">New Password</label>
    <input type="password" class="form-control focus-color" id="new-pass" name='new_pass' placeholder="Password" value="">
</div>

<div class="form-group input-pass" style="display:none">
    <label class="form-label">Konfirm Password</label>
    <input type="password" class="form-control focus-color" id="re-pass" name='re_pass' placeholder="Password" value="">
</div>

 <br>
 <br>
 
   <div class="form-group input-pass" style="display:none">
	<button id="btn-apply" type="button" class="btn btn-primary" onclick="simpan()"><i class="fe fe-check"></i> Setuju</button>	
	<button disabled id="btn-save" type="button" class="btn btn-primary"><i class="fe fe-save"></i> Simpan</button>	
	<button id="btn-cancel" type="button" class="btn btn-primary">Batal</button>
   </div>
</form>
 


<br>
<br>
<br>
<br>
<br>

<?php echo card_close()?>
</div>



<script>
$('#old-pass').keydown(function(e){
	switch(e.which){
		case 13:
		pass_check();
		break;
	}
});


$('#new-pass, #re-pass').keydown(function(e){
	switch(e.which){
		case 13:
		simpan();
		break;
	}
	
});

$('#btn-cancel').click(function(){
	batal();
});

function batal(){
	$('#old-pass').attr('disabled',false);
	$('.input-pass').css('display','none');
	$('#re-pass').val('');
	$('#new-pass').val('');
	
	$('#re-pass').removeClass('data-sending');
	$('#new-pass').removeClass('data-sending');
	$('#old-pass').addClass('data-sending');
	
	$('#old-pass').val('');
	$('#old-pass').focus();
}

function pass_check(){
	var data = get_dataSending('form-a');
	var send_data = ybs_dataSending(data);	
	var a = new ybsRequest();
	a.process("<?php echo $link_check?>",send_data,'POST');
	a.onSuccess = function(data){
		$('#old-pass').attr('disabled',true);
		$('.input-pass').css('display','block');
		
		$('#re-pass').addClass('data-sending');
		$('#new-pass').addClass('data-sending');
		$('#old-pass').removeClass('data-sending');

		$('#new-pass').focus();
	};
	
	a.onFailed  = function(){
		batal();
	};
}

function simpan(){
 var data = get_dataSending('form-a');	
 send_data = ybs_dataSending(data);
 var a = new ybsRequest();
 a.process("<?php echo $link_update?>",send_data,'POST'); 
 a.onAfterSuccess = function(){
	 batal();
 }
 
}



</script>