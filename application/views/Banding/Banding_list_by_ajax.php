<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->
<?php echo _css("datatables") ?>

<div class='col-md-12 col-xl-12'>
	<div class="card">
		<div class="card-status bg-green"></div>
		<div class="card-header">
			<h3 class="card-title">List Temuan Quality Controll
			</h3>
			<div class="card-options">
				<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
				<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
			</div>
		</div>
		<div class="card-body">


			<div class="box-body table-responsive" id='box-table'>
				<small>
					<table class='display dataTable nowrap' id="report_table_reg">
						<thead>
							<tr>
								<th>No</th>
								<th>Opsi</th>
								<th>Tanggal Kejadian</th>
								<th>Status Banding</th>
								<th>Nama QA</th>
								<th>Nama Agent</th>
								<th style="background-color: red; color: white;">No PSTN</th>
								<th style="background-color: red; color: white;">No Handphone</th>
								<th style="background-color: red; color: white;">Email</th>
								<th style="background-color: red; color: white;">Alamat Lengkap</th>
								<th style="background-color: red; color: white;">Opsi Chanel</th>
								<th style="background-color: yellow;">Nama Pelanggan</th>
								<th style="background-color: yellow;">Alamat</th>
								<th style="background-color: yellow;">Kecepatan</th>
								<th style="background-color: yellow;">Tagihan</th>
								<th style="background-color: yellow;">Tahun Pasang</th>
								<th style="background-color: yellow;">Tempat Pembayaran</th>
								<th>Kode Verifikasi</th>
								<th>Keterangan</th>
								<th>Reason QA</th>
								<th>AHT >3 Menit</th>
								<th>Durasi</th>
								<th>Notes</th>
							</tr>
						</thead>

					</table>
				</small>
			</div>
		</div>


		<!-- load library selectize -->
		<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->
		<?php echo _js("datatables") ?>
		<!-- <script type="text/javascript">
			$(document).ready(function() {
				$('#report_table_reg tbody').on('click', 'tr td div.hapus', function() {
					// $('.hapus').click(function() {
					if (confirm("Are you sure?")) {
						var del_id = $(this).attr('id');
						$.ajax({
							type: 'POST',
							url: '<?php echo base_url() ?>Report_qc/Report_qc/deleteqc',
							data: {
								'del_id': del_id
							},
							success: function(data) {
								location.reload();
							}


						});
					}
					return false;
				});
			});
		</script> -->
		<script type="text/javascript">
			$(document).ready(function() {

				$('#report_table_reg').DataTable({
					'processing': true,
					'serverSide': true,
					'serverMethod': 'post',
					'ajax': {
						'url': '<?php echo base_url() ?>Banding/Banding/qc_list'
					},
					'columns': [{
							data: 'no'
						},
						{
							data: 'opsi'
						},

						{
							data: 'tanggal_kejadian'
						},
						{
							data: 'status_banding'
						},
						{
							data: 'id_qc'
						},
						{
							data: 'nama_agent'
						},
						{
							data: 'pstn1'
						},

						{
							data: 'handphone'
						},
						{
							data: 'email'
						},
						{
							data: 'alamat'
						},
						{
							data: 'opsi_call'
						},
						{
							data: 'validate_1'
						},
						{
							data: 'validate_2'
						},
						{
							data: 'validate_3'
						},
						{
							data: 'validate_4'
						},
						{
							data: 'validate_5'
						},
						{
							data: 'validate_6'
						},
						{
							data: 'veri_system_qc'
						},
						{
							data: 'keterangan_qc'
						},
						{
							data: 'reason_qa'
						},
						{
							data: 'aht_qc'
						},
						{
							data: 'durasi_qc'
						},
						{
							data: 'note_qc'
						},
					]
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#report_table_reg tbody').on('click', 'tr td span.banding', function() {
					// $('.hapus').click(function() {
					if (confirm("Apa anda ingin melakukan banding?")) {
						var del_id = $(this).attr('id');
						var reason_banding = prompt("Reason banding");

						$.ajax({
							type: 'POST',
							url: '<?php echo base_url() ?>Banding/Banding/Banding',
							data: {
								'del_id': del_id,
								'reason_banding': reason_banding
							},
							success: function(data) {
								location.reload();
							}


						});
					}
					return false;
				});
				$('#report_table_reg tbody').on('click', 'tr td span.approve', function() {
					// $('.hapus').click(function() {
					if (confirm("Apa anda ingin melakukan Approve?")) {
						var del_id = $(this).attr('id');
						var reason_banding = prompt("Reason Approve");

						$.ajax({
							type: 'POST',
							url: '<?php echo base_url() ?>Banding/Banding/Approve',
							data: {
								'del_id': del_id,
								'reason_banding': reason_banding
							},
							success: function(data) {
								location.reload();
							}


						});
					}
					return false;
				});
				
			});
		</script>
		