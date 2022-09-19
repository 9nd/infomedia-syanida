

<div class="col-md-12 col-xl-12">
	
	
	<div class="form-group">
		<a   class="btn btn-primary" href="<?php echo $link_create?>"><i class="fe fe-check"></i> Create Schedule</a>
		<a   class="btn btn-success" href="<?php echo $link_register_ip?>"><i class="fa fa-address-card"></i> Izinkan IP tertentu - Login saat maintenance mode </a>		
	 </div>

	 
	 
	<div class="panel panel-info">
		<div class="panel-heading">List Maintenance Schedule</div>
		<div class="panel-body">
		<form id="form-a">
		<div class="row">
	

		<div class="col-md-12 col-xl-12">
		<div class="box-body table-responsive " id="box-table">
		<table class="table  table-striped" id="detail-table">
			<thead>
			
			<tr>
				<th>No</th>
				<th>Descriptions</th>
				<th>Mulai</th>
				<th>Target Hari</th>
				<th>Jam</th>
				<th>Menit</th>
				<th>Selesai</th>
				<th>Action</th>
			</tr>
			</thead>
			
			<tbody>
				<?php $x=1; foreach($row as $val){ ?>
					<tr id="<?php echo $val->id ?>">
						<td><?php echo $x?></td>
						<td><?php echo $val->desc ?></td>
						<td><?php echo $val->start ?></td>
						<td><?php echo $val->days ?></td>
						<td><?php echo $val->hours ?></td>
						<td><?php echo $val->minutes ?></td>
						<?php if($val->actual_finish==0){?>
							<td><span class="tag tag-green">Running</span></td>	
							<td><a   href="javascript:void(0)"  class="btn btn-default text-dark btn-sm" title="finish" onclick="stop_maintenance('<?php echo $val->id ?>')"><i class="fa fa-flag"></i></a>
							</td>	
							<?php }else{?>
								<td><?php  echo _indonesia_date($val->actual_finish); ?></td>	
								<td><a href="javascript:void(0)"  class="btn btn-default text-red btn-sm" title="delete" onclick="delete_schedule('<?php echo $val->id ?>')"><i class="fa fa-trash-o"></i></a>
								
							</td>	
						<?php }?>
							
					
						
					</tr>					
				<?php $x++; }?>	
			</tbody>
		
		</table>
		</div>
	</div>
		
		
		
		
		
		
	</div> 
	</form>
	</div>
	</div>
</div>



<script>

function delete_schedule(id){
	var data = get_json_format("id",id);
	data_sending = ybs_dataSending([data]);
	var a = new ybsRequest();
	a.process("<?php echo $link_delete?>",data_sending,"POST");
	a.onSuccess = function(){
		
	}
}

function stop_maintenance(id){
	var data = get_json_format('id',id);
	data_sending = ybs_dataSending([data]);
	var a = new ybsRequest();
	a.process("<?php echo $link_stop_maintenance?>",data_sending,"POST");
	a.onSuccess = function(){
		
	}
} 

</script>





