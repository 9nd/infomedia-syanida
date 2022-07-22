<?php echo _css('datatables,icheck,selectize')?>

<div class="col-md-12 col-xl-12" > 
	<?php echo card_open('Generator','bg-green',true)?> 

		
		<div class="col-md-12 col-xl-12" >
		<div class="form-group">
		 <label class="form-label">petunjuk:</label>
		<textarea id="text-code-petunjuk" class="form-control bg-dark text-white" rows="3" readonly></textarea>
		</div>			
		</div>

	
		<form id="form-a">
		<br>
		<div class="col-md-12 col-xl-12" > 
		<div class="form-group"> 
					<label class="form-label">Pilih Table data base</label> 
					<select id="select-table-db" name='table_name' class="form-control data-sending custom-select focus-color"> 
					<option value="none">--pilih table--</option> 
					<?php foreach($table_list as $val){?>
						 <option value="<?php echo $val?>"><?php echo $val?></option> 
					<?php }?>
					</select> 
		</div> 
		<br>
		</div>
		
		<div class="col-md-12 col-xl-12" > 
		<div class="form-group">
		<label class="form-label">Folder Name</label>
		<input type="text" class="form-control data-sending focus-color" id="general-folder" name="general_folder" placeholder="">
		</div>
		</div>
		
		<div class="col-md-12 col-xl-12" > 
		<div class="form-group">
		<label class="form-label">File Name</label>
		<input type="text" class="form-control data-sending focus-color" id="general-file-name" name="general_file_name" placeholder="">
		<br>
		<a href="javascript:void(0)" class="form-label label-link-form" id="label-link-form" name="link"  value="" target="_blank">Output URL : -</a>
		
		
		<span class="tag tag-red"> WARNING : </span><br>


		<div class="alert alert-icon alert-danger" role="alert">
		  <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> 
			pastikan output url belum di gunakan '404 Page Not Found'..<br>
			proses generate akan mereplace semua file jika memiliki nama yang sama
		  
		</div>
		
		
		</div>
		<br>
		<br>
		<div class="col-md-12 col-xl-12" > 
		<label class="form-label">Pilih sistem validasi</label> 
		<span>
			note : validasi data kembar dan kosong hanya dilakukan di controller.
		</span>
		<div class='box-body table-responsive'  id='box-table'>
		<small>
		<table id="table-detail" class="table table-hover table-striped" style="width:150%">
		<thead>
	
            <tr >
			<th>No</th>
			<th></th>
			<th>Field Name</th>
			<th>Data Kembar</th>
			<th>Data Kosong</th>
            </tr>

        </thead>
		<tbody >
		
		</tbody>
		</table>

		</small>
		</div>
		<br>
		<br>
		<br>
		</div>
		
		
		<div class="col-md-12 col-xl-12" > 
		<label class="form-label">Pilih Join Table</label> 
		
		
		
		<span class="tag tag-orange"> NOTE : </span><br>


		<div class="alert alert-icon alert-danger" role="alert">
		  <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> 
			<ul>
				<li>Field Show akan menggantikan view dari Field Name</li>
				<li>Alias Table Join Harus di isi jika menggunakan JOIN Table</li>
				<li>Alias Table Join hanya boleh alfabeth a-z,</li>
				tanpa spasi/karakter lain
			</ul>
		</div>
		
		
		<div class='box-body table-responsive'  id='box-table-join'>
		<small>
		<table id="table-detail-join" class="table table-hover table-striped" style="width:150%">
		<thead>
	
            <tr >
			<th>No</th>
			<th>Field Name</th>
			<th>Join Table</th>
			<th>Field Show</th>
			<th>Type Input</th>
			<th>Alias Table Join</th>
            </tr>

        </thead>
		<tbody >
		
		</tbody>
		</table>

		</small>
		</div>

		<br>
		</div>
		
		<div class="col-md-12 col-xl-12">

	   <div class="form-group">
		<button disabled id="btn-apply-next" type="button" class="btn btn-success" onclick="next_process()" ><i class="fa fa-share-alt"></i> Tahap Selanjutnya</button>	
	   </div>
	    <br>
		<br>
		<br>
		<br>		
	   </div>
		
		
		
		<div id="container-next-process" style="display:none">
		
		<div class="col-md-12 col-xl-12" > 
		<label class="form-label">Alias Field Form</label> 
		<span>
			note : Title Alias Form adalah title yang akan di tampilkan pada setiap form
		</span>
		<div class='box-body table-responsive'  id='box-table-title-alias'>
		<small>
		<table id="table-detail-title-alias" class="table table-hover table-striped" style="width:150%">
		<thead>
	
            <tr >
			<th>No</th>
			<th class="checkbox-header"> </th>
			<th>Field Name</th>
			<th>Alias Field</th>
			<th>Title Alias Form</th>
            </tr>

        </thead>
		<tbody >
		
		</tbody>
		</table>

		</small>
		</div>
		<br>
		<br>
		</div>
				
		
		
		<div class="col-md-12 col-xl-12">
		<div class="form-group">
					<div class="form-label">Tampilkan data CRUD untuk semua user</div>
					<label class="custom-switch">
						<input  checked type="checkbox" id="select-crud-show" name="crud_show" class="custom-switch-input data-sending" value='on'>
						<span class="custom-switch-indicator"></span>
						<span class="custom-switch-description">Ya,Tampilkan</span>
					</label><br>
					<span>
						Ya 		= data bersifat public dapat di lihat/update/hapus oleh user yang memiliki otorisasi yang sama.<br>
						Tidak	= data bersifat private hanya user yg melakukan input yang dapat melihat/update/hapus.
					</span>
		</div>
		<br>
		<br>
		<br>
		<br>
		</div>
		
		<div class="col-md-12 col-xl-12">
		<div class="form-group">
					<div class="form-label">Methode Server Side</div>
					<label class="custom-switch">
						<input checked type="checkbox" id="select-server-side" name="server_side" class="custom-switch-input data-sending" value='on'>
						<span class="custom-switch-indicator" ></span>
						<span class="custom-switch-description">Ya,Gunakan</span>
					</label><br>
					<span>
						Ya 		= untuk table yang memiliki / diprediksi akan memiliki jumlah data yang besar > 1000 row.<br>
						Tidak	= untuk table dengan data yang kecil, 1000 row.
						<br><br>
						<span class="text-red">WARNING !!</span><br>
						<span class="text-red">SERVER-SIDE harus digunakan untuk table dengan row > 1000, jika tidak di gunakan akan terjadi error. </span>
					</span>
		</div>
		<br>

		</div>
				
		
		<div class="col-md-12 col-xl-12">

	   <div class="form-group">
		<button id="btn-apply" type="button" class="btn btn-primary" onclick="apply()" ><i class="fe fe-check"></i> Setuju</button>	
		<button disabled="" onclick="generate_form()" id="btn-save" type="button" class="btn btn-success"><i class="fa fa-american-sign-language-interpreting"></i> Generate CRUD</button>	
		<button disabled="" id="btn-cancel" type="button" class="btn btn-primary" onclick="disable_button(true)">Batal</button>
	   </div>
			 
		</div>
		</form>
		<br>
		<br>
		<a href="javascript:void(0)" class="form-label label-link-form" id="label-link-form" name="link"  value="" target="_blank">Output URL : -</a>
		<a href="<?php echo $link_registrasi_url?>" class="btn btn-info form-label" target="_blank">Open Registrasi URL</a>
		<a href="<?php echo $link_create_menu?>" class="btn btn-success form-label" target="_blank">Buat Menu</a>
		</div>
		<!-- end div container-next-process -->
		

		
		
		
	<?php echo card_close()?> 
