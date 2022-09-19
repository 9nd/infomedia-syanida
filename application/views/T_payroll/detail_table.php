<?php echo _css('datatables,icheck') ?>

<?php echo card_open('Detail payroll Periode ' . $periode, 'bg-teal', true) ?>
<div class='box-body table-responsive' id='box-table'>
	<div class='col-md border-left'>
		<table class='display responsive nowrap' id="example" style="width: 100%;">
			<thead>
				<tr>
					<th style="font-size: 12px"><b>No</b></th>
					<th style="font-size: 12px"><b>Opsi</b></th>
					<th style="font-size: 12px"><b>Nama Agent</b></th>
					<th style="font-size: 12px"><b>Hadir</b></th>
					<th style="font-size: 12px"><b>%Kehadiran</b></th>
					<th style="font-size: 12px"><b>%Contacted</b></th>
					<th style="font-size: 12px"><b>%Verified</b></th>
					<th style="font-size: 12px"><b>Tenur</b></th>
					<th style="font-size: 12px"><b>Reward</b></th>
					<th style="font-size: 12px"><b>Pendidikan</b></th>
					<th style="font-size: 12px"><b>Foreign</b></th>
					<th style="font-size: 12px"><b>s_Contacted</b></th>
					<th style="font-size: 12px"><b>s_Verified</b></th>
					<th style="font-size: 12px"><b>s_Masa</b></th>
					<th style="font-size: 12px"><b>s_Reward</b></th>
					<th style="font-size: 12px"><b>s_Pendidikan</b></th>
					<th style="font-size: 12px"><b>Foreign</b></th>
					<th style="font-size: 12px"><b>Score</b></th>
					<th style="font-size: 12px"><b>Level</b></th>
					<th style="font-size: 12px"><b>Akomodasi</b></th>
					<th style="font-size: 12px"><b>Tunjangan Transport</b></th>
					<th style="font-size: 12px"><b>Komisi</b></th>
					<th style="font-size: 12px"><b>Tunjangan Level</b></th>
					<th style="font-size: 12px"><b>Tunjangan Jabatan</b></th>
					<th style="font-size: 12px"><b>THP Leveling</b></th>
					<th style="font-size: 12px"><b>OT Fee MOS</b></th>
					<th style="font-size: 12px"><b>Other Fee</b></th>
					<th style="font-size: 12px"><b>Tunjangan Skill</b></th>
					<th style="font-size: 12px"><b>HP + Email Perbantuan</b></th>
					<th style="font-size: 12px"><b>HP Only</b></th>
					<th style="font-size: 12px"><b>Total Perbantuan</b></th>
					<th style="font-size: 12px"><b>Total THP</b></th>
					<th style="font-size: 12px"><b>NON THP</b></th>
					<th style="font-size: 12px"><b>Benefit Lain</b></th>
					<th style="font-size: 12px"><b>M Fee</b></th>
					<th style="font-size: 12px"><b>Head Count</b></th>
					<th style="font-size: 12px"><b>Jml_Verified</b></th>
					<th style="font-size: 12px"><b>Jml_Contacted</b></th>
					<th style="font-size: 12px"><b>Jml_HPemail</b></th>
					<th style="font-size: 12px"><b>Jml_hp</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($t_payroll->result() as $datana) {


				?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><a href="<?php echo base_url()?>T_payroll/T_payroll/edit?id=<?php echo $datana->id; ?>"><i class="fe fe-edit"></i></a></td>
						<td><?php echo $datana->agentid; ?></td>
						<td><?php echo $datana->hadir; ?></td>
						<td><?php echo $datana->kehadiran; ?></td>
						<td><?php echo $datana->contacted; ?></td>
						<td><?php echo $datana->verified; ?></td>
						<td><?php echo $datana->tenur; ?></td>
						<td><?php echo $datana->reward; ?></td>
						<td><?php echo $datana->pendidikan; ?></td>
						<td><?php echo $datana->foreign; ?></td>
						<td><?php echo $datana->s_contacted; ?></td>
						<td><?php echo $datana->s_verified; ?></td>
						<td><?php echo $datana->s_tenur; ?></td>
						<td><?php echo $datana->s_reward; ?></td>
						<td><?php echo $datana->s_pendidikan; ?></td>
						<td>0</td>
						<td><?php echo $datana->score; ?></td>
						<td><?php echo $datana->level; ?></td>
						<td><?php echo $datana->akomodasi; ?></td>
						<td><?php echo $datana->t_transport; ?></td>
						<td><?php echo $datana->komisi; ?></td>
						<td><?php echo $datana->tunj_level; ?></td>
						<td><?php echo $datana->tunj_jabatan; ?></td>
						<td><?php echo $datana->thp_leveling; ?></td>
						<td><?php echo $datana->ot_moss; ?></td>
						<td><?php echo $datana->other_fee; ?></td>
						<td><?php echo $datana->tunj_skill; ?></td>
						<td><?php echo $datana->perbantuan_hpemail; ?></td>
						<td><?php echo $datana->perbantuan_hponly; ?></td>
						<td><?php echo $datana->nominal_perbantuan; ?></td>
						<td><?php echo $datana->total_thp; ?></td>
						<td><?php echo $datana->non_thp; ?></td>
						<td><?php echo $datana->benefit_lain; ?></td>
						<td><?php echo $datana->m_fee; ?></td>
						<td><?php echo $datana->headcount; ?></td>
						<td><?php echo $datana->jml_verified; ?></td>
						<td><?php echo $datana->jml_contacted; ?></td>
						<td><?php echo $datana->jml_hpemail; ?></td>
						<td><?php echo $datana->jmlhp; ?></td>
					</tr>
				<?php
					$no++;
				}
				?>
			</tbody>
		</table>
	</div>
</div>



<?php echo card_close() ?>

<?php echo _js('datatables,icheck') ?>
<script src="<?php echo base_url() ?>assets/DataTablesResponsive/dataTables.altEditor.free.min.js"></script>
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
<script>

</script>