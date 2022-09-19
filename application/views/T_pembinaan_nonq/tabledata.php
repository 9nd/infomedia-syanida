<?php echo _css('datatables,icheck') ?>

<table class='display responsive' id="example" style="width: 100%;">
	<thead>
		<tr>
			<th style="font-size: 12px"><b>Tanggal</b></th>
			<th style="font-size: 12px"><b>Detail Not Approve</b></th>
			<th style="font-size: 12px">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$nomor = 1;
		foreach ($datanya->result() as $datana) {

		?>
			<tr>
				<td style="font-size: 11px"><?php echo $datana->tglk; ?></td>
				<td style="font-size: 11px"><?php echo $datana->detailnotk; ?></td>
				<td style="font-size: 11px">
					<div class='hapus' id='<?php echo $datana->id; ?>'><button type='button' class='btn btn-danger'><span class='fe fe-minus-circle'></span></button></div>
				</td>
				</td>

			</tr>
		<?php
			$nomor++;
		}
		?>
	</tbody>
</table>




<?php echo _js('datatables,icheck') ?>

<script>
	var page_version = "1.0.8"
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#example").DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf'
			]
		});
		$(".hapus").click(function() {
			var del_id = $(this).attr('id');
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url() . "T_pembinaan_nonq/T_pembinaan_nonq/hapus" ?>",
				data: 'delete_id=' + del_id,
				success: function(data) {
					alert('berhasil hapus');
					rekasus();
				}
			});

		});

	});
</script>


<?php echo _js('datatables,icheck') ?>