</div>

<?php echo _js('datatables,icheck,selectize')?>
<script>



<?php 
// General Variable, Agar dapat di gunakan pada semua fungsi
?>
var table_join,table_detail,table_detail_alias;
var data_parent,row_process;




$(document).ready(function(){
	
	
	
	<?php
		// Fungsi Toogle Switch
		// "on"  untuk penanda crud public
		// "off" untuk penanda crud private
	?>
	$('#select-crud-show').change(function(){
		if($('#select-crud-show').val()=='off'){
			$('#select-crud-show').val('on');
		}else{
			$('#select-crud-show').val('off');
		}
		
	})
	
	
	

	$('#select-server-side').change(function(){
		if($('#select-server-side').val()=='off'){
			$('#select-server-side').val('on');
		}else{
			$('#select-server-side').val('off');
		}
		
	})
	
	
	
	
});


$('#select-table-db').change(function(){
	
	<?php 
		
		// * data_parent = "";
		// * mereset data_parent..
		// * data_parent merupakan variable public dan 
		// * digunakan pada function refresh_table_join,
		// * tepatnya pada datatables->createdRow..
		// * nilai data_parent harus di reset ketika refresh_table_join di panggil,
		// * jika tidak maka data lama yang akan di gunakan..ini menyebabkan konflik.
		// *
		// * "data_parent" di isi saat pemanggilan fungsi get_field_select_table,
		// * tepatnya pada add row table join.
		// * Fungsi utama data_parent adalah sebagai 
		// * penanda ketika row join akan  dihapus.
	?>
	
	
	data_parent = '';
	


	if($(this).val()!=="none" && $(this).val()!==""){
		table_detail = $('#table-detail').DataTable();
		table_detail.clear().draw();
		table_detail.destroy();
		
		table_join= $('#table-detail-join').DataTable();
		table_join.clear().draw();
		table_join.destroy();
		
		$('#general-folder').val($(this).val());
		$('#general-file-name').val($(this).val());
		$('#general-folder').change();
		refresh_table();
		refresh_table_join();
		
		disable_next_process(false);
		show_next_process(false);
		
	}else{
		try{
			table_detail.clear().draw();
			table_detail.destroy();
			
			table_join.clear().draw();
			table_join.destroy();
			
			disable_next_process(true);
			show_next_process(false);
			
			$('#btn-save').attr('disabled',true);
			$('#btn-cancel').attr('disabled',true);
			$('#btn-apply').attr('disabled',false);
			
			$('#general-folder').val('');
			$('#general-file-name').val('');
			$('#general-folder').change();
		}catch(error){
			
		}
		

		
	}
	
});


