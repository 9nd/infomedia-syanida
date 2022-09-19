<?php echo _css('datatables,icheck') ?>

<?php echo card_open('List Penggajihan Periode ', 'bg-teal', true) ?>


<div class='box-body table-responsive' id='box-table'>


	<table class='display responsive nowrap' id="example" style="width: 100%;">
		<thead>
			<tr>
				<th style="font-size: 12px"><b>No</b></th>
				<th style="font-size: 12px"><b>Nama Agent</b></th>
				<th style="font-size: 12px"><b>Hadir</b></th>
				<th style="font-size: 12px"><b>Kehadiran</b></th>
				<th style="font-size: 12px"><b>Contacted</b></th>
				<th style="font-size: 12px"><b>Verified</b></th>
				<th style="font-size: 12px"><b>Tenur</b></th>
				<th style="font-size: 12px"><b>Reward</b></th>
				<th style="font-size: 12px"><b>Pendidikan</b></th>
				<th style="font-size: 12px"><b>Foreign</b></th>
				<th style="font-size: 12px"><b>Contacted</b></th>
				<th style="font-size: 12px"><b>Verified</b></th>
				<th style="font-size: 12px"><b>Masa</b></th>
				<th style="font-size: 12px"><b>Reward</b></th>
				<th style="font-size: 12px"><b>Pendidikan</b></th>
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
				<th style="font-size: 12px"><b>Contacted</b></th>
				<th style="font-size: 12px"><b>Verified</b></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$nomor = 1;
			// var_dump($list_agent_d['results']);
			foreach ($list_agent_d['results'] as $datana) {

			?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $datana->nama; ?></td>
					<?php
					
					
					//masa kerja
					$masakerja = $controller->db->query("SELECT tanggal_gabung, pendidikan FROM sys_user_detail WHERE agentid = '$datana->agentid'");
					$now = strtotime("now");
					$your_date = strtotime($masakerja->row()->tanggal_gabung);
					$datediff = $now - $your_date;
					$masakerjah = round($datediff / (60 * 60 * 24 * 30));

					// pendidikan
					if ($masakerja->row()->pendidikan == "S1") {
						$pendidikan = 100;
					} else if ($masakerja->row()->pendidikan == "D3") {
						$pendidikan = 80;
					} else if ($masakerja->row()->pendidikan == "D1") {
						$pendidikan = 60;
					} else {
						$pendidikan = 40;
					}

					//score
					$score = ($achivement_c * 30 / 100) + ($achivement_v * 50 / 100) + ($masakerjah * 5 / 100) + ($pendidikan * 5 / 100);
					$scoret = round($score, 2);
					?>
					<td><?php $datana->agentid['hk']?></td>
					<td><?php echo $kehadiran * 100 . "%"; ?></td>
					<td><?php echo $achivement_c . "%"; ?></td>
					<td><?php echo $achivement_v . "%"; ?></td>
					<td><?php echo $masakerjah; ?></td>
					<td>0</td>
					<td><?php echo $pendidikan; ?></td>
					<td>0</td>
					<?php

					if ($achivement_c > 100) {
						$n_achivement = 100;
					} else if ($achivement_c > 80) {
						$n_achivement = 80;
					} else if ($achivement_c > 60) {
						$n_achivement = 60;
					} else if ($achivement_c > 30) {
						$n_achivement = 30;
					}

					if ($achivement_v > 100) {
						$n_vachivement = 100;
					} else if ($achivement_v > 80) {
						$n_vachivement = 80;
					} else if ($achivement_v > 60) {
						$n_vachivement = 60;
					} else if ($achivement_v > 30) {
						$n_vachivement = 30;
					}
					?>
					<td><?php echo $n_achivement * 30 / 100; ?></td>
					<td><?php echo $n_vachivement * 50 / 100; ?></td>
					<td><?php echo $masakerjah * 5 / 100; ?></td>
					<td><?php echo $pendidikan * 5 / 100; ?></td>
					<td>0</td>
					<td>0</td>

					<td><?php echo $scoret; ?></td>
					<?php
					if ($scoret < 30) {
						$level = "Pemula";
					} else if ($scoret < 50) {
						$level = "Junior";
					} else if ($scoret < 80) {
						$level = "Madya";
					} else {
						$level = "Senior";
					}
					?>
					<td><?php echo $level; ?></td>
					<?php
					$queryako = $controller->db->query("SELECT * FROM t_payroll_akomodasi WHERE jabatan='$level'");
					$akomodasi = $queryako->row()->akomodasi;
					if ($kehadiran >= 1) {
						$akomodasi = $akomodasi;
					} else {
						$akomodasi = $kehadiran * $akomodasi;
					}
					?>
					<td><?php echo $akomodasi; ?></td>
					<td><?php echo $queryako->row()->tunjangan_transport; ?></td>
					<?php

					if ($achivement_c >= 100) {
						$komisi = $queryako->row()->komisi;
					} else {
						$komisi = ($achivement_c / 100) * $queryako->row()->komisi;
					}
					?>
					<td>
						<?php echo $komisi; ?>
					</td>
					<td><?php echo $queryako->row()->tunjangan_level; ?></td>
					<td><?php echo $queryako->row()->tunjangan_jabatan; ?></td>
					<td>
						<?php
						$thp_leveling = $akomodasi + $queryako->row()->tunjangan_transport + $komisi + $queryako->row()->tunjangan_level + $queryako->row()->tunjangan_jabatan;
						echo $thp_leveling;
						?>
					</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>4			
					</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
					<td>8</td>
					<td>9</td>
					<td>10</td>
					<td>11</td>
					<td><?php
						echo $datacont->row()->jumlah;
						?></td>
					<td><?php
						echo $dataver->row()->jumlah;
						?></td>
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