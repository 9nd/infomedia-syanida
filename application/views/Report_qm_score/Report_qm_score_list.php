<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->

<?php echo _css('selectize,chartjs,multiselect,datatables') ?>
<div class='col-md-12 col-xl-12'>
	<div class="card">
		<div class="card-status bg-green"></div>
		<div class="card-header">
			<h3 class="card-title">FILTER
			</h3>
			<div class="card-options">
				<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
				<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
			</div>
		</div>
		<div class="card-body">
			<div class='box-body' id='box-table'>

				<form id='form-a' methode="GET">
					<div class="row">
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Mulai Dari</label>
								<input type='date' class='form-control data-sending focus-color' id='id_reason' name='start_tap' value='<?php if (isset($_GET['start_tap'])) echo $_GET['start_tap'] ?>' required>
							</div>
						</div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Sampai </label>
								<input type='date' class='form-control data-sending focus-color' id='id_reason' name='end_tap' value='<?php if (isset($_GET['end_tap'])) echo $_GET['end_tap'] ?>' required>
							</div>
						</div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Agent</label>
								<select name='agentid[]' id="agentid" class="form-control custom-select" multiple="multiple">
									<?php
									if ($user_categori != 8) {
									?>
										<option value="0">--Semua Agent--</option>
									<?php
									}
									if ($list_agent['num'] > 0) {
										foreach ($list_agent['results'] as $d_agent) {
											$selected = "";
											if (isset($_GET['agentid'])) {

												if (count($_GET['agentid']) > 1) {

													foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
														if ($v_agentid == $d_agent->agentid) {
															$selected = 'selected';
														}
													}
												} else {
													$selected = ($d_agent->agentid == $_GET['agentid'][0]) ? 'selected' : '';
												}
											}
											echo "<option value='" . $d_agent->agentid . "' " . $selected . ">" . $d_agent->agentid . "-" . $d_agent->nama . "</option>";
										}
									}
									?>

								</select>
							</div>
						</div>

						<div class='col-md-12 col-xl-12'>

							<div class='form-group'>
								<button id='btn-save' type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Search</button>
							</div>

						</div>
					</div>
				</form>

			</div>
		</div>


	</div>
</div>
<?php