$('#table-detail-join').on('change','td .alias-table-join , .select-show-join',function(e){
		disable_next_process(false);
		show_next_process(false);
});	

$('#table-detail-join').on('keydown','td .alias-table-join',function(e){
		disable_next_process(false);
		show_next_process(false);
		
		var key = e.keyCode;
		return ((key >=65 && key <=90) || key ==8 || key == 37 || key ==39 || key==189 || key==102 || key==100 || (key >=48 && key <=57) );	
		
});

$('#general-folder, #general-file-name').keydown(function(e){
	var key = e.keyCode;
	return ((key >=65 && key <=90) || key ==8 || key == 37 || key ==39 || key==189 || key==102 || key==100 || (key >=48 && key <=57) );	
});	

$('#general-folder, #general-file-name').keyup(function(e){
	
	var folder_name = $('#general-folder').val();
	var file_name	= $('#general-file-name').val();
	var link="";
	if(file_name=="" || folder_name ==""){
		link = '';
	}else{
		link = "<?php echo site_url() ?>" +ucfirst(folder_name)  + '/'+ ucfirst(file_name);
	}
	set_output_url(link);	
});

$('#general-folder, #general-file-name').change(function(e){
	var folder_name = $('#general-folder').val();
	var file_name	= $('#general-file-name').val();
	var link="";
	if(file_name=="" || folder_name ==""){
		link = '';
	}else{
		link = "<?php echo site_url() ?>" + ucfirst(folder_name)  + '/'+ ucfirst(file_name);
	}
	set_output_url(link);	
});	





$('#table-detail-join').on('change','td .select-join',function(e){

	data_parent = '';
	row_process = '';
	
	
	disable_next_process(false);
 	show_next_process(false);
	
	
	var tr 			= $(this).closest('tr');
	row_process 	= $(tr).attr('data-row');

	var parent 		= $(tr).attr('data-child');

	reset_child_row(parent);
	$(tr).attr('data-child',null);
	

	var table_name  = $(this).val();
	if(table_name==$('#select-table-db').val()){
		$(this).val('none');
		show_error_message('Opps..belum support join table sendiri !!');
	}else{
		get_field_select_table(table_name,row_process);
		$('#alias-table-join-'+row_process).attr('name','atj___'+row_process+'_-_'+table_name);

	}
												
});

$('#table-detail-join').on('change','td .alias-table-join',function(e){
	var tr 			= $(this).closest('tr');
	row_process 	= $(tr).attr('data-row');
	mychilds 		= $(tr).attr('data-child');
	alias_table		= $(this).val();
	
	if(mychilds ==null){
		return;
	}
	
	mychild = mychilds.split('_');
	$.each(mychild,function(k,v){
		var c = $('.ybs-rows-click[data-parent="'+v+'"] td .select-join');
		$.each(c,function(x,y){
			var new_name = $(y).attr('name')+'_-_'+alias_table;
			$(y).attr('name',new_name);
		})
	});
	
	
});	




