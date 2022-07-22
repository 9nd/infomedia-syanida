<?php echo _css('datatables,icheck')?>

<div class='box-body table-responsive'  id='box-table'>
		<small>
		<table id="table-detail" class="table" style="width:150%">
		<thead>
	
            <tr >
			<th>No</th>
			<th><label><input type='checkbox'  id='general_check'> </label></th>
			<th>time</th>
			<th>User</th>
			<th>Type Injection</th>
			<th>Access URL</th>
			<th>Data</th>
			<th></th>
            </tr>

        </thead>
		<tbody id="table-body-periode">
		
		</tbody>
		</table>
		<div hidden>
			<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-danger"   id="button_delete_single" ></button>
		</div>
		</small>
</div>
		
		<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
				
					<label class='custom-switch'>
						<input type='checkbox' id='hscroll-table' class='custom-switch-input' value='off'>
						<span class='custom-switch-indicator'></span>
						<span class='custom-switch-description'>HScroll</span>
					</label>
		</div>
		</div>

<?php echo _js('datatables,icheck')?>		
<script>
var resp_table=true;
var table_detail;

$(document).ready(function(){
	$('#hscroll-table').prop('checked',false);
		set_scroll_table();
	
	$('#hscroll-table').change(function(){
		set_scroll_table();
	});
	
})

function set_scroll_table(){
	resp_table=!$('#hscroll-table').prop('checked');
	
	/** clear & destroy table agar tidak error..
	 * 	fungsi clear & destroy tidak di simpan di dalam
	 *  refresh_table() karena  clear & destroy
	 *	di panggil juga pada proses delete row ybs.js
	 *	pada function ybsProcDelTable yang kemudian memanggil fungsi refresh_table();
     *  jika di letakkan pada refresh_table() maka akan terjadi double function pada saat delete row 	 
	**/
	if($.fn.dataTable.isDataTable('#table-detail')){
		table_detail.clear().draw();
		table_detail.destroy();	
	}
	refresh_table();
}

$('th').addClass('text-dark');		


function refresh_table(value_search){

table_detail =	$('#table-detail').DataTable({
				processing			: true,
				language			: {processing : '<div class="dimmer active"><div class="loader"></div><br><br><br>Sabar Lagi Loading...</div>'},
				ajax				:	{	url: "<?php echo $link_refresh_table_menu; ?>" ,
											contentType: "application/json",
											type: "GET",
											dataSrc: "message",
										},
							
				 
				columns				:	[	{data:null,width:"5%"},
											{data:null,width:"5%",
												render: function ( data, type, row ) {
														if ( type === 'display' ) {
															 var konfirm=row.menu_utama+" > "+row.sub_menu;
															 return '<input type="checkbox" class="checkbox flat-red dt-select2" value="'+row.id_menu+"-"+konfirm+"  "+'">';
														}
														
														return data;
												},
											},
											
											
											{data: "time"},
											{data: "user"},
											{data: "type_injection"},
											{data: "access_url"},
											{data: "data"},
										
											{data:null,width:"10%",
												render: function ( data, type, row ) {
														if ( type === 'display' ) {
															var konfirm=row.menu_utama+" > "+row.sub_menu;
															
											
															
															var btn_group="";
															
															btn_group = btn_group + '<a href="<?php echo $link_update?>/'+row.id_menu+'" class="btn btn-default text-red btn-sm " title="update"><i class="fa fa-edit"></i></a>'; 
															btn_group = btn_group + '<button type="button" class="btn btn-default text-red btn-sm"  id="btn_pre_delete" onclick=\' ybsDeleteTable("'+row.id_menu+"-"+konfirm+'","<?php echo $link_delete ?>","#table-detail") \'  ><i class="fa fa-trash-o"></i></button></small>';
															
															return btn_group;
														}	
														
														return data;	
												
												}	
											
											
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
				dom					: 'Blfrtip',
				
				buttons				: ['copy','excel'],						
				initComplete		: 	function() {
											var api = this.api();
											if(value_search ==null || value_search===undefined){
												value_search='';
											}
											api.search(value_search).draw();						
										},							
				
				
				scrollY 			:	"300px",
				scrollCollapse		:	false,
				scrollX 			:	true,
				paging				: 	true,
				lengthChange		: 	true,
				lengthMenu			: 	[[10,50,100], [10,50,100]],
				searching			: 	true,
				ordering			: 	true,
				info				: 	true,
				autoWidth			: 	false,
				responsive			: 	resp_table,

			});
			
			//membuat nomor urut
			table_detail.on( 'draw.dt', function () {
			var PageInfo = $('#table-detail').DataTable().page.info();
				 table_detail.column(0, { page: 'current' }).nodes().each( function (cell, i) {
					 var num = i + 1 + PageInfo.start;
					cell.innerHTML = '<small>' + num + '</small>';
				} );
			} );

}


$('#btn-delete').click(function(){
	ybsDeleteTableChecked('<?php echo $link_delete?>','#table-detail');
});


</script>