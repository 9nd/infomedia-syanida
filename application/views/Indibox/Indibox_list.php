<?php echo _css('datatables,icheck') ?>

<?php echo card_open('Daftar', 'bg-teal', true) ?>

<div class='row'>
	<div class='col-md-6 col-lg-4'>
		<?php echo button_card($title->general->button_create, $title->general->button_create_desc, 'text-green', 'btn-success', 'fe fe-list', 'bg-green', 'btn-create', $link_create) ?>
	</div>
	<!-- <div class='col-md-6 col-lg-4'>
		<?php echo button_card($title->general->button_delete, $title->general->button_delete_desc, 'text-red', 'btn-danger', 'fe fe-trash', 'bg-red', 'btn-delete') ?>
	</div> -->
</div>

<div class='box-body table-responsive' id='box-table'>
	<small>
		<table class='display responsive nowrap' id="example" style="width: 100%;">
			<thead>
				<tr>
					<th><b>No</b></th>
					<th><b>Option</b></th>
					<th><b>NCLI</b></th>
					<th><b>NO PSTN</b></th>
					<th><b>No Speedy</b></th>
					<th><b>Nama Pelanggan</b></th>
					<th><b>Email</b></th>
					<th><b>No Handphone</b></th>
					<th><b>Reason Call</b></th>
					<th><b>Keterangan</b></th>

				</tr>
			</thead>
			<tbody>
				<?php
				$nomor = 1;


				foreach ($indibox as $datana) {



				?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td>
							<a href="<?php echo base_url() . "Indibox/Indibox/detail/" . $datana['idx'] ?>" class="btn btn-default text-red btn-sm " title="detail"><i class="fa fa-info"></i></a>
							<a href="<?php echo $link_update . "/" . $datana['idx'] ?>" class="btn btn-default text-red btn-sm " title="update"><i class="fa fa-edit"></i></a>
							<!-- <a href="
							<?php //echo $link_delete . "/" . $datana['idx'] ?>
							" class="btn btn-default text-red btn-sm" title="delete" onclick="deleteItem(<?php // echo $datana['id']; ?>)"><i class="fa fa-trash"></i></a> -->
						</td>
						<td><?php echo $datana['ncli']; ?></td>
						<td><?php echo $datana['no_pstn']; ?></td>
						<td><?php echo $datana['no_speedy']; ?></td>
						<td><?php echo $datana['nama_pelanggan']; ?></td>
						<td><?php echo $datana['email']; ?></td>
						<td><?php echo $datana['no_hp']; ?></td>
						<td><?php echo $datana['reason_call']; ?></td>
						<td><?php echo $datana['keterangan']; ?></td>
					</tr>
				<?php
					$nomor++;
				}
				?>
			</tbody>
		</table>

		<div hidden>
			<button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modal-danger' id='button_delete_single'></button>
		</div>
	</small>
</div>





<?php echo card_close() ?>

<?php echo _js('datatables,icheck') ?>

<script>
	var page_version = "1.0.8"
</script>
<script>
	$(document).ready(function() {
		$('#example').DataTable();
	});

	function deleteItem() {
		if (confirm("anda ingin hapus data ini?")) {
			// your deletion code
		}
		return false;
	}
</script>
