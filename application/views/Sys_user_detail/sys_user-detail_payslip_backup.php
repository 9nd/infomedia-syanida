<?php echo _css('selectize,datepicker,chartjs,datatables') ?>

<?php echo card_open('Form', 'bg-green', true) ?>
<input type="button" onclick="printDiv('wrapwrap')" value="print" class="btn btn-primary" style="float:right"/>
<div id="wrapwrap">
	<main>



		<div class="page">
			<div class="row">
				<div class="col-xs-3">
					<img style="margin:0 0 20px 10px;max-height:100px" src="<?php echo base_url(); ?>assets/images/logopembnaan.png" /></div>
			</div>
			<?php
			$curdata = $controller->db->query("SELECT * FROM sys_user_detail_payroll WHERE id='$id'")->row();
			?>
			<table class="table-condensed " width="100%">
				<tbody>
					<tr>
						<td colspan="1">
							<strong>Nama Karyawan</strong>
							<br>
							<strong>Nomor Karyawan</strong>
							<br>
							<strong>Jabatan</strong>
							<br>
							<strong>Departemen</strong>
							<br>
						</td>
						<td>
							:
							<span><?php
									$nama = $controller->db->query("SELECT * FROM sys_user_detail WHERE agentid='$curdata->agentid'");
									echo $nama->row()->nama_lengkap;
									?></span>
							<br>
							:
							<span><?php
									echo $nama->row()->perner;
									?></span>
							<br>
							:
							<span>AGENT</span>
							<br>
							:
							<span>TELKOM CONSUMER CC BANDUNG</span>
							<br>
						</td>
					</tr>
				</tbody>
			</table>
			<br>
			<center>
				<h5>RINCIAN PENDAPATAN</h5>
				Bulan :
				<span><?php
						echo date_format(date_create($curdata->bulan), 'F Y');
						?></span>
			</center>
			<br>
			<div style="width:100%">
				<div style="display: inline-block;width:45%">
					<table class="oe_inline table-condensed " width="100%">
						<thead>
							<tr style="border-bottom:1px solid #eeeeee">
								<th>Pendapatan</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>

									<span>
										<span>Komisi Progressive</span>
										<br>
									</span>

									<span>
										<span>BPJS Kesehatan Allowance</span>
										<br>
									</span>

									<span>
										<span>JP Allowance</span>
										<br>
									</span>

								</td>
								<td align="right">

									<span>
										<span>Rp. 
											<?php
											echo number_format($curdata->p_kompro);
											?>
										</span>
										<br>
									</span>

									<span>
										<span>Rp. 
											<?php
											echo number_format($curdata->p_bpjskes);
											?>
										</span>
										<br>
									</span>

									<span>
										<span>Rp. 
											<?php
											echo number_format($curdata->p_jpal);
											?>
										</span>
										<br>
									</span>

								</td>
							</tr>
						</tbody>
						<thead>
							<tr style="border-bottom:1px solid #eeeeee">
								<th>Potongan</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>

									<span>BPJS Kesehatan Deduction</span>
									<br>
									<span>JP Deduction</span>
									<br>
								</td>
								<td align="right">

									<span>Rp. <?php
											echo number_format($curdata->pt_bpjskes);
											?></span>
									<br>
									<span>Rp. <?php
											echo number_format($curdata->pt_jpal);
											?></span>
									<br>
								</td>
							</tr>
						</tbody>
						<thead>
							<tr style="border-bottom:1px solid #eeeeee">
								<th>Total</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									Total Pendapatan
									<br>
									Total Potongan
								</td>
								<td align="right">
									<span>Rp. <?php
											$totalpen = $curdata->p_kompro + $curdata->p_bpjskes + $curdata->p_jpal;
											echo number_format($totalpen);
											?></span>
									<br>
									<span>Rp. <?php
											$totalpeng = $curdata->pt_bpjskes + $curdata->pt_jpal;
											echo number_format($totalpeng);
											?></span>
									<br>
								</td>
							</tr>
						</tbody>
						<tbody>
							<tr style="margin-top:15px;font-weight:bold">
								<td>
									Pendapatan Dibayarkan
								</td>
								<td align="right">
									<span>Rp. <?php
											$total = $totalpen - $totalpeng;
											echo number_format($total);
											?></span>
								</td>
							</tr>
						</tbody>

					</table>
				</div>
				<div style="display: inline-block;width:45%;right:0;float:right">
					<table class="table-condensed " width="100%">
						<thead>
							<tr style="border-bottom:1px solid #eeeeee">
								<th>Benefit</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>

								</td>
								<td align="right">

								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<p class="text-right">
				<strong>
					** Ini adalah
					<i>Electronic Payslip</i>
					karyawan
				</strong>
			</p>
		</div>



	</main>
</div>


<?php echo card_close() ?>

<?php echo _js('selectize,datepicker,chartjs,datatables') ?>
<script>
	function printDiv(wrapwrap) {
		var printContents = document.getElementById(wrapwrap).innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
	}
</script>