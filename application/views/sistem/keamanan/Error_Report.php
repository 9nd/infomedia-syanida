<div class="col-sm-12 col-lg-12">
untuk menampilkan detail error pada browser
<br>
anda dapat  mengenabled Error Report, <br>
ini hanya untuk memudahkan dalam penelusuran error.<br>
<br>
<br>

 <div class="form-group" id="form-a">
                        <div class="form-label">Enable Error Reporting</div>
                        <label class="custom-switch">
                          <input <?php echo $select_reset ?> type="checkbox" id="select-reset" name="ereport" class="custom-switch-input data-sending" value="<?php echo $value?>">
                          <span class="custom-switch-indicator"></span>
                          <span class="custom-switch-description">Yes</span>
                        </label>
 </div>


<div class="alert alert-icon alert-danger" role="alert">
  <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> 
Untuk Keamanan <b>Disable Error Report</b> , ketika dalam kondisi <b>online / production</b>, 
  
</div>

</div>


<script>
$(document).ready(function(){
	//	getLocation();
})

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
     alert("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
 alert("Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude); 
}

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
    a.process("<?php echo $link_change_report?>",send_data,'POST');
}

</script>