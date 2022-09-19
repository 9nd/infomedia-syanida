<div class="col-sm-12 col-lg-12">
<div style="font-size:14px">
Untuk Menambah Keamanan Sistem 
<br>
anda dapat  mengaktifkan CSRF PROTECTION, <br>
<br>
CSRF PROTECTION berfungsi mencegah percobaan request dari luar sistem.
<br>
<br>


<div class="alert alert-icon alert-danger" role="alert">
  <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> 
jika anda mengaktifkan CSRF PROTECTION, maka anda tidak dapat membuka 2 tab halaman sekaligus</b>, 
  
</div>


 <div class="form-group" id="form-a">
                        <div class="form-label">Aktifkan CSRF PROTECTION</div>
                        <label class="custom-switch">
                          <input <?php echo $select_reset ?> type="checkbox" id="select-reset" name="reset" class="custom-switch-input data-sending" value="<?php echo $value?>">
                          <span class="custom-switch-indicator"></span>
                          <span class="custom-switch-description">Yes</span>
                        </label>
 </div>

</div>

</div>



<script>
$(document).ready(function(){
	
})




$('#select-reset').change(function(){

		if($('#select-reset').val()=='off'){
			$('#select-reset').val('on');
			change_error_report();
		}else{
			$('#select-reset').val('off');
			change_error_report();
		}
})

function change_error_report(){
	var a = new ybsRequest();
	var aa = get_dataSending('form-a');
    
	var b = get_json_format('token',data_token);
	
	aa.push(b);
	send_data = ybs_dataSending(aa);
    a.process("<?php echo $link_change?>",send_data,'POST');
}

</script>