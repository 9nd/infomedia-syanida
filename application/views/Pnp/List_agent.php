<?php echo _css('datatables,icheck') ?>

<?php echo card_open('', 'bg-teal', true) ?>

<div class='box-body table-responsive' id='box-table'>
	<small>

		<table class='display nowrap' id="example2" style="width: 100%;">
			<thead>
				<tr>
					<th><b>No</b></th>
					<th nowrap><b>Proses</b></th>
					<th nowrap><b>judul</b></th>
					<th><b>waktu_mulai</b></th>
					<th nowrap><b>waktu_selesai</b></th>
					<th nowrap><b>durasi_waktu</b></th>
					<th><b>tanggal</b></th>
					<th><b>catatan</b></th>
					<th><b>soal</b></th>
					<th><b>jumlah_soal</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$nomor = 1;


				foreach ($data['results'] as $datana) {

				?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><a target="_blank" href="<?php echo base_url() . "Pnp_agent/Pnp_agent/detail/" . $datana->id; ?>">Proses</a></td>
						<td><?php echo $datana->judul; ?></td>
						<td><?php echo $datana->waktu_mulai; ?></td>
						<td><?php echo $datana->waktu_selesai; ?></td>
						<td><?php echo $datana->durasi_waktu; ?></td>
						<td><?php echo $datana->tanggal; ?></td>
						<td><?php echo $datana->catatan; ?></td>
						<td><?php echo $datana->soal; ?></td>
						<td><?php echo $datana->jumlah_soal; ?></td>
					</tr>
				<?php
					$nomor++;
				}
				?>
			</tbody>
		</table>

	</small>
</div>





<?php echo card_close() ?>

<?php echo _js('datatables,icheck') ?>

<script>
	var page_version = "1.0.8"
</script>
<script>
	$(document).ready(function() {
		$('#example2').DataTable();
	});
</script>