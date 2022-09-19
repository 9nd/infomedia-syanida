<?php echo _css('datatables,icheck,selectize')?>
<div class="col-md-12 col-xl-12">
<?php echo card_open('<i class="fe fe-list"> </i> ','bg-red',true)?>
<form id="form-a">
<input hidden class="data-sending" id="id" value="<?php echo $id?>">


<div class="form-group">
    <label class="form-label">Nama Level</label>
    <input type="text" class="form-control data-sending focus-color" id="input-nama-level" name='nmlevel' placeholder="Nama Level" value="<?php echo $nmlevel?>">
</div>

  
<div class="form-group">
                        <label class="form-label">Status</label>
                        <select  id="select-status-level" name='status' class="form-control data-sending custom-select focus-color" >
						<?php if($selected_status=='1'){ ?>
							<option selected value="1" >AKTIF</option>
							<option value="2" >NON AKTIF</option>
						<?php }else{ ?>
							<option value="1" >AKTIF</option>
							<option selected value="2" >NON AKTIF</option>
						<?php }?>
                        </select>
		<br>	
<br>			
</div>
<div class="form-group">
	<label class="form-label">Pilih Otorisasi URL / FORM</label>

	<div class='box-body table-responsive'  id='box-table'>
		<small>
		<table id="table-detail-url" class="table ybs-table" style="width:150%">
		<thead>
	
            <tr >
			<th>No</th>
			<th class="checkbox-header"></th>
			<th>URL /FORM </th>
			<th> CODE </th>
			<th>Shortcut</th>
            </tr>

        </thead>
		<tbody>
		
		</tbody>
		</table>

		</small>
		</div>
		<br>
</div>

<div class="form-group">
	<label class="form-label">Pilih Otorisasi Menu</label>
	<label class="form-label"><small>hanya menu yang di pilih yang akan di tampilkan.</small></label>

	<div class='box-body table-responsive'  id='box-table'>
		<small>
		<table id="table-detail-menu" class="table ybs-table" style="width:150%">
		<thead>
	
            <tr >
			<th>No</th>
			<th class="checkbox-header"></th>
			<th>Menu Utama</th>
			<th>Tipe Menu</th>
			<th>Sub Menu</th>
            </tr>

        </thead>
		<tbody>
		
		</tbody>
		</table>

		</small>
		</div>
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

<?php echo _js('datatables,icheck,selectize')?>
	
<script>
$(document).ready(function(){

	refresh_table_url(<?php echo $data_url?>);
	refresh_table_menu(<?php echo $data_menu?>);
})

function refresh_table_url(list){

	$('#table-detail-url').DataTable({
				data				: list,
				 
				columns				:	[	{data:'no',width:"5%"},
											{data:null,width:"5%",
												render: function ( data, type, row ) {
														if ( type === 'display' ) {
															 var konfirm="";
															 return '<input type="checkbox" class="checkbox flat-red dt-select2"  '+ row.checked+' value="'+row.id+'">';
														}
														
														return data;
												},
											},
											
											
											{data: "form_name",
											
											},
											{data: "code",

											},

											{data: "shortcut",
												render: function ( data, type, row ) {
														if ( type === 'display' ) {
															 if(row.shortcut=='1'){
																  return '<span class="badge badge-success"> YES</span>';
															 }else{
																   return '<span class="badge badge-danger"> NO</span>';
															 }
															
														}
														
														return data;
												},
												
											},
	
										],
				
				
				columnDefs			:	[ 
											//SETTING UNTUK KOLOM 0 (NOMOR URUT)
											{"searchable": false,"orderable": false,"targets": 0} ,
								
											//SETTING UNTUK KOLOM 1 (CHECK)
											{"searchable": false,"orderable": false,"targets": 1} ,
							
										],
							
				order				: 	[[ 1, 'asc' ]],
			
				
										//MENAMBAHKAN CLASS PADA ROW
				createdRow			: 	function ( row, data, index ) {
											$(row).addClass('cursor-pointer');
											$(row).addClass('ybs-rows-click');
										},
				
										//MEMANGGIL ULANG FUNGSI SAAT TABLE DI DRAW ULANG	
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
				searching			: 	true,
				ordering			: 	true,
				info				: 	true,
				autoWidth			: 	false,
				responsive			: 	false,
				

			});
			
			//membuat nomor urut
			var t = $('#table-detail-url').DataTable();
			t.on( 'draw.dt', function () {
			var PageInfo = $('#table-detail-url').DataTable().page.info();
				 t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
					 var num = i + 1 + PageInfo.start;
					cell.innerHTML = '<small>' + num + '</small>';
				} );
			} );
			

}

function refresh_table_menu(list){

	$('#table-detail-menu').DataTable({
				data				: list,		
							
				 
				columns				:	[	{data:'no',width:"5%"},
											{data:null,width:"5%",
												render: function ( data, type, row ) {
														if ( type === 'display' ) {
															 var konfirm="";
															 return '<input type="checkbox" class="checkbox flat-red dt-select2" '+ row.checked +' value="'+row.id_menu+'">';
														}
														
														return data;
												},
											},
											
											
											{data: "menu_utama",
											
											},
											{data: "type_menu",},
										
											{data: "sub_menu",

											},											
										],
				
				
				columnDefs			:	[ 
											//SETTING UNTUK KOLOM 0 (NOMOR URUT)
											{"searchable": false,"orderable": false,"targets": 0} ,
								
											//SETTING UNTUK KOLOM 1 (CHECK)
											{"searchable": false,"orderable": false,"targets": 1} ,
							
										],
							
				order				: 	[[ 1, 'asc' ]],
			
				
										//MENAMBAHKAN CLASS PADA ROW
				createdRow			: 	function ( row, data, index ) {
											$(row).addClass('cursor-pointer');
											$(row).addClass('ybs-rows-click');
										},
				
										//MEMANGGIL ULANG FUNGSI SAAT TABLE DI DRAW ULANG	
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
				searching			: 	true,
				ordering			: 	true,
				info				: 	true,
				autoWidth			: 	false,
				responsive			: 	false,

			});
			
			//membuat nomor urut
			var t = $('#table-detail-menu').DataTable();
			t.on( 'draw.dt', function () {
			var PageInfo = $('#table-detail-menu').DataTable().page.info();
				 t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
					 var num = i + 1 + PageInfo.start;
					cell.innerHTML = '<small>' + num + '</small>';
				} );
			} );

}

</script>
<script>
function apply(){
	
}
	
$('.data-sending').keydown(function(e){
	switch(e.which){
		case 13:
		$('#btn-apply').click();
		return false;
	}
})
$('#btn-apply').click(function(){
	if($('#input-nama-level').val()=="" || $('#input-nama-level').val()==null){
		show_error_message('Nama level tidak boleh kosong !');
		play_sound_failed();	
		$('#input-nama-level').focus();
		return false;
	}
	var b = $('#table-detail-url').get_checked();
	var c = $('#table-detail-menu').get_checked();

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
	var b 		= $('#table-detail-url').get_checked();
	b     		= get_json_format('form',b);
	var c 		= $('#table-detail-menu').get_checked();
	c 	  		= get_json_format('menu',c);
	send_data 	= ybs_dataSending([a,b,c]); 
	var s = new ybsRequest();
	s.process("<?php echo $link_save?>",send_data,'POST');
	s.onAfterSuccess = function(){
		cancel();
	}
	s.onAfterFailed	  = function(data){
		cancel();
		$(data.elementid).focus();
	}
	
}
</script>