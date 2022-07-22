<!-- load css selectize--> 
<!-- tempatkan code ini pada top page view-->
<?php echo _css("selectize")?> 




<div class="col-md-12 col-xl-12">
	<div class="panel panel-primary">
		<div class="panel-heading">Allow Access File</div>
		<div class="panel-body">
		<form id="form-a">
				<div class="col-md-12 col-xl-12" > 
					<div class="form-group"> 
					<label class="text-red">Pilih controller front-end</label> 
					<select name="fc" id="fc" class="form-control custom-select data-sending"> 
								
						<?php foreach($file_controller as $val){
								$selected = "";$text = $val;
								if(strtolower($selected_file)==strtolower($val)){
									$selected = "selected";
								}
								if($val=="Auth"){
									$text = $val . " (Default Login Form)";
								}
								echo  "<option $selected value=\"$val\">$text</option>";
							   
							  }
						?>
					</select> 
					
					</div> 
					<br>
					<div class="form-group"> 
					<label class="text-red">Function</label> 
						<select name="function" id="function" class="form-control custom-select data-sending"> 
						</select> 
					</div> 
					
					
				</div>
		
		<br>
		<br>

		
	   <div class="form-group">
		<button id="btn-apply" type="button" class="btn btn-primary"><i class="fe fe-check"></i> Setuju</button>	
		<button disabled="" id="btn-save" type="button" class="btn btn-primary"><i class="fe fe-save"></i> Simpan</button>	
		<button disabled="" id="btn-cancel" type="button" class="btn btn-primary">Batal</button>
		<a href="<?php echo $link_back?>" id="btn-close" class="btn btn-primary">Tutup</a>
	   </div>
			 
	
		
		
		</form>
		</div>
	</div>
</div>


			








<!-- load library selectize --> 
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->
<?php echo _js("ybs,selectize")?> 
<script> 
 	$('#fc').selectize({}); 
</script>



<script>
var select_file;

$('#fc').change(function(){
	get_function();
});



$(document).ready(function(){
	var select = $('#fc').selectize({});
	select_file = select[0].selectize;
	
	get_function();
});

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

	select_file.disable();
		
	$('.form-control').attr('disabled',true);
	$('#btn-apply').attr('disabled',true);
	$('#btn-cancel').attr('disabled',false);
	$('#btn-save').attr('disabled',false);
	$('#btn-save').focus();
}
function cancel(){
	select_file.enable();
	$('.form-control').attr('disabled',false);
	$('#btn-cancel').attr('disabled',true);
	$('#btn-save').attr('disabled',true);
	$('#btn-apply').attr('disabled',false);
	
}


function get_function(){
	
	$('#function option').remove();
	
	var d = get_json_format('file',$('#fc').val());
	
	send_data  = ybs_dataSending([d]);
	
	var a = new ybsRequest();
	a.process("<?php echo $link_getfunction ?>",send_data,'GET');
	
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
		
		
		
		
		
		
	}
}

function simpan(){
	var data = get_dataSending('form-a');
	send_data = ybs_dataSending(data);
	var a = new ybsRequest();
	a.process("<?php echo $link_setrouter?>",send_data,"POST");
	cancel();
}


</script>