$('#table-detail-title-alias').on('keydown','td .alias-field , .alias-form',function(e){
	disable_button(true);
	var key = e.keyCode;

	return ((key >=65 && key <=90) || key ==8 || key == 37 || key ==39 || key==189 || key==102 || key==100 || (key >=48 && key <=57) );	
});	



function disable_next_process(b){

	if(b==true){
		$('#btn-apply-next').attr('disabled',true);
	}else{
		$('#btn-apply-next').attr('disabled',false);
	}
}

function show_next_process(b){
	if(b==true){
		$('#container-next-process').css({'display':'block'});
	}else{
		$('#container-next-process').css({'display':'none'});
		$('#btn-cancel').click();
	}
}


function next_process(){

	var t  = $('.alias-table-join');
	var tx  = $('.alias-table-join');
	var complite = true;
	if($('#general-folder').val()==""){
		$('#general-folder').focus();
		show_error_message('Opps..nama folder tidak boleh kosong !');
		return false;
	}
	
	if($('#general-file-name').val()==""){
		$('#general-file-name').focus();
		show_error_message('Opps..nama file tidak boleh kosong !');
		return false;
	}
	
	
	
	<?php
	// * Looping input alias-table-join
	// * $.each menggunakan variable pembantu complite dan is_double,
	// * sebagai penanda break looping..
	// * karena fungsi return false pada jquery hanya menghentikan loop,
	// * tanpa keluar dr function parent
	?>

	var rr = 0;
	$.each(t,function(k,v){
		
		
		var disabled = $(v).attr('disabled');
		if(!disabled){
			
		
			if($(v).val()==''){
				$(v).focus();
				complite = false;
				show_error_message('Alias Table tidak boleh kosong');
				return false;
			}
			
			var x = 0;
			var is_double=false;
			$.each(tx,function(y,z){
				var dsb = $(z).attr('disabled');
				if(!dsb){
					if($(v).val()==$(z).val()){
						x++;
					}
					
					if(x>1){
						$(z).focus();
						complite = false;
						show_error_message('Alias Table tidak boleh kembar');
						is_double = true;
						return false;
					}
					
				}	
				
			});
			
			if(is_double){
				return false;
			}
	
		}
		rr++;
	});
	
	


	
	if(complite){
		show_next_process(true);
		disable_next_process(true);
		get_title_alias('');
	}

}

function reset_child_row(parent){
	
	if(parent ==null){
		return;
	}
	
	var sp = parent.split('_');
	$.each(sp,function(k,vp){
		
		
		var childrens	= $('.ybs-rows-click[data-parent="'+vp+'"]');
		
		$.each(childrens,function(k,v){

			var childs = $(v).attr('data-child');

			if(childs == null){
				table_join.rows($(v)).remove().draw();
			}else{
				reset_child_row(childs);
				
				
				table_join.rows($(v)).remove().draw();
			}
		});
	});
	
}


function set_output_url(link){
	if(link==''){
		link= 'javascript:void(0)';
		$('.label-link-form').text("Output URL : - ");
	}else{
		$('.label-link-form').text("Output URL : " + link);
	}

	$('.label-link-form').attr('href',link);
}


</script>

<script> 
 	$('#select-table-db').selectize({}); 
</script>


<script>



function get_title_alias(row){

	var t 	= $('.select-join');
	var al  = $('.alias-table-join'); 
	
	var b 	=	[];
	var alt = 	[];
	
	b.push($('#select-table-db').val());
	
	var x = 0;
	$.each(t,function(key,value){
		if($(value).val() !=='none'){
			b.push($(value).val()+'___'+$(al[x]).val());
		}
		
		x++;
	});
	

	var c = get_json_format('table_name',b);
	send_data = ybs_dataSending([c]);

	var a = new ybsRequest();
	a.process("<?php echo $link_get_title_alias?>",send_data);
	a.onSuccess = function(data){
		var table_alias= $('#table-detail-title-alias').DataTable();
		table_alias.clear().draw();
		table_alias.destroy();
		
		refresh_table_title_alias(data.message);
	}
	
	a.onAfterFailed = function(){
		if(row !== ''){
			$('#select-join-'+row).val('none');
			$('#select-show-join-'+row+' option').remove();
			var opt='<option value="none">--Pilih Field--</option>';
			$('#select-show-join-'+row).append(opt);
		}
	}
	

};

