<!-- load css selectize--> 
<!-- tempatkan code ini pada top page view-->
<?php echo _css("selectize")?> 



<div class="col-md-12 col-xl-12">
	<div class="panel panel-info">
		<div class="panel-heading">Run Page Maintenance</div>
		<div class="panel-body">
		<form id="form-a">
		<div class="row">
		
			<div class="col-md-2 col-xl-2" > 
				<div class="form-group"> 
				<label class="form-label">Lama Hari</label> 
				<select name="days" id="select-days" class="form-control custom-select data-sending">
				<?php for ($x=0;$x<362;$x++){?>		
				  <option value="<?php echo $x ?>"><?php if($x<10){$sx="0".$x;}else{$sx=$x;};echo $sx ?></option>  
				<?php }?> 
				</select> 
				</div> 
			</div>
		
			<div class="col-md-2 col-xl-2" > 
				<div class="form-group"> 
				<label class="form-label">Jam</label> 
				<select name="hours" id="select-hours" class="form-control custom-select data-sending"> 
				<?php for ($x=0;$x<24;$x++){?>		
				  <option value="<?php echo $x ?>"><?php if($x<10){$sx="0".$x;}else{$sx=$x;};echo $sx ?></option>  
				<?php }?> 
				</select> 
				</div> 
			</div>
			
			<div class="col-md-2 col-xl-2" > 
				<div class="form-group"> 
				<label class="form-label">Menit</label> 
				<select name="minutes" id="select-minutes" class="form-control custom-select data-sending"> 
				<?php for ($x=0;$x<60;$x++){?>		
				  <option value="<?php echo $x ?>"><?php if($x<10){$sx="0".$x;}else{$sx=$x;};echo $sx ?></option>  
				<?php }?> 
					
				</select> 
				</div> 
			</div>
		
		
		</div>
		<div class="row">
		<div class="col-md-12 col-xl-12" > 
		<div class="form-group">
			<label class="form-label">Deskripsi</label>
			<input type="text" class="form-control data-sending focus-color" id="desc" name='desc' placeholder="Deskripsi" value="">
		</div>
		</div>
		</div>
		
		<div class="row">
		<div class="col-md-12 col-xl-12" > 
		<br>
		<p>Lama maintenance</p>
		<h1 id="l-time">00 HARI : 00 JAM : 00 MENIT</h1>
		
		<div class="alert alert-icon alert-danger" role="alert">
			
		  <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i>
		  <u>WARNING !!!</u><br>
		   1. Page maintenance akan di jalankan , dan hitungan mundur di mulai ketika anda menekan tombol run<br>
		   2. Seluruh Request Akan di block dan di alihkan ke page Maintenance<br>
		   3. Pastikan IP anda terdaftar agar dapat masuk kehalaman login, saat maintenance mode di jalankan<br><br>
		   <h3> IP SAYA =   <span style="background:black;color:white">&nbsp <?php echo $_SERVER['REMOTE_ADDR']?> &nbsp </span></h3>
		   <a   class="btn btn-success btn-sm" href="<?php echo $link_register_ip?>"><i class="fa fa-address-card"></i> Check Daftar IP </a>
		   <br>
		   
		</div>
		</div>
		
		
		<div class="col-md-12 col-xl-12" > 
			<div class="alert alert-icon alert-info" role="alert">
			 <i class="fe fe-check mr-2" aria-hidden="true"></i>
				<u>YOUR KEY ACCESS</u><br>
				jika anda tidak dapat mengakses halaman login,pada maintenance mode <br>
				gunakan url ini untuk mendaftarkan ip anda..
				<br>
				<br>
				<span id="linkkey"></span>
				
			</div>
			
			
			
		</div>
		
		
		
		</div>
		</form>
		<div class="form-group">
		<button id="btn-apply" type="button" class="btn btn-primary"><i class="fe fe-check"></i> Setuju</button>	
		<button disabled="" id="btn-save" type="button" class="btn btn-success"><i class="fe fe-save"></i> Simpan dan Jalankan Sekarang</button>	
		<button disabled="" id="btn-cancel" type="button" class="btn btn-primary">Batal</button>
		<a href="<?php echo $link_back ?>" id="btn-close" class="btn btn-primary">Tutup</a>
	   </div>
		
		</div>
	</div>
	
	
	
	
	
	
	
</div>










<!-- load library selectize --> 
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->
<?php echo _js("ybs,selectize")?> 

<script> 
 	$('#select-days').selectize({}); 
	$('#select-hours').selectize({}); 
	$('#select-minutes').selectize({}); 
	
	$('.custom-select').change(function(){
		var a = $('#select-days').text() + " HARI : " + $('#select-hours').text()  + " JAM : " +  $('#select-minutes').text() + " MENIT" 
		$("#l-time").html(a);
	})
	

$('#btn-apply').click(function(){
	if($('#select-days').val()=="" || $('#select-days').val()==null){
		show_error_message('Jumlah hari belum di pilih !');
		play_sound_failed();	
		$('#select-days').focus();
		return false;
	}
	
	if($('#select-hours').val()=="" || $('#select-hours').val()==null){
		show_error_message('Jumlah Jam belum di pilih !');
		play_sound_failed();	
		$('#select-hours').focus();
		return false;
	}
	if($('#select-minutes').val()=="" || $('#select-minutes').val()==null){
		show_error_message('Jumlah Menit belum di pilih !');
		play_sound_failed();	
		$('#select-minutes').focus();
		return false;
	}
	
	if($('#desc').val()=="" || $('#desc').val()==null){
		show_error_message('Deskripsi Belum di isi');
		play_sound_failed();	
		$('#desc').focus();
		return false;
	}


	apply();
	play_sound_apply();
	
})

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
}
function cancel(){
	$('.form-control').attr('disabled',false);
	$('#btn-cancel').attr('disabled',true);
	$('#btn-save').attr('disabled',true);
	$('#btn-apply').attr('disabled',false);	
}
function simpan(){
	var a 		= get_dataSending('form-a');
	
	send_data 	= ybs_dataSending(a); 
	var s = new ybsRequest();
	s.process("<?php echo $link_save?>",send_data,'POST');
	s.onSuccess = function(data){
		$("#linkkey").empty();
		$("#linkkey").append(data.message);
		show_success_message("Page Maintenance di jalankan");
		play_sound_success();
	}
	s.onAfterSuccess = function(){
		cancel();
	}
	s.onAfterFailed	  = function(data){
		cancel();
		$(data.elementid).focus();
	}
	
}

	
</script>


