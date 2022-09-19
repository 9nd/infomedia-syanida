<?php echo _css('datatables,icheck') ?>

<?php echo card_open('List Penggajihan', 'bg-teal', true) ?>
<div class='row'>
	<div class='col-md-6 col-lg-4'>
		<?php echo button_card('Generate Payroll', $title->general->button_create_desc, 'text-green', 'btn-success', 'fe fe-edit', 'bg-green', 'btn-create', $link_generate) ?>
	</div>

</div>

<div class='box-body table-responsive' id='box-table'>
	<table class='display responsive nowrap' id="example" style="width: 100%;">
		<thead>
			<tr>
				<th style="font-size: 12px"><b>No</b></th>
				<th style="font-size: 12px"><b>Periode Penggajihan</b></th>
				<th style="font-size: 12px"><b>Skema Penggajihan</b></th>
				<th style="font-size: 12px"><b>Total THP</b></th>
				<th style="font-size: 12px"><b>Status Approve</b></th>
				<th style="font-size: 12px"><b>Opsi</b></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$nomor = 1;
			foreach ($periode->result() as $datana) {

			?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $datana->periode; ?></td>
					<td><?php echo $datana->skema; ?></td>
					<td><?php echo $datana->total; ?></td>
					<td><?php
						$statusapp = $controller->db->query("SELECT * FROM t_payroll_approve WHERE periode = '$datana->periode'")->row();
						echo $statusapp->status_approve;
						?></td>
					<td><a href="<?php echo base_url(); ?>T_payroll/T_payroll/detail?periode=<?php echo $datana->periode; ?>"><i class="fe fe-list"></i></a></td>
				</tr>
			<?php
				$nomor++;
			}
			?>
		</tbody>
	</table>

</div>




<?php echo card_close() ?>

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
	});
</script>