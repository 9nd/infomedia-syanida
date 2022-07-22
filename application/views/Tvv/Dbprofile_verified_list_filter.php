<?php echo _css('datatables,icheck') ?>

<?php echo card_open('Daftar', 'bg-teal', true) ?>

<div class='box-body table-responsive' id='box-table'>
	<small>
		<table id='table-detail' class='table' style='width:150%'>
			<thead>

				<tr>
					<th>No</th>
					<th>NCLI</th>
					<th>PSTN</th>
					<th>NO.INTERNET</th>
					<th>NAMA PELANGGAN</th>
					<th>RELASI</th>
					<th>NO_HP</th>
					<th>EMAIL</th>
					<th>NAMA_PEMILIK</th>
					<th>ALAMAT</th>
					<th>KOTA</th>
					<th>REGIONAL</th>
					<th>TGL VERIFIKASI</th>
					<th>SUMBER</th>
					<th>ACTION</th>
				</tr>

				</tdead>
			<tbody>
				<?php
				$n = 1;
				if (count($data)) {
					foreach ($data as $dt) {
				?>
						<tr>
							<td><?php echo $n; ?></td>
							<td><?php echo $dt['NCLI']; ?></td>
							<td><?php echo $dt['NO_PSTN']; ?></td>
							<td><?php echo $dt['NO_SPEEDY']; ?></td>
							<td><?php echo $dt['NAMA_PELANGGAN']; ?></td>
							<td><?php echo $dt['RELASI']; ?></td>
							<td><?php echo $dt['NO_HP']; ?></td>
							<td><?php echo $dt['EMAIL']; ?></td>
							<td><?php echo $dt['NAMA_PEMILIK']; ?></td>
							<td><?php echo $dt['ALAMAT']; ?></td>
							<td><?php echo $dt['KOTA']; ?></td>
							<td><?php echo $dt['REGIONAL']; ?></td>
							<td><?php echo $dt['TGL_VERIFIKASI']; ?></td>
							<td><?php echo $dt['SUMBER']; ?></td>
							<td><a href="<?php echo $link_edit."?berdasarkan=".$berdasarkan."&ncli=".$ncli."&tgl_veri=".$dt['TGL_VERIFIKASI'];?>" class="btn btn-default text-red btn-sm " title="update"><i class="fa fa-edit"></i></a></td>
						</tr>

				<?php
						$n++;
					}
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
	var resp_table = true;
	var table_detail;
	$(document).ready(function() {



	});
</script>