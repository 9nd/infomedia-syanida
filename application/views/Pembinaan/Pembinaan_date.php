<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->
<?php

echo _css("datatables");

echo _css("selectize,multiselect");

?>
<link href="<?php echo base_url(); ?>assets/progress_bar/css/static.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/progress_bar/js/jquery.progresstimer.js"></script>
<script src="<?php echo base_url(); ?>assets/progress_bar/js/static.min.js"></script>

<div class='col-md-12 col-xl-12'>
	<div class="card">
		<div class="card-status bg-green"></div>
		<?php
		if ($opt_level == 8) {
		?>
			<div class="card-header">
				<h3 class="card-title">Coaching List Agent <?php echo $userdata->nama ?>
				</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>

			<div class="card-body">
				<div class='box-body table-responsive' id='box-table'>
					<small>
						<table class='timecard display responsive' id="report_table_reg" style="width: 100%;">
							<thead>
								<tr>
									<th>No</th>
									<th>Opsi</th>
									<th>Agent Name</th>
									<th>TL</th>
									<th>Tanggal Pembinaan</th>
									<th>Input By</th>
									<th>Penyuluhan</th>
									<th>Action Plan</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$n = 1;
								foreach ($pembagent->result()  as $datana) {


								?>
									<tr>
										<td><?php echo $n; ?></td>
										<td><a target="_blank" href="<?php echo base_url() ?>Pembinaan/Pembinaan/Detailagent?agentid=<?php echo $datana->agentid ?>&tanggal=<?php echo $datana->tanggal_pembinaan ?>"></a></td>
										<?php
										$agentds = $datana->agentid;
										$querys = $controller->db->query("SELECT * FROM sys_user WHERE agentid = '$agentds'")->row();
										echo "<td>" . $querys->nama . "</td>";
										echo "<td>" . $querys->tl . "</td>";
										?>
										<td><?php echo $datana->tanggal_pembinaan; ?></td>
										<td><?php echo $datana->input_by; ?></td>
										<td><?php echo $datana->penyuluhan; ?></td>
										<td><?php echo $datana->action_plan; ?></td>
										<td><?php echo $datana->keterangan; ?></td>
										<td><a href='<?php echo base_url(); ?>Pembinaan/Pembinaan/detail_agent?agentid=<?php echo $datana->agentid; ?>&tp=<?php echo $datana->tanggal_pembinaan ?>' target='_blank'><span class='fa fa-list'></a></span>&nbsp;&nbsp;<a href='<?php echo base_url(); ?>Pembinaan/Pembinaan/edit_agent?agentid=<?php echo $datana->agentid; ?>&tp=<?php echo $datana->tanggal_pembinaan ?>' target='_blank'><span class="fa fa-pencil-square-o"></span></a></td>

									</tr>

								<?php
									$n++;
								}
								// }
								?>



							</tbody>
						</table>
					</small>
				</div>
			</div>
		<?php
		}
		if ($opt_level != 8) {
		?>
			<div class="card-header">
				<h3 class="card-title">Pembinaan List

				</h3><a href="<?php echo base_url() ?>Pembinaan/Pembinaan/Tambah_form">&nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-primary" value="Tambah"></a>
				<div class="card-options">
					<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen">
						<i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div class='box-body table-responsive' id='box-table'>
					<small>
						<table class='timecard display responsive' id="report_table_reg" style="width: 100%;">
							<thead>
								<tr>
									<th>No</th>
									<th>Opsi</th>
									<th>Agent Name</th>
									<th>TL</th>
									<th>Tanggal</th>
									<th>Input By</th>
									<th>Penyuluhan</th>
									<th>Action Plan</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$n = 1;
								foreach ($data_tapping  as $datana) {


								?>
									<tr>
										<td><?php echo $n; ?></td>
										<td><a target="_blank" href="<?php echo base_url() ?>Pembinaan/Pembinaan/detailagent?agentid=<?php echo $datana->agentid ?>&tanggal=<?php echo $datana->tanggal_pembinaan ?>"><span class="fa fa-list"></span></a></td>
										<?php
										$agentds = $datana->agentid;
										$querys = $controller->db->query("SELECT nama,tl FROM sys_user WHERE agentid = '$agentds'")->row();
										echo "<td>" . $querys->nama . "</td>";
										echo "<td>" . $querys->tl . "</td>";
										?>
										<td><?php echo $datana->tanggal_pembinaan; ?></td>
										<td><?php echo $datana->input_by; ?></td>
										<td><?php echo $datana->penyuluhan; ?></td>
										<td><?php echo $datana->action_plan; ?></td>
										<td><?php echo $datana->keterangan; ?></td>

									</tr>

								<?php
									$n++;
								}
								// }
								?>



							</tbody>
						</table>
					</small>
				</div>
			</div>
	</div>
	<?php echo _js('datatables,icheck') ?>

	<script type="text/javascript">
		$(document).ready(function() {

			$("#report_table_reg").DataTable({
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf'
				]
			});
		});
	</script>
<?php
		}
?>
</div>