if (isset($_GET['start_tap']) && isset($_GET['end_tap'])) {

?>


	<div class="col-md">
		<div class="panel panel-lte">
			<div class="panel-heading lte-heading-success">Report QC</div>
			<div class="panel-body">
				<table class='table'>
					<thead>
						<tr>
							<th><b>Site</b></th>
							<th><b>Tanggal</b></th>
							<th>Total sampel</th>
							<th>% Pencapaian QM Score</th>
							<th>% Ketidaktercapaian QM Score</th>
						</tr>
					</thead>
					<tbody id="num_area">
						<tr>
							<td align="center">Bandung</td>
							<td align="center"><?php echo $_GET['start_tap'] . "-" . $_GET['end_tap'] ?></td>
							<td align="center"><?php echo count($report_qms); ?></td>
							<?php

							foreach ($report_qms as $r) {
								if (count($_GET['agentid']) > 1) {
									$pencapaian_1[$r->id] = 3 * $r->skill_communication_1;
									$pencapaian_2[$r->id] = 3 * $r->skill_communication_2;
									$pencapaian_3[$r->id] = 3 * $r->skill_communication_3;
									$pencapaian_4[$r->id] = 3 * $r->skill_communication_4;
									$pencapaian_5[$r->id] = 2 * $r->skill_communication_5;
									$pencapaian_6[$r->id] = 10 * $r->skill_communication_6;
									$pencapaian_7[$r->id] = 3 * $r->skill_communication_7;
									$pencapaian_8[$r->id] = 2 * $r->skill_communication_8;
									$pencapaian_9[$r->id] = 2 * $r->validation_1;
									$pencapaian_10[$r->id] = 2 * $r->validation_2;
									$pencapaian_11[$r->id] = 2 * $r->validation_3;
									$pencapaian_12[$r->id] = 2 * $r->validation_4;
									$pencapaian_13[$r->id] = 2 * $r->validation_5;
									$pencapaian_14[$r->id] = 5 * $r->validation_6;
									$pencapaian_15[$r->id] = 3 * $r->validation_7;
									$pencapaian_16[$r->id] = 20 * $r->validation_8;
									$pencapaian_17[$r->id] = 10 * $r->validation_9;
									$pencapaian_18[$r->id] = 10 * $r->validation_10;
									$pencapaian_19[$r->id] = 3 * $r->validation_11;
									$pencapaian_20[$r->id] = 4 * $r->documentation_1;
									$pencapaian_21[$r->id] = 3 * $r->documentation_2;
									$pencapaian_22[$r->id] = 3 * $r->documentation_3;
									$pencapaian_total_all[$r->id] = $pencapaian_1[$r->id] + $pencapaian_2[$r->id] + $pencapaian_3[$r->id] + $pencapaian_4[$r->id] + $pencapaian_5[$r->id] + $pencapaian_6[$r->id] +
										$pencapaian_7[$r->id] + $pencapaian_8[$r->id] + $pencapaian_9[$r->id] + $pencapaian_10[$r->id] + $pencapaian_11[$r->id] + $pencapaian_12[$r->id] + $pencapaian_13[$r->id] +
										$pencapaian_14[$r->id] + $pencapaian_15[$r->id] + $pencapaian_16[$r->id] + $pencapaian_17[$r->id] + $pencapaian_18[$r->id] + $pencapaian_19[$r->id] + $pencapaian_20[$r->id] +
										$pencapaian_21[$r->id] + $pencapaian_22[$r->id];
									$y = $pencapaian_total_all;
									$jml = array_sum($y) / count($report_qms);

									// $arr = array($jml);
									// $x = array_combine($arr,$arr);

									// $pencapaian_bobot = $pencapaian_total_all / 100 * 100;

								} else {
									$pencapaian_1 = 3 * $r->skill_communication_1;
									$pencapaian_2 = 3 * $r->skill_communication_2;
									$pencapaian_3 = 3 * $r->skill_communication_3;
									$pencapaian_4 = 3 * $r->skill_communication_4;
									$pencapaian_5 = 2 * $r->skill_communication_5;
									$pencapaian_6 = 10 * $r->skill_communication_6;
									$pencapaian_7 = 3 * $r->skill_communication_7;
									$pencapaian_8 = 2 * $r->skill_communication_8;
									$pencapaian_9 = 2 * $r->validation_1;
									$pencapaian_10 = 2 * $r->validation_2;
									$pencapaian_11 = 2 * $r->validation_3;
									$pencapaian_12 = 2 * $r->validation_4;
									$pencapaian_13 = 2 * $r->validation_5;
									$pencapaian_14 = 5 * $r->validation_6;
									$pencapaian_15 = 3 * $r->validation_7;
									$pencapaian_16 = 20 * $r->validation_8;
									$pencapaian_17 = 10 * $r->validation_9;
									$pencapaian_18 = 10 * $r->validation_10;
									$pencapaian_19 = 3 * $r->validation_11;
									$pencapaian_20 = 4 * $r->documentation_1;
									$pencapaian_21 = 3 * $r->documentation_2;
									$pencapaian_22 = 3 * $r->documentation_3;
									$pencapaian_total_all = $pencapaian_1 + $pencapaian_2 + $pencapaian_3 + $pencapaian_4 + $pencapaian_5 + $pencapaian_6 +
										$pencapaian_7 + $pencapaian_8 + $pencapaian_9 + $pencapaian_10 + $pencapaian_11 + $pencapaian_12 + $pencapaian_13 +
										$pencapaian_14 + $pencapaian_15 + $pencapaian_16 + $pencapaian_17 + $pencapaian_18 + $pencapaian_19 + $pencapaian_20 +
										$pencapaian_21 + $pencapaian_22;
									$ketidaktercapaian =  100 - $pencapaian_total_all;
								}
							}
							if (count($_GET['agentid']) > 1) {
								$ketidaktercapaian =  100 - round($jml);
								echo "<td align='center'>" . round($jml) . "%</td>";
								echo "<td align='center'>" . $ketidaktercapaian . "%</td>";
							} else {
								echo "<td align='center'>" . $pencapaian_total_all . "%</td>";
								echo "<td align='center'>" . $ketidaktercapaian . "%</td>";
							}

							?>

						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class='col-md-12 col-xl-12'>
		<div class="card">
			<div class="card-status bg-orange"></div>
			<div class="card-header">
				<h3 class="card-title">Report QM Score Periode

				</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div class='box-body' id=''>
					<small>
						<input id="copy_btn" type="button" value="copy">
						<br>
						<br>
						<table id='table' border=1 width="100%">
							<thead>
								<tr style="background-color: red; color: white;" align="center">
									<th rowspan=2></th>
									<th rowspan=2><b>Kategori</b></th>
									<th rowspan=2><b>Parameter</b></th>
									<th rowspan=2><b>Bobot</b></th>
									<th nowrap colspan=3><b>Persentase</b></th>
									<th rowspan=2><b>Pencapaian Bobot</b></th>
									<th rowspan=2><b>Pencapaian per kategori</b></th>
									<th rowspan=2><b>Ketidaktercapaian</b></th>
								</tr>
								<tr style="background-color: red; color: white;" align="center">
									<th nowrap>Nilai 1</th>
									<th nowrap>Nilai 0</th>
									<th>Total</th>
								</tr>
							</thead>
							<!-- <tbody>
							


							</tbody> -->
							<tfoot>
								<?php

								if (count($_GET['agentid']) > 1) {
									foreach ($report_qms as $r) {
										$skill_communication_1[$r->id] = $r->skill_communication_1;
										$y = $skill_communication_1[$r->id];
										$jml_skill_1 = $sum += $y;
										$a = $jml_skill_1 * 1;
										$b = $jml_skill_1 * 0;
										$total = $a + $b;
										$pencapaian = (3 * $total) / count($report_qms);

										$skill_communication_2[$r->id] = $r->skill_communication_2;
										$y2 = $skill_communication_2[$r->id];
										$jml_skill_2 = $sum2 += $y2;
										$a2 = $jml_skill_2 * 1;
										$b2 = $jml_skill_2 * 0;
										$total2 = $a2 + $b2;
										$pencapaian2 = (3 * $total2) / count($report_qms);

										$skill_communication_3[$r->id] = $r->skill_communication_3;
										$y3 = $skill_communication_3[$r->id];
										$jml_skill_3 = $sum3 += $y3;
										$a3 = $jml_skill_3 * 1;
										$b3 = $jml_skill_3 * 0;
										$total3 = $a3 + $b3;
										$pencapaian3 = (3 * $total3) / count($report_qms);

										$skill_communication_4[$r->id] = $r->skill_communication_4;
										$y4 = $skill_communication_4[$r->id];
										$jml_skill_4 = $sum4 += $y4;
										$a4 = $jml_skill_4 * 1;
										$b4 = $jml_skill_4 * 0;
										$total4 = $a4 + $b4;
										$pencapaian4 = (3 * $total4) / count($report_qms);

										$skill_communication_5[$r->id] = $r->skill_communication_5;
										$y5 = $skill_communication_5[$r->id];
										$jml_skill_5 = $sum5 += $y5;
										$a5 = $jml_skill_5 * 1;
										$b5 = $jml_skill_5 * 0;
										$total5 = $a5 + $b5;
										$pencapaian5 = (2 * $total5) / count($report_qms);

										$skill_communication_6[$r->id] = $r->skill_communication_6;
										$y6 = $skill_communication_6[$r->id];
										$jml_skill_6 = $sum6 += $y6;
										$a6 = $jml_skill_6 * 1;
										$b6 = $jml_skill_6 * 0;
										$total6 = $a6 + $b6;
										$pencapaian6 = (10 * $total6) / count($report_qms);

										$skill_communication_7[$r->id] = $r->skill_communication_7;
										$y7 = $skill_communication_7[$r->id];
										$jml_skill_7 = $sum7 += $y7;
										$a7 = $jml_skill_7 * 1;
										$b7 = $jml_skill_7 * 0;
										$total7 = $a7 + $b7;
										$pencapaian7 = (3 * $total7) / count($report_qms);

										$skill_communication_8[$r->id] = $r->skill_communication_8;
										$y8 = $skill_communication_8[$r->id];
										$jml_skill_8 = $sum8 += $y8;
										$a8 = $jml_skill_8 * 1;
										$b8 = $jml_skill_8 * 0;
										$total8 = $a8 + $b8;
										$pencapaian8 = (2 * $total8) / count($report_qms);

										$pencapaian_skill_1[$r->id] = 3 * $r->skill_communication_1;
										$pencapaian_skill_2[$r->id] = 3 * $r->skill_communication_2;
										$pencapaian_skill_3[$r->id] = 3 * $r->skill_communication_3;
										$pencapaian_skill_4[$r->id] = 3 * $r->skill_communication_4;
										$pencapaian_skill_5[$r->id] = 2 * $r->skill_communication_5;
										$pencapaian_skill_6[$r->id] = 10 * $r->skill_communication_6;
										$pencapaian_skill_7[$r->id] = 3 * $r->skill_communication_7;
										$pencapaian_skill_8[$r->id] = 2 * $r->skill_communication_8;
										$pencapaian_skill_total[$r->id] = $pencapaian_skill_1[$r->id] + $pencapaian_skill_2[$r->id] + $pencapaian_skill_3[$r->id] + $pencapaian_skill_4[$r->id] +
											$pencapaian_skill_5[$r->id] + $pencapaian_skill_6[$r->id] + $pencapaian_skill_7[$r->id] + $pencapaian_skill_8[$r->id];
										$pt = $pencapaian_skill_total;
										$tot = array_sum($pt) / 2;
										$pencapaian_kategory = $tot / 29 * 100;

										$total_plus = $a + $a2 + $a3 + $a4 + $a5 + $a6 + $a7 + $a8;
										$total_minus = 8 * count($report_qms) - $total_plus;
										$total_all = $total_plus + $total_minus;
										$ketidaktercapaian = 29  - $total_all;
									}

								?>
									<tr>
										<th style="background-color: green; color: white;" align="center" rowspan=9>Phone and Communication Skill</th>
										<th style="text-align:left;">Salam pembuka</th>
										<th style="text-align:left;">compliance critical error</th>
										<th style="text-align:left;">3%</th>
										<?php
										echo "<td align='center'>" . $a . "</td>";
										echo "<td align='center'>" . $b . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian) . "%</td>";


										echo "<td align='center' rowspan=8>" . round($pencapaian_kategory) . "%</td>";
										echo "<td align='center' rowspan=8> </td>";

										?>

									</tr>
									<tr>
										<th style="text-align:left;">Salam Penutup</th>
										<th style="text-align:left;">compliance critical error</th>
										<th style="text-align:left;">3%</th>
										<?php

										echo "<td align='center'>" . $a2 . "</td>";
										echo "<td align='center'>" . $b2 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian2) . "%</td>";
										?>

									</tr>
									<tr>
										<th style="text-align:left;">Mengucapkan nama pelanggan minimal 3 kali (awal, tengah & akhir) selama percakapan</th>
										<th style="text-align:left;">compliance critical error</th>
										<th style="text-align:left;">3%</th>
										<?php
										echo "<td align='center'>" . $a3 . "</td>";
										echo "<td align='center'>" . $b3 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian3) . "%</td>";
										?>

									</tr>
									<tr>
										<th style="text-align:left;">Menyampaikan informasi/pertanyaan dengan jelas, lengkap dan sistematis (tidak berbelit-belit)</th>
										<th style="text-align:left;">customer critical error</th>
										<th style="text-align:left;">3%</th>
										<?php

										echo "<td align='center'>" . $a4 . "</td>";
										echo "<td align='center'>" . $b4 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian4) . "%</td>";
										?>

									</tr>
									<tr>
										<th style="text-align:left;">Menggunakan bahasa Indonesia/inggris dengan baik & benar, serta sopan</th>
										<th style="text-align:left;">customer critical error</th>
										<th style="text-align:left;">2%</th>
										<?php

										echo "<td align='center'>" . $a5 . "</td>";
										echo "<td align='center'>" . $b5 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian5) . "%</td>";
										?>

									</tr>
									<tr>
										<th style="text-align:left;">Intonasi & artikulasi</th>
										<th style="text-align:left;">compliance critical error</th>
										<th style="text-align:left;">10%</th>
										<?php

										echo "<td align='center'>" . $a6 . "</td>";
										echo "<td align='center'>" . $b6 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian6) . "%</td>";
										?>

									<tr>
										<th style="text-align:left;">Memberikan perhatian kepada pelanggan secara aktif dan berempati</th>
										<th style="text-align:left;">customer critical error</th>
										<th style="text-align:left;">3%</th>
										<?php

										echo "<td align='center'>" . $a7 . "</td>";
										echo "<td align='center'>" . $b7 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian7) . "%</td>";
										?>

									</tr>
									<tr>
										<th style="text-align:left;">Agent menanyakan kabar pelanggan/kondisi inet pelanggan</th>
										<th style="text-align:left;">customer critical error</th>
										<th style="text-align:left;">2%</th>
										<?php

										echo "<td align='center'>" . $a8 . "</td>";
										echo "<td align='center'>" . $b8 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian8) . "%</td>";
										?>

									</tr>
									<tr style="background-color: red; color: white;" align="center">

										<th nowrap colspan=2><b>Subtotal</b></th>
										<th style="text-align:left;">29%</th>
										<?php

										echo "<td align='center'>" . $total_plus . "</td>";
										echo "<td align='center'>" . $total_minus . "</td>";
										echo "<td align='center'>" . $total_all . "</td>";
										echo "<td align='center'>" . $pencapaian_total . "%</td>";
										echo "<td align='center'></td>";
										echo "<td align='center'>" . $ketidaktercapaian . "%</td>";
										?>

									</tr>

									<?php
									foreach ($report_qms as $r) {
										$validation_1[$r->id] = $r->validation_1;
										$y = $validation_1[$r->id];
										$jml_skill_1 = $sum += $y;
										$a = $jml_skill_1 * 1;
										$b = $jml_skill_1 * 0;
										$total = $a + $b;
										$pencapaian = (2 * $total) / count($report_qms);

										$validation_2[$r->id] = $r->validation_2;
										$y2 = $validation_2[$r->id];
										$jml_skill_2 = $sum2 += $y2;
										$a2 = $jml_skill_2 * 1;
										$b2 = $jml_skill_2 * 0;
										$total2 = $a2 + $b2;
										$pencapaian2 = (2 * $total2) / count($report_qms);

										$validation_3[$r->id] = $r->validation_3;
										$y3 = $validation_3[$r->id];
										$jml_skill_3 = $sum3 += $y3;
										$a3 = $jml_skill_3 * 1;
										$b3 = $jml_skill_3 * 0;
										$total3 = $a3 + $b3;
										$pencapaian3 = (2 * $total3) / count($report_qms);

										$validation_4[$r->id] = $r->validation_4;
										$y4 = $validation_4[$r->id];
										$jml_skill_4 = $sum4 += $y4;
										$a4 = $jml_skill_4 * 1;
										$b4 = $jml_skill_4 * 0;
										$total4 = $a4 + $b4;
										$pencapaian4 = (2 * $total4) / count($report_qms);

										$validation_5[$r->id] = $r->validation_5;
										$y5 = $validation_5[$r->id];
										$jml_skill_5 = $sum5 += $y5;
										$a5 = $jml_skill_5 * 1;
										$b5 = $jml_skill_5 * 0;
										$total5 = $a5 + $b5;
										$pencapaian5 = (2 * $total5) / count($report_qms);

										$validation_6[$r->id] = $r->validation_6;
										$y6 = $validation_6[$r->id];
										$jml_skill_6 = $sum6 += $y6;
										$a6 = $jml_skill_6 * 1;
										$b6 = $jml_skill_6 * 0;
										$total6 = $a6 + $b6;
										$pencapaian6 = (5 * $total6) / count($report_qms);

										$validation_7[$r->id] = $r->validation_7;
										$y7 = $validation_7[$r->id];
										$jml_skill_7 = $sum7 += $y7;
										$a7 = $jml_skill_7 * 1;
										$b7 = $jml_skill_7 * 0;
										$total7 = $a7 + $b7;
										$pencapaian7 = (3 * $total7) / count($report_qms);

										$validation_8[$r->id] = $r->validation_8;
										$y8 = $validation_8[$r->id];
										$jml_skill_8 = $sum8 += $y8;
										$a8 = $jml_skill_8 * 1;
										$b8 = $jml_skill_8 * 0;
										$total8 = $a8 + $b8;
										$pencapaian8 = (20 * $total8) / count($report_qms);

										$validation_9[$r->id] = $r->validation_9;
										$y9 = $validation_9[$r->id];
										$jml_skill_9 = $sum9 += $y9;
										$a9 = $jml_skill_9 * 1;
										$b9 = $jml_skill_9 * 0;
										$total9 = $a9 + $b9;
										$pencapaian9 = (10 * $total9) / count($report_qms);

										$validation_10[$r->id] = $r->validation_10;
										$y10 = $validation_10[$r->id];
										$jml_skill_10 = $sum10 += $y10;
										$a10 = $jml_skill_10 * 1;
										$b10 = $jml_skill_10 * 0;
										$total10 = $a10 + $b10;
										$pencapaian10 = (10 * $total10) / count($report_qms);

										$validation_11[$r->id] = $r->validation_11;
										$y11 = $validation_11[$r->id];
										$jml_skill_11 = $sum11 += $y11;
										$a11 = $jml_skill_11 * 1;
										$b11 = $jml_skill_11 * 0;
										$total11 = $a11 + $b11;
										$pencapaian11 = (3 * $total11) / count($report_qms);

										$pencapaian_skill_1[$r->id] = 2 * $r->validation_1;
										$pencapaian_skill_2[$r->id] = 2 * $r->validation_2;
										$pencapaian_skill_3[$r->id] = 2 * $r->validation_3;
										$pencapaian_skill_4[$r->id] = 2 * $r->validation_4;
										$pencapaian_skill_5[$r->id] = 2 * $r->validation_5;
										$pencapaian_skill_6[$r->id] = 5 * $r->validation_6;
										$pencapaian_skill_7[$r->id] = 3 * $r->validation_7;
										$pencapaian_skill_8[$r->id] = 20 * $r->validation_8;
										$pencapaian_skill_9[$r->id] = 10 * $r->validation_9;
										$pencapaian_skill_10[$r->id] = 10 * $r->validation_10;
										$pencapaian_skill_11[$r->id] = 3 * $r->validation_11;
										$pencapaian_skill_total[$r->id] = $pencapaian_skill_1[$r->id] + $pencapaian_skill_2[$r->id] + $pencapaian_skill_3[$r->id] + $pencapaian_skill_4[$r->id] +
											$pencapaian_skill_5[$r->id] + $pencapaian_skill_6[$r->id] + $pencapaian_skill_7[$r->id] + $pencapaian_skill_8[$r->id]  + $pencapaian_skill_9[$r->id] +
											$pencapaian_skill_10[$r->id] + $pencapaian_skill_11[$r->id];
										$pt = $pencapaian_skill_total;
										$tot = array_sum($pt) / 2;
										$pencapaian_kategory = $tot / 61 * 100;

										$total_plus = $a + $a2 + $a3 + $a4 + $a5 + $a6 + $a7 + $a8 + $a9 + $a10 + $a11;
										$total_minus = 11 * count($report_qms) - $total_plus;
										$total_all = $total_plus + $total_minus;
										$ketidaktercapaian = 61  - $total_all;
									}
									?>
									<tr>
										<th style="background-color: orange; color: white;" align="center" rowspan=12>Validation</th>
										<th style="text-align:left;">Alamat Pelanggan</th>
										<th style="text-align:left;">bussiness critical error</th>
										<th style="text-align:left;">2%</th>
										<?php

										echo "<td align='center'>" . $a . "</td>";
										echo "<td align='center'>" . $b . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian) . "%</td>";


										echo "<td align='center' rowspan=11>" . round($pencapaian_kategory) . "%</td>";
										echo "<td align='center' rowspan=11> </td>";

										?>

									</tr>
									<tr>
										<th style="text-align:left;">Kecepatan</th>
										<th style="text-align:left;">bussiness critical error</th>
										<th style="text-align:left;">2%</th>
										<?php

										echo "<td align='center'>" . $a2 . "</td>";
										echo "<td align='center'>" . $b2 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian2) . "%</td>";
										?>
									</tr>
									<tr>
										<th style="text-align:left;">Tagihan</th>
										<th style="text-align:left;">bussiness critical error</th>
										<th style="text-align:left;">2%</th>
										<?php

										echo "<td align='center'>" . $a3 . "</td>";
										echo "<td align='center'>" . $b3 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian3) . "%</td>";
										?>
									</tr>
									<tr>
										<th style="text-align:left;">Tahun Pemasangan</th>
										<th style="text-align:left;">bussiness critical error</th>
										<th style="text-align:left;">2%</th>
										<?php

										echo "<td align='center'>" . $a4 . "</td>";
										echo "<td align='center'>" . $b4 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian4) . "%</td>";
										?>
									</tr>
									<tr>
										<th style="text-align:left;">Tempat Bayar</th>
										<th style="text-align:left;">bussiness critical error</th>
										<th style="text-align:left;">2%</th>
										<?php

										echo "<td align='center'>" . $a5 . "</td>";
										echo "<td align='center'>" . $b5 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian5) . "%</td>";
										?>
									</tr>
									<tr>
										<th style="text-align:left;">Salah menyebutkan Nomer INET / PSTN pelanggan atau tidak konfirmasi nomer INET/PSTN pelanggan</th>
										<th style="text-align:left;">bussiness critical error</th>
										<th style="text-align:left;">5%</th>
										<?php

										echo "<td align='center'>" . $a6 . "</td>";
										echo "<td align='center'>" . $b6 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian6) . "%</td>";
										?>
									</tr>
									<tr>
										<th style="text-align:left;">Nama Pelanggan Salah</th>
										<th style="text-align:left;">bussiness critical error</th>
										<th style="text-align:left;">3%</th>
										<?php

										echo "<td align='center'>" . $a7 . "</td>";
										echo "<td align='center'>" . $b7 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian7) . "%</td>";
										?>
									</tr>
									<tr>
										<th style="text-align:left;">Decision Maker</th>
										<th style="text-align:left;">bussiness critical error</th>
										<th style="text-align:left;">20%</th>
										<?php

										echo "<td align='center'>" . $a8 . "</td>";
										echo "<td align='center'>" . $b8 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian8) . "%</td>";
										?>
									</tr>
									<tr>
										<th style="text-align:left;">Verifikasi HP</th>
										<th style="text-align:left;">bussiness critical error</th>
										<th style="text-align:left;">10%</th>
										<?php

										echo "<td align='center'>" . $a9 . "</td>";
										echo "<td align='center'>" . $b9 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian9) . "%</td>";
										?>
									</tr>
									<tr>
										<th style="text-align:left;">Verifikasi Email</th>
										<th style="text-align:left;">bussiness critical error</th>
										<th style="text-align:left;">10%</th>
										<?php

										echo "<td align='center'>" . $a10 . "</td>";
										echo "<td align='center'>" . $b10 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian10) . "%</td>";
										?>
									</tr>
									<tr>
										<th style="text-align:left;">Kode Verifikasi</th>
										<th style="text-align:left;">compliance critical error</th>
										<th style="text-align:left;">3%</th>
										<?php

										echo "<td align='center'>" . $a11 . "</td>";
										echo "<td align='center'>" . $b11 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian11) . "%</td>";
										?>
									</tr>
									<tr style="background-color: red; color: white;" align="center">

										<th nowrap colspan=2><b>Subtotal</b></th>
										<th style="text-align:left;">61%</th>
										<?php

										echo "<td align='center'>" . $total_plus . "</td>";
										echo "<td align='center'>" . $total_minus . "</td>";
										echo "<td align='center'>" . $total_all . "</td>";
										echo "<td align='center'>" . $pencapaian_total . "%</td>";
										echo "<td align='center'></td>";
										echo "<td align='center'>" . $ketidaktercapaian . "%</td>";
										?>
									</tr>
									<?php
									foreach ($report_qms as $r) {
										$documentation_1[$r->id] = $r->documentation_1;
										$y = $documentation_1[$r->id];
										$jml_skill_1 = $sum += $y;
										$a = $jml_skill_1 * 1;
										$b = $jml_skill_1 * 0;
										$total = $a + $b;
										$pencapaian = (4 * $total) / count($report_qms);

										$documentation_2[$r->id] = $r->documentation_2;
										$y2 = $documentation_2[$r->id];
										$jml_skill_2 = $sum2 += $y2;
										$a2 = $jml_skill_2 * 1;
										$b2 = $jml_skill_2 * 0;
										$total2 = $a2 + $b2;
										$pencapaian2 = (3 * $total2) / count($report_qms);

										$documentation_3[$r->id] = $r->documentation_3;
										$y3 = $documentation_3[$r->id];
										$jml_skill_3 = $sum3 += $y3;
										$a3 = $jml_skill_3 * 1;
										$b3 = $jml_skill_3 * 0;
										$total3 = $a3 + $b3;
										$pencapaian3 = (3 * $total3) / count($report_qms);

										$pencapaian_skill_1[$r->id] = 4 * $r->documentation_1;
										$pencapaian_skill_2[$r->id] = 3 * $r->documentation_2;
										$pencapaian_skill_3[$r->id] = 3 * $r->documentation_3;
										$pencapaian_skill_total[$r->id] = $pencapaian_skill_1[$r->id] + $pencapaian_skill_2[$r->id] + $pencapaian_skill_3[$r->id];
										$pt = $pencapaian_skill_total;
										$tot = array_sum($pt) / 2;
										$pencapaian_kategory = $tot / 10 * 100;

										$total_plus = $a + $a2 + $a3;
										$total_minus = 3 * count($report_qms) - $total_plus;
										$total_all = $total_plus + $total_minus;
										$ketidaktercapaian = 10  - $total_all;
									}

									?>
									</tr>
									<tr>
										<th style="background-color: blue; color: white;" align="center" rowspan=4>Documentation</th>
										<th style="text-align:left;">Dapat memberikan informasi tujuan Profiling</th>
										<th style="text-align:left;">compliance critical error</th>
										<th style="text-align:left;">4%</th>
										<?php
										echo "<td align='center'>" . $a . "</td>";
										echo "<td align='center'>" . $b . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian) . "%</td>";


										echo "<td align='center' rowspan=3>" . round($pencapaian_kategory) . "%</td>";
										echo "<td align='center' rowspan=3> </td>";
										?>
									</tr>
									<tr>
										<th style="text-align:left;">Melakukan dokumentasi pada aplikasi terkait</th>
										<th style="text-align:left;">compliance critical error</th>
										<th style="text-align:left;">3%</th>
										<?php

										echo "<td align='center'>" . $a2 . "</td>";
										echo "<td align='center'>" . $b2 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian2) . "%</td>";

										?>
									</tr>
									<tr>
										<th style="text-align:left;">Menanyakan opsi channel kepada pelanggan</th>
										<th style="text-align:left;">compliance critical error</th>
										<th style="text-align:left;">3%</th>
										<?php

										echo "<td align='center'>" . $a3 . "</td>";
										echo "<td align='center'>" . $b3 . "</td>";
										echo "<td align='center'>" . count($report_qms) . "</td>";
										echo "<td align='center'>" . round($pencapaian3) . "%</td>";
										?>
									</tr>
									<tr style="background-color: red; color: white;" align="center">

										<th nowrap colspan=2><b>Subtotal</b></th>
										<th style="text-align:left;">10%</th>
										<?php

										echo "<td align='center'>" . $total_plus . "</td>";
										echo "<td align='center'>" . $total_minus . "</td>";
										echo "<td align='center'>" . $total_all . "</td>";
										echo "<td align='center'>" . $pencapaian_total . "%</td>";
										echo "<td align='center'></td>";
										echo "<td align='center'>" . $ketidaktercapaian . "%</td>";
										?>
									</tr>
									<?php
								} else {
									foreach ($report_qms as $r) {
									?>
										<tr>
											<th style="background-color: green; color: white;" align="center" rowspan=9>Phone and Communication Skill</th>
											<th style="text-align:left;">Salam pembuka</th>
											<th style="text-align:left;">compliance critical error</th>
											<th style="text-align:left;">3%</th>
											<?php
											if ($r->skill_communication_1 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											$pencapaian_1 = (3 * $r->skill_communication_1);
											$pencapaian_2 = (3 * $r->skill_communication_2);
											$pencapaian_3 = (3 * $r->skill_communication_3);
											$pencapaian_4 = (3 * $r->skill_communication_4);
											$pencapaian_5 = (2 * $r->skill_communication_5);
											$pencapaian_6 = (10 * $r->skill_communication_6);
											$pencapaian_7 = (3 * $r->skill_communication_7);
											$pencapaian_8 = (2 * $r->skill_communication_8);
											$pencapaian_total = $pencapaian_1 + $pencapaian_2 + $pencapaian_3 + $pencapaian_4 +
												$pencapaian_5 + $pencapaian_6 + $pencapaian_7 + $pencapaian_8;
											$pencapaian_kategory = $pencapaian_total / 29 * 100;
											echo "<td align='center' rowspan=8>" . round($pencapaian_kategory) . "%</td>";
											echo "<td align='center' rowspan=8> </td>";

											?>

										</tr>
										<tr>
											<th style="text-align:left;">Salam Penutup</th>
											<th style="text-align:left;">compliance critical error</th>
											<th style="text-align:left;">3%</th>
											<?php

											if ($r->skill_communication_2 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>

										</tr>
										<tr>
											<th style="text-align:left;">Mengucapkan nama pelanggan minimal 3 kali (awal, tengah & akhir) selama percakapan</th>
											<th style="text-align:left;">compliance critical error</th>
											<th style="text-align:left;">3%</th>
											<?php
											if ($r->skill_communication_3 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>

										</tr>
										<tr>
											<th style="text-align:left;">Menyampaikan informasi/pertanyaan dengan jelas, lengkap dan sistematis (tidak berbelit-belit)</th>
											<th style="text-align:left;">customer critical error</th>
											<th style="text-align:left;">3%</th>
											<?php

											if ($r->skill_communication_4 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>

										</tr>
										<tr>
											<th style="text-align:left;">Menggunakan bahasa Indonesia/inggris dengan baik & benar, serta sopan</th>
											<th style="text-align:left;">customer critical error</th>
											<th style="text-align:left;">2%</th>
											<?php

											if ($r->skill_communication_5 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (2 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (2 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>

										</tr>
										<tr>
											<th style="text-align:left;">Intonasi & artikulasi</th>
											<th style="text-align:left;">compliance critical error</th>
											<th style="text-align:left;">10%</th>
											<?php

											if ($r->skill_communication_6 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (10 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (10 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>

										<tr>
											<th style="text-align:left;">Memberikan perhatian kepada pelanggan secara aktif dan berempati</th>
											<th style="text-align:left;">customer critical error</th>
											<th style="text-align:left;">3%</th>
											<?php

											if ($r->skill_communication_7 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>

										</tr>
										<tr>
											<th style="text-align:left;">Agent menanyakan kabar pelanggan/kondisi inet pelanggan</th>
											<th style="text-align:left;">customer critical error</th>
											<th style="text-align:left;">2%</th>
											<?php

											if ($r->skill_communication_8 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (2 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (2 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>

										</tr>
										<tr style="background-color: red; color: white;" align="center">

											<th nowrap colspan=2><b>Subtotal</b></th>
											<th style="text-align:left;">29%</th>
											<?php
											$total_plus = $r->skill_communication_1 + $r->skill_communication_2 + $r->skill_communication_3 +
												$r->skill_communication_4 + $r->skill_communication_5 + $r->skill_communication_6 +
												$r->skill_communication_7 + $r->skill_communication_8;
											$total_minus = 8 - $total_plus;
											$total_all = $total_plus + $total_minus;
											$pencapaian_1 = (3 * $r->skill_communication_1);
											$pencapaian_2 = (3 * $r->skill_communication_2);
											$pencapaian_3 = (3 * $r->skill_communication_3);
											$pencapaian_4 = (3 * $r->skill_communication_4);
											$pencapaian_5 = (2 * $r->skill_communication_5);
											$pencapaian_6 = (10 * $r->skill_communication_6);
											$pencapaian_7 = (3 * $r->skill_communication_7);
											$pencapaian_8 = (2 * $r->skill_communication_8);
											$pencapaian_total = $pencapaian_1 + $pencapaian_2 + $pencapaian_3 + $pencapaian_4 +
												$pencapaian_5 + $pencapaian_6 + $pencapaian_7 + $pencapaian_8;
											$ketidaktercapaian = 29 - $pencapaian_total;
											echo "<td align='center'>" . $total_plus . "</td>";
											echo "<td align='center'>" . $total_minus . "</td>";
											echo "<td align='center'>" . $total_all . "</td>";
											echo "<td align='center'>" . $pencapaian_total . "%</td>";
											echo "<td align='center'></td>";
											echo "<td align='center'>" . $ketidaktercapaian . "%</td>";
											?>

										</tr>
										<tr>
											<th style="background-color: orange; color: white;" align="center" rowspan=12>Validation</th>
											<th style="text-align:left;">Alamat Pelanggan</th>
											<th style="text-align:left;">bussiness critical error</th>
											<th style="text-align:left;">2%</th>
											<?php

											if ($r->validation_1 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											$pencapaian_1 = (2 * $r->validation_1);
											$pencapaian_2 = (2 * $r->validation_2);
											$pencapaian_3 = (2 * $r->validation_3);
											$pencapaian_4 = (2 * $r->validation_4);
											$pencapaian_5 = (2 * $r->validation_5);
											$pencapaian_6 = (5 * $r->validation_6);
											$pencapaian_7 = (3 * $r->validation_7);
											$pencapaian_8 = (20 * $r->validation_8);
											$pencapaian_9 = (10 * $r->validation_9);
											$pencapaian_10 = (10 * $r->validation_10);
											$pencapaian_11 = (3 * $r->validation_11);
											$pencapaian_total = $pencapaian_1 + $pencapaian_2 + $pencapaian_3 + $pencapaian_4 +
												$pencapaian_5 + $pencapaian_6 + $pencapaian_7 + $pencapaian_8 +
												$pencapaian_9 + $pencapaian_10 + $pencapaian_11;
											$pencapaian_kategory = $pencapaian_total / 61 * 100;
											echo "<td align='center' rowspan=11>" . round($pencapaian_kategory) . "%</td>";
											echo "<td align='center' rowspan=11> </td>";

											?>

										</tr>
										<tr>
											<th style="text-align:left;">Kecepatan</th>
											<th style="text-align:left;">bussiness critical error</th>
											<th style="text-align:left;">2%</th>
											<?php

											if ($r->validation_2 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (2 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (2 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>
										</tr>
										<tr>
											<th style="text-align:left;">Tagihan</th>
											<th style="text-align:left;">bussiness critical error</th>
											<th style="text-align:left;">2%</th>
											<?php

											if ($r->validation_3 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (2 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (2 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>
										</tr>
										<tr>
											<th style="text-align:left;">Tahun Pemasangan</th>
											<th style="text-align:left;">bussiness critical error</th>
											<th style="text-align:left;">2%</th>
											<?php

											if ($r->validation_4 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (2 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (2 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>
										</tr>
										<tr>
											<th style="text-align:left;">Tempat Bayar</th>
											<th style="text-align:left;">bussiness critical error</th>
											<th style="text-align:left;">2%</th>
											<?php

											if ($r->validation_5 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (2 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (2 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>
										</tr>
										<tr>
											<th style="text-align:left;">Salah menyebutkan Nomer INET / PSTN pelanggan atau tidak konfirmasi nomer INET/PSTN pelanggan</th>
											<th style="text-align:left;">bussiness critical error</th>
											<th style="text-align:left;">5%</th>
											<?php

											if ($r->validation_6 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (5 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (5 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>
										</tr>
										<tr>
											<th style="text-align:left;">Nama Pelanggan Salah</th>
											<th style="text-align:left;">bussiness critical error</th>
											<th style="text-align:left;">3%</th>
											<?php

											if ($r->validation_7 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>
										</tr>
										<tr>
											<th style="text-align:left;">Decision Maker</th>
											<th style="text-align:left;">bussiness critical error</th>
											<th style="text-align:left;">20%</th>
											<?php

											if ($r->validation_8 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (20 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (20 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>
										</tr>
										<tr>
											<th style="text-align:left;">Verifikasi HP</th>
											<th style="text-align:left;">bussiness critical error</th>
											<th style="text-align:left;">10%</th>
											<?php

											if ($r->validation_9 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (10 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (10 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>
										</tr>
										<tr>
											<th style="text-align:left;">Verifikasi Email</th>
											<th style="text-align:left;">bussiness critical error</th>
											<th style="text-align:left;">10%</th>
											<?php

											if ($r->validation_10 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (10 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (10 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>
										</tr>
										<tr>
											<th style="text-align:left;">Kode Verifikasi</th>
											<th style="text-align:left;">compliance critical error</th>
											<th style="text-align:left;">3%</th>
											<?php

											if ($r->validation_11 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>
										</tr>
										<tr style="background-color: red; color: white;" align="center">

											<th nowrap colspan=2><b>Subtotal</b></th>
											<th style="text-align:left;">61%</th>
											<?php
											$total_plus = $r->validation_1 + $r->validation_2 + $r->validation_3 + $r->validation_4 +
												$r->validation_5 + $r->validation_6 + $r->validation_7 + $r->validation_8 +
												$r->validation_9 + $r->validation_10 + $r->validation_11;
											$total_minus = 11 - $total_plus;
											$total_all = $total_plus + $total_minus;
											$pencapaian_1 = (2 * $r->validation_1);
											$pencapaian_2 = (2 * $r->validation_2);
											$pencapaian_3 = (2 * $r->validation_3);
											$pencapaian_4 = (2 * $r->validation_4);
											$pencapaian_5 = (2 * $r->validation_5);
											$pencapaian_6 = (5 * $r->validation_6);
											$pencapaian_7 = (3 * $r->validation_7);
											$pencapaian_8 = (20 * $r->validation_8);
											$pencapaian_9 = (10 * $r->validation_9);
											$pencapaian_10 = (10 * $r->validation_10);
											$pencapaian_11 = (3 * $r->validation_11);
											$pencapaian_total = $pencapaian_1 + $pencapaian_2 + $pencapaian_3 + $pencapaian_4 +
												$pencapaian_5 + $pencapaian_6 + $pencapaian_7 + $pencapaian_8 +
												$pencapaian_9 + $pencapaian_10 + $pencapaian_11;
											$pencapaian_kategory = $pencapaian_total / 61 * 100;
											$ketidaktercapaian = 61 - $pencapaian_total;
											echo "<td align='center'>" . $total_plus . "</td>";
											echo "<td align='center'>" . $total_minus . "</td>";
											echo "<td align='center'>" . $total_all . "</td>";
											echo "<td align='center'>" . $pencapaian_total . "%</td>";
											echo "<td align='center'></td>";
											echo "<td align='center'>" . $ketidaktercapaian . "%</td>";
											?>
										</tr>
										<tr>
											<th style="background-color: blue; color: white;" align="center" rowspan=4>Documentation</th>
											<th style="text-align:left;">Dapat memberikan informasi tujuan Profiling</th>
											<th style="text-align:left;">compliance critical error</th>
											<th style="text-align:left;">4%</th>
											<?php
											if ($r->documentation_1 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (4 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (4 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											$pencapaian_1 = (4 * $r->skill_communication_1);
											$pencapaian_2 = (3 * $r->skill_communication_2);
											$pencapaian_3 = (3 * $r->skill_communication_3);
											$pencapaian_total = $pencapaian_1 + $pencapaian_2 + $pencapaian_3;
											$pencapaian_kategory = $pencapaian_total / 10 * 100;
											echo "<td align='center' rowspan=3>" . round($pencapaian_kategory) . "%</td>";
											echo "<td align='center' rowspan=3> </td>";

											?>
										</tr>
										<tr>
											<th style="text-align:left;">Melakukan dokumentasi pada aplikasi terkait</th>
											<th style="text-align:left;">compliance critical error</th>
											<th style="text-align:left;">3%</th>
											<?php

											if ($r->documentation_2 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>
										</tr>
										<tr>
											<th style="text-align:left;">Menanyakan opsi channel kepada pelanggan</th>
											<th style="text-align:left;">compliance critical error</th>
											<th style="text-align:left;">3%</th>
											<?php

											if ($r->documentation_3 == 0) {
												$a = 1;
												$b = 0;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>0</td>";
												echo "<td align='center'>1</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											} else {

												$a = 0;
												$b = 1;
												$total = $a + $b;
												$pencapaian = (3 * $b) / $total;
												echo "<td align='center'>1</td>";
												echo "<td align='center'>0</td>";
												echo "<td align='center'>" . $total . "</td>";
												echo "<td align='center'>" . $pencapaian . "%</td>";
											}
											?>
										</tr>
										<tr style="background-color: red; color: white;" align="center">

											<th nowrap colspan=2><b>Subtotal</b></th>
											<th style="text-align:left;">10%</th>
											<?php
											$total_plus = $r->documentation_1 + $r->documentation_2 + $r->documentation_3;
											$total_minus = 3 - $total_plus;
											$total_all = $total_plus + $total_minus;
											$pencapaian_1 = (4 * $r->documentation_1);
											$pencapaian_2 = (3 * $r->documentation_2);
											$pencapaian_3 = (3 * $r->documentation_3);
											$pencapaian_total = $pencapaian_1 + $pencapaian_2 + $pencapaian_3;
											$pencapaian_kategory = $pencapaian_total / 10 * 100;
											$ketidaktercapaian = 10 - $pencapaian_total;
											echo "<td align='center'>" . $total_plus . "</td>";
											echo "<td align='center'>" . $total_minus . "</td>";
											echo "<td align='center'>" . $total_all . "</td>";
											echo "<td align='center'>" . $pencapaian_total . "%</td>";
											echo "<td align='center'></td>";
											echo "<td align='center'>" . $ketidaktercapaian . "%</td>";
											?>
										</tr>
										<tr>
											<th colspan="3" style="text-align:center;">GRAND TOTAL</th>
											<th style="text-align:left;">100%</th>
										<?php
										$total_plus_all =  	$r->skill_communication_1 + $r->skill_communication_2 + $r->skill_communication_3 +
											$r->skill_communication_4 + $r->skill_communication_5 + $r->skill_communication_6 + $r->skill_communication_7 +
											$r->skill_communication_8 + $r->validation_1 + $r->validation_2 + $r->validation_3 + $r->validation_4 +
											$r->validation_5 + $r->validation_6 + $r->validation_7 + $r->validation_8 + $r->validation_9 + $r->validation_10 +
											$r->validation_11 + $r->documentation_1 + $r->documentation_2 + $r->documentation_3;
										$total_minus_all = 22 - $total_plus_all;
										$total_plus_minus = $total_plus_all + $total_minus_all;
										$pencapaian_1 = (3 * $r->skill_communication_1);
										$pencapaian_2 = (3 * $r->skill_communication_2);
										$pencapaian_3 = (3 * $r->skill_communication_3);
										$pencapaian_4 = (3 * $r->skill_communication_4);
										$pencapaian_5 = (2 * $r->skill_communication_5);
										$pencapaian_6 = (10 * $r->skill_communication_6);
										$pencapaian_7 = (3 * $r->skill_communication_7);
										$pencapaian_8 = (2 * $r->skill_communication_8);
										$pencapaian_9 = (2 * $r->validation_1);
										$pencapaian_10 = (2 * $r->validation_2);
										$pencapaian_11 = (2 * $r->validation_3);
										$pencapaian_12 = (2 * $r->validation_4);
										$pencapaian_13 = (2 * $r->validation_5);
										$pencapaian_14 = (5 * $r->validation_6);
										$pencapaian_15 = (3 * $r->validation_7);
										$pencapaian_16 = (20 * $r->validation_8);
										$pencapaian_17 = (10 * $r->validation_9);
										$pencapaian_18 = (10 * $r->validation_10);
										$pencapaian_19 = (3 * $r->validation_11);
										$pencapaian_20 = (4 * $r->documentation_1);
										$pencapaian_21 = (3 * $r->documentation_2);
										$pencapaian_22 = (3 * $r->documentation_3);
										$pencapaian_total_all = $pencapaian_1 + $pencapaian_2 + $pencapaian_3 + $pencapaian_4 + $pencapaian_5 + $pencapaian_6 +
											$pencapaian_7 + $pencapaian_8 + $pencapaian_9 + $pencapaian_10 + $pencapaian_11 + $pencapaian_12 + $pencapaian_13 +
											$pencapaian_14 + $pencapaian_15 + $pencapaian_16 + $pencapaian_17 + $pencapaian_18 + $pencapaian_19 + $pencapaian_20 +
											$pencapaian_21 + $pencapaian_22;
										$pencapaian_bobot = $pencapaian_total_all / 100 * 100;
										$ketidaktercapaian =  100 - $pencapaian_bobot;
										echo "<td align='center'>" . $total_plus_all . "</td>";
										echo "<td align='center'>" . $total_minus_all . "</td>";
										echo "<td align='center'>" . $total_plus_minus . "</td>";
										echo "<td align='center'>" . $pencapaian_total_all . "%</td>";
										echo "<td align='center'>" . round($pencapaian_bobot) . "%</td>";
										echo "<td align='center'>" . $ketidaktercapaian . "%</td>";
									}

										?>
									<?php
								}
									?>
										</tr>
							</tfoot>
						</table>
					</small>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-lte">
			<div class="panel-heading lte-heading-success">Kategori AHT</div>
			<div class="panel-body">
				<table width="100%" border=1>
					<tr align="center" style="background-color: red; color: white;">
						<td rowspan=9>AHT >3 menit</td>
						<td>KATEGORI</td>
						<td>JUMLAH</td>
					</tr>
					<?php
					if (count($_GET['agentid']) > 1) {
						foreach ($report_qms as $r) {

							$aht_1[$r->id] = $r->aht_1;
							$y = $aht_1[$r->id];
							$jml1 = $sum += $y;

							$aht_2[$r->id] = $r->aht_2;
							$y2 = $aht_2[$r->id];
							$jml2 = $sum1 += $y2;

							$aht_3[$r->id] = $r->aht_3;
							$y3 = $aht_3[$r->id];
							$jml3 = $sum3 += $y3;

							$aht_4[$r->id] = $r->aht_4;
							$y4 = $aht_4[$r->id];
							$jml4 = $sum4 += $y4;

							$aht_5[$r->id] = $r->aht_5;
							$y5 = $aht_5[$r->id];
							$jml5 = $sum5 += $y5;

							$aht_6[$r->id] = $r->aht_6;
							$y6 = $aht_6[$r->id];
							$jml6 = $sum6 += $y6;

							$aht_7[$r->id] = $r->aht_7;
							$y7 = $aht_7[$r->id];
							$jml7 = $sum7 += $y7;

							$aht_8[$r->id] = $r->aht_8;
							$y8 = $aht_8[$r->id];
							$jml8 = $sum8 += $y8;
						}


					?>
						<tr align="center">
							<td>Agent melakukan carring</td>
							<td><?php echo $jml1;
								?></td>
						</tr>
						<tr align="center">
							<td>Pelanggan Ragu - Ragu</td>
							<td><?php echo $jml2; ?></td>
						</tr>
						<tr align="center">
							<td>Pelanggan meminta menunggu</td>
							<td><?php echo $jml3; ?></td>
						</tr>
						<tr align="center">
							<td>Pertanyaan agent berbelit- belit</td>
							<td><?php echo $jml4; ?></td>
						</tr>
						<tr align="center">
							<td>Tidak langsung bertemu DM</td>
							<td><?php echo $jml5; ?></td>
						</tr>
						<tr align="center">
							<td>Spelling</td>
							<td><?php echo $jml6; ?></td>
						</tr>
						<tr align="center">
							<td>Keluhan pelanggan</td>
							<td><?php echo $jml7; ?></td>
						</tr>
						<tr align="center">
							<td>Tanya Promo/Produk</td>
							<td><?php echo $jml8; ?></td>
						</tr>
						<?php
					} else {
						foreach ($report_qms as $r) {
						?>
							<tr align="center">
								<td>Agent melakukan carring</td>
								<td><?php echo $r->aht_1; ?></td>
							</tr>
							<tr align="center">
								<td>Pelanggan Ragu - Ragu</td>
								<td><?php echo $r->aht_2; ?></td>
							</tr>
							<tr align="center">
								<td>Pelanggan meminta menunggu</td>
								<td><?php echo $r->aht_3; ?></td>
							</tr>
							<tr align="center">
								<td>Pertanyaan agent berbelit- belit</td>
								<td><?php echo $r->aht_4; ?></td>
							</tr>
							<tr align="center">
								<td>Tidak langsung bertemu DM</td>
								<td><?php echo $r->aht_5; ?></td>
							</tr>
							<tr align="center">
								<td>Spelling</td>
								<td><?php echo $r->aht_6; ?></td>
							</tr>
							<tr align="center">
								<td>Keluhan pelanggan</td>
								<td><?php echo $r->aht_7; ?></td>
							</tr>
							<tr align="center">
								<td>Tanya Promo/Produk</td>
								<td><?php echo $r->aht_8; ?></td>
							</tr>
					<?php
						}
					}
					?>
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel panel-lte">
			<div class="panel-heading lte-heading-success">Quality Monitoring Score Monthly</div>
			<div class="panel-body">
				<table width="100%" border=1>
					<tr align="center" style="background-color: red; color: white;">
						<td>No</td>
						<td>Kategori COPC</td>
						<td>Jumlah NC</td>
						<td>%Pencapaian</td>
					</tr>
					<?php
					if (count($_GET['agentid']) > 1) {
					?>
						<tr align="center">
							<td>1</td>
							<td>compliance critical error</td>
							<td>
								<?php

								foreach ($report_qms as $r) {
									$total_compliance[$r->id] = $r->skill_communication_1 + $r->skill_communication_2 + $r->skill_communication_3 + $r->skill_communication_4 +
										$r->skill_communication_6 + $r->validation_11 + $r->documentation_1 + $r->documentation_2 + $r->documentation_3;
									$total_bussiness[$r->id] = $r->validation_1 + $r->validation_2 + $r->validation_3 + $r->validation_4 + $r->validation_5 +
										$r->validation_6 + $r->validation_7 + $r->validation_8 + $r->validation_9 + $r->validation_10;
									$total_customer[$r->id] = $r->skill_communication_5 + $r->skill_communication_7 + $r->skill_communication_8;


									$persentase_all = $persentase_ompliance + $persentase_bussiness + $persentase_customer;
								}
								$y = array_sum($total_compliance);
								$x = 9 * count($report_qms);
								$total_compliance_all = $x - $y;

								$yBussiness = array_sum($total_bussiness);
								$xBussiness = 10 * count($report_qms);
								$total_bussiness_all = $xBussiness - $yBussiness;

								$yCustomer = array_sum($total_customer);
								$xCustomer = 3 * count($report_qms);
								$total_customer_all = $xCustomer - $yCustomer;

								$total_semua = $total_compliance_all +  $total_bussiness_all + $total_customer_all;

								echo $total_compliance_all;

								?>
							</td>
							<td><?php

								$persentase_ompliance = ($total_compliance_all / $total_semua) * 100;
								echo round($persentase_ompliance);
								?>%</td>

						</tr>
						<tr align="center">
							<td>2</td>
							<td>bussiness critical error</td>
							<td>
								<?php
								echo $total_bussiness_all;

								?>
							</td>
							<td><?php
								$total_bussiness = ($total_bussiness_all / $total_semua) * 100;
								echo round($total_bussiness);
								?>%</td>

						</tr>
						<tr align="center">
							<td>3</td>
							<td>customer critical error</td>
							<td><?php

								echo $total_customer_all;

								?></td>
							<td><?php
								$total_customer = ($total_customer_all / $total_semua) * 100;
								echo round($total_customer);
								?>%</td>

						</tr>
						<tr align="center">
							<td colspan="2" align="right">Total</td>
							<td><?php
								echo $total_semua ?></td>
							<td><?php
								$persentase_all = $persentase_ompliance + $total_bussiness + $total_customer;
								echo round($persentase_all);

								?>%</td>

						</tr>
					<?php
					} else {
					?>
						<tr align="center">
							<td>1</td>
							<td>compliance critical error</td>
							<td>
								<?php
								foreach ($report_qms as $r) {
									$total_compliance = $r->skill_communication_1 + $r->skill_communication_2 + $r->skill_communication_3 + $r->skill_communication_4 +
										$r->skill_communication_6 + $r->validation_11 + $r->documentation_1 + $r->documentation_2 + $r->documentation_3;
									$total_compliance_all = 9 - $total_compliance;
									$total_bussiness = $r->validation_1 + $r->validation_2 + $r->validation_3 + $r->validation_4 + $r->validation_5 +
										$r->validation_6 + $r->validation_7 + $r->validation_8 + $r->validation_9 + $r->validation_10;
									$total_bussiness_all = 10 - $total_bussiness;
									$total_customer = $r->skill_communication_5 + $r->skill_communication_7 + $r->skill_communication_8;
									$total_customer_all = 3 - $total_customer;
									$total_all = $r->skill_communication_1 + $r->skill_communication_2 + $r->skill_communication_3 +
										$r->skill_communication_4 + $r->skill_communication_5 + $r->skill_communication_6 + $r->skill_communication_7 +
										$r->skill_communication_8 + $r->validation_1 + $r->validation_2 + $r->validation_3 + $r->validation_4 +
										$r->validation_5 + $r->validation_6 + $r->validation_7 + $r->validation_8 + $r->validation_9 + $r->validation_10 +
										$r->validation_11 + $r->documentation_1 + $r->documentation_2 + $r->documentation_3;
									$total = 22 - $total_all;
									$persentase_ompliance = ($total_compliance_all / $total) * 100;
									$persentase_bussiness = ($total_bussiness_all / $total) * 100;
									$persentase_customer = ($total_customer_all / $total) * 100;
									$persentase_all = $persentase_ompliance + $persentase_bussiness + $persentase_customer;
									echo $total_compliance_all;

								?>
							</td>
							<td><?php
									echo $persentase_ompliance;
								?>%</td>

						</tr>
						<tr align="center">
							<td>2</td>
							<td>bussiness critical error</td>
							<td>
								<?php

									echo $total_bussiness_all;

								?>
							</td>
							<td><?php
									echo $persentase_bussiness;
								?>%</td>

						</tr>
						<tr align="center">
							<td>3</td>
							<td>customer critical error</td>
							<td><?php

									echo $total_customer_all;

								?></td>
							<td><?php
									echo $persentase_customer;
								?>%</td>

						</tr>
						<tr align="center">
							<td colspan="2" align="right">Total</td>
							<td><?php


									echo $total ?></td>
							<td><?php
									echo $persentase_all;
								}
								?>%</td>

						</tr>
					<?php
					}
					?>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="panel panel-lte">
			<div class="panel-heading lte-heading-success">Bar Chart AHT</div>
			<div class="panel-body">
				<?php

				if (count($_GET['agentid']) > 1) {
					echo "<canvas id='barChart2' style='height:230px; min-height:230px'></canvas>";
				} else {
					echo "<canvas id='barChart' style='height:230px; min-height:230px'></canvas>";
				}
				?>

			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="panel panel-lte">
			<div class="panel-heading lte-heading-success">Bar Chart QM Score </div>
			<div class="panel-body">
				<canvas id="qmsChart" style="height:230px; min-height:230px"></canvas>
			</div>
		</div>
	</div>

	<div class='col-md-12 col-xl-12'>
		<div class="card">
			<div class="card-status bg-orange"></div>
			<div class="card-header">
				<h3 class="card-title">Report

				</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div class='box-body table-responsive' id='box-table'>
					<small>
						<table class='table' id="report_table_reg">
							<thead>
								<tr>
									<th nowrap>#</th>
									<th align="center">Nama QC</th>
									<th align="center">Nama Agent</th>
									<th align="center">Tanggal Tapping</th>
									<th align="center">Tanggal Respon Limit</th>
									<th align="center">Dial to Notel/HP</th>
									<th align="center">Salam pembuka</th>
									<th align="center">Salam penutup</th>
									<th align="center">Mengucapkan nama pelanggan minimal 3 kali (awal, tengah & akhir) selama percakapan.</th>
									<th align="center">Menyampaikan informasi/pertanyaan dengan jelas, lengkap dan sistematis (tidak berbelit-belit)</th>
									<th align="center">Menggunakan bahasa Indonesia/inggris dengan baik & benar, serta sopan</th>
									<th align="center">Intonasi & artikulasi</th>
									<th align="center">Memberikan perhatian kepada pelanggan secara aktif dan berempati</th>
									<th align="center">Agent menanyakan kabar pelanggan/kondisi inet pelanggan</th>
									<th align="center">Alamat Pelanggan</th>
									<th align="center">Kecepatan</th>
									<th align="center">Tagihan</th>
									<th align="center">Tahun Pemasangan</th>
									<th align="center">Tempat Bayar</th>
									<th align="center">Salah menyebutkan Nomer INET / PSTN pelanggan atau tidak konfirmasi nomer INET/PSTN pelanggan</th>
									<th align="center">Nama Pelanggan Salah</th>
									<th align="center">Decision Maker</th>
									<th align="center">Verifikasi HP</th>
									<th align="center">Verifikasi Email</th>
									<th align="center">Kode Verifikasi</th>
									<th align="center">Dapat memberikan informasi tujuan Profiling</th>
									<th align="center">Melakukan dokumentasi pada aplikasi terkait</th>
									<th align="center">Menanyakan opsi channel kepada pelanggan</th>
									<th align="center">Keterangan</th>
									<th align="center">Notes</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($report_qms as $r) {

								?>
									<tr>
										<td nowrap><?php echo $n; ?></td>
										<td nowrap><?php echo $r->qc_id; ?></td>
										<td nowrap><?php echo $r->agent_id; ?></td>
										<td nowrap><?php echo $r->tgl_taping; ?></td>
										<td nowrap><?php echo $r->tgl_respon_limit; ?></td>
										<td nowrap><?php echo $r->dial; ?></td>
										<td nowrap><?php echo $r->skill_communication_1; ?></td>
										<td nowrap><?php echo $r->skill_communication_2; ?></td>
										<td nowrap><?php echo $r->skill_communication_3; ?></td>
										<td nowrap><?php echo $r->skill_communication_4; ?></td>
										<td nowrap><?php echo $r->skill_communication_5; ?></td>
										<td nowrap><?php echo $r->skill_communication_6; ?></td>
										<td nowrap><?php echo $r->skill_communication_7; ?></td>
										<td nowrap><?php echo $r->skill_communication_8; ?></td>
										<td nowrap><?php echo $r->validation_1; ?></td>
										<td nowrap><?php echo $r->validation_2; ?></td>
										<td nowrap><?php echo $r->validation_3; ?></td>
										<td nowrap><?php echo $r->validation_4; ?></td>
										<td nowrap><?php echo $r->validation_5; ?></td>
										<td nowrap><?php echo $r->validation_6; ?></td>
										<td nowrap><?php echo $r->validation_7; ?></td>
										<td nowrap><?php echo $r->validation_8; ?></td>
										<td nowrap><?php echo $r->validation_9; ?></td>
										<td nowrap><?php echo $r->validation_10; ?></td>
										<td nowrap><?php echo $r->validation_11; ?></td>
										<td nowrap><?php echo $r->documentation_1; ?></td>
										<td nowrap><?php echo $r->documentation_2; ?></td>
										<td nowrap><?php echo $r->documentation_3; ?></td>
										<td nowrap><?php echo $r->keterangan; ?></td>
										<td nowrap><?php echo $r->note; ?></td>

									</tr>
								<?php
								}
								?>
							</tbody>
						</table>
					</small>
				</div>
			</div>
		</div>
	</div>

<?php
}

?>

<!-- load library selectize -->
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->

<?php echo _js('selectize,chartjs,multiselect,datatables') ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#agentid').selectize({});
		$("#report_table_reg").DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf'
			]
		});
	});
</script>
<script>
	//---bar chart---// 
	$(document).ready(function() {
		
		var barmultiaxisChartData = {
			labels: [
				['Agent', 'Melakukan', 'Caring'],
				['Pelanggan', 'Ragu - Ragu'],
				['Pelanggan', 'meminta', 'menunggu'],
				['Pertanyaan', 'agent', 'berbelit- belit'],
				['Tidak', 'langsung', 'bertemu DM'], 'Spelling',
				['Keluhan', 'pelanggan'],
				['Tanya', 'Promo/Produk']
			],
			datasets: [{
				label: 'AHT > 3 Menit',
				backgroundColor: "blue",
				type: 'bar',
				yAxisID: 'y-axis-1',
				data: [
					<?php
					foreach ($report_qms as $r) {
					?>
						<?php echo  $r->aht_1; ?>, 
						<?php echo  $r->aht_2; ?>, 
						<?php echo  $r->aht_3; ?>, 
						<?php echo  $r->aht_4; ?>, 
						<?php echo  $r->aht_5; ?>,
						<?php echo  $r->aht_6; ?>, 
						<?php echo  $r->aht_7; ?>, 
						<?php echo  $r->aht_8; } ?>
				],

			}, ]

		};

		var chartjs_multiaxis_bar = document.getElementById("barChart");

		if (chartjs_multiaxis_bar) {
			ctx = document.getElementById('barChart').getContext('2d');
			var mixedChart = new Chart(ctx, {
				type: 'bar',
				data: barmultiaxisChartData,
				options: {
					maintainAspectRatio: false,
					scales: {
						yAxes: [{
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'right',
							id: 'y-axis-1',
							ticks: {
								suggestedMin: 0
							}
						}]
					}
				}
			});

		}
	});

	//---bar chart2---// 
	$(document).ready(function() {


		var barmultiaxisChartData = {
			labels: [
				['Agent', 'Melakukan', 'Caring'],
				['Pelanggan', 'Ragu - Ragu'],
				['Pelanggan', 'meminta', 'menunggu'],
				['Pertanyaan', 'agent', 'berbelit- belit'],
				['Tidak', 'langsung', 'bertemu DM'], 'Spelling',
				['Keluhan', 'pelanggan'],
				['Tanya', 'Promo/Produk']
			],
			datasets: [{
				label: 'AHT > 3 Menit',
				backgroundColor: "blue",
				type: 'bar',
				yAxisID: 'y-axis-1',
				data: [
					<?php
					foreach ($report_qms as $r) {
						$aht_1[$r->id] = $r->aht_1;
						$y = $aht_1[$r->id];
						$jumlah1 = $sum += $y;

						$aht_2[$r->id] = $r->aht_2;
						$y2 = $aht_2[$r->id];
						$jumlah2 = $sum1 += $y2;

						$aht_3[$r->id] = $r->aht_3;
						$y3 = $aht_3[$r->id];
						$jumlah3 = $sum3 += $y3;

						$aht_4[$r->id] = $r->aht_4;
						$y4 = $aht_4[$r->id];
						$jumlah4 = $sum4 += $y4;

						$aht_5[$r->id] = $r->aht_5;
						$y5 = $aht_5[$r->id];
						$jumlah5 = $sum5 += $y5;

						$aht_6[$r->id] = $r->aht_6;
						$y6 = $aht_6[$r->id];
						$jumlah6 = $sum6 += $y6;

						$aht_7[$r->id] = $r->aht_7;
						$y7 = $aht_7[$r->id];
						$jumlah7 = $sum7 += $y7;

						$aht_8[$r->id] = $r->aht_8;
						$y8 = $aht_8[$r->id];
						$jumlah8 = $sum8 += $y8;
					} ?>
					<?php echo  $jumlah1; ?>,
					<?php echo  $jumlah2; ?>,
					<?php echo  $jumlah3; ?>,
					<?php echo  $jumlah4; ?>,
					<?php echo  $jumlah5; ?>,
					<?php echo  $jumlah6; ?>,
					<?php echo  $jumlah7; ?>,
					<?php echo  $jumlah8; ?>
				],

			}, ]

		};

		var chartjs_multiaxis_bar = document.getElementById("barChart2");

		if (chartjs_multiaxis_bar) {
			ctx = document.getElementById('barChart2').getContext('2d');
			var mixedChart = new Chart(ctx, {
				type: 'bar',
				data: barmultiaxisChartData,
				options: {
					maintainAspectRatio: false,
					scales: {
						yAxes: [{
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'right',
							id: 'y-axis-1',
							ticks: {
								suggestedMin: 0
							}
						}]
					}
				}
			});

		}
	});

	//--- QMS Chart --//
	$(document).ready(function() {


		var barmultiaxisChartData = {
			labels: [
				['Phone', 'and', 'Communication Skill'], 'Validation', ['Documentation &', 'Information']
			],
			datasets: [{
				label: 'Quality Monitoring Score',
				backgroundColor: "green",
				type: 'bar',
				yAxisID: 'y-axis-1',
				data: [
					<?php
					foreach ($report_qms as $r) {
						$total_phone	  = $r->skill_communication_1 + $r->skill_communication_2 + $r->skill_communication_3 +
							$r->skill_communication_4 + $r->skill_communication_5 + $r->skill_communication_6 +
							$r->skill_communication_7 + $r->skill_communication_8;
						$total_validation = $r->validation_1 + $r->validation_2 + $r->validation_3 + $r->validation_4 +
							$r->validation_5 + $r->validation_6 + $r->validation_7 + $r->validation_8 +
							$r->validation_9 + $r->validation_10 + $r->validation_11;
						$total_documentation =  $r->documentation_1 + $r->documentation_2 + $r->documentation_3;
						echo  $total_phone; ?>, <?php
												echo  $total_validation; ?>, <?php
																				echo  $total_documentation;
																			} ?>
				],

			}, ]

		};

		var chartjs_multiaxis_bar = document.getElementById("qmsChart");

		if (chartjs_multiaxis_bar) {
			ctx = document.getElementById('qmsChart').getContext('2d');
			var mixedChart = new Chart(ctx, {
				type: 'bar',
				data: barmultiaxisChartData,
				options: {
					maintainAspectRatio: false,
					scales: {
						yAxes: [{
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'right',
							id: 'y-axis-1',
							ticks: {
								suggestedMin: 0
							}
						}]
					}
				}
			});

		}
	});
</script>
<script>
	var copyBtn = document.querySelector('#copy_btn');
	copyBtn.addEventListener('click', function() {
		var urlField = document.querySelector('#table');

		// create a Range object
		var range = document.createRange();
		// set the Node to select the "range"
		range.selectNode(urlField);
		// add the Range to the set of window selections
		window.getSelection().addRange(range);

		// execute 'copy', can't 'cut' in this case
		document.execCommand('copy');
	}, false);
</script>