<?php echo _css('datatables,icheck') ?>
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
					<?php
					if ($user_categori != 8) {
					?>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Agent </label>
								<select name='agentid' id="agentid" class="form-control custom-select">
									<?php

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
					<?php
					}

					?>

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
					<th><b>Keterangan</b></th>

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
							<!-- <a href="<?php echo base_url() . "Histori_call/Histori_call/detail/" . $datana['idx'] ?>" class="btn btn-default text-red btn-sm " title="detail"><i class="fa fa-info"></i></a> -->
							<a href="<?php echo base_url() . 'Outbound/Outbound/edit?phone=' . $datana['pstn1'] . '&ncli=' . $datana['ncli'] . '&handphone=' . $datana['handphone'] . '&userid=' . $datana['veri_upd'] ?>" target='_blank' class="btn btn-default text-red btn-sm " title="update"><i class="fa fa-info"></i></a>
							<!-- <a href="
							<?php //echo $link_delete . "/" . $datana['idx'] 
							?>
							" class="btn btn-default text-red btn-sm" title="delete" onclick="deleteItem(<?php // echo $datana['id']; 
																											?>)"><i class="fa fa-trash"></i></a> -->
						</td>
						<td><?php echo $this->Status_call->get_row(array("id_reason" => $datana['veri_call']))->nama_reason; ?></td>
						<td><?php echo $datana['ncli']; ?></td>
						<td><?php echo $datana['pstn1']; ?></td>
						<td><?php echo $datana['no_speedy']; ?></td>
						<td><?php echo $datana['handphone']; ?></td>
						<td><?php echo $datana['nama']; ?></td>
						<td><?php echo $datana['email']; ?></td>
						<td><?php echo $datana['veri_keterangan']; ?></td>
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





<?php echo card_close() ?>

<?php echo _js('datatables,icheck') ?>

<script>
	var page_version = "1.0.8"
</script>
<script>
	$(document).ready(function() {
		$('#example').DataTable();
	});

	function deleteItem() {
		if (confirm("anda ingin hapus data ini?")) {
			// your deletion code
		}
		return false;
	}
</script>