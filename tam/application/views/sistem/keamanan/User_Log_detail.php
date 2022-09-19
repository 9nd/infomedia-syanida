<?php echo _css('datatables,icheck')?>

<div class='box-body table-responsive'  id='box-table'>
		<small>
		<table id='table-detail' class='table table-striped' style='width:150%'>
		<thead>
	
            <tr >
			<th>Tanggal</th>
			<th>Jam</th>
			<th>Url Access</th>
			<th>Type Request</th>
			<th>OS</th>
			<th>IP Address</th>
			
            </tr>

        </thead>
		<tbody>
			<?php foreach ($row as $val){ ?>
				<tr style="font-size:11px">
				<td><?php echo $val->tanggal ?></td>
				<td><?php echo $val->jam ?></td>
				<td><?php echo $val->url_access ?></td>
				<td><?php echo $val->type_request ?></td>
				<td><?php echo $val->os_access ?></td>
				<td><?php echo $val->ip_address_access ?></td>
				
				</tr>
			<?php }?>
		</tbody>
		</table>
		<div hidden>
			<button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modal-danger'   id='button_delete_single' ></button>
		</div>
		</small>
	</div>



<?php echo _js('datatables,icheck')?>
<script>var page_version="1.0.8"</script>


<script>
 $('#table-detail').dataTable({
				
				paging				: 	true,
				lengthChange		: 	true,
				lengthMenu			: 	[[10,50,100,500,1000], [10,50,100,500,1000]],
				searching			: 	true,
				ordering			: 	true,
				info				: 	true,
				autoWidth			: 	false,
				responsive			: 	true,
				orderCellsTop		:   true,
			
})	


</script>