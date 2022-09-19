<a class="btn-lte3 btn-app text-black  pull-right" onclick="printDiv('printableArea')">
	<i class="fas fa-print"></i> Print
</a>
<br>
<br>

<div id="printableArea">
	<div align="center">
		<h3>BERITA ACARA TEGURAN LISAN</h3>
	</div>

	<table width="100%" border="1">
		<tbody>
			<tr>
				<td colspan="3">
					<table width="100%" border="0">
						<tr>
							<td width="25%"><b>NAMA</b></td>
							<td width="1%">
								<div align="center">:</div>
							</td>
							<td width="74%"><?php echo $nama_penerima; ?></td>
						</tr>
						<tr>
							<td><b>UNIT KERJA</b></td>
							<td>
								<div align="center">:</div>
							</td>
							<td>CC PROFILING</td>
						</tr>
						<tr>
							<td><b>PEMBERI TEGURAN</b></td>
							<td>
								<div align="center">:</div>
							</td>
							<td><?php echo $nama_pemberi; ?></td>
						</tr>
						<tr>
							<td><b>TANGGAL TEGURAN</b></td>
							<td>
								<div align="center">:</div>
							</td>
							<td><?php echo $tanggal_teguran; ?></td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table width="100%" border="0">
						<tr>
							<td colspan="3"><b>ISI TEGURAN LISAN :</b></td>
						</tr>
						<tr>
							<td height="250" colspan="3"><?php echo $isi_teguran_lisan;
															echo "<br>";
															echo $pertimbangan_tindakan; ?></td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td colspan="3">
					<p><b>KOMITMEN :</b></p>
					<?php echo $komitmen; ?>
					<p>&nbsp;</p>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<p><b>VERIFIKASI : </b></p>
					<?php echo $verifikasi; ?>
					<p>&nbsp;</p>
				</td>

			</tr>

		</tbody>
	</table>

	<table width="100%" border="0">
		<tbody>
			<tr>
				<td colspan="3"><b>Bandung, <?php echo $tanggal_teguran; ?></b></td>
			</tr>
			<tr>
				<td colspan="3">Mengetahui,</td>
			</tr>
			<tr>
				<td>
					<p align="center"><b>Atasan Penegur</b></p>
					<p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p>
					<p align="center"><b>Erick Yanida Firmansyah</b></p>
				</td>
				<td>
					<p align="center"><b>Pegawai yang ditegur</b></p>
					<p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p>
					<p align="center"><b><?php echo $nama_penerima; ?></b></p>
				</td>
				<td>
					<p align="center"><b>Pemberi Teguran Lisan</b></p>
					<p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p>
					<p align="center"><b><?php echo $nama_pemberi; ?></b></p>
				</td>
			</tr>
		</tbody>
	</table>
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