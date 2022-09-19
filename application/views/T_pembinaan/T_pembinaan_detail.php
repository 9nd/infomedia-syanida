<h5>Detail Agent :<?php
					// $agentid = $query[0]->agentid;
					if($agentidget == ""){
						echo "$agentidget";
						// var_dump($data);
					}else{
						$nama = $controller->db->query("SELECT nama FROM sys_user WHERE agentid='$agentidget'")->row();
						echo $nama->nama;
					}
					
					// if (COUNT($nama) == 0) {
					// 	echo "Belum ada data";
					// } else {
					
					// }
					?></h5>
<table class='display' id='detailed' style="width: 100%;">
	<thead>
		<tr>
			<th style="font-size: 12px"><b>No</b></th>
			<th style="font-size: 12px"><b>Tanggal</b></th>
			<th style="font-size: 12px"><b>Pembinaan</b></th>
			<th style="font-size: 12px"><b>Keterangan</b></th>


		</tr>
	</thead>
	<tbody>
		<?php
		$nomor = 1;
		foreach ($query as $datanya) {

		?>
			<tr>
				<td style="font-size: 11px"><?php echo $nomor; ?></td>
				<td style="font-size: 11px"><?php echo $datanya->tanggal_pembinaan ?></td>
				<td style="font-size: 11px"><?php echo $datanya->tingkat_pembinaan ?></td>
				<td style="font-size: 11px"><?php echo $datanya->keterangan ?></td>

			</tr>
		<?php
			$nomor++;
		}
		?>
	</tbody>
</table>
<script>
	$(document).ready(function() {
		$('#detailed').DataTable({
			"paging": true,
			"search": false,
			"info": false,
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf'
			]
		});
	});
</script>