function refresh_table(){
	var d = $('#select-table-db').ybs_json();
	if(d=='none'){
		return;
	}
	send_data  = ybs_dtSending([d]);
	table_detail = $('#table-detail').DataTable({
				ajax				:	{	url: "<?php echo $link_get_field_table; ?>" ,
											contentType: "application/json",
											type: "GET",
											data : function ( d ){
												d.data_ajax = send_data;
											},
											dataSrc: "message",
											
											<?php //DISABLE CLIENT SIDE ?>
											dataFilter: function(response){
															var a = JSON.parse(response);
														
															if(a.elementid > 1000){
																$("#select-server-side").attr("disabled",true);
																$("#select-server-side").val("on");
																$("#select-server-side").prop('checked', true);
																$("#select-server-side").toggleClass("custom-disabled");
														
															}else{
																$("#select-server-side").attr("disabled",false);
																$("#select-server-side").removeClass("custom-disabled");
															}
															return response;
											},	
										},
							
				 
				columns				:	[	{data:null,width:"5%"},
											{data:null,width:"5%",
												render: function ( data, type, row ) {
														if ( type === 'display' ) {
															 var konfirm=row.name;
															 return '<input type="checkbox" class="checkbox flat-red dt-select2" value="'+row.id+"-"+konfirm+"  "+'">';
														}
														
														return data;
												},
											},
											
											
											{data: "name"},
											{data:null,
												render : function(data,type,row){
													if(type==='display'){
														
														var disabled = '';
														if(row.primary_key=='1'){
															disabled = 'disabled';
														}
														if(row.name == 'user_input'){
															disabled = 'disabled';
														}
														var select = '<select '+ disabled +'  name="dr___'+row.name+'" class="form-control data-sending custom-select focus-color" > \n ' + 
																	 '<option value="0">Cegah</option> \n' +
																	 '<option value="1">Izinkan</option> \n' +
																	 '</select>';
														return select;
													
													}			
													return data;
												},
											
											
											
											},
											{data:null,
												render : function(data,type,row){
													if(type==='display'){
														
														var disabled = '';
														if(row.primary_key=='1'){
															disabled = 'disabled';
														}
														if(row.name == 'user_input'){
															disabled = 'disabled';
														}
														var select = '<select '+ disabled +'  name="dk___'+row.name+'" class="form-control data-sending custom-select focus-color" > \n ' + 
																	 '<option value="0">Cegah</option> \n' +
																	 '<option value="1">Izinkan</option> \n' +
																	 '</select>';
														return select;
													
													}			
													return data;
												},
											
											
											
											},
											
											
										],
				
				
				columnDefs			:	[ 
											
											{"searchable": false,"orderable": false,"targets": 0} ,
								
											
											{"searchable": false,"orderable": false,"targets": 1} ,
							
										],
							
				order				: 	[[ 1, 'asc' ]],
			
				
										
				createdRow			: 	function ( row, data, index ) {
											$(row).addClass('cursor-pointer');
											$(row).addClass('ybs-rows-click');
											
											
										},
				
											
				drawCallback		: 	function() {
											$('.dt-select2').iCheck({
												checkboxClass: 'icheckbox_flat-green',
											});
											
										},
				
				
				scrollY 			:	"300px",
				scrollCollapse		:	false,
				scrollX 			:	true,
				paging				: 	true,
				lengthChange		: 	false,
				lengthMenu			: 	[[ -1], [ "All"]],
				searching			: 	false,
				ordering			: 	true,
				info				: 	true,
				autoWidth			: 	false,
				responsive			: 	false,

			});
			
		
			table_detail.on( 'draw.dt', function () {
			var PageInfo = $('#table-detail').DataTable().page.info();
				 table_detail.column(0, { page: 'current' }).nodes().each( function (cell, i) {
					 var num = i + 1 + PageInfo.start;
					cell.innerHTML = '<small>' + num + '</small>';
				} );
			} );

}

