<?php
class Template_list extends CI_Model {

function __construct(){
      parent::__construct();
}

function create_view_list($fl,$pv,$gf,$field_alias_form,$type_input_field,$server_side){

$string = "
<?php echo _css('datatables,icheck')?>

<?php echo card_open('Daftar','bg-teal',true)?>
<div class='row'>
	<div class='col-md-6 col-lg-4'>
	<?php echo button_card(\$title->general->button_create,\$title->general->button_create_desc,'text-green','btn-success','fe fe-list','bg-green','btn-create',\$link_create)?>
	</div>
	<div class='col-md-6 col-lg-4'>
	<?php echo button_card(\$title->general->button_delete,\$title->general->button_delete_desc,'text-red','btn-danger','fe fe-trash','bg-red','btn-delete')?>
	</div>
</div>

	<div class='box-body table-responsive'  id='box-table'>
		<small>
		<table id='table-detail' class='table' style='width:150%'>
		<thead>
	
            <tr >
			<th>No</th>
			<th><label><input type='checkbox'  id='general_check'> </label></th>
			<?php foreach(\$title->table_column as \$key=>\$val){ ?>
				<th><?php echo \$val ?></th>
			<?php } ?>
			<th>Action</th>
            </tr>

        </thead>
		<tbody>
		
		</tbody>
		</table>
		<div hidden>
			<button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modal-danger'   id='button_delete_single' ></button>
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



<?php echo card_close()?>

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
	
});

function set_scroll_table(){
	resp_table=!$('#hscroll-table').prop('checked');
	refresh_table();
}	
";



$string .="	

function refresh_table(value_search){
$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        \"iStart\": oSettings._iDisplayStart,
                        \"iEnd\": oSettings.fnDisplayEnd(),
                        \"iLength\": oSettings._iDisplayLength,
                        \"iTotal\": oSettings.fnRecordsTotal(),
                        \"iFilteredTotal\": oSettings.fnRecordsDisplay(),
                        \"iPage\": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        \"iTotalPages\": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };
table_detail = $('#table-detail').dataTable({
				destroy				: true,
				processing			: true,";
if($server_side=='on'){
$string.="				
				serverSide			: true,";		
}
$string.="				
				language			: {processing : '<div class=\"dimmer active\"><div class=\"loader\"></div><br><br><br>mohon tunggu...</div>'},
				ajax				:	{	url: \"<?php echo \$link_refresh_table; ?>\" ,
											type: \"POST\",
											dataSrc: \"message\",
											data : function ( d ){
												if(value_search!==undefined){
													d.search = {value:value_search,regex:false};
												}
											},
										},
							
				 
				columns				:	[	{data:null,width:\"5%\"},
											{data:null,width:\"5%\",
												render: function ( data, type, row ) {
														if ( type === 'display' ) {
															 var konfirm='';
															 return '<input type=\"checkbox\" class=\"checkbox flat-red dt-select2\" value=\"'+row.id+\"-\"+konfirm+\"  \"+'\">';
														}
														
														return data;
												},
											},
											
											<?php foreach(\$title->table_column as \$alias_field=>\$val){?>
												{data:\"<?php echo \$alias_field ?>\" ,";
foreach($type_input_field as $k=>$v){
	if($v=='number'){
$string .="
													<?php if(\$alias_field=='$k'){?>
														 render: \$.fn.dataTable.render.number( ',', '.', 2, '' ),	
													<?php }?>
";		
		
	}
	
}												
														
$string .="
												
												
												
												},
											<?php }?>

											{data:null,width:\"10%\",
												render: function ( data, type, row ) {
														if ( type === 'display' ) {
															var konfirm='';
															var btn_group='';
															btn_group = btn_group + '<a href=\"<?php echo \$link_update?>/'+row.id+'\" class=\"btn btn-default text-red btn-sm \" title=\"update\"><i class=\"fa fa-edit\"></i></a>'; 
															btn_group = btn_group + '<button type=\"button\" class=\"btn btn-default text-red btn-sm\"  id=\"btn_pre_delete\" onclick=\' ybsDeleteTable(\"'+row.id+\"-\"+konfirm+'\",\"<?php echo \$link_delete ?>\",\"#table-detail\") \'  ><i class=\"fa fa-trash-o\"></i></button></small>';
															return btn_group;
														}	
														return data;	
												}	
											},
											
											
										],
				
				
				columnDefs			:	[ 
											//SETTING UNTUK KOLOM 0 (NOMOR URUT)
											{\"searchable\": false,\"orderable\": false,\"targets\": 0, \"className\":\"dt-center\"} ,
								
											//SETTING UNTUK KOLOM 1 (CHECK)
											{\"searchable\": false,\"orderable\": false,\"targets\": 1} ,
							
										],
							
				order				: 	[[ 1, 'asc' ]],
			
				
										//MENAMBAHKAN CLASS PADA ROW
				rowCallback			: 	function(row, data, iDisplayIndex) {
											$(row).addClass('cursor-pointer');
											$(row).addClass('ybs-rows-click');
					
											var info = this.fnPagingInfo();
											var page = info.iPage;
											var length = info.iLength;
											var index = page * length + (iDisplayIndex + 1);
											$('td:eq(0)', row).html(index);
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
											if(value_search!==undefined){
												api.search(value_search).draw();	
											}
											
											$('#table-detail_filter input')
													.off('.DT')
													.on('keyup.DT', function(e) {
														if (e.keyCode == 13) {
															value_search =this.value;
															api.search(this.value).draw();
												}
											});					
										},						
				
				scrollY 			:	\"300px\",
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
}


$('#btn-delete').click(function(){
	ybsDeleteTableChecked('<?php echo \$link_delete?>','#table-detail');
});
</script>
";



$result = _createFile($string,$pv,$fl .'.php');		
return $result;		
	
}



}