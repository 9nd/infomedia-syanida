<a class="btn-lte3 btn-app text-black  pull-right" onclick="printDiv('printableArea')">
	<i class="fas fa-print"></i> Print
</a>
<br>
<br>

<div id="printableArea">
	<table width="100%" border="0">
		<tbody>
			<tr>
				<td colspan="4">
					<div align="center"><strong>
							<h3>FORMULIR KONSELING</h3>
						</strong></div>
				</td>
			</tr>
			<tr>
				<td width="27%">Nama Yang dikonseling</td>
				<td width="3%">
					<div align="center">:</div>
				</td>
				<td colspan="2"><?php echo $nama_penerima; ?></td>
			</tr>
			<tr>
				<td>Nama Konselor</td>
				<td>
					<div align="center">:</div>
				</td>
				<td colspan="2"><?php echo $nama_pemberi; ?></td>
			</tr>
			<tr>
				<td>Bulan / Tahun</td>
				<td>
					<div align="center">:</div>
				</td>
				<td colspan="2"><?php echo $bulan_tahun; ?></td>
			</tr>
			<tr>
				<td>Lokasi Kerja</td>
				<td>
					<div align="center">:</div>
				</td>
				<td colspan="2">Bandung</td>
			</tr>
			<tr>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="4">
					<table width="100%" border="1">
						<tbody>
							<tr>
								<td width="3%">
									<div align="center">NO</div>
								</td>
								<td width="28%">
									<div align="center">DATA PERFORMANCE</div>
								</td>
								<td width="24%">
									<div align="center">KETIDAKSESUAIAN</div>
								</td>
								<td width="16%">
									<div align="center">PEMBINAAN</div>
								</td>
								<td width="29%">
									<div align="center">KOMITMEN PERBAIKAN</div>
								</td>
							</tr>
							<tr>
								<td>1</td>
								<td><?php echo $data_performance ?></td>
								<td><?php echo $ketidaksesuaian ?></td>
								<td><?php echo $get_jenis ?></td>
								<td><?php echo $komitmen_perbaikan ?></td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="4">Bandung, <?php echo $bulan_tahun ?></td>
			</tr>
			<tr>
				<td colspan="2"><b>Dibuat Oleh, </b></td>
				<td width="37%">
					<div align="right"></div>
				</td>
				<td width="33%"><b>Diketahui Oleh</b></td>
			</tr>
			<tr>
				<td colspan="4">
					<table width="100%" border="0">
						<tr>
							<td width="33%">
								<div align="center">
									<p><b>Konselor</b></p>
									<p>&nbsp;</p>
									<p>&nbsp;</p>
								</div>
							</td>
							<td width="34%">
								<div align="center">
									<p><b>Pegawai yang dikonseling</b></p>
									<p>&nbsp;</p>
									<p>&nbsp;</p>
								</div>
							</td>
							<td width="33%">
								<div align="center">
									<p><b>Infomedia Solusi Humanika</b></p>
									<p>&nbsp;</p>
									<p>&nbsp;</p>
								</div>
							</td>
						</tr>
						<tbody>
							<tr>
								<td><b>Nama / NIK : <?php echo $nik_konselor->nama . " / " . $nik_konselor->nik_absensi; ?></b></td>
								<td><b>Nama / NIK : <?php echo $nik_penerima->nama . " / " . $nik_penerima->nik_absensi; ?></b></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td><b>Jabatan : <?php $level = $ctrl->db->query("SELECT * FROM sys_level WHERE id='$nik_konselor->opt_level'")->row()->nmlevel;
												echo $level; ?></b></td>
								<td><b>Jabatan : <?php $level = $ctrl->db->query("SELECT * FROM sys_level WHERE id='$nik_penerima->opt_level'")->row()->nmlevel;
												echo $level; ?></b></td>
								<td>&nbsp;</td>
							</tr>
						</tbody>
					</table>
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