function refresh_table_join(){
	var color_random = get_random_color();
	var d = $('#select-table-db').ybs_json();
	
	send_data  = ybs_dtSending([d]);
	table_join = $('#table-detail-join').DataTable({
				ajax				:	{	url: "<?php echo $link_get_field_table_join; ?>" ,
											contentType: "application/json",
											type: "GET",
											data : function ( d ){
												d.data_ajax = send_data;
											},
											dataSrc: "message",
										},
							
				 
				columns				:	[	{data:null,width:"5%"},
											{data: "name"},
											{data:null,
												render : function(data,type,row,meta){
													if(type==='display'){
														var disabled ='';
														if(row.primary_key=='1'){
															disabled = 'disabled';
														}
														
														if(row.name == 'user_input'){
															disabled = '';
														}
														var select = '<select '+disabled+' id="select-join-'+meta.row+'" name="sj___'+row.name+'" data-row="'+meta.row+'" class="form-control data-sending custom-select focus-color select-join" > \n ' + 
																	 '<option value="none">--Pilih Table--</option> \n' +
																	  <?php foreach($table_list as $val){?>
																			 '<option value="<?php echo $val?>"><?php echo $val?></option> \n' + 
																	  <?php }?>																	 
																	 '</select>';
																	 
																		
														return select;
													
													}			
													return data;
												},
											
											
											
											},
								
											{data:null,
												render : function(data,type,row,meta){
													if(type==='display'){
														var disabled ='';
														var a = row.name.split('.');
														
														if(row.primary_key=='1'|| a.length > 1){
															disabled = 'disabled';
														}
														if(row.name == 'user_input'){
															disabled = 'disabled';
														}
														
														var select = '<select '+disabled+' id="select-show-join-'+meta.row+'" data-row="'+meta.row+'" name="ssj___'+row.name+'" class="form-control data-sending custom-select focus-color select-show-join" > \n ' + 
																	  '<option value="none">--Pilih Field--</option> \n' +
																	 '</select>';
														return select;
													
													}			
													return data;
												},
											
											},
											{data:null,
												render : function(data,type,row,meta){
													if(type==='display'){
														var disabled ='';
														var a = row.name.split('.');
														
														if(row.primary_key=='1'|| a.length > 1){
															disabled = 'disabled';
														}
														if(row.name == 'user_input'){
															disabled = 'disabled';
														}
														var select = '<select '+disabled+' id="select-type-input-'+meta.row+'" data-row="'+meta.row+'" name="sti___'+row.name+'" class="form-control data-sending custom-select focus-color select-type-input" > \n ' + 
																	  '<option value="all"> Text ( ALL ) </option> \n' +
																	  '<option value="alfa"> Text ( A-Z ) </option> \n' +
																	  '<option value="number"> Text ( 0-9 ) </option> \n' +
																	  '<option value="alfa_number"> Text ( A-Z , 0-9 ) </option> \n' +
																	  '<option value="password"> Text Password </option> \n' +
																	  '<option value="combobox"> Combo Box </option> \n' +
																	  '<option value="date"> Date </option> \n' +
																	 '</select>';
														return select;
													
													}			
													return data;
												},
											
											},
											
											{data:null,
												render : function(data,type,row,meta){
													if(type==='display'){
														var input = '<input disabled type="text" id="alias-table-join-'+meta.row+'" name="atj___'+meta.row+'_-_'+row.name+'" class="form-control data-sending alias-table-join" value=""></input>';
														return input;
													}			
													return data;
												},
											
											},
											
											
										],
				
				
				columnDefs			:	[ 
											
											{"searchable": false,"orderable": false,"targets": 0} ,
								
											
											// {"searchable": false,"orderable": false,"targets": 1} ,
							
										],
							
				// order				: 	[[ 1, 'asc' ]],
			
				
										
				createdRow			: 	function ( row, data, index ) {
											$(row).addClass('cursor-pointer');
											$(row).addClass('ybs-rows-click');
											
											$(row).attr('data-row',index);
											$(row).attr('data-parent',data_parent);
							
											var c = $('.ybs-rows-click[data-row="'+row_process+'"]').attr('data-child');
											
											if(c==null){
												$('.ybs-rows-click[data-row="'+row_process+'"]').attr('data-child',data_parent);
											}else{
												c = c + '_' + data_parent;
												$('.ybs-rows-click[data-row="'+row_process+'"]').attr('data-child',c);
											}
											
											var a = data.name.split('.');
											if(a.length > 1){
												$(row).addClass(color_random);
											}

										},
				
										
				drawCallback		: 	function() {
											$('.dt-select2').iCheck({
												checkboxClass: 'icheckbox_flat-green',
											});
										},
				
				
				scrollY 			:	"300px",
				scrollCollapse		:	false,
				scrollX 			:	true,
				paging				: 	true,
				lengthChange		: 	false,
				lengthMenu			: 	[[ -1], [ "All"]],
				searching			: 	false,
				ordering			: 	true,
				info				: 	true,
				autoWidth			: 	false,
				responsive			: 	false,

			});
			
		
			table_join.on( 'draw.dt', function () {

			var PageInfo = $('#table-detail-join').DataTable().page.info();
				 table_join.column(0, { page: 'current' }).nodes().each( function (cell, i) {
					 var num = i + 1 + PageInfo.start;
					cell.innerHTML = '<small>' + num + '</small>';
				} );
			} );
			
			

}


