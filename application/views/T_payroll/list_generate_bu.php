<?php echo _css('datatables,icheck') ?>


<div class='box-body table-responsive' id='box-table'>


	<table class='display responsive nowrap' id="example" style="width: 100%;">
		<thead>
			<tr>
				<th style="font-size: 12px"><b>No</b></th>
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
				<th style="font-size: 12px"><b>Verified</b></th>
				<th style="font-size: 12px"><b>Contacted</b></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$nomor = 1;
			// var_dump($list_agent_d['results']);
			foreach ($list_agent_d['results'] as $datana) {
				if ($datana->agentid_mos == $agentmoss[$datana->agentid_mos]['moss_duty']) {
					$warna = "background-color: yellow";
					$agent = $datana->agentid_mos;
				} else {
					$warna = "";
					$agent = $datana->agentid;
				}
			?>
				<!-- <tr > -->
				<tr style="<?php if (isset($warna)) {
								echo $warna;
							} ?>">
					<td><?php echo $nomor; ?></td>
					<td><?php echo $datana->nama; ?></td>
					<td><?php echo $hkagent[$agent]['hk'] ?></td>
					<td><?php echo number_format($hkagent[$agent]['hk'] / $kehadiran['hknya'], 2) ?></td>
					<td><?php echo number_format($contacted[$agent]['r_contcs']['achievementc'], 2) ?></td>
					<td><?php echo number_format($contacted[$agent]['r_verif']['achievementk'], 2) ?></td>
					<td><?php echo number_format($tenur[$datana->agentid]['tenur']) ?></td>
					<td>0</td>
					<td><?php echo $tenur[$datana->agentid]['pendidikan'] ?></td>
					<td>0</td>
					<td><?php
						$ctc = $contacted[$agent]['r_contcs']['achievementc'];
						if ($ctc >= 1) {
							$sc_cont = 100;
						} else if ($ctc >= 0.8) {
							$sc_cont = 80;
						} else if ($ctc >= 0.6) {
							$sc_cont = 60;
						} else if ($ctc >= 0.4) {
							$sc_cont = 30;
						} else {
							$sc_cont = 0;
						}
						$asc_cont = $sc_cont * 30 / 100;
						echo number_format($asc_cont);
						?></td>
					<td><?php
						$ctv = $contacted[$agent]['r_verif']['achievementk'];
						if ($ctv < 0.5) {
							$sc_ver = 0;
						} else if ($ctv < 0.75) {
							$sc_ver = 50;
						} else if ($ctv < 0.9) {
							$sc_ver = 75;
						} else if ($ctv < 1) {
							$sc_ver = 90;
						} else {
							$sc_ver = 100;
						}
						$asc_ver = $sc_ver * 50 / 100;
						echo number_format($asc_ver);
						?></td>
					<td>
						<?php
						$tenura = $tenur[$datana->agentid]['tenur'];
						if ($tenura < 3) {
							$sc_tenur = 40;
						} else if ($tenura < 6) {
							$sc_tenur = 60;
						} else if ($tenura < 12) {
							$sc_tenur = 80;
						} else if ($tenura > 12) {
							$sc_tenur = 100;
						} else {
							$sc_tenur = 0;
						}
						$asc_tenur = $sc_tenur * 5 / 100;
						echo number_format($asc_tenur);
						?>
					</td>
					<td>0</td>
					<td>
						<?php
						$pendidikana = $tenur[$datana->agentid]['pendidikan'];
						if ($pendidikana == "S1") {
							$sc_pendidikan = 100;
						} else if ($pendidikana == "D3") {
							$sc_pendidikan = 80;
						} else if ($pendidikana == "D1") {
							$sc_pendidikan = 60;
						} else if ($pendidikana == "SMU" || $pendidikana == "SMA") {
							$sc_pendidikan = 40;
						} else {
							$sc_pendidikan = 0;
						}
						$asc_pendidikan = $sc_pendidikan * 5 / 100;
						echo number_format($asc_pendidikan);
						// echo $datana->agentid;
						?>
					</td>
					<td>0</td>
					<td><?php
						if ($agent == $datana->agentid) {
							$tot_score = $asc_cont + $asc_ver + $asc_tenur + $asc_pendidikan;
						} else {
							$tot_score = 70;
						}

						echo number_format($tot_score);
						?></td>
					<?php
					if ($tot_score < 30) {
						$level = "Pemula";
					} else if ($tot_score < 50) {
						$level = "Junior";
					} else if ($tot_score < 80) {
						$level = "Madya";
					} else {
						$level = "Senior";
					}
					?>
					<td><?php echo $level; ?></td>
					<td><?php
						$sakomodasi = $akomodasi[$level]['akomodasi'];
						if ($hkagent[$agent]['hk'] >= 1) {
							$sakomodasi = $sakomodasi;
						} else {
							$sakomodasi = $hkagent[$agent]['hk'] * $sakomodasi;
						}
						echo $sakomodasi;
						?></td>
					<td><?php echo ($akomodasi[$level]['tunjangan_transport'] * $hkagent[$agent]['hk']) ?></td>
					<td><?php echo ($akomodasi[$level]['komisi'] * $contacted[$agent]['r_contcs']['achievementc']) ?></td>
					<td><?php
						if ($ctv > 1) {
							$tunjanganlevel = $akomodasi[$level]['tunjangan_level'];
						} else {
							$tunjanganlevel = $akomodasi[$level]['tunjangan_level'] * $ctv;
						}
						echo $tunjanganlevel; ?></td>
					<td><?php echo $akomodasi[$level]['tunjangan_jabatan'] ?></td>
					<td><?php
						$thpleveling = $sakomodasi + ($akomodasi[$level]['tunjangan_transport'] * $hkagent[$agent]['hk']) + ($akomodasi[$level]['komisi'] * $contacted[$agent]['r_contcs']['achievementc']) + $tunjanganlevel + $akomodasi[$level]['tunjangan_jabatan'];
						echo $thpleveling ?></td>
					<td>0</td>
					<td>0</td>
					<td><?php echo $akomodasi[$level]['tunjangan_skill'] ?></td>
					<td><?php
						$hpemails = $hpemail[$agent]['hpemail'];
						$kelebihanhpemail = ($kehadiran['hknya'] * 95) - $contacted[$agent]['verif'];
						if ($kelebihanhpemail > 0) {
							$kelebihanhpemail = $kelebihanhpemail;
							$rupiah = $kelebihanhpemail * 5000;
						} else {
							$kelebihanhpemail = 0;
							$rupiah = 0;
						}
						echo $kelebihanhpemail;
						?>

					</td>
					<td>0</td>
					<td><?php echo $rupiah; ?></td>
					<td><?php
						$tottahp = $thpleveling + $akomodasi[$level]['tunjangan_skill'] + $rupiah;
						echo  $tottahp;
						?></td>
					<td><?php echo $akomodasi[$level]['non_thp'] ?></td>
					<td><?php echo $akomodasi[$level]['benefit_lain'] ?></td>
					<td><?php echo $akomodasi[$level]['m_fee'] ?></td>
					<td><?php
						$headcount = $tottahp + $akomodasi[$level]['tunjangan_skill'] + $akomodasi[$level]['non_thp'] + $akomodasi[$level]['benefit_lain'] + $akomodasi[$level]['m_fee'];
						echo  $headcount;
						?></td>
					<td><?php echo $contacted[$agent]['verif'] ?></td>
					</td>
					<td><?php echo $contacted[$agent]['contcs'] ?></td>
					</td>
				</tr>
			<?php
				$nomor++;
			}
			?>
		</tbody>
	</table>
	<button id='btn-save' class='btn btn-primary col-2 pull-right submitg'><i class="fe fe-save"></i>Submit</button>

</div>




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

	$('.submitg').on('click', function() {
		var msg = confirm('Insert Data?');
		if (msg) {
			var start = $("#start").val();
			var end = $("#end").val();

			$.ajax({
				url: "<?php echo base_url() . "T_payroll/T_payroll/bulk_insert" ?>",
				data: {
					start: start,
					end: end
				},
				type: "get",
				success: function(response) {
					alert("success");
				}
			});
			// alert('The table has '+data.length+' records');
		}
	});

	// var table = $('#example').DataTable();

	// $('#example tbody').on('click', 'tr', function() {
	// 	console.log(table.row(this).data());
	// });
</script>