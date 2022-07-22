<?php echo _css('datatables,icheck') ?>

<div class="col-sm-12 col-lg-12">


	<div class="alert alert-icon alert-success" role="alert">
		<i class="fe fe-check mr-2" aria-hidden="true"></i><small>Pisahkan No.Internet dengan menggunakan koma (,)</small><br>
		<!-- <i class="fe fe-check mr-2" aria-hidden="true"></i><small>Step 2. Isi Table pada Sheet Template</small><br> -->
		<!-- <i class="fe fe-check mr-2" aria-hidden="true"></i><small>Step 3. Upload kembali file Template yang telah di isi</small><br> -->
		<!-- <i class="fe fe-check mr-2" aria-hidden="true"></i><small>Step 4. Konfirm dan Save</small> -->
	</div>



	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Check Payment Status</h3>
		</div>
		<div class="card-body">
			<div class="dimmer">

				<div class="dimmer-content">
					<form id="form-a" action="#" method="post">
						<!--<div class="form-label ">Upload File Template</div>-->
						<div class='col-md-12 col-xl-12'>
							<div class='form-group'>
								<label class='form-label'>NO.INTERNET</label>
								<textarea id='no_internet' name='no_internet' class='form-control'></textarea>
							</div>
						</div>
						<div class='col-md-12 col-xl-12'>

							<div class='form-group'>
								<button id='btn-save' type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Submit</button>
							</div>

						</div>
					</form>


					<br>

				</div>


			</div>
		</div>
	</div>
	<?php
	if ($_POST['no_internet']) {


	?>
		<div class="col-md-12 col-xl-12" id="panel-form-moss">
			<div class="card">
				<div class="card-status bg-orange"></div>
				<div class="card-header">
					<h3 class="card-title">LIST CUSTOMERS PAYMENT STATUS

					</h3>
					<div class="card-options">
						<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class='box-body table-responsive' id='box-table'>
						<small>
							<table class='timecard' id="report_table_reg" style="width: 100%;">
								<thead>
									<tr>
										<th>Phone</th>
										<th>Nama</th>
										<th>Periode</th>
										<th nowrap>Jumlah Tagihan</th>
										<th nowrap>Belum Bayar</th>
										<th nowrap>Status Pembayaran</th>
										<th>Cicilan</th>
										<th>Tanggal</th>
									</tr>
								</thead>
								<tbody>
									<?php
									echo $list;
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

		$(".selectgroup-input").change(function() {
			if ($(this).val() == "1") {
				$("#panel-form-reguler").show();
				$("#panel-form-moss").hide();
			} else {
				$("#panel-form-reguler").hide();
				$("#panel-form-moss").show();
			}
		});
	});
</script>