function refresh_table_title_alias(data_load){

	table_detail_alias = $('#table-detail-title-alias').DataTable({

				data				: data_load, 
				columns				:	[	{data:"nomor",width:"5%"},
											{data:null,width:"5%",
												render: function ( data, type, row ) {
														if ( type === 'display' ) {
															 var konfirm=row.name;
															 var r = '<input type="checkbox" class="checkbox flat-red dt-select2" value="'+row.id+"-"+konfirm+"  "+'">';
															 if(row.alias_field=='id'){
																r = '<input disabled checked type="checkbox" class="checkbox flat-red dt-select2" value="'+row.id+"-"+konfirm+"  "+'">';	
															 }	
															
															 return r;
														}
														
														return data;
												},
											},
											{data: "name"},
											{data:null,
												render : function(data,type,row,meta){
													if(type==='display'){
														var input = '<input disabled type="text" id="af___'+row.name+'" name="af___'+row.name+'" class="form-control data-sending focus-color alias-field" value="'+row.alias_field+'"></input>';
														return input;
													}			
													return data;
												},
											
											},
											
											{data:null,
												render : function(data,type,row,meta){
													if(type==='display'){
														var r = '<input  type="text" id="am___'+row.name+'" name="am___'+row.name+'" class="form-control data-sending focus-color alias-form" value="'+row.alias_field.toString().toUpperCase()+'"></input>';
													
														return r;
													}			
													return data;
												},
											
											},
											
											
										],
				
				
				columnDefs			:	[ 
											
											{"searchable": false,"orderable": false,"targets": 0} ,
								
											
											// {"searchable": false,"orderable": false,"targets": 1} ,
							
										],
							
				// order				: 	[[ 1, 'asc' ]],
			
				
										
				createdRow			: 	function ( row, data, index ) {
											
											if(data.alias_field !=='id'){
												$(row).addClass('cursor-pointer');
												$(row).addClass('ybs-rows-click');
												$(row).addClass('sound-table');
											}	
											
										},
				
											
				drawCallback		: 	function() {
											$('.dt-select2').iCheck({
												checkboxClass: 'icheckbox_flat-green',
											});
											
										},
				
				
				scrollY 			:	"300px",
				scrollCollapse		:	false,
				scrollX 			:	true,
				paging				: 	true,
				lengthChange		: 	false,
				lengthMenu			: 	[[ -1], [ "All"]],
				searching			: 	false,
				ordering			: 	true,
				info				: 	true,
				autoWidth			: 	false,
				responsive			: 	false,

			});
			

			table_detail_alias.on( 'draw.dt', function () {
				
			var PageInfo = $('#table-detail-title-alias').DataTable().page.info();
				 table_detail_alias.column(0, { page: 'current' }).nodes().each( function (cell, i) {
					 var num = i + 1 + PageInfo.start;
					cell.innerHTML = '<small>' + num + '</small>';
				} );
			} );

}


	
function get_field_select_table(table_name,row){

		<?php //prepare data json ?>
		var d = get_json_format('table_name',table_name);
		if(table_name=='none'){
			$('#alias-table-join-'+row).attr('disabled',true);
			$('#alias-table-join-'+row).val('');
			$('#select-type-input-'+row).val('all');
			$('#select-type-input-'+row).attr('disabled',false);
		}
		
		send_data  = ybs_dataSending([d]);
		
		
		<?php //request data field table ?>
		var a  = new ybsRequest();
		a.process( "<?php echo $link_get_field_table_join; ?>" ,send_data);
		
		
		<?php //jika data berhasil di dapat ?>
		a.onSuccess = function(data){
			
			
			<?php //reset select show join ?>
			$('#select-show-join-'+row+' option').remove();
			
			<?php //prepare option select ?>
			var opt='';

			<?php //looping data field from server ?>
			$.each(data.message,function(key,val){
				
				<?php //create option value ?>
				if(val.name !=='id' && val.name !=='user_input' ){
					opt = opt + '<option value="'+table_name+'___'+val.name+'">'+val.name+'</option>';
				}
				
				<?php //enable alias table ?>
				$('#alias-table-join-'+row).attr('disabled',false);
				$('#alias-table-join-'+row).val('');
				
				
				<?php //add row table join 
					  //yang bertipe int dan bukan field id dan user_input*/ ?>
				if(val.name !=='id' && val.name !=='user_input' && val.type=='int'){
					
					var d = new Date();
					data_parent = d.getTime();
					table_join.rows.add([{"name":table_name+'.'+val.name}]);

				}
				
				
		
			});	
			
		
		

			<?php //add option value to select show join ?>
			$('#select-show-join-'+row).append(opt);
			

			<?php //redraw table ?>
			table_join.draw(false);
			$('#select-join-'+row).focus();

			<?php //type input harus combobox ?>
			$('#select-type-input-'+row).val('combobox');
			$('#select-type-input-'+row).attr('disabled',true);
			
			
		};
		a.onFailed = function(){
			$('#select-show-join-'+row+' option').remove();
			var opt='<option value="none">--Pilih Field--</option>';
			$('#select-show-join-'+row).append(opt);
		}
		

}



