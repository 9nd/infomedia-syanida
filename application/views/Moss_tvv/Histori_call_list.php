<?php echo _css('datatables,icheck') ?>
<?php
if (isset($_GET['success'])) {
	if ($_GET['success'] == 1) {
		$color = "green";
		$icon = "check";
		$status = "Berhasil";
	} else {
		$color = "red";
		$icon = "cross";
		$status = "Gagal";
	}
?>
	<div class="col-lg-12 col-xs-12 blink_me_veri">
		<div class="small-box bg-<?php echo $color; ?>">
			<div class="inner">
				<p>Data TVV <?php echo $status; ?> Disubmit</p>
			</div>
			<div class="icon-counter">
				<i class="fa fa-<?php echo $icon; ?>-square-o"></i>
			</div>
		</div>
	</div>
<?php
}
?>
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

					<div class='col-md-6 col-xl-6'>
						<div class='form-group'>
							<label class='form-label'>Date</label>
							<input type='date' min="" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='id_reason' name='tgl' value='<?php if (isset($_GET['tgl'])) echo $_GET['tgl'] ?>'>
						</div>
					</div>

					<div class='col-md-12 col-xl-12'>

						<div class='form-group'>
							<button id='btn-save' type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Search</button>
						</div>

					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<?php echo card_open('Daftar', 'bg-teal', true) ?>

<?php
if ($_GET['tgl']) {


?>
	<div class='box-body table-responsive' id='box-table'>
		<small>
			<table class='display nowrap' id="example" style="width: 100%;">
				<thead>
					<tr>
						<th><b>No</b></th>
						<th><b>Option</b></th>
						<th><b>Reason Call</b></th>
						<th><b>NCLI</b></th>
						<th><b>NO PSTN</b></th>
						<th><b>No Speedy</b></th>
						<th><b>No Handphone</b></th>
						<th><b>Nama Pelanggan</b></th>
						<th><b>Email</b></th>
						<th><b>Lup</b></th>
						<!-- <th><b>Keterangan</b></th> -->

					</tr>
				</thead>
				<tbody>
					<?php
					$nomor = 1;
					foreach ($list as $datana) {
					?>
						<tr>
							<td><?php echo $nomor; ?></td>
							<td>
								<?php
								if ($datana['reason_call'] != '13') {
								?>
									<a href="<?php echo base_url() . 'Moss_tvv/Moss_tvv/edit/' . $datana['idx'] ?>" class="btn btn-default text-red btn-sm " title="update"><i class="fa fa-file"></i></a>
								<?php
								}
								?>
							</td>
							<td><?php echo $this->Status_call->get_row(array("id_reason" => $datana['reason_call']))->nama_reason; ?></td>
							<td><?php echo $datana['ncli']; ?></td>
							<td><?php echo $datana['no_pstn']; ?></td>
							<td><?php echo $datana['no_speedy']; ?></td>
							<td><?php echo $datana['no_handpone']; ?></td>
							<td><?php echo $datana['nama_pelanggan']; ?></td>
							<td><?php echo $datana['email']; ?></td>
							<!-- <td><?php echo $datana['veri_keterangan']; ?></td> -->
							<td><?php echo $datana['lup']; ?></td>
						</tr>
					<?php
						$nomor++;
					}
					?>
				</tbody>
			</table>

			<div hidden>
				<button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modal-danger' id='button_delete_single'></button>
			</div>
		</small>
	</div>
<?php
} else {
?>
	<div class='box-body table-responsive' id='box-table'>
		<small>

			<table class='display nowrap' id="example" style="width: 100%;">
				<thead>
					<tr>
						<th><b>No</b></th>
						<th><b>NCLI</b></th>
						<th><b>No PSTN</b></th>
						<th><b>No Indihome</b></th>
						<th><b>Nama Pastel</b></th>
						<th><b>Handphone</b></th>
						<th><b>Email</b></th>
						<th><b>Layanan</b></th>
						<th><b>Lup</b></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$nomor = 1;


					foreach ($data_list as $datana) {
					?>
						<tr>
							<td><?php echo $nomor; ?>

							</td>
							<td id="idx<?php echo $datana['idx'] ?>">
								<span class="btn btn-sm btn-primary"><?php echo $datana['ncli']; ?></span>
							</td>
							<td><?php echo $datana['no_pstn']; ?></td>
							<td><?php echo $datana['no_speedy']; ?></td>
							<td><?php echo $datana['nama_pastel']; ?></td>
							<td><?php echo $datana['no_handpone']; ?></td>
							<td><?php echo $datana['email']; ?></td>
							<td><?php echo $datana['layanan']; ?></td>
							<td><?php echo $datana['lup']; ?></td>
						</tr>
					<?php
						$nomor++;
					}
					// } else {
					//     echo "<td colspan='10'>Tidak ada data</td>";

					?>

				</tbody>
			</table>
		</small>
	</div>
<?php
}
?>




<?php echo card_close() ?>

<?php echo _js('datatables,icheck') ?>

<script>
	var page_version = "1.0.8"
</script>
<script>
	$(document).ready(function() {
		$('#example').DataTable();

		function refresh_div() {
			var text_title = $("#title_app").text();
			$.ajax({
				url: '<?php echo base_url() ?>Outbound/Outbound/get_list_mos_tvv',
				type: 'POST',
				dataType: 'JSON',
				success: function(response) {

					$.each(response.data, function(key, val) {
						// alert(key);
						if (key == 'waiting') {
							$("#lblatas").html("MOSS : " + val);
							if (parseInt(val) > 0) {
								$("#lblatas").attr("class", "label btn btn-danger icon-shake-jump");
								// $("#lblatas").show();
								// $("#title_app").text("( " + val + " ) NEW DATA MOSS | Sy-ANIDA");

							} else {
								// $("#lblatas").hide();
								$("#lblatas").attr("class", "label btn btn-success");
								$("#lblatas").html("MOSS : " + val);
								$("#title_app").html('Sy-ANIDA | Profiling');
							}

							$("#lblbawah").html(val);
						}
						if (key == 'oncall') {
							$.each(val, function(keyna, valna) {
								var urlna = $("#link_" + valna.idx).val();
								$("#idx" + valna.idx).html('<a target="_blank" href="' + urlna + '"><span class="btn btn-sm btn-success">On Call : ' + valna.agentid + '</span></a>');
							});
						}
						if (key == 'oncall_indibox') {
							$.each(val, function(keyna, valna) {
								var urlna = $("#indibox_link_" + valna.idx).val();
								$("#idx_indibox" + valna.idx).html('<a target="_blank" href="' + urlna + '"><span class="btn btn-sm btn-success">On Call : ' + valna.agentid + '</span></a>');
							});
						}
						if (key == 'indibox') {
							$("#indinum").html("INDIBOX : " + val);
							if (parseInt(val) > 0) {
								$("#indinum").attr("class", "label btn btn-danger icon-shake-jump");

							} else {
								// $("#lblatas").hide();
								$("#indinum").attr("class", "label btn btn-success");
								$("#indinum").html("INDIBOX : " + val);
							}

							$("#lblbawah").html(val);
						}


					});


					refresh_div();
				}
			});
		}
		// t = setInterval(refresh_div, 1000);
		refresh_div();
	});

	function deleteItem() {
		if (confirm("anda ingin hapus data ini?")) {
			// your deletion code
		}
		return false;
	}
</script>