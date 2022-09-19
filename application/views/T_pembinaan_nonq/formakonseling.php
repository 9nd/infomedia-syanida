<a class="btn-lte3 btn-app text-black  pull-right" onclick="printDiv('printableArea')">
	<i class="fas fa-print"></i> Print
</a>
<br>
<br>

<div id="printableArea">
	<table width="100%" height="82" border="1">
		<tbody>
			<tr>
				<td colspan="8"><img src='<?php echo base_url(); ?>assets/images/logopembnaan.png'></td>
			</tr>
			<tr>
				<td colspan="8">
					<div align="center" style="padding-left: 2px;"><b>FORM COACHING</b></div>
				</td>
			</tr>
			<tr>
				<td colspan="8">
					<div align="center" style="padding-left: 2px;">
						<table border="0" width="100%">
							<tr>
								<td colspan="3" style="padding-left: 10px;">Tanggal</td>
								<td colspan="2" style="padding-left: 2px;">: <?php echo $tanggal ?></td>
								<td width="59"></td>
								<td width="173" style="padding-left: 10px;">Nama SDM</td>
								<td width="372" style="padding-left: 2px;">: <?php echo $penerima;
																				?></td>
							</tr>
							<tr>
								<td colspan="3" style="padding-left: 10px;">Departemen/Layanan</td>
								<td colspan="2" style="padding-left: 2px;">: TELKOM DIV.2/PROFILING CONSUMER</td>
								<td>&nbsp;</td>
								<td style="padding-left: 10px;" width="200">Paraf SDM yang di coaching</td>
								<td style="padding-left: 2px;">: </td>
							</tr>
							<tr>
								<td colspan="3" style="padding-left: 10px;">Lokasi</td>
								<td colspan="2" style="padding-left: 2px;">: Ters. Buah Batu No. 31-33 Bandung</td>
								<td>&nbsp;</td>
								<td style="padding-left: 10px;">Atasan Langsung</td>
								<td style="padding-left: 2px;">: <?php echo $atasan;
																	?></td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
								<td colspan="2">&nbsp;</td>
								<td>&nbsp;</td>
								<td style="padding-left: 10px;" style="padding-left: 10px;">Paraf Atasan Langsung</td>
								<td style="padding-left: 2px;">: </td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
								<td colspan="2">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>

			<tr>
				<td colspan="6">
					<div align="center"><b>PERMASALAHAN</b></div>
				</td>
				<td colspan="2" align="center" style="padding-left: 10px;" width="3000"><b>PENYULUHAN</b></td>
			</tr>
			<tr>
				<td width="46">
					<div align="center">Tgl</div>
				</td>
				<td colspan="5">
					<div align="center">Permasalahan</div>
				</td>
				<td colspan="2" rowspan="5" valign="top" style="padding-left: 10px;"><?php if (isset($penyuluhan)) {
																							echo $penyuluhan;
																						} ?></td>
			</tr>
			<tr>

				<td><?php

					if (isset($cases[0]->tglk)) {
						$tgl = $cases[0]->tglk;
						echo substr("$tgl", 5, 5);
					} else {
						echo "&nbsp;";
					}

					?></td>
				
				<td colspan="5" style="padding-left: 10px;"><?php if (isset($cases[0]->detailnotk)) {
																echo $cases[0]->detailnotk;
															} else {
																echo "&nbsp;";
															} ?>&nbsp;</td>
			</tr>
			<tr>
				<td><?php
					if (isset($cases[1]->tglk)) {
						$tgl = $cases[1]->tglk;
						echo substr("$tgl", 5, 5);
					} else {
						echo "&nbsp;";
					}

					?></td>
			
				<td colspan="5" style="padding-left: 10px;"><?php if (isset($cases[1]->detailnotk)) {
																echo $cases[1]->detailnotk;
															} else {
																echo "&nbsp;";
															} ?>&nbsp;</td>
			</tr>
			<tr>
				<td><?php
					if (isset($cases[2]->tglk)) {
						$tgl = $cases[2]->tglk;
						echo substr("$tgl", 5, 5);
					} else {
						echo "&nbsp;";
					}

					?></td>
			
				<td colspan="5" style="padding-left: 10px;"><?php if (isset($cases[2]->detailnotk)) {
																echo $cases[2]->detailnotk;
															} else {
																echo "&nbsp;";
															} ?>&nbsp;</td>
			</tr>
			<tr>
				<td><?php
					if (isset($cases[3]->tglk)) {
						$tgl = $cases[3]->tglk;
						echo substr("$tgl", 5, 5);
					} else {
						echo "&nbsp;";
					}

					?></td>
				
				<td colspan="5" style="padding-left: 10px;"><?php if (isset($cases[3]->detailnotk)) {
																echo $cases[3]->detailnotk;
															} else {
																echo "&nbsp;";
															} ?>&nbsp;</td>
			</tr>
			<tr>
				<td><?php
					if (isset($cases[4]->tglk)) {
						$tgl = $cases[4]->tglk;
						echo substr("$tgl", 5, 5);
					} else {
						echo "&nbsp;";
					}

					?></td>
			
				<td colspan="5" style="padding-left: 10px;"><?php if (isset($cases[4]->detailnotk)) {
																echo $cases[4]->detailnotk;
															} else {
																echo "&nbsp;";
															} ?>&nbsp;</td>
				<td colspan="2" style="padding-left: 10px;">
					<div align="center" style="padding-left: 10px;"><b>ACTION PLAN:</b></div>
				</td>
			</tr>
			<tr>
				<td><?php

					if (isset($cases[5]->tglk)) {
						$tgl = $cases[5]->tglk;
						echo substr("$tgl", 5, 5);
					} else {
						echo "&nbsp;";
					}

					?></td>
				
				<td colspan="5" style="padding-left: 10px;"><?php if (isset($cases[5]->detailnotk)) {
																echo $cases[5]->detailnotk;
															} else {
																echo "&nbsp;";
															} ?>&nbsp;</td>
				<td colspan="2" rowspan="5" valign="top" style="padding-left: 10px;"><?php if (isset($actionplan)) {
																							echo $actionplan;
																						} else {
																							echo "&nbsp;";
																						} ?></td>
			</tr>
			<tr>
				<td><?php
					if (isset($cases[6]->tglk)) {
						$tgl = $cases[6]->tglk;
						echo substr("$tgl", 5, 5);
					} else {
						echo "&nbsp;";
					}

					?></td>
				
				<td colspan="5" style="padding-left: 10px;"><?php if (isset($cases[6]->detailnotk)) {
																echo $cases[6]->detailnotk;
															} else {
																echo "&nbsp;";
															} ?>&nbsp;</td>
			</tr>
			<tr>
				<td><?php
					if (isset($cases[7]->tglk)) {
						$tgl = $cases[7]->tglk;
						echo substr("$tgl", 5, 5);
					} else {
						echo "&nbsp;";
					}

					?></td>
			
				<td colspan="5" style="padding-left: 10px;"><?php if (isset($cases[7]->detailnotk)) {
																echo $cases[7]->detailnotk;
															} else {
																echo "&nbsp;";
															} ?>&nbsp;</td>
			</tr>
			<tr>
				<td><?php

					if (isset($cases[8]->tglk)) {
						$tgl = $cases[8]->tglk;
						echo substr("$tgl", 5, 5);
					} else {
						echo "&nbsp;";
					}

					?></td>
				
				<td colspan="5" style="padding-left: 10px;"><?php if (isset($cases[8]->detailnotk)) {
																echo $cases[8]->detailnotk;
															} else {
																echo "&nbsp;";
															} ?>&nbsp;</td>
			</tr>
			<tr>
				<td><?php
					if (isset($cases[9]->tglk)) {
						$tgl = $cases[9]->tglk;
						echo substr("$tgl", 5, 5);
					} else {
						echo "&nbsp;";
					}

					?></td>
			
				<td colspan="5" style="padding-left: 10px;"><?php if (isset($cases[9]->detailnotk)) {
																echo $cases[9]->detailnotk;
															} else {
																echo "&nbsp;";
															} ?>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3" width="5000">
					<div align="center"><b>JENIS COACHING</b></div>
				</td>
				<td width="87">
					<div align="center"><b>Batas Waktu Verifikasi</b></div>
				</td>
				<td colspan="2" style="padding-left: 10px;" width="2200">Tgl. Verifikasi</td>
				<td style="padding-left: 2px;">:</td>
			</tr>
			<tr>
				<td>
					<div align="center">
						<input type="checkbox" name="checkbox" id="checkbox">
					</div>
				</td>
				<td colspan="3" style="padding-left: 10px;">Tidak memenuhi Target Verified</td>
				<td>
					<div align="center">Bulanan</div>
				</td>
				<td colspan="2" style="padding-left: 10px;">Paraf Atasan Langsung</td>
				<td style="padding-left: 2px;">:</td>
			</tr>
			<tr>
				<td>
					<div align="center">
						<input type="checkbox" name="checkbox2" id="checkbox2">
					</div>
				</td>
				<td colspan="3" style="padding-left: 10px;">Gagal Tes Perbaikan target nilai PnP</td>
				<td>
					<div align="center">Bulanan</div>
				</td>
				<td colspan="2" style="padding-left: 10px;">Paraf Pegawai Subjek Coaching</td>
				<td style="padding-left: 2px;">:</td>
			</tr>
			<tr>
				<td>
					<div align="center">
						<input type="checkbox" name="checkbox3" id="checkbox3">
					</div>
				</td>
				<td colspan="3" style="padding-left: 10px;">Tidak mencapai target PPCO</td>
				<td>
					<div align="center">Bulanan</div>
				</td>
				<td colspan="3">
					<div align="center"><b>HASIL PERBAIKAN COACHING (VERIFIKASI)</b></div>
				</td>
			</tr>
			<tr>
				<td>
					<div align="center">
						<input type="checkbox" name="checkbox4" id="checkbox4">
					</div>
				</td>
				<td colspan="3" style="padding-left: 10px;">Kesalahan pembuatan Ticket ( Handling / Complaint / Request )*</td>
				<td>
					<div align="center">10 Harian</div>
				</td>
				<td colspan="3" rowspan="7" align="left" valign="top" style="padding-left: 10px;">&nbsp;</td>
			</tr>
			<tr>
				<td>
					<div align="center">
						<input type="checkbox" name="checkbox5" id="checkbox5">
					</div>
				</td>
				<td colspan="3" style="padding-left: 10px;">LOG IN terlambat (maksimum 10 menit akumulasi 25 hari)</td>
				<td>
					<div align="center">Bulanan</div>
				</td>
			</tr>
			<tr>
				<td>
					<div align="center">
						<input type="checkbox" name="checkbox6" id="checkbox6">
					</div>
				</td>
				<td colspan="3" style="padding-left: 10px;">Tidak hadir ( Training / Sosialisasi / Meeting )*</td>
				<td>
					<div align="center">Bulanan</div>
				</td>
			</tr>
			<tr>
				<td>
					<div align="center">
						<input type="checkbox" name="checkbox7" id="checkbox7">
					</div>
				</td>
				<td colspan="3" style="padding-left: 10px;">Pelanggaran Sopan santun / Komitmen CO (Performance)</td>
				<td>
					<div align="center">Bulanan</div>
				</td>
			</tr>
			<tr>
				<td>
					<div align="center">
						<input type="checkbox" name="checkbox8" id="checkbox8">
					</div>
				</td>
				<td colspan="3" style="padding-left: 10px;">Softskills</td>
				<td>
					<div align="center">Bulanan</div>
				</td>
			</tr>
			<tr>
				<td>
					<div align="center">
						<input type="checkbox" name="checkbox9" id="checkbox9">
					</div>
				</td>
				<td colspan="3" style="padding-left: 10px;">Product Knowledge</td>
				<td>
					<div align="center">2 Mingguan</div>
				</td>
			</tr>
			<tr>
				<td>
					<div align="center">
						<input type="checkbox" name="checkbox10" id="checkbox10">
					</div>
				</td>
				<td colspan="3" style="padding-left: 10px;">Not Approve 5x (<?php if (isset($tkpembinaan)) {
																				echo $tkpembinaan;
																			}else{ echo "isi jenis coaching";} ?>)</td>
				<td>
					<div align="center">2 Mingguan</div>
				</td>
			</tr>

		</tbody>
	</table>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Coret yang tidak perlu
	<br>
	<br>

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ISH.OPR.03.27 Rev. 01
</div>

<script>
	function printDiv(divName) {

		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;
		var css = '@page { size: landscape; }',
			head = document.head || document.getElementsByTagName('head')[0],
			style = document.createElement('style');

		style.type = 'text/css';
		style.media = 'print';

		if (style.styleSheet) {
			style.styleSheet.cssText = css;
		} else {
			style.appendChild(document.createTextNode(css));
		}

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
	}
</script>