</script>


<script>
function apply(){
	var fl = $('.alias-field');
	var ff = $('.alias-form');
	var complite 	= true;
	var is_double 	= false; 
	
	
	<?php 
		// * Validasi alias field :
		// * - mencegah data kosong
		// * - mencegah data kembar
	?>
	$.each(fl,function(k,v){
		if($(v).val()==''){
			$(v).focus();
			show_error_message('Opps..tidak boleh kosong !!');
			complite = false;
			return false;
		}
		
		var xx =0;
		$.each(fl,function(kk,vv){
			if($(vv).val()==$(v).val()){
				xx++;
			}
			
			if(xx>1){
				$(vv).focus();
				show_error_message('Opps.."'+$(vv).val()+'" sudah digunakan..tidak boleh sama !!');
				complite = false;
				is_double = true;
				return false;
			}
			
		});
		
		if(is_double){
				return false;
		}
		
	});
	
	if(!complite){
		return false;
	}
	
	<?php
		// * Validasi alias form :
		// * - mencegah data kosong
		// * - mencegah data kembar
	?>
	$.each(ff,function(k,v){
		if($(v).val()==''){
			$(v).focus();
			show_error_message('Opps..tidak boleh kosong !!');
			complite = false;
			return false;
		}
		
		var xx =0;
		$.each(ff,function(kk,vv){
			if($(vv).val()==$(v).val()){
				xx++;
			}
			
			if(xx>1){
				$(vv).focus();
				show_error_message('Opps.."'+$(vv).val()+'" sudah digunakan..tidak boleh sama !!');
				complite = false;
				is_double = true;
				return false;
			}
			
		});
		
		if(is_double){
				return false;
		}
		
	});
	
	
	if(!complite){
		return false;
	}
	
	disable_button(false);
	
}


function generate_form(){
	
	if($('#general-folder').val()==""){
		$('#general-folder').focus();
		show_error_message('Opps..nama folder tidak boleh kosong !');
		return false;
	}
	
	if($('#general-file-name').val()==""){
		$('#general-file-name').focus();
		show_error_message('Opps..nama file tidak boleh kosong !');
		return false;
	}
	
	var aa = get_dataSending('form-a');
	send_data = ybs_dataSending(aa);
		
	var a = new ybsRequest();
	a.process('<?php echo $link_generate_form?>',send_data,"POST");
	a.onComplite = function(){
		disable_button(true);
	}
	
}

function disable_button(b){
	$('#btn-apply').attr('disabled',!b);
	$('#btn-save').attr('disabled',b);
	$('#btn-cancel').attr('disabled',b);
}

</script>

<script>
	var a = '- Table data base harus memiliki : '+
			'- primary key dengan nama field "id" ,  type int or double,    autoincreament\n'+
			'- nama field hanya boleh menggunakan karakter (a-z) dan underscore "_" jangan menggunakan karakter lainnya termasuk spasi \n'+
			'- Table tidak bisa join ke dirinya sendiri \n' +
			'- Table data base yang bersifat private harus memiliki field dengan nama "user_input"';
	$('#text-code-petunjuk').val(